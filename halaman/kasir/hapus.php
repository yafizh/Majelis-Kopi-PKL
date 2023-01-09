<?php 
session_start();
require_once('../../database/connection.php');

if ($conn->query("DELETE FROM penjualan WHERE id=" . $_GET['id'])) {
    $_SESSION['success'] =  "Riwayat Penjualan Berhasil Dihapus!";
    echo "<script>location.href = '../../index.php?h=riwayat_penjualan';</script>";
} else die($conn->error);
