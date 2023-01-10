<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Riwayat Penjualan</h3>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert-box success-alert">
                <div class="alert">
                    <h4 class="alert-heading">Berhasil</h4>
                    <p class="text-medium">
                        <?= $_SESSION['success']; ?>
                    </p>
                </div>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
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
                                            <h6>Total Pembelian</h6>
                                        </th>
                                        <th class="fit">
                                            <h6>Aksi</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT 
                                        p.*,
                                        DATE(p.tanggal_waktu) tanggal,
                                        IFNULL(SUM(dp.jumlah * dp.harga), 0) total 
                                    FROM 
                                        penjualan p
                                    INNER JOIN 
                                        detail_penjualan dp 
                                    ON 
                                        dp.id_penjualan=p.id 
                                ";

                                if ($_SESSION['user']['status'] == 'KASIR')
                                    $q .= " WHERE p.id_kasir=" . $_SESSION['user']['id_kasir'];

                                $q .= " 
                                    GROUP BY 
                                        p.id 
                                    ORDER BY 
                                        p.tanggal_waktu DESC";

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
                                                    <p><?= indoensiaDateWithDay($row['tanggal']); ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p>Rp <?= number_format($row['total'], 0, ",", "."); ?></p>
                                                </td>
                                                <td>
                                                    <?php if ($_SESSION['user']['status'] == 'KASIR') : ?>
                                                        <div class="action">
                                                            <a href="?h=detail_riwayat_penjualan&id=<?= $row['id']; ?>" class="text-secondary" title="Lihat Detail Penjualan">
                                                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                                    <path fill="currentColor" d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    <?php else : ?>
                                                        <div class="action">
                                                            <a href="?h1=menu&h2=detail_penjualan&id=<?= $row['id']; ?>" class="text-secondary" title="Lihat Detail Penjualan">
                                                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                                    <path fill="currentColor" d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td class="text-center" colspan="4">Data Kosong</td>
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