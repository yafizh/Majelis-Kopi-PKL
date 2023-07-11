<?php
$q = "
    SELECT 
        k.*,
        u.username,
        u.password  
    FROM 
        kasir k 
    INNER JOIN 
        user u 
    ON 
        u.id=k.id_user 
    WHERE 
        k.id=" . $_GET['id'] . "
";
$data = $conn->query($q)->fetch_assoc();
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h3>Detail Kasir</h3>
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
                                        <label>Tempat Lahir</label>
                                        <input type="text" disabled name="tempat_lahir" value="<?= $data['tempat_lahir']; ?>" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Lahir</label>
                                        <input type="text" disabled name="tempat_lahir" value="<?= indonesiaDate($data['tanggal_lahir']); ?>" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1 mb-0">
                                        <label>Jenis Kelamin</label>
                                    </div>
                                    <div class="d-flex gap-3 mb-4">
                                        <div class="form-check radio-style">
                                            <input class="form-check-input" disabled name="jenis_kelamin" type="radio" <?= $data['jenis_kelamin'] == 'Laki - Laki' ? 'checked' : ''; ?> value="Laki - Laki" id="male" />
                                            <label class="form-check-label" for="male"> Laki - Laki</label>
                                        </div>
                                        <div class="form-check radio-style">
                                            <input class="form-check-input" disabled name="jenis_kelamin" type="radio" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'checked' : ''; ?> value="Perempuan" id="female" />
                                            <label class="form-check-label" for="female"> Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Gaji</label>
                                        <input type="number" disabled name="nominal_gaji" autocomplete="off" required value="<?= $data['nominal_gaji']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card-style mb-30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Username</label>
                                        <input type="text" name="username" disabled value="<?= $data['username']; ?>" autocomplete="off" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-style mb-30">
                            <div class="col-12 d-flex justify-content-between">
                                <a href="?h1=user&h2=kasir" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>