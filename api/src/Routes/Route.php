<?php

namespace App\Routes;
use Attribute;

#[Attribute]
class Route
{
    public static $routes = [];

    public static function proceed() {
        $url = getallheaders()['X-Forwarded-URI'];
        $url = substr($url, 4);
        $method = ucfirst(strtolower($_SERVER['REQUEST_METHOD']));

        if ($method == "Head") $method = "Get";

        if ($method== "Post") {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }
        foreach (Route::$routes as $iurl => $route) {
         

            $iurl = "[^".$iurl."$]";

            if (preg_match($iurl, $url)) {
                preg_match($iurl, $url, $params);
                header("Content-Type: application/json");
                $route->$method($params);
                return true;
            }
        }
        return false;
    }

}

