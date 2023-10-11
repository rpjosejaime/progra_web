<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Grupo;
use App\Models\GrupoAsistencia;
use App\Models\GrupoHorario;
use App\Models\Organigrama;
use App\Models\Profesor;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$nombre = Auth::user()->name;
        return view('home');
    }


    public function test()
    {
        //$variable = Organigrama::all();
        //$variable = Profesor::all();
        //$variable = Grupo::all();
        $grupos = Grupo::paginate();
        //$variable = GrupoAsistencia::all();

        //return $variable;
        $dia_semana = date("w") + 1;
        date_default_timezone_set("America/Chihuahua");
        $hora_actual = date("H:i");

        return $dia_semana;

        return view('test', compact('grupos'));
    }

}
