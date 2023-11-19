# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Base de datos: bd_alcvaletparking
# Tiempo de Generación: 2023-11-08 02:23:13 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla clientes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `IdUser` int(10) NOT NULL AUTO_INCREMENT,
  `emailUser` varchar(50) DEFAULT NULL,
  `passwordUser` varchar(250) DEFAULT NULL,
  `nombre_completo` varchar(250) DEFAULT NULL,
  `din` char(50) DEFAULT NULL,
  `direccion_completa` mediumtext DEFAULT NULL,
  `tlf` varchar(20) DEFAULT NULL,
  `conocido_por` varchar(60) DEFAULT NULL,
  `observaciones` mediumtext DEFAULT NULL,
  `terminos` int(11) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `sesionDesde` varchar(30) DEFAULT NULL,
  `sesionHasta` varchar(30) DEFAULT NULL,
  `createUser` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IdUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;

INSERT INTO `clientes` (`IdUser`, `emailUser`, `passwordUser`, `nombre_completo`, `din`, `direccion_completa`, `tlf`, `conocido_por`, `observaciones`, `terminos`, `rol`, `sesionDesde`, `sesionHasta`, `createUser`)
VALUES
	(1,'hola@gmail.com','$2y$10$4BGjpWNNaEtT.G.jnUENhevXws7gocLQ5q4KW.UJ2qCXXd8y0Z78W','urian','din','direcion completa','78787','Un Amigo','Observacion',1,NULL,'2023-11-08 02:34:26',NULL,'2023-11-07 03:00:03'),
	(2,'any@gmail.com','$2y$10$sV6v2xUhy2jZtjO7vGvfkebuz.Az01v5g6.OgubbF19HJhEHdUQDW','Any L','543545','car 9','4455465','Google','nada',1,0,'2023-11-08 03:18:10',NULL,'2023-11-08 03:18:00');

/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
