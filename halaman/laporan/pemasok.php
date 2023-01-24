<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Laporan Pemasok</h3>
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
                                <?php $result = $conn->query("SELECT * FROM bahan_baku"); ?>
                                <div class="select-style-1">
                                    <label>Bahan Baku</label>
                                    <div class="select-position">
                                        <select name="id_bahan_baku" required>
                                            <option value="" disabled selected>Pilih Bahan Baku</option>
                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                <option <?= ($_POST['id_bahan_baku'] ?? '') == $row['id'] ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Filter</button>
                                    <?php
                                    $link = "halaman/laporan/cetak/pemasok.php?";
                                    if (isset($_POST['id_bahan_baku']))
                                        $link .= "id_bahan_baku=" . $_POST['id_bahan_baku'];
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
                                            <h6>Pemasok</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Barang Yang Disuplai</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT  
                                        p.*, 
                                        GROUP_CONCAT(bb.nama) AS bahan_baku 
                                    FROM 
                                        pemasok p 
                                    LEFT JOIN 
                                        pemasok_bahan_baku pbb 
                                    ON 
                                        pbb.id_pemasok=p.id 
                                    LEFT JOIN 
                                        bahan_baku bb 
                                    ON 
                                        bb.id=pbb.id_bahan_baku 
                                ";

                                if (isset($_POST['id_bahan_baku']))
                                    $q .= " WHERE bb.id = '" . $_POST['id_bahan_baku'] . "'";

                                $q .= "GROUP BY p.id ORDER BY p.nama";
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
                                                    <p><?= $row['nama']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['bahan_baku']; ?></p>
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