-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 01:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes`
--

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE `beli` (
  `id_beli` int(11) NOT NULL,
  `tgl_beli` date NOT NULL,
  `jml_beli` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beli`
--

INSERT INTO `beli` (`id_beli`, `tgl_beli`, `jml_beli`, `id_obat`, `id_pembeli`, `id_pegawai`) VALUES
(1, '2023-02-15', 4, 4, 3, 10),
(2, '2023-04-03', 5, 3, 4, 9),
(3, '2023-06-18', 2, 2, 1, 8),
(4, '2023-08-07', 7, 5, 5, 7),
(5, '2023-09-22', 2, 8, 7, 6),
(6, '2023-10-12', 8, 6, 8, 5),
(8, '2023-03-09', 2, 11, 2, 3),
(9, '2023-05-06', 7, 9, 6, 10),
(10, '2023-10-30', 4, 9, 10, 1),
(39, '2023-11-24', 1, 9, 11, 1),
(40, '2023-11-24', 1, 9, 11, 1),
(41, '2023-11-24', 1, 9, 11, 1),
(42, '2023-11-24', 5, 9, 11, 10),
(43, '2023-11-24', 1, 9, 11, 1),
(44, '2023-11-24', 3, 9, 3, 1),
(45, '2023-11-24', 2, 10, 12, 10);

--
-- Triggers `beli`
--
DELIMITER $$
CREATE TRIGGER `update_stok_obat` AFTER INSERT ON `beli` FOR EACH ROW BEGIN
    DECLARE obat_id INT;
    DECLARE jml_beli_obat INT;

    SELECT id_obat, jml_beli INTO obat_id, jml_beli_obat
    FROM beli
    WHERE id_beli = NEW.id_beli;

    UPDATE obat
    SET stok_obat = stok_obat - jml_beli_obat
    WHERE id_obat = obat_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(30) DEFAULT NULL,
  `harga_obat` int(11) DEFAULT NULL,
  `stok_obat` int(11) DEFAULT NULL,
  `jenis_obat` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `harga_obat`, `stok_obat`, `jenis_obat`) VALUES
(2, 'Inpepsa', 124500, 42, 'obat keras'),
(3, 'Rhinos SR', 110000, 17, 'obat keras'),
(4, 'Paracetamol', 5200, 93, 'obat bebas'),
(5, 'Asam Mefenamat', 6400, 5, 'obat keras'),
(6, 'Pharma Fix', 50500, 68, 'obat keras'),
(7, 'Fluzep', 23500, 29, 'obat bebas terbatas'),
(8, 'Dextaf', 3500, 12, 'obat keras'),
(9, 'OBH Combi', 23800, 169, 'obat bebas terbatas'),
(10, 'Amoxicillin', 13100, 54, 'obat keras'),
(11, 'Sertraline', 60000, 3, 'obat keras');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(30) DEFAULT NULL,
  `no_telp` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `no_telp`) VALUES
(1, 'Adit', '6281234567890'),
(2, 'Diva', '6282345678901'),
(3, 'Fara', '6283456789012'),
(4, 'Haris', '6284567890123'),
(5, 'Haqim', '6285678901234'),
(6, 'Meri', '6286789012345'),
(7, 'Herlia', '6287890123456'),
(8, 'Radia', '6288901234567'),
(9, 'Ikram', '6289012345678'),
(10, 'Bunga', '6280123456789');

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `nama_pembeli` varchar(30) DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `no_telp` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama_pembeli`, `alamat`, `no_telp`) VALUES
(1, 'Rama', 'Palembang', '628111222333'),
(2, 'Retno', 'Lampung', '628444555666'),
(3, 'Nabila', 'Bengkulu', '628777888999'),
(4, 'Adrian', 'Palembang', '628123496578'),
(5, 'Aida', 'Jambi', '628987654321'),
(6, 'Heru', 'Sulawesi', '628555123456'),
(7, 'Nadiya', 'Palembang', '628111000222'),
(8, 'Vella', 'Bekasi', '628333444555'),
(9, 'Evan', 'Banyuasin', '628666777888'),
(10, 'Ferdi', 'Batam', '628999888777'),
(11, 'Agi', 'Universe', '6281273837529'),
(12, 'Ade Iriani', 'Jakabaring', '123');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(30) DEFAULT NULL,
  `no_telp` varchar(30) DEFAULT NULL,
  `alamat_supplier` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_telp`, `alamat_supplier`) VALUES
(1, 'Pfizer', '622180861400', 'Jakarta'),
(2, 'Johnson & Johnson', '622179182103', 'Jakarta'),
(3, 'AstraZeneca', '62711376559', 'Palembang'),
(4, 'Kimia Farma', '62711445984', 'Palembang'),
(5, 'Kalbe', '62214287388889', 'Palembang'),
(6, 'Dexa Medica', '62217454111', 'Tanggerang'),
(7, 'Biofarma', '62222033755', 'Surabaya'),
(8, 'Sanbe', '62224207725', 'Bandung'),
(9, 'Lapi', '622122668888', 'Jakarta'),
(10, 'Novartis', '622130014225', 'Yogyakarta'),
(14, 'Kamu', 'dari matamu', 'turun ke hatiku');

-- --------------------------------------------------------

--
-- Table structure for table `supply`
--

CREATE TABLE `supply` (
  `id_pengiriman` int(11) NOT NULL,
  `tgl_pengiriman` date NOT NULL,
  `jumlah_obat` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supply`
--

INSERT INTO `supply` (`id_pengiriman`, `tgl_pengiriman`, `jumlah_obat`, `id_supplier`, `id_obat`) VALUES
(1, '2023-11-20', 12, 5, 8),
(2, '2023-11-20', 37, 2, 4),
(4, '2023-11-20', 8, 8, 2),
(5, '2023-11-20', 41, 10, 5),
(7, '2023-11-20', 30, 3, 11),
(8, '2023-11-20', 5, 7, 3),
(9, '2023-11-20', 14, 4, 9),
(10, '2023-11-20', 32, 6, 6),
(17, '2023-11-24', 100, 7, 9);

--
-- Triggers `supply`
--
DELIMITER $$
CREATE TRIGGER `update_stok_supply` AFTER INSERT ON `supply` FOR EACH ROW BEGIN
    DECLARE obat_id_supply INT;
    DECLARE jml_obat_supply INT;

    SELECT id_obat, jumlah_obat INTO obat_id_supply, jml_obat_supply
    FROM supply
    WHERE id_pengiriman = NEW.id_pengiriman;

    UPDATE obat
    SET stok_obat = stok_obat + jml_obat_supply
    WHERE id_obat = obat_id_supply;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beli`
--
ALTER TABLE `beli`
  ADD PRIMARY KEY (`id_beli`),
  ADD KEY `fk_beli_obat` (`id_obat`),
  ADD KEY `fk_beli_pembeli` (`id_pembeli`),
  ADD KEY `fk_beli_pegawai` (`id_pegawai`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `supply`
--
ALTER TABLE `supply`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `fk_supply_supplier` (`id_supplier`),
  ADD KEY `fk_supply_obat` (`id_obat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beli`
--
ALTER TABLE `beli`
  MODIFY `id_beli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `supply`
--
ALTER TABLE `supply`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beli`
--
ALTER TABLE `beli`
  ADD CONSTRAINT `fk_beli_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_beli_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_beli_pembeli` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supply`
--
ALTER TABLE `supply`
  ADD CONSTRAINT `fk_supply_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_supply_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
