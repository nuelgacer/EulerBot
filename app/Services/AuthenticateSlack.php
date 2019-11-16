<?php

namespace App\Services;

use \Illuminate\Http\Request;

/**
 * Abstract Class AuthenticateSlack
 * 
 * Services for Authenticating Slack API Requests
 * 
 * @author Emmanuel Gacer <emmanuelqgacer@gmail.com>
 */

abstract class AuthenticateSlack
{
    /**
     * Injects the current request to authentication clas
     * 
     * @param \Illuminate\Http\Request $request The current HTTP Request
     */
    public function __construct(Request $request)
    {
        // This variable is defined from each authentication class
        $this->request = $request;
    }
}