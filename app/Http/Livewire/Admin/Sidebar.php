<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class Sidebar extends Component
{
    private $modules;
    //private $slugPosition = 3;
    private $slugPosition = 2;
    public function mount() {
        if(auth()->user()) {
            $this->modules = collect([
                ['id'=> 'dashboard-li', 'name' => 'admin.dashboard' , 'route' => route('admin.dashboard'), 'text' => 'Dashboard', 'icon' => 'nc-bank'],
                ['id'=> 'quotes-li', 'name' => 'admin.quotes', 'route' => route('admin.quotes'), 'text' => 'Orçamentos', 'icon' => 'nc-paper'],
                //['name' => 'admin.pages', 'route' => route('admin.pages'), 'text' => 'Páginas de confirmação', 'icon' => 'nc-check-2'],
                ['id'=> 'clients-li', 'name' => 'admin.clients', 'route' => route('admin.clients'), 'text' => 'Clientes', 'icon' => 'nc-circle-10'],
                //['name' => 'admin.contracts', 'route' => route('admin.contracts'), 'text' => 'Contratos', 'icon' => 'nc-single-copy-04'],
                ['id'=> 'songs-li' ,'name' => 'admin.songs', 'route' => route('admin.songs'), 'text' => 'Músicas', 'icon' => 'nc-note-03'],
                ['id'=> 'songbooks-li', 'name' => 'admin.songbooks', 'route' => route('admin.songbooks'), 'text' => 'Repertório', 'icon' => 'nc-bullet-list-67'],
                ['id'=> 'projects-li','name' => 'admin.projects', 'route' => route('admin.projects'), 'text' => 'Projetos', 'icon' => 'nc-briefcase-24'],
                ['id'=> 'moments-li','name' => 'admin.moments', 'route' => route('admin.moments'), 'text' => 'Momentos', 'icon' => 'nc-image'],
                ['id'=> 'payments-li','name' => 'admin.payments', 'route' => route('admin.payments'), 'text' => 'Pagamentos', 'icon' => 'nc-money-coins']
            ]);
        } else {
            $slug = $this->getSlug();
            $this->modules = collect([
                ['id'=> 'index-li','name' => 'information.index' , 'route' => route('information.index', $slug), 'text' => 'Dashboard', 'icon' => 'nc-bank'],
                ['id'=> 'client-li','name' => 'information.client', 'route' => route('information.client', $slug), 'text' => 'Dados Cadastrais', 'icon' => 'nc-single-02'],
                ['id'=> 'setlist-li', 'name' => 'information.setlist', 'route' => route('information.setlist', $slug), 'text' => 'Repertório', 'icon' => 'nc-note-03'],
                ['id'=> 'contract-li','name' => 'information.contract', 'route' => route('information.contract', $slug), 'text' => 'Contrato', 'icon' => 'nc-single-copy-04'],
                ['id' => 'rider-li', 'name'=> 'information.rider', 'route' => route('information.rider', $slug), 'text' => 'Rider de palco', 'icon' => 'nc-ruler-pencil']
            ]);
        }
        $this->checkActiveModule();
    }
    private function getSlug() {
        $url = parse_url(url()->current());
        $url = explode('/', $url['path']);
        return $url[$this->slugPosition];
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
