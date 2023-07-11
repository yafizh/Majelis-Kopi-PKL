<?php
$penambahan_aset = $conn->query("SELECT * FROM aset_berkurang WHERE id=" . $_GET['id'])->fetch_assoc();
$conn->query("UPDATE aset SET jumlah = jumlah + " . $penambahan_aset['jumlah'] . " WHERE id=" . $penambahan_aset['id_aset']);
if ($conn->query("DELETE FROM aset_berkurang WHERE id=" . $_GET['id'])) {
    $_SESSION['success'] =  "Pengurangan Aset Berhasil Dihapus!";
    echo "<script>location.href = '?h1=aset&h2=pengurangan_aset';</script>";
} else die($conn->error);
