<?php
namespace App\Managers;
use App\Entities\User;
use App\Factories\MySQLFactory;
use App\Helpers\TokenHelper;
use App\Interfaces\IDatabase;
use PDO;


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
        $token = $token->fetch(PDO::FETCH_ASSOC);
        if (!$token) {
            return false;
        }
        if ($token["created_at"] < time() - 3600) {
            $this->deleteToken($token);
            return false;
        }
        if ($token["request_ip"] == getallheaders()['X-Forwarded-For']) {
            
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
        $userManager = new UserManager(new MySQLFactory());
        return $userManager->getUser($user['id']);
        
    }

    public function stroreTokenForUser($token, $user_id, $ip)
    {

        $tokenReq = $this->pdo->prepare('INSERT INTO webtokens (token, user_id, request_ip, created_at) VALUES (:token, :user_id, :request_ip, :created_at)');
        $tokenReq->execute([
            'token' => $token,
            'user_id' => $user_id,
            'request_ip' => $ip,
            'created_at' => time()
        ]);
    }

    public function deleteToken($token)
    {
        $token = $this->pdo->prepare('DELETE FROM tokens WHERE token = :token');
        $token->execute([
            'token' => $token
        ]);
    }

    public function GenerateToken(User $user){
        $TokenHelper=new TokenHelper();
        $token=$_COOKIE['token']??null;
        $token ??= $TokenHelper->generateToken($user);
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