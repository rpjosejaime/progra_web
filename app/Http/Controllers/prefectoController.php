<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class prefectoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function crudPrefecto()
    {
        $nombre = Auth::user()->name;
        return view('prefectura.prefectos');
    }

    public function asistenciaDocente()
    {
        $nombre = Auth::user()->name;
        return view('prefectura.recorrido');
    }

    public function reportesDocente()
    {
        $nombre = Auth::user()->name;
        return view('prefectura.reportes');
    }

}
