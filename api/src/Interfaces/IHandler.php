<?php

namespace App\Interfaces;


interface IHandler
{
    public function Get($params);
    public function Post($params);
    public function Put($params);
    public function Delete($params);
    public function Patch($params);
}