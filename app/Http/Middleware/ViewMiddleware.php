<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Middleware to evelope response
 * 
 * @author Emmanuel Gacer <emmanuelqgacer@gmail.com>
 */

class ViewMiddleware
{
    /**
     * Enclose all responses to Slack API requirements
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Set this standard 404 response for all
        if($response->status() == 404) {
            return response()->json([
                "error" => "Not found"   
            ], 404);
        }
        // Get the returned content
        $content = $response->getContent();
        
        return $response
            // Do some enveloping to match the requirements of Slack API
            ->setContent([
                'text' => $content,
                'channel' => $request->input('event.channel', null)
            ])
            // Set the headers
            ->header('Authorization', 'Bearer ' . getenv('BOT_TOKEN'));
    }
}
