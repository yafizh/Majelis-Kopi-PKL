<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Pengurangan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../assets/images/logo/logo.jpg" type="image/x-icon" />
</head>

<body>
    <?php include_once('header.php'); ?>
    <h4 class="text-center my-3">Laporan Pengurangan Aset</h4>
    <?php if ((isset($_GET['dari_tanggal']) && isset($_GET['sampai_tanggal']))) : ?>
        <section class="p-3">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4">
                    <table class="table">
                        <?php if (isset($_GET['dari_tanggal']) && isset($_GET['sampai_tanggal'])) : ?>
                            <tr>
                                <td class="align-middle td-fit">Dari Tanggal</td>
                                <td class="pl-5"><?= indonesiaDate($_GET['dari_tanggal']); ?></td>
                            </tr>
                            <tr>
                                <td class="align-middle td-fit">Sampai Tanggal</td>
                                <td class="pl-5"><?= indonesiaDate($_GET['sampai_tanggal']); ?></td>
                            </tr>
                        <?php endif; ?>
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
                    <th class="text-center align-middle">Tanggal</th>
                    <th class="text-center align-middle">Nama Aset</th>
                    <th class="text-center align-middle">Jumlah</th>
                    <th class="text-center align-middle">Keterangan</th>
                </tr>
            </thead>
            <?php
            $q = "
                SELECT 
                    ab.*,
                    a.nama nama_aset
                FROM 
                    aset_berkurang ab 
                INNER JOIN 
                    aset a 
                WHERE 
                    1=1 
            ";

            if (isset($_GET['dari_tanggal']) && isset($_GET['sampai_tanggal']))
                $q .= " AND DATE(ab.tanggal) >= '" . $_GET['dari_tanggal'] . "' AND DATE(ab.tanggal) <= '" . $_GET['sampai_tanggal'] . "'";

            $q .= " ORDER BY ab.tanggal DESC";

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
                                <p class="m-0"><?= indonesiaDate($row['tanggal']); ?></p>
                            </td>
                            <td class="text-center">
                                <p class="m-0"><?= $row['nama_aset']; ?></p>
                            </td>
                            <td class="text-center">
                                <p class="m-0"><?= $row['jumlah']; ?></p>
                            </td>
                            <td class="text-center">
                                <p class="m-0"><?= $row['keterangan']; ?></p>
                            </td>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td class="text-center" colspan="5">Data Kosong</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <?php include_once('footer.php'); ?>
</body>

</html>