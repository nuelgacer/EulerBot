<?php

namespace App\Http\Controllers;

/**
 * class AppController
 * 
 * Responds according to the request of Slack API
 * 
 * @author Emmanuel Gacer <emmanuelqgacer@gmail.com>
 */

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {}

    /**
     * Base resource to process the request from Slack API
     * 
     * @param \Illuminate\Http\Request $request Current HTTP Request
     * @return String The message response to Slack API
     */
    public function index(\Illuminate\Http\Request $request)
    {
        // Athenticated users
        $authUsers = $request->input('authed_users', []);
        // The text where number will be extracted
        $text = trim($request->input('event.text', null));
        // The sender, prefixed and suffixed
        $user = '<@' .$request->input('event.user', null) . '>';

        // Remove all mentioned users to get the number
        foreach($authUsers as $authedUser) {
            // Add prefix and suffix based on Slack format
            $authedUser = "<@{$authedUser}>";
            // Remove the mentioned user
            $text = str_replace($authedUser, '', $text);
        }
        
        // If text is empty, send this message
        if(!strlen(trim($text))) {
            return sprintf("Hi %s! I am ready to answer your question, give me a number?", $user);
        }
        
        // Make sure number is valid
        if(!is_numeric($text) || $text <= 0 || $text >= 10000) {
            return sprintf('Hi %s! Please provide a valid number 0 < X < 10000.', $user);
        }

        // Perform Project Euler Problem 1
        $sum = 0;
        $number = +$text;

        // Loop through the number until it reaches zero
        while($number > 0) {
            $number--;
            // Modulo divide the number by 3 and 5 to check if it is a multiple
            if($number%3==0 || $number%5==0) {
                $sum += $number;
            }
        }

        return sprintf("The sum of all multiples of 3 and 5 below %s is %s.", number_format($text), number_format($sum));
    }
}