<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class ClientPageConfirmModal extends Component
{
    public function render()
    {
        return view('livewire.front.client-page-confirm-modal');
    }
    public function confirm() {
        $this->emit('sendConfirm');
    }
}
