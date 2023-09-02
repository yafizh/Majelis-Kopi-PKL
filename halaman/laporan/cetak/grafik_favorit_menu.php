<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Grafik Menu Favorit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../assets/images/logo/logo.jpg" type="image/x-icon" />
</head>

<body>
    <?php include_once('header.php'); ?>
    <h4 class="text-center my-3">Laporan Grafik Menu Favorit</h4>
    <section class="p-3">
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-4">
                <table class="table">
                    <?php
                    $kategori_menu = $conn->query("SELECT * FROM kategori_menu WHERE id=" . $_GET['id_kategori_menu'])->fetch_assoc();
                    ?>
                    <tr>
                        <td class="align-middle td-fit">Kategori Menu</td>
                        <td class="pl-5"><?= $kategori_menu['nama']; ?></td>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Bulan</td>
                        <td class="pl-5"><?= MONTH_IN_INDONESIA[intval($_GET['bulan']) - 1]; ?></td>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Tahun</td>
                        <td class="pl-5"><?= $_GET['tahun']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
    <main class="p-3">
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
                        YEAR(p.tanggal_waktu) = '" . $_GET['tahun'] . "'
                        AND
                        MONTH(p.tanggal_waktu) = '" . $_GET['bulan'] . "'
                    )
            ";

        $q = "
            SELECT  
                m.nama,
                ($sub_q) jumlah_penjualan 
            FROM 
                menu m 
            WHERE 
                m.id_kategori_menu = " . $_GET['id_kategori_menu'] . "
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
        <canvas id="myChart" width="400" height="300"></canvas>
    </main>
    <?php include_once('footer.php'); ?>
    <script src="../../../assets/js/Chart.min.js"></script>
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
</body>

</html>