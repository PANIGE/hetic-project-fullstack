<?php

namespace App\Controllers;
use App\Routes\Route;
use App\Managers\ReportManager;


 #[Route('/reports?/[0-9]+-new)?')]
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

    }

    public function view(int $gid) {
        $ReportManager = new ReportManager($this->factory);
        $report = $ReportManager->getReport($gid);
        if ($report == null) {
            http_response_code(404);
            echo json_encode(array("status" => 404, "message" => "Report not found."));
        } else {
            echo json_encode($report);
        }

    }

    public function search(){

    }
   
}