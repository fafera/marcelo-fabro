<?php

namespace App\Http\Livewire\Admin\Moments;

use App\Models\Moment;
use Livewire\Component;

class Form extends Component
{
    public Moment $moment;
    public $update = false;
    public $rules = [
        'moment.title' => 'required',
        'moment.order' => 'required'
    ];
    public function render()
    {
        return view('livewire.admin.moments.form');
    }
    public function store() {
        $this->validate();
        $this->moment->save();
        $this->setReturn();
    }
    public function mount($moment = null) {
        if(isset($moment)) {
            $this->update = true;
            return $this->moment = $moment;
        }
        return $this->moment = Moment::make();
    }
    private function setReturn() {
        if($this->update) {
            session()->flash('message', 'Momento editado com sucesso!');            
            return redirect()->route('admin.moments.show', $this->moment->id);
        }
        session()->flash('message', 'Momento adicionado com sucesso!');
        return redirect()->route('admin.moments');
    }
    public function delete() {
        $this->moment->delete();
        session()->flash('message', 'Momento excluído com sucesso!');
        return redirect()->route('admin.moments');
    }
}
