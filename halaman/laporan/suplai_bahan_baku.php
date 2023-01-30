<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Laporan Suplai Bahan Baku</h3>
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
                                <?php $result = $conn->query("SELECT * FROM pemasok"); ?>
                                <div class="select-style-1">
                                    <label>Pemasok</label>
                                    <div class="select-position">
                                        <select name="id_pemasok">
                                            <option value="" disabled selected>Pilih Pemasok</option>
                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                <option <?= ($_POST['id_pemasok'] ?? '') == $row['id'] ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
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
                                    $link = "halaman/laporan/cetak/suplai_bahan_baku.php?";
                                    if (isset($_POST['id_pemasok']))
                                        $link .= "id_pemasok=" . $_POST['id_pemasok'];

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
                                            <h6>Pemasok</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Barang Yang Disuplai</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Jumlah</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT 
                                        p.*,
                                        bb.nama bahan_baku,
                                        bb.satuan,
                                        pemasok.id id_pemasok, 
                                        pemasok.nama pemasok 
                                    FROM 
                                        penyuplaian p 
                                    INNER JOIN 
                                        pemasok_bahan_baku pbb 
                                    ON 
                                        pbb.id=p.id_pemasok_bahan_baku 
                                    INNER JOIN 
                                        pemasok 
                                    ON 
                                        pemasok.id=pbb.id_pemasok 
                                    INNER JOIN 
                                        bahan_baku bb 
                                    ON 
                                        bb.id=pbb.id_bahan_baku 
                                    WHERE 
                                        1=1
                                ";

                                if (isset($_POST['id_pemasok']))
                                    $q .= " AND pemasok.id = '" . $_POST['id_pemasok'] . "'";

                                if (!empty($_POST['dari_tanggal'] ?? '') && !empty($_POST['sampai_tanggal'] ?? ''))
                                    $q .= " AND (DATE(p.tanggal) >= '" . $_POST['dari_tanggal'] . "' AND DATE(p.tanggal) <= '" . $_POST['sampai_tanggal'] . "')";

                                $q .= " ORDER BY p.tanggal DESC";

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
                                                    <p><?= $row['pemasok']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['bahan_baku']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['jumlah']; ?> <?= $row['satuan']; ?></p>
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