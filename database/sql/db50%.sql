-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2024 at 11:17 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.2.0

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
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL,
  `nama_kecamatan` varchar(255) NOT NULL,
  `kota_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kecamatan`
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
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id` int(11) NOT NULL,
  `nama_kelurahan` varchar(255) NOT NULL,
  `kecamatan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelurahan`
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
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id` int(11) NOT NULL,
  `nama_kota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id`, `nama_kota`) VALUES
(1, 'Tangerang Selatan');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `isi_laporan` text NOT NULL,
  `foto` int(11) NOT NULL,
  `jenis_laporan` enum('rahasia','anonim') NOT NULL,
  `status` enum('Menunggu Tanggapan','Diverifikasi','Dalam tindakan','Tuntas','Ditolak') NOT NULL,
  `tgl_laporan` date NOT NULL,
  `jam_lapor` time NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kelurahan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `id_pengguna`, `isi_laporan`, `foto`, `jenis_laporan`, `status`, `tgl_laporan`, `jam_lapor`, `kecamatan`, `kelurahan`) VALUES
(1, 8, 'Pada tanggal 15 Agustus 2024, sekitar pukul 14:30 WIB, saya melihat tumpukan sampah yang menumpuk di sekitar Jalan Melati, tepatnya di dekat pintu masuk pasar tradisional. Kondisi ini sudah berlangsung selama beberapa hari dan mengakibatkan bau tidak sedap serta mengganggu pejalan kaki. Saya khawatir jika tidak segera ditangani, sampah tersebut dapat menyebabkan masalah kesehatan bagi warga sekitar. Saya berharap pihak berwenang dapat segera membersihkan area tersebut dan mengambil tindakan untuk mencegah kejadian serupa di masa mendatang.', 0, 'anonim', 'Menunggu Tanggapan', '2024-08-31', '19:16:19', 'Serpong ', 'Buaran'),
(2, 12, 'Test Admin Untuk Laporan', 0, 'rahasia', 'Menunggu Tanggapan', '2024-08-31', '00:59:47', 'Serpong ', 'Buaran');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `alasan` text NOT NULL,
  `status` enum('Tolak','Kembalikan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `foto`, `email`, `password`, `telp`, `status`) VALUES
(7, 'Fatir Zaidan', 'user-1725112067_0541cfe157.png', 'fatirzaidan@gmail.com', '$2y$10$ilRiku45hvztAoqaM3fEnub9CcQwOqX0RfG8PD4k2GrYYMLZX9N3u', '08123456789', '1'),
(8, 'Abdul Jabbar', 'user-1725183000_411f58b21a.png', 'arewegoto@gmail.com', '$2y$10$6DGefU0lxVCbRmBG2A8yceBZwxSr7coyPxZ2uzFn9Huhvvuv.7oGe', '085161772073', '1'),
(12, 'TestAkun', 'user-1725113485_a76b1da09b.png', 'test@gmail.com', '$2y$10$jD1ksWtYQypKYarG.HNqZe/n.ek38.QYYUQdhhcITwsz21/sVnJLm', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama`, `foto`, `email`, `password`, `telp`, `status`, `level`) VALUES
(4, 'Kafkariela Prima Rasendriya', 'user-1725112221_7ae9d24875.png', 'kafkariela150@gmail.com', '$2y$10$FZTic0tXnu6W29YycmgPlON40k6GJJNhPIEFbBE6KUCcerK9JdrIi', '085161772073', '1', 'Admin'),
(5, 'Edo Priyatna', 'user-1725112209_3a0894e977.png', 'edopriyatna@gmail.com', '$2y$10$SfEH3NpnQIYtZ0XfcEHTA.hx69jESCgUouj/uam1Pem6wWBHj1Tbq', '', '1', 'Petugas'),
(6, 'Abdul Jabbars', 'user-1725112194_392485ab97.png', 'douzxy@gmail.com', '$2y$10$YcvaUulvuv9dNWaVx/X9teqWGZ/64O7Mv5CxSZRh4LXkA1.7WeaRq', '', '1', 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_laporan` (`id_laporan`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kota_id` (`kota_id`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengguna` (`id_pengguna`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_laporan` (`id_laporan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD CONSTRAINT `kecamatan_ibfk_1` FOREIGN KEY (`kota_id`) REFERENCES `kota` (`id`);

--
-- Constraints for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD CONSTRAINT `kelurahan_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`);

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`);

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ibfk_2` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
