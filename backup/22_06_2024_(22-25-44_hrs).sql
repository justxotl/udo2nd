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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO fotosrep VALUES("6","2ffc5c3f6c762ea_1.jpg","1","39");
INSERT INTO fotosrep VALUES("7","653bc924b4f99ca_3.png","3","40");



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
INSERT INTO info_per VALUES("3","71981423","Anastacia","Carmen","04126987365","3");
INSERT INTO info_per VALUES("12","16958789","Adrian","Manuel","04167984369","15");
INSERT INTO info_per VALUES("13","64597836","Ignacio","Aponte","04146765179","16");



DROP TABLE IF EXISTS medico;

CREATE TABLE `medico` (
  `id_med` int(11) NOT NULL AUTO_INCREMENT,
  `ced_med` varchar(255) NOT NULL,
  `nom_med` varchar(255) NOT NULL,
  `ape_med` varchar(255) NOT NULL,
  `cert_med` varchar(20) NOT NULL,
  PRIMARY KEY (`id_med`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO medico VALUES("5","20212223","Antonio Armando","Contreras Frías","");
INSERT INTO medico VALUES("16","58766943","Roberto Clemente","Sambrano","236598");



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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO reposos VALUES("9","15","GRIPE","2024-04-01","2024-04-08","1","5");
INSERT INTO reposos VALUES("12","18","CEFALEAS EN RACIMOS","2024-05-26","2024-06-13","3","5");
INSERT INTO reposos VALUES("13","7","FRACTURA","2024-05-02","2024-05-09","1","5");
INSERT INTO reposos VALUES("15","3","HEMATOMA","2024-05-25","2024-05-28","1","5");
INSERT INTO reposos VALUES("16","20","REPOSO POR PRECAUCIÓN","2024-05-01","","3","5");
INSERT INTO reposos VALUES("17","10","DOLENCIA","2024-05-01","","16","5");
INSERT INTO reposos VALUES("20","14","PATOLOGIA DE EJEMPLO","2024-05-17","","16","5");
INSERT INTO reposos VALUES("23","11","REACCIÓN ALÉRGICA","2024-04-17","","16","5");
INSERT INTO reposos VALUES("24","8","FRACTURA DE TIBIA","2024-05-16","2024-05-24","15","5");
INSERT INTO reposos VALUES("25","14","DOLOR CERVICAL","2024-05-30","2024-06-13","1","5");
INSERT INTO reposos VALUES("26","4","CONJUNTIVITIS","2024-06-01","2024-06-05","15","5");
INSERT INTO reposos VALUES("32","9","GASTRITIS","2024-06-21","2024-06-30","15","5");
INSERT INTO reposos VALUES("33","21","MERECIDO DESCANSO","2024-06-11","","1","5");
INSERT INTO reposos VALUES("34","8","LUXACIÓN","2024-06-10","2024-06-18","1","5");
INSERT INTO reposos VALUES("35","7","vayalo","2024-06-05","","1","5");
INSERT INTO reposos VALUES("36","8","sdfghsxdfthbxdfghn","2024-06-01","","1","5");
INSERT INTO reposos VALUES("37","20","aertygabergawrehba","2024-06-02","","1","5");
INSERT INTO reposos VALUES("38","7","dfghnsrdghsethasert","2024-06-14","","1","5");
INSERT INTO reposos VALUES("39","7","aergabshertyaehrayg","2024-06-14","2024-06-21","1","5");
INSERT INTO reposos VALUES("40","10","xfdghxsdfahdbfhaer","2024-06-14","2024-06-24","3","5");



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
INSERT INTO user VALUES("3","cesar","ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f","1","","","","");
INSERT INTO user VALUES("15","Adrian","e33498d494a8aaf97fe9de15ae6d0b8f965c9776b4bf80d13658c41d3df85bf0","1","","","","");
INSERT INTO user VALUES("16","Nacho","ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f","2","Nombre de Mascota","Mes favorito","Estela","Enero");



SET FOREIGN_KEY_CHECKS=1;