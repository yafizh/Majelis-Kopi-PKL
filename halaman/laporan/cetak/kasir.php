<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../assets/images/logo/logo.jpg" type="image/x-icon" />
</head>

<body>
    <?php include_once('header.php'); ?>
    <h4 class="text-center my-3">Laporan Kasir</h4>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center fit">
                        <h6>No</h6>
                    </th>
                    <th class="text-center">
                        <h6>Nama</h6>
                    </th>
                    <th class="text-center">
                        <h6>Tempat Lahir</h6>
                    </th>
                    <th class="text-center">
                        <h6>Tanggal Lahir</h6>
                    </th>
                    <th class="text-center">
                        <h6>Jenis Kelamin</h6>
                    </th>
                    <th class="text-center">
                        <h6>Gaji</h6>
                    </th>
                </tr>
            </thead>
            <?php
            $q = "
                SELECT
                    * 
                FROM 
                    kasir 
                ORDER BY 
                    nama 
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
                            <td>
                                <p class="m-0"><?= $row['nama']; ?></p>
                            </td>
                            <td>
                                <p class="m-0"><?= $row['tempat_lahir']; ?></p>
                            </td>
                            <td class="text-center">
                                <p class="m-0"><?= indonesiaDate($row['tanggal_lahir']); ?></p>
                            </td>
                            <td class="text-center">
                                <p class="m-0"><?= $row['jenis_kelamin']; ?></p>
                            </td>
                            <td class="text-end">
                                <p class="m-0">Rp <?= number_format($row['nominal_gaji'], 0, ",", "."); ?></p>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td class="text-center" colspan="6">Data Kosong</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <?php include_once('footer.php'); ?>
</body>

</html>