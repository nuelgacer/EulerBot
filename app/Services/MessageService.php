<?php

namespace App\Services;

/**
 * class AppMentionService
 * 
 * Verify a Slack API request
 * 
 * @author Emmanuel Gacer <emmanuelqgacer@gmail.com>
 */

class AppMentionService extends AuthenticateSlack implements AuthenticateSlackInterface
{
    /**
     * The current HTTP request
     * @var \Illuminate\Http\Request
     */
    protected $request;
    
    public function auth()
    {
        // Disable verification for the moment
        return TRUE;
        // Get the slack signature to be compared against
        $slackSignature = $this->request->header('X-Slack-Signature', FALSE);

        // Make sure it is not empty
        if($slackSignature === FALSE) {
            return FALSE;
        }

        // Get the ingredients
        $version = 'v0';
        $timestamp = $this->request->header('X-Slack-Request-Timestamp', null);
        $signingSecret = getenv('SIGN_SECRET');
        $body = http_build_query($this->request->all());

        // Prepare the base string for hashing
        $baseString = implode(':', [$version, $timestamp, $body]);

        // Use HMAC sha256
        $signature = $version . '=' . hash_hmac('sha256', $baseString, $signingSecret);

        // Compare if signatures are matched
        if($signature === $slackSignature) {
            return TRUE;
        }

        return FALSE;
    }
}