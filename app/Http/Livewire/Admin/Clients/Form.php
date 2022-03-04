<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;

class Form extends Component
{
    public $client;
    public $rules = [
        'client.name' => 'required',
        'client.cpf' => 'required', 
        'client.phone' => 'required',
        'client.email' => 'required|email'
    ];
    public function mount(Client $client) {
        $this->client = $client;
    }
    public function update() {
        
        $this->validate();
        
        $this->client->save();
    }
    public function render()
    {
        return view('livewire.admin.clients.form');
    }
}
