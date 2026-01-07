<?php

ini_set("soap.wsdl_cache_enabled", "0");
require_once "config/Database.php";

class Product {
    private $conn;
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();

    }
    public function getProducts()
    {
        $sql = $this->conn->prepare("select * from product");

        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function createProduct($data)
    {
        $name = $data->name;
        $desc = $data->description;
        $created = $data->created_at;

        $sql = $this->conn->prepare("
            Insert into product (name, `desc`, created_date) values (:name, :description, :created_at)
        ");
        $res = $sql->execute([
            ':name'=> $name,
            ':description' => $desc,
            ':created_at' =>$created
        ]);
        if($res){
            http_response_code(200);
            exit;
        }else{
            http_response_code(500);
            exit;
        }
    }
    public function updateProduct($data,$id)
    {
        $sql = $this->conn->prepare("update product set name = :name, `desc` = :desc, created_date = :created_date");
        $res = $sql->execute([
            ':name' => $data->name,
            ':desc' => $data->desc,
            ':created_date' => $data->created_date
        ]);
        if($res){
            return json_encode(['message'=>'updated']);
        }else{
            return json_encode(['message'=>'Not updated, Try again']);
        }
    }
    public function getProductById($id){
        
        $sql = $this->conn->prepare("select * from product where id = :id");
        $sql->execute([
            ':id' => $id
        ]);
        $res = $sql->fetch(PDO::FETCH_ASSOC);

        return $res;
    }

}