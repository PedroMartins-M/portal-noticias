<?php

use App\Http\Controllers\api\AuthAppController;
use App\Http\Controllers\api\NoticiaApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [AuthAppController::class, 'login']);

Route::post('logout', [AuthAppController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('noticias', NoticiaApiController::class)->only(['index', 'show']);

Route::apiResource('noticias', NoticiaApiController::class)->except(['index', 'show'])->middleware('auth:sanctum');
