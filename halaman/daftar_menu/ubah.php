<?php
$data = $conn->query("SELECT * FROM menu WHERE id=" . $_GET['id'])->fetch_assoc();
$kategori_menu = $conn->query("SELECT * FROM kategori_menu WHERE id=" . $_GET['id_kategori_menu'])->fetch_assoc();

if (isset($_POST['submit'])) {
    $id_kategori_menu = $conn->real_escape_string($_POST['id_kategori_menu']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $harga = $conn->real_escape_string($_POST['harga']);
    $id_bahan_baku = $_POST['id_bahan_baku'];
    $jumlah = $_POST['jumlah'];

    try {
        $conn->begin_transaction();


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
        $conn->query($q);
        $id_menu = $conn->insert_id;

        $conn->query("DELETE FROM bahan_baku_menu WHERE id_menu=" . $_GET['id']);
        for ($i = 0; $i < count($id_bahan_baku); $i++) {
            $q = "
                INSERT INTO bahan_baku_menu (
                    id_menu,
                    id_bahan_baku,
                    jumlah
                ) VALUES (
                    " . $_GET['id'] . ",
                    " . $id_bahan_baku[$i] . ",
                    " . $jumlah[$i] . "
                )
            ";
            $conn->query($q);
        }

        $conn->commit();
        $_SESSION['success'] = "Menu Berhasil Diperbaharui!";
        echo "<script>location.href = '?h1=menu&h2=daftar_menu&h3=daftar_menu_per_kategori&id_kategori_menu=" . $kategori_menu['id'] . "';</script>";
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
                        <h3>Perbaharui Menu</h3>
                    </div>
                </div>
            </div>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-layout-wrapper">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card-style mb-30">
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
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div id="bahan-baku-container" class="card-style mb-30"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php require_once('layout/js.php'); ?>
<?php $bahan_baku = $conn->query("SELECT * FROM bahan_baku ORDER BY nama")->fetch_all(MYSQLI_ASSOC); ?>
<?php $bahan_baku_menu = $conn->query("SELECT bahan_baku.*, bahan_baku_menu.jumlah FROM bahan_baku_menu INNER JOIN bahan_baku ON bahan_baku.id=bahan_baku_menu.id_bahan_baku WHERE id_menu=" . $_GET['id'])->fetch_all(MYSQLI_ASSOC); ?>
<script>
    const bahanBakuContainer = document.getElementById('bahan-baku-container');
    const bahan_baku = JSON.parse('<?= json_encode($bahan_baku); ?>');
    const satuanBahanBaku = document.querySelectorAll('.satuan');
    const choosedBahanBaku = [];
    const ignoreIndex = [];
    const bahanBakuMenu = JSON.parse('<?= json_encode($bahan_baku_menu); ?>');

    const addFieldBahanBaku = (button) => {
        bahanBakuContainer.insertAdjacentHTML('beforeend', `
            <div class="row field-bahan-baku">
                <div class="col-4">
                    <div class="select-style-1">
                        <label>Bahan Baku</label>
                        <div class="select-position">
                            <select required name="id_bahan_baku[]" class="bahan_baku">
                                <option value="" selected disabled>Pilih Bahan Baku</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-style-1">
                        <label>Jumlah</label>
                        <input type="text" class="bg-transparent" name="jumlah[]" autocomplete="off" required />
                    </div>
                </div>
                <div class="col-2 d-flex align-items-center gap-2">
                    <label class="satuan">Satuan</label>
                </div>
                <div class="col-3 d-flex align-items-center gap-2 button-container">
                    <button onclick="removeFieldBahanBaku(this)" class="btn btn-danger">Hapus</button>
                    <button onclick="addFieldBahanBaku(this)" class="btn btn-success add-field-button">Tambah</button>
                </div>
            </div>
        `);
        button.remove();
        setOptions();
    }

    const removeFieldBahanBaku = (button) => {
        button.parentElement.parentElement.remove();
        if (!document.querySelector('.add-field-button')) {
            const semuaFieldBahanBaku = document.querySelectorAll('.field-bahan-baku');
            semuaFieldBahanBaku[semuaFieldBahanBaku.length - 1].querySelector('.button-container').insertAdjacentHTML('beforeend', `<button onclick="addFieldBahanBaku(this)" class="btn btn-success add-field-button">Tambah</button>`);
        }
        setOptions();
    }

    const setOptions = () => {
        document.querySelectorAll('.bahan_baku').forEach((element, index) => {
            if (!ignoreIndex.includes(index)) {
                element.innerHTML = '<option value="" selected disabled>Pilih Bahan Baku</option>';
                for (const key in bahan_baku) {
                    if (!choosedBahanBaku.includes(bahan_baku[key]['id'])) {
                        const option = document.createElement('option');
                        option.value = bahan_baku[key]['id'];
                        option.text = bahan_baku[key]['nama'];
                        option.setAttribute('data-satuan', bahan_baku[key]['satuan']);
                        element.append(option);
                    }
                }
                element.addEventListener('change', () => {
                    choosedBahanBaku.push(element[element.selectedIndex].value);
                    satuanBahanBaku[index].innerText = element[element.selectedIndex].getAttribute('data-satuan');
                    ignoreIndex.push(index);
                    setOptions();
                });
            }
        });
    }

    for (let index = 0; index < Object.keys(bahanBakuMenu).length; index++) {
        choosedBahanBaku.push(bahanBakuMenu[index]['id']);
        ignoreIndex.push(index);
        bahanBakuContainer.insertAdjacentHTML('beforeend', `
            <div class="row field-bahan-baku">
                <div class="col-4">
                    <div class="select-style-1">
                        <label>Bahan Baku</label>
                        <div class="select-position">
                            <select required name="id_bahan_baku[]" class="bahan_baku">
                                <option value="" disabled>Pilih Bahan Baku</option>
                                <option value="${bahanBakuMenu[index]['id']}" selected>${bahanBakuMenu[index]['nama']}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-style-1">
                        <label>Jumlah</label>
                        <input type="text" class="bg-transparent" name="jumlah[]" autocomplete="off" value="${bahanBakuMenu[index]['jumlah']}" />
                    </div>
                </div>
                <div class="col-2 d-flex align-items-center gap-2">
                    <label class="satuan">${bahanBakuMenu[index]['satuan']}</label>
                </div>
                <div class="col-3 d-flex align-items-center gap-2 button-container">
                    <button onclick="removeFieldBahanBaku(this)" class="btn btn-danger">Hapus</button>
                    ${(index == Object.keys(bahanBakuMenu).length-1) ? `<button onclick="addFieldBahanBaku(this)" class="btn btn-success add-field-button">Tambah</button>` : ``}
                </div>
            </div>
        `);
    }

    setOptions();
</script>