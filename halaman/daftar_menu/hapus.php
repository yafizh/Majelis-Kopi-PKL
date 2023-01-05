<?php
if ($conn->query("DELETE FROM menu WHERE id=" . $_GET['id'])) {
    $_SESSION['success'] =  "Menu Berhasil Dihapus!";
    echo "<script>location.href = '?h1=menu&h2=daftar_menu&h3=daftar_menu_per_kategori&id_kategori_menu=" . $_GET['id_kategori_menu'] . "';</script>";
} else die($conn->error);
