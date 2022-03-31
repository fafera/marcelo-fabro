<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SongbooksController extends Controller
{
    public function index() {
        return view('admin.pages.songbooks.index');
    }
    public function create() {
        return view('admin.pages.songbooks.show', ['id' => null]);
    }
    public function show($id) {
        return view('admin.pages.songbooks.show', ['id' => $id]);
    }
}
