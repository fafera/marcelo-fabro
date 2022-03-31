<?php

namespace App\Http\Livewire\Admin\Moments;

use App\Models\Moment;
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
            Column::make('Momento', 'title')
                ->sortable()
                ->searchable(),
            Column::make('Ordem', 'order')
                ->sortable()
                ->searchable()
        ];
    }
    public function query(): Builder
    {
        return Moment::query();
    }
    public function getTableRowUrl($row): string
    {
        return route('admin.moments.show', $row->id );
    }
}
