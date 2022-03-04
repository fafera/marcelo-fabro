<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Models\ClientPage;
use App\Models\Quote;
use Livewire\Component;

class CreatePageForm extends Component
{
    public $quote;
    public $quotes;
    public $slug;
    public $rules = [
        'quote' => 'sometimes',
        'slug' => 'required'
    ];
    public function render()
    {
        return view('livewire.admin.clients.create-page-form');
    }
    public function mount($quote = null) {
        $this->quotes = Quote::all();
        if($quote !== null) {
            $this->quote = $quote->id;
        }
    }
    public function store() {
        $this->validate();
        $clientPage = ClientPage::create([
            'quote_id' => $this->quote,
            'slug' => $this->slug
        ]);
        session()->flash('message', 'Página de confirmação do cliente criada com sucesso!');
        return redirect()->route('admin.pages');
    }
}
