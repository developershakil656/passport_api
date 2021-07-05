<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->group(function(){
    Route::prefix('admin')->group(function(){
        #admin login
        Route::post('/login',[AdminController::class, 'login']);

        // authenticated staff routes here 
        Route::middleware(['auth:admin-api','admin'])->group(function(){
        
            Route::post('/logout',[AdminController::class,'logout']);
            Route::get('/creators',[AdminController::class,'creators']);
        });
    });
});


// Route::get('/dashbord',function(Request $request){
//     return send_response(true,'you are admin');
// })->middleware(['auth:admin-api','admin']);


