<?php

namespace App\Listeners;

use App\Events\MessageEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use \GuzzleHttp\Client;

/**
 * class MessageListener
 * 
 * Sends the response to Slack API
 * 
 * @author Emmanuel Gacer <emmanuelqgacer@gmail.com>
 */

class MessageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {}

    /**
     * Handle the event.
     *
     * @param  MessageEvent  $event
     * @return void
     */
    public function handle(MessageEvent $event)
    {
        // Get the reponse body and headers
        $response = $event->getResponse();
        // Initialize \GuzzleHttp\Client
        $client = new Client();
        // Send the response to slack API
        $client->request('POST', 'https://slack.com/api/chat.postMessage', $response);
    }
}
