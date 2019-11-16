<?php

namespace App\Services;

/**
 * A service to respond to a url verification from Slack API
 */

class UrlVerificationService extends AuthenticateSlack implements AuthenticateSlackInterface
{
    protected $request;

    public function auth()
    {
        $challenge = $this->request->input('challenge', FALSE);
        return $challenge ? [
            "challenge" => $challenge
        ] : FALSE;
    }
}