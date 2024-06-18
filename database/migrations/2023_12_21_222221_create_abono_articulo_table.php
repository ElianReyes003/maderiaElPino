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
        Schema::create('abonoArticulo', function (Blueprint $table) {
            $table->id('abonoArticulo')->autoIncrement();
            $table->string('folioAbono', 20);
            $table->unsignedBigInteger('fkComprasCliente');
            $table->foreign("fkComprasCliente")->references("pkComprasCliente")->on("comprasCliente");
            $table->unsignedBigInteger('fkConcepto');
            $table->foreign('fkConcepto')->references('pkConcepto')->on('concepto');
            $table->unsignedBigInteger('fkEmpleado');
            $table->foreign("fkEmpleado")->references("pkEmpleado")->on("empleado");
            $table->smallInteger("estatus");
            $table->dateTime("fecha");
            $table->decimal('abono',10,2);
            $table->decimal('Saldo',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonoArticulo');
    }
};
