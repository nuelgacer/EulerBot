<?php

namespace App\Listeners;

use App\Events\MessageEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MessageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageEvent  $event
     * @return void
     */
    public function handle(MessageEvent $event)
    {
        $response = $event->getResponse();

        $client = new \GuzzleHttp\Client();
        
        $client->request('POST', 'https://slack.com/api/chat.postMessage', $response);
        
        // var_dump($response);
    }
}