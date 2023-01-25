<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
require_once('../../database/connection.php');
$data = json_decode(file_get_contents('php://input'), true);

try {
    $conn->begin_transaction();

    if ($data['pelanggan_tetap']) {
        $pelanggan_tetap = $conn->query("SELECT * FROM pelanggan WHERE id=" . $data['id_pelanggan'])->fetch_assoc();
        $data['nama_pelanggan'] = $pelanggan_tetap['nama'];
    }

    $q = "
        UPDATE penjualan SET 
            tunai='" . $data['tunai'] . "', 
            id_pelanggan=" . ($data['pelanggan_tetap'] ? $data['id_pelanggan'] : 'NULL') . ",
            nama='" . $data['nama_pelanggan'] . "'
        WHERE 
            id=" . $_GET['id'];
    $conn->query($q);

    $conn->query("DELETE FROM detail_penjualan WHERE id_penjualan=" . $_GET['id']);
    foreach ($data['pesanan'] as $value) {
        $q = "
        INSERT INTO detail_penjualan (
            id_penjualan, 
            id_menu,
            jumlah,
            harga
        ) VALUES (
            " . $_GET['id'] . ",
            " . $value['id_menu'] . ",
            " . $value['jumlah'] . ",
            " . $value['harga'] . "
        )";
        $conn->query($q);
    }

    $conn->commit();
    echo json_encode([
        'isSuccess' => 1
    ]);
} catch (\Throwable $e) {
    $conn->rollback();
    echo json_encode([
        'isSuccess' => 0
    ]);
    throw $e;
};
