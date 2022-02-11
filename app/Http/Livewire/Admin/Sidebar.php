<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Collection;
use Livewire\Component;
use PhpParser\Builder\Function_;
use Illuminate\Support\Facades\Route;

class Sidebar extends Component
{
    private $modules;

    public Function mount() {
        $this->modules = collect([
            ['name' => 'admin.dashboard' , 'route' => route('admin.dashboard'), 'text' => 'Dashboard', 'icon' => 'nc-bank'],
            ['name' => 'admin.quotes', 'route' => route('admin.quotes'), 'text' => 'Orçamentos', 'icon' => 'nc-paper']
        ]);
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
