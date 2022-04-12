<?php

namespace App\Http\Livewire\Admin\Payments;

use App\Helpers\FinancialHelper;
use Exception;
use App\Models\Payment;
use Livewire\Component;
use App\Models\Contract;

class Modal extends Component
{
    public Contract $contract; 
    public $value;
    public $date;
    
    public $rules = [
        'value' => 'required',
        'date' => 'required'
    ];
    protected $messages = [
        '*.required' => 'Por favor, preencha todos os campos.'
    ];
    public function mount(Contract $contract) {
        $this->contract = $contract;
    }
    public function render()
    {
        return view('livewire.admin.payments.modal');
    }
    public function store() {
        $this->verifyValue();
        $this->validate();
        $payment = Payment::create([
            'value' => $this->value,
            'date' => $this->date,
            'contract_id' => $this->contract->id
        ]);
        session()->flash('message', 'Pagamento adicionado com sucesso!');
        return redirect()->route('admin.clients.show', $this->contract->client->id);
        // dd($this->contract->value);
        // dd($this->value);
    }
    private function verifyValue() {
        if(FinancialHelper::formatBRLtoDecimal($this->value) > $this->contract->remainingAmount) {
            session()->flash('message', 'Ops. Valor Inválido!!');
            session()->flash('status', 'danger');
            return redirect()->route('admin.clients.show', $this->contract->client->id);
        }
    }
}
