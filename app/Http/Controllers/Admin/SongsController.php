<?php

namespace App\Http\Controllers\Admin;

use App\Models\Song;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SongsController extends Controller
{
    public function index() {
        return view('admin.pages.songs.index');
    }
    public function show($id) {
        return view('admin.pages.songs.show', ['song' => Song::findOrFail($id)]);
    }
    public function create() {
        return view('admin.pages.songs.create');
    }
}
