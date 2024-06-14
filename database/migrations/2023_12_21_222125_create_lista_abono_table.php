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
        Schema::create('listaAbono', function (Blueprint $table) {
            $table->id('pkListaAbono')->autoIncrement();
            $table->unsignedBigInteger("fkArticulo");
            $table->foreign("fkArticulo")->references("pkArticulo")->on("articulo");
            $table->unsignedBigInteger("fkEmpleado");
            $table->foreign("fkEmpleado")->references("pkEmpleado")->on("empleado");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_abono');
    }
};
