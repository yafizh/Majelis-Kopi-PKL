<?php
require_once('database/connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/x-icon" />
    <link rel="preload" as="image" href="assets/images/logo/logo.png">
    <title>Majelis Kopi</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/datatable.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <style>
        .fit {
            width: 1%;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <?php include_once('layout/sidebar.php'); ?>
    <div class="overlay"></div>

    <main class="main-wrapper">
        <?php include_once('layout/navbar.php'); ?>
        <?php
        if (isset($_GET['h1'])) {
            if ($_GET['h1'] == 'kategori_menu')
                include_once('halaman/kategori_menu/index.php');
            elseif ($_GET['h1'] == 'tambah_kategori_menu')
                include_once('halaman/kategori_menu/tambah.php');
            elseif ($_GET['h1'] == 'ubah_kategori_menu')
                include_once('halaman/kategori_menu/ubah.php');
            elseif ($_GET['h1'] == 'hapus_kategori_menu')
                include_once('halaman/kategori_menu/hapus.php');

            if ($_GET['h1'] == 'bahan_baku') {
                if ($_GET['h2'] == 'daftar_bahan_baku')
                    include_once('halaman/daftar_bahan_baku/index.php');
                elseif ($_GET['h2'] == 'tambah_daftar_bahan_baku')
                    include_once('halaman/daftar_bahan_baku/tambah.php');
                elseif ($_GET['h2'] == 'ubah_daftar_bahan_baku')
                    include_once('halaman/daftar_bahan_baku/ubah.php');
                elseif ($_GET['h2'] == 'hapus_daftar_bahan_baku')
                    include_once('halaman/daftar_bahan_baku/hapus.php');
            }
        } else include_once('halaman/dashboard/dashboard.php');
        ?>
    </main>
</body>

</html>