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
        Schema::table('exportacion', function (Blueprint $table) {
            $table->decimal('base', 64, 2)->default(0.00);
            $table->text('almacen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exportacion', function (Blueprint $table) {
            $table->dropColumn([
                'base',
                'almacen'
            ]);
        });
    }
};
