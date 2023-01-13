<?php

namespace App\Managers;

use App\Entity\Group;
use App\Managers\BaseManager;
use App\Interfaces\IDatabase;
use App\Factories\MySQLFactory;

class GroupManager extends BaseManager{
    
        public function __construct(IDatabase $database){
            parent::__construct($database);
        }
    
        public function getGroupById(int $id){
            $query = "SELECT * FROM `group` WHERE id = :id";
            $query->execute([':id' => $id]); 
            $group = $query->fetch();
            return $group;
        }
    
        public function createGroup(Group $group){
            $query = "INSERT INTO `group` (name , owner ) VALUES (:name , :owner)";
            $query->execute([
                ':name' => $group->getName() , 
                ':owner' => $group->getOwner()
            ]);
            
        }

        public function getUserGroup(int $user_id){
            $query = "SELECT g.id, g.name FROM `users_group` ug  LEFT JOIN `groups` g ON ug.gid = g.id WHERE ug.uid = :id";
            $query->execute([':uid' => $user_id]);
            $groups = $query->fetchAll();
            return $groups;
        }

        public function getOwnerGroup(int $owner_id){
            $query = "SELECT * FROM `group` WHERE owner = :owner";
            $query->execute([':owner' => $owner_id]);
            $groups = $query->fetchAll();
            return $groups;
        }

        public function deleteGroup(int $id){
            $query = "DELETE FROM `group` WHERE id = :id";
            $query->execute([':id' => $id]);
        }

        public function addUser(int $id_group , int $user_id){
            $query = "INSERT INTO `users_group` (gid , uid) VALUES  (:gid , :uid)";
            $query->execute([
                ':gid' => $id_group , 
                ':uid' => $user_id
            ]);  
        }

        public function deleteUser(int $id_group , int $user_id){
            $query = "DELETE FROM `users_group` WHERE gid = :gid AND uid = :uid";
            $query->execute([
                ':gid' => $id_group , 
                ':uid' => $user_id
            ]);  
        }
}



