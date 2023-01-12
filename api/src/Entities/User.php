<?php

namespace App\Entities;

class User {
    private int $id;
    private string $last_name;
    private string $first_name;
    private string $email;
    private string $pw_hash;
    private string $rank;
    private string $part;
    private string $phone;

    public function __construct(array $user) {
        if (isset($user['id'])) {
            $this->setID($user['id']);
        }
        $this->setLastName($user['last_name']);
        $this->setFirstName($user['first_name']);
        $this->setEmail($user['email']);
        $this->setPwHash($user['pw_hash']);
    }

    //getters
    public function getId(): int {return $this->id; }

    public function getLastName(): string { return $this->last_name; }

    public function getFirstName(): string { return $this->first_name; }

    public function getEmail(): string { return $this->email; }

    public function getPwHash(): string { return $this->pw_hash; }

    public function getRank(): string { return $this->rank; }

    public function getPart(): string { return $this->part; }

    public function getPhone(): string { return $this->phone; }

    //setters
    public function setId(int $id): void { $this->id = $id; }

    public function setLastName(string $last_name): void { $this->last_name = $last_name; }

    public function setFirstName(string $first_name): void { $this->first_name = $first_name; }

    public function setEmail(string $email): void { $this->email = $email; }

    public function setPwHash(string $pw_hash): void { $this->pw_hash = $pw_hash; }

    public function setRank(string $rank): void { $this->rank = $rank; }

    public function setPart(string $part): void { $this->part = $part; }

    public function setPhone(string $phone): void { $this->phone = $phone; }
    
    
}