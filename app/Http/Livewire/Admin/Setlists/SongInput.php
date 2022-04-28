<?php

namespace App\Http\Livewire\Admin\Setlists;

use App\Models\Song;
use App\Models\Moment;
use Livewire\Component;
use Illuminate\Support\Str;

class SongInput extends Component
{
    public $moment;
    public $songs;
    public $search = [];
    public $results = [];
    public $data = [];
    public function mount($moment) {
        $this->moment = $moment;
    }
    public function render()
    {
        return view('livewire.admin.setlists.song-input');
    }
    public function resetSearch($moment)
    {
        $this->search[$moment]['query'] = "";
        $this->results[$moment] = null;
        unset($this->data[$moment]);
    }
    public function setSong($songId, $momentId)
    {
        $this->data[$momentId] = ['song_id' => $songId, 'moment_id' => $momentId];
        $this->resetResults($momentId);
        $song = Song::findOrFail($songId);
        $this->search[$momentId]['query'] = $song->fullString;
    }
    public function resetResults($key)
    {
        $this->results[$key] = null;
    }
    public function updatedSearch($query, $key)
    {
        //$search = Song::where('title', 'like', '%' . $query . '%')->get();
        $search = $this->songs->filter(function($item) use($query){
            if(Str::contains(strtolower($item['title']), $query)) {
                return $item;
            }
        });
        $key = $this->getKeyValue($key);
        $this->results[$key] = $search;
    }
    private function getKeyValue($key)
    {
        $key = explode('.', $key);
        return $key[0];
    }
    public function showCustomSongModal($moment)
    {
        $this->resetResults($moment);
        $this->dispatchBrowserEvent('showCustomSongModal', ['moment' => $moment]);
    }
    public function setCustomSong($song)
    {
        $this->dispatchBrowserEvent('closeCustomSongModal');
        $this->data[$song['moment_id']] = ['title' => $song['title'], 'performer' => $song['performer'],  'moment_id' => $song['moment_id'], 'custom_song' => 1];
        $this->search[$song['moment_id']]['query'] = $song['title'] . " - " . $song['performer'];
    }
}
