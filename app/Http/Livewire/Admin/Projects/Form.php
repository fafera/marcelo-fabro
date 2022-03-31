<?php

namespace App\Http\Livewire\Admin\Projects;

use App\Models\Project;
use Livewire\Component;

class Form extends Component
{
    public Project $project;
    public $title, $update = false;
    public $rules = [
        'project.title' => 'required',
        'project.has_songbook' => 'required'
    ];
    public function mount($id = null) {
        if($id !== null) {
            $this->project = Project::findOrFail($id);
            $this->title = "Detalhes de ".$this->project->title;
            $this->update = true;
        } else {
            $this->project = Project::make();
            $this->title = "Adicionar novo projeto";
        }
    }
    public function store() {
        $this->validate();
        $this->project->save();
        session()->flash('message', 'O projeto foi editado com sucesso!');
        return redirect()->route('admin.projects');
    }
    public function render()
    {
        return view('livewire.admin.projects.form');
    }
    public function delete() {
        if(!$this->project->quotes->isEmpty()) {
            session()->flash('message', 'Ops! O projeto tem orçamentos ativos.');
            session()->flash('status', 'danger');

            return redirect()->route('admin.projects.show', $this->project->id);
        }
        $this->project->delete();
        session()->flash('message', 'O projeto foi excluído com sucesso!');
        return redirect()->route('admin.projects');
    }
}
