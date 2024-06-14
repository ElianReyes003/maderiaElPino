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
        Schema::create('calle', function (Blueprint $table) {
            $table->id('pkCalle')->autoIncrement();
            $table->string('nombreCalle',90);
            $table->unsignedBigInteger("fkColonia");
            $table->foreign("fkColonia")->references("pkColonia")->on("colonia");
            $table->smallInteger("estatus");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calle');
    }
};
