<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        /*if (! $request->expectsJson()) {
            return route('login');
        }*/
         if (!Auth::check()) {
              $msg['status'] = 'error';
            $msg['message']      = 'No estas Autorizado para usar laPI ';
            $res = response()->json($msg,401 );
            //dd($request);
            throw new HttpResponseException($res);
        }

        return $next($request);
    }
}
