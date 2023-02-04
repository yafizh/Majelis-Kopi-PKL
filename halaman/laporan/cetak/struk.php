<?php
include_once('../../../assets/fpdf/fpdf.php');
include_once('../../../database/connection.php');

$q = "
    SELECT 
        dp.id,
        m.nama,
        dp.harga,
        dp.jumlah
    FROM 
        detail_penjualan dp 
    INNER JOIN 
        menu m 
    ON 
        m.id=dp.id_menu 
    WHERE 
        dp.id_penjualan=" . $_GET['id'] . " 
    ORDER BY 
        dp.id DESC
    ";
$pembelian = $conn->query($q);

$q = "
SELECT 
    k.nama nama_kasir,
    p.*,
    SUM(dp.jumlah * dp.harga) total,
    DATE(p.tanggal_waktu) tanggal,
    DATE_FORMAT(p.tanggal_waktu, '%H:%i') waktu 
FROM 
    penjualan p
INNER JOIN 
    kasir k 
ON 
    k.id=p.id_kasir 
INNER JOIN 
    detail_penjualan dp 
ON 
    dp.id_penjualan=p.id 
WHERE 
    p.id=" . $_GET['id'] . "
GROUP BY 
    p.id 
";
$penjualan = $conn->query($q)->fetch_assoc();

$border = 0;
$height = 65;
$pageSize = [60, $height];

$pdf = new FPDF('P', 'mm', $pageSize);
$pdf->SetMargins(4, 4);
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();


$pdf->SetFont('Arial', '', 4);
$pdf->Cell(0, 2, '============================================================', $border, 2, 'C');
$pdf->Cell(0, 2, 'MAJELIS KOPI', $border, 2, 'C');
$pdf->Cell(0, 2, 'JL PANGLIMA BATUR BANJARBARU', $border, 2, 'C');
$pdf->Cell(0, 2, '============================================================', $border, 2, 'C');


$pdf->SetFont('Arial', '', 4);
$pdf->Cell(0, 2, 'Nama Kasir: ' . $penjualan['nama_kasir'], $border, 2,);
$pdf->Cell(26, 2, 'Tanggal: ' . indonesiaDate($penjualan['tanggal']), $border, 0);
$pdf->Cell(26, 2, 'Waktu: ' . $penjualan['waktu'], $border, 1, 'R');
$pdf->Cell(0, 2, '============================================================', $border, 2, 'C');

$total = 0;
$pdf->SetFont('Arial', '', 4);
while ($row = $pembelian->fetch_assoc()) {
    $pdf->Cell(0, 2, $row['nama'], $border, 2);
    $pdf->Cell(10, 2, $row['jumlah'] . ' x', $border, 0, 'L');
    $pdf->Cell(26, 2, 'Rp ' . number_format($row['harga'], 0, ",", "."), $border, 0);
    $pdf->Cell(6, 2, 'Rp', $border, 0);
    $pdf->Cell(10, 2, number_format($row['harga'] * $row['jumlah'], 0, ",", "."), $border, 1, 'R');
    $total += $row['harga'] * $row['jumlah'];
}

$pdf->Cell(0, 2, '============================================================', $border, 2, 'C');

$pdf->SetFont('Arial', 'B', 4);
$pdf->Cell(36, 2, 'Total', $border, 0);
$pdf->Cell(6, 2, 'Rp', $border, 0);
$pdf->Cell(10, 2, number_format($total, 0, ",", "."), $border, 1, 'R');

$pdf->SetFont('Arial', '', 4);
$pdf->Cell(0, 2, '============================================================', $border, 2, 'C');

$pdf->SetFont('Arial', 'B', 4);
$pdf->Cell(36, 2, 'Tunai', $border, 0);
$pdf->Cell(6, 2, 'Rp', $border, 0);
$pdf->Cell(10, 2, number_format($penjualan['tunai'], 0, ",", "."), $border, 1, 'R');
$pdf->Cell(36, 2, 'Kembali', $border, 0);
$pdf->Cell(6, 2, 'Rp', $border, 0);
$pdf->Cell(10, 2, number_format($penjualan['tunai'] - $total, 0, ",", "."), $border, 1, 'R');

$pdf->Output();
