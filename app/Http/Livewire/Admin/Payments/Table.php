<?php

namespace App\Http\Livewire\Admin\Payments;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class Table extends DataTableComponent
{
    public bool $paginationEnabled = true;
    public bool $responsive = true;
    public string $defaultSortColumn = 'payments.date';
    public string $defaultSortDirection = 'desc';
    public function columns(): array
    {
        return [
            Column::make('Data', 'dateBR')
                ->sortable(function(Builder $query, $direction){
                    return $query->orderBy('payments.date', $direction);
                })
                ->searchable(function(Builder $query, $searchTerm){
                    return $query->orWhere('payments.date','like', '%'.$searchTerm.'%');
                }),
            Column::make('Valor', 'valueBRL')
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy('payments.value', $direction);
                })
                ->searchable(function(Builder $query, $searchTerm){
                    return $query->orWhere('payments.value', 'like', '%'.$searchTerm.'%');
                }),
            Column::make('Valor restante', 'contract.remainingAmountBRL')
                ->format(function($value) {
                    if($value !== false) {
                        return $value;
                    } else {
                        return "-";
                    }
                }),
            Column::make('Valor do contrato', 'contract.valueBRL'),
            Column::make('Cliente', 'contract.client.name')
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy('clients.name', $direction);
                })
                ->searchable(function(Builder $query, $searchTerm){
                    return $query->orWhere('clients.name', 'like', '%'.$searchTerm.'%');
                })
        ];
    }
    
    public function query(): Builder
    {
        return Payment::query()
            ->join('contracts', 'contracts.id', '=', 'payments.contract_id')
            ->join('clients', 'clients.id', '=', 'contracts.client_id');
    }
    // public function getTableRowUrl($row): string
    // {
    //     return route('admin.moments.show', $row->id );
    // }
}
