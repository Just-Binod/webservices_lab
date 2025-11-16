<?php 

require_once "config/Database.php";

$con = new Database();

$connection = $con->getConnection();


echo "<pre>"; 

var_dump($connection);

exit;