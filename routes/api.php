<?php

use App\Http\Controllers\ObstacleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// O Laravel aplica automaticamente o prefixo '/api' a estas rotas
Route::middleware('guest')->group(function () {
    Route::post('/sign-up', [UserController::class, 'signUp'])->name('signup');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('obstacles')->name('api.obstacles.')->group(function () {
        Route::post('/create', [ObstacleController::class, 'createObstacle'])->name('create');
    });
});