<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;

class PublicBlogController extends Controller
{
    public function index(Request $request){
        $entradas = Entrada::where('scope', 'Personal')->where('estado', 2)->get();

        return view('public.blog.index', compact('entradas'));
    }

    public function mostrarEntrada(Request $request, $slug){
        $entrada = Entrada::where('slug', $slug)
                          ->where('estado', 2)
                          ->firstOrFail();

        return view('public.blog.entrada', compact('entrada'));
    }
}
