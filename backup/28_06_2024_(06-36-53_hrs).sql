SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS udo;

USE udo;

DROP TABLE IF EXISTS fotosrep;

CREATE TABLE `fotosrep` (
  `id_fot` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `id_u` varchar(255) NOT NULL,
  `id_re` int(11) NOT NULL,
  PRIMARY KEY (`id_fot`),
  KEY `id_re` (`id_re`),
  CONSTRAINT `fotosrep_ibfk_1` FOREIGN KEY (`id_re`) REFERENCES `reposos` (`id_rep`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO fotosrep VALUES("12","9deb7d5a370d6ca_1.png","1","45");
INSERT INTO fotosrep VALUES("13","d026d0db1906415_16.png","16","46");



DROP TABLE IF EXISTS info_per;

CREATE TABLE `info_per` (
  `id_info` int(11) NOT NULL AUTO_INCREMENT,
  `cedula_pers` varchar(255) NOT NULL,
  `nombre_pers` varchar(255) NOT NULL,
  `apellido_pers` varchar(255) NOT NULL,
  `tlf_pers` varchar(255) NOT NULL,
  `id_usu` int(11) NOT NULL,
  PRIMARY KEY (`id_info`),
  KEY `user` (`id_usu`),
  CONSTRAINT `info_per_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO info_per VALUES("1","87654321","Nivel Admin","Nivel Admin","04126973654","1");
INSERT INTO info_per VALUES("13","64597836","Nivel Usuario","Nivel Usuario","04146765179","16");



DROP TABLE IF EXISTS medico;

CREATE TABLE `medico` (
  `id_med` int(11) NOT NULL AUTO_INCREMENT,
  `ced_med` varchar(255) NOT NULL,
  `nom_med` varchar(255) NOT NULL,
  `ape_med` varchar(255) NOT NULL,
  `cert_med` varchar(20) NOT NULL,
  PRIMARY KEY (`id_med`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO medico VALUES("5","20212223","Antonio Armando","Contreras Frías","1678797");



DROP TABLE IF EXISTS reposos;

CREATE TABLE `reposos` (
  `id_rep` int(11) NOT NULL AUTO_INCREMENT,
  `duracion` varchar(60) NOT NULL,
  `patologia` varchar(400) NOT NULL,
  `fecha_cert` date NOT NULL,
  `fecha_ven` date DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  PRIMARY KEY (`id_rep`),
  KEY `id_user` (`id_user`),
  KEY `id_doc` (`id_doc`),
  CONSTRAINT `reposos_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reposos_ibfk_2` FOREIGN KEY (`id_doc`) REFERENCES `medico` (`id_med`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO reposos VALUES("45","21","GRIPE","2024-06-01","2024-06-22","1","5");
INSERT INTO reposos VALUES("46","21","GASTRITIS","2024-06-20","2024-07-11","16","5");



DROP TABLE IF EXISTS user;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass_u` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nivel` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pregunta_uno` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pregunta_dos` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `resp_uno` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `resp_dos` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO user VALUES("1","admin","ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f","1","pais de origen","fruta preferida","venezuela","pera");
INSERT INTO user VALUES("16","usuario","ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f","2","Nombre de Mascota","Mes favorito","Estela","Enero");



SET FOREIGN_KEY_CHECKS=1;