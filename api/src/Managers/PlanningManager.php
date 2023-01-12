<?php

use App\Managers\BaseManager;
use App\Entities\Planning;
use App\Interfaces\IDatabase;
use App\Factories\MySQLFactory;

class PlanningManager extends BaseManager{

    public function __construct(IDatabase $Factory){
        parent::__construct($Factory);
    }

    public function getPlannings(){
        $query=$this->pdo->prepare("SELECT * FROM planning");  
        $query->execute();
        $plannings=$query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($plannings as $planning) {
           yield new Planning($planning);
        }
    }

    public function getPlanningById($id){
        $query=$this->pdo->prepare("SELECT * FROM planning WHERE id=:id");
        $query->execute([
            'id' => $id
        ]);
        $planning=$query->fetch(PDO::FETCH_ASSOC);
        return new Planning($planning);
    }

    public function updatePlanning(Planning $planning){
        $query=$this->pdo->prepare("UPDATE planning SET end=:end");
        $query->execute([
            'end' => $planning->getEnd()
        ]);

    }

    public function createPlanning(Planning $planning){
        $query=$this->pdo->prepare("INSERT INTO planning (emitter,begin, end, onjectif, title, comment) VALUES (:emitter, :begin, :end, :objectif, :title, :comment)");
        $query->execute([
            'emitter' => $planning->getEmitter(),
            'begin' => $planning->getBegin(),
            'end' => $planning->getEnd(),
            'objectif' => $planning->getObjectif(),
            'title' => $planning->getTitle(),
            'comment' => $planning->getComment()
        ]);
        
    }
}