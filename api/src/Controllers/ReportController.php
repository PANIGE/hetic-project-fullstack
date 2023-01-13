<?php

namespace App\Controllers;

use App\Entities\Report;
use App\Routes\Route;
use App\Managers\ReportManager;
use App\Managers\TokenManager;

 #[Route('/reports?/([0-9]+-new)?')]
class ReportController extends BaseController{
    public function Get($params) {
        if (!isset($params[1])) {
            $this->search();
        } else if ($params[1] == "new") {
            http_response_code(405);
            echo json_encode(array("status" => 405, "message" => "Method not allowed."));
        }
        else {
            $this->view($params[1]);

        }
    }

    public function Post($params) {
        if (!isset($params[1]) && $params[1] == "new") {
            $this->create();
        }
        else {
            http_response_code(405);
            echo json_encode(array("status" => 405, "message" => "Method not allowed."));
        }
    }

    public function create() {
        $this->EnsurePostParameters("begin","end","title","content","group_id");
        $this->EnsureLogin();
        $tokenManager = new TokenManager($this->factory);
        $user = $tokenManager->getUserFromCookies();
        $report = new Report();
        $report->setEmitter($_POST['emitter']);
        $report->setBegin($_POST['begin']);
        $report->setEnd($_POST['end']);
        $report->setTitle($_POST['title']);
        $report->setComment($_POST['content']);
        $report->setGroupId($_POST['group_id']);
        $ReportManager = new ReportManager($this->factory);
        $ReportManager->createReport($report);
        http_response_code(201);
        echo json_encode(array("status" => 201, "message" => "Report created.", "report" => [
            "id" => $report->getId(),
            "emitter" => $report->getEmitter(),
            "begin" => $report->getBegin(),
            "end" => $report->getEnd(),
            "transactions" => $report->getTransaction(),
            "title" => $report->getTitle(),
            "content" => $report->getComment(),
        ]));
        
    }

    public function view(int $gid) {
        $ReportManager = new ReportManager($this->factory);
        $report = $ReportManager->getReport($gid);
        if ($report == null) {
            http_response_code(404);
            echo json_encode(array("status" => 404, "message" => "Report not found."));
        } else {
            echo json_encode([
                "id" => $report->getId(),
                "emitter" => $report->getEmitter(),
                "begin" => $report->getBegin(),
                "end" => $report->getEnd(),
                "transactions" => $report->getTransaction(),
                "title" => $report->getTitle(),
                "content" => $report->getComment(),
            ]);
        }

    }

    public function search() {
        $this->EnsureGetParameters("group_id");
        $_GET['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
        $_GET['limit'] = isset($_GET['limit']) ? $_GET['limit'] : 50;
        $_GET['search'] = isset($_GET['search']) ? $_GET['search'] : "";

        //$this->EnsureLogin();

        $ReportManager = new ReportManager($this->factory);
        $plannings = $ReportManager->searchReport($_GET['search'], $_GET['limit'], ($_GET["page"]-1) * $_GET["limit"]);

        //converts object to dictionary
        $plannings = array_map(function(Report $planning) {
            return [
                "id" => $planning->getId(),
                "emitter" => $planning->getEmitter(),
                "begin" => $planning->getBegin(),
                "end" => $planning->getEnd(),
                "transactions" => $planning->getTransaction(),
                "title" => $planning->getTitle(),
                "content" => $planning->getComment(),
            ];
        }, $plannings);

        echo json_encode($plannings);
    
    }
   
}