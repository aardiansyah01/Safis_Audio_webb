<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\LandingController;

Route::get('/', function () {
    return view('landing.index');
});

Route::middleware([
    'auth',
    'subscription'
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

});

Route::middleware([
    'auth',
    'subscription'
])->group(function () {

    Route::get('/history', function () {
        return view('history');
    })->name('history');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/subscription', [SubscriptionController::class, 'index']);
});

Route::get('/audio-processing', function () {
    return "Audio Processing Page";
})->middleware(['auth', 'subscription']);

require __DIR__.'/auth.php';
