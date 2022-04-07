<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function show($id) {
        
        
    }
    public function index() {
        return view('admin.pages.payments.index');
    }
}
