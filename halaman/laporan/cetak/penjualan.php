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
    <h4 class="text-center my-3">Laporan Penjualan</h4>
    <?php if (isset($_GET['status_pelanggan']) || (isset($_GET['dari_tanggal']) && isset($_GET['sampai_tanggal']))) : ?>
        <section class="p-3">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4">
                    <table class="table">
                        <?php if (isset($_GET['status_pelanggan'])) : ?>
                            <tr>
                                <td class="align-middle td-fit">Status Pelaggan</td>
                                <td class="pl-5"><?= $_GET['status_pelanggan']; ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (isset($_GET['dari_tanggal']) && isset($_GET['sampai_tanggal'])) : ?>
                            <tr>
                                <td class="align-middle td-fit">Dari Tanggal</td>
                                <td class="pl-5"><?= indonesiaDate($_GET['dari_tanggal']); ?></td>
                            </tr>
                            <tr>
                                <td class="align-middle td-fit">Sampai Tanggal</td>
                                <td class="pl-5"><?= indonesiaDate($_GET['sampai_tanggal']); ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle td-fit">No</th>
                    <th class="text-center align-middle">Tanggal</th>
                    <th class="text-center align-middle">Nama Pelanggan</th>
                    <th class="text-center align-middle">Status Pelanggan</th>
                    <th class="text-center align-middle">Total Pembelian</th>
                </tr>
            </thead>
            <?php
            $q = "
                SELECT 
                    p.*,
                    DATE(p.tanggal_waktu) tanggal,
                    (SELECT IFNULL(SUM(dp.jumlah * dp.harga), 0) FROM detail_penjualan dp WHERE dp.id_penjualan=p.id) total 
                FROM 
                    penjualan p 
                WHERE 
                    1=1 
            ";

            if (isset($_POST['status_pelanggan'])) {
                if ($_POST['status_pelanggan'] == 'Pelanggan Tetap')
                    $q .= " AND id_pelanggan IS NOT NULL";
                elseif ($_POST['status_pelanggan'] == 'Pelanggan Baru')
                    $q .= " AND id_pelanggan IS NULL";
            }
            if (isset($_GET['dari_tanggal']) && isset($_GET['sampai_tanggal']))
                $q .= " AND DATE(p.tanggal_waktu) >= '" . $_GET['dari_tanggal'] . "' AND DATE(p.tanggal_waktu) <= '" . $_GET['sampai_tanggal'] . "'";

            $q .= " ORDER BY p.tanggal_waktu DESC";

            $result = $conn->query($q);
            $no = 1;
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
                                <p><?= $row['nama']; ?></p>
                            </td>
                            <td class="text-center">
                                <p><?= $row['id_pelanggan'] ? 'Pelanggan Tetap' : 'Pelanggan Baru'; ?></p>
                            </td>
                            <td class="text-center">
                                <p class="m-0">Rp <?= number_format($row['total'], 0, ",", "."); ?></p>
                            </td>
                        </tr>
                    <?php endwhile; ?>
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