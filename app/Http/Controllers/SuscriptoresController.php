<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suscriptor;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificacionSuscripcion;

class SuscriptoresController extends Controller
{
    public function formRegistrarSuscriptor(Request $request){
        return view('public.blog.form-suscripcion');
    }

    public function registrarSuscriptor(Request $request){
        $validated = $request->validate([
            'correo' => 'required|email:rfc,dns'
        ]);

        $suscriptor = Suscriptor::firstOrCreate(
            ['correo' => $validated['correo']],
            ['timestamp_verificacion' => null,
            'estado' => 0 // 0=INACTIVO, 1=ACTIVO, 9=ELIMINADO
        ]);

        if ($suscriptor->estado === 1) {
            return response()->json([
                'success' => true,
                'message' => 'La dirección de correo electrónico ya se encuentra suscrita y verificada.'
            ], 200);
        }

        if ($suscriptor->estado === 9) {
            $suscriptor->update([
                'timestamp_verificacion' => null,
                'estado' => 0
            ]);
        }


        $url = URL::temporarySignedRoute('blog-personal.verificar', now()->addHours(24),['id' => $suscriptor->id]);

        // enviar link correo
        $correoVerificacion = new VerificacionSuscripcion($url);
        
        Mail::to($validated['correo'])->send($correoVerificacion);

        return response()->json([
            'success' => true,
            'message' => 'Recibido exitosamente. Por favor, ingresa al enlace que envié a tu correo para completar el proceso de verificación.'
        ]);
        
    }

    public function verificarCorreo(Request $request, $id){
        if(!$request->hasValidSignature()){  
            $message = 'En enlace de verificación ha caducado.';
            return view('public.blog.resultado-verificacion', compact('message'));
        }

        $suscriptor = Suscriptor::findOrFail($id);

        if($suscriptor->timestamp_verificacion !== null){
            $message = 'El correo ya ha sido verificado.';
            return view('public.blog.resultado-verificacion', compact('message'));
        }

        $suscriptor->update([
            'timestamp_verificacion' => now(),
            'estado' => 1
        ]);

        $message = 'Correo verificado exitosamente.';

        return view('public.blog.resultado-verificacion', compact('message'));
    }

    public function darDeBajaSuscriptor(Request $request){
        // Extracción explícita del identificador bajo la convención RFC 8058 (One-Click POST)
        $validated = $request->validate([
            'correo' => 'required|email'
        ]);

        $suscriptor = Suscriptor::where('correo', $validated['correo'])->first();

        if (!$suscriptor) {
            return response()->json([
                'error' => 'Registro no encontrado en la base de datos.'
            ], 404);
        }

        // Mutación determinista del estado hacia INACTIVO
        $suscriptor->update(['estado' => 0]);

        return response()->json([
            'success' => true,
            'message' => 'Desuscripción procesada correctamente.'
        ], 200);
    }
}
