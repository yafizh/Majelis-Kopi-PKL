<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <img src="assets/images/logo/logo.jpg" width="80" class="mb-3" alt="logo" />
        <h4>MAJELIS KOPI</h4>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-item <?= isset($_GET['h1']) ? '' : 'active'; ?>">
                <a href="?">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19,5V7H15V5H19M9,5V11H5V5H9M19,13V19H15V13H19M9,17V19H5V17H9M21,3H13V9H21V3M11,3H3V13H11V3M21,11H13V21H21V11M11,15H3V21H11V15Z" />
                        </svg>
                    </span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-item-has-children <?= ($_GET['h1'] ?? '') == 'user' ? 'active' : ''; ?>">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#user" aria-controls="user" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,5A3.5,3.5 0 0,0 8.5,8.5A3.5,3.5 0 0,0 12,12A3.5,3.5 0 0,0 15.5,8.5A3.5,3.5 0 0,0 12,5M12,7A1.5,1.5 0 0,1 13.5,8.5A1.5,1.5 0 0,1 12,10A1.5,1.5 0 0,1 10.5,8.5A1.5,1.5 0 0,1 12,7M5.5,8A2.5,2.5 0 0,0 3,10.5C3,11.44 3.53,12.25 4.29,12.68C4.65,12.88 5.06,13 5.5,13C5.94,13 6.35,12.88 6.71,12.68C7.08,12.47 7.39,12.17 7.62,11.81C6.89,10.86 6.5,9.7 6.5,8.5C6.5,8.41 6.5,8.31 6.5,8.22C6.2,8.08 5.86,8 5.5,8M18.5,8C18.14,8 17.8,8.08 17.5,8.22C17.5,8.31 17.5,8.41 17.5,8.5C17.5,9.7 17.11,10.86 16.38,11.81C16.5,12 16.63,12.15 16.78,12.3C16.94,12.45 17.1,12.58 17.29,12.68C17.65,12.88 18.06,13 18.5,13C18.94,13 19.35,12.88 19.71,12.68C20.47,12.25 21,11.44 21,10.5A2.5,2.5 0 0,0 18.5,8M12,14C9.66,14 5,15.17 5,17.5V19H19V17.5C19,15.17 14.34,14 12,14M4.71,14.55C2.78,14.78 0,15.76 0,17.5V19H3V17.07C3,16.06 3.69,15.22 4.71,14.55M19.29,14.55C20.31,15.22 21,16.06 21,17.07V19H24V17.5C24,15.76 21.22,14.78 19.29,14.55M12,16C13.53,16 15.24,16.5 16.23,17H7.77C8.76,16.5 10.47,16 12,16Z" />
                        </svg>
                    </span>
                    <span class="text">User</span>
                </a>
                <ul id="user" class="collapse dropdown-nav <?= ($_GET['h1'] ?? '') == 'user' ? 'show' : ''; ?>">
                    <li><a href="?h1=user&h2=admin" class="<?= in_array(($_GET['h2'] ?? ''), ['admin', 'tambah_admin', 'ubah_admin']) ? 'active' : ''; ?>">Admin</a></li>
                    <li><a href="?h1=user&h2=kasir" class="<?= in_array(($_GET['h2'] ?? ''), ['kasir', 'tambah_kasir', 'ubah_kasir', 'detail_kasir']) ? 'active' : ''; ?>">Kasir</a></li>
                </ul>
            </li>
            <li class="nav-item nav-item-has-children <?= ($_GET['h1'] ?? '') == 'aset' ? 'active' : ''; ?>">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#aset" aria-controls="aset" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,5A3.5,3.5 0 0,0 8.5,8.5A3.5,3.5 0 0,0 12,12A3.5,3.5 0 0,0 15.5,8.5A3.5,3.5 0 0,0 12,5M12,7A1.5,1.5 0 0,1 13.5,8.5A1.5,1.5 0 0,1 12,10A1.5,1.5 0 0,1 10.5,8.5A1.5,1.5 0 0,1 12,7M5.5,8A2.5,2.5 0 0,0 3,10.5C3,11.44 3.53,12.25 4.29,12.68C4.65,12.88 5.06,13 5.5,13C5.94,13 6.35,12.88 6.71,12.68C7.08,12.47 7.39,12.17 7.62,11.81C6.89,10.86 6.5,9.7 6.5,8.5C6.5,8.41 6.5,8.31 6.5,8.22C6.2,8.08 5.86,8 5.5,8M18.5,8C18.14,8 17.8,8.08 17.5,8.22C17.5,8.31 17.5,8.41 17.5,8.5C17.5,9.7 17.11,10.86 16.38,11.81C16.5,12 16.63,12.15 16.78,12.3C16.94,12.45 17.1,12.58 17.29,12.68C17.65,12.88 18.06,13 18.5,13C18.94,13 19.35,12.88 19.71,12.68C20.47,12.25 21,11.44 21,10.5A2.5,2.5 0 0,0 18.5,8M12,14C9.66,14 5,15.17 5,17.5V19H19V17.5C19,15.17 14.34,14 12,14M4.71,14.55C2.78,14.78 0,15.76 0,17.5V19H3V17.07C3,16.06 3.69,15.22 4.71,14.55M19.29,14.55C20.31,15.22 21,16.06 21,17.07V19H24V17.5C24,15.76 21.22,14.78 19.29,14.55M12,16C13.53,16 15.24,16.5 16.23,17H7.77C8.76,16.5 10.47,16 12,16Z" />
                        </svg>
                    </span>
                    <span class="text">Aset</span>
                </a>
                <ul id="aset" class="collapse dropdown-nav <?= ($_GET['h1'] ?? '') == 'aset' ? 'show' : ''; ?>">
                    <li><a href="?h1=aset&h2=data_aset" class="<?= in_array(($_GET['h2'] ?? ''), ['data_aset', 'tambah_aset', 'ubah_aset', 'detail_aset']) ? 'active' : ''; ?>">Daftar Aset</a></li>
                    <li><a href="?h1=aset&h2=penambahan_aset" class="<?= in_array(($_GET['h2'] ?? ''), ['penambahan_aset', 'tambah_penambahan_aset', 'ubah_penambahan_aset']) ? 'active' : ''; ?>">Riwayat Penambahan Aset</a></li>
                    <li><a href="?h1=aset&h2=pengurangan_aset" class="<?= in_array(($_GET['h2'] ?? ''), ['pengurangan_aset', 'tambah_pengurangan_aset', 'ubah_pengurangan_aset']) ? 'active' : ''; ?>">Riwayat Pengurangan Aset</a></li>
                </ul>
            </li>
            <li class="nav-item <?= in_array(($_GET['h1'] ?? ''), ['kategori_menu', 'tambah_kategori_menu', 'ubah_kategori_menu']) == 'kategori_menu' ? 'active' : ''; ?>">
                <a href="?h1=kategori_menu">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M11,13.5V21.5H3V13.5H11M9,15.5H5V19.5H9V15.5M12,2L17.5,11H6.5L12,2M12,5.86L10.08,9H13.92L12,5.86M17.5,13C20,13 22,15 22,17.5C22,20 20,22 17.5,22C15,22 13,20 13,17.5C13,15 15,13 17.5,13M17.5,15A2.5,2.5 0 0,0 15,17.5A2.5,2.5 0 0,0 17.5,20A2.5,2.5 0 0,0 20,17.5A2.5,2.5 0 0,0 17.5,15Z" />
                        </svg>
                    </span>
                    <span class="text">Kategori Menu</span>
                </a>
            </li>
            <span class="divider">
                <br>
                <h6>Utama</h6>
            </span>
            <li class="nav-item nav-item-has-children <?= ($_GET['h1'] ?? '') == 'karyawan' ? 'active' : ''; ?>">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#karyawan" aria-controls="karyawan" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19 3H14.82C14.4 1.84 13.3 1 12 1S9.6 1.84 9.18 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3M12 3C12.55 3 13 3.45 13 4S12.55 5 12 5 11 4.55 11 4 11.45 3 12 3M7 7H17V5H19V19H5V5H7V7M12 17V15H17V17H12M12 11V9H17V11H12M8 12V9H7V8H9V12H8M9.25 14C9.66 14 10 14.34 10 14.75C10 14.95 9.92 15.14 9.79 15.27L8.12 17H10V18H7V17.08L9 15H7V14H9.25" />
                        </svg>
                    </span>
                    <span class="text">Kasir</span>
                </a>
                <ul id="karyawan" class="collapse dropdown-nav <?= ($_GET['h1'] ?? '') == 'karyawan' ? 'show' : ''; ?>">
                    <li><a href="?h1=karyawan&h2=presensi" class="<?= ($_GET['h2'] ?? '') == 'presensi' ? 'active' : ''; ?>">Rekap Presensi</a></li>
                    <li><a href="?h1=karyawan&h2=penggajian" class="<?= ($_GET['h2'] ?? '') == 'penggajian' ? 'active' : ''; ?>">Penggajian</a></li>
                </ul>
            </li>
            <li class="nav-item nav-item-has-children <?= ($_GET['h1'] ?? '') == 'bahan_baku' ? 'active' : ''; ?>">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#bahan-baku" aria-controls="bahan-baku" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19 3H14.82C14.4 1.84 13.3 1 12 1S9.6 1.84 9.18 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3M12 3C12.55 3 13 3.45 13 4S12.55 5 12 5 11 4.55 11 4 11.45 3 12 3M7 7H17V5H19V19H5V5H7V7M12 17V15H17V17H12M12 11V9H17V11H12M8 12V9H7V8H9V12H8M9.25 14C9.66 14 10 14.34 10 14.75C10 14.95 9.92 15.14 9.79 15.27L8.12 17H10V18H7V17.08L9 15H7V14H9.25" />
                        </svg>
                    </span>
                    <span class="text">Bahan Baku</span>
                </a>
                <ul id="bahan-baku" class="collapse dropdown-nav <?= ($_GET['h1'] ?? '') == 'bahan_baku' ? 'show' : ''; ?>">
                    <li><a href="?h1=bahan_baku&h2=daftar_bahan_baku" class="<?= ($_GET['h2'] ?? '') == 'daftar_bahan_baku' ? 'active' : ''; ?>">Daftar Bahan Baku</a></li>
                    <li><a href="?h1=bahan_baku&h2=stok_bahan_baku" class="<?= ($_GET['h2'] ?? '') == 'stok_bahan_baku' ? 'active' : ''; ?>">Stok Bahan Baku</a></li>
                </ul>
            </li>
            <li class="nav-item nav-item-has-children <?= ($_GET['h1'] ?? '') == 'pemasok' ? 'active' : ''; ?>">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#pemasok" aria-controls="pemasok" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M18 18.5C18.83 18.5 19.5 17.83 19.5 17C19.5 16.17 18.83 15.5 18 15.5C17.17 15.5 16.5 16.17 16.5 17C16.5 17.83 17.17 18.5 18 18.5M19.5 9.5H17V12H21.46L19.5 9.5M6 18.5C6.83 18.5 7.5 17.83 7.5 17C7.5 16.17 6.83 15.5 6 15.5C5.17 15.5 4.5 16.17 4.5 17C4.5 17.83 5.17 18.5 6 18.5M20 8L23 12V17H21C21 18.66 19.66 20 18 20C16.34 20 15 18.66 15 17H9C9 18.66 7.66 20 6 20C4.34 20 3 18.66 3 17H1V6C1 4.89 1.89 4 3 4H17V8H20M3 6V15H3.76C4.31 14.39 5.11 14 6 14C6.89 14 7.69 14.39 8.24 15H15V6H3Z" />
                        </svg>
                    </span>
                    <span class="text">Pemasok</span>
                </a>
                <ul id="pemasok" class="collapse dropdown-nav <?= ($_GET['h1'] ?? '') == 'pemasok' ? 'show' : ''; ?>">
                    <li><a href="?h1=pemasok&h2=daftar_pemasok" class="<?= in_array(($_GET['h2'] ?? ''), ['daftar_pemasok', 'tambah_daftar_pemasok', 'ubah_daftar_pemasok', 'hapus_daftar_pemasok']) ? 'active' : ''; ?>">Daftar Pemasok</a></li>
                    <li><a href="?h1=pemasok&h2=penyuplaian" class="<?= ($_GET['h2'] ?? '') == 'penyuplaian' ? 'active' : ''; ?>">Penyuplaian</a></li>
                </ul>
            </li>
            <li class="nav-item nav-item-has-children <?= ($_GET['h1'] ?? '') == 'menu' ? 'active' : ''; ?>">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M1 22C1 22.54 1.45 23 2 23H15C15.56 23 16 22.54 16 22V21H1V22M8.5 9C4.75 9 1 11 1 15H16C16 11 12.25 9 8.5 9M3.62 13C4.73 11.45 7.09 11 8.5 11S12.27 11.45 13.38 13H3.62M1 17H16V19H1V17M18 5V1H16V5H11L11.23 7H20.79L19.39 21H18V23H19.72C20.56 23 21.25 22.35 21.35 21.53L23 5H18Z" />
                        </svg>
                    </span>
                    <span class="text">Menu</span>
                </a>
                <ul id="menu" class="collapse dropdown-nav <?= ($_GET['h1'] ?? '') == 'menu' ? 'show' : ''; ?>">
                    <li><a href="?h1=menu&h2=daftar_menu" class="<?= in_array(($_GET['h2'] ?? ''), ['daftar_menu', 'tambah_daftar_menu', 'ubah_daftar_menu', 'hapus_daftar_menu']) ? 'active' : ''; ?>">Daftar Menu</a></li>
                    <li><a href="?h1=menu&h2=favorit_menu" class="<?= ($_GET['h2'] ?? '') == 'favorit_menu' ? 'active' : ''; ?>">Favorit Menu</a></li>
                    <li><a href="?h1=menu&h2=penjualan" class="<?= in_array(($_GET['h2'] ?? ''), ['penjualan', 'detail_penjualan', 'edit_penjualan']) ? 'active' : ''; ?>">Penjualan</a></li>
                </ul>
            </li>
            <li class="nav-item <?= in_array(($_GET['h1'] ?? ''), ['pelanggan', 'tambah_pelanggan', 'ubah_pelanggan']) == 'pelanggan' ? 'active' : ''; ?>">
                <a href="?h1=pelanggan">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M15,4A4,4 0 0,1 19,8A4,4 0 0,1 15,12A4,4 0 0,1 11,8A4,4 0 0,1 15,4M15,5.9A2.1,2.1 0 0,0 12.9,8A2.1,2.1 0 0,0 15,10.1C16.16,10.1 17.1,9.16 17.1,8C17.1,6.84 16.16,5.9 15,5.9M15,13C17.67,13 23,14.33 23,17V20H7V17C7,14.33 12.33,13 15,13M15,14.9C12,14.9 8.9,16.36 8.9,17V18.1H21.1V17C21.1,16.36 17.97,14.9 15,14.9M5,13.28L2.5,14.77L3.18,11.96L1,10.08L3.87,9.83L5,7.19L6.11,9.83L9,10.08L6.8,11.96L7.45,14.77L5,13.28Z" />
                        </svg>
                    </span>
                    <span class="text">Pelanggan Tetap</span>
                </a>
            </li>
            <span class="divider">
                <br>
                <h6>Laporan</h6>
            </span>
            <li class="nav-item nav-item-has-children <?= ($_GET['h1'] ?? '') == 'laporan' ? 'active' : ''; ?>">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_5" aria-controls="ddmenu_5" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M16 0H8C6.9 0 6 .9 6 2V18C6 19.1 6.9 20 8 20H20C21.1 20 22 19.1 22 18V6L16 0M20 18H8V2H15V7H20V18M4 4V22H20V24H4C2.9 24 2 23.1 2 22V4H4M10 10V12H18V10H10M10 14V16H15V14H10Z" />
                        </svg>
                    </span>
                    <span class="text">Laporan</span>
                </a>
                <ul id="ddmenu_5" class="collapse dropdown-nav <?= ($_GET['h1'] ?? '') == 'laporan' ? 'show' : ''; ?>">
                    <li><a href="?h1=laporan&h2=kasir" class="<?= ($_GET['h2'] ?? '') == 'kasir' ? 'active' : ''; ?>">Kasir</a></li>
                    <li><a href="?h1=laporan&h2=menu" class="<?= ($_GET['h2'] ?? '') == 'menu' ? 'active' : ''; ?>">Menu</a></li>
                    <li><a href="?h1=laporan&h2=favorit_menu" class="<?= ($_GET['h2'] ?? '') == 'favorit_menu' ? 'active' : ''; ?>">Favorit Menu</a></li>
                    <li><a href="?h1=laporan&h2=grafik_favorit_menu" class="<?= ($_GET['h2'] ?? '') == 'grafik_favorit_menu' ? 'active' : ''; ?>">Grafik Favorit Menu</a></li>
                    <li><a href="?h1=laporan&h2=penjualan" class="<?= ($_GET['h2'] ?? '') == 'penjualan' ? 'active' : ''; ?>">Penjualan</a></li>
                    <li><a href="?h1=laporan&h2=pemasok" class="<?= ($_GET['h2'] ?? '') == 'pemasok' ? 'active' : ''; ?>">Pemasok</a></li>
                    <li><a href="?h1=laporan&h2=suplai_bahan_baku" class="<?= ($_GET['h2'] ?? '') == 'suplai_bahan_baku' ? 'active' : ''; ?>">Suplai Bahan Baku</a></li>
                    <li><a href="?h1=laporan&h2=keuangan" class="<?= ($_GET['h2'] ?? '') == 'keuangan' ? 'active' : ''; ?>">Keuangan</a></li>
                    <li><a href="?h1=laporan&h2=penambahan_aset" class="<?= ($_GET['h2'] ?? '') == 'penambahan_aset' ? 'active' : ''; ?>">Penambahan Aset</a></li>
                    <li><a href="?h1=laporan&h2=pengurangan_aset" class="<?= ($_GET['h2'] ?? '') == 'pengurangan_aset' ? 'active' : ''; ?>">Pengurangan Aset</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>