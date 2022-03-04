<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Quote;
use App\Models\ClientPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientPageController extends Controller
{
    public function index() {
        return view('admin.pages.client_pages.index', ['pages' => ClientPage::all()]);
    }
    public function show($id) {
        return view('admin.pages.client_pages.show', ['page' => ClientPage::withTrashed()->where('id',$id)->first()]);
    }
    public function createFromQuote($id) {
        return view('admin.pages.client_pages.create', ['quote' => Quote::findOrFail($id)]);
    }
    public function generate($slug) {
        $pageInfo = ClientPage::where('slug', $slug);
        if($pageInfo->first() !== null) {
            return view('front.create_page', ['page' => $pageInfo->first()]);
        }
        throw new \Exception("Página inválida");
    }
}
