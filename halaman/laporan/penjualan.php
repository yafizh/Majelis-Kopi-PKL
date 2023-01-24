<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Laporan Penjualan</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card-style mb-30">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Dari Tanggal</label>
                                        <input type="date" class="bg-transparent" name="dari_tanggal" required value="<?= $_POST['dari_tanggal'] ?? ''; ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Sampai Tanggal</label>
                                        <input type="date" class="bg-transparent" name="sampai_tanggal" required value="<?= $_POST['sampai_tanggal'] ?? ''; ?>" />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Filter</button>
                                    <?php
                                    $link = "halaman/laporan/cetak/penjualan.php";
                                    if (isset($_POST['sampai_tanggal']) && isset($_POST['dari_tanggal']))
                                        $link .= "?dari_tanggal=" . $_POST['dari_tanggal'] . "&sampai_tanggal=" . $_POST['sampai_tanggal'];
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
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center fit">
                                            <h6>No</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Tanggal</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Total Pembelian </h6>
                                        </th>
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
                                ";


                                if (isset($_POST['dari_tanggal']) && isset($_POST['sampai_tanggal']))
                                    $q .= " WHERE DATE(p.tanggal_waktu) >= '" . $_POST['dari_tanggal'] . "' AND DATE(p.tanggal_waktu) <= '" . $_POST['sampai_tanggal'] . "'";

                                $q .= " ORDER BY p.tanggal_waktu DESC";

                                $result = $conn->query($q);
                                $no = 1;
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
                                                    <p>Rp <?= number_format($row['total'], 0, ",", "."); ?></p>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>