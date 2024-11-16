<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('exportacion', function (Blueprint $table) {
            $table->id();
            $table->string('expediente')->nullable();
            $table->string('consignatario');
            $table->string('bl');
            $table->string('tipo')->nullable();
            $table->string('contenedor')->nullable();
            $table->date('eta')->nullable();
            $table->string('obs')->nullable();
            $table->string('motonave')->nullable();
            $table->string('cliente');
            $table->string('renuncia')->nullable();
            $table->string('linea')->nullable();
            $table->integer('envio')->default(0)->nullable();
            $table->integer('estatus')->default(0)->nullable();
            $table->boolean('liberacion')->default(false)->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {

        Schema::dropIfExists('exportacion');


    }
};
