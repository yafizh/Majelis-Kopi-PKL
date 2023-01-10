<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Stok Bahan Baku</h3>
                    </div>
                </div>
            </div>
        </div>
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
                                            <h6>Bahan Baku</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Stok</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                SELECT 
                                    bb.*,
                                    (
                                        (
                                            SELECT 
                                                IFNULL(SUM(p.jumlah), 0) 
                                            FROM 
                                                penyuplaian p 
                                            INNER JOIN 
                                                pemasok_bahan_baku pbb 
                                            ON 
                                                pbb.id=p.id_pemasok_bahan_baku 
                                            WHERE 
                                                pbb.id_bahan_baku=bb.id
                                        ) 
                                        -
                                        (
                                            SELECT 
                                                IFNULL(SUM(bbm.jumlah * dp.jumlah), 0) 
                                            FROM 
                                                detail_penjualan dp 
                                            INNER JOIN 
                                                penjualan p 
                                            ON 
                                                p.id=dp.id_penjualan 
                                            INNER JOIN 
                                                menu m 
                                            ON 
                                                m.id=dp.id_menu 
                                            INNER JOIN 
                                                bahan_baku_menu bbm 
                                            ON 
                                                bbm.id_menu=m.id 
                                            WHERE 
                                                bbm.id_bahan_baku=bb.id
                                            )
                                    ) jumlah 
                                FROM 
                                    bahan_baku bb 
                                ORDER BY 
                                    bb.nama;
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
                                                    <p><?= $row['nama']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['jumlah']; ?> <?= $row['satuan']; ?></p>
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