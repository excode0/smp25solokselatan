-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2023 at 07:13 AM
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
-- Database: `smpsolokselatan`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata_siswa`
--

CREATE TABLE `biodata_siswa` (
  `id_biodata_siswa` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `idkelas` int(11) NOT NULL,
  `idlokal` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biodata_siswa`
--

INSERT INTO `biodata_siswa` (`id_biodata_siswa`, `nama`, `idkelas`, `idlokal`) VALUES
(4, 'syahri miranti', 1, 5),
(5, 'keysha amanda putri', 1, 5),
(6, 'elsan dyta duha', 1, 5),
(7, 'fitria febrianti', 2, 6),
(8, 'viola varesya', 2, 6),
(9, 'zesti anggini', 2, 6),
(10, 'natasha audira', 2, 9),
(11, 'anisa cantika putri', 2, 9),
(12, 'lavdesvita gea', 2, 9),
(13, 'hayrin najwa', 3, 7),
(14, 'sakinah dwi keylan', 3, 7),
(15, 'yesi lia', 3, 7),
(16, 'anindya wazada', 3, 8),
(17, 'enjel sri natalia', 3, 8),
(18, 'mulia sofa', 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `data_keaktifan`
--

CREATE TABLE `data_keaktifan` (
  `id_keaktifan` int(11) NOT NULL,
  `tingkat_1` int(30) NOT NULL,
  `tingkat_2` int(30) NOT NULL,
  `tingkat_3` int(30) NOT NULL,
  `idsiswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_kehadiran`
--

CREATE TABLE `data_kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `kehadiran` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_nilai`
--

CREATE TABLE `data_nilai` (
  `id_data_nilai` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `nilai` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_sample`
--

CREATE TABLE `data_sample` (
  `id_sample` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `nilai_rata_raport` float NOT NULL,
  `jumlah_kehadiran` int(11) NOT NULL,
  `jumlah_keaktifan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_sample`
--

INSERT INTO `data_sample` (`id_sample`, `idsiswa`, `nilai_rata_raport`, `jumlah_kehadiran`, `jumlah_keaktifan`) VALUES
(2, 4, 81.81, 31, 38),
(3, 7, 90.91, 30, 37);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'VII'),
(2, 'VIII'),
(3, 'IX');

-- --------------------------------------------------------

--
-- Table structure for table `lokal`
--

CREATE TABLE `lokal` (
  `id_lokal` int(11) NOT NULL,
  `nama_lokal` varchar(30) NOT NULL,
  `idkelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokal`
--

INSERT INTO `lokal` (`id_lokal`, `nama_lokal`, `idkelas`) VALUES
(5, 'a', 1),
(6, 'a', 2),
(7, 'a', 3),
(8, 'b', 3),
(9, 'b', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(60) NOT NULL,
  `idkelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata_siswa`
--
ALTER TABLE `biodata_siswa`
  ADD PRIMARY KEY (`id_biodata_siswa`);

--
-- Indexes for table `data_keaktifan`
--
ALTER TABLE `data_keaktifan`
  ADD PRIMARY KEY (`id_keaktifan`);

--
-- Indexes for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indexes for table `data_nilai`
--
ALTER TABLE `data_nilai`
  ADD PRIMARY KEY (`id_data_nilai`);

--
-- Indexes for table `data_sample`
--
ALTER TABLE `data_sample`
  ADD PRIMARY KEY (`id_sample`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `lokal`
--
ALTER TABLE `lokal`
  ADD PRIMARY KEY (`id_lokal`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biodata_siswa`
--
ALTER TABLE `biodata_siswa`
  MODIFY `id_biodata_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `data_keaktifan`
--
ALTER TABLE `data_keaktifan`
  MODIFY `id_keaktifan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_nilai`
--
ALTER TABLE `data_nilai`
  MODIFY `id_data_nilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_sample`
--
ALTER TABLE `data_sample`
  MODIFY `id_sample` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lokal`
--
ALTER TABLE `lokal`
  MODIFY `id_lokal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
