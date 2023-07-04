<?php
if (isset($_POST['submit'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $tempat_lahir = $conn->real_escape_string($_POST['tempat_lahir']);
    $tanggal_lahir = $conn->real_escape_string($_POST['tanggal_lahir']);
    $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
    $nominal_gaji = $conn->real_escape_string($_POST['nominal_gaji']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    try {
        $conn->begin_transaction();

        $q = "
            INSERT INTO user (
                username, 
                password 
            ) VALUES (
                '$username', 
                '$password'
            )
        ";
        $conn->query($q);
        $id_user = $conn->insert_id;

        $target_dir = "uploads/";
        $foto = $target_dir . Date("YmdHis") . '.' . strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

        if (!is_dir($target_dir)) mkdir($target_dir, 0700, true);
        move_uploaded_file($_FILES['foto']["tmp_name"], $foto);

        $q = "
            INSERT INTO kasir(
                id_user,
                nama,
                tempat_lahir,
                tanggal_lahir,
                jenis_kelamin,
                nominal_gaji,
                foto 
            ) VALUES (
                '$id_user',
                '$nama',
                '$tempat_lahir',
                '$tanggal_lahir',
                '$jenis_kelamin',
                '$nominal_gaji',
                '$foto' 
            )";
        $conn->query($q);

        $conn->commit();
        $_SESSION['success'] = "Tambah Kasir Berhasil!";
        echo "<script>location.href = '?h1=user&h2=kasir';</script>";
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
                        <h3>Tambah Kasir</h3>
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
                                        <input type="text" class="bg-transparent" name="nama" autocomplete="off" autofocus required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tempat Lahir</label>
                                        <input type="text" class="bg-transparent" name="tempat_lahir" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" class="bg-transparent" name="tanggal_lahir" required />
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
                                        <label>Gaji</label>
                                        <input type="number" class="bg-transparent" name="nominal_gaji" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Foto</label>
                                        <input type="file" class="bg-transparent" name="foto" required />
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
                                        <input type="text" class="bg-transparent" name="username" autocomplete="off" autofocus required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Password</label>
                                        <input type="password" class="bg-transparent" name="password" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-style mb-30">
                            <div class="col-12 d-flex justify-content-between">
                                <a href="?h1=user&h2=kasir" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
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