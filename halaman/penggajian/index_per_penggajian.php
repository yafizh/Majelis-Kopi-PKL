<?php $kasir = $conn->query("SELECT * FROM kasir WHERE id=" . $_GET['id_kasir'])->fetch_assoc(); ?>
<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3><a href="?h1=karyawan&h2=penggajian" class="breadcrumb-item">Penggajian</a> <span style="color: #5D657B;">/</span> <?= $kasir['nama']; ?></h3>
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
                                            <h6>Bulan</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Gaji Pokok</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Potongan Gaji</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Total Gaji</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $result = $conn->query("SELECT * FROM penggajian_kasir WHERE id_kasir=" . $_GET['id_kasir'] . " ORDER BY tahun DESC, bulan DESC");
                                $no = 1;
                                ?>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                        <tr>
                                            <td class="text-center fit">
                                                <p><?= $no++; ?></p>
                                            </td>
                                            <td class="text-center">
                                                <p><?= MONTH_IN_INDONESIA[intval($row['bulan'])-1] . " " . $row['tahun']; ?></p>
                                            </td>
                                            <td class="text-center">
                                                <p>Rp <?= number_format($row['nominal_gaji'], 0, ",", "."); ?></p>
                                            </td>
                                            <td class="text-center">
                                                <p>Rp <?= number_format($row['potongan_gaji'], 0, ",", "."); ?></p>
                                            </td>
                                            <td class="text-center">
                                                <p>Rp <?= number_format($row['nominal_gaji'] - $row['potongan_gaji'], 0, ",", "."); ?></p>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
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