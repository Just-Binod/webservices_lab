<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
ini_set("soap.wsdl_cache_enabled", "0");


try {
    $client = new SoapClient("http://localhost/soap/service.wsdl");

    $products = $client->getProducts();

    echo "<pre>"; print_r($products); exit;

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
