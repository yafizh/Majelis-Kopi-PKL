<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3><a href="?h=riwayat_penjualan" class="breadcrumb-item">Riwayat Penjualan</a> <span style="color: #5D657B;">/</span> Detail Riwayat Penjualan</h3>
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
                <div class="col-lg-8">
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
                                            <h6>Harga</h6>
                                        </th>
                                        <th class="text-center fit">
                                            <h6>Jumlah Pembelian</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT 
                                        dp.id,
                                        m.nama,
                                        dp.harga,
                                        dp.jumlah,
                                        m.foto  
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
                                                <td class="px-5">
                                                    <p><?= $row['nama']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p>Rp <?= number_format($row['harga'], 0, ",", "."); ?></p>
                                                </td>
                                                <td class="text-center fit">
                                                    <p><?= $row['jumlah']; ?></p>
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
                <div class="col-lg-4">
                    <div class="card-style mb-30">
                        <div class="table-responsive">
                            <table class="table">
                                <?php
                                $q = "
                                    SELECT 
                                        p.*,
                                        SUM(dp.jumlah * dp.harga) total 
                                    FROM 
                                        penjualan p
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
                                ?>
                                <tbody>
                                    <tr>
                                        <th>Total</th>
                                        <td class="ps-3">
                                            <input type="text" class="form-control text-end" disabled value="<?= number_format($penjualan['total'], 0, ",", "."); ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tunai</th>
                                        <td class="ps-3">
                                            <input type="text" class="form-control text-end" disabled value="<?= number_format($penjualan['tunai'], 0, ",", "."); ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kembalian</th>
                                        <td class="ps-3">
                                            <input type="text" name="kembalian" class="form-control text-end" disabled value="<?= number_format($penjualan['tunai'] - $penjualan['total'], 0, ",", "."); ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="d-flex gap-3">
                                                <a href="?id=<?= $_GET['id']; ?>" class="btn btn-warning flex-grow-1">EDIT</a>
                                                <a href="halaman/kasir/hapus.php?id=<?= $_GET['id']; ?>" onclick="return confirm('Yakin?')" class="btn btn-danger flex-grow-1">HAPUS</a>
                                            </div>
                                        </td>
                                    </tr>
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