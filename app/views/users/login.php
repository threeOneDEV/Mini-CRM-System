<?php
$title = 'User list';
ob_start();
?>

<div class="container signin-form mt-5" style="max-width: 500px;">
    <form action="/login/authenticate" method="post">
        <div class="form-header text-center">
            <h2>Sign In</h2>
            <p>Login to Mini-CRM</p>
            <p><?= $errorMessage ? $errorMessage : null ?></p>
        </div>
        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your email" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password" autocomplete="off" required>
        </div>
        <!-- <div class="small">Forgot password? <a href="forgot_pass.php">Click here</a></div><br> -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg w-100 mt-4" name="button_signin">Sign in</button>
        </div>
    </form>
</div>

<?php 
$content = ob_get_clean(); 
include 'app/views/layout.php';
?>