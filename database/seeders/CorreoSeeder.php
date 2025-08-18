<?php

namespace Database\Seeders;

use App\Models\DatosNaviera;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CorreoSeeder extends Seeder
{

    public function run(): void
    {
        DatosNaviera::insert([
            ['id_naviera' => 1, 'email' => 'ven.service@cma-cgm.com'],
            ['id_naviera' => 4, 'email' => 've.import@maersk.com'],
            ['id_naviera' => 2, 'email' => 'venezuelainfo@hlag.com'],
            ['id_naviera' => 8, 'email' => 'dlmarventraficocaracas@seaboardmarine.com'],
            ['id_naviera' => 8, 'email' => 'mirian.gonzalez@conaven.com'],
            ['id_naviera' => 10, 'email' => 'cszv@zim.com']
        ]);
    }
}
