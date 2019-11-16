<?php

namespace App\Http\Middleware;

use Log;
use Closure;
use App\Events\MessageEvent;

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
        
        // Do some enveloping to match the requirements of Slack API
        $content = [
            // Get the returned content
            'text' => $response->getContent(),
            'channel' => $request->input('event.channel', null)
        ];
        Log::info('App: '.$response->getContent());
        
        $authorizationBearer = 'Bearer ' . getenv('BOT_TOKEN');
        
        // Fire the event to send message to Slack API
        event(new MessageEvent([
            // Set the content
            'body' => json_encode($content),
            // Set the headers
            'headers' => [
                'Authorization' => $authorizationBearer,
                'Content-Type' => 'application/json'
            ]
        ]));
        
        // Send 200 response
        return response()->json(["ok" => true], 200);
    }
}
