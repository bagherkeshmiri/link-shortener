<?php

use App\Http\Controllers\web\LinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/r/{link}', [LinkController::class, 'redirect']);


