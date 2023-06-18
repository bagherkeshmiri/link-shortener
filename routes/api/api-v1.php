<?php

use App\Http\Controllers\api\v1\user\AuthController;
use App\Http\Controllers\api\v1\user\LinkController;
use App\Http\Controllers\api\v1\user\TokenController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes Version 1.0
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);


Route::middleware(['apiHeadersCheck', 'auth:sanctum'])->group(function () {
    Route::prefix('link')->controller(LinkController::Class)->group(function () {
        Route::get('/shorten', 'shorten');
        Route::get('/all', 'all');
    });


    Route::post('/tokens/create', [TokenController::class, 'generateToken'])->withoutMiddleware(['apiHeadersCheck', 'auth:sanctum']);
});

