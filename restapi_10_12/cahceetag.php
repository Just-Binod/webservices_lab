<?php
$data = [
    "products" => ["Laptop", "Mobile", "Tablet","hello"]
];

$response = json_encode($data);
$etag = md5($response);


header("Content-Type: application/json");
header("ETag: \"$etag\"");
header("Cache-Control: public, max-age=60");

if (isset($_SERVER['HTTP_IF_NONE_MATCH']) &&
    trim($_SERVER['HTTP_IF_NONE_MATCH']) === $etag) {
    http_response_code(304);
    exit;
}
echo $response;