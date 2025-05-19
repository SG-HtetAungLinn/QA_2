<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css" />
    <script src="./js/jquery/jquery.min.js" type="text/javascript"></script>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .login-container {
        min-height: 100vh;
    }

    .login-image div {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        margin: 0 auto;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    @media (max-width: 768px) {}
</style>
</head>

<body>
    <div class="container-fluid">
        <div class="row g-0 login-container">
            <!-- Image Column -->
            <div class="col-lg-6 d-none d-lg-block login-image">
                <div class="">
                    <img src="./img/login.jpg" alt="Logo" />
                </div>
            </div>

            <!-- Form Column -->
            <div class="col-lg-6 col-md-12 login-form bg-light">
                <div class="col-md-8 col-sm-11 col-12 mx-auto shadow p-4 bg-light rounded">
                    <h1 class="text-center mb-4 text-theme">Login Form</h1>
                    <div class="alert alert-danger" id="errorMsg" style="display: none;">
                    </div>
                    <form action="" method="POST" id="login_form">
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Enter Your Username" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter Your Password" />
                        </div>
                        <input type="hidden" name="form_submit" value="1">
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-theme w-100">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="./js/login.js"></script>
</body>

</html>