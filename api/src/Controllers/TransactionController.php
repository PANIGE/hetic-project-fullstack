<?php

namespace App\Controllers;

use App\Managers\BaseManager;
use App\Routes\Route;
use App\Managers\transactionManager;

#[Route('/transactions/(new)?')]
class TransactionController extends BaseController{

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

    public function view(int $gid, int $limit=50 , int $offset=0) {
        $transactionManager = new transactionManager($this->factory);
        $transaction = $transactionManager->getTransaction($gid, $limit, $offset);
        if ($transaction == null) {
            http_response_code(404);
            echo json_encode(array("status" => 404, "message" => "Transaction not found."));
        }
        else {
            echo json_encode($transaction);
        }
    }

    public function search(){}

}