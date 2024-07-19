<?php

$title = 'Mini-CRM System';
ob_start();

?>

<div class="container text-center mt-3">
    <?php 
        echo "<h1>{$_SESSION['login']}</h1>"
    ?>
    <h1>Welcome</h1>
    <h2>to</h2>
    <h1>Mini-CRM System</h1>
</div>

<?php 

$content = ob_get_clean(); 
include 'app/views/layout.php';

?>