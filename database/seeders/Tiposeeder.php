<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estatus;
use App\Models\Tipo;

class Tiposeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipo::create([
            'nombre' => 'AEREO'
        ]);
        
         Tipo::create([
            'nombre' => 'MARITIMO'
        ]);
        
           Estatus::create([
            'nombre' => 'POR ARRIBAR'
        ]);
        
         Estatus::create([
            'nombre' => 'EN VALORACION Y RESAGADO'
        ]);
        
         Estatus::create([
            'nombre' => 'CERRADO'
        ]);
    }
}
