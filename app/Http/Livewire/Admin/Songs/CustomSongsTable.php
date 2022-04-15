<?php

namespace App\Http\Livewire\Admin\Songs;

use App\Models\CustomSong;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class CustomSongsTable extends DataTableComponent
{
    public bool $paginationEnabled = true;
    public bool $responsive = true;
    public string $defaultSortColumn = 'title';
    public string $defaultSortDirection = 'asc';   
    public function columns(): array
    {
        return [
            Column::make('Música', 'title')
                ->sortable()
                ->searchable(),
            Column::make('Artista', 'performer')
                ->sortable()
                ->searchable(),
            Column::make('Cliente', 'quote.client.name')
        ];
    }
    
    public function query(): Builder
    {
        return CustomSong::query();
    }
    public function getTableRowUrl($row): string
    {
        return route('admin.setlists.show', $row->setlist->quote->id );
    }
    
}
