<?php
class Database{
 
    private $host = "172.17.98.54";
    private $db_name = "dev_iot_prod ";
    private $username = "dev_uapp";
    private $password = "teUC9M@T!DJvd";
    public $conn;

    public function __construct(){
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
 
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           // $this->conn->execute();
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>
