-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-12-2023 a las 19:50:55
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_segegresado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresado`
--

DROP TABLE IF EXISTS `egresado`;
CREATE TABLE IF NOT EXISTS `egresado` (
  `Id_Egresado` int NOT NULL AUTO_INCREMENT,
  `Doc_Egresado` char(8) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Cod_Egresado` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Nom_Egresado` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Apa_Egresado` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Ama_Egresado` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Fech_Nacimiento` date NOT NULL,
  `Email_Egresado` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Tel_Egresado` char(9) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Dir_Egresado` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Id_Condicion` int NOT NULL,
  `Fech_Obtencion` date NOT NULL,
  `Foto_Egresado` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Id_Programa` int NOT NULL,
  PRIMARY KEY (`Id_Egresado`),
  UNIQUE KEY `Doc_Egresado` (`Doc_Egresado`),
  UNIQUE KEY `Cod_Egresado` (`Cod_Egresado`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `egresado`
--

INSERT INTO `egresado` (`Id_Egresado`, `Doc_Egresado`, `Cod_Egresado`, `Nom_Egresado`, `Apa_Egresado`, `Ama_Egresado`, `Fech_Nacimiento`, `Email_Egresado`, `Tel_Egresado`, `Dir_Egresado`, `Id_Condicion`, `Fech_Obtencion`, `Foto_Egresado`, `Id_Programa`) VALUES
(2, '74499797', '21A413', 'BRAYAM RUBEN', 'QUISPE', 'RAMOS', '1995-07-24', 'brayam@gmail.com', '918474850', 'CALLE LOS MANZANOS 309', 1, '2023-11-29', 'photo_74499797.jpg', 1),
(3, '74499448', '21A414', 'ZARAI LUCERO', 'QUISPE', 'RAMOS', '2003-09-26', 'lucero@gmail.com', '999999999', 'CALLE LOS MANZANOS 309', 2, '2023-12-01', 'photo_74499448.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleo`
--

DROP TABLE IF EXISTS `empleo`;
CREATE TABLE IF NOT EXISTS `empleo` (
  `Id_Empleo` int NOT NULL AUTO_INCREMENT,
  `Ruc_Empresa` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Nom_Empresa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Car_Empresa` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Id_EstLaboral` int NOT NULL,
  `Id_Ingreso` int NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date DEFAULT NULL,
  `Id_Egresado` int NOT NULL,
  PRIMARY KEY (`Id_Empleo`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `empleo`
--

INSERT INTO `empleo` (`Id_Empleo`, `Ruc_Empresa`, `Nom_Empresa`, `Car_Empresa`, `Id_EstLaboral`, `Id_Ingreso`, `Fecha_Inicio`, `Fecha_Fin`, `Id_Egresado`) VALUES
(6, '20603835191', 'GROUP SOLUTION TECNOLOGY SOCIEDAD ANÓNIMA CERRADA', 'PROGRAMADOR JUNIR', 2, 4, '2023-10-01', '2023-12-30', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `Id_Perfil` int NOT NULL AUTO_INCREMENT,
  `Desc_Perfil` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Vigente` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id_Perfil`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`Id_Perfil`, `Desc_Perfil`, `Vigente`) VALUES
(1, 'ADMINISTRADOR', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

DROP TABLE IF EXISTS `permiso`;
CREATE TABLE IF NOT EXISTS `permiso` (
  `Id_Permiso` int NOT NULL AUTO_INCREMENT,
  `Act_Egresado` tinyint(1) DEFAULT NULL,
  `Act_Usuario` tinyint(1) DEFAULT NULL,
  `Act_Perfil` tinyint(1) DEFAULT NULL,
  `Id_Perfil` int NOT NULL,
  PRIMARY KEY (`Id_Permiso`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`Id_Permiso`, `Act_Egresado`, `Act_Usuario`, `Act_Perfil`, `Id_Perfil`) VALUES
(1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practicas`
--

DROP TABLE IF EXISTS `practicas`;
CREATE TABLE IF NOT EXISTS `practicas` (
  `Id_Practicas` int NOT NULL AUTO_INCREMENT,
  `Id_Modulo` int NOT NULL,
  `Ruc_Empresa` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Nom_Empresa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Car_Practicas` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Id_Medio` int NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Hora_ByDia` int NOT NULL,
  `Id_Egresado` int NOT NULL,
  PRIMARY KEY (`Id_Practicas`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `practicas`
--

INSERT INTO `practicas` (`Id_Practicas`, `Id_Modulo`, `Ruc_Empresa`, `Nom_Empresa`, `Car_Practicas`, `Id_Medio`, `Fecha_Inicio`, `Fecha_Fin`, `Hora_ByDia`, `Id_Egresado`) VALUES
(4, 1, '20603835191', 'GROUP SOLUTION TECNOLOGY SOCIEDAD ANÓNIMA CERRADA', 'PRACTICANTE', 3, '2023-11-01', '2023-12-31', 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

DROP TABLE IF EXISTS `programa`;
CREATE TABLE IF NOT EXISTS `programa` (
  `Id_Programa` int NOT NULL AUTO_INCREMENT,
  `Nom_Programa` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Dir_Programa` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`Id_Programa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `Id_Usuario` int NOT NULL AUTO_INCREMENT,
  `Nom_Usuario` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Ape_Usuario` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `User_Usuario` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Pass_Usuario` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Id_Perfil` int NOT NULL,
  PRIMARY KEY (`Id_Usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_Usuario`, `Nom_Usuario`, `Ape_Usuario`, `User_Usuario`, `Pass_Usuario`, `Id_Perfil`) VALUES
(1, 'INSTITUTO', 'CAJAS', 'admin', 'admin', 1),
(2, 'BRAYAM', '', 'ubrayam', 'ubrayam', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
