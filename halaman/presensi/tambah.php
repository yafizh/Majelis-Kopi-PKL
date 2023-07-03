<?php
if (isset($_GET['id_kasir']))
    $kasir = $conn->query("SELECT * FROM kasir WHERE id=" . $_GET['id_kasir'])->fetch_assoc();

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
            INSERT INTO presensi_kasir (
                id_kasir, 
                bulan,
                tahun,
                izin,
                sakit,
                hadir,
                tidak_hadir 
            ) VALUES (
                " . $kasir['id'] . ", 
                '" . explode("-", $bulan)[1] . "',
                '" . explode("-", $bulan)[0] . "',
                $izin,
                $sakit,
                $hadir,
                $tidak_hadir
            )
        ";
        $conn->query($q);

        $q = "
            INSERT INTO penggajian_kasir (
                id_kasir, 
                bulan,
                tahun,
                nominal_gaji,
                potongan_gaji  
            ) VALUES (
                " . $kasir['id'] . ", 
                '" . explode("-", $bulan)[1] . "',
                '" . explode("-", $bulan)[0] . "',
                " . $kasir['nominal_gaji'] . ",
                $potongan_gaji
            )
        ";
        $conn->query($q);


        $conn->commit();
        $_SESSION['success'] = "Tambah Presensi Berhasil!";
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
                        <h3>Tambah Presensi</h3>
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
                                        <input type="month" class="bg-transparent" name="bulan" autocomplete="off" required value="<?= Date("Y-m") ?>" />
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
                                        <input type="number" class="bg-transparent text-center" value="0" name="hadir" min="0" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Izin</label>
                                        <input type="number" class="bg-transparent text-center" value="0" name="izin" min="0" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Sakit</label>
                                        <input type="number" class="bg-transparent text-center" value="0" name="sakit" min="0" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tidak Hadir</label>
                                        <input type="number" class="bg-transparent text-center" value="0" name="tidak_hadir" min="0" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Potongan Gaji</label>
                                        <input type="number" class="bg-transparent" value="0" name="potongan_gaji" min="0" autocomplete="off" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card-style mb-30">
                        <div class="col-12 d-flex justify-content-between">
                            <a href="?h1=karyawan&h2=presensi&h3=karyawan_per_presensi&id_kasir=<?= $kasir['id']; ?>" class="main-btn btn-sm light-btn btn-hover">Kembali</a>
                            <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php require_once('layout/js.php'); ?>