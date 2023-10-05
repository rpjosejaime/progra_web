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
        Schema::create('grupos_asistencias', function (Blueprint $table) {
            $table->string('clave_materia', 10);
            $table->string('clave_plan_estudios', 25);
            $table->char('periodo', 7);
            $table->char('letra_grupo', 3);
            $table->tinyInteger('dia_semana');
            $table->datetime('fecha_hora');
            $table->string('asistencia');
            $table->string('observacion') -> nullable();
            $table->string('RFC_prefecto');


            $table->primary(['clave_materia', 'clave_plan_estudios', 'periodo', 'letra_grupo', 'dia_semana']);

            $table->foreign('clave_plan_estudios')
                ->references('clave_plan_estudios')
                ->on('carreras')
                ->onDelete('restrict');

            $table->foreign('clave_materia')
                ->references('clave_materia')
                ->on('materias')
                ->onDelete('restrict');

            $table->foreign('RFC_prefecto')
                ->references('RFC')
                ->on('users')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos_asistencias');
    }
};
