<?php

namespace models;
use models\Database;
use models\Migration;
use PDO;
use PDOException;

class Contact{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try{
            $this->db->query("SELECT 1 FROM `contacts` LIMIT 1");
        }catch(PDOException $e){
            $migration = new Migration();
            $migration->migrate();
        }
    }

    public function getAllContacts(){
        try{         
            $stmt = $this->db->query("SELECT 
                                    `contacts`.`id`,
                                    `contacts`.`name`,
                                    `contacts`.`email`,
                                    `contacts`.`phone`,
                                    `contacts`.`users_id`,
                                    `users`.`login` AS 'user_login',
                                    `contacts`.`soft_delete`
                                    FROM `contacts`
                                    JOIN `users` ON `contacts`.`users_id` = `users`.`id`");
            $contacts = [];

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $contacts[] = $row;
            }

            return $contacts;
        }catch(PDOException $e){
            return false;
        }  
    }

    public function findById($id){
        $query = "SELECT * FROM `contacts` WHERE `id` = ?";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $contactById = $stmt->fetch(PDO::FETCH_ASSOC);
            return $contactById;
        }catch(PDOException $e){
            return false;
        }

    }

    public function findByPhone($phone){
        $query = "SELECT * FROM `contacts` WHERE `phone` = ?";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$phone]);
            $contactByPhone = $stmt->fetch(PDO::FETCH_ASSOC);
            return $contactByPhone;
        }catch(PDOException $e){
            return false;
        }

    }

    public function findLastContact(){
        try{
            $stmt = $this->db->query("SELECT MAX(`id`) FROM `contacts`");
            $lastContact = $stmt->fetchColumn();
            return $lastContact;
        }catch(PDOException $e){
            return false;
        }
    }

    public function add($data, $id){
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $query = "INSERT INTO `contacts` (`name`,`email`,`phone`,`users_id`) VALUES (?,?,?,?)";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$name, $email, $phone, $id]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function update($data,$id){   
        $name = $data['name'] ?? null;
        $email = $data['email'] ?? null;
        $phone = $data['phone'] ?? null;
        $soft_delete = $data['soft_delete'] ?? null;
        $users_id = $data['users_id'] ?? null;
        $params = [
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone,
            'soft_delete'=>$soft_delete,
            'users_id'=>$users_id
        ];
        $params = array_filter($params, function($value) {
            return $value !== null && $value !== "";
        });

        if($params){
            $query = "UPDATE `contacts` SET ";
            $setClauses = [];
            $values = [];

            foreach($params as $key => $value){
                $setClauses[] = "`$key` = ?";
                $values[] = $value;
            }

            $query .= implode(', ',$setClauses);
            $query .= " WHERE `id` = ?";
            $values[] = $id;

            try{
                $stmt = $this->db->prepare($query);
                $stmt->execute($values);
                return true;
            }catch(PDOException $e){
                return false;
            }
        }
    }

    public function delete($id){
        $query = "DELETE FROM `contacts` WHERE `id` = ?";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}