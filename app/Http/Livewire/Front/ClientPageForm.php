<?php

namespace App\Http\Livewire\Front;

use App\Models\User;
use App\Models\Quote;
use App\Models\Client;
use App\Models\Address;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;

class ClientPageForm extends Component
{
    public $name, $cpf, $cep, $street, $complement, $number, $district, $city, $uf, $quote_id, $client, $page, $quote;
    private $cepDigits = 8, $cepErrorMessage = "Atenção! O CEP informado é inválido.", $role = "user", $allStored = false;
    protected $listeners = ['sendConfirm' => 'confirm', 'storeUser' => 'storeUser'];
    public $rules = [
        'quote_id' => 'required',
        'name' => 'required',
        'cpf' => 'required',
        'cep' => 'required',
        'street' => 'required',
        'complement' => 'sometimes',
        'number' => 'required',
        'district' => 'required',
        'city' => 'required',
        'uf' => 'required'
    ];

    public function render()
    {
        return view('livewire.front.client-page-form');
    }
    public function getConfirmation() {
        $this->validate();
        $this->dispatchBrowserEvent('openConfirmationModal');
    }
    public function confirm() {
        $this->dispatchBrowserEvent('closeConfirmationModal');
        $this->dispatchBrowserEvent('openStoreModal');
    }
    protected function deletePage() {
        $this->page->delete();
    }
    public function storeUser($password) {
        $user = User::create([
            'name' => $this->name,
            'email' => $this->quote->email,
            'password' => $password,
            'role' => $this->role
        ]);
        $user->save();
        $this->storeClient($user->id);
    }
   
    protected function storeClient($userId) {
        $this->client = Client::create([
            'name' => $this->name,
            'cpf' => $this->cpf,
            'phone' => $this->quote->phone,
            'email' => $this->quote->email,
            'user_id' => $userId,
            'quote_id' => $this->quote->id
        ]);
        $this->client->save();
        $this->storeAddress();
        //$this->storeClientQuote();
       
        
    }
    protected function storeClientQuote(){
        DB::table('client_quote')->insert([
            'client_id' => $this->client->id,
            'quote_id' => $this->quote->id,
            'created_at' =>  \Carbon\Carbon::now(), 
            'updated_at' => \Carbon\Carbon::now(), 
        ]);
        $this->storeAddress();
    }
    protected function storeAddress() {
        $address = Address::create([
            'client_id' => $this->client->id, 
            'cep' => $this->cep,
            'street' => $this->street,
            'city' => $this->city,
            'uf' => $this->uf, 
            'district' => $this->district,
            'number' => $this->number,
            'complement' => $this->complement
        ]);
        $this->allStored();
    }   
    private function allStored() {
        $this->deletePage();
        return redirect()->to('/login');
    }
    public function getCepInfo() {
        if($this->verifyCep() === true) { 
            try {
                $request = Http::get('https://viacep.com.br/ws/'.$this->cep.'/json/unicode');
            } catch (\Throwable $th) {
                throw new \Exception("Ops! Algo deu errado. Tente de novo.");
            }
            
            $request = $request->json();
            if(!isset($request['erro'])) {
                $this->street = $request['logradouro'];
                $this->district = $request['bairro'];
                $this->uf = $request['uf'];
                $this->city = $request['localidade']."-".$request['uf'];
            } else {
                return $this->addError('cep', $this->cepErrorMessage);
            }
        } 
    }
    private function verifyCep() {
        $this->cep = preg_replace("/[^0-9]/", "", $this->cep);
        if(strlen($this->cep) !== $this->cepDigits) {
            return $this->addError('cep', $this->cepErrorMessage);
        }
        return true;
    }
    public function mount($page) {
        $this->page = $page;
        $this->quote = Quote::findOrFail($page->quote_id);
        $this->quote_id = $page->quote_id;
    }
}
