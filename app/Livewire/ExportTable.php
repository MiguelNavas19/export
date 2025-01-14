<?php

namespace App\Livewire;

use App\Exports\ExportInfo;
use App\Exports\ReportExport;
use App\Models\exportacion;
use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Attributes\On;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class ExportTable extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDisabled();
        $this->setFiltersVisibilityStatus(false);
        $this->setPerPageVisibilityStatus(false);
        $this->setPerPageAccepted([100]);
        $this->setLoadingPlaceholderStatus(true);
        $this->setLoadingPlaceholderContent('Cargando...');
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('consignatario')) {
                return [
                    'default' => false,
                    'class' => 'px-2 text-sm font-medium dark:text-white',
                ];
            }

            if ($column->isField('contenedor')) {
                return [
                    'default' => false,
                    'class' => 'px-2 text-sm font-medium dark:text-white',
                ];
            }

            if ($column->isField('bl')) {
                return [
                    'default' => false,
                    'class' => 'px-2 text-sm font-medium dark:text-white',
                ];
            }

            return [];
        });


        $this->setBulkActions([
            'export' => 'Exportar',
            'exportcarpeta' => 'Plantilla carpeta',
            'exportestatus' => 'Exportar Estatus',
        ]);


        $this->setTrAttributes(function ($row, $index) {
            $date = Carbon::now();

            if ($row->updated_at->format('Y-m-d') == $date->format('Y-m-d')) {
                return [
                    'class' => 'dark:bg-gray-900 bg-gray-500', // Color para estado activo
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make('id')->excludeFromColumnSelect()->hideIf(true)
                ->sortable(),
            Column::make('expediente')->secondaryHeader($this->getFilterByKey('expediente'))
                ->sortable(),
            Column::make('consignatario')->secondaryHeader($this->getFilterByKey('consignatario'))
                ->sortable(),
            Column::make('bl')->secondaryHeader($this->getFilterByKey('bl'))
                ->sortable(),
            Column::make('tipo')->collapseAlways()
                ->sortable(),
            Column::make('contenedor')->secondaryHeader($this->getFilterByKey('contenedor'))
                ->sortable(),
            Column::make('eta')
                ->secondaryHeader($this->getFilterByKey('fecha'))
                ->sortable(),

            Column::make('motonave')->secondaryHeader($this->getFilterByKey('motonave'))
                ->sortable(),

            Column::make('cliente')->secondaryHeader($this->getFilterByKey('cliente'))
                ->sortable(),

            Column::make('linea')->hideIf(true),
            Column::make('linea', 'tipolinea.nombre')->sortable(),

            Column::make('puerto', 'tipopuerto.nombre')->sortable(),

            Column::make('envio', 'tipoenvio.nombre')->secondaryHeader($this->getFilterByKey('envio'))
                ->sortable(),
            Column::make('estatus', 'tipoestatus.nombre')->secondaryHeader($this->getFilterByKey('estatus'))
                ->sortable(),

            Column::make('liberacion')->secondaryHeader($this->getFilterByKey('liberacion'))
                ->sortable()->format(function ($value) {
                    return $value == 1 ? 'Sí' : 'No';
                }),

            Column::make('Correo Enviado', 'send')->collapseAlways()->format(function ($value) {
                return $value == 1 ? 'Sí' : 'No';
            }),

            Column::make('obs')->secondaryHeader($this->getFilterByKey('obs'))->collapseAlways(),

            Column::make('renuncia')->collapseAlways(),
            Column::make('ultima actualizacion', 'updated_at')->collapseAlways(),

            Column::make('Actions')->label(
                fn($row, Column $column) => view('livewire.estatus', [
                    'valor' => 'BOTON',
                    'id' => $row->id,
                    'liberar' => $row->liberacion,
                    'sends' => $row->send,
                    'lineas' => $row->linea,
                ])
            ),



        ];
    }


    public function filters(): array
    {
        return [
            DateRangeFilter::make('fecha')
                ->config([
                    'allowInput' => true,   // Allow manual input of dates
                    'placeholder' => 'Ingrese Fecha', // A placeholder value
                ])
                ->setFilterPillValues([0 => 'minDate', 1 => 'maxDate']) // The values that will be displayed for the Min/Max Date Values
                ->filter(function (Builder $builder, array $dateRange) { // Expects an array.
                    $builder
                        ->whereDate('eta', '>=', $dateRange['minDate']) // minDate is the start date selected
                        ->whereDate('eta', '<=', $dateRange['maxDate']); // maxDate is the end date selected
                }),

            TextFilter::make('Cliente')
                ->config([
                    'placeholder' => 'Buscar Cliente',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('cliente', 'like', '%' . $value . '%');
                }),

            TextFilter::make('consignatario')
                ->config([
                    'placeholder' => 'Buscar consignatario',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('consignatario', 'like', '%' . $value . '%');
                }),

            TextFilter::make('expediente')
                ->config([
                    'placeholder' => 'Buscar expediente',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('expediente', 'like', '%' . $value . '%');
                }),

            TextFilter::make('contenedor')
                ->config([
                    'placeholder' => 'Buscar contenedor',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('contenedor', 'like', '%' . $value . '%');
                }),

            TextFilter::make('Motonave')
                ->config([
                    'placeholder' => 'Buscar Motonave',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('motonave', 'like', '%' . $value . '%');
                }),

            TextFilter::make('Bl')
                ->config([
                    'placeholder' => 'Buscar BL',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('bl', 'like', '%' . $value . '%');
                }),


            TextFilter::make('obs')
                ->config([
                    'placeholder' => 'Buscar Observacion',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('obs', 'like', '%' . $value . '%');
                }),

            TextFilter::make('envio')
                ->config([
                    'placeholder' => 'Buscar envio',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereHas('tipoenvio', function ($query) use ($value) {
                        $query->where('nombre', 'like', '%' . $value . '%'); // Cambia 'nombre' al campo correspondiente en tu tabla tipoenvio
                    });
                }),

            TextFilter::make('estatus')
                ->config([
                    'placeholder' => 'Buscar estatus',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereHas('tipoestatus', function ($query) use ($value) {
                        $query->where('nombre', 'like', '%' . $value . '%'); // Cambia 'nombre' al campo correspondiente en tu tabla tipoenvio
                    });
                }),

            TextFilter::make('liberacion')
                ->config([
                    'placeholder' => 'Buscar liberacion',
                ])
                ->filter(function (Builder $builder, string $value) {

                    if (strcasecmp($value, 'SI') == 0) {
                        $builder->where('liberacion', true);
                    } else {
                        $builder->where('liberacion', false)->orwhere('liberacion', null);
                    }
                }),

        ];
    }


    public function export()
    {
        $id = $this->getSelected();

        $this->clearSelected();
        if (count($id) > 0) {
            return Excel::download(new ExportInfo($id, 'general'), 'datosexportacion.xlsx');
        }
    }


    public function exportestatus()
    {

        $this->skipRender();
        try {

            $id = $this->getSelected();

            $this->clearSelected();
            if (count($id) > 0) {
              $data = exportacion::whereIn('id', $id)->orderby('eta', 'ASC')->orderby('cliente', 'ASC')->orderby('motonave', 'ASC')->orderby('consignatario', 'ASC')->get();

              $pdf = Pdf::loadView('pdf.pdfestatus', compact('data'))->setPaper('a4', 'landscape');

                return response()->streamDownload(function () use ($pdf) {
                    // Aquí simplemente se debe llamar a la función que genera el PDF.
                    echo $pdf->stream(); // o cualquier método que use para obtener el contenido del PDF
                }, 'exportacionestatus.pdf');
            }

        } catch (Exception $e) {

            $this->dispatch('errormensaje', 'error',  'Error', $e->getMessage());
        }
    }




    public function exportcarpeta()
    {
        $id = $this->getSelected();

        $this->clearSelected();
        if (count($id) > 0) {
            return Excel::download(new ReportExport($id), 'plantillacarpeta.xlsx');
        }
    }

    #[On('datosActualizados')]
    public function builder(): Builder
    {
        $query = Exportacion::query()->where(function ($query) {

            $query->wherenotin('estatus', [3])
                ->ORwhere('estatus', null);
        })
            ->orderby('eta', 'ASC')->orderby('motonave', 'ASC')
            ->orderby('cliente', 'ASC')->orderby('consignatario', 'ASC');

        return $query;
    }
}
