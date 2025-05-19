<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "QA Project" ?></title>
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css" />
    <script src="./js/jquery/jquery.min.js" type="text/javascript"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-success bg-success shadow-sm sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="/">
                <img src="./img/logo.png" alt="Logo" class="d-inline-block align-top">
            </a>
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-3">
                    <li class="nav-item">
                        <a class="nav-link px-2 <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active fw-bold' : '' ?>" href="index.php">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-2 <?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active fw-bold' : '' ?>" href="about.php">
                            About Us
                        </a>
                    </li>
                </ul>

                <!-- User data -->
                <div class="d-flex align-items-center">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <span class="text-white me-3 small text-end">
                            Welcome, <strong><?= $_SESSION['user']['username'] ?? 'User' ?></strong>
                            <span class="badge bg-light text-dark"><?= $_SESSION['user']['role'] ?? '' ?></span>
                        </span>
                        <a href="logout.php" class="btn btn-outline-light btn-sm">
                            Logout
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>