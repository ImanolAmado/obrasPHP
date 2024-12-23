<?php

use App\Http\Controllers\ObraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(ObraController::class)->group(function(){
    Route::get('/obras', 'index')->name('obras.index');
    Route::get('/obras/{id}', 'show')->name('obras.show');
    Route::middleware('auth:sanctum')->post('/obras/', 'store')->name('obras.store');
    Route::middleware('auth:sanctum')->put('/obras/{id}', 'update')->name('update.obras');
    Route::middleware('auth:sanctum')->delete('/obras/{id}', 'destroy')->name('delete.obas');
});



Route::post('login', [AuthController::class, 'login']);
