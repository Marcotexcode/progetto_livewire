<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('home'); });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Progetti
Route::middleware('auth')->group(function () {
    Route::get('/counter',  [App\Http\Controllers\Progetti\ProgettiController::class, 'counter'])->name('counter');
    Route::get('/comment',  [App\Http\Controllers\Progetti\ProgettiController::class, 'comment'])->name('comment');
});