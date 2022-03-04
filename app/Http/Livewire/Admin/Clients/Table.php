<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;


class Table extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Telefone', 'phone')
                ->sortable()
                ->searchable(),
            Column::make('CPF', 'cpf')
                ->sortable()
                ->searchable()
        ];
    }
    public function query(): Builder
    {
        return Client::query();
    }
    public function getTableRowUrl($row): string
    {
        return route('admin.clients.show', $row->id );
    }
    
}
