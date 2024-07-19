<?php

namespace models;
use models\Database;
use PDOException;
use PDO;

class Migration{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function migrate(){
        try{
            $this->createUsersTable();
            $this->createContactsTable();
            $this->createCommentsTable();
            $this->createTasksTable();
            $this->createProductsTable();
            $this->createOffersTable();
        }catch(PDOException $e){
            return false;
        }
    }

    private function createUsersTable(){
        $usersTableQuery = "CREATE TABLE IF NOT EXISTS `users`(
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `login` VARCHAR(100) NOT NULL,
            `email` VARCHAR(100) NOT NULL,
            `password` VARCHAR(500) NOT NULL,
            `is_admin` INT(1) NOT NULL DEFAULT 0 ,
            `created_ad` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `soft_delete` INT(1) NOT NULL DEFAULT 0)";

        try{
            $this->db->exec($usersTableQuery);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    private function createContactsTable(){
        $contactsTableQuery = "CREATE TABLE IF NOT EXISTS `contacts`(
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `phone` VARCHAR(11) NOT NULL,
        `users_id` INT(11) NULL,
        `soft_delete` INT(1) NOT NULL DEFAULT 0,
        PRIMARY KEY(`id`),
        FOREIGN KEY(`users_id`) REFERENCES `users`(`id`))";

        try{
            $this->db->exec($contactsTableQuery);
            return true;
        }catch(PDOException $e){
            return false;
        }  
    }

    private function createCommentsTable(){
        $commentsTableQuery = "CREATE TABLE IF NOT EXISTS `comments`(
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `description` VARCHAR(1000) NOT NULL,
        `users_id` INT(11) NULL,
        `contacts_id` INT(11) NOT NULL,
        PRIMARY KEY(`id`),
        FOREIGN KEY(`users_id`) REFERENCES `users`(`id`),
        FOREIGN KEY(`contacts_id`) REFERENCES `contacts`(`id`))";

        try{
            $this->db->exec($commentsTableQuery);
            return true;
        }catch(PDOException $e){
            return false;
        }  
    }

    private function createTasksTable(){
        $tasksTableQuery = "CREATE TABLE IF NOT EXISTS `tasks`(
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `description` VARCHAR(100) NOT NULL,
            `deadline` date NOT NULL,
            `users_id` INT(11) NOT NULL, 
            PRIMARY KEY (`id`),
            FOREIGN KEY (`users_id`) REFERENCES `users`(`id`))";
    
            try{
                $this->db->exec($tasksTableQuery);
                return true;
            }catch(PDOException $e){
                return false;
            }
    }

    private function createProductsTable(){
        $productsTableQuery = "CREATE TABLE IF NOT EXISTS `products`(
        `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(100) NOT NULL,
        `price` INT(11) NOT NULL),
        `soft_delete` INT(1) NOT NULL DEFAULT 0)";

        try{
            $this->db->exec($productsTableQuery);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    private function createOffersTable(){
        $offerTableQuery = "CREATE TABLE IF NOT EXISTS `offers`(
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `products_id` INT(11) NOT NULL,
            `discount` INT(2) NULL,
            `users_id` INT(11) NOT NULL,
            `contacts_id` INT(11) NOT NULL,
            `price` DECIMAL(10,2) NOT NULL,
            `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY(`id`),
            FOREIGN KEY(`products_id`) REFERENCES `products`(`id`),
            FOREIGN KEY(`users_id`) REFERENCES `users`(`id`),
            FOREIGN KEY(`contacts_id`) REFERENCES `contacts`(`id`))";

        $triggerCalculatedOfferPrice = 
            "CREATE TRIGGER `calculated_offer_price` BEFORE INSERT ON `offers` FOR EACH ROW BEGIN
                DECLARE original_price DECIMAL(10,2);
                SELECT `price` INTO original_price FROM `products` WHERE `id` = NEW.`products_id`;
                IF NEW.`discount` IS NOT NULL THEN
                    SET NEW.`price` = original_price - (original_price * NEW.`discount` / 100);
                ELSE
                    SET NEW.`price` = original_price;
                END IF;
            END";
    
            try{
                $this->db->exec($offerTableQuery);
                $this->db->exec($triggerCalculatedOfferPrice);
                return true;
            }catch(PDOException $e){
                return false;
            }
    }
}