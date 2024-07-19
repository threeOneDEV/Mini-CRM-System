<?php

$title = 'User list';

ob_start();

?>

<div class="container mt-5">
    <div class="row">

        <?php include('create.php') ?>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    User List
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Login</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center">Actions</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $user): ?>
                                <?php if(!$user['soft_delete']): ?>
                                
                                    <tr>
                                        <td><?= $user['login'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['is_admin'] ? 'Admin' : 'Manager' ?></td>
                                        <td class="text-center">
                                            <?= 
                                            !$user['is_admin'] ? 
                                            "<a href=\"". APP_BASE_PATH ."/users/setAdmin/{$user['id']}\" class=\"btn btn-success btn-sm\" name=\"button_give_admin\">Give ADMIN</a>" : 
                                            "<a href=\"". APP_BASE_PATH ."/users/unsetAdmin/{$user['id']}\" class=\"btn btn-danger btn-sm\" name=\"button_remove_admin\">Remove ADMIN</a>" 
                                            ?>
                                        </td>
                                        <td>
                                            <?= 
                                            $user['is_admin'] ? null :
                                            "<button type=\"button\" class=\"btn fa-solid fa-trash\" data-bs-toggle=\"modal\" data-bs-target=\"#staticBackdropDeleteUser".$user['id']."\"></button>"
                                            ?>
                                        </td>
                                        
                                    </tr>
                                    
                                    <?php include('delete.php') ?>

                                <?php endif ?>
                            
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
include 'app/views/layout.php';
?>