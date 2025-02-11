<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

use App\Http\Controllers\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


// 
use App\Livewire\Documents\CreateDocument;
Route::get('/documentos/crear', CreateDocument::class)->name('documents.create');

//
use App\Livewire\Documents\DocumentTable;
Route::get('/documentos', DocumentTable::class)->name('documents.index');

//
use App\Livewire\Documents\DocumentShow;
Route::get('/documentos/ver/{id}', DocumentShow::class)->name('documents.show');

//
use App\Livewire\Documents\EditDocument;
Route::get('/documentos/editar/{id}', EditDocument::class)->name('documents.edit');

//
use App\Livewire\Files\UploadFileDerivation;
/* Route::get('/archivos/subir/{id}', UploadFileDerivation::class)->name('files.upload'); */
Route::get('archivos/subir/{documentoId}', UploadFileDerivation::class)->name('files.upload');


use App\Http\Controllers\FileController;
Route::get('/archivos/descargar/{id}', [FileController::class, 'download'])->name('files.download');
Route::get('/archivos/subir/{id}', UploadFileDerivation::class)->name('files.upload');




use App\Livewire\Users\UserTable;
Route::get('/usuarios', UserTable::class)->name('users.index');





use App\Livewire\Oficinas\OficinaTable;
Route::get('/oficinas', OficinaTable::class)->name('oficinas.oficina-table');



require __DIR__.'/auth.php';
