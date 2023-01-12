<?php

namespace App\Controllers;
use App\Routes\Route;

#[Route('/infos')]
class InfosHandler extends BaseController {
    public function Get($params) {
        phpinfo();
    }
}