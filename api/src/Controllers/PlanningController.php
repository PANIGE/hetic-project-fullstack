<?php

namespace App\Controllers;

use App\Entities\Planning;
use App\Routes\Route;
use App\Managers\PlanningManager;
use App\Managers\TokenManager;
use App\Managers\UserManager;

#[Route('/plannings?/([0-9]+|new)?')]
class PlanningController extends BaseController {
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
        if (isset($params[1]) && $params[1] == "new") {
            $this->create();
        }
        else {
            http_response_code(405);
            echo json_encode(array("status" => 405, "message" => "Method not allowed."));
        }
    }

    public function create() {
        $this->EnsurePostParameters("group_id", "begin", "end", "title", "comment", "objective");
        $this->EnsureLogin();
        $tokenManager = new TokenManager($this->factory);
        $user = $tokenManager->getUserFromCookies();

        $planning = new Planning();
        $planning->setGroupId($_POST['group_id']);
        $planning->setBegin($_POST['begin']);
        $planning->setEnd($_POST['end']);
        $planning->setTitle($_POST['title']);
        $planning->setComment($_POST['comment']);
        $planning->setObjectif($_POST['objective']);
        $planning->setEmitter($user->getId());

        $planningManager = new PlanningManager($this->factory);
        $planningManager->createPlanning($planning);
        http_response_code(201);
        echo json_encode([
            "id" => $planning->getId(),
            "emitter" => $planning->getEmitter(),
            "begin" => $planning->getBegin(),
            "end" => $planning->getEnd(),
            "objective" => $planning->getObjectif(),
            "title" => $planning->getTitle(),
            "content" => $planning->getComment(),
        ]);
    }

    public function view(int $id) {
        $planningManager = new PlanningManager($this->factory);
        $planning=$planningManager->getPlanningById($id);
        if ($planning == null) {
            http_response_code(404);
            echo json_encode(array("status" => 404, "message" => "Report not found."));
        } else {
            echo json_encode($planning);
        }

    }
    

    public function search() {
        $this->EnsureGetParameters("group_id");
        $_GET['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
        $_GET['limit'] = isset($_GET['limit']) ? $_GET['limit'] : 50;
        $_GET['search'] = isset($_GET['search']) ? $_GET['search'] : "";

        //$this->EnsureLogin();

        $planningManager = new PlanningManager($this->factory);
        $plannings = $planningManager->searchPlanning($_GET['search'], $_GET['limit'], ($_GET["page"]-1) * $_GET["limit"]);

        //converts object to dictionary
        $plannings = array_map(function(Planning $planning) {
            return [
                "id" => $planning->getId(),
                "emitter" => $planning->getEmitter(),
                "begin" => $planning->getBegin(),
                "end" => $planning->getEnd(),
                "objective" => $planning->getObjectif(),
                "title" => $planning->getTitle(),
                "content" => $planning->getComment(),
            ];
        }, $plannings);

        echo json_encode($plannings);
    
    }
}