<?php
$q = "
    SELECT 
        pemasok.nama pemasok,
        bb.nama bahan_baku,
        bb.satuan,
        penyuplaian.jumlah, 
        penyuplaian.harga 
    FROM 
        penyuplaian 
    INNER JOIN 
        pemasok_bahan_baku pbb 
    ON 
        penyuplaian.id_pemasok_bahan_baku=pbb.id 
    INNER JOIN 
        bahan_baku bb 
    ON 
        bb.id=pbb.id_bahan_baku 
    INNER JOIN 
        pemasok  
    ON 
        pemasok.id=pbb.id_pemasok 
    WHERE 
        penyuplaian.id=" . $_GET['id'] . " 
";
$data = $conn->query($q)->fetch_assoc();
if (isset($_POST['submit'])) {
    $jumlah = $conn->real_escape_string($_POST['jumlah']);
    $harga = $conn->real_escape_string($_POST['harga']);

    if ($conn->query("UPDATE penyuplaian SET jumlah=$jumlah, harga=$harga WHERE id=" . $_GET['id'])) {
        $_SESSION['success'] = "Penyuplaian Berhasil Diperbaharui!";
        echo "<script>location.href = '?h1=pemasok&h2=penyuplaian';</script>";
    } else die($conn->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h3>Perbaharui Penyuplaian</h3>
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
                                        <input type="text" disabled value="<?= $data['pemasok']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Bahan Baku</label>
                                        <input type="text" disabled value="<?= $data['bahan_baku']; ?>" />
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="input-style-1">
                                        <label>Jumlah</label>
                                        <input type="number" name="jumlah" class="bg-transparent" value="<?= $data['jumlah']; ?>" autocomplete="off" required min="1" />
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="input-style-1">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="bg-transparent" value="<?= $data['harga']; ?>" autocomplete="off" required min="1" />
                                    </div>
                                </div>
                                <div class="col-2 d-flex align-items-center">
                                    <div class="input-style-1 m-0">
                                        <label id="label-satuan" class="m-0"><?= $data['satuan']; ?></label>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?h1=pemasok&h2=penyuplaian" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
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