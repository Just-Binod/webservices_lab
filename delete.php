<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/Database.php';
include_once 'Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

// Get data from request body (common for REST)
$data = json_decode(file_get_contents("php://input"));

// Set product ID to be deleted
$product->id = $data->id;

// Delete the product
if($product->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "Product was deleted."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Unable to delete product."));
}
?>