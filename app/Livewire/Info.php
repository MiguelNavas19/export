<?php

namespace App\Livewire;

use App\Jobs\SendMailJob;
use App\Models\Bitacora;
use App\Models\Estatus;
use App\Models\exportacion;
use App\Models\Naviera;
use App\Models\Puertos;
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
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Response;


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
    public $puerto = '';
    public $enviomodal;
    public $estatusmodal;
    public $liberacion;
    public $idex;
    public $dirigido = '';
    public $direccion = '';
    public $masivo = false;
    public $nuevocliente = false;
    public $motonavemas = '';
    public $etamas = '';
    public $titulo = ' Carta BL';
    public $apendi = false;
    public $retiro;
    public $word = false;
    public $fechapago = '';
    public $fechaentrega = '';
    public $namearchive;
    public $fechaveconinter = '';

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

        $this->reset(['fechaentrega','fechapago','renuncia', 'motonave', 'expediente', 'consignatario', 'bl', 'tipo', 'contenedor', 'eta', 'obs', 'cliente', 'linea', 'enviomodal', 'estatusmodal', 'liberacion', 'puerto']);

        $this->masivo = false;
        $this->nuevocliente = false;
        $this->opensave = true;

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
        $this->puerto = $query->id_puerto;
        $this->idex = $id;
        $this->fechaentrega = $query->fecha_entrega;
        $this->fechapago = $query->fecha_pago;
        $this->fechaveconinter = $query->fecha_veconinter;
    }


    public function actualizardatos()
    {

        //$this->validate();
        DB::beginTransaction();
        try {

            if (empty($this->eta) or is_null($this->eta)) {
                $this->eta = null;
            }
            
            if (empty($this->fechaentrega) or is_null($this->fechaentrega)) {
                $this->fechaentrega = null;
            }

            if (empty($this->fechapago) or is_null($this->fechapago)) {
                $this->fechapago = null;
            }
            
             if (empty($this->fechaveconinter) or is_null($this->fechaveconinter)) {
                $this->fechaveconinter = null;
            }
            
            $antes =  exportacion::where('id', $this->idex)->first();

            exportacion::where('id', $this->idex)->update([
                'motonave' =>  trim($this->motonave),
                'expediente' => trim($this->expediente),
                'consignatario' => trim($this->consignatario),
                'bl' => trim($this->bl),
                'tipo' => trim($this->tipo),
                'contenedor' => trim($this->contenedor),
                'eta' => $this->eta,
                'obs' => trim($this->obs),
                'cliente' => trim($this->cliente),
                'linea' => $this->linea,
                'envio' => $this->enviomodal,
                'estatus' => $this->estatusmodal,
                'liberacion' => $this->liberacion,
                'renuncia' => trim($this->renuncia),
                'id_puerto' => $this->puerto,
                'fecha_entrega' => $this->fechaentrega,
                'fecha_pago' => $this->fechapago,
                'fecha_veconinter' => $this->fechaveconinter
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



    #[On('nuevocliente')]
    public function nuevocliente()
    {

        $this->reset(['renuncia', 'motonave', 'expediente', 'consignatario', 'bl', 'tipo', 'contenedor', 'eta', 'obs', 'cliente', 'linea', 'enviomodal', 'estatusmodal', 'liberacion', 'puerto']);
        $this->nuevocliente = true;
        $this->masivo = false;
        $this->opensave = true;
    }


    #[On('ingresarnuevos')]
    public function ingresarnuevo()
    {

        DB::beginTransaction();
        try {

            $this->validate();
            $fecha = $this->eta;
            $fechaveconinter = $this->fechaveconinter;
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
            
              if (isset($fechaveconinter) && $fechaveconinter !== '') {
                // Verificar si $fecha es una instancia de Carbon
                if (!$fechaveconinter instanceof Carbon) {
                    // Convertir a Carbon si no lo es
                    $fechaveconinter = Carbon::parse($fechaveconinter);
                }

                // Formatear la fecha a 'Y-m-d'
                $fechaveconinter = $fechaveconinter->format('Y-m-d');

                // Verificar si el valor en $rows[5] es numérico y convertirlo a fecha
                if (is_numeric($this->fechaveconinter)) {
                    $fechaveconinter = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($this->fechaveconinter));
                    $fechaveconinter = $fechaveconinter->format('Y-m-d');
                }
            } else {
                $fechaveconinter = null;
            }

            $consulta = exportacion::where(function ($query) {
                if (isset($this->expediente) && trim($this->expediente) !== '') {
                    $query->where('bl', trim($this->bl))
                        ->orWhere('expediente', trim($this->expediente));
                } else {
                    $query->where('bl', trim($this->bl));
                }
            })
                ->get();

            if (count($consulta) == 0) {
                $exp =  exportacion::Create([
                    'motonave' =>  trim($this->motonave),
                    'expediente' => trim($this->expediente),
                    'consignatario' => trim($this->consignatario),
                    'bl' => trim($this->bl),
                    'tipo' => trim($this->tipo),
                    'contenedor' => trim($this->contenedor),
                    'eta' => $fecha,
                    'obs' => trim($this->obs),
                    'cliente' => trim($this->cliente),
                    'linea' => $this->linea,
                    'envio' => $this->enviomodal,
                    'estatus' => $this->estatusmodal,
                    'liberacion' => $this->liberacion,
                    'renuncia' => trim($this->renuncia),
                    'id_puerto' => $this->puerto,
                    'fecha_veconinter' => $fechaveconinter,
                ]);

                Bitacora::Create([
                    'id_usuario' =>  Auth::user()->id,
                    'antes' => 'nuevo registro',
                    'despues' => $exp
                ]);

                $this->opensave = false;

                DB::commit();

                $this->dispatch('alertamensaje', 'success',  'Exito', 'Cliente registrado');

                if ($exp->tipolinea->datosnaviera->count() > 0) {

                    $emails = collect($exp->tipolinea->datosnaviera)->pluck('email')->toArray();
                    SendMailJob::dispatch($emails, $this->bl);
                    $exp->update(['send' => true]);
                }
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
    public function pdfbl($id, $datos)
    {

        $this->reset(['direccion', 'dirigido', 'renuncia', 'motonave', 'expediente', 'consignatario', 'bl', 'tipo', 'contenedor', 'eta', 'obs', 'cliente', 'linea', 'enviomodal', 'estatusmodal', 'liberacion', 'puerto']);

        $this->masivo = false;
        $this->nuevocliente = false;
        $this->opensave = false;
        $this->openpdf = true;
        $this->apendi = false;
      
        $this->titulo = match ($datos) {
            3 => 'Renuncia',
            2 => 'Retiro BL',
            default => 'Carta BL',
        };

        $this->namearchive = match ($datos) {
            3 => 'renuncia_',
            2 => 'retiro_bl_',
            default => 'carta_bl_',
        };

        $this->retiro = match ($datos) {
            2 => 'pdf.retiro',
            default => 'pdf.carta',
        };

        $this->word = match ($datos) {
            3 => true,
            default => false,
        };
      
        $this->idex = $id;
    }


    #[On('apendi')]
    public function apendi($id)
    {

        $this->reset(['direccion', 'dirigido', 'renuncia', 'motonave', 'expediente', 'consignatario', 'bl', 'tipo', 'contenedor', 'eta', 'obs', 'cliente', 'linea', 'enviomodal', 'estatusmodal', 'liberacion', 'puerto']);

        $this->masivo = false;
        $this->nuevocliente = false;
        $this->opensave = false;
        $this->openpdf = true;
        $this->apendi = true;
        $this->titulo = 'Apendi A,B';
        $this->idex = $id;
    }


    #[On('enviarmail')]
    public function enviarmail($id)
    {
       $data = exportacion::where('id', $id)->first();
        if ($data) {
            if ($data->tipolinea->datosnaviera->count() > 0) {

                $emails = collect($data->tipolinea->datosnaviera)->pluck('email')->toArray();
               

                SendMailJob::dispatch($emails, $data->bl);
                 $this->dispatch('alertamensaje', 'success',  'Exito', 'Correo enviado con exito');
                $data->update(['send' => true]);
            } else {
                $this->dispatch('alertamensaje', 'error',  'Error', 'Naviera ' . $data->tipolinea->nombre . ' no tiene correo registrado');
            }
        } else {
            $this->dispatch('alertamensaje', 'error',  'Error', 'Correo ya fue enviado');
        }
    }


   public function generarpdf()
    {
        $this->skipRender();
        try {

            $exportacion = exportacion::where('id', $this->idex)->first();

            if ($this->apendi) {
                if (empty(trim($this->direccion))) {
                    throw new InvalidArgumentException('El campo direccion no puede estar vacío');
                }
                $direccion = $this->direccion;
                $pdf = Pdf::loadView('pdf.apendi', compact('exportacion', 'direccion'))->setPaper('a4');

                return response()->streamDownload(function () use ($pdf) {
                    // Aquí simplemente se debe llamar a la función que genera el PDF.
                    echo $pdf->stream(); // o cualquier método que use para obtener el contenido del PDF
                }, 'APENDI.pdf');
            } else {

                if (empty(trim($this->dirigido))) {
                    throw new InvalidArgumentException('El campo dirigido no puede estar vacío');
                }

                if (!is_string(trim($this->dirigido))) {
                    throw new TypeError('El campo dirigido debe ser una cadena');
                }
                $dirigido = $this->dirigido;

          if ($this->word) {

                    // Ruta de la plantilla
                    $templatePath = storage_path('app/public/plantillas/plantilla_carta.docx');
                    $template = new TemplateProcessor($templatePath);

                    // Reemplazar marcadores de texto
                    $template->setValue('fecha', now()->day . ' de ' . strtoupper(now()->locale('es')->monthName) . ' de ' . now()->year);
                    $template->setValue('dirigido', $dirigido);
                    $template->setValue('bl', $exportacion->bl);
                    $template->setValue('motonave', $exportacion->motonave);
                    $template->setValue('renuncia', $exportacion->renuncia);
                    $template->setValue('eta', \Carbon\Carbon::parse($exportacion->eta)->format('d/m/Y'));
                    // Guardar el documento temporal
                    $tempFile = storage_path('app/documento_generado.docx');
                    $template->saveAs($tempFile);

                    // Descargar el archivo
                    return Response::download($tempFile, $this->namearchive . $dirigido .'.docx')
                        ->deleteFileAfterSend(true);
                } else {
                    $view = $this->retiro;

                    $fileName = $this->namearchive . $dirigido . '.pdf';

                    $pdf = Pdf::loadView($view, compact('exportacion', 'dirigido'))->setPaper('a4');

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream(); // o cualquier método que use para obtener el contenido del PDF
                    }, $fileName);
                }
            }
        } catch (Exception $e) {

            $this->dispatch('errormensaje', 'error',  'Error', $e->getMessage());
        }
    }

    public function render()
    {

        $qenvio = Tipo::get();

        $qestatus = Auth::user()->id == 5
        ? Estatus::whereNotIn('id', [3])->get()
        : Estatus::get();

        $qpuertos = Puertos::where('status', true)->get();
        $naviera = Naviera::where('status', true)->get();

        return view('livewire.info', compact('qenvio', 'qestatus', 'qpuertos', 'naviera'));
    }
}
