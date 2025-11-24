<?php
include_once "conofig/Database.php";

class Product
{
    private $id;
    private $name;
    private $desc;
    private $created_date;
    private $connection;

    public function __construct()
    {
        $conn = new Database();
        $this->connection = $conn->getConnection();
    }

    public function getProducts()
    {
        //Fetch products form database table
        $sql = $this->connection->prepare("select * from product");
        $sql->execute();

        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
             
    }
    public function createProduct()
    {
        //push array in database
        try{
            $sql = $this->connection->prepare("insert into product (`name`, `desc`) values (:test123, :description)");
            $sql->execute(
                [
                    ':test123' => "pusp",
                    ':description' => "This is desctription"
                ]
            );
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function getProductById($id)
    {
        // pull single product form database

        $sql = $this->connection->prepare("select * from product where id = :id");
        $sql->execute([
            ':id' => $id
        ]);

        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}