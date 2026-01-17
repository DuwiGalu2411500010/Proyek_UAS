-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2026 at 01:09 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasirmini`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'galu', 'e10adc3949ba59abbe56e057f20f883e', 'duwi galu'),
(2, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `stok`, `kategori`) VALUES
(1, 'pensil', '2000.00', 92, 'atk'),
(2, 'buku', '5000.00', 82, 'atk'),
(3, 'penghapus', '1000.00', 98, 'ATK'),
(5, 'sikat baju', '3000.00', 18, 'AR'),
(6, 'taro', '1000.00', 7, 'chiki'),
(7, 'coklatos', '500.00', 8, 'chiki'),
(8, 'sapu lidi', '8000.00', 6, 'AR'),
(9, 'sapu lantai', '13000.00', 3, 'AR'),
(10, 'Hangger', '12000.00', 6, 'AR'),
(11, 'sandal dymatu', '12000.00', 4, 'AR'),
(14, 'sandal dm', '13000.00', 5, 'AK'),
(15, 'hp', '2000000.00', 2, 'Android');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `tanggal` datetime NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `kasir` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal`, `total_harga`, `kasir`) VALUES
(10, '2026-01-17 12:07:29', '48000.00', 'Admin'),
(11, '2026-01-17 12:07:51', '70000.00', 'Admin'),
(12, '2026-01-17 12:08:22', '6000.00', 'Admin'),
(13, '2026-01-17 12:09:05', '21000.00', 'Admin'),
(14, '2026-01-17 12:47:37', '4000.00', 'galu'),
(15, '2026-01-17 12:47:41', '4000.00', 'galu'),
(16, '2026-01-17 12:47:43', '4000.00', 'galu'),
(17, '2026-01-17 12:47:44', '4000.00', 'galu'),
(18, '2026-01-17 12:47:44', '4000.00', 'galu'),
(19, '2026-01-17 12:47:44', '4000.00', 'galu'),
(20, '2026-01-17 12:47:45', '4000.00', 'galu'),
(21, '2026-01-17 12:47:45', '4000.00', 'galu'),
(22, '2026-01-17 12:47:45', '4000.00', 'galu'),
(23, '2026-01-17 12:58:13', '4000.00', 'galu'),
(24, '2026-01-17 12:58:19', '4000.00', 'galu'),
(25, '2026-01-17 12:58:19', '4000.00', 'galu'),
(26, '2026-01-17 12:58:19', '4000.00', 'galu'),
(27, '2026-01-17 12:58:19', '4000.00', 'galu'),
(28, '2026-01-17 12:58:19', '4000.00', 'galu'),
(29, '2026-01-17 12:58:20', '4000.00', 'galu'),
(30, '2026-01-17 12:58:20', '4000.00', 'galu'),
(31, '2026-01-17 12:58:20', '4000.00', 'galu'),
(32, '2026-01-17 12:58:20', '4000.00', 'galu'),
(33, '2026-01-17 12:58:20', '4000.00', 'galu'),
(34, '2026-01-17 12:58:21', '4000.00', 'galu'),
(35, '2026-01-17 12:58:21', '4000.00', 'galu'),
(36, '2026-01-17 12:58:21', '4000.00', 'galu'),
(37, '2026-01-17 12:58:21', '4000.00', 'galu'),
(38, '2026-01-17 12:58:25', '4000.00', 'galu'),
(39, '2026-01-17 12:58:25', '4000.00', 'galu'),
(40, '2026-01-17 12:58:25', '4000.00', 'galu'),
(41, '2026-01-17 12:58:25', '4000.00', 'galu'),
(42, '2026-01-17 12:59:16', '10000.00', 'galu'),
(43, '2026-01-17 12:59:20', '10000.00', 'galu'),
(44, '2026-01-17 13:00:40', '4000.00', 'galu'),
(45, '2026-01-17 13:00:45', '4000.00', 'galu'),
(46, '2026-01-17 13:02:24', '4000.00', 'galu'),
(47, '2026-01-17 13:07:01', '4000.00', 'galu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `id_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `id_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
