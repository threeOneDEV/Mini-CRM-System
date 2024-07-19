<?php

namespace models;

use models\Database;
use models\Migration;
use PDOException;
use PDO;


class Offer{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $this->db->query("SELECT 1 FROM `offers` LIMIT 1");
        } catch (PDOException $e) {
            $migration = new Migration();
            $migration->migrate();
        }
    }

    public function getAllOffers(){
        try {
            $stmt = $this->db->query("SELECT 
                                    `offers`.`id`, 
                                    `products`.`title` AS 'product_title', 
                                    `discount`,
                                    `users_id`,
                                    `users`.`login` AS 'user_login',
                                    `contacts_id`,  
                                    `date`,
                                    `offers`.`price` AS 'calculated_price'
                                    FROM `offers`
                                    JOIN `products` ON `offers`.`products_id` = `products`.`id`
                                    JOIN `users` ON `offers`.`users_id` = `users`.`id`");
            $offers = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $offers[] = $row;
            }

            return $offers;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function add($data, $users_id, $contacts_id){
        $product = $data['product'];
        $discount = $data['discount'] === "" ? NULL : $data['discount'];
        $params = [
            'products_id' => $product,
            'discount' => $discount,
            'users_id' => $users_id,
            'contacts_id' => $contacts_id
        ];
        $params = array_filter($params, function ($value) {
            return $value !== null && $value !== "";
        });

        foreach ($params as $key => $value) {
            $setKey[] = $key;
            $setValue[] = $value;
            $setClauses[] = "?";
        }

        $setKey = implode(', ', $setKey);
        $setClauses = implode(', ', $setClauses);
        $query = "INSERT INTO `offers`($setKey) VALUES ($setClauses)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($setValue);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteByContactId($id){
        $query = "DELETE FROM `offers` WHERE `contacts_id` = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
