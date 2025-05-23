<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfessionController;
use App\Http\Resources\UserResource;


// public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/templates', [TemplateController::class, 'index']);
Route::get('/templates/{id}', [TemplateController::class, 'show']);

Route::post('/contact', [ContactController::class, 'send']);


// protected Routes
Route::middleware('auth:sanctum')->group(function () {

    // auth
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // user-specific actions
    Route::put('/user/update-profile', [UserController::class, 'updateProfile']);
    Route::get('/user/template', [TemplateController::class, 'getUserTemplate']);
    Route::post('/user/template', [UserController::class, 'updateTemplate']);
    Route::post('/user/update-password', [UserController::class, 'updatePassword']);
    Route::post('/user/upload-photo', [UserController::class, 'uploadPhoto']);

    // portfolio
    Route::get('/portfolio', [PortfolioController::class, 'get']);
    Route::post('/portfolio', [PortfolioController::class, 'save']);

    // profession
    Route::apiResource('professions', ProfessionController::class);
});
