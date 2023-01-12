<?php
require 'vendor/autoload.php';
use App\Routes\Route;




$attribute_name = "App\Routes\Route";

$classes = [];
$classes = array_values(array_diff(scandir('src/Controllers'), array('..', '.', 'BaseController.php')));
$classes = array_map(function ($item) {
    return "App\\Controllers\\".substr($item, 0, -4);
}, $classes);


foreach ($classes as $class_name) {
    $reflection = new ReflectionClass($class_name);
    $attrs = $reflection->getAttributes();
    if (count($attrs) == 0) continue;
    if ($attrs[0]->getName() != $attribute_name) continue;
    $url = $attrs[0]->getArguments()[0];
    $object = new $class_name();
    Route::$routes[$url] = $object;
    
}


if (!Route::proceed()) {
    http_response_code(404);
    header("Content-Type: application/json");
    echo json_encode(["status" => 404, "message" => "Not Found"]);
}