<?php
$data = $conn->query("SELECT * FROM uang_kas_kasir WHERE id=" . $_GET['id'])->fetch_assoc();
if (isset($_POST['submit'])) {
    $mulai = $conn->real_escape_string($_POST['mulai']);
    $selesai = $conn->real_escape_string($_POST['selesai']);

    if ($conn->query("UPDATE uang_kas_kasir SET mulai='$mulai', selesai='$selesai' WHERE id=" . $_GET['id'])) {
        $_SESSION['success'] = "Uang Kas Berhasil Diperbaharui!";
        echo "<script>location.href = '?h=uang_kas';</script>";
    } else die($conn->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h3>Perbaharui Uang Kas</h3>
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
                                        <label>Tanggal</label>
                                        <input type="text" disabled value="<?= indoensiaDateWithDay($data['tanggal']); ?>" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Mulai</label>
                                        <input type="text" class="bg-transparent" name="mulai" autocomplete="off" value="<?= $data['mulai']; ?>" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Selesai</label>
                                        <input type="text" class="bg-transparent" name="selesai" autocomplete="off" value="<?= $data['selesai']; ?>" required />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?h=uang_kas" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
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