<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PortfolioController;
use App\Http\Resources\UserResource;

// public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/templates', [TemplateController::class, 'index']);
Route::get('/templates/{id}', [TemplateController::class, 'show']);

// protected Routes
Route::middleware('auth:sanctum')->group(function () {

    // auth
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);


    Route::apiResource('users', UserController::class);

    // user-specific actions
    Route::get('/user/template', [TemplateController::class, 'getUserTemplate']);
    Route::post('/user/template', [UserController::class, 'updateTemplate']);

    // portfolio
    Route::get('/portfolio', [PortfolioController::class, 'get']);
    Route::post('/portfolio', [PortfolioController::class, 'save']);
});
