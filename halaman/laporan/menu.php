<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Laporan Menu</h3>
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
                                <?php $result = $conn->query("SELECT * FROM kategori_menu"); ?>
                                <div class="select-style-1">
                                    <label>Pemasok</label>
                                    <div class="select-position">
                                        <select name="id_kategori_menu" required>
                                            <option value="" disabled selected>Pilih Kategori Menu</option>
                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                <option <?= ($_POST['id_kategori_menu'] ?? '') == $row['id'] ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Filter</button>
                                    <?php
                                    $link = "halaman/laporan/cetak/menu.php?";
                                    if (isset($_POST['id_kategori_menu']))
                                        $link .= "id_kategori_menu=" . $_POST['id_kategori_menu'];
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
                                            <h6>Kategori Menu</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Nama Menu</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT 
                                        km.nama kategori_menu,
                                        m.nama nama_menu 
                                    FROM 
                                        kategori_menu km 
                                    INNER JOIN 
                                        menu m 
                                    ON 
                                        km.id=m.id_kategori_menu 
                                ";

                                if (isset($_POST['id_kategori_menu']))
                                    $q .= " WHERE km.id = '" . $_POST['id_kategori_menu'] . "'";

                                $q .= " ORDER BY km.nama DESC";

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
                                                    <p><?= $row['kategori_menu']; ?></p>
                                                </td>
                                                <td>
                                                    <p><?= $row['nama_menu']; ?></p>
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