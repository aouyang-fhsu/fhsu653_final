<?php
class Database {
    
    //DB Connect
    public function connect(){
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);
    
        $hostname = $dbparts['host'];
        $username = $dbparts['username'];
        $password = $dbparts['password'];
        $database = $dbparts['Database'];

        $dsn = "mysql:host={$hostname};dbname={$database}";
            
        $this->conn = null;

        try {
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e){
            echo 'Connection Error ' . $e->getMessage();
        }

        return $this->conn;
    }
}
    
?>