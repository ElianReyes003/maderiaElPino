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
        Schema::create('articulo', function (Blueprint $table) {
            $table->id('pkArticulo')->autoIncrement();
            $table->string('nombreArticulo',80);
            $table->unsignedBigInteger('fkCategoriaArticulo');
            $table->foreign("fkCategoriaArticulo")->references("pkCategoriaArticulo")->on("categoriaArticulo");
            $table->integer('cantidadMinima');
            $table->integer('cantidadActual');
            $table->decimal('abonoOchoDias',10,2);
            $table->decimal('abonoQuinceDias',10,2);
            $table->decimal('abonoTreintaDias',10,2);
            $table->text('imagenArticulo')->nullable();
            $table->smallInteger('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulo');
    }
};
