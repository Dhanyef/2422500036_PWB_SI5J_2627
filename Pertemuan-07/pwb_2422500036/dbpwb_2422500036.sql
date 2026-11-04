-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 04, 2026 at 11:16 AM
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
-- Database: `dbpwb_2422500036`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id_admin` int NOT NULL,
  `full_name` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id_admin`, `full_name`, `username`, `password`) VALUES
(1, 'dhany', 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `ekspedisi`
--

CREATE TABLE `ekspedisi` (
  `id_ekspedisi036` int NOT NULL,
  `nama_ekspedisi036` varchar(11) NOT NULL,
  `jenis_layanan036` varchar(30) NOT NULL,
  `tarif_perkg036` varchar(10) NOT NULL,
  `status036` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`, `deskripsi`) VALUES
(1, 'Buku', 'Dandadan Volume 1'),
(5, 'Komik', 'Wistoria Volume 2'),
(6, 'Buku', 'Wistoria Volume 3');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text,
  `id_kategori` int NOT NULL,
  `harga` int NOT NULL,
  `stok` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `deskripsi`, `id_kategori`, `harga`, `stok`) VALUES
(1, 'DanDaDan Volume 1', 'Buku komik Dandadan', 1, 65000, 100);

-- --------------------------------------------------------

--
-- Table structure for table `produk_gambar`
--

CREATE TABLE `produk_gambar` (
  `id_gambar` int NOT NULL,
  `nama_gambar` varchar(100) DEFAULT NULL,
  `id_produk` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ekspedisi`
--
ALTER TABLE `ekspedisi`
  ADD PRIMARY KEY (`id_ekspedisi036`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `produk_gambar`
--
ALTER TABLE `produk_gambar`
  ADD PRIMARY KEY (`id_gambar`),
  ADD KEY `produk_id` (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ekspedisi`
--
ALTER TABLE `ekspedisi`
  MODIFY `id_ekspedisi036` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk_gambar`
--
ALTER TABLE `produk_gambar`
  ADD CONSTRAINT `produk_gambar_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
