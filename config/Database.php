<?php
class Database {
    
    //DB Connect
    public function connect(){
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);
    
        $hostname = $dbparts['host'];
        $username = $dbparts['username'];
        $password = $dbparts['password'];
        $database = ltrim($dbparts['path'],'/');
            
        $this->conn = null;

        try {
            $this->conn= new PDO("mysql:host=$hostname;         dbname=$database", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e){
            echo 'Connection Error ' . $e->getMessage();
        }

        return $this->conn;
    }
}
    
?>