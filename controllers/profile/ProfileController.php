<?php

namespace controllers\profile;

use models\User;

class ProfileController{
    public function index(){
        $userModel = new User;
        $user = $userModel->findById($_SESSION['id']);
        $errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : "";
        unset($_SESSION['error_message']);
        include ('app/views/profile/index.php');       
    }

    public function update($params){
        $userModel = new User;
        $id = $params['id'];
        $login = $_POST['login'] ?? null;
        $email = $_POST['email'] ?? null;
        $previous_password = $_POST['previous_password'] ?? null;
        $password = $_POST['password'] ?? null;
        $confirm_password = $_POST['confirm_password'] ?? null;
        $userById = $userModel->findById($_SESSION['id']);
        $userByLogin = $login ? $userModel->findByLogin($login) : null;
        $userByEmail = $email ? $userModel->findByEmail($email) : null;

        if($userByLogin){
            $_SESSION['error_message'] = "Логин занят!";
            header('Location: /profile');
            exit();
        }

        if($userByEmail){
            $_SESSION['error_message'] = "Почта уже используется!";
            header('Location: /profile');
            exit();
        }

        if($previous_password && !password_verify($previous_password, $userById['password'])){
            $_SESSION['error_message'] = "Предыдущий пароль неверен!";
            header('Location: /profile');
            exit();
        }

        if(($password || $confirm_password) && !$previous_password){
            $_SESSION['error_message'] = "Необходимо ввести предыдущий пароль!";
            header('Location: /profile');
            exit();
        }

        if(($password || $confirm_password) && $previous_password){
            if($password !== $confirm_password){
                $_SESSION['error_message'] = "Пароли не совпадают!";
                header('Location: /profile');
                exit();
            }
        }

        $userModel->update($_POST,$id);
        header('Location: /profile');
    }  
}