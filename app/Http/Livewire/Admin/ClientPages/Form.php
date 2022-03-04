<?php

namespace App\Http\Livewire\Admin\ClientPages;

use App\Models\ClientPage;
use Livewire\Component;

class Form extends Component
{
    public $page, $quoteInfoString;
    protected $rules = [
        'page.slug' => 'required',
        'page.quote_id' => 'required',
    ];
    public function mount(ClientPage $page) {
        $this->page = $page;
        $this->quoteInfoString = $this->page->quote->quoteString;
    }
    public function update() {
        $this->validate();
        $this->page->save();
        session()->flash('message', 'Página de confirmação do cliente editada com sucesso!');
    }
    public function delete() {
        $this->page->forceDelete();
        session()->flash('message', 'Página de confirmação do cliente excluída com sucesso!');
        return redirect()->route('admin.pages');
    }
    public function render() {
        
        return view('livewire.admin.client-pages.form');
    }
    
}
