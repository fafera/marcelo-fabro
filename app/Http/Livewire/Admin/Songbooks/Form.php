<?php

namespace App\Http\Livewire\Admin\Songbooks;

use App\Models\Project;
use Livewire\Component;
use App\Models\Songbook;

class Form extends Component
{
    public Songbook $songbook;
    public $projects;
    public $title, $update = false;
    public $rules = [
        'songbook.title' => 'required',
        'songbook.project_id' => 'required'
    ];
    public function mount($id = null) {
        $this->projects = Project::where('has_songbook', '1')->get();
        if($id !== null) {
            $this->songbook = Songbook::findOrFail($id);
            $this->title = "Detalhes de ".$this->songbook->title;
            $this->update = true;
        } else {
            $this->songbook = Songbook::make();
            $this->songbook->singable = false;
            $this->title = "Adicionar novo repertório";
        }
    }
    public function store() {
        $this->validate();
        $this->songbook->save();
        session()->flash('message', 'O repertório foi editado com sucesso!');
        return redirect()->route('admin.songbooks');
    }
    public function render()
    {
        return view('livewire.admin.songbooks.form');
    }
    public function delete() {
        $this->songbook->delete();
        session()->flash('message', 'O repertório foi excluído com sucesso!');
        return redirect()->route('admin.songbooks');
    }
}
