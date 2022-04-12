<?php

namespace App\Http\Livewire\Admin\Projects;

use App\Models\Project;
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
            Column::make('Possui repertório', 'has_songbook_string')
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy('has_songbook', $direction);
                })
                ->searchable()
        ];
    }
    public function query(): Builder
    {
        return Project::query();
    }
    public function getTableRowUrl($row): string
    {
        return route('admin.projects.show', $row->id );
    }
}
