-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-02-2016 a las 03:34:36
-- Versión del servidor: 5.1.73
-- Versión de PHP: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_newcapital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficheros`
--

CREATE TABLE IF NOT EXISTS `ficheros` (
  `idficheros` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `Nombre` varchar(500) DEFAULT NULL,
  `fichero` blob,
  `Link` varchar(500) DEFAULT NULL,
  `descripcion` varchar(2000) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idficheros`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `ficheros`
--

INSERT INTO `ficheros` (`idficheros`, `fecha`, `Nombre`, `fichero`, `Link`, `descripcion`, `estado`) VALUES
(1, '2015-12-06', 'Google', NULL, 'www.google.com.pe', 'Podras buscar', 0),
(2, '2015-12-01', 'Gmail', NULL, 'www.gmail.com', 'Correo electronico', 0),
(3, '2015-12-08', 'qe', NULL, '../uploads/8.PNG', 'qwe', 0),
(4, '2015-12-08', 'qe2', NULL, '../uploads/4.PNG', 'qwe', 0),
(5, '2015-12-08', 'Prueba', NULL, '../FicherosUpload/1.PNG', 'Prueba Desc', 0),
(6, '2015-12-08', 'ss', NULL, '../NoticiasUpload/7.PNG', 'qq', 0),
(7, '2015-12-08', 'asda', NULL, '../FicherosUpload/Cambio de umbrales.xlsx', 'sdasd', 0),
(8, '2015-12-08', 'PDF', NULL, '../FicherosUpload/Cap6.PDF', 'PDF Prueba', 0),
(9, '2015-12-08', 'Comprimido Prueba', NULL, '../FicherosUpload/Archivos e Imagenes Financiera.rar', 'Archivos Comprimidos', 1),
(10, '2015-12-08', 'Excel de Prueba', NULL, '<br />\n<b>Notice</b>:  Undefined index: File in <b>C:xampphtdocsNewCapitalUtilUpload.php</b> on line <b>3</b><br />\nerror', 'Excel con datos importantes de prueba', 0),
(11, '2015-12-08', 'Power Point de Prueba', NULL, '../FicherosUpload/Prueba Power Point.pptx', 'PPT de prueba ', 1),
(12, '2015-12-08', 'Proyect Prueba', NULL, '<br />\n<b>Notice</b>:  Undefined index: File in <b>C:xampphtdocsNewCapitalUtilUpload.php</b> on line <b>3</b><br />\nerror', 'Proyect de Prueba', 0),
(13, '2015-12-08', 'qw', NULL, '<br />\n<b>Notice</b>:  Undefined index: File in <b>C:xampphtdocsNewCapitalUtilUpload.php</b> on line <b>3</b><br />\nerror', 'ee', 0),
(14, '2015-12-08', '1', NULL, '<br />\n<b>Notice</b>:  Undefined index: File in <b>C:xampphtdocsNewCapitalUtilUpload.php</b> on line <b>3</b><br />\nerror', '3', 0),
(15, '2015-12-08', 'Excel Prueba', NULL, '../FicherosUpload/Prueba Excel.xlsx', 'Prueba Excel', 1),
(16, '2015-12-08', 'Contacto', NULL, '../FicherosUpload/Ronald Pacheco Alarcon.contact', 'Contacto Ronald Pacheco Alarcon', 0),
(17, '2015-12-09', 's', NULL, '../FicherosUpload/prueba2.jpg', 's', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fondos`
--

CREATE TABLE IF NOT EXISTS `fondos` (
  `idFondos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) DEFAULT NULL,
  `valorcuota` decimal(10,3) DEFAULT NULL,
  `ncuotas` decimal(10,3) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idFondos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Volcado de datos para la tabla `fondos`
--

INSERT INTO `fondos` (`idFondos`, `nombre`, `valorcuota`, `ncuotas`, `estado`) VALUES
(1, 'FondoPrueba', 1000.000, 10.000, 1),
(2, 'FondoPrueba02', 1000.000, 20.000, 0),
(3, 'FondoPrueba03', 1000.000, 10.000, 1),
(4, 'FondoPrueba04', 1000.000, 50.000, 0),
(5, 'FondoPrueba05', 1000.000, 70.000, 0),
(6, 'FondoPrueba07', 1000.000, 15.000, 0),
(7, 'FondoPrueba08', 1000.000, 15.000, 0),
(8, 'FondoPrueba09', 10.000, 15.000, 0),
(9, 'FondoPobre', 9.242, 2.000, 0),
(10, 'FondoFinal', 10.300, 100.000, 1),
(11, 'Fondo Baisco 01', 3.450, 1000.000, 1),
(12, 'ABC', 100.000, 100.000, 1),
(13, 'ChesaPeake E.C 3.25% Mar 15Â¨2016', 100.000, 1.000, 0),
(14, 'Chesapeake E.C 3.25 Mar 15Â´2016  @ 97.75%', 1000.000, 1.000, 0),
(15, 'Chesapeak Energy Corp', 97.750, 100.000, 0),
(16, 'Chesapeak Energy Corp 3.25% Marzo 15 2016', 97.750, 1000.000, 0),
(17, 'Chesapeak Energy Corp 3.25% Marzo 15 2016', 98.000, 100.000, 0),
(18, 'Deposito ROger Gutierrez', 100.000, 100.000, 0),
(19, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(20, 'Chesapeake Energy Corp 3.25% Marzo 15 2016', 97.750, 100.000, 0),
(21, 'Chesapeake Energy Corp 3.25% Marzo 15 2016', 97.750, 100.000, 0),
(22, 'Chesapeake Energy Corp 3.25% Marzo 15 2016 Nominal: $USD 4,000.00', 97.750, 100.000, 1),
(23, 'Chesapeak Enr.Corp 3.25% 15 Marzo 2016', 98.000, 100.000, 1),
(24, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(25, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(26, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(27, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(28, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(29, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(30, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(31, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(32, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(33, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(34, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(35, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(36, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(37, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(38, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(39, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(40, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(41, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(42, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(43, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(44, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(45, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(46, 'Cash Roger Gutierrez', 100.000, 100.000, 0),
(47, 'Cash Roger Gutierrez', 100.000, 100.000, 1),
(48, 'Vedanta Resources 6.75% Junio 07 2016', 98.000, 100.000, 1),
(49, 'Cash moises Eguez', 100.000, 100.000, 0),
(50, 'Cash Moises Egues', 100.000, 100.000, 1),
(51, 'NewCapital 10% Marzo 15 2035', 100.000, 100.000, 1),
(52, 'Cash Alvaro Barriga', 100.000, 100.000, 1),
(53, 'Royal Royal', 100.000, 100.000, 1),
(54, 'Camposol SA 9.875% Feb 2 - 2017 Nominal $USD 6,000.00', 84.980, 100.000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialvalorcuota`
--

CREATE TABLE IF NOT EXISTS `historialvalorcuota` (
  `idHistorialValorCuota` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `valorcuota` decimal(10,3) DEFAULT NULL,
  `Fondos_idFondos` int(11) NOT NULL,
  `Estado` int(11) NOT NULL,
  PRIMARY KEY (`idHistorialValorCuota`,`Fondos_idFondos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

--
-- Volcado de datos para la tabla `historialvalorcuota`
--

INSERT INTO `historialvalorcuota` (`idHistorialValorCuota`, `fecha`, `valorcuota`, `Fondos_idFondos`, `Estado`) VALUES
(1, '2015-11-27 00:00:00', 11.240, 1, 1),
(2, '2015-11-26 00:00:00', 14.220, 1, 1),
(3, '2015-11-28 00:00:00', 17.230, 1, 0),
(4, '2015-11-28 00:00:00', 600.000, 2, 0),
(5, '2015-11-27 00:00:00', 1000.000, 4, 1),
(6, '2015-11-30 00:00:00', 1000.000, 2, 0),
(7, '2015-11-27 00:00:00', 1000.000, 4, 1),
(8, '2015-11-30 00:00:00', 20.120, 1, 1),
(9, '2015-11-27 00:00:00', 1000.000, 2, 1),
(10, '2015-11-27 00:00:00', 1000.000, 4, 1),
(11, '2015-11-27 00:00:00', 1000.000, 5, 1),
(12, '2015-11-27 00:00:00', 1000.000, 6, 1),
(13, '2015-11-27 00:00:00', 1000.000, 7, 1),
(14, '2015-11-27 00:00:00', 10.000, 8, 1),
(15, '2015-11-27 00:00:00', 9.242, 9, 1),
(16, '2015-12-06 00:00:00', 13.650, 1, 1),
(17, '2015-12-01 00:00:00', 14.120, 1, 1),
(18, '2015-12-02 00:00:00', 12.430, 1, 1),
(19, '2015-12-03 00:00:00', 13.220, 1, 1),
(20, '2015-12-04 00:00:00', 14.590, 1, 1),
(21, '2015-12-05 00:00:00', 17.220, 1, 1),
(22, '2015-12-08 00:00:00', 10.300, 10, 1),
(23, '2015-12-08 19:44:36', 14.678, 10, 1),
(24, '2015-12-09 10:53:58', 12.780, 10, 1),
(25, '2015-12-09 10:57:34', 16.780, 1, 1),
(26, '2015-12-09 15:56:42', 3.450, 11, 1),
(27, '2015-12-09 15:57:15', 3.470, 11, 1),
(28, '2015-12-10 11:17:39', 100.000, 12, 1),
(29, '2015-12-10 11:20:47', 102.000, 12, 1),
(30, '2015-12-10 11:21:03', 103.000, 12, 1),
(31, '2015-12-10 11:21:07', 104.000, 12, 1),
(32, '2015-12-10 11:21:10', 105.000, 12, 1),
(33, '2015-12-10 11:21:13', 106.000, 12, 1),
(34, '2015-12-21 12:15:09', 3.870, 11, 1),
(35, '2015-12-22 00:00:00', 10.540, 10, 1),
(36, '2016-01-21 14:33:40', 100.000, 13, 1),
(37, '2016-01-21 14:40:43', 1000.000, 14, 1),
(38, '2016-01-21 16:05:22', 97.750, 15, 1),
(39, '2016-01-21 16:06:23', 97.750, 16, 1),
(40, '2016-01-22 16:58:16', 98.000, 17, 1),
(41, '2016-01-22 17:00:13', 100.000, 18, 1),
(42, '2016-01-22 17:00:41', 100.000, 19, 1),
(43, '2016-01-22 17:15:11', 97.750, 20, 1),
(44, '2016-01-25 15:17:32', 97.750, 21, 1),
(45, '2016-01-25 15:17:38', 97.750, 22, 1),
(46, '2016-01-25 15:24:48', 98.000, 23, 1),
(47, '2016-01-25 15:28:23', 100.000, 24, 1),
(48, '2016-01-25 15:28:24', 100.000, 25, 1),
(49, '2016-01-25 15:28:32', 100.000, 26, 1),
(50, '2016-01-25 15:28:38', 100.000, 27, 1),
(51, '2016-01-25 15:28:38', 100.000, 28, 1),
(52, '2016-01-25 15:28:38', 100.000, 29, 1),
(53, '2016-01-25 15:28:38', 100.000, 30, 1),
(54, '2016-01-25 15:28:38', 100.000, 31, 1),
(55, '2016-01-25 15:28:38', 100.000, 32, 1),
(56, '2016-01-25 15:28:39', 100.000, 33, 1),
(57, '2016-01-25 15:28:39', 100.000, 34, 1),
(58, '2016-01-25 15:28:39', 100.000, 35, 1),
(59, '2016-01-25 15:28:39', 100.000, 36, 1),
(60, '2016-01-25 15:28:39', 100.000, 37, 1),
(61, '2016-01-25 15:28:39', 100.000, 38, 1),
(62, '2016-01-25 15:28:40', 100.000, 39, 1),
(63, '2016-01-25 15:28:40', 100.000, 40, 1),
(64, '2016-01-25 15:28:40', 100.000, 41, 1),
(65, '2016-01-25 15:28:40', 100.000, 42, 1),
(66, '2016-01-25 15:28:41', 100.000, 43, 1),
(67, '2016-01-25 15:28:41', 100.000, 44, 1),
(68, '2016-01-25 15:28:41', 100.000, 45, 1),
(69, '2016-01-25 15:28:54', 100.000, 46, 1),
(70, '2016-01-25 16:09:51', 100.000, 47, 1),
(71, '2016-01-25 16:24:13', 98.000, 48, 1),
(72, '2016-01-25 16:31:16', 100.000, 49, 1),
(73, '2016-01-25 16:34:01', 100.000, 50, 1),
(74, '2016-01-26 12:15:00', 100.000, 51, 1),
(75, '2016-01-26 12:15:49', 100.000, 52, 1),
(76, '2016-01-26 13:34:56', 100.000, 53, 1),
(77, '2016-01-29 13:55:15', 84.980, 54, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `idnoticias` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) DEFAULT NULL,
  `descripcion` varchar(4000) DEFAULT NULL,
  `imagen` varchar(2000) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idnoticias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idnoticias`, `nombre`, `descripcion`, `imagen`, `fecha`, `estado`) VALUES
(1, 'Baja en la bolsa', 'Este ultimo fin de semana la bolsa bajo', NULL, '2015-12-01 00:00:00', 0),
(2, 'Subida en la bolsa', 'Este ultimo fin de semana la bolsa subio', NULL, '2015-12-07 00:00:00', 0),
(3, 'Bolsa regularizada', 'Este ultimo fin de semana la bolsa se regula', NULL, '2015-12-06 00:00:00', 0),
(4, 'Noticia Prueba', 'Prueba', NULL, '2015-12-16 00:00:00', 0),
(5, 'qq', 'w2123', '../NoticiasUpload/7.PNG', '2015-12-08 00:00:00', 0),
(6, 'Bolsa en alza', 'la bolsa subio', '../NoticiasUpload/prueba2.jpg', '2015-12-08 00:00:00', 0),
(7, 'Bola abajo', 'Bajo la bolsa ', '../NoticiasUpload/prueba1.jpg', '2015-12-08 00:00:00', 0),
(8, 'Noticia Prueba', 'Probando', '../NoticiasUpload/prueba2.jpg', '2015-12-09 00:00:00', 0),
(9, 'David Lagos presenta Made in Jerez en los Jue', 'AdemÃ¡s, cabe resaltar que la mayorÃ­a de las letras del concierto son de David Lagos, quien estÃ¡ preparando en estos momentos su espectÃ¡culo ClÃ¡sico personal. En el concierto de este jueves, el programa incluye tonÃ¡, bulerÃ­as por soleÃ¡, tientos, cante de levante, guajira , soleÃ¡, seguiriya, fandango y bulerÃ­a. La actuaciÃ³n tendrÃ¡ lugar este jueves 10 de diciembre, en la sede de la FundaciÃ³n Cajasol (plaza de San Francisco) en Sevilla, a las 21,00 horas. Las entradas pueden adquirirse en la taquilla de la FundaciÃ³n Cajasol o en la web www.fundacioncajasol.com.', '../NoticiasUpload/3a07c082-f1ff-4751-a0ff-1baa20caaaa8-original.png', '2015-12-09 00:00:00', 0),
(10, 'hola', 'hola', '../NoticiasUpload/Dolar Rises.jpg', '2016-01-21 17:27:34', 0),
(11, 'hola', 'holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '../NoticiasUpload/Dolar Rises.jpg', '2016-01-21 17:32:25', 0),
(12, 'Prueba', 'La noticia de prueba se desarrolla en la paz\ncuando un usuario toma sopa', '../NoticiasUpload/12511641_10156483493000437_1187007999_n.jpg', '2016-01-22 14:37:03', 0),
(13, 'lista 1', 'prueba 1\nprueba 2\nprueba 3', '../NoticiasUpload/12511641_10156483493000437_1187007999_n.jpg', '2016-01-22 14:39:16', 0),
(14, 'aaa', 'aaa', '../NoticiasUpload/NYSE.jpg', '2016-01-22 16:30:46', 0),
(15, 'aaa', 'aaa', '../NoticiasUpload/NYSE.jpg', '2016-01-22 16:30:49', 0),
(16, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '../NoticiasUpload/NYSE.jpg', '2016-01-22 16:33:02', 0),
(17, 'noticia 1', 'prueba de noticia', '../NoticiasUpload/12511641_10156483493000437_1187007999_n.jpg', '2016-01-22 16:33:16', 0),
(18, 'prueba', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\nbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '../NoticiasUpload/12511641_10156483493000437_1187007999_n.jpg', '2016-01-22 16:46:17', 0),
(19, 'teetrer werrwerwrw wrwerwerwerwerwerwe', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\nsdfsdfsdfsd\nsdf\nsf\nsd', '../NoticiasUpload/12511641_10156483493000437_1187007999_n.jpg', '2016-01-22 16:49:19', 0),
(20, 'Empresa de telefonÃ­a se\ncomunica', 'empresa de transporte da seÃ±ales de comunicaciones para el tipo de empresa \nasociada para calcular', '../NoticiasUpload/serv2.jpg', '2016-01-22 16:54:07', 0),
(21, 'telefonia en las empresas de cierre', 'En esta secciÃ³n podrÃ¡s revisar informaciÃ³n acerca de tu cuenta.\nRecuerda mantener tus datos actualizados para poder informarte de las novedades en Cineplanet. Si no tienes tus datos actualizados haz click aquÃ­.', '../NoticiasUpload/serv2.jpg', '2016-01-22 16:56:03', 0),
(22, 'Iran, China agree $600 billion trade deal aft', 'Iran, China agree $600 billion trade deal after sanctions', '../NoticiasUpload/NYSE.jpg', '2016-01-23 12:45:29', 0),
(23, 'Iran, China agree $600 billion trade deal after sanctions', 'DUBAI, Jan 23 (Reuters) - Iran and China agreed to expand bilateral ties and increase trade to $600 billion in the next 10 years, President Hassan Rouhani said on Saturday during a visit to Tehran by Chinese President Xi Jinping.\n\nXi is the second leader of a U.N. Security Council member to visit Tehran after the nuclear deal Iran struck with world powers last year. Russian President Vladimir Putin visited Tehran in November.\n\nIran emerged from years of economic isolation this month when the United Nations nuclear watchdog ruled it had curbed its nuclear programme, clearing the way for the lifting of U.N., U.S., and European Union sanctions. (Full Story)', '../NoticiasUpload/NYSE.jpg', '2016-01-23 12:51:17', 0),
(24, 'Iran, China agree $600 billion trade deal after sanctions', 'DUBAI, Jan 23 (Reuters) - Iran and China agreed to expand bilateral ties and increase trade to $600 billion in the next 10 years, President Hassan Rouhani said on Saturday during a visit to Tehran by Chinese President Xi Jinping.\n\nXi is the second leader of a U.N. Security Council member to visit Tehran after the nuclear deal Iran struck with world powers last year. Russian President Vladimir Putin visited Tehran in November.\n\nIran emerged from years of economic isolation this month when the United Nations nuclear watchdog ruled it had curbed its nuclear programme, clearing the way for the lifting of U.N., U.S., and European Union sanctions. (Full Story)\n\n"Iran and China have agreed to increase trade to $600 billion in the next 10 years," Rouhani said at a news conference with Xi broadcast live on state television.\n\n"Iran and China have agreed on forming strategic relations (as) reflected in a 25-year comprehensive document," he said.\n\nIran and China signed 17 accords on Saturday, including on cooperation in nuclear energy and a revival of the ancient Silk Road trade route, known in China as One Belt, One Road.\n\n"China is still heavily dependent on Iran for its energy imports and Russia needs Iran in terms of its new security architecture vision for the Middle East," said Ellie Geranmayeh, policy fellow at the European Council on Foreign Relations.\n\n"Iran plays quite an integral role for both China and Russias interests within the region, much more than it does for the Europeans," Geranmayeh said.', '../NoticiasUpload/NYSE.jpg', '2016-01-23 12:52:57', 0),
(25, 'Iran, China agree $600 billion trade deal after sanctions', 'DUBAI, Jan 23 (Reuters) - Iran and China agreed to expand bilateral ties and increase trade to $600 billion in the next 10 years, President Hassan Rouhani said on Saturday during a visit to Tehran by Chinese President Xi Jinping.\n\nXi is the second leader of a U.N. Security Council member to visit Tehran after the nuclear deal Iran struck with world powers last year. Russian President Vladimir Putin visited Tehran in November.\n\nIran emerged from years of economic isolation this month when the United Nations'' nuclear watchdog ruled it had curbed its nuclear programme, clearing the way for the lifting of U.N., U.S., and European Union sanctions. (Full Story)\n\n"Iran and China have agreed to increase trade to $600 billion in the next 10 years," Rouhani said at a news conference with Xi broadcast live on state television.\n\n"Iran and China have agreed on forming strategic relations (as) reflected in a 25-year comprehensive document," he said.\n\nIran and China signed 17 accords on Saturday, including on cooperation in nuclear energy and a revival of the ancient Silk Road trade route, known in China as One Belt, One Road.\n\n"China is still heavily dependent on Iran for its energy imports and Russia needs Iran in terms of its new security architecture vision for the Middle East," said Ellie Geranmayeh, policy fellow at the European Council on Foreign Relations.\n\n"Iran plays quite an integral role for both China and Russiaâ€™s interests within the region, much more than it does for the Europeans," Geranmayeh said.\n\n\n\nNEW MARKETS\n\nXi was quoted as saying by China''s Xinhua news agency: "The China-Iran friendship ... has stood the test of the vicissitudes of the international landscape."\n\nThe Chinese state-backed Global Times newspaper said in an editorial on Saturday that China hoped to improve ties with Iran as part of its sweeping plan to rebuild trade links with Europe and Asia and carve out new markets for its goods.\n\n"China is of course considering its self interest in strengthening cooperation with Iran, especially at a time when China is in the midst of expending efforts to push forward the One Belt, One Road initiative, Iran is an important fulcrum," the paper said.\n\nRouhani said the countries had also agreed to cooperate on "terrorism and extremism in Iraq, Syria, Afghanistan and Yemen".\n\nChina signalled its support for Yemen''s government, which is fighting an Iran-allied militia, during Xi''s visit to Saudi Arabia, Iran''s rival for influence in the region, this week. (Full Story)\n\nIran has called on China to join the fight against the Islamic State militant group and play a more active role in the region. (Full Story)\n\nTehran is widely credited with convincing Russia to start its military intervention in Syria and join the fight against Islamic State. (Full Story)\n\n"Although China and Russia backed U.N. sanctions against Iran on its nuclear programme, they were also heavily pushing for special waivers to continue trading with Iran," Geranmayeh said.\n\n"Iran had a relationship both politically and economically with China and Russia for the last ten years in ways that it hasn''t had with Europe. So itâ€™s quite natural to see it opening up first to these countries."\n\nThe Chinese president was to meet Iran''s most powerful figure, Supreme Leader Ayatollah Ali Khamenei, later in the day.', '../NoticiasUpload/NYSE.jpg', '2016-01-23 13:02:35', 0),
(26, 'Iran, China agree $600 billion trade deal after sanctions', 'Chinese president visits Tehran two months after Putin\nChina and Russia kept ties with Iran during sanctions\nNuclear deal paved way for lifting of sanctions\nIran-China hope to revive ancient Silk Road trade route\nAdds quotes, analyst comment, background\n\nBy Bozorgmehr Sharafedin\n\nDUBAI, Jan 23 (Reuters) - Iran and China agreed to expand bilateral ties and increase trade to $600 billion in the next 10 years, President Hassan Rouhani said on Saturday during a visit to Tehran by Chinese President Xi Jinping.\n\nXi is the second leader of a U.N. Security Council member to visit Tehran after the nuclear deal Iran struck with world powers last year. Russian President Vladimir Putin visited Tehran in November.\n\nIran emerged from years of economic isolation this month when the United Nations'' nuclear watchdog ruled it had curbed its nuclear programme, clearing the way for the lifting of U.N., U.S., and European Union sanctions. (Full Story)\n\n"Iran and China have agreed to increase trade to $600 billion in the next 10 years," Rouhani said at a news conference with Xi broadcast live on state television.\n\n"Iran and China have agreed on forming strategic relations (as) reflected in a 25-year comprehensive document," he said.\n\nIran and China signed 17 accords on Saturday, including on cooperation in nuclear energy and a revival of the ancient Silk Road trade route, known in China as One Belt, One Road.\n\n"China is still heavily dependent on Iran for its energy imports and Russia needs Iran in terms of its new security architecture vision for the Middle East," said Ellie Geranmayeh, policy fellow at the European Council on Foreign Relations.\n\n"Iran plays quite an integral role for both China and Russiaâ€™s interests within the region, much more than it does for the Europeans," Geranmayeh said.\n\n\n\nNEW MARKETS\n\nXi was quoted as saying by China''s Xinhua news agency: "The China-Iran friendship ... has stood the test of the vicissitudes of the international landscape."\n\nThe Chinese state-backed Global Times newspaper said in an editorial on Saturday that China hoped to improve ties with Iran as part of its sweeping plan to rebuild trade links with Europe and Asia and carve out new markets for its goods.\n\n"China is of course considering its self interest in strengthening cooperation with Iran, especially at a time when China is in the midst of expending efforts to push forward the One Belt, One Road initiative, Iran is an important fulcrum," the paper said.\n\nRouhani said the countries had also agreed to cooperate on "terrorism and extremism in Iraq, Syria, Afghanistan and Yemen".\n\nChina signalled its support for Yemen''s government, which is fighting an Iran-allied militia, during Xi''s visit to Saudi Arabia, Iran''s rival for influence in the region, this week. (Full Story)\n\nIran has called on China to join the fight against the Islamic State militant group and play a more active role in the region. (Full Story)\n\nTehran is widely credited with convincing Russia to start its military intervention in Syria and join the fight against Islamic State. (Full Story)\n\n"Although China and Russia backed U.N. sanctions against Iran on its nuclear programme, they were also heavily pushing for special waivers to continue trading with Iran," Geranmayeh said.\n\n"Iran had a relationship both politically and economically with China and Russia for the last ten years in ways that it hasn''t had with Europe. So itâ€™s quite natural to see it opening up first to these countries."\n\nThe Chinese president was to meet Iran''s most powerful figure, Supreme Leader Ayatollah Ali Khamenei, later in the day.\n\n\n\nReporting by Bozorgmehr Sharafedin, additional reporting by Megha Rajagopalan in Beijing Editing by Janet Lawrence\n\nbozorgmehr.sharafedin@thomsonreuters.com Mobile: 00971-55 386 5977', '../NoticiasUpload/NYSE.jpg', '2016-01-23 13:06:43', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE IF NOT EXISTS `operaciones` (
  `idoperaciones` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `saldoanterior` decimal(10,3) DEFAULT NULL,
  `cantidad` decimal(10,3) DEFAULT NULL,
  `castigo` decimal(10,3) DEFAULT NULL,
  `saldoactual` decimal(10,3) DEFAULT NULL,
  `NcuotasAgregado` decimal(10,3) NOT NULL,
  `NcuotasAnterior` decimal(10,3) NOT NULL,
  `NcuotasActual` decimal(10,3) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `Fondos_idFondos` int(11) NOT NULL,
  `Usuarios_idUsuarios` int(11) NOT NULL,
  PRIMARY KEY (`idoperaciones`,`Fondos_idFondos`,`Usuarios_idUsuarios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`idoperaciones`, `tipo`, `fecha`, `saldoanterior`, `cantidad`, `castigo`, `saldoactual`, `NcuotasAgregado`, `NcuotasAnterior`, `NcuotasActual`, `estado`, `Fondos_idFondos`, `Usuarios_idUsuarios`) VALUES
(30, 'APORTE', '2015-12-08 19:26:30', 0.000, 150.000, NULL, 150.000, 20.000, 10.000, 30.000, 1, 10, 10),
(31, 'APORTE', '2015-12-08 19:27:07', 150.000, 50.000, NULL, 200.000, 20.000, 30.000, 50.000, 1, 10, 10),
(32, 'RESCATE', '2015-12-08 19:28:09', NULL, 100.000, 50.000, 50.000, 20.000, 50.000, 30.000, 0, 10, 10),
(33, 'RESCATE', '2015-12-08 19:30:24', NULL, 5.000, 5.000, 40.000, 5.000, 30.000, 25.000, 0, 10, 10),
(34, 'APORTE', '2015-12-08 19:35:24', 40.000, 50.000, NULL, 90.000, 10.000, 25.000, 35.000, 1, 10, 10),
(35, 'APORTE', '2015-12-09 11:19:28', 0.000, 1000.000, NULL, 1000.000, 45.000, 0.000, 45.000, 1, 10, 12),
(36, 'APORTE', '2015-12-09 15:58:27', 0.000, 1000.000, NULL, 1000.000, 30.000, 0.000, 30.000, 1, 11, 14),
(37, 'APORTE', '2015-12-09 15:59:25', 1000.000, 1000.000, NULL, 1000.000, 15.000, 30.000, 45.000, 1, 11, 14),
(38, 'RESCATE', '2015-12-09 16:02:01', NULL, 500.000, 200.000, 1000.000, 20.000, 45.000, 25.000, 0, 11, 14),
(39, 'APORTE', '2015-12-10 11:19:38', 0.000, 1000.000, NULL, 1000.000, 10.000, 0.000, 10.000, 1, 12, 15),
(40, 'APORTE', '2015-12-10 11:22:21', 1000.000, 1000.000, NULL, 1000.000, 29.000, 10.000, 39.000, 1, 12, 15),
(41, 'APORTE', '2015-12-10 11:39:37', 0.000, 1000.000, NULL, 1000.000, 30.000, 0.000, 30.000, 1, 1, 15),
(42, 'APORTE', '2016-01-21 16:10:09', 0.000, 1000.000, NULL, 1000.000, 50.840, 0.000, 50.840, 1, 16, 16),
(43, 'APORTE', '2016-01-22 17:02:38', 0.000, 1000.000, NULL, 1000.000, 100.000, 100.000, 200.000, 1, 19, 16),
(44, 'RESCATE', '2016-01-22 17:04:21', NULL, 1000.000, 0.000, 1000.000, 49.700, 200.000, 150.000, 1, 19, 16),
(45, 'APORTE', '2016-01-22 17:20:56', 0.000, 1000.000, NULL, 1000.000, 50.840, 0.000, 50.840, 1, 20, 16),
(46, 'APORTE', '2016-01-22 23:55:50', 1000.000, 104.340, NULL, 1000.000, 10.300, 35.000, 45.300, 1, 11, 14),
(47, 'APORTE', '2016-01-22 23:57:28', 1000.000, 122.120, NULL, 1000.000, 12.000, 45.300, 57.300, 1, 11, 14),
(48, 'APORTE', '2016-01-22 23:59:01', 0.000, 1000.000, NULL, 1000.000, 500.000, 0.000, 500.000, 1, 1, 14),
(49, 'APORTE', '2016-01-23 00:23:12', 1000.000, 1000.000, NULL, 1000.000, 230.000, 500.000, 730.000, 0, 1, 14),
(50, 'RESCATE', '2016-01-23 00:26:02', NULL, 1000.000, 0.000, 99.500, 718.500, 730.000, 11.500, 0, 1, 14),
(51, 'APORTE', '2016-01-25 15:02:47', 1000.000, 1000.000, NULL, 1000.000, 50.840, 50.840, 101.680, 1, 20, 16),
(52, 'APORTE', '2016-01-25 15:21:35', 0.000, 1000.000, NULL, 1000.000, 50.840, 50.840, 101.680, 0, 22, 16),
(53, 'APORTE', '2016-01-25 15:54:59', 0.000, 1000.000, NULL, 1000.000, 101.040, 0.010, 101.050, 0, 24, 16),
(54, 'RESCATE', '2016-01-25 15:57:08', NULL, 1000.000, 0.000, 0.000, 49.690, 101.050, 51.360, 0, 24, 16),
(55, 'APORTE', '2016-01-25 16:02:20', 0.000, 1000.000, NULL, 1000.000, 101.050, 101.050, 202.099, 0, 24, 16),
(56, 'RESCATE', '2016-01-25 16:04:01', NULL, 1000.000, 0.000, 0.000, 69.640, 101.680, 32.040, 0, 22, 16),
(57, 'APORTE', '2016-01-25 16:07:49', 1000.000, 1000.000, NULL, 1000.000, 0.010, 101.030, 101.040, 0, 24, 16),
(58, 'APORTE', '2016-01-25 16:10:57', 0.000, 10104.960, NULL, 10104.960, 0.010, 101.050, 101.060, 1, 47, 16),
(59, 'RESCATE', '2016-01-25 16:11:58', 10104.960, 4969.640, 0.000, 5135.320, 49.696, 101.060, 51.363, 1, 47, 16),
(60, 'RESCATE', '2016-01-25 16:13:33', 5135.320, 2981.700, 0.000, 2153.620, 29.817, 51.363, 21.546, 1, 47, 16),
(61, 'APORTE', '2016-01-25 16:16:53', 1000.000, 1000.000, NULL, 1000.000, 0.010, 50.830, 50.840, 0, 22, 16),
(62, 'APORTE', '2016-01-25 16:20:54', 0.000, 4969.640, NULL, 4969.640, 50.840, 50.840, 101.680, 1, 22, 16),
(63, 'APORTE', '2016-01-25 16:29:03', 0.000, 2981.700, NULL, 2981.700, 0.010, 30.410, 30.420, 1, 48, 16),
(64, 'APORTE', '2016-01-25 16:37:21', 0.000, 4032.000, NULL, 4032.000, 0.010, 40.310, 40.320, 1, 50, 17),
(65, 'RESCATE', '2016-01-25 16:40:01', NULL, 3986.070, 0.000, 45.930, 39.867, 40.320, 0.453, 1, 50, 17),
(66, 'APORTE', '2016-01-25 16:43:53', 0.000, 3986.070, NULL, 3986.070, 0.010, 40.660, 40.670, 1, 23, 17),
(67, 'APORTE', '2016-01-26 12:17:13', 0.000, 1000.000, NULL, 1000.000, 100.000, 0.000, 100.000, 0, 52, 18),
(68, 'APORTE', '2016-01-26 12:41:31', 1000.000, 1000.000, NULL, 1000.000, 100.000, 11.500, 111.500, 1, 1, 14),
(69, 'APORTE', '2016-01-26 12:45:01', 1000.000, 10000.000, NULL, 11000.000, 100.000, 111.500, 211.500, 1, 1, 14),
(70, 'APORTE', '2016-01-26 12:46:21', 1000.000, 100000.000, NULL, 101000.000, 10000.000, 57.300, 10057.300, 1, 11, 14),
(71, 'APORTE', '2016-01-26 12:53:37', 0.000, 10000.000, NULL, 10000.000, 100.000, 0.000, 100.000, 1, 52, 18),
(72, 'RESCATE', '2016-01-26 12:57:30', NULL, 5000.000, 0.000, 5000.000, 50.000, 100.000, 50.000, 1, 52, 18),
(73, 'APORTE', '2016-01-26 12:58:18', 0.000, 5000.000, NULL, 5000.000, 50.000, 0.000, 50.000, 1, 51, 18),
(74, 'RESCATE', '2016-01-27 10:39:41', 2153.620, 1000.000, 0.000, 1153.620, 9.996, 21.546, 11.550, 1, 47, 16),
(75, 'RESCATE', '2016-01-27 11:13:53', NULL, 999.860, 0.000, 0.140, 10.000, 211.500, 201.500, 1, 1, 14),
(76, 'APORTE', '2016-01-27 11:17:12', 0.000, 2153.620, NULL, 2153.620, 21.000, 30.000, 51.000, 1, 10, 13),
(77, 'RESCATE', '2016-01-27 11:18:08', NULL, 1000.000, 0.000, 1153.620, 1.000, 51.000, 50.000, 1, 10, 13),
(78, 'APORTE', '2016-01-28 17:07:24', 45.930, 5370.000, NULL, 5415.930, 53.700, 0.453, 54.153, 1, 50, 17),
(79, 'RESCATE', '2016-01-29 14:12:57', NULL, 5415.280, 0.000, 0.650, 54.150, 54.153, 0.003, 1, 50, 17),
(80, 'APORTE', '2016-01-29 14:15:15', 0.000, 5415.280, NULL, 5415.280, 63.724, 0.000, 63.724, 1, 54, 17),
(81, 'APORTE', '2016-02-03 18:00:03', 0.650, 296.250, NULL, 296.900, 2.963, 0.003, 2.966, 1, 50, 17),
(82, 'RESCATE', '2016-02-05 13:45:56', NULL, 296.250, 0.000, 0.650, 2.963, 2.966, 0.004, 1, 50, 17),
(83, 'RESCATE', '2016-02-05 13:45:59', NULL, 296.250, 0.000, 0.650, 2.963, 0.004, -2.959, 1, 50, 17),
(84, 'APORTE', '2016-02-05 13:46:59', 0.650, 296.250, NULL, 296.900, 2.963, -2.959, 0.003, 1, 50, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `dni` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `TipoUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuarios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `nombres`, `apellidos`, `direccion`, `dni`, `telefono`, `correo`, `usuario`, `password`, `estado`, `TipoUsuario`) VALUES
(1, 'Ronald', 'Pacheco Alarcon', 'Av. Siempre viva', '55555', '000000000', 'rpacheco124@gmail.com', 'adminPacheco', 'jorgexs2', 1, 1),
(10, 'Hilda Soledad', 'NuÃ±ez de la Cruz', 'Villa Maria San Gabriel', '48323539', '987374267', 'hsNunez@gmail.com', 'hsoledad26', '123456', 1, 2),
(11, 'Miguel', 'Cotrina', 'av.arequipa 111', '12568954', '987654321', 'miguel.cotrina@digisoft.com', 'mcotrina', '123qaz456', 1, 2),
(12, 'mac', 'cotrina', 'd12', '42979729', '3424', 'fgdfg', 'macespinoza', '123qaz456', 1, 2),
(13, 'Usuario Calidad', 'Calidad', 'av.calidad', '123456789', '987654321', 'calidad@digisoft.com', 'calidad', '123qaz456', 1, 2),
(14, 'Alvaro', 'Barriga', 'Miraflores', '98926789', '672827827', 'alvaro@sss.com', 'alvarob', '123456', 1, 2),
(15, 'Carlos', 'Perez', 'Ava miraflores', '83838392', '23423532', 'wfsdfsd@sdsf.com', 'carlosperez', '123456', 1, 2),
(16, 'Roger', 'Gutierrez', 'Calle 6 MZ. L. LT. 12 ASENT. H. Felipe Alva A', '41842805', '992219663', 'rogergf@gmail.com', 'rogutierrez', 'capital', 1, 2),
(17, 'Moises', 'Egues Martinez', 'Av. San Felipe 226 Dpto. 902', '25857545', '949288572', 'meguesm@gmail.com', 'moegues', 'capital', 1, 2),
(18, 'Alvaro', 'Barriga', 'Libertad 140 2E Barranco', '41585424', '982536886', 'alvaro.barriga@newcapital-sec.com', 'albarriga', 'capital', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_fondos`
--

CREATE TABLE IF NOT EXISTS `usuarios_fondos` (
  `idUsuarioFondo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Usuarios_idUsuarios` int(11) NOT NULL,
  `Fondos_idFondos` int(11) NOT NULL DEFAULT '0',
  `ncuotas` decimal(10,3) DEFAULT NULL,
  `saldoactual` decimal(10,3) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuarioFondo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `usuarios_fondos`
--

INSERT INTO `usuarios_fondos` (`idUsuarioFondo`, `Usuarios_idUsuarios`, `Fondos_idFondos`, `ncuotas`, `saldoactual`, `estado`) VALUES
(1, 10, 10, 35.000, 90.000, 0),
(2, 10, 10, 35.000, 90.000, 0),
(3, 10, 1, 10.000, 0.000, 0),
(4, 10, 10, 11.000, 0.000, 0),
(5, 10, 10, 10.000, 0.000, 0),
(6, 10, 1, 12.000, 0.000, 0),
(7, 10, 1, 2.000, 0.000, 0),
(8, 11, 10, 20.000, 0.000, 1),
(9, 12, 10, 45.000, 1000.000, 1),
(10, 13, 10, 50.000, 1154.040, 1),
(11, 14, 11, 1000.000, 1000.000, 1),
(12, 15, 12, 39.000, 1000.000, 1),
(13, 15, 1, 30.000, 1000.000, 1),
(14, 16, 16, 102.000, 1000.000, 0),
(15, 16, 19, 50.300, 1000.000, 0),
(17, 16, 20, 101.680, 1000.000, 0),
(18, 14, 1, 201.500, 0.140, 1),
(19, 16, 20, 101.680, 1000.000, 0),
(20, 16, 22, 101.680, 1000.000, 0),
(21, 16, 24, 101.040, 1000.000, 0),
(22, 16, 24, 101.040, 1000.000, 0),
(23, 16, 24, 101.040, 1000.000, 0),
(24, 16, 24, 101.040, 1000.000, 0),
(25, 16, 47, 11.550, 1153.620, 1),
(26, 16, 22, 101.680, 1000.000, 0),
(27, 16, 22, 101.680, 4969.640, 1),
(28, 16, 48, 30.420, 2981.700, 1),
(29, 17, 50, 0.003, 296.900, 1),
(30, 17, 23, 40.670, 3986.070, 1),
(31, 18, 52, 50.000, 5000.000, 0),
(32, 18, 52, 50.000, 5000.000, 1),
(33, 18, 51, 50.000, 5000.000, 1),
(34, 18, 53, 0.000, 0.000, 1),
(35, 17, 54, 63.724, 5415.280, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
