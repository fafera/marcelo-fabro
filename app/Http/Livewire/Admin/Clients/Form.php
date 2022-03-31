<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;

class Form extends Component
{
    public Client $client;
    public $update = false;
    public $rules = [
        'client.name' => 'required',
        'client.cpf' => 'required', 
        'client.phone' => 'required',
        'client.email' => 'required|email'
    ];
    public function mount($client = null) {
        if($client) {
            $this->client = $client;
            $this->update = true;
        } else {
            $this->client = Client::make();
        }
    }
    public function store() {
        $this->validate();
        $this->client->save();
        session()->flash('message', 'O cliente foi editado com sucesso!');
        return redirect()->route('admin.clients.show', $this->client);
    }
    public function render()
    {
        return view('livewire.admin.clients.form');
    }
    public function delete() {
        $this->client->delete();
        session()->flash('message', 'O cliente foi excluído com sucesso!');
        return redirect()->route('admin.clients');
    }
}
