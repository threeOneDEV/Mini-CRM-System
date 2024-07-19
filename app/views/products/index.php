<?php
$title = 'Product list';
ob_start();
?>

<div class="container mt-5">
    <div class="row">

        <?php include('create.php') ?>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Products List
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Price</th>
                                <th class="text-center">Actions</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="productsList">
                            <?php foreach($products as $product): ?>
                                <?php if(!$product['soft_delete']): ?>
                                
                                    <tr>
                                        <td><?= $product['title'] ?></td>
                                        <td><?= $product['price'] ?></td>   
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropEditProduct<?= $product['id'] ?>">Edit</button>                                 
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#staticBackdropDeleteProduct<?= $product['id'] ?>"></button>
                                        </td>
                                    </tr>

                                    <?php include ('delete.php') ?>
                                    
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
include 'app/views/layout.php';
?>