-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2022 at 01:18 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toskul`
--

-- --------------------------------------------------------

--
-- Table structure for table `core`
--

CREATE TABLE `core` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `smp` varchar(128) NOT NULL,
  `nisn` int(128) NOT NULL,
  `tempat_lahir` varchar(128) NOT NULL,
  `tgl_lahir` varchar(128) NOT NULL,
  `no_hp` int(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `ayah` varchar(128) NOT NULL,
  `penghasilan_ayah` int(250) NOT NULL,
  `ibu` varchar(128) NOT NULL,
  `penghasilan_ibu` int(250) NOT NULL,
  `foto` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `core`
--

INSERT INTO `core` (`id`, `nama`, `smp`, `nisn`, `tempat_lahir`, `tgl_lahir`, `no_hp`, `email`, `ayah`, `penghasilan_ayah`, `ibu`, `penghasilan_ibu`, `foto`) VALUES
(1, 'agung', 'SMP 1', 123456, 'Kendal', '2026-07-19', 123456, 'agung@gmail.com', 'abc', 2000, 'def', 2000, '61ed265689423.png'),
(2, 'yahya', 'SMP 2', 12345, 'Bekasiii', '2022-01-06', 12345678, 'yahya@gmail.com', 'abc', 100, 'abc', 100, '61e43bd471595.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `pass` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`id`, `username`, `email`, `pass`) VALUES
(1, 'agungX', 'agung@gmail.com', '$2y$10$DB29gnNSveCJ/W1Gd0rBgOQGRD81BfQHAoTEJ9Gcdk0h5MKE93cl2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `core`
--
ALTER TABLE `core`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `core`
--
ALTER TABLE `core`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
