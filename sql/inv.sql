-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2016 a las 13:12:45
-- Versión del servidor: 5.6.25
-- Versión de PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inv`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cambia_iva`(
        IN `idCab` TINYINT
    )
BEGIN
set @iva_total = (select sum(iva)
from factura_detalle
where numero_factura = idCab); 

update `facturas` 
set `facturas`.`iva_total`=@iva_total, 
`facturas`.`subtotal` = (`facturas`.`total_venta` - @iva_total)
where `detalle_factura`.`numero_factura` = idCab;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombres` varchar(300) DEFAULT NULL,
  `identificacion` varchar(50) DEFAULT NULL,
  `id_tipo_cliente` int(11) DEFAULT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(70) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombres`, `identificacion`, `id_tipo_cliente`, `direccion`, `telefono`, `correo`, `estado`) VALUES
(2, 'JUAN  FLOREZ', '125467', 1, 'centro', '3214324343', 'andres@gmail.com', 1),
(4, 'pedro sandoval', '12102018', 1, 'CENTRO', '3168270783', 'JUAN@GMAIL.COM', 1),
(5, 'ANDRES', '12', NULL, 'CEB', '12', '@', 1),
(6, 'ANDRES', '13', NULL, 'CENTRO', '20', '@', 1),
(8, 'JUAN ANDRES', '23', 2, 'CENTRO', '2335', 'M@GMAIL.COM', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id_config` int(11) NOT NULL,
  `nombre_empresa` varchar(80) DEFAULT NULL,
  `direccion_empresa` varchar(80) DEFAULT NULL,
  `telefono_empresa` varchar(45) DEFAULT NULL,
  `correo_empresa` varchar(200) DEFAULT NULL,
  `nit` varchar(50) DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `pie_pagina` text
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id_config`, `nombre_empresa`, `direccion_empresa`, `telefono_empresa`, `correo_empresa`, `nit`, `iva`, `pie_pagina`) VALUES
(1, 'EMPRESAS LTDA', 'CALLE 23 # 2-34 CENTRO', '8222222', 'myempresa@miempresa.com', '90023456-1', 16, 'ResoluciÃ³n desde 000001 hasta 00000100 del 2016');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `id_detalle` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` double NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=258 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detalle`, `numero_factura`, `id_producto`, `cantidad`, `precio_venta`) VALUES
(255, 10, 5, 1, 1500),
(254, 10, 15, 1, 1000),
(253, 10, 5, 1, 1500),
(252, 9, 19, 1, 2500),
(251, 8, 15, 1, 1000),
(250, 7, 15, 1, 1000),
(249, 6, 15, 1, 1000),
(248, 5, 15, 1, 1000),
(247, 4, 15, 1, 1000),
(246, 4, 15, 1, 1000),
(245, 4, 15, 1, 1000),
(244, 3, 20, 1, 2300),
(243, 3, 5, 1, 1500),
(242, 3, 19, 1, 2500),
(241, 3, 17, 1, 2000),
(240, 3, 15, 1, 1000),
(239, 3, 15, 100, 1000),
(238, 2, 20, 1, 2300),
(235, 1, 15, 1, 1000),
(236, 2, 15, 1, 1000),
(237, 2, 5, 1, 1500);

--
-- Disparadores `detalle_factura`
--
DELIMITER $$
CREATE TRIGGER `delete_productos` BEFORE DELETE ON `detalle_factura`
 FOR EACH ROW BEGIN
set @res = old.cantidad;
UPDATE `productos` set existencias = existencias + @res where id_producto = old.id_producto;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `invetario_update` AFTER UPDATE ON `detalle_factura`
 FOR EACH ROW BEGIN
set @res = new.cantidad;
UPDATE `productos` set existencias = existencias - @res where id_producto = new.id_producto;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `resta_inventario` AFTER INSERT ON `detalle_factura`
 FOR EACH ROW BEGIN

set @res = new.cantidad;
UPDATE `productos` set existencias = existencias - @res where id_producto = new.id_producto;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE IF NOT EXISTS `facturas` (
  `id_factura` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `fecha_factura` datetime NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `condiciones` varchar(30) NOT NULL,
  `total_venta` varchar(20) NOT NULL,
  `estado_factura` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_factura`, `numero_factura`, `fecha_factura`, `id_cliente`, `id_vendedor`, `condiciones`, `total_venta`, `estado_factura`) VALUES
(96, 10, '2017-7-30 04:29:54', 2, 1, '1', '3000', 1),
(95, 9, '2017-7-30 04:24:36', 8, 1, '1', '2500', 1),
(94, 8, '2017-7-30 04:21:45', 2, 1, '1', '1000', 1),
(93, 7, '2017-7-30 23:37:36', 2, 2, '1', '1000', 1),
(92, 6, '2017-7-30 20:58:52', 2, 1, '1', '1000', 1),
(91, 5, '2017-7-29 05:21:33', 2, 2, '1', '1000', 1),
(90, 4, '2017-7-28 23:22:43', 2, 1, '1', '3000', 1),
(89, 3, '2017-7-28 07:38:32', 4, 2, '1', '109300', 1),
(88, 2, '2017-7-28 07:06:24', 2, 1, '1', '4800', 1),
(87, 1, '2017-7-27 17:56:33', 2, 1, '1', '1000', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL,
  `codigo` char(20) DEFAULT NULL,
  `descripcion` char(255) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `existencias` double DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `iva` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `codigo`, `descripcion`, `precio`, `existencias`, `estado`, `iva`) VALUES
(24, '2123', 'COMPUTADORA DELL', 1000, 1200, 1, 12),
(5, '1122', 'COMPUTADORA TOSHIBA', 1200, 4996, NULL, 12),
(20, '2987', 'COMPUTADORA LENOVO', 2300, 228, 1, 12),
(19, '2431', 'COMPUTADORA HP', 2500, 198, 1, 12),
(17, '1210', 'IMPRESORA HP', 90, 199, 1, 12),
(18, '1234', 'IMPRESORA EPSON', 200, 200, 1, 112),
(21, '1214', 'TECLADO', 12, 100, 1, 5),
(12, '2031', 'IMPRESORA LASSER', 1000, 500, 1, 12),
(16, '123', 'COMPUTADORA MAC', 1500, 200, 1, 12),
(22, '23234', 'COMPUTADORA SAMSUNG', 1500, 200, 1, 12),
(23, '9876', 'CAMARAS', 200, 40, 1, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cliente`
--

CREATE TABLE IF NOT EXISTS `tipo_cliente` (
  `id_tipo_cliente` int(11) NOT NULL,
  `descripcion` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_cliente`
--

INSERT INTO `tipo_cliente` (`id_tipo_cliente`, `descripcion`) VALUES
(1, 'PERSONA NATURAL'),
(2, 'PERSON JURIDICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp`
--

CREATE TABLE IF NOT EXISTS `tmp` (
  `id_tmp` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL,
  `precio_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=369 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `user_name`, `user_password_hash`, `user_email`, `date_added`) VALUES
(1, 'admin', 'admin', 'admin', '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO', 'admin@admin.com', '2016-05-21 15:06:00'),
(2, 'Juan', 'Andres', 'juan', '$2y$10$AU4u7/QPWg27Gxk9iN16SeHbrr.QsRXt2VQ2H884UAKwJEDGk8A.O', 'juanandres@gmail.com', '2016-10-06 21:21:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `idx_fk_tipocliente_idx` (`id_tipo_cliente`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id_config`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `numero_cotizacion` (`numero_factura`,`id_producto`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD UNIQUE KEY `numero_cotizacion` (`numero_factura`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  ADD PRIMARY KEY (`id_tipo_cliente`);

--
-- Indices de la tabla `tmp`
--
ALTER TABLE `tmp`
  ADD PRIMARY KEY (`id_tmp`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=258;
--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  MODIFY `id_tipo_cliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=369;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `idx_fk_tipocliente` FOREIGN KEY (`id_tipo_cliente`) REFERENCES `tipo_cliente` (`id_tipo_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
