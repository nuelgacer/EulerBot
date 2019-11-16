<?php

namespace App\Events;

/**
 * class MessageEvent
 * 
 * An event to trigger sending of response to Slack API
 * 
 * @author Emmanuel Gacer <emmanuelqgacer@gmail.com>
 */

class MessageEvent extends Event
{
    /**
     * @var Array response to be sent to Slack API
     */
    private $response;
    /**
     * Create a new event instance.
     *
     * @param Array $response Response to be sent to Slack API
     * @return void
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * Get the array response
     * 
     * @return Array This class $response array
     */
    public function getResponse()
    {
        return $this->response;
    }
}
