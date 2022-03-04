<?php

namespace App\Http\Livewire\Admin\Setlists;

use App\Models\Setlist;
use Livewire\Component;

class Show extends Component
{
    public $quote, $setlist;
    public function mount($quote) {
        $this->quote = $quote;
    }
    public function render()
    {
        return view('livewire.admin.setlists.show');
    }
}
