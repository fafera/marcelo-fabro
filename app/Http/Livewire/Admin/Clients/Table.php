<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Models\Quote;
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
            Column::make('Data', 'quote.date')
                ->sortable(function(Builder $query, $direction) {
                    $query->select('clients.*')
                    ->from('clients')
                    ->orderBy('quotes.date', $direction);
                    if($this->checkJoin($query, 'quotes') == false) {
                        $query->join('quotes','clients.id', '=', 'quotes.client_id');
                    }
                    return $query;
                })
                ->searchable(),
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Horário', 'quote.time')
                ->sortable(function(Builder $query, $direction) {
                    $query->select('clients.*')
                    ->from('clients')
                    ->orderBy('quotes.time', $direction);
                    if($this->checkJoin($query, 'quotes') == false) {
                        $query->join('quotes','clients.id', '=', 'quotes.client_id');
                    }
                    return $query;
                })
                ->searchable(),
            Column::make('Local', 'quote.place')
                ->sortable(function(Builder $query, $direction) {
                    $query->select('clients.*')
                    ->from('clients')
                    ->orderBy('quotes.place', $direction);
                    if($this->checkJoin($query, 'quotes') == false) {
                        $query->join('quotes','clients.id', '=', 'quotes.client_id');
                    }
                    return $query;
                })
                ->searchable(),
            Column::make('Projeto', 'quote.project.title')
                ->sortable(function(Builder $query, $direction) {
                    $query->select('clients.*')
                        ->from('clients')
                        ->join('projects', 'projects.id', '=', 'quotes.project_id')
                        ->orderBy('quotes.place', $direction);
                    if($this->checkJoin($query, 'quotes') == false) {
                        $query->join('quotes','clients.id', '=', 'quotes.client_id');
                    }
                    return $query;
                })
                ->searchable(),
            Column::make('Contrato', 'contract.file')
                ->format(function($value) {
                    if($value !== null) {
                        return "<span class='badge bg-success'>Contrato gerado</span>";
                    } else {
                        return "<span class='badge bg-danger'>Aguardando contrato</span>";
                    }
                })->asHtml(),
            Column::make('Repertório', 'quote')
                ->format(function($quote) {
                    if($quote == null) {
                        return "<span class='badge bg-danger'>Aguardando orçamento</span>";
                    }
                    $project = $quote->project;
                    $setlist = $quote->setlist;
                    if(!$setlist->isEmpty()) {
                        return "<span class='badge bg-success'>Repertório registrado</span>";
                    } elseif($project->has_songbook == 0) {
                        return "<span class='badge bg-success'>Sem repertório customizável</span>";
                    } else {
                        return "<span class='badge bg-danger'>Aguardando repertório</span>";
                    }
                })->asHtml(),
        ];
    }
    private function checkJoin($query, $table) {
        return collect($query->getQuery()->joins)->pluck('table')->contains($table);
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
