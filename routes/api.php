<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// status
Route::get('/status', function () {
    return ApiResponse::success('API is running');
})->middleware('auth:sanctum');

// clients
Route::apiResource('client', ClientController::class)->middleware('auth:sanctum');

// auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
