<?php
$data = $conn->query("SELECT * FROM menu WHERE id=" . $_GET['id'])->fetch_assoc();
$kategori_menu = $conn->query("SELECT * FROM kategori_menu WHERE id=" . $_GET['id_kategori_menu'])->fetch_assoc();

if (isset($_POST['submit'])) {
    $id_kategori_menu = $conn->real_escape_string($_POST['id_kategori_menu']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $harga = $conn->real_escape_string($_POST['harga']);

    if ($_FILES['foto']['error'] != 4) {
        $target_dir = "uploads/";
        $foto = $target_dir . Date("YmdHis") . '.' . strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

        if (!is_dir($target_dir)) mkdir($target_dir, 0700, true);
        if (!move_uploaded_file($_FILES['foto']["tmp_name"], $foto))
            echo "<script>alert('Gagal meng-upload gambar!')</script>";
    } else $foto = $data['foto'];

    $q = "
        UPDATE menu SET 
            id_kategori_menu=$id_kategori_menu, 
            nama='$nama',
            harga=$harga,
            foto='$foto' 
        WHERE 
            id=" . $_GET['id'] . "
    ";

    if ($conn->query($q)) {
        $_SESSION['success'] = "Menu Berhasil Diperbaharui!";
        echo "<script>location.href = '?h1=menu&h2=daftar_menu&h3=daftar_menu_per_kategori&id_kategori_menu=" . $kategori_menu['id'] . "';</script>";
    } else die($conn->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h3>Perbaharui Menu</h3>
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
                                <div class="col-12">
                                    <?php $list_kategori_menu = $conn->query("SELECT * FROM kategori_menu ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Kategori Menu</label>
                                        <div class="select-position">
                                            <select required name="id_kategori_menu">
                                                <option value="" selected disabled>Pilih Kategori Menu</option>
                                                <?php while ($row = $list_kategori_menu->fetch_assoc()) : ?>
                                                    <?php if ($row['id'] == $data['id_kategori_menu']) : ?>
                                                        <option selected value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                    <?php endif; ?>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Menu</label>
                                        <input type="text" class="bg-transparent" value="<?= $data['nama']; ?>" name="nama" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Harga</label>
                                        <input type="text" class="bg-transparent" value="<?= $data['harga']; ?>" name="harga" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Foto</label>
                                        <input type="file" class="bg-transparent" name="foto" />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?h1=menu&h2=daftar_menu&h3=daftar_menu_per_kategori&id_kategori_menu=<?= $kategori_menu['id']; ?>" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
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