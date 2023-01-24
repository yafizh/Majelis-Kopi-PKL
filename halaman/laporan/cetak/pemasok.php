<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Pemasok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../assets/images/logo/logo.jpg" type="image/x-icon" />
</head>

<body>
    <?php include_once('header.php'); ?>
    <h4 class="text-center my-3">Laporan Pemasok</h4>
    <?php if (isset($_GET['id_bahan_baku'])) : ?>
        <section class="p-3">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4">
                    <table class="table">
                        <?php $bahan_baku = $conn->query("SELECT * FROM bahan_baku")->fetch_assoc(); ?>
                        <tr>
                            <td class="align-middle td-fit">Nama Bahan Baku</td>
                            <td class="pl-5"><?= $bahan_baku['nama']; ?></td>
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
                    <th class="text-center fit">
                        <h6>No</h6>
                    </th>
                    <th class="text-center">
                        <h6>Pemasok</h6>
                    </th>
                    <th class="text-center">
                        <h6>Barang Yang Disuplai</h6>
                    </th>
                </tr>
            </thead>
            <?php
            $q = "
              SELECT  
                  p.*, 
                  GROUP_CONCAT(bb.nama) AS bahan_baku 
              FROM 
                  pemasok p 
              LEFT JOIN 
                  pemasok_bahan_baku pbb 
              ON 
                  pbb.id_pemasok=p.id 
              LEFT JOIN 
                  bahan_baku bb 
              ON 
                  bb.id=pbb.id_bahan_baku 
          ";

            if (isset($_GET['id_bahan_baku']))
                $q .= " WHERE bb.id = '" . $_GET['id_bahan_baku'] . "'";

            $q .= "GROUP BY p.id ORDER BY p.nama";
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
                                <p class="m-0"><?= $row['bahan_baku']; ?></p>
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