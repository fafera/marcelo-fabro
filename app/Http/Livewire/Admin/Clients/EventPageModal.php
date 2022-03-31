<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;
use App\Models\ClientEventPage;

class EventPageModal extends Component
{
    public $listeners = ['show'];
    public Client $client;
    public ClientEventPage $eventPage;

    public $rules = [
        'eventPage.slug' => 'required',
        'eventPage.*' => 'required'
    ];
    public function  mount(Client $client) {
        $this->client = $client;
        if($this->client->eventPage !== null) {
           $this->eventPage = $this->client->eventPage;
        } else {
            $this->eventPage = ClientEventPage::make();
            $this->eventPage->client_id = $this->client->id;
            
        }
    }
    public function render()
    {
        return view('livewire.admin.clients.event-page-modal');
    }
    public function store() {
        if($this->client->quote == null) {
            session()->flash('message', 'A página de evento foi editada com sucesso!');
            session()->flash('status', 'danger');
            return redirect()->route('admin.clients.show', $this->client->id);
        }
        $this->eventPage->quote_id = $this->client->quote->id;
        $this->eventPage->save();
        session()->flash('message', 'A página de evento foi editada com sucesso!');
        return redirect()->route('admin.clients.show', $this->client->id);
    }
}
