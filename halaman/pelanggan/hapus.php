<?php
if ($conn->query("DELETE FROM pelanggan WHERE id=" . $_GET['id'])) {
    $_SESSION['success'] =  "Pelanggan Tetap Berhasil Dihapus!";
    if ($_SESSION['user']['status'] == 'KASIR')
        echo "<script>location.href = '?h=pelanggan';</script>";
    else
        echo "<script>location.href = '?h1=pelanggan';</script>";
} else die($conn->error);
