<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1e73f3f4a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="#">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Mini CRM</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/offers">Offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contacts">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tasks">Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile">Profile</a>
                    </li>

                    <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" href="#">Admin panel</a>

                            <ul class="dropdown-menu dropdown-menu-dark bg-dark" style="border: none;">
                                <li><a class="dropdown-item" href="/users">Users</a></li>
                                <li><a class="dropdown-item" href="/products">Products</a></li>
                                <li><a class="dropdown-item" href="/archive">Archive</a></li>
                            </ul>

                        </li>
                    
                   <?php endif ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/login/logout">Exit</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <?= $content ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="#"></script>
</body>
</html>