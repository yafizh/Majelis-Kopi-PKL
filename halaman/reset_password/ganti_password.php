<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
require_once('../../database/connection.php');
session_start();
if (isset($_POST['submit'])) {
    $password_baru = $conn->real_escape_string($_POST['password_baru']);
    $konfirmasi_password_baru = $conn->real_escape_string($_POST['konfirmasi_password_baru']);

    if ($password_baru === $konfirmasi_password_baru) {
        $q = "
        UPDATE user SET 
            password='$password_baru' 
        WHERE 
            id=" . $_GET['id'] . "
            ";
        $conn->query($q);
        echo "<script>alert('Berhasil ganti password, silakan login!')</script>";
        echo "<script>location.href = '../login/index.php';</script>";
    } else
        echo "<script>alert('Password tidak sama!')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../assets/images/logo/logo.png" type="image/x-icon" />
    <title>Ganti Password</title>

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
                <div class="auth-cover-wrapper bg-primary-100" style="position: relative;">
                    <img src="../../assets/images/auth/left.jpg" style="position: absolute; width: 100%; height: 100%; object-fit: cover; z-index: 1;">
                    <div style="position: absolute; z-index: 2; background-color: #000; width: 100%; height: 100%; opacity: .5;"></div>
                    <div class="w-100 h-100 d-flex flex-column" style="position: absolute; z-index: 3; padding-top: 10rem;">
                        <div class="text-center">
                            <h1 class="text-white mb-30">HALAMAN GANTI PASSWORD</h1>
                            <h1 class="text-white mb-10">APLIKASI PENJUALAN</h1>
                            <h1 class="text-white mb-10">MAJELIS KOPI BANJARBARU</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="signin-wrapper">
                    <div class="form-wrapper">
                        <h6 class="mb-15">Form Ganti Password</h6>
                        <p class="text-sm mb-25">
                            Masukkan password baru.
                        </p>
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Password Baru</label>
                                        <input type="password" name="password_baru" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Konfirmasi Password Baru</label>
                                        <input type="password" name="konfirmasi_password_baru" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="button-group d-flex justify-content-center flex-wrap">
                                        <button type="submit" name="submit" class="main-btn primary-btn btn-hover w-100 text-center mb-3">
                                            Ganti Password
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