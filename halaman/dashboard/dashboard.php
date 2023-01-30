<section class="section">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h2>Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon purple">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M1 22C1 22.54 1.45 23 2 23H15C15.56 23 16 22.54 16 22V21H1V22M8.5 9C4.75 9 1 11 1 15H16C16 11 12.25 9 8.5 9M3.62 13C4.73 11.45 7.09 11 8.5 11S12.27 11.45 13.38 13H3.62M1 17H16V19H1V17M18 5V1H16V5H11L11.23 7H20.79L19.39 21H18V23H19.72C20.56 23 21.25 22.35 21.35 21.53L23 5H18Z" />
                        </svg>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Menu</h6>
                        <?php $menu = $conn->query("SELECT * FROM menu"); ?>
                        <h3 class="text-bold mb-10"><?= $menu->num_rows; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon success">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,5A3.5,3.5 0 0,0 8.5,8.5A3.5,3.5 0 0,0 12,12A3.5,3.5 0 0,0 15.5,8.5A3.5,3.5 0 0,0 12,5M12,7A1.5,1.5 0 0,1 13.5,8.5A1.5,1.5 0 0,1 12,10A1.5,1.5 0 0,1 10.5,8.5A1.5,1.5 0 0,1 12,7M5.5,8A2.5,2.5 0 0,0 3,10.5C3,11.44 3.53,12.25 4.29,12.68C4.65,12.88 5.06,13 5.5,13C5.94,13 6.35,12.88 6.71,12.68C7.08,12.47 7.39,12.17 7.62,11.81C6.89,10.86 6.5,9.7 6.5,8.5C6.5,8.41 6.5,8.31 6.5,8.22C6.2,8.08 5.86,8 5.5,8M18.5,8C18.14,8 17.8,8.08 17.5,8.22C17.5,8.31 17.5,8.41 17.5,8.5C17.5,9.7 17.11,10.86 16.38,11.81C16.5,12 16.63,12.15 16.78,12.3C16.94,12.45 17.1,12.58 17.29,12.68C17.65,12.88 18.06,13 18.5,13C18.94,13 19.35,12.88 19.71,12.68C20.47,12.25 21,11.44 21,10.5A2.5,2.5 0 0,0 18.5,8M12,14C9.66,14 5,15.17 5,17.5V19H19V17.5C19,15.17 14.34,14 12,14M4.71,14.55C2.78,14.78 0,15.76 0,17.5V19H3V17.07C3,16.06 3.69,15.22 4.71,14.55M19.29,14.55C20.31,15.22 21,16.06 21,17.07V19H24V17.5C24,15.76 21.22,14.78 19.29,14.55M12,16C13.53,16 15.24,16.5 16.23,17H7.77C8.76,16.5 10.47,16 12,16Z" />
                        </svg>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Kasir</h6>
                        <?php $kasir = $conn->query("SELECT * FROM kasir"); ?>
                        <h3 class="text-bold mb-10"><?= $kasir->num_rows; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon primary">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M18 18.5C18.83 18.5 19.5 17.83 19.5 17C19.5 16.17 18.83 15.5 18 15.5C17.17 15.5 16.5 16.17 16.5 17C16.5 17.83 17.17 18.5 18 18.5M19.5 9.5H17V12H21.46L19.5 9.5M6 18.5C6.83 18.5 7.5 17.83 7.5 17C7.5 16.17 6.83 15.5 6 15.5C5.17 15.5 4.5 16.17 4.5 17C4.5 17.83 5.17 18.5 6 18.5M20 8L23 12V17H21C21 18.66 19.66 20 18 20C16.34 20 15 18.66 15 17H9C9 18.66 7.66 20 6 20C4.34 20 3 18.66 3 17H1V6C1 4.89 1.89 4 3 4H17V8H20M3 6V15H3.76C4.31 14.39 5.11 14 6 14C6.89 14 7.69 14.39 8.24 15H15V6H3Z" />
                        </svg>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Pemasok</h6>
                        <?php $pemasok = $conn->query("SELECT * FROM pemasok"); ?>
                        <h3 class="text-bold mb-10"><?= $pemasok->num_rows; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon orange">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M15,4A4,4 0 0,1 19,8A4,4 0 0,1 15,12A4,4 0 0,1 11,8A4,4 0 0,1 15,4M15,5.9A2.1,2.1 0 0,0 12.9,8A2.1,2.1 0 0,0 15,10.1C16.16,10.1 17.1,9.16 17.1,8C17.1,6.84 16.16,5.9 15,5.9M15,13C17.67,13 23,14.33 23,17V20H7V17C7,14.33 12.33,13 15,13M15,14.9C12,14.9 8.9,16.36 8.9,17V18.1H21.1V17C21.1,16.36 17.97,14.9 15,14.9M5,13.28L2.5,14.77L3.18,11.96L1,10.08L3.87,9.83L5,7.19L6.11,9.83L9,10.08L6.8,11.96L7.45,14.77L5,13.28Z" />
                        </svg>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Pelanggan Tetap</h6>
                        <?php $pelanggan = $conn->query("SELECT * FROM pelanggan"); ?>
                        <h3 class="text-bold mb-10"><?= $pelanggan->num_rows; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap justify-content-between">
                        <div class="left">
                            <h6 class="text-medium mb-10">Grafik Pengunjung Satu Tahun Terakhir</h6>
                        </div>
                    </div>
                    <div class="chart">
                        <canvas id="Chart1" style="width: 100%; height: 400px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap justify-content-between align-items-center">
                        <div class="left">
                            <h6 class="text-medium mb-30">Favorit Menu</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table top-selling-table">
                            <thead>
                                <tr>
                                    <th class="min-width"></th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium text-center">Nama Menu</h6>
                                    </th>
                                    <th>
                                        <h6 class="text-sm text-medium text-center">Kategori Menu</h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium text-center">Jumlah Terjual</h6>
                                    </th>
                                </tr>
                            </thead>
                            <?php
                            $q = "
                                    SELECT 
                                        m.*,
                                        mn.nama kategori_menu,
                                        (SELECT COUNT(*) FROM detail_penjualan WHERE id_menu=m.id) jumlah_terjual
                                    FROM 
                                        menu m 
                                    INNER JOIN 
                                        kategori_menu mn 
                                    ON 
                                        mn.id=m.id_kategori_menu 
                                    ORDER BY 
                                        jumlah_terjual DESC 
                                    LIMIT 4
                                ";
                            $favorit_menu = $conn->query($q);
                            ?>
                            <tbody>
                                <?php if ($favorit_menu->num_rows) : ?>
                                    <?php while ($row = $favorit_menu->fetch_assoc()) : ?>
                                        <tr>
                                            <td>
                                                <div class="image">
                                                    <img style="width: 50px; height: 50px; object-fit: contain;" src="<?= $row['foto']; ?>" />
                                                </div>
                                            </td>
                                            <td>
                                                <p><?= $row['nama']; ?></p>
                                            </td>
                                            <td>
                                                <p class="text-center"><?= $row['kategori_menu']; ?></p>
                                            </td>
                                            <td>
                                                <p class="text-center"><?= $row['jumlah_terjual']; ?></p>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Belum Ada Penjualan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once('layout/js.php'); ?>

<script>
    const ctx1 = document.getElementById("Chart1").getContext("2d");
    const chart1 = new Chart(ctx1, {
        type: "line",

        data: {
            labels: [
                "Jan",
                "Fab",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            datasets: [{
                label: "",
                backgroundColor: "transparent",
                borderColor: "#4A6CF7",
                data: [
                    600, 800, 750, 880, 940, 880, 900, 770, 920, 890, 976, 1100,
                ],
                pointBackgroundColor: "transparent",
                pointHoverBackgroundColor: "#4A6CF7",
                pointBorderColor: "transparent",
                pointHoverBorderColor: "#fff",
                pointHoverBorderWidth: 5,
                pointBorderWidth: 5,
                pointRadius: 8,
                pointHoverRadius: 8,
            }, ],
        },

        // Configuration options
        defaultFontFamily: "Inter",
        options: {
            tooltips: {
                callbacks: {
                    labelColor: function(tooltipItem, chart) {
                        return {
                            backgroundColor: "#ffffff",
                        };
                    },
                },
                intersect: false,
                backgroundColor: "#f9f9f9",
                titleFontFamily: "Inter",
                titleFontColor: "#8F92A1",
                titleFontColor: "#8F92A1",
                titleFontSize: 12,
                bodyFontFamily: "Inter",
                bodyFontColor: "#171717",
                bodyFontStyle: "bold",
                bodyFontSize: 16,
                multiKeyBackground: "transparent",
                displayColors: false,
                xPadding: 30,
                yPadding: 10,
                bodyAlign: "center",
                titleAlign: "center",
            },

            title: {
                display: false,
            },
            legend: {
                display: false,
            },

            scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawTicks: false,
                        drawBorder: false,
                    },
                    ticks: {
                        padding: 35,
                        max: 1200,
                        min: 500,
                    },
                }, ],
                xAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(143, 146, 161, .1)",
                        zeroLineColor: "rgba(143, 146, 161, .1)",
                    },
                    ticks: {
                        padding: 20,
                    },
                }, ],
            },
        },
    });

    // =========== chart one end
</script>