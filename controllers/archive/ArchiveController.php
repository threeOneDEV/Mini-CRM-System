<?php

namespace controllers\archive;

use models\Comment;
use models\Contact;
use models\Offer;
use models\User;

class ArchiveController{
    public function index(){
        if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']){
            $userModel = new User;
            $contactModel = new Contact;
            $users = $userModel->getAllUsers();
            $contacts = $contactModel->getAllContacts();
            include('app/views/archive/index.php');
        }else{
            http_response_code(403);
            exit();
        }
    }

    public function delete($params){
        if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']){
            $contactModel = new Contact;
            $offerModel = new Offer;
            $commentModel = new Comment;
            $id = $params['id'];
            $offerModel->deleteByContactId($id);
            $commentModel->deleteByContactId($id);
            $contactModel->delete($id);
            header('Location: /archive');
        }else{
            http_response_code(403);
            exit();
        }
    }

    public function update($params){
        $contactModel = new Contact;
        $id = $params['id'];
        $data = [
            'users_id'=>$_POST['users_id'],
            'soft_delete'=>0
        ];
        $contactModel->update($data, $id);
        header('Location: /archive');
    }
}