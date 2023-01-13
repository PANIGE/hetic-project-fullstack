<?php

namespace App\Managers;
use App\Managers\BaseManager;
use App\Factories\MySQLFactory;
use App\Interfaces\IDatabase;
use App\Entities\Transaction;
use PDO;

class TransactionManager extends BaseManager{

    public function __construct(IDatabase $database){
        parent::__construct($database);
    }

    public function getTransaction($id){
        $query=$this->pdo->prepare("SELECT * FROM transactions WHERE id=:id");
        $query->execute(['id'=>$id]);
        $transaction=$query->fetch(PDO::FETCH_ASSOC);
        $transaction=new Transaction($transaction);
        return $transaction;
    }

    public function createTransaction(Transaction $transaction){
        $query=$this->pdo->prepare("INSERT INTO transactions (emitter, type , value , reason , unix, group_id) VALUES (:emitter, :type , :value , :reason , :unix, :group_id)");
        $query->execute([
            'emitter'=>$transaction->getEmitter(),
            'type'=>$transaction->getType(),
            'value'=>$transaction->getValue(),
            'reason'=>$transaction->getReason(),
            'unix'=>$transaction->getUnix(),
            'group_id'=>$transaction->getGroupId()
        ]);
       
    }

    
    public function getTransactions(int $gid, int $limit = 50, int $offset = 0) {
        $req = $this->pdo->prepare(`SELECT t.id , CONCAT(u.first_name, " ", u.last_name) full_name, t.reason, t.value, t.unix, ty.name_short type_short, ty.name_full type_full FROM transactions t 
                            LEFT JOIN users u on t.emitter = u.id 
                            LEFT JOIN transactions_types ty ON t.type = ty.id
                            WHERE group_id = :gid ORDER BY t.unix DESC LIMIT :limit OFFSET :offset`);
        $req->execute([
            'gid' => $gid,
            'limit' => $limit,
            'offset' => $offset
        ]);
        $transactions = $req->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach($transactions as $transaction){
            $result []= new Transaction($transaction);
        }
        return $result;
    }


}