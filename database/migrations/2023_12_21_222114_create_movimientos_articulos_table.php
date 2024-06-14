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
        Schema::create('movimientosArticulos', function (Blueprint $table) {
            $table->id('pkMovimientosArticulos')->autoIncrement();
            $table->unsignedBigInteger('fkArticulo');
            $table->unsignedBigInteger('fkTipoMovimiento');
            $table->integer('cantidad')->nullable();
            $table->date('fecha');
            $table->unsignedBigInteger('fkEmpleado');
            $table->foreign("fkEmpleado")->references("pkEmpleado")->on("empleado");
            $table->foreign("fkArticulo")->references("pkArticulo")->on("articulo");
            $table->foreign("fkTipoMovimiento")->references("pkTipoMovimiento")->on("tipoMovimiento");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos_articulos');
    }
};
