<?php
namespace App\Managers;
use App\Entities\User;
use App\Factories\MySQLFactory;
use App\Helper\TokenHelper;
use App\Interfaces\IDatabase;


class TokenManager extends BaseManager
{
    public function __construct(IDatabase $factory)
    {
        parent::__construct($factory);
    }
    
    public function checkToken($token)
    {
        $token = $this->pdo->prepare('SELECT * FROM tokens WHERE token = :token');
        $token->execute([
            'token' => $token
        ]);
        $token = $token->fetch();
        if ($token) {
            return true;
        }
        return false;
    }

    public function getUserByToken($token)
    {
        
        $query = $this->pdo->prepare("SELECT id FROM tokens WHERE token = '$token'");
        $query->execute();
        $user=$query->fetch(\PDO::FETCH_ASSOC);
        var_dump($user);
        $userManager = new UserManagers(new MySQLFactory());
        return $userManager->getUser($user['id']);
        
    }

    public function stroreTokenForUser($token, $user_id)
    {
        $token = $this->pdo->prepare('INSERT INTO tokens (token, user_id) VALUES (:token, :user_id)');
        $token->execute([
            'token' => $token,
            'user_id' => $user_id
        ]);
    }

    public function deleteToken($token)
    {
        $token = $this->pdo->prepare('DELETE FROM tokens WHERE token = :token');
        $token->execute([
            'token' => $token
        ]);
    }

    public function create(){
        $TokenHelper=new TokenHelper();
        $token=$_COOKIE['token']??null;
        $token ??= $TokenHelper->generateToken();
        if(!isset($_COOKIE['token'])){
            setcookie('token',$token);
        }
        return $token;
    }

    public function getUserFromCookies() : ?User {
        if (isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
            return $this->getUserByToken($token);
        }
    }

}