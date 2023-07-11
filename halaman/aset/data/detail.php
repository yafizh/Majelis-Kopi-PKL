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
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h3>Detail Aset</h3>
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
                                        <input type="text" disabled name="nama" value="<?= $data['nama']; ?>" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" disabled required><?= $data['keterangan']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-style mb-30">
                            <div class="col-12 d-flex justify-content-between">
                                <a href="?h1=aset&h2=data_aset" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>