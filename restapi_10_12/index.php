<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
require "Product.php";
header("content-type: application/json");
header("Access-Control-Allow-Methods: GET");

// $data = json_decode(file_get_contents("php://input"));

$product =  new Product();
echo $product->getProducts();