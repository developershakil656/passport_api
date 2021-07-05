<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }

        // if ($request->is('admin/*')) {
        //     if(!Auth::guard('admin')->check()){
        //         return route('admin.login');
        //     }
        // }elseif (!Auth::guard('creator')->check()){
        //     return route('login');
        // }

        // if(Auth::user()){
        //     return 'ok';
        // }else{
        //     'no';
        // }
    }
}
