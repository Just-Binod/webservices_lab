<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

require "Product.php";

header("content-type: application/json");
header("Access-Control-Allow-Methods: PUT");

$data = json_decode(file_get_contents("php://input"));
$id = isset($_GET['id']) ? $_GET['id'] : 0;

if(!$id){
    http_response_code(400);
    echo json_encode(['message'=>'Id not found']);
    exit;
}


$product =  new Product();
$check_record = $product->getProductById($id);
// echo $check_record; exit;
if($check_record){
    echo $product->updateProduct($data, $id);
}else{
    echo json_encode(
        [
            'message' => "record not found in database"
        ]
    );
    exit;
}