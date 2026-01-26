<?php
require "User.php";
require 'auth.php';

$user = checkJWT();  

$detail = new User();
$response = $detail->profile($user);