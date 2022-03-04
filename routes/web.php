<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\BaseController;
use App\Http\Controllers\Admin\SongsController;
use App\Http\Controllers\Admin\QuotesController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\ContractsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClientPageController;
use App\Http\Controllers\Admin\SetlistsController;

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
Auth::routes();
Route::get('/', [BaseController::class, 'index'])->name('front.index');
Route::post('/', [BaseController::class, 'request'])->name('front.quote.request');
Route::get('/criar-minha-pagina/{slug}', [ClientPageController::class, 'generate'])->name('front.create-page');
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/quotes', [QuotesController::class, 'index'])->name('admin.quotes');
    Route::get('/admin/quotes/{id}', [QuotesController::class, 'show'])->name('admin.quotes.show');
    Route::get('/admin/pages/create/quote/{id}', [ClientPageController::class, 'createFromQuote'])->name('admin.pages.create-from-quote');
    Route::get('/admin/pages', [ClientPageController::class, 'index'])->name('admin.pages');
    Route::get('/admin/pages/{id}', [ClientPageController::class, 'show'])->name('admin.pages.show');
    Route::get('/admin/clients', [ClientsController::class, 'index'])->name('admin.clients');
    Route::get('/admin/clients/{id}', [ClientsController::class, 'show'])->name('admin.clients.show');
    Route::get('/admin/contracts/generate/{quote_id}', [ContractsController::class, 'generate'])->name('admin.contracts.generate');
    Route::get('/admin/contracts', [ContractsController::class, 'index'])->name('admin.contracts');
    Route::get('/admin/contracts/{id}', [ContractsController::class, 'show'])->name('admin.contracts.show');
    Route::get('/admin/songs', [SongsController::class, 'index'])->name('admin.songs');
    Route::get('/admin/songs/create', [SongsController::class, 'create'])->name('admin.songs.create');
    Route::get('/admin/songs/{id}', [SongsController::class, 'show'])->name('admin.songs.show');
    Route::get('/admin/setlists', [SetlistsController::class, 'index'])->name('admin.setlists');
    Route::get('/admin/setlists/show/{quote_id}', [SetlistsController::class, 'show'])->name('admin.setlists.show');
});
Route::middleware(['auth', 'roles:user|admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/setlist/create', [SetlistsController::class, 'create'])->name('admin.setlists.create');
    Route::get('/admin/setlist/self', [SetlistsController::class, 'self'])->name('admin.setlists.self');
    Route::get('/admin/contract/self', [ContractsController::class, 'self'])->name('admin.contracts.self');
});


