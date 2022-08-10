<?php

use App\Http\Controllers\web\LinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/{link}',[LinkController::class , 'transmitter']);

