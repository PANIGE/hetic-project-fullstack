<?php

namespace App\Helpers;

use App\Interfaces\IToken;

class TokenHelper implements IToken
{
    public function GenerateToken():string
    {
        //generate random 32 character string while it doesn't exist in database
        $token = bin2hex(random_bytes(16));
        return $token; //bin2hex(random_bytes(16));
    }
}