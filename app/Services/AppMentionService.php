<?php

namespace App\Services;

/**
 * class AppMentionService
 * 
 * 
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

    }
}