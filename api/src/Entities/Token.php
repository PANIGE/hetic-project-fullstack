<?php

namespace App\Entities;

class Token{
    public string $token;
    public string $user_id;
    public string $request_ip;

//getter
public function getToken(): string{return $this->token;}

public function getUserId(): string{return $this->user_id;}

public function getRequestIp(): string{return $this->request_ip;}

//setter

public function setToken(string $token): void{$this->token = $token;}

public function setUserId(string $user_id): void{$this->user_id = $user_id;}

public function setRequestIp(string $request_ip): void{$this->request_ip = $request_ip;}

}