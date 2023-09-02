<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Laporan Grafik Menu Favorit</h3>
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
                                    <div class="select-style-1">
                                        <?php
                                        $kategori_menu = $conn->query("SELECT * FROM kategori_menu ORDER BY nama");
                                        ?>
                                        <label>Kategori Menu</label>
                                        <div class="select-position">
                                            <select required name="id_kategori_menu">
                                                <option value="" selected disabled>Pilih Kategori Menu</option>
                                                <?php while ($row = $kategori_menu->fetch_assoc()) : ?>
                                                    <option value="<?= $row['id']; ?>" <?= ($_POST['id_kategori_menu'] ?? '0') == $row['id'] ? 'selected' : ''; ?>><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="select-style-1">
                                        <label>Bulan</label>
                                        <div class="select-position">
                                            <select required name="bulan">
                                                <!-- <option value="" selected disabled>Pilih Bulan</option> -->
                                                <option value="1" <?= (($_POST['bulan'] ?? '0') == 1) ? 'selected' : ''; ?>>Januari</option>
                                                <option value="2" <?= (($_POST['bulan'] ?? '0') == 2) ? 'selected' : ''; ?>>Februari</option>
                                                <option value="3" <?= (($_POST['bulan'] ?? '0') == 3) ? 'selected' : ''; ?>>Maret</option>
                                                <option value="4" <?= (($_POST['bulan'] ?? '0') == 4) ? 'selected' : ''; ?>>April</option>
                                                <option value="5" <?= (($_POST['bulan'] ?? '0') == 5) ? 'selected' : ''; ?>>Mei</option>
                                                <option value="6" <?= (($_POST['bulan'] ?? '0') == 6) ? 'selected' : ''; ?>>Juni</option>
                                                <option value="7" <?= (($_POST['bulan'] ?? '0') == 7) ? 'selected' : ''; ?>>Juli</option>
                                                <option value="8" <?= (($_POST['bulan'] ?? '0') == 8) ? 'selected' : ''; ?>>Agustus</option>
                                                <option value="9" <?= (($_POST['bulan'] ?? '0') == 9) ? 'selected' : ''; ?>>September</option>
                                                <option value="10" <?= (($_POST['bulan'] ?? '0') == 10) ? 'selected' : ''; ?>>Oktober</option>
                                                <option value="11" <?= (($_POST['bulan'] ?? '0') == 11) ? 'selected' : ''; ?>>November</option>
                                                <option value="12" <?= (($_POST['bulan'] ?? '0') == 12) ? 'selected' : ''; ?>>Desember</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tahun</label>
                                        <input type="number" class="bg-transparent" name="tahun" required value="<?= $_POST['tahun'] ?? Date("Y"); ?>" />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Filter</button>
                                    <?php
                                    $link = "halaman/laporan/cetak/grafik_favorit_menu.php";
                                    if (isset($_POST['submit']))
                                        $link .= "?id_kategori_menu=" . $_POST['id_kategori_menu'] . "&bulan=" . $_POST['bulan'] . "&tahun=" . $_POST['tahun'];
                                    ?>
                                    <a href="<?= $link; ?>" target="_blank" class="main-btn btn-sm success-btn btn-hover">Cetak</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if (isset($_POST['submit'])) : ?>
                    <?php
                    $sub_q = "
                        SELECT 
                            COUNT(*) 
                        FROM 
                            detail_penjualan dp 
                        INNER JOIN 
                            penjualan p 
                        ON 
                            p.id=dp.id_penjualan 
                        WHERE 
                            dp.id_menu=m.id 
                            AND 
                            (
                                YEAR(p.tanggal_waktu) = '" . $_POST['tahun'] . "'
                                AND
                                MONTH(p.tanggal_waktu) = '" . $_POST['bulan'] . "'
                            )
                    ";


                    $q = "
                        SELECT  
                            m.nama,
                            ($sub_q) jumlah_penjualan 
                        FROM 
                            menu m 
                        WHERE 
                            m.id_kategori_menu = " . $_POST['id_kategori_menu'] . "
                        ORDER BY 
                            jumlah_penjualan DESC 
                    ";

                    $result = $conn->query($q);
                    $labels = [];
                    $data   = [];
                    $colors = [];
                    while ($row = $result->fetch_assoc()) {
                        $labels[] = $row['nama'];
                        $data[] = $row['jumlah_penjualan'];
                        $colors[] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                    }
                    ?>
                    <div class="col-lg-9">
                        <div class="card-style mb-30">
                            <canvas id="myChart" width="400" height="300"></canvas>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>
<script>
    const labels = JSON.parse(`<?= json_encode($labels); ?>`);
    const data = JSON.parse(`<?= json_encode($data); ?>`);
    const colors = JSON.parse(`<?= json_encode($colors); ?>`);
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Penjualan',
                data: data,
                borderWidth: 1,
                backgroundColor: colors
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            animation: {
                duration: 0 // general animation time
            },
            hover: {
                animationDuration: 0 // duration of animations when hovering an item
            },
            responsiveAnimationDuration: 0 // animation duration after a resize
        }
    });
</script>