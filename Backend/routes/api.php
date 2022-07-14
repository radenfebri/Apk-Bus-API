<?php

use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\RuteController;
use App\Http\Controllers\Api\SupirController;
use App\Http\Controllers\Api\TerminalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ROUTE API BUSES
Route::resource('buses', BusController::class);
// ROUTE API SUPIRS
Route::resource('supirs', SupirController::class);
// ROUTE API TERMINALS
Route::resource('terminals', TerminalController::class);
// ROUTE API RUTES
Route::resource('rutes', RuteController::class);


