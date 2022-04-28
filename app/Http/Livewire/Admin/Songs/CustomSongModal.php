<?php

namespace App\Http\Livewire\Admin\Songs;

use Livewire\Component;
use App\Models\CustomSong;
use Illuminate\Support\Facades\Auth;

class CustomSongModal extends Component
{
    public $dataKey, $title, $performer;
    // public $moment_id;
    public $listeners = ['setDataKey'];
    public $rules = [
        // 'moment_id' => 'required', 
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
    public function setDataKey($key) {
        $this->dataKey = $key;
    }
    public function store() {
        $this->validate();
        $customSong =  [
            'title' => $this->title,
            'performer' => $this->performer,
            'key' => $this->dataKey,
        ];
        //$customSong->save();
        $this->resetFields();
        $this->emit('setCustomSong', $customSong);
    }
    private function resetFields() {
        $this->reset(['title', 'performer', 'dataKey']);
    }
}
