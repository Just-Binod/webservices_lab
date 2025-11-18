<?php

ini_set("soap.wsdl_cache_enabled", "0");

class Product {

    public function hello($name) {
        return "Hello, " . $name . "!";
    }

    public function sum($a, $b) {
        return $a + $b;
    }
}

$server = new SoapServer("service.wsdl");

$server->setClass("Product");

$server->handle();
