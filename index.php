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
    <link rel="shortcut icon" href="assets/images/logo/logo.jpg" type="image/x-icon" />
    <link rel="preload" as="image" href="assets/images/logo/logo.jpg">
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
        <?php if ($_SESSION['user']['status'] == 'ADMIN') : ?>
            <?php include_once('layout/navbar.php'); ?>
            <?php
            if (isset($_GET['h1'])) {
                if ($_GET['h1'] == 'user') {
                    if ($_GET['h2'] == 'admin')
                        include_once('halaman/user/admin/index.php');
                    elseif ($_GET['h2'] == 'tambah_admin')
                        include_once('halaman/user/admin/tambah.php');
                    elseif ($_GET['h2'] == 'ubah_admin')
                        include_once('halaman/user/admin/ubah.php');
                    elseif ($_GET['h2'] == 'hapus_admin')
                        include_once('halaman/user/admin/hapus.php');

                    if ($_GET['h2'] == 'kasir')
                        include_once('halaman/user/kasir/index.php');
                    elseif ($_GET['h2'] == 'tambah_kasir')
                        include_once('halaman/user/kasir/tambah.php');
                    elseif ($_GET['h2'] == 'detail_kasir')
                        include_once('halaman/user/kasir/detail.php');
                    elseif ($_GET['h2'] == 'ubah_kasir')
                        include_once('halaman/user/kasir/ubah.php');
                    elseif ($_GET['h2'] == 'hapus_kasir')
                        include_once('halaman/user/kasir/hapus.php');
                }

                if ($_GET['h1'] == 'aset') {
                    if ($_GET['h2'] == 'data_aset')
                        include_once('halaman/aset/data/index.php');
                    elseif ($_GET['h2'] == 'tambah_aset')
                        include_once('halaman/aset/data/tambah.php');
                    elseif ($_GET['h2'] == 'ubah_aset')
                        include_once('halaman/aset/data/ubah.php');
                    elseif ($_GET['h2'] == 'hapus_aset')
                        include_once('halaman/aset/data/hapus.php');
                    elseif ($_GET['h2'] == 'detail_aset')
                        include_once('halaman/aset/data/detail.php');
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

                    if ($_GET['h2'] == 'penjualan')
                        include_once('halaman/riwayat_penjualan/index.php');
                    elseif ($_GET['h2'] == 'detail_penjualan')
                        include_once('halaman/riwayat_penjualan/detail.php');
                    elseif ($_GET['h2'] == 'edit_penjualan')
                        include_once('halaman/kasir/index.php');
                }

                if ($_GET['h1'] == 'karyawan') {
                    if ($_GET['h2'] == 'presensi') {
                        if (($_GET['h3'] ?? '') == 'karyawan_per_presensi')
                            include_once('halaman/presensi/index_per_presensi.php');
                        else
                            include_once('halaman/presensi/index.php');
                    } elseif ($_GET['h2'] == 'tambah_presensi')
                        include_once('halaman/presensi/tambah.php');
                    elseif ($_GET['h2'] == 'ubah_presensi')
                        include_once('halaman/presensi/ubah.php');
                    elseif ($_GET['h2'] == 'hapus_presensi')
                        include_once('halaman/presensi/hapus.php');

                    if ($_GET['h2'] == 'penggajian') {
                        if (($_GET['h3'] ?? '') == 'karyawan_per_penggajian')
                            include_once('halaman/penggajian/index_per_penggajian.php');
                        else
                            include_once('halaman/penggajian/index.php');
                    } elseif ($_GET['h2'] == 'tambah_penggajian')
                        include_once('halaman/penggajian/tambah.php');
                    elseif ($_GET['h2'] == 'ubah_penggajian')
                        include_once('halaman/penggajian/ubah.php');
                    elseif ($_GET['h2'] == 'hapus_penggajian')
                        include_once('halaman/penggajian/hapus.php');
                }

                if ($_GET['h1'] == 'pelanggan')
                    include_once('halaman/pelanggan/index.php');
                elseif ($_GET['h1'] == 'lihat_pelanggan')
                    include_once('halaman/pelanggan/lihat.php');
                elseif ($_GET['h1'] == 'tambah_pelanggan')
                    include_once('halaman/pelanggan/tambah.php');
                elseif ($_GET['h1'] == 'ubah_pelanggan')
                    include_once('halaman/pelanggan/ubah.php');
                elseif ($_GET['h1'] == 'hapus_pelanggan')
                    include_once('halaman/pelanggan/hapus.php');

                if ($_GET['h1'] == 'laporan') {
                    if ($_GET['h2'] == 'favorit_menu')
                        include_once('halaman/laporan/favorit_menu.php');
                    elseif ($_GET['h2'] == 'penjualan')
                        include_once('halaman/laporan/penjualan.php');
                    elseif ($_GET['h2'] == 'suplai_bahan_baku')
                        include_once('halaman/laporan/suplai_bahan_baku.php');
                    elseif ($_GET['h2'] == 'menu')
                        include_once('halaman/laporan/menu.php');
                    elseif ($_GET['h2'] == 'pemasok')
                        include_once('halaman/laporan/pemasok.php');
                    elseif ($_GET['h2'] == 'keuangan')
                        include_once('halaman/laporan/keuangan.php');
                    elseif ($_GET['h2'] == 'kasir')
                        include_once('halaman/laporan/kasir.php');
                }

                if ($_GET['h1'] == 'ganti_password')
                    include_once('halaman/ganti_password/index.php');
            } else include_once('halaman/dashboard/dashboard.php');
            ?>
        <?php else : ?>
            <?php include_once('layout/navbar_kasir.php'); ?>
            <?php
            if (isset($_GET['h'])) {
                if ($_GET['h'] == 'ganti_password')
                    include_once('halaman/ganti_password/index.php');

                if ($_GET['h'] == 'riwayat_penjualan')
                    include_once('halaman/riwayat_penjualan/index.php');
                elseif ($_GET['h'] == 'detail_riwayat_penjualan')
                    include_once('halaman/riwayat_penjualan/detail.php');
                elseif ($_GET['h'] == 'stok_bahan_baku')
                    include_once('halaman/stok_bahan_baku/index.php');
                // Pelanggan
                elseif ($_GET['h'] == 'pelanggan')
                    include_once('halaman/pelanggan/index.php');
                elseif ($_GET['h'] == 'lihat_pelanggan')
                    include_once('halaman/pelanggan/lihat.php');
                elseif ($_GET['h'] == 'tambah_pelanggan')
                    include_once('halaman/pelanggan/tambah.php');
                elseif ($_GET['h'] == 'ubah_pelanggan')
                    include_once('halaman/pelanggan/ubah.php');
                elseif ($_GET['h'] == 'hapus_pelanggan')
                    include_once('halaman/pelanggan/hapus.php');
            } else include_once('halaman/kasir/index.php');
            ?>
        <?php endif; ?>

    </main>
</body>

</html>