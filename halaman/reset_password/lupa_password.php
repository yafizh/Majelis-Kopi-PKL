<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
require_once('../../database/connection.php');
session_start();
if (isset($_POST['submit'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $tempat_lahir = $conn->real_escape_string($_POST['tempat_lahir']);
    $tanggal_lahir = $conn->real_escape_string($_POST['tanggal_lahir']);

    $q = "
        SELECT 
            u.id as id_user  
        FROM 
            user u 
        LEFT JOIN 
            kasir k 
        ON 
            k.id_user=u.id 
        WHERE 
            UPPER(u.username)='" . strtoupper($username) . "' 
            AND 
            UPPER(k.nama)='" . strtoupper($nama) . "'
            AND 
            UPPER(k.tempat_lahir)='" . strtoupper($tempat_lahir) . "' 
            AND 
            k.tanggal_lahir='" . $tanggal_lahir . "' 
    ";
    $validate = $conn->query($q);
    if ($validate->num_rows) {
        $data = $validate->fetch_assoc();
        echo "<script>location.href = 'ganti_password.php?id=" . $data['id_user'] . "';</script>";
    } else
        echo "<script>alert('Data tidak terdaftar!')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../assets/images/logo/logo.png" type="image/x-icon" />
    <title>Lupa Password</title>

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
        <div class="row g-0 auth-row">
            <div class="col-lg-6">
                <div class="auth-cover-wrapper bg-primary-100" style="position: relative;">
                    <img src="../../assets/images/auth/left.jpg" style="position: absolute; width: 100%; height: 100%; object-fit: cover; z-index: 1;">
                    <div style="position: absolute; z-index: 2; background-color: #000; width: 100%; height: 100%; opacity: .5;"></div>
                    <div class="w-100 h-100 d-flex flex-column" style="position: absolute; z-index: 3; padding-top: 10rem;">
                        <div class="text-center">
                            <h1 class="text-white mb-30">HALAMAN LUPA PASSWORD</h1>
                            <h1 class="text-white mb-10">APLIKASI PENJUALAN</h1>
                            <h1 class="text-white mb-10">MAJELIS KOPI BANJARBARU</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="signin-wrapper">
                    <div class="form-wrapper">
                        <h6 class="mb-15">Form Lupa Password</h6>
                        <p class="text-sm mb-25">
                            Masukkan identias diri.
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
                                        <label>Nama</label>
                                        <input type="text" name="nama" required autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" required autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" required autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="button-group d-flex justify-content-center flex-wrap">
                                        <button type="submit" name="submit" class="main-btn primary-btn btn-hover w-100 text-center mb-3">
                                            Reset Password
                                        </button>
                                        <a href="../login/index.php">Login</a>
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