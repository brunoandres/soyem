-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-05-2019 a las 03:57:02
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sistema_soyem`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

CREATE TABLE IF NOT EXISTS `recibos` (
  `rec_id` int(9) NOT NULL AUTO_INCREMENT,
  `rec_nro` varchar(13) NOT NULL,
  `rec_fecha` date NOT NULL,
  `rec_nombre` varchar(90) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `rec_legajo` varchar(20) NOT NULL,
  `rec_domicilio` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `rec_localidad` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `rec_cuit` varchar(15) NOT NULL,
  `rec_iva` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `rec_importe` decimal(10,2) NOT NULL,
  `rec_concepto` int(3) NOT NULL,
  `rec_detalles` blob NOT NULL,
  `rec_importe_efectivo` decimal(10,2) NOT NULL,
  `rec_importe_cheque` decimal(10,2) NOT NULL,
  `rec_banco` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `rec_cheque_nro` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `rec_imp` varchar(1) NOT NULL DEFAULT 'N',
  `rec_anulado` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`rec_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5456 ;

--
-- Volcado de datos para la tabla `recibos`
--

INSERT INTO `recibos` (`rec_id`, `rec_nro`, `rec_fecha`, `rec_nombre`, `rec_legajo`, `rec_domicilio`, `rec_localidad`, `rec_cuit`, `rec_iva`, `rec_importe`, `rec_concepto`, `rec_detalles`, `rec_importe_efectivo`, `rec_importe_cheque`, `rec_banco`, `rec_cheque_nro`, `rec_imp`, `rec_anulado`) VALUES
(8, '0002-00000812', '2015-01-06', 'CARDENAS ANA MARIA', '92049', '', 'San Carlos de Bariloche', '', 'Consumidor Final', '584.60', 4, 0x63746120736f6369616c206e6f762e313420243132392e30300d0a6661726d6163696120243135312e36300d0a6f707469636120243230302e30300d0a707369636f6c6f6769612024313034, '584.60', '0.00', '', '', 'N', 'S'),
(9, '0002-00000814', '2015-01-06', 'VERA CELEDINO', '279', '', 'San Carlos de Bariloche', '', 'Consumidor Final', '1287.00', 14, 0x352079203620637461206361746172617461732032303134, '1287.00', '0.00', '', '', 'N', 'S');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
