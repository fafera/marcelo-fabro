<?php

namespace App\Http\Livewire\Admin\Riders;

use App\Models\Quote;
use App\Models\Rider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Modal extends Component
{
    use WithFileUploads;
    public Quote $quote;
    public Rider $rider;
    public $update = false, $file;
    public $rules = [
        'file' => 'required'
    ];
    public function mount(Quote $quote) {
        $this->quote = $quote;
        if($this->quote->rider != null) {
            $this->update = true;
            return $this->rider = $this->quote->rider;
           
        }
        return $this->rider = Rider::make();
    }
    public function render()
    {
        return view('livewire.admin.riders.modal');
    }
    public function store() {
        $this->validate();
        if($this->file->isValid()) {
            $filename = $this->mountFilename();
            $this->file->storeAs('public/rider', $filename);
            $this->rider->file = $filename;
            $this->rider->quote_id = $this->quote->id;
            $this->rider->save();
            session()->flash('message', 'Rider alterado com sucesso!');
            return redirect()->route('admin.quotes.show', $this->quote->id);
        } 
        session()->flash('message', 'Ops. Algo deu errado, tente novamente!');
        session()->flash('status', 'danger');
        return redirect()->route('admin.quotes.show', $this->quote->id);
    }
    private function mountFilename() {
        return "rider_".$this->quote->id.".".$this->file->extension();
    }
    public function download() {
        return Storage::disk('local')->download('public/rider/'.$this->rider->file);
    }
}
