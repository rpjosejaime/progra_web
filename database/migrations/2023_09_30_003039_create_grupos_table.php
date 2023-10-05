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
        Schema::create('grupos', function (Blueprint $table) {
            $table->string('clave_materia', 10);
            $table->string('clave_plan_estudios', 25);
            $table->char('periodo', 7);
            $table->char('letra_grupo', 3);
            $table->integer('capacidad');
            $table->integer('num_inscritos');
            $table->integer('num_inscritos_compartidos');
            $table->string('es_compartido')->nullable();
            $table->string('docente', 13);


            // Definir la clave primaria compuesta
            $table->primary(['clave_materia', 'clave_plan_estudios', 'periodo', 'letra_grupo']);

            $table->foreign('clave_plan_estudios')
                ->references('clave_plan_estudios')
                ->on('carreras')
                ->onDelete('restrict');

            $table->foreign('clave_materia')
                ->references('clave_materia')
                ->on('materias')
                ->onDelete('restrict');

            $table->foreign('docente')
                ->references('rfc')
                ->on('profesores')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
