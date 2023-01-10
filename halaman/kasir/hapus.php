<?php
session_start();
require_once('../../database/connection.php');

if ($conn->query("DELETE FROM penjualan WHERE id=" . $_GET['id'])) {
    $_SESSION['success'] =  "Riwayat Penjualan Berhasil Dihapus!";
    if ($_SESSION['user']['status'] == 'ADMIN')
        echo "<script>location.href = '../../index.php?h1=menu&h2=penjualan';</script>";
    else
        echo "<script>location.href = '../../index.php?h=riwayat_penjualan';</script>";
} else die($conn->error);
