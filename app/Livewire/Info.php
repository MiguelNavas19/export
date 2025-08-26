<?php

namespace App\Livewire;

use App\Jobs\SendMailJob;
use App\Models\{Bitacora, Color, Estatus, exportacion, Medida, Naviera, Puertos, Tipo};
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use InvalidArgumentException;
use TypeError;
use Exception;
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
    public $tipo;
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
    public $fechadespacho = '';
    public $fechadevolucion = '';
    public $fechaarribo = '';
    public $fecharegistro = '';
    public $fechaimpuesto = '';
    public $fechapresentacion = '';
    public $fechareconocimiento = '';
    public $fechavalidacion = '';
    public $diaslibres = '';
    public $factura = '';
    public $fechafactura = '';
    public $poder = 1;
    public $cantidadequipos = '';
    public $funcionario = '';
    public $descripcion = '';
    public $peso = '';
    public $dua = '';
    public $autorizado = 1;
    public $color = 0;
    public $base = 0;
    public $almacen = '';

    public $rif = '';

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
        // Resetear propiedades de forma más eficiente
        $this->resetUI();

        $this->setComponentState(false, false, true);

        $record = exportacion::find($id);

        if (!$record) {
            $this->dispatch('alertamensaje', 'error', 'Error', 'Registro no encontrado');
            return;
        }

        $this->mapRecordToProperties($record);
        $this->idex = $id;
    }

    private function setComponentState($masivo, $nuevocliente, $opensave)
    {
        $this->masivo = $masivo;
        $this->nuevocliente = $nuevocliente;
        $this->opensave = $opensave;
    }

    private function mapRecordToProperties($record)
    {

        $propertyMap = [
            'motonave' => 'motonave',
            'expediente' => 'expediente',
            'consignatario' => 'consignatario',
            'bl' => 'bl',
            'tipo' => 'tipo',
            'contenedor' => 'contenedor',
            'eta' => 'eta',
            'obs' => 'obs',
            'cliente' => 'cliente',
            'linea' => 'linea',
            'liberacion' => 'liberacion',
            'envio' => 'enviomodal',
            'estatus' => 'estatusmodal',
            'renuncia' => 'renuncia',
            'id_puerto' => 'puerto',
            'fecha_entrega' => 'fechaentrega',
            'fecha_pago' => 'fechapago',
            'fecha_veconinter' => 'fechaveconinter',
            'fecha_despacho' => 'fechadespacho',
            'fecha_devolucion' => 'fechadevolucion',
            'fecha_arribo' => 'fechaarribo',
            'fecha_registro' => 'fecharegistro',
            'fecha_impuesto' => 'fechaimpuesto',
            'fecha_presentacion' => 'fechapresentacion',
            'fecha_reconocimiento' => 'fechareconocimiento',
            'fecha_validacion' => 'fechavalidacion',
            'dias_libres' => 'diaslibres',
            'factura' => 'factura',
            'fecha_factura' => 'fechafactura',
            'poder' => 'poder',
            'cantidad_equipos' => 'cantidadequipos',
            'funcionario' => 'funcionario',
            'descripcion' => 'descripcion',
            'peso' => 'peso',
            'dua' => 'dua',
            'autorizado' => 'autorizado',
            'color' => 'color',
            'base' => 'base',
            'almacen' => 'almacen'
        ];

        foreach ($propertyMap as $recordKey => $property) {
            if ($recordKey == "tipo") {
                $this->$property  = $this->tipoid($record->$recordKey);
            } else {
                $this->$property = $record->$recordKey;
            }
        }
    }



    public function actualizardatos()
    {
        DB::beginTransaction();

        try {

            $this->eta = $this->parseDate($this->eta);
            $this->fechaveconinter = $this->parseDate($this->fechaveconinter);
            $this->fechadespacho = $this->parseDate($this->fechadespacho);
            $this->fechadevolucion =  $this->parseDate($this->fechadevolucion);
            $this->fechaarribo = $this->parseDate($this->fechaarribo);
            $this->fecharegistro = $this->parseDate($this->fecharegistro);
            $this->fechaimpuesto = $this->parseDate($this->fechaimpuesto);
            $this->fechapresentacion =  $this->parseDate($this->fechapresentacion);
            $this->fechareconocimiento = $this->parseDate($this->fechareconocimiento);
            $this->fechavalidacion = $this->parseDate($this->fechavalidacion);
            $this->fechafactura = $this->parseDate($this->fechafactura);
            $this->fechapago = $this->parseDate($this->fechapago);
            $this->fechaentrega = $this->parseDate($this->fechaentrega);

            $this->tipo = $this->tiponame($this->tipo);

            // Obtener registro actual antes de la actualización
            $antes = exportacion::findOrFail($this->idex);

            // Actualizar el registro
            $this->updateExportacionRecord($antes);

            // Obtener registro actualizado
            $despues = exportacion::findOrFail($this->idex);

            // Registrar en bitácora
            $this->createBitacoraEntry($antes, $despues);

            // Finalizar operación
            $this->finalizeUpdate();

            DB::commit();
            $this->dispatch('datosActualizados');
        } catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('alertamensaje', 'error', 'Error', $e->getMessage());
        }
    }


    protected function updateExportacionRecord($currentRecord)
    {
        $updateData = [
            'motonave' => trim($this->motonave),
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
            'fecha_veconinter' => $this->fechaveconinter,
            'fecha_despacho' => $this->fechadespacho,
            'fecha_devolucion' => $this->fechadevolucion,
            'fecha_arribo' => $this->fechaarribo,
            'fecha_registro' => $this->fecharegistro,
            'fecha_impuesto' => $this->fechaimpuesto,
            'fecha_presentacion' => $this->fechapresentacion,
            'fecha_reconocimiento' => $this->fechareconocimiento,
            'fecha_validacion' => $this->fechavalidacion,
            'fecha_factura' => $this->fechafactura,
            'dias_libres' => trim($this->diaslibres),
            'factura' => trim($this->factura),
            'poder' => $this->poder,
            'cantidad_equipos' => trim($this->cantidadequipos),
            'funcionario' => trim($this->funcionario),
            'descripcion' => trim($this->descripcion),
            'peso' => trim($this->peso),
            'dua' => trim($this->dua),
            'autorizado' => $this->autorizado,
            'color' => $this->color,
            'base' => $this->base,
            'almacen' => $this->almacen
        ];

        // Actualizar usando el modelo existente
        $currentRecord->update($updateData);
    }

    protected function createBitacoraEntry($antes, $despues)
    {
        Bitacora::create([
            'id_usuario' => Auth::id(),
            'antes' => $antes,
            'despues' => $despues
        ]);
    }

    protected function finalizeUpdate()
    {
        $this->opensave = false;
        $this->resetExcept('idex'); // Mantener idex por si se necesita
    }


    #[On('nuevocliente')]
    public function nuevocliente()
    {

        $this->resetUI();
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

            // Procesamiento de fechas centralizado
            $eta = $this->parseDate($this->eta);
            $fechaveconinter = $this->parseDate($this->fechaveconinter);

            $fechadespacho = $this->parseDate($this->fechadespacho);
            $fechadevolucion =  $this->parseDate($this->fechadevolucion);
            $fechaarribo = $this->parseDate($this->fechaarribo);
            $fecharegistro = $this->parseDate($this->fecharegistro);
            $fechaimpuesto = $this->parseDate($this->fechaimpuesto);
            $fechapresentacion =  $this->parseDate($this->fechapresentacion);
            $fechareconocimiento = $this->parseDate($this->fechareconocimiento);
            $fechavalidacion = $this->parseDate($this->fechavalidacion);
            $fechafactura = $this->parseDate($this->fechafactura);
            $fechapago = $this->parseDate($this->fechapago);
            $fechaentrega = $this->parseDate($this->fechaentrega);

            $tipo = $this->tiponame($this->tipo);

            // Verificación de duplicados
            if ($this->registroDuplicado()) {
                $this->dispatch('alertamensaje', 'error', 'Error', 'BL o Expediente ya registrados');
                DB::rollBack();
                return;
            }

            // Creación del registro
            $exp = exportacion::create($this->prepareData(
                $eta,
                $fechaveconinter,
                $fechadespacho,
                $fechadevolucion,
                $fechaarribo,
                $fecharegistro,
                $fechaimpuesto,
                $fechapresentacion,
                $fechareconocimiento,
                $fechavalidacion,
                $fechafactura,
                $tipo,
                $fechapago,
                $fechaentrega
            ));

            // Registro en bitácora
            $this->createBitacoraEntry('nuevo registro', $exp);


            // Envío de notificaciones
            $this->enviarNotificaciones($exp);

            DB::commit();
            $this->resetUI();
            $this->opensave = false;
            $this->dispatch('alertamensaje', 'success', 'Exito', 'Cliente registrado');
        } catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('alertamensaje', 'error', 'Error', $e->getMessage());
        }
    }

    // Métodos auxiliares
    private function parseDate($dateValue)
    {
        if (empty($dateValue)) return null;

        if (is_numeric($dateValue)) {
            return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateValue))
                ->format('Y-m-d');
        }

        return Carbon::parse($dateValue)->format('Y-m-d');
    }


    private function registroDuplicado()
    {
        $query = exportacion::where('bl', trim($this->bl));

        if (!empty(trim($this->expediente))) {
            $query->orWhere('expediente', trim($this->expediente));
        }

        return $query->exists();
    }

    private function tiponame($tipo)
    {

        return Medida::where('status', true)->where('id', $tipo)->value('nombre') ?? null;
    }

    private function tipoid($tipo)
    {

        return Medida::where('status', true)->where('nombre', $tipo)->value('id') ?? null;
    }

    private function prepareData(
        $eta,
        $fechaveconinter,
        $fechadespacho,
        $fechadevolucion,
        $fechaarribo,
        $fecharegistro,
        $fechaimpuesto,
        $fechapresentacion,
        $fechareconocimiento,
        $fechavalidacion,
        $fechafactura,
        $tipo,
        $fechapago,
        $fechaentrega
    ) {
        return [
            'motonave' => trim($this->motonave),
            'expediente' => trim($this->expediente),
            'consignatario' => trim($this->consignatario),
            'bl' => trim($this->bl),
            'tipo' => trim($tipo),
            'contenedor' => trim($this->contenedor),
            'eta' => $eta,
            'obs' => trim($this->obs),
            'cliente' => trim($this->cliente),
            'linea' => $this->linea,
            'envio' => $this->enviomodal,
            'estatus' => $this->estatusmodal,
            'liberacion' => $this->liberacion,
            'renuncia' => trim($this->renuncia),
            'id_puerto' => $this->puerto,
            'fecha_veconinter' => $fechaveconinter,
            'fecha_despacho' => $fechadespacho,
            'fecha_devolucion' => $fechadevolucion,
            'fecha_arribo' => $fechaarribo,
            'fecha_registro' => $fecharegistro,
            'fecha_impuesto' => $fechaimpuesto,
            'fecha_presentacion' => $fechapresentacion,
            'fecha_reconocimiento' => $fechareconocimiento,
            'fecha_validacion' => $fechavalidacion,
            'fecha_factura' => $fechafactura,
            'dias_libres' => trim($this->diaslibres),
            'factura' => trim($this->factura),
            'poder' => $this->poder,
            'cantidad_equipos' => trim($this->cantidadequipos),
            'funcionario' => trim($this->funcionario),
            'descripcion' => trim($this->descripcion),
            'peso' => trim($this->peso),
            'dua' => trim($this->dua),
            'autorizado' => $this->autorizado,
            'color' => $this->color,
            'fecha_entrega' => $fechaentrega,
            'fecha_pago' => $fechapago,
            'base' => $this->base,
            'almacen' => $this->almacen
        ];
    }


    private function enviarNotificaciones($exp)
    {
        if ($exp->tipolinea->datosnaviera->isNotEmpty()) {
            $emails = $exp->tipolinea->datosnaviera->pluck('email')->toArray();
            SendMailJob::dispatch($emails, $this->bl, $exp->id_puerto);
            $exp->update(['send' => true]);
        }
    }

    private function resetUI()
    {

        $this->reset([
            'motonave',
            'expediente',
            'consignatario',
            'bl',
            'tipo',
            'contenedor',
            'eta',
            'obs',
            'cliente',
            'linea',
            'enviomodal',
            'estatusmodal',
            'liberacion',
            'renuncia',
            'puerto',
            'fechaveconinter',
            'fechadespacho',
            'fechadevolucion',
            'fechaarribo',
            'fecharegistro',
            'fechaimpuesto',
            'fechapresentacion',
            'fechareconocimiento',
            'fechavalidacion',
            'fechafactura',
            'diaslibres',
            'factura',
            'poder',
            'cantidadequipos',
            'funcionario',
            'descripcion',
            'peso',
            'dua',
            'autorizado',
            'color',
            'fechaentrega',
            'fechapago',
            'base',
            'almacen'
        ]);
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

        $this->reset(['rif', 'direccion', 'dirigido', 'renuncia', 'motonave', 'expediente', 'consignatario', 'bl', 'tipo', 'contenedor', 'eta', 'obs', 'cliente', 'linea', 'enviomodal', 'estatusmodal', 'liberacion', 'puerto']);


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

        $this->reset(['rif', 'direccion', 'dirigido', 'renuncia', 'motonave', 'expediente', 'consignatario', 'bl', 'tipo', 'contenedor', 'eta', 'obs', 'cliente', 'linea', 'enviomodal', 'estatusmodal', 'liberacion', 'puerto']);

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
                SendMailJob::dispatch($emails, $data->bl, $data->id_puerto);
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
                $rif = $this->rif;
                $pdf = Pdf::loadView('pdf.apendi', compact('exportacion', 'direccion', 'rif'))->setPaper('a4');

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
                $rif = $this->rif;
                if ($this->word) {

                    // Ruta de la plantilla
                    $templatePath = public_path('storage/plantillas/plantilla_carta.docx');
                    $template = new TemplateProcessor($templatePath);

                    // Reemplazar marcadores de texto
                    $template->setValue('fecha', now()->day . ' de ' . strtoupper(now()->locale('es')->monthName) . ' de ' . now()->year);
                    $template->setValue('dirigido', $dirigido);
                    $template->setValue('rif', $rif);
                    $template->setValue('bl', $exportacion->bl);
                    $template->setValue('peso', $exportacion->peso);
                    $template->setValue('tipo', $exportacion->tipo);
                    $template->setValue('contenedor', $exportacion->contenedor);
                    $template->setValue('cantidad', $exportacion->cantidad_equipos);
                    $template->setValue('motonave', $exportacion->motonave);
                    $template->setValue('renuncia', $exportacion->renuncia);
                    $template->setValue('eta', \Carbon\Carbon::parse($exportacion->eta)->format('d/m/Y'));
                    // Guardar el documento temporal
                    $tempFile = storage_path('app/documento_generado.docx');
                    $template->saveAs($tempFile);

                    // Descargar el archivo
                    return Response::download($tempFile, $this->namearchive . $dirigido . '.docx')
                        ->deleteFileAfterSend(true);
                } else {
                    $view = $this->retiro;


                    $fileName = $this->namearchive . $dirigido . '.pdf';

                    $pdf = Pdf::loadView($view, compact('exportacion', 'dirigido', 'rif'))->setPaper('a4');

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream(); // o cualquier método que use para obtener el contenido del PDF
                    }, $fileName);

                    // $pdfPath = public_path() . '/storage/temp/' . $fileName;
                    // $pdf->save($pdfPath);
                    // $ruta = '/storage/temp/' . $fileName;

                    // $this->dispatch('openPdf', asset($ruta));
                }
            }
        } catch (Exception $e) {

            $this->dispatch('errormensaje', 'error',  'Error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.info', [
            'qenvio' => Tipo::all(),
            'qestatus' => $this->getEstatus(),
            'qpuertos' => $this->getActiveRecords(Puertos::class),
            'naviera' => $this->getActiveRecords(Naviera::class),
            'colors' => $this->getActiveRecords(Color::class),
            'medidas' => $this->getActiveRecords(Medida::class),
        ]);
    }

    protected function getEstatus()
    {
        return Auth::user()->id == 5
            ? Estatus::where('id', '!=', 3)->get()
            : Estatus::all();
    }

    protected function getActiveRecords($model)
    {
        return $model::where('status', true)->get();
    }
}
