<?php

namespace App\Livewire;

use App\Models\exportacion;
use Livewire\Component;
use Livewire\Attributes\On;

class Info extends Component
{

    public $opensave = false;
    public $motonave = '';

    #[On('editar')]
    public function editar($id)
    {

        $this->opensave = true;
        $query = exportacion::where('estatus', '!=', 3)->where('id',$id)->first();
        $this->motonave = $query->motonave;
    }

    public function render()
    {
        return view('livewire.info');
    }
}
