-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2019 a las 12:49:27
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

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
(9, 'agregar_nominacion', NULL),
(10, 'ver_nominaciones_hechas', NULL),
(11, 'ver_nominaciones_recibidas', NULL),
(12, 'ver_nominaciones_pendientes', NULL),
(13, 'ver_todas_nominaciones', NULL),
(14, 'votar_nominacion', NULL),
(15, 'aprobar_nominacion', NULL),
(16, 'canjear_producto', NULL),
(17, 'consultar_canjes_propios', NULL),
(18, 'consultar_todos_canjes', NULL),
(19, 'marcar_producto_entregado', NULL),
(20, 'agregar_atributo', NULL),
(21, 'consultrar_atributo', NULL),
(22, 'editar_atributo', NULL),
(23, 'eliminar_atributo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atributo`
--

CREATE TABLE IF NOT EXISTS `atributo` (
  `idATRIBUTO` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(3) NOT NULL,
  `prioridad` int(2) DEFAULT NULL,
  `definicion` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idATRIBUTO`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `atributo`
--

INSERT INTO `atributo` (`idATRIBUTO`, `nombre`, `valor`, `prioridad`, `definicion`) VALUES
(1, 'Transformacionales', 30, 1, 'Buscamos nuevas posibilidades, fomentamos la creatividad e i'),
(2, 'Orientado a resultados', 25, 2, 'Hacemos que las cosas sucedan, nos enfocamos en la meta.\r\n'),
(3, 'Ágiles', 20, 3, 'Nos sentimos cómodos en la complejidad y buscamos ser disrup'),
(4, 'Orientado a relaciones', 15, 4, 'Somos abiertos a diversos estilos y personalidades, buscamos'),
(5, 'Cultos', 10, 5, 'Apreciamos el arte, la belleza y el lujo, conocemos la histo'),
(6, 'Humildes', 5, 6, 'Demostramos sencillez, integridad y claro conocimiento de nu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canje`
--

CREATE TABLE IF NOT EXISTS `canje` (
  `idCANJE` int(11) NOT NULL,
  `idUSUARIO` int(11) NOT NULL,
  `idPRODUCTO` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha_canje` datetime NOT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  PRIMARY KEY (`idCANJE`),
  KEY `fk_CANJE_USUARIO1` (`idUSUARIO`),
  KEY `fk_CANJE_PRODUCTO1` (`idPRODUCTO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nominacion`
--

CREATE TABLE IF NOT EXISTS `nominacion` (
  `idNOMINACION` int(11) NOT NULL AUTO_INCREMENT,
  `idNOMINADOR` int(11) NOT NULL,
  `idNOMINADO` int(11) NOT NULL,
  `idATRIBUTO` int(11) NOT NULL,
  `valor_atributo` int(11) NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `motivo1` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `sustento1` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `motivo2` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sustento2` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nominacion` datetime DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  PRIMARY KEY (`idNOMINACION`),
  KEY `fk_USUARIO_has_EMPLEADO_USUARIO1` (`idNOMINADOR`),
  KEY `fk_NOMINACION_ATRIBUTO1` (`idATRIBUTO`),
  KEY `fk_NOMINACION_USUARIO1` (`idNOMINADO`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `nominacion`
--

INSERT INTO `nominacion` (`idNOMINACION`, `idNOMINADOR`, `idNOMINADO`, `idATRIBUTO`, `valor_atributo`, `estado`, `motivo1`, `sustento1`, `motivo2`, `sustento2`, `fecha_nominacion`, `fecha_cierre`) VALUES
(1, 2, 3, 2, 25, 'pendiente', 'Cumple con los requisitos establecidos', 'upload/1546804289-170202634174.pdf', NULL, NULL, '2019-01-06 15:51:29', NULL);

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
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 6),
(1, 7),
(1, 8),
(2, 9),
(2, 10),
(2, 11),
(1, 12),
(1, 13),
(3, 13),
(3, 14),
(1, 15),
(2, 16),
(2, 17),
(1, 18),
(2, 19),
(1, 20),
(1, 21),
(2, 21),
(1, 22),
(1, 23);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `idROL` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idROL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idROL`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'ABM de registros, aprobación de nominaciones'),
(2, 'Colaborador', 'Registrar nominaciones, canjes de productos, gestion nominaciones propias'),
(3, 'Evaluador', 'Vota nominaciones, Resultados');

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
  `cargo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `departamento` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificado` datetime DEFAULT NULL,
  PRIMARY KEY (`idUSUARIO`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUSUARIO`, `nombre`, `apellido`, `email`, `cargo`, `departamento`, `activo`, `fecha_creacion`, `fecha_modificado`) VALUES
(1, 'U Admin', 'A', 'mikeven@gmail.com', 'Desarrollador', 'Desarrollo', 1, '2018-12-22 01:22:21', NULL),
(2, 'U Colab', 'C', 'mrangel@mgideas.net', 'Colaborador', 'RRHH', 1, '2018-12-24 18:01:10', NULL),
(3, 'U Eval', 'E', 'miaragi@yahoo.com', 'Evaluador', 'Adm', 1, '2018-12-24 18:01:40', NULL);

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
(3, 3);

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
  ADD CONSTRAINT `fk_NOMINACION_ATRIBUTO1` FOREIGN KEY (`idATRIBUTO`) REFERENCES `atributo` (`idATRIBUTO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_NOMINACION_USUARIO1` FOREIGN KEY (`idNOMINADO`) REFERENCES `usuario` (`idUSUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USUARIO_has_EMPLEADO_USUARIO1` FOREIGN KEY (`idNOMINADOR`) REFERENCES `usuario` (`idUSUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
