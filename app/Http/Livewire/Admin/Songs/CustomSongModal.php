<?php

namespace App\Http\Livewire\Admin\Songs;

use Livewire\Component;
use App\Models\CustomSong;
use Illuminate\Support\Facades\Auth;

class CustomSongModal extends Component
{
    public $moment_id, $title, $performer;
    public $listeners = ['setMomentId'];
    public $rules = [
        'moment_id' => 'required', 
        'title' => 'required',
        'performer' => 'required'
    ];
    public $messages = [
        '*' => 'Por favor, preencha todos os campos.'
    ];
    public function render()
    {
        return view('livewire.admin.songs.custom-song-modal');
    }   
    public function setMomentId($id) {
        $this->moment_id = $id;
    }
    public function store() {
        $this->validate();
        $customSong = new CustomSong([
            'title' => $this->title,
            'performer' => $this->performer,
            'moment_id' => $this->moment_id,
            'user_id' => Auth::id()
        ]);
        $customSong->save();
        $this->emit('setCustomSong', $customSong);
    }
}
