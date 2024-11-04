<?php

namespace App\Http\Controllers;

use App\Imports\ExportacionImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcel extends Controller
{
    public function imports(Request $request){


    Excel::import(new ExportacionImport, $request->file('file'));

    }
}
