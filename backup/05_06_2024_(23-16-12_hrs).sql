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
INSERT INTO info_per VALUES("14","78787878","este","otro","04561231234","17");



DROP TABLE IF EXISTS reposos;

CREATE TABLE `reposos` (
  `id_rep` int(11) NOT NULL AUTO_INCREMENT,
  `duracion` varchar(60) NOT NULL,
  `patologia` varchar(400) NOT NULL,
  `nombre_med` varchar(255) NOT NULL,
  `apellido_med` varchar(255) NOT NULL,
  `fecha_cert` date NOT NULL,
  `fecha_ven` date DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_rep`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `reposos_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO reposos VALUES("6","15","ASKDJALKSDJ AKLSDJALKSDJALSDJA LSDJASLDKASJDALSDKJA SDLAKJSDLASDKJALSDKAJSDLAKSJDALSDKJASDLKAJSDLAKSDJALSKDJALSDKJASLDKAJSDLAKJSDLAKSDJALSKDJALSDKJASLDKJASDLKAJSDLAKJSDLAKSJDLAKSJDLAKSJDKALJSDLKAJSLDJASDLAKJSDLASDKJALSDKAJSDLAKSJDALSDKJASDLKAJSDLAKSDJALSKDJALSDKJASLDKAJSDLAKJSDLAKSDJALSKDJALSDKJASLDKJASDLKAJSDLAKJSDLAKSJDLAKSJDLAKSJDKALJSDLKAJSLDJASDLAKJSDLASDKJALSDKAJSDLAKSJDALSDKJASDLK","Jose","Lorena","2024-05-26","2024-06-10","1");
INSERT INTO reposos VALUES("9","15","gripe","Jose","alimaña","2024-04-01","2024-04-08","1");
INSERT INTO reposos VALUES("12","18","ysdgsy","Jose","raya","2024-05-26","2024-06-13","3");
INSERT INTO reposos VALUES("13","7","fractura fracturafracturafracturafracturafracturafracturafracturafracturafracturafracturafracturafracturafracturafracturafracturafractura","Antonieta ","de las Nieves","2024-05-02","2024-05-09","1");
INSERT INTO reposos VALUES("15","3","testeo","esto","estootro","2024-05-25","2024-05-28","1");
INSERT INTO reposos VALUES("16","20","esjemapsdl","yomismo","tumiso","2024-05-01","","3");
INSERT INTO reposos VALUES("17","10","dolencia","Maria Antonia","Perez","2024-05-01","","16");
INSERT INTO reposos VALUES("20","14","ejemplo reposo niveles ejemplo reposo nivelesejemplo reposo nivelesejemplo reposo nivelesejemplo reposo nivelesejemplo reposo nivelesejemplo reposo nivelesejemplo reposo nivelesejemplo reposo niveles","ejemplo reposo niveles","ejemplo reposo niveles","2024-05-17","","16");
INSERT INTO reposos VALUES("21","5","funcion","funcion","funcion","2024-05-01","","17");
INSERT INTO reposos VALUES("22","14","crisstoseñor","ejempl","ejemplos","2024-05-03","","1");
INSERT INTO reposos VALUES("23","11","asdkljaskldjaskldj","sdñalksdalñksdlña","dsfjlñadsklfjals","2024-04-17","","16");
INSERT INTO reposos VALUES("24","8","ya basta","adsasdasdasdads","asdasdasdasdasd","2024-05-16","2024-05-24","15");



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

INSERT INTO user VALUES("1","Alvarez","ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f","1","venezuela","venezuela","venezuela","venezuela");
INSERT INTO user VALUES("3","cesar","ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f","1","","","","");
INSERT INTO user VALUES("15","Adrian","e33498d494a8aaf97fe9de15ae6d0b8f965c9776b4bf80d13658c41d3df85bf0","1","","","","");
INSERT INTO user VALUES("16","nacho","ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f","2","agua","agua","agua","agua");
INSERT INTO user VALUES("17","este","ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f","1","","","","");



SET FOREIGN_KEY_CHECKS=1;