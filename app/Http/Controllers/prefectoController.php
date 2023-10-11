<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\GrupoHorario;
use App\Models\GrupoAsistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Generator\StringManipulation\Pass\Pass;
use PhpParser\Node\Stmt\Return_;

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

    public function getHora()
    {
        date_default_timezone_set("America/Mexico_City");
        $hora_actual = date("H:i");
        return $hora_actual;
    }

    public function asistenciaDocente()
    {
        date_default_timezone_set("America/Chihuahua");
        $hora_actual = date("H:i");
        $dia_semana = date("w") + 1;

        //$horarios = DB::select('SELECT * FROM tabla WHERE columna = ?', ['valor']);
        $horarios = DB::select("SELECT m.clave_materia, g.clave_plan_estudios, g.periodo, nombre_materia, DATE_FORMAT(hora_inicio, '%H:%i') as hora_inicio, DATE_FORMAT(hora_fin, '%H:%i') as hora_fin,
        gh.aula, gh.letra_grupo, edificio, rfc, nombre, ap_paterno, ap_materno from grupos_horarios gh
        inner join grupos g on gh.clave_materia = g.clave_materia and gh.periodo = g.periodo and gh. clave_plan_estudios = g.clave_plan_estudios and gh.letra_grupo = g.letra_grupo
        inner join profesores p on g.docente = p.rfc
        inner join materias m on g.clave_materia = m.clave_materia and g.clave_plan_estudios = m.clave_plan_estudios
        inner join aulas a on gh.aula = a.aula
        where g.periodo = ? and dia_semana = ? and ? between hora_inicio and hora_fin order by gh.aula", ['23/2', 8, $hora_actual]);

        $edificios = DB::select("select distinct  edificio from aulas order by edificio;");

        return view('prefectura.recorrido', compact('horarios', 'edificios'));
    }

    public function horarioEdificio(Request $request)
    {
        date_default_timezone_set("America/Chihuahua");
        $hora_actual = date("H:i");
        $edificio = $request->input('edificio');
        $dia_semana = date("w") + 1;

        //$horarios = DB::select('SELECT * FROM tabla WHERE columna = ?', ['valor']);
        $horarios = DB::select("SELECT m.clave_materia, g.clave_plan_estudios, g.periodo, nombre_materia, DATE_FORMAT(hora_inicio, '%H:%i') as hora_inicio, DATE_FORMAT(hora_fin, '%H:%i') as hora_fin,
        gh.aula, gh.letra_grupo, edificio, rfc, nombre, ap_paterno, ap_materno, asistencia from grupos_horarios gh
        inner join grupos g on gh.clave_materia = g.clave_materia and gh.periodo = g.periodo and gh. clave_plan_estudios = g.clave_plan_estudios and gh.letra_grupo = g.letra_grupo
        inner join profesores p on g.docente = p.rfc
        inner join materias m on g.clave_materia = m.clave_materia and g.clave_plan_estudios = m.clave_plan_estudios
        inner join aulas a on gh.aula = a.aula
        left join grupos_asistencias ga on m.clave_materia = ga.clave_materia and gh.periodo = ga.periodo and gh.clave_plan_estudios = ga.clave_plan_estudios and ga.dia_semana = gh.dia_semana and ga.letra_grupo = gh.letra_grupo
        where g.periodo = ? and gh.dia_semana = ? and ? between hora_inicio and hora_fin and edificio = ? order by asistencia ASC, gh.aula", ['23/2', $dia_semana, $hora_actual, $edificio]);

        //$edificios = DB:: select("select distinct  edificio from aulas order by edificio;");

        return view('layouts.tabla', compact('horarios'));
    }

    public function guardarAsistencia(Request $request)
    {
        $data = $request->all();
        $rfcPrefecto = Auth::user()->RFC;

        date_default_timezone_set("America/Chihuahua");
        $fechaHoraActual = date('Y-m-d H:i');
        $dia_semana = date("w") + 1;

        // Itera a través de los datos y guárdalos en la base de datos
        $horariosJson = $request->input('horarios'); // Nombre del campo que contiene los datos de la tabla
        $asistencias = $request->input('asistencia'); // Obtén los valores del campo select

        $horarios = json_decode($horariosJson, true);
        $cambio = false;

        foreach ($horarios as $index => $horarioData) {

            // Consulta para verificar si ya existe un registro con los mismos valores
            $existente = GrupoAsistencia::where('clave_materia', $horarioData['clave_materia'])
                ->where('clave_plan_estudios', $horarioData['clave_plan_estudios'])
                ->where('periodo', $horarioData['periodo'])
                ->where('letra_grupo', $horarioData['letra_grupo'])
                ->where('dia_semana', $dia_semana)
                ->first();

            //return response()->json($existente);

            if (!$existente) {
                // Aquí debes guardar cada fila de la tabla en tu base de datos
                // Crea una instancia de TuModelo y asigna los valores correspondientes
                $horario = new GrupoAsistencia();
                $horario->clave_materia = $horarioData['clave_materia'];
                $horario->clave_plan_estudios = $horarioData['clave_plan_estudios'];
                $horario->periodo = $horarioData['periodo'];
                $horario->letra_grupo = $horarioData['letra_grupo'];
                $horario->dia_semana = $dia_semana;
                $horario->fecha_hora = $fechaHoraActual;
                $horario->asistencia = $asistencias[$index];
                //$horario->observacion = 'TEST';
                $horario->RFC_prefecto = $rfcPrefecto;

                $horario->save(); // Guarda el registro en la base de datos
                $cambio = true;
            }

            if ($existente) {
                if ($existente->asistencia !== $asistencias[$index]) {

                    /*return [
                        'clave_materia' => $horarioData['clave_materia'],
                        'grupo' => $horarioData['letra_grupo'],
                        'asistencia' => $existente->asistencia,
                        'formulario' => $asistencias[$index]
                    ];*/
                    //$existente->update(['asistencia' => $asistencias[$index]]);
                    //$existente->update(['fecha_hora' => $fechaHoraActual]);

                    DB::statement("UPDATE grupos_asistencias SET asistencia = ?, fecha_hora = ? WHERE  clave_materia=?
                    AND clave_plan_estudios=? AND periodo=? AND letra_grupo=? AND dia_semana=?",
                    [$asistencias[$index], $fechaHoraActual, $horarioData['clave_materia'], $horarioData['clave_plan_estudios'], $horarioData['periodo'],
                    $horarioData['letra_grupo'], $dia_semana]);

                    $cambio = true;
                }
            }
        }

        //return redirect()->route('home'); // Redirige a la página de origen o a donde desees
        if ($cambio) {
            return back()->with('success', 'Asistencia Guardada Correctamente');
        } else {
            return back();
        }
    }



    public function reportesDocente()
    {
        $nombre = Auth::user()->name;
        return view('prefectura.reportes');
    }
}
