<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CreatorController;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')->group(function(){
    Route::middleware(['auth:creator-api','creator'])->group(function(){
        #post management
        Route::apiResource('post',PostController::class);
    });

    #creator management
    Route::prefix('creator')->group(function(){
        Route::post('/login',[CreatorController::class,'login']);
        Route::post('/register',[CreatorController::class,'register']);
        #creator logout
        Route::post('/logout',[CreatorController::class,'logout'])->middleware('auth:creator-api','creator');
    });
});

Route::get('login',function(){
    return send_response(false, 'you are not logged in!');
})->name('login');

