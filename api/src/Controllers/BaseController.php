<?php

namespace App\Controllers;

use App\Factories\MySQLFactory;
use App\Interfaces\IDatabase;
use App\Interfaces\IHandler;
use App\Managers\BaseManager;
use App\Managers\TokenManager;

class BaseController implements IHandler
{

    public IDatabase $factory;

    public function __construct() {
        $this->factory = new MySQLFactory(); 
        // this is the only place where the factory is created in all Controllers
        // so it avoid redundoncy in Controllers
    }

    // implements all http codes with a 405 to be overriden
    public function Get($params)
    {
        http_response_code(405);
        echo json_encode(array("status" => 405, "message" => "Method not allowed."));
    }

    public function Post($params)
    {
        http_response_code(405);
        echo json_encode(array("status" => 405, "message" => "Method not allowed."));
    }

    public function Put($params)
    {
        http_response_code(405);
        echo json_encode(array("status" => 405, "message" => "Method not allowed."));
    }

    public function Delete($params)
    {
        http_response_code(405);
        echo json_encode(array("status" => 405, "message" => "Method not allowed."));
    }

    public function Patch($params)
    {
        http_response_code(405);
        echo json_encode(array("status" => 405, "message" => "Method not allowed."));
    }

    public function EnsureLogin() {
        $tokenManager = new TokenManager($this->factory);
        if ($tokenManager->getUserFromCookies() == null) {
            http_response_code(401);
            echo json_encode(array("status" => 401, "message" => "Unauthorized."));
            die;
        }
    }

    public function EnsurePostParameters(...$Args) {
        $data = array("status" => 400, "message" => "Bad request.");
        $missing = [];
        foreach ($Args as $arg) {
            if (!isset($_POST[$arg])) {
                $missing[] = $arg;
            }
        }
        $data["reason"] = "Missing parameters: " . implode(", ", $missing);
        if (count($missing) > 0) {
            http_response_code(400);
            echo json_encode($data);
            die;
        }
    }

    public function EnsureGetParameters(...$Args) {
        foreach ($Args as $arg) {
            if (!isset($_GET[$arg])) {
                $missing[] = $arg;
            }
        }
        $data["reason"] = "Missing parameters: " . implode(", ", $missing);
        if (count($missing) > 0) {
            http_response_code(400);
            echo json_encode($data);
            die;
        }
    }

}