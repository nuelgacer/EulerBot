<?php

namespace App\Events;

class MessageEvent extends Event
{
    private $response;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
