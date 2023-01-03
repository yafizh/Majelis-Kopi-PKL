INSERT INTO `db_majelis_kopi`.`user` (
    `id`,
    `username`,
    `password`
) VALUES 
(1, 'kasir', 'kasir');

INSERT INTO `db_majelis_kopi`.`kasir` (
    `id`,
    `id_user`,
    `nama`,
    `tempat_lahir`,
    `tanggal_lahir`,
    `jenis_kelamin`,
    `foto`
) VALUES 
(1, 1, 'Zaldi', 'Banjarbaru', '2001-01-01', 'Laki - Laki', '');

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
    `nama`
) VALUES 
(1, 1, 'AQUA'),
(2, 1, 'PROF'),
(3, 4, 'Nasi Goreng'),
(4, 3, 'Kopi Susus');

INSERT INTO `db_majelis_kopi`.`bahan_baku` (
    `id`,
    `nama`,
    `satuan`
) VALUES 
(1, 'Telur', 'Butir'),
(2, 'AQUA', 'Botol'),
(3, 'PROF', 'Botol'),
(4, 'Sosis', 'Sosis'),
(5, 'Kopi', 'Gram'),
(6, 'Susu', 'Milliliter');

INSERT INTO `db_majelis_kopi`.`bahan_baku_menu` (
    `id`,
    `id_menu`,
    `id_bahan_baku`,
    `jumlah`
) VALUES 
(1, 1, 2, 1),
(2, 2, 3, 1),
(3, 3, 1, 1),
(4, 3, 4, 1),
(5, 4, 5, 10),
(6, 4, 6, 10);

INSERT INTO `db_majelis_kopi`.`penjualan` (
    `id`,
    `id_menu`,
    `id_kasir`,
    `jumlah`,
    `tanggal_waktu`
) VALUES 
(1, 1, 1, 2, NOW()),
(2, 3, 1, 1, NOW());