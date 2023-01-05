<?php
if (isset($_GET['id_kategori_menu']))
    $kategori_menu = $conn->query("SELECT * FROM kategori_menu WHERE id=" . $_GET['id_kategori_menu'])->fetch_assoc();

if (isset($_POST['submit'])) {
    $id_kategori_menu = isset($_GET['id_kategori_menu']) ? $kategori_menu['id'] : $conn->real_escape_string($_POST['id_kategori_menu']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $harga = $conn->real_escape_string($_POST['harga']);

    $target_dir = "uploads/";
    $foto = $target_dir . Date("YmdHis") . '.' . strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

    if (!is_dir($target_dir)) mkdir($target_dir, 0700, true);
    if (move_uploaded_file($_FILES['foto']["tmp_name"], $foto)) {
        $q = "
            INSERT INTO menu (
                id_kategori_menu, 
                nama,
                harga,
                foto
            ) VALUES (
                $id_kategori_menu, 
                '$nama',
                $harga,
                '$foto'
            )
        ";

        if ($conn->query($q)) {
            $_SESSION['success'] = "Tambah Menu Berhasil!";
            if (isset($_GET['id_kategori_menu']))
                echo "<script>location.href = '?h1=menu&h2=daftar_menu&h3=daftar_menu_per_kategori&id_kategori_menu=" . $kategori_menu['id'] . "';</script>";
            else
                echo "<script>location.href = '?h1=menu&h2=daftar_menu';</script>";
        } else die($conn->error);
    } else
        echo "<script>alert('Gagal meng-upload gambar!')</script>";
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h3>Tambah Menu</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-layout-wrapper">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card-style mb-30">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <?php if (isset($_GET['id_kategori_menu'])) : ?>
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Kategori Menu</label>
                                            <input type="text" disabled value="<?= $kategori_menu['nama']; ?>" />
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="col-12">
                                        <?php $kategori_menu = $conn->query("SELECT * FROM kategori_menu ORDER BY nama"); ?>
                                        <div class="select-style-1">
                                            <label>Kategori Menu</label>
                                            <div class="select-position">
                                                <select required name="id_kategori_menu">
                                                    <option value="" selected disabled>Pilih Kategori Menu</option>
                                                    <?php while ($row = $kategori_menu->fetch_assoc()) : ?>
                                                        <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Menu</label>
                                        <input type="text" class="bg-transparent" name="nama" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Harga</label>
                                        <input type="text" class="bg-transparent" name="harga" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Foto</label>
                                        <input type="file" class="bg-transparent" name="foto" required />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <?php if (isset($_GET['id_kategori_menu'])) : ?>
                                        <a href="?h1=menu&h2=daftar_menu&h3=daftar_menu_per_kategori&id_kategori_menu=<?= $kategori_menu['id']; ?>" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                                    <?php else : ?>
                                        <a href="?h1=menu&h2=daftar_menu" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                                    <?php endif; ?>
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