<?php

namespace App\Http\Livewire\Admin\Setlists;

use App\Models\Quote;
use App\Models\Client;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class Table extends DataTableComponent
{
    public bool $paginationEnabled = true;
    public bool $responsive = true;
    public function columns(): array
    {
        return [
            Column::make('Cliente', 'client.name')
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy(Client::select('name')->whereColumn('clients.name', 'clients.name'), $direction);
                })
                ->searchable(),
            Column::make('Data', 'date')
                ->sortable()
                ->searchable(),
            Column::make('Local', 'place')
                ->sortable()
                ->searchable()
        ];
    }
    public function query(): Builder
    {
        return Quote::query()->has('setlist');
    }
    public function getTableRowUrl($row): string
    {
        return route('admin.setlists.show', $row->id );
    }
}
