<?php
if ($conn->query("DELETE FROM bahan_baku WHERE id=" . $_GET['id']) ) {
    $_SESSION['success'] =  "Bahan Baku Berhasil Dihapus!";
    echo "<script>location.href = '?h1=bahan_baku&h2=daftar_bahan_baku';</script>";
} else die($conn->error);
