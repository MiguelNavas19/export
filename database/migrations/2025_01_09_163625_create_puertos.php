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
        Schema::create('puertos', function (Blueprint $table) {
            $table->id(); // id primary key autoincrementable
            $table->text('nombre')->unique(); // nombre, debe ser único
            $table->boolean('estatus')->default(true); // estatus, por defecto true
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puertos');
    }
};
