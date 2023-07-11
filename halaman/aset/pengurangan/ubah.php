<?php
$data = $conn->query("
    SELECT 
        ab.*,
        a.nama nama_aset  
    FROM 
        aset_berkurang ab 
    INNER JOIN 
        aset a 
    ON 
        a.id=ab.id_aset  
    WHERE 
        ab.id=" . $_GET['id'])
    ->fetch_assoc();
if (isset($_POST['submit'])) {
    $jumlah = $conn->real_escape_string($_POST['jumlah']);
    $keterangan = $conn->real_escape_string($_POST['keterangan']);

    try {
        $conn->begin_transaction();

        $q = "
            UPDATE aset_berkurang SET 
                jumlah='$jumlah',
                keterangan='$keterangan'
            WHERE 
                id=" . $data['id'] . "
            ";
        $conn->query($q);

        $conn->query("UPDATE aset SET jumlah = jumlah + " . $data['jumlah'] . " - " . $jumlah . " WHERE id=" . $data['id_aset']);

        $conn->commit();
        $_SESSION['success'] = "Pengurangan Aset Berhasil Diperbaharui!";
        echo "<script>location.href = '?h1=aset&h2=pengurangan_aset';</script>";
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
                        <h3>Perbaharui Pengurangan Aset</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-layout-wrapper">
            <form action="" method="POST">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="card-style mb-30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Aset</label>
                                        <input type="text" disabled value="<?= $data['nama_aset']; ?>" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Jumlah</label>
                                        <input type="number" class="bg-transparent" name="jumlah" min="1" value="<?= $data['jumlah'] ?>" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="bg-transparent" required><?= $data['keterangan'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-style mb-30">
                            <div class="col-12 d-flex justify-content-between">
                                <a href="?h1=aset&h2=pengurangan_aset" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                                <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>