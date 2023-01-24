<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../assets/images/logo/logo.jpg" type="image/x-icon" />
</head>

<body>
    <?php include_once('header.php'); ?>
    <h4 class="text-center my-3">Laporan Menu</h4>
    <?php if (isset($_GET['id_kategori_menu'])) : ?>
        <section class="p-3">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4">
                    <table class="table">
                        <?php $kategori_menu = $conn->query("SELECT * FROM kategori_menu")->fetch_assoc(); ?>
                        <tr>
                            <td class="align-middle td-fit">Kategori Menu</td>
                            <td class="pl-5"><?= $kategori_menu['nama']; ?></td>
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
                        <h6>Kategori Menu</h6>
                    </th>
                    <th class="text-center">
                        <h6>Nama Menu</h6>
                    </th>
                </tr>
            </thead>
            <?php
            $q = "
                SELECT 
                    km.nama kategori_menu,
                    m.nama nama_menu 
                FROM 
                    kategori_menu km 
                INNER JOIN 
                    menu m 
                ON 
                    km.id=m.id_kategori_menu 
            ";

            if (isset($_GET['id_kategori_menu']))
                $q .= " WHERE km.id = '" . $_GET['id_kategori_menu'] . "'";

            $q .= " ORDER BY km.nama DESC";

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
                                <p class="m-0"><?= $row['kategori_menu']; ?></p>
                            </td>
                            <td class="text-center">
                                <p class="m-0"><?= $row['nama_menu']; ?></p>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td class="text-center" colspan="3  ">Data Kosong</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <?php include_once('footer.php'); ?>
</body>

</html>