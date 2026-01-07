<?php
require "config/Database.php";

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
            $loggedIn = [
                'status' => 'OK',
                'email' => $res['email'],
                'message' => "logged in"
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
    public function signup()
    {

    }
}