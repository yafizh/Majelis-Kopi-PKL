<?php
$data = $conn->query("SELECT * FROM pemasok WHERE id=" . $_GET['id'])->fetch_assoc();
$data['id_bahan_baku'] = [];
$pemasok_bahan_baku = $conn->query("SELECT * FROM pemasok_bahan_baku WHERE id_pemasok=" . $_GET['id']);
while ($row = $pemasok_bahan_baku->fetch_assoc())
    $data['id_bahan_baku'][] = $row['id_bahan_baku'];

if (isset($_POST['submit'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $bahan_baku = $_POST['bahan_baku'];

    try {
        $conn->begin_transaction();

        $conn->query("UPDATE pemasok SET nama='$nama' WHERE id=" . $_GET['id']);

        foreach ($data['id_bahan_baku'] as $id) {
            if (!in_array($id, $bahan_baku)) 
                $conn->query("DELETE FROM pemasok_bahan_baku WHERE id_bahan_baku=$id");
        }

        foreach ($bahan_baku as $id) {
            if (!in_array($id, $data['id_bahan_baku'])) {
                $q = "
                INSERT INTO pemasok_bahan_baku (
                    id_bahan_baku, 
                    id_pemasok
                ) VALUES (
                    $id,
                    " . $_GET['id'] . "
                )";
                $conn->query($q);
            }
        }

        $conn->commit();
        $_SESSION['success'] = "Pemasok Berhasil Diperbaharui!";
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
                        <h3>Perbaharui Pemasok</h3>
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
                                        <input type="text" class="bg-transparent" name="nama" autocomplete="off" value="<?= $data['nama']; ?>" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php
                                    $result = $conn->query("SELECT * FROM bahan_baku");
                                    ?>
                                    <div class="input-style-1 mb-0">
                                        <label>Bahan Baku Yang Disuplai</label>
                                    </div>
                                    <div class="d-flex gap-3 mb-5">
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <div class="form-check checkbox-style mb-20">
                                                <?php if (in_array($row['id'], $data['id_bahan_baku'])) : ?>
                                                    <input class="form-check-input" name="bahan_baku[]" checked type="checkbox" value="<?= $row['id']; ?>" id="bahan-baku-<?= $row['id']; ?>" />
                                                <?php else : ?>
                                                    <input class="form-check-input" name="bahan_baku[]" type="checkbox" value="<?= $row['id']; ?>" id="bahan-baku-<?= $row['id']; ?>" />
                                                <?php endif; ?>
                                                <label class="form-check-label" for="bahan-baku-<?= $row['id']; ?>">
                                                    <?= $row['nama']; ?></label>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?h1=pemasok&h2=daftar_pemasok" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Perbaharui</button>
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