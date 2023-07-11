<?php
$q = "
    SELECT 
        * 
    FROM 
        aset
    WHERE 
        id=" . $_GET['id'] . "
";
$data = $conn->query($q)->fetch_assoc();
if (isset($_POST['submit'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $keterangan = $conn->real_escape_string($_POST['keterangan']);

    try {
        $conn->begin_transaction();

        if ($_FILES['foto']['error'] != 4) {
            $target_dir = "uploads/aset";
            $foto = $target_dir . Date("YmdHis") . '.' . strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

            if (!is_dir($target_dir)) mkdir($target_dir, 0700, true);
            move_uploaded_file($_FILES['foto']["tmp_name"], $foto);
        } else $foto = $data['foto'];

        $q = "
            UPDATE aset SET 
                nama='$nama',
                keterangan='$keterangan',
                foto='$foto' 
            WHERE 
                id=" . $_GET['id'];
        $conn->query($q);

        $conn->commit();
        $_SESSION['success'] = "Aset Berhasil Diperbaharui!";
        echo "<script>location.href = '?h1=aset&h2=data_aset';</script>";
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
                        <h3>Perbaharui Aset</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-layout-wrapper">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="card-style mb-30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama</label>
                                        <input type="text" class="bg-transparent" name="nama" value="<?= $data['nama']; ?>" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="bg-transparent" required><?= $data['keterangan']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Foto</label>
                                        <input type="file" class="bg-transparent" name="foto" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-style mb-30">
                            <div class="col-12 d-flex justify-content-between">
                                <a href="?h1=aset&h2=data_aset" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                                <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Perbaharui</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>