<?php

use App\Http\Controllers\web\LinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/test', function(){ dd('asdaad');});
Route::get('/', function(){ dd('asdaad');});
// Route::get('/{link}',[LinkController::class , 'transmitter']);

