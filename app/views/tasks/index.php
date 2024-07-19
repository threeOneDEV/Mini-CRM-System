<?php
$title = 'Tasks list';
ob_start();
?>

<div class="container mt-5">
    <div class="row">

        <?php include('create.php') ?>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Tasks List
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Deadline</th>
                                <th class="text-center">Actions</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tasksList">
                            <?php foreach($tasks as $task): ?>
                                <?php if($task['users_id'] == $_SESSION['id']): ?>
                                
                                    <tr>
                                        <td class="description"><p><?= $task['is_done'] ?  '<s>'.$task['description'].'</s>' : $task['description'] ?></p></td>
                                        <td><?= $task['deadline'] ?></td>   
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropEditTask<?= $task['id'] ?>">Edit</button>
                                            <?= !$task['is_done'] ? 
                                            "<a href=\"/tasks/done/{$task['id']}\" class=\"btn btn-success btn-sm\" name=\"button_done_task\">Done</a>" : 
                                            "<a href=\"/tasks/notDone/{$task['id']}\" class=\"btn btn-danger btn-sm\" name=\"button_not_done_task\">Not done</a>" 
                                            ?>                                   
                                        </td>
                                        <td class="text-center">
                                            <a href="/tasks/delete/<?= $task['id'] ?>" class="btn fa-solid fa-trash" name="button_delete_task"></a>
                                        </td>
                                    </tr>
                                    
                                    <?php include ('edit.php') ?>

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
include('app/views/layout.php');
?>