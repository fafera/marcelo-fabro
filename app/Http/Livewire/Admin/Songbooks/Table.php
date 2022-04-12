<?php

namespace App\Http\Livewire\Admin\Songbooks;

use App\Models\Songbook;
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
            Column::make('Título', 'title')
                ->sortable()
                ->searchable(),
            Column::make('Possui vocal', 'singable_string')
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy('singable', $direction);
                })
                ->searchable()
        ];
    }
    public function query(): Builder
    {
        return Songbook::query();
    }
    public function getTableRowUrl($row): string
    {
        return route('admin.songbooks.show', $row->id );
    }
}
