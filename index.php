<?php
header("Content-Type: application/json");


require "Product.php";

$product = new Product();

// echo $product->getProducts();


echo json_encode($product->getProducts());







