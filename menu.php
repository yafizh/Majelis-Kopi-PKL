<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
require_once('database/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/logo/logo.jpg" type="image/x-icon" />
    <link rel="preload" as="image" href="assets/images/logo/logo.jpg">
    <title>Majelis Kopi</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <style>
        img {
            width: 100%;
            height: 12rem;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-5">
        <div class="row mb-3">
            <h1 class="text-center">Menu Makanan & Minuman Majelis Kopi</h1>
        </div>
        <?php $result = $conn->query("SELECT * FROM kategori_menu ORDER BY nama"); ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="row mb-2">
                <h3><?= $row['nama'] ?></h3>
            </div>
            <?php $result2 = $conn->query("SELECT * FROM menu WHERE id_kategori_menu=" . $row['id'] . " ORDER BY nama"); ?>
            <div class="row mb-3">
                <?php if ($result2->num_rows) : ?>
                    <?php while ($row2 = $result2->fetch_assoc()) : ?>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body p-0">
                                    <img src="<?= $row2['foto']; ?>">
                                    <div class="p-3">
                                        <h5 class="mb-3"><?= $row2['nama']; ?></h5>
                                        <h6 class="text-muted">Rp <?= number_format($row2['harga'], 0, ",", "."); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="col-12 text-center">
                        Belum Ditambahkan
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>