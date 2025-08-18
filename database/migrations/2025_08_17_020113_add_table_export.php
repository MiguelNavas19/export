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
            //$table->date('fecha_veconinter')->nullable();
            $table->date('fecha_despacho')->nullable();
            $table->date('fecha_devolucion')->nullable();
            $table->date('fecha_arribo')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->date('fecha_impuesto')->nullable();
            $table->date('fecha_presentacion')->nullable();
            $table->date('fecha_reconocimiento')->nullable();
            $table->date('fecha_validacion')->nullable();
            $table->date('fecha_factura')->nullable();
            $table->date('dias_libres')->nullable();
            $table->text('factura')->nullable();
            $table->enum('poder', [1, 2])->default(1);
            $table->text('cantidad_equipos')->nullable();
            $table->text('funcionario')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('peso')->nullable();
            $table->text('dua')->nullable();
            $table->enum('autorizado', [1, 2])->default(1);
            $table->integer('color')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exportacion', function (Blueprint $table) {
            $table->dropColumn([
                'fecha_factura',
                'fecha_validacion',
                'fecha_reconocimiento',
                'fecha_presentacion',
                'fecha_impuesto',
                'fecha_registro',
                'fecha_arribo',
                'fecha_veconinter',
                'fecha_despacho',
                'fecha_devolucion',
                'dua',
                'dias_libres',
                'factura',
                'poder',
                'cantidad_equipos',
                'funcionario',
                'descripcion',
                'peso',
                'autorizado',
                'color'
            ]);
        });
    }
};
