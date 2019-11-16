<?php

namespace App\Http\Middleware;

use Log;
use Closure;
use \App\Services\AuthSlackException;

/**
 * class BotMiddleware
 * 
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
        Log::info('text: '.json_encode($request->all()));
        // Debug Slack API request
        Log::info('Body: '.http_build_query($request->all()));
        Log::info('X-Slack-Signature: ' . $request->header('X-Slack-Signature', FALSE));
        Log::info('X-Slack-Request-Timestamp: ' . $request->header('X-Slack-Request-Timestamp', FALSE));
        try {
            // Get the type of request
            $type = $request->input('type', FALSE);
            $subtype = $request->input('event.subtype', FALSE);
            if($type === 'event_callback') {
                $type = $request->input('event.type', FALSE);
            }
            // Make sure type has value
            if($type === FALSE) {
                throw new AuthSlackException('Invalid Request');
            }
            // Allow only events without subtype
            if($subtype) {
                return response('', 200);
            }
            /**
             * Using factory design pattern,
             * process different Slack API requests
             */

            /**
             * Get the event class name based on the type of request
             * Convert snake_case (and dotted) to PascalCase
             */
            $service = '\\App\\Services\\' . str_replace(['_','.'], '', ucwords($type, '_.')) . 'Service';
            // Authenticate request
            if(class_exists($service)) {
                if(FALSE === ($data = (new $service($request))->auth())) {
                    throw new AuthSlackException('Authentication failed');
                }
                // If the request returns an array, send it as a response
                else if(is_array($data)) {
                    return response()->json($data);
                }
            }
            else {
                throw new AuthSlackException('Resource is not available');
            }

            return $next($request);
        }
        catch(AuthSlackException $e) {
            // Return an error message
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}