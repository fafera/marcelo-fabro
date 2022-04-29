<?php

namespace App\Http\Controllers\Front;

use App\Models\ClientEventPage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class InformationController extends Controller
{
    protected $information;
    public $songbook;
    public function __construct()
    {
        $this->verifySongbookEdit();
        
        //$this->information = ClientEventPage::where('slug', request()->route()->parameters['slug'])->first();
    }
    private function verifySongbookEdit() {
        //dd(request()->route()->parameters);
        if(isset(request()->route()->parameters['slug'])) {
            $page = ClientEventPage::where('slug', request()->route()->parameters['slug'])->first();
            return $this->songbook =  $page->quote->project->has_songbook;
        }
        return false;
        
        
    }
    public function index($slug) {
        $eventPage = ClientEventPage::where('slug', request()->route()->parameters['slug'])->first();
        return view('front.pages.index', ['information' => $eventPage, 'songbook' => $this->songbook]);
    }
    public function setlist($slug) {
        $eventPage = ClientEventPage::where('slug', request()->route()->parameters['slug'])->first();
        return view('admin.pages.setlists.show_self', ['quote' => $eventPage->quote, 'songbook' => $this->songbook]);
    }
    public function contract($slug) {
        $eventPage = ClientEventPage::where('slug', request()->route()->parameters['slug'])->first();
        return view('admin.pages.contracts.show', ['contract' => $eventPage->contract, 'songbook' => $this->songbook]);
    }
    public function client($slug) {
        $eventPage = ClientEventPage::where('slug', request()->route()->parameters['slug'])->first();
        return view('admin.pages.clients.show_self', ['client' => $eventPage->client, 'songbook' => $this->songbook]);
    }
    public function rider($slug) {
        $eventPage = ClientEventPage::where('slug', request()->route()->parameters['slug'])->first();
        return view('admin.pages.rider.show', ['quote' => $eventPage->quote]);
    }
}
