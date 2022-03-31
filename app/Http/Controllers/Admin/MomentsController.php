<?php

namespace App\Http\Controllers\Admin;

use App\Models\Moment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MomentsController extends Controller
{
    public function index() {
        return view('admin.pages.moments.index');
    }
    public function create() {
        return view('admin.pages.moments.create');
    }
    public function show($id) {
        return view('admin.pages.moments.show', ['moment' => Moment::findOrFail($id)]);
    }
}
