<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuotesController extends Controller
{
    public function index() {   

        return view('admin.pages.quotes', ['quotes' => Quote::all()]);
    }   
}
