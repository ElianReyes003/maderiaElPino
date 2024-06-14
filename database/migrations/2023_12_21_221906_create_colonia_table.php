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
        Schema::create('colonia', function (Blueprint $table) {
            $table->id('pkColonia')->autoIncrement();
            $table->string('nombreColonia',45);
            $table->unsignedBigInteger("fkMunicipio");
            $table->foreign("fkMunicipio")->references("pkMunicipio")->on("municipio");
            $table->smallInteger("estatus");
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colonia');
    }
};
