<?php

ini_set("soap.wsdl_cache_enabled", "0");
require_once "config/Database.php";
require_once "Auth.php";

class Product {

    private function authorize()
    {
        $headers = apache_request_headers();
        
        file_put_contents(
            'log/soap_debug.log',
            print_r($headers, true),
            FILE_APPEND
        );

        if (!isset($headers['AuthHeader'])) {
            throw new SoapFault("Client", "Authentication header missing");
        }

        $auth = $headers['AuthHeader'];

        // Example validation
        if ($auth->username !== 'admin' || $auth->apiKey !== '123456') {
            throw new SoapFault("Client", "Invalid credentials");
        }

        return true;
    }


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



$server = new SoapServer("service.wsdl");


$server->setClass("Product");

$server->handle();
