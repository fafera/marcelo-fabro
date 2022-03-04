<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Quote;
use App\Models\Contract;
use App\Http\Controllers\Controller;

class ContractsController extends Controller
{
    public function generate($id){ 
        return view('admin.pages.contracts.generator', ['quote' => Quote::findOrFail($id)]);

    }
    public function show($id) {
        return view('admin.pages.contracts.show', ['contract' => Contract::findOrFail($id)]);
    }
    public function index() {
        return view('admin.pages.contracts.index');
    }
}
