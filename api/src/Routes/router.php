<?php

namespace App\Routes;
use Attribute;

#[Attribute]
class Route
{
    public static $routes = [];

    public $url;
    public function __constructor(string $url) {
        Route::$routes[] = $this;
        $this->url = $url;
    }

    public function Match(string $url): bool
    {
        //check if regex from this->url matches $url
        return preg_match($this->url, $url);
    }

    public function GetParams(string $url): array
    {
        //get params from regex
        preg_match($this->url, $url, $params);
        return $params;
    }

    public static function proceed() {
        $url = $_SERVER['REQUEST_URI'];
        $url = substr($url, 4);
        $method = ucfirst(strtolower($_SERVER['REQUEST_METHOD']));
        foreach (Route::$routes as $route) {
            
            var_dump($route);
            if ($route->Match($url)) {
                $params = $route->GetParams($url);
                $route->getDeclaringClass()->$method($params);
                return true;
            }
        }
        return false;
    }

    public function getDeclaringClass()
    {
        //this is an attribute, so we need to get the class that has this attribute
        $class = get_class($this);
    }
}


// Path: /([0-9]+)/([a-zA-Z]+])

#[Route("^/")]
class Index
{
    public function Get($params)
    {
        
        phpinfo();
    }
}