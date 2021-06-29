<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function(){
    Route::group(['middleware' => 'auth:api' ],function(){

        #post manage
        Route::apiResource('post',PostController::class);

        #user logout
        Route::post('/user/logout',[UserController::class,'logout']);
    });

    #user login
    Route::prefix('user')->group(function(){
        Route::post('/login',[UserController::class,'login']);
        Route::post('/register',[UserController::class,'register']);
    });
});

Route::get('login',function(){
    return send_response(false, 'UnAuthinticate User!');
})->name('login');
