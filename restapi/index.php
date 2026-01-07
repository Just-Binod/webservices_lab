<?php
header("Content-Type: application/json");

require 'auth.php';
require 'users.php';

$user = authenticate();

$method = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));


$resource = end($uri) ?? null;


if ($resource !== 'users') {
    http_response_code(404);
    echo json_encode(['error' => 'Resource not found']);
    exit;
}

switch ($method) {
    case 'GET':
        echo json_encode(getUsers());
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(createUser($data));
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
