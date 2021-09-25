<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('{code}', [UrlController::class, 'show'])->name('codes.show');

Route::post('url',[UrlController::class, 'store'])->name('codes.store');
