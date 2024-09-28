-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 04:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` varchar(10) NOT NULL,
  `nm_barang` varchar(100) NOT NULL,
  `satuan` enum('kg','pcs') NOT NULL DEFAULT 'kg',
  `harga` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nm_barang`, `satuan`, `harga`) VALUES
('BEDCOVBSR', 'Bedcover besar', 'kg', 12000),
('BEDCOVKCL', 'Bedcover kecil', 'kg', 10000),
('BEDDING', 'Bantal, guling', 'pcs', 30000),
('BONEKABSR', 'Boneka besar', 'pcs', 25000),
('BONEKAKCL', 'Boneka kecil', 'pcs', 15000),
('BONEKASDG', 'Boneka sedang', 'pcs', 20000),
('CELANAJAS', 'Celana Jas', 'pcs', 30000),
('JAS', 'Jas', 'pcs', 50000),
('JAS1SET', 'Jas satu set', 'pcs', 100000),
('PAKAIAN', 'Pakaian sehari-hari', 'kg', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `kd_layanan` char(3) NOT NULL,
  `nm_layanan` varchar(100) NOT NULL,
  `multiplier_harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`kd_layanan`, `nm_layanan`, `multiplier_harga`) VALUES
('CAJ', 'Cuci Saja', 1.00),
('DRY', 'Dry Cleaning', 2.50),
('EXP', 'Express', 1.75),
('STD', 'Standard', 1.20);

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan`
--

CREATE TABLE `penerimaan` (
  `no_nota` int(7) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `kd_layanan` char(3) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `keterangan` enum('Diproses','Selesai') NOT NULL DEFAULT 'Diproses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerimaan`
--

INSERT INTO `penerimaan` (`no_nota`, `tgl_masuk`, `nm_pelanggan`, `alamat`, `no_telp`, `kd_barang`, `kd_layanan`, `jumlah`, `keterangan`) VALUES
(10, '2024-01-03', 'Andi', 'Jl. ABC no. 123', '08123456789', 'PAKAIAN', 'STD', 2.50, 'Selesai'),
(11, '0000-00-00', 'Dinda', 'Jl. DEF no. 456', '08987654321', 'JAS1SET', 'DRY', 1.00, 'Diproses'),
(12, '0000-00-00', 'Tuti', 'Jl. GHI no. 789', '08111222333', 'BEDCOVBSR', 'EXP', 3.75, 'Diproses');

-- --------------------------------------------------------

--
-- Table structure for table `pengambilan`
--

CREATE TABLE `pengambilan` (
  `no_pengambilan` int(7) NOT NULL,
  `no_nota` char(7) NOT NULL,
  `tgl_ambil` date NOT NULL,
  `total` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengambilan`
--

INSERT INTO `pengambilan` (`no_pengambilan`, `no_nota`, `tgl_ambil`, `total`) VALUES
(6, '10', '0000-00-00', 15000);

--
-- Triggers `pengambilan`
--
DELIMITER $$
CREATE TRIGGER `status_change` AFTER INSERT ON `pengambilan` FOR EACH ROW UPDATE penerimaan SET keterangan = 2 WHERE no_nota = NEW.no_nota
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`kd_layanan`);

--
-- Indexes for table `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD PRIMARY KEY (`no_nota`);

--
-- Indexes for table `pengambilan`
--
ALTER TABLE `pengambilan`
  ADD PRIMARY KEY (`no_pengambilan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penerimaan`
--
ALTER TABLE `penerimaan`
  MODIFY `no_nota` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengambilan`
--
ALTER TABLE `pengambilan`
  MODIFY `no_pengambilan` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
