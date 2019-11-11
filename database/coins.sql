-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2019 a las 05:54:06
-- Versión del servidor: 5.6.15-log
-- Versión de PHP: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `coins`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion`
--

CREATE TABLE IF NOT EXISTS `accion` (
  `idACCION` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idACCION`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `accion`
--

INSERT INTO `accion` (`idACCION`, `nombre`, `descripcion`) VALUES
(1, 'agregar_producto', NULL),
(2, 'consultar_producto', NULL),
(3, 'modificar_producto', NULL),
(4, 'eliminar_producto', NULL),
(5, 'agregar_usuario', NULL),
(6, 'consultar_usuario', NULL),
(7, 'modificar_usuario', NULL),
(8, 'eliminar_usuario', NULL),
(9, 'agregar_atributo', NULL),
(10, 'consultar_atributo', NULL),
(11, 'editar_atributo', NULL),
(12, 'eliminar_atributo', NULL),
(13, 'agregar_nominacion', NULL),
(14, 'ver_nominaciones_hechas', NULL),
(15, 'ver_nominaciones_recibidas', NULL),
(16, 'ver_nominaciones_pendientes', NULL),
(17, 'ver_todas_nominaciones', NULL),
(18, 'votar_nominacion', NULL),
(19, 'aprobar_nominacion', NULL),
(20, 'adjudicar_nominacion', NULL),
(21, 'activar_nominacion', NULL),
(22, 'canjear_producto', NULL),
(23, 'consultar_canjes_propios', NULL),
(24, 'consultar_todos_canjes', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atributo`
--

CREATE TABLE IF NOT EXISTS `atributo` (
  `idATRIBUTO` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(3) NOT NULL,
  `prioridad` int(2) DEFAULT NULL,
  `definicion` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idATRIBUTO`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `atributo`
--

INSERT INTO `atributo` (`idATRIBUTO`, `nombre`, `valor`, `prioridad`, `definicion`, `imagen`) VALUES
(1, 'Transformacionales', 30, 1, 'Buscamos nuevas posibilidades, fomentamos la creatividad e innovación y nos alentamos a tomar riesgos.\r\n', 'assets/images/transformacionales.png'),
(2, 'Orientado a resultados', 25, 2, 'Hacemos que las cosas sucedan, nos enfocamos en la meta.\r\n', 'assets/images/orientado_a_resultados.png'),
(3, 'Ágiles', 20, 3, 'Nos sentimos cómodos en la complejidad y buscamos ser disruptivos, tomamos decisiones audaces.\r\n', 'assets/images/agiles.png'),
(4, 'Orientado a relaciones', 15, 4, 'Somos abiertos a diversos estilos y personalidades, buscamos aprender de los demás y ayudarles en su desarrollo.\r\n', 'assets/images/orientado_a_relaciones.png'),
(5, 'Cultos', 10, 5, 'Apreciamos el arte, la belleza y el lujo, conocemos la historia de la marca, el entorno en el que se desarrolla y sus perspectivas futuras. \r\n', 'assets/images/cultos.png'),
(6, 'Humildes', 5, 6, 'Demostramos sencillez, integridad y claro conocimiento de nuestras capacidades y retos.  \r\n', 'assets/images/humildes.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canje`
--

CREATE TABLE IF NOT EXISTS `canje` (
  `idCANJE` int(11) NOT NULL AUTO_INCREMENT,
  `idUSUARIO` int(11) NOT NULL,
  `idPRODUCTO` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha_canje` datetime NOT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  PRIMARY KEY (`idCANJE`),
  KEY `fk_CANJE_USUARIO1` (`idUSUARIO`),
  KEY `fk_CANJE_PRODUCTO1` (`idPRODUCTO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `idDepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idDepartamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombre`) VALUES
(1, 'RRHH'),
(2, 'Publicidad'),
(3, 'Finanzas'),
(4, 'Investigación'),
(5, 'Administración'),
(6, 'Producción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nominacion`
--

CREATE TABLE IF NOT EXISTS `nominacion` (
  `idNOMINACION` int(11) NOT NULL AUTO_INCREMENT,
  `idNOMINADOR` int(11) NOT NULL,
  `idNOMINADO` int(11) NOT NULL,
  `idATRIBUTO` int(11) NOT NULL,
  `idADMIN` int(11) DEFAULT NULL,
  `valor_atributo` int(11) NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `votable` tinyint(1) DEFAULT NULL,
  `comentario` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `motivo1` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `sustento1` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `motivo2` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sustento2` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nominacion` datetime DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `fecha_adjudicacion` datetime DEFAULT NULL,
  PRIMARY KEY (`idNOMINACION`),
  KEY `idADMIN` (`idADMIN`),
  KEY `fk_NOMINACION_ATRIBUTO1` (`idATRIBUTO`),
  KEY `fk_NOMINACION_USUARIO1` (`idNOMINADO`),
  KEY `fk_USUARIO_has_EMPLEADO_USUARIO1` (`idNOMINADOR`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `nominacion`
--

INSERT INTO `nominacion` (`idNOMINACION`, `idNOMINADOR`, `idNOMINADO`, `idATRIBUTO`, `idADMIN`, `valor_atributo`, `estado`, `votable`, `comentario`, `motivo1`, `sustento1`, `motivo2`, `sustento2`, `fecha_nominacion`, `fecha_cierre`, `fecha_adjudicacion`) VALUES
(1, 2, 2, 5, 1, 10, 'adjudicada', 1, 'Ha sido aprobada', 'Me parece apropiado', 'upload/1573006307-mtx.pdf', NULL, NULL, '2019-11-05 22:11:47', '2019-11-05 22:30:57', '2019-11-05 22:33:06'),
(2, 2, 1, 1, NULL, 30, 'pendiente', 1, NULL, 'Lo considero', 'upload/1573007645-peliculas.xlsx', NULL, NULL, '2019-11-05 22:34:05', NULL, NULL),
(3, 5, 4, 4, 5, 15, 'adjudicada', NULL, '', 'justo', '', NULL, NULL, '2019-11-07 23:15:37', '2019-11-07 23:15:37', '2019-11-07 23:15:37'),
(4, 2, 6, 4, NULL, 15, 'pendiente', NULL, NULL, 'Motivo 2', 'upload/1573183364-NOV2019.pdf', NULL, NULL, '2019-11-07 23:22:44', NULL, NULL),
(5, 6, 2, 1, 7, 30, 'adjudicada', NULL, 'Aprobada directamente por VP', 'Es considerable', '', NULL, NULL, '2019-11-07 23:54:02', '2019-11-10 14:01:56', '2019-11-10 14:01:56'),
(6, 7, 2, 2, 7, 25, 'adjudicada', NULL, '', 'Inmediata', '', NULL, NULL, '2019-11-07 23:57:12', '2019-11-07 23:57:12', '2019-11-07 23:57:12'),
(7, 5, 7, 6, 7, 5, 'validada', 1, 'Validada por VP F1', 'Motivacionales', '', NULL, NULL, '2019-11-08 00:20:04', '2019-11-10 13:56:51', NULL),
(8, 6, 2, 6, 7, 5, 'adjudicada', NULL, 'Aprobada por VP completo', 'Motivo', '', NULL, NULL, '2019-11-08 23:48:42', '2019-11-09 00:51:45', '2019-11-09 00:51:46'),
(9, 9, 11, 6, NULL, 5, 'pendiente', NULL, NULL, 'Motivo Humildes', 'upload/1573411469-peliculas.xlsx', NULL, NULL, '2019-11-10 14:44:29', NULL, NULL),
(10, 11, 2, 4, 1, 15, 'adjudicada', 1, 'Aprobado por comité', 'OAR', 'upload/1573411992-mtx.pdf', 'Motivo segunda sust.', 'upload/1573413755-CALCULOS PVP.xlsx', '2019-11-10 14:53:12', '2019-11-10 16:13:48', '2019-11-11 00:40:18'),
(11, 8, 10, 3, 8, 20, 'adjudicada', NULL, '', 'Motivo AGILES', 'upload/1573447566-certificado de origen moto.jpg', NULL, NULL, '2019-11-11 00:46:06', '2019-11-11 00:46:07', '2019-11-11 00:46:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
  `idROL` int(11) NOT NULL,
  `idACCION` int(11) NOT NULL,
  PRIMARY KEY (`idROL`,`idACCION`),
  KEY `fk_ROL_has_ACCION_ACCION1` (`idACCION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idROL`, `idACCION`) VALUES
(1, 1),
(1, 2),
(2, 2),
(4, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(2, 10),
(4, 10),
(1, 11),
(1, 12),
(2, 13),
(4, 13),
(2, 14),
(4, 14),
(2, 15),
(4, 15),
(1, 16),
(2, 16),
(3, 16),
(4, 16),
(1, 17),
(3, 17),
(4, 17),
(3, 18),
(1, 19),
(4, 19),
(2, 20),
(1, 21),
(2, 22),
(4, 22),
(2, 23),
(4, 23),
(1, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idPRODUCTO` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `cantidad` int(3) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificado` datetime DEFAULT NULL,
  PRIMARY KEY (`idPRODUCTO`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idPRODUCTO`, `nombre`, `valor`, `descripcion`, `imagen`, `activo`, `cantidad`, `fecha_creacion`, `fecha_modificado`) VALUES
(1, 'Perfume Bulgary', 20, 'Botella de perfume 60ml', 'upload/productos/1547134576-bvlgary.jpg', NULL, NULL, '2019-01-10 11:36:32', NULL),
(2, 'Nike', 650, 'Botella de perfume masculino de 50ml', 'upload/productos/1547134745-nikenike.jpg', NULL, NULL, '2019-01-10 11:39:07', NULL),
(3, 'Ralph''s Lauren''s gold', 65, 'Perfume de 100 ml dorado', 'upload/productos/1547384529-download.jpg', NULL, NULL, '2019-01-13 09:02:11', '2019-01-16 01:26:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `idROL` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idROL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idROL`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'ABM de registros, aprobación de nominaciones'),
(2, 'Colaborador', 'Registrar nominaciones, canjes de productos, gestion nominaciones propias'),
(3, 'Evaluador', 'Vota nominaciones, Resultados'),
(4, 'Vicepresidente', 'Aprueba nominaciones sin votación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sustento`
--

CREATE TABLE IF NOT EXISTS `sustento` (
  `idSUSTENTO` int(11) NOT NULL AUTO_INCREMENT,
  `motivo` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `adjunto` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idNOMINACION` int(11) NOT NULL,
  PRIMARY KEY (`idSUSTENTO`,`idNOMINACION`),
  KEY `fk_SUSTENTO_NOMINACION1` (`idNOMINACION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUSUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificado` datetime DEFAULT NULL,
  `idDepartamento` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUSUARIO`),
  KEY `fk_departamento` (`idDepartamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUSUARIO`, `nombre`, `apellido`, `email`, `password`, `cargo`, `activo`, `fecha_creacion`, `fecha_modificado`, `idDepartamento`) VALUES
(1, 'Miguel', 'Rangel', 'mikeven@gmail.com', '1212', '', 1, '2019-11-05 20:19:57', '2019-11-05 20:40:08', 4),
(2, 'Alberto', 'Sánchez', 'asanchez@gmail.com', 'asan0125', '', 1, '2019-11-05 22:06:51', NULL, 2),
(3, 'Carla', 'Brito', 'cbrito@yahoo.com', '6666', '', 1, '2019-11-05 22:08:03', NULL, 4),
(4, 'Laura', 'Guerrero', 'laugue@gmail.com', '1648', '', 1, '2019-11-05 22:29:03', NULL, 1),
(5, 'Francis', 'Guerra', 'fguerra@gmail.com', '5200', '', 1, '2019-11-07 19:40:04', NULL, 1),
(6, 'Gaby', 'Cardoso', 'gcardoso@aol.com', '7979', '', 1, '2019-11-07 23:20:38', NULL, 2),
(7, 'Virginia', 'Altamirano', 'vvisa@yahoo.com', '3131', '', 1, '2019-11-07 23:56:11', NULL, 2),
(8, 'Mayra', 'Moncada', 'mmoncada@gmail.com', '0000', '', 1, '2019-11-10 14:23:09', '2019-11-10 14:49:48', 5),
(9, 'Jorge', 'Dante', 'jdante@hotmail.com', '9999', '', 1, '2019-11-10 14:30:27', NULL, 5),
(10, 'Daniel', 'Mijares', 'dmijares@gmail.com', '4444', '', 1, '2019-11-10 14:31:20', NULL, 5),
(11, 'Victor', 'Sandoval', 'vsand@gmail.com', '1313', '', 1, '2019-11-10 14:43:26', NULL, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE IF NOT EXISTS `usuario_rol` (
  `idUSUARIO` int(11) NOT NULL,
  `idROL` int(11) NOT NULL,
  PRIMARY KEY (`idUSUARIO`,`idROL`),
  KEY `fk_USUARIO_has_ROL_ROL1` (`idROL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`idUSUARIO`, `idROL`) VALUES
(1, 1),
(2, 2),
(6, 2),
(9, 2),
(11, 2),
(3, 3),
(4, 3),
(10, 3),
(5, 4),
(7, 4),
(8, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voto`
--

CREATE TABLE IF NOT EXISTS `voto` (
  `idUSUARIO` int(11) NOT NULL,
  `idNOMINACION` int(11) NOT NULL,
  `valor` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_voto` datetime DEFAULT NULL,
  PRIMARY KEY (`idUSUARIO`,`idNOMINACION`),
  KEY `fk_USUARIO_has_NOMINACION_NOMINACION1` (`idNOMINACION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `voto`
--

INSERT INTO `voto` (`idUSUARIO`, `idNOMINACION`, `valor`, `fecha_voto`) VALUES
(3, 1, 'si', '2019-11-05 22:13:27'),
(3, 10, 'si', '2019-11-10 15:39:32'),
(4, 1, 'si', '2019-11-05 22:30:29'),
(4, 10, 'si', '2019-11-10 15:41:01'),
(10, 10, 'no', '2019-11-10 16:13:06');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `canje`
--
ALTER TABLE `canje`
  ADD CONSTRAINT `fk_CANJE_PRODUCTO1` FOREIGN KEY (`idPRODUCTO`) REFERENCES `producto` (`idPRODUCTO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CANJE_USUARIO1` FOREIGN KEY (`idUSUARIO`) REFERENCES `usuario` (`idUSUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nominacion`
--
ALTER TABLE `nominacion`
  ADD CONSTRAINT `fk_NOMINACION_ATRIBUTO1` FOREIGN KEY (`idATRIBUTO`) REFERENCES `atributo` (`idATRIBUTO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_NOMINACION_USUARIO1` FOREIGN KEY (`idNOMINADO`) REFERENCES `usuario` (`idUSUARIO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_USUARIO_has_EMPLEADO_USUARIO1` FOREIGN KEY (`idNOMINADOR`) REFERENCES `usuario` (`idUSUARIO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nominacion_ibfk_1` FOREIGN KEY (`idADMIN`) REFERENCES `usuario` (`idUSUARIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `fk_ROL_has_ACCION_ACCION1` FOREIGN KEY (`idACCION`) REFERENCES `accion` (`idACCION`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ROL_has_ACCION_ROL1` FOREIGN KEY (`idROL`) REFERENCES `rol` (`idROL`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sustento`
--
ALTER TABLE `sustento`
  ADD CONSTRAINT `fk_SUSTENTO_NOMINACION1` FOREIGN KEY (`idNOMINACION`) REFERENCES `nominacion` (`idNOMINACION`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_departamento` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `fk_USUARIO_has_ROL_ROL1` FOREIGN KEY (`idROL`) REFERENCES `rol` (`idROL`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USUARIO_has_ROL_USUARIO` FOREIGN KEY (`idUSUARIO`) REFERENCES `usuario` (`idUSUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `voto`
--
ALTER TABLE `voto`
  ADD CONSTRAINT `fk_USUARIO_has_NOMINACION_NOMINACION1` FOREIGN KEY (`idNOMINACION`) REFERENCES `nominacion` (`idNOMINACION`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USUARIO_has_NOMINACION_USUARIO1` FOREIGN KEY (`idUSUARIO`) REFERENCES `usuario` (`idUSUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
