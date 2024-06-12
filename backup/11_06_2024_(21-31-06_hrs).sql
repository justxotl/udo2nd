SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS udo;

USE udo;

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

INSERT INTO info_per VALUES("1","87654321","Americio José","Alvarez Cárdenas","04126973654","1");
INSERT INTO info_per VALUES("3","33333333","Anastacia","Carmen","04444444444","3");
INSERT INTO info_per VALUES("12","16958789","Adrian","Manuel","04167984369","15");
INSERT INTO info_per VALUES("13","64597836","Ignacio","Aponte","11111111111","16");



DROP TABLE IF EXISTS medico;

CREATE TABLE `medico` (
  `id_med` int(11) NOT NULL AUTO_INCREMENT,
  `ced_med` varchar(255) NOT NULL,
  `nom_med` varchar(255) NOT NULL,
  `ape_med` varchar(255) NOT NULL,
  PRIMARY KEY (`id_med`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO medico VALUES("5","20212223","Antonio Armando","Contreras Frías");



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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO reposos VALUES("6","15","ENFERMEDAD DE EJEMPLO","2024-05-26","2024-06-10","1","5");
INSERT INTO reposos VALUES("12","18","ysdgsy","2024-05-26","2024-06-13","3","5");
INSERT INTO reposos VALUES("16","20","esjemapsdl","2024-05-01","","3","5");
INSERT INTO reposos VALUES("17","10","dolencia","2024-05-01","","16","5");
INSERT INTO reposos VALUES("20","14","ejemplo reposo niveles ejemplo reposo nivelesejemplo reposo nivelesejemplo reposo nivelesejemplo reposo nivelesejemplo reposo nivelesejemplo reposo nivelesejemplo reposo nivelesejemplo reposo niveles","2024-05-17","","16","5");
INSERT INTO reposos VALUES("23","11","asdkljaskldjaskldj","2024-04-17","","16","5");
INSERT INTO reposos VALUES("24","8","ya basta","2024-05-16","2024-05-24","15","5");
INSERT INTO reposos VALUES("25","14","DOLOR CERVICAL","2024-05-30","2024-06-13","1","5");
INSERT INTO reposos VALUES("26","4","dfgsdfgsdfgs","2024-06-01","2024-06-05","15","5");
INSERT INTO reposos VALUES("32","9","GASTRITIS","2024-06-21","","15","5");
INSERT INTO reposos VALUES("33","21","MERECIDO DESCANSO","2024-06-11","","1","5");
INSERT INTO reposos VALUES("34","8","LUXACIÓN","2024-06-10","2024-06-18","1","5");



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

INSERT INTO user VALUES("1","Alvarez","ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f","1","pais de origen","fruta preferida","venezuela","pera");
INSERT INTO user VALUES("3","Carmen","ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f","1","","","","");
INSERT INTO user VALUES("15","Adrian","e33498d494a8aaf97fe9de15ae6d0b8f965c9776b4bf80d13658c41d3df85bf0","1","","","","");
INSERT INTO user VALUES("16","nacho","ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f","2","agua","agua","agua","agua");



SET FOREIGN_KEY_CHECKS=1;