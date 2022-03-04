<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class Sidebar extends Component
{
    private $modules;

    public Function mount() {
        if(auth()->user()->role === "admin") {
            $this->modules = collect([
                ['name' => 'admin.dashboard' , 'route' => route('admin.dashboard'), 'text' => 'Dashboard', 'icon' => 'nc-bank'],
                ['name' => 'admin.quotes', 'route' => route('admin.quotes'), 'text' => 'Orçamentos', 'icon' => 'nc-paper'],
                ['name' => 'admin.pages', 'route' => route('admin.pages'), 'text' => 'Páginas de confirmação', 'icon' => 'nc-check-2'],
                ['name' => 'admin.clients', 'route' => route('admin.clients'), 'text' => 'Clientes', 'icon' => 'nc-circle-10'],
                ['name' => 'admin.contracts', 'route' => route('admin.contracts'), 'text' => 'Contratos', 'icon' => 'nc-single-copy-04'],
                ['name' => 'admin.songs', 'route' => route('admin.songs'), 'text' => 'Músicas', 'icon' => 'nc-note-03'],
                ['name' => 'admin.setlists', 'route' => route('admin.setlists'), 'text' => 'Repertórios', 'icon' => 'nc-bullet-list-67']
            ]);
        } else {
            $this->modules = collect([
                ['name' => 'admin.dashboard' , 'route' => route('admin.dashboard'), 'text' => 'Dashboard', 'icon' => 'nc-bank'],
                ['name' => 'admin.setlists', 'route' => route('admin.setlists.self'), 'text' => 'Repertório', 'icon' => 'nc-note-03'],
                ['name' => 'admin.contracts', 'route' => route('admin.contracts.self'), 'text' => 'Contrato', 'icon' => 'nc-single-copy-04']
            ]);
        }
        $this->checkActiveModule();
    }
    private function checkActiveModule() {
        $modules = $this->modules->map(function ($item, $key) {
            if(Route::current()->named($item['name'].'*')) {
                $item['active'] = true;
            }
            return $item;
        });
        $this->modules = $modules;        
    }
    public function render()
    {
        return view('livewire.admin.sidebar', ['modules' => $this->modules]);
    }
}
