<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
require_once('../../database/connection.php');
$data = json_decode(file_get_contents('php://input'), true);

try {
    $conn->begin_transaction();

    $conn->query("UPDATE penjualan SET tunai='" . $data['tunai'] . "' WHERE id=" . $_GET['id']);
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
