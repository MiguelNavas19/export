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
            $table->string('expediente');
            $table->string('consignatario');
            $table->string('bl');
            $table->string('tipo');
            $table->string('contenedor');
            $table->date('eta');
            $table->string('obs');
            $table->string('motonave');
            $table->string('cliente');
            $table->string('linea');
            $table->integer('envio');
            $table->integer('estatus');
            $table->boolean('liberacion')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {

        Schema::dropIfExists('exportacion');


    }
};
