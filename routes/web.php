<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
// Register routes using the routes configuration file
$routes = require __DIR__.'/../app/config/routes.php';

// Iterate through the routes configuration
foreach($routes as $type => $route) {
    // Register each grouped routes
    if($type === "groups") {

    }
    else {
        /**
         * Register each routes
         * $verb - is the HTTP verb
         * $methods - array of routes
         */
        foreach($route["methods"] as $verb => $methods) {
            /**
             * $endpoint - is the URI
             * $action - is the options such as the action, name, etc.
             */
            foreach($methods as $endpoint => $action) {
                // Prepend the classname to the action
                if(array_key_exists("uses", $action)) {
                    $action["uses"] = "{$route['class']}@{$action['uses']}";
                }
                // Register the route
                $router->$verb($endpoint, $action);
            }
        }
    }
}
