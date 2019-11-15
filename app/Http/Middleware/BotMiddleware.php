<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Middleware to authenticate Slack API requests
 * 
 * @author Emmanuel Gacer <emmanuelqgacer@gmail.com>
 */

class BotMiddleware
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
        // Do the URL verification and API Request authentication

        return $next($request);
    }
}