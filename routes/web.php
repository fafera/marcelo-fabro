<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QuotesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\BaseController;
use GuzzleHttp\Middleware;
use Illuminate\Database\Console\Migrations\BaseCommand;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BaseController::class, 'index'])->name('front.index');
Route::post('/', [BaseController::class, 'request'])->name('front.quote.request');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/quotes', [QuotesController::class, 'index'])->name('admin.quotes');
    Route::get('/admin/quotes/teste', [QuotesController::class, 'index'])->name('admin.quotes.teste');
});

require __DIR__.'/auth.php';
