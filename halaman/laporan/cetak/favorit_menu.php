<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Menu Favorit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php include_once('header.php'); ?>
    <h4 class="text-center my-3">Laporan Menu Favorit</h4>
    <?php if (isset($_GET['dari_tanggal']) && isset($_GET['sampai_tanggal'])) : ?>
        <section class="p-3">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4">
                    <table class="table">
                        <tr>
                            <td class="align-middle td-fit">Dari Tanggal</td>
                            <td class="pl-5"><?= indonesiaDate($_GET['dari_tanggal']); ?></td>
                        </tr>
                        <tr>
                            <td class="align-middle td-fit">Sampai Tanggal</td>
                            <td class="pl-5"><?= indonesiaDate($_GET['sampai_tanggal']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle td-fit">No</th>
                    <th class="text-center align-middle">Menu</th>
                    <th class="text-center align-middle">Jumlah Penjualan</th>
                </tr>
            </thead>
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
            ";

            if (isset($_GET['dari_tanggal']) && isset($_GET['sampai_tanggal']))
                $sub_q .= " AND (DATE(tanggal_waktu) >= '" . $_GET['dari_tanggal'] . "' AND DATE(tanggal_waktu) <= '" . $_GET['sampai_tanggal'] . "')";

            $q = "
                SELECT  
                    m.*,
                    ($sub_q) jumlah_penjualan 
                FROM 
                    menu m 
                ORDER BY 
                    jumlah_penjualan DESC 
            ";

            $result = $conn->query($q);
            $no = 1;
            ?>
            <tbody>
                <?php if ($result->num_rows) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="text-center fit">
                                <p class="m-0"><?= $no++; ?></p>
                            </td>
                            <td class="text-center">
                                <p class="m-0"><?= $row['nama']; ?></p>
                            </td>
                            <td class="text-center">
                                <p class="m-0"><?= $row['jumlah_penjualan']; ?></p>
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
    </main>
    <?php include_once('footer.php'); ?>
</body>

</html>