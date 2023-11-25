# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Base de datos: bd_alcvaletparking
# Tiempo de Generación: 2023-11-12 23:04:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla tbl_clientes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_clientes`;

CREATE TABLE `tbl_clientes` (
  `IdUser` int(10) NOT NULL AUTO_INCREMENT,
  `emailUser` varchar(50) DEFAULT NULL,
  `passwordUser` varchar(250) DEFAULT NULL,
  `nombre_completo` varchar(250) DEFAULT NULL,
  `din` char(50) DEFAULT NULL,
  `direccion_completa` mediumtext DEFAULT NULL,
  `tlf` varchar(20) DEFAULT NULL,
  `conocido_por` varchar(60) DEFAULT NULL,
  `observaciones` mediumtext DEFAULT NULL,
  `terminos` int(11) DEFAULT 1,
  `rol` int(11) DEFAULT 0,
  `sesionDesde` varchar(30) DEFAULT NULL,
  `sesionHasta` varchar(30) DEFAULT NULL,
  `createUser` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IdUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

LOCK TABLES `tbl_clientes` WRITE;
/*!40000 ALTER TABLE `tbl_clientes` DISABLE KEYS */;

INSERT INTO `tbl_clientes` (`IdUser`, `emailUser`, `passwordUser`, `nombre_completo`, `din`, `direccion_completa`, `tlf`, `conocido_por`, `observaciones`, `terminos`, `rol`, `sesionDesde`, `sesionHasta`, `createUser`)
VALUES
	(1,'urian@gmail.com','$2y$10$4BGjpWNNaEtT.G.jnUENhevXws7gocLQ5q4KW.UJ2qCXXd8y0Z78W','urian viera','din','direcion completa','78787','Un Amigo','Observacion',1,0,'2023-11-12 20:26:05',NULL,'2023-11-07 03:00:03'),
	(2,'any@gmail.com','$2y$10$sV6v2xUhy2jZtjO7vGvfkebuz.Az01v5g6.OgubbF19HJhEHdUQDW','Any L','543545','car 9','4455465','Google','nada',1,0,'2023-11-08 03:18:10',NULL,'2023-11-08 03:18:00'),
	(3,'admin@gmail.com','$2y$10$l2FhdKzhkm7897RONVEjkumtfvmvJhsdAwJj.cEP9/QUf96FVcMyC','Administrador','44444','cra x','4444','Un Amigo','Soy administrador',1,1,'2023-11-12 23:59:20',NULL,'2023-11-11 00:26:45'),
	(4,'urian12@gmail.com','$2y$10$yd9zdO3o2rshYYEP0HMfLuRVfMWTOv0vuf7XdftVdDIB3voKH1xNS','Alejando','534534','45345','',NULL,'hola',1,0,NULL,NULL,'2023-11-11 02:48:32'),
	(5,'luisito@gmail.com','$2y$10$ImJDlgyXn/fzuvQTr9OlVuYjxy7.DVSc5wv4SFoh6ELlOVrP6WMJy','Luis','45678','carar444','',NULL,'hoa',1,0,NULL,NULL,'2023-11-11 02:49:14');

/*!40000 ALTER TABLE `tbl_clientes` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla tbl_parking_aire_libre
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_parking_aire_libre`;

CREATE TABLE `tbl_parking_aire_libre` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dia` int(11) NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_parking_aire_libre` WRITE;
/*!40000 ALTER TABLE `tbl_parking_aire_libre` DISABLE KEYS */;

INSERT INTO `tbl_parking_aire_libre` (`id`, `dia`, `valor`)
VALUES
	(1,1,15.00),
	(2,2,15.00),
	(3,3,20.00),
	(4,4,25.00),
	(5,5,29.00),
	(6,6,32.00),
	(7,7,35.00),
	(8,8,36.50),
	(9,9,38.00),
	(10,10,39.50),
	(11,11,41.00),
	(12,12,42.50),
	(13,13,44.00),
	(14,14,45.50),
	(15,15,47.00),
	(16,16,48.50),
	(17,17,50.00),
	(18,18,51.50),
	(19,19,53.00),
	(20,20,54.50),
	(21,21,56.00),
	(22,22,57.50),
	(23,23,59.00),
	(24,24,60.50),
	(25,25,62.00),
	(26,26,63.50),
	(27,27,65.00),
	(28,28,66.50),
	(29,29,68.00),
	(30,30,69.50),
	(31,31,71.00),
	(32,32,72.50),
	(33,33,74.00),
	(34,34,75.50),
	(35,35,77.00),
	(36,36,78.50),
	(37,37,80.00),
	(38,38,81.50),
	(39,39,83.00),
	(40,40,84.50),
	(41,41,86.00),
	(42,42,87.50),
	(43,43,89.00),
	(44,44,90.50),
	(45,45,92.00),
	(46,46,93.50),
	(47,47,95.00),
	(48,48,96.50),
	(49,49,98.00),
	(50,50,99.50),
	(51,51,101.00),
	(52,52,102.50),
	(53,53,104.00),
	(54,54,105.50),
	(55,55,107.00),
	(56,56,108.50),
	(57,57,110.00),
	(58,58,111.50),
	(59,59,113.00),
	(60,60,114.50),
	(61,61,115.25),
	(62,62,116.00),
	(63,63,116.75),
	(64,64,117.50),
	(65,65,118.25),
	(66,66,119.00),
	(67,67,119.75),
	(68,68,120.50),
	(69,69,121.25),
	(70,70,122.00),
	(71,71,122.75),
	(72,72,123.50),
	(73,73,124.25),
	(74,74,125.00),
	(75,75,125.75),
	(76,76,126.50),
	(77,77,127.25),
	(78,78,128.00),
	(79,79,128.75),
	(80,80,129.50),
	(81,81,130.25),
	(82,82,131.00),
	(83,83,131.75),
	(84,84,132.50),
	(85,85,133.25),
	(86,86,134.00),
	(87,87,134.75),
	(88,88,135.50),
	(89,89,136.25),
	(90,90,137.00),
	(91,91,137.75),
	(92,92,138.50),
	(93,93,139.25),
	(94,94,140.00),
	(95,95,140.75),
	(96,96,141.50),
	(97,97,142.25),
	(98,98,143.00),
	(99,99,143.75),
	(100,100,144.50),
	(101,101,145.25),
	(102,102,146.00),
	(103,103,146.75),
	(104,104,147.50),
	(105,105,148.25),
	(106,106,149.00),
	(107,107,149.75),
	(108,108,150.50),
	(109,109,151.25),
	(110,110,152.00),
	(111,111,152.75),
	(112,112,153.50),
	(113,113,154.25),
	(114,114,155.00),
	(115,115,155.75),
	(116,116,156.50),
	(117,117,157.25),
	(118,118,158.00),
	(119,119,158.75),
	(120,120,159.50),
	(121,121,160.25),
	(122,122,161.00),
	(123,123,161.75),
	(124,124,162.50),
	(125,125,163.25),
	(126,126,164.00),
	(127,127,164.75),
	(128,128,165.50),
	(129,129,166.25),
	(130,130,167.00),
	(131,131,167.75),
	(132,132,168.50),
	(133,133,169.25),
	(134,134,170.00),
	(135,135,170.75),
	(136,136,171.50),
	(137,137,172.25),
	(138,138,173.00),
	(139,139,173.75),
	(140,140,174.50),
	(141,141,175.25),
	(142,142,176.00),
	(143,143,176.75),
	(144,144,177.50),
	(145,145,178.25),
	(146,146,179.00),
	(147,147,179.75),
	(148,148,180.50),
	(149,149,181.25),
	(150,150,182.00),
	(151,151,182.75),
	(152,152,183.50),
	(153,153,184.25),
	(154,154,185.00),
	(155,155,185.75),
	(156,156,186.50),
	(157,157,187.25),
	(158,158,188.00),
	(159,159,188.75),
	(160,160,189.50),
	(161,161,190.25),
	(162,162,191.00),
	(163,163,191.75),
	(164,164,192.50),
	(165,165,193.25),
	(166,166,194.00),
	(167,167,194.75),
	(168,168,195.50),
	(169,169,196.25),
	(170,170,197.00),
	(171,171,197.75),
	(172,172,198.50),
	(173,173,199.25),
	(174,174,200.00),
	(175,175,200.75),
	(176,176,201.50),
	(177,177,202.25),
	(178,178,203.00),
	(179,179,203.75),
	(180,180,204.50),
	(181,181,205.25),
	(182,182,206.00),
	(183,183,206.75),
	(184,184,207.50),
	(185,185,208.25),
	(186,186,209.00),
	(187,187,209.75),
	(188,188,210.50),
	(189,189,211.25),
	(190,190,212.00),
	(191,191,212.75),
	(192,192,213.50),
	(193,193,214.25),
	(194,194,215.00),
	(195,195,215.75),
	(196,196,216.50),
	(197,197,217.25),
	(198,198,218.00),
	(199,199,218.75),
	(200,200,219.50),
	(201,201,220.25),
	(202,202,221.00),
	(203,203,221.75),
	(204,204,222.50),
	(205,205,223.25),
	(206,206,224.00),
	(207,207,224.75),
	(208,208,225.50),
	(209,209,226.25),
	(210,210,227.00),
	(211,211,227.75),
	(212,212,228.50),
	(213,213,229.25),
	(214,214,230.00),
	(215,215,230.75),
	(216,216,231.50),
	(217,217,232.25),
	(218,218,233.00),
	(219,219,233.75),
	(220,220,234.50),
	(221,221,235.25),
	(222,222,236.00),
	(223,223,236.75),
	(224,224,237.50),
	(225,225,238.25),
	(226,226,239.00),
	(227,227,239.75),
	(228,228,240.50),
	(229,229,241.25),
	(230,230,242.00),
	(231,231,242.75),
	(232,232,243.50),
	(233,233,244.25),
	(234,234,245.00),
	(235,235,245.75),
	(236,236,246.50),
	(237,237,247.25),
	(238,238,248.00),
	(239,239,248.75),
	(240,240,249.50),
	(241,241,250.25),
	(242,242,251.00),
	(243,243,251.75),
	(244,244,252.50),
	(245,245,253.25),
	(246,246,254.00),
	(247,247,254.75),
	(248,248,255.50),
	(249,249,256.25),
	(250,250,257.00),
	(251,251,257.75),
	(252,252,258.50),
	(253,253,259.25),
	(254,254,260.00),
	(255,255,260.75),
	(256,256,261.50),
	(257,257,262.25),
	(258,258,263.00),
	(259,259,263.75),
	(260,260,264.50),
	(261,261,265.25),
	(262,262,266.00),
	(263,263,266.75),
	(264,264,267.50),
	(265,265,268.25),
	(266,266,269.00),
	(267,267,269.75),
	(268,268,270.50),
	(269,269,271.25),
	(270,270,272.00),
	(271,271,272.75),
	(272,272,273.50),
	(273,273,274.25),
	(274,274,275.00),
	(275,275,275.75),
	(276,276,276.50),
	(277,277,277.25),
	(278,278,278.00),
	(279,279,278.75),
	(280,280,279.50),
	(281,281,280.25),
	(282,282,281.00),
	(283,283,281.75),
	(284,284,282.50),
	(285,285,283.25),
	(286,286,284.00),
	(287,287,284.75),
	(288,288,285.50),
	(289,289,286.25),
	(290,290,287.00),
	(291,291,287.75),
	(292,292,288.50),
	(293,293,289.25),
	(294,294,290.00),
	(295,295,290.75),
	(296,296,291.50),
	(297,297,292.25),
	(298,298,293.00),
	(299,299,293.75),
	(300,300,294.50),
	(301,301,295.25),
	(302,302,296.00),
	(303,303,296.75),
	(304,304,297.50),
	(305,305,298.25),
	(306,306,299.00),
	(307,307,299.75),
	(308,308,300.50),
	(309,309,301.25),
	(310,310,302.00),
	(311,311,302.75),
	(312,312,303.50),
	(313,313,304.25),
	(314,314,305.00),
	(315,315,305.75),
	(316,316,306.50),
	(317,317,307.25),
	(318,318,308.00),
	(319,319,308.75),
	(320,320,309.50),
	(321,321,310.25),
	(322,322,311.00),
	(323,323,311.75),
	(324,324,312.50),
	(325,325,313.25),
	(326,326,314.00),
	(327,327,314.75),
	(328,328,315.50),
	(329,329,316.25),
	(330,330,317.00),
	(331,331,317.00),
	(332,332,317.00),
	(333,333,317.00),
	(334,334,317.00),
	(335,335,317.00),
	(336,336,317.00),
	(337,337,317.00),
	(338,338,317.00),
	(339,339,317.00),
	(340,340,317.00),
	(341,341,317.00),
	(342,342,317.00),
	(343,343,317.00),
	(344,344,317.00),
	(345,345,317.00),
	(346,346,317.00),
	(347,347,317.00),
	(348,348,317.00),
	(349,349,317.00),
	(350,350,317.00),
	(351,351,317.00),
	(352,352,317.00),
	(353,353,317.00),
	(354,354,317.00),
	(355,355,317.00),
	(356,356,317.00),
	(357,357,317.00),
	(358,358,317.00),
	(359,359,317.00),
	(360,360,317.00),
	(361,361,317.00),
	(362,362,317.00),
	(363,363,317.00),
	(364,364,317.00),
	(365,365,317.00);

/*!40000 ALTER TABLE `tbl_parking_aire_libre` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla tbl_parking_cubierto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_parking_cubierto`;

CREATE TABLE `tbl_parking_cubierto` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dia` int(11) NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_parking_cubierto` WRITE;
/*!40000 ALTER TABLE `tbl_parking_cubierto` DISABLE KEYS */;

INSERT INTO `tbl_parking_cubierto` (`id`, `dia`, `valor`)
VALUES
	(1,1,20.00),
	(2,2,20.00),
	(3,3,25.00),
	(4,4,30.00),
	(5,5,33.00),
	(6,6,36.00),
	(7,7,39.00),
	(8,8,41.00),
	(9,9,43.00),
	(10,10,45.00),
	(11,11,47.00),
	(12,12,49.00),
	(13,13,51.00),
	(14,14,53.00),
	(15,15,55.00),
	(16,16,57.00),
	(17,17,59.00),
	(18,18,61.00),
	(19,19,63.00),
	(20,20,65.00),
	(21,21,67.00),
	(22,22,69.00),
	(23,23,71.00),
	(24,24,73.00),
	(25,25,75.00),
	(26,26,77.00),
	(27,27,79.00),
	(28,28,81.00),
	(29,29,83.00),
	(30,30,85.00),
	(31,31,87.00),
	(32,32,89.00),
	(33,33,91.00),
	(34,34,93.00),
	(35,35,95.00),
	(36,36,97.00),
	(37,37,99.00),
	(38,38,101.00),
	(39,39,103.00),
	(40,40,105.00),
	(41,41,107.00),
	(42,42,109.00),
	(43,43,111.00),
	(44,44,113.00),
	(45,45,115.00),
	(46,46,117.00),
	(47,47,119.00),
	(48,48,121.00),
	(49,49,123.00),
	(50,50,125.00),
	(51,51,127.00),
	(52,52,129.00),
	(53,53,131.00),
	(54,54,133.00),
	(55,55,135.00),
	(56,56,137.00),
	(57,57,139.00),
	(58,58,141.00),
	(59,59,143.00),
	(60,60,145.00),
	(61,61,146.50),
	(62,62,148.00),
	(63,63,149.50),
	(64,64,151.00),
	(65,65,152.50),
	(66,66,154.00),
	(67,67,155.50),
	(68,68,157.00),
	(69,69,158.50),
	(70,70,160.00),
	(71,71,161.50),
	(72,72,163.00),
	(73,73,164.50),
	(74,74,166.00),
	(75,75,167.50),
	(76,76,169.00),
	(77,77,170.50),
	(78,78,172.00),
	(79,79,173.50),
	(80,80,175.00),
	(81,81,176.50),
	(82,82,178.00),
	(83,83,179.50),
	(84,84,181.00),
	(85,85,182.50),
	(86,86,184.00),
	(87,87,185.50),
	(88,88,187.00),
	(89,89,188.50),
	(90,90,190.00),
	(91,91,191.50),
	(92,92,193.00),
	(93,93,194.50),
	(94,94,196.00),
	(95,95,197.50),
	(96,96,199.00),
	(97,97,200.50),
	(98,98,202.00),
	(99,99,203.50),
	(100,100,205.00),
	(101,101,206.50),
	(102,102,208.00),
	(103,103,209.50),
	(104,104,211.00),
	(105,105,212.50),
	(106,106,214.00),
	(107,107,215.50),
	(108,108,217.00),
	(109,109,218.50),
	(110,110,220.00),
	(111,111,221.50),
	(112,112,223.00),
	(113,113,224.50),
	(114,114,226.00),
	(115,115,227.50),
	(116,116,229.00),
	(117,117,230.50),
	(118,118,232.00),
	(119,119,233.50),
	(120,120,235.00),
	(121,121,236.50),
	(122,122,238.00),
	(123,123,239.50),
	(124,124,241.00),
	(125,125,242.50),
	(126,126,244.00),
	(127,127,245.50),
	(128,128,247.00),
	(129,129,248.50),
	(130,130,250.00),
	(131,131,251.50),
	(132,132,253.00),
	(133,133,254.50),
	(134,134,256.00),
	(135,135,257.50),
	(136,136,259.00),
	(137,137,260.50),
	(138,138,262.00),
	(139,139,263.50),
	(140,140,265.00),
	(141,141,266.50),
	(142,142,268.00),
	(143,143,269.50),
	(144,144,271.00),
	(145,145,272.50),
	(146,146,274.00),
	(147,147,275.50),
	(148,148,277.00),
	(149,149,278.50),
	(150,150,280.00),
	(151,151,281.50),
	(152,152,283.00),
	(153,153,284.50),
	(154,154,286.00),
	(155,155,287.50),
	(156,156,289.00),
	(157,157,290.50),
	(158,158,292.00),
	(159,159,293.50),
	(160,160,295.00),
	(161,161,296.50),
	(162,162,298.00),
	(163,163,299.50),
	(164,164,301.00),
	(165,165,302.50),
	(166,166,304.00),
	(167,167,305.50),
	(168,168,307.00),
	(169,169,308.50),
	(170,170,310.00),
	(171,171,311.50),
	(172,172,313.00),
	(173,173,314.50),
	(174,174,316.00),
	(175,175,317.50),
	(176,176,319.00),
	(177,177,320.50),
	(178,178,322.00),
	(179,179,323.50),
	(180,180,325.00),
	(181,181,326.50),
	(182,182,328.00),
	(183,183,329.50),
	(184,184,331.00),
	(185,185,332.50),
	(186,186,334.00),
	(187,187,335.50),
	(188,188,337.00),
	(189,189,338.50),
	(190,190,340.00),
	(191,191,341.50),
	(192,192,343.00),
	(193,193,344.50),
	(194,194,346.00),
	(195,195,347.50),
	(196,196,349.00),
	(197,197,350.50),
	(198,198,352.00),
	(199,199,353.50),
	(200,200,355.00),
	(201,201,356.50),
	(202,202,358.00),
	(203,203,359.50),
	(204,204,361.00),
	(205,205,362.50),
	(206,206,364.00),
	(207,207,365.50),
	(208,208,367.00),
	(209,209,368.50),
	(210,210,370.00),
	(211,211,371.50),
	(212,212,373.00),
	(213,213,374.50),
	(214,214,376.00),
	(215,215,377.50),
	(216,216,379.00),
	(217,217,380.50),
	(218,218,382.00),
	(219,219,383.50),
	(220,220,385.00),
	(221,221,386.50),
	(222,222,388.00),
	(223,223,389.50),
	(224,224,391.00),
	(225,225,392.50),
	(226,226,394.00),
	(227,227,395.50),
	(228,228,397.00),
	(229,229,398.50),
	(230,230,400.00),
	(231,231,401.50),
	(232,232,403.00),
	(233,233,404.50),
	(234,234,406.00),
	(235,235,407.50),
	(236,236,409.00),
	(237,237,410.50),
	(238,238,412.00),
	(239,239,413.50),
	(240,240,415.00),
	(241,241,416.50),
	(242,242,418.00),
	(243,243,419.50),
	(244,244,421.00),
	(245,245,422.50),
	(246,246,424.00),
	(247,247,425.50),
	(248,248,427.00),
	(249,249,428.50),
	(250,250,430.00),
	(251,251,431.50),
	(252,252,433.00),
	(253,253,434.50),
	(254,254,436.00),
	(255,255,437.50),
	(256,256,439.00),
	(257,257,440.50),
	(258,258,442.00),
	(259,259,443.50),
	(260,260,445.00),
	(261,261,446.50),
	(262,262,448.00),
	(263,263,449.50),
	(264,264,451.00),
	(265,265,452.50),
	(266,266,454.00),
	(267,267,455.50),
	(268,268,457.00),
	(269,269,458.50),
	(270,270,460.00),
	(271,271,461.50),
	(272,272,463.00),
	(273,273,464.50),
	(274,274,466.00),
	(275,275,467.50),
	(276,276,469.00),
	(277,277,470.50),
	(278,278,472.00),
	(279,279,473.50),
	(280,280,475.00),
	(281,281,476.50),
	(282,282,478.00),
	(283,283,479.50),
	(284,284,481.00),
	(285,285,482.50),
	(286,286,484.00),
	(287,287,485.50),
	(288,288,487.00),
	(289,289,488.50),
	(290,290,490.00),
	(291,291,491.50),
	(292,292,493.00),
	(293,293,494.50),
	(294,294,496.00),
	(295,295,497.50),
	(296,296,499.00),
	(297,297,500.50),
	(298,298,502.00),
	(299,299,503.50),
	(300,300,505.00),
	(301,301,506.50),
	(302,302,508.00),
	(303,303,509.50),
	(304,304,511.00),
	(305,305,512.50),
	(306,306,514.00),
	(307,307,515.50),
	(308,308,517.00),
	(309,309,518.50),
	(310,310,520.00),
	(311,311,521.50),
	(312,312,523.00),
	(313,313,524.50),
	(314,314,526.00),
	(315,315,527.50),
	(316,316,529.00),
	(317,317,530.50),
	(318,318,532.00),
	(319,319,533.50),
	(320,320,535.00),
	(321,321,536.50),
	(322,322,538.00),
	(323,323,539.50),
	(324,324,541.00),
	(325,325,542.50),
	(326,326,544.00),
	(327,327,545.50),
	(328,328,547.00),
	(329,329,548.50),
	(330,330,550.00),
	(331,331,550.00),
	(332,332,550.00),
	(333,333,550.00),
	(334,334,550.00),
	(335,335,550.00),
	(336,336,550.00),
	(337,337,550.00),
	(338,338,550.00),
	(339,339,550.00),
	(340,340,550.00),
	(341,341,550.00),
	(342,342,550.00),
	(343,343,550.00),
	(344,344,550.00),
	(345,345,550.00),
	(346,346,550.00),
	(347,347,550.00),
	(348,348,550.00),
	(349,349,550.00),
	(350,350,550.00),
	(351,351,550.00),
	(352,352,550.00),
	(353,353,550.00),
	(354,354,550.00),
	(355,355,550.00),
	(356,356,550.00),
	(357,357,550.00),
	(358,358,550.00),
	(359,359,550.00),
	(360,360,550.00),
	(361,361,550.00),
	(362,362,550.00),
	(363,363,550.00),
	(364,364,550.00),
	(365,365,550.00);

/*!40000 ALTER TABLE `tbl_parking_cubierto` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla tbl_reservas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_reservas`;

CREATE TABLE `tbl_reservas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha_entrega` date NOT NULL,
  `hora_entrega` time NOT NULL,
  `fecha_recogida` date NOT NULL,
  `hora_recogida` time NOT NULL,
  `tipo_plaza` varchar(100) NOT NULL DEFAULT '',
  `terminal_entrega` varchar(100) NOT NULL DEFAULT '',
  `terminal_recogida` varchar(100) NOT NULL DEFAULT '',
  `matricula` varchar(50) NOT NULL DEFAULT '',
  `color` varchar(60) DEFAULT NULL,
  `marca_modelo` varchar(250) NOT NULL DEFAULT '',
  `numero_vuelo_de_vuelta` varchar(50) DEFAULT NULL,
  `servicio_adicional` varchar(10) DEFAULT NULL,
  `total_pago_reserva` decimal(5,2) DEFAULT NULL,
  `formato_pago` varchar(250) DEFAULT NULL,
  `fecha_pago_factura` date DEFAULT NULL,
  `date_registro` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_reservas` WRITE;
/*!40000 ALTER TABLE `tbl_reservas` DISABLE KEYS */;

INSERT INTO `tbl_reservas` (`id`, `id_cliente`, `fecha_entrega`, `hora_entrega`, `fecha_recogida`, `hora_recogida`, `tipo_plaza`, `terminal_entrega`, `terminal_recogida`, `matricula`, `color`, `marca_modelo`, `numero_vuelo_de_vuelta`, `servicio_adicional`, `total_pago_reserva`, `formato_pago`, `fecha_pago_factura`, `date_registro`)
VALUES
	(2,1,'2023-11-09','12:37:00','2023-11-15','15:37:00','Plaza Cubierto','Aeropuerto de Alicante','Aeropuerto de Alicante','matri','rojo','Toyota - Corolla','145521','Si',45.00,NULL,NULL,'2023-11-12 14:35:20'),
	(3,2,'2023-11-16','02:42:00','2023-11-15','12:42:00','Plaza Cubierto','Aeropuerto de Alicante','Aeropuerto de Alicante','matricula','amrillo','Toyota - Corolla','000144','Si',20.00,NULL,NULL,'2023-11-15 14:35:24'),
	(4,1,'2023-11-08','23:55:00','2023-11-09','12:49:00','Plaza Cubierto','Aeropuerto de Alicante','Aeropuerto de Alicante','m','azul cielo','mmc','788845','No',35.00,NULL,NULL,'2023-11-08 14:35:27'),
	(5,1,'2023-11-15','12:24:00','2023-11-15','16:24:00','Plaza Aire Libre','Aeropuerto de Alicante','Aeropuerto de Alicante','67','gris','67','877744','No',50.00,NULL,NULL,'2023-11-12 14:35:31'),
	(6,1,'2023-11-09','06:15:00','2023-11-18','07:45:00','Plaza Cubierto','Aeropuerto de Alicante','Aeropuerto de Alicante','5645','azul','444','222100','No',58.00,NULL,NULL,'2023-11-12 14:35:34'),
	(7,4,'2023-11-10','06:00:00','2023-11-13','05:45:00','Plaza Cubierto','Aeropuerto de Alicante','Aeropuerto de Alicante','666','vinotinto','666','888000','No',65.00,'Pago con Tarjeta de Crédito/Débito','2023-11-12','2023-11-12 17:57:52'),
	(8,5,'2023-11-15','05:45:00','2023-11-17','07:00:00','Plaza Cubierto','Aeropuerto de Alicante','Aeropuerto de Alicante','8888','negro','8888','999111','No',18.00,NULL,NULL,'2023-11-11 14:35:42'),
	(9,1,'2023-11-13','05:15:00','2023-11-15','05:15:00','Plaza Cubierto','Aeropuerto de Alicante','Aeropuerto de Alicante','454ht','rojo','chevrolet','01144','Si',35.00,'Cheque','2023-11-12','2023-11-12 17:59:40'),
	(10,1,'2023-11-14','05:45:00','2023-11-16','06:30:00','Plaza Cubierto','Aeropuerto de Alicante','Aeropuerto de Alicante','98989','789','879','789789','No',20.00,NULL,NULL,'2023-11-11 14:34:35');

/*!40000 ALTER TABLE `tbl_reservas` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;