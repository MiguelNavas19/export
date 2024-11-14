<?php

namespace App\Imports;

use App\Models\exportacion;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class ExportacionImport implements ToCollection
{

    public $c;
    public $e;

    public function collection(Collection $row)
    {

        $i = 0;
        $c = 0;
        $e = 0;
        foreach ($row as $rows) {
            if ($i > 0) {

                $fecha = $rows[5];

                if (isset($fecha) && $fecha !== '') {
                    // Verificar si $fecha es una instancia de Carbon
                    if (!$fecha instanceof Carbon) {
                        // Convertir a Carbon si no lo es
                        $fecha = Carbon::parse($fecha);
                    }

                    // Formatear la fecha a 'Y-m-d'
                    $fecha = $fecha->format('Y-m-d');

                    // Verificar si el valor en $rows[5] es numérico y convertirlo a fecha
                    if (is_numeric($rows[5])) {
                        $fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($rows[5]));
                        $fecha = $fecha->format('Y-m-d');
                    }
                }


                if (isset($rows[1], $rows[2], $rows[8]) && $rows[1] !== '' && $rows[2] !== '' && $rows[8] !== '') {

                    $consulta = exportacion::where('consignatario',$rows[1])->where('bl',$rows[2])
                    ->where('cliente',$rows[8])->get();

                    if (count($consulta) == 0) {
                        exportacion::create([
                            "expediente" => $rows[0],
                            "consignatario" => $rows[1],
                            "bl" => $rows[2],
                            "tipo" => $rows[3],
                            "contenedor" => $rows[4],
                            "eta" => $fecha,
                            "obs" => $rows[6],
                            "motonave" => $rows[7],
                            "cliente" => $rows[8],
                            "linea" => $rows[9],
                            "envio" => $rows[10],
                            "estatus" => $rows[11],
                             "liberacion" => $rows[12],
                        ]);
                        $c++;
                    }else{
                        $e++;
                    }


                }else{
                    $e++;
                }



            }

            $i++;
        }

        $this->c = $c;
        $this->e = $e;
    }
}
