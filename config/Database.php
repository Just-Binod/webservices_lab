<?php
/*
* Class: Database
* PDO class for connecting to database
*/

class Database
{
    private $host = "localhost:3307";  # Adjusted port for 3307, if your is defaulttt dont use : 3307
    private $username = "root";
    private $password = "";
    private $dbName = "crud_oop";
    private $connection;

    public function __construct()
    {
        try {
            $pdo = new PDO(
                "mysql:host=$this->host;dbname=$this->dbName",
                $this->username,
                $this->password
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

            $this->connection = $pdo;
        } catch (PDOException $err) {
            die($err->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
