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
        Schema::create('articuloTipoVenta', function (Blueprint $table) {
            
            
            $table->id('pkArticuloTipoVenta')->autoIncrement();
            $table->unsignedBigInteger('fkTipoVenta');
            $table->unsignedBigInteger('fkArticulo');
            $table->foreign("fkTipoVenta")->references("pkTipoVenta")->on("tipoVenta");
            $table->foreign("fkArticulo")->references("pkArticulo")->on("articulo");
            $table->decimal('cantidadTipoVenta',10,2);
            $table->decimal('enganche',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articuloTipoVenta');
    }
};
