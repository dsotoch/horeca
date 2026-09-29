<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PostulacionController extends Controller
{
    public function index(Request $request){
        $postulaciones=collect();
        $usuario=$request->user();
        return view("postulaciones.index-postulacion-profesional",compact('postulaciones','usuario'));
    }
}
