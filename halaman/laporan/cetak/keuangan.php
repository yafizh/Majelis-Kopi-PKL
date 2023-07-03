<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../assets/images/logo/logo.jpg" type="image/x-icon" />
</head>

<body>
    <?php include_once('header.php'); ?>
    <h4 class="text-center my-3">Laporan Keuangan</h4>
    <section class="p-3">
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-4">
                <table class="table">
                    <tr>
                        <td class="align-middle td-fit">Bulan</td>
                        <td class="pl-5"><?= MONTH_IN_INDONESIA[intval(explode('-', $_GET['bulan'])[1])] . " " . explode('-', $_GET['bulan'])[0]; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle td-fit">No</th>
                    <th class="text-center align-middle">Tanggal</th>
                    <th class="text-center align-middle">Pendapatan</th>
                </tr>
            </thead>
            <?php
            $q = "
                SELECT  
                    DATE(p.tanggal_waktu) tanggal,
                    SUM(dp.harga) pendapatan
                FROM 
                    penjualan p 
                INNER JOIN 
                    detail_penjualan dp 
                ON 
                    dp.id_penjualan=p.id 
            ";

            $bulan_tahun = $_POST['bulan'] ?? Date("Y-m");
            $bulan = explode("-", $bulan_tahun)[1];
            $tahun = explode("-", $bulan_tahun)[0];

            $q .= "
                WHERE 
                    MONTH(p.tanggal_waktu) = '{$bulan}' 
                    AND 
                    YEAR(p.tanggal_waktu) = '{$tahun}'
            ";

            $q .= "GROUP BY tanggal ORDER BY tanggal";
            $result = $conn->query($q);
            $no = 1;
            $pendapatan = 0;

            $q = "
                SELECT 
                    SUM(harga) laba_kotor
                FROM 
                    penyuplaian 
                WHERE 
                    MONTH(tanggal) = '{$bulan}' 
                    AND 
                    YEAR(tanggal) = '{$tahun}' 
            ";
            $result2 = $conn->query($q);
            $laba_kotor = $result2->fetch_assoc()['laba_kotor'];
            ?>
            <tbody>
                <?php if ($result->num_rows) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="text-center fit">
                                <p class="m-0"><?= $no++; ?></p>
                            </td>
                            <td class="text-center">
                                <p class="m-0"><?= indonesiaDate($row['tanggal']); ?></p>
                            </td>
                            <td class="text-center">
                                <p class="m-0"><?= $row['pendapatan']; ?></p>
                            </td>
                        </tr>
                        <?php $pendapatan += $row['pendapatan']; ?>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="2">
                            <p class="m-0"><strong>Laba Kotor</strong></p>
                        </td>
                        <td class="text-center">
                            <p class="m-0"><strong>Rp <?= number_format($pendapatan, 0, ",", "."); ?></strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p class="m-0"><strong>Pengeluaran</strong></p>
                        </td>
                        <td class="text-center">
                            <p class="m-0"><strong>Rp <?= number_format($laba_kotor, 0, ",", "."); ?></strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p class="m-0"><strong>Laba Bersih</strong></p>
                        </td>
                        <td class="text-center">
                            <p class="m-0"><strong>Rp <?= number_format($pendapatan - $laba_kotor, 0, ",", "."); ?></strong></p>
                        </td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td class="text-center" colspan="3">Data Kosong</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <?php include_once('footer.php'); ?>
</body>

</html>