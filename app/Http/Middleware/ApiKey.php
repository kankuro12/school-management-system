<?php

namespace App\Http\Middleware;

use App\ApiData;
use Closure;
use Illuminate\Http\Request;

class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $api_keys=['123456','123456789'];

        if(!in_array( $request->header('xpsu','kankuro'),$api_keys)){
            return ApiData::f('Api Key Not Found',401);
        }
        return $next($request);
    }
}
