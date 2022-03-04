<?php

namespace App\Http\Livewire\Admin\Quotes;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class Table extends DataTableComponent
{
    public bool $paginationEnabled = true;
    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Data', 'date')
                ->sortable()
                ->searchable(),
            Column::make('Horário', 'time')
                ->sortable()
                ->searchable(),
            Column::make('Local', 'place')
                ->sortable()
                ->searchable()
        ];
    }
    
    public function query(): Builder
    {
        return Quote::query();
    }
    public function getTableRowUrl($row): string
    {
        return route('admin.quotes.show', $row->id );
    }
}
