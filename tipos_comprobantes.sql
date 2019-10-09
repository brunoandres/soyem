-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-10-2019 a las 17:48:57
-- Versión del servidor: 5.7.26
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_soyem`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_comprobantes`
--

DROP TABLE IF EXISTS `tipos_comprobantes`;
CREATE TABLE IF NOT EXISTS `tipos_comprobantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(79) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=152 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_comprobantes`
--

INSERT INTO `tipos_comprobantes` (`id`, `descripcion`) VALUES
(1, 'IVA - Alicuota Exento'),
(2, 'Impuesto Ley 25.413 Ali Gral s/Debitos'),
(3, 'Impuesto Ley 25.413 Ali Gral s/Creditos'),
(4, 'Transfer. e/Cuentas de Distinto Titular Cuit/l:30999112583-MUNIC S CARLOS DE BA'),
(5, 'Com.pago chq por caja'),
(6, 'Pago de Cheque por Caja - Tercero'),
(7, 'Comision Cheque Pagado por Clearing'),
(8, 'Pago de Cheque de Camara'),
(9, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30689110831 CC-255122877696000'),
(10, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20118995164 CC-292730042982000'),
(11, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27210725801 CC-285000006374'),
(12, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30708829745 CC-285000019299'),
(13, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20248602342 CA-400768720318'),
(14, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30710111495 CC-292292000561000'),
(15, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 30715472364 BCO NACION'),
(16, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27206790569 CA-255710467529000'),
(17, 'Transfer. e/Cuentas de Distinto Titular Cuenta:137-0151266 ENERGIA SRL'),
(18, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30689088925 CC-285000000789'),
(19, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27217803174 CA-2580411683'),
(20, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20142425646 CC-255719129153000'),
(21, 'Pago de Servicios Ente: CIA RADIOCOM MOVILES SA'),
(22, 'Pago de Servicios Ente: TELEFONICA DE ARG.'),
(23, 'Pago de Servicios Ente: COOP ELECTRICA BARILOCHE'),
(24, 'Pago de Servicios Ente: AGUAS RIONEGRINAS SE'),
(25, 'Pago de Servicios Ente: CAMUZZI GAS DEL SUR'),
(26, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27140017162 CC-285003648496'),
(27, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27298526420 CA-250122864248000'),
(28, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 27245677435 BCO NEUQUEN'),
(29, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27334423277 CA-2580478543'),
(30, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27340197866 CA-2823251746'),
(31, 'Pago de Cheque de Canje Interno'),
(32, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 20260817702 BCO NACION'),
(33, 'Transf. Interbanking - Distinto Titular Ord.:30999112583-MUNICIPALIDAD DE BARIL'),
(34, 'Debito/Credito Aut-Seg. Protecc. Cajero SEGUR.PROT.ROBO CAJ.-7575270300000006'),
(35, 'Debito/Cred Aut - Segurcoop Seguro Vida SEGUR.SOCIO SEG.VIDA-1717003221768601'),
(36, 'Transf. Interbanking - Distinto Titular Ord.:30999112583-MUNICIPALIDAD BCHE TAS'),
(37, 'Transferencia por Pago de Haberes Se acreditara en: 11 Cuentas'),
(38, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27363532387 CA-403056770311'),
(39, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30689541166 CA-252109997414000'),
(40, 'Pago de Obligaciones a AFIP Tipo de Pago: VEP AFIP'),
(41, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 30708047445 BCO NEUQUEN'),
(42, 'Com. mantenimiento cuenta'),
(43, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30594833089 CC-292292001277000'),
(44, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 30708501790 BCO NACION'),
(45, 'Transfer. e/Cuentas de Distinto Titular Cuenta:137-0168671 UNIV NAC COMAHUE CUR'),
(46, 'Constitucion de Plazo Fijo (Exento) Operacion: 5036036 - Circular: 037'),
(47, 'Vencimiento Plazo Fijo (Exento)'),
(48, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27227928420 CC-285004443267'),
(49, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 34500045339 CC-115000050142'),
(50, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 30672953517 BCO NACION'),
(51, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20336582718 CC-000567820310'),
(52, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30689133483 CC-303400000900553'),
(53, 'Transfer. e/Cuentas de Distinto Titular Cuenta:137-0151464 COOP TRAB COO TRA ME'),
(54, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20294287842 CA-255122870119000'),
(55, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20282368367 CA-255122866902000'),
(56, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27327685258 CC-099003784723'),
(57, 'Suscripcion al Periodico Accion'),
(58, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27265567466 CA-255122896666000'),
(59, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 20268100300 BCO NACION'),
(60, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 20265040773 BCO NACION'),
(61, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20147599871 CA-255730038942000'),
(62, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20201221375 CA-255730038634001'),
(63, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20299408931 CA-466209478371591'),
(64, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27173367142 CA-255730039683001'),
(65, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20925085201 CA-466209476357245'),
(66, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27247766397 CC-366209410926472'),
(67, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 24258255018 BCO NACION'),
(68, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 23387899294 BCO NACION'),
(69, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 20145196214 BCO NACION'),
(70, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20222951098 CA-466209478061580'),
(71, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 20170617968 BCO NACION'),
(72, 'Transfer. e/Cuentas de Distinto Titular Cuenta:137-0087598 CASA PALM SACII Y A'),
(73, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27173367800 CC-305000000130316'),
(74, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 30531602273 BCO NACION'),
(75, 'Transfer. e/Cuentas de Distinto Titular Cuenta:137-5013495 R S ARAZI'),
(76, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27301370003 CA-292100106581001'),
(77, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20201239444 CC-285003636307'),
(78, 'Transfer. e/Cuentas de Distinto Titular Cuenta:070-0340606 COOP DE TRAB BS AS'),
(79, 'Debito/Credito Aut-Seg. Protecc. Cajero SEGUR.PROT.ROBO CAJ.-7575270300000005'),
(80, 'Debito/Cred Aut - Segurcoop Seguro Vida SEGUR.SOCIO SEG.VIDA-1717003221259501'),
(81, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20073011605 CA-255725000272000'),
(82, 'Debito/Credito Aut-Edic. Desde la Gente IMFC-GEN0000000000000000137750'),
(83, 'GESVAL - Acreditacion de Valores'),
(84, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30999077508 CC-250900001477000'),
(85, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30639453975 CC-02572381009'),
(86, 'Constitucion de Plazo Fijo (Exento) Operacion: 4940703 - Circular: 037'),
(87, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30526874249 CC-4700004061'),
(88, 'Transfer. e/Cuentas de Distinto Titular Cuenta:137-0116618 HOSP PRIV REG DEL SU'),
(89, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20327103432 CA-402933931291'),
(90, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27286163586 CC-133133004219000'),
(91, 'Transf. Inmediata e/Ctas. Dist. Titular'),
(92, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20208088891 CA-466209494567864'),
(93, 'Pago Cheque Canje Interno-S/ Impuestos'),
(94, 'Cheque Rechazado por Otros Motivos'),
(95, 'Pago de Cheque de Camara-Sin Impuestos'),
(96, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27334423277 CC-285003691872'),
(97, 'Pago de Servicios Ente: EDERSA'),
(98, 'Debito/Credito Aut-Seg. Protecc. Cajero SEGUR.PROT.ROBO CAJ.-7575270300000004'),
(99, 'Com.pedido chequeras'),
(100, 'Debito/Cred Aut - Segurcoop Seguro Vida SEGUR.SOCIO SEG.VIDA-1717003220401701'),
(101, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20142778573 CA-255122853033001'),
(102, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 27250588874 BCO NACION'),
(103, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30517956011 CC-4870001602'),
(104, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 30672995821 BCO NACION'),
(105, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27928946644 CA-6816102093'),
(106, 'Debito/Credito Aut-Seg. Protecc. Cajero SEGUR.PROT.ROBO CAJ.-7575270300000003'),
(107, 'Debito/Cred Aut - Segurcoop Seguro Vida SEGUR.SOCIO SEG.VIDA-1717003220151801'),
(108, 'Debito/Credito Aut-Edic. Desde la Gente IMFC-GEN0000000000000000135678'),
(109, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 20313587712 BCO NEUQUEN'),
(110, 'Transfer. e/Cuentas de Distinto Titular Cuit/l:30999112583-MUNICIP DE SAN CARLO'),
(111, 'GESVAL - Comision p/ Gestion de Valores'),
(112, 'Transfer. e/Cuentas de Distinto Titular Cuenta:137-5970617 PROGRAMA ASUMIR ASOC'),
(113, 'Debito/Credito Aut-Seg. Protecc. Cajero SEGUR.PROT.ROBO CAJ.-7575270300000002'),
(114, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27184751424 CA-255122869537000'),
(115, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20225042129 CC-285000017903'),
(116, 'Debito/Cred Aut-Serv. Banca Elec. Empr. B. INTERNET MANTENIM-000019522'),
(117, 'Debito/Cred Aut - Segurcoop Seguro Vida SEGUR.SOCIO SEG.VIDA-1717003095570301'),
(118, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 23103818524 CA-252126690384000'),
(119, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 27280667876 BCO NACION'),
(120, 'GESVAL - Cheque Rechazado'),
(121, 'Transfer. e/Cuentas de Distinto Titular Cuenta:137-5177421 FANELLO PATRICIA M'),
(122, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 20215896227 BCO NACION'),
(123, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 20322151668 BCO NEUQUEN'),
(124, 'Transfer. e/Cuentas de Distinto Titular Cuit/l:30586762199-UNIV NAC COMAHUE CUR'),
(125, 'Com.ret-chq caja o.filial'),
(126, 'Pago Cheque p/ Caja en o/Filial-Tercero'),
(127, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27340196517 CC-2580142136'),
(128, 'Debito/Credito Aut-Seg. Protecc. Cajero SEGUR.PROT.ROBO CAJ.-7575270300000001'),
(129, 'Transferencia por Pago de Haberes Se acreditara en: 10 Cuentas'),
(130, 'Debito/Cred Aut - Segurcoop Seguro Vida SEGUR.SOCIO SEG.VIDA-1717003095113301'),
(131, 'Debito/Credito Aut-Edic. Desde la Gente IMFC-GEN0000000000000000133700'),
(132, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30999240298 CA-255122902926000'),
(133, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20237813341 CA-2580197183'),
(134, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 27127977866 BCO NEUQUEN'),
(135, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30678753374 CC-1110048894'),
(136, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 20259664013 BCO CIUDAD'),
(137, 'Debito/Credito Aut-Seg. Protecc. Cajero SEGUR.PROT.ROBO CAJ.-7575134370000012'),
(138, 'Debito/Cred Aut - Segurcoop Seguro Vida SEGUR.SOCIO SEG.VIDA-1717003094702501'),
(139, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 20344036331 BCO NEUQUEN'),
(140, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30708053100 CC-029000142953'),
(141, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 20134625717 CA-303303005555000'),
(142, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27308750316 CA-255122873963001'),
(143, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27279655325 CA-255122856482000'),
(144, 'Transf. Inmediata e/Ctas. Dist. Titular Cuit/l Dest.: 20144067038 BCO NACION'),
(145, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27254023367 CC-292292008714000'),
(146, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 27167450232 CA-255122865902000'),
(147, 'Transfer. e/Cuentas de Distinto Titular Cuenta:093-0321707 BREZNIW VIRGINIA'),
(148, 'Debito/Credito Aut-Seg. Protecc. Cajero SEGUR.PROT.ROBO CAJ.-7575134370000011'),
(149, 'Transf. Inmediata e/Ctas. Dist. Titular Cui: 30648209416 CC-252900001404000'),
(150, 'Debito/Cred Aut - Segurcoop Seguro Vida SEGUR.SOCIO SEG.VIDA-1717003094259301'),
(151, 'Debito/Credito Aut-Edic. Desde la Gente IMFC-GEN0000000000000000131778');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
