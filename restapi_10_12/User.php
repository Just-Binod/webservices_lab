<?php
require "config/Database.php";
require "vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class User{
    private $conn;
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    public function login($data){
        $sql = $this->conn->prepare("select id, email,password from users where email = :e");
        $sql->execute([
            ':e' => $data->email
        ]);
        $res = $sql->fetch(PDO::FETCH_ASSOC);
        
        
        if(password_verify($data->password, $res['password'])){
            $key = 'aslkdjaldkj@LKJLKJLKJ%LKJLKJLJLJLJlkajsdlkajsdalksdj';
            $payload = [
                'iss' => 'Rest api PHP',
                'aud' => 'For the purpose of authentication and authorization',
                'iat' => time(),
                'email'=> $res['email']
            ];    
            $loggedIn = [
                'status' => 'loggedin',
                'message' => "Logged in successfully",
                'token' => JWT::encode($payload, $key, 'HS256')
            ];

            return json_encode($loggedIn); exit;
        }else{
            $loggedIn = [
                'status' => 'false',
                'error' => "invalid password"
            ];

            return json_encode($loggedIn); exit;
        }
    }
    public function profile($user)
    {
        
        $sql = $this->conn->prepare("select id, email,password from users where email = :e");
        $sql->execute([
            ':e' => $user['email']
        ]);
        $res = $sql->fetch(PDO::FETCH_ASSOC);

        echo "<pre>"; print_r($res); exit;

    }
}