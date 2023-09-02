<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Uang Kas</h3>
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
                                            <h6>Mulai</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Selesai</h6>
                                        </th>
                                        <th class="text-center fit">
                                            <h6>Aksi</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                INSERT INTO uang_kas_kasir (
                                    id_kasir,
                                    tanggal,
                                    mulai,
                                    selesai
                                ) SELECT * FROM (SELECT 
                                    '" . $_SESSION['user']['id_kasir'] . "',
                                    '" . Date("Y-m-d") . "',
                                    '0' AS 'mulai',
                                    '0' AS 'selesai'
                                ) AS tmp 
                                WHERE NOT EXISTS (SELECT * FROM uang_kas_kasir WHERE tanggal = '" . Date("Y-m-d") . "' AND id_kasir = " . $_SESSION['user']['id_kasir'] . ")
                                ";
                                $conn->query($q);

                                $q = "
                                    SELECT 
                                        * 
                                    FROM
                                        uang_kas_kasir
                                    WHERE 
                                        id_kasir = " . $_SESSION['user']['id_kasir'] . "
                                    ORDER BY 
                                        tanggal DESC 
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
                                                    <p><?= number_format($row['mulai'], 0, ",", "."); ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= number_format($row['selesai'], 0, ",", "."); ?></p>
                                                </td>
                                                <td class="d-flex gap-2">
                                                    <div class="action">
                                                        <a href="?h=ubah_uang_kas&id=<?= $row['id']; ?>" class="text-warning">
                                                            <i class="lni lni-pencil"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td class="text-center" colspan="5">Data Kosong</td>
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