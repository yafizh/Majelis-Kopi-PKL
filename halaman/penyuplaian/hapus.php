<?php
if ($conn->query("DELETE FROM penyuplaian WHERE id=" . $_GET['id']) ) {
    $_SESSION['success'] =  "Penyuplaian Berhasil Dihapus!";
    echo "<script>location.href = '?h1=pemasok&h2=penyuplaian';</script>";
} else die($conn->error);
