<?php

namespace App\Services;

/**
 * class UrlVerificationService
 * 
 * A service to respond to a url verification from Slack API
 * 
 * @author Emmanuel Gacer <emmanuelqgacer@gmail.com>
 */

class UrlVerificationService extends AuthenticateSlack implements AuthenticateSlackInterface
{
    /**
     * The current HTTP request
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Authenticate URL verification request from Slack API
     * 
     * @return boolean Returns TRUE if the request is valid
     */
    public function auth()
    {
        // Get the challenge data
        $challenge = $this->request->input('challenge', FALSE);

        // Return the challenge if available, else FALSE
        return $challenge ? [
            "challenge" => $challenge
        ] : FALSE;
    }
}