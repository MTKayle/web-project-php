<?php
class Database{
    private $host = "localhost";
    private $dbName = "toys_store";
    private $userName = "root";
    private $password = "";
    public $connection;

    public function getConnection(){
        $this->connection = null;
        try {
            $this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName, $this->userName, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
            
        }
        return $this->connection;
    }
}
?>