-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2023 at 12:50 AM
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
  `username` varchar(25) NOT NULL,
  `password` varchar(70) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `id_konsultasi` int NOT NULL,
  `id_gejala` int NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_detail_konsultasi`
--

INSERT INTO `tb_detail_konsultasi` (`id_detail_konsultasi`, `id_konsultasi`, `id_gejala`, `nilai`) VALUES
(1, 1, 1, 0.8),
(2, 1, 2, 0.6),
(3, 1, 3, 0.4),
(4, 1, 4, 1),
(5, 1, 5, 0.2),
(6, 2, 1, 0.2),
(7, 2, 2, 0.4),
(8, 2, 3, 0.8),
(9, 2, 4, 0.6),
(10, 2, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_gabungan`
--

CREATE TABLE `tb_gabungan` (
  `id_gabungan` int NOT NULL,
  `id_penyakit` int NOT NULL,
  `id_gejala` int NOT NULL,
  `id_penginput` int NOT NULL,
  `level_penginput` varchar(5) NOT NULL,
  `nilai_mb` double NOT NULL,
  `nilai_md` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_gabungan`
--

INSERT INTO `tb_gabungan` (`id_gabungan`, `id_penyakit`, `id_gejala`, `id_penginput`, `level_penginput`, `nilai_mb`, `nilai_md`) VALUES
(1, 1, 1, 2, 'admin', 0.8, 0.2),
(2, 1, 2, 2, 'admin', 0.6, 0.4),
(3, 1, 3, 2, 'admin', 0.4, 0.6),
(4, 2, 2, 2, 'admin', 1, 0.2),
(5, 2, 4, 2, 'admin', 0.4, 0.4),
(6, 3, 3, 2, 'admin', 0.6, 0.4),
(7, 3, 5, 2, 'admin', 0.8, 0.2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_gejala`
--

CREATE TABLE `tb_gejala` (
  `id_gejala` int NOT NULL,
  `nama_gejala` varchar(70) NOT NULL,
  `id_penginput` int NOT NULL,
  `level_penginput` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_gejala`
--

INSERT INTO `tb_gejala` (`id_gejala`, `nama_gejala`, `id_penginput`, `level_penginput`) VALUES
(1, 'Gejala A', 2, 'admin'),
(2, 'Gejala B', 2, 'admin'),
(3, 'Gejala C', 2, 'admin'),
(4, 'Gejala D', 2, 'admin'),
(5, 'Gejala E', 2, 'admin');

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
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `usia` int NOT NULL,
  `jenis_kelamin` varchar(120) NOT NULL,
  `telp` varchar(50) NOT NULL,
  `alamat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_penyakit` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `nilai_cf` double NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_konsultasi`
--

INSERT INTO `tb_konsultasi` (`id_konsultasi`, `nama`, `usia`, `jenis_kelamin`, `telp`, `alamat`, `nama_penyakit`, `keterangan`, `nilai_cf`, `time`) VALUES
(1, 'Ahmad Subadri', 24, 'Laki-Laki', '081218436055', 'dasdsa fas fsafsa', 'Penyakit X', 'Keterangan penyakit X', 100, '2023-06-07 07:43:31'),
(2, 'Rizqi Oktafiani', 23, 'Laki-Laki', '', 'werwev  werwe ewrew', 'Penyakit X', 'Keterangan penyakit X', 100, '2023-06-07 07:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pakar`
--

CREATE TABLE `tb_pakar` (
  `id_pakar` int NOT NULL,
  `id_admin` int NOT NULL,
  `nama_pakar` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `sip_pakar` varchar(30) NOT NULL,
  `telp_pakar` varchar(15) NOT NULL,
  `level` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_pakar`
--

INSERT INTO `tb_pakar` (`id_pakar`, `id_admin`, `nama_pakar`, `username`, `password`, `sip_pakar`, `telp_pakar`, `level`) VALUES
(8, 2, 'dr. Ahmad Subadri, Sp. A.', 'pakar', '81dc9bdb52d04dc20036dbd8313ed055', '932-481MW', '085732845920', 'pakar'),
(15, 2, 'poo', 'pooh', '81dc9bdb52d04dc20036dbd8313ed055', 'poo', '0232032', 'pakar');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penyakit`
--

CREATE TABLE `tb_penyakit` (
  `id_penyakit` int NOT NULL,
  `nama_penyakit` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `id_penginput` int NOT NULL,
  `level_penginput` varchar(5) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_penyakit`
--

INSERT INTO `tb_penyakit` (`id_penyakit`, `nama_penyakit`, `keterangan`, `id_penginput`, `level_penginput`, `date`) VALUES
(1, 'Penyakit X', 'Keterangan penyakit X', 2, 'admin', '2023-06-07'),
(2, 'Penyakit Y', 'Keterangan penyakit Y', 2, 'admin', '2023-06-07'),
(3, 'Penyakit Z', 'Keterangan penyakit Z', 2, 'admin', '2023-06-07');

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
-- Indexes for table `tb_pakar`
--
ALTER TABLE `tb_pakar`
  ADD PRIMARY KEY (`id_pakar`);

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
  MODIFY `id_detail_konsultasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_gabungan`
--
ALTER TABLE `tb_gabungan`
  MODIFY `id_gabungan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_gejala`
--
ALTER TABLE `tb_gejala`
  MODIFY `id_gejala` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_info`
--
ALTER TABLE `tb_info`
  MODIFY `id_info` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_konsultasi`
--
ALTER TABLE `tb_konsultasi`
  MODIFY `id_konsultasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pakar`
--
ALTER TABLE `tb_pakar`
  MODIFY `id_pakar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_penyakit`
--
ALTER TABLE `tb_penyakit`
  MODIFY `id_penyakit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
