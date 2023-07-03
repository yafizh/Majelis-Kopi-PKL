<?php
$result = $conn->query("SELECT * FROM presensi_kasir WHERE id=" . $_GET['id']);
$data = $result->fetch_assoc();
if (
    $conn->query("DELETE FROM presensi_kasir WHERE id=" . $_GET['id'])
    &&
    $conn->query("DELETE FROM penggajian_kasir WHERE id_kasir=" . $data['id_kasir'] . " AND bulan=" . $data['bulan'] . " AND tahun=" . $data['tahun'])
) {
    $_SESSION['success'] =  "Presensi Berhasil Dihapus!";
    echo "<script>location.href = '?h1=karyawan&h2=presensi&h3=karyawan_per_presensi&id_kasir=" . $data['id_kasir'] . "';</script>";
} else die($conn->error);
