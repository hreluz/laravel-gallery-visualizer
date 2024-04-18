<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['as' => 'api.'], function ()  {
    Route::post('auth/register', RegisterController::class)->name('auth.register');

    Route::group(['prefix' => 'v1' , 'as' => 'v1.'], function(){
        require( __DIR__ . '/api/v1.php');
    });
});


