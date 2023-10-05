<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grupos_horarios', function (Blueprint $table) {
            $table->string('clave_materia', 10);
            $table->string('clave_plan_estudios', 25);
            $table->char('periodo', 7);
            $table->char('letra_grupo', 3);
            $table->tinyInteger('dia_semana');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->char('aula', 3);
            /*$table->string('lunes_horario')->nullable();
            $table->string('lunes_salon')->nullable();
            $table->string('martes_horario')->nullable();
            $table->string('martes_salon')->nullable();
            $table->string('miercoles_horario')->nullable();
            $table->string('miercoles_salon')->nullable();
            $table->string('jueves_horario')->nullable();
            $table->string('jueves_salon')->nullable();
            $table->string('viernes_horario')->nullable();
            $table->string('viernes_salon')->nullable();
            $table->string('sabado_horario')->nullable();
            $table->string('sabado_salon')->nullable();*/


            // Definir la clave primaria compuesta
            $table->primary(['clave_materia', 'clave_plan_estudios', 'periodo', 'letra_grupo', 'dia_semana']);

            $table->foreign('clave_plan_estudios')
                ->references('clave_plan_estudios')
                ->on('carreras')
                ->onDelete('restrict');

            $table->foreign('clave_materia')
                ->references('clave_materia')
                ->on('materias')
                ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos_horarios');
    }
};
