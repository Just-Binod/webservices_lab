<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
ini_set("soap.wsdl_cache_enabled", "0");



try {
    $auth = [
        'login' => 'admin1',
        'password' => 'admin123'
    ];

    $client = new SoapClient("http://localhost/soap/service.wsdl",$auth);

    $prodArr = [
        'name' => 'test',
        'desc' => 'test123',
        'created_date' => date('Y-m-d')
    ];

    $response = $client->createProduct($prodArr);

    ?>
    <h2><?php echo $response->message; ?></h2>
    <?php

    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
