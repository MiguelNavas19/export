<?php

namespace App\Imports;

use App\Models\exportacion;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class ExportacionImport implements ToCollection
{

    public function collection(Collection $row)
    {

        $i = 0;
        $c = 0;
        $e = 0;
        foreach ($row as $rows) {
            if ($i > 0) {

                $fecha = $rows[5];

                // Asegúrate de que $fecha sea una instancia de Carbon
                if ($fecha instanceof Carbon) {
                    $fecha = $fecha->format('Y-m-d');
                } else {
                    // Si no es una instancia de Carbon, puedes convertirla
                    $fecha = Carbon::parse($fecha)->format('Y-m-d');
                }


                if (is_numeric($rows[5])) {
                    $fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($rows[5]));
                    $fecha = $fecha->format('Y-m-d');
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
                        ]);
                        $c++;
                    }


                }



            }

            $i++;
        }
    }
}
