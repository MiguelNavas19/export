<?php

namespace App\Exports;

use App\Models\exportacion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportInfo implements FromView
{

    public $id;

    public function __construct($id) {
        $this->id = $id;
    }

    public function view(): View
    {

        return view('export.exportinfo',[
            'exportacion' => exportacion::whereIn('id', $this->id)->get()
        ]);
    }



}
