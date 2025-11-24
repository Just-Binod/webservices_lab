<?php

ini_set("soap.wsdl_cache_enabled", "0");
require_once "config/Database.php";


class Product {


    public function hello($name) {
        return "Hello, " . $name . "!";
    }

    public function sum($a, $b) {
        return $a + $b;
    }
    
    public function getProducts()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = $conn->prepare("select * from product");

        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}



$server = new SoapServer("service.wsdl");

$server->setClass("Product");

$server->handle();
