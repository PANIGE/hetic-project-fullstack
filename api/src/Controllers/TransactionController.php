<?php

namespace App\Controllers;

use App\Managers\BaseManager;
use App\Routes\Route;
use App\Managers\transactionManager;
use App\Entities\Transaction;

#[Route('/transactions/(new)?')]
class TransactionController extends BaseController{

    public function Get($params) {
        if (!isset($params[1])) {
            $this->EnsureGetParameters("gid");

            $gid = $_GET['gid'];
            $limit = $_GET['limit'];
            $offset = $_GET['offset'];
            
            if (!isset($limit)) {
                $limit = 50;
            }
            if (!isset($offset)) {
                $offset = 0;
            }
            $this->view($gid, $limit, $offset);
        } else {
            http_response_code(405);
            echo json_encode(array("status" => 405, "message" => "Method not allowed."));
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
        $this->EnsurePostParameters("emitter","type","value","reason","unix","group_id");
        $this->EnsureLogin();
        
        $Transaction = new Transaction();
        $Transaction->setEmitter($_POST['emitter']);
        $Transaction->setType($_POST['type']);
        $Transaction->setValue($_POST['value']);
        $Transaction->setReason($_POST['reason']);
        $Transaction->setUnix($_POST['unix']);
        $Transaction->setGroupId($_POST['group_id']);

        $TransactionManager = new TransactionManager($this->factory);
        $TransactionManager->createTransaction($Transaction);

        http_response_code(201);
        echo json_encode([
            "id" => $Transaction->getId(),
            "emitter" => $Transaction->getEmitter(),
            "type" => $Transaction->getType(),
            "value" => $Transaction->getValue(),
            "reason" => $Transaction->getReason(),
            "unix" => $Transaction->getUnix(),
            "group_id" => $Transaction->getGroupId(),
        ]);
        



    }

    public function view(int $gid, int $limit=50 , int $offset=0) {
        $TransactionManager = new TransactionManager($this->factory);
        $Transaction = $TransactionManager->getTransactions($gid, $limit, $offset);
        http_response_code(200);
        $Transaction = array_map(function($Transaction) {
            return [
                "id" => $Transaction->getId(),
                "emitter" => $Transaction->getEmitter(),
                "type" => $Transaction->getType(),
                "value" => $Transaction->getValue(),
                "reason" => $Transaction->getReason(),
                "unix" => $Transaction->getUnix(),
                "group_id" => $Transaction->getGroupId(),
            ];
        }, $Transaction);

        echo json_encode($Transaction);
    }


}