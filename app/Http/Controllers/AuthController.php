<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            return response()->json(
                [
                    'error' => 'Unauthorized'
                ],
                401
            );
        }

        // authenticate user
        $user = auth()->user();
        $token = $user->createToken($user->name)->plainTextToken;

        return response()->json(
            [
                'token' => $token
            ],
            200
        );
    }
}
