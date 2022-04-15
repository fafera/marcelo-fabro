<?php

use App\Http\Controllers\Debug;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Livewire\Admin\Songbooks\Export;
use App\Http\Controllers\Front\BaseController;
use App\Http\Controllers\Admin\SongsController;
use App\Http\Controllers\Admin\QuotesController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\MomentsController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\SetlistsController;
use App\Http\Controllers\Admin\ContractsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SongbooksController;
use App\Http\Controllers\Admin\ClientPageController;
use App\Http\Controllers\Front\InformationController;

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
Route::get('/debug', [Debug::class, 'index']);
Auth::routes();
Route::get('/', [BaseController::class, 'index'])->name('front.index');
Route::get('/jazzexpress', [BaseController::class, 'jazz'])->name('front.jazz');
Route::post('/', [BaseController::class, 'request'])->name('front.quote.request');
Route::get('/pdf/stream/{file_path}', [PDFController::class, 'stream'])->name('pdf.stream');
Route::get('/criar-minha-pagina/{slug}', [ClientPageController::class, 'generate'])->name('front.create-page');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/quotes', [QuotesController::class, 'index'])->name('admin.quotes');
    Route::get('/admin/quotes/create/{id}', [QuotesController::class, 'create'])->name('admin.quotes.create');
    Route::get('/admin/quotes/{id}', [QuotesController::class, 'show'])->name('admin.quotes.show');
    Route::get('/admin/pages/create/quote/{id}', [ClientPageController::class, 'createFromQuote'])->name('admin.pages.create-from-quote');
    Route::get('/admin/pages', [ClientPageController::class, 'index'])->name('admin.pages');
    Route::get('/admin/pages/{id}', [ClientPageController::class, 'show'])->name('admin.pages.show');
    Route::get('/admin/clients', [ClientsController::class, 'index'])->name('admin.clients');
    Route::get('/admin/clients/create', [ClientsController::class, 'create'])->name('admin.clients.create');
    Route::get('/admin/clients/{id}', [ClientsController::class, 'show'])->name('admin.clients.show');
    Route::get('/admin/clients/event-page/{client_id}', [ClientsController::class, 'eventPage'])->name('admin.clients.event-page');
    Route::get('/admin/contracts/generate/{quote_id}', [ContractsController::class, 'generate'])->name('admin.contracts.generate');
    Route::get('/admin/contracts', [ContractsController::class, 'index'])->name('admin.contracts');
    Route::get('/admin/contracts/{id}', [ContractsController::class, 'show'])->name('admin.contracts.show');
    Route::post('/admin/contracts/upload', [ContractsController::class, 'upload'])->name('admin.contracts.upload');
    Route::get('/admin/moments', [MomentsController::class, 'index'])->name('admin.moments');
    Route::get('/admin/moments/create', [MomentsController::class, 'create'])->name('admin.moments.create');
    Route::get('/admin/moments/{id}', [MomentsController::class, 'show'])->name('admin.moments.show');
    Route::get('/admin/songs', [SongsController::class, 'index'])->name('admin.songs');
    Route::get('/admin/songs/custom', [SongsController::class, 'customSongs'])->name('admin.songs.custom');
    Route::get('/admin/songs/create', [SongsController::class, 'create'])->name('admin.songs.create');
    Route::get('/admin/songs/{id}', [SongsController::class, 'show'])->name('admin.songs.show');
    Route::get('/admin/setlists', [SetlistsController::class, 'index'])->name('admin.setlists');
    //Route::get('/admin/setlists/create/{quote_id}', [SetlistsController::class, 'create'])->name('admin.setlists.create');
    Route::get('/admin/setlists/show/{quote_id}', [SetlistsController::class, 'show'])->name('admin.setlists.show');
    Route::get('/admin/payments/{contract_id}', [PaymentsController::class, 'show'])->name('admin.payments.show');
    Route::get('/admin/payments', [PaymentsController::class, 'index'])->name('admin.payments');
    Route::get('/admin/projects', [ProjectsController::class, 'index'])->name('admin.projects');
    Route::get('/admin/projects/create', [ProjectsController::class, 'create'])->name('admin.projects.create');
    Route::get('/admin/projects/{id}', [ProjectsController::class, 'show'])->name('admin.projects.show');
    Route::get('/admin/songbooks', [SongbooksController::class, 'index'])->name('admin.songbooks');
    Route::get('/admin/songbooks/create', [SongbooksController::class, 'create'])->name('admin.songbooks.create');
    Route::get('/admin/songbooks/{id}', [SongbooksController::class, 'show'])->name('admin.songbooks.show');
    Route::get('/admin/songbooks/export/{id}', Export::class)->name('admin.songbooks.export');
    
});
Route::prefix('informacoes/{slug}')->group(function() {
    Route::get('/', [InformationController::class, 'index'])->name('information.index');
    Route::get('/repertorio', [InformationController::class, 'setlist'])->name('information.setlist');
    Route::get('/contrato', [InformationController::class, 'contract'])->name('information.contract');
    Route::get('/cliente', [InformationController::class, 'client'])->name('information.client');
});


