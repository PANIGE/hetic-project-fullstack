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
        foreach (Route::$routes as $iurl => $route) {
         

            $iurl = "[^".$iurl."$]";

            if (preg_match($iurl, $url)) {
                preg_match($iurl, $url, $params);
                $route->$method($params);
                return true;
            }
        }
        return false;
    }

}

