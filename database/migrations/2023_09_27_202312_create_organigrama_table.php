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
        Schema::create('organigrama', function (Blueprint $table) {
            $table->char('clave_area', 6)->primary();
            $table->string('descripcion_area', 200)->nullable();
            $table->char('area_depende', 6)->nullable();
            $table->char('nivel')->nullable();
            $table->char('tipo_area')->nullable();
            $table->char('p_sustantivos', 20)->nullable();
            $table->char('pro_sus', 20)->nullable();
            $table->char('p_sus', 20)->nullable();
            $table->char('p_s', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organigrama');
    }
};
