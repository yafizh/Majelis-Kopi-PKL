<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Laporan Penambahan Aset</h3>
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
                                        <input type="date" class="bg-transparent" name="dari_tanggal" value="<?= $_POST['dari_tanggal'] ?? ''; ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Sampai Tanggal</label>
                                        <input type="date" class="bg-transparent" name="sampai_tanggal" value="<?= $_POST['sampai_tanggal'] ?? ''; ?>" />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Filter</button>
                                    <?php
                                    $link = "halaman/laporan/cetak/penambahan_aset.php?";
                                    if (!empty($_POST['sampai_tanggal'] ?? '') && !empty($_POST['dari_tanggal'] ?? ''))
                                        $link .= "&dari_tanggal=" . $_POST['dari_tanggal'] . "&sampai_tanggal=" . $_POST['sampai_tanggal'];
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
                                            <h6>Nama Aset</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Keterangan </h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Jumlah</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT 
                                        ab.*,
                                        a.nama nama_aset 
                                    FROM 
                                        aset_bertambah ab 
                                    INNER JOIN 
                                        aset a 
                                    ON 
                                        a.id=ab.id_aset 
                                    WHERE 
                                        1=1 
                                ";

                                if (!empty($_POST['dari_tanggal'] ?? '') && !empty($_POST['sampai_tanggal'] ?? ''))
                                    $q .= " AND DATE(ab.tanggal) >= '" . $_POST['dari_tanggal'] . "' AND DATE(ab.tanggal) <= '" . $_POST['sampai_tanggal'] . "'";

                                $q .= " ORDER BY ab.tanggal DESC";

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
                                                <td>
                                                    <p><?= $row['nama_aset']; ?></p>
                                                </td>
                                                <td>
                                                    <p><?= $row['keterangan']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['jumlah']; ?></p>
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