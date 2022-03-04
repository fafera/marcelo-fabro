<?php

namespace App\Http\Livewire\Admin\Quotes;

use App\Models\Quote;
use App\Models\Project;
use Livewire\Component;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Redirect;

class Form extends Component
{
    public $quote;
    public $projects;
    protected $rules = [
        'quote.name' => 'required',
        'quote.email' => 'required|email',
        'quote.phone' => 'required',
        'quote.date' => 'required',
        'quote.time' => 'required',
        'quote.place' => 'required',
        'quote.project_id' => 'required',
        'quote.message' => 'sometimes'
    ];
    public function mount(Quote $quote) {
        $this->quote = $quote;
        $this->projects = Project::all();
    }
    public function update() {
        $this->formatDateTime();
        $this->validate();
        $this->quote->save();
        return session()->flash('message', 'O orçamento foi atualizado com sucesso!');

    }
    public function delete() {
        if($this->quote->clientPage !== null) {
            $this->quote->clientPage->forceDelete();
        }
        $this->quote->delete();
        session()->flash('message', 'O orçamento foi excluído com sucesso!');
        return redirect()->route('admin.quotes');
    }
    private function formatDateTime() {
        if(isset($this->quote->date))
            $this->quote->date = DateHelper::convertToDateFormat($this->quote->date);
        if(isset($this->quote->time))
            $this->quote->time = DateHelper::convertToTimeFormat($this->quote->time);
        
    }
    public function render() {
        return view('livewire.admin.quotes.form');
    }
    
}
