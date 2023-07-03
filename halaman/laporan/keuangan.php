<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Laporan Keuangan</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card-style mb-30">
                        <form action="" method="POST">
                            <div class="col-12">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Bulan</label>
                                        <input type="month" class="bg-transparent" name="bulan" value="<?= $_POST['bulan'] ?? Date("Y-m"); ?>" />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Filter</button>
                                    <?php
                                    $link = "halaman/laporan/cetak/keuangan.php?bulan=" . ($_POST['bulan'] ?? Date("Y-m"));
                                    ?>
                                    <a href="<?= $link; ?>" target="_blank" class="main-btn btn-sm success-btn btn-hover">Cetak</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card-style mb-30">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center fit">
                                            <h6>No</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Tanggal</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Total Pendapatan</h6>
                                        </th>
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
                                                    <p><?= $no++; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= indonesiaDate($row['tanggal']); ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p>Rp <?= number_format($row['pendapatan'], 0, ",", "."); ?></p>
                                                </td>
                                            </tr>
                                            <?php $pendapatan += $row['pendapatan']; ?>
                                        <?php endwhile; ?>
                                        <tr>
                                            <td colspan="2">
                                                <p><strong>Laba Kotor</strong></p>
                                            </td>
                                            <td class="text-center">
                                                <p><strong>Rp <?= number_format($pendapatan, 0, ",", "."); ?></strong></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p><strong>Pengeluaran</strong></p>
                                            </td>
                                            <td class="text-center">
                                                <p><strong>Rp <?= number_format($laba_kotor, 0, ",", "."); ?></strong></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p><strong>Laba Bersih</strong></p>
                                            </td>
                                            <td class="text-center">
                                                <p><strong>Rp <?= number_format($pendapatan - $laba_kotor, 0, ",", "."); ?></strong></p>
                                            </td>
                                        </tr>
                                    <?php else : ?>
                                        <tr>
                                            <td class="text-center" colspan="3">Data Kosong</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>