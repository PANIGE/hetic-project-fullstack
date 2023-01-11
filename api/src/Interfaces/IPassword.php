<?php

namespace App\Interfaces;

interface IPassword
{
    /**
     * Generate a bcrypt password hash
     * @param int $password the password to hash
     * @return string the hashed password
     */
    public static function hashPassword(string $Password): string;

    /**
     * Verify a password against a hash
     * @param string $password the password to verify
     * @param string $hash the hash to verify against
     * @return bool true if the password matches the hash, false otherwise
     */
    public static function verifyPassword(string $Password, string $hash): bool;
}