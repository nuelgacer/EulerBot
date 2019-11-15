<?php
/**
 * Middleware configuration for API
 * 
 * @author Emmanuel Gacer <emmanuelqgacer@gmail.com>
 */

return [
    // Global middlewares
    "global" => [
        // Middleware for Slack API Requests
        App\Http\Middleware\BotMiddleware::class,
        // Middleware for sending response to Slack API
        App\Http\Middleware\ViewMiddleware::class,
    ],
    // Other middlewares
];