<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors(), 422);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::guard('api')->login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'user'    => $user,
            'authorisation' => [
                'type'    => 'Bearer',
                'token'   => $token,
            ],
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = Auth::guard('api')->user();
        
        return response()->json([
            'message' => 'Login successful',
            'user'    => $user,
            'authorisation' => [
                'type'    => 'Bearer',
                'token'   => $token,
            ],
        ]);
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        return response()->json([
            'message' => 'Authenticated (JWT)',
            'user' => Auth::guard('api')->user()
        ]);
    }
}
