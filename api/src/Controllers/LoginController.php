<?php

namespace App\Controllers;

use App\Managers\TokenManager;
use App\Managers\UserManager;
use App\Routes\Route;

#[Route('/login')]
class LoginController extends BaseController {
    public function Post($params) {
        $tokenManager = new TokenManager($this->factory);

        $this->EnsurePostParameters("email", "password");

        $mail = $_POST['email'];
        $password = $_POST['password'];
        
        //mail regex
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(array("status" => 400, "message" => "Invalid mail."));
            return;
        }

        $userManager = new UserManager($this->factory);
        $user = $userManager->GetUserByEmail($mail);
        if ($user == null) {
            http_response_code(401);
            echo json_encode(array("status" => 401, "message" => "Invalid mail or password."));
            return;
        }

        if (!password_verify($password, $user->getPwHash())) {
            http_response_code(401);
            echo json_encode(array("status" => 401, "message" => "Invalid mail or password."));
            return;
        }
        
        
        $token = $tokenManager->GenerateToken($user);

        $tokenManager->stroreTokenForUser($token, $user->getId(), getallheaders()["X-Forwarded-For"]);

        //respond
        http_response_code(200);
        echo json_encode(array("status" => 200, "message" => "Login successful.", "token" => $token));
        
    }
}