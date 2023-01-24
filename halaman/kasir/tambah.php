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
            id_menu,
            jumlah,
            harga
        ) VALUES (
            " . $id_penjualan . ",
            " . $value['id_menu'] . ",
            " . $value['jumlah'] . ",
            " . $value['harga'] . "
        )";
        $conn->query($q);
        $id_detail_penjualan = $conn->insert_id;

        $q = "
            SELECT 
                bb.*,
                bbm.jumlah 
            FROM 
                bahan_baku_menu bbm 
            INNER JOIN 
                bahan_baku bb 
            ON 
                bb.id=bbm.id_bahan_baku 
            WHERE 
                bbm.id_menu=" . $value['id_menu'] . "
        ";
        $bahan_baku_menu = $conn->query($q);
        while ($row = $bahan_baku_menu->fetch_assoc()) {
            $q = "
                INSERT INTO bahan_baku_digunakan(
                    id_detail_penjualan,
                    id_bahan_baku,
                    jumlah 
                ) VALUES (
                    " . $id_detail_penjualan . ",
                    " . $row['id'] . ",
                    " . $row['jumlah'] . "
                )
            ";
            $conn->query($q);
        }
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
