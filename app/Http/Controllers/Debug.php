<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Debug extends Controller
{
    public function index() {
        return view('jobs.pdf.songbook', ['title' => 'Rhay Santos & Jazz Express']);
    }
}
