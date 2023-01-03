<?php
if ($conn->query("DELETE FROM kategori_menu WHERE id=" . $_GET['id']) ) {
    $_SESSION['success'] =  "Kategori Menu Berhasil Dihapus!";
    echo "<script>location.href = '?h1=kategori_menu';</script>";
} else die($conn->error);
