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



    public function exportarcierre()
    {

            if($this->desde <= $this->hasta){
                return Excel::download(new ExportCerrados($this->desde,$this->hasta), 'datacerrados.xlsx');
            }


    }


    #[On('infocerrado')]
    public function nuevocliente()
    {

        $this->reset(['desde','hasta']);

        $this->modal = true;
    }


    public function render()
    {
        return view('livewire.cierre');
    }
}
