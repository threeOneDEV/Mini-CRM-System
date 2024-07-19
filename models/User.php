<?php

namespace models;
use models\Database;
use models\Migration;
use PDOException;
use PDO;

class User{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try{
            $this->db->query("SELECT 1 FROM `users` LIMIT 1");
        }catch(PDOException $e){
            $migration = new Migration();
            $migration->migrate();
        }
    }

    public function getAllUsers(){
        try{
            $stmt = $this->db->query("SELECT * FROM `users`");
            $users = [];

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $users[] = $row;
            }

            return $users;
        }catch(PDOException $e){
            return false;
        }     
    }

    public function findById($id){
        $query = "SELECT * FROM `users` WHERE `id` = ?";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $userById = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $userById;
        }catch(PDOException $e){
            return false;
        }
    }

    public function findByEmail($email){
        $query = "SELECT * FROM `users` WHERE `email` = ?";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);
            $userByEmail = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $userByEmail;
        }catch(PDOException $e){
            return false;
        }
    }

    public function findByLogin($login){
        $query = "SELECT * FROM `users` WHERE `login` = ?";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$login]);
            $userByLogin = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $userByLogin;
        }catch(PDOException $e){
            return false;
        }
    }

    public function add($data){
        $login = $data['login'];
        $email = $data['email'];
        $password = password_hash($data['password'],PASSWORD_DEFAULT);
        $is_admin = $data['is_admin'];
        $query = "INSERT INTO `users` (`login`,`email`,`password`,`is_admin`) VALUES (?,?,?,?)";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$login, $email, $password, $is_admin]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function update($data, $id){
        $login = $data['login'] ?? null;
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
        $is_admin = $data['is_admin'] ?? null;
        $soft_delete = $data['soft_delete'] ?? null;
        $params = [
            'login'=> $login,
            'email' => $email,
            'password' => $password ? password_hash($password,PASSWORD_DEFAULT) : $password,
            'is_admin' => $is_admin,
            'soft_delete' => $soft_delete
        ];
        $params = array_filter($params, function($value) {
            return $value !== null && $value !== "";
        });

        if ($params) {
            $query = "UPDATE `users` SET ";
            $setClauses = [];
            $values = [];
    
            foreach ($params as $key => $value) {
                $setClauses[] = "`$key` = ?";
                $values[] = $value;
            }
    
            $query .= implode(', ', $setClauses);
            $query .= " WHERE `id` = ?";
            $values[] = $id;

            try {
                $stmt = $this->db->prepare($query);
                $stmt->execute($values);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
    }
}