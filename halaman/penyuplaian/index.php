<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Pemasok</h3>
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
                                            <h6>Pemasok</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Bahan Baku</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Jumlah</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Harga</h6>
                                        </th>
                                        <th class="text-center fit">
                                            <h6>Aksi</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT  
                                        penyuplaian.*, 
                                        pemasok.nama pemasok, 
                                        bb.nama bahan_baku,
                                        bb.satuan 
                                    FROM 
                                        penyuplaian 
                                    INNER JOIN 
                                        pemasok_bahan_baku pbb 
                                    ON 
                                        pbb.id=penyuplaian.id_pemasok_bahan_baku 
                                    INNER JOIN 
                                        pemasok 
                                    ON 
                                        pemasok.id=pbb.id_pemasok 
                                    INNER JOIN 
                                        bahan_baku bb 
                                    ON 
                                        bb.id=pbb.id_bahan_baku 
                                    ORDER BY 
                                        penyuplaian.id DESC 
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
                                                <td class="text-center">
                                                    <p><?= indoensiaDateWithDay($row['tanggal']); ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['pemasok']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['bahan_baku']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['jumlah']; ?> <?= $row['satuan']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= number_format($row['harga'], 0, ",", "."); ?></p>
                                                </td>
                                                <td class="d-flex gap-2">
                                                    <div class="action">
                                                        <a href="?h1=pemasok&h2=ubah_penyuplaian&id=<?= $row['id']; ?>" class="text-warning">
                                                            <i class="lni lni-pencil"></i>
                                                        </a>
                                                    </div>
                                                    <div class="action">
                                                        <a onclick="return confirm('Yakin?')" href="?h1=pemasok&h2=hapus_penyuplaian&id=<?= $row['id']; ?>" class="text-danger">
                                                            <i class="lni lni-trash-can"></i>
                                                        </a>
                                                    </div>
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