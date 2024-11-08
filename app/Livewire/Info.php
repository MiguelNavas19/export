<?php

namespace App\Livewire;

use App\Models\Estatus;
use App\Models\exportacion;
use App\Models\Tipo;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Exception;

class Info extends Component
{

    public $opensave = false;
    public $motonave = '';
    public $expediente = '';
    public $consignatario = '';
    public $bl = '';
    public $tipo = '';
    public $contenedor = '';
    public $eta = '';
    public $obs = '';
    public $cliente = '';
    public $linea = '';
    public $envio = '';
    public $estatus = '';

    public $qenvio;
    public $qestatus;
    public $idex;


    #[On('editar')]
    public function editar($id)
    {

        $this->opensave = true;
        $query = exportacion::where('estatus', '!=', 3)->where('id',$id)->first();
        $this->motonave = $query->motonave;
        $this->expediente = $query->expediente;
        $this->consignatario = $query->consignatario;
        $this->bl = $query->bl;
        $this->tipo = $query->tipo;
        $this->contenedor = $query->contenedor;
        $this->eta = $query->eta;
        $this->obs = $query->obs;
        $this->cliente = $query->cliente;
        $this->linea = $query->linea;
        $this->envio = $query->envio;
        $this->estatus = $query->estatus;


        $this->idex = $id;

        $this->qenvio = Tipo::orderByRaw("id = ? DESC", [$query->envio])->get();


        $this->qestatus = Estatus::orderByRaw("id = ? DESC", [$query->estatus])
        ->get();

    }


    public function actualizardatos()
    {
        //$this->validate();
        DB::beginTransaction();
        try {

exportacion::where('id',$this->idex)->update([
                'motonave' =>  $this->motonave,
                'expediente' => $this->expediente,
                'consignatario' => $this->consignatario,
                'bl' => $this->bl,
                'tipo' => $this->tipo,
                'contenedor' => $this->contenedor,
                'eta' => $this->eta,
                'obs' => $this->obs,
                'cliente' => $this->cliente,
                'linea' => $this->linea,
                'envio' => $this->envio,
                'estatus' => $this->estatus,
            ]);


            $this->opensave = false;
                DB::commit();

           $this->dispatch('datosActualizados');

        } catch (Exception $e) {
            DB::rollBack();
           // $this->dispatch('alert', 'error',  'Error', $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.info');
    }
}
