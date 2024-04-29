-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 04:32 AM
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
-- Database: `udo`
--

-- --------------------------------------------------------

--
-- Table structure for table `doc`
--

CREATE TABLE `doc` (
  `id_doc` int(11) NOT NULL,
  `cedula_doc` varchar(255) NOT NULL,
  `nombres_doc` varchar(255) NOT NULL,
  `apellidos_doc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_per`
--

CREATE TABLE `info_per` (
  `id_info` int(11) NOT NULL,
  `cedula_pers` varchar(255) NOT NULL,
  `nombre_pers` varchar(255) NOT NULL,
  `apellido_pers` varchar(255) NOT NULL,
  `tlf_pers` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `info_per`
--

INSERT INTO `info_per` (`id_info`, `cedula_pers`, `nombre_pers`, `apellido_pers`, `tlf_pers`) VALUES
(1, '87654321', 'Americio José', 'Alvarez Cárdenas', '04126973654'),
(3, '22222222', 'Angel', 'Cristo', '04149630129'),
(4, '33333333', 'Ana', 'Carmen', '04151364978');

-- --------------------------------------------------------

--
-- Table structure for table `reposos`
--

CREATE TABLE `reposos` (
  `id_rep` int(11) NOT NULL,
  `cedula_rep` varchar(60) NOT NULL,
  `duracion` varchar(60) NOT NULL,
  `patologia` varchar(400) NOT NULL,
  `cedula_doc` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reposos`
--

INSERT INTO `reposos` (`id_rep`, `cedula_rep`, `duracion`, `patologia`, `cedula_doc`) VALUES
(1, '34234234', '32', 'HAMBRE', '12345679');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `pass_u` varchar(250) NOT NULL,
  `nivel` varchar(250) NOT NULL,
  `cedula_usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `usuario`, `pass_u`, `nivel`, `cedula_usu`) VALUES
(1, 'Alvarez', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '1', '87654321'),
(2, 'Carlo', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '2', ''),
(3, 'cesar', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '1', ''),
(4, 'FELIPA', '1f3ce40415a2081fa3eee75fc39fff8e56c22270d1a978a7249b592dcebd20b4', '1', '22222222'),
(5, 'juana', 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1', '2', '33333333');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`id_doc`);

--
-- Indexes for table `info_per`
--
ALTER TABLE `info_per`
  ADD PRIMARY KEY (`id_info`);

--
-- Indexes for table `reposos`
--
ALTER TABLE `reposos`
  ADD PRIMARY KEY (`id_rep`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doc`
--
ALTER TABLE `doc`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `info_per`
--
ALTER TABLE `info_per`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reposos`
--
ALTER TABLE `reposos`
  MODIFY `id_rep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
