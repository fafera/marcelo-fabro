<?php

namespace App\Http\Livewire\Admin\Setlists;

use App\Models\CustomMoment;
use App\Models\Song;
use App\Models\Quote;
use App\Models\Moment;
use App\Models\Setlist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    public Song $songs;
    public $moments;
    public Quote $quote;
    public $search = [];
    public $results = [];
    public $data = [];
    public $custom_moment;
    public $arraySize;
    protected $listeners = ['setCustomSong'];
    public $rules = [
        'search.*.query' => 'required',
        'custom_moment.*' => 'sometimes'
    ];
    public $messages = [
        'search.*.query.required' => 'Por favor, preencha todos os momentos.'
    ];
    public function mount()
    {
        $this->moments = Moment::all();
        // foreach ($this->moments as $moment) {
        //     $this->search[$moment->id]['query'] = null;
        // }
        $this->arraySize = count($this->moments);
    }

    public function store()
    {
        unset($this->results);
        $this->validate();
        if (count($this->data) === $this->arraySize) {
            $this->saveSetlist();
            session()->flash('message', 'Seu repertório foi cadastrado com sucesso!');
            return redirect()->route('admin.dashboard');
        }
        return $this->addError('search.*.query', 'Ops! Acho que algumas músicas são inválidas.');
    }
    private function saveSetlist() {
        if(isset($this->data)) {
            $this->saveSongs();
            $this->saveCustomMoment();
        }
    }
    private function saveCustomMoment() {
        if(isset($this->custom_moment)) {
            CustomMoment::create([
                'title' => $this->custom_moment['title'],
                'description' => $this->custom_moment['description'],
                'quote_id' => auth()->user()->client->quote->first()->id,
            ]);
        }
    }
    private function saveSongs() {
        foreach($this->data as $register) {
            $storeData = [
                'moment_id' => $register['moment_id'],
                'quote_id' => auth()->user()->client->quote->first()->id,
            ];
            if(isset($register['custom_song'])) {
                $storeData['custom_song_id'] = $register['song_id'];
            } else {
                $storeData['song_id'] = $register['song_id'];
            }
            Setlist::create($storeData);
        }


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
        $search = Song::where('title', 'like', '%' . $query . '%')->get();
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
        $this->data[$song['moment_id']] = ['song_id' => $song['id'], 'moment_id' => $song['moment_id'], 'custom_song' => 1];
        $this->search[$song['moment_id']]['query'] = $song['title'] . " - " . $song['performer'];
    }
    public function render()
    {
        return view('livewire.admin.setlists.create');
    }
}
