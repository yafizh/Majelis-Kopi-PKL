DROP DATABASE IF EXISTS `db_majelis_kopi`;
CREATE DATABASE `db_majelis_kopi`;
USE `db_majelis_kopi`;

CREATE TABLE `db_majelis_kopi`.`kategori_menu`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `nama` VARCHAR(255) UNIQUE,
    PRIMARY KEY(`id`)
);

CREATE TABLE `db_majelis_kopi`.`menu`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_kategori_menu` BIGINT UNSIGNED,
    `nama` VARCHAR(255) UNIQUE,
    `harga` BIGINT UNSIGNED,
    `foto` VARCHAR(255), 
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_kategori_menu`) REFERENCES kategori_menu (`id`) ON DELETE CASCADE
);

CREATE TABLE `db_majelis_kopi`.`bahan_baku`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `nama` VARCHAR(255) UNIQUE,
    `satuan` VARCHAR(255),
    PRIMARY KEY(`id`)
);

CREATE TABLE `db_majelis_kopi`.`bahan_baku_menu`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_menu` BIGINT UNSIGNED,
    `id_bahan_baku` BIGINT UNSIGNED,
    `jumlah` BIGINT UNSIGNED,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_menu`) REFERENCES menu (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_bahan_baku`) REFERENCES bahan_baku (`id`) ON DELETE CASCADE 
);

CREATE TABLE `db_majelis_kopi`.`pemasok`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `nama` VARCHAR(255) UNIQUE,
    PRIMARY KEY(`id`)
);

CREATE TABLE `db_majelis_kopi`.`pemasok_bahan_baku`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_pemasok` BIGINT UNSIGNED,
    `id_bahan_baku` BIGINT UNSIGNED,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_pemasok`) REFERENCES pemasok (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_bahan_baku`) REFERENCES bahan_baku (`id`) ON DELETE CASCADE 
);

CREATE TABLE `db_majelis_kopi`.`penyuplaian`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_pemasok_bahan_baku` BIGINT UNSIGNED,
    `tanggal` DATE,
    `jumlah` BIGINT UNSIGNED,
    `harga` BIGINT UNSIGNED,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_pemasok_bahan_baku`) REFERENCES pemasok_bahan_baku (`id`) ON DELETE CASCADE 
);


CREATE TABLE `db_majelis_kopi`.`user`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `username` VARCHAR(255) UNIQUE,
    `password` VARCHAR(255),
    `status` VARCHAR(255),
    PRIMARY KEY(`id`)
);

CREATE TABLE `db_majelis_kopi`.`kasir`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_user` BIGINT UNSIGNED,
    `nama` VARCHAR(255),
    `tempat_lahir` VARCHAR(255),
    `tanggal_lahir` DATE,
    `jenis_kelamin` VARCHAR(255),
    `nominal_gaji` BIGINT UNSIGNED,
    `foto` VARCHAR(255),
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_user`) REFERENCES user (`id`) ON DELETE CASCADE 
);

CREATE TABLE `db_majelis_kopi`.`presensi_kasir`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_kasir` BIGINT UNSIGNED,
    `bulan` TINYINT UNSIGNED,
    `tahun` INT UNSIGNED,
    `hadir` TINYINT UNSIGNED,
    `sakit` TINYINT UNSIGNED,
    `izin` TINYINT UNSIGNED,
    `tidak_hadir` TINYINT UNSIGNED,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_kasir`) REFERENCES kasir (`id`) ON DELETE CASCADE 
);

CREATE TABLE `db_majelis_kopi`.`penggajian_kasir`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_kasir` BIGINT UNSIGNED,
    `bulan` TINYINT UNSIGNED,
    `tahun` INT UNSIGNED,
    `nominal_gaji` BIGINT UNSIGNED,
    `potongan_gaji` BIGINT UNSIGNED,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_kasir`) REFERENCES kasir (`id`) ON DELETE CASCADE 
);

CREATE TABLE `db_majelis_kopi`.`pelanggan`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `nama` VARCHAR(255),
    `nomor_telepon` VARCHAR(255),
    `email` VARCHAR(255),
    `jenis_kelamin` VARCHAR(255),
    `tanggal_terdaftar` DATE,
    PRIMARY KEY (`id`) 
);

CREATE TABLE `db_majelis_kopi`.`penjualan`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_kasir` BIGINT UNSIGNED,
    `id_pelanggan` BIGINT UNSIGNED NULL,
    `nama` VARCHAR(255),
    `tunai` BIGINT UNSIGNED,
    `tanggal_waktu` VARCHAR(255),
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_kasir`) REFERENCES kasir (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_pelanggan`) REFERENCES pelanggan (`id`) ON DELETE CASCADE 
);

CREATE TABLE `db_majelis_kopi`.`detail_penjualan`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_penjualan` BIGINT UNSIGNED,
    `id_menu` BIGINT UNSIGNED,
    `jumlah` VARCHAR(255),
    `harga` BIGINT UNSIGNED,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_penjualan`) REFERENCES penjualan (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_menu`) REFERENCES menu (`id`) ON DELETE CASCADE 
);

CREATE TABLE `db_majelis_kopi`.`bahan_baku_digunakan`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_detail_penjualan` BIGINT UNSIGNED,
    `id_bahan_baku` BIGINT UNSIGNED,
    `jumlah` VARCHAR(255),
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_detail_penjualan`) REFERENCES detail_penjualan (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_bahan_baku`) REFERENCES bahan_baku (`id`) ON DELETE CASCADE 
);

CREATE TABLE `db_majelis_kopi`.`aset` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `nama` VARCHAR(255),
    `jumlah` INT,
    `keterangan` TEXT,
    `foto` VARCHAR(255),
    PRIMARY KEY (`id`)
);

CREATE TABLE `db_majelis_kopi`.`aset_bertambah`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_aset` BIGINT UNSIGNED,
    `id_user` BIGINT UNSIGNED,
    `jumlah` INT,
    `keterangan` TEXT,
    `tanggal` DATE,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_aset`) REFERENCES aset (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_user`) REFERENCES user (`id`) ON DELETE CASCADE 
);

CREATE TABLE `db_majelis_kopi`.`aset_berkurang`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_aset` BIGINT UNSIGNED,
    `id_user` BIGINT UNSIGNED,
    `jumlah` INT,
    `keterangan` TEXT,
    `tanggal` DATE,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_aset`) REFERENCES aset (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_user`) REFERENCES user (`id`) ON DELETE CASCADE 
);