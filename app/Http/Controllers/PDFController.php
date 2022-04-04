<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function stream($file) {
        return response()->file(Storage::disk('public')->path('pdf/').$file);

    }
}
