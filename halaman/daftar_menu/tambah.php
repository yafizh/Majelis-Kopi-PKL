<?php
if (isset($_GET['id_kategori_menu']))
    $kategori_menu = $conn->query("SELECT * FROM kategori_menu WHERE id=" . $_GET['id_kategori_menu'])->fetch_assoc();

if (isset($_POST['submit'])) {
    $id_kategori_menu = isset($_GET['id_kategori_menu']) ? $kategori_menu['id'] : $conn->real_escape_string($_POST['id_kategori_menu']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $harga = $conn->real_escape_string($_POST['harga']);
    $id_bahan_baku = $_POST['id_bahan_baku'];
    $jumlah = $_POST['jumlah'];

    try {
        $conn->begin_transaction();

        $target_dir = "uploads/";
        $foto = $target_dir . Date("YmdHis") . '.' . strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

        if (!is_dir($target_dir)) mkdir($target_dir, 0700, true);
        move_uploaded_file($_FILES['foto']["tmp_name"], $foto);
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
        $conn->query($q);
        $id_menu = $conn->insert_id;

        for ($i = 0; $i < count($id_bahan_baku); $i++) {
            $q = "
                INSERT INTO bahan_baku_menu (
                    id_menu,
                    id_bahan_baku,
                    jumlah
                ) VALUES (
                    " . $id_menu . ",
                    " . $id_bahan_baku[$i] . ",
                    " . $jumlah[$i] . "
                )
            ";
            $conn->query($q);
        }

        $conn->commit();
        $_SESSION['success'] = "Tambah Menu Berhasil!";
        if (isset($_GET['id_kategori_menu']))
            echo "<script>location.href = '?h1=menu&h2=daftar_menu&h3=daftar_menu_per_kategori&id_kategori_menu=" . $kategori_menu['id'] . "';</script>";
        else
            echo "<script>location.href = '?h1=menu&h2=daftar_menu';</script>";
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
                        <h3>Tambah Menu</h3>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div id="bahan-baku-container" class="card-style mb-30">
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
                                        <input type="number" class="bg-transparent" name="jumlah[]" autocomplete="off" value="0" />
                                    </div>
                                </div>
                                <div class="col-2 d-flex align-items-center gap-2">
                                    <label class="satuan">Satuan</label>
                                </div>
                            </div>
                            <div class="row field-bahan-baku">
                                <div class="col-4">
                                    <div class="select-style-1">
                                        <label>Bahan Baku</label>
                                        <div class="select-position">
                                            <select name="id_bahan_baku[]" class="bahan_baku">
                                                <option value="" selected disabled>Pilih Bahan Baku</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-style-1">
                                        <label>Jumlah</label>
                                        <input type="number" class="bg-transparent" name="jumlah[]" autocomplete="off" value="0" />
                                    </div>
                                </div>
                                <div class="col-2 d-flex align-items-center gap-2">
                                    <label class="satuan">Satuan</label>
                                </div>
                            </div>
                            <div class="row field-bahan-baku">
                                <div class="col-4">
                                    <div class="select-style-1">
                                        <label>Bahan Baku</label>
                                        <div class="select-position">
                                            <select name="id_bahan_baku[]" class="bahan_baku">
                                                <option value="" selected disabled>Pilih Bahan Baku</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-style-1">
                                        <label>Jumlah</label>
                                        <input type="number" class="bg-transparent" name="jumlah[]" autocomplete="off" value="0" />
                                    </div>
                                </div>
                                <div class="col-2 d-flex align-items-center gap-2">
                                    <label class="satuan">Satuan</label>
                                </div>
                            </div>
                            <div class="row field-bahan-baku">
                                <div class="col-4">
                                    <div class="select-style-1">
                                        <label>Bahan Baku</label>
                                        <div class="select-position">
                                            <select name="id_bahan_baku[]" class="bahan_baku">
                                                <option value="" selected disabled>Pilih Bahan Baku</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-style-1">
                                        <label>Jumlah</label>
                                        <input type="number" class="bg-transparent" name="jumlah[]" autocomplete="off" value="0" />
                                    </div>
                                </div>
                                <div class="col-2 d-flex align-items-center gap-2">
                                    <label class="satuan">Satuan</label>
                                </div>
                                <div class="col-3 d-flex align-items-center gap-2 button-container">
                                    <button onclick="addFieldBahanBaku(this)" class="btn btn-success">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card-style mb-30">
                        <div class="col-12 d-flex justify-content-between">
                            <?php if (isset($_GET['id_kategori_menu'])) : ?>
                                <a href="?h1=menu&h2=daftar_menu&h3=daftar_menu_per_kategori&id_kategori_menu=<?= $kategori_menu['id']; ?>" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                            <?php else : ?>
                                <a href="?h1=menu&h2=daftar_menu" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                            <?php endif; ?>
                            <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php require_once('layout/js.php'); ?>
<?php $bahan_baku = $conn->query("SELECT * FROM bahan_baku ORDER BY nama")->fetch_all(MYSQLI_ASSOC); ?>
<script>
    const bahanBakuContainer = document.getElementById('bahan-baku-container');
    const bahan_baku = JSON.parse('<?= json_encode($bahan_baku); ?>');
    const satuanBahanBaku = document.querySelectorAll('.satuan');
    const choosedBahanBaku = [];
    const ignoreIndex = [];

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
    setOptions();
</script>