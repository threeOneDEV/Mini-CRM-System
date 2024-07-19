<?php

namespace models;
use models\Database;
use models\Migration;
use PDOException;
use PDO;

class Comment{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try{
            $this->db->query("SELECT 1 FROM `comments` LIMIT 1");
        }catch(PDOException $e){
            $migration = new Migration();
            $migration->migrate();
        }
    }

    public function getAllComments(){
        try{
            $stmt = $this->db->query("SELECT 
            `comments`.`id`, 
            `comments`.`date`,
            `comments`.`description`, 
            `users`.`login` as 'user_login', 
            `comments`.`contacts_id` 
            FROM `comments`
            JOIN `users` ON `comments`.`users_id` = `users`.`id`
            ORDER BY `comments`.`date` ASC");
            $comments = [];

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $comments[] = $row;
            }

            return $comments;
        }catch(PDOException $e){
            return false;
        }    
    }

    public function add($data,$usersId,$contactsId){
        $description = $data['description'];
        $query = "INSERT INTO `comments`(`description`,`users_id`,`contacts_id`) VALUES (?,?,?)";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$description,$usersId,$contactsId]);
            return true;
        }catch(PDOException $e){
            return false;
        }

    }

    public function deleteByContactId($id){
        $query = "DELETE FROM `comments` WHERE `contacts_id` = ?";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}