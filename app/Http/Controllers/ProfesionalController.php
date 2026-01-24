<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfesionalController extends Controller
{
    public function inicio(Request $request){
        return view('portafolio.home');
    }
}
