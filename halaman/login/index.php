<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
require_once('../../database/connection.php');
session_start();
if (isset($_POST['submit'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $q = "
        SELECT 
            u.id id_user,
            u.username,
            u.password,
            u.status,
            k.id id_kasir,
            k.nama,
            k.foto 
        FROM 
            user u 
        LEFT JOIN 
            kasir k 
        ON 
            k.id_user=u.id 
        WHERE 
            username='$username' 
            AND 
            password='$password'
    ";
    $validate = $conn->query($q);
    if ($validate->num_rows) {
        $_SESSION['user'] = $validate->fetch_assoc();
        echo "<script>location.href = '../../index.php';</script>";
    } else
        echo "<script>alert('Username atau Password Salah!')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../assets/images/favicon.svg" type="image/x-icon" />
    <title>Login</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../assets/css/LineIcons.css" />
    <link rel="stylesheet" href="../../assets/css/quill/bubble.css" />
    <link rel="stylesheet" href="../../assets/css/quill/snow.css" />
    <link rel="stylesheet" href="../../assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="../../assets/css/morris.css" />
    <link rel="stylesheet" href="../../assets/css/datatable.css" />
    <link rel="stylesheet" href="../../assets/css/main.css" />
</head>

<body>
    <main class="main-wrapper" style="margin: 0; padding: 0;">
        <div class="row g-0 auth-row" style="height: 100vh;">
            <div class="col-lg-6">
                <div class="auth-cover-wrapper bg-primary-100">
                    <div class="auth-cover">
                        <div class="title text-center">
                            <h1 class="text-primary mb-10">Welcome Back</h1>
                            <p class="text-medium">
                                Sign in to your Existing account to continue
                            </p>
                        </div>
                        <div class="cover-image">
                            <img src="../../assets/images/auth/signin-image.svg" alt="" />
                        </div>
                        <div class="shape-image">
                            <img src="../../assets/images/auth/shape.svg" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="signin-wrapper">
                    <div class="form-wrapper">
                        <h6 class="mb-15">Sign In Form</h6>
                        <p class="text-sm mb-25">
                            Start creating the best possible user experience for you
                            customers.
                        </p>
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Username</label>
                                        <input type="text" name="username" required autocomplete="off" autofocus />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Password</label>
                                        <input type="password" name="password" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="button-group d-flex justify-content-center flex-wrap">
                                        <button type="submit" name="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/Chart.min.js"></script>
    <script src="../../assets/js/apexcharts.min.js"></script>
    <script src="../../assets/js/dynamic-pie-chart.js"></script>
    <script src="../../assets/js/moment.min.js"></script>
    <script src="../../assets/js/fullcalendar.js"></script>
    <script src="../../assets/js/jvectormap.min.js"></script>
    <script src="../../assets/js/world-merc.js"></script>
    <script src="../../assets/js/polyfill.js"></script>
    <script src="../../assets/js/quill.min.js"></script>
    <script src="../../assets/js/datatable.js"></script>
    <script src="../../assets/js/Sortable.min.js"></script>
    <script src="../../assets/js/main.js"></script>
</body>

</html>