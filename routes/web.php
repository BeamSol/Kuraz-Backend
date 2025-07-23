<?php

// use App\Http\Controllers\PostController;
// use Illuminate\Support\Facades\Route;
// use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('welcome');
// })->name('home');

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('dashboard', function () {
//         return Inertia::render('dashboard');
//     })->name('dashboard');
// });
// Route::resource( 'posts',PostController::class) -> middleware(['auth']);

// require __DIR__.'/settings.php';
// require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

Route::get('/login-view', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/me-view');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials.',
    ]);
});

Route::middleware('auth')->get('/me-view', function () {
    return view('me', ['user' => Auth::user()]);
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login-view');
});
