<?php
$title = 'Offer list';
ob_start();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header bg-danger text-white text-center">
                    <h1>OFFERS</h1>
                </div>
                
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>ID client</th>
                                <th>Product</th>
                                <th>Discount</th>
                                <th>Price</th>                            
                                <th>Manager</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($offers as $offer): ?>
                                <?php if($offer['users_id'] == $_SESSION['id'] || $_SESSION['is_admin']): ?>
                                    <tr>
                                        <td><?= $offer['date'] ?></td>
                                        <td>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $offer['contacts_id'] ?>"><?= $offer['contacts_id'] ?></a>

                                            <!-- MODAL START -->
                                            <?php foreach($contacts as $contact): ?>
                                                <?php if($contact['id'] == $offer['contacts_id']): ?>
                                                    <div class="modal fade" id="exampleModal<?= $offer['contacts_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Clients card</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="text-center">
                                                                        <div class="mb-3">
                                                                            <h5 class="card-title">Name</h5>
                                                                            <p class="card-text"><?= $contact['name'] ?></p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <h5 class="card-title">Email</h5>
                                                                            <p class="card-text"><?= $contact['email'] ?></p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <h5 class="card-title">Phone</h5>
                                                                            <p class="card-text"><?= $contact['phone'] ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom<?= $contact['id'] ?>" aria-controls="offcanvasBottom">Info</button>
                                                                </div>
                                                                
                                                                <div class="text-center">
                                                                    <?php include('app/views/comments/index.php') ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            <?php endforeach ?>    
                                            <!-- MODAL END -->

                                        </td>
                                        <td><?= $offer['product_title'] ?></td>
                                        <td><?= $offer['discount'] ? $offer['discount'] : 'None' ?></td>
                                        <td><?= $offer['calculated_price'] ?></td>
                                        <td><?= $offer['user_login'] ?></td>
                                    </tr>
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