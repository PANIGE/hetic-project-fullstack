<?php

namespace App\Controllers;

use App\Entities\Group;
use App\Entities\User;
use App\Managers\GroupManager;
use App\Managers\TokenManager;
use App\Managers\UserManager;
use App\Routes\Route;

#[Route('/groups/(\d+|new)/(\d+|add)?')]
class LoginController extends BaseController {
    public function Get($params) {
        $group_id = $params[1];
        $user_id = $params[2];

        if ($group_id == "new") {
            $this->Create();
        } else if ($group_id != "new" && !isset($user_id)) {
            $this->ListUser($group_id);
        }
        else {
            http_response_code(405);
            echo json_encode(array("status" => 405, "message" => "Method not allowed."));
        }
    }

    public function Post($params) {
        $group_id = $params[1];
        $user_id = $params[2];

        if ($group_id != "new" && $user_id == "add") {
            $this->AddUser($group_id, $user_id);
        } else {
            http_response_code(405);
            echo json_encode(array("status" => 405, "message" => "Method not allowed."));
        }
    }

    public function Delete($params)
    {
        $group_id = $params[1];
        $user_id = $params[2];

        if ($group_id != "new" && $user_id != "add") {
            $this->DeleteUser($group_id, $user_id);
        } else {
            http_response_code(405);
            echo json_encode(array("status" => 405, "message" => "Method not allowed."));
        }
    }

    public function Create() {
        $this->EnsurePostParameters("name", "description");
        $this->EnsureLogin();
        $tokenManager = new TokenManager($this->factory);
        $user = $tokenManager->getUserFromCookies();

        $group = new Group();
        $group->setName($_POST['name']);
        $group->setOwner($user->getId());

        $groupManager = new GroupManager($this->factory);
        $groupManager->createGroup($group);
        http_response_code(201);
        echo json_encode([
            "id" => $group->getId(),
            "name" => $group->getName(),
            "owner" => $group->getOwner()
        ]);

    }

    public function AddUser($group_id) {
        $this->EnsurePostParameters("user_id");
        $this->EnsureLogin();
        $tokenManager = new TokenManager($this->factory);
        $user = $tokenManager->getUserFromCookies();

        $groupManager = new GroupManager($this->factory);
        $groupManager->addUser($group_id, $_POST['user_id']);
        http_response_code(201);
    }

    public function DeleteUser($group_id, $user_id) {
        $this->EnsureLogin();
        $tokenManager = new TokenManager($this->factory);
        $user = $tokenManager->getUserFromCookies();

        $groupManager = new GroupManager($this->factory);
        $groupManager->deleteUser($group_id, $user_id);
        http_response_code(201);
    }

    public function ListUser($group_id)
    {
        $this->EnsureLogin();
        $tokenManager = new TokenManager($this->factory);
        $user = $tokenManager->getUserFromCookies();

        $groupManager = new GroupManager($this->factory);
        $users = $groupManager->getGroupUsers($group_id);
        http_response_code(200);
        $users = array_map(function (User $user) {
            return [
                "id" => $user->getId(),
                "email" => $user->getEmail(),
                "firstname" => $user->getFirstname(),
                "lastname" => $user->getLastname(),
                "phone" => $user->getPhone(),
            ];
        }, $users);
        echo json_encode($users);
    }

}