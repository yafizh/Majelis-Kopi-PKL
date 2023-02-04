<?php
if (isset($_POST['submit'])) {
    $tanggal_terdaftar = Date("Y-m-d");
    $nama = $conn->real_escape_string($_POST['nama']);
    $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
    $nomor_telepon = $conn->real_escape_string($_POST['nomor_telepon']);

    if ($conn->query("INSERT INTO pelanggan (nama, jenis_kelamin, nomor_telepon, tanggal_terdaftar) VALUES ('$nama', '$jenis_kelamin', '$nomor_telepon', '$tanggal_terdaftar')")) {
        $_SESSION['success'] = "Tambah Pelanggan Tetap Berhasil!";
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
                        <h3>Tambah Pelanggan Tetap</h3>
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
                                        <input type="text" disabled value="<?= indonesiaDate(Date("Y-m-d")); ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama</label>
                                        <input type="text" class="bg-transparent" name="nama" autocomplete="off" autofocus required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1 mb-0">
                                        <label>Jenis Kelamin</label>
                                    </div>
                                    <div class="d-flex gap-3 mb-4">
                                        <div class="form-check radio-style">
                                            <input class="form-check-input" name="jenis_kelamin" type="radio" value="Laki - Laki" id="male" />
                                            <label class="form-check-label" for="male"> Laki - Laki</label>
                                        </div>
                                        <div class="form-check radio-style">
                                            <input class="form-check-input" name="jenis_kelamin" type="radio" value="Perempuan" id="female" />
                                            <label class="form-check-label" for="female"> Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nomor Telepon</label>
                                        <input type="text" class="bg-transparent" name="nomor_telepon" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?h1=pelanggan" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
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