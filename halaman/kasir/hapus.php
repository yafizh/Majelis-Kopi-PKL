<?php
if ($conn->query("DELETE FROM user WHERE id=" . $_GET['id']) ) {
    $_SESSION['success'] =  "Kasir Berhasil Dihapus!";
    echo "<script>location.href = '?h1=user&h2=kasir';</script>";
} else die($conn->error);
