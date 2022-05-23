<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;

class EmailMustBeVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth('sanctum')->user()->verified){
            return response()->json([
                'code'=>422,
                'message'=>'E-mail not yet verified',
                'data'=> []
            ],422);
        }
        return $next($request);
    }
}
