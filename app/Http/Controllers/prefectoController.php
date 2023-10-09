<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\GrupoHorario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //$horarios = DB::select('SELECT * FROM tabla WHERE columna = ?', ['valor']);
        $horarios = DB::select("SELECT m.clave_materia, g.clave_plan_estudios,nombre_materia, DATE_FORMAT(hora_inicio, '%H:%i') as hora_inicio, DATE_FORMAT(hora_fin, '%H:%i') as hora_fin, gh.aula, edificio, nombre, ap_paterno, ap_materno from grupos_horarios gh
        inner join grupos g on gh.clave_materia = g.clave_materia and gh.periodo = g.periodo and gh. clave_plan_estudios = g.clave_plan_estudios and gh.letra_grupo = g.letra_grupo
        inner join profesores p on g.docente = p.rfc
        inner join materias m on g.clave_materia = m.clave_materia and g.clave_plan_estudios = m.clave_plan_estudios
        inner join aulas a on gh.aula = a.aula
        where g.periodo = ? and dia_semana = ? and ? between hora_inicio and hora_fin order by gh.aula", ['23/2','2','14:14']);

        $edificios = DB:: select("select distinct  edificio from aulas order by edificio;");

        return view('prefectura.recorrido', compact('horarios','edificios'));
    }

    public function horarioEdificio(Request $request){

        $edificio = $request->input('edificio');

        //$horarios = DB::select('SELECT * FROM tabla WHERE columna = ?', ['valor']);
        $horarios = DB::select("SELECT m.clave_materia, g.clave_plan_estudios,nombre_materia, DATE_FORMAT(hora_inicio, '%H:%i') as hora_inicio, DATE_FORMAT(hora_fin, '%H:%i') as hora_fin, gh.aula, edificio, nombre, ap_paterno, ap_materno from grupos_horarios gh
        inner join grupos g on gh.clave_materia = g.clave_materia and gh.periodo = g.periodo and gh. clave_plan_estudios = g.clave_plan_estudios and gh.letra_grupo = g.letra_grupo
        inner join profesores p on g.docente = p.rfc
        inner join materias m on g.clave_materia = m.clave_materia and g.clave_plan_estudios = m.clave_plan_estudios
        inner join aulas a on gh.aula = a.aula
        where g.periodo = ? and dia_semana = ? and ? between hora_inicio and hora_fin and edificio = ? order by gh.aula" , ['23/2','2','14:14', $edificio] );

        //$edificios = DB:: select("select distinct  edificio from aulas order by edificio;");

        return view('layouts.tabla', compact('horarios'));
    }



    public function reportesDocente()
    {
        $nombre = Auth::user()->name;
        return view('prefectura.reportes');
    }
}
