<?php

namespace App\Livewire;

use App\Models\Estatus;
use App\Models\exportacion;
use App\Models\Tipo;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Livewire\Attributes\On;

class ExportTable extends DataTableComponent
{

    #[On('cambio')]
    public function cambioestatus($valor, $id, $tipo)
    {

        if($tipo == 'envio'){
            Exportacion::where('id',$id)->update([
                'envio' => $valor
            ]);
        }


        if($tipo == 'estatus'){
            Exportacion::where('id',$id)->update([
                'estatus' => $valor
            ]);
        }


    }


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
    }

    public function columns(): array
    {
        return [
            Column::make('id')->excludeFromColumnSelect()->hideIf(true)
                ->sortable(),
            Column::make('expediente')->collapseAlways(),
            Column::make('consignatario')
                ->sortable(),
            Column::make('bl')
                ->sortable(),
            Column::make('tipo')->collapseAlways()
                ->sortable(),
            Column::make('contenedor')
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
                                       $resultados = Tipo::query()
                        ->orderByRaw("id = ? DESC", [$row->envio])
                        ->get();

                  return view('livewire.estatus', [
                        'options' => $resultados,
                        'valor' => 'envio',
                        'id' => $row->id,
                        'actual' => $row->envio,
                    ]);
                }),
            Column::make('estatus')
                ->sortable()
                ->format(function ($value, $row) {
                    $resultados = Estatus::query()
                        ->orderByRaw("id = ? DESC", [$row->estatus])
                        ->get();
                    return view('livewire.estatus', [
                        'options' => $resultados,
                        'valor' => 'estatus',
                        'id' => $row->id,
                        'actual' => $row->estatus,
                    ]);
                }),
            Column::make('obs')->secondaryHeader($this->getFilterByKey('obs'))->collapseAlways(),
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

            TextFilter::make('Motonave')
                ->config([
                    'placeholder' => 'Buscar Motonave',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('motonave', 'like', '%' . $value . '%');
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


    public function builder(): Builder
    {
        $query = Exportacion::query()->where('estatus','!=','3');

        // Debugging
        logger('Query before applying filters:', [$query->toSql()]);

        return $query;
    }
}
