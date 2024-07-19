<?php
$title = 'Profile';
ob_start();
?>

<p class="text-center" style="color: red;"><?= $errorMessage ?></p>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h1>PROFILE CARD</h1>
                </div>
                <div class="card-body text-center">
                    <h1><i class="fa-solid fa-id-card" style="font-size: 3em;"></i></h1>
                    <h3 class="card-title">Role</h3>
                    <p class="card-text"><?= $user['is_admin'] ? 'Admin' : 'Manager' ?></p>
                    <h3 class="card-title">Login</h3>
                    <p class="card-text"><?= $user['login'] ?></p>
                    <h3 class="card-title">Email</h3>
                    <p class="card-text"><?= $user['email'] ?></p>
                    <h3 class="card-title">Password</h3>
                    <p class="card-text">***************</p>
                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit profile info</button>
                </div>

                <?php include('edit.php') ?>

            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
include 'app/views/layout.php';
?>