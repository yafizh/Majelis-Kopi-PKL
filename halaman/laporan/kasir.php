<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30 d-flex justify-content-between align-items-center">
                        <h3>Laporan Kasir</h3>
                        <a href="halaman/laporan/cetak/kasir.php" target="_blank" class="main-btn btn-sm success-btn btn-hover">Cetak</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card-style mb-30">
                        <div class="table-responsive">
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center fit">
                                            <h6>No</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Nama</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Tempat Lahir</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Tanggal Lahir</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Jenis Kelamin</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Gaji</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT 
                                        * 
                                    FROM 
                                        kasir
                                    ORDER BY 
                                        nama 
                                ";

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
                                                <td>
                                                    <p><?= $row['nama']; ?></p>
                                                </td>
                                                <td>
                                                    <p><?= $row['tempat_lahir']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= indonesiaDate($row['tanggal_lahir']); ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['jenis_kelamin']; ?></p>
                                                </td>
                                                <td class="text-end">
                                                    <p>Rp <?= number_format($row['nominal_gaji'], 0, ",", "."); ?></p>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td class="text-center" colspan="6">Data Kosong</td>
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