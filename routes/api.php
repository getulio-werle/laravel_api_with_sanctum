<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// status
Route::get('/status', function () {
    return response()->json(
        [
            'status' => 'ok',
            'message' => 'API is running'
        ],
        200
    );
});

// clients
Route::apiResource('client', ClientController::class);

// auth
Route::post('/login', [AuthController::class, 'login']);