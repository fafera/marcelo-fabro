<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    public function index() {
        return view('admin.pages.projects.index');
    }
    public function create() {
        return view('admin.pages.projects.show', ['id' => null]);
    }
    public function show($id) {
        return view('admin.pages.projects.show', ['id' => $id]);
    }
}
