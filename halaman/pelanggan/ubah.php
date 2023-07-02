<?php
$data = $conn->query("SELECT * FROM pelanggan WHERE id=" . $_GET['id'])->fetch_assoc();
if (isset($_POST['submit'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
    $nomor_telepon = $conn->real_escape_string($_POST['nomor_telepon']);

    if ($conn->query("UPDATE pelanggan SET nama='$nama', jenis_kelamin='$jenis_kelamin', nomor_telepon='$nomor_telepon' WHERE id=" . $_GET['id'])) {
        $_SESSION['success'] = "Pelanggan Tetap Berhasil Diperbaharui!";
        if ($_SESSION['user']['status'] == 'KASIR')
            echo "<script>location.href = '?h=pelanggan';</script>";
        else
            echo "<script>location.href = '?h1=pelanggan';</script>";
    } else die($conn->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h3>Perbaharui Pelanggan Tetap</h3>
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
                                        <label>Tanggal Terdaftar</label>
                                        <input type="text" value="<?= indonesiaDate($data['tanggal_terdaftar']); ?>" disabled />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama</label>
                                        <input type="text" class="bg-transparent" name="nama" autocomplete="off" value="<?= $data['nama']; ?>" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1 mb-0">
                                        <label>Jenis Kelamin</label>
                                    </div>
                                    <div class="d-flex gap-3 mb-4">
                                        <div class="form-check radio-style">
                                            <input class="form-check-input" name="jenis_kelamin" type="radio" <?= $data['jenis_kelamin'] == 'Laki - Laki' ? 'checked' : ''; ?> value="Laki - Laki" id="male" />
                                            <label class="form-check-label" for="male"> Laki - Laki</label>
                                        </div>
                                        <div class="form-check radio-style">
                                            <input class="form-check-input" name="jenis_kelamin" type="radio" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'checked' : ''; ?> value="Perempuan" id="female" />
                                            <label class="form-check-label" for="female"> Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nomor Telepon</label>
                                        <input type="text" class="bg-transparent" name="nomor_telepon" autocomplete="off" value="<?= $data['nomor_telepon']; ?>" required />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <?php if ($_SESSION['user']['status'] == 'KASIR') : ?>
                                        <a href="?h=pelanggan" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                                    <?php else : ?>
                                        <a href="?h1=pelanggan" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                                    <?php endif; ?>
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