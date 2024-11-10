<?php

namespace App\Livewire;

use App\Exports\ExportInfo;
use App\Models\Estatus;
use App\Models\exportacion;
use App\Models\Tipo;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Maatwebsite\Excel\Facades\Excel;

class ExportTable extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDisabled();
        $this->setFiltersVisibilityStatus(false);
        $this->setPerPageVisibilityStatus(false);
        $this->setPerPageAccepted([30]);
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
            'updatemasivo' => 'Actualizar',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('id')->excludeFromColumnSelect()->hideIf(true)
                ->sortable(),
            Column::make('expediente')->collapseAlways(),
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
            Column::make('linea')
                ->sortable()->collapseAlways(),
            Column::make('envio')
                ->sortable()
                ->format(function ($value, $row) {
                    $resultadoss = Tipo::query()
                        ->orderByRaw("id = ? DESC", [$row->envio])
                        ->get();

                    return view('livewire.estatus', [
                        'options' => $resultadoss,
                        'valor' => 'tenvio',
                        'id' => $row->id,
                        'actual' => $value,
                    ]);
                }),
            Column::make('estatus')
                ->sortable()
                ->format(function ($value, $row) {


                    return view('livewire.estatus', [
                        'options' => Estatus::orderByRaw("id = ? DESC", [$value])->get(),
                        'valor' => 'testatus',
                        'id' => $row->id,
                        'actual' => $value,
                    ]);
                }),
            Column::make('obs')->secondaryHeader($this->getFilterByKey('obs'))->collapseAlways(),

            Column::make('Actions')->label(
                fn($row, Column $column) => view('livewire.estatus', [
                    'valor' => 'BOTON',
                    'id' => $row->id,
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

        ];
    }


    public function export()
    {
        $id = $this->getSelected();

        $this->clearSelected();
        if(count($id) > 0){
            return Excel::download(new ExportInfo($id), 'datosexportacion.xlsx');

        }
    }



    public function updatemasivo()
    {
        $id = $this->getSelected();

        if(count($id) > 0){
            $this->dispatch('editarmasivamente', $id);
        }
    }



    public function builder(): Builder
    {
        $query = Exportacion::query()->where('estatus', '!=', 3)->orderby('motonave','ASC')
        ->orderby('cliente','ASC')->orderby('eta','ASC');

        return $query;
    }
}
