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
        Schema::create('comprasCliente', function (Blueprint $table) {
            $table->id('pkcomprasCliente')->autoIncrement();
            $table->string('folioCompra', 20);
            $table->unsignedBigInteger('fkCliente');
            $table->foreign('fkCliente')->references('pkCliente')->on('cliente');
            $table->smallInteger('estatus');
            $table->date('fecha');
            $table->decimal('cantidadASaldar', 10, 2);
            $table->unsignedBigInteger('fkArticuloTipoVenta');
            $table->foreign('fkArticuloTipoVenta')->references('pkArticuloTipoVenta')->on('articuloTipoVenta');
            $table->smallInteger('estatusDeCobro');
            $table->unsignedBigInteger('fkEmpleado')->nullable();
            $table->foreign('fkEmpleado')->references('pkEmpleado')->on('empleado')->nullable();
            $table->integer('diasDeuda')->nullable();
            $table->integer('ordenReparto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprasCliente');
    }
};
