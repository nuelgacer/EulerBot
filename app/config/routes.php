<?php
/**
 * API route configuration
 * 
 * @author Emmanuel Gacer <emmanuelqgacer@gmail.com>
 */

return [
    // Grouped routes
    "groups" => [],
    // Routes
    [
        // The default controller
        "class" => "AppController",
        // Methods available for this controller
        "methods" => [
            // Keyed with the HTTP verb
            "get" => [
                // Provided the URI as key and the action as value
                "/" => [
                    "uses" => "index"
                ]
            ],
            "post" => [
                "/" => [
                    "uses" => "index"
                ]
            ]
        ]
    ]
];