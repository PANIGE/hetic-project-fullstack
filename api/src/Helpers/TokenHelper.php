<?php

namespace App\Helpers;

use App\Entities\User;
use ReallySimpleJWT\Token;

use App\Interfaces\IToken;

class TokenHelper implements IToken
{
    public function GenerateToken(User $user): string
    {
        $payload = [
            'iat' => time(),
            'uid' => $user->getId(),
            'email' => $user->getEmail(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'exp' => time() + 3600,
        ];

        $secret = 'gpD*m3R#5DyfhAde3*uq5DQ^77E9QkU2';

        $token = Token::customPayload($payload, $secret);
        return $token;
    }
}