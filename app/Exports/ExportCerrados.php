<?php

namespace App\Exports;

use App\Models\exportacion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportCerrados implements FromView
{

    public $desde;
    public $hasta;
    public $valor = 1;

    public function __construct($desde, $hasta, $valor)
    {
        $this->desde = $desde;
        $this->hasta = $hasta;
        $this->valor = $valor;
    }

    public function view(): View
    {

        if ($this->valor == 1) {

            $vista = "export.exportinfo";
            $consulta = exportacion::query()
                ->where('estatus', 3)
                ->whereBetween('eta', [$this->desde, $this->hasta])
                ->orderBy('eta')
                ->orderBy('motonave')
                ->orderBy('cliente')
                ->orderBy('consignatario')
                ->get();
        }

        if ($this->valor == 2) {
            $vista = "export.exportreconocimiento";
            $consulta = exportacion::query()
                ->where('estatus', 6)
                ->whereBetween('fecha_registro', [$this->desde, $this->hasta])
                ->orderBy('eta')
                ->orderBy('motonave')
                ->orderBy('cliente')
                ->orderBy('consignatario')
                ->get();
        }

        return view($vista, [
            'exportacion' => $consulta
        ]);
    }
}
