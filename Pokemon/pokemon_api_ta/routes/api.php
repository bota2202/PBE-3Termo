<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Mantido para compatibilidade com o projeto original
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
