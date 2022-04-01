<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Models\Address;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AddressForm extends Component
{
    public Address $address;
    public $client, $cepDigits = 8, $cepErrorMessage = "Atenção! O CEP informado é inválido.";
    public $rules = [ 
        'address.cep' => 'required',
        'address.street' => 'required',
        'address.city' => 'required',
        'address.uf' => 'required',
        'address.district' => 'required',
        'address.cep' => 'required',
        'address.number' => 'required',
        'address.complement' => 'sometimes',
        'address.client_id' => 'required',

    ];
    public function mount($client) {
        if($client->address != null) {
            $this->address = $client->address;
        } else {
            $this->address = Address::make();
            $this->address->client_id = $client->id;
        }
    }
    public function render()
    {
        return view('livewire.admin.clients.address-form');
    }
    public function store() {
        $this->address->save();
        session()->flash('message', 'Endereço editado com sucesso!');
        return redirect()->route('admin.clients.show', $this->client->id);
    }
    public function getCepInfo() {
        if($this->verifyCep() === true) { 
            try {
                $request = Http::get('https://viacep.com.br/ws/'.$this->address->cep.'/json');
            } catch (\Throwable $th) {
                throw new \Exception("Ops! Algo deu errado. Tente de novo.");
            }
            
            $request = $request->json();
            if(!isset($request['erro'])) {
                $this->address->street = $request['logradouro'];
                $this->address->district = $request['bairro'];
                $this->address->uf = $request['uf'];
                $this->address->city = $request['localidade']."-".$request['uf'];
            } else {
                return $this->addError('cep', $this->cepErrorMessage);
            }
        } 
    }
    private function verifyCep() {
        $this->address->cep = preg_replace("/[^0-9]/", "", $this->address->cep);
        if(strlen($this->address->cep) !== $this->cepDigits) {
            return $this->addError('cep', $this->cepErrorMessage);
        }
        return true;
    }
}
