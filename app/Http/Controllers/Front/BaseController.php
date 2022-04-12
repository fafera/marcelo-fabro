<?php

namespace App\Http\Controllers\Front;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function index() {
        return view('front.index');
    }
    public function request(Request $request) {
        return Quote::create($request->all());
        dd($request->all());
    }
    public function jazz() {
        return view('front.jazz');
    }
}
