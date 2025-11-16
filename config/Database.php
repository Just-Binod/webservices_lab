<?php
/*
* Class: Database
* PDO class for connection datbase
* @retrun connection object
* @author: nast be computer VII <>
*/ 
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "password";
    private $dbName = "ecom";
    private $connection = "";

    public function __construct(){
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
            $this->connection = $pdo;
        } catch(PDOException $err) {
            die($err->getMessage());
        }
    }
    /*
    *
    */
    public function getConnection()
    {
        return $this->connection;
    }
    
}