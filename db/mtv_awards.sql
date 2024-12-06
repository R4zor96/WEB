-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-12-2024 a las 08:21:30
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mtv_awards`
--

DROP DATABASE IF EXISTS mtv_awards;
CREATE DATABASE IF NOT EXISTS mtv_awards DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE mtv_awards;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

DROP TABLE IF EXISTS `albumes`;
CREATE TABLE IF NOT EXISTS `albumes` (
  `estatus_album` tinyint DEFAULT '0' COMMENT '0: Deshabilitado, 1: Habilitado',
  `fecha_lanzamiento_album` date NOT NULL,
  `id_album` int NOT NULL AUTO_INCREMENT,
  `titulo_album` varchar(50) NOT NULL,
  `descripcion_album` text COMMENT 'El artista aún no ha presentado su biografía',
  `imagen_album` varchar(200) DEFAULT NULL,
  `id_artista` int NOT NULL,
  `id_genero` int NOT NULL,
  PRIMARY KEY (`id_album`),
  KEY `id_artista` (`id_artista`),
  KEY `id_genero` (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`estatus_album`, `fecha_lanzamiento_album`, `id_album`, `titulo_album`, `descripcion_album`, `imagen_album`, `id_artista`, `id_genero`) VALUES
(1, '2024-12-09', 1, 'a', 'a', NULL, 2, 1),
(1, '2024-12-13', 7, 'prueba', 'uiuiuiu', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas`
--

DROP TABLE IF EXISTS `artistas`;
CREATE TABLE IF NOT EXISTS `artistas` (
  `estatus_artista` tinyint DEFAULT '0' COMMENT '0: Deshabilitado, 1: Habilitado',
  `id_artista` int NOT NULL AUTO_INCREMENT,
  `pseudonimo_artista` varchar(50) NOT NULL,
  `nacionalidad_artista` varchar(100) NOT NULL,
  `biografia_artista` text COMMENT 'El artista aún no ha presentado su biografía',
  `id_usuario` int NOT NULL,
  `id_genero` int NOT NULL,
  PRIMARY KEY (`id_artista`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_genero` (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `artistas`
--

INSERT INTO `artistas` (`estatus_artista`, `id_artista`, `pseudonimo_artista`, `nacionalidad_artista`, `biografia_artista`, `id_usuario`, `id_genero`) VALUES
(1, 2, 'Prueba', 'si', 'si', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canciones`
--

DROP TABLE IF EXISTS `canciones`;
CREATE TABLE IF NOT EXISTS `canciones` (
  `estatus_cancion` tinyint DEFAULT '0' COMMENT '0: Deshabilitado, 1: Habilitado',
  `id_acancion` int NOT NULL AUTO_INCREMENT,
  `nombre_cancion` varchar(50) NOT NULL,
  `fecha_lanzamiento_cancion` date DEFAULT NULL,
  `duracion_cancion` time NOT NULL,
  `mp3_cancion` varchar(200) NOT NULL,
  `url_cancion` varchar(200) DEFAULT NULL,
  `url_video_cancion` varchar(200) DEFAULT NULL,
  `id_artista` int NOT NULL,
  `id_genero` int NOT NULL,
  `id_album` int NOT NULL,
  PRIMARY KEY (`id_acancion`),
  KEY `id_artista` (`id_artista`),
  KEY `id_genero` (`id_genero`),
  KEY `id_album` (`id_album`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `canciones`
--

INSERT INTO `canciones` (`estatus_cancion`, `id_acancion`, `nombre_cancion`, `fecha_lanzamiento_cancion`, `duracion_cancion`, `mp3_cancion`, `url_cancion`, `url_video_cancion`, `id_artista`, `id_genero`, `id_album`) VALUES
(1, 3, 'Nombre de la Canción', '2024-12-15', '00:02:45', 'ruta/a/la_cancion.mp3', 'a', 'a', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

DROP TABLE IF EXISTS `generos`;
CREATE TABLE IF NOT EXISTS `generos` (
  `estatus_genero` tinyint DEFAULT '0' COMMENT '0: Deshabilitado, 1: Habilitado',
  `id_genero` int NOT NULL AUTO_INCREMENT,
  `nombre_genero` varchar(50) NOT NULL,
  PRIMARY KEY (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`estatus_genero`, `id_genero`, `nombre_genero`) VALUES
(1, 1, 'Rock Alternativo'),
(0, 2, 'Pop Latino'),
(1, 3, 'Cumbia'),
(0, 4, 'Rock Alternativo'),
(1, 5, 'Pop Latino'),
(0, 6, 'Cumbia'),
(0, 9, 'Rempalago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(8, 'Operador'),
(85, 'Artista'),
(128, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `estatus_usuario` tinyint DEFAULT '0' COMMENT '0: Deshabilitado, 1: Habilitado',
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) NOT NULL,
  `ap_usuario` varchar(50) NOT NULL,
  `am_usuario` varchar(50) DEFAULT NULL,
  `sexo_usuario` tinyint NOT NULL COMMENT '0: Femenino, 1: Masculino',
  `email_usuario` varchar(50) DEFAULT NULL,
  `password_usuario` varchar(64) DEFAULT NULL,
  `imagen_usuario` varchar(200) DEFAULT NULL,
  `id_rol` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`estatus_usuario`, `id_usuario`, `nombre_usuario`, `ap_usuario`, `am_usuario`, `sexo_usuario`, `email_usuario`, `password_usuario`, `imagen_usuario`, `id_rol`) VALUES
(0, 1, 'Admon', 'Admon', NULL, 1, 'admon@mtvawards.com', '0bc01fae70b5e73eabb266178092ea42dfddd9657c903b22210913821ad86261', NULL, 128),
(1, 2, 'Artista', 'Artista', '', 1, 'artista@mtvawards.com', '721dce38870b6a80f02f15a3191634cb4bae3b644649e4f86820b66873c22ea1', NULL, 85),
(0, 3, 'Operador', 'Operador', NULL, 0, 'operador@mtvawards.com', '1725165c9a0b3698a3d01016e0d8205155820b8d7f21835ca64c0f81c728d880', NULL, 8),
(1, 9, 'usuario1', 'usu', 'usu', 1, 'usuario1@example.com', '2270e73a86e507f7a99d98e739a62f96ec812c1a19b37a0db27785e620518566', NULL, 85);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votaciones`
--

DROP TABLE IF EXISTS `votaciones`;
CREATE TABLE IF NOT EXISTS `votaciones` (
  `fecha_creacion_votacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_votacion` int NOT NULL AUTO_INCREMENT,
  `id_artista` int NOT NULL,
  `id_album` int NOT NULL,
  `id_acancion` int NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_votacion`),
  KEY `id_artista` (`id_artista`),
  KEY `id_album` (`id_album`),
  KEY `id_acancion` (`id_acancion`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD CONSTRAINT `albumes_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `artistas` (`id_artista`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `albumes_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `artistas`
--
ALTER TABLE `artistas`
  ADD CONSTRAINT `artistas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artistas_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `canciones`
--
ALTER TABLE `canciones`
  ADD CONSTRAINT `canciones_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `artistas` (`id_artista`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `canciones_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `canciones_ibfk_3` FOREIGN KEY (`id_album`) REFERENCES `albumes` (`id_album`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `votaciones`
--
ALTER TABLE `votaciones`
  ADD CONSTRAINT `votaciones_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `artistas` (`id_artista`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votaciones_ibfk_2` FOREIGN KEY (`id_album`) REFERENCES `albumes` (`id_album`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votaciones_ibfk_3` FOREIGN KEY (`id_acancion`) REFERENCES `canciones` (`id_acancion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votaciones_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
