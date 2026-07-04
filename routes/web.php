<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PdfController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Frontend Routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/agenda', [PublicController::class, 'agendas'])->name('public.agendas');
Route::get('/agenda/{id}', [PublicController::class, 'agendaDetail'])->name('public.agenda.detail');
Route::get('/tentang-kami', [PublicController::class, 'about'])->name('public.about');
Route::get('/kontak', [PublicController::class, 'contact'])->name('public.contact');

// Manual Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Backend Routes (Only Accessible After Login)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Admin Dashboard
    Route::get('/dashboard', [AgendaController::class, 'dashboard'])->name('admin.dashboard');
    
    // PDF Export Route
    Route::get('/agenda/export-pdf', [PdfController::class, 'exportPdf'])->name('admin.agenda.pdf');

    // Agenda CRUD Routes
    Route::resource('agenda', AgendaController::class, [
        'names' => [
            'index' => 'admin.agenda.index',
            'create' => 'admin.agenda.create',
            'store' => 'admin.agenda.store',
            'show' => 'admin.agenda.show',
            'edit' => 'admin.agenda.edit',
            'update' => 'admin.agenda.update',
            'destroy' => 'admin.agenda.destroy',
        ]
    ]);

    // Page Settings Routes
    Route::get('/pages/edit', [PageController::class, 'edit'])->name('admin.pages.edit');
    Route::put('/pages/update', [PageController::class, 'update'])->name('admin.pages.update');
});
