<?php

namespace App\Services;

/**
 * class AppMentionService
 * 
 * Verify a request if it is a valid Slack API request
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

    /**
     * Verify the request from Slack API
     * 
     * @return boolean Returns TRUE if the request is verified
     */
    public function auth()
    {
        // Get the slack signature to be compared against
        $slackSignature = $this->request->header('X-Slack-Signature', FALSE);
        // Get the ingredients
        $version = 'v0';
        $timestamp = $this->request->header('X-Slack-Request-Timestamp', null);
        $signingSecret = getenv('SIGN_SECRET');
        // Raw request body
        $body = file_get_contents("php://input");

        // Make sure it is not empty
        if($slackSignature === FALSE) {
            return FALSE;
        }

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