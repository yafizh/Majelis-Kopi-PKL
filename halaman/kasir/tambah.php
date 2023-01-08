<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
require_once('../../database/connection.php');
$data = json_decode(file_get_contents('php://input'), true);

try {
    $conn->begin_transaction();

    $q = "
        INSERT INTO penjualan (
            id_kasir, 
            tunai,
            tanggal_waktu 
        ) VALUES (
            " . $_SESSION['user']['id_kasir'] . ",
            '" . $data['tunai'] . "',
            '" . Date("Y-m-d H:i:s") . "'
        )
    ";
    $conn->query($q);
    $id_penjualan = $conn->insert_id;

    foreach ($data['pesanan'] as $value) {
        $q = "
        INSERT INTO detail_penjualan (
            id_penjualan, 
            id_menu
        ) VALUES (
            " . $id_penjualan . ",
            " . $value['id_menu'] . "
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
