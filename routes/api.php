<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// O Laravel aplica automaticamente o prefixo '/api' a estas rotas
Route::middleware('guest')->group(function () {
    Route::post('/sign-up', [UserController::class, 'signUp'])->name('api.user.signup');
});