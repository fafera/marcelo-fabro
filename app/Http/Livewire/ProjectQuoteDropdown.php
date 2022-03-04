<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectQuoteDropdown extends Component
{
    public $projects;
    public $quote;
    public $selected;
    protected $rules = [
        'quote.project_id' => 'required'
    ];
    public function mount($quote = null) {
        if($quote !== null) {
            $this->quote = $quote;
        }
        $this->projects = Project::all();
    }
    public function render()
    {
        return view('livewire.project-quote-dropdown');
    }
}
