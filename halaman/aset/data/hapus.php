<?php
if ($conn->query("DELETE FROM aset WHERE id=" . $_GET['id']) ) {
    $_SESSION['success'] =  "Aset Berhasil Dihapus!";
    echo "<script>location.href = '?h1=aset&h2=data_aset';</script>";
} else die($conn->error);
