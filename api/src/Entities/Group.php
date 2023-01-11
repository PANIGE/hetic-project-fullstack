<?php

namespace App\Entities;

class Group {
    public $id;
    public $name;
    public $owner;

//getter

    public function getId() {return $this->id;}

    public function getName() {return $this->name;}

    public function getOwner() {return $this->owner;}

//setter

    public function setId($id) {$this->id = $id;}

    public function setName($name) {$this->name = $name;}

    public function setOwner($owner) {$this->owner = $owner;}
}