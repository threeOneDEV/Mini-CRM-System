<?php

namespace models;

use models\Database;
use models\Migration;
use PDOException;
use PDO;

class Product{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $this->db->query("SELECT 1 FROM `products` LIMIT 1");
        } catch (PDOException $e) {
            $migration = new Migration();
            $migration->migrate();
        }
    }

    public function getAllProducts(){
        try {
            $stmt = $this->db->query("SELECT * FROM `products`");
            $products = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products[] = $row;
            }

            return $products;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function add($data){
        $title = $data['title'];
        $price = $data['price'];
        $query = "INSERT INTO `products` (`title`,`price`) VALUES (?,?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $price]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($data, $id){
        $title = $data['title'] ?? null;
        $price = $data['price'] ?? null;
        $soft_delete = $data['soft_delete'] ?? null;
        $params = [
            'title' => $title,
            'price' => $price,
            'soft_delete' => $soft_delete
        ];
        $params = array_filter($params, function ($value) {
            return $value !== null && $value !== "";
        });

        if ($params){
            foreach ($params as $key => $value) {
                $query = "UPDATE `products` SET ";
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