<?php

namespace App\Http\Controllers\Front;

use App\Models\ClientEventPage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class InformationController extends Controller
{
    protected $information;
    public function __construct()
    {
        //$this->information = ClientEventPage::where('slug', request()->route()->parameters['slug'])->first();
    }
    public function index($slug) {
        $eventPage = ClientEventPage::where('slug', request()->route()->parameters['slug'])->first();
        return view('front.pages.index', ['information' => $eventPage]);
    }
    public function setlist($slug) {
        $eventPage = ClientEventPage::where('slug', request()->route()->parameters['slug'])->first();
        return view('admin.pages.setlists.show', ['quote' => $eventPage->quote]);
    }
    public function contract($slug) {
        $eventPage = ClientEventPage::where('slug', request()->route()->parameters['slug'])->first();
        return view('admin.pages.contracts.show', ['contract' => $eventPage->contract]);
    }
}
