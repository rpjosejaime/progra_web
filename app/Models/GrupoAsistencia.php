<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoAsistencia extends Model
{
    public $table = 'grupos_asistencias';
    public $timestamps = false;
    protected $primaryKey = ['clave_materia', 'clave_plan_estudios', 'periodo', 'letra_grupo', 'dia_semana'];
    public $incrementing = false;
    protected $fillable = [
        'clave_materia',
        'clave_plan_de_estudios',
        'periodo', 'letra_grupo',
        'dia_semana', 'asistencia',
        'fecha_hora', 'observacion',
        'RFC_prefecto'
    ];

    //protected $primaryKey = ['clave_materia', 'clave_plan_de_estudios', 'periodo', 'letra_grupo', 'dia_semana'];
}
