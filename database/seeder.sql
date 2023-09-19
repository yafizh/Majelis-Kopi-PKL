-- USER
INSERT INTO `db_majelis_kopi`.`user` (`id`, `username`, `password`, `status`) VALUES
(1, 'admin', 'admin', 'ADMIN'),
(2, 'kasir', 'kasir', 'KASIR'),
(3, 'dali', 'dali', NULL),
(4, 'yudi', 'yudi', NULL),
(5, 'amin', 'amin', NULL),
(6, 'sasa', 'sasa1', NULL);

-- KASIR
INSERT INTO `db_majelis_kopi`.`kasir` (`id`, `id_user`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `nominal_gaji`, `foto`) VALUES
(1, 2, 'Zaldi', 'Martapura', '2000-03-31', 'Laki - Laki', 1500000, 'uploads/20230731011414.jpg'),
(2, 3, 'hadya ahdali', 'martapura', '2001-03-18', 'Laki - Laki', 1500000, 'uploads/20230731011226.jpeg'),
(3, 4, 'muhammad kasnadi mahyudi', 'Astambul', '2004-03-13', 'Laki - Laki', 1000000, 'uploads/20230731011604.jpeg'),
(4, 5, 'muhammad amin', 'martapura', '2000-09-11', 'Laki - Laki', 1500000, 'uploads/20230731011742.jpeg'),
(5, 6, 'sasa', 'banjarbaru', '2004-01-01', 'Perempuan', 1500000, 'uploads/20230807030911.jpeg');

INSERT INTO `db_majelis_kopi`.`penggajian_kasir` (`id`, `id_kasir`, `bulan`, `tahun`, `nominal_gaji`, `potongan_gaji`) VALUES
(1, 2, 7, 2023, 1500000, 0),
(2, 4, 8, 2023, 1500000, 0),
(3, 3, 8, 2023, 1000000, 0),
(4, 1, 8, 2023, 1500000, 0),
(5, 4, 7, 2023, 1500000, 50000),
(6, 2, 8, 2023, 1500000, 200000);

-- ASET
INSERT INTO `db_majelis_kopi`.`aset` (`id`, `nama`, `jumlah`, `keterangan`, `foto`) VALUES
(1, 'kursi', 27, 'pembelian tahun 2020', 'uploads/aset20230731005658.png'),
(2, 'kompor', 1, 'pembelian tahun 2021', 'uploads/aset20230731012021.jfif'),
(3, 'bar', 1, 'since 2016', 'uploads/aset20230731012046.jfif'),
(4, 'Mesin Kopi', 1, 'Lanuifera', 'uploads/aset20230805004717.jpg'),
(5, 'malkhonig', 1, 'grinder kopi', 'uploads/aset20230805004748.jpg'),
(6, 'Meja', 9, 'Semi Kayu', 'uploads/aset20230805004947.jfif');

INSERT INTO `db_majelis_kopi`.`aset_berkurang` (`id`, `id_aset`, `id_user`, `jumlah`, `keterangan`, `tanggal`) VALUES
(1, 1, 1, 1, 'rusak', '2023-07-31'),
(2, 6, 1, 1, 'Rusak', '2023-08-05'),
(3, 1, 1, 2, 'dipindahkan ke bagian gudang', '2023-08-07');

INSERT INTO `db_majelis_kopi`.`aset_bertambah` (`id`, `id_aset`, `id_user`, `jumlah`, `keterangan`, `tanggal`) VALUES
(1, 1, 1, 10, 'pembelian 2022', '2023-07-31'),
(2, 3, 1, 1, 'Permanen', '2023-07-31'),
(3, 2, 1, 1, 'tahun masuk 2022', '2023-07-31'),
(4, 5, 1, 1, 'Pembelian Tahun 2018', '2023-08-05'),
(5, 4, 1, 1, 'tahun pembelian 2018', '2023-08-05'),
(6, 6, 1, 10, 'pembelian tahun 2022', '2023-08-05'),
(7, 1, 1, 20, 'Penambahan Asset', '2023-08-05');

-- KATEGORI MENU
INSERT INTO `db_majelis_kopi`.`kategori_menu` (`id`, `nama`) VALUES
(1, 'Botolan'),
(2, 'Cake'),
(3, 'Coffee'),
(4, 'Food'),
(5, 'Mocktails'),
(6, 'Non Coffee'),
(7, 'Snack'),
(8, 'Syrup'),
(9, 'Tea Variant');

-- MENU
INSERT INTO `db_majelis_kopi`.`menu` (`id`, `id_kategori_menu`, `nama`, `harga`, `foto`) VALUES
(1, 1, 'AQUA', 7000, 'assets/images/menu/aqua.jpg'),
(2, 1, 'Le Minerale', 7000, 'assets/images/menu/le-minerale.png'),
(3, 4, 'Nasi Goreng', 35000, 'assets/images/menu/nasi-goreng.jpg'),
(4, 3, 'Cafe Latte', 25000, 'assets/images/menu/cafe-latte.jpg'),
(5, 3, 'Cappuccino', 30000, 'assets/images/menu/cappuccino.jpg'),
(6, 3, 'kopi susu aren', 20000, 'uploads/20230731021515.jpeg'),
(7, 5, 'Black in the past', 30000, 'uploads/20230731021757.jpeg'),
(8, 9, 'ice tea', 9000, 'uploads/20230731022945.jpg'),
(9, 3, 'kopi susu original', 20000, 'uploads/20230731023129.jpeg'),
(10, 6, 'macha', 25000, 'uploads/20230731023233.jpeg'),
(11, 6, 'Taro', 25000, 'uploads/20230731023327.jpeg'),
(12, 6, 'red velved', 25000, 'uploads/20230731023449.jpeg'),
(13, 6, 'chocolate', 25000, 'uploads/20230731023533.jpeg'),
(14, 2, 'Kue cubit', 20000, 'uploads/20230731024611.jpg'),
(15, 7, 'Kentang Goreng', 20000, 'uploads/20230731024651.jpeg'),
(16, 7, 'siomay goreng', 20000, 'uploads/20230731024742.jpeg'),
(17, 7, 'Tahu crispy', 20000, 'uploads/20230731024820.jpeg'),
(18, 9, 'lemon tea', 25000, 'uploads/20230731024920.jpg'),
(19, 8, 'Caramel', 30000, 'uploads/20230805005444.jpeg'),
(20, 8, 'Vanila', 30000, 'uploads/20230805005749.jpeg'),
(21, 8, 'hazelnut', 30000, 'uploads/20230805005843.jpeg');

-- PELANGGAN 
INSERT INTO `db_majelis_kopi`.`pelanggan` (`id`, `nama`, `nomor_telepon`, `email`, `jenis_kelamin`, `tanggal_terdaftar`) VALUES
(1, 'Habibi', '087811442255', NULL, 'Laki - Laki', '2023-07-31'),
(2, 'nida', '089777777', NULL, 'Perempuan', '2023-07-31'),
(3, 'fiya', '08966666', NULL, 'Perempuan', '2023-07-31'),
(4, 'helmi', '08578787', NULL, 'Laki - Laki', '2023-07-31');

-- PEMASOK
INSERT INTO `db_majelis_kopi`.`pemasok` (`id`, `nama`) VALUES
(5, 'beastmeat'),
(7, 'fresh fruit'),
(3, 'Kedai A'),
(6, 'moonlight'),
(4, 'ohayoo suplier'),
(2, 'PT Air Mineral'),
(1, 'Umum');

-- BAHAN BAKU
INSERT INTO `db_majelis_kopi`.`bahan_baku` (`id`, `nama`, `satuan`) VALUES
(1, 'Telur', 'Butir'),
(2, 'Air Mineral AQUA', 'Botol'),
(3, 'Air Mineral Le Minerale', 'Botol'),
(4, 'Sosis', 'Sosis'),
(5, 'beans', 'Gram'),
(6, 'freshmilk', 'Milliliter'),
(7, 'bubuk macha', 'gram'),
(8, 'bubuk taro', 'gram'),
(9, 'bubuk chocolate', 'gram'),
(10, 'bubuk red velved', 'gram'),
(11, 'grandsand', 'mililiter'),
(12, 'aren', 'mililiter'),
(13, 'gula', 'mililiter'),
(14, 'susu kental manis', 'mililiter'),
(15, 'tea', 'pcs'),
(16, 'lemon', 'butir'),
(17, 'Kentang', 'Gram'),
(18, 'Tahu Krispy', 'butir'),
(19, 'siomay', 'butir'),
(20, 'Kue Cubit', 'Butir'),
(21, 'syrup hazelnut', 'mililiter'),
(22, 'syrup caramel', 'Mililiter'),
(24, 'syrup vanila', 'mililiter'),
(25, 'leci', 'butir');

INSERT INTO `db_majelis_kopi`.`pemasok_bahan_baku` (`id`, `id_pemasok`, `id_bahan_baku`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 2, 2),
(4, 2, 3),
(6, 3, 6),
(8, 4, 7),
(9, 4, 8),
(10, 4, 9),
(11, 4, 10),
(12, 4, 11),
(13, 3, 12),
(14, 3, 13),
(15, 3, 14),
(16, 3, 15),
(17, 3, 16),
(18, 5, 17),
(19, 5, 18),
(20, 5, 19),
(21, 6, 20),
(22, 4, 5),
(23, 6, 21),
(24, 6, 22),
(25, 6, 24),
(26, 7, 25);

INSERT INTO `db_majelis_kopi`.`penyuplaian` (`id`, `id_pemasok_bahan_baku`, `tanggal`, `jumlah`, `harga`) VALUES
(1, 1, '2023-07-31', 5, 10000),
(2, 2, '2023-07-31', 5, 10000),
(3, 3, '2023-07-31', 50, 10000),
(4, 4, '2023-07-31', 50, 10000),
(6, 6, '2023-07-31', 1000, 15),
(7, 9, '2023-07-31', 1000, 150),
(9, 8, '2023-07-31', 1000, 150),
(10, 10, '2023-07-31', 1000, 150),
(11, 11, '2023-07-31', 1000, 150),
(12, 13, '2023-07-31', 1000, 100),
(13, 6, '2023-07-31', 1000, 18),
(14, 14, '2023-07-31', 1000, 15),
(15, 16, '2023-07-31', 100, 200),
(16, 12, '2023-07-31', 500, 20),
(17, 18, '2023-07-31', 2000, 34),
(18, 21, '2023-07-31', 100, 180),
(19, 20, '2023-07-31', 60, 75000),
(20, 19, '2023-07-31', 10, 2000),
(21, 17, '2023-07-31', 100, 2000),
(22, 22, '2023-07-31', 2000, 100000),
(24, 15, '2023-07-31', 1000, 5000),
(25, 2, '2023-08-05', 100, 15000),
(26, 23, '2023-08-05', 5000, 750000),
(27, 24, '2023-08-05', 5000, 750000),
(28, 25, '2023-08-05', 5000, 750000),
(29, 19, '2023-08-07', 10, 10000),
(30, 26, '2023-08-07', 10, 40000);



INSERT INTO `db_majelis_kopi`.`bahan_baku_menu` (`id`, `id_menu`, `id_bahan_baku`, `jumlah`) VALUES
(1, 1, 2, 1),
(2, 2, 3, 1),
(3, 3, 1, 1),
(4, 3, 4, 2),
(5, 4, 5, 18),
(6, 4, 6, 120),
(7, 5, 5, 20),
(8, 5, 6, 150),
(9, 6, 12, 30),
(10, 6, 5, 15),
(11, 6, 6, 150),
(12, 7, 5, 15),
(13, 7, 13, 20),
(14, 7, 11, 150),
(15, 8, 15, 1),
(16, 8, 13, 50),
(17, 9, 5, 15),
(18, 9, 13, 20),
(19, 9, 6, 150),
(20, 10, 7, 20),
(21, 10, 14, 10),
(22, 10, 6, 150),
(23, 11, 8, 20),
(24, 11, 14, 10),
(25, 11, 6, 150),
(26, 12, 10, 20),
(27, 12, 14, 10),
(28, 12, 6, 150),
(29, 13, 9, 20),
(30, 13, 14, 10),
(31, 13, 6, 150),
(32, 14, 20, 10),
(33, 15, 17, 150),
(34, 16, 19, 7),
(35, 17, 18, 2),
(36, 18, 15, 2),
(37, 18, 16, 1),
(38, 18, 13, 30),
(43, 19, 22, 25),
(44, 19, 14, 5),
(45, 19, 6, 150),
(46, 20, 5, 15),
(47, 20, 6, 150),
(48, 20, 14, 5),
(49, 20, 24, 25),
(50, 21, 21, 25),
(51, 21, 5, 15),
(52, 21, 6, 150),
(53, 21, 14, 5);

INSERT INTO `db_majelis_kopi`.`penjualan` (`id`, `id_kasir`, `id_pelanggan`, `nama`, `tunai`, `tanggal_waktu`) VALUES
(1, 1, NULL, 'Zaldi', 100000, '2023-07-31 00:53:32'),
(2, 1, NULL, 'Habibi', 100000, '2023-07-31 00:53:32'),
(3, 1, 2, 'nida', 100000, '2023-07-31 10:14:57'),
(4, 1, NULL, 'khairuni', 55000, '2023-08-05 13:48:54'),
(5, 1, NULL, 'izuh', 20000, '2023-08-07 00:51:24'),
(6, 5, 2, 'nida', 100000, '2023-08-07 03:24:00'),
(7, 1, 1, 'Habibi', 50000, '2023-08-07 03:26:28'),
(8, 1, NULL, 'susi', 200000, '2023-08-07 03:29:21');

INSERT INTO `db_majelis_kopi`.`detail_penjualan` (`id`, `id_penjualan`, `id_menu`, `jumlah`, `harga`) VALUES
(1, 1, 1, '2', 5000),
(2, 2, 3, '1', 5000),
(3, 2, 1, '2', 5000),
(4, 3, 4, '1', 25000),
(5, 3, 5, '1', 30000),
(6, 3, 6, '1', 20000),
(7, 4, 4, '1', 25000),
(8, 4, 5, '1', 30000),
(9, 5, 17, '1', 20000),
(16, 6, 4, '1', 25000),
(17, 6, 6, '1', 20000),
(20, 7, 6, '1', 20000),
(21, 7, 5, '1', 30000),
(22, 8, 14, '10', 20000);

INSERT INTO `db_majelis_kopi`.`bahan_baku_digunakan` (`id`, `id_detail_penjualan`, `id_bahan_baku`, `jumlah`) VALUES
(1, 1, 2, '1'),
(2, 2, 1, '1'),
(3, 2, 4, '2'),
(4, 4, 5, '18'),
(5, 4, 6, '120'),
(6, 5, 5, '20'),
(7, 5, 6, '150'),
(8, 6, 12, '30'),
(9, 6, 5, '15'),
(10, 6, 6, '150'),
(11, 7, 5, '18'),
(12, 7, 6, '120'),
(13, 8, 5, '20'),
(14, 8, 6, '150'),
(15, 9, 18, '2'),
(29, 22, 20, '10');

INSERT INTO `db_majelis_kopi`.`presensi_kasir` (`id`, `id_kasir`, `bulan`, `tahun`, `hadir`, `sakit`, `izin`, `tidak_hadir`) VALUES
(1, 2, 8, 2023, 5, 0, 0, 0),
(2, 4, 8, 2023, 5, 0, 0, 0),
(3, 3, 8, 2023, 5, 0, 0, 0),
(4, 1, 8, 2023, 5, 0, 0, 0),
(5, 4, 7, 2023, 28, 0, 1, 0),
(6, 2, 8, 2023, 20, 1, 2, 2);
