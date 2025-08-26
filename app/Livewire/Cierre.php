<?php

namespace App\Livewire;

use App\Exports\ExportCerrados;
use Livewire\Component;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;

class Cierre extends Component
{

    public $modal = false;
    public $desde;
    public $hasta;
    public $titulo = 'Exportar Informacion Cerrados';
    public $valor = 1;

    public function exportarcierre()
    {

        if ($this->desde <= $this->hasta) {

            if ($this->valor == 1) {
                return Excel::download(new ExportCerrados($this->desde, $this->hasta, $this->valor), 'datacerrados.xlsx');
            }

            if ($this->valor == 2) {
                return Excel::download(new ExportCerrados($this->desde, $this->hasta, $this->valor), 'reconocimiento.xlsx');
            }
        }
    }


    #[On('infocerrado')]
    public function nuevocliente()
    {

        $this->reset(['desde', 'hasta']);
        $this->valor = 1;
        $this->modal = true;
    }


    #[On('reconocimiento')]
    public function reconocimiento()
    {

        $this->reset(['desde', 'hasta']);
        $this->titulo = 'Reporte Reconocimiento';
        $this->valor = 2;
        $this->modal = true;
    }


    public function render()
    {
        return view('livewire.cierre');
    }
}
