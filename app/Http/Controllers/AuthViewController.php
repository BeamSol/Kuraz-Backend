<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthViewController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $response = Http::post(url('/api/register'), $request->only('name', 'email', 'password'));

        return redirect('/login')->with('response', $response->json());
    }

    public function login(Request $request)
{
    $response = Http::post(url('/api/login'), $request->only('email', 'password'));

    if ($response->ok()) {
        return response()->json([
            'token' => $response['authorisation']['token'],
            'user' => $response['user'],
        ]);
    }

    return response()->json(['error' => 'Login failed'], 401);
}



    public function me()
{
    return view('auth.me');
}

}

