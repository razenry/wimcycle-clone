-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Sep 2024 pada 07.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lomba`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto_tanggapan`
--

CREATE TABLE `foto_tanggapan` (
  `id` int(11) NOT NULL,
  `id_tanggapan` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `foto_tanggapan`
--

INSERT INTO `foto_tanggapan` (`id`, `id_tanggapan`, `foto`) VALUES
(1, 1, 'E:\\xampp\\htdocs\\Lomba-Oscar1.O-2024\\app\\controllers/../../public/storage/images/tanggapan/66dbd52a2435f_avtar_3.png'),
(2, 1, 'E:\\xampp\\htdocs\\Lomba-Oscar1.O-2024\\app\\controllers/../../public/storage/images/tanggapan/66dbd52a24da1_avtar_4.png'),
(3, 1, 'E:\\xampp\\htdocs\\Lomba-Oscar1.O-2024\\app\\controllers/../../public/storage/images/tanggapan/66dbd52a25239_avtar_5.png'),
(4, 2, '66dbd6fd46e23_avtar_3.png'),
(5, 2, '66dbd6fd4bdaa_avtar_4.png'),
(6, 2, '66dbd6fd4c873_avtar_5.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL,
  `nama_kecamatan` varchar(255) NOT NULL,
  `kota_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama_kecamatan`, `kota_id`) VALUES
(1, 'Ciputat', 1),
(2, 'Ciputat Timur', 1),
(3, 'Pondok Aren', 1),
(4, 'Serpong Utara', 1),
(5, 'Setu', 1),
(6, 'Serpong', 1),
(7, 'Pamulang', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id` int(11) NOT NULL,
  `nama_kelurahan` varchar(255) NOT NULL,
  `kecamatan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelurahan`
--

INSERT INTO `kelurahan` (`id`, `nama_kelurahan`, `kecamatan_id`) VALUES
(1, 'Cipayung', 1),
(2, 'Ciputat', 1),
(3, 'Jombang', 1),
(4, 'Sawah Baru', 1),
(5, 'Sawah Lama', 1),
(6, 'Serua', 1),
(7, 'Serua Indah', 1),
(8, 'Cempaka Putih', 2),
(9, 'Cireundeu', 2),
(10, 'Pisangan', 2),
(11, 'Pondok Ranji', 2),
(12, 'Rempoa', 2),
(13, 'Rengas', 2),
(14, 'Jurangmangu Barat', 3),
(15, 'Jurangmangu Timur', 3),
(16, 'Pondok Kacang Barat', 3),
(17, 'Pondok Kacang Timur', 3),
(18, 'Perigi Lama', 3),
(19, 'Perigi Baru', 3),
(20, 'Pondok Aren', 3),
(21, 'Pondok Karya', 3),
(22, 'Pondok Jaya', 3),
(23, 'Pondok Betung', 3),
(24, 'Pondok Pucung', 3),
(25, 'Jelupang', 4),
(26, 'Lengkong Karya', 4),
(27, 'Pakualam', 4),
(28, 'Pakulonan', 4),
(29, 'Paku Jaya', 4),
(30, 'Pondok Jagung', 4),
(31, 'Pondok Jagung Timur', 4),
(32, 'Babakan', 5),
(33, 'Bakti Jaya', 5),
(34, 'Kedemangan', 5),
(35, 'Keranggan', 5),
(36, 'Muncul Setu', 5),
(37, 'Buaran', 6),
(38, 'Ciater', 6),
(39, 'Cilenggang', 6),
(40, 'Lengkong Gudang', 6),
(41, 'Lengkong Gudang Timur', 6),
(42, 'Lengkong Wetan', 6),
(43, 'Rawa Buntu', 6),
(44, 'Rawa Mekar Jaya', 6),
(45, 'Serpong', 6),
(46, 'Bambu Apus', 7),
(47, 'Benda Baru', 7),
(48, 'Kedaung', 7),
(49, 'Pamulang Barat', 7),
(50, 'Pamulang Timur', 7),
(51, 'Pondok Benda', 7),
(52, 'Pondok Cabe Ilir', 7),
(53, 'Pondok Cabe Udik', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `id` int(11) NOT NULL,
  `nama_kota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`id`, `nama_kota`) VALUES
(1, 'Tangerang Selatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `slug` varchar(300) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi_laporan` text NOT NULL,
  `jenis_laporan` enum('rahasia','anonim','publik') NOT NULL,
  `status` enum('Menunggu tanggapan','Diverifikasi','Dalam tindakan','Tuntas','Ditolak') DEFAULT 'Menunggu tanggapan',
  `tgl_laporan` date NOT NULL,
  `jam_lapor` time NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `tgl_edit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `alasan` text NOT NULL,
  `status` enum('Tolak','Kembalikan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `foto`, `email`, `password`, `telp`, `status`) VALUES
(7, 'Fatir Zaidan', 'user-1725547359_47ddbebe8f.png', 'fatirzaidan@gmail.com', '$2y$10$ilRiku45hvztAoqaM3fEnub9CcQwOqX0RfG8PD4k2GrYYMLZX9N3u', '08123456789', '1'),
(8, 'Abdul Jabbar', 'user-1725547385_972edf2c70.png', 'arewegoto@gmail.com', '$2y$10$6DGefU0lxVCbRmBG2A8yceBZwxSr7coyPxZ2uzFn9Huhvvuv.7oGe', '085161772073', '1'),
(12, 'TestAkun', 'user-1725547398_1016b75ec0.png', 'test@gmail.com', '$2y$10$jD1ksWtYQypKYarG.HNqZe/n.ek38.QYYUQdhhcITwsz21/sVnJLm', '', '1'),
(13, 'Test2', 'user-1725547412_cfe26d16d6.png', 'kafkariela120@gmail.com', '$2y$10$9V6MyjZ7v.3LPjtIwnUMW.Erdf5HTCNf8brRms4DB8NGh/2RKPM4u', '08123456789', '1'),
(17, 'Fandi Saktianto', 'user-1725611319_7e78633e78.png', 'fandi.code@gmail.com', '$2y$10$OZ4jQOBZvWtPvfveyHwW6e4Gj9cpdPlFlTQoOw9a/MNEsG/XAq5Rm', '085161772073', '1'),
(18, 'Ray.jsx', 'user-1725675743_81f0b8b3ad.png', 'test.ray@gmail.com', '$2y$10$Tp0yP1Bjc9KRxt2ihhisnehx6l/.ujoxqsXxCNx.jUwVJQOHrRx6y', '085161772073', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `level` enum('Admin','Petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id`, `nama`, `foto`, `email`, `password`, `telp`, `status`, `level`) VALUES
(4, 'Kafkariela Prima Rasendriya', 'user-1725112221_7ae9d24875.png', 'kafkariela150@gmail.com', '$2y$10$FZTic0tXnu6W29YycmgPlON40k6GJJNhPIEFbBE6KUCcerK9JdrIi', '085161772073', '1', 'Admin'),
(5, 'Edo Priyatna', 'user-1725112209_3a0894e977.png', 'edopriyatna@gmail.com', '$2y$10$SfEH3NpnQIYtZ0XfcEHTA.hx69jESCgUouj/uam1Pem6wWBHj1Tbq', '', '1', 'Petugas'),
(6, 'Abdul Jabbar', 'user-1725679000_2f56707f2c.png', 'douzxy@gmail.com', '$2y$10$VIy2FqEac8tU09DXcctBne27WFrH1dWiX6heEDM5Uu5fbMT3WVIye', '085161772073', '1', 'Petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `tanggapan` text NOT NULL,
  `status` enum('Dalam tindakan','Tuntas') NOT NULL,
  `tgl_tanggapan` date NOT NULL,
  `jam_tanggapan` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tanggapan`
--

INSERT INTO `tanggapan` (`id`, `id_laporan`, `id_petugas`, `tanggapan`, `status`, `tgl_tanggapan`, `jam_tanggapan`) VALUES
(1, 11, 6, 'nanana', 'Tuntas', '2024-09-07', '11:23:06'),
(2, 11, 6, 'asss', 'Tuntas', '2024-09-07', '11:30:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_laporan` (`id_laporan`);

--
-- Indeks untuk tabel `foto_tanggapan`
--
ALTER TABLE `foto_tanggapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tanggapan` (`id_tanggapan`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kota_id` (`kota_id`);

--
-- Indeks untuk tabel `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`);

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengguna` (`id_pengguna`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_laporan` (`id_laporan`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_laporan` (`id_laporan`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `foto_tanggapan`
--
ALTER TABLE `foto_tanggapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `kota`
--
ALTER TABLE `kota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `foto_tanggapan`
--
ALTER TABLE `foto_tanggapan`
  ADD CONSTRAINT `foto_tanggapan_ibfk_1` FOREIGN KEY (`id_tanggapan`) REFERENCES `tanggapan` (`id`);

--
-- Ketidakleluasaan untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD CONSTRAINT `kecamatan_ibfk_1` FOREIGN KEY (`kota_id`) REFERENCES `kota` (`id`);

--
-- Ketidakleluasaan untuk tabel `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD CONSTRAINT `kelurahan_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`);

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`);

--
-- Ketidakleluasaan untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ibfk_2` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_ibfk_1` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id`),
  ADD CONSTRAINT `tanggapan_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
