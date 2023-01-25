<?php
if (isset($_POST['submit'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $bahan_baku = $_POST['bahan_baku'];

    try {
        $conn->begin_transaction();

        $conn->query("INSERT INTO pemasok (nama) VALUES ('$nama')");
        $id_pemasok = $conn->insert_id;
        foreach ($bahan_baku as $id) {
            $q = "
            INSERT INTO pemasok_bahan_baku (
                id_bahan_baku, 
                id_pemasok
            ) VALUES (
                $id,
                $id_pemasok
            )";
            $conn->query($q);
        }

        $conn->commit();
        $_SESSION['success'] = "Tambah Pemasok Berhasil!";
        echo "<script>location.href = '?h1=pemasok&h2=daftar_pemasok';</script>";
    } catch (\Throwable $e) {
        $conn->rollback();
        throw $e;
    };
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h3>Tambah Pemasok</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-layout-wrapper">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card-style mb-30">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Pemasok</label>
                                        <input type="text" class="bg-transparent" name="nama" autocomplete="off" autofocus required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php
                                    $result = $conn->query("SELECT * FROM bahan_baku");
                                    ?>
                                    <div class="input-style-1 mb-0">
                                        <label>Bahan Baku Yang Disuplai</label>
                                    </div>
                                    <div class="d-flex gap-3 mb-5 flex-wrap">
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <div class="form-check checkbox-style mb-20">
                                                <input class="form-check-input" name="bahan_baku[]" type="checkbox" value="<?= $row['id']; ?>" id="bahan-baku-<?= $row['id']; ?>" />
                                                <label class="form-check-label" for="bahan-baku-<?= $row['id']; ?>">
                                                    <?= $row['nama']; ?></label>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?h1=pemasok&h2=daftar_pemasok" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>