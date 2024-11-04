<?php

namespace App\Livewire;

use App\Models\exportacion;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class ExportTable extends DataTableComponent
{
    protected $model = exportacion::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('expediente')
                ->sortable(),
            Column::make('consignatario')
                ->sortable(),
            Column::make('bl')
                ->sortable(),
            Column::make('tipo')
                ->sortable(),
            Column::make('contenedor')
                ->sortable(),
            Column::make('eta')
                ->sortable(),
            Column::make('obs')
                ->sortable(),
            Column::make('motonave')
                ->sortable(),
            Column::make('cliente')
                ->sortable(),
            Column::make('linea')
                ->sortable(),
            Column::make('envio')
                ->sortable(),
            Column::make('estatus')
                ->sortable(),
        ];
    }


    public function filters(): array
{
    return [
        DateFilter::make('Fecha','eta'),
    ];
}
}
