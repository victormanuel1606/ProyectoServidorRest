-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-08-2017 a las 15:36:07
-- Versión del servidor: 5.6.25-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gamesexpress`
--
CREATE DATABASE IF NOT EXISTS `gamesexpress` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gamesexpress`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `Destino` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `referencias` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `Origen` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Precio` int(11) NOT NULL,
  `Nombre_Cliente` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`idPedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idPedido`, `Destino`, `referencias`, `Origen`, `Precio`, `Nombre_Cliente`) VALUES
(1, 'Penjamo', 'Frente a un puente', 'Mexico', 500, 'Navarro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicasion`
--

CREATE TABLE IF NOT EXISTS `ubicasion` (
  `idUbicasion` int(11) NOT NULL,
  `Ciudad` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Proveedor` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Fecha_llegada` date NOT NULL,
  `idPedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `ubicasion`
--

INSERT INTO `ubicasion` (`idUbicasion`, `Ciudad`, `Proveedor`, `Fecha_llegada`, `idPedido`) VALUES
(1, 'Mexico', 'Intel', '2017-07-06', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
