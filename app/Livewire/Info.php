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
    public $enviomodal = 0;
    public $estatusmodal = 0;

    public $qenvio;
    public $qestatus;
    public $idex;

    public $masivo = false;
    public $motonavemas = '';
    public $etamas = '';


    #[On('editar')]
    public function editar($id)
    {
        $this->masivo = false;
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
        $this->enviomodal = $query->envio;
        $this->estatusmodal = $query->estatus;


        $this->idex = $id;

        $this->qenvio = Tipo::orderByRaw("id = ? DESC", [$this->enviomodal])->get();


        $this->qestatus = Estatus::orderByRaw("id = ? DESC", [$this->estatusmodal])
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
                'envio' => $this->enviomodal,
                'estatus' => $this->estatusmodal,
            ]);


            $this->opensave = false;
                DB::commit();

           $this->dispatch('datosActualizados');

        } catch (Exception $e) {
            DB::rollBack();
           // $this->dispatch('alert', 'error',  'Error', $e->getMessage());
        }
    }

    #[On('cambio')]
    public function cambioestatus($valor, $id, $tipo)
    {

        if ($tipo == 'envio') {
            Exportacion::where('id', $id)->update([
                'envio' => $valor
            ]);
        } elseif ($tipo == 'estatus') {
            Exportacion::where('id', $id)->update([
                'estatus' => $valor
            ]);
        } elseif ($tipo == 'liberacion') {
            Exportacion::where('id', $id)->update([
                'liberacion' => $valor
            ]);
        }
    }



    #[On('editarmasivamente')]
    public function editarmasivamente($id)
    {

        $this->opensave = true;
        $this->masivo = true;
        $query = exportacion::where('estatus', '!=', 3)->wherein('id',$id)->first();
        $this->motonavemas = $query->motonave;
        $this->etamas = $query->eta;

        $this->idex = $id;


    }


    public function actualizardatosmasivos()
    {
        //$this->validate();
        DB::beginTransaction();
        try {

exportacion::wherein('id',$this->idex)->update([
                'motonave' =>  $this->motonavemas,
                'eta' => $this->etamas,
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
