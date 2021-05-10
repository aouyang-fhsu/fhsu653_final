<?php
class Database {
    private static $host = 'y5svr1t2r5xudqeq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';     
    private static $username = 'dtlblzne3cfwivk8';
    private static $db_name = 'gic4xphvg8gbi3j6';
    private static $password = 'jozx23uetptqw1le';
    private static $conn;
    
    //DB Connect
    public function connect(){
        $this->conn = null;

        try {
            $this->conn= new PDO('mysql:host=' . $this->host .';dbname=' . $this->db_name, $this->$username, $this->$password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXECPTION);
        } catch(PDOException $e){
            echo 'Connection Error ' . $e->getMessage();
        }

        return $this->conn;
    }

    
?>