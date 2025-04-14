<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiResponse;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // login attempt
        $email = $request->email;
        $password = $request->password;
        $attempt = auth()->attempt([
            'email' => $email,
            'password' => $password
        ]);
        if (!$attempt) {
            return ApiResponse::unauthorized();
        }

        // authenticate user
        $user = auth()->user();
        $token = $user->createToken($user->name)->plainTextToken;

        return ApiResponse::success([
            'name' => $user->name,
            'email' => $user->email,
            'token' => $token
        ]);
    }
}
