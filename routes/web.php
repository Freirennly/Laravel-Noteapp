<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoteController;

// Halaman utama
Route::get('/hello', function () {
    return 'Hello, Laravel!';
});

// Resource routes untuk kategori dan catatan
Route::resource('categories', CategoryController::class);
Route::resource('notes', NoteController::class);
Route::patch('/notes/{id}/toggle-pin', [NoteController::class, 'togglePin'])->name('notes.togglePin');
Route::get('/test', [App\Http\Controllers\TestController::class, 'index']);
Route::get('/', [NoteController::class, 'index'])->name('notes.index');
