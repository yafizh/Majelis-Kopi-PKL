<?php
$_SESSION['error'] = [];
if (isset($_POST['submit'])) {
    $password_lama = $conn->real_escape_string($_POST['password_lama']);
    $password_baru = $conn->real_escape_string($_POST['password_baru']);
    $konfirmasi_password_baru = $conn->real_escape_string($_POST['konfirmasi_password_baru']);

    $cek_password_lama = $conn->query("SELECT * FROM user WHERE id=" . $_SESSION['user']['id_user'] . " AND password='$password_lama'");
    if ($cek_password_lama->num_rows) {
        if ($password_baru === $konfirmasi_password_baru) {
            if ($conn->query("UPDATE user SET password='$password_baru' WHERE id=" . $_SESSION['user']['id_user']))
                $_SESSION['success'] =  true;
            else
                die($conn->error);
        } else $_SESSION['error'][] = 'Password Baru Tidak Sama!';
    } else $_SESSION['error'][] = 'Password Lama Salah!';
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h3>Ganti Password</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-layout-wrapper">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <?php if (count($_SESSION['error'])) : ?>
                        <?php foreach ($_SESSION['error'] as $error) : ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="alert-message">
                                    <?= $error; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-message">
                                Password Berhasil Diperbaharui!
                            </div>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>
                    <div class="card-style mb-30">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Password Lama</label>
                                        <input type="password" class="bg-transparent" name="password_lama" autocomplete="off" autofocus required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Password Baru</label>
                                        <input type="password" class="bg-transparent" name="password_baru" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Konfirmasi Password Baru</label>
                                        <input type="password" class="bg-transparent" name="konfirmasi_password_baru" required />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?h1=user&h2=admin" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
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