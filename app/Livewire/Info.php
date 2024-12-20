<?php

namespace App\Livewire;

use App\Models\Bitacora;
use App\Models\Estatus;
use App\Models\exportacion;
use App\Models\Tipo;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use InvalidArgumentException;
use TypeError;


class Info extends Component
{

    public $opensave = false;
    public $openpdf = false;
    public $motonave = '';
    public $expediente = '';
    public $consignatario = '';
    public $renuncia = '';
    public $bl = '';
    public $tipo = '';
    public $contenedor = '';
    public $eta = '';
    public $obs = '';
    public $cliente = "";
    public $linea = '';
    public $enviomodal;
    public $estatusmodal;
    public $liberacion;
    public $idex;
    public $dirigido = '';

    public $masivo = false;
    public $nuevocliente = false;
    public $motonavemas = '';
    public $etamas = '';



    public function rules()
    {
        return [
            'expediente' => Rule::unique('exportacion'),
            'bl' => 'required|' . Rule::unique('exportacion'),
            'cliente' => 'required',
            'consignatario' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'bl.required' => 'El BL es requerido',
            'bl.unique' => 'BL ya se encuentra registrado',
            'expediente.unique' => 'expediente ya se encuentra registrado',
            'cliente.required' => 'El cliente es requerido',
            'consignatario.required' => 'El consignatario es requerido',
        ];
    }



    #[On('editar')]
    public function editar($id)
    {

        $this->reset(['renuncia', 'motonave', 'expediente', 'consignatario', 'bl', 'tipo', 'contenedor', 'eta', 'obs', 'cliente', 'linea', 'enviomodal', 'estatusmodal', 'liberacion']);

        $this->masivo = false;
        $this->nuevocliente = false;
        $this->opensave = true;
        /*$query = exportacion::where(function ($query) {
                                $query->where('estatus', '!=', 3)
                                ->orWhere('estatus', null);
                        })->where('id', $id)->first();*/

        $query = exportacion::where('id', $id)->first();

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
        $this->liberacion = $query->liberacion;
        $this->enviomodal = $query->envio;
        $this->estatusmodal = $query->estatus;
        $this->renuncia = $query->renuncia;
        $this->idex = $id;
    }


    public function actualizardatos()
    {

        //$this->validate();
        DB::beginTransaction();
        try {

            if(empty($this->eta) OR is_null($this->eta)){
                $this->eta = null;
            }
            $antes =  exportacion::where('id', $this->idex)->first();

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
                'renuncia' => $this->renuncia,
            ]);


            $despues =  exportacion::where('id', $this->idex)->first();
            Bitacora::Create([
                'id_usuario' =>  Auth::user()->id,
                'antes' => $antes,
                'despues' => $despues
            ]);


            $this->opensave = false;
            DB::commit();

            $this->dispatch('datosActualizados');
        } catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('alertamensaje', 'error',  'Error', $e->getMessage());
        }
    }



    /*  #[On('editarmasivamente')]
    public function editarmasivamente($id)
    {

        $this->nuevocliente = false;
        $this->opensave = true;
        $this->masivo = true;
        $query = exportacion::where('estatus', '!=', 3)->wherein('id', $id)->first();
        $this->motonavemas = $query->motonave;
        $this->etamas = $query->eta;

        $this->idex = $id;
    }*/


    /* public function actualizardatosmasivos()
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
*/



    #[On('nuevocliente')]
    public function nuevocliente()
    {

        $this->reset(['renuncia','motonave', 'expediente', 'consignatario', 'bl', 'tipo', 'contenedor', 'eta', 'obs', 'cliente', 'linea', 'enviomodal', 'estatusmodal', 'liberacion']);
        $this->nuevocliente = true;
        $this->masivo = false;
        $this->opensave = true;
    }



    public function ingresarnuevo()
    {
        $this->validate();
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
            } else {
                $fecha = null;
            }

            $consulta = exportacion::where(function ($query) {
                if (isset($this->expediente) && $this->expediente !== '') {
                    $query->where('bl', $this->bl)
                        ->orWhere('expediente', $this->expediente);
                } else {
                    $query->where('bl', $this->bl);
                }
            })
                ->get();

            if (count($consulta) == 0) {
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
                    'renuncia' => $this->renuncia,
                ]);

                $databitacora = json_encode([
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
                    'renuncia' => $this->renuncia,
                ]);

                Bitacora::Create([
                    'id_usuario' =>  Auth::user()->id,
                    'antes' => 'nuevo registro',
                    'despues' => $databitacora
                ]);

                $this->opensave = false;
                DB::commit();

                $this->dispatch('alertamensaje', 'success',  'Exito', 'Cliente registrado');
            } else {
                $this->dispatch('alertamensaje', 'error',  'Error', 'BL o Expediente ya registrados');
                DB::rollBack();
            }
        } catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('alertamensaje', 'error',  'Error', $e->getMessage());
        }
    }



    #[On('eliminar')]
    public function eliminar($id)
    {
        DB::beginTransaction();
        try {

            Bitacora::Create([
                'id_usuario' =>  Auth::user()->id,
                'antes' => 'eliminado',
                'despues' => exportacion::where('id', $id)->first()
            ]);

            exportacion::where('id', $id)->delete();


            DB::commit();
            $this->dispatch('alertamensaje', 'success',  'Exito', 'Eliminado con exito');
        } catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('alertamensaje', 'error',  'Error', $e->getMessage());
        }
    }





    #[On('pdfbl')]
    public function pdfbl($id)
    {

        $this->reset(['renuncia', 'motonave', 'expediente', 'consignatario', 'bl', 'tipo', 'contenedor', 'eta', 'obs', 'cliente', 'linea', 'enviomodal', 'estatusmodal', 'liberacion']);

        $this->masivo = false;
        $this->nuevocliente = false;
        $this->opensave = false;
        $this->openpdf = true;

        $this->idex = $id;
    }


    public function generarpdf()
    {
        $this->skipRender();
        try {
            if (empty(trim($this->dirigido))) {
                throw new InvalidArgumentException('El campo dirigido no puede estar vacío');
            }

            if (!is_string(trim($this->dirigido))) {
                throw new TypeError('El campo dirigido debe ser una cadena');
            }
            $exportacion = exportacion::where('id', $this->idex)->first();
            $dirigido = $this->dirigido;

           $pdf = Pdf::loadView('pdf.carta', compact('exportacion','dirigido'))->setPaper('a4');

            return response()->streamDownload(function () use ($pdf) {
                // Aquí simplemente se debe llamar a la función que genera el PDF.
               echo $pdf->stream(); // o cualquier método que use para obtener el contenido del PDF
            }, 'carta_bl_'.$dirigido.'.pdf');



        } catch (Exception $e) {

            $this->dispatch('errormensaje', 'error',  'Error', $e->getMessage());
        }

    }

    public function render()
    {

        $qenvio = Tipo::get();
        $qestatus = Estatus::get();


        return view('livewire.info', compact('qenvio', 'qestatus'));
    }
}
