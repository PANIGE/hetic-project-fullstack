<?php

namespace App\Managers;

use App\Entities\User;
use App\Helpers\PasswordHelper;
use Generator;

class UserManager extends BaseManager
{
    public function getAllUsers(){
        $query = $this->pdo->query("SELECT * FROM users");
        $users = $query->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($users as $user) {
            yield new User($user);
        }
    }

    public function getFilteredUsers(int $gid) {
        $query = $this->pdo->prepare("SELECT * FROM users u LEFT JOIN users_group ug ON ug.uid = u.id LEFT JOIN groups g on ug.gid = g.id WHERE g.id = :gid");
        $query->execute([':gid' => $gid]);
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


    public function GetUserByEmail(string $mail):User|null{
        $query = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");

        $query->execute(
            [
                'email' => $mail
            ]
        );
        $user = $query->fetch(\PDO::FETCH_ASSOC);
        if (!$user) {
            return null;
        }
        return new User($user);
    }

    public function CreateUser(User $user){
        $query = $this->pdo->prepare("INSERT INTO users (first_name, last_name, pw_hash, email) VALUES (:first_name, :last_name, :password, :email)");
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
        $user = $this->GetUserByUsername($username);
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