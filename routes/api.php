<?php

use App\Http\Controllers\Api\v1\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/images', [ImageController::class, 'index'])->name('api.images.index');
Route::get('/images/{image}', [ImageController::class, 'show'])->name('api.images.show');
