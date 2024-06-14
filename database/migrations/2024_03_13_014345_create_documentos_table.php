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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id('pkDocumentos');
            $table->unsignedBigInteger('fkCliente');
            $table->foreign('fkCliente')->references('pkCliente')->on('cliente')->onDelete('cascade');
            $table->string('nombre');
            $table->string('ruta'); // Puedes almacenar la ruta donde se guarda el documento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
