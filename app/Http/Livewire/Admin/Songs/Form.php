<?php

namespace App\Http\Livewire\Admin\Songs;

use App\Models\Song;
use Livewire\Component;

class Form extends Component
{

    public Song $song;
    public $update = false;
    public $rules = [
        'song.title' => 'required',
        'song.performer' => 'required'
    ];
    public function store() {
        $this->validate();
        $this->song->save();
        $this->setReturn();
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
        $this->song->delete();
        session()->flash('message', 'Música excluída com sucesso!');
        return redirect()->route('admin.songs');
    }
    public function mount($song = null) {
        return isset($song) ?  $this->getSong($song) : $this->makeSong();
    }
    private function getSong($song) {
        $this->song = $song;
        $this->update = true;
    }
    private function makeSong() {
        return $this->song = Song::make();
    }
    public function render()
    {
        return view('livewire.admin.songs.form');
    }
}
