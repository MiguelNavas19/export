<?php

namespace App\Livewire;

use App\Models\Estatus;
use App\Models\exportacion;
use App\Models\Tipo;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;

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
    public $liberacion = 0;
    public $qenvio;
    public $qestatus;
    public $idex;

    public $masivo = false;
    public $nuevocliente = false;
    public $motonavemas = '';
    public $etamas = '';


    #[On('editar')]
    public function editar($id)
    {
        $this->masivo = false;
        $this->nuevocliente = false;
        $this->opensave = true;
        $query = exportacion::where('estatus', '!=', 3)->where('id', $id)->first();
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
        $this->liberacion = $query->liberacion;


        $this->idex = $id;

        $this->qenvio = Tipo::orderByRaw("id = ? DESC", [$this->enviomodal])->get();
        $this->qestatus = Estatus::orderByRaw("id = ? DESC", [$this->estatusmodal])->get();
    }


    public function actualizardatos()
    {
        //$this->validate();
        DB::beginTransaction();
        try {
            exportacion::where('id', $this->idex)->update([
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
                'liberacion' => $this->liberacion,
            ]);

            $this->opensave = false;
            DB::commit();

            $this->dispatch('datosActualizados');
        } catch (Exception $e) {
            DB::rollBack();
            // $this->dispatch('alert', 'error',  'Error', $e->getMessage());
        }
    }



    #[On('editarmasivamente')]
    public function editarmasivamente($id)
    {

        $this->nuevocliente = false;
        $this->opensave = true;
        $this->masivo = true;
        $query = exportacion::where('estatus', '!=', 3)->wherein('id', $id)->first();
        $this->motonavemas = $query->motonave;
        $this->etamas = $query->eta;

        $this->idex = $id;
    }


    public function actualizardatosmasivos()
    {
        //$this->validate();
        DB::beginTransaction();
        try {

            exportacion::wherein('id', $this->idex)->update([
                'motonave' =>  $this->motonavemas,
                'eta' => $this->etamas,
            ]);


            $this->opensave = false;

            DB::commit();

            //$this->dispatch('datosActualizados');

        } catch (Exception $e) {
            DB::rollBack();
            // $this->dispatch('alert', 'error',  'Error', $e->getMessage());
        }
    }




    #[On('nuevocliente')]
    public function nuevocliente()
    {

        $this->reset(['motonave', 'expediente', 'consignatario', 'bl', 'tipo', 'contenedor', 'eta', 'obs', 'cliente', 'linea', 'enviomodal', 'estatusmodal', 'liberacion']);

        $this->nuevocliente = true;
        $this->masivo = false;
        $this->opensave = true;

        $this->qenvio = Tipo::get();
        $this->qestatus = Estatus::get();
    }



    public function ingresarnuevo()
    {
        //$this->validate();
        DB::beginTransaction();
        try {

            $fecha = $this->eta;
            if (isset($fecha) && $fecha !== '') {
                // Verificar si $fecha es una instancia de Carbon
                if (!$fecha instanceof Carbon) {
                    // Convertir a Carbon si no lo es
                    $fecha = Carbon::parse($fecha);
                }

                // Formatear la fecha a 'Y-m-d'
                $fecha = $fecha->format('Y-m-d');

                // Verificar si el valor en $rows[5] es numérico y convertirlo a fecha
                if (is_numeric($this->eta)) {
                    $fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($this->eta));
                    $fecha = $fecha->format('Y-m-d');
                }
            }else{
                $fecha = null;
            }


          $exp =  exportacion::Create([
                'motonave' =>  $this->motonave,
                'expediente' => $this->expediente,
                'consignatario' => $this->consignatario,
                'bl' => $this->bl,
                'tipo' => $this->tipo,
                'contenedor' => $this->contenedor,
                'eta' => $fecha,
                'obs' => $this->obs,
                'cliente' => $this->cliente,
                'linea' => $this->linea,
                'envio' => $this->enviomodal,
                'estatus' => $this->estatusmodal,
                'liberacion' => $this->liberacion,
            ]);

            $this->opensave = false;
            DB::commit();

            $this->dispatch('alertamensaje', 'success',  'Exito', 'Cliente registrado');
        } catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('alertamensaje', 'error',  'Error', $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.info');
    }
}
