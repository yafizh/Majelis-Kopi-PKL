<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
                <div class="header-left d-flex align-items-center">
                    <div class="menu-toggle-btn mr-20">
                        <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                            <i class="lni lni-chevron-left me-2"></i> Menu
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
                <div class="header-right">
                    <div class="profile-box ml-15">
                        <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-info">
                                <div class="info">
                                    <h6><?= $_SESSION['user']['nama']; ?></h6>
                                    <div class="image">
                                        <img src="<?= $_SESSION['user']['foto']; ?>" alt="" />
                                    </div>
                                </div>
                            </div>
                            <i class="lni lni-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                            <li>
                                <a href="/" style="background-color: <?= isset($_GET['h']) ? 'none' : '#4a6cf7' ?>; color: <?= isset($_GET['h']) ? '' : 'white' ?>;">
                                    <i class="lni lni-user"></i> Menu Kasir
                                </a>
                            </li>
                            <li>
                                <a href="?h=riwayat_penjualan" style="background-color: <?= (($_GET['h'] ?? '') == 'riwayat_penjualan') ? '#4a6cf7' : 'none' ?>; color: <?= (($_GET['h'] ?? '') == 'riwayat_penjualan') ? 'white' : '' ?>;">
                                    <i class="lni lni-user"></i> Riwayat Penjualan
                                </a>
                            </li>
                            <li>
                                <a href="?h=stok_bahan_baku" style="background-color: <?= (($_GET['h'] ?? '') == 'stok_bahan_baku') ? '#4a6cf7' : 'none' ?>; color: <?= (($_GET['h'] ?? '') == 'stok_bahan_baku') ? 'white' : '' ?>;">
                                    <i class="lni lni-user"></i> Stok Bahan Baku
                                </a>
                            </li>
                            <li>
                                <a href="#0" style="background-color: <?= (($_GET['h'] ?? '') == 'ganti_password') ? '#4a6cf7' : 'none' ?>; color: <?= (($_GET['h'] ?? '') == 'ganti_password') ? 'white' : '' ?>;">
                                    <i class="lni lni-cog"></i> Ganti Password
                                </a>
                            </li>
                            <li>
                                <a href="halaman/logout/?"> <i class="lni lni-exit"></i> Keluar </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>