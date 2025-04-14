<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// status
Route::get('/status', function () {
    return ApiResponse::success('API is running');
});

// clients
Route::apiResource('client', ClientController::class);

// auth
Route::post('/login', [AuthController::class, 'login']);