<?php

namespace App\Managers;

use App\Entities\User;
use App\Helper\PasswordHelper;
use Generator;

class UserManagers extends BaseManager
{
    public function getAllUsers(){
    $query = $this->pdo->query("SELECT * FROM users");
    $users = $query->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($users as $user) {
        yield new User($user);
    }
}

    public function getUser($id):User{
        $query = $this->pdo->prepare("SELECT * FROM users WHERE id = $id");
        $query->execute(
            [
                'id' => $id
            ]
        );
        $user = $query->fetch(\PDO::FETCH_ASSOC);
        return new User($user);
    }

    public function getUserFromName(string $username):User{
        $query = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $query->execute(
            [
                'username' => $username
            ]
        );
        $user = $query->fetch(\PDO::FETCH_ASSOC);
        return new User($user);
    }

    public function createUser(User $user){
        $query = $this->pdo->prepare("INSERT INTO users (first_name,last_name, password, email, role) VALUES (:username, :password, :email, :role)");
        $query->execute(
            [
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'password' => PasswordHelper::hashPassword($user->getPwHash()),
                'email' => $user->getEmail(),
            ]
        );
    }

    public function updateUser(User $user){
        $query = $this->pdo->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, password = :password, email = :email, role = :role WHERE id = :id");
        $query->execute(
            [
                'id' => $user->getId(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'password' => PasswordHelper::hashPassword($user->getPwHash()),
                'email' => $user->getEmail(),
                'role' => $user->getRank()
            ]
        );
    }

    public function deleteUser($id){
        $query = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $query->execute(
            [
                'id' => $id()
            ]
        );
    }

    public function login(string $username, string $password):bool{
        $user = $this->getUserFromName($username);
        if($user->getId() === null){
            return false;
        }
        return PasswordHelper::verifyPassword($password, $user->getPwHash());
    }

    public function register(string $username, string $password, string $email){
        $query= $this->pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email");
        $query->execute(
            [
                'username' => $username,
                'password' => PasswordHelper::hashPassword($password),
                'email' => $email
            ]
        );

}
}