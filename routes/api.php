<?php

use App\Http\Controllers\ObraController;
use App\Http\Controllers\ObraUser;
use App\Http\Controllers\ObraUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


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
    // Rutas "get"
    Route::get('/obras/{categoria}', 'categoria')->name('obras.categoria'); 
    Route::get('/obras/todos/{id}', 'show')->name('obras.show');

    // Rutas "CRUD" para usuarios autenticados
    Route::middleware('auth:sanctum')->post('/obras', 'store')->name('obras.store');
    Route::middleware('auth:sanctum')->put('/updateObras', 'update')->name('obras.update');
    Route::middleware('auth:sanctum')->delete('/deleteObras/{id}', 'destroy')->name('obras.delete');
});


Route::controller(UserController::class)->group(function(){
    Route::post('/register', 'register');
    Route::middleware('auth:sanctum')->get('/perfil', 'perfil');
    Route::middleware('auth:sanctum')->get('/userObra',  'userObra');
});


// Registro de votaciones
Route::controller(ObraUserController::class)->group(function(){
    Route::middleware('auth:sanctum')->post('/voto', 'store');
    Route::middleware('auth:sanctum')->get('/voto/{id}', 'show');
});


Route::controller(AuthController::class)->group(function(){
    Route::post('login',  'login');
    Route::middleware('auth:sanctum')->post('logout',  'logout');
});



