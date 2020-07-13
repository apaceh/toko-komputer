-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2019 at 04:14 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_komputer`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` varchar(3) NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `spek_barang` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `stock` int(5) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `spek_barang`, `gambar`, `stock`, `harga`) VALUES
('A_1', 'Asus ROG STRIX ', '- Intel Kaby Lake 7th Core i7 7700HQ 2.8GHz up to 3.8GHz (6MB Cache)\r\n- 8GB RAM DDR4 (Max. 32GB)', 'rog.jpg', 10, 14450000),
('L_1', 'Lenovo 320-14ISK', 'Prosesor: Core i3 6006U, Penyimpanan: 1 TB HDD, RAM: 4 GB, Ukuran Layar: 14 inch', '5d39d8bf4c630.png', 12, 5300000),
('M_1', 'Macbook pro', '-Processor i7 2.9ghz\r\n-Memory 8GB ddr3 1600Mhz\r\n-HDD 50pGB\r\n-VGA intel HD Graphics 4000 1536MB\r\n-Lay', '5d39cba7a1817.jpg', 0, 9550000),
('W_1', 'Alienware 14', 'i7 4700MQ 1TB+256GB SSD 16GB RAM GTX 765', '5d39cd8961a72.jpg', 10, 8250000);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `username`, `password`, `alamat`, `no_hp`) VALUES
(1, 'Alfi', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'test', '123456789012'),
(2, 'Syahri', 'syahri@gmail.com', '30e20e74dadfe75bd52704159e048309', 'passwordnya syahri', '123456789012'),
(3, 'risol', 'risol@gmail.com', '6846e55b7fbbc3949ea47a340a082486', 'cipiyoh', '091234567890');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `kd_barang` varchar(3) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`kd_barang`, `id_customer`, `nama_barang`, `jumlah`) VALUES
('L_1', 2, 'Lenovo 320-14ISK', 3),
('W_1', 2, 'Alienware 14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `username`, `password`, `nama`, `alamat`, `no_hp`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Alfi Syahri', 'utg', '082363808853');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kd_barang` varchar(3) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(25) NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `status` enum('Dipesan','Dikirim','Selesai') NOT NULL,
  `jumlah` int(5) NOT NULL,
  `total` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kd_barang`, `id_customer`, `nama_customer`, `nama_barang`, `status`, `jumlah`, `total`) VALUES
(3, 'A_1', 2, 'Syahri', 'Asus ROG', 'Dikirim', 2, 30000000),
(5, 'L_1', 2, 'Syahri', 'Lenovo IdeaPad 320-14ISK', 'Dipesan', 2, 10600000),
(6, 'L_1', 2, 'Syahri', 'Lenovo 320-14ISK', 'Dipesan', 1, 5300000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
