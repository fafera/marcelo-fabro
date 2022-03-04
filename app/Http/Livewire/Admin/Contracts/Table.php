<?php

namespace App\Http\Livewire\Admin\Contracts;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class Table extends DataTableComponent
{
    public bool $paginationEnabled = true;
    public function columns(): array
    {
        return [
            Column::make('Nome', 'client.name')
                ->sortable()
                ->searchable(),
            Column::make('Orçamento', 'quote.infoString')
                ->sortable(),
            Column::make('Valor', 'value_br')
                ->sortable(),
        ];
    }
    
    public function query(): Builder
    {
        return Contract::query();
    }
    public function getTableRowUrl($row): string
    {
        return route('admin.contracts.show', $row->id );
    }
}
