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
        Schema::create('cambiosarticulos', function (Blueprint $table) {
            $table->id('pkCambiosArticulos');
            $table->unsignedBigInteger('fkMovimientosArticulos');
            $table->foreign('fkMovimientosArticulos')->references('pkMovimientosArticulos')->on('movimientosarticulos');
            $table->integer('cantidad');
            $table->unsignedBigInteger('fkArticulo');
            $table->foreign('fkArticulo')->references('pkArticulo')->on('articulo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cambios_articulos');
    }
};
