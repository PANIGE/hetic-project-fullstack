<?php
 
namespace App\Managers;
use App\Managers\BaseManager;
use App\Factories\MySQLFactory;
use App\Entities\Report;
use App\Interfaces\IDatabase;

 class ReportManager extends BaseManager{
    public function __construct(IDatabase $factory)
    {
        parent::__construct($factory);
    }
    
    public function getReports(int $gid){
       $query = $this->pdo->query("SELECT * FROM reports WHERE group_id = :id");
         $query->execute(['id' => $gid]);
       $reports = $query->fetchAll();
       foreach($reports as $report){
           yield new Report($report);
       }
    }

    public function getReport(int $id){
        $query = $this->pdo->prepare("SELECT * FROM reports WHERE id = :id");
        $query->execute(
            ['id' => $id]
        );
        $report = $query->fetch();
        if($report){
            $q2 = $this->pdo->prepare("SELECT * FROM transactions WHERE unix <= :begin AND unix >= :end");
            $q2->execute([
                'begin' => $report['begin'],
                'end' => $report['end']
            ]);

            $transactions = $q2->fetchAll();

            $report['transactions'] = $transactions;

            return new Report($report);
    }
        
    }

    public function createReport( Report $report){
       $query=$this->pdo->prepare("INSERT INTO reports (emitter, begins , end , title , comment, group_id) VALUES (:emitter, :begin, :end, :title, :comment, :group_id)");
       $query->execute([
           'emitter' => $report->getEmitter(),
           'begin' => $report->getBegin(),
           'end' => $report->getEnd(),
           'title' => $report->getTitle(),
           'comment' => $report->getComment(),
              'group_id' => $report->getGroupId()
       ]);
    }
   
    public function deleteReport(int $id){
        $query = $this->pdo->prepare("DELETE FROM reports WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
    }
}