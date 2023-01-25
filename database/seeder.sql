INSERT INTO `db_majelis_kopi`.`user` (
    `id`,
    `username`,
    `password`,
    `status` 
) VALUES 
(1, 'admin', 'admin', 'ADMIN'),
(2, 'kasir', 'kasir', 'KASIR');

INSERT INTO `db_majelis_kopi`.`kasir` (
    `id`,
    `id_user`,
    `nama`,
    `tempat_lahir`,
    `tanggal_lahir`,
    `jenis_kelamin`,
    `foto`
) VALUES 
(1, 2, 'Zaldi', 'Banjarbaru', '2001-01-01', 'Laki - Laki', '');

INSERT INTO `db_majelis_kopi`.`kategori_menu` (
    `id`,
    `nama`
) VALUES 
(1, 'Botolan'),
(2, 'Cake'),
(3, 'Coffee'),
(4, 'Food'),
(5, 'Mocktails'),
(6, 'Non Coffee'),
(7, 'Snack'),
(8, 'Syrup'),
(9, 'Tea Variant');

INSERT INTO `db_majelis_kopi`.`menu` (
    `id`,
    `id_kategori_menu`,
    `nama`,
    `harga`,
    `foto`
) VALUES 
(1, 1, 'AQUA', 7000, 'assets/images/menu/aqua.jpg'),
(2, 1, 'Le Minerale', 7000, 'assets/images/menu/le-minerale.png'),
(3, 4, 'Nasi Goreng', 35000, 'assets/images/menu/nasi-goreng.jpg'),
(4, 3, 'Cafe Latte', 25000, 'assets/images/menu/cafe-latte.jpg'),
(5, 3, 'Cappuccino', 30000, 'assets/images/menu/cappuccino.jpg');

INSERT INTO `db_majelis_kopi`.`bahan_baku` (
    `id`,
    `nama`,
    `satuan`
) VALUES 
(1, 'Telur', 'Butir'),
(2, 'Air Mineral AQUA', 'Botol'),
(3, 'Air Mineral Le Minerale', 'Botol'),
(4, 'Sosis', 'Sosis'),
(5, 'Kopi', 'Gram'),
(6, 'Susu', 'Milliliter');

INSERT INTO `db_majelis_kopi`.`pemasok` (
    `id`,
    `nama`
) VALUES 
(1, 'Umum'),
(2, 'PT Air Mineral'),
(3, 'Kedai A');

INSERT INTO `db_majelis_kopi`.`pemasok_bahan_baku` (
    `id`,
    `id_pemasok`,
    `id_bahan_baku`
) VALUES 
(1, 1, 1),
(2, 1, 4),
(3, 2, 2),
(4, 2, 3),
(5, 3, 5),
(6, 3, 6);

INSERT INTO `db_majelis_kopi`.`bahan_baku_menu` (
    `id`,
    `id_menu`,
    `id_bahan_baku`,
    `jumlah`
) VALUES 
(1, 1, 2, 1),
(2, 2, 3, 1),
(3, 3, 1, 1),
(4, 3, 4, 2),
(5, 4, 5, 18),
(6, 4, 6, 120),
(7, 5, 5, 20),
(8, 5, 6, 150);


INSERT INTO `db_majelis_kopi`.`penyuplaian` (
    `id`,
    `id_pemasok_bahan_baku`,
    `tanggal`, 
    `jumlah`
) VALUES 
(1, 1, CURRENT_DATE(), 5),
(2, 2, CURRENT_DATE(), 5),
(3, 3, CURRENT_DATE(), 5),
(4, 4, CURRENT_DATE(), 5),
(5, 5, CURRENT_DATE(), 5),
(6, 6, CURRENT_DATE(), 5);

INSERT INTO `db_majelis_kopi`.`pelanggan` (
    `id`,
    `tanggal_terdaftar`,
    `nama`,
    `jenis_kelamin`
) VALUES 
(1, NOW(), 'Habibi', 'Laki - Laki');

INSERT INTO `db_majelis_kopi`.`penjualan` (
    `id`,
    `id_kasir`,
    `id_pelanggan`,
    `tunai`,
    `tanggal_waktu`
) VALUES 
(1, 1, NULL, 100000, NOW()),
(2, 1, NULL, 100000, NOW());

INSERT INTO `db_majelis_kopi`.`detail_penjualan` (
    `id`,
    `id_penjualan`,
    `id_menu`,
    `jumlah`,
    `harga`
) VALUES 
(1, 1, 1, 2, 5000),
(2, 2, 3, 1, 5000),
(3, 2, 1, 2, 5000);


INSERT INTO `db_majelis_kopi`.`bahan_baku_digunakan` (
    `id`,
    `id_detail_penjualan`,
    `id_bahan_baku`,
    `jumlah`
) VALUES 
(1, 1, 2, 1),
(2, 2, 1, 1),
(3, 2, 4, 2);

