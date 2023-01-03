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
                                            IFNULL(SUM(penyuplaian.jumlah), 0) 
                                            - 
                                            IFNULL(SUM(bbm.jumlah * penjualan.jumlah), 0) 
                                        ) AS jumlah
                                    FROM   
                                        bahan_baku bb 
                                    LEFT JOIN 
                                        pemasok_bahan_baku pbb 
                                    ON 
                                        pbb.id_bahan_baku=bb.id 
                                    LEFT JOIN 
                                        penyuplaian 
                                    ON 
                                        penyuplaian.id_pemasok_bahan_baku=pbb.id 
                                    LEFT JOIN 
                                        bahan_baku_menu bbm 
                                    ON 
                                        bbm.id_bahan_baku=bb.id 
                                    LEFT JOIN 
                                        menu m 
                                    ON 
                                        m.id=bbm.id_menu 
                                    LEFT JOIN 
                                        penjualan 
                                    ON 
                                        penjualan.id_menu=m.id 
                                    GROUP BY 
                                        bb.id 
                                    ORDER BY 
                                        bb.nama 
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