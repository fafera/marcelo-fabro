<?php

namespace App\Http\Controllers\Admin;

use App\Models\Song;
use App\Models\Quote;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index() {
        $info = collect();
        if(auth()->user()->role === "admin") {
            $info->quotes = Quote::all()->count();
            $info->clients = Client::all()->count();
            $info->songs = Song::all()->count();
        } else {
            $info->contract = auth()->user()->contract;
            $info->setlist = auth()->user()->quote->setlist->first();
        }

        return view('admin.pages.dashboard', ['info' => $info]);
    }
}
