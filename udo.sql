-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 04:06 AM
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
(3, '71981423', 'Anastacia', 'Carmen', '04126987365', 3),
(12, '16958789', 'Adrian', 'Manuel', '04167984369', 15),
(13, '64597836', 'Ignacio', 'Aponte', '04146765179', 16);

-- --------------------------------------------------------

--
-- Table structure for table `medico`
--

CREATE TABLE `medico` (
  `id_med` int(11) NOT NULL,
  `ced_med` varchar(255) NOT NULL,
  `nom_med` varchar(255) NOT NULL,
  `ape_med` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `medico`
--

INSERT INTO `medico` (`id_med`, `ced_med`, `nom_med`, `ape_med`) VALUES
(5, '20212223', 'Antonio Armando', 'Contreras Frías');

-- --------------------------------------------------------

--
-- Table structure for table `reposos`
--

CREATE TABLE `reposos` (
  `id_rep` int(11) NOT NULL,
  `duracion` varchar(60) NOT NULL,
  `patologia` varchar(400) NOT NULL,
  `fecha_cert` date NOT NULL,
  `fecha_ven` date DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reposos`
--

INSERT INTO `reposos` (`id_rep`, `duracion`, `patologia`, `fecha_cert`, `fecha_ven`, `id_user`, `id_doc`) VALUES
(6, '15', 'ENFERMEDAD DE EJEMPLO', '2024-05-26', '2024-06-10', 1, 5),
(9, '15', 'GRIPE', '2024-04-01', '2024-04-08', 1, 5),
(12, '18', 'CEFALEAS EN RACIMOS', '2024-05-26', '2024-06-13', 3, 5),
(13, '7', 'FRACTURA', '2024-05-02', '2024-05-09', 1, 5),
(15, '3', 'HEMATOMA', '2024-05-25', '2024-05-28', 1, 5),
(16, '20', 'REPOSO POR PRECAUCIÓN', '2024-05-01', NULL, 3, 5),
(17, '10', 'DOLENCIA', '2024-05-01', NULL, 16, 5),
(20, '14', 'PATOLOGIA DE EJEMPLO', '2024-05-17', NULL, 16, 5),
(23, '11', 'REACCIÓN ALÉRGICA', '2024-04-17', NULL, 16, 5),
(24, '8', 'FRACTURA DE TIBIA', '2024-05-16', '2024-05-24', 15, 5),
(25, '14', 'DOLOR CERVICAL', '2024-05-30', '2024-06-13', 1, 5),
(26, '4', 'CONJUNTIVITIS', '2024-06-01', '2024-06-05', 15, 5),
(32, '9', 'GASTRITIS', '2024-06-21', NULL, 15, 5),
(33, '21', 'MERECIDO DESCANSO', '2024-06-11', NULL, 1, 5),
(34, '8', 'LUXACIÓN', '2024-06-10', '2024-06-18', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `usuario` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass_u` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nivel` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pregunta_uno` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pregunta_dos` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `resp_uno` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `resp_dos` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `usuario`, `pass_u`, `nivel`, `pregunta_uno`, `pregunta_dos`, `resp_uno`, `resp_dos`) VALUES
(1, 'Alvarez', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '1', 'pais de origen', 'fruta preferida', 'venezuela', 'pera'),
(3, 'cesar', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '1', '', '', '', ''),
(15, 'Adrian', 'e33498d494a8aaf97fe9de15ae6d0b8f965c9776b4bf80d13658c41d3df85bf0', '1', '', '', '', ''),
(16, 'Nacho', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '2', 'Nombre de Mascota', 'Mes favorito', 'Estela', 'Enero');

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
-- Indexes for table `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`id_med`);

--
-- Indexes for table `reposos`
--
ALTER TABLE `reposos`
  ADD PRIMARY KEY (`id_rep`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_doc` (`id_doc`);

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
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `medico`
--
ALTER TABLE `medico`
  MODIFY `id_med` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reposos`
--
ALTER TABLE `reposos`
  MODIFY `id_rep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  ADD CONSTRAINT `reposos_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reposos_ibfk_2` FOREIGN KEY (`id_doc`) REFERENCES `medico` (`id_med`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
