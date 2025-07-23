<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthViewController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});
Route::resource( 'posts',PostController::class) -> middleware(['auth']);

Route::get('/jwt-demo', function () {
    return view('auth-demo');
});

Route::get('/register', [AuthViewController::class, 'showRegisterForm']);
Route::post('/register', [AuthViewController::class, 'register']);

Route::get('/login2', [AuthViewController::class, 'showLoginForm']);
Route::post('/login', [AuthViewController::class, 'login']);
// Route::get('/me', [AuthViewController::class, 'me'])->middleware('web'); // For demo purposes
Route::get('/me', function () {
    return view('auth.me');
});
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
