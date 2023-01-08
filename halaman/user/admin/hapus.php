<?php
if ($conn->query("DELETE FROM user WHERE id=" . $_GET['id']) ) {
    $_SESSION['success'] =  "Admin Berhasil Dihapus!";
    echo "<script>location.href = '?h1=user&h2=admin';</script>";
} else die($conn->error);
