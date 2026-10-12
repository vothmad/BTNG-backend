<?php

use App\Http\Controllers\SoulController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/souls', [SoulController::class, 'store']);

Route::get('/reapers/kill-count', [SoulController::class, 'killCount']);

Route::get('/souls/debug', function() {
    return response()->json(\App\Models\Soul::all());
});