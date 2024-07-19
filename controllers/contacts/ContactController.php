<?php

namespace controllers\contacts;
use models\Contact;
use models\Comment;
use models\Product;
use models\User;

class ContactController{
    public function index(){
        $contactModel = new Contact;
        $commentModel = new Comment;
        $productModel = new Product;
        $userModel = new User;
        $contacts = $contactModel->getAllContacts();
        $comments = $commentModel->getAllComments();
        $products = $productModel->getAllProducts();
        $users = $userModel->getAllUsers();
        $errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;
        unset($_SESSION['error_message']);
        include('app/views/contacts/index.php');
    }

    public function store($params){
        $users_id = $params['id_first'];
        $contacts_id = $params['id_second'] ?? null;

        if(isset($_POST['button_add_contact'])){
            $contactModel = new Contact;
            $commentModel = new Comment;
            $contactByPhone = $contactModel->findByPhone($_POST['phone']);

            if($contactByPhone){
                switch($contactByPhone['soft_delete']){
                    case(0):
                        $_SESSION['error_message'] = "Контакт с данным номером уже сущестует!";
                        header('Location: /contacts');
                        break;
                    case(1):
                        $data['description'] = "КОНТАКТ ДОБАВЛЕН" . '<br> <br>' . "РАННЯЯ ИНФОРМАЦИЯ"  . '<br>' .  "email - {$contactByPhone['email']} || name - {$contactByPhone['name']}";
                        $commentModel->add($data, $params['id_first'], $contactByPhone['id']);
                        $_POST['soft_delete'] = 0;
                        $_POST['users_id'] = isset($_POST['users_id']) ? $_POST['users_id'] : $_SESSION['id'];
                        $contactModel->update($_POST,$contactByPhone['id']);
                        header('Location: /contacts');
                        break;
                    default:
                        break;
                }

                exit();
            }

            $users_id = isset($_POST['users_id']) ? $_POST['users_id'] : $params['id_first'];
            $contactModel->add($_POST, $users_id);
            $data['description'] = 'КОНТАКТ ДОБАВЛЕН';
            $lastContact = $contactModel->findLastContact();
            $commentModel->add($data,$params['id_first'],$lastContact);
        }

        if(isset($_POST['button_submit_comment'])){
            $commentModel = new Comment;
            $commentModel->add($_POST,$users_id,$contacts_id);
        }
        header('Location: /contacts');
    }

    public function update($params){
        $id = $params['id_first'];
        $contactModel = new Contact;
        $commentModel = new Comment;
        $contactByPhone = $contactModel->findByPhone($_POST['phone']);

        if($contactByPhone){
            $_SESSION['error_message'] = "Контакт с данным номером уже сущестует!";
            header('Location: /contacts');
            exit();
        }

        $contactModel->update($_POST,$id);
        header('Location: /contacts');
    }

    public function softDelete($params){
        $contactModel = new Contact;
        $id = $params['id_first'];
        $data['soft_delete'] = '1';
        $contactById = $contactModel->findById($id);

        if($contactById['users_id'] !== $_SESSION['id'] && !$_SESSION['is_admin']){
            http_response_code(403);
            exit();
        }

        $contactModel->update($data,$id);
        header('Location: /contacts');
    }
}