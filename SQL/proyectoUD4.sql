-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para catalogoproductos
CREATE DATABASE IF NOT EXISTS `catalogoproductos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci */;
USE `catalogoproductos`;

-- Volcando estructura para tabla catalogoproductos.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fabricante` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `pvp` decimal(20,2) NOT NULL DEFAULT 0.00,
  `link` varchar(250) NOT NULL,
  `picture` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla catalogoproductos.productos: ~13 rows (aproximadamente)
INSERT INTO `productos` (`id`, `fabricante`, `nombre`, `stock`, `pvp`, `link`, `picture`) VALUES
	(1, 'KBSim', 'Gladiator NXT EVO ‘Space Combat Edition’', 120, 169.00, 'https://flightsimcontrols.com/product/gladiator-evo-space-combat-edition/', 'https://flightsimcontrols.com/wp-content/uploads/2022/03/70_GNX-EVOSCG-P_R_800_2.jpg'),
	(2, 'Thrustmaster', 'HOTAS WARTHOG™', 110, 549.99, 'https://shop.thrustmaster.com/pt_pt/hotas-warthog.html?gad_source=1&gad_campaignid=21425725666&gbraid=0AAAAAqqxBJ_Ye_UFBw3iY7HAJtjAxyhBT&gclid=Cj0KCQjw0Y3HBhCxARIsAN7931WXcCKYolzH5KjwuEeXlYiXQU6TkNAf8WeyfP1T9_kkpIm870BKcVkaAokBEALw_wcB', 'https://shop.thrustmaster.com/media/catalog/product/h/o/hotaswarthog_1000x1000_3.webp'),
	(3, 'Logitech', 'X56 H.O.T.A.S.', 140, 299.99, 'https://www.logitechg.com/es-es/products/space/x56-space-flight-vr-simulator-controller.945-000059.html', 'https://m.media-amazon.com/images/I/61nAWk4GT8L._UF1000,1000_QL80_.jpg'),
	(4, 'Thrustmaster', 'TCA OFFICER PACK AIRBUS EDITION', 90, 179.99, 'https://shop.thrustmaster.com/es_es/tca-officer-pack-airbus-edition.html?srsltid=AfmBOopFVUK6uzKgyGST_xkv6LAzXEjBTgLcUlBt3NYjGMsuo7K_MvzK', 'https://shop.thrustmaster.com/media/catalog/product/t/c/tcaofficerpack_wb1.webp'),
	(5, 'Thrustmaster', 'T.Flight Rudder Pedals', 200, 109.99, 'https://www.thrustmaster.com/es-es/products/t-flight-rudder-pedals/', 'https://shop.thrustmaster.com/media/catalog/product/t/f/tfrp-rudder_1_1.webp'),
	(6, 'Thrustmaster', 'T.Flight Hotas X', 112, 79.99, 'https://www.thrustmaster.com/es-es/products/t-flight-hotas-x-8/', 'https://m.media-amazon.com/images/I/71T+cWTYOHL.jpg'),
	(7, 'Thrustmaster', 'TWCS Throttle', 133, 109.99, 'https://www.thrustmaster.com/es-es/products/twcs-throttle/', 'https://m.media-amazon.com/images/I/61Djj94n88L._UF894,1000_QL80_.jpg'),
	(8, 'Thrustmaster', 'F/A-18C Hornet™ HOTAS Add-On Grip', 76, 199.99, 'https://www.thrustmaster.com/es-es/products/f-a-18c-hornet-hotas-add-on-grip/', 'https://thumb.pccomponentes.com/w-530-530/articles/22/223625/1.jpg'),
	(49, 'Hori Europe', 'HOTAS Flight Stick para PlayStation®4', 100, 99.99, 'https://horieurope.com/es-eu/products/hotas-flight-stick-for-playstation4', 'https://horieurope.com/cdn/shop/files/PS4-144E_1.png');

-- Volcando estructura para tabla catalogoproductos.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `passwd` char(60) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla catalogoproductos.usuario: ~1 rows (aproximadamente)
INSERT INTO `usuario` (`idUsuario`, `usuario`, `passwd`, `isAdmin`) VALUES
	(9, 'admin', '$2y$10$ki887GxDnVb/PEe/N4xUj.NYzuDfsYw8tSRvnBY896oyR377ALltW', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
