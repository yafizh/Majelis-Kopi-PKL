<?php
if ($conn->query("DELETE FROM pelanggan WHERE id=" . $_GET['id']) ) {
    $_SESSION['success'] =  "Pelanggan Tetap Berhasil Dihapus!";
    echo "<script>location.href = '?h1=pelanggan';</script>";
} else die($conn->error);
