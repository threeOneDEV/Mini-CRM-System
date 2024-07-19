<?php

namespace controllers\users;
use models\User;

class UserController{
    public function index(){ 
        if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']){
            $userModel = new User();
            $users = $userModel->getAllUsers();
            $errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;
            unset($_SESSION['error_message']);        
            include ('app/views/users/index.php');
        }else{
            http_response_code(403);
            exit();         
        }
    }

    public function store(){
        if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['is_admin'])){
            $userModel = new User();
            $login = $_POST['login'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $userByLogin = $userModel->findByLogin($login);
            $userByEmail = $userModel->findByEmail($email);

            if($userByLogin){
                $_SESSION['error_message'] = "Логин занят!";
                header('Location: /users');
                exit();
            }

            if($userByEmail){
                $_SESSION['error_message'] = "Почта уже используется!";
                header('Location: /users');
                exit();
            }

            if($password !== $confirm_password){
                $_SESSION['error_message'] = "Пароли не совпадают!";
                header('Location: /users');
                exit();
            }

            $userModel->add($_POST);
        }
        header('Location: /users');
    }

    public function softDelete($params){
        if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']){
            $data['soft_delete'] = 1;
            $id = $params['id'];
            $userModel = new User();
            $userModel->update($data, $id);
            header('Location: /users');
        }else{        
            http_response_code(403);
            exit();
        }
    }

    public function setAdmin($params){
        if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']){
            $id = $params['id'];
            $userModel = new User;
            $data['is_admin'] = 1;
            $userModel->update($data,$id);
            header('Location: /users');
        }else{
            http_response_code(403);
            exit();
        }
    }

    public function unsetAdmin($params){
        if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']){
            $id = $params['id'];
            $userModel = new User;
            $data['is_admin'] = 0;
            $userModel->update($data,$id);
            header('Location: /users');
        }else{
            http_response_code(403);
            exit();
        }
    }
}