<?php

namespace App\Http\Livewire\Admin\ClientPages;

use App\Models\Client;
use App\Models\ClientPage;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class Table extends DataTableComponent
{
    public bool $paginationEnabled = true;
    public function columns(): array
    {
        return [
            Column::make('Slug')
                ->sortable()
                ->searchable(),
            Column::make('Orçamento', 'quote.quote_string')
                ->sortable()
                ->searchable(),
        ];
    }
    
    public function query(): Builder
    {
        return ClientPage::query()->withTrashed();
    }
    public function getTableRowUrl($row): string
    {
        return route('admin.pages.show', $row->id );
    }
}
