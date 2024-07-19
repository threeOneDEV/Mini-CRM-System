<?php
namespace models;

use PDOException;
use PDO;

class Database{
    private static $instance;
    private $conn;

    private function __construct(){
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

        try{
            $dsn = "mysql:host=$host;dbname=$dbname";
            $this->conn = new PDO($dsn,$user,$pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die ("Ошибка подключения к БД");
        }
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->conn;
    }
}


?>