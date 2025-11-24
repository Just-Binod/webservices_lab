<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

$id = $_GET['id'];
include "Product.php";

$products = new Product();

$result = $products->getProductById($id);

?>
<h1><?php echo $result['name']?></h1>
<p>
    <?php echo $result['desc']?>
</p>