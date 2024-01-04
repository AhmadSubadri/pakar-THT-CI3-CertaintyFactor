-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 04, 2024 at 12:25 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sp_mario`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(70) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `nama`, `level`) VALUES
(2, 'administrator', '29964386f8a9725756ad7a3987411c4d', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_konsultasi`
--

CREATE TABLE `tb_detail_konsultasi` (
  `id_detail_konsultasi` int NOT NULL,
  `id_konsultasi` varchar(128) NOT NULL,
  `id_gejala` int NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_gabungan`
--

CREATE TABLE `tb_gabungan` (
  `id_gabungan` int NOT NULL,
  `id_penyakit` int NOT NULL,
  `id_gejala` int NOT NULL,
  `cf_rule` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_gabungan`
--

INSERT INTO `tb_gabungan` (`id_gabungan`, `id_penyakit`, `id_gejala`, `cf_rule`) VALUES
(1, 1, 1, 0.8),
(2, 1, 2, 0.6),
(3, 1, 3, 0.4),
(4, 2, 2, 1),
(5, 2, 4, 0.6),
(6, 3, 3, 0.6),
(7, 3, 5, 0.4),
(8, 5, 7, 1),
(9, 5, 8, 1),
(10, 5, 9, 0.8),
(11, 5, 10, 0.8),
(12, 5, 11, 0.8),
(13, 5, 12, 0.8),
(14, 6, 10, 0.8),
(15, 6, 13, 1),
(16, 6, 14, 1),
(17, 6, 15, 0.8),
(18, 6, 7, 1),
(19, 7, 16, 0.8),
(20, 7, 17, 1),
(21, 7, 8, 1),
(22, 7, 18, 1),
(23, 7, 19, 0.8),
(24, 7, 20, 0.8),
(25, 7, 10, 0.8),
(26, 7, 7, 1),
(27, 8, 21, 1),
(28, 8, 22, 0.6),
(29, 8, 23, 1),
(30, 8, 18, 1),
(31, 8, 24, 0.6),
(32, 8, 25, 0.8),
(33, 8, 7, 1),
(34, 9, 26, 1),
(35, 9, 27, 1),
(36, 9, 28, 1),
(37, 9, 10, 0.8),
(38, 9, 29, 0.8),
(39, 9, 30, 0.8),
(40, 9, 7, 1),
(41, 10, 31, 1),
(42, 10, 32, 1),
(43, 10, 33, 1),
(44, 10, 34, 1),
(45, 10, 35, 1),
(46, 10, 36, 0.6),
(47, 10, 10, 0.8),
(48, 10, 7, 1),
(49, 11, 37, 1),
(50, 11, 19, 0.8),
(51, 11, 38, 0.8),
(52, 11, 39, 0.8),
(53, 11, 40, 1),
(54, 11, 21, 1),
(55, 11, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_gejala`
--

CREATE TABLE `tb_gejala` (
  `id_gejala` int NOT NULL,
  `kode_gejala` varchar(50) NOT NULL,
  `nama_gejala` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_gejala`
--

INSERT INTO `tb_gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`) VALUES
(7, 'G1', 'Sakit pada telinga'),
(8, 'G2', 'Nyeri pada telinga'),
(9, 'G3', 'Mengeluarkan cairan berwarna'),
(10, 'G4', 'Pendengaran menurun'),
(11, 'G5', 'Gatal pada telinga'),
(12, 'G6', 'Telinga berdengung'),
(13, 'G7', 'Keluarnya cairan berbau'),
(14, 'G8', 'Mengeluarkan cairan telinga lebih dari 3 bulan'),
(15, 'G9', 'Mengeluarkan cairan terus menerus '),
(16, 'G10', 'Gatal pada daun telinga'),
(17, 'G11', 'Mengeluarkan cairan bening tidak berbau'),
(18, 'G12', 'Telinga terasa penuh'),
(19, 'G13', 'Telinga berdenging'),
(20, 'G14', 'Muncul benjolan kecil didepan telinga '),
(21, 'G15', 'Vertigo atau pusing berputar'),
(22, 'G16', 'Mual dan muntah mendadak'),
(23, 'G17', 'Tuli yang hilang timbul'),
(24, 'G18', 'Kegeliasan '),
(25, 'G19', 'Terdengar suara yang mengganggu didalam telinga'),
(26, 'G20', 'Terdengar bunyi mendengung/bergema'),
(27, 'G21', 'Terdengar bunyi menderu/bunyi keras gemuruh'),
(28, 'G22', 'Terdengar bunyi siulan/kicauan'),
(29, 'G23', 'Hilangnya konsentrasi'),
(30, 'G24', 'Susah tidur dimalam hari'),
(31, 'G25', 'Daun telinga merah'),
(32, 'G26', 'Daun telinga membengkak'),
(33, 'G27', 'Daun telinga terasa nyeri'),
(34, 'G28', 'Daun telinga terasa panas'),
(35, 'G29', 'Daun telinga mengeluarkan nanah'),
(36, 'G30', 'Kepala terasa melayang'),
(37, 'G31', 'Tuli'),
(38, 'G32', 'Kepala pusing'),
(39, 'G33', 'Tubuh tidak seimbang'),
(40, 'G34', 'Kesemutan pada sisi telinga');

-- --------------------------------------------------------

--
-- Table structure for table `tb_info`
--

CREATE TABLE `tb_info` (
  `id_info` int NOT NULL,
  `info_header` text NOT NULL,
  `info_content` text NOT NULL,
  `author` int NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_konsultasi`
--

CREATE TABLE `tb_konsultasi` (
  `id_konsultasi` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `usia` int NOT NULL,
  `jenis_kelamin` varchar(120) NOT NULL,
  `telp` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `nama_penyakit` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `nilai_cf` double NOT NULL,
  `uniq_id` varchar(128) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penyakit`
--

CREATE TABLE `tb_penyakit` (
  `id_penyakit` int NOT NULL,
  `kode_penyakit` varchar(50) NOT NULL,
  `nama_penyakit` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_penyakit`
--

INSERT INTO `tb_penyakit` (`id_penyakit`, `kode_penyakit`, `nama_penyakit`, `keterangan`, `date`) VALUES
(9, 'PO5', 'Tinnitus', 'Penanganannya dapat dilakukan dengan menghindari suara keras, jangan terlalu dalam mengorek-ngorek telinga dengan menggunakan cutton buds. Apabila tidak kunjung sembuh maka segeralah memeriksakan diri kedokter.', '2023-06-20'),
(10, 'PO6', 'Perikondritis', 'Penanganannya dapat dilakukan dengan mengompres telinga, pemberian obat antibiotik/krim antibiotik (dioleskan nke duan telinga yang mengalami infeksi) dan obat tromamisin. Apabila tidak kunjung sembuh maka segeralah memeriksakan diri kedokter.', '2023-06-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_detail_konsultasi`
--
ALTER TABLE `tb_detail_konsultasi`
  ADD PRIMARY KEY (`id_detail_konsultasi`);

--
-- Indexes for table `tb_gabungan`
--
ALTER TABLE `tb_gabungan`
  ADD PRIMARY KEY (`id_gabungan`);

--
-- Indexes for table `tb_gejala`
--
ALTER TABLE `tb_gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `tb_info`
--
ALTER TABLE `tb_info`
  ADD PRIMARY KEY (`id_info`);

--
-- Indexes for table `tb_konsultasi`
--
ALTER TABLE `tb_konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`);

--
-- Indexes for table `tb_penyakit`
--
ALTER TABLE `tb_penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_detail_konsultasi`
--
ALTER TABLE `tb_detail_konsultasi`
  MODIFY `id_detail_konsultasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_gabungan`
--
ALTER TABLE `tb_gabungan`
  MODIFY `id_gabungan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tb_gejala`
--
ALTER TABLE `tb_gejala`
  MODIFY `id_gejala` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tb_info`
--
ALTER TABLE `tb_info`
  MODIFY `id_info` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_konsultasi`
--
ALTER TABLE `tb_konsultasi`
  MODIFY `id_konsultasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_penyakit`
--
ALTER TABLE `tb_penyakit`
  MODIFY `id_penyakit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
