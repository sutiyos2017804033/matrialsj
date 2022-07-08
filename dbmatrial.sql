-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2022 pada 03.24
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmatrial`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `barang_id` varchar(15) NOT NULL,
  `barang_nama` varchar(150) DEFAULT NULL,
  `barang_satuan` varchar(30) DEFAULT NULL,
  `barang_harpok` double DEFAULT NULL,
  `barang_harjul` double DEFAULT NULL,
  `barang_stok` int(11) DEFAULT 0,
  `barang_tgl_input` timestamp NULL DEFAULT current_timestamp(),
  `barang_tgl_last_update` datetime DEFAULT NULL,
  `barang_kategori_id` int(11) DEFAULT NULL,
  `barang_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`barang_id`, `barang_nama`, `barang_satuan`, `barang_harpok`, `barang_harjul`, `barang_stok`, `barang_tgl_input`, `barang_tgl_last_update`, `barang_kategori_id`, `barang_user_id`) VALUES
('BR0006', 'Cat Nipon Paint1 Liter', 'Pcs', 70000, 80000, 36, '2021-10-09 10:24:35', '2022-07-05 05:10:23', 17, 1),
('BR0008', 'Semen 3 Roda', 'Sak', 40000, 55000, 5, '2021-10-09 10:25:51', '2022-07-05 05:12:06', 18, 1),
('BR0009', 'Palu', 'Pcs', 25000, 40000, 12, '2021-10-09 10:26:24', '2022-07-05 05:12:23', 15, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_beli`
--

CREATE TABLE `tbl_beli` (
  `beli_notrans` varchar(15) NOT NULL,
  `beli_tanggal` date DEFAULT NULL,
  `beli_suplier_id` int(11) DEFAULT NULL,
  `beli_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_beli`
--

INSERT INTO `tbl_beli` (`beli_notrans`, `beli_tanggal`, `beli_suplier_id`, `beli_user_id`) VALUES
('BL003', '2022-04-23', 7, 1),
('TR050722000015', '2022-07-05', 8, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_beli`
--

CREATE TABLE `tbl_detail_beli` (
  `d_beli_id` int(11) NOT NULL,
  `d_beli_notrans` varchar(15) DEFAULT NULL,
  `d_beli_barang_id` varchar(15) DEFAULT NULL,
  `d_beli_harga` double DEFAULT NULL,
  `d_beli_jumlah` int(11) DEFAULT NULL,
  `d_beli_total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_detail_beli`
--

INSERT INTO `tbl_detail_beli` (`d_beli_id`, `d_beli_notrans`, `d_beli_barang_id`, `d_beli_harga`, `d_beli_jumlah`, `d_beli_total`) VALUES
(192, 'BL003', 'BR0011', 60000, 1, 60000),
(195, 'TR050722000015', 'BR0006', 70000, 2, 140000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_jual`
--

CREATE TABLE `tbl_detail_jual` (
  `d_jual_id` int(11) NOT NULL,
  `d_jual_notrans` varchar(15) DEFAULT NULL,
  `d_jual_barang_id` varchar(15) DEFAULT NULL,
  `d_jual_barang_nama` varchar(150) DEFAULT NULL,
  `d_jual_barang_satuan` varchar(30) DEFAULT NULL,
  `d_jual_barang_harpok` double DEFAULT NULL,
  `d_jual_barang_harjul` double DEFAULT NULL,
  `d_jual_qty` int(11) DEFAULT NULL,
  `d_jual_diskon` double DEFAULT NULL,
  `d_jual_total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_detail_jual`
--

INSERT INTO `tbl_detail_jual` (`d_jual_id`, `d_jual_notrans`, `d_jual_barang_id`, `d_jual_barang_nama`, `d_jual_barang_satuan`, `d_jual_barang_harpok`, `d_jual_barang_harjul`, `d_jual_qty`, `d_jual_diskon`, `d_jual_total`) VALUES
(112, 'TR040722000001', 'BR0007', 'Tas Pancing', 'Pcs', 60000, 80000, 1, 10000, 80000),
(113, 'TR040722000001', 'BR0008', 'Jor Kayu ', 'Pcs', 15000, 20000, 1, 0, 20000),
(114, 'TR050722000012', 'BR0008', 'Jor Kayu ', 'Pcs', 15000, 20000, 1, 0, 20000),
(115, 'TR050722000013', 'BR0011', 'Jor Besi Panjang 2 M', 'Pcs', 60000, 80000, 1, 0, 80000),
(116, 'TR050722000014', 'BR0008', 'Semen 3 Roda', 'Sak', 40000, 55000, 10, 0, 550000),
(117, 'TR050722000015', 'BR0008', 'Semen 3 Roda', 'Sak', 40000, 55000, 5, 0, 275000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jual`
--

CREATE TABLE `tbl_jual` (
  `jual_notrans` varchar(15) NOT NULL,
  `jual_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `jual_total` double DEFAULT NULL,
  `jual_jml_uang` double DEFAULT NULL,
  `jual_kembalian` double DEFAULT NULL,
  `jual_user_id` int(11) DEFAULT NULL,
  `jual_keterangan` varchar(150) DEFAULT 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jual`
--

INSERT INTO `tbl_jual` (`jual_notrans`, `jual_tanggal`, `jual_total`, `jual_jml_uang`, `jual_kembalian`, `jual_user_id`, `jual_keterangan`) VALUES
('TR040722000001', '2022-07-04 21:32:48', 90000, 100000, 10000, 3, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR040722000002', '2022-07-04 21:38:41', 90000, 100000, 10000, 3, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR040722000003', '2022-07-04 21:39:17', 90000, 100000, 10000, 3, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR040722000004', '2022-07-04 21:39:39', 90000, 100000, 10000, 3, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR040722000005', '2022-07-04 21:40:15', 90000, 100000, 10000, 3, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR040722000006', '2022-07-04 21:40:26', 90000, 100000, 10000, 3, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR040722000007', '2022-07-04 21:40:39', 90000, 100000, 10000, 3, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR040722000008', '2022-07-04 21:40:51', 90000, 100000, 10000, 3, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR040722000009', '2022-07-04 21:41:03', 90000, 100000, 10000, 3, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR040722000010', '2022-07-04 21:41:11', 90000, 100000, 10000, 3, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR040722000011', '2022-07-04 21:41:35', 90000, 100000, 10000, 3, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR050722000012', '2022-07-04 22:06:20', 20000, 20000, 0, 3, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR050722000013', '2022-07-04 22:06:32', 80000, 100000, 20000, 3, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR050722000014', '2022-07-04 22:21:05', 550000, 600000, 50000, 1, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.'),
('TR050722000015', '2022-07-04 22:21:48', 275000, 300000, 25000, 1, 'Barang yang sudah dibeli tidak dapat dikembalikan/ditukar.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`kategori_id`, `kategori_nama`) VALUES
(15, 'Lain-lain'),
(16, 'Paku'),
(17, 'Cat'),
(18, 'Semen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan_nama` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`satuan_id`, `satuan_nama`) VALUES
(1, 'Pack'),
(4, 'Pcs'),
(10, 'Dus'),
(11, 'Sak'),
(12, 'Kg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_suplier`
--

CREATE TABLE `tbl_suplier` (
  `suplier_id` int(11) NOT NULL,
  `suplier_nama` varchar(35) DEFAULT NULL,
  `suplier_alamat` varchar(60) DEFAULT NULL,
  `suplier_notelp` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_suplier`
--

INSERT INTO `tbl_suplier` (`suplier_id`, `suplier_nama`, `suplier_alamat`, `suplier_notelp`) VALUES
(7, 'Agus', 'Jl. Bitung Km. 10', '02147483647'),
(8, 'Firman', 'Jl. Raya Curug', '0819222222'),
(9, 'Budi', 'Jl. Raya Cikupa km, 15', '08963242');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(35) DEFAULT NULL,
  `user_username` varchar(30) DEFAULT NULL,
  `user_password` varchar(35) DEFAULT NULL,
  `user_level` varchar(2) DEFAULT NULL,
  `user_status` varchar(2) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_level`, `user_status`) VALUES
(1, 'Sutyos', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '1', '1'),
(3, 'Putri', 'kasir', '827ccb0eea8a706c4c34a16891f84e7b', '2', '1'),
(4, 'Ahmad', 'pemilik', '827ccb0eea8a706c4c34a16891f84e7b', '3', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `barang_user_id` (`barang_user_id`),
  ADD KEY `barang_kategori_id` (`barang_kategori_id`);

--
-- Indeks untuk tabel `tbl_beli`
--
ALTER TABLE `tbl_beli`
  ADD PRIMARY KEY (`beli_notrans`),
  ADD KEY `beli_user_id` (`beli_user_id`),
  ADD KEY `beli_suplier_id` (`beli_suplier_id`);

--
-- Indeks untuk tabel `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  ADD PRIMARY KEY (`d_beli_id`),
  ADD KEY `d_beli_barang_id` (`d_beli_barang_id`),
  ADD KEY `d_beli_nofak` (`d_beli_notrans`);

--
-- Indeks untuk tabel `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  ADD PRIMARY KEY (`d_jual_id`),
  ADD KEY `d_jual_barang_id` (`d_jual_barang_id`),
  ADD KEY `d_jual_nofak` (`d_jual_notrans`);

--
-- Indeks untuk tabel `tbl_jual`
--
ALTER TABLE `tbl_jual`
  ADD PRIMARY KEY (`jual_notrans`),
  ADD KEY `jual_user_id` (`jual_user_id`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indeks untuk tabel `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  MODIFY `d_beli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  MODIFY `d_jual_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
