<?php

namespace App\Entities;

class Transaction{
    public int $id;
    public int $emitter;
    public int $type;
    public float $value;
    public string $reason;
    public int $unix;
    public int $group_id;

//getter
public function getId(): int{return $this->id;}

public function getEmitter(): int{return $this->emitter;}

public function getType(): int{return $this->type;}

public function getValue(): float{return $this->value;}

public function getReason(): string{return $this->reason;}

public function getUnix(): int{return $this->unix;}

public function getGroupId(): int{return $this->group_id;}

//setter

public function setId(int $id): void{$this->id = $id;}

public function setEmitter(int $emitter): void{$this->emitter = $emitter;}

public function setType(int $type): void{$this->type = $type;}

public function setValue(float $value): void{$this->value = $value;}

public function setReason(string $reason): void{$this->reason = $reason;}

public function setUnix(int $unix): void{$this->unix = $unix;}

public function setGroupId(int $group_id): void{$this->group_id = $group_id;}

}
