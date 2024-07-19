<?php

namespace controllers\tasks;
use models\Task;

class TaskController{
    public function index(){
        $taskModel = new Task;
        $tasks = $taskModel->getAllTasks();
        include('app/views/tasks/index.php');
    }

    public function store(){
        $taskModel = new Task;
        $taskModel->add($_POST,$_SESSION['id']);
        header('Location: /tasks');
    }

    public function delete($params){
        $taskModel = new Task;
        $id = $params['id'];
        $taskById = $taskModel->findById($id);

        if($taskById['users_id'] !== $_SESSION['id']){
            http_response_code(403);
            exit();
        }

        $taskModel->delete($id);
        header('Location: /tasks');
    }

    public function update($params){
        $taskModel = new Task;
        $id = $params['id'];
        $taskModel->update($_POST,$id);
        header('Location: /tasks');
    }

    public function done($params){
        $taskModel = new Task;
        $data['is_done'] = 1;
        $id = $params['id'];
        $taskById = $taskModel->findById($id);

        if($taskById['users_id'] !== $_SESSION['id']){
            http_response_code(403);
            exit();
        }

        $taskModel->update($data,$id);
        header('Location: /tasks');
    }

    public function notDone($params){
        $taskModel = new Task;
        $data['is_done'] = 0;
        $id = $params['id'];
        $taskById = $taskModel->findById($id);

        if($taskById['users_id'] !== $_SESSION['id']){
            http_response_code(403);
            exit();
        }

        $taskModel->update($data,$id);
        header('Location: /tasks');
    }
}