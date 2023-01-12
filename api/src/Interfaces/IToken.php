<?php

namespace App\Interfaces;

use App\Entities\User;

interface IToken
{
    /**
     * Connect to the database
     * @return null
     */
    public function GenerateToken(User $user);
}