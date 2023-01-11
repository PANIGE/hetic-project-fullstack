<?php

namespace App\Helper;

use App\Interfaces\IPassword;


class PasswordHelper implements IPassword
{
    public static function hashPassword(string $Password): string
    {
        return password_hash($Password, PASSWORD_BCRYPT);
    }

    /**
     * Verify a password against a hash
     * @param string $password the password to verify
     * @param string $hash the hash to verify against
     * @return bool true if the password matches the hash, false otherwise
     */
    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}