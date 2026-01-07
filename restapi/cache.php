<?php
header("Content-Type: application/json");
header("Cache-Control: public, max-age=60");

$cacheFile = __DIR__ . '/cache.json';



// Server-side cache
if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 60) {
    echo file_get_contents($cacheFile);
    exit;
}


$response = [[
    "status" => "success3",
    "data" => "This response is cached for 60 seconds",
    "time" => time()
]];

file_put_contents($cacheFile, json_encode($response));
echo json_encode($response);