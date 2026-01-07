<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

header("content-type: application/json");
header("Access-Control-Allow-Methods: POST");
require_once "User.php";

$data = json_decode(file_get_contents("php://input"));

$user = new User();
echo $user->login($data);
// echo password_hash("kathmandu",PASSWORD_DEFAULT);

