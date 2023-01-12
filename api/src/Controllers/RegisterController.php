<?php

namespace App\Controllers;

use App\Entities\User;
use App\Helpers\PasswordHelper;
use App\Managers\TokenManager;
use App\Managers\UserManager;
use App\Routes\Route;

#[Route('/register')]
class RegisterController extends BaseController {
    public function Post($params) {
        $this->EnsurePostParameters("password", "email", "firstname", "lastname");
        $password = $_POST['password'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        $userManager = new UserManager($this->factory);
        $user = $userManager->GetUserByEmail($email);

        if ($user != null) {
            http_response_code(409);
            echo json_encode(array("status" => 409, "message" => "Email already in use."));
            return;
        }

        $pwHelper = new PasswordHelper();

        $user = new User([
            "pw_hash" => $pwHelper->HashPassword($password),
            "email" => $email,
            "first_name" => $firstname,
            "last_name" => $lastname
        ]);
        $user->setEmail($email);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);


        $userManager->CreateUser($user);

        $tokenManager = new TokenManager($this->factory);
        $token = $tokenManager->GenerateToken($user);
        $tokenManager->stroreTokenForUser($token, $user->getId(), getallheaders()["X-Forwarded-For"]);

        //respond
        http_response_code(200);
        echo json_encode(array("status" => 200, "message" => "Registration successful.", "token" => $token));
    }
}