<?php
if ($conn->query("DELETE FROM pemasok WHERE id=" . $_GET['id']) ) {
    $_SESSION['success'] =  "Pemasok Berhasil Dihapus!";
    echo "<script>location.href = '?h1=pemasok&h2=daftar_pemasok';</script>";
} else die($conn->error);
