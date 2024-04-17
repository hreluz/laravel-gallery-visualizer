<?php

use App\Http\Controllers\Api\v1\ImageController;
use Illuminate\Support\Facades\Route;

Route::apiResource('images', ImageController::class);
