<?php

namespace App\Services;

use \Illuminate\Http\Request;

/**
 * 
 */

abstract class AuthenticateSlack
{

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}