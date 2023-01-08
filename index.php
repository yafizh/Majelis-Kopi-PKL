<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
require_once('database/connection.php');
session_start();
// session_destroy();

if (!isset($_SESSION['user']))
    echo "<script>location.href = 'halaman/login/?';</script>";
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

        .breadcrumb-item {
            color: #5D657B;
        }

        .breadcrumb-item:hover {
            color: #4A6CF7;
        }
    </style>
</head>

<body>

    <?php if ($_SESSION['user']['status'] == 'ADMIN') : ?>
        <?php include_once('layout/sidebar.php'); ?>
        <div class="overlay"></div>
    <?php endif; ?>

    <main class="main-wrapper <?= $_SESSION['user']['status'] == 'ADMIN' ? '' : 'm-0'; ?>">
        <?php include_once('layout/navbar.php'); ?>

        <?php if ($_SESSION['user']['status'] == 'ADMIN') : ?>
            <?php
            if (isset($_GET['h1'])) {
                if ($_GET['h1'] == 'user') {
                    if ($_GET['h2'] == 'admin')
                        include_once('halaman/user/admin/index.php');
                    elseif ($_GET['h2'] == 'tambah_user/admin')
                        include_once('halaman/user/admin/tambah.php');
                    elseif ($_GET['h2'] == 'ubah_user/admin')
                        include_once('halaman/user/admin/ubah.php');
                    elseif ($_GET['h2'] == 'hapus_user/admin')
                        include_once('halaman/user/admin/hapus.php');

                    if ($_GET['h2'] == 'kasir')
                        include_once('halaman/user/kasir/index.php');
                    elseif ($_GET['h2'] == 'tambah_user/kasir')
                        include_once('halaman/user/kasir/tambah.php');
                    elseif ($_GET['h2'] == 'ubah_user/kasir')
                        include_once('halaman/user/kasir/ubah.php');
                    elseif ($_GET['h2'] == 'hapus_user/kasir')
                        include_once('halaman/user/kasir/hapus.php');
                }

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

                    if ($_GET['h2'] == 'stok_bahan_baku')
                        include_once('halaman/stok_bahan_baku/index.php');
                }

                if ($_GET['h1'] == 'pemasok') {
                    if ($_GET['h2'] == 'daftar_pemasok')
                        include_once('halaman/daftar_pemasok/index.php');
                    elseif ($_GET['h2'] == 'tambah_daftar_pemasok')
                        include_once('halaman/daftar_pemasok/tambah.php');
                    elseif ($_GET['h2'] == 'ubah_daftar_pemasok')
                        include_once('halaman/daftar_pemasok/ubah.php');
                    elseif ($_GET['h2'] == 'hapus_daftar_pemasok')
                        include_once('halaman/daftar_pemasok/hapus.php');

                    if ($_GET['h2'] == 'penyuplaian')
                        include_once('halaman/penyuplaian/index.php');
                    elseif ($_GET['h2'] == 'tambah_penyuplaian')
                        include_once('halaman/penyuplaian/tambah.php');
                    elseif ($_GET['h2'] == 'ubah_penyuplaian')
                        include_once('halaman/penyuplaian/ubah.php');
                    elseif ($_GET['h2'] == 'hapus_penyuplaian')
                        include_once('halaman/penyuplaian/hapus.php');
                }

                if ($_GET['h1'] == 'menu') {
                    if ($_GET['h2'] == 'daftar_menu') {
                        if (($_GET['h3'] ?? '') == 'daftar_menu_per_kategori')
                            include_once('halaman/daftar_menu/index_per_kategori.php');
                        else
                            include_once('halaman/daftar_menu/index.php');
                    } elseif ($_GET['h2'] == 'tambah_daftar_menu')
                        include_once('halaman/daftar_menu/tambah.php');
                    elseif ($_GET['h2'] == 'ubah_daftar_menu')
                        include_once('halaman/daftar_menu/ubah.php');
                    elseif ($_GET['h2'] == 'hapus_daftar_menu')
                        include_once('halaman/daftar_menu/hapus.php');

                    if ($_GET['h2'] == 'favorit_menu')
                        include_once('halaman/favorit_menu/index.php');

                    if ($_GET['h2'] == 'penyuplaian')
                        include_once('halaman/penyuplaian/index.php');
                    elseif ($_GET['h2'] == 'tambah_penyuplaian')
                        include_once('halaman/penyuplaian/tambah.php');
                    elseif ($_GET['h2'] == 'ubah_penyuplaian')
                        include_once('halaman/penyuplaian/ubah.php');
                    elseif ($_GET['h2'] == 'hapus_penyuplaian')
                        include_once('halaman/penyuplaian/hapus.php');
                }
            } else include_once('halaman/dashboard/dashboard.php');
            ?>
        <?php else : ?>
            <?php
            if (isset($_GET['h'])) {
            } else include_once('halaman/kasir/index.php');
            ?>
        <?php endif; ?>

    </main>
</body>

</html>