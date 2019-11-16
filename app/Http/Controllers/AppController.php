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
            $number = $request->input('text', null);

            if(!is_numeric($number)) {
                throw new \Exception('Please provide a valid number 0 < X < 10000');
            }
            // Do more validation

            // Perform Project Euler Problem 1
            $sum = 0;
            $i = +$number;

            // Loop through the number until it reaches zero
            while($i > 0) {
                $i--;
                // Modulo divide the number by 3 and 5 to check if it is a multiple
                if($i%3==0 || $i%5==0) {
                    $sum += $i;
                }
            }

            return sprintf("The sum of all multiples of 3 and 5 below %s is %s.", $number, $sum);
        }
        catch(\Exception $e) {
            return $e->getMessage();
        }
    }
}
