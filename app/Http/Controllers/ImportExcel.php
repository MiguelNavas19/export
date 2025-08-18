<?php

namespace App\Http\Controllers;

use App\Imports\ExportacionImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcel extends Controller
{

    public function preview(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);

        $import = new ExportacionImport(previewMode: true);
        Excel::import($import, $request->file('file'));

        return response()->json([
            'results' => $import->results,
            'summary' => [
                'total' => count($import->results),
                'valid' => $import->created,
                'errors' => $import->errors
            ]
        ]);
    }



    public function imports(Request $request)
    {

        try {
            // Supongamos que $import es el resultado de la importación
            $request->validate(['file' => 'required|mimes:xlsx,xls']);

            $import = new ExportacionImport(previewMode: false);
            Excel::import($import, $request->file('file'));
            $mensaje = "Registros cargados con exito " . $import->created . " <br> no se cargaron " . $import->errors . " registros";
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
