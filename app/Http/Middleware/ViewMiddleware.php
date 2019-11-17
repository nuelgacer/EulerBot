<?php

namespace App\Http\Middleware;

use Log;
use Closure;
use App\Events\MessageEvent;

/**
 * class ViewMiddleware
 * 
 * Middleware to evelope response and send to trigger events
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
            // Get the channel
            'channel' => $request->input('event.channel', null)
        ];
        
        // Fire the event to send the message to Slack API
        event(new MessageEvent([
            // Set the response body
            'body' => json_encode($content),
            // Set the response headers
            'headers' => [
                'Authorization' => 'Bearer ' . getenv('BOT_TOKEN'),
                'Content-Type' => 'application/json',
                'X-Slack-No-Retry' => 1
            ]
        ]));
        
        // Send 200 response
        return response('', 200)
            ->header('X-Slack-No-Retry', 1);
    }
}
