<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Entrada;
use App\Models\Suscriptor;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificarSuscriptor;
use Illuminate\Support\Facades\Log;

class NotificarSuscriptoresJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public readonly int $entradaId;
    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->entradaId = $id;

        $entrada = Entrada::where('id', $this->entradaId)->first();
        
        if (!$entrada || $entrada->estado !== 2) {
            Log::warning("Abortando Job: La entrada {$this->entradaId} es inexistente o su estado difiere de 'Publicado'.");
            return;
        }
        Suscriptor::where('estado', 1)->chunk(100, function ($suscriptores) use ($entrada) {
            foreach ($suscriptores as $suscriptor) {
                Mail::to($suscriptor->correo)->send(
                    new NotificarSuscriptor($entrada->titulo, $entrada->slug, $entrada->extracto)
                );
            }
            
            sleep(1);
        });

        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
