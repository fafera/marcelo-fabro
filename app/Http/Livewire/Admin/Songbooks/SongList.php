<?php

namespace App\Http\Livewire\Admin\Songbooks;

use Livewire\Component;

class SongList extends Component
{
    public $songbook;
    public $list;
    public function render()
    {
        return view('livewire.admin.songbooks.song-list');
    }
    public function mount($songbook) {
        $this->songbook = $songbook;
        $this->list = $songbook->songs;
    }
}
