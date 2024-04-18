<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\{
    LoginController,
    ProfileController,
    RegisterController
};

Route::group(['as' => 'api.'], function ()  {

    Route::post('auth/register', RegisterController::class)->name('auth.register');
    Route::post('auth/login', LoginController::class)->name('auth.login');

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('auth', [ProfileController::class, 'show'])->name('auth.show');
        Route::put('auth', [ProfileController::class, 'update'])->name('auth.update');
    });

    Route::group(['prefix' => 'v1' , 'as' => 'v1.'], function(){
        require( __DIR__ . '/api/v1.php');
    });
});


