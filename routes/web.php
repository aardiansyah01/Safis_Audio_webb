<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AudioProcessingController;
use Midtrans\Config;
use Midtrans\Snap;

Route::get('/', function () {
    return view('landing.index');
});

Route::middleware([
    'auth',
    'subscription'
])->group(function () {

    Route::get(
        '/dashboard',
        [AudioProcessingController::class, 'index']
    )->name('dashboard');

    Route::post(
        '/audio/upload',
        [AudioProcessingController::class, 'upload']
    )->name('audio.upload');

    Route::post(
        '/audio/process/{id}',
        [AudioProcessingController::class, 'process']
    )->name('audio.process');

    Route::get(
        '/audio/download/{id}',
        [AudioProcessingController::class, 'download']
    )->name('audio.download');
    
    Route::post(
        '/audio/reprocess/{id}',
        [AudioProcessingController::class, 'reprocess']
    )->name('audio.reprocess');
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
    Route::post('/subscription/subscribe', [SubscriptionController::class, 'subscribe'])
    ->name('subscription.subscribe');
});

// Route::get(
//     '/audio-processing',
//     [AudioProcessingController::class, 'index']
// )->name('audio.processing');

Route::middleware('auth')->group(function () {

    Route::get('/subscription', [SubscriptionController::class, 'index']);

    Route::post('/subscription/buy/{plan}',
        [SubscriptionController::class, 'buy'])
        ->name('subscription.buy');
});

Route::get('/test-midtrans', function () {

    Config::$serverKey = config('services.midtrans.server_key');
    Config::$isProduction = config('services.midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => 'TEST-' . time(),
            'gross_amount' => 30000,
        ],

        'customer_details' => [
            'first_name' => 'Aditya',
            'email' => 'test@gmail.com',
        ]
    ];

    $snapToken = Snap::getSnapToken($params);

    return $snapToken;
});

require __DIR__.'/auth.php';
