<?php

ini_set("soap.wsdl_cache_enabled", "0");
require_once "config/Database.php";
require_once "Auth.php";

class Product {

    
    public function hello($name) {
        return "Hello 12, " . $name . "!";
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

    public function getProductById($id)
    {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = $conn->prepare("SELECT * FROM product WHERE id = :id");

        $sql->execute([':id' => $id]);
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function createProduct($product)
    {
        Auth::check();
        $name  = $product->name;
        $desc = $product->desc;
        $created_date   = $product->created_date;

        $db = new Database();
        $conn = $db->getConnection();

        $sql = $conn->prepare(
            "INSERT INTO product (`name`, `desc`, created_date)
            VALUES (:name, :desc, :created_date)"
        );

        $result = $sql->execute([
            ':name' => $name,
            ':desc' => $desc,
            ':created_date' => $created_date
        ]);

        if($result){
            return [
                'status' => true,
                'message' => 'Product created successfully',
                'id' => $conn->lastInsertId()
            ];
        }else{
            return [
                'status' => false,
                'message' => 'please try again later',
                'id' => "0"
            ];
        }

    }
}



$server = new SoapServer("service.wsdl", [
    'cache_wsdl' => WSDL_CACHE_NONE
]);

$service = new Product();
$server->setObject($service);

$server->handle();
