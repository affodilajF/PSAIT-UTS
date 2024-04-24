-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 03:24 PM
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
-- Database: `sait_db_uts`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `alamat` varchar(40) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL, 
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `alamat`, `tanggal_lahir`) VALUES
('sv_001', 'joko', 'bantul', '1999-12-07'),
('sv_002', 'paul', 'sleman', '2000-10-07'),
('sv_003', 'andy', 'surabaya', '2000-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(30) DEFAULT NULL,
  `sks` int(2) DEFAULT NULL, 
  PRIMARY KEY (`kode_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`kode_mk`, `nama_mk`, `sks`) VALUES
('svpl_001', 'database', 2),
('svpl_002', 'kecerdasan artifisial', 2),
('svpl_003', 'interoperabilitas', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `nilai_mahasiswa`
-- (See below for the actual view)
--
CREATE TABLE `nilai_mahasiswa` (
`id_perkuliahan` int(5)
,`nim` varchar(10)
,`nama` varchar(20)
,`alamat` varchar(40)
,`tanggal_lahir` date
,`kode_mk` varchar(10)
,`nama_mk` varchar(30)
,`sks` int(2)
,`nilai` double
);

-- --------------------------------------------------------

--
-- Table structure for table `perkuliahan`
--

CREATE TABLE `perkuliahan` (
  `id_perkuliahan` INT(5) NOT NULL AUTO_INCREMENT,
  `nim` VARCHAR(10) DEFAULT NULL,
  `kode_mk` VARCHAR(10) DEFAULT NULL,
  `nilai` DOUBLE DEFAULT NULL,
  PRIMARY KEY (`id_perkuliahan`),
  CONSTRAINT `fk_perkuliahan_mahasiswa` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`),
  CONSTRAINT `fk_perkuliahan_matakuliah` FOREIGN KEY (`kode_mk`) REFERENCES `matakuliah` (`kode_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



--
-- Dumping data for table `perkuliahan`
--

INSERT INTO `perkuliahan` (`id_perkuliahan`, `nim`, `kode_mk`, `nilai`) VALUES
(1, 'sv_001', 'svpl_001', 90),
(2, 'sv_001', 'svpl_002', 87),
(3, 'sv_001', 'svpl_003', 88),
(4, 'sv_002', 'svpl_001', 98),
(5, 'sv_002', 'svpl_002', 77);

-- --------------------------------------------------------

--
-- Structure for view `nilai_mahasiswa`
--
DROP TABLE IF EXISTS `nilai_mahasiswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nilai_mahasiswa`  AS SELECT `perkuliahan`.`id_perkuliahan` AS `id_perkuliahan`, `mahasiswa`.`nim` AS `nim`, `mahasiswa`.`nama` AS `nama`, `mahasiswa`.`alamat` AS `alamat`, `mahasiswa`.`tanggal_lahir` AS `tanggal_lahir`, `matakuliah`.`kode_mk` AS `kode_mk`, `matakuliah`.`nama_mk` AS `nama_mk`, `matakuliah`.`sks` AS `sks`, `perkuliahan`.`nilai` AS `nilai` FROM ((`mahasiswa` join `perkuliahan` on(`mahasiswa`.`nim` = `perkuliahan`.`nim`)) join `matakuliah` on(`perkuliahan`.`kode_mk` = `matakuliah`.`kode_mk`)) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
