<?php

namespace App\Http\Livewire\Admin\Songs;

use App\Models\Song;
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
            Column::make('Música', 'title')
                ->sortable()
                ->searchable(),
            Column::make('Artista', 'performer')
                ->sortable()
                ->searchable()
        ];
    }
    public function query(): Builder
    {
        return Song::query();
    }
    public function getTableRowUrl($row): string
    {
        return route('admin.songs.show', $row->id );
    }
}
