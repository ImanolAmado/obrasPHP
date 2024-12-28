<?php

use App\Http\Controllers\ObraController;
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
    Route::middleware('auth:sanctum')->put('/obras/{id}', 'update')->name('update.obras');
    Route::middleware('auth:sanctum')->delete('/obras/{id}', 'destroy')->name('delete.obas');
});


// Registrar nuevos usuarios
Route::post('register', [UserController::class, 'register']);

// Login usuarios
Route::post('login', [AuthController::class, 'login']);

// Logout usuarios
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

// Info de usuario concreto
Route::middleware('auth:sanctum')->post('perfil', [AuthController::class, 'perfil']);