<?php
$title = 'Contact list';
ob_start();
?>

<div class="container mt-5">
    <div class="row">

        <?php include('create.php') ?>
        
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Contacts List
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th class="text-center">Actions</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="contactsList">
                            <?php foreach($contacts as $contact): ?>
                                <?php if((!$contact['soft_delete'] && $contact['users_id'] == $_SESSION['id']) || (!$contact['soft_delete'] && $_SESSION['is_admin'])): ?>
                                    <tr>
                                        <td><?= $contact['name'] ?></td>
                                        <td><?= $contact['email'] ?></td>
                                        <td><?= $contact['phone'] ?></td>                            
                                        <td>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropEditContact<?= $contact['id'] ?>">Edit</button>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropMakeOffer<?= $contact['id'] ?>">Offer</button>
                                                <button class="btn btn-info btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom<?= $contact['id'] ?>" aria-controls="offcanvasBottom">Info</button>

                                                <?php include('app/views/comments/index.php') ?>
                                            </div>
                                        </td>                          
                                        <td>
                                            <button type="button" class="btn fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#staticBackdropSoftDeleteContact<?= $contact['id'] ?>"></button>
                                        </td>
                                    </tr>
                                    
                                    <?php include('delete.php') ?>

                                    <?php include('edit.php') ?>
                                                            
                                    <?php include('app/views/offers/create.php') ?> 
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