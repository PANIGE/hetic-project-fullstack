<?php

require('src/Routes/router.php');

use App\Routes\Route;

$reflection = new ReflectionClass(Route::class);
$attributes = $reflection->getAttributes();

    foreach ($attributes as $attribute) {
       var_dump($attribute->getName());
       var_dump($attribute->getArguments());
       var_dump($attribute->newInstance());
    }

Route::proceed();