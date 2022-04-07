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
        'client.cpf' => 'nullable', 
        'client.phone' => 'nullable',
        'client.email' => 'nullable|email'
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
        $this->checkAuthRedirect();
        
    }
    private function checkAuthRedirect() {
        if(auth()->user()) { 
            session()->flash('message', 'O cliente foi editado com sucesso!');
            return redirect()->route('admin.clients.show', $this->client);
        }
        session()->flash('message', 'Seus dados foram alterados com sucesso!');
        return redirect()->route('information.client', $this->client->eventPage->slug);
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
