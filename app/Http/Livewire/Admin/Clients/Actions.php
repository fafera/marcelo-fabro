<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;

class Actions extends Component
{
    public Client $client; 
    public $quoteButton = [], $contractButton = [], $setlistButton = [], $eventPageButton = [], $paymentButton, $riderButton;
    public function render()
    {
        return view('livewire.admin.clients.actions');
    }
    public function mount($client = null) {
        $this->client = $client;
        
        $this->setQuoteButton();
        
    }
    private function setQuoteButton() {
        if($this->client->quote !== null) {
            $this->quoteButton['route'] = route('admin.quotes.show', $this->client->quote->id);
            $this->quoteButton['text'] = 'Visualizar Orçamento';
            $this->quoteButton['class'] = 'btn-success';
            $this->setEventPageButton();
            $this->setContractButton();
            $this->setSetlistButton();
            $this->setRiderButton();
        } else {
            $this->quoteButton['route'] = route('admin.quotes.create', $this->client->id);
            $this->quoteButton['text'] = 'Adicionar Orçamento';
            $this->quoteButton['class'] = 'btn-warning';
        }
    }
    private function setEventPageButton() {
        if($this->client->eventPage !== null) {
            $this->eventPageButton['route'] = '#';
            $this->eventPageButton['text'] = 'Página do evento';
            $this->eventPageButton['class'] = 'btn-success';
        } else {
            $this->eventPageButton['route'] = '#';
            $this->eventPageButton['text'] = 'Criar página do evento';
            $this->eventPageButton['class'] = 'btn-warning';
        }
    }
    private function setContractButton() {
        if($this->client->contract !== null) {
            $this->contractButton['route'] = route('admin.contracts.show', $this->client->contract->id);
            $this->contractButton['text'] = 'Visualizar Contrato';
            $this->contractButton['class'] = 'btn-success';
            $this->setPaymentButton();
        } else {
            $this->contractButton['route'] = route('admin.contracts.generate', $this->client->quote->id);
            $this->contractButton['text'] = 'Gerar contrato';
            $this->contractButton['class'] = 'btn-warning';
        } 
    }
    private function setSetlistButton() {
        if($this->client->setlistSongs->first() !== null) {
            $this->setlistButton['route'] = route('admin.setlists.show', $this->client->quote->id);
            $this->setlistButton['text'] = 'Visualizar Repertório';
            $this->setlistButton['class'] = 'btn-success';
        } elseif($this->client->quote !== null && $this->client->quote->project->has_songbook == 1) {
            $this->setlistButton['route'] = route('admin.setlists.show', $this->client->quote->id);
            $this->setlistButton['text'] = 'Gerar Repertório';
            $this->setlistButton['class'] = 'btn-warning';
        } else {
            $this->setlistButton['route'] = '#';
            $this->setlistButton['text'] = 'Repertório não customizável';
            $this->setlistButton['class'] = 'btn-success';
            $this->setlistButton['prop'] = 'disabled';
        }
    }
    private function setPaymentButton() {
        if($this->client->contract->isPaymentDone) {
            $this->paymentButton['route'] = '#';
            $this->paymentButton['text'] = 'Pagamento Realizado';
            $this->paymentButton['class'] = 'btn-success';
        } elseif (!$this->client->contract->payments->isEmpty()){
            $this->paymentButton['route'] = '#';
            $this->paymentButton['text'] = 'Pagamento parcial';
            $this->paymentButton['class'] = 'btn-warning';
        } else {
            $this->paymentButton['route'] = '#';
            $this->paymentButton['text'] = 'Aguardando pagamento';
            $this->paymentButton['class'] = 'btn-danger';
        } 
    }
    private function setRiderButton() {
        $this->riderButton['route'] = '#';
        if($this->client->quote->rider !== null) {
            $this->riderButton['text'] = 'Visualizar Rider';
            $this->riderButton['class'] = 'btn-success';
        } else {
            $this->riderButton['text'] = 'Aguardando Rider';
            $this->riderButton['class'] = 'btn-warning';
        } 
    }
}
