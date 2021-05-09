<?php
class Database {
    private static $dsn = 'mysql:host=y5svr1t2r5xudqeq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=gic4xphvg8gbi3j6';     
    private static $username = 'dtlblzne3cfwivk8';
    private static $password = 'jozx23uetptqw1le';
    private static $db;
    
    private function __construct(){}

    public static function getDB(){
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                    self::$username,
                                    self::$password
                                );
            } catch (PDOException $e) {
                $error = "Database Error: ";
                $error .= $e->getMessage();
                include('../view/error.php');
                exit();
            }
        }
        return self::$db;
    }
}

    
?>