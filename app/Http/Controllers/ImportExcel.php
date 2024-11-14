<?php

namespace App\Http\Controllers;

use App\Imports\ExportacionImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcel extends Controller
{
    public function imports(Request $request){

        try {
            // Supongamos que $import es el resultado de la importación
            $import = new ExportacionImport;
            Excel::import($import, $request->file('excel'));
            $mensaje = "Registros cargados con exito ".$import->c." <br> no se cargaron ".$import->e." registros";
            return response()->json([
                'success' => true,
                'message' => $mensaje, // Mensaje que quieres mostrar en la alerta
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al subir el archivo: ' . $e->getMessage()
            ], 500);
        }



    }
}
