-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 16, 2023 at 02:56 PM
-- Server version: 8.0.30
-- PHP Version: 8.0.28

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
  `username` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `level` varchar(5) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `nama`, `level`) VALUES
(2, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Ahmad Subadri', 'admin'),
(13, 'poo', '81dc9bdb52d04dc20036dbd8313ed055', 'poo', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_konsultasi`
--

CREATE TABLE `tb_detail_konsultasi` (
  `id_detail_konsultasi` int NOT NULL,
  `id_konsultasi` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `id_gejala` int NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_gabungan`
--

CREATE TABLE `tb_gabungan` (
  `id_gabungan` int NOT NULL,
  `id_penyakit` int NOT NULL,
  `id_gejala` int NOT NULL,
  `cf_rule` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(7, 3, 5, 0.4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_gejala`
--

CREATE TABLE `tb_gejala` (
  `id_gejala` int NOT NULL,
  `kode_gejala` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_gejala` varchar(70) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_gejala`
--

INSERT INTO `tb_gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`) VALUES
(1, 'G01', 'Gejala A'),
(2, 'G02', 'Gejala B'),
(3, 'G03', 'Gejala C'),
(4, 'G04', 'Gejala D'),
(5, 'G05', 'Gejala E');

-- --------------------------------------------------------

--
-- Table structure for table `tb_info`
--

CREATE TABLE `tb_info` (
  `id_info` int NOT NULL,
  `info_header` text COLLATE utf8mb4_general_ci NOT NULL,
  `info_content` text COLLATE utf8mb4_general_ci NOT NULL,
  `author` int NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_konsultasi`
--

CREATE TABLE `tb_konsultasi` (
  `id_konsultasi` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usia` int NOT NULL,
  `jenis_kelamin` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `telp` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_penyakit` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nilai_cf` double NOT NULL,
  `uniq_id` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penyakit`
--

CREATE TABLE `tb_penyakit` (
  `id_penyakit` int NOT NULL,
  `kode_penyakit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_penyakit` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_penyakit`
--

INSERT INTO `tb_penyakit` (`id_penyakit`, `kode_penyakit`, `nama_penyakit`, `keterangan`, `date`) VALUES
(1, 'P01', 'Penyakit X', 'Keterangan penyakit X', '2023-06-07'),
(2, 'P02', 'Penyakit Y', 'Keterangan penyakit Y', '2023-06-07'),
(3, 'P03', 'Penyakit Z', 'Keterangan penyakit Z', '2023-06-07');

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
  MODIFY `id_detail_konsultasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_gabungan`
--
ALTER TABLE `tb_gabungan`
  MODIFY `id_gabungan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_gejala`
--
ALTER TABLE `tb_gejala`
  MODIFY `id_gejala` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_info`
--
ALTER TABLE `tb_info`
  MODIFY `id_info` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_konsultasi`
--
ALTER TABLE `tb_konsultasi`
  MODIFY `id_konsultasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_penyakit`
--
ALTER TABLE `tb_penyakit`
  MODIFY `id_penyakit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
