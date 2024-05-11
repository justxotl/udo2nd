-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 03:23 AM
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
-- Table structure for table `info_per`
--

CREATE TABLE `info_per` (
  `id_info` int(11) NOT NULL,
  `cedula_pers` varchar(255) NOT NULL,
  `nombre_pers` varchar(255) NOT NULL,
  `apellido_pers` varchar(255) NOT NULL,
  `tlf_pers` varchar(255) NOT NULL,
  `id_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `info_per`
--

INSERT INTO `info_per` (`id_info`, `cedula_pers`, `nombre_pers`, `apellido_pers`, `tlf_pers`, `id_usu`) VALUES
(1, '87654321', 'Americio José', 'Alvarez Cárdenas', '04126973654', 1),
(3, '33333333', 'Anastacia', 'Carmen', '04444444444', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reposos`
--

CREATE TABLE `reposos` (
  `id_rep` int(11) NOT NULL,
  `duracion` varchar(60) NOT NULL,
  `patologia` varchar(400) NOT NULL,
  `nombre_med` varchar(255) NOT NULL,
  `apellido_med` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reposos`
--

INSERT INTO `reposos` (`id_rep`, `duracion`, `patologia`, `nombre_med`, `apellido_med`, `id_user`) VALUES
(6, '15', 'agua seca', 'Jose', 'Lorena', 1),
(7, '15', 'mano pelua', 'juanito', 'alimaña', 3),
(9, '15', 'pendejo', 'Jose', 'alimaña', 1),
(10, '18', 'menso', 'Jose', 'raya', 1),
(11, '18', 'asdasd', 'juanito', 'raya', 3),
(12, '18', 'ysdgsy', 'Jose', 'raya', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `pass_u` varchar(250) NOT NULL,
  `nivel` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `usuario`, `pass_u`, `nivel`) VALUES
(1, 'Alvarez', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '1'),
(3, 'cesar', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info_per`
--
ALTER TABLE `info_per`
  ADD PRIMARY KEY (`id_info`),
  ADD KEY `user` (`id_usu`);

--
-- Indexes for table `reposos`
--
ALTER TABLE `reposos`
  ADD PRIMARY KEY (`id_rep`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info_per`
--
ALTER TABLE `info_per`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reposos`
--
ALTER TABLE `reposos`
  MODIFY `id_rep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `info_per`
--
ALTER TABLE `info_per`
  ADD CONSTRAINT `info_per_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reposos`
--
ALTER TABLE `reposos`
  ADD CONSTRAINT `reposos_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
