<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SetlistsController extends Controller
{
    public function create($id) {
        return view('admin.pages.setlists.create', ['quote' => Quote::findOrFail($id)]);
    }
    public function index() {
        return view('admin.pages.setlists.index');
    }
    public function show($quoteId) {
        return view('admin.pages.setlists.show', ['quote' => Quote::findOrFail($quoteId)]);
    }
}
