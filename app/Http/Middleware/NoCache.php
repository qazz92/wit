<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class NoCache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::info("노캐쉬 미들웨어 통과!");
        return $next($request)->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header('Expires','Sat, 01 Jan 1990 00:00:00 GMT');
    }
}
