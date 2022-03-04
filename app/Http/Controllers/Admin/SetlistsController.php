<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SetlistsController extends Controller
{
    public function create() {
        return view('admin.pages.setlists.create');
    }
    public function index() {
        return view('admin.pages.setlists.index');
    }
    public function show($quoteId) {
        $quote = Quote::findOrFail($quoteId);
        return view('admin.pages.setlists.show', ['quote' => $quote]);
    }
}
