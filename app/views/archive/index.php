<?php
$title = 'Archive';
ob_start();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h3>ARCHIVE CONTACTS</h3>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Last manager</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contacts as $contact) : ?>
                                <?php if ($contact['soft_delete']) : ?>

                                    <tr class="text-center">
                                        <td><?= $contact['name'] ?></td>
                                        <td><?= $contact['email'] ?></td>
                                        <td><?= $contact['phone'] ?></td>
                                        <td><?= $contact['user_login'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropRestoreContact<?= $contact['id'] ?>">Restore</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropDeleteContact<?= $contact['id'] ?>">Delete</button>
                                        </td>
                                    </tr>

                                    <?php include('restore.php') ?>

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