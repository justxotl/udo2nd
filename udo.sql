-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 12:40 PM
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
-- Table structure for table `fotosrep`
--

CREATE TABLE `fotosrep` (
  `id_fot` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_u` varchar(255) NOT NULL,
  `id_re` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fotosrep`
--

INSERT INTO `fotosrep` (`id_fot`, `foto`, `id_u`, `id_re`) VALUES
(12, '9deb7d5a370d6ca_1.png', '1', 45),
(13, 'd026d0db1906415_16.png', '16', 46);

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
(1, '87654321', 'Nivel Admin', 'Nivel Admin', '04126973654', 1),
(13, '64597836', 'Nivel Usuario', 'Nivel Usuario', '04146765179', 16);

-- --------------------------------------------------------

--
-- Table structure for table `medico`
--

CREATE TABLE `medico` (
  `id_med` int(11) NOT NULL,
  `ced_med` varchar(255) NOT NULL,
  `nom_med` varchar(255) NOT NULL,
  `ape_med` varchar(255) NOT NULL,
  `cert_med` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `medico`
--

INSERT INTO `medico` (`id_med`, `ced_med`, `nom_med`, `ape_med`, `cert_med`) VALUES
(5, '20212223', 'Antonio Armando', 'Contreras Frías', '1678797');

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
(45, '21', 'GRIPE', '2024-06-01', '2024-06-22', 1, 5),
(46, '21', 'GASTRITIS', '2024-06-20', '2024-07-11', 16, 5);

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
(1, 'admin', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '1', 'pais de origen', 'fruta preferida', 'venezuela', 'pera'),
(16, 'usuario', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '2', 'Nombre de Mascota', 'Mes favorito', 'Estela', 'Enero');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fotosrep`
--
ALTER TABLE `fotosrep`
  ADD PRIMARY KEY (`id_fot`),
  ADD KEY `id_re` (`id_re`);

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
-- AUTO_INCREMENT for table `fotosrep`
--
ALTER TABLE `fotosrep`
  MODIFY `id_fot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `info_per`
--
ALTER TABLE `info_per`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `medico`
--
ALTER TABLE `medico`
  MODIFY `id_med` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reposos`
--
ALTER TABLE `reposos`
  MODIFY `id_rep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fotosrep`
--
ALTER TABLE `fotosrep`
  ADD CONSTRAINT `fotosrep_ibfk_1` FOREIGN KEY (`id_re`) REFERENCES `reposos` (`id_rep`) ON DELETE CASCADE ON UPDATE CASCADE;

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
