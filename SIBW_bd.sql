-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `SIBW_bd`;
CREATE DATABASE `SIBW_bd` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `SIBW_bd`;

DROP TABLE IF EXISTS `comentario`;
CREATE TABLE `comentario` (
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `usuario` int(11) NOT NULL,
  `evento` int(11) NOT NULL,
  `moderado` bit(1) DEFAULT NULL,
  `moderador` int(11) DEFAULT NULL,
  KEY `usuario` (`usuario`),
  KEY `evento` (`evento`),
  KEY `moderador` (`moderador`),
  CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`),
  CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`evento`) REFERENCES `gameEvent` (`eventId`),
  CONSTRAINT `comentario_ibfk_3` FOREIGN KEY (`moderador`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `tabImg` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tabName` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `headerImg` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `headerName` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `eventLinks`;
CREATE TABLE `eventLinks` (
  `twitter` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `facebook` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `youtube` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `instagram` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `eventId` int(11) NOT NULL,
  KEY `eventId` (`eventId`),
  CONSTRAINT `eventLinks_ibfk_1` FOREIGN KEY (`eventId`) REFERENCES `gameEvent` (`eventId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `eventTag`;
CREATE TABLE `eventTag` (
  `fortnite` bit(1) NOT NULL,
  `marioKart` bit(1) NOT NULL,
  `torneo` bit(1) NOT NULL,
  `prensa` bit(1) NOT NULL,
  `lol` bit(1) NOT NULL,
  `eventId` int(11) NOT NULL,
  KEY `eventId` (`eventId`),
  CONSTRAINT `eventTag_ibfk_1` FOREIGN KEY (`eventId`) REFERENCES `gameEvent` (`eventId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `gameEvent`;
CREATE TABLE `gameEvent` (
  `eventTitle` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `titleImg` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `eventName` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `img1` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `undernameImg1` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `img2` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `undernameImg2` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `body` longtext COLLATE utf8_spanish_ci NOT NULL,
  `eventId` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`eventId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `gameEvent` (`eventTitle`, `titleImg`, `eventName`, `location`, `img1`, `undernameImg1`, `img2`, `undernameImg2`, `date`, `body`, `eventId`) VALUES
('Evento Fortnite',	'/imgs/evento-fortnite.jpg',	'Evento de Fortnite en Mall Alto Penalolen',	'GamerHouse',	'/imgs/fortnite5.jpg',	'Evento Presencial | GamerHouse',	'/imgs/fortnite7.jpg',	'Las skins especiales del evento | GamerHouse',	'08 / 11 / 2018',	'<p>Así es, GamerHouse te trae nuevas sorpresas que seguramente estarás encantado de disfrutar. Se trata de un evento organizado por el equipo de trabajo de la empresa y el apoyo grandísimo del querido youtuber chileno conocido como <a href=\"https://www.youtube.com/channel/UCvY9VE9C0M7RohImZLODeQg\"><strong>CAOZ</strong></a>, en el Mall Alto Peñalolén (Santiago de Chile).</p>\r\n\r\n				<p>El evento consistirá básicamente en : El <b>ShowMatch</b> en el que participarán youtubers amantes del Fortnite, un <b>Torneo Fortnite</b> en el que podrán participar de forma GRATUITA, competencia contra youtubers, concurso de <b>bailes Fortnite</b>, un área recreativa pensada en los más pequeños y en quienes no participen de forma competitiva, sorteos y demás actividades. También encontrarás stands relacionados con el título, artículos de PC y <b>Funko-Pops</b>. Ese día podrás reservar tus Funko-Pops para ser el primero en tener los de Fortnite para cuando lleguen en Diciembre.</p>\r\n\r\n				<p>Te recordamos que las inscripciones al <b>Torneo Fortnite</b> se realizarán el mismo día del evento a partir de las 12:00 PM, quienes deseen participar deberán inscribirse de forma presencial (SÓLO 32 CUPOS). Aquí te dejamos un Video descriptivo en el que <a href=\"https://www.youtube.com/channel/UCvY9VE9C0M7RohImZLODeQg\"><strong>CAOZ</strong></a> explica cada detalle que debes saber antes del 10 de Noviembre, fecha que se acerca y esperamos sea tan emocionante para ustedes como para nosotros.</p>',	1);

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pass` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `usuario` (`correo`, `id`, `pass`, `nombre`, `tipo`) VALUES
('fulano@mengano.es',	1,	'menganitopass',	'fulanito',	0);

-- 2019-05-10 14:47:34
