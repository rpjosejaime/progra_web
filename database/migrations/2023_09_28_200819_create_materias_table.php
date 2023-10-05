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
        Schema::create('materias', function (Blueprint $table) {
            //test$table->id();
            $table->string('clave_materia', 10);
            $table->string('clave_plan_estudios', 25);
            $table->string('nombre_materia', 100);
            $table->integer('semestre_materia')->nullable();
            $table->char('clave_area', 6);

            // Definir la clave primaria compuesta
            $table->primary(['clave_materia', 'clave_plan_estudios']);

            $table->foreign('clave_plan_estudios')
                  ->references('clave_plan_estudios')
                  ->on('carreras')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};
