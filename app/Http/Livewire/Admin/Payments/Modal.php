<?php

namespace App\Http\Livewire\Admin\Payments;

use Exception;
use App\Models\Payment;
use Livewire\Component;
use App\Models\Contract;

class Modal extends Component
{
    public Contract $contract; 
    public $value;
    public $rules = [
        'value' => 'required'
    ];
    public function mount(Contract $contract) {
        $this->contract = $contract;
    }
    public function render()
    {
        //$this->resetErrorBag();
        return view('livewire.admin.payments.modal');
    }
    public function store() {
        $this->verifyValue();
        $this->validate();
        $payment = Payment::create([
            'value' => $this->value,
            'contract_id' => $this->contract->id
        ]);
        session()->flash('message', 'Pagamento adicionado com sucesso!');
        return redirect()->route('admin.clients.show', $this->contract->client->id);
        // dd($this->contract->value);
        // dd($this->value);
    }
    private function verifyValue() {
        if($this->value > $this->contract->remainingAmount) {
            throw new Exception('Valor inválido');
        }
    }
}