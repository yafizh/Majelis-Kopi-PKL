<?php
$data = $conn->query("SELECT * FROM bahan_baku WHERE id=" . $_GET['id'])->fetch_assoc();
if (isset($_POST['submit'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $satuan = $conn->real_escape_string($_POST['satuan']);

    if ($conn->query("UPDATE bahan_baku SET nama='$nama', satuan='$satuan' WHERE id=" . $_GET['id'])) {
        $_SESSION['success'] = "Bahan Baku Berhasil Diperbaharui!";
        echo "<script>location.href = '?h1=bahan_baku&h2=daftar_bahan_baku';</script>";
    } else die($conn->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h3>Perbaharui Bahan Baku</h3>
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
                                        <label>Bahan Baku</label>
                                        <input type="text" class="bg-transparent" name="nama" autocomplete="off" value="<?= $data['nama']; ?>" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Satuan</label>
                                        <input type="text" class="bg-transparent" name="satuan" autocomplete="off" value="<?= $data['satuan']; ?>" required />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?h1=bahan_baku&h2=daftar_bahan_baku" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
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