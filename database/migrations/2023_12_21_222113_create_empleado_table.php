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
        Schema::create('empleado', function (Blueprint $table) {
            $table->id('pkEmpleado')->autoIncrement();
            $table->string('nombreEmpleado',90);
            $table->unsignedBigInteger("fkColonia");
            $table->foreign("fkColonia")->references("pkColonia")->on("colonia");
            $table->string('calle',200);
            $table->string('numCasa',20);
            $table->string('telefono',20);
            $table->string('nombreUsuario',45);
            $table->string('contraseña',45);
            $table->unsignedBigInteger('fkTipoUsuario');
            $table->foreign("fkTipoUsuario")->references("pkTipoUsuario")->on("tipoUsuario");
            $table->smallInteger("estatus");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado');
    }
};
