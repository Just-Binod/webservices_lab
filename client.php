<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
ini_set("soap.wsdl_cache_enabled", "0");



try {
    $client = new SoapClient("http://localhost/soap/service.wsdl");
    // $id = 15;
    // $products = $client->getProductById($id);

    // echo "<pre>"; print_r($products); exit;

    
    $prodArr = [
        'name' => $_POST['name'],
        'desc' => $_POST['desc'],
        'created_date' => date('Y-m-d')
    ];
    // echo "<pre>"; print_r($prodArr); exit;
    $response = $client->createProduct($prodArr);

    ?>
    <h1><?php echo $response->message;?></h1>
    <?php

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
