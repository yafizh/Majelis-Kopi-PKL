<?php
if (isset($_GET['id_kasir']))
    $kasir = $conn->query("SELECT * FROM kasir WHERE id=" . $_GET['id_kasir'])->fetch_assoc();

if (isset($_GET['id'])) {
    $data = $conn->query("SELECT * FROM presensi_kasir WHERE id=" . $_GET['id'])->fetch_assoc();
    $data2 = $conn->query("SELECT * FROM penggajian_kasir WHERE id_kasir=" . $_GET['id_kasir'] . " AND bulan=" . $data['bulan'] . " AND tahun=" . $data['tahun'])->fetch_assoc();
}

if (isset($_POST['submit'])) {
    $bulan = $conn->real_escape_string($_POST['bulan']);
    $hadir = $conn->real_escape_string($_POST['hadir']);
    $izin = $conn->real_escape_string($_POST['izin']);
    $sakit = $conn->real_escape_string($_POST['sakit']);
    $tidak_hadir = $conn->real_escape_string($_POST['tidak_hadir']);
    $potongan_gaji = $conn->real_escape_string($_POST['potongan_gaji']);
    try {
        $conn->begin_transaction();

        $q = "
            UPDATE presensi_kasir SET 
                bulan='" . explode("-", $bulan)[1] . "',
                tahun='" . explode("-", $bulan)[0] . "',
                izin=$izin,
                sakit=$sakit,
                hadir=$hadir,
                tidak_hadir=$tidak_hadir 
            WHERE 
                id=" . $_GET['id'] . "
        ";
        $conn->query($q);

        $q = "
            UPDATE penggajian_kasir SET 
                bulan='" . explode("-", $bulan)[1] . "',
                tahun='" . explode("-", $bulan)[0] . "',
                nominal_gaji=" . $kasir['nominal_gaji'] . ",
                potongan_gaji=$potongan_gaji 
            WHERE 
                id_kasir=" . $data['id_kasir'] . " 
                AND 
                bulan='" . explode("-", $bulan)[1] . "'
                AND 
                tahun='" . explode("-", $bulan)[0] . "' 
        ";
        $conn->query($q);


        $conn->commit();
        $_SESSION['success'] = "Presensi Berhasil Diperbaharui!";
        echo "<script>location.href = '?h1=karyawan&h2=presensi&h3=karyawan_per_presensi&id_kasir=" . $kasir['id'] . "';</script>";
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
                        <h3>Perbaharui Presensi</h3>
                    </div>
                </div>
            </div>
        </div>
        <form action="" method="POST">
            <div class="form-layout-wrapper">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card-style mb-30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama</label>
                                        <input type="text" name="nama" autocomplete="off" disabled required value="<?= $kasir['nama']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Bulan</label>
                                        <input type="month" class="bg-transparent" name="bulan" autocomplete="off" required value="<?= $data['tahun'] . '-' . str_pad($data['bulan'], 2, '0', STR_PAD_LEFT); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div id="bahan-baku-container" class="card-style mb-30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Hadir</label>
                                        <input type="number" class="bg-transparent text-center" value="<?= $data['hadir']; ?>" name="hadir" min="0" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Izin</label>
                                        <input type="number" class="bg-transparent text-center" value="<?= $data['izin']; ?>" name="izin" min="0" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Sakit</label>
                                        <input type="number" class="bg-transparent text-center" value="<?= $data['sakit']; ?>" name="sakit" min="0" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tidak Hadir</label>
                                        <input type="number" class="bg-transparent text-center" value="<?= $data['tidak_hadir']; ?>" name="tidak_hadir" min="0" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Potongan Gaji</label>
                                        <input type="number" class="text-center" readonly value="<?= $data2['potongan_gaji']; ?>" name="potongan_gaji" min="0" autocomplete="off" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    const potonganGaji = document.querySelector('input[name=potongan_gaji]');
                    const izin = document.querySelector('input[name=izin]');
                    const tidak_hadir = document.querySelector('input[name=tidak_hadir]');
                    izin.addEventListener('input', () => {
                        if (!isNaN(izin.value)) {
                            potonganGaji.value = (parseInt(tidak_hadir.value) * 50000) + (parseInt(izin.value) * 50000);
                        }
                    });
                    tidak_hadir.addEventListener('input', () => {
                        if (!isNaN(tidak_hadir.value)) {
                            potonganGaji.value = (parseInt(tidak_hadir.value) * 50000) + (parseInt(izin.value) * 50000);
                        }
                    });
                </script>
                <div class="row">
                    <div class="card-style mb-30">
                        <div class="col-12 d-flex justify-content-between">
                            <a href="?h1=karyawan&h2=presensi&h3=karyawan_per_presensi&id_kasir=<?= $kasir['id']; ?>" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                            <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Perbaharui</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php require_once('layout/js.php'); ?>