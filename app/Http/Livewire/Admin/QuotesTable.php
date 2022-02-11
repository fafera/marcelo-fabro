<?php

namespace App\Http\Livewire\Admin;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class QuotesTable extends DataTableComponent
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
        ];
    }

    public function query(): Builder
    {
        return Quote::query();
    }
}
