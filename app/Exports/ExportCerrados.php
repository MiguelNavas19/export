<?php

namespace App\Exports;

use App\Models\exportacion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportCerrados implements FromView
{

    public $desde;
    public $hasta;

    public function __construct($desde,$hasta) {
        $this->desde = $desde;
        $this->hasta = $hasta;
    }

    public function view(): View
    {
            return view('export.exportinfo',[
                'exportacion' => exportacion::where('estatus',3)->whereDate('eta', '>=', $this->desde)->whereDate('eta', '<=', $this->hasta)->orderby('eta','ASC')->orderby('motonave','ASC')->orderby('cliente','ASC')->orderby('consignatario', 'ASC')->get()
            ]);
    }
}
