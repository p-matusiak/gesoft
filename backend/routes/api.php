<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\RequestController;
use App\Http\Controllers\Api\ContactController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/services', [ContactController::class, 'services']);
Route::get('/portfolio', [ContactController::class, 'portfolio']);
Route::post('/contact', [ContactController::class, 'store']);

// Auth routes
Route::post('/admin/login', [AuthController::class, 'login']);

// Protected admin routes
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/stats', [RequestController::class, 'stats']);
    Route::get('/requests', [RequestController::class, 'index']);
    Route::get('/requests/{contactRequest}', [RequestController::class, 'show']);
    Route::patch('/requests/{contactRequest}', [RequestController::class, 'update']);
    Route::post('/requests/{contactRequest}/reply', [RequestController::class, 'reply']);
});
