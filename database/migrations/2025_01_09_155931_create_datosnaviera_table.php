<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('datosnaviera', function (Blueprint $table) {
            $table->id(); // id primary key autoincrementable
            $table->unsignedBigInteger('id_naviera'); // id_naviera como foreign key
            $table->string('email', 255)->unique(); // email, debe ser único
            $table->boolean('estatus')->default(true); // estatus, por defecto true

            // Definir la relación con navieras
            $table->foreign('id_naviera')->references('id')->on('navieras')->onDelete('cascade');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datosnaviera');
    }
};
