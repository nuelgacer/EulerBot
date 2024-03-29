<?php

namespace App\Services;

/**
 * interface AuthenticateSlackInterface
 * 
 * @author Emmanuel Gacer <emmanuelqgacer@gmail.com>
 */

interface AuthenticateSlackInterface
{
    /**
     * Verify requests
     */
    public function auth();
}