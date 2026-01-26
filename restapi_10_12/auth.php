<?php
require 'vendor/autoload.php';
// require 'config/jwt.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function checkJWT()
{
    $headers = apache_request_headers();

    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(["error" => "Authorization header missing"]);
        exit;
    }

    // Extract Bearer token
    $authHeader = $headers['Authorization'];
    if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        
        http_response_code(401);
        echo json_encode(["error" => "Invalid Authorization header"]);
        exit;
    }

    $token = $matches[1];

    try {
        $decoded = JWT::decode($token, new Key('aslkdjaldkj@LKJLKJLKJ%LKJLKJLJLJLJlkajsdlkajsdalksdj', 'HS256'));
        return (array)$decoded;

    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(["error" => "Invalid or expired token", "details" => $e->getMessage()]);
        exit;
    }
}