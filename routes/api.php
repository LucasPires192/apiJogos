<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JogosController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/jogos', [JogosController::class, 'index']);
Route::put('/jogos/{id}', [JogosController::class, 'update']);
Route::delete('/jogos/{id}', [JogosController::class, 'destroy']);
Route::post('/jogos', [JogosController::class, 'store']);
