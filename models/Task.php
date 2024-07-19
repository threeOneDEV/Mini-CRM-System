<?php

namespace models;

use models\Migration;
use models\Database;
use PDOException;
use PDO;

class Task{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try{
            $this->db->query("SELECT 1 FROM `tasks` LIMIT 1");
        }catch(PDOException $e){
            $migration = new Migration();
            $migration->migrate();
        }
    }

    public function getAllTasks(){
        try{
            $stmt = $this->db->query("SELECT * FROM `tasks`");
            $tasks = [];

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $tasks[] = $row;
            }

            return $tasks;
        }catch(PDOException $e){
            return false;
        }
    }

    public function findById($id){
        $query = "SELECT * FROM `tasks` WHERE `id` = ?";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $taskById = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $taskById;
        }catch(PDOException $e){
            return false;
        }
    }

    public function add($data,$id){
        $description = $data['description'];
        $deadline = $data['deadline'];
        $query = "INSERT INTO `tasks` (`description`,`deadline`,`users_id`) VALUES (?,?,?)";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$description,$deadline,$id]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        $query = "DELETE FROM `tasks` WHERE `id` = ?";

        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function update($data,$id){
        $description = $data['description'] ?? null;
        $deadline = $data['deadline'] ?? null;
        $is_done = $data['is_done'] ?? null;
        $params = [
            'description'=>$description,
            'deadline'=>$deadline,
            'is_done'=>$is_done
        ];
        $params = array_filter($params, function($value) {
            return $value !== null && $value !== "";
        });

        if($params){
            $query = "UPDATE `tasks` SET ";
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
}