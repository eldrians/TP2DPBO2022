-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 10:06 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpcrud`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidang_divisi`
--

CREATE TABLE `bidang_divisi` (
  `id_bidang` int(11) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `id_divisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidang_divisi`
--

INSERT INTO `bidang_divisi` (`id_bidang`, `jabatan`, `id_divisi`) VALUES
(2, 'Ketua Biro Politik', 6),
(4, 'Ketua Biro Advokasi', 6),
(6, 'Ketua Biro Sosial', 6),
(20, 'Ketua Divisi', 7),
(21, 'Ketua Divisi', 8),
(22, 'Ketua Divisi', 10),
(24, 'Ketua Divisi', 6),
(27, 'Biro Olahraga', 7),
(28, 'Biro Kesenian', 7),
(29, 'Biro Digital', 7),
(30, 'Ketua Biro Pemasaran', 10),
(31, 'Ketua Biro Manajemen Produksi', 10),
(32, 'Ketua Biro MSDM', 8),
(33, 'Ketua Biro Litbang', 8),
(38, 'Ketua Divisi', 14);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(6, 'DIVADSOSPOL'),
(7, 'DPMB'),
(8, 'DPO'),
(10, 'EKOBIS'),
(14, 'DIVDIKLAT');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `nim` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `semester` int(11) NOT NULL,
  `foto` longblob NOT NULL,
  `id_bidang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`nim`, `nama`, `semester`, `foto`, `id_bidang`) VALUES
('2000145', 'Yayan Alghofari', 2, 0x316c2e6a706567, 24),
('2000352', 'Axel Eldrian Hadiwibowo', 4, 0x6178656c2e6a7067, 2),
('2000516', 'Rudi Hambali', 2, 0x346c2e6a706567, 21),
('2000589', 'Asep Hidayat', 7, 0x326c2e6a706567, 27),
('2000635', 'Varih Rizki Islam', 6, 0x33632e6a706567, 22),
('522014', 'Gumi', 4, 0x336c2e6a706567, 31);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidang_divisi`
--
ALTER TABLE `bidang_divisi`
  ADD PRIMARY KEY (`id_bidang`),
  ADD KEY `di_divisi` (`id_divisi`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_bidang` (`id_bidang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidang_divisi`
--
ALTER TABLE `bidang_divisi`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidang_divisi`
--
ALTER TABLE `bidang_divisi`
  ADD CONSTRAINT `di_divisi` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD CONSTRAINT `id_bidang` FOREIGN KEY (`id_bidang`) REFERENCES `bidang_divisi` (`id_bidang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
