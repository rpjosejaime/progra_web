<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GrupoHorario;
use App\Models\GrupoAsistencia;
use App\Models\User;
use App\Models\Profesor;
use App\Models\Organigrama;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $areas = DB::select("select distinct m.clave_area, descripcion_area from organigrama o
        inner join materias m on o.clave_area = m.clave_area
        order by descripcion_area;");

        return view('prefectura.reportes.listado', compact('areas'));
    }


    public function listadoDocente(Request $request) {
        $claveArea = $request->input('clave_area');
        $datos = '';// Lógica para obtener datos de la base de datos según $claveArea

        return view('prefectura.reportes.tabla', compact('docente'));
    }

}
