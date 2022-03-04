<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    public function index() {
        return view('admin.pages.clients.index', ['clients' => Client::all()]);
    }
    public function show($id) {
        return view('admin.pages.clients.show', ['client' => Client::findOrFail($id) ]);
    }
}
