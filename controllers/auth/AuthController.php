<?php

namespace controllers\auth;
use models\AuthUser;

class AuthController{
    public function index(){
        $errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : "";
        unset($_SESSION['error_message']);
        include('app/views/users/login.php');
    }

    public function authenticate(){
        if(isset($_POST['email']) && isset($_POST['password'])){     
            $email = $_POST['email'];
            $password = $_POST['password'];
            $authModel = new AuthUser;
            $user = $authModel->findByEmail($email);

            if($user && password_verify($password,$user['password'])){
                $_SESSION['id'] = $user['id'];
                $_SESSION['login'] = $user['login'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['is_admin'] = $user['is_admin'];
                header('Location: /');
            }else{
                $_SESSION['error_message'] = "Логин или пароль неверны";
                header('Location: /login');              
            }
        }
    }

    public function logout(){
        session_unset();
        session_destroy();
        header('Location: /login');     
    }

    public function checkAuth(){
        if(!isset($_SESSION['id']) && $_SERVER['REQUEST_URI'] !== '/login'){
            header('Location: /login');           
        }
    }   
}