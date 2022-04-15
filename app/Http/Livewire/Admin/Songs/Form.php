<?php

namespace App\Http\Livewire\Admin\Songs;

use App\Models\Song;
use Livewire\Component;
use App\Models\Songbook;
use App\Models\SongSongbook;
use Illuminate\Support\Facades\DB;

class Form extends Component
{

    public Song $song;
    public $update = false, $songbooks, $checkboxes;
    public array $songbooks_relation = [];
    public $btnForward = false, $btnBackward = false;
    public $rules = [
        'song.title' => 'required',
        'song.performer' => 'required',
        'songbooks_relation' => 'sometimes'
    ];
    private function checkButtons() {
        if($this->nextSong() != null) {
            $this->btnForward = true;
        } 
        if($this->previousSong() != null) {
            $this->btnBackward = true;
        }
    }
    private function nextSong() {
        return Song::where('id', '>', $this->song->id)->orderBy('id', 'asc')->first();
    }
    private function previousSong() {
        return Song::where('id', '<', $this->song->id)->orderBy('id', 'desc')->first();
    }
    public function forward() {
        if($this->nextSong() != null) {
            return redirect()->route('admin.songs.show', $this->nextSong()->id);
        }
    }
    public function backward() {
        if($this->previousSong() != null) {
            return redirect()->route('admin.songs.show', $this->previousSong()->id);
        }
    }
    public function store() {
        $this->validate();
        $this->song->save();
        $this->storeSongbooksRelations();
        $this->setReturn();
    }
    private function storeSongbooksRelations() {
        foreach($this->songbooks_relation as $key => $relation) {
            if($relation) {
                $this->checkNewRelation($key);
            } else {
                $this->checkOutdatedRelation($key);
            }
        }
    }
    private function checkNewRelation($id) {
        $relation = $this->getRelation($id);
        if($relation == null) {
            SongSongbook::create([
                'song_id' => $this->song->id,
                'songbook_id' => $id
            ]);
        }
    }
    private function checkOutdatedRelation($id) {
        $relation = $this->getRelation($id);
        if($relation) {
            $relation->delete();
        }
    }
    private function getRelation($id) {
        return SongSongbook::where('song_id', $this->song->id)->where('songbook_id', $id)->first();
    }
    private function setReturn() {
        if($this->update) {
            session()->flash('message', 'Música editada com sucesso!');            
            return redirect()->route('admin.songs.show', $this->song->id);
        }
        session()->flash('message', 'Música adicionada com sucesso ao repertório!');
        return redirect()->route('admin.songs');

    }
    public function delete() {
        if(!$this->song->setlists->isEmpty()) {
            session()->flash('message', 'Ops! Esta música pertence a algum repertório');
            session()->flash('status', 'danger');
            return redirect()->route('admin.songs.show', $this->song->id);
        }
        $this->song->delete();
        session()->flash('message', 'Música excluída com sucesso!');
        return redirect()->route('admin.songs');
    }
    public function mount($song = null) {
        $this->songbooks = Songbook::all();
        
        if(isset($song)) {
            $this->checkButtons();
            $this->update = true;
            return $this->getSong($song);   
        }
        return $this->makeSong();
    }
    private function getSong($song) {
        $this->song = $song;
        $ids = $this->song->songbooks->pluck('id')->toArray();
        $this->songbooks_relation = array_fill_keys($ids, true);
        $this->update = true;
    }
    private function makeSong() {
        $ids = $this->songbooks->pluck('id')->toArray();
        $this->songbooks_relation = array_fill_keys($ids, false);
        return $this->song = Song::make();
        
    }
    public function render()
    {
        return view('livewire.admin.songs.form');
    }
}
