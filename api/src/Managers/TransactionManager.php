<?php

use App\Managers\BaseManager;
use App\Factories\MySQLFactory;
use App\Interfaces\IDatabase;
use App\Entities\Transaction;

class TransactionManager extends BaseManager{

    public function __construct(IDatabase $database){
        parent::__construct($database);
    }

    public function getTransactions(){
        $query=$this->pdo->query("SELECT * FROM transactions");
        $transactions=$query->fetchAll(PDO::FETCH_ASSOC);
        foreach($transactions as $transaction){
            yield new Transaction($transaction);
        }
    }

    public function getTransaction($id){
        $query=$this->pdo->prepare("SELECT * FROM transactions WHERE id=:id");
        $query->execute(['id'=>$id]);
        $transaction=$query->fetch(PDO::FETCH_ASSOC);
        $transaction=new Transaction($transaction);
        return $transaction;
    }

    public function createTransaction(Transaction $transaction){
        $query=$this->pdo->prepare("INSERT INTO transactions (emitter, type , value , reason , unix) VALUES (:emitter, :type , :value , :reason , :unix)");
        $query->execute([
            'emitter'=>$transaction->getEmitter(),
            'type'=>$transaction->getType(),
            'value'=>$transaction->getValue(),
            'reason'=>$transaction->getReason(),
            'unix'=>$transaction->getUnix()
        ]);
       
    }

}