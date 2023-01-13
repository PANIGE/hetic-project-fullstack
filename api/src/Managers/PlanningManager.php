<?php

namespace App\Managers;

use App\Managers\BaseManager;
use App\Entities\Planning;
use App\Interfaces\IDatabase;
use App\Factories\MySQLFactory;
use PDO;

class PlanningManager extends BaseManager{

    public function __construct(IDatabase $Factory){
        parent::__construct($Factory);
    }

    public function getPlannings(int $gid){
        $query=$this->pdo->prepare(`SELECT * FROM planning WHERE group_id=:id`);  
        $query->execute([
            'id' => $gid
        ]);
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
        $query=$this->pdo->prepare("UPDATE planning SET end = :end");
        $query->execute([
            'end' => $planning->getEnd()
        ]);

    }

    public function createPlanning(Planning $planning){
        $query=$this->pdo->prepare("INSERT INTO planning (emitter,begin, end, onjectif, title, comment, group_id) VALUES (:emitter, :begin, :end, :objectif, :title, :comment, :group_id)");
        $query->execute([
            'emitter' => $planning->getEmitter(),
            'begin' => $planning->getBegin(),
            'end' => $planning->getEnd(),
            'objectif' => $planning->getObjectif(),
            'title' => $planning->getTitle(),
            'comment' => $planning->getComment(),
            'group_id' => $planning->getGroupId()
        ]);
    }

    public function searchPlanning($search, $limit, $offset): array {
        $query=$this->pdo->prepare("SELECT * FROM planning WHERE title LIKE :search LIMIT :limit OFFSET :offset ");
        $query->bindValue(':limit',intval($limit), PDO::PARAM_INT);
        $query->bindValue(':offset',intval($offset), PDO::PARAM_INT);
        $query->bindValue(':search','%'.$search.'%', PDO::PARAM_STR);
        $query->execute();
        $plannings=$query->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($plannings as $planning) {
            $res[]= new Planning($planning);
        }
        return $res;
    }
}