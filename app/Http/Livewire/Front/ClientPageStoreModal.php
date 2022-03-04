<?php

namespace App\Http\Livewire\Front;

use App\Models\Client;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ClientPageStoreModal extends Component
{
    public $password, $password_confirmation;
    public $rules = [
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'password_confirmation' => ['string', 'min:8']
    ];
    public function render()
    {
        return view('livewire.front.client-page-store-modal');
    }
    public function create() {
        $this->validate();
        $this->emit('storeUser', Hash::make($this->password));
    }
}
