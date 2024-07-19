<?php

namespace models;

use models\Database;
use PDOException;
use PDO;

class AuthUser{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByEmail($email){
        $query = "SELECT * FROM `users` WHERE `email` = ? LIMIT 1";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user ? $user : false;
        } catch (PDOException $e) {
            return false;   
        }
    }
}
