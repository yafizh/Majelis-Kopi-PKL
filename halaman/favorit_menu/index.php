<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Favorit Menu</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="tables-wrapper">
            <?php
            $q = "
                    SELECT 
                        * 
                    FROM 
                        kategori_menu 
                    ORDER BY 
                        (SELECT COUNT(*) FROM menu WHERE id_kategori_menu=kategori_menu.id) DESC
                ";
            $kategori_menu = $conn->query($q);
            ?>
            <div class="row">
                <?php while ($row1 = $kategori_menu->fetch_assoc()) : ?>
                    <div class="col-12 col-md-6">
                        <div class="card-style mb-30">
                            <h6 class="mb-10">Kategori <?= $row1['nama']; ?></h6>
                            <div class="table-responsive">
                                <table id="table" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center fit">
                                                <h6>No</h6>
                                            </th>
                                            <th class="text-center">
                                                <h6>Nama Menu</h6>
                                            </th>
                                            <th class="text-center">
                                                <h6>Jumlah Terjual</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $q = "
                                        SELECT 
                                            *,
                                            (SELECT COUNT(*) FROM detail_penjualan WHERE id_menu=menu.id) jumlah
                                        FROM 
                                            menu 
                                        WHERE 
                                            id_kategori_menu=" . $row1['id'] . " 
                                        ORDER BY 
                                            (SELECT COUNT(*) FROM detail_penjualan WHERE id_menu=menu.id) DESC";
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
                                                        <p><?= $row['jumlah']; ?></p>
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
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>