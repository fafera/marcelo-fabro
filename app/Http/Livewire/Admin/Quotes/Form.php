<?php

namespace App\Http\Livewire\Admin\Quotes;

use App\Models\Quote;
use App\Models\Client;
use App\Models\Project;
use Livewire\Component;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Redirect;

class Form extends Component
{
    public $quote, $client, $projects, $update = false;
    protected $rules = [
        'quote.name' => 'required',
        'quote.email' => 'required|email',
        'quote.phone' => 'required',
        'quote.date' => 'required',
        'quote.time' => 'required',
        'quote.place' => 'required',
        'quote.city' => 'required', 
        'quote.project_id' => 'required',
        'quote.message' => 'sometimes',
        'quote.with_singer' => 'sometimes',
        'quote.client_id' => 'sometimes'
    ];
    public function mount($quote = null, $client = null) {
        if($quote !== null) {
            $this->quote = $quote;
            $this->update = true;
        } else {
            $this->client = $client;
            $this->quote = Quote::make();
            $this->quote->name = $this->client->name;
            $this->quote->phone = $this->client->phone;
            $this->quote->client_id = $this->client->id;
            $this->quote->email = $this->client->email;
        }
        $this->projects = Project::all();
    }
    public function update() {
        if($this->quote->with_singer == null) {
            $this->quote->with_singer = false;
        }
        $this->formatDateTime();
        $this->validate();        
        $this->quote->save();
        if(isset($this->client)) {
            session()->flash('message', 'O orçamento foi adicionado com sucesso!');
            return redirect()->route('admin.clients.show', $this->client->id);
        }
        return session()->flash('message', 'O orçamento foi atualizado com sucesso!');

    }
    public function delete() {
        //Deleta o cliente CASCADE
        $this->quote->client->delete();
        //$this->quote->delete();
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
