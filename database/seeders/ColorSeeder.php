<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Medida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Color::insert([
            ['nombre' => 'AZUL'],
            ['nombre' => 'ROJO'],
            ['nombre' => 'AMARILLO'],
            ['nombre' => 'VERDE'],
        ]);

        Medida::insert([
            ['nombre' => '1X20'],
            ['nombre' => '1X40'],
            ['nombre' => '1X40HC'],
            ['nombre' => 'AEREA'],
            ['nombre' => 'LCL'],
            ['nombre' => 'CARGA SUELTA'],
            ['nombre' => 'FLACK RACK'],
            ['nombre' => 'GRANEL'],
        ]);
    }
}
