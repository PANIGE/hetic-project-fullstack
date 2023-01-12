<?php

namespace App\Controllers;
use App\Interfaces\IHandler;

class BaseController implements IHandler
{
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

}