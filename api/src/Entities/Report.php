<?php

namespace App\Entities;

class Report {
    public int $id;
    public int $emitter;
    public int $begin;
    public int $end;
    public string $title;
    public string $comment;
    public array $transactions;


//getter
public function getId(): int {return $this->id;}

public function getEmitter(): int {return $this->emitter;}

public function getBegin(): int {return $this->begin;}

public function getEnd(): int {return $this->end;}

public function getTitle(): string {return $this->title;}

public function getComment(): string {return $this->comment;}

public function getTransaction(): array {return $this->transactions;}

//setter
public function setId(int $id): void {$this->id = $id;}

public function setEmitter(int $emitter): void {$this->emitter = $emitter;}

public function setBegin(int $begin): void {$this->begin = $begin;}

public function setEnd(int $end): void {$this->end = $end;}

public function setTitle(string $title): void {$this->title = $title;}

public function setComment(string $comment): void {$this->comment = $comment;}

public function setTransaction(array $transactions): void {$this->transactions = $transactions;}

}