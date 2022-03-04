<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class ClientPageModal extends Component
{
    public $title = "modal";
    protected $listeners  = ['showClientModal' => 'showClientModal'];
    public function render()
    {
        return view('livewire.front.client-page-modal');
    }
    public function showClientModal() {
        $this->emit('showModal', 'front.client-page-modal');

    }
}
