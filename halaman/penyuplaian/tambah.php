<?php 
$pemasok = $conn->query("SELECT * FROM pemasok WHERE id=".$_GET['id'])->fetch_assoc();
if (isset($_POST['submit'])) {
    $id_bahan_baku = $conn->real_escape_string($_POST['id_bahan_baku']);
    $jumlah = $conn->real_escape_string($_POST['jumlah']);
    $harga = $conn->real_escape_string($_POST['harga']);

    $id_pemasok_bahan_baku = $conn->query("SELECT * FROM pemasok_bahan_baku WHERE id_pemasok=" . $_GET['id'] . " AND id_bahan_baku=" . $id_bahan_baku)->fetch_assoc();

    $q = "
        INSERT INTO penyuplaian (
            id_pemasok_bahan_baku, 
            tanggal, 
            jumlah,
            harga
        ) VALUES (
            " . $id_pemasok_bahan_baku['id'] . ",
            '" . Date("Y-m-d") . "',
            $jumlah,
            $harga
        )
    ";
    if ($conn->query($q)) {
        $_SESSION['success'] = "Suplai Bahan Baku Berhasil!";
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
                        <h3>Suplai Bahan Baku</h3>
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
                                        <input type="text" disabled value="<?= $pemasok['nama']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php
                                    $q = "
                                            SELECT 
                                                bb.*  
                                            FROM 
                                                pemasok_bahan_baku pbb 
                                            INNER JOIN 
                                                bahan_baku bb 
                                            ON 
                                                bb.id=pbb.id_bahan_baku 
                                            WHERE 
                                                pbb.id_pemasok=" . $_GET['id'] . "
                                        ";
                                    $result = $conn->query($q);
                                    ?>
                                    <div class="select-style-1">
                                        <label>Bahan Baku</label>
                                        <div class="select-position">
                                            <select name="id_bahan_baku" required>
                                                <option value="" disabled selected>Pilih Bahan Baku</option>
                                                <?php while ($row = $result->fetch_assoc()) : ?>
                                                    <option data-satuan="<?= $row['satuan']; ?>" value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="input-style-1">
                                        <label>Jumlah</label>
                                        <input type="number" name="jumlah" class="bg-transparent" value="1" autocomplete="off" required min="1" />
                                    </div>
                                </div>
                                <div class="col-2 d-flex align-items-center">
                                    <div class="input-style-1 m-0">
                                        <label id="label-satuan" class="m-0">Satuan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="bg-transparent" autocomplete="off" required min="1" />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?h1=pemasok&h2=daftar_pemasok" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Suplai</button>
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
<script>
    document.querySelector('select[name=id_bahan_baku]').addEventListener('change', function(){
        document.querySelector('#label-satuan').innerText = this[this.selectedIndex].getAttribute('data-satuan');
    });
</script>