<?php

namespace App\Http\Livewire;

use App\Models\Quote;
use App\Models\Project;
use Livewire\Component;
use App\Helpers\DateHelper;

class QuoteForm extends Component
{
    public Quote $quote;
    public $success;
    protected $successMessage;

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
    ];
    protected $messages = [
        '*' => 'Confira os dados do formulário e tente novamente.',
    ];
    public function mount() {
        $this->quote = Quote::make();
    }
    private function getSuccessMessage() {
        return $this->successMessage =  "Seu orçamento foi solicitado com sucesso! Aguarde o contato via WhatsApp";
    }
    public function request() {
        $this->save();
        $this->success = $this->getSuccessMessage();
        $this->mount();
    }
    private function save() {
        $this->formatDateTime();
        if($this->quote->with_singer == null) {
            $this->quote->with_singer = false;
        }
        $this->validate();
        $this->quote->save();
    }
    private function formatDateTime() {
        if(isset($this->quote->date))
            $this->quote->date = DateHelper::convertToDateFormat($this->quote->date);
        if(isset($this->quote->time))
            $this->quote->time = DateHelper::convertToTimeFormat($this->quote->time);
        
    }
    public function render()
    {
        return view('livewire.front.quote-form', ['projects' => Project::all()]);
    }
}
