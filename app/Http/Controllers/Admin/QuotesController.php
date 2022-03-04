<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuotesController extends Controller
{
    public function index() {   
        return view('admin.pages.quotes.index', ['quotes' => Quote::all()]);
    }   
    public function show($id) {
        $quote = Quote::findOrFail($id);
        return view('admin.pages.quotes.show', ['quote' => Quote::findOrFail($id) ]);
    }
    public function update($id, Request $request) {
        $quote = Quote::findOrFail($id);
        return $quote->fill($request->except('_token'))->save();
    }
}
