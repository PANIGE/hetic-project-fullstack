<?php

namespace App\Interfaces;


interface IToken
{
    /**
     * Connect to the database
     * @return null
     */
    public function GenerateToken();
}