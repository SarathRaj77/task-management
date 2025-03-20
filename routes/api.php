<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{id}/assign', [TaskController::class, 'assign']);
    Route::put('/tasks/{id}/complete', [TaskController::class, 'complete']);
    Route::get('/tasks', [TaskController::class, 'index']);
});
