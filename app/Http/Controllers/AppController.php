<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(\Illuminate\Http\Request $request)
    {
        try {
            $authUsers = $request->input('authed_users', []);
            $text = trim($request->input('event.text', null));
            $user = '<@' .$request->input('event.user', null) . '>';
            $type = $request->input('event.type', null);

            if($type == 'app_mention') {
                return sprintf("Hi %s! I am ready to answer your question, give me a number?", $user);
            }
            $isMentioned = false;
            foreach($authUsers as $authedUser) {
                $authedUser = "<@{$authedUser}>";
                // Check
                if(!$isMentioned && strpos($text, $authedUser) !== FALSE) {
                    $isMentioned = true;
                }
                $text = str_replace($authedUser, '', $text);
            }
            if($type == 'message' && $isMentioned && !strlen(trim($text))) {
                return response('', 200);
            }
            
            // Make sure number is valid
            if(!is_numeric($text) || $text <= 0 || $text >= 10000) {
                throw new \Exception(
                    sprintf('Hi %s! Please provide a valid number 0 < X < 10000.', $user)
                );
            }
            // Do more validation

            // Perform Project Euler Problem 1
            $sum = 0;
            $i = +$text;

            // Loop through the number until it reaches zero
            while($i > 0) {
                $i--;
                // Modulo divide the number by 3 and 5 to check if it is a multiple
                if($i%3==0 || $i%5==0) {
                    $sum += $i;
                }
            }

            return sprintf("The sum of all multiples of 3 and 5 below %s is %s.", number_format($text), number_format($sum));
        }
        catch(\Exception $e) {
            return $e->getMessage();
        }
    }
}
