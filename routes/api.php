<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1' , 'as' => 'api.v1.'], function(){
    require( __DIR__ . '/api/v1.php');
});

