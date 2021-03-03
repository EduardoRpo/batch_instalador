-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2021 a las 03:03:19
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `batch_record`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agitador`
--

CREATE TABLE `agitador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `agitador`
--

INSERT INTO `agitador` (`id`, `nombre`) VALUES
(1, '0001-00003 AGITADOR HOMO-MIXER'),
(2, '0001-00004 AGITADOR HOMO-MIXER'),
(3, '0001-00045 AGITADOR DE BAJA POTENCIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apariencia`
--

CREATE TABLE `apariencia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `apariencia`
--

INSERT INTO `apariencia` (`id`, `nombre`) VALUES
(1, 'APARIENCIA'),
(2, 'L?QUIDO TRASLUCIDO, MEDIANAMENTE VISCOSO, BRILLANTE Y LIBRE DE PART?CULAS EXTRA?AS.'),
(3, 'L?QUIDO VISCOSO, HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS.'),
(4, 'L?QUIDO PEGAJOSO, HOMOG?NEO, BRILLANTE, LIBRE DE PART?CULAS EXTRA?AS'),
(5, 'L?QUIDO, HOMOG?NEO, CON ADICI?N DE FRAGANCIA.'),
(6, 'CREMA HOMOG?NEA, LIBRE DE PART?CULAS EXTRA?AS.'),
(7, 'CREMA HOMOG?NEA, BRILLANTE, SUAVE, LIBRE DE PART?CULAS EXTRA?AS.'),
(8, 'CREMA HOMOG?NEA, BRILLANTE, LIBRE DE PART?CULAS EXTRA?AS.'),
(9, 'GEL HOMOG?NEO, SUAVE, LIBRE DE PART?CULAS EXTRA?AS.'),
(10, 'GEL HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS.'),
(11, 'EMULSI?N HOMOG?NEA, SUAVE Y LIBRE DE PART?CULAS EXTRA?AS.'),
(12, 'EMULSI?N SUAVE AL TACTO, HOMOG?NEA, CREMOSA, LIBRE DE PART?CULAS EXTRA?AS.'),
(13, 'GEL FLUIDO, TRASLUCIDO, HOMOG?NEO Y LIBRE DE PART?CULAS EXTRA?AS.'),
(14, 'L?QUIDO VISCOSO, SUAVE Y SIN GRUMOS.'),
(15, 'L?QUIDO BRILLANTE, TRASLUCIDO, LIBRE DE PART?CULAS EXTRA?AS.'),
(16, 'CREMA HOMOG?NEA, CON CUERPO, SUAVE, LIBRE DE PART?CULAS EXTRA?AS.'),
(17, 'CREMA HOMOG?NEA Y FLUIDA.'),
(18, 'CREMA SEMIS?LIDA BLANDA, BRILLANTE, HOMOG?NEA, LIBRE DE PART?CULAS EXTRA?AS, SUAVE AL TACTO '),
(19, 'L?QUIDO TRASLUCIDO, LIBRE DE PART?CULAS EXTRA?AS'),
(20, 'CREMA SEMIDURA, HOMOG?NEA, UNTOSA, LIBRE DE PART?CULAS EXTRA?AS.'),
(21, 'L?QUIDO VISCOSO, BRILLANTE, CREMOSO, PERLADO, HOMOG?NEO, LIBRE DE MATERIAL PARTICULADO.'),
(22, 'CREMA PASTOSA, HOMOG?NEA, LIBRE DE MATERIAL PARTICULADO DETECTABLE POR SIMPLE INSPECCI?N.'),
(23, 'L?QUIDO VISCOSO, HOMOG?NEO, LIBRE DE MATERIAL EXTRA?O Y PARTICULADO.'),
(24, 'PASTA S?LIDA, BRILLANTE, HOMOG?NEA, LIBRE DE MATERIAL PARTICULADO.'),
(25, 'L?QUIDO VISCOSO, BRILLANTE, HOMOG?NEO LIBRE DE MATERIAL PARTICULADO. '),
(26, 'EMULSI?N HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS.'),
(27, 'L?QUIDO VISCOSO, JABONOSO, TRASLUCIDO.'),
(28, 'EMULSI?N HOMOG?NEA, SUAVE LIBRE DE IMPUREZAS, IGUAL AL EST?NDAR.'),
(29, 'L?QUIDO TRASLUCIDO, HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS.'),
(30, 'CREMA HOMOG?NEA, SUAVE, LIBRE DE PART?CULAS EXTRA?AS'),
(31, 'L?QUIDO VISCOSO, HOMOG?NEO, CON PART?CULAS DE EXFOLIANTE Y FLOR DE JAMAICA DE SU PARTE INFERIOR. '),
(32, 'EMULSI?N HOMOG?NEA, CON CUERPO, SUAVE, LIBRE DE PART?CULAS EXTRA?AS.'),
(33, 'L?QUIDO HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS.'),
(34, 'GEL SEMIS?LIDO BLANDO, BRILLANTE, HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS, SUAVE AL TACTO '),
(35, 'SEMIS?LIDO, BRILLANTE, HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS, SUAVE AL TACTO'),
(36, 'L?QUIDO VISCOSO, BRILLANTE, CREMOSO, HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS.'),
(37, 'L?QUIDO LIGERAMENTE VISCOSO, HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS.'),
(38, 'CREMA VISCOSA, BRILLANTE, HOMOG?NEA, LIBRE DE MATERIAL PARTICULADO.'),
(39, 'L?QUIDO VISCOSO, SEMIFLUIDO, LECHOSO, LIBRE DE PART?CULAS EXTRA?AS'),
(40, 'CREMA SEMIS?LIDA, HOMOG?NEA, LIBRE DE PART?CULAS EXTRA?AS, SUAVE AL TACTO.'),
(41, 'EMULSI?N HOMOG?NEA, LIBRE DE PART?CULAS EXTRA?AS.'),
(42, 'L?QUIDO FLUIDO, HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS.'),
(43, 'GEL HOMOG?NEO, VISCOSO, SUAVE, LIBRE DE PART?CULAS EXTRA?AS'),
(44, 'LIQU?DO, BRILLANTE, HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS.'),
(45, 'L?QUIDO OLEOSO, SUAVE AL TACTO, HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS.'),
(46, 'CREMA SUAVE, HOMOG?NEA, VISCOSA, LIBRE DE PART?CULAS EXTRA?AS.'),
(47, 'GEL GRUESO, HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS.'),
(48, 'GEL HOMOG?NEO.'),
(49, 'CREMA LIQUIDA HOMOG?NEA.'),
(50, 'SOLUCI?N HIDRO-ALCOH?LICA CON VISOS PERLADOS, LIBRE DE PART?CULAS EXTRA?AS.'),
(51, 'L?QUIDO VISCOSO.'),
(52, 'BRILLANTE CREMOSO, HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS. '),
(53, 'L?QUIDO CLARO, LIBRE DE PART?CULAS EXTRA?AS.'),
(54, 'L?QUIDO VISCOSO, HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS, SUAVE AL TACTO.'),
(55, 'L?QUIDO, LECHOSO, HOMOG?NEO, LIBRE DE PART?CULAS EXTRA?AS.'),
(56, 'SEMIS?LIDO, LIBRE DE PART?CULAS EXTRA?AS.'),
(57, 'CARACTER?STICO.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) CHARACTER SET latin1 NOT NULL,
  `id_modulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_desinfeccion`
--

CREATE TABLE `area_desinfeccion` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `modulo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `area_desinfeccion`
--

INSERT INTO `area_desinfeccion` (`id`, `descripcion`, `modulo`) VALUES
(1, 'Agitador / Homomixer', 3),
(2, 'Alcoholímetros', 4),
(3, 'Área de acondicionamiento', 6),
(4, 'Área de Control Calidad', 4),
(5, 'Área de dispensación, pesaje y balanza electronica', 2),
(6, 'Área de envasado', 5),
(7, 'Área de loteado', 6),
(8, 'Área de preparación', 3),
(9, 'Áreas de lavado y circulación dentro del laboratorio.', 0),
(10, 'Áreas de siembra, preparación, incubación, repiques.', 0),
(11, 'Balanza Analítica', 4),
(12, 'Balanza electrónica.', 5),
(13, 'Banda transportadora', 6),
(14, 'Canasta', 0),
(15, 'Densímetros', 4),
(16, 'Ductos y mangueras de transferencia del producto.', 5),
(17, 'Envasadora.', 5),
(18, 'Equipos principales', 0),
(19, 'Equipos y/o utensilios auxiliares', 0),
(20, 'Loteadora videojet', 6),
(21, 'Maquinas pegadoras de etiquetas.', 0),
(22, 'Marmita y/o Tanque preparación', 3),
(23, 'Mesa auxiliar', 6),
(24, 'Mesones', 4),
(25, 'Mesones', 5),
(26, 'Phmetro', 4),
(27, 'Recipientes o contenedores originales de las MP', 2),
(28, 'Recipientes para la dosificación', 2),
(29, 'Tunel termoencogible', 0),
(30, 'Utensilios en general.', 0),
(31, 'Utensilios', 3),
(32, 'Viscosímetro', 4),
(33, 'Utensilios', 4),
(34, 'Utensilios', 5),
(35, 'Utensilios', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batch`
--

CREATE TABLE `batch` (
  `id_batch` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_programacion` date DEFAULT NULL,
  `fecha_actual` date NOT NULL,
  `numero_orden` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `numero_lote` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `tamano_lote` int(11) NOT NULL,
  `lote_presentacion` int(11) NOT NULL,
  `unidad_lote` int(11) NOT NULL,
  `estado` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `id_producto` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `multi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `batch`
--

INSERT INTO `batch` (`id_batch`, `fecha_creacion`, `fecha_programacion`, `fecha_actual`, `numero_orden`, `numero_lote`, `tamano_lote`, `lote_presentacion`, `unidad_lote`, `estado`, `id_producto`, `multi`) VALUES
(5, '2021-01-20', '2021-01-21', '2021-01-20', 'OP001/21', 'LQ0010121', 201, 80, 2525, '1', '20020', 1),
(6, '2021-01-21', '2021-01-22', '2021-01-21', 'OP002/21', 'LQ0010121', 4502, 1000, 4525, '1', '20019', 0),
(7, '2021-01-22', '2021-01-22', '2021-01-22', 'OP003/21', 'LQ0010121', 448, 450, 1000, '1', '20018', 0),
(8, '2021-01-22', '2021-02-23', '2021-01-22', 'OP004/21', 'LQ0010121', 995, 1000, 1000, '1', '20019', 0),
(9, '2021-01-22', '2021-01-22', '2021-01-22', 'OP005/21', 'LQ0010121', 605, 80, 7600, '1', '20020', 1),
(10, '2021-01-22', '0000-00-00', '2021-01-22', 'OP006/21', 'LQ0010121', 905, 1000, 910, '1', '20019', 0),
(11, '2021-02-09', '0000-00-00', '2021-02-09', 'OP007/21', 'LQ0010221', 1990, 1000, 2000, '1', '20003', 0),
(12, '2021-02-18', NULL, '2021-02-18', 'OP008/21', 'LQ0010221', 1990, 1000, 2000, '0', '20003', 0),
(13, '2021-02-18', NULL, '2021-02-18', 'OP009/21', 'LQ0010221', 1990, 1000, 2000, '0', '20003', 0),
(14, '2021-02-18', '0000-00-00', '2021-02-18', 'OP010/21', 'LQ0010221', 497, 1000, 500, '1', '20003', 0),
(15, '2021-02-18', NULL, '2021-02-18', 'OP011/21', 'LQ0010221', 497, 1000, 500, '0', '20003', 0),
(16, '2021-02-18', NULL, '2021-02-18', 'OP012/21', 'LQ0010221', 497, 1000, 500, '0', '20003', 0),
(17, '2021-02-18', NULL, '2021-02-18', 'OP013/21', 'LQ0010221', 497, 1000, 500, '0', '20003', 0),
(18, '2021-02-18', NULL, '2021-02-18', 'OP014/21', 'LQ0010221', 497, 1000, 500, '0', '20003', 0),
(19, '2021-02-18', NULL, '2021-02-18', 'OP015/21', 'LQ0010221', 497, 1000, 500, '0', '20003', 0),
(20, '2021-02-18', NULL, '2021-02-18', 'OP016/21', 'LQ0010221', 497, 1000, 500, '0', '20003', 0),
(21, '2021-02-18', NULL, '2021-02-18', 'OP017/21', 'LQ0010221', 497, 1000, 500, '0', '20003', 0),
(22, '2021-02-18', NULL, '2021-02-18', 'OP018/21', 'LQ0010221', 497, 1000, 500, '0', '20003', 0),
(23, '2021-02-18', NULL, '2021-02-18', 'OP019/21', 'LQ0010221', 497, 1000, 500, '0', '20003', 0);

--
-- Disparadores `batch`
--
DELIMITER $$
CREATE TRIGGER `trig_before_insert_batch` BEFORE INSERT ON `batch` FOR EACH ROW begin 
  DECLARE vn_numero_orden VARCHAR (10); 
   
  DECLARE vn_annio VARCHAR(2); 
  DECLARE vn_linea VARCHAR(2); 
  DECLARE vn_numero_lote VARCHAR(10); 
  -- sacar en numero de orden 
  SELECT lpad( max(substring(numero_orden, 3, 3)) +1, 3, 0 ) 
  INTO   vn_numero_orden 
  FROM   batch 
  WHERE  substring(numero_orden, 7, 2) = date_format(now(), '%y') ; 
   
  -- año actual 
  SELECT date_format(now(), '%y') 
  INTO   vn_annio; 
   
  IF vn_numero_orden IS NULL THEN 
    SET vn_numero_orden = '001'; 
  END IF; 
  SET new.numero_orden = concat( 'OP', 
  vn_numero_orden, '/', 
  vn_annio 
  ); 
  -- seleccion de tipo de linea 
  SELECT 
         CASE 
                WHEN id_linea = 1 THEN 'SM' 
                WHEN id_linea = 2 THEN 'LQ' 
                WHEN id_linea = 3 THEN 'SL' 
         end 
  INTO   vn_linea 
  FROM   producto 
  WHERE  referencia = new.id_producto; 
   
  -- seleccion de consecutivo para numero de lote 
  SELECT lpad( max(substring(numero_lote, 2, 3)) +1, 3, 0 ) 
  INTO   vn_numero_lote 
  FROM   batch 
  WHERE  substring(numero_lote, 7, 2) = date_format(now(), '%y') 
  AND    substring(numero_lote, 1, 1) = vn_linea; 
   
  IF vn_numero_lote IS NULL THEN 
    SET vn_numero_lote = '001'; 
  END IF; 
  SET new 
  .numero_lote = concat( 
  vn_linea, 
  vn_numero_lote, 
  date_format(now(), '%m'), 
  vn_annio); 
	
  IF new.fecha_programacion is not null THEN
  	SET new.estado = 1;
  ELSE
  	SET new.estado = 0;
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trig_before_update_batch` BEFORE UPDATE ON `batch` FOR EACH ROW IF new.fecha_programacion is not null THEN
	SET new.estado = 1;
ELSE 
	SET new.estado = 0;	
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batch_conciliacion_rendimiento`
--

CREATE TABLE `batch_conciliacion_rendimiento` (
  `id` int(5) NOT NULL,
  `unidades_producidas` int(5) NOT NULL,
  `cajas` int(3) NOT NULL,
  `muestras_retencion` int(3) NOT NULL,
  `mov_inventario` int(11) NOT NULL,
  `batch` int(5) NOT NULL,
  `modulo` int(3) NOT NULL,
  `ref_multi` int(11) NOT NULL,
  `entrego` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batch_condicionesmedio`
--

CREATE TABLE `batch_condicionesmedio` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `temperatura` int(11) NOT NULL,
  `humedad` int(11) NOT NULL,
  `id_batch` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `batch_condicionesmedio`
--

INSERT INTO `batch_condicionesmedio` (`id`, `fecha`, `temperatura`, `humedad`, `id_batch`, `id_modulo`) VALUES
(18, '2021-01-21 02:46:35', 25, 65, 5, 2),
(19, '2021-01-21 02:50:45', 25, 65, 5, 2),
(20, '2021-01-21 02:57:21', 25, 65, 5, 2),
(21, '2021-01-21 12:09:13', 25, 65, 5, 3),
(22, '2021-01-21 16:22:16', 20, 55, 5, 2),
(23, '2021-01-21 23:17:26', 25, 65, 5, 3),
(24, '2021-01-22 00:59:37', 25, 65, 5, 2),
(25, '2021-01-22 01:12:25', 25, 65, 6, 2),
(26, '2021-01-22 11:39:43', 25, 65, 5, 3),
(27, '2021-01-22 11:50:52', 25, 65, 6, 2),
(28, '2021-01-22 12:36:09', 30, 75, 5, 2),
(29, '2021-01-22 12:48:08', 24, 75, 7, 2),
(30, '2021-01-22 13:39:22', 25, 65, 5, 3),
(31, '2021-01-22 15:59:08', 25, 65, 9, 2),
(32, '2021-02-11 11:44:24', 25, 65, 11, 2),
(33, '2021-02-14 13:16:03', 25, 65, 11, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batch_control_especificaciones`
--

CREATE TABLE `batch_control_especificaciones` (
  `id` int(5) NOT NULL,
  `color` float NOT NULL,
  `olor` float NOT NULL,
  `apariencia` float NOT NULL,
  `ph` float NOT NULL,
  `viscosidad` float NOT NULL,
  `densidad` float NOT NULL,
  `untuosidad` float NOT NULL,
  `espumoso` float NOT NULL,
  `alcohol` float NOT NULL,
  `modulo` int(5) NOT NULL,
  `batch` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `batch_control_especificaciones`
--

INSERT INTO `batch_control_especificaciones` (`id`, `color`, `olor`, `apariencia`, `ph`, `viscosidad`, `densidad`, `untuosidad`, `espumoso`, `alcohol`, `modulo`, `batch`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 3, 1),
(2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 3, 1),
(3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 4, 2),
(4, 1, 1, 1, 1, 2000, 0, 2, 1, 30, 4, 3),
(5, 2, 1, 1, 3, 5, 20, 2, 1, 2, 4, 3),
(6, 1, 1, 1, 1, 2, 3, 1, 1, 20, 4, 3),
(7, 2, 2, 1, 1, 1, 2, 1, 1, 2, 4, 3),
(8, 1, 1, 1, 5, 6, 0.1, 1, 1, 0, 4, 5),
(9, 2, 2, 2, 5, 5, 5, 2, 1, 0, 4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batch_desinfectante_seleccionado`
--

CREATE TABLE `batch_desinfectante_seleccionado` (
  `id` int(4) NOT NULL,
  `desinfectante` tinyint(2) NOT NULL,
  `observaciones` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `modulo` tinyint(2) NOT NULL,
  `batch` tinyint(4) NOT NULL,
  `realizo` int(4) NOT NULL,
  `verifico` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `batch_desinfectante_seleccionado`
--

INSERT INTO `batch_desinfectante_seleccionado` (`id`, `desinfectante`, `observaciones`, `modulo`, `batch`, `realizo`, `verifico`) VALUES
(1, 2, '', 2, 1, 3, 1),
(2, 4, '', 3, 1, 3, 1),
(3, 3, '', 4, 2, 3, 0),
(4, 1, '', 5, 1, 3, 0),
(5, 3, '', 2, 3, 3, 1),
(6, 3, '', 3, 2, 3, 0),
(7, 2, '', 2, 4, 3, 0),
(8, 0, '', 3, 4, 3, 0),
(9, 1, '', 3, 3, 3, 1),
(10, 3, '', 4, 3, 1, 0),
(11, 3, '', 4, 3, 1, 0),
(12, 3, '', 4, 3, 1, 0),
(13, 3, '', 4, 3, 1, 0),
(14, 1, '', 5, 3, 1, 1),
(15, 2, '', 2, 5, 3, 1),
(16, 2, '', 3, 5, 1, 1),
(17, 2, '', 4, 5, 3, 0),
(18, 2, '', 4, 5, 3, 0),
(19, 1, '', 2, 6, 3, 0),
(20, 2, '', 5, 5, 3, 0),
(21, 2, '', 2, 7, 1, 0),
(22, 1, '', 2, 9, 1, 3),
(23, 2, 'b', 2, 11, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batch_eliminado`
--

CREATE TABLE `batch_eliminado` (
  `id_batch` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_programacion` date DEFAULT NULL,
  `fecha_eliminacion` date NOT NULL,
  `numero_orden` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `numero_lote` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `tamano_lote` int(11) NOT NULL,
  `lote_presentacion` int(11) NOT NULL,
  `unidad_lote` int(11) NOT NULL,
  `id_producto` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batch_firmas2seccion`
--

CREATE TABLE `batch_firmas2seccion` (
  `id` int(11) NOT NULL,
  `observaciones` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `modulo` int(3) NOT NULL,
  `batch` int(4) NOT NULL,
  `ref_multi` int(7) NOT NULL,
  `realizo` int(3) NOT NULL,
  `verifico` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `batch_firmas2seccion`
--

INSERT INTO `batch_firmas2seccion` (`id`, `observaciones`, `modulo`, `batch`, `ref_multi`, `realizo`, `verifico`) VALUES
(1, 'Hola', 2, 1, 0, 3, 1),
(2, '', 4, 2, 0, 3, 0),
(3, 'hola', 2, 3, 0, 3, 1),
(4, '', 2, 4, 0, 3, 1),
(5, '', 4, 3, 0, 1, 0),
(6, '', 2, 5, 0, 3, 1),
(7, '', 4, 5, 0, 3, 1),
(8, 'jjhjjhj', 2, 6, 0, 3, 0),
(9, 'la bascula estaba mala', 2, 7, 0, 1, 0),
(10, '', 2, 9, 0, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batch_incidencias`
--

CREATE TABLE `batch_incidencias` (
  `id` tinyint(4) NOT NULL,
  `incidencia` tinyint(4) NOT NULL,
  `motivo` tinyint(4) NOT NULL,
  `modulo` tinyint(4) NOT NULL,
  `batch` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `batch_incidencias`
--

INSERT INTO `batch_incidencias` (`id`, `incidencia`, `motivo`, `modulo`, `batch`) VALUES
(1, 1, 1, 2, 1),
(2, 2, 10, 2, 1),
(3, 3, 22, 2, 1),
(4, 5, 40, 4, 2),
(5, 6, 44, 4, 2),
(6, 7, 51, 4, 2),
(7, 1, 2, 2, 3),
(8, 5, 42, 2, 3),
(9, 5, 41, 2, 4),
(10, 7, 51, 2, 4),
(11, 1, 4, 4, 3),
(12, 4, 35, 4, 3),
(13, 7, 52, 4, 3),
(14, 1, 6, 2, 5),
(15, 6, 44, 2, 5),
(16, 3, 29, 4, 5),
(17, 1, 2, 2, 6),
(18, 3, 30, 2, 7),
(19, 5, 41, 2, 9),
(20, 7, 51, 2, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batch_muestras`
--

CREATE TABLE `batch_muestras` (
  `id` int(50) NOT NULL,
  `muestra` float NOT NULL,
  `id_batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `batch_muestras`
--

INSERT INTO `batch_muestras` (`id`, `muestra`, `id_batch`) VALUES
(1, 10, 4),
(2, 12, 4),
(3, 13, 4),
(4, 13, 4),
(5, 13, 4),
(6, 45, 4),
(7, 5, 4),
(8, 2, 4),
(9, 6, 4),
(10, 6, 4),
(11, 6, 4),
(12, 6, 4),
(13, 6, 4),
(14, 6, 4),
(15, 6, 4),
(16, 66, 4),
(17, 6, 4),
(18, 6, 4),
(19, 6, 4),
(20, 6, 4),
(78, 7, 3),
(79, 20, 3),
(80, 7, 3),
(81, 50, 3),
(82, 7, 3),
(83, 50, 3),
(84, 20, 3),
(85, 80, 3),
(86, 20, 3),
(87, 20, 3),
(88, 20, 3),
(89, 20, 3),
(90, 20, 3),
(91, 20, 3),
(92, 20, 3),
(93, 7, 3),
(94, 7, 3),
(95, 7, 3),
(96, 7, 3),
(97, 7, 3),
(98, 7, 3),
(99, 7, 3),
(100, 7, 3),
(101, 7, 3),
(102, 7, 3),
(103, 7, 3),
(104, 7, 3),
(105, 7, 3),
(106, 7, 3),
(107, 7, 3),
(108, 7, 3),
(109, 7, 3),
(110, 7, 3),
(111, 7, 3),
(112, 7, 3),
(113, 7, 3),
(114, 7, 3),
(115, 7, 3),
(116, 7, 3),
(117, 7, 3),
(118, 7, 3),
(119, 7, 3),
(120, 7, 3),
(121, 7, 3),
(122, 7, 3),
(123, 7, 3),
(124, 7, 3),
(125, 7, 3),
(126, 7, 3),
(127, 7, 3),
(128, 7, 3),
(129, 7, 3),
(130, 7, 3),
(131, 7, 3),
(132, 7, 3),
(133, 7, 3),
(134, 7, 3),
(135, 7, 3),
(136, 7, 3),
(137, 7, 3),
(138, 7, 3),
(139, 7, 3),
(140, 7, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batch_req_ajuste`
--

CREATE TABLE `batch_req_ajuste` (
  `id` int(5) NOT NULL,
  `materia_prima` varchar(180) COLLATE utf8_spanish_ci NOT NULL,
  `procedimiento` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `modulo` int(3) NOT NULL,
  `id_batch` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `batch_req_ajuste`
--

INSERT INTO `batch_req_ajuste` (`id`, `materia_prima`, `procedimiento`, `modulo`, `id_batch`) VALUES
(1, 'A', 'B', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batch_solucion_pregunta`
--

CREATE TABLE `batch_solucion_pregunta` (
  `id` int(11) NOT NULL,
  `solucion` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `id_pregunta` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `batch_solucion_pregunta`
--

INSERT INTO `batch_solucion_pregunta` (`id`, `solucion`, `id_pregunta`, `id_modulo`, `id_batch`) VALUES
(1, '1', '1', 2, 1),
(2, '1', '7', 2, 1),
(3, '0', '11', 2, 1),
(4, '1', '8', 2, 1),
(5, '0', '9', 2, 1),
(6, '1', '7', 3, 1),
(7, '1', '6', 3, 1),
(8, '1', '17', 3, 1),
(9, '0', '11', 3, 1),
(10, '1', '3', 3, 1),
(11, '1', '7', 5, 1),
(12, '0', '9', 5, 1),
(13, '1', '1', 5, 1),
(14, '1', '3', 5, 1),
(15, '1', '14', 5, 1),
(16, '1', '1', 2, 3),
(17, '0', '7', 2, 3),
(18, '1', '11', 2, 3),
(19, '1', '8', 2, 3),
(20, '1', '9', 2, 3),
(21, '1', '7', 3, 2),
(22, '1', '6', 3, 2),
(23, '0', '17', 3, 2),
(24, '1', '11', 3, 2),
(25, '1', '3', 3, 2),
(26, '1', '1', 2, 4),
(27, '0', '7', 2, 4),
(28, '1', '11', 2, 4),
(29, '0', '8', 2, 4),
(30, '1', '9', 2, 4),
(31, '0', '7', 3, 4),
(32, '0', '6', 3, 4),
(33, '0', '17', 3, 4),
(34, '1', '11', 3, 4),
(35, '0', '3', 3, 4),
(36, '1', '7', 3, 3),
(37, '0', '6', 3, 3),
(38, '1', '17', 3, 3),
(39, '0', '11', 3, 3),
(40, '1', '3', 3, 3),
(41, '0', '14', 5, 3),
(42, '1', '15', 5, 3),
(43, '1', '16', 5, 3),
(44, '0', '17', 5, 3),
(45, '0', '18', 5, 3),
(46, '1', '19', 5, 3),
(47, '1', '1', 2, 5),
(48, '1', '2', 2, 5),
(49, '1', '3', 2, 5),
(50, '1', '4', 2, 5),
(51, '1', '5', 2, 5),
(52, '1', '6', 3, 5),
(53, '1', '7', 3, 5),
(54, '0', '8', 3, 5),
(55, '1', '9', 3, 5),
(56, '0', '10', 3, 5),
(57, '1', '11', 3, 5),
(58, '0', '12', 3, 5),
(59, '1', '13', 3, 5),
(60, '1', '1', 2, 6),
(61, '1', '2', 2, 6),
(62, '1', '3', 2, 6),
(63, '1', '4', 2, 6),
(64, '0', '5', 2, 6),
(65, '1', '14', 5, 5),
(66, '1', '15', 5, 5),
(67, '1', '16', 5, 5),
(68, '1', '17', 5, 5),
(69, '1', '18', 5, 5),
(70, '1', '19', 5, 5),
(71, '0', '1', 2, 7),
(72, '1', '2', 2, 7),
(73, '1', '3', 2, 7),
(74, '1', '4', 2, 7),
(75, '0', '5', 2, 7),
(76, '1', '1', 2, 9),
(77, '1', '2', 2, 9),
(78, '0', '3', 2, 9),
(79, '1', '4', 2, 9),
(80, '1', '5', 2, 9),
(81, '1', '1', 2, 11),
(82, '1', '2', 2, 11),
(83, '1', '3', 2, 11),
(84, '0', '4', 2, 11),
(85, '0', '5', 2, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batch_tanques`
--

CREATE TABLE `batch_tanques` (
  `id` int(11) NOT NULL,
  `tanque` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `id_batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `batch_tanques`
--

INSERT INTO `batch_tanques` (`id`, `tanque`, `cantidad`, `id_batch`) VALUES
(1, 150, 3, 1),
(3, 30, 1, 2),
(4, 450, 4, 3),
(5, 350, 2, 4),
(6, 100, 2, 5),
(7, 450, 10, 6),
(8, 350, 1, 7),
(10, 450, 2, 8),
(11, 300, 2, 9),
(16, 450, 2, 10),
(19, 450, 4.4, 11),
(20, 450, 1, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batch_tanques_chks`
--

CREATE TABLE `batch_tanques_chks` (
  `id` int(5) NOT NULL,
  `linea` int(3) NOT NULL,
  `tanques` int(2) NOT NULL,
  `tanquesOk` int(2) NOT NULL,
  `modulo` int(2) NOT NULL,
  `batch` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `batch_tanques_chks`
--

INSERT INTO `batch_tanques_chks` (`id`, `linea`, `tanques`, `tanquesOk`, `modulo`, `batch`) VALUES
(1, 0, 3, 3, 2, 1),
(2, 1, 3, 2, 3, 1),
(3, 0, 1, 1, 4, 2),
(4, 0, 4, 4, 2, 3),
(5, 0, 2, 2, 2, 4),
(6, 0, 4, 4, 4, 3),
(7, 0, 2, 2, 2, 5),
(8, 0, 2, 2, 4, 5),
(9, 0, 10, 10, 2, 6),
(10, 0, 1, 1, 2, 7),
(11, 0, 2, 2, 2, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `cargo` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `posicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `cargo`, `posicion`) VALUES
(1, 'Director técnico', 1),
(2, 'Director de producción', 9),
(3, 'Supervisor de producción', 6),
(4, 'Analista de calidad', 3),
(5, 'Operario pesaje', 5),
(6, 'Operario producción', 4),
(7, 'Operario envasado', 7),
(8, 'Operario acondicionamiento', 8),
(9, 'Auxiliar de almacén mp', 2),
(10, 'Auxiliar de almacén me', 10),
(11, 'Auxiliar de almacén pt', 11),
(12, 'Director de calidad', 12),
(13, 'Director de operaciones', 13),
(14, 'Practicante de calidad', 0),
(15, 'Analista de microbiología', 0),
(16, 'Asistente de aseguramiento', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`id`, `nombre`) VALUES
(1, 'Azul celeste\r'),
(2, 'Conforme al est?ndar, seg?n el grupo cosm?tico.\r'),
(3, 'Conforme al est?ndar.\r'),
(4, 'Blanco, conforme al est?ndar\r'),
(5, 'Caf? oscuro\r'),
(6, 'Conforme al est?ndar, con adici?n de fragancia.\r'),
(7, 'Seg?n colorante.\r'),
(8, 'Amarillo cadmio, conforme al est?ndar.\r'),
(9, 'Blanco perla.\r'),
(10, 'Caf? claro.\r'),
(11, 'Caracter?stico al est?ndar.\r'),
(12, 'Blanco ligeramente amarillento, igual al est?ndar.\r'),
(13, 'Conforme al est?ndar, con destellos dorados.\r'),
(14, 'Caracter?stico al est?ndar, seg?n el grupo cosm?tico.\r'),
(15, 'Conforme al est?ndar, con adici?n de fragancia, seg?n el grupo cosm?tico\r'),
(16, 'Seg?n el est?ndar\r'),
(17, 'S?lido compacta, homog?nea, sin part?culas que se aprecien a simple vista\r'),
(18, 'Blanco\r'),
(19, 'Seg?n referencia \r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condicionesmedio_tiempo`
--

CREATE TABLE `condicionesmedio_tiempo` (
  `id` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `t_min` int(11) NOT NULL,
  `t_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `condicionesmedio_tiempo`
--

INSERT INTO `condicionesmedio_tiempo` (`id`, `id_modulo`, `t_min`, `t_max`) VALUES
(1, 2, 1, 9),
(2, 3, 4, 30),
(3, 4, 1, 3),
(4, 5, 3, 30),
(5, 6, 1, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `densidad_gravedad`
--

CREATE TABLE `densidad_gravedad` (
  `id` int(11) NOT NULL,
  `limite_inferior` float NOT NULL,
  `limite_superior` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `densidad_gravedad`
--

INSERT INTO `densidad_gravedad` (`id`, `limite_inferior`, `limite_superior`) VALUES
(1, 0, 0),
(2, 0.8, 1.05),
(3, 0.8, 1),
(4, 0.82, 1.05),
(5, 0.85, 0.95),
(6, 0.85, 1.15),
(7, 0.85, 1.05),
(8, 0.85, 1),
(9, 0.85, 1.02),
(10, 0.89, 1.02),
(11, 0.89, 1.2),
(12, 0.9, 1.3),
(13, 0.9, 1.1),
(14, 0.9, 1.15),
(15, 0.9, 1.05),
(16, 0.9, 1),
(17, 0.95, 1.15),
(18, 0.95, 1.02),
(19, 0.95, 1.05),
(20, 0.95, 1.1),
(21, 0.95, 1.2),
(22, 0.97, 1.15),
(23, 0.97, 1.09),
(24, 0.97, 1.01),
(25, 0.98, 1.1),
(26, 0.98, 1.2),
(27, 1.01, 1.05),
(28, 1.03, 1.09),
(29, 1.05, 1.25),
(30, 1.25, 0),
(31, 1.5, 4),
(32, 1.9, 2.4),
(33, 2, 12),
(34, 2, 6),
(35, 2.5, 6),
(36, 3, 7),
(37, 5, 6),
(38, 12, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desinfectante`
--

CREATE TABLE `desinfectante` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `concentracion` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `desinfectante`
--

INSERT INTO `desinfectante` (`id`, `nombre`, `concentracion`) VALUES
(1, 'Alcohol', 0.7),
(2, 'Desinfex', 0.01),
(3, 'Glutapure', 0.005),
(4, 'Pure citrus ', 0.003);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empaque`
--

CREATE TABLE `empaque` (
  `id` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empaque`
--

INSERT INTO `empaque` (`id`, `nombre`) VALUES
('50186', 'CAJA NO 7 (39.5X31X16.5) - LINEA GOURMET (MAYO -CHOC) + 2 TIRAS (39X16.5)'),
('50269', 'CAJA NO 1 (42.5X32.6X24) - LINEA 450 ML (40 UND)'),
('50279', 'CAJA NO 2 (39.5X31X19) - LINEA MIXTA'),
('50573', 'CAJA NO 3 (38X28.5X32.5) - POTE MAWIE X 450 (36 UND)'),
('50641', 'CAJA NO 6 (40X20.5X29) - LITROS X 12 UND'),
('50753', 'CAJA NO 8 (32X24X12.5) - ACEITE ARGAN (48 UND)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envasadora`
--

CREATE TABLE `envasadora` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `envasadora`
--

INSERT INTO `envasadora` (`id`, `nombre`) VALUES
(1, 'ENVASADORA NEUMATICA LIQUIDOS'),
(2, 'ENVASADORA NEUMATICA SEMISOLIDOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envase`
--

CREATE TABLE `envase` (
  `id` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `envase`
--

INSERT INTO `envase` (`id`, `nombre`) VALUES
('50005', 'envase antibacterial x 40 ml\r'),
('50006', 'envase bala x 120 ml\r'),
('50007', 'envase campana transparente (500 ml)\r'),
('50011', 'envase cilindrico x 500 ml (boston round)\r'),
('50013', 'envase eliptico naturalx 1000 ml b 28/415\r'),
('50014', 'envase eliptico pet blanco - boca 24/410 (300 ml)\r'),
('50015', 'envase eliptico - 50431- pet trans - boca 28/410 (500 ml) - coral\r'),
('50016', 'envase gel esferico x 500 ml\r'),
('50018', 'envase elipticox140ml\r'),
('50019', 'envase hexagonal x 300ml perlado\r'),
('50020', 'envase oval x 450 ml\r'),
('50021', 'envase oval cr x 400 ml\r'),
('50023', 'envase oval x 270 ml pp b24 snap bco\r'),
('50024', 'envase oval x 450 ml pead b 24 snap bco\r'),
('50025', 'envase pet ensue?o x 500 ml 28/410\r'),
('50026', 'envase pet lagrima x 380 ml\r'),
('50029', 'envase sap perlado - (180 gr)\r'),
('50031', 'envase vidrio trinity (18/415)\r'),
('50048', 'envase colapsible blanco (19x100 mm) - (15 ml)\r'),
('50083', 'envase plano sh - pead blanco b snap - (450 ml)\r'),
('50084', 'envase conico - boca 24/410 - (120 ml)\r'),
('50092', 'envase bala x60ml\r'),
('50093', 'envase conicox120 b24-410 cuello largo\r'),
('50105', 'envase bala cuadrado x 240ml\r'),
('50107', 'envase colapsible x 300ml perlado\r'),
('50122', 'envase colapsible x 120ml blanco con tapon y tapa (maides)\r'),
('50123', 'envase colapsible x 120ml perlado (naturex)\r'),
('50124', 'envase eliptico perlado / nacarado - boca 28/410 - (1.000 ml\r'),
('50125', 'envase eliptico x 300ml pet bco (salubell)\r'),
('50132', 'envase eliptico x 500ml b28/410 salubell\r'),
('50134', 'envase bala x 240 mawie\r'),
('50146', 'envase colapsible negro - sin impresi?n con tapa - (250 ml)\r'),
('50149', 'tapa envase cosmetico\r'),
('50193', 'envase oval perlado x 300ml(natural sofy)\r'),
('50197', 'envase de vidrioone million-maides\r'),
('50202', 'envase 24/410-maides\r'),
('50220', 'envase esbelto perlado / nacarado - boca 28/410 - (500 ml)\r'),
('50223', 'envase colapsible x 120ml blanco con tapon y tapa verde\r'),
('50224', 'envase colapsible blanco - sin impresion con tapa - (60 ml)\r'),
('50225', 'envase colapsible blanco - sin impresion con tapa - (130 ml)\r'),
('50227', 'envase redondo boca 80 x 350\r'),
('50228', 'envase bala pet traslucido - boca 28/410 - (500 ml)\r'),
('50229', 'envase pet natural - boca 28/415 - (1.000 ml)\r'),
('50236', 'envase espumero (incluye valvula y sobretapa) fling foaming pump - 160ml\r'),
('50238', 'envase conico fie x 240ml pet\r'),
('50239', 'envase plastico\r'),
('50240', 'envase esbelto blanco 500ml\r'),
('50242', 'envase eliptico np x 275ml pet boca 24-410 tte\r'),
('50243', 'envase hotelero h 3 perlino\r'),
('50270', 'envase stand up 200 ml r13 pp blc\r'),
('50272', 'envase bala transp. x 1000 cc pvc r 28\r'),
('50278', 'envase antibacterial 37 ml de 5 gr\r'),
('50288', 'envase hombro recto 250cc\r'),
('50290', 'envase splash np x120 ml pet tte b24-410\r'),
('50302', 'envase esbelto negro (500 ml)\r'),
('50319', 'envase ranurado 35ml\r'),
('50325', 'envase gel antibacterial body 32ml\r'),
('50326', 'envase rec 60 cc desodorante negro\r'),
('50329', 'envase rec 60cc desodorante blanco\r'),
('50335', 'envase splash np x 120 pet amarillo b24-410\r'),
('50336', 'envase splash np x 120 pet azul b24-410\r'),
('50337', 'envase splash np x 120 pet verde b24-410\r'),
('50347', 'envase antibacterial x 32 ml negro\r'),
('50362', 'envase polietileno 60gr oro\r'),
('50369', 'envase candado x 30ml\r'),
('50381', 'envase estelar 30 ml de 5.4 gr\r'),
('50407', 'envase fenix blanco x 450 ml\r'),
('50412', 'envase colapsible blanco - sin impresion con tapa - (240 ml)\r'),
('50425', 'envase champagne -260 ml boca 24/410\r'),
('50432', 'envase mimosa amarillo b28/410 (500 ml)\r'),
('50433', 'envase milk - shampoo leche - mawie (430 ml) 28/410\r'),
('50506', 'envase ampolleta transparente (10 ml)\r'),
('50508', 'envase cilindrico (16 ml)\r'),
('50510', 'envase bala negro (120 ml) - t? capilar isabely\r'),
('50608', 'envase cintura cafe oscuro\r'),
('50618', 'envase negro fenix x 450 ml\r'),
('50620', 'envase polietileno 60 gr negro bioelixir\r'),
('50627', 'envase rollon negro azul x 90 cc\r'),
('50629', 'envase redondo 90 cc des improbel gr\r'),
('50633', 'envase bala x 250 cc pet r 24 s/tmawie\r'),
('50647', 'envase giordy 28 ml muestras\r'),
('50654', 'envase pet panal x 250 ml natural\r'),
('50655', 'envase tubo colapsible 35x135 con tapa flip top lacado brillante\r'),
('50657', 'envase bala x 120 ml minipet\r'),
('50662', 'envase ambar x 120ml clariderm\r'),
('50667', 'envase gris fenix x 450 ml\r'),
('50674', 'envase de vidrio 0901 18 din amb 5 cc\r'),
('50696', 'envase eliptico x500 ml pet tte b28 34 gr\r'),
('50697', 'envase medio kilo x 500 ml mayonesa / chocolate\r'),
('50717', 'envase pote x 100 ml color blanco\r'),
('50724', 'envase pink x 250 ml pet bco b24-410 22\r'),
('50726', 'envase transparente vodka (260 ml) - 28/410\r'),
('50755', 'envase redondo estimulador capilar - isabely (10 ml)\r'),
('50770', 'envase pet - galon con tapa y contratapa (4 litros) - institucional mawie\r'),
('50772', 'envase pet - galon con tapa y contratapa (5 litros) - institucional mawie\r'),
('50782', 'envase pet - galon con tapa y contratapa (1 litro) - institucional mawie\r'),
('50794', 'envase - garrafa blanca - 20 litros\r'),
('50795', 'envase colapsible negro - sin impresi?n con tapa - (120 ml)\r'),
('50809', 'envase pure blanco - boca 24/410 (160 ml)\r'),
('50810', 'envase cuadrado blanco - boca 28/410 (500 ml)\r'),
('50820', 'envase longo blanco - boca 24/410 (400 ml)\r'),
('C51000', 'envase plano blanco ( 435 ml) - d-mag\r'),
('C51001', 'envase plano blanco ( 260 ml) - d-mag\r'),
('C51002', 'envase plano dorado ( 435 ml) - d-mag\r'),
('C51003', 'envase plano dorado ( 260 ml) - d-mag\r'),
('C51041', 'envase blanco ( 500 ml) - (20981 - 20982 - 21101 - 21102) - renato garces\r'),
('C51045', 'envase blanco ( 400 ml) - (21176) - renato garces\r'),
('C51053', 'envase eliptico perlado (1000 ml) - (20799 - 20811 - 20873 - 20875 - 20957 - 21326 - 20881) - paradi'),
('C51062', 'envase traslucido (250 ml) - (20788 - 20810 - 20872 - 20874 - 20958 - 21325 - 20880) - paradise\r'),
('C51071', 'envase blanco (60 ml) - (20988) paradise\r'),
('C51075', 'envase aluminio (150 ml) - (21006) - paradise\r'),
('C51077', 'envase tipo ron - pvc (500 ml) - (21260 - 21261 -21263 - 21264) inmaculada\r'),
('C51078', 'envase airless blanco con bomba y sobre tapa - (50 ml) - (21265) inmaculada\r'),
('C51080', 'envase aluminio 24/410 - (130 ml) - (21266) inmaculada\r'),
('C51089', 'envase translucido (500 ml) - (21232 - 21234) - lina alvarez\r'),
('C51090', 'envase translucido (250 ml) - (21233,21327,21328) - lina alvarez\r'),
('C51091', 'envase translucido (60 ml) - (21235) - lina alvarez\r'),
('C51109', 'envase blanco con gotero y tapa (35 ml) - (20205) - lemonier\r'),
('C51111', 'envase transl?cido (140 ml) - (20205) - lemonier\r'),
('C51115', 'envase redondo translucido tulip (250 ml) - (20804, 20826, 20828, 20830, 20803, 20825, 20827, 20829)'),
('C51121', 'envase redondo translucidotulip (45 ml) - (20685, 20867, 20868, 20871, 20864, 20866, 20869, 20870) -'),
('C51127', 'envase redondo translucido (120 ml) - (20931, 20932, 20933, 20934, 20927, 20928, 20929, 20930) - tul'),
('C51146', 'envase de vidrio aceite tulip (30 ml) - (21312) - tulip\r'),
('C51150', 'envase circular con etiqueta crema corporal antiedad -idunn (210 ml) - (20655) - idunn\r'),
('C51152', 'envase circular con etiqueta serum regenrador -idunn (60ml) - (20653) - idunn\r'),
('C51155', 'envase con etiqueta crema aclarante - idunn (60 ml) - (20654) - idunn\r'),
('C51162', 'envase redonde estimulador - (10 ml) - (21159) - the blis\r'),
('C51166', 'envase circular transl?cido (290 ml) - (21278 - 21279 - 21280) - larimar\r'),
('C51171', 'envase unity blanco (400 ml) - (20619 - 20620 - 20621 - 20626 - 20627 - 20628 - 20766 - 20767 - 2076'),
('C51194', 'envase transl?cido (30 ml) - (20783) - karicia\r'),
('C51197', 'envase marula (260 ml) - (21242) - karicia\r'),
('C51200', 'envase transl?cido cuadrado (500 ml) - (20349 - 20938 - 21164) - milagros\r'),
('C51207', 'envase plano transl?cido (300 ml) - (20715) - milagros\r'),
('C51210', 'envase circular blanco milagros (300 ml) - (20919) - milagros\r'),
('C51219', 'envase largo transl?cido (150 ml) - (21295 - 21296) - milagros\r'),
('C51236', 'envase perlado (450 ml) - 21274, 21275 - ada\r'),
('C51240', 'envase negro - 21308, 21309 - celestial\r'),
('C51244', 'envase de vidrio (30 ml) - 21310, 21311 - celestial\r'),
('C51250', 'envase blanco (120 ml) - 21339 - renato garces\r'),
('C51253', 'envase blanco (250 ml) - 21340 - renato garces\r'),
('C51256', 'envase con textos exfoliante rostro (200 ml) - (21345) - idunn\r'),
('C51258', 'envase con textos exfoliante cuerpo (300 ml) - (21346) - idunn\r'),
('C51260', 'envase rosado con textos mascarilla (60 ml) - (21347, 21348 ) - idunn\r'),
('C51263', 'envase con textos maquillaje (220 ml) - (21349, 21350) - idunn\r'),
('C51271', 'envase transl?cido (250 ml) - 21299 - sandra casta?o\r'),
('C51283', 'envase circular con etiqueta rose in serum vibes (35 ml) - (21140) - vibes\r'),
('C51285', 'envase de vidrio con etiqueta kush vives (30 ml) - (21207) - vibes\r'),
('C51287', 'envase circular con etiqueta rose in cleanser (250 ml) - (21257) - vibes\r'),
('C51290', 'envase transl?cido con etiqueta rose in a santinizer vibes (90 ml) - (21273) - vibes\r'),
('C51292', 'envase caf? serum con textos vibes (250 ml) - (21342) - vibes\r'),
('C51295', 'envase caf? shower con textos vibes (250 ml) - (21343) - vibes\r'),
('C51297', 'envase caf? cream con textos vibes (280 ml) - (21344) - vibes\r'),
('C51300', 'envase circular traslucido hair vibes shampoo (250 ml) - (21027) - vibes\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escherichia`
--

CREATE TABLE `escherichia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `escherichia`
--

INSERT INTO `escherichia` (`id`, `nombre`) VALUES
(1, 'AUSENCIA EN 1G O ML'),
(2, 'NO APLICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE `etiqueta` (
  `id` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `etiqueta`
--

INSERT INTO `etiqueta` (`id`, `nombre`) VALUES
('50050', 'etiqueta - 20083 - tratamiento capilar hidrataci?n bioesplendor - mawie (450 ml)\r'),
('50052', 'etiqueta - 20060 - calendula gel calengel - mawie (60 gr)\r'),
('50058', 'etiqueta - 20887 - (incluye contracara) gel reductor caliente - mawie (120 ml)\r'),
('50064', 'etiqueta - 20056 - gel antibacterial - mawie (500 ml)\r'),
('50066', 'etiqueta - 20088 - tratamiento acondicionador nutrici?n - mawie (450 ml)\r'),
('50068', 'etiqueta - 20044 - (incluye cara y contracara) crema para peinar hidroprotein - mawie (300 ml)\r'),
('50071', 'etiqueta - 20113 - tratamiento capilar keratina - mawie (450 ml)\r'),
('50072', 'etiqueta - 20006 - laca extrafuerte - mawie (120 ml)\r'),
('50074', 'etiqueta - 22169 - locion spray control caspa - lorhan (150 ml)\r'),
('50079', 'etiqueta - 20879 - (incluye contracara) - shampoo reparacion total 8 en 1 - mawie (80 ml)\r'),
('50080', 'etiqueta - 20096 - (incluye contracara) - tratamiento capilar repolarizador - mawie (80 ml)\r'),
('50081', 'etiqueta - 20781-1 - te capilar anticaida - isabely (120 ml) - usa\r'),
('50082', 'etiqueta - 20020 - (incluye contracara) - shampoo nutricion - mawie (80 ml)\r'),
('50088', 'etiqueta - 20086 - tratamiento capilar embrion de pato - mawie (450 ml)\r'),
('50089', 'etiqueta - 20052 - filtro pantalla solar gel - mawie (60 ml)\r'),
('50108', 'etiqueta - 20054 - gel antibacterial - mawie (1000 ml)\r'),
('50109', 'etiqueta - 20141 - gel antibacterial - mawie (30 gr)\r'),
('50110', 'etiqueta - 20093 - tratamiento acondicionador reparacion total 8 en 1 - mawie (80 ml)\r'),
('50111', 'etiqueta - 20004 - jabon liquido antibacterial - mawie (500\r'),
('50112', 'etiqueta - 20068 - gel extra fuerte - mawie (500 ml)\r'),
('50114', 'etiqueta - 20018 - (incluye contracara) shampoo nutricion - mawie (450 ml)\r'),
('50115', 'etiqueta - 20107 - tratamiento capilar repolarizador capilar - mawie (450 ml)\r'),
('50234', 'etiqueta - 20050 - crema corporal - mawie (1000 gr)\r'),
('50250', 'etiqueta - 20174 - (incluye contracara) tratamiento acondicionador reparacion total 8 en 1 (450 ml)\r'),
('50254', 'etiqueta - 20150 - shampoo control caspa con exfoliante - lorhan (450 ml)\r'),
('50257', 'etiqueta - 20148 - shampoo proteccion color - lorhan (450 ml)\r'),
('50277', 'etiqueta - 20051 - crema para manos y cuerpo - mawie (500ml)\r'),
('50285', 'etiqueta - 20210 - (incluye cara y contracara) filtro pantalla solar - lorhan (120 ml) spf30+\r'),
('50286', 'etiqueta - 20233 - kit antivolumen - lorhan (120 ml) - paso 2\r'),
('50287', 'etiqueta - 20233 - (incluye contracara) kit antivolumen - lorhan (60 ml) - paso 3\r'),
('50295', 'etiqueta - 20147 - tratamiento capilar ultrareparador - lorhan (450 ml)\r'),
('50313', 'etiqueta - 20268 - (incluye contracara) shampoo romero y quina - isabely (450 ml)\r'),
('50314', 'etiqueta - 20269 - (incluye contracara) tratamiento romero y quina - isabely (450 ml)\r'),
('50342', 'etiqueta - 20319 - (incluye contracara) shampoo reparacion total 8 en 1 - mawie (450 ml)\r'),
('50379', 'etiqueta - 20386 - cocktail capilar - isabely (10 ml)\r'),
('50409', 'etiqueta - 20550 - (incluye contracara) shampoo keratina - mawie (450 ml)\r'),
('50410', 'etiqueta - 20551 - (incluye contracara) shampoo hidratacion - mawie (450 ml)\r'),
('50416', 'etiqueta adhesiva shampoo leche (10 ml) - muestra comercial\r'),
('50417', 'etiqueta adhesiva tratamiento capilar mayonesa (16 ml) - muestra comercial\r'),
('50418', 'etiqueta - 20887-1 gel reductor hot - mawie (240 ml) - usa\r'),
('50419', 'etiqueta - 20886-1 gel reductor cold - mawie (240 ml) - usa\r'),
('50427', 'etiqueta - 20922 - (incluye tapa) chocolate gourmet - mawie (500 ml)\r'),
('50428', 'etiqueta muestra chocolate gourmet - mawie (16 ml)\r'),
('50429', 'etiqueta muestra cerveza gourmet - mawie (10 ml)\r'),
('50430', 'etiqueta muestra margarina gourmet - mawie (16 ml)\r'),
('50435', 'etiqueta - 20924 - (incluye etq cuello) shampoo cerveza gourmet - mawie (260 ml)\r'),
('50436', 'etiqueta - 20781 - te capilar anticaida - isabely (120 ml)\r'),
('50437', 'etiqueta - 20722 - kit antivolumen - lorhan (1.000 ml) - paso 1\r'),
('50438', 'etiqueta - 20722 - kit antivolumen - lorhan (1.000 ml) - paso 2\r'),
('50439', 'etiqueta - 20722 - kit antivolumen - lorhan (1.000 ml) - paso 3\r'),
('50440', 'etiqueta - 20233 - kit antivolumen - lorhan (60 ml) - paso 1\r'),
('50441', 'etiqueta - 20233 - kit antivolumen - lorhan (120 ml) - paso 2\r'),
('50442', 'etiqueta - 20233 - kit antivolumen - lorhan (60 ml) - paso 3\r'),
('50443', 'etiqueta - 20922 - tapa chocolate gourmet - mawie (500 ml)\r'),
('50444', 'etiqueta - 20925 - (incluye etiqueta tapa) tratamiento capilar margarina gourmet - mawie (500 ml)\r'),
('50445', 'etiqueta - 20925 - tapa margarina gourmet - mawie (450 ml)\r'),
('50446', 'etiqueta - 20887 - (incluye contracara) gel reductor caliente (240 ml)\r'),
('50447', 'etiqueta - 20886 - (incluye contracara) gel reductor frio - mawie (240 ml)\r'),
('50448', 'etiqueta - 20019-1 - (incluye cara y contra cara) shampoo nutrici?n - mawie (1.000 ml) - usa\r'),
('50449', 'etiqueta - 20564 - (incluye cara y contracara) shampoo kerat\r'),
('50450', 'etiqueta - 20144 mascarilla lisos -keratina - mawie (450 ml)\r'),
('50451', 'etiqueta - 20292 - (incluye cara y contracara) tratamiento k\r'),
('50452', 'etiqueta - 20043 - (incluye cara y contracara) crema para peinar hidroprotein - mawie (1.000 ml)\r'),
('50457', 'etiqueta - 20566 (incluye cara y contracara) shampoo 8 en 1 reparacion total - mawie (1.000 ml)\r'),
('50460', 'etiqueta - 20110 - (incluye cara y contracara) tratamiento acond nutricion gusano de seda - mawie (1'),
('50461', 'etiqueta - 20144 - mascarilla lisos - mawie (450 ml)\r'),
('50465', 'etiqueta - 20044 - crema para peinar hidroprotein - mawie (300 ml)\r'),
('50474', 'etiqueta - 20046-1 - sachet crema para peinar - mawie (80 ml) - usa\r'),
('50475', 'etiqueta - 20020-1 - sachet shampoo nutricion - mawie (80 ml) - usa\r'),
('50476', 'etiqueta - 20183-1 - sachet acondicionador keratina - mawie (80 ml) - usa\r'),
('50477', 'etiqueta - 20090-1 - sachet acondicionador nutricion - mawie (80 ml) - usa\r'),
('50478', 'etiqueta - 20093-1 - sachet acondicionador 8 en 1 - mawie (80 ml) - usa\r'),
('50479', 'etiqueta - 20879-1 - sachet shampoo 8 en 1 - mawie (80 ml) - usa\r'),
('50480', 'etiqueta - 20096-1 - sachet repolarizador 8 en 1 - mawie (80 ml) - usa\r'),
('50481', 'etiqueta - 20147-1 - tratamiento capilar ultrareparador - lorhan (450 ml) - usa\r'),
('50482', 'etiqueta - 20148-1 - shampoo proteccion color - lorhan (450 ml) - usa\r'),
('50483', 'etiqueta - 20149-1 - shampoo control grasa anti-residuos - lorhan (450 ml) - usa\r'),
('50484', 'etiqueta - 20150-1 - shampoo control caspa con exfoliante - lorhan (450 ml) - usa\r'),
('50486', 'etiqueta - 22169-1 - locion spray control caspa - lorhan (150 ml) - usa\r'),
('50487', 'etiqueta - 20094-1 - tratamiento capilar repolarizador - mawie (1.000 ml) - usa\r'),
('50488', 'etiqueta - 20566-1 - shampoo 8 en 1 reparacion total - mawie (1.000 ml) - usa\r'),
('50489', 'etiqueta - 20110-1 - tratamiento acondicionador nutrici?n gusano de seda - mawie (1.000 ml) - usa\r'),
('50490', 'etiqueta - 20019-1 - shampoo nutricion - mawie (1.000 ml) - usa\r'),
('50491', 'etiqueta - 20292-1 - tratamiento keratina - mawie (1.000 ml) - usa\r'),
('50492', 'etiqueta - 20564-1 - shampoo keratina - mawie (1.000 ml) - usa\r'),
('50493', 'etiqueta - 20565-1 - shampoo hidrataci?n - mawie (1000 ml) - usa\r'),
('50494', 'etiqueta - 20043-1 - crema para peinar - mawie (1000 ml) - usa\r'),
('50495', 'etiqueta - 20663-1 - tratamiento siempre joven - mawie (450 ml) - usa\r'),
('50496', 'etiqueta - 20662-1 - shampoo siempre joven - mawie (450 ml) - usa\r'),
('50497', 'etiqueta - 20664-1 - mascarilla nutritiva antiedad - mawie (450 ml) - usa\r'),
('50498', 'etiqueta - 20083-1 - tratamiento capilar hidrataci?n bioesplendor - mawie (450 ml) - usa\r'),
('50499', 'etiqueta - 20551-1 - shampoo hidrataci?n - mawie (450 ml) - usa\r'),
('50500', 'etiqueta - 20552-1 - tratamiento acondicionador hidrataci?n - mawie (450 ml) - usa\r'),
('50501', 'etiqueta - 20044-1 - crema para peinar hidroprotein - mawie (300 ml) - usa\r'),
('50502', 'etiqueta - 20113-1 - tratamiento capilar keratina lisos - mawie (450 ml) - usa\r'),
('50503', 'etiqueta - 20144-1 - mascarilla lisos - mawie (450 ml) - usa\r'),
('50504', 'etiqueta - 20550-1 - shampoo lisos - mawie (450 ml) - usa\r'),
('50505', 'etiqueta - 20018-1 - shampoo nutrici?n - mawie (450 ml) - usa\r'),
('50512', 'etiqueta - 20086-1 - tratamiento capilar embri?n de pato - mawie (450 ml) - usa\r'),
('50513', 'etiqueta - 20088-1 - tratamiento acondicionador nutrici?n gusano de seda - mawie (450 ml) - usa\r'),
('50514', 'etiqueta - 20107-1 - repolarizador capilar - mawie (450 ml) - mawie (450 ml) - usa\r'),
('50515', 'etiqueta - 20174-1 - tratamiento acondicionador reparaci?n total 8 en 1 (450 ml) - usa\r'),
('50516', 'etiqueta - 20319-1 - shampoo reparacion total 8 en 1 - mawie (450 ml) - usa\r'),
('50517', 'etiqueta - 20268-1 - shampoo romero y quina - isabely (450 ml) - usa\r'),
('50518', 'etiqueta - 20269-1 - tratamiento romero y quina - isabely (450 ml) - usa\r'),
('50519', 'etiqueta - 20639-1 - aceite de argan - isabely (60 ml) - usa\r'),
('50528', 'etiqueta - 20149 - shampoo control grasa anti-residuos - lorhan (450 ml)\r'),
('50575', 'etiqueta - 20019 - (incluye cara y contracara) shampoo nutricion - mawie (1000 ml)\r'),
('50577', 'etiqueta - 20566 - (incluye cara y contracara) shampoo 8 en 1 reparaci?n total - mawie (1000 ml)\r'),
('50578', 'etiqueta -20094 - tratamiento repolarizador mawie (1.000ml)\r'),
('50579', 'etiqueta - 20564 - shampoo lisos mawie x (1000ml)\r'),
('50580', 'etiqueta - 20292 - tratamiento keratina - mawie (1000 ml)\r'),
('50581', 'etiqueta - 20565 - shampoo hidrataci?n - mawie (1000 ml)\r'),
('50585', 'etiq.etiqueta tonico capilar lorhan x150 ml\r'),
('50586', 'etiqueta - 20088-1 - (incluye cara y contracara) acondicionador nutricion mawie - (450 ml) - usa\r'),
('50587', 'etiqueta - 20018-1 - (incluye cara y contracara) shampoo nutricion - mawie (450 ml) - usa\r'),
('50600', 'etiqueta - 20594 - (incluye cara y contracara) aceite bronceador - lorhan (200 ml)\r'),
('50601', 'etiqueta - 20593 - (incluye cara y contracara) crema bronceadora - lorhan (200 ml)\r'),
('50602', 'etiqueta - 20588 - (incluye cara y contracara) autobronceador - lorhan (200 ml)\r'),
('50610', 'etiqueta - xxxxx - gel antibacterial bolsa - mawie (1.000 ml)\r'),
('50623', 'etiqueta - 20639 - aceite de argan - isabely (60 ml)\r'),
('50634', 'etiqueta - 20662 - (incluye cara y contracara) shampoo nutritivo antiedad - mawie (450 ml)\r'),
('50635', 'etiqueta - 20663 - (incluye cara y contracara) tratamiento nutritivo siempre joven - mawie (450 ml)\r'),
('50636', 'etiqueta - 20664 - mascarilla capilar nutritiva siempre joven (450 ml)\r'),
('50646', 'etiqueta - 20050 - (incluye cara y contracara) crema para manos y cuerpo - mawie (1000 ml)\r'),
('50658', 'etiqueta - 20779-1 - tratamiento capilar proteccio?n color - lorhan (450 ml) - usa\r'),
('50659', 'etiqueta - 20113 - (incluye cara y contracara) tratamiento capilar keratina - mawie (450 ml)\r'),
('50661', 'etiqueta locion clariderm x 120 ml\r'),
('50666', 'etiqueta - 20779 - tratamiento capilar proteccion color - lorhan (450 ml)\r'),
('50671', 'etiqueta - 20780 - (incluye cara y contracara) shampoo men - mawie (450 ml)\r'),
('50683', 'etiqueta - 20883 - shampoo leche gourmet - mawie (430 ml)\r'),
('50684', 'etiqueta - 20882 - (incluye etiqueta tapa) mayonesa gourmet - mawie (500 ml)\r'),
('50685', 'etiqueta - 20086-1 (incluye cara y contracara) tratamiento nutricion - mawie (450 ml) - usa\r'),
('50688', 'etiqueta - 20550-1 shampoo lisos - mawie (450 ml) - usa\r'),
('50692', 'etiqueta - 20552 - tratamiento acondicionador hidrataci?n - mawie (450 ml)\r'),
('50699', 'etiqueta - 20882 - tapa mayonesa gourmet - mawie (500 ml)\r'),
('50718', 'etiqueta - 21007 - splash honestidad - mawie (250 ml)\r'),
('50719', 'etiqueta - 21008 - splash respeto - mawie (250 ml)\r'),
('50720', 'etiqueta - 21011 - splash perdon - mawie (250 ml)\r'),
('50721', 'etiqueta - 21012 - splash amor - mawie (250 ml)\r'),
('50722', 'etiqueta - 21009 - splash valentia - mawie (250 ml)\r'),
('50723', 'etiqueta - 21010 - splash tolerancia - mawie (250 ml)\r'),
('50727', 'etiqueta - 20970 (incluye cara y contra cara) shampoo isabely teens (450 ml)\r'),
('50731', 'etiqueta - 20974 - shampoo mawizena ni?o - mawie (500 ml)\r'),
('50733', 'etiqueta - 20922-1 - (incluye tapa) chocolate gourmet - mawie (450 ml) - usa\r'),
('50734', 'etiqueta - 20924-1 - (incluye etq cuello) shampoo cerveza gourmet - mawie (260 ml) - usa\r'),
('50735', 'etiqueta - 20883-1 - shampoo leche gourmet - mawie (430 ml) - usa\r'),
('50736', 'etiqueta - 20882-1 - (incluye etiqueta tapa) mayonesa gourmet - mawie (500 ml) - usa\r'),
('50737', 'etiqueta - 20925-1 - (incluye etiqueta tapa) margarina gourmet - mawie (500 ml) - usa\r'),
('50743', 'etiqueta - 21100 - (cara y contra cara) tratamiento isabely teens (450 ml)\r'),
('50744', 'etiqueta - 21109 - shampoo sin sulfatos - mawie (450 ml)\r'),
('50745', 'etiqueta - 20174 - tratamiento acondicionador reparacion total 8 en 1 (1000 ml)\r'),
('50747', 'etiqueta foil potes y margarina gourmet 160x114 mm\r'),
('50748', 'etiqueta (juego x 2) - 21081-1 kit sachet mawie x 15 und - usa\r'),
('50750', 'etiqueta - 20664-1 - mascarilla capilar nutritiva siempre joven (450 ml) - usa\r'),
('50751', 'etiqueta - 20110-1 - (incluye cara y contracara) tratamiento acond nutricion gusano de seda - mawie '),
('50752', 'etiqueta - 20550-1 - (incluye contracara) shampoo keratina - mawie (450 ml) - usa\r'),
('50759', 'etiqueta - 21182 - estimulador capilar - isabely (10 ml)\r'),
('50761', 'etiqueta - 20038 - (incluye tapa) cera moldeadora y fijadora - mawie (200 gr)\r'),
('50762', 'etiqueta - xxxx - (incluye tapa) cera moldeadora y fijadora vibrante - mawie (200 gr)\r'),
('50763', 'etiqueta - 20165 - jabon liquido antibacterial - mawie (1000 ml)\r'),
('50769', 'etiqueta - xxxxx - gel antibacterial bolsa - mawie (500 ml)\r'),
('50771', 'etiqueta - 20974 - shampoo mawizena ni?a - mawie (500 ml)\r'),
('50773', 'etiqueta - 21190 - gel antibacterial - mawie (garrafa x 5 litros)\r'),
('50774', 'etiqueta - 21187 - alcohol al 70% - mawie (500 ml)\r'),
('50775', 'etiqueta - 21186 - alcohol al 70% - mawie (1.000 ml)\r'),
('50776', 'etiqueta - 21185 - alcohol al 70% - mawie (3.785 ml)\r'),
('50777', 'etiqueta - 21196 - alcohol al 70% - sasha (1.000 ml)\r'),
('50778', 'etiqueta - 21196 - alcohol al 70% - sasha (500 ml)\r'),
('50779', 'etiqueta - 21199 - alcohol glicerinado - sasha (1.000 ml)\r'),
('50780', 'etiqueta - 21211 - alcohol glicerinado - mawie (1.000 ml)\r'),
('50781', 'etiqueta - 21212 - alcohol glicerinado - mawie (500 ml)\r'),
('50783', 'etiqueta - 21204 - gel antibacterial galon - sasha (4 litros)\r'),
('50784', 'etiqueta - 21205 - gel antibacterial - sasha (1000 ml)\r'),
('50785', 'etiqueta - 21206 - gel antibacterial bolsa - sasha (1000 ml)\r'),
('50786', 'etiqueta - 21201 - jabon antibacterial galon - sasha (4 litros)\r'),
('50787', 'etiqueta - 21202 - jabon antibacterial - sasha (1000 ml)\r'),
('50788', 'etiqueta - 21198 - alcohol glicerinado galon - sasha (4 litros)\r'),
('50789', 'etiqueta - 21195 - alcohol al 70% galon - sasha (4 litros)\r'),
('50790', 'etiqueta - xxxxx - gel antibacterial galon - sasha (20 litros)\r'),
('50791', 'etiqueta - xxxxx - jabon antibacterial galon - sasha (20 litros)\r'),
('50792', 'etiqueta - xxxxx - alcohol glicerinado galon - sasha (20 litros)\r'),
('50793', 'etiqueta - xxxxx - alcohol al 70% galon - sasha (20 litros)\r'),
('50799', 'etiqueta - 20004-1 - liquid hand soap - mawie (500 ml) - usa\r'),
('50800', 'etiqueta - 20165-1 - liquid hand soap - mawie (1000 ml) - usa\r'),
('50801', 'etiqueta - 21184-1 - liquid hand soap - mawie (3785 ml) - usa\r'),
('50802', 'etiqueta - 20054-1 - hand sanitizer anti-bacterial gel - mawie (1.000 ml) - usa\r'),
('50803', 'etiqueta - 20056-1 - hand sanitizer anti-bacterial gel - mawie (500 ml) - usa\r'),
('50804', 'etiqueta - 20141-1 - hand sanitizer anti-bacterial gel - mawie (30 ml) - usa\r'),
('50805', 'etiqueta - 21183-1 - hand sanitizer anti-bacterial gel - mawie (3785 ml) - usa\r'),
('50806', 'etiqueta - 21212-1 - ethyl alcohol with glycerin - mawie (500 ml) - usa\r'),
('50807', 'etiqueta - 21211-1 - ethyl alcohol with glycerin - mawie (1000 ml) - usa\r'),
('50819', 'etiqueta - 21182-1 - estimulador capilar - isabely (10 ml) - usa\r'),
('50834', 'etiqueta - 20953 (incluye contra cara) shampoo yogurt guayaba - coral (450 ml)\r'),
('50835', 'etiqueta - 20954 (incluye contra cara) tratamiento capilar fruta coral (450 ml)\r'),
('50838', 'etiqueta - xxx - (incluye contracara) shampoo tribel - mawie (450 ml)\r'),
('50839', 'etiqueta - xxxx - (incluye contracara) tratamiento tribel - mawie (450 ml)\r'),
('50840', 'etiqueta - 21239 - (incluye contracara) shampoo control grasa antiresiduos - mawie (450 ml)\r'),
('50841', 'etiqueta - 21240 - (incluye contracara) shampoo control caspa con exfoliante - mawie (450 ml)\r'),
('50842', 'etiqueta - xxxx - (incluye tapa) cera vibrante - mawie (120 ml)\r'),
('50843', 'etiqueta - 20054 - gel antibacterial - mawie (3785 ml)\r'),
('50844', 'etiqueta - xxxxx - jabon liquido antibacterial - mawie (galon)\r'),
('50851', 'etiqueta - 20970-1 (incluye cara y contra cara) shampoo isabely teens (450 ml) - usa\r'),
('50852', 'etiqueta - 21100-1 - (cara y contra cara) tratamiento isabely teens (450 ml) - usa\r'),
('50853', 'etiqueta - 21281 - (tonico capilar control caspa - mawie (150 ml)\r'),
('C10013', 'etiqueta (incluye contra cara) shampoo yogurt - guayaba (450 ml)\r'),
('C10014', 'etiqueta (incluye contra cara) tratamiento capilar fruta (450 ml)\r'),
('C51015', 'etiqueta - 21248 - (incluye cara y contracara) repolarizador dmag (260 ml) - d-mag\r'),
('C51016', 'etiqueta - 21249 - (incluye cara y contracara) repolarizador - d-mag (435 ml)\r'),
('C51017', 'etiqueta - 21251 - (incluye cara y contracara) repolarizador teen - d-mag (435 ml)\r'),
('C51018', 'etiqueta - 21250 - (incluye cara y contracara) repolarizador teen - d-mag (260 ml)\r'),
('C51019', 'etiqueta - 21252 - (incluye cara y contracara) tratamiento super bomba - d-mag (260 ml)\r'),
('C51020', 'etiqueta - 21253 - (incluye cara y contracara) tratamiento super bomba - d-mag (435 ml)\r'),
('C51021', 'etiqueta - 21323 - (incluye cara y contracara) shampoo binomio - d-mag (435 ml)\r'),
('C51022', 'etiqueta - 21324 - (incluye cara y contracara) repolarizador men - d-mag (435 ml)\r'),
('C51023', 'etiqueta - 21300 - (incluye cara y contracara) shampoo teen - d-mag (260 ml)\r'),
('C51024', 'etiqueta - 21256 - (incluye cara y contracara) shampoo teen - d-mag (435 ml)\r'),
('C51025', 'etiqueta - 21255 - (incluye cara y contracara) shampoo prevenci?n ca?da - d-mag (435 ml)\r'),
('C51026', 'etiqueta - 21254 - (incluye cara y contracara) shampoo prevenci?n ca?da - d-mag (260 ml)\r'),
('C51027', 'etiqueta - 21319 - (incluye cara y contracara) spa capilar - d-mag (435 ml)\r'),
('C51028', 'etiqueta - 21259 - (incluye cara y contracara) shampoo super bomba - d-mag (435 ml)\r'),
('C51029', 'etiqueta - 21301 - (incluye cara y contracara) shampoo men - d-mag (260 ml)\r'),
('C51030', 'etiqueta - 21303 - (incluye cara y contracara) shampoo men - d-mag (435 ml)\r'),
('C51031', 'etiqueta - 21302 - (incluye cara y contracara) shampoo celulas madre - d-mag (435 ml)\r'),
('C51032', 'etiqueta - 21320 - (incluye cara y contracara) suero de renacimiento - d-mag (260 ml)\r'),
('C51033', 'etiqueta - 21307 - (incluye cara y contracara) tratamiento matizante cenizo - d-mag (260 ml)\r'),
('C51048', 'etiqueta - 21176 - (cara y contracara) - crema para peinar (400 ml) - renato garces\r'),
('C51049', 'etiqueta - 21102 - (cara y contracara) - shampoo hidratacion (500 ml) - renato garces\r'),
('C51050', 'etiqueta - 21101 - (cara y contracara) - shampoo lisos (500 ml) - renato garces\r'),
('C51051', 'etiqueta - 20982 - (cara y contracara) - tratamiento crecimiento capilar (500 ml) - renato garces\r'),
('C51052', 'etiqueta - 20981 - (cara y contracara) - shampoo crecimiento (500 ml) - renato garces\r'),
('C51055', 'etiqueta - 20799 - (incluye cara y contracara) tratamiento capilar tormenta - (1000 ml) - paradise\r'),
('C51056', 'etiqueta - 20811 - (incluye cara y contracara) tratamiento capilar encanto (1000 ml) - paradise\r'),
('C51057', 'etiqueta - 20873 - (incluye cara y contracara) tratamiento capilar tornasol (1000 ml) - paradise\r'),
('C51058', 'etiqueta - 20875 - (incluye cara y contracara) tratamiento capilar embrujo (1000 ml) - paradise\r'),
('C51059', 'etiqueta - 20957 - (incluye cara y contracara) tratamiento capilar seducci?n (1000 ml) - paradise\r'),
('C51060', 'etiqueta - 21326 - (incluye cara y contracara) tratamiento capilar hechizo (1000 ml) - paradise\r'),
('C51061', 'etiqueta - 20881 - (incluye cara y contracara) leche para el cabello (1000 ml) - paradise\r'),
('C51064', 'etiqueta - 20788 - (incluye cara y contracara) tratamiento capilar tormenta (250 ml) - paradise\r'),
('C51065', 'etiqueta - 20810 - (incluye cara y contracara) tratamiento capilar encanto (250 ml) - paradise\r'),
('C51066', 'etiqueta - 20872 - (incluye cara y contracara) tratamiento capilar tornasol (250 ml) - paradise\r'),
('C51067', 'etiqueta - 20874 - (incluye cara y contracara) tratamiento capilar embrujo (250 ml) - paradise\r'),
('C51068', 'etiqueta - 20958 - (incluye cara y contracara) tratamiento capilar seducci?n (250 ml) - paradise\r'),
('C51069', 'etiqueta - 21326 - (incluye cara y contracara) tratamiento capilar hechizo (250 ml) - paradise\r'),
('C51070', 'etiqueta - 20880 - (incluye cara y contracara) leche para el cabello (250 ml) - paradise\r'),
('C51074', 'etiqueta - 20988 - suero facial (60 ml) - paradise\r'),
('C51082', 'etiqueta - 21265 - aceite de argan oleo divino (50 ml) - inmaculada\r'),
('C51083', 'etiqueta - 21261 - shampoo yogourt (500 ml) - inmaculada\r'),
('C51084', 'etiqueta - 21260 - tratamiento capilar mix tropical (500 ml) - inmaculada\r'),
('C51085', 'etiqueta - 21266 - tonico energizante (120 ml) - inmaculada\r'),
('C51092', 'etiqueta shampoo (500 ml) - (21232 ) - lina alvarez\r'),
('C51093', 'etiqueta tratamiento capilar (500 ml) - (21234) - lina alvarez\r'),
('C51094', 'etiqueta shampoo (250 ml) - (21327) - lina alvarez\r'),
('C51095', 'etiqueta tratamiento capilar (250 ml) - (21328) - lina alvarez\r'),
('C51096', 'etiqueta elixir (60 ml) - (21235) - lina alvarez\r'),
('C51097', 'etiqueta gel rizos (250 ml) - (21233) - lina alvarez\r'),
('C51104', 'etiqueta crema casta?o de indias x 250 ml lemonier - (20241) - lemonier\r'),
('C51107', 'etiqueta gel casta?o de indias (250 ml) - (20151) - lemonier\r'),
('C51110', 'etiqueta piesano (35 ml) - (20205) - lemonier\r'),
('C51113', 'etiqueta y sello kitokys (140 ml) - (20205) - lemonier\r'),
('C51117', 'etiqueta crema hidratante euforia floral tulip (250 ml) - (20804) - tulip\r'),
('C51118', 'etiqueta crema hidratante verbena vital tulip (250 ml) - (20826) - tulip\r'),
('C51119', 'etiqueta crema hidratante bergamota eterea tulip (250 ml) - (20828) - tulip\r'),
('C51120', 'etiqueta crema hidratante violetas serenas tulip (250 ml) - (20830) - tulip\r'),
('C51123', 'etiqueta crema hidratante euforia floral tulip (45 ml) - (20865) - tulip\r'),
('C51124', 'etiqueta crema hidratante verbena vital tulip (45 ml) - (20867) - tulip\r'),
('C51125', 'etiqueta crema hidratante bergamota eterea tulip (45 ml) - (20868) - tulip\r'),
('C51126', 'etiqueta crema hidratante violetas serenas tulip (45 ml) - (20871) - tulip\r'),
('C51128', 'etiqueta crema hidratante violetas serenas tulip (120 ml) - (20931) - tulip\r'),
('C51129', 'etiqueta crema hidratante euforia floral tulip (120 ml) - (20932) - tulip\r'),
('C51130', 'etiqueta crema hidratante verbena vital (120 ml) - (20933) - tulip\r'),
('C51131', 'etiqueta crema hidratante bergamota eterea (120 ml) - (20934) - tulip\r'),
('C51133', 'etiqueta jab?n liquido euforia floral (250 ml) - (20803) - tulip\r'),
('C51134', 'etiqueta jab?n liquido verbena vital (250 ml) - (20825) - tulip\r'),
('C51135', 'etiqueta jab?n liquido bergamota eterea (250 ml) - (20827) - tulip\r'),
('C51136', 'etiqueta jab?n liquido violetas serenas (250 ml) - (20829) - tulip\r'),
('C51138', 'etiqueta jab?n liquido euforia floral (45 ml) - (20864) - tulip\r'),
('C51139', 'etiqueta jab?n liquido verbena vital (45 ml) - (20866) - tulip\r'),
('C51140', 'etiqueta jab?n liquido bergamota eterea (45 ml) - (20869) - tulip\r'),
('C51141', 'etiqueta jab?n liquido violetas serenas (45 ml) - (20870) - tulip\r'),
('C51142', 'etiqueta jab?n liquido violetas serenas (120 ml) - (20927) - tulip\r'),
('C51143', 'etiqueta jab?n liquido euforia floral (120 ml) - (20928) - tulip\r'),
('C51144', 'etiqueta jab?n liquido verbena vital (120 ml) - (20929) - tulip\r'),
('C51145', 'etiqueta jab?n liquido bergamota eterea (120 ml) - (20930) - tulip\r'),
('C51148', 'etiqueta beauty oil tulip (30 ml) - (21312) - tulip\r'),
('C51150', 'envase circular con etiqueta crema corporal antiedad -idunn (210 ml) - (20655) - idunn\r'),
('C51152', 'envase circular con etiqueta serum regenrador -idunn (60ml) - (20653) - idunn\r'),
('C51155', 'envase con etiqueta crema aclarante - idunn (60 ml) - (20654) - idunn\r'),
('C51158', 'colapsible con etiqueta crema intidunn (60 ml) - (20709) - idunn\r'),
('C51160', 'colapsible con etiqueta lipocorp - idunn 200 ml - (20670) - idunn\r'),
('C51164', 'etiqueta estimulador cailar (10 ml) - (21159) - the blis\r'),
('C51177', 'etiqueta delantera y trasera shampoo jengibre (400 ml) - (20619) - karicia\r'),
('C51178', 'etiqueta delantera y trasera tratamiento jengibre (400 ml) - (20620) - karicia\r'),
('C51179', 'etiqueta delantera y trasera shampoo mango uva (400 ml) - (20621) - karicia\r'),
('C51180', 'etiqueta delantera y trasera tratamiento mango uva (400 ml) - (20627) - karicia\r'),
('C51181', 'etiqueta delantera y trasera shampoo rosas y limon (400 ml) - (20626) - karicia\r'),
('C51182', 'etiqueta delantera y trasera tratamiento rosas y limon (400 ml) - (20628) - karicia\r'),
('C51183', 'etiqueta delantera y trasera shampoo moringa (400 ml) - (20766) - karicia\r'),
('C51184', 'etiqueta delantera y trasera tratamiento moringa (400 ml) - (20767) - karicia\r'),
('C51185', 'etiqueta delantera y trasera shampoo minoxidil hombre (400 ml) - (20768) - karicia\r'),
('C51186', 'etiqueta delantera y trasera shampoo minoxidil dama (400 ml) - (20945) - karicia\r'),
('C51187', 'etiqueta delantera y trasera tratamiento minoxidil dama (400 ml) - (20946) - karicia\r'),
('C51191', 'etiqueta t?nico minoxidil hombre (30 ml) - (20888) - karicia\r'),
('C51192', 'etiqueta aceite bergamota (30 ml) - (20965) - karicia\r'),
('C51193', 'etiqueta t?nico minoxidil dama (30 ml) - (21026) - karicia\r'),
('C51196', 'etiqueta aceite moringa (30 ml) - (20783) - karicia\r'),
('C51199', 'etiqueta marula (30 ml) - (21242) - karicia\r'),
('C51202', 'etiqueta tratamiento de frutas (500 ml) - (20349) - milagros\r'),
('C51205', 'etiqueta shampoo emergencia (500 ml) - (20938) - milagros\r'),
('C51206', 'etiqueta tratamiento emergencia (500 ml) - (21164) - milagros\r'),
('C51209', 'etiqueta delantera y trasera champu kid (300 ml) - (20715) - milagros\r'),
('C51212', 'etiquetatermo regenerador aceite (250 ml) - (20919) - milagros\r'),
('C51221', 'etiqueta gel antibacterial (150 ml) - (21295) - milagros\r'),
('C51223', 'etiqueta alcohol (150 ml) - (21296) - milagros\r'),
('C51238', 'etiqueta shampoo (450 ml) - 21274 - ada\r'),
('C51239', 'etiqueta acondicionador (450 ml) - 21275 - ada\r'),
('C51242', 'etiqueta delantera y trasera shampoo dama (375 ml) - 21308 - celestial\r'),
('C51243', 'etiqueta delantera y trasera shampoo hombre (375 ml) - 21309 - celestial\r'),
('C51246', 'etiqueta tonico capilar hombre (30 ml) - 21310 - celestial\r'),
('C51247', 'etiqueta tonico capilar dama (30 ml) - 21311 - celestial\r'),
('C51252', 'etiqueta delantera y trasera aceite de coco (120 ml) - 21339 - renato garces\r'),
('C51255', 'etiqueta delantera y trasera aceite de coco (250 ml) - 21340 - renato garces\r'),
('C51266', 'etiqueta gotero(10 ml) - (20939, 20940, 20944, 20968) - milagros\r'),
('C51267', 'etiqueta gotero (60 ml) - (21070) - milagros\r'),
('C51270', 'etiqueta delantera y trasera tratamiento repolarizador (260 ml) - 21298 - sandra casta?o\r'),
('C51273', 'etiqueta delantera y trasera agua de rosas (250 ml) - 21299 - sandra casta?o\r'),
('C51276', 'etiqueta hair vibes tratamiento 250 ml - (21027) - vibes\r'),
('C51280', 'etiqueta hair vibes shampoo 250 ml - (21027) - vibes\r'),
('C51281', 'colapsible blanco con etiqueta filtro pantalla vibes (60 ml) - (21098) - vibes\r'),
('C51283', 'envase circular con etiqueta rose in serum vibes (35 ml) - (21140) - vibes\r'),
('C51285', 'envase de vidrio con etiqueta kush vives (30 ml) - (21207) - vibes\r'),
('C51287', 'envase circular con etiqueta rose in cleanser (250 ml) - (21257) - vibes\r'),
('C51288', 'colpasible azul con etiqueta eye and lip vibes (17 gr) - (21258) - vibes\r'),
('C51290', 'envase transl?cido con etiqueta rose in a santinizer vibes (90 ml) - (21273) - vibes\r'),
('C51294', 'etiqueta serum vibes (250 ml) - (21342) - vibes\r'),
('C51296', 'etiqueta shower vibes (250 ml) - (21343) - vibes\r'),
('C51299', 'etiqueta cream vibes (280 ml) - (21344) - vibes\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `firma`
--

CREATE TABLE `firma` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_primerfirma` int(11) NOT NULL,
  `id_segundafirma` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formula`
--

CREATE TABLE `formula` (
  `id` int(11) NOT NULL,
  `id_producto` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `id_materiaprima` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `porcentaje` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `formula`
--

INSERT INTO `formula` (`id`, `id_producto`, `id_materiaprima`, `porcentaje`) VALUES
(1, '20086', '40354', 0),
(2, '20086', '10639', 0),
(3, '20086', '40398', 0),
(4, '20086', '40230', 0),
(5, '20086', '40277', 0),
(6, '20086', '40101', 0),
(7, '20086', '40312', 0),
(8, '20086', '40235', 0),
(9, '20086', '40073', 5),
(11, '20174', '40354', 0),
(12, '20174', '10639', 0),
(13, '20174', '40398', 0),
(14, '20174', '40230', 0.02),
(15, '20174', '40277', 0),
(16, '20174', '40000', 0),
(17, '20174', '40408', 0),
(18, '20174', '40442', 0),
(19, '20174', '40436', 0),
(20, '20174', '40167', 0),
(21, '20174', '40073', 0),
(22, '20174', '40275', 0),
(23, '20174', '40366', 0),
(24, '20174', '40171', 0),
(25, '20174', '40057', 0),
(26, '20174', '40417', 0),
(27, '20091', '40354', 0),
(28, '20091', '10639', 0),
(29, '20091', '40398', 0),
(30, '20091', '40230', 0),
(31, '20091', '40277', 0),
(32, '20091', '40000', 0),
(33, '20091', '40408', 0),
(34, '20091', '40442', 0),
(35, '20091', '40436', 0),
(36, '20091', '40167', 0),
(37, '20091', '40073', 0),
(38, '20091', '40275', 0),
(39, '20091', '40366', 0),
(40, '20091', '40171', 0),
(41, '20091', '40057', 0),
(42, '20091', '40417', 0),
(43, '21110', '40398', 0),
(44, '21110', '40354', 0),
(45, '21110', '10639', 0),
(46, '21110', '40230', 0),
(47, '21110', '40277', 0),
(48, '21110', '40000', 0),
(49, '21110', '40073', 0),
(50, '21110', '40080', 0),
(51, '21110', '40057', 0),
(52, '21110', '40366', 0),
(53, '21110', '40436', 0),
(54, '21110', '40032', 0),
(55, '21110', '40054', 0),
(56, '21110', '40013', 0),
(57, '21110', '40108', 0),
(58, '20269', '40398', 0),
(59, '20269', '40354', 0),
(60, '20269', '40230', 0),
(61, '20269', '40277', 0),
(62, '20269', '40000', 0),
(63, '20269', '40337', 0),
(64, '20269', '40299', 0),
(65, '20269', '40167', 0),
(66, '20269', '40073', 0),
(67, '20269', '40080', 0),
(68, '20269', '40057', 0),
(69, '20269', '40366', 0),
(70, '20269', '40436', 0),
(71, '20269', '40032', 0),
(72, '20269', '40349', 0),
(73, '20043', '40354', 0),
(74, '20043', '10639', 0),
(75, '20043', '40398', 0),
(76, '20043', '40230', 0),
(77, '20043', '40277', 0),
(78, '20043', '40000', 0),
(79, '20043', '40408', 0),
(80, '20043', '40442', 0),
(81, '20043', '40436', 0),
(82, '20043', '40073', 0),
(83, '20043', '40366', 0),
(84, '20043', '40068', 0),
(85, '20043', '40057', 0),
(86, '21164', '40354', 0),
(87, '21164', '10639', 0),
(88, '21164', '40398', 0),
(89, '21164', '40230', 0),
(90, '21164', '40277', 0),
(91, '21164', '10652', 0),
(92, '21164', '40000', 0),
(93, '21164', '40436', 0),
(94, '21164', '40073', 0),
(95, '21164', '40316', 0),
(96, '21164', '40209', 0),
(97, '21164', '49000', 0),
(98, '21164', '40325', 0),
(99, '21164', '40312', 0),
(100, '21164', '40336', 0),
(101, '21164', '40034', 0),
(102, '20349', '40354', 0),
(103, '20349', '10639', 0),
(104, '20349', '40398', 0),
(105, '20349', '40230', 0),
(106, '20349', '40277', 0),
(107, '20349', '40101', 0),
(108, '20349', '40312', 0),
(109, '20349', '40235', 0),
(110, '20349', '40073', 5),
(112, '20938', '40000', 0),
(113, '20938', '40308', 0),
(114, '20938', '40230', 0),
(115, '20938', '40129', 0),
(116, '20938', '40096', 0),
(117, '20938', '40404', 0),
(118, '20938', '40345', 0),
(119, '20938', '40418', 0),
(120, '20938', '40322', 0),
(121, '20938', '40253', 0),
(122, '20938', '40316', 0),
(123, '20938', '40442', 0),
(124, '20938', '10383', 0),
(125, '20938', '40209', 0),
(126, '20938', '40034', 0),
(127, '20044', '40354', 0),
(128, '20044', '10639', 0),
(129, '20044', '40398', 0),
(130, '20044', '40230', 0),
(131, '20044', '40277', 0),
(132, '20044', '40000', 0),
(133, '20044', '40408', 0),
(134, '20044', '40442', 0),
(135, '20044', '40436', 0),
(136, '20044', '40073', 0),
(137, '20044', '40366', 0),
(138, '20044', '40068', 0),
(139, '20044', '40057', 0),
(140, '20043', '40354', 0),
(141, '20043', '10639', 0),
(142, '20043', '40398', 0),
(143, '20043', '40230', 0),
(144, '20043', '40277', 0),
(145, '20043', '40000', 0),
(146, '20043', '40408', 0),
(147, '20043', '40442', 0),
(148, '20043', '40436', 0),
(149, '20043', '40073', 0),
(150, '20043', '40366', 0),
(151, '20043', '40068', 0),
(152, '20043', '40057', 0),
(153, '20879', '40000', 0),
(154, '20879', '40230', 0),
(155, '20879', '40316', 0),
(156, '20879', '40308', 0),
(157, '20879', '40129', 0),
(158, '20879', '40096', 0),
(159, '20879', '40404', 0),
(160, '20879', '40345', 0),
(161, '20879', '40418', 0),
(162, '20879', '40256', 0),
(163, '20879', '40057', 0),
(164, '20879', '40171', 0),
(165, '20879', '40279', 0),
(166, '20879', '40209', 0),
(167, '20879', '40253', 0),
(168, '20879', '40082', 0),
(169, '20879', '10633', 0),
(170, '20879-1', '40000', 0),
(171, '20879-1', '40230', 0),
(172, '20879-1', '40316', 0),
(173, '20879-1', '40308', 0),
(174, '20879-1', '40129', 0),
(175, '20879-1', '40096', 0),
(176, '20879-1', '40404', 0),
(177, '20879-1', '40345', 0),
(178, '20879-1', '40418', 0),
(179, '20879-1', '40256', 0),
(180, '20879-1', '40057', 0),
(181, '20879-1', '40171', 0),
(182, '20879-1', '40279', 0),
(183, '20879-1', '40209', 0),
(184, '20879-1', '40253', 0),
(185, '20879-1', '40082', 0),
(186, '20879-1', '10633', 0),
(187, '20319', '40000', 0),
(188, '20319', '40230', 0),
(189, '20319', '40316', 0),
(190, '20319', '40308', 0),
(191, '20319', '40129', 0),
(192, '20319', '40096', 0),
(193, '20319', '40404', 0),
(194, '20319', '40345', 0),
(195, '20319', '40418', 0),
(196, '20319', '40256', 0),
(197, '20319', '40057', 0),
(198, '20319', '40171', 0),
(199, '20319', '40279', 0),
(200, '20319', '40209', 0),
(201, '20319', '40253', 0),
(202, '20319', '40082', 0),
(203, '20319', '10633', 0),
(204, '20319-1', '40000', 0),
(205, '20319-1', '40230', 0),
(206, '20319-1', '40316', 0),
(207, '20319-1', '40308', 0),
(208, '20319-1', '40129', 0),
(209, '20319-1', '40096', 0),
(210, '20319-1', '40404', 0),
(211, '20319-1', '40345', 0),
(212, '20319-1', '40418', 0),
(213, '20319-1', '40256', 0),
(214, '20319-1', '40057', 0),
(215, '20319-1', '40171', 0),
(216, '20319-1', '40279', 0),
(217, '20319-1', '40209', 0),
(218, '20319-1', '40253', 0),
(219, '20319-1', '40082', 0),
(220, '20319-1', '10633', 0),
(221, '20566', '40000', 0),
(222, '20566', '40230', 0),
(223, '20566', '40316', 0),
(224, '20566', '40308', 0),
(225, '20566', '40129', 0),
(226, '20566', '40096', 0),
(227, '20566', '40404', 0),
(228, '20566', '40345', 0),
(229, '20566', '40418', 0),
(230, '20566', '40256', 0),
(231, '20566', '40057', 0),
(232, '20566', '40171', 0),
(233, '20566', '40279', 0),
(234, '20566', '40209', 0),
(235, '20566', '40253', 0),
(236, '20566', '40082', 0),
(237, '20566', '10633', 0),
(238, '20566-1', '40000', 0),
(239, '20566-1', '40230', 0),
(240, '20566-1', '40316', 0),
(241, '20566-1', '40308', 0),
(242, '20566-1', '40129', 0),
(243, '20566-1', '40096', 0),
(244, '20566-1', '40404', 0),
(245, '20566-1', '40345', 0),
(246, '20566-1', '40418', 0),
(247, '20566-1', '40256', 0),
(248, '20566-1', '40057', 0),
(249, '20566-1', '40171', 0),
(250, '20566-1', '40279', 0),
(251, '20566-1', '40209', 0),
(252, '20566-1', '40253', 0),
(253, '20566-1', '40082', 0),
(254, '20566-1', '10633', 0),
(255, '21254', '40308', 0),
(256, '21254', '40230', 0),
(257, '21254', '40129', 0),
(258, '21254', '40096', 0),
(259, '21254', '40404', 0),
(260, '21254', '40345', 0),
(261, '21254', '40418', 0),
(262, '21254', '40316', 0),
(263, '21254', '40253', 0),
(264, '21254', '40000', 0),
(265, '21254', '40163', 0),
(266, '21254', '40101', 0),
(267, '21255', '40308', 0),
(268, '21255', '40230', 0),
(269, '21255', '40129', 0),
(270, '21255', '40096', 0),
(271, '21255', '40404', 0),
(272, '21255', '40345', 0),
(273, '21255', '40418', 0),
(274, '21255', '40316', 0),
(275, '21255', '40253', 0),
(276, '21255', '40000', 0),
(277, '21255', '40163', 0),
(278, '21255', '40101', 0),
(279, '20968', '40057', 5),
(280, '20086', '40034', 3),
(281, '20003', '40073', 5),
(282, '20003', '40108', 10),
(283, '20003', '40096', 0.3),
(285, '20019', '40073', 10),
(286, '20019', '40013', 5),
(287, '20019', '40034', 35),
(288, '', '40068', 0),
(289, '20003', '', 0),
(290, '20003', '40032', 0),
(291, '20003', '10383', 7),
(292, '20020', '10015', 5),
(293, '20020', '10023', 25),
(294, '20020', '10005', 70),
(295, '20019', '10017', 25),
(296, '20019', '10001', 50),
(297, '20019', '10025', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formula_f`
--

CREATE TABLE `formula_f` (
  `id` int(5) NOT NULL,
  `id_producto` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `id_materiaprima` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `porcentaje` float(3,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formula_maestra`
--

CREATE TABLE `formula_maestra` (
  `id` int(11) NOT NULL,
  `Actividad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `formula_maestra`
--

INSERT INTO `formula_maestra` (`id`, `Actividad`, `id_cargo`) VALUES
(1, 'Entrega de formula Maestra para solicitud de materia prima', 3),
(2, 'Lleva Materia prima a la escusa', 1),
(3, 'Verificacion del estado de Identificacion y Aprobacion Materias primas', 4),
(4, 'Toma de materia prima de la esclusa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado_alcohol`
--

CREATE TABLE `grado_alcohol` (
  `id` int(11) NOT NULL,
  `limite_inferior` float NOT NULL,
  `limite_superior` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grado_alcohol`
--

INSERT INTO `grado_alcohol` (`id`, `limite_inferior`, `limite_superior`) VALUES
(1, 0, 0),
(2, 70, 0),
(3, 68, 0),
(4, 69, 0),
(5, 40, 0),
(6, 30, 0),
(7, 80, 0),
(8, 70, 0),
(9, 40, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` tinyint(4) NOT NULL,
  `nombre` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `nombre`) VALUES
(1, 'metodo'),
(2, 'materiales'),
(3, 'medicion'),
(4, 'maquina'),
(5, 'mano de obra'),
(6, 'medio ambiente'),
(7, 'generales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias_motivo`
--

CREATE TABLE `incidencias_motivo` (
  `id` tinyint(4) NOT NULL,
  `nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `id_incidencias` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `incidencias_motivo`
--

INSERT INTO `incidencias_motivo` (`id`, `nombre`, `id_incidencias`) VALUES
(1, 'Falta Programacion Producción', 1),
(2, 'Falta Estandarizacion Producto', 1),
(3, 'Falta Documentacion Necesaria', 1),
(4, 'Falta de Capacitacion', 1),
(5, 'Falta de Procedimiento y/o Instructivo', 1),
(6, 'Falta de Formulación', 1),
(7, 'Desviación el la planeacion de la Orden de Producción', 1),
(8, 'Seguir Proceso sin el debido Procedimiento (estandar) ', 1),
(9, 'Aprobacion de Producto demoras', 1),
(10, 'Faltante  Materia Prima', 2),
(11, 'Materia Prima o material de empaque Defectuosa', 2),
(12, 'Faltante de Insumos Propios', 2),
(13, 'Personal no Suficiente para la Elaboracion de la Labor', 2),
(14, 'Producto sin Rotulos', 2),
(15, 'Producto No Conforme', 2),
(16, 'Defectos en tapa', 2),
(17, 'Defectos en sello', 2),
(18, 'Defectos en envase', 2),
(19, 'Defectos en etiqueta', 2),
(20, 'Defectos en loteado', 2),
(21, 'Defectos en embalaje', 2),
(22, 'Desorden Puesto de Trabajo', 3),
(23, 'Tiempo Insuficiente para Suplir las Labores', 3),
(24, 'pH fuera de estándar.', 3),
(25, 'Viscosidad fuera de estándar.', 3),
(26, 'Densidad o gravedad específica fuera de estándar.', 3),
(27, 'Grados de alcohol fuera de estándar.', 3),
(28, 'Color fuera de estándar.', 3),
(29, 'Olor fuera de estándar.', 3),
(30, 'Apariencia fuera de estándar. ', 3),
(31, 'Poder espumoso fuera de estándar. ', 3),
(32, 'Untosidad por fuera de estándar.', 3),
(33, 'Equipo Obsoleto y/o sin Mantenimiento', 4),
(34, 'Daño Sistema Calentamiento', 4),
(35, 'Averia Sistema Mecanico', 4),
(36, 'Apagado Maquinas', 4),
(37, 'Falta de Boquillas y Moldes', 4),
(38, 'Averia Sistema Electrico', 4),
(39, 'Ausencia De Personal', 5),
(40, 'Accidente de Trabajo', 5),
(41, 'Toma de Decisiones Tardia', 5),
(42, 'Falta de Capacitacion Habilidad', 5),
(43, 'Agotamiento', 5),
(44, 'Ambiente de Trabajo con Disconfort por Temperatura', 6),
(45, 'Falta de Cultura Organizacional', 6),
(46, 'Alta Cantidad de Cajas y  Tambores de Almacenamiento en Areas Productivas', 6),
(47, 'Mantenimiento Preventivo y/o Correctivo', 7),
(48, 'Instrucción al Personal', 7),
(49, 'Montaje de Molde o Boquillas', 7),
(50, 'Despeje de Lineas por Producto y/o Proceso', 7),
(51, 'Pausas Activas ( Baño, Desayuno, Almuerzo)', 7),
(52, 'Programa de Aseo en Planta', 7),
(53, 'Desviacion Orden y Aseo  Puesto de Trabajo', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructivos_base`
--

CREATE TABLE `instructivos_base` (
  `id` int(11) NOT NULL,
  `producto` int(3) NOT NULL,
  `pasos` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tiempo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `instructivos_base`
--

INSERT INTO `instructivos_base` (`id`, `producto`, `pasos`, `tiempo`) VALUES
(1, 51, 'Garantice que tiene los elementos necesarios y en optimas condiciones de higiene, limpieza y desinfección para iniciar con el proceso de producción', 1),
(2, 51, 'adicionar al tanque alistado y seleccionado para la preparación 1/2 (medio tanque) de agua desionizada a utilizar, la totalidad del edta, blend 5 y blend 8 recogido por usted en el área de dispensación. esto se debe mezclar por un minuto mínimamente', 1),
(3, 51, 'a la mezcla del paso anterior, adicionar lauril eter, cocoamida y probetaina suministrada en el área de dispensación. esta mezcla agitarla constante a xxxx rpm por 5 minutos ', 5),
(4, 51, 'al producto resultante de los paso 1 y 2 adicionar el blend 6 y continuar agitando la mezcla  por 2 minutos', 2),
(5, 51, 'a la nueva mezcla producto de los pasos 1, 2 y 3 adicionar el blend 1 a la vez que se realiza una agitación suave y constante por 3 minutos', 3),
(6, 51, 'adicionar el resto de agua, mas el blend de los colores, y el blend de las fragancias. mezclar y ajustar ph de ser necesario (adicionando blend 8). así  mismo se deberá comparar con el estándar de calidad. esto deberá mezclarse por 5 minutos', 5),
(7, 51, 'por ultimo adicionar el blend lt para ajustar la viscosidad requerida, mezclar y revisar estándares de calidad', 2),
(8, 51, 'finalice el proceso siguiendo las instrucciones suministradas por el supervisor de piso o director de producción', 5),
(9, 58, 'garantice que tiene los elementos necesarios y en optimas condiciones de higiene, limpieza y desinfección para iniciar con el proceso de producción', 1),
(10, 58, 'fundir las grasas necesarias para la producción, la temperatura de trabajo en la marmita es de 80°c', 5),
(11, 58, '\"adicionar al tanque alistado y seleccionado para la preparación 1/3 (un tercio) del total de agua desionizada a utilizar', 1),
(12, 58, 'Realizar una dilusión del edta con un poco de agua (1 litro) y adicionarlo al tanque de preparación con el producto del paso anterior miestras se realiza una agitación suave', 0.5),
(13, 58, 'adicionar al tanque que contiene el producto del proceso del paso 3, la grasa que se ha derretido previamente a 80°c. esto se debera hacer mientras se mezcla con agitación a xxxx rpm hasta formar la emulsión del producto', 5),
(14, 58, 'A la mezcla obtenida en el paso 4  por favor adicionar el blend 2, blend 57, blend 47 y blend 22 mientras se agita la mezcla. seguir este proceso hasta que termine de adicionar el 1/4 (un cuarto) del agua fria restante del total requerido', 10),
(15, 58, '\"adicionar blend de aromas, mezclar y  ajustar ph de ser necesario (blend 8)', 5),
(16, 58, 'finalice el proceso siguiendo las instrucciones suministradas por el supervisor de piso o director de producción', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructivo_preparacion`
--

CREATE TABLE `instructivo_preparacion` (
  `id` int(11) NOT NULL,
  `pasos` text COLLATE utf8_spanish_ci NOT NULL,
  `tiempo` float NOT NULL,
  `id_producto` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `instructivo_preparacion`
--

INSERT INTO `instructivo_preparacion` (`id`, `pasos`, `tiempo`, `id_producto`) VALUES
(1, 'Garantice que tiene los elementos necesarios y en optimas condiciones de higiene, limpieza y desinfecci?n para iniciar con el proceso de producci?n', 1, '20003\r'),
(2, 'Adicionar al tanque alistado y seleccionado para la preparaci?n 1/3 (un tercio) del total de agua desionizada a utilizar, la totalidad del edta, blend 5 - blend basico preservante - mawie y blend 8 - blend basico citrico - mawie recogido por usted en el ?rea de dispensaci?n.', 1, '20003\r'),
(3, 'A la mezcla del paso anterior, adicionar lauril eter, cocoamida y probetaina suministrada en el area de dispensaci?n. esta mezcla agitarla constante a xxxx rpm', 1, '20003\r'),
(4, 'Al producto resultante de los paso 1 y 2 adicionar el blend 6 - blend basico activos - mawie y continuar agitando la mezcla ', 5, '20003\r'),
(5, 'A la nueva mezla producto de los pasos 1, 2 y 3 adicionar el blend 1 - perlado sh a la vez que se realiza una agitaci?n suave y constante', 5, '20003\r'),
(6, 'Adicionar el blend de los colores, y el blend de las fragancias. mezclar y ajustar ph de ser necesario', 1, '20003'),
(7, 'Por ultimo adicionar el blend lt para ajustar la viscosidad requerida, mezclar y revisar estandares de calidad', 5, '20003\r'),
(8, 'Finalice el proceso siguiendo las instrucciones suministradas por el supervisor de piso o director de producci?n', 5, '20003\r'),
(9, 'Garantice que tiene los elementos necesarios y en optimas condiciones de higiene, limpieza y desinfecci?n para iniciar con el proceso de producci?n', 1, '20006\r'),
(10, 'Adicionar al tanque alistado y seleccionado para la preparaci?n 1/3 (un tercio) del total de agua desionizada a utilizar, la totalidad del edta, blend 5 - blend basico preservante - mawie y blend 8 - blend basico citrico - mawie recogido por usted en el ?rea de dispensaci?n.', 5, '20006\r'),
(11, 'A la mezcla del paso anterior, adicionar lauril eter, cocoamida y probetaina suministrada en el area de dispensaci?n. esta mezcla agitarla constante a xxxx rpm', 10, '20006\r'),
(12, 'Al producto resultante de los paso 1 y 2 adicionar el blend 6 - blend basico activos - mawie y continuar agitando la mezcla ', 5, '20006\r'),
(13, 'A la nueva mezla producto de los pasos 1, 2 y 3 adicionar el blend 1 - perlado sh a la vez que se realiza una agitaci?n suave y constante', 5, '20006\r'),
(14, 'Adicionar el blend de los colores, y el blend de las fragancias. mezclar y ajustar ph de ser necesario', 1, '20006'),
(15, 'Por ultimo adicionar el blend lt para ajustar la viscosidad requerida, mezclar y revisar estandares de calidad', 5, '20006\r'),
(16, 'Finalice el proceso siguiendo las instrucciones suministradas por el supervisor de piso o director de producci?n', 5, '20006\r'),
(17, 'Garantice que tiene los elementos necesarios y en optimas condiciones de higiene, limpieza y desinfecci?n para iniciar con el proceso de producci?n', 1, '20019\r'),
(18, 'Adicionar al tanque alistado y seleccionado para la preparaci?n 1/3 (un tercio) del total de agua desionizada a utilizar, la totalidad del edta, blend 5 - blend basico preservante - mawie y blend 8 - blend basico citrico - mawie recogido por usted en el ?rea de dispensaci?n.', 1, '20019\r'),
(19, 'A la mezcla del paso anterior, adicionar lauril eter, cocoamida y probetaina suministrada en el area de dispensaci?n. esta mezcla agitarla constante a xxxx rpm', 1, '20019\r'),
(20, 'Al producto resultante de los paso 1 y 2 adicionar el blend 6 - blend basico activos - mawie y continuar agitando la mezcla ', 5, '20019\r'),
(21, 'A la nueva mezla producto de los pasos 1, 2 y 3 adicionar el blend 1 - perlado sh a la vez que se realiza una agitaci?n suave y constante', 5, '20019\r'),
(22, 'Adicionar el blend de los colores, y el blend de las fragancias. mezclar y ajustar ph de ser necesario', 1, '20019'),
(23, 'Por ultimo adicionar el blend lt para ajustar la viscosidad requerida, mezclar y revisar estandares de calidad', 5, '20019\r'),
(24, 'Finalice el proceso siguiendo las instrucciones suministradas por el supervisor de piso o director de producci?n', 5, '20019\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE `linea` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `densidad` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`id`, `nombre`, `densidad`) VALUES
(0, 'BLEND', 1),
(1, 'SEMISÓLIDO', 0.98),
(2, 'LÍQUIDO', 0.99),
(3, 'SÓLIDO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_maquinaria`
--

CREATE TABLE `linea_maquinaria` (
  `id` int(11) NOT NULL,
  `id_linea` int(11) NOT NULL,
  `id_agitador` int(11) NOT NULL,
  `id_marmita` int(11) NOT NULL,
  `id_loteadora` int(11) NOT NULL,
  `id_envasadora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `linea_maquinaria`
--

INSERT INTO `linea_maquinaria` (`id`, `id_linea`, `id_agitador`, `id_marmita`, `id_loteadora`, `id_envasadora`) VALUES
(1, 1, 1, 1, 1, 1),
(2, 2, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loteadora`
--

CREATE TABLE `loteadora` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `loteadora`
--

INSERT INTO `loteadora` (`id`, `nombre`) VALUES
(1, 'Loteadora 1'),
(2, 'loteadora 2'),
(3, 'Loteadora 3'),
(4, 'loteadora 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinaria`
--

CREATE TABLE `maquinaria` (
  `id` int(11) NOT NULL,
  `maquina` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `linea` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `maquinaria`
--

INSERT INTO `maquinaria` (`id`, `maquina`, `linea`) VALUES
(2, 'ENVASADORA NEUMATICA SEMISOLIDOS', 2),
(3, 'LOTEADORA 1', 1),
(4, 'LOTEADORA 2', 2),
(5, 'LOTEADORA 3', 3),
(6, 'MARMITA DE 100 KG CON MOTOREDUCTOR Y VARIADOR', 1),
(7, 'MARMITA DE 200 KG CON MOTOREDUCTOR Y VARIADOR', 2),
(8, 'MARMITA DE 800 KG CON MOTOREDUCTOR Y VARIADOR', 3),
(9, '0001-00003 AGITADOR HOMO-MIXER', 1),
(10, '0001-00004 agitador homo-mixer', 2),
(11, '0001-00045 agitador de baja potencia', 3),
(12, 'Banda transportadora 1', 1),
(13, 'Banda transportadora 2', 2),
(14, 'Banda transportadora 3', 3),
(15, 'Etiqueteadora 1', 1),
(16, 'ETIQUETEADORA 2', 2),
(17, 'ETIQUETEADORA 3', 3),
(18, 'TUNEL TERMO 1', 1),
(19, 'TUNEL TERMO 2', 2),
(20, 'TUNEL TERMO 3', 3),
(21, 'Envasadora neumatica liquidos', 1),
(22, 'ENVASADORA NEUMATICA SOLIDOS', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`) VALUES
(1, 'Ada\r'),
(2, 'Advance pro\r'),
(3, 'Al natural\r'),
(4, 'Azucar morena\r'),
(5, 'Barba herbal\r'),
(6, 'By liliam maestre\r'),
(7, 'By manu gomez\r'),
(8, 'Cabellos radiantes\r'),
(9, 'Capilsan\r'),
(10, 'Celestial\r'),
(11, 'Chiara\r'),
(12, 'Clariderm\r'),
(13, 'Class gold\r'),
(14, 'Crazy colors\r'),
(15, 'Dermannabis\r'),
(16, 'Dezham\r'),
(17, 'Dezhma beauty\r'),
(18, 'D mag\r'),
(19, 'Dulce secreto\r'),
(20, 'Ecozen\r'),
(21, 'Encanto\r'),
(22, 'Esencia cosmetica artesanal\r'),
(23, 'Estrella de mar\r'),
(24, 'Fika beuty\r'),
(25, 'Filomena\r'),
(26, 'Goldskin\r'),
(27, 'Idunn cosmetics\r'),
(28, 'Indian red\r'),
(29, 'Inmaculada\r'),
(30, 'Isabely\r'),
(31, 'Karicia\r'),
(32, 'Kebelle\r'),
(33, 'Laboratorios lemonier\r'),
(34, 'Larimar\r'),
(35, 'Lorhan\r'),
(36, 'Lucent\r'),
(37, 'Luxury\r'),
(38, 'Lz\r'),
(39, 'Malaika\r'),
(40, 'Mandy\r'),
(41, 'Manthoe\r'),
(42, 'Maria e\r'),
(43, 'Mawie\r'),
(44, 'Milagros\r'),
(45, 'Minoxifort\r'),
(46, 'Morgana\r'),
(47, 'Moringel\r'),
(48, 'Moringel soluna\r'),
(49, 'Morinpiel\r'),
(50, 'Nativis\r'),
(51, 'Olimpo\r'),
(52, 'Paradise by manu gomez\r'),
(53, 'Permaliss\r'),
(54, 'Pianta\r'),
(55, 'Policlean\r'),
(56, 'Ponto brasileiro\r'),
(57, 'Prismatec\r'),
(58, 'R.r pharm s.a.s\r'),
(59, 'Salvar\r'),
(60, 'Sandra castaño'),
(61, 'Secret of angels\r'),
(62, 'S\'hair plus solutions'),
(63, 'Somos al natural\r'),
(64, 'T\'hair'),
(65, 'Tez\r'),
(66, 'The bliss\r'),
(67, 'Tulip beauty\r'),
(68, 'Vibes\r'),
(69, 'Victoria liss\r'),
(70, 'Wonder gold sas\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marmita`
--

CREATE TABLE `marmita` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `marmita`
--

INSERT INTO `marmita` (`id`, `nombre`) VALUES
(1, 'MARMITA DE 100 KG CON MOTOREDUCTOR Y VARIADOR'),
(2, 'MARMITA DE 200 KG CON MOTOREDUCTOR Y VARIADOR'),
(3, 'MARMITA DE 800 KG CON MOTOREDUCTOR Y VARIADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_prima`
--

CREATE TABLE `materia_prima` (
  `referencia` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `materia_prima`
--

INSERT INTO `materia_prima` (`referencia`, `nombre`, `alias`) VALUES
('10001', 'Aceite mineral usp - guia no 520', 'Cosmetics - 342 - 001\r'),
('10002', 'Aculyn 44 - guia no 601', 'Cosmetics - 585 - 002'),
('10003', 'Agua desionizada', 'Cosmetics - 573 - 003\r'),
('10005', 'Alcohol etílico potable extraneutro- etanol liquido - guía n', 'Cosmetics - 270 - 005'),
('10008', 'Bioextracto germen de trigo hg - guia no 324', 'Cosmetics - 569 - 008\r'),
('10009', 'Bio-restore - guia no 346', 'Cosmetics - 144 - 009\r'),
('10010', 'Base cocoamida - guia no 900', 'Cosmetics - 260 - 010\r'),
('10011', 'Extracto colageno hidrolizado - guia no 339', 'Cosmetics - 637 - 011\r'),
('10012', 'Colorante liquido color caramelo 2000', 'Cosmetics - 564 - 012\r'),
('10013', 'Extracto concentrado de uva fr. - guia no 308', 'Cosmetics - 257 - 013\r'),
('10014', 'Activo d-pantenol usp - guia no 602', 'Cosmetics - 161 - 014\r'),
('10015', 'Flor lavanda (alhucema en polvo) - guia no 708', 'Cosmetics - 201 - 015\r'),
('10017', 'Extra/ cooling complex - guia no 344', 'Cosmetics - 550 - 017\r'),
('10018', 'Extracto de aloe vera - guia no 351', 'Cosmetics - 517 - 018\r'),
('10019', 'Extracto de cal?ndula - guia no 355', 'Cosmetics - 651 - 019\r'),
('10020', 'Blend 22 - extracto f2 - guia no 991', 'Cosmetics - 318 - 020\r'),
('10021', 'Extracto de eucalipto - guia no 360', 'Cosmetics - 308 - 021\r'),
('10022', 'Extracto de romero - guia no 354', 'Cosmetics - 353 - 022\r'),
('10023', 'Extracto embri?n de pato - guia no 350', 'Cosmetics - 416 - 023\r'),
('10025', 'Fixate g-100', 'Cosmetics - 502 - 025\r'),
('10026', 'Fragancia 212 splash 958104 - guia no22', 'Cosmetics - 211 - 026\r'),
('10027', 'Fragancia affair 232362n - guia no53', 'Cosmetics - 246 - 027\r'),
('10028', 'Fragancia avena 220790-n - guia no11', 'Cosmetics - 204 - 028\r'),
('10030', 'Fragancia bamboo tea 155167 (fantasia mc) - guia no', 'Cosmetics - 443 - 030\r'),
('10034', 'Fragancia base zanahoria (mex-ec0156929) - guia no51', 'Cosmetics - 574 - 034\r'),
('10039', 'Fragancia coco lima verbena 977463 - guia no88', 'Cosmetics - 345 - 039\r'),
('10047', 'Fragancia durazno (mango) ref. 166175 - guia no46', 'Cosmetics - 213 - 047\r'),
('10048', 'Fragancia maracuya 990948 - guia no16', 'Cosmetics - 287 - 048\r'),
('10049', 'Fragancia mermelade - guia no20', 'Cosmetics - 430 - 049\r'),
('10050', 'Fragancia moment 241308j - guia no50', 'Cosmetics - 640 - 050\r'),
('10059', 'Fragancia torta de chocolate 970188 - guia no6', 'Cosmetics - 102 - 059\r'),
('10061', 'Fragancia hs citrus fresh kh10201 445265 - guia no42', 'Cosmetics - 278 - 061\r'),
('10063', 'Activo genapol blanco perlado novavit - guia no 902', 'Cosmetics - 637 - 063\r'),
('10064', 'Activo glicerina usp col-tp250 - guia no 646', 'Cosmetics - 576 - 064\r'),
('10066', 'Alcohol industrial - guia no 923', 'Cosmetics - 367 - 066\r'),
('10067', 'Extracto lino -p (glicolico) - guia no 320', 'Cosmetics - 245 - 067\r'),
('10068', 'Lipocol hco-40', 'Cosmetics - 233 - 068\r'),
('10071', 'Policuaternium 007 -mackernium ( cosmetics c-107 cdm) - guia no905', 'Cosmetics - 217 - 071\r'),
('10072', 'Preservante mackstat dm (hidantoina) - guia no 861', 'Cosmetics - 576 - 072\r'),
('10073', 'Silicona sxr-mem 1784 emulsi?n-gr18.1 (xiameter) - guia no 853', 'Cosmetics - 521 - 073\r'),
('10078', 'Extracto phitomix antialopecia(hair care 6-p) - guia no 349', 'Cosmetics - 255 - 078\r'),
('10079', 'Phitomix cabello normal', 'Cosmetics - 596 - 079\r'),
('10080', 'Activo phytokeratin pf grade keratina - guia no 636', 'Cosmetics - 189 - 080\r'),
('10083', 'Propilenglicol - guia no 319', 'Cosmetics - 125 - 083\r'),
('10085', 'Silicona 9027 elastomer blend - guia no 855', 'Cosmetics - 583 - 085\r'),
('10087', 'Silicona mirasil c-dml 1501 (gruesa) - guia no 852', 'Cosmetics - 224 - 087\r'),
('10090', 'Activo sunquart ct 29 (genamin) - guia no 904', 'Cosmetics - 411 - 090\r'),
('10092', 'Activo trietanolamina - guia  no 621', 'Cosmetics - 385 - 092\r'),
('10093', 'Vitamina e alfatocoferol acetato - guia no 940', 'Cosmetics - 124 - 093\r'),
('10095', 'Silicona mirasil cm 5 245 fluida - guia no 851', 'Cosmetics - 376 - 095\r'),
('10096', 'Acido citrico - guia no881', 'Cosmetics - 451 - 096\r'),
('10097', 'Acido estearico 38% (triple prensado) - guia no 887', 'Cosmetics - 374 - 097\r'),
('10098', 'Peroxido de hidrogeno (50%)', 'Cosmetics - 205 - 098\r'),
('10100', 'Colorante amarillo sunset c.i 15985', 'Cosmetics - 445 - 100\r'),
('10101', 'Azucar', 'Cosmetics - 366 - 101\r'),
('10102', 'Bht - guia no 719', 'Cosmetics - 571 - 102\r'),
('10103', 'Polvo carbopol etd 2020 ( stabylen 30 fino) - guia no 711', 'Cosmetics - 186 - 103\r'),
('10109', 'Cloruro de sodio', 'Cosmetics - 447 - 109\r'),
('10110', 'Polvo dihidroxiacetona - guia no 704', 'Cosmetics - 652 - 110\r'),
('10111', 'Escama grasa emulgin b1-cognis - guia no 725', 'Cosmetics - 639 - 111\r'),
('10112', 'Eumulgin b2', 'Cosmetics - 544 - 112\r'),
('10113', 'Eumulgin b3 - guia no 727', 'Cosmetics - 359 - 113\r'),
('10116', 'Planta flor de calendula - guia no 952', 'Cosmetics - 272 - 116\r'),
('10117', 'Esferas azules lipobead blue ae - guia no 606', 'Cosmetics - 540 - 117\r'),
('10119', 'Aceite manteca de karit? - guia no 502', 'Cosmetics - 218 - 119\r'),
('10120', 'Mentol cristales usp - guia no 724', 'Cosmetics - 419 - 120\r'),
('10125', 'Polvo pvp k30 - guia no 702', 'Cosmetics - 357 - 125\r'),
('10126', 'Planta romero rama seca - guia no 951', 'Cosmetics - 260 - 126\r'),
('10128', 'Triclosan -  polvo - guia no 715', 'Cosmetics - 496 - 128\r'),
('10129', 'Uvasorb s5 (benzophenone 4) - guia no 707', 'Cosmetics - 382 - 129\r'),
('10130', 'Alcohol cetilico -grasos - guia no 922', 'Cosmetics - 264 - 130\r'),
('10133', 'Alcohol estearilico', 'Cosmetics - 119 - 133\r'),
('10134', 'Polvo polygel hp (carbomero 940) - guia no 700', 'Cosmetics - 472 - 134\r'),
('10135', 'L-cisteina - guia no 718', 'Cosmetics - 602 - 135\r'),
('10137', 'Lauril eter sulfato de sodio 70% (texapon,proquiles,lesna,le - guia no 903', 'Cosmetics - 543 - 137\r'),
('10138', 'Probetaina cabs - guia no 901', 'Cosmetics - 279 - 138\r'),
('10141', 'Desinfectante hipoclorito de sodio', 'Cosmetics - 191 - 141\r'),
('10142', 'Soluc-des x 1l', 'Cosmetics - 566 - 142\r'),
('10144', 'Activo mirustyle cp - lq - guia no 623', 'Cosmetics - 285 - 144\r'),
('10146', 'Desinfex', 'Cosmetics - 588 - 146\r'),
('10147', 'Colorante en polvo color amaranto', 'Cosmetics - 550 - 147\r'),
('10150', 'Phitomix (hair care n5 phitoex-p) - guia no 348', 'Cosmetics - 420 - 150\r'),
('10151', 'Formaldehydo solution (k42183503-120)', 'Cosmetics - 114 - 151\r'),
('10152', 'Acido ascorbico (vitamina c) - no 941', 'Cosmetics - 207 - 152\r'),
('10153', 'Color amarillo huevo (tartrazina)', 'Cosmetics - 603 - 153\r'),
('10157', 'Miristato isopropil', 'Cosmetics - 525 - 157\r'),
('10164', 'Aceite oxipon (aceite de aguacate lipovol a)', 'Cosmetics - 166 - 164\r'),
('10165', 'Edta disodico dithidrato - guia no 703', 'Cosmetics - 275 - 165\r'),
('10167', 'Sabor uva', 'Cosmetics - 537 - 167\r'),
('10168', 'Fragancia sabor cherry - guia no 5', 'Cosmetics - 362 - 168\r'),
('10171', 'Fragancia coco ligth - guia no56', 'Cosmetics - 406 - 171\r'),
('10172', 'Fragancia angelical - guia no49', 'Cosmetics - 547 - 172\r'),
('10177', 'Colorante en polvo color rojo punzon', 'Cosmetics - 630 - 177\r'),
('10180', 'Vitamina e x p', 'Cosmetics - 647 - 180\r'),
('10183', 'Cera abejas blanca - guia no 710', 'Cosmetics - 286 - 183\r'),
('10185', 'Colorante azul cq-4', 'Cosmetics - 123 - 185\r'),
('10187', 'Activo genamin btlf - guia no 648', 'Cosmetics - 118 - 187\r'),
('10194', 'Proteina de seda', 'Cosmetics - 360 - 194\r'),
('10195', 'Clavos de olor enteros - guia no 955', 'Cosmetics - 140 - 195\r'),
('10197', 'Anis en polvo', 'Cosmetics - 281 - 197\r'),
('10198', 'Activo ceramida a2 - guia no 608', 'Cosmetics - 388 - 198\r'),
('10199', 'Extracto ortiga - p (alicolico) - guia no 312', 'Cosmetics - 188 - 199\r'),
('10200', 'Activo genapol lt espesante - guia no 909', 'Cosmetics - 462 - 200\r'),
('10202', 'Colorante matizante colorex av 43', 'Cosmetics - 469 - 202\r'),
('10203', 'Colorex hcb 2', 'Cosmetics - 273 - 203\r'),
('10204', 'Fragancia base neutralizante bmx - guia no31', 'Cosmetics - 334 - 204\r'),
('10206', 'Acido undecilenico - guia no 882', 'Cosmetics - 281 - 206\r'),
('10207', 'Pvp k 90 - guia no 713', 'Cosmetics - 295 - 207\r'),
('10208', 'Galaxy sn930 (base jabon transparente)', 'Cosmetics - 512 - 208\r'),
('10210', 'Filtro solar salisol omc (eusolex 2292) - guia no 612', 'Cosmetics - 143 - 210\r'),
('10211', 'Base lichie rosa vmx 54264 - guia no 98', 'Cosmetics - 206 - 211\r'),
('10212', 'Versagel m 750 - guia no 605', 'Cosmetics - 411 - 212\r'),
('10213', 'Silicona sdc-rm 2051 thickening agent (espesante) - guia no 857', 'Cosmetics - 267 - 213\r'),
('10215', 'Fragancia base denver vmx 58936 - guia no 95', 'Cosmetics - 191 - 215\r'),
('10220', 'Extracto seboregulador 6 p - guia no 310', 'Cosmetics - 444 - 220\r'),
('10221', 'Fragancia mango creme - guia no 100', 'Cosmetics - 535 - 221\r'),
('10222', 'Fragancia cande - guia no57', 'Cosmetics - 396 - 222\r'),
('10223', 'Exfoliante coconut exfoliator 500-g60 - guia no 801', 'Cosmetics - 493 - 223\r'),
('10225', 'Activo mackam 2c-lipockam - guia no 640', 'Cosmetics - 407 - 225\r'),
('10228', 'Pmxestimulante capilar p-alicol crece cabello-dermo vital 12 - guia no 331 ', 'Cosmetics - 139 - 228\r'),
('10229', 'Proliss - guia no 632', 'Cosmetics - 503 - 229\r'),
('10231', 'Fragancia fixarome - guia no47', 'Cosmetics - 405 - 231\r'),
('10235', 'Aloe vera gel', 'Cosmetics - 233 - 235\r'),
('10237', 'Poliplant capilar - guia no 316', 'Cosmetics - 503 - 237\r'),
('10240', 'Aceite de argan - guia no 500', 'Cosmetics - 424 - 240\r'),
('10242', 'Extracto limon fruto - guia no 335', 'Cosmetics - 548 - 242\r'),
('10244', 'Fragancia carol 212 - guia no28', 'Cosmetics - 636 - 244\r'),
('10245', 'Fragancia julieta - guia no64', 'Cosmetics - 431 - 245\r'),
('10248', 'Extracto adelgazante anticelulitica', 'Cosmetics - 581 - 248\r'),
('10249', 'Extracto hamamelis virginiana - guia no 336', 'Cosmetics - 459 - 249\r'),
('10252', 'Grasa lanolina anhidra usp - guia no 521', 'Cosmetics - 428 - 252\r'),
('10253', 'Vaselina b/ca - guia no 611', 'Cosmetics - 376 - 253\r'),
('10254', 'Aceito eucaliptol 70-75% - guia no 505', 'Cosmetics - 497 - 254\r'),
('10255', 'Activo salcilato de metilo', 'Cosmetics - 234 - 255\r'),
('10257', 'Aceite zanahoria - guia no 519', 'Cosmetics - 260 - 257\r'),
('10258', 'Fragancia frutos rojos - guia no7', 'Cosmetics - 408 - 258\r'),
('10259', 'Fragancia melon & pera - guia no70', 'Cosmetics - 126 - 259\r'),
('10261', 'Fragancia paris hilton - guia no59', 'Cosmetics - 115 - 261\r'),
('10264', 'Complejo #1 antipolucion - guia no 330', 'Cosmetics - 535 - 264\r'),
('10265', 'Complejo #2 hidratante - guia no 329', 'Cosmetics - 339 - 265\r'),
('10266', 'Complejo #3 antiedad - guia no 327', 'Cosmetics - 647 - 266\r'),
('10267', 'Extracto complejo #4 oxigenante - guia no 332', 'Cosmetics - 329 - 267\r'),
('10268', 'Extracto complejo #6 pieles sensibles - guia no 328', 'Cosmetics - 115 - 268\r'),
('10270', 'Fragancia vainilla lace - guia no55', 'Cosmetics - 297 - 270\r'),
('10271', 'Fragancia lima limon - guia no65', 'Cosmetics - 200 - 271\r'),
('10273', 'Extracto cola de caballo - guia no 323', 'Cosmetics - 637 - 273\r'),
('10274', 'Extracto casta?o de indias (prodilenglicol) - guia no 318', 'Cosmetics - 435 - 274\r'),
('10275', 'Espesante lustreplex-lq (mh) - guia no 604', 'Cosmetics - 405 - 275\r'),
('10276', 'Fragancia paradisse - guia no58', 'Cosmetics - 602 - 276\r'),
('10277', 'Acido hialurinico (hylasome) - guia no 885', 'Cosmetics - 222 - 277\r'),
('10278', 'Extracto de quina hg - guia no 317', 'Cosmetics - 564 - 278\r'),
('10279', 'Extracto de levadura - guia no 321', 'Cosmetics - 236 - 279\r'),
('10281', 'Espesante luviquat supreme - guia no 631', 'Cosmetics - 625 - 281\r'),
('10285', 'Fragancia marazul - guia no73', 'Cosmetics - 247 - 285\r'),
('10286', 'Elastina - guia no 347', 'Cosmetics - 513 - 286\r'),
('10288', 'Fragancia escol. florecer - guia no62', 'Cosmetics - 502 - 288\r'),
('10289', 'Colorante matizante colorex br 51 (rojo)', 'Cosmetics - 395 - 289\r'),
('10291', 'Arena exfoliante - guia no 804', 'Cosmetics - 235 - 291\r'),
('10292', 'Colorante matizante colorex bo 31 (cobrizo)', 'Cosmetics - 528 - 292\r'),
('10293', 'Colorona oriental beige', 'Cosmetics - 437 - 293\r'),
('10294', 'Silicona mirasil hms - guia no 856', 'Cosmetics - 615 - 294\r'),
('10295', 'Tinosorb s - guia no 712', 'Cosmetics - 203 - 295\r'),
('10296', 'Filtro solar tinosorb m - guia no 610', 'Cosmetics - 554 - 296\r'),
('10299', 'Filtro solar uvinul t 150', 'Cosmetics - 354 - 299\r'),
('10300', 'Uvinul n 539t - guia no 607', 'Cosmetics - 540 - 300\r'),
('10308', 'Polvo almidon farmal usp - guia no 701', 'Cosmetics - 222 - 308\r'),
('10310', 'Polvo colorona karat gold mp 24', 'Cosmetics - 496 - 310\r'),
('10311', 'Fragancia base odalisque coral (coralina) mex-ec0218387 - guia no60', 'Cosmetics - 252 - 311\r'),
('10312', 'Escama grasa emulgin b2 (hostacerin cs 200) - guia no 726', 'Cosmetics - 278 - 312\r'),
('10313', 'Anageline e l - guia no 614', 'Cosmetics - 509 - 313\r'),
('10314', 'Fragancia blue sky - guia no9', 'Cosmetics - 242 - 314\r'),
('10315', 'Aceite de jojoba - guia no 501', 'Cosmetics - 164 - 315\r'),
('10316', 'Fragancia vitabela - guia no8', 'Cosmetics - 144 - 316\r'),
('10317', 'Fragancia fantastic - guia no17', 'Cosmetics - 221 - 317\r'),
('10319', 'Fragancia manzana - guia no', 'Cosmetics - 649 - 319\r'),
('10321', 'Jarocol blue 2', 'Cosmetics - 415 - 321\r'),
('10322', 'Planta quina corteza entera', 'Cosmetics - 229 - 322\r'),
('10323', 'Activo liquido clorhidroxido de aluminio - guia no 649', 'Cosmetics - 594 - 323\r'),
('10324', 'Fragancia charlote - guia no79', 'Cosmetics - 106 - 324\r'),
('10326', 'Fragancia tipo hugo - guia no48', 'Cosmetics - 181 - 326\r'),
('10327', 'Fragancia sparklin kiwi - guia no21', 'Cosmetics - 278 - 327\r'),
('10328', 'Fragancia bambu fantasia - guia no13', 'Cosmetics - 191 - 328\r'),
('10329', 'Exfoliante semilla de mora -albaricoque lipo aps 40/60 - guia no 802       ', 'Cosmetics - 383 - 329\r'),
('10330', 'Acido glioxilico - guia no 883', 'Cosmetics - 553 - 330\r'),
('10331', 'Aceite de rosa mosqueta - guia no 507', 'Cosmetics - 344 - 331\r'),
('10332', 'Fragancia love cod 967841 - guia no61', 'Cosmetics - 500 - 332\r'),
('10333', 'Salicilato de metilo - guia no 633', 'Cosmetics - 143 - 333\r'),
('10334', 'Polvo cristales alcanfor dab 8 - guia no 723', 'Cosmetics - 650 - 334\r'),
('10335', 'Monoestearato de glicerilo - guia no 706', 'Cosmetics - 551 - 335\r'),
('10336', 'Acido salicilico', 'Cosmetics - 167 - 336\r'),
('10337', 'Silicona a+ - guia no 854', 'Cosmetics - 636 - 337\r'),
('10338', 'Policuaternio 6-novavit c 106 - guia no 906', 'Cosmetics - 336 - 338\r'),
('10339', 'Fragancia citrus punch - guia no 97', 'Cosmetics - 258 - 339\r'),
('10340', 'Fragancia base fusion natural mex-eco217621 - guia no25      ', 'Cosmetics - 265 - 340\r'),
('10341', 'Colorante matizante funky fusion real teal', 'Cosmetics - 352 - 341\r'),
('10342', 'Extracto de azucena - p (propilenglicol) - guia no 352', 'Cosmetics - 653 - 342\r'),
('10346', 'Colorante matizante arianor mahogany 306002', 'Cosmetics - 422 - 346\r'),
('10347', 'Colorante matizante arianor siena brown 306001', 'Cosmetics - 401 - 347\r'),
('10348', 'Fijador color covafix 123 - guia no 337', 'Cosmetics - 631 - 348\r'),
('10353', 'Fragancia romantic amber - guia no77', 'Cosmetics - 259 - 353\r'),
('10354', 'Fragancia one millo - guia no69', 'Cosmetics - 484 - 354\r'),
('10355', 'Extracto hiedra p (glicolico) - guia no 333', 'Cosmetics - 596 - 355\r'),
('10356', 'Extracto pmx.adelgazan anticelu -slimther 8-p - guia no 313', 'Cosmetics - 285 - 356\r'),
('10359', 'Euxyl k 510', 'Cosmetics - 142 - 359\r'),
('10361', 'Aceite de oliva refinado - guia no 513', 'Cosmetics - 174 - 361\r'),
('10362', 'Extracto de ginkgo biloba liquido - guia no 311 ', 'Cosmetics - 535 - 362\r'),
('10363', 'Extracto de ginseng liquido - guia no 305', 'Cosmetics - 518 - 363\r'),
('10364', 'Aceite de macadamia - guia no 512', 'Cosmetics - 444 - 364\r'),
('10365', 'Original apple - celulas madre manzana - guia no 177', 'Cosmetics - 508 - 365\r'),
('10366', 'Polvo biotina pura usp', 'Cosmetics - 202 - 366\r'),
('10367', 'Extracto de manzanilla liquido - guia no 306', 'Cosmetics - 232 - 367\r'),
('10368', 'Extracto de arnica liquido - guia no 303', 'Cosmetics - 374 - 368\r'),
('10369', 'Extracto de avena - guia no 300', 'Cosmetics - 162 - 369\r'),
('10370', 'Extracto de algas focus liquido - guia no 353', 'Cosmetics - 323 - 370\r'),
('10371', 'Extracto de centella asiatica liquido - guia no 304', 'Cosmetics - 279 - 371\r'),
('10372', 'Extracto de pepino liquido - guia no 307', 'Cosmetics - 291 - 372\r'),
('10373', 'Polvo alantoina - guia no 722', 'Cosmetics - 274 - 373\r'),
('10375', 'Fragancia base banano - guia no54', 'Cosmetics - 212 - 375\r'),
('10376', 'Extracto de te verde liquido - guia no 301', 'Cosmetics - 529 - 376\r'),
('10377', 'Exfoliante de piedra volcanica - guia no 805', 'Cosmetics - 480 - 377\r'),
('10378', 'Extracto de cebolla - guia no 362', 'Cosmetics - 285 - 378\r'),
('10381', 'Fragancia artic fruits (tropic) - guia no41', 'Cosmetics - 378 - 381\r'),
('10382', 'Alcohol cetoestarilico 70/30 - guia no 921', 'Cosmetics - 473 - 382\r'),
('10383', 'Aceite bio elixir - guia no 522', 'Cosmetics - 196 - 383\r'),
('10384', 'Polvo nuez moscada polvo - guia no 721', 'Cosmetics - 373 - 384\r'),
('10385', 'Fragancia toffe - guia no52', 'Cosmetics - 126 - 385\r'),
('10386', 'Colorante matizante funky pretty in pink', 'Cosmetics - 159 - 386\r'),
('10387', 'Fragancia invicto (invictos m) - guia no75', 'Cosmetics - 252 - 387\r'),
('10388', 'Fragancia de chocolate - guia no3', 'Cosmetics - 512 - 388\r'),
('10389', 'Fragancia base suave avena mex-eco167471 - guia no10', 'Cosmetics - 105 - 389\r'),
('10390', 'Fragancia base victoria coconut passion mex-eco - guia no66  ', 'Cosmetics - 439 - 390\r'),
('10391', 'Fragancia base vainilla zande vco 12845 - guia no30', 'Cosmetics - 495 - 391\r'),
('10392', 'Aceite de aguacate hidrosoluble - guia no 514', 'Cosmetics - 402 - 392\r'),
('10393', 'Aceite de macadamia hidrosoluble - guia no 518', 'Cosmetics - 225 - 393\r'),
('10395', 'Aceite de coco hidrosoluble - guia no 506', 'Cosmetics - 487 - 395\r'),
('10396', 'Aceite de argan hidrosoluble', 'Cosmetics - 342 - 396\r'),
('10398', 'Extracto bioex-capilar extracto de huevo - guia no 302', 'Cosmetics - 621 - 398\r'),
('10399', 'Extracto gusano de seda liquido - guia no 345', 'Cosmetics - 165 - 399\r'),
('10401', 'Fragancia victoria rush cake - guia no40', 'Cosmetics - 508 - 401\r'),
('10402', 'Extracto de henna - guia no 322', 'Cosmetics - 161 - 402\r'),
('10403', 'Radiant fantasy pearl', 'Cosmetics - 517 - 403\r'),
('10405', 'Colorante matizante radiant color pearl', 'Cosmetics - 225 - 405\r'),
('10406', 'Polvo arbutina', 'Cosmetics - 124 - 406\r'),
('10407', 'Flor de jamaica entera - guia no 954', 'Cosmetics - 320 - 407\r'),
('10408', 'Fragancia zanahoria swissarom - guia no', 'Cosmetics - 597 - 408\r'),
('10409', 'Aceite de almendras', 'Cosmetics - 625 - 409\r'),
('10410', 'Fragancia charmin secret - guia no 121', 'Cosmetics - 276 - 410\r'),
('10412', 'Fragancia cocovan (cocovainilla) - guia no1', 'Cosmetics - 142 - 412\r'),
('10413', 'Fragancia escol mango - guia no 99', 'Cosmetics - 418 - 413\r'),
('10414', 'Preservante troycare pe91-sharomix eg10 - guia no 862', 'Cosmetics - 477 - 414\r'),
('10415', 'Activo genapol pgm clariant - guia no 907', 'Cosmetics - 168 - 415\r'),
('10416', 'Polvo cafe seco', 'Cosmetics - 579 - 416\r'),
('10417', 'Blend 6 - blend basico activos - mawie', 'Cosmetics - 327 - 417\r'),
('10418', 'Aceite moringa- guia no 517', 'Cosmetics - 138 - 418\r'),
('10419', 'Plantas hojas moringa - guia  no 953', 'Cosmetics - 378 - 419\r'),
('10420', 'Activo acido glicolico 70 % guia no 884', 'Cosmetics - 193 - 420\r'),
('10421', 'Aceite de zapote - guia no 197', 'Cosmetics - 115 - 421\r'),
('10422', 'Activo kaviar - guia no 613', 'Cosmetics - 476 - 422\r'),
('10423', 'Polvo oxido de zinc', 'Cosmetics - 644 - 423\r'),
('10425', 'Fragancia turqoise fcb-12339 - guia no72', 'Cosmetics - 186 - 425\r'),
('10426', 'Fragancia versace crital fcb-12376 - guia no43', 'Cosmetics - 156 - 426\r'),
('10427', 'Fragancia guilty gucci fcd-12194 - guia no45', 'Cosmetics - 423 - 427\r'),
('10428', 'Activo minoxidil polvo', 'Cosmetics - 360 - 428\r'),
('10430', 'Aceite cetiol he - guia no 523', 'Cosmetics - 328 - 430\r'),
('10431', 'Aceite cetiol oe - guia no 508', 'Cosmetics - 310 - 431\r'),
('10434', 'Fragancia bebe - guia no67', 'Cosmetics - 248 - 434\r'),
('10435', 'Hydrovance - guia no 622', 'Cosmetics - 157 - 435\r'),
('10437', 'Jabon de glicerina zetesap - guia no 910', 'Cosmetics - 554 - 437\r'),
('10438', 'Activo lipobeads golden pearls (oro) - guia no 620', 'Cosmetics - 446 - 438\r'),
('10439', 'Activo minoxidil liposomas', 'Cosmetics - 203 - 439\r'),
('10440', 'Fragancia red love - guia no71', 'Cosmetics - 419 - 440\r'),
('10441', 'Activo biocapigen veg - guia no 617', 'Cosmetics - 136 - 441\r'),
('10442', 'Fragancia herbapon cod.978831 - guia no23', 'Cosmetics - 231 - 442\r'),
('10443', 'Activo sunquart tms', 'Cosmetics - 425 - 443\r'),
('10444', 'Activo saliquart ultima - preservante ni?os - guia no 202', 'Cosmetics - 545 - 444\r'),
('10445', 'Preservante biosure fe - guia no 863', 'Cosmetics - 125 - 445\r'),
('10446', 'Activo pilingib veg ls 9109 - guia no 618', 'Cosmetics - 142 - 446\r'),
('10448', 'Activo arlypon tt (espesante - guia no 639', 'Cosmetics - 141 - 448\r'),
('10449', 'Extracto passiflora - guia no 341', 'Cosmetics - 382 - 449\r'),
('10450', 'Extracto tomillo - guia no 325', 'Cosmetics - 509 - 450\r'),
('10451', 'Extracto de bardana - guia no 343', 'Cosmetics - 385 - 451\r'),
('10453', 'Activo coenzima q 10 liposomas - guia no 619', 'Cosmetics - 647 - 453\r'),
('10454', 'Extracto de cacao - guia no 334', 'Cosmetics - 585 - 454\r'),
('10456', 'Activo cupuacu buter - guia no 709', 'Cosmetics - 370 - 456\r'),
('10457', 'Activo andiroba oil - guia no 609', 'Cosmetics - 563 - 457\r'),
('10458', 'Activo nicotinamida (vitamina b3) - guia no 942', 'Cosmetics - 169 - 458\r'),
('10459', 'Fragancia army s.m - guia no19', 'Cosmetics - 390 - 459\r'),
('10460', 'Fragancia macho man - guia no83', 'Cosmetics - 183 - 460\r'),
('10461', 'Fragancia hugo red - guia no76', 'Cosmetics - 647 - 461\r'),
('10462', 'Activo lipamide dea 75% - guia no 603', 'Cosmetics - 392 - 462\r'),
('10463', 'Activo lipo dsls (libre de sulfatos) - guia no 142', 'Cosmetics - 520 - 463\r'),
('10464', 'Activo jojoba scrubeads blue berry 40/60 - guia no 625', 'Cosmetics - 582 - 464\r'),
('10465', 'Activo isopent y laiol', 'Cosmetics - 418 - 465\r'),
('10466', 'Fragancia men 900172 - guia no90', 'Cosmetics - 468 - 466\r'),
('10467', 'Fragancia nocturno - guia no81', 'Cosmetics - 365 - 467\r'),
('10468', 'Fragancia actual - guia no78', 'Cosmetics - 650 - 468\r'),
('10469', 'Fragancia extremo - guia no82', 'Cosmetics - 424 - 469\r'),
('10470', 'Activo opacificante blanco tilamar op 40 - guia no 600', 'Cosmetics - 382 - 470\r'),
('10471', 'Activo lamesoft tm benz', 'Cosmetics - 180 - 471\r'),
('10472', 'Activo isopentidiol (i.p.d) - guia no 642', 'Cosmetics - 543 - 472\r'),
('10473', 'Extracto de moringa pura - guia no 358', 'Cosmetics - 290 - 473\r'),
('10474', 'Fragancia bergamota - guia no14', 'Cosmetics - 266 - 474\r'),
('10475', 'Fragancia wild scarlet (mix frutal) - guia no44', 'Cosmetics - 225 - 475\r'),
('10476', 'Fragancia base lavander flower 2473 - guia no15', 'Cosmetics - 174 - 476\r'),
('10477', 'Fragancia verbenyl - guia no80', 'Cosmetics - 577 - 477\r'),
('10478', 'Activo arlypon tt basf', 'Cosmetics - 565 - 478\r'),
('10479', 'Fragancia chicle - guia no4', 'Cosmetics - 620 - 479\r'),
('10481', 'Activo seriliss - guia no 630', 'Cosmetics - 609 - 481\r'),
('10482', 'Activo colorex hcr15', 'Cosmetics - 608 - 482\r'),
('10483', 'Activo polvo decolorante azul - guia no 641', 'Cosmetics - 543 - 483\r'),
('10484', 'Activo aceite de arroz - guia no 516', 'Cosmetics - 413 - 484\r'),
('10485', 'Activo structure xl - guia no 638', 'Cosmetics - 386 - 485\r'),
('10487', 'Fragancia maracuya frutal - guia no 101', 'Cosmetics - 307 - 487\r'),
('10488', 'Activo tween 20', 'Cosmetics - 566 - 488\r'),
('10489', 'Aceite de hidro cannabis - guia no 511', 'Cosmetics - 324 - 489\r'),
('10490', 'Fragancia passion queen - guia no12', 'Cosmetics - 304 - 490\r'),
('10491', 'Fragancia escol.white mountains - guia no74', 'Cosmetics - 361 - 491\r'),
('10492', 'Fragancia more love - guia no2', 'Cosmetics - 461 - 492\r'),
('10493', 'Extracto leche de soya - guia no 326', 'Cosmetics - 445 - 493\r'),
('10494', 'Fragancia african ch f - guia no84', 'Cosmetics - 596 - 494\r'),
('10495', 'Fragancia 3525 ponant blue cosmetic - guia no85', 'Cosmetics - 501 - 495\r'),
('10496', 'Colorante negro brillante 300 %', 'Cosmetics - 569 - 496\r'),
('10497', 'Activo pmx frutal complex 4-p', 'Cosmetics - 555 - 497\r'),
('10498', 'Activo pmx restauration 10-p - guia no 309', 'Cosmetics - 116 - 498\r'),
('10499', 'Colorante covarine black ws 9199', 'Cosmetics - 591 - 499\r'),
('10500', 'Colorante funky fusion black shadow', 'Cosmetics - 596 - 500\r'),
('10501', 'Activo leche ref fld042 (fragancia cosmetica ) - guia no24   ', 'Cosmetics - 382 - 501\r'),
('10502', 'Preservante fenoxietanol', 'Cosmetics - 279 - 502\r'),
('10503', 'Proteina hidrolizada de leche', 'Cosmetics - 593 - 503\r'),
('10504', 'Extracto de ajo - guia no 338', 'Cosmetics - 258 - 504\r'),
('10505', 'Exfoliante micro red 5025 - guia no 800', 'Cosmetics - 261 - 505\r'),
('10506', 'Fragancia secret kiss - guia no', 'Cosmetics - 213 - 506\r'),
('10507', 'Activo dry flo pc - guia no 637 ', 'Cosmetics - 176 - 507\r'),
('10508', 'Activo mackpro klp - guia no 626', 'Cosmetics - 106 - 508\r'),
('10509', 'Activo acido sulfonico lineal - guia no 886', 'Cosmetics - 389 - 509\r'),
('10510', 'Arbutina liquida - fusion skin ligth - guia no 624', 'Cosmetics - 325 - 510\r'),
('10511', 'Activo balance rcfg - guia no 647', 'Cosmetics - 145 - 511\r'),
('10512', 'Fragancia base karite y cacao clave 3470 - guia no18', 'Cosmetics - 563 - 512\r'),
('10513', 'Glycoenergizer hair - guia no 616', 'Cosmetics - 461 - 513\r'),
('10514', 'Fragancia uchuva - dragon fruit - guia no27', 'Cosmetics - 254 - 514\r'),
('10515', 'Fragancia banano - pear banana - guia no63', 'Cosmetics - 233 - 515\r'),
('10516', 'Activo hilurlip', 'Cosmetics - 542 - 516\r'),
('10517', 'Activo naturepep amarant - guia no 628', 'Cosmetics - 143 - 517\r'),
('10518', 'Activo rice tein - guia no 627', 'Cosmetics - 323 - 518\r'),
('10519', 'Fragancia champan cava - guia no86', 'Cosmetics - 649 - 519\r'),
('10520', 'Colorante funfky fusion esmeralt green', 'Cosmetics - 371 - 520\r'),
('10521', 'Fragancia vainilla cookies - 2016143-0 - guia no 94', 'Cosmetics - 642 - 521\r'),
('10522', 'Fragancia blau mm - guia no 93', 'Cosmetics - 199 - 522\r'),
('10523', 'Fragancia doscarol mm - guia no 92', 'Cosmetics - 135 - 523\r'),
('10524', 'Aminoacido de soja x 5 kg - guia no 340', 'Cosmetics - 158 - 524\r'),
('10525', 'Activo reparage crecimiento - guia no 615', 'Cosmetics - 349 - 525\r'),
('10526', 'Sterilex dt', 'Cosmetics - 132 - 526\r'),
('10527', 'Fragancia vainilla creme - cod fcb-42260 - guia no29', 'Cosmetics - 614 - 527\r'),
('10528', 'Fragancia vainilla tahiti - cod fcb-40803 - guia no68', 'Cosmetics - 134 - 528\r'),
('10529', 'Aceite de camelia - guia no 509', 'Cosmetics - 446 - 529\r'),
('10530', 'Aceite esencia de lavanda - guia no 504', 'Cosmetics - 428 - 530\r'),
('10531', 'Aceite esencia de geranio - guia no 510', 'Cosmetics - 334 - 531\r'),
('10532', 'Activo timiron super sheen mp 1001 (ref 180001)', 'Cosmetics - 285 - 532\r'),
('10533', 'Exfopumise 300 (piedra pomex)', 'Cosmetics - 500 - 533\r'),
('10534', 'Blend basico novavit - guia no 113', 'Cosmetics - 280 - 534\r'),
('10535', 'Polvo pigmento perlado incanto gold - guia no 720', 'Cosmetics - 344 - 535\r'),
('10536', 'Acido clorhidrico', 'Cosmetics - 574 - 536\r'),
('10537', 'Fragancia coast red-ii - 685983 - guia no87', 'Cosmetics - 196 - 537\r'),
('10538', 'Activo acecare 30 kc - guia no 645', 'Cosmetics - 499 - 538\r'),
('10539', 'Fragancia dragibus negro (olor bom bom bum) -guia no 96', 'Cosmetics - 310 - 539\r'),
('10540', 'Fragancia ralf - guia no37', 'Cosmetics - 359 - 540\r'),
('10541', 'Extracto de quina - guia no 359', 'Cosmetics - 128 - 541\r'),
('10542', 'Fragancia blueligth - 2004737-d7 - guia no 34', 'Cosmetics - 266 - 542\r'),
('10543', 'Fragancia bomb - 2001823 - guia no 35', 'Cosmetics - 282 - 543\r'),
('10544', 'Fragancia secret kiss - 2013255-d7 - guia no89', 'Cosmetics - 265 - 544\r'),
('10545', 'Fragancia seduccion pure - 2015913 - guia no36', 'Cosmetics - 205 - 545\r'),
('10546', 'Fragancia coco passion - 2015912 - guia no38', 'Cosmetics - 139 - 546\r'),
('10547', 'Fragancia fresh & clean - 2022658 - guia no 33', 'Cosmetics - 227 - 547\r'),
('10548', 'Fragancia love spell - 2015929 - guia no 32', 'Cosmetics - 274 - 548\r'),
('10549', 'Fragancia breezy wild - 2022657 - guia no39', 'Cosmetics - 371 - 549\r'),
('10550', 'Fragancia manzana verde - 978741px1 - guia no 91', 'Cosmetics - 404 - 550\r'),
('10551', 'Fragancia platano gl505291 - guia no 107', 'Cosmetics - 453 - 551\r'),
('10552', 'Blend 1 - blend basico sh - mawie', 'Cosmetics - 105 - 552\r'),
('10553', 'Blend 2 - blend basico tratamiento - mawie', 'Cosmetics - 626 - 553\r'),
('10554', 'Blend 3 - blend basico fragancia - mawie', 'Cosmetics - 464 - 554\r'),
('10555', 'Sympeptide x slash', 'Cosmetics - 627 - 555\r'),
('10556', 'Cegaba liquido 10%', 'Cosmetics - 338 - 556\r'),
('10557', 'Peptilash - guia no 315', 'Cosmetics - 210 - 557\r'),
('10558', 'Glicosan - 2 - guia no 314', 'Cosmetics - 204 - 558\r'),
('10559', 'Iselux slc - guia no 908', 'Cosmetics - 398 - 559\r'),
('10560', 'Blend 5 - blend basico preservante - mawie', 'Cosmetics - 651 - 560\r'),
('10561', 'Hidroqueratina natural - guia no 643', 'Cosmetics - 417 - 561\r'),
('10562', 'Fragancia mango temptation - guia no 104', 'Cosmetics - 304 - 562\r'),
('10563', 'Fragancia creamy coconut - guia no 103', 'Cosmetics - 171 - 563\r'),
('10564', 'Adyfiline (voluminizador de senos y cola)', 'Cosmetics - 240 - 564\r'),
('10565', 'Fision aquashield (regulador osmotico capiar / control frizz) - guia no 635', 'Cosmetics - 375 - 565\r'),
('10566', 'Fragancia honestidad 120800 - guia no 114', 'Cosmetics - 397 - 566\r'),
('10567', 'Fragancia honestidad -#2 - 84372 - guia no 119', 'Cosmetics - 171 - 567\r'),
('10568', 'Fragancia respeto 261352/eb - guia no 111', 'Cosmetics - 562 - 568\r'),
('10569', 'Fragancia respeto - #2 - 268007/d - guia no 116', 'Cosmetics - 192 - 569\r'),
('10570', 'Fragancia perdon 120768 - guia no 115', 'Cosmetics - 458 - 570\r'),
('10571', 'Fragancia perdon -#2 - 120853 - guia no 102', 'Cosmetics - 324 - 571\r'),
('10572', 'Fragancia amor 120714 - guia no 113', 'Cosmetics - 647 - 572\r'),
('10573', 'Fragancia amor - #2 - 120769 - guia no 118', 'Cosmetics - 371 - 573\r'),
('10574', 'Fragancia valentia 120733 - guia no', 'Cosmetics - 130 - 574\r'),
('10575', 'Fragancia valentia - #2 - 453785 - guia no', 'Cosmetics - 330 - 575\r'),
('10576', 'Fragancia tolerancia 190864/b - guia no 112', 'Cosmetics - 594 - 576\r'),
('10577', 'Fragancia tolerancia -#2-120713 - guia no 117', 'Cosmetics - 525 - 577\r'),
('10578', 'Solvente propilen carbonato - guia no 634', 'Cosmetics - 193 - 578\r'),
('10579', 'Acido lactico al 88% h.s usp', 'Cosmetics - 190 - 579\r'),
('10580', 'Reniquoat', 'Cosmetics - 218 - 580\r'),
('10581', 'Colorante amarillo (amarillo huevo rojo)', 'Cosmetics - 156 - 581\r'),
('10582', 'Fragancia bossy life-2014614-d5 - guia no 87 ', 'Cosmetics - 176 - 582\r'),
('10583', 'Fragancia telma girl-2025616-d5 - guia no 110', 'Cosmetics - 523 - 583\r'),
('10584', 'Fragancia flower girl px1 - tommy girl - guia no 43', 'Cosmetics - 606 - 584\r'),
('10585', 'Fragancia chocodrile challenge - 2000306-d7 - guia no 106', 'Cosmetics - 506 - 585\r'),
('10586', 'Fragancia salva casual - 2031809-d7 - guia no 105', 'Cosmetics - 200 - 586\r'),
('10587', 'Blend 4 - blend f d orange - mawie', 'Cosmetics - 219 - 587\r'),
('10588', 'Blend 7 - blend basico ceto - mawie', 'Cosmetics - 191 - 588\r'),
('10589', 'Blend 8 - blend basico citrico - mawie', 'Cosmetics - 601 - 589\r'),
('10590', 'Blend 9 - blend basico color - mawie', 'Cosmetics - 259 - 590\r'),
('10591', 'Blend 10 - blend basico activo - mawie', 'Cosmetics - 365 - 591\r'),
('10592', 'Blend 11 - blend basico karicia - mawie', 'Cosmetics - 528 - 592\r'),
('10593', 'Blend 12 - blend basico karicia 1 - mawie', 'Cosmetics - 612 - 593\r'),
('10594', 'Blend 13 - blend basico minoxidil - mawie', 'Cosmetics - 264 - 594\r'),
('10595', 'Blend 14 - blend basico emergencia - mawie', 'Cosmetics - 604 - 595\r'),
('10596', 'Blend 15 - blend basico activo - mawie', 'Cosmetics - 481 - 596\r'),
('10597', 'Blend 16 - blend basico magia - mawie', 'Cosmetics - 251 - 597\r'),
('10598', 'Blend 17 - blend basico keratina - mawie', 'Cosmetics - 250 - 598\r'),
('10599', 'Blend 18 - blend basico junior teen - mawie', 'Cosmetics - 540 - 599\r'),
('10600', 'Blend 19 - blend basico transparente - mawie', 'Cosmetics - 596 - 600\r'),
('10601', 'Blend 20 - blend salvar - mawie', 'Cosmetics - 181 - 601\r'),
('10602', 'Blend 21 - blend salvar - mawie', 'Cosmetics - 368 - 602\r'),
('10603', 'Timiron diamons cluster mp 149 - guia no 705 ', 'Cosmetics - 553 - 603\r'),
('10604', 'Peg-40 aceite de castor', 'Cosmetics - 564 - 604\r'),
('10605', 'Cutina ags-manthoe', 'Cosmetics - 249 - 605\r'),
('10606', 'Cutina gms v-manthoe', 'Cosmetics - 434 - 606\r'),
('10607', 'Fragancia fibra extrema clave 2060 - guia no 102', 'Cosmetics - 604 - 607\r'),
('10608', 'Aceite esencial de menta - guia no 515', 'Cosmetics - 210 - 608\r'),
('10609', 'Base teflex 101 - guia no', 'Cosmetics - 519 - 609\r'),
('10610', 'Fragancia coco ligth (color rojo) - guia no 122', 'Cosmetics - 618 - 610\r'),
('10611', 'Aceite de girasol - guia no 503', 'Cosmetics - 629 - 611\r'),
('10612', 'Blend 24 - blend fragancia banano mix', 'Cosmetics - 351 - 612\r'),
('10613', 'Extracto de quinua - waliwex quinua', 'Cosmetics - 354 - 613\r'),
('10614', 'Soda caustica liquida al 50%', 'Cosmetics - 127 - 614\r'),
('10615', 'Fragancia base cute pet (linea veterinaria) - guia no56', 'Cosmetics - 144 - 615\r'),
('10616', 'Fragancia base adorable pet (linea veterinaria) - guia no56', 'Cosmetics - 492 - 616\r'),
('10617', 'Ir 3535 - insect repellent (linea mixtavet / hum) - guia no', 'Cosmetics - 187 - 617\r'),
('10618', 'Fragancia coco playero gh  (c?digo:  973150) - guia no 109', 'Cosmetics - 630 - 618\r'),
('10619', 'Fragancia coco costero gh ( c?digo: 973162)  - guia no 108', 'Cosmetics - 440 - 619\r'),
('10620', 'Activo sensoveil soft - guia no', 'Cosmetics - 416 - 620\r'),
('10621', 'Activo procondition 22 - guia no', 'Cosmetics - 260 - 621\r'),
('10622', 'Activo uniquat 37 - guia no', 'Cosmetics - 545 - 622\r'),
('10623', 'Fision ecosil', 'Cosmetics - 473 - 623\r'),
('10624', 'Quinoa pro ex hydrolyzed', 'Cosmetics - 362 - 624\r'),
('10625', 'Granactive aa 30', 'Cosmetics - 537 - 625\r'),
('10626', 'Capilmax - guia no 650', 'Cosmetics - 599 - 626\r'),
('10627', 'Colageno - guia no 728', 'Cosmetics - 423 - 627\r'),
('10628', 'Fragancia brisa marina - guia no', 'Cosmetics - 212 - 628\r'),
('10629', 'Activo biosure a03 - preservante ni?os - guia no', 'Cosmetics - 533 - 629\r'),
('10630', 'Versagel mp 1600 - guia no', 'Cosmetics - 315 - 630\r'),
('10631', 'Acripol t210 - guia no', 'Cosmetics - 461 - 631\r'),
('10632', 'Espesante teflex 301 - guia no', 'Cosmetics - 593 - 632\r'),
('10633', 'Blend 25 - blend minoxidil', 'Cosmetics - 290 - 633\r'),
('10634', 'Flocare et 76', 'Cosmetics - 550 - 634\r'),
('10635', 'Sterilex a', 'Cosmetics - 454 - 635\r'),
('10636', 'Sterilex b', 'Cosmetics - 487 - 636\r'),
('10637', 'Zinc sebum liquido ', 'Cosmetics - 415 - 637\r'),
('10638', 'Blend 26 - blend splash', 'Cosmetics - 130 - 638\r'),
('10639', 'Blend 7.1 - blend cmix', 'Cosmetics - 123 - 639\r'),
('10640', 'Activo hebeatol plus - guia no', 'Cosmetics - 459 - 640\r'),
('10641', 'Blend 27 - base crema de manos - mawie', 'Cosmetics - 639 - 641\r'),
('10642', 'Blend 23 - vibes', 'Cosmetics - 321 - 642\r'),
('10643', 'Acido retinoico - guia no', 'Cosmetics - 418 - 643\r'),
('10644', 'Blend 28 - blend basico activo tratamiento - mascarilla - mawie', 'Cosmetics - 137 - 644\r'),
('10645', 'Blend 29 - blend basico activo shampoo - mawie', 'Cosmetics - 519 - 645\r'),
('10646', 'Blend 30 - blend basico activo tratamiento frutas - mawie', 'Cosmetics - 391 - 646\r'),
('10647', 'Blend 31 - blend basico activo tonicos / lociones - mawie', 'Cosmetics - 117 - 647\r'),
('10648', 'Blend 32 - blend basico activo repolarizador - mawie', 'Cosmetics - 561 - 648\r'),
('10649', 'Blend 33 - blend basico activo jabon liquido - mawie', 'Cosmetics - 189 - 649\r'),
('10650', 'Blend 34 - blend basico extracto de lim?n - mawie', 'Cosmetics - 105 - 650\r'),
('10651', 'Blend 35 - blend alcohol 70% - mawie', 'Cosmetics - 302 - 651\r'),
('10652', 'Blend 2-1 - blend basico tratamiento (ecosil) - mawie', 'Cosmetics - 376 - 652\r'),
('10653', 'Aceite mano de res - oleo', 'Cosmetics - 500 - 653\r'),
('10654', 'Quarzo 30 - 50', 'Cosmetics - 255 - 654\r'),
('10655', 'Fentacare 1631 - 30 / genamin ctca 30', 'Cosmetics - 500 - 655\r'),
('10656', 'Colorante black 2 - wsg45', 'Cosmetics - 533 - 656\r'),
('10657', 'Aceite esencial de naranja - guia no', 'Cosmetics - 567 - 657\r'),
('10658', 'Aceite esencial de limon', 'Cosmetics - 336 - 658\r'),
('10659', 'Aceite de marula - guia no', 'Cosmetics - 633 - 659\r'),
('10660', 'Fragancia arru-ru - guia no', 'Cosmetics - 648 - 660\r'),
('10661', 'Microesferas de marula - guia no', 'Cosmetics - 566 - 661\r'),
('10662', 'Aceite semilla de uva - guia no', 'Cosmetics - 589 - 662\r'),
('10663', 'Manteca de mango - guia no', 'Cosmetics - 457 - 663\r'),
('10664', 'Natura lip - guia no', 'Cosmetics - 110 - 664\r'),
('10665', 'Natura bbb - guia no', 'Cosmetics - 650 - 665\r'),
('10666', 'Manteca de cacao - guia no', 'Cosmetics - 586 - 666\r'),
('10667', 'Aceite esencia de limoncillo - guia no', 'Cosmetics - 524 - 667\r'),
('10668', 'Manteca de murumuru - guia no', 'Cosmetics - 291 - 668\r'),
('10669', 'Liposil black - guia no', 'Cosmetics - 363 - 669\r'),
('10670', 'Extracto de maltict - guia no', 'Cosmetics - 455 - 670\r'),
('10671', 'Fragancia watermelon - guia no', 'Cosmetics - 440 - 671\r'),
('10672', 'Fragancia tea water - guia no', 'Cosmetics - 474 - 672\r'),
('10673', 'Fragancia pi?a fresca - guia no', 'Cosmetics - 431 - 673\r'),
('10674', 'Fragancia rose oriental - guia no', 'Cosmetics - 603 - 674\r'),
('10675', 'Fragancia fresa - guia no', 'Cosmetics - 407 - 675\r'),
('10676', 'Fragancia manzana kiwi - guia no', 'Cosmetics - 514 - 676\r'),
('10677', 'Alcohol isopropilico - guia n', 'Cosmetics - 648 - 677\r'),
('10678', 'Blend 28 - blend basico bio - mawie', 'Cosmetics - 222 - 678\r'),
('10679', 'Fragancia green te - guia no', 'Cosmetics - 186 - 679\r'),
('10680', 'Fragancia eau de roses - guia no', 'Cosmetics - 385 - 680\r'),
('10681', 'Glitter poly hm silver 0.008 - guia no', 'Cosmetics - 480 - 681\r'),
('10682', 'Glitter holograma hm silver 0.004 - guia no', 'Cosmetics - 438 - 682\r'),
('10683', 'Glitter hearts homologram hm silver 1/8 - guia no', 'Cosmetics - 557 - 683\r'),
('10684', 'Fragancia indiana jones - guia no', 'Cosmetics - 243 - 684\r'),
('10685', 'Hento white af - guia no', 'Cosmetics - 128 - 685\r'),
('10686', 'Tercil cp arcilla morada      ', 'Cosmetics - 210 - 686\r'),
('10687', 'Tercil cb arcilla negra      ', 'Cosmetics - 160 - 687\r'),
('10688', 'Tercil cocoa brown clay     ', 'Cosmetics - 463 - 688\r'),
('10689', 'Kaolin   ', 'Cosmetics - 569 - 689\r'),
('10690', 'Cosyellow arcilla amarilla    ', 'Cosmetics - 397 - 690\r'),
('10691', 'Charcoal polvo   ', 'Cosmetics - 280 - 691\r'),
('10692', 'Aceite esencial de hierbabuena', 'Cosmetics - 108 - 692\r'),
('10693', 'Aceite esencial de citronela', 'Cosmetics - 646 - 693\r'),
('10694', 'Aceite esencial de canela', 'Cosmetics - 391 - 694\r'),
('10695', 'Aceite esencial lemongrass', 'Cosmetics - 329 - 695\r'),
('10696', 'Fragancia eau de rosas px1', 'Cosmetics - 639 - 696\r'),
('10697', 'Acetato de calcio usp', 'Cosmetics - 543 - 697\r'),
('10698', 'Sulfato de aluminio usp', 'Cosmetics - 159 - 698\r'),
('10699', 'Extracto de agua de rosas - guia no', 'Cosmetics - 200 - 699\r'),
('10700', 'Extracto de manzanilla - guia no', 'Cosmetics - 331 - 700\r'),
('10701', 'Flocare et 1537g', 'Cosmetics - 593 - 701\r'),
('10702', 'Cutina ags', 'Cosmetics - 460 - 702\r'),
('10703', 'Xinysemi lapis blue', 'Cosmetics - 532 - 703\r'),
('10704', 'Fragancia sabor a pi?a colada', 'Cosmetics - 187 - 704\r'),
('10705', 'Fragancia sabor a vainilla lactea', 'Cosmetics - 474 - 705\r'),
('10706', 'Fragancia pasion oriental', 'Cosmetics - 598 - 706\r'),
('10707', 'Fragancia pi?a colada', 'Cosmetics - 555 - 707\r'),
('10708', 'Activo lamesoft po 65 - guia no', 'Cosmetics - 439 - 708\r'),
('10709', 'Aceite de coco - guia no', 'Cosmetics - 201 - 709\r'),
('10710', 'Blend 29 - blend suavizante - mawie', 'Cosmetics - 299 - 710\r'),
('10711', 'Extracto de quinua - polvo', 'Cosmetics - 300 - 711\r'),
('10712', 'Oxinex st liquido - guia no', 'Cosmetics - 583 - 712\r'),
('10713', 'Tono 1 - samara no1 pressed foundation ct-1264', 'Cosmetics - 297 - 713\r'),
('10714', 'Tono 2 - samara no2 pressed foundation ct-1265', 'Cosmetics - 356 - 714\r'),
('10715', 'Tono 3 - samara no3 pressed foundation ct-xxxx', 'Cosmetics - 159 - 715\r'),
('10716', 'Tono 4 - samara no4 pressed foundation ct-1263', 'Cosmetics - 293 - 716\r'),
('10717', 'Tono 5 - samara no5 77812009 kinda 000922', 'Cosmetics - 128 - 717\r'),
('10718', 'Fragancia vainilla lance m', 'Cosmetics - 538 - 718\r'),
('10719', 'Vitamina c nanovector', 'Cosmetics - 241 - 719\r'),
('10720', 'Fragancia galleta cremosa', 'Cosmetics - 272 - 720\r'),
('10721', 'Fragancia mandarina', 'Cosmetics - 541 - 721\r'),
('10722', 'Fragancia sabor vainilla - raco 07917', 'Cosmetics - 282 - 722\r'),
('10723', 'Fragancia sabor blue berry - raco 07802', 'Cosmetics - 254 - 723\r'),
('10724', 'Aceite de coco - guia n?', 'Cosmetics - 638 - 724\r'),
('10725', 'Aceite de kahai - guia n?', 'Cosmetics - 356 - 725\r'),
('10726', 'Poliplant de fruta - guia no', 'Cosmetics - 405 - 726\r'),
('10727', 'Guarana semilla polvo - guia no', 'Cosmetics - 113 - 727\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id` int(11) NOT NULL,
  `modulo` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id`, `modulo`) VALUES
(6, 'ACONDICIONAMIENTO'),
(4, 'APROBACION'),
(11, 'CONTROL DE FIRMAS VALIDACION'),
(8, 'CONTROL FISICO'),
(1, 'CREACION BATCH RECORD'),
(9, 'DESPACHOS'),
(5, 'ENVASADO'),
(10, 'LIBERACION LOTE'),
(7, 'LIBERACION PRODUCTO TERMINADO'),
(2, 'PESAJE'),
(3, 'PREPARACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo_area_desinfeccion`
--

CREATE TABLE `modulo_area_desinfeccion` (
  `id` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo_pregunta`
--

CREATE TABLE `modulo_pregunta` (
  `id` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `resp` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `id_modulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `modulo_pregunta`
--

INSERT INTO `modulo_pregunta` (`id`, `id_pregunta`, `resp`, `id_modulo`) VALUES
(1, 1, '0', 2),
(2, 2, '1', 2),
(3, 3, '0', 2),
(4, 4, '1', 2),
(5, 5, '1', 2),
(6, 6, '0', 3),
(7, 7, '1', 3),
(8, 8, '0', 3),
(9, 9, '1', 3),
(10, 10, '1', 3),
(11, 11, '0', 3),
(12, 12, '1', 3),
(13, 13, '1', 3),
(14, 14, '1', 5),
(15, 15, '0', 5),
(16, 16, '0', 5),
(17, 17, '0', 5),
(18, 18, '1', 5),
(19, 19, '1', 5),
(20, 20, '1', 6),
(21, 21, '0', 6),
(22, 22, '1', 6),
(23, 23, '0', 6),
(24, 24, '1', 6),
(25, 25, '1', 6),
(26, 26, '1', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multipresentacion`
--

CREATE TABLE `multipresentacion` (
  `id` int(11) NOT NULL,
  `id_batch` int(11) NOT NULL,
  `referencia` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `multipresentacion`
--

INSERT INTO `multipresentacion` (`id`, `id_batch`, `referencia`, `cantidad`, `total`) VALUES
(10, 3, '20006', 2000, 0),
(11, 3, '20019', 100, 0),
(12, 9, '20020', 500, 39),
(13, 9, '20018', 500, 223),
(14, 9, '20019', 340, 338);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombre_producto`
--

CREATE TABLE `nombre_producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nombre_producto`
--

INSERT INTO `nombre_producto` (`id`, `nombre`) VALUES
(1, 'ACEITE BRONCEADOR\r'),
(2, 'ACEITE DE MORINGA\r'),
(3, 'ACEITE NUTRITIVO\r'),
(4, 'ACONDICIONADOR CAPILAR\r'),
(5, 'AUTOBRONCEADOR CREMA\r'),
(6, 'BALSAMO DE CALENDULA\r'),
(7, 'BEARD OIL\r'),
(8, 'BEAUTYL OIL\r'),
(9, 'BIO ALISADO CAPILAR REPARADOR\r'),
(10, 'BIOELIXIR CAPILAR\r'),
(11, 'BIO-REPOLARIZADOR CAPILAR\r'),
(12, 'BODY FRAGANCE\r'),
(13, 'CASTA?O DE INDIAS CREMA TONIFICADORA DE '),
(14, 'CASTA?O DE INDIAS GEL TONIFICADORA DE PI'),
(15, 'CERA MOLDEADORA Y FIJADORA \r'),
(16, 'COCKTAIL CAPILAR\r'),
(17, 'CREMA BRONCEADORA\r'),
(18, 'CREMA CORPORAL\r'),
(19, 'CREMA PARA PEINAR\r'),
(20, 'DRY SHAMPOO\r'),
(21, 'ESPUMA LIMPIADORA Y DESMAQUILLANTE\r'),
(22, 'ESTIMULADOR CAPILAR\r'),
(23, 'EYE & LIP PERFECTOR\r'),
(24, 'FILTRO PANTALLA SOLAR EN GEL \r'),
(25, 'GEL ANTIBACTERIAL\r'),
(26, 'GEL CONDUCTORA Y REDUCTORA\r'),
(27, 'GEL DE CALENDULA\r'),
(28, 'GEL DUCHA/SHOWER GEL\r'),
(29, 'GEL EXFOLIANTE\r'),
(30, 'GEL REDUCTOR - REAFIRMANTE\r'),
(31, 'GOTAS MAGICAS CAPILARES\r'),
(32, 'HIDRATANTE CORPORAL\r'),
(33, 'HIDRATANTE LABIAL\r'),
(34, 'JABON ARTESANAL GLICERINADO\r'),
(35, 'JABON DE DUCHA CORPORAL\r'),
(36, 'JABON FACIAL ANTIOXIDANTE\r'),
(37, 'JAB?N L?QUIDO ANTIBACTERIAL\r'),
(38, 'LOCION ACLARANTE\r'),
(39, 'LOCI?N CAPILAR\r'),
(40, 'LOCION DE PEINAR  / LACA\r'),
(41, 'LOCI?N HIDRATANTE CON DESTELLOS\r'),
(42, 'LOCION TOPICA PARA PIES\r'),
(43, 'MASCARILLA CAPILAR\r'),
(44, 'PERFUME PARA EL CABELLO\r'),
(45, 'POLVO DECOLORANTE / BLEACHING POWDER\r'),
(46, 'REGENERADOR DE ANTIESTRIAS\r'),
(47, 'REPOLARIZADOR CAPILAR\r'),
(48, 'ROSE IN A SERUM\r'),
(49, 'SERUM DE RENACIMIENTO CAPILAR\r'),
(50, 'SERUM REGENERADOR CELULAR FACIAL\r'),
(51, 'SHAMPOO\r'),
(52, 'SHAMPOO EN BARRA\r'),
(53, 'SPLASH\r'),
(54, 'SPRAY AUTOBRONCEADOR\r'),
(55, 'SUERO FACIAL DULCE BELLEZA\r'),
(56, 'TONICO CAPILAR\r'),
(57, 'TRATAMIENTO ALISADO PROGRESIVO\r'),
(58, 'TRATAMIENTO CAPILAR\r'),
(59, 'TRATAMIENTO CAPILAR COLOR\r'),
(60, 'TRATAMIENTO REPOLARIZADOR\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion_sanitaria`
--

CREATE TABLE `notificacion_sanitaria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `vencimiento` varchar(11) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `notificacion_sanitaria`
--

INSERT INTO `notificacion_sanitaria` (`id`, `nombre`, `vencimiento`) VALUES
(491, 'NSOC40042-10CO', '2021-01-31'),
(492, 'NSOC13020-04CO', '8/08/2021\r'),
(493, 'NSOC47139-12CO', '16/03/2022\r'),
(494, 'NSOC69424-15CO', '25/11/2022\r'),
(495, 'NSOC75893-16CO', '9/12/2023\r'),
(496, 'NSOC64857-15CO', '25/03/2022\r'),
(497, 'NSOC71985-16CO', '10/05/2023\r'),
(498, 'NSOC64859-15CO', '25/03/2022\r'),
(499, 'NSOC49420-12CO', '30/07/2022\r'),
(500, 'NSOC64858-15CO', '25/03/2022\r'),
(501, 'NSOC49418-12CO', '30/07/2022\r'),
(502, 'NSOC69422-15CO', '25/11/2022\r'),
(503, 'NSOC62247-14CO', '30/10/2021\r'),
(504, 'NSOC64194-15CO', '17/02/2022\r'),
(505, 'NSOC69423-15CO', '25/11/2022\r'),
(506, 'NSOC48102-12CO', '17/05/2022\r'),
(507, 'NSOC65639-15CO', '14/05/2022\r'),
(508, 'NSOC74608-16CO', '7/10/2023\r'),
(509, 'NSOC77777-17CO', '17/03/2024\r'),
(510, 'NSOC65148-15CO', '13/04/2022\r'),
(511, 'NSOC78811-17CO', '10/05/2024\r'),
(512, 'NSOC52828-13CO', '2/04/2023\r'),
(513, 'NSOC78812-17CO', '10/05/2024\r'),
(514, 'NSOC60775-14CO', '1/08/2021\r'),
(515, 'NSOC78813-17CO', '10/05/2024\r'),
(516, 'NSOC49972-12CO', '31/08/2022\r'),
(517, 'NSOC64115-15CO', '16/02/2022\r'),
(518, 'NSOC63842-15CO', '3/02/2022\r'),
(519, 'NSOC64510-15CO', '2/03/2022\r'),
(520, 'NSOC64114-15CO', '16/02/2022\r'),
(521, 'NSOC58102-14CO', '11/03/2021\r'),
(522, 'NSOC63371-14CO', '19/12/2021\r'),
(523, 'NSOC63481-14CO', '19/12/2021\r'),
(524, 'NSOC57616-14CO', '5/02/2021\r'),
(525, 'NSOC63484-14CO', '19/12/2021\r'),
(526, 'NSOC41343-11CO', '2/03/2021\r'),
(527, 'NSOC63482-14CO', '19/12/2021\r'),
(528, 'NSOC56175-13CO', '5/11/2020\r'),
(529, 'NSOC63479-14CO', '19/12/2021\r'),
(530, 'NSOC65640-15CO', '15/05/2022\r'),
(531, 'NSOC63385-14CO', '19/12/2021\r'),
(532, 'NSOC65638-15CO', '14/05/2022\r'),
(533, 'NSOC63387-14CO', '19/12/2021\r'),
(534, 'NSOC63382-14CO', '19/12/2021\r'),
(535, 'NSOC94848-19CO', '2/08/2026\r'),
(536, 'NSOC63381-14CO', '19/12/2021\r'),
(537, 'NSOC85068-18CO', '23/04/2025\r'),
(538, 'NSOC63379-14CO', '19/12/2021\r'),
(539, 'NSOC63476-14CO', '19/12/2021\r'),
(540, 'NSOC57341-13CO', '20/12/2020\r'),
(541, 'NSOC63389-14CO', '19/12/2021\r'),
(542, 'NSOC57093-13CO', '13/12/2020\r'),
(543, 'NSOC63386-14CO', '19/12/2021\r'),
(544, 'NSOC75889-16CO', '9/12/2023\r'),
(545, 'NSOC63376-14CO', '19/12/2021\r'),
(546, 'NSOC77038-17CO', '8/02/2024\r'),
(547, 'NSOC63378-14CO', '19/12/2021\r'),
(548, 'NSOC77045-17CO', '8/02/2024\r'),
(549, 'NSOC63384-14CO', '19/12/2021\r'),
(550, 'NSOC78202-17CO', '6/04/2024\r'),
(551, 'NSOC63485-14CO', '19/12/2021\r'),
(552, 'NSOC78203-17CO', '6/04/2024\r'),
(553, 'NSOC78209-17CO', '6/04/2024\r'),
(554, 'NSOC63441-14CO', '20/12/2021\r'),
(555, 'NSOC81247-17CO', '15/09/2024\r'),
(556, 'NSOC63458-14CO', '19/12/2021\r'),
(557, 'NSOC81896-17CO', '20/10/2024\r'),
(558, 'NSOC63380-14CO', '19/12/2021\r'),
(559, 'NSOC82727-17CO', '30/11/2024\r'),
(560, 'NSOC63454-14CO', '19/12/2021\r'),
(561, 'NSOC82576-17CO', '24/11/2024\r'),
(562, 'NSOC63383-14CO', '19/12/2021\r'),
(563, 'NSOC82725-17CO', '2/12/2024\r'),
(564, 'NSOC63477-14CO', '19/12/2021\r'),
(565, 'NSOC82571-17CO', '24/11/2024\r'),
(566, 'NSOC63478-14CO', '19/12/2021\r'),
(567, 'NSOC85066-18CO', '23/04/2025\r'),
(568, 'NSOC63375-14CO', '19/12/2021\r'),
(569, 'NSOC89731-18CO', '13/12/2025\r'),
(570, 'NSOC63462-14CO', '19/12/2021\r'),
(571, 'NSOC54540-13CO', '26/07/2023\r'),
(572, 'NSOC63460-14CO', '19/12/2021\r'),
(573, 'NSOC80513-17CO', '8/11/2024\r'),
(574, 'NSOC63453-14CO', '19/12/2021\r'),
(575, 'NSOC86869-18CO', '30/07/2025\r'),
(576, 'NSOC63472-14CO', '19/12/2021\r'),
(577, 'NSOC75182-16CO', '8/11/2023\r'),
(578, 'NSOC63459-14CO', '19/12/2021\r'),
(579, 'NSOC61442-14CO', '9/09/2021\r'),
(580, 'NSOC63372-14CO', '19/12/2021\r'),
(581, 'NSOC44851-11CO', '21/10/2021\r'),
(582, 'NSOC63483-14CO', '19/12/2021\r'),
(583, 'NSOC63846-15CO', '3/02/2022\r'),
(584, 'NSOC63456-14CO', '19/12/2021\r'),
(585, 'NSOC62021-14CO', '21/10/2021\r'),
(586, 'NSOC63442-14CO', '19/12/2021\r'),
(587, 'NSOC74293-16CO', '23/09/2023\r'),
(588, 'NSOC63466-14CO', '19/12/2021\r'),
(589, 'NSOC75891-16CO', '9/12/2023\r'),
(590, 'NSOC02148-20CO', '9/10/2027\r'),
(591, 'NSOC02149-20CO', '9/10/2027\r'),
(592, 'NSOC86270-18CO', '26/06/2025\r'),
(593, 'NSOC01429-20CO', '11/09/2027\r'),
(594, 'NSOC58034-14CO', '5/03/2021\r'),
(595, 'NSOC65872-15CO', '28/05/2022\r'),
(596, 'NSOC65871-15CO', '28/05/2022\r'),
(597, 'NSOC70011-15CO', '17/12/2022\r'),
(598, 'NSOC71690-16CO', '21/04/2023\r'),
(599, 'NSOC84270-18CO', '8/03/2025\r'),
(600, 'NSOC01316-20CO', '7/09/2027\r'),
(601, 'NSOC01144-20CO', '31/08/2027\r'),
(602, 'NSOC01323-20CO', '7/09/2027\r'),
(603, 'NSOC61441-14CO', '9/09/2021\r'),
(604, 'NSOC61727-14CO', '30/09/2021\r'),
(605, 'NSOC67159-15CO', '19/08/2022\r'),
(606, 'NSOC61728-14CO', '30/09/2021\r'),
(607, 'NSOC64193-15CO', '17/02/2022\r'),
(608, 'NSOC67161-15CO', '9/09/2021\r'),
(609, 'NSOC67654-15CO', '7/09/2022\r'),
(610, 'NSOC75737-16CO', '30/11/2023\r'),
(611, 'NSOC75697-16CO', '30/11/2023\r'),
(612, 'NSOC75702-16CO', '30/11/2023\r'),
(613, 'NSOC75688-16CO', '30/11/2023\r'),
(614, 'NSOC88745-18CO', '23/10/2025\r'),
(615, 'NSOC86366-18CO', '3/07/2025\r'),
(616, 'NSOC67044-15CO', '12/08/2022\r'),
(617, 'NSOC41751-11CO', '25/03/2021\r'),
(618, 'NSOC47136-12CO', '15/03/2022\r'),
(619, 'NSOC52254-13CO', '14/02/2023\r'),
(620, 'NSOC61439-14CO', '9/09/2021\r'),
(621, 'NSOC56730-13CO', '20/11/2027\r'),
(622, 'NSOC79946-17CO', '14/07/2024\r'),
(623, 'NSOC91327-19CO', '5/03/2026\r'),
(624, 'NSOC57290-13CO', '19/12/2020\r'),
(625, 'NSOC57289-13CO', '19/12/2020\r'),
(626, 'NSOC64150-15CO', '16/02/2022\r'),
(627, 'NSOC43158-11CO', '30/06/2021\r'),
(628, 'NSOC38184-10CO', '4/08/2020\r'),
(629, 'NSOC33609-09C', '10/06/2026\r'),
(630, 'NSOC45237-11CO', '10/11/2021\r'),
(631, 'NSOC61611-14CO', '22/09/2021\r'),
(632, 'NSOC65817-15CO', '26/05/2022\r'),
(633, 'NSOC55009-13CO', '23/08/2023\r'),
(634, 'NSOC56711-13CO', '27/11/2020\r'),
(635, 'NSOC56712-13CO', '27/11/2020\r'),
(636, 'NSOC56713-13CO', '27/11/2020\r'),
(637, 'NSOC66117-15CO', '12/06/2022\r'),
(638, 'NSOC66118-15CO', '12/06/2022\r'),
(639, 'NSOC41749-11CO', '25/03/2021\r'),
(640, 'NSOC68097-15CO', '24/09/2022\r'),
(641, 'NSOC63843-15CO', '3/02/2022\r'),
(642, 'NSOC00036-20CO', '16/06/2027\r'),
(643, 'NSOC00138-20CO', '1/07/2027\r'),
(644, 'NSOC38345-10CO', '17/08/2020\r'),
(645, 'NSOC38348-10CO', '17/08/2020\r'),
(646, 'NSOC77444-17CO', '24/02/2024\r'),
(647, 'NSOC66718-15CO', '23/07/2022\r'),
(648, 'NSOC67091-15CO', '14/08/2022\r'),
(649, 'NSOC67094-15CO', '14/08/2022\r'),
(650, 'NSOC67117-15CO', '14/08/2022\r'),
(651, 'NSOC69401-15CO', '24/11/2022\r'),
(652, 'NSOC69411-15CO', '24/11/2022\r'),
(653, 'NSOC69412-15CO', '24/11/2022\r'),
(654, 'NSOC73671-16CO', '18/08/2023\r'),
(655, 'NSOC76146-16CO', '15/12/2023\r'),
(656, 'NSOC78206-17CO', '6/04/2024\r'),
(657, 'NSOC78195-17CO', '6/04/2024\r'),
(658, 'NSOC78211-17CO', '6/04/2024\r'),
(659, 'NSOC74294-16CO', '23/09/2023\r'),
(660, 'NSOC78210-17CO', '6/04/2024\r'),
(661, 'NSOC81246-17CO', '15/09/2024\r'),
(662, 'NSOC81248-17CO', '15/09/2024\r'),
(663, 'NSOC85065-18CO', '23/04/2025\r'),
(664, 'NSOC81930-17CO', '20/10/2024\r'),
(665, 'NSOC91062-19CO', '21/02/2026\r'),
(666, 'NSOC91225-19CO', '1/03/2026\r'),
(667, 'NSOC81947-17CO', '20/10/2024\r'),
(668, 'NSOC83662-18CO', '1/02/2025\r'),
(669, 'NSOC81897-17CO', '20/10/2024\r'),
(670, 'NSOC82283-17CO', '9/11/2024\r'),
(671, 'NSOC82346-17CO', '14/11/2024\r'),
(672, 'NSOC40750-11CO', '1/02/2021\r'),
(673, 'NSOC84085-18CO', '28/02/2025\r'),
(674, 'NSOC84227-18CO', '6/03/2025\r'),
(675, 'NSOC84229-18CO', '6/03/2025\r'),
(676, 'NSOC96552-19CO', '23/10/2026\r'),
(677, 'NSOC84878-18CO', '13/04/2025\r'),
(678, 'NSOC84880-18CO', '13/04/2025\r'),
(679, 'NSOC84917-18CO', '17/04/2025\r'),
(680, 'NSOC84876-18CO', '13/04/2025\r'),
(681, 'NSOC73946-16CO', '2/09/2023\r'),
(682, 'NSOC73947-16CO', '2/09/2023\r'),
(683, 'NSOC85247-18CO', '30/04/2025\r'),
(684, 'NSOC88772-18CO', '24/10/2025\r'),
(685, 'NSOC97585-19CO', '5/12/2026\r'),
(686, 'NSOC80507-17CO', '11/08/2024\r'),
(687, 'NSOC80523-17CO', '11/08/2024\r'),
(688, 'NSOC88746-18CO', '23/10/2025\r'),
(689, 'NSOC80512-17CO', '11/08/2024\r'),
(690, 'NSOC80509-17CO', '1/08/2024\r'),
(691, 'NSOC01594-20CO', '09/17/2027\r'),
(692, 'NSOC85067-18CO', '23/04/2025\r'),
(693, 'NSOC86870-18CO', '30/07/2025\r'),
(694, 'NSOC89127-18CO', '14/11/2025\r'),
(695, 'NSOC01523-20CO', '15/09/2027\r'),
(696, 'NSOC87033-18CO', '9/08/2025\r'),
(697, 'NSOC87034-18CO', '9/08/2025\r'),
(698, 'NSOC94716-19CO', '29/07/2026\r'),
(699, 'NSOC87974-18CO', '19/09/2025\r'),
(700, 'NSOC89730-18CO', '13/12/2025\r'),
(701, 'NSOC89729-18CO', '13/12/2025\r'),
(702, 'NSOC91061-19CO', '21/02/2026\r'),
(703, 'NSOC93256-19CO', '31/05/2026\r'),
(704, 'NSOC00519-20CO', '24/07/2027\r'),
(705, 'NSOC00479-20CO', '23/07/2027\r'),
(706, 'NSOC93031-19CO', '21/05/2026\r'),
(707, 'NSOC96914-19CO', '8/11/2026\r'),
(708, 'NSOC93332-19CO', '6/06/2026\r'),
(709, 'NSOC95369-19CO', '27/08/2026\r'),
(710, 'NSOC00193-20CO', '10/07/2027\r'),
(711, 'NSOC00609-20CO', '28/07/2027\r'),
(712, 'NSOC00659-20CO', '31/07/2027\r'),
(713, 'NSOC95814-19CO', '17/09/2026\r'),
(714, 'NSOC96122-19CO', '30/09/2026\r'),
(715, 'NSOC50591-12CO', '12/10/2022\r'),
(716, 'NSOC98522-20CO', '7/02/2027\r'),
(717, 'NSOC01907-20CO', '30/09/2027\r'),
(718, 'NSOC91203-19CO', '28/02/2026\r'),
(719, 'NSOC97899-19CO', '19/12/2026\r'),
(720, 'NSOC97778-19CO', '19/12/2026\r'),
(721, 'NSOC97898-19CO', '19/12/2026\r'),
(722, 'NSOC97601-19CO', '6/12/2026\r'),
(723, 'NSOC97182-19CO', '20/11/2026\r'),
(724, 'NSOC96556-19CO', '23/10/2026\r'),
(725, 'NSOC97356-19CO', '25/11/2026\r'),
(726, 'NSOC97318-19CO', '25/11/2026\r'),
(727, 'NSOC97309-19CO', '25/11/2026\r'),
(728, 'NSOC89376-18CO', '23/11/2025\r'),
(729, 'NSOC89375-18CO', '23/11/2025\r'),
(730, 'NSOC89377-18CO', '23/11/2025\r'),
(731, 'NSOC43760-11CO', '9/08/2021\r'),
(732, 'NSOC71402-16CO', '1/04/2023\r'),
(733, 'NSOC68107-15CO', '25/09/2022\r'),
(734, 'NSOC68108-15CO', '25/09/2022\r'),
(735, 'NSOC71980-16CO', '10/05/2023\r'),
(736, 'NSOC72582-16CO', '9/06/2023\r'),
(737, 'NSOC71981-16CO', '10/05/2023\r'),
(738, 'NSOC73952-16CO', '2/09/2023\r'),
(739, 'NSOC73951-16CO', '2/09/2023\r'),
(740, 'NSOC85580-18CO', '17/05/2025\r'),
(741, 'NSOC98524-20CO', '7/02/2027\r'),
(742, 'NSOC93396-19CO', '10/06/2026\r'),
(743, 'NSOC82346-17CO', '14/11/2024\r'),
(744, 'NSOC70017-15CO', '17/12/2022\r'),
(745, 'NSOC56777-13CO', '29/11/2020\r'),
(746, 'NSOC51491-12CO', '12/12/2022\r'),
(747, 'NSOC42502-11CO', '13/05/2021\r'),
(748, 'NSOC51460-12CO', '12/12/2022\r'),
(749, 'NSOC42503-11CO', '13/05/2021\r'),
(750, 'NSOC51396-12CO', '7/12/2022\r'),
(751, 'NSOC70019-15CO', '17/12/2022\r'),
(752, 'NSOC70015-15CO', '17/12/2022\r'),
(753, 'NSOC70014-15CO', '17/12/2022\r'),
(754, 'NSOC70013-15CO', '17/12/2022\r'),
(755, 'NSOC70020-15CO', '17/12/2022\r'),
(756, 'NSOC56037-13CO', '25/10/2020\r'),
(757, 'NSOC54527-13CO', '26/07/2023\r'),
(758, 'NSOC56964-13CO', '11/12/2020\r'),
(759, 'NSOC56966-13CO', '11/12/2020\r'),
(760, 'NSOC14487-05CO', '13/01/2022\r'),
(761, 'NSOC38151-10CO', '30/07/2020\r'),
(762, 'NSOC60612-14CO', '23/07/2021\r'),
(763, 'NSOC37027-10C', '1/07/2020\r'),
(764, 'NSOC40042-10CO', '24/11/2020\r'),
(765, 'NSOC13020-04CO', '8/08/2021\r'),
(766, 'NSOC47139-12CO', '16/03/2022\r'),
(767, 'NSOC75893-16CO', '9/12/2023\r'),
(768, 'NSOC71985-16CO', '10/05/2023\r'),
(769, 'NSOC49420-12CO', '30/07/2022\r'),
(770, 'NSOC49418-12CO', '30/07/2022\r'),
(771, 'NSOC62247-14CO', '30/10/2021\r'),
(772, 'NSOC64194-15CO', '17/02/2022\r'),
(773, 'NSOC48102-12CO', '17/05/2022\r'),
(774, 'NSOC74608-16CO', '7/10/2023\r'),
(775, 'NSOC77777-17CO', '17/03/2024\r'),
(776, 'NSOC78811-17CO', '10/05/2024\r'),
(777, 'NSOC78812-17CO', '10/05/2024\r'),
(778, 'NSOC78813-17CO', '10/05/2024\r'),
(779, 'NSOC64115-15CO', '16/02/2022\r'),
(780, 'NSOC64510-15CO', '2/03/2022\r'),
(781, 'NSOC64114-15CO', '16/02/2022\r'),
(782, 'NSOC63371-14CO', '19/12/2021\r'),
(783, 'NSOC63481-14CO', '19/12/2021\r'),
(784, 'NSOC63484-14CO', '19/12/2021\r'),
(785, 'NSOC63482-14CO', '19/12/2021\r'),
(786, 'NSOC63479-14CO', '19/12/2021\r'),
(787, 'NSOC63385-14CO', '19/12/2021\r'),
(788, 'NSOC63387-14CO', '19/12/2021\r'),
(789, 'NSOC63382-14CO', '19/12/2021\r'),
(790, 'NSOC63381-14CO', '19/12/2021\r'),
(791, 'NSOC63379-14CO', '19/12/2021\r'),
(792, 'NSOC63476-14CO', '19/12/2021\r'),
(793, 'NSOC63389-14CO', '19/12/2021\r'),
(794, 'NSOC63386-14CO', '19/12/2021\r'),
(795, 'NSOC63376-14CO', '19/12/2021\r'),
(796, 'NSOC63378-14CO', '19/12/2021\r'),
(797, 'NSOC63384-14CO', '19/12/2021\r'),
(798, 'NSOC63485-14CO', '19/12/2021\r'),
(799, 'NSOC63441-14CO', '20/12/2021\r'),
(800, 'NSOC63458-14CO', '19/12/2021\r'),
(801, 'NSOC63380-14CO', '19/12/2021\r'),
(802, 'NSOC63454-14CO', '19/12/2021\r'),
(803, 'NSOC63383-14CO', '19/12/2021\r'),
(804, 'NSOC63477-14CO', '19/12/2021\r'),
(805, 'NSOC63478-14CO', '19/12/2021\r'),
(806, 'NSOC63375-14CO', '19/12/2021\r'),
(807, 'NSOC63462-14CO', '19/12/2021\r'),
(808, 'NSOC63460-14CO', '19/12/2021\r'),
(809, 'NSOC63453-14CO', '19/12/2021\r'),
(810, 'NSOC63472-14CO', '19/12/2021\r'),
(811, 'NSOC63459-14CO', '19/12/2021\r'),
(812, 'NSOC63372-14CO', '19/12/2021\r'),
(813, 'NSOC63483-14CO', '19/12/2021\r'),
(814, 'NSOC63456-14CO', '19/12/2021\r'),
(815, 'NSOC63442-14CO', '19/12/2021\r'),
(816, 'NSOC63466-14CO', '19/12/2021\r'),
(817, 'NSOC02148-20CO', '9/10/2027\r'),
(818, 'NSOC02149-20CO', '9/10/2027\r'),
(819, 'NSOC01429-20CO', '11/09/2027\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones`
--

CREATE TABLE `observaciones` (
  `id` int(11) NOT NULL,
  `observaciones` text COLLATE utf8_spanish_ci NOT NULL,
  `id_batch` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_desinfectante`
--

CREATE TABLE `observaciones_desinfectante` (
  `id` int(11) NOT NULL,
  `observaciones` text COLLATE utf8_spanish_ci NOT NULL,
  `id_desinfectante` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `olor`
--

CREATE TABLE `olor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `olor`
--

INSERT INTO `olor` (`id`, `nombre`) VALUES
(1, 'OLOR\r'),
(2, 'CARACTER?STICO.\r'),
(3, 'CARACTER?STICO A COCO, IGUAL AL EST?NDAR.\r'),
(4, 'CARACTER?STICO A LA FRAGANCIA.\r'),
(5, 'CARACTER?STICO AL EST?NDAR.\r'),
(6, 'CARACTER?STICO AL EST?NDAR, CON ADICI?N DE FRAGANCIA.\r'),
(7, 'CARACTER?STICO AL EST?NDAR, CON ADICI?N DE SABOR.\r'),
(8, 'CARACTER?STICO, SEG?N EL GRUPO COSM?TICO.\r'),
(9, 'C?TRICO.\r'),
(10, 'CON O SIN OLOR.\r'),
(11, 'CONFORME AL EST?NDAR.\r'),
(12, 'CONFORME AL EST?NDAR, CON ADICI?N DE FRAGANCIA.\r'),
(13, 'CONFORME AL EST?NDAR CON ADICI?N DE FRAGANCIA SEG?N EL GRUPO COSMETICO.\r'),
(14, 'CONFORME AL ESTANDAR, SEG?N EL GRUPO COSMETICO.\r'),
(15, 'INODORO (SIN OLOR)\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otros`
--

CREATE TABLE `otros` (
  `id` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `otros`
--

INSERT INTO `otros` (`id`, `nombre`) VALUES
('50364', 'SOBRE TAPA TRAS/BANDA ORO'),
('50421', 'CUCHARA EN MADERA - MAYONESA MAWIE'),
('50445', 'ETIQUETA - 20925 - TAPA MARGARINA GOURMET - MAWIE (450 ML)'),
('50621', 'TAPA CAPUCHON NEGRO ENV 60GR BIOELIXIR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `id` int(11) NOT NULL,
  `referencia` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ph`
--

CREATE TABLE `ph` (
  `id` int(11) NOT NULL,
  `limite_inferior` float NOT NULL,
  `limite_superior` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ph`
--

INSERT INTO `ph` (`id`, `limite_inferior`, `limite_superior`) VALUES
(1, 0, 0),
(2, 0, 0),
(3, 1, 2),
(4, 1, 4),
(5, 1.5, 2),
(6, 1.9, 2.5),
(7, 2, 4.5),
(8, 2, 4),
(9, 3, 5.5),
(10, 3.5, 5.5),
(11, 3.5, 5),
(12, 4, 5.5),
(13, 4, 6),
(14, 4, 7.5),
(15, 4, 5),
(16, 4.4, 6),
(17, 4.5, 6),
(18, 4.5, 6.5),
(19, 4.5, 7.5),
(20, 4.5, 7),
(21, 5, 7),
(22, 5, 6.5),
(23, 5, 7.5),
(24, 5, 6),
(25, 5.5, 6),
(26, 5, 8),
(27, 5.5, 7),
(28, 5.5, 6.5),
(29, 5.5, 7.5),
(30, 6, 7),
(31, 6, 7.5),
(32, 6, 0.95),
(33, 6.5, 7.5),
(34, 6.5, 8),
(35, 7, 8.5),
(36, 1.5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poder_espumoso`
--

CREATE TABLE `poder_espumoso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `poder_espumoso`
--

INSERT INTO `poder_espumoso` (`id`, `nombre`) VALUES
(1, 'GENERE ESPUMA'),
(3, 'NO APLICA'),
(2, 'NO GENERA ESPUMA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `pregunta`) VALUES
(1, 'Se encuentran el ?rea con materias primas, materiales, insumos y productos que no se requieren para la referencia y lote a fabricar?\r'),
(2, 'Est?n las ?reas, equipos y herramientas necesarios para el proceso de pesaje limpios y desinfectados?\r'),
(3, 'Los recipientes para empacar las materias primas pesadas, se encuentran sucios y sin desinfectar?\r'),
(4, 'El personal que participar? del proceso, porta el uniforme completo y limpio, de acuerdo con el instructivo i-sig-02?\r'),
(5, 'Est?n los procedimientos de pesaje, desinfecci?n de ?reas y equipos escritos y disponibles para consulta?\r'),
(6, 'Se encuentran el ?rea con materias primas, materiales, insumos y productos que no se requieren para la referencia y lote a fabricar?\r'),
(7, 'Est?n las ?reas, equipos y herramientas necesarios para el proceso de preparaci?n limpios y desinfectados?\r'),
(8, 'El personal que participar? del proceso, porta el uniforme incompleto y sucio, de acuerdo con el instructivo i-sig-02?\r'),
(9, 'Est?n los procedimientos escritos de preparaci?n, desinfecci?n de ?reas y equipos corresponde al producto a elaborar?\r'),
(10, 'Verificar si las cantidades de las materias primas corresponden a la orden, si se encuentran limpias, aprobadas por control calidad y rotuladas?\r'),
(11, 'Los recipientes que se utilizaran para mezclar y preparar el producto a fabrica, se encuentran sucios y sin desinfectar?\r'),
(12, 'El agua (fr?a y/o caliente) a utilizar en la manufactura del producto, cumple con las especificaciones definidas?\r'),
(13, 'En el  ?rea de preparaci?n disponen del patr?n est?ndar del producto a elaborar?\r'),
(14, 'Se encuentran el ?rea con materiales, insumos y productos que no se requieren para la referencia y lote a fabricar?\r'),
(15, 'Est?n las ?reas, equipos y herramientas necesarios para el proceso de envasado sucios y sin desinfectar?\r'),
(16, 'El personal que participar? del proceso, porta el uniforme incompleto y sucio, de acuerdo con el instructivo i-sig-02?\r'),
(17, 'No se encuentran los procedimientos escritos de preparaci?n, desinfecci?n de ?reas y equipos corresponde al producto a elaborar?\r'),
(18, 'Se dispone en el ?rea de los insumos debidamente aprobados y en el estado, cantidad necesaria para realizar cumplir con la orden de producci?n?\r'),
(19, 'El personal que participar? en el proceso conoce los par?metros de control de pesos para la referencia a trabajar?\r'),
(20, 'Se encuentran el ?rea libre de insumos y elementos que no se requieren para la referencia y lote a fabricar?\r'),
(21, 'Est?n las ?reas, equipos y herramientas necesarios para el proceso de acondicionamiento, loteado y/o etiquetado sucios y sin desinfectar?\r'),
(22, 'El personal que participar? del proceso, porta el uniforme completo y limpio, de acuerdo con el instrutivo i-sig-02?\r'),
(23, 'No se encuentran los procedimientos escritos de preparaci?n, desinfecci?n de ?reas y equipos corresponde al producto a elaborar?\r'),
(24, 'Se verific? si los insumos entregados corresponden a los requeridos para la referencia y presentaci?n?\r'),
(25, 'Se dispone en el ?rea de los insumos necesarios debidamente aprobados y en las cantidades necesarias para realizar cumplir con la orden de producci?n?\r'),
(26, 'El personal que participar? en el proceso conoce los par?metros y requistos de loteado y pegado de etiquetas para esta referencia?\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion_comercial`
--

CREATE TABLE `presentacion_comercial` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `presentacion_comercial`
--

INSERT INTO `presentacion_comercial` (`id`, `nombre`) VALUES
(1, '4,5\r'),
(2, '5\r'),
(3, '10\r'),
(4, '11\r'),
(5, '20\r'),
(6, '30\r'),
(7, '32\r'),
(8, '35\r'),
(9, '45\r'),
(10, '50\r'),
(11, '60\r'),
(12, '80\r'),
(13, '90\r'),
(14, '100\r'),
(15, '120\r'),
(16, '130\r'),
(17, '140\r'),
(18, '150\r'),
(19, '180\r'),
(20, '200\r'),
(21, '210\r'),
(22, '220\r'),
(23, '240\r'),
(24, '250\r'),
(25, '260\r'),
(26, '280\r'),
(27, '290\r'),
(28, '300\r'),
(29, '360\r'),
(30, '400\r'),
(31, '430\r'),
(32, '440\r'),
(33, '450\r'),
(34, '470\r'),
(35, '500\r'),
(36, '980\r'),
(37, '1000\r'),
(38, '3785\r'),
(39, '4000\r'),
(40, '20000\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `referencia` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_referencia` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `unidad_empaque` smallint(4) UNSIGNED NOT NULL,
  `id_nombre_producto` smallint(4) UNSIGNED NOT NULL,
  `id_notificacion_sanitaria` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `id_linea` tinyint(3) UNSIGNED NOT NULL,
  `id_marca` smallint(4) UNSIGNED NOT NULL,
  `id_propietario` smallint(4) UNSIGNED NOT NULL,
  `presentacion_comercial` int(4) UNSIGNED NOT NULL,
  `id_color` tinyint(3) UNSIGNED NOT NULL,
  `id_olor` tinyint(3) UNSIGNED NOT NULL,
  `id_apariencia` int(11) NOT NULL,
  `id_untuosidad` int(11) NOT NULL,
  `id_poder_espumoso` int(11) NOT NULL,
  `id_recuento_mesofilos` int(11) NOT NULL,
  `id_pseudomona` int(11) NOT NULL,
  `id_escherichia` int(11) NOT NULL,
  `id_staphylococcus` int(11) NOT NULL,
  `id_ph` int(11) NOT NULL,
  `id_viscosidad` int(11) NOT NULL,
  `id_densidad_gravedad` int(11) NOT NULL,
  `id_grado_alcohol` int(11) NOT NULL,
  `id_tapa` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `id_envase` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `id_etiqueta` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `id_empaque` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `id_otros` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `multi` int(10) NOT NULL,
  `base_instructivo` int(2) NOT NULL,
  `instructivo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`referencia`, `nombre_referencia`, `unidad_empaque`, `id_nombre_producto`, `id_notificacion_sanitaria`, `id_linea`, `id_marca`, `id_propietario`, `presentacion_comercial`, `id_color`, `id_olor`, `id_apariencia`, `id_untuosidad`, `id_poder_espumoso`, `id_recuento_mesofilos`, `id_pseudomona`, `id_escherichia`, `id_staphylococcus`, `id_ph`, `id_viscosidad`, `id_densidad_gravedad`, `id_grado_alcohol`, `id_tapa`, `id_envase`, `id_etiqueta`, `id_empaque`, `id_otros`, `multi`, `base_instructivo`, `instructivo`) VALUES
('20003', 'JABÓN BACTERICIDA MQ221 - POLICLEAN (1.000 ML)', 10, 43, '500', 2, 55, 42, 1000, 2, 15, 13, 2, 1, 1, 1, 1, 1, 15, 15, 17, 1, '50044', '50025', '50081', '50186', '50364', 0, 1, 0),
('20018', 'SHAMPOO NUTRICIÓN - MAWIE (450 ML)', 10, 51, '522', 2, 43, 46, 450, 9, 12, 5, 2, 1, 1, 1, 1, 1, 20, 35, 14, 1, '50100', '50024', '50089', '50279', '50421', 1, 0, 51),
('20019', 'SHAMPOO NUTRICIÓN - MAWIE (1000 ML)', 5, 51, '497', 2, 43, 46, 1000, 14, 9, 13, 2, 1, 1, 1, 1, 1, 16, 12, 17, 1, '50101', '50031', '50089', '50279', '50364', 1, 0, 51),
('20020', 'SHAMPOO NUTRICIÓN - MAWIE (80 ML)', 10, 51, '493', 2, 43, 46, 80, 1, 5, 5, 1, 1, 1, 1, 1, 1, 13, 16, 12, 1, '50102', '50029', '50112', '50269', '50421', 1, 0, 51);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietario`
--

CREATE TABLE `propietario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `propietario`
--

INSERT INTO `propietario` (`id`, `nombre`) VALUES
(1, 'A.c derma s.a.s\r'),
(2, 'Advance pro cosmeticos s.a.s\r'),
(3, 'Alejandro Montoya Solano'),
(4, 'Alejandra Aristizabal'),
(5, 'Alexandra Hernandez Restrepo'),
(6, 'Andrea Bolivar'),
(7, 'Andres Felipe Rodriguez'),
(8, 'Asubell s.a.s\r'),
(9, 'Blanca Gladys Cardona'),
(10, 'Cindy alvarez garcia\r'),
(11, 'Class gold hair /diego ruiz buitrago\r'),
(12, 'Comercial aplpha cosmetics\r'),
(13, 'Comercializadora natural sofi\r'),
(14, 'Cristina londo?o estrada\r'),
(15, 'Comercializadora pamt s.a.s\r'),
(16, 'Dacamdie\r'),
(17, 'Diana victoria ledesma\r'),
(18, 'Dimarele s.a.s\r'),
(19, 'Elizabeth zapata\r'),
(20, 'Estrella D\'mar By Juli Restrepo'),
(21, 'Filomena group s.a.s\r'),
(22, 'Glesismith ramos sotelo\r'),
(23, 'Insumos pab sas\r'),
(24, 'Inversiones segar sa\r'),
(25, 'Johana alejandra velez\r'),
(26, 'Juan felipe valladales\r'),
(27, 'Karen gutierrez b\r'),
(28, 'Laboratorios Farmacéuticos Villegas Montoya'),
(29, 'Laboratorios licol\r'),
(30, 'Laboratorios vitalite\r'),
(31, 'Laura lopera rios\r'),
(32, 'Liliam maestre\r'),
(33, 'Lina Marcela Zapata Muñoz'),
(34, 'Lucelida castro\r'),
(35, 'Lucia emilcen arias lopez\r'),
(36, 'M.v.h inversiones s.a.s\r'),
(37, 'Mario Enrique Galvis / D\'mag Cosmeticos Fenix'),
(38, 'Milagros enterprise group s.a.s\r'),
(39, 'Nelly botero\r'),
(40, 'Pablo emilio agudelo\r'),
(41, 'Permaliss s.a.s\r'),
(42, 'Poliquimicos s.a.s\r'),
(43, 'Prismatec ismail romero\r'),
(44, 'Ramiro de jesus arroyave roman\r'),
(45, 'Renato garces\r'),
(46, 'Samara cosmetics s.a.s\r'),
(47, 'Sara franco lopez\r'),
(48, 'Sergio antonio arnelaez toro\r'),
(49, 'Sharon sanabria\r'),
(50, 'Susana franco\r'),
(51, 'Susuna franco cuartas\r'),
(52, 'The insider vox s.a.s\r'),
(53, 'Variedades Y Publicidad S.a.s'),
(54, 'Wilber arturo zuluaga ramirez\r'),
(55, 'Yuli alejandra estrada\r'),
(56, 'Blanca cardona\r'),
(57, 'Sandra castano\r'),
(58, 'Luz mery arboleda\r'),
(59, 'Natalia rendon cardona\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pseudomona`
--

CREATE TABLE `pseudomona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pseudomona`
--

INSERT INTO `pseudomona` (`id`, `nombre`) VALUES
(1, 'AUSENCIA EN 1G O ML'),
(2, 'NO APLICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuento_mesofilos`
--

CREATE TABLE `recuento_mesofilos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `recuento_mesofilos`
--

INSERT INTO `recuento_mesofilos` (`id`, `nombre`) VALUES
(1, 'MAX.5X10(3) UFC/G O ML'),
(2, 'NO APLICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `staphylococcus`
--

CREATE TABLE `staphylococcus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `staphylococcus`
--

INSERT INTO `staphylococcus` (`id`, `nombre`) VALUES
(1, 'AUSENCIA EN 1G O ML'),
(2, 'NO APLICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tanques`
--

CREATE TABLE `tanques` (
  `id` int(11) NOT NULL,
  `capacidad` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tanques`
--

INSERT INTO `tanques` (`id`, `capacidad`) VALUES
(1, 30),
(2, 60),
(3, 100),
(4, 120),
(5, 150),
(6, 180),
(7, 200),
(8, 220),
(9, 240),
(10, 250),
(11, 300),
(12, 350),
(13, 450),
(14, 800),
(15, 1500),
(16, 2000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tapa`
--

CREATE TABLE `tapa` (
  `id` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tapa`
--

INSERT INTO `tapa` (`id`, `nombre`) VALUES
('50017', 'tapa pote fc (maides)\r'),
('50037', 'tapa disc-top (nacarada o perlado) cuello largo\r'),
('50038', 'tapa flip-top 11583 azul oscura\r'),
('50039', 'tapa flip-top 18/415 traslucido\r'),
('50040', 'tapa flip-top snap ovalada 24 mm-mostaza\r'),
('50041', 'tapa oval hotelero x 30 ml mostaza\r'),
('50042', 'tapa push pull 28/410 mm (azul perlado)\r'),
('50043', 'tapa push pull 28/410 mm (fucsia)\r'),
('50044', 'tapa push pull 28/410 mm (gris)\r'),
('50045', 'tapa push pull 24/410 (azul)\r'),
('50086', 'tapa pote convex2 onz pp bco c/l poly\r'),
('50087', 'tapa push pull 28/410 pco salmon perlado\r'),
('50091', 'tapa pote aloha naranja\r'),
('50098', 'tapa push pull 24/410 fucsia\r'),
('50099', 'tapa push pull 24/410 dorado\r'),
('50100', 'tapa push pull 28/410 mm uva\r'),
('50101', 'tapa push pull 28/410mm bronce\r'),
('50102', 'tapa push pull 28/410mm amarilla\r'),
('50103', 'tapa valvula para bolsa laminada flex up 7x16\r'),
('50106', 'tapa push pull 28/410mm verde\r'),
('50126', 'tapa disc-top blanco cuello largo\r'),
('50127', 'tapa push pull 28/410mm azul (crema de manos)\r'),
('50128', 'tapa shampoo hexagonal bronce (hair perfect)\r'),
('50129', 'tapa mascarilla (hair perfect)\r'),
('50130', 'tapa ambrosia (naturex)\r'),
('50136', 'tapa push pull transparente\r'),
('50142', 'tapa flip top azul oscura cuello corto\r'),
('50143', 'tapa disc top azul oscuro cuello largo\r'),
('50149', 'tapa envase cosmetico\r'),
('50151', 'tapa colapsible natural\r'),
('50153', 'tapa flip top ovalada verde\r'),
('50154', 'tapa flip top ovalada amarilla\r'),
('50159', 'tapa oval fucsia flip top\r'),
('50163', 'tapa pote aloha verde\r'),
('50200', 'tapa discap dorada-maides\r'),
('50214', 'tapa doy pack naranja\r'),
('50215', 'tapa push pull 24/410 blanca\r'),
('50217', 'tapa 22 flip top morada\r'),
('50219', 'tapa 28/410 disc top perla (nacarada) banda plata\r'),
('50222', 'tapa pote aloha perlada\r'),
('50241', 'tapa - 50014- disc top x 24/410 natural\r'),
('50244', 'tapa h perlino\r'),
('50271', 'tapa zp pin 5 mm blc ( tapa espumero)\r'),
('50292', 'tapa disc top x24-410 enco oro\r'),
('50293', 'tapa disc top x20-410 natural\r'),
('50310', 'tapa disc top x 28-410 negra pco banda plata\r'),
('50315', 'tapa flip-top ovalada x 24mm fucsia\r'),
('50316', 'tapa disc top x24-410 verde perlado\r'),
('50320', 'tapa lisa sp18/415 blanca\r'),
('50328', 'tapa rda rollon 47 d x 47 esferica negra\r'),
('50330', 'tapa rda rollon blanco\r'),
('50341', 'tapa pushpull 28/410 blanco\r'),
('50343', 'tapa pushpull 28/410 fucsia + blanco\r'),
('50346', 'tapa disctop 24/410 morado perlado\r'),
('50348', 'tapa flip-top 18/415 negro\r'),
('50368', 'tapa flip top ovalada x 24 azul perlado\r'),
('50377', 'tapa 28/410 disc top amarillo rojizo\r'),
('50378', 'tapa 28/410 disc top rojo\r'),
('50383', 'tapa advance azul\r'),
('50384', 'tapa advance fucsia\r'),
('50385', 'tapa advance amarilla oro\r'),
('50386', 'tapa 18/400 rosca sin liner\r'),
('50387', 'tapa 28/410 disc top blanca\r'),
('50388', 'tapa pushpull 28/410 amarillo pollo\r'),
('50389', 'tapa pushpull 28/410 (8h) rojo\r'),
('50406', 'tapa disc top fucsia 24/410\r'),
('50423', 'tapa 250/500 gr rect mercasid 50k - mawie - (500 ml)\r'),
('50426', 'tapa rosca plateada 24/410-(cerveza)\r'),
('50431', 'tapa flip-top 28/410 natural - coral\r'),
('50434', 'tapa rosca plateada 28/410-(leche)\r'),
('50507', 'tapa - envase ampolleta pet (10 ml)\r'),
('50509', 'tapa - envase cilidrico (16 ml)\r'),
('50511', 'tapa aplicadora - envase bala negro (120 ml) - t? capilar isabely\r'),
('50529', 'tapa flip top 58mm fucsia est franja 5mm plt\r'),
('50556', 'tapa pote blanco de 2 onzas - mawie\r'),
('50558', 'tapa pote blanco de 4 onzas - mawie\r'),
('50560', 'tapa flip top 58mm azul est franja 5mm plt\r'),
('50561', 'tapa flip top 58mm verde est franja 5mm plt\r'),
('50562', 'tapa flip top 58mm dorada est franja 5mm plt\r'),
('50568', 'tapa 24/410 disc top perlada\r'),
('50569', 'tapa 28/410 disc top morada perlada\r'),
('50571', 'tapa advance verde oliva\r'),
('50605', 'tapa disc top 24/410 cafe perlado\r'),
('50606', 'tapa disc top 24/410 dorado glitter\r'),
('50607', 'tapa aloha color gris\r'),
('50614', 'tapa 28/410 disc top salmon\r'),
('50621', 'tapa capuchon negro env 60gr bioelixir\r'),
('50624', 'tapa advance verde menta\r'),
('50625', 'tapa flip top 58mm negra franja plata\r'),
('50626', 'tapa negro azul con esfera\r'),
('50630', 'tapa redonda rollon 38 dx 38 h lisa gris\r'),
('50631', 'tapa flip top 58mm verde aguamarina\r'),
('50648', 'tapa pote aloha azul perlado\r'),
('50650', 'tapa lisa sp18/415 gris con liner\r'),
('50653', 'tapa lisa 18/415 oro\r'),
('50656', 'tapa flip top 20/410 traslucida\r'),
('50664', 'tapa blanca 28 mm clariderm\r'),
('50665', 'tapa glitter 0.32 onz natural\r'),
('50668', 'tapa flip top 58mm gris est franja 5mm plt\r'),
('50675', 'tapa 18 mm din blanca\r'),
('50698', 'tapa blanca gruesa mayonesa / chocolate\r'),
('50703', 'tapa flip-top snap ovalada 24 mm-roja\r'),
('50716', 'tapa pote x 100 ml color gris\r'),
('50728', 'tapa flip-top 28 mm - fuscia traslucida - mawizena\r'),
('50729', 'tapa flip-top 28 mm - azul oscuro traslucida - mawizena\r'),
('50756', 'tapa envase redondo (tipo brocha) estimulador capilar - isabely (10 ml)\r'),
('50766', 'tapa envase redondo + cep c0129 (tipo cepillo) estimulador capilar - isabely (10 ml)\r'),
('50767', 'tapa - 50014- disc top x 28/410 traslucida\r'),
('50797', 'tapa plastica 53 mm - fuscia claro\r'),
('50808', 'tapa 24/410 disc top blanca\r'),
('50812', 'tapa sin decoraci?n (mytpv) - p. decolorante - mawie - (500 ml)\r'),
('50847', 'tapa de base conica - helado gourmet - mawie (500 ml)\r'),
('C51004', 'tapa flip top negro (21301, 21303) - d-mag\r'),
('C51005', 'tapa flip top cafe (21319) - d-mag\r'),
('C51006', 'tapa flip top bronce (21259) - d-mag\r'),
('C51007', 'tapa flip top fucsia perlada (21300 , 21256) - d-mag\r'),
('C51008', 'tapa flip top dorado (21252, 21253) - d-mag\r'),
('C51009', 'tapa flip top rojo (21323) - d-mag\r'),
('C51010', 'tapa flip top azul rey (21324) - d-mag\r'),
('C51011', 'tapa flip top amarilla (21255, 21254) - d-mag\r'),
('C51012', 'tapa flip top verde lim?n (21320) - d-mag\r'),
('C51013', 'tapa flip top verde (21302) - d-mag\r'),
('C51014', 'tapa flip top morada (21307) - d-mag\r'),
('C51039', 'tapa flip top mostaza (21248, 21249) - d-mag\r'),
('C51040', 'tapa flip top fucsia (21248 , 21251) - d-mag\r'),
('C51042', 'tapa disc top dorado perlado cuello largo - (21101 - 21102) - renato garces\r'),
('C51043', 'tapa disc top blanco - (20981 - 220982) - renato garces\r'),
('C51047', 'tapa disc top dorado perlado cuello corto - (21176) - renato garces\r'),
('C51054', 'tapa disc top perlada 28/410 cuello largo - (20799 - 20811 - 20873 - 20875 - 20957 - 21326 - 20881) '),
('C51063', 'tapa push pull blanco (20788 - 20810 - 20872 - 20874 - 20958 - 21325 - 20880) - paradise\r'),
('C51073', 'tapa capuchon franja dorada - (20988) - paradise\r'),
('C51076', 'tapa blanca - (21006) - paradise\r'),
('C51078', 'envase airless blanco con bomba y sobre tapa - (50 ml) - (21265) inmaculada\r'),
('C51088', 'tapa flip top gris 28/410 (21260 - 21261 - 21263 - 21264) - inmaculada\r'),
('C51098', 'tapa disc top transl?cida cuello largo - (21232 - 21234) - lina alvarez\r'),
('C51099', 'tapa disc top transl?cida - (21327,21328) - lina alvarez\r'),
('C51100', 'bomba spray blanca con sobre tapa - (21235) - lina alvarez\r'),
('C51101', 'tapa disc top negra - (21233) - lina alvarez\r'),
('C51103', 'tapa boca ancha blanca (250 ml) - (20241) - lemonier\r'),
('C51106', 'tapa boca ancha azul (250 ml) - (20151) - lemonier\r'),
('C51109', 'envase blanco con gotero y tapa (35 ml) - (20205) - lemonier\r'),
('C51132', 'tapa flip top negra tulip (250 ml y 120 ml) - (20803, 20825, 20827, 20829, 20927, 20928, 20929, 2093'),
('C51137', 'tapa flip top negra tulip (45 ml) - (20864, 20866, 20869, 20870) - tulip\r'),
('C51153', 'bomba spray metalizada + tapa idunn - (20653) - idunn\r'),
('C51156', 'bomba spray metalizada + tapa idunn - (20654) - idunn\r'),
('C51159', 'tapa metalizada intidunn idunn - (20709) - idunn\r'),
('C51161', 'moldeador + tapa rosada lipocord idunn - (20670) - idunn\r'),
('C51163', 'tapa envase redondo (tipo brocha) estimulador (10 ml) - (21159) - the blis\r'),
('C51167', 'tapa flip top gris - (21278 - 21279 - 21280) - larimar\r'),
('C51172', 'tapa unity verde - (20619 - 20620) - karicia\r'),
('C51173', 'tapa unity morado - (20621 - 20627) - karicia\r'),
('C51174', 'tapa unity roja - (20626 - 20628 - 20945 - 20946) - karicia\r'),
('C51175', 'tapa unity verde limon - (20766 - 20767) - karicia\r'),
('C51176', 'tapa unity verde militar - (20768) - karicia\r'),
('C51189', 'tapa goterero negro - (20888 - 20965) - karicia\r'),
('C51190', 'tapa goterero rosado metalizado - (21026) - karicia\r'),
('C51195', 'bomba spray con tapa - (20783) - karicia\r'),
('C51198', 'tapa marula - (21242) - karicia\r'),
('C51201', 'tapa morada - (20349) - milagros\r'),
('C51204', 'tapa fucsia - (20938 - 21164) - milagros\r'),
('C51208', 'tapa verde limon milagros - (20715) - milagros\r'),
('C51211', 'tapa metalizada - (20919) - milagros\r'),
('C51215', 'tapa gotero verde - (21070 - 20968) - milagros\r'),
('C51217', 'tapa gotero morado - (20940) - milagros\r'),
('C51218', 'tapa gotero fucsia - (20944) - milagros\r'),
('C51220', 'tapa flip top fucsia (150 ml) - (21295) - milagros\r'),
('C51222', 'bomba spray negra con tapa - (21296) - milagros\r'),
('C51237', 'tapa perlada - 21274, 21275 - ada\r'),
('C51241', 'tapa negra - 21308, 21309 - celestial\r'),
('C51254', 'bomba spray rosada con tapa - 21340 - renato garces\r'),
('C51257', 'tapa rosada exfoliante con rostro (200 ml) - (21345) - idunn\r'),
('C51259', 'tapa azul exfoliante cuerpo (300 ml) - (21346) - idunn\r'),
('C51261', 'tapa gris mascarilla mature women (60 ml) - (21347) - idunn\r'),
('C51262', 'tapa negra mascarilla young women (60 ml) - (21348) - idunn\r'),
('C51264', 'tapa perlada maquillaje claro (220 ml) - (21349) - idunn\r'),
('C51265', 'tapa caf? maquillaje oscuro (220 ml) - (21350) - idunn\r'),
('C51269', 'tapa colapsible blanco - 21298 - sandra casta?o\r'),
('C51272', 'bomba spray blanco con tapa - 21299 - sandra casta?o\r'),
('C51275', 'tapa flip top negra vibes - (21131) - vibes\r'),
('C51279', 'tapa metalizada rosca vibes - (21027, 21257) - vibes\r'),
('C51282', 'tapa flip to blanca vibes - (21098) - vibes\r'),
('C51284', 'bomba aplicar dorada con tapa vibes - (21140) - vibes\r'),
('C51289', 'tapa translucida rosca vibes - (21258) - vibes\r'),
('C51291', 'tapa flip top transl?cido vibes - (21273) - vibes\r'),
('C51293', 'tapa rosca negra vibes - (21342, 21343) - vibes\r'),
('C51298', 'tapa caf? vibes - (21344) - vibes\r');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `untuosidad`
--

CREATE TABLE `untuosidad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `untuosidad`
--

INSERT INTO `untuosidad` (`id`, `nombre`) VALUES
(1, 'SUAVE AL TACTO'),
(2, 'GEL SUAVE, QUE ABSORBE Y FLUYE FACILMENT'),
(3, 'CREMA SUAVE, QUE ABSORBE Y FLUYE FACILME'),
(4, 'SUAVE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `firma` blob NOT NULL,
  `urlfirma` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `rol` int(5) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `email`, `user`, `clave`, `firma`, `urlfirma`, `rol`, `id_modulo`, `id_cargo`) VALUES
(1, 'Camilo', 'Restrepo cardona', 'camilo.restrepo@samaracosmetics.com', 'crestrepo', 'fa3367027246db000e7cd30d8e4e6615', 0xffd8ffe000104a46494600010101006000600000ffdb0043000302020302020303030304030304050805050404050a070706080c0a0c0c0b0a0b0b0d0e12100d0e110e0b0b1016101113141515150c0f171816141812141514ffdb00430103040405040509050509140d0b0d1414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414ffc0001108015402ab03012200021101031101ffc4001d000100020203010100000000000000000000010206070304050809ffc4004d100001030302030505050407060405050001000203040511062107123108134151611422718191153242a1b1162352c117728292d1e1f02425334362a2263483f10918445364455473c2e2ffc40014010100000000000000000000000000000000ffc40014110100000000000000000000000000000000ffda000c03010002110311003f00fd4e77ddf5c28dc81e4ae9b792086f4528a5a821158fc1550114354a0b78f4d957e0a5dd54170f140e6ebf041d026c7a22086f4573d1554ee8214b9423d0159dd14346cac8207452888088882ae0a5bd109c20e882a49f0194dcf518574404444157052de8a51011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110548c272ab28f1411f2523a29557203959719272a7250496f90520615559bd104ae373727fc972220a35aac06109c2676ca094545740444404444044440444415dca96f45288088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880a8e711d012aea394792037a792951d02940454738f82969282c88880888808888285c7d54872851cbe5b20b737450e76ea3c307aa823082cd77a29775556f8ab35054fc15dbd14395901111055c83f2565440574440444404444104e1434e5491940308251110111101111011141e882541e8a0755e0eb4d636dd09a7aaef37598c3494ece67728cb9c7c03478941ed4933618dd23dc18c68c9738e001e6560f74e3ae80b2d51a6add5d6982a03b94b3da038e7cb65f35d7d7f11fb56d4cf25ae39b4fe8c69e4672c9b49ea3c1eef3cfba3a0e856ccd2fd8b787b6db1b60bad0545dee3247cb2d54952f043bc4b434f283f920deb69bdd0dee863acb7d5c3594920cb6685fccd23f92ef309df2be27d53a0b53f640d4947aa74ddd2a2e9a1a49db0d650ce72608dc7eebb1b1db387f810bec8b05ee935259e8ee941289e8eae3134520f169ff58f920f4d11101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101141ca869282c8888088880888808888088880888838dcec7829ce5460eca5033e899f450e5280acde8a5101111011110140ea54a2022220222202222022220222202ab8e15955c328241ca950de8a50143ba295c6ff00fdf083a974b953d9e86a2b6ae66c14b4f1ba592471c06b40dcff00af35f2bb60afed69c4a92598cf0f0cecd28e46e79055c9b65be6493e3e03017bfc6fd4971e2e6bca4e15e9c95eca50e135eeb23fb91c637e424780fcc9f45bf348e97b6e8bd3d4366b4c0da7a0a58c32363475f371f324e493ea83bb6ab4d1d96862a2a2a486929616863218581ad681d000177b94792000741852831cd7da46935e691bb586b9ad7c15d03a1f79b9e571fbaef9100fc968dec61a92b63d337fd117690fda3a66b9d086b89e631927f2e607e457d24f1ffb2f99ed14add07db3eba1883a2a4d4b6befb97c1ef680491eb969fa941f4cb738dfaab2ab7eeab2022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220e36fdd0a514fc9046de2ac30a3af8291d104a83d14a20af32b2a96fa296f441288880888823214a8f1528088880888808888088880888808a8acde8807a2c0b8cfc488385fa12b6f0ffde553b1052423abe676cdf90ea7e0b3a73b7c657cd3ae5aee34f686b3e99639d369ed38d7555700018df20c65a7c37772b7e450657d9938632e8fd272ea2bbb4bf516a03ed754f9061f1c6497363fcf27e3e8b76b1b868c8556f4e831e1fc972202222087745f3871fa48f4ef1e38497d717440d4be8b99a3621c402dcfc1ebe905f3c76c7a710e9cd1d77e53feefd414e79da704071c11f90fa20fa159f77cbd3c9597142e6bd8d70e8e1cdf5dd72a022220222202222022220222202222022220222202222022220ab5e1c0107215951ad0dd80007900ae808888088880888808888088880888808888088880aa7a81fcd55c48e9febcd6bce27f123f67036c9686baaf5457465b4d0c639fb9e6cb5b23c0f5e83d0a0d87cdef633f00ac3aaf9b1bc1fd5da434257df6fdc41bb57ea2a369ad6ba3909863e50098f04ee3cfc3c96ffd315f25d74edaeb253cd2d452c52b9d8c64b980938f9a0f59111011110111101111071938529f9a86a0bede8a553725580c2094444044507a2095444c64a0ba2220283d14a20a0255d47c94a022220222202ab95910437a29444051d0295570ce0a0c438a9ade9f877a12efa827f78d2c27ba8fc5f21d9ad1ea4e3e8b5df652d115362d0d3ea3ba87bef5a8e735b3492b70fee8e4c60f8ef92efed2f13b413ddc4de24691e1a52b4c903a6170b8c8c764471b7c1df207e642fa229208e9e9e28a38c471c6de56340e8d1b0fc907337eeefd559474e8a5011110168ced8f183c189e7239bd96e14b381f07ff009ade6b4e76b4a77d47023519660ba2eea4c63ca46a0da161aa35b63b7d491ca66a78e4eb9eac057a6bc3d16f3268eb13cb794ba820247fe9b57b88088b8deee507fd7c907222d5fa9b8fba7b4c5dae16d9e0b954d5d0bf9656d3d364639412e049dc0cf5f42b3fb0de29b505a292e546f3252d546d96371f10420f45111011110111101111011110111101111011110111101111011110111101111011110111101111011155db0f1c7a20c6788bace9787fa3ae97eace57474911732371c778f3b35bf32405807003455c850d5eb6d501f26a8bf3bbd777ad03b8a738e48dadfc3b797861795c49a83c4de3469ed0ec0f96d169ff007a5d434e1ae7b778da7c3ae3af9adf11b5ad6800600d820c2b8c550ea5e19dfcc643659698c31f9973c86803e24aca2c547f66d968293af714f1c5f4680b0ae2bb7ed5aed2762df92bee6c965001398e1f7ce7d3a2d871b7946db20ba2220222202222022220a2b0185288236f44f051b9504f2f508247de50e716e7fc1617c4fe2ad9385b637d75d2a98d9dc08a7a5072f95fe0d006eb565aa3e26f19d8caf96ac690d3d50dcb20191339bd76c6f9dfc506e6bf6beb069a93bbb95e296965c6444e9473bbe016bfbbf697b051cc596fb7dc2ed1b4132490c780dc7c7aaefe9becff00a62ce44b7085d7dadc7ef2a2b4e438fc02d856db1dbad34ada6a2a1a6a481a30238620d6fe8835a583b4ce8abccb1c351593da2a24203595d096827c810b6ad354c5550b648656cac70cb5d1b83861787a874269fd510086e969a5ab6b4e5ae7460381f420642c26e1a2ee3c3a315c34d55d4496b80974d6d9497f233c4b7c481e2df98f141b65aacb1dd27aae8f54dbdb514ef2c79197c4efbcdf51e60f9ac81a76f5413e2a51101111011110154bb1f4cab2e19e46431bdf21e5635a4b9c7c0789fc906aae31f1ee9b85170b7db9968a9bedcaa9a66752d2b834b2307ae4f8ff0082f73859c60b0f166d53d55aa6745554aeeeeae867da581c3ae4797910b57f0b2c0fe29714751ebeab9a475b209c51d0331b39acddd8cf81f1f3caf238c9a70f01389b68e27e9d80d2d96b256d25fa8e99bfbbe539fde728d86df98f541f5237a6fd559746d174a5bc5b296be8a56cf49531b658a56f4735c320aee8e882579f7abac163b5565c6a9e23a6a589d33dee3b00d0495df3d168eed53a8e78f46d1e93b7bdc2e9a9aa5b44c6b3ef18c91cff000f0fcd0799d9aad13eaaba6a5e265d220daabdd4490d135c0e594cd7751e59c0fa2fa09be3b60fa85e368dd334ba3f4c5b6cb48d029e8a06c2ddf39206e7eb95edf4e882511101111016aded2d0f7fc12d54de4e7ff6769c6707efb7fd7c96d25ae7b4246e93837aa9ad1977b2ff00fd820c9740c8e9743e9e7bdbc8e75be9c969ea3f76d590af0b44f30d1b610e3977b053e4ff00e9b57ba82aff008e078ac2f89ba9e6b2582682dd3b1b7bab7329e922072fe779c0207c398e7c30bdfd477ca4d3367acba57ca21a3a589d2c8e271b0f2f5e807c56ade07415bae1d55c40bdb0b67b84b21b6d2b81c52c00f2e467f111b67e3e683adad74cd170d384171a68cf7979baf2d34957280e9259a43ef0f86c70b6b68bb37ecfe93b45b739752d2c7139de6e0d193f5cac1788713b51f13345e9f6b79a9e9df25cea9a402008c623cfc483f55b5075dd0591110111101111011110111101111011110111101111011110111101111011110111101111011110170c8e0c69738e1a012ef4185ccb10e2b5e8e9fe1cea4af69c3e1a194b4f4e571690d3f5c20d6fd9bdaed5377d73ade619fb52e8fa6a7c8ff931e06de99fd16f3c9002d73d9dacb1587837a6208e3313a5a5153273752f9097b8fe7f92cd351dea1d3f65aeb94eee58a9a2749f123a0f99d9061b4af76a5e32544a038d1e9fa3ee39838f2baa66f788c7a301fa85b19bd3a63758570a6d55343a4e3acb88ff007a5d647dc2ab2dc10e90e434ff0055bcadf4c2cdd0146473633bf921ca80d1cd9c6fe682c888808888088882ad5651d02af3faa09f9ac4389fafe9386da42b6f3540cce8c16c1037ef4b211eeb47f8f86165ce77ba7ebd70be6bb4dd2af8d7da1ab2463a49748e998df098f6314f29d8820f5dff0040839384bc26afe2557d3f10b8864d7d54c3bcb7db6520c5033390e2de9e2765f4746d6b5a03461b8c0c6c31e8a91c2d858c631bcad60e56803a0030b9b1807cd055df7ba2b37a7446ab208ebb1dd55db1cec0f9abaaf320d6bc46e5e1cda66d4f6c84f35248249a9e36ed2309f79a3c81c9f81dd665a4f5250eaed3d4379b6ccd9e8ab2312c6e6f867a823c083907e0bb776b653de6db5343571b65a6a9618a46380208231d0ad2dd97239ec147aaf4b54ca4bad7737be2613f7627e7031e1bb4941bddbd14a86f4528088880888820f45ad3b406aa7697e1c5718657475d5a5b474cd8ce1ee7bce36f1d867eab653b6dfc3c5682d7ed9b88bc78b1e9ea76b26a1d3d0fb7d5779bb3bdfc2d23d7641b3b855a459a1f40596d21b89a1803a638c66576effcc9fa2f5f56e9aa2d63a72e165b84625a3ae85d048d3e47fc0807e4bd86f4ca381c8c74f141f3c766fd555da5ef97be165fa77495d64797dbe670e5efe989c86b478e33d7e2be8661cb73d7e0be7aed2ba5ea74d5e2c3c54b345cf70b0ca19591b5bbcb4ce38276eb8c9fafa2de7a6af94ba9ac34175a195b351d642d9a2919d082107a0f7729f36e3277dd6808646711bb5549cd19968347d0e1ae232df697788f51cc7fbab79deebdb69b556563fee53c2f94fc1ad27f905a77b2c5b64aed2b79d5f5ac6bae3a8ae1354b9fcb83ddb5c4347d73b20de2dd959559f7559011110111101605c726b1fc26d50d7b5ae69a376438641dc2cf56bfe39f33b859a85ace52f306035c460fbc10647a25bc9a36c4d030050c000ffd36af6dc7701791a4dbdde97b4370016d2420f29dbee35776e35905b68ea2b2a5e23829e332c8f2766b5a0927e9941a438db5557c44d7760e1a5b647c74d30fb42f32b0ecd80670c27c092b765b2db05a2db4d43491b63a7a78db1c4c031ca00c05a5fb375a65d4953a8b88f716cc6b6fd52594bde0c06d2b0fb9ca3c0673f45b3788faa1ba3345dd6ea306586122167f1c8766b47c4941896840751716f585f84ad9e969638ad94ce68db6f79f83f1fd56d61d3ae5611c20d2eed29a128209985b5b53cd59545df78cb21e6393e8303e4b37e8104a2e17c819bb9dcade9b9015daef9a0ba281d14a022281d104a222022220222202222022220222ab8e10591625abf89da634208bedebd52db9d2383591cafcbc9ce3a05944323268d8f6383d8e68735de63c0a0e54444107a2e373c0763c719c7c179ba96f9069bb15c6eb520ba1a281f3b98d38710d04e07a9c607c57cb3a7753ea0ba32dfc62aa9aba9e89f7574135be425b1b28b3ca30dceff789cf9a0faedbd15975a8eae2aea78aa217892295a1ec78e8411907e8bb280aaecf8792b2f3ef55c2d96aacab3cbfecf03e6c38e07bad2773e03641a7b8ebc7ab9f0eab292d3a5ac336a4bccb97cfdd4124b1d33078b8337249f5d82f6381fc74a5e2e5a8b2aa8a5b2dfa1da7b7cd900e362f612012339f86170f671a89ae7c3a66a7b9c8d75c6f334b57513b8803979c86807f8474dfc9792cba5371138ef433e9f6779456385cdb8dc636f2b5eec90181df88e71f2ca0de8de9e6a5437246fb15280b5a768985d3706355b5b9ff00ca64e37380e04ede2b651e8bc2d65430dcb4adde96a2564114f492c4e9a4c06b399a464e7d7083cfe16d632bb871a66a213cd1bedd0e0b4e7a30058cdf6b9bc4cd6b069da2267b1d9e4151769d87dc9650331403c0ff0011f0e8b53703f5aea6d5bc3ea6d0fa6e3753cf6b91f4b577c908eee18b9896f201d490765f4668dd2541a2ac50db285b9630f349238e5d2487ef39c7cc941ef47f77cfd55d11011141384128baf53570d1c2e9a696386268f7a491c1ad1f1256b8bd7684d1d6da8752d1564b7faf69e51476981d3bf9bcb23608367642e37bb91a5c5c1ad1b973ba0fcd6a61ab3899ab598b3697a5d2f4cf6e4555ee6ef251ff00a6de9b63aaac7c0daed44e6c9acf57dd2feeea68e95fecb4c3d30dddc3af54195ea1e2fe8fd30e31dc35051b271bf730bfbd7ff75b9f258b3fb4b69be63dd505f278ff000c91dbddcaef51b2cbecbc35d25a631350582df48e637fe33a01cc31e25cedd78173e3fe8ab357cf452de077903b91ddd0696e7d0a0d96e28888308e33eb66f0fb8677ebd9e6ef21a773620ddc991deeb7f321637d98b488d2bc23b54b2c7cb5f74e6b8d539c72e73e4391927c863f358b76cbaf33689b069f8f98cf79bbc313434ece0d3b83e9b8fa2def68a18ad56da5a28006c34d13616b41e81a3083baac72a1aac821bd14aa38868c9381f1c264a0baab949385c5248236973886b5a325c48007c504bb03a9c1f8e3cb256a3e1469faca7e24ebebe49246ea1b8d446d81ad600472120ee3a8ff0012bd7d45ad5fa82ebfb396581d3ba76e24ac1272b5adc9cf291f0599e9fb15369eb5c5454cdc46cdf27392ef13f141eab3a79faab2ab91a82c8888088a0f441d3b956c56da3a8ac9dc190c11ba47b89c61ad0495a8fb3a513ef74ba875c55b5dedd7faf798dcf18c53c6e21807a75fa2ed7697d4d2da38772da289c3ed4bf48db753b31cc7df2398e3c76cfd56c0d11a661d1da52d7658778e8a06c59f3701ef1f99c941edb761b2bb7a29441e75f2d505f6d35b6ea96f35355c2e8246f9b5c31fcd697ecb575a8b6daf51685ae93357a5ebdd4d1b1c37ee1c72d3ebf1f55bd9dbe47a2d1b2d33747f6ab8268bf7706a9b3384918d819a139cfc70107b5da7b509b07076f218ee5a8ade4a38f7ea5ee0081f2cacc3865a719a4f40d8ad2d1bd3d2461e48eaf2399c7ea4ad57da369dbaa35970eb4a34190565cfda67637ffb51f527cfc56fc63435a00180360105d111011110111101609c69699386b7b635ed639d1b40e7d9a72f6ed9f0caced609c6907fa35bc80d0fe66b1bcae3807323763e610657658bb9b45147cad6f240c6e1bf77668e9e8b587699bb4f0f0e9d66a39dd05c2fb5315ba02ddc9e677bc3e9faada16b6f756da56e1a3961682d60c01ee8d82d37c4ba69f537685d0166e7028686096eb2b43b7e66921b91f241b674ad861d2da72db6980930d153b2004f8f28c13f3ebf35af389cf76aee22e90d231379a96394dd6e38c16b638ffe1b5df17787c16d2aaa98a969659e77362863617c8f71d9ad1b9fc96aae08f36b0b96a2d773b31f6a541a5a3cef8a68dd818cf4048ca0dbac000c0e8365e1eb6d514fa334c5d2f9541c69e869dd339a3f1103dd1f3270bdd6ee32b4876c3b84947c19aa8212e12d656d35380c382e0640e23fed41e268ce1bdff8c16dfda9d59a82ae16d765f456da5f75904793cb9cf5f13b2d43aa75cf157b337172dd4572b8cd7ed137094772d2d32b7bbce1cdcee58f006478745f6bd86963a0b25052c51f771c50318d6630000d1b2c4b8c3af34ee84d235551a83bb99b331d143478e67cef231cad1feba20cb6c37aa5d4569a5b950ca26a4aa67791bc7883fcc1c8f92f4d69cecb9417ca3e1742ebdc1252367a9927a3a798e5f1c0e20b41f2df271eab7137a6e82a49cedbad29a5389b71d59da0af766a59e5fb02d946e84c78cb2495ae6e5c0f9e4e16dad4573659ac770af9080ca681f2927c30d242f9abb2b568ba71135319807545352b647484ee5d349cc7e7b20fa9fc0f9ae324b5f92ec371d09ea574af376a5b0db2a6beb66105253b0c923dc7a0037c799f4f1caf9578cbaab88b7dd1555af69abe7d2fa7e8ea19f67dbe33c934d193bcd2798c630d283ebc6f452b1dd01a806aad1762bc025dedb450ce73d72e60256423a20945479c79f45aa35f71d23d35a81f60b0d82bb555f63199a9e8ce238463f13b077c786106da45adf84bc6cb3716a92a9b46d92dd78a2718eb6d354477f4e738c91e23d56c669e61941644441571f55abb8a7c589f4fd6c3a674cd1fdb3ababd87baa761f769dbd3bc908e801fd17a3c58e2637405be9e9e8a0371d45727186df42cdcbdff00c47c9a32b8784bc33768aa19ee37595b70d53733ded7d6bc6f93bf76d3fc23f920f947899c29b8cbc5cd0da5ea2e46f7aaae92fb65d6ae67b9d1c4ce6e6e46b4f4680d72fbc208c46c6b5a03400060741818c2f9fb87d4b1eabed3fabafc4730b4d27b1073864071939460f81e567e657d0ad686b761b20b28f151ccba574bbd159a95f555d590d153b07bd24cf0c68f9941aa7b586a29b4f706ae9ecee026ad961a4683d4873c138f902bd89f85b497fe09c1a29f23a96192dd1c224a771698e400383863febeab40f6a3e37e9ad5d74d1f66b1d7497a6d3dcc4d5705082e12805b80dfe2e8e1f359dc7a878d1c5183bbb659a8f4459e61c82aeb0975408fc481b9c91e88337ece37d9ab340b6cf57219abec733a82690fe3c1d8ff00af25b5dbf756aed0ba4f4f767ed1953f695edadefe6755d6dcaba40d74d21033807f41beeb07d41db1ec31482974ada2bf5455bf68844d31b1e7c39460b88f920fa2bd1619c5cb9d35ab871a924abaa8e9a375be760748e032e2c20003c4ad414dacbb41eaa6192834a5a6c104bf73ed2931235a7c719ce47a856b4f66bd4bacef315d78a1ab5f7b8e291b236d14796d38c7e139f0f879f541ad780b1eb4e31e82b7e9ab6569b268bb793056d76712d412ee62c601b8d88ebe6bebad25a3ed1a1ac905aacf46ca2a383a35bbb9ce3d5ce3d4b8f995a164e0d6bfe0eeabb85e385f35156d8ebe4e79b4fd63cb5b1bbc7909f0cec327385eab6edda075549ecc6cd63d250b861f55def7ce1f000b906f8aeb952db21335655434910fc551208c7d495acb50769cd0b60ab34cdb8cd759771cb6d80cbb8f0cec3f35e05b7b304576aa15daef535c356d53bde740f90c54e1de430738fa2da3a6b86fa634831bf645868681c1bcbcf1c439bfbc46506afa7e36eb9d731e747681a8869dfccd6d75ea5ee58cf27169c647ccaee52706751eb1aa8eb3881aa26af87622d16d3dd52e7c9d8c7305badadf742103ae3741f395d28e0ece3c4d8ef34d47243a16fac14f531d334f2514a31caf23c07afc56fdb3dea86fd411d65baaa2ada5907336685c1c082ad74b5525e68a5a4aea686ae964187c33b439aef8ad4757d9a2868ab2a2a34b6a5bbe946cc79bd9a864cc209f26f920dd049e9e3f3c2e0aaae8286274b533c74f13772f99e1a07ccad3b43c12d654beebb8a378e420f33c332f3f0c9d8a43d96b4ed75c3daeff0079bdea591bd61adad3ddb8f9968ff141905ffb41e8cb1cad861b91bd553cf2b29ed319a8767cbdddb2bc09b58713f880d7b74ee9f8b4a5bdc70daebc383a623f8847fc8ad97a7343d834953b60b3d9e8edec66c0c1080efef75fcd6418f1c6e834f51f00a4bc44d3adb54dd354cbd4d3990c14d9f2e469dc2d8ba6f4759747d20a6b3dae9add0e304411804fc5dd4fcd7b47c7f258c6b0e22e9fd094a67bcdca2a6c038846f23be03aa0c99df5f8ac6758f112c3a128fbebbd73237bb68e9dbefcb21f20d1bf8f8ad71fd24eb6e26548a7d1964367b349b3afd74183cb8fbcc679ac8744702ed1a6ab8ddeef23b526a17eefb8570e6c1ebee34e797e483c29a3d65c6673e19e99fa4f48bde0f338915950d077c01f7411e6b60d9f86da56cf6ca7a382cb432450b795ae96163dc77f17637595b7a2728f2415451e3d54a0f9bfb504866e27708e881c092e86477f64b57d1e0876e17cff00c6c8d970ed05c29a591deec334b316e3aedfff0095f408ff002410d2ac3aa0f82841e1eb1b3d4df2c3534f475668aa790ba39b2400ec6d9237c7c16bbb7ea6d6fa3a29e9af54edbdb69e9f9fbf8e1735cf786e794168dfc373beeb6f11ef0dba744e5f781c610682b2f14f8b3aba9df3dbb44c36d84f2f77257b8efe63190b3286d5a93525c25b6dfeb9b48dee5b29869227608270407671d56cd51ca3c9079360d336fd374fdcd0c0d8c6305d81ccedf3b95ec35a03555b9cff009a91b7a20b3ba2aab3ba286a096f4528aae4165c6fce320138dfe2aede8ba970effd92634a23352233dd0972185f8f77247867f541a56e864d73da5ed946581d6cd2d48ea8739db9f687f4c7aee0ff00656f28fcba63c3c96bde19681add3f3dcef17c7412df6e531967f6724b1bb01ca09eb8dfe456c46f5f3416444410ee8b4a71ea17d9f5a70d352c6790525dbd8e571e9cb300dff15bafc169ded43037fa39a6ad7004dbeeb47543d796419083c5a7075776b4aa90ef4fa6acfcacdf632487047fdc7e8b7db57cfdd9a03f52ea4d7dac24c9fb42bcc30970c618d24e3f31f41e4be811b34f820b22a0279b18db1d72ac3a20945e2ea9d536cd1963acbc5e2b23a0b752b39e59e53eeb46703e64af9ba6ff00e20ba323bd1a48ac9779e87bceefdbbdc6e7dec73726738f541f44ebbd6147a0b4c56df2e0d99f4b4ad05eda76f33ce4e361f35deb05f68f5259e92e741289692a582463da73d7c3e2b49f6a78b51ebae04cf2e8aaea76524d1fb654d4b9c399d4ec6f3f2b074249007a616a8eca1c50d4da46d365a1d4504d269cba380a4ae6ef0b493cb8c9ddae07ab7d33e283ed75aef8f218ee17ddc48e7b41310058e20e4c8d1b2d80d256b5ed152c90f0aae6633873a5a76f4cff00cd6a0cfed9198add4ac25ce2d898df78efb00327d5698a399f55dae2eb1900329b4e478e6393873f7c0f3dc7e6b74dbe3e4b7d334b8bc88db927c76ff35f3871275653f08fb4f51ea1b93bbab55d6c8e81cf7600e68f2ec0f5f747d50673c7dd4b593d250688b2cdcb7cd42fee799ae0d31403efbc9f0e87eab65e94d3f4da574edbed146d0da6a385b0b303ae06e7e6727e6b50f03acf59ae3505cf89d7984c335c7305ae9e43cdecf4c360e1e5cdbf4f25bcda40e8105ba05a07b5cc8f759744d3723a48a6d454bde35877201dc7d095be669190c6647bdac63772e71000f524af8cfb6671aed77ab6dbec9a7a5f6f9adb5f154cf5b0e4b29de1d86efd3ae107d07c5de35daf85d471c0d8df73bf55659476ba6f79ef79d9b9c7419f0f1c2c07865c19d45ac35447ae78a4f8eaab5b87dbacb261cca5cee0b874c8f003e7bac8382dc218e85d4dacefb7275ff525740d95b52fc18e9dae190183e0b75000b70771d37408fa1f1dd5d151c7afc33841ae38fb7736ce1dd5c11b836a2be58e92219ddce7b80c01e3b656aaec716be5b87112eaf2e7bdf726d2091c0005b1b483f0dd653c71bd4772d4d6fb7472874166a79ee958e8fdeeedcd61eec11e79fd5695e08eafae9b41d2682d2dcd26acd4734d72aeae8dc3968299cfc17b8ff1900e020fa0aaaa5bc64d64eb740f749a4ec728755b8b7dcaeaa6f48fc9cd6f53e195e476c88e36f67cbf332181ae8791acf478c7e4b6c68fd2b45a334fd25a2df1f253d3b71cc7ef48efc4f71f1738e493eab4876deaf923e165bedb0bc092e374869f909fbcdc127f3c20dabc168fbae136906e397fdd74fb7f602cdd791a56cedd3fa6ed56c67dda3a58e9c1feab40fe4bd63d10637af7540d29a62b6bd8def2a5ad0ca78c6097cae3cac0078eff00a2c77465a68b85fa424ba6a2aaa5a4aea83ed171ae970de691dbf2f3790f003c97a5ab6c0dd49aab4ec35b1ba5b6d2bdf5623e5243a76639093e1cbbfc72b55d5589fda238837065ce593f6274f54ba0651b0b986aa71f7b9b1e5fa141a9759712b46e9be3c69fd71a1aeb1c8cb8d60a4bdd1461ccef03b0d0f00ec7391f12bedf610465bb83bf55f1cf6b9e06697b5d974b7ecad929ad5a8eaee7151d33a932c0ec6e0b874d881ef75dd663c17ed0377b56a18787dc4ba575a750c20414d5ce05b1d4e366e49db246e08ebe283e995e6df6f349a76d35772ae9441474d1192591db00d1fcd778121bd4923afaad27c519a4e29eb9a0e1ed23dc2d54e456df2768d8c6d3910e7cc9c6c83b7c28b4d56b8d4157c42bcc586d40ee6cf4cec1f67a719fde63c1ce24f4fe6b701cf29c0c3baefe6b8a92962a2a68a9e089b1430b43191b4001a00d80fc9731f74f90ebf9a0f9cfb1e4e6b1bc43a89dce92b9d7c7b652e3d00cf28fccadff0077bcd158a864abb85543454918cba59dfcad1f35f2dc5a7f8a5c10d7fab22d1fa623d4366d4157ed74d3171e5a771dfdec1dbc7aecbd9b5f0035b7152e51dcf8af7e0ea361e68ec96d70e40739c38b76f1f541eede3b40ddb5bdce4b370b6d0fbed531c5b35daa0725243e4413d47cc7cd45afb35566a8a86dc3891a9eb352559ffe82090c74d1f8e078e324f805ba34e698b5e93b5c56eb4d04143471800470b40071e27ccaf59c83e63e3e70c7f60dfa2b5468bd2d0cf1e9bab74f534d49180f747ca373b6ff001ebb28b976d6b5d550c547a7b4e5d6e5a9ea00653d0c90e00908e980439c013d06e42fa69cd0ef03f10ba34f63b753d43aa23b7d2c750492656c2d0f27cf38ca0d09a4b8017be20d6536a6e2c5ca5b855e39e0b1c4f0da7a7077e5763a9dcedf0f1cade1a7f46d874ab7fdcd66a1b6e460ba969db1923d48192bdb441c4d85bce5cec39c320103a0f25ccd031d11aac82a5a1c81a0780fa2b2208c63a0c294440444404504e1473209e51e48ee8bc1d45acec9a569df3ddeeb4b6f63464f7d2807e9e3f05ad2e3da15f7c93d934269bb8ea8ab3d2774662a61ff005171f0fa20dbe6370a812778445c9831ed8f3cfa2c0f5971db4968b91d4f35c0dc6e19e51456f699a427c07bbb058a33861c42e21be1975bea66daa8012ffb22c839320fe17c9e3f9ad89a3b863a6742c4d167b4c14f2b460d53da1f33bd4bcee506b7fb738a3c5368fb229a3d0b6773b7acac6f3543d9e6c1e7f4f8af7b48767cd3d649e3b85ddf36a8bc6799f597221d977986f4fd56d603d3e0559071450b618dac635ac6346035a3000f40b900c2944044441c5e09bfc94b95b6c6e83e7ae2f0e5ed2dc2dcb9cc32899ac206db03d7eabe836f5f9af9f78fb5335af8c9c27ab600e63abdd0f3386cdce01dfe617d04dfbbd73e082c4613977524e1074410dea570cd3329d8e92591b1b1bb97bdc0003e6b8ae972a7b3d0cf5b572b60a68186492471c06b4755f3b3aa354f692bc4d1d2cf5361d051485bdf3080fab68f21d4e7e8833ed49da0f4e5aef1f64db1eebbd7e7df306d0c43c4b9e76dbc875cad63aab8a7c67ba475757a66c4c3474f54d83b9a7a7e79dc0ee1c5afe83041ea3a8dd6f0d11c29d35a0297b9b45b58d900e574d300f91dea5c7f92cd3cca0f9474c71f78a3a72dbf6aebad293d15a62ab6c0f926a70c7b9a76e61cae23afaafa92db5b0dca869eae9ddde53d446d963779b5c320fe6b57f6a3afa7b7f062f7dfb39cce6386268ebde1782dfd1663c2db7d4daf875a6e92b1fcf5515042d91c7ae790754195a222022220ab906fd51df1c2373e79416518c740a51014382944151d0ad3ddac5ce8b815a8a66679e21139ae69c161ef00e6cfcd6e23d1685ed997111f07cda43da26bc5c29a898df120bf248f86020c97b3469c3a7b83d63ef726a6b98eac98b860973cedf901f55b5979d62b6c767b3d0d0c4008a960642dc0c6cd6868fd17a282a5b9729f052a1dd10680ed635df6cd0e94d0ed7b5afd4373631f9193c8c20f4f89fc97b376d17c2fe1adae4b7374cd0d4d75737bb143494625aaa971006c00c8eb92e2478eeb19e3ec2d878f7c1ba97e4b1d5b246ecb872fbb83d3e7f985bb2d161a3d3a2aaa5e61755d44ae96a2adec6b1f212e2402e3e03a0f820d1dad6866e11f64fd414b52d31d4d4c52b194a1dccca6350fc36269f26823e795e55dac674ef083853a4632d75e2a26a77f2377d9c799c71f3fd577fb62f1134ad4707ef56565f68e5ba3a489cca48a50f7b8b5fcc46de80a8ecd16cbbf1365a1e21ea4858ca6a7a76d259291a72d646d686ba6f89c6c7af541f4ac7d06f9f55aafb4cd73e8785753c8f746e9ab69210e6f5de66ff82daadfbb9f15a6fb53dc29adfc3ba2357208a192ef48d748ed9ad01f924fd106da96aa1a1a133d44ad8a08e3e77c8f3801b8dc95f29ebcb3cddb03550b6db4ba8349593bc0dbb188f3c929d8f213d46c323c97af55a8affda7b524b65b3196d1c38a37f2575c58ec1adc1fb8c77d17d13a634d5bb495969ad56aa56d351d3b7958c037e9d49f127cd07cdf66aee3df0b29a3b347a7e8757daa8408e9ea23706bcc60600ce4787eabda8f8adc73bc35eda2e18525039bf8eb2a31f4cb80fcd7d1d81d709ca3c907cd0de15715f8af247fb7ba9dba7ecee397daad18e795bfc248ff0035b0eedc04d334fc30bce94b1dae9e8c56523a2121fbef9719639eeebf7805b53037d9463d107cf3d993898f8ed9170f352364a1d4f6461a76c750394cec6ecd2d276271fc97d08d3b641d96a6e357002d5c5d9296e0daca8b1ea1a3696d3dce90f2bb1d407f9e0f4dc1192b5bd0de3b4170b3fd9eb6d547afadcd3cad9a2931311e049d8f4c6c46507d4873e0161fc4be225bb86fa727b957480cce1c94d4cdddf3487eeb5a06e772b4eff4c7c6eb94fdd51f0ae3a40ed9b255cce0d1eb9dbe8bdfd15c0db9dd75543abf88d726deaf709e7a4b6c64fb25113bec0ec4f5415d0dc26b86a2d03a9eab51d4cf417fd5d1bfbf7b3fe252c64618c00fa75f9792cb3839c10b17066c9251db4beb2aa67074f5f50c6f7afc741b74031d16c76f8ab0007418410d181f35f37769aa73aab8a7c28d31c9de4325c4d64ccf36b48f0f835cbe90277c78f5d968114526aeed78fa9735d251e97b386b5c0ec2694671f1c39c837f331d30aea1bd14a0f36f958eb7d9ee154cd9f0d3c92376cee1a48dbc7e0be69ec3dc518354e96bfd92aab3bcba50d6495b377b1f74e0257b8b8e0edca0823eabea57b43bafe8b574bd9ef48b2f75770b7d34d687d61e6ab8a824ee993ee492ef1dfd36418e529fe9838dd4b728077ba6b4931c629707927ac7f88cf5e51fc977fb4df0969b88bc3eafaca6a760d416a61aba1a968c480b3de2dc8dfa671eab69e9fd3f6fd336b8a82db4b1d2d2b3a3183a9f124f89f55de99ac31bbbce5eef187731c0c20d27a0f8e304dd9d28759573c3eba9a9fd9248b24b9f54d3dd86f9924f29594f04f4755d834f4b76bbb9cebf5ee415b585dd63040e58fe431f52be75e04e9fa7bd71935569bf6c8e6d21a7eeb25ca3a573f31cd3b8e1be840232beca1510823f79927383d7d0fe883b0d180a7e4baadab0f2d0c6c8e0e277e5d82bbe69391ae642e7737504e0841cfca3c94aeb3e495a7dc88b863ab9c000570c1edc5ee33080373eef2177e683be8bcf7475ae92377b446c6820b99dd139f4072ba9536baea991c7ed5a88632e2792289830d23a6704f541ec13e1d133feb0b1faad312d63256bef57463648d8d22195ac2de5f10797627c7cd43b4947353c704d72b9ccd630b09f6c735cedf3925b8c9ea8320ceffe5b2af382e0dce1c7c32b193c3db51a6929a67575442f70716cb5b3386ce240fbdd37dfe4ad49c3ad3b45718aba1b5b63ab8492c9bbc90919ebd4a0c9b3d73d7c4f45026692073b73d46eba7159686373deda58c177de763afc5737d9b48e735c29e1cb47283c8361e48390d4c6d760c8d07c8b80506b21c91deb01033f795853c4cfbb1b07c1a14f2b37f75b923cb74158e764832d7b5c327769cabba40d6e49007c5742e777b758a032d755d350c60679a67b583f35835cb8dd6a74c692c56faed51559c06d0c07bbcff5cec8364b8ec7f92ead65ca9edd13e6aa9e3a689bd5f2bc340fcd6b6963e25eaec077d9fa4685d8248719ea48f2f20a6878016395c66d43555daa2a4eee757ceeee89ce76634ec8175ed0361f6c7d069e82b755dc9bee986d709731aef273cec3e4bca347c5bd75eed4d550688b7c9ffed819aa80f9ed95b52d361b758298416da1a7a185ade5e58630dfd373f35cc26969592bea03044c190f61249f523fd7441ae6c5d9e74e515736e57992af545cc1c9a8ba49ce3fb9d16cca3a1a7a1a76c34d4f153c2de91c4c0c68f800a68eae1ae81b341236589c480e6f4d8e0fe617650401e9ba9444044440444404444157283e0aea1dd10687ed714eea4d1961bf3232f7da2f14f3170fc0c2f01c7f20b7751d547574b0cf1383a3958246b874208cff00358571db4d9d59c25d4f6e6379e5751be58ffaccf787e8a9c03d4835570874cd717f7928a46c32fa3d9ee91f920d819cfaa90708d527a20d2fda0457eabaed2da12df2f70dbe543a4ac90388229e200bc023cf2b6a582c545a6ed14b6db7d3b29e9296311c6c6340c0006fb789587eb0b2c9fd2a68abdb473451b2a68e418fbbced05a7f22b61b3a2080cc630318e88ece3f356270b0be28f1128b86fa66a2e9527bda8e5e4a6a669cbe590f400796719f4ca0d63c5574bc54e2d58b43d28e7b6da9edb9dca5e6259ccd391191d33f15bfa3686b700003c0018dbc16ade0268aafb1586b6fb7df7f516a09fdb6af99b8310fc31fcbc96d56b795b8416507a294415e65651ca3c94a02222022a1255d01111055de017c9fdacae82ffc50d03a6daf25949590d5ccc07ab9d20e518f837f35f573bc73d0ed95f15c55cee26f6c28cb0c751454b561c5aec6447031c76c8fe2083ed48c72fbbe5b2e4546f4f5f4561d104a87745288342769ce15eace21d6e8db869034acb8d9eb1f2ba6a87e3bbe60395c01d8e0b56310f648d41aa2aa5aad6bc47ba5c9d2e0ba1a126361f4c38e3ae7c17d405a0907c5395069ed33d967879a4e92a994f6615753511398fabae2677b72d2d25a0ec0efe0b5f7674d62384770b970ab584a2d55745532496a9eadc1b1d540e765bcaef80fd57d44e03ae375af38b7c13d37c64b48a4bcd3f775510ff66af80013c07d0f88f4283d8d71c48d3fc3fb1cd75bcdd29e92958c2f68320e6930338681b9cfa2f9038a7a9f55f1eebf48cd73a492c5a0ae1788a1a1a573489aac1ff99f21d0f87d56edd19d9034969eba36baf3575bab258b9442cbabc3d8cc74f7475f9ae7e383229f893c25b2c6238a2fb51d29635a006b58d18031d3c506e1d3ba7a834bda29ed96ca5652d1d3b79638a3f4f127c49f35eb34602ab0876e15d01111011464267c903e4a1dd551d2068249c0f885e5d56a8b4d1bb966b9d2c67c39a66e507acac3a2c6bf6de8247725332b2b1d9c0f67a571cfcc8030b91b7eb9d4737b3d86a1b83806a268e3cfae324a0c8941385e0bcea099dd6868d991d39a577c3a00b95d6aaf95dfbdbb49ca7ab6389adc7c0f541ea48ef7492401e27c878ad33d9f226dceb35ceab91ed0dbcde6464409dc4718e41be7e2b655f2dcc8ec9707ba49e7229e4786c921232d69c6df158b7002d14f6fe1169d0da76c6e9e2352f05a33cef71767e3b8419e0bbd1e791b53139c003cac707119f40b91d5643f944533f6ea1b81f9ae56411464b991b5ae2304b5a012172900f51941d27cd50430b6068e61b991f8c7a6159d1cef00091918f1218491f0caee220ea963beeba47b81183b86fcc6375ab78e1a8aaa1b4d1e93b18965d417c2d8232dcb8c110239e471cede59f559e6b6d5b41a1b4e575eae52725252c7cce68fbcf3e0d68f124edf35adf81fa62e37696b75eea38dcdbc5d8b9d491499cd352bb768c78123c3d1060fc19d35070d3b44df34b454b1b219acb0cbde34e7bd90105cf39f12495f4eb77682b45d5c419daee81cc8db9934fc8e73ba13ef6cb7ab7c7cbc1000f453ca3c94a20222208e51e49807c139947320b28f92ead4d741431992a678e9d9d79a47868fccac6eb789d61a694431559aea8f08a86274e7fed4197728f25070df05844bacefd5bca2d3a4eaded76712dc2514ed1b7520e4ae38ed7ae2f0e0eacbbd159627347eee860ef9e091bfbced9066b34f1c11b9f248d8d8d192e240e5c7c562b7be2969cb1c82092e0daaa92e0d14f460cd2389f20deaa9270dad771aa351749abaed3001a7da6a0f274df0d6600cff0035efda34cdaac71b5b6fb7535186ec3b989ad3f5c65062d2eb1d4f702d168d233b58edc4f749db0340f32dfbdf25d6fd95d6d7f707dd75332d54e7ad2da2201d8f2e772d8bc83fd056c7cd06156ce12e9aa094cd3d09b9d51eb51717ba777fddb0f92cb2928a0a088454f0474f10e91c4c0d68f800bb488200c26075c6e9e2a03838673b20b2e1930d05c7007f11db1ea556a6a62a48649e695b1451b799ef79c068f32b0892babb8833c90503e5a4d387024ae6e5afa9df76c446fca7a17786f841eb68e97daa7bcd4c0fff0077cb587d9c781c01cee1e85dccb286fdd0bad414505b68e2a5a689b0411379191b060340f00bb3d360825111011110111101111011155c8382aa9d95904b048331c8c735c3cc1185a33b334c74b576b5d07512835566ba493c316fbd3c982d70f3df1f55be080ef3e98dbd5688e32d8ae7a035ad07142c3049531d3b053dee8a11932538d83c0f1e5fe4837c47f771d71b67cd4e7c1785a3b585ab5d58296f165aa6d550543799ae69dc79870ea0af6dbd10449089394900969c8c8e87cd5f1cadc21763ff0075aff885c69d3bc3da77b6a6a4d7dc46036df47fbc99c4ec32d1d065064fa9f535b748d9aa6eb76a96d250c0dcbdee3d4f8340f127c30b4a70fec171e35eb43af753517b3d868c96592df30c8201ff008ce07af9efe3f05dbb4e80d45c62bdd1ea1d78c6d0d869c896874e82e01cef074dbee56f3869d94f13228d8d646c01ad6b4001a074007a20e46faf55c8aa0655901111041385d5aba98e96096691c5b1c6c2f7728248037ce3fd6576d55cdf441a428f8bfaeef1ae45250682ab3a6fda5b19aea86189fdd9fc7b9c7ae16ee6677ca9e55206104a222022220f1f555d9b61d3975b8bb03d969a49864e325ad246ff0025f2bf624d3b2de6f9a97585602e2efdc46e70dfbc91dcef23e580b6af6b7d51fb39c1eb8c4c97bb9ee123695ad0772d3bb8fc80fcd777b2f69b769ee0f5a0c8cc4f5dcd56ecb39496bb01b91fd50106dc6f4524e14a20ab4e55911011110147c9417792e95c6ed476884cb5b590d233c1d348183f341dd7372b45f15a3355da278554f97e2315550437a6c07559dd571874fc733a9edf2545eea403fb9b7c0e9093f1e8b4eeb6be6a0bcf68cd032d2593eccae14154d83dbe50e1c8e1ef39cd6f4c7d7641f4d737ccae396a638013248d678fbce0161bfb31a9ee2c70afd506161663bbb7d30601ebcc772b929785d641c8eadf68bb4e067bcac9deecfcb38083bf55c44d3f4790eb9c32b81e5e4872f767e4175dbae26ad7345bac572ac07fe648c10c7d33f78af7edf65a1b54619474705281b0eea30177797d5062a2b755d54a032df4143161a79a799d238646e30df552dd3f7dab8c7b66a2918ec9cb28a063063cb246565580a5062b1e82b738b5f552d6dc1cd18ff69aa796fc700e17b14762b7d0c6d641434f1b5bd3118fd57a488281b8e830acde8a51011110704d1b6463daf1ccc7021c3cc63a2e1b4db61b45b69a869d819053c6236340c0006c365dce51e4a5011110151cee56927a0f1563d16afe356b1adb6d0d169bb13fff00115f1fecf010726067e290e3a6d94187dc3bde3ef125b42c73ff006274ecfcf50ec7bb5750370079819dd6fa631ac8dad6b5ad0d180d68d86dd1639c3cd0b43c3dd2d4966a305e221cd2cafddd2c877738fc4ac99dd0fa041a52e54af776b2b64ad7618cd3d2738f1dde7a2dda3c7e2b46555e2dd49da5aaebea6be08a0a3b0b63739ef1f7dd21d9bd77c782d94fd6cda88daeb5db6bae9ce32c7c5096467d79ddb20ca89c2a97755874955acee7ccd8696df6766016c933ccf20fec8d93f626bee918fb6b51d75449f8a1a2229e23f2033f9a0c8ee179a1b6c6e7d557414cdf39250d58d557152ccda83051c75b73971902929dce69f2dd77a8f873a728aa3be6dae2926fe398ba53ff00712b228608e18c323636360180d600001e4830f6dfb575d00f63b053db233d24b9547313fd86ee3e6b8bf64b525da23f6a6a79a02460c36d89b1b46e76e63d76c2ce7950340f0418752f0ab4ec58f69a375c64cf3192b6474849f8671f92c9e86db4b6e8847494d0d3300c72c4c0d1f92ee220a86f8e3753ca3c94a208e51e4a5146420945190baf3d5474b197cd236160fc5238347d4941d945855db8bda42ce5cda9d41461ed772f244e323be8d583de7b55e96b7c822a1a2badde62ee50ca6a6e5e63e432724a0dd67e1e8b17d45aeadda7668e919de5c2e328222a0a167792b8fae3ee8cf895aa3506aee2e6bea7645a774949a62dd2b72ea8afaa8db50e07cbf836c7af55c1a77417156d54ce8adacd39609de733575439f5753507c72ffe48365d3e97b96ad99951aa4b19481c2486cd0bb2c69c7fcd70fbe7d0ecb368618e18db1c6c6c6c68e50d68c003c82d40740f166ab227e23d240ce6c8f66b5b738c0f3f5cac6788972e24707f4fbafd55af6d7748e278cd157d108ccfff004b3977ce33f920fa311789a42f536a2d2d69bacf01a49ab69a3a87c07fe5973412df9657b68088880888808888088882bba37d77564405d7a8859346e89ec6c8c70e5735c32083e04792ec28c03d420f9eaf5c1cd67c33d475b7ce1656d29a2ad7f7955a76e1b424f898cf8138561c6ee295235b0d6709ea8559f743a1a80e8dcef3f82fa09cdf451cbb631b20f9fe4b4718f89ee636e55b4fa06d0fd9d0d23f9ea88feb79fa7a2cdf87fc07d35a06a9d5cd64d76bc3ff00e2dc6bdfcf23f38df1d0745b2b953976c636410cf056e815037976576f441288880888823c54a22022220222202abb6dd42970ca0f98bb41daaa78a3c6ad19a1e06bdf43047edb5ae6e406c65fef927faac007c57d2d494d15253c7042c6c7144d0c635a360d03007d30b8bec9a3172371f6487db8c7dc9a90c1de16673cbcdd719f05dd000e88251110151ce3d3f92e1a8aa8e96092599ed8e38da5ef7b8e0068ea4f92d275fc4fd53c53b9cf6ce1bc11d25b207f24fa92b633dd9f02211f888dbc0fc906e1bcdfedf60a492aee35f4f434d18cba49e40c0dff001f82d60eed11477cb81a2d2162b96a897706aa18cb29da7c32e3d47c171d93b3558c55fda1aa2e75dabee2fdde6be62d809ce768da7f5256dab6dae92d148ca5a2a5868e9a3186c50c618d1f00106b26d87891ab6663ee77aa5d3142eeb476e6f792907c0c87a15ebda782ba7a8dd14b5ec9efd54c3913dce532e7fb3d31fe2b60b5b8f05641d2a2b752dbe211d353c34ec6ec1b1461a02d2fafdcc8fb5270d8f2485e6dd5ade669f77183b2de9ca3c9691e2c426978fdc29adc80247d552fa9cb33841bb8354aab7eeecac8088880888808888088a33f54128bab515b152b4ba69a385a06ee91c001f9af2aab58da28dc03ab992b8ecd6d3874a4fc9b941efaaf32c6aa753dc24666dd62acab6f372f3cce6c231e60139c7c9719fdabaf6601b75abde19782ea8763e1ee81f54194e4e7fc975ea2e14f48099e78e10067df780bc1769496b4115d79b8546461cd86410b4efe4370bb14ba1ecb47289450c734ad18ef2a0994ff00dd941d1bcf12ec369b7d4d61ab35515346e964f65619395a3c49e83e6b54f0deb2f3ac351dcb8810d826a89ee2df67b63ab9e228a9698123233d79b7271d72164bc6991f748ec9a0ad1cb4d3dfa7c54ba2686886919bc8e2079ec02da168b54166b652505333bba7a58db144df26b46020c6e4a2d63718c35d5f6fb53496e7d9a2748f0df42ed924e1f415d8fb4aeb72b906070e49aa396324ff00d2d5987280bab72ae8e82df535529c450c4e91c7fe90327f241a63853a76dd271835cd5d2d342296d8f8e821696f316380cbbde764e7fc56f08d81ad0dc00318c2d49d9a2964aad07557fa8662aafd70a8ae7b8f5e52f2d6fe4dfcd6de6f9a0728f25288808aa5deabab5170a7a207bf9e3876cfef1e1bfa941dc458f4fadecd138b595bed2e1b72d331d293fdd042e376aba9983bd8ec572a8380419631034f5f1791e43c3c506484e14077aac5db55aa2b5ac7b292df6f63da322795f2bda7193b018fcd55b60bf54e4566a39236e7eed152b23dbcb2e05064ee7b580b9ce0d68ea49fe6bc6b96b6b1da09f6abad2c47a72f79ccefa05e71e1bdae62c35b2d75d0b0e796b2a9ef6b8fa8e9f92f5a874ad9ed78f65b5d1c0ece72d85bcdf5c20f163e25d0d6c863b7505cee4fc6c60a47721dff0088ec175aa2f9adab64a9650d828e858d388a6b854e73f26ac92f7a92d3a6695d5374b8d35be06ec5d3c8d68f82d7559c79a4bbd4368f45daeb35455bbacb0c4594f16e705ef23a7c31f141e84fa375c5f1d17da5ab994111de58ad7072103c838f8faac53545a7879a79cd8b515e6e5a9ae118f76defab92a2471c9c0e461c67e2bdd83446b7d690176acbf9b3d2caecbed5640d6e580e434cc77fa12b2dd21c33d39a2581f6bb6c51d46497554a4c933b3e25eedd06b0b2e93bdea493161d296ed0767947fe7aa210fae737fe9691ee15b2344f0bacfa29bdec41d5d7370fdedc2a8874ae3f1f0599728e5f3f52aa5dcbe1b20b6075c6eaae706825c7940ea4ff008ad63adfb40699d25586829657df2f192c1436dfde3b9bc013d02f06dfa6b5ff0013eac56ea5b8cba4ec7d63b550b877d235dfc6efc3f3dd064dc43e2cbb4b3e9a82c76c7ea0bc553cc51c10b862377839de247fa242c3f4b767faed47a9a1d55c46b87db5718cf7b05a49cd353127a11f74e3c80c7ea76ce97d1565d25018ed540c81e7efceecba693c32e7bbde3d3cd640d686803082b1b435a000303618e8b91110111101111011110111101111011110111101155cac80a8aeaae416450de8a50111101111011155c82c888808888088880888835df1f20ada8e106a965bc486abd8dce0232798b5a417818f12d0577f84afb3cdc38d3e6c1dd0b6fb1c6636c3d03b1ef7cf9b39cacbe66b1ed735cd6b816ee0f4c7afa2d4371d0fa8786575a8bbe8485b71b5d54864abd3734bddc6091ef3e9ddf85c76dbc708371b7a29580699e31586fd31a4a9926b1dddbb496fbb30c1231de2327dd3f10b3864c2567331c1cd2321cd208c79faa0e745569cfc1590169ae3753b5bc46e135612018ef6e8fd7de8cadcab4bf68fa7746cd0b736370ea3d474bfbdce39038f2ee8373b461a0295c6d3e87c8ae1a8ac8695a5d34d1c43a9ef1e1bb20ed22f186a6a29d99a6335593d053c4e767e78c29170ae9b022b7ba0690efde55480069036c8049dd07adcca0bbaf8af1c52de6a1c1d2d7c34adc6f1d3c1cd83e7cce3fc90e9e8aa1b236aea2aab049f78492b9adf935b8c7e883b55f7ca0b60ff006aad861cf40e70cfd174c6a464c1a28a92b2bb99bcc1cc8c46dfef3f942efd2db2928f97b9a68a22dd816b4647cfaaeda0f184b7baca6e66414d41293bb67719081e07dd38cae3160adaa800adbcd53de4fbcda5e589bf01819fcd7bc067a8cab20c7e1d176a6bcc92d27b53c8c73553dd2edf072f669e9a2a68c3228991b5bd1ac67280b9b947929411ca3c939479294405476c41f92baf1755de1960d3974b9c9cdc9494d24deef5f75a76f8a0d79c3f8e5d5dc54d57a9e7634d3501fb1e849f2079a423e78faadb63c7e2b5ef032cf35ab8696a7d4f31abae0ead99d20c38ba47176fe6718dcad88821dd16b2ed0fa8a5d3dc29bd1a6772d6563051403382e74a7970df5dd6c87c64c9cdcee03182d076f8ad35c418c6bae35693d2c3f7d6fb3b1d78afdb3878da261f89df08337e1dd0d1e8cd0f63b21a98fbda4a58e290641fde632fd874f789590d45c9f144d7414951505cec06b5b8dbcf27c17722a7644d70646d664efcad032b9397d107952545de5e66c3494f081d1f3cc5df9347f3556d15d2785c26b93237904669e01819f892bd9036e8a50780fd36da899afaaafaca9686867219b919919f7b0dc6fbae66697b4b64748eb7d3caf77e299bce7feece17b2b8c9c1c0f8ed8415a7a78e9d81b146d8dad1801ad007e4b91dd579978d436dd3f48fa9b8dc29a8206f57d44a1807d4ad6976ed29a75b38a6d3f4b5faaaaddd1b6e85c59fdfc7f241b7575eb2e14d6e84cd553c74f137abe570680b4d3abb8bdafda7b8a6a1d0b6d93612cceef6a80f3c781fa745ddb57673b5cf2f7fab2f374d5f59d5dedd50443f28c1f8a0ee5ffb4469aa2aa750d94556a8b8838f67b4c46419f22ec10179f4d5dc57d78d7725251687b6c9f8e7ccd561a7c4341d8fc70b68d8f4cda74c52b696d56ea6b7c2063969e30dcfc7037f9af4d06b0b2700ec14999efb2d5eabb8bb77d45d242f19cfe1603b0faad8f416fa6b5d3329e929e3a581a30d8e1606b47c82e671e5dbe2b13d5fc51d35a129dd2ddeeb0c2fc6d4f19e799c7c83467f904197ec3c175eb2b20a0a77cf533b29a160cba491c1ad1f1256931c68d65c42e6834169292263bffd52f47bb8a31fc5cbe27d0655e2e00dd75a4ded3c42d59577c2e39fb3285c61a567a7afc8041e96a6ed1964a5acfb374c52d46afbb3b20535b88e507d5dfe0bc3fd91e29714e5ff00c49768f4758dff007edb6b3cd348d38f75cece41f89f92dbba5743d8b45513696c96b828211ffdb67beee9d5c773d3c4af7c3404186683e1669ae1d5277364b6c70498f7aaa5f7e57e773971dfe9b2ccc78f92728f252820003a0c29444044440444404444044440444404451f88a094444044440504e1464e7a6427a94120e51dd1555d0515d11011143ba2094503a2940444404444107a2aaba202222022220a968241c6e3a29f928cfaaf1af3aaad3a75a1d71b8c14bcdf85f27bc7e0d19250725ef4cdab51c5dddcedd4b5edf013c61c47c0e321634ee145ae8dc64b3d75c6c2ece7968aa9c23cff0051d91f246712cdee378d3b68acbac80f2f792b3b9881f573bc3a74f35cbf66eafbc0cd5dd292cf13da331d04464907f68a0a3ec7a8acece73ad1a621b66e1471e324f982d5e59d737aa595f1b6b2db78702486d1534c4900e08c8f773f359350e83b6534eea8aaef6e95040064ae93bc1b6f90d3b0590c14d15347c90c4c8a30721b1b4347d020c0a1d45aeaa5ec64563a204bb99d24ee7c6c0d3d06327758671c2d5acefbc32b9cb510daa2347cb5bdd425ce78744fe76b838e70762b7a068d86174eef6d86f16daba0a8687d3d544e864691f85c083faa0c26d36fbbdcad76cac9715f14d1b260d75c5ed182d041d9a339cf4e8bdc82d35749512cb4d69b7c52168c4af99ce71f4fbabc8e0efb5db74b0b05c5a457596575092ece6489a7f75267c72c23e8567c31e5e883c98a6bab19ef52520e566796399d9e6f2c72ae47d45c4365e5a388b9ad059fbe3871f107dd5ea28e51e483cda79abdd1974949046ec7badef8923e3eeaec735407b41637948f79dcfe3fdd5db441d52670dcb5acc93b92e27f92e405fcf821bcbe609cae6551d4a08e5767aecae88808888088880b5c71e6a9f1f0f2aa923798e4afa8828c380dfdf900207cb2b629772fa0f55a3fb476bcb2e91aad1bf6bd6775147746d5cb14603a4e48c780f52506e6b7d1b2828a0a588622858d8da318c068007e8bb67e2be6d1c6fe26710de0e81d12ea5b6ca4f7572bb34b5ae1fc582401e1b2ec47a1b8f97e7c7356ebab658c9397454908931e980cc7e6837dde6e74f65b65557d5bc329a9a274d2389c00d6824ad4fd9dadf5378a3beebab842e8eb352d5f7b0093ef3699bb463d01f2f40b53f10746f132eda9ed3a067e22c9777dd62e6ae8e2a3e46434e0e4ba4c1f12303cd6c683875c47d2746c8e0e285053d1c2d6b626565b9ad6b580000639800001e4837bb5deef9a9e65f2cea5e36ea1d2552f87fa42b1df256000d3d15adcf71764f8b7607e6bd3d35c53e34eabc0b768fa58e09300565ca37d3307a869dfa63cd07d245dd5639a83887a6b4c4464ba5fa82847f0cb3b79be80e568fb9f0db8bdac5fcfa83507b340e279a96d550d8985be03eb8dcacb787bd9ef4ce980ca9aed3925c6e9cd87555d67654efe6d1d00f965070d676938eef54ea4d17a6ee7aa2a79b97bc6b0c708f5e6c1dbe38f8ae17daf8cdada4e5abb8dbf475097679697124fca7c0fdefd42dd74b4b0d1c2228228e1886c1913435a3e41761a07920d3d61ecd5a6a9263597fa8afd5b5d9cba4b9cce7479f30c1fe6b695aecf4165a36d2d051d3d1d3b76114118637e802efb80f25d4aeb8535b69e49eae78e9a166ee92578681f341db70df3e2abb01bec16b7b8f1d6c9dfba9ac54b70d515606d1dae9cb9b9f22f3b0ff35e7cdfd28eb2734c7ec1a3681e776bff007f545bf2d8141b1ef3a86dba7e964a9b95743450c6399ce99e06df0ea56adb976878aeb37b1e8ab0d7ea7a973b91b50d8cc74ed3eae237f0f2ebd57a96ce0169ff006b6d7dfaa2af555c81e6335ca52e68767a860e9f05b268e869edf08869608e9a16f4644c0d6f4f20834d1d17c53d78d9e2d45a8e9b4cdbe51ff95b4b03a6e5f22eff0032b2ad1dc0dd27a2ded9e1b736e17200035d5cdef643ea33b05b100c2941c6c6358de56801a3a01d02e444404444044440444404444044440444404444044440451f88a94107a2a9cf9aba20ab73e2aca3a7820e88251110111101155c9cc82c8a01c952808abcca474412888808888088a09c201385573b6cf4f9ac4b889c45a0e1e5ad953511cb5b5950f11525be98734d5121e81a3cbccac2dba435ef11a37cda8af4fd256b97a5aad4477fc9e4f94f43d7a20ceb51711f4d6956b85cef54b4cf07062ef39e4cf972b77cac77fa4bbcea4798f4b699ac9d8465b5b741ecd06fe201ddc17a3a4b837a534738cb436c6d4551ddd5758f33ca76f372cddadf7718dbc106bd6e8cd537c2d92f9aae4a46e30696ced1137d72e3b9eabdcb2f0ef4fd864ef60b747354fe2aaaa26695c7c4973b273f0593ab37a20a46c0c6800003a0c0c6cafca3c94a20222af36e82ca1c063a29441d4147132a5f50d686ccf68639d9ea067191e38caed0e8a510111101111011110111101114138412a0f45c151590d2c65f3cac8583f1c8e0d1f9ac0f5271d347e9de661ba36e1580f28a4a106591c4fc07a20b718f894de1ae996d544c6d45ceae414f49013f79e7c71e9fa95f32d0e897dbb8ada66efc527d3ce6e73bfbbfb56524979196b5b1e7019cc40f20bd8e2feb6bf6aed71a42ff0049a764a1b452cdddc3517806388c85c48716fd3e8bcded47c02d7daf34f506a6ba5fe86e5596c7869a6a180b238a1791ccf69f12081f441f54de7881a5749d2b4d75eedf450b5b8633bd6e703a00d6ef8f05ab75576b7b0db9cda7b1da2e57ba999dddc27ba3146f933eeb413bbb39f058de9ea4e12f0eec56a6dbe18f586a29606322638baa26964e50073020866eb60f0eb8595b517a8f586b2640ebd7291476c8da0416f61ea001b1763c50601a3f87dc60badeae77bada9b6e9aaabc3b35152e609eaa084f489807ddc602cda9fb32596e12b67d4d7abb6a8a8c0e6f6b9cb18e3d7381e0b73b4798df2a79b1e8831ed3bc3fd39a5636b2d364a1a1e5d83a381bcdfdec656445a0f5195c525432069748e6b183a971000f992b15d41c58d27a5c3c5c2fb48c7b46d1c6fef1e7fb2dca0cbc819e8aa0068c0d96a4771e65bdd4360d2da4af17b7bdd86cf2c7ecf0631d799cb95941c55d50d736aae16cd294cfc6d4b199e768f2c9db283665c2e5496b87bdabaa86923fe39e46b07d4ac02efc7bd2f4333a9a825aabf56104361b642e94b88f0c8dbe6a697815a7e6a86555fe5add4d58d1bbee3339eccf9860380b3ab5586dd63a76c36ea0a7a289bd1b044d60fc820d60dbd71435b063a86d74ba4adf2e089ab1dde5406ff57c0aeddb78194951522af555d6bb54d5e7219552b99034f90603bfcf65b51a3d3753803a041d5b75ba96d74ada6a4a78a9a08f66c70b031a3e002ed728f25288088880888808888088a0f440cef852aa3aab202222022220222202222022220222202222028fc454a8e8104a2a73faaba022282708251539fd54f3203b3e0a9bf8abbbaa840566f455566f441288aae416450de8a5011110151fe5e7e2aea8f19fd5069bd1b18d6dc6fd5578aafde45a7c476ea389cec863882e73b1e077eab7235bee8f35a1b594d75e08f116e3abe8ed12dd3495e9ac3746526f2534cd18ef48f2c75f9ee16ced25c4fd2fada95b3d9afb49581c07eebbd0d9067c0b4e0e50658d1e7bab2a028825cacaad56404444051ca3c94a202222022220228270abcdf341745c65c06e4e079e760bc7b8eafb2daf1ed577a3a7276c3a7683f441ee28c858049c60b4d43cc769a4b8df66c9019454ce23638ea7f55d6a8bf7102f3b5b2c34b6584bb1df5ca70f781e7ca106c7e6f9af06f9aeac3a6dae75caef4949819e57c80bbfba375889e19deefad6bb516b0ae9d9cc4ba9ede041190474cfd57b16ae11e93b3f76596786aa666fdfd6734cf27cc976507873f1ce96bf959a72c776bfc8edbbc869cb2207fac47f25d713f15354bc18a1b5e92a57370eefbfda661ea00f1c63aada90c2ca78db1c4c6c71b461ad68000f800b940c20d5d4fc0fa2b939b36a9bbdcb54543460b6aa62d886f9c0634edd4accec3a22c1a7306d967a3a278fc71c239ffbc4657bdca3c94a0c775b68db7eb9d3f5169b947cd0c9ef31edfbd1bc74737d42d6941ac6fbc26a56d9f57db6a2f5678f31c578a388ca5d1f8091bf55bb394792a3e36c8d2d73439a460823628348d978d9c1fb2cd356d03a8ed95446247c76e7472019f1c37385dcaeed51a221c3685d72bb1fff000a85ee1f985b3a4d2965964748fb3d03e477de7ba95849f89c2ef53dba9a940ee29a187ffe3606fe8834d47c6fd61a82363f4e70d6e53d3b8902a2be46c2df42075465af8d7a9d8054dd6cda5a32ee6229e3efa56b7cb3d16ec2df30ae834d53f679a7ba548aad53a92efa926db314b398e1cf97282b3bd3bc35d33a62360b6d928e07373895d187bfe6e3baca91051ac0d18680d036c00a79479655910111101111011110111101111011110111101141384072825111011110111101111011110111105012a5aaa73e594693e3b20e4445571c209e51e4a54732a677eb8417270aa7743f1518dd0577f056194e552825dd5429728413caa4744232aa01f341744440444404503a2940504654a20e29236c8d2c7b439ae1821c320fa15aef54f67fd0faae4967a8b1c3475926e6b284982518e9bb70b64a20d1eee06eafb1c6c669ae28de29299aecfb3dc226d4b40f204eeaa2cbc6fb307360d4162bcb31906aa98b24ebe43e4b78f28f24e51e4834cd26abe32d3c23da346592bce40e7a7b977791e270775c8389bc4ba5daa7863248efff0016e31b875f55b85c98cb506a3878db7d89ae15dc36d454ee6e43bbb6b6403e18eab97ff981a367289f4aea6a625b977796f76df9adaa1be1e1e4ae07d506b18fb426972de69a3bb529c67135be41fa02b9a3e3fe8d7b9ed15f50d73719e6a3947ea16c67b43b62011e442a3a08dc49746d24f525a1060b0f1c347ccd791737b5cdcfbaea69727001fe1f5547f1c74a372195755263f868e439f1f259e7b3c5cdcddd339ba6794657236368e8d03e4835dbb8db6697229282ed58720011d1b8788f35ca78937599ad75168cbdd4b5dcdff143211b1dbaf9ad84a3947920d7e3506bcb860d3e98a1b7b1c010eaeaee623e218ac2c3ae6e78159a8a8edb11fbedb6d212ef802ffd567ea3947920c021e15453730b9dfaf5747b8e70eac31371e5cad3d17ad6ae1ae97b2ccd9e92cb491cc0e44af673bb3e79764e564fcbbedb05741c3140c859c91b1ac67f0b4003e8b94340f05288231e38dd4a220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220e2f05390075c2354a08327aa73646ea0b798e7032a7eb9411cdb11955765cddb20ab777be7c55834f8841c4d3ccf76fb8db0b9550b0877bbcadf3db7566e47524fc505ce15543bd559bd103e4a01f30ac7a2aa0b0e8a5437a29414566f4554417450de8a50141ca944103a29444044440444404444044440444405572b2202222022220222202222022220222202a3b3e1d71b2ba20e08e473e57b4c6e6b5bb0713d573aa8006c0602b20222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220e3dc6c370a5110139bc14b93f0a09030a555aac80aae527a2aa02b0e8a1aac808aae52de8820752a4f450dfbc54bba20a7e2528a5c82114ee542096ab2220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220e36ab0ea8882aefba54a220ba22202a22202b37a222087296f444412888808888088880aae44412de8a511011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111107fffd9, '../../../admin/assets/img/firmas/CAMILO RESTREPO.jpg', 2, 1, 2);
INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `email`, `user`, `clave`, `firma`, `urlfirma`, `rol`, `id_modulo`, `id_cargo`) VALUES
(3, 'BERNEY', 'MONTOYA', 'bm@z.com', 'bmontoya', '264e42adc0c8a830a100c3a426e501c3', 0xffd8ffe000104a46494600010101009600960000ffdb0043000302020302020303030304030304050805050404050a070706080c0a0c0c0b0a0b0b0d0e12100d0e110e0b0b1016101113141515150c0f171816141812141514ffdb00430103040405040509050509140d0b0d1414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414ffc0001108013802c303012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00fd53a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a4ac1f1878fbc3be00d3fedde22d62d347b527024ba902e7e83a9af03f167ed84de25d4c7873e12e8177e2ed7263b63bf784a5920eefb8fde03d78140d2b9f4dd4135f5b5be4cb71144075dee062be6187e1bfed05f12ae3ecfe2cf185af83f4c8c8907f622a995dbd32a7a7d4d6b5bfec3de14ba91e6d7bc45e22d76e2462f2b4d7a50393ea0521dbccf60d43e2f78234b90a5df8b74681c12a55afa3c823a8eb58f27ed1bf0ca291a36f1be8fbd4e0e2e01fd6b9bd1ff639f84fa3b4857c309765fafdae6793f1e4d4f7dfb21fc28bcb768bfe1148200cdbb74323ab7d339e946a1a1d7687f1b7c05e24b96b7d37c5da4dd4cabb8a0b95538f5e715d7da5f5bdfc425b5b88ae623d1e170c3f315e1da97ec49f09352b2f20f879ede4030b710dcbac8bee0e6b94b7fd8b6f7c0f0cf3fc3ff889ade857bc324570e1e1620f4603b7e146a1a1f51d15f1b5e7c78f8e1f00a4ddf113c289e29d077328d4b4e037281d18b2020038cfcc075afa3fe10fc62f0efc69f0b45ad68173bc7ddb8b57204b6efdd587f5ef45c563baa28a298828a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a42715e09f1dff006baf0c7c232da4e9a3fe125f164836c3a6d99dea8c7a798c3a73d873401ed3e21f13695e13d2e5d4758bfb7d36ca21979ae1c2a8fcfa9f615f2b7c41fdacbc49f123c4cde10f81f61fdb372222d71ac3c47627a942d851f53dfa562e91fb3ffc4ffda6b50d3bc47f167561a2681feb20d06cc149150f2015e8a48ee726beb1f03fc37f0dfc37d2d2c3c3ba45b6990aa2a3345180f260705dbab1fad229687cebf0f3f635bbf12de47e22f8c5ae5d78af556f9974b79cb41164e70c7bfd0607d6be9fd1f41d3bc3f650da69b636f636d0a08e38ade308aaa3a0e2b428a6212968a281051451400514514015b50d3edf56b0b8b2bb8567b5b88da29627190ea46083f857c3df113c2717ec77fb43f85bc57e1b5921f06f892536579a6ac8db6390900903b8190467debeeaaf91ff00e0a3d7da759fc2bd0da7dc3538f5259acdd470bb71bb3fa5035b9f5ac32acf0a489ca3a861f4229f5f1e7857f6f21e22d3b4dd23c21f0ff5cf176af0d9c627fb30091860a01c672719146b5fb6cf8fbc0b126a5e30f837a8e8da179811eefcf394cfd5714058fb0e8ac1f0278db4bf88be11d2fc47a34de7e9ba8c0b3c4c78600f5561d883c1fa56f5020a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a2a2baba82c6de49ee268e08235dcf248c15540ee49e82b0acfe23785752f154be19b4f11e9773e228adc5dbe950ddc6f72b09c6243183b82fccbce31c8a00e8a8a4c83c8aaba86ad65a4ac4d7b7705a2cd2086333c8103b9ce1467a9383c7b5005ba2a86b5ad5b68160f7976cc96ea554b22339cb10aa02a82492481c55ea005a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800acaf1278ab48f07e952ea5adea56da5584632d71752045fa73d4fb0af35f8e7fb4ef843e05da98b53b837dad4885a1d2ed48321f42e7f807d6be63f08fc28f887fb6678b13c4df11a5bad03c130b896d74c50d189508c858c1ed8eae79e695c76ea6afc41f8f1e3cfda93c4973e0df8410cf61a04276ddeb2c4c4655ce092dfc2bec3935ee1f007f64df0c7c19b54beba45d7fc51261e5d4aed43f96ddc440fdde7bf5af5df09f83f46f03e8d6fa5685a75be9b63028548a040b9c7727b9f735b34c2fd828a28a041451450014514500145145001451587e34f17e9de03f0bea5af6ab3adbd8d8c2d348cc7d07007a93d28039ef8cff0019341f825e0db8d775b9c29c14b6b607e79e4c70a07a7a9ed5f99bfb4c7887e23fc50fecaf13f8de09b4ad37537c689a38042f944fde0a7bf4e4f26bdebe0cf8675dfdb37e2bc9f10bc6d1ac9e07d1a5682c74b6056299c1ca803b81c124f535a3e336b6fda0bf6d4d07c3b66219fc3fe0c8c492843ba2629c918e99dc40fc2a5948fac3e0ff00856d3c27f0dfc396705941692c7a7c224f2a15424ec04e703ad60fed41f65ff8503e38377089e21a6ca4230c8dd8f94fe0715ea2aa154003007000af97bf6fdf88f2f85fe165af866c82c97de26b8169b39dfe5820b6d1ee768fc69f417537bf60fd2e7d2ff66bf0ef9e49fb44934d18231842e401fa57d095c7fc21f0927817e18f86743487c86b3b189248c9c9121505f3ff000226bb0a60c28a28a0414514500145145001451450014514500145145001451450015ccebdf123c31e1cd76cf43d4bc43a6699acdec524f6b677b72913cc8806f2a188ddb72338e40e6af78835cb9d1ae3498e0d22f7545bdbb5b6964b5d9b6d10824cb26e60760c63e504f3d2be5af8cdf0b7e2240ab6317c3ff09fc5af065d0d5355d5f4bd55cadcb5e15cda8b7693254ed55438c67270450057d5bc73f1afc411f8960b2f899f04eff451e75cc123b3cccb163e4b7963321509d8c84923d0d53fd9ef475f8a5ac6abaffc4bb0f85da7f893c2f73097d67e1eeb416f6dde2caf957be5e02a606dd8cd83b7057e515e45f097f671f01f88359169f13bf64c3e0dbdbad3df51d2df47bfbabbb7b9645ded6f2e241e4ca063e56c64f0335e0ba77c76fd9afc3ede36f0ef8ebe03f89fe1ede5f34563368fa4ea1729be0051cbcf1c922e25475665c8236b0c60e4900fbffe37fc31f8cbe1ef17eabf107e14fc56b3b1b4b889646f077891049a7dc480758e566fdd17fcb9af49f881e26f1ae9b2f84edbfe158d8f8de1583ed7ac6a4751860834d9d147cd0a488cf21cef23680718e6be28bbd37f636f8a1e07b6b19fe27f882c6e2778efad352f135f5ec93c4216566483ed0a60e768421413d857b1789bc05fb50437961e31f84ff1634ef17786b54b28678343f1669e968eb1bc4bb5f2a9c3630dfc3c9391da803a1f07fed07e04d03c5d2c37d078cbe165b5eeb8d37f68f8a206fec9d626688a98a2b8767448f2c1860a0dca39cfcb5f57c7750cd1a3c722ba38dcaca72187a8f515f0478fbf69af8a9f0a7e2c786edbe237c3131d85be9c6f758d5342d426bfb0bc8d10aa2a46d1055944c633c0046472457b1c5f147e18fc50d4bc3df10f41d6aeed1f45d121d5a1b8d35d9e596ca695e36b396c5324fcc9fddc83f74d007d33457210c9e25d5bc4fa2ea9a7df5adbf8525b393edba5df59ba5e79a76989d1f3f2e3e656461df39e2b674af1358eb179a95a5bfda04fa74e2dee04f6b242379191b19d409063f89091ef401ad45203b86452d00145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514c96548636924758d141666638000ea49f4a00733055249000e4935f2f7ed1dfb6358782649bc25e04dbe21f1adc7ee41b71e64568c78c923ef3fa28fc6b82f8fbfb536b9f153c493fc2ff8416d35fdc4cc6def756817391d19633d02fab1af6afd9b3f65bd0be08e8315cddc10ea9e2bb8024bad46640cd1b119d899e807af5340fccf33f807fb175cc7af0f1bfc55ba1afebf3309d2c656f3111cf3ba527ef1f451c0afafe38d618d51142228c2aa8c003d053a8a01b6c28a28a041451450014514500145145001451494011dd5d45676d2dc4ee2286252eeedd1540c935f0b78bb5df107ed9df16dbc37a349227c37d2ae02cd73082125c7595b3d4f50a2bbbfdb0fe37ea6fa8587c27f044ac7c4fae4896f75247c18a37e3683d89ee7b0acff001278eb49fd8a7e0ee9de0bd005b6adf106f1433430a962d2b9c798c3a9c74553d690cd9fda3be28697fb31fc24d3fc09e063e5f88af17ecd636f6e434b1293f34ad8fe239e3eb5d37ec7ff00b3f8f84be0b1ad6b08f278c35b5fb45fcb23659031dc13ea33cfbd737fb31feccba969fad4ff0012fe26bff6b78db52fde456f758905983ce79fe3ed8fe115f53d021971711dac124d348b1451a96777380a07524d7c6de15b39bf69cfdaae7f15aedbdf02f83dbecf6c674dd14b2e0fdc078277739f402ba8fdb4be2dbae8f07c32f0cccd71e2bd79d22961841261858f3b88e84d7b57c13f85fa7fc22f873a4f87ac6da3b7922895eed90e4cb39037b13df9a0adb53baa5a28a64851451400514514005145140051451400514514005145140086b83f157c50f0f7867c65a6691a878c34ad2ef248269ce852ed7bdba508583c6a1b700a158f08738e2ba7d4bc51a6693ace9ba4ddddac3a86a5bfec90b039976005f0718e011d4f7af1df8c3a66bd6375e1ef1ae8fe0b4d43598f55874bd634f86d20bab8bcd2657f2a53e6637a88c3f9a0061f708208268037bc5dfb557c29f03c1a14fae78bed6ced75cb38f51d3ee7c89a48a6b77384937aa15556edb88af1df146b1e0af1ec9e27f1b691fb4e5e7879a602cb4f306a304565a433e50a3db3e04858c6f82f865c3152319ad0f897e26f127c2df193f81fc09f03e0f17e9b6de17b75d2a78d4456b0c09294fb1cacd918182ca0723a9f5a9be28686bf1534ab2b7d4fe0c7833c45e1f5b79a34b7d77518a1b84d5238df65bdb911947576fdd8915c1197ca8c11401f2df862d7e32f827c51e24d174efdb0bc27e23d76e34f6934eb5bfd61641b8f28ff00be8a48c1c7f0ab0af41f09ff00c342e9ff000bed45df847e1ffed13aaeae261aa6b4350b6904710384b47654db2804b3718037631904d7827892df4df8577f1eb5af7ec17f61d12df097d3c97d71748ac4e098fe56423d323f115ca7c52d27f650b6d374ef1068d67f173c01a8ea08f34fe1dd2e12aba7aa95065617039425c005242b90471d2803d835ef0ef8c3c43e051e1ff8b1fb188d474cd162f2b4293c1f74207b28c9cb26f5919c8ef8e412064570de069be1a58dec5a3e9be3af8dff000961d59d2c753d0b55b696e0322fee92de39d5061559db208036f07a563782afbc1d3f86e3b6f067edade28f0b417b22c69a5ebd0de5a496ae08392d1dc6cc1e85882bcfe35ef3f0f3c17f147e28786ded6cff006d2d16ff00489a58d64bbb48235d4a1f2f2a55599924527b9cfcc4039f500a7a8f88be3ffec17aeeb5aa788f578bc69f03440b05adff00951bb59348bb2d99212e1f22464de9b8865ce0838c70ba4fc54f839ff0500f107c3cd3356babdf84bf10b4e5682e66d282da5adfb48c5dd619973b1bcd2d222b8cb163939e6bd0744f86ff00b567846c7c6b67a8ea7e1afda2fe1d88658c69be21bf4ba6bad837a320219848081fbb62431181ce18795ead77e03f8ad27867c27f1f7e1ac3f007e255d3eeb2f145b696f67a4dd408cc238e5816e1083f301bcb7057865076d007d1df0bfc6df1cbf668f146b36fe34d4ee3e2f7c2992e7ec561e20ba952d353b6b90c1161293846959d885c65b731055b935ef965e28f879fb4e43a5c3a8695ad585cc51aea3a60d6619b4e977b2e0490a961be48cf3c83b48c8f5ae37c11f0f7e297c2bf06f87fc2fe11d7341f8c3a2d95a1bd9f52f196a922dc5cc9bc7d9e28362ca228d76ee5625c6508f97a8f2cd27e247823c6d2783b4ffda03519be117c46f05eb92cba1e9916a370af2aeef2d1bed132bfda55b8f9c373ea3a5007d99f0a3c13a97c3cf02e99e1fd53c51a878c6e2c4346babea8aa2e658f7131890afde6552aa58f2db727935d8578fdf686bf077c09e22bbf1578f7c53aff0086a3b445df3a86beb3551b4b4735ac692b12367272d904e7e635adf07fe36781fe2658fd83c31ad35c5ed80115c699a99922d460e320cb14bfbcc91cee39cfad007a551499cf4a5a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a2b37c45e22d3bc27a2de6adab5dc763a7da46659a794e02a819a009b56d5acb41d36e750d46ea2b2b1b6432cd713b054451d4926be17f8b5f1f3c4ffb5878913e1cfc2782eadb43690aea3abb65165407a923eec78edd5ab17c5df10bc65fb757c407f07f84de6d13c056cc4dc5c1c812460ffac971dce06d5afb4fe0f7c1bf0efc14f0941a1f87ed446a006b8ba61fbcb8931cbb1fe9da914b4327e03fecff00e1df813e198ac74c8127d52441f6dd49d7f793b77e7b2fa0af51a28a648514514005145140051457927c40fda5bc2be05f165a785e3f3b5cf115c3a28b0d3f0c5371c0dc73c1f6a43b5f63d6e8a646e648d58a94246769ea3da9f4c41451450015c07c6cf8bda3fc17f02dfebbaa4ca255465b5b60c03cf2e38503ebd6bb3d5757b2d0ec64bcd42ee1b2b58c65e69dc228fc4d7e677ed45f15754fdadbe2b58782fc01a53eab67a4cae914d065bcf6270d231e8a83de81a38ef863f1a354f0cf8cb52f17ff0065c7e22f1e6bd2345a5c3393235a3b938703d79c0afb2bf675fd92ef7c3be273f11be24dff00f6ef8e2e49992063ba2b3661ce7fbce3db81daaefeccff00b17683f05d6d75dd65c6b5e2dd8ade6b28f2ad1b1c88c7723fbc6be97a4914e5d84af3bf8e9f19749f827e05bcd6f50951aeca94b3b4ce5e794f4007523d6babf1778c347f02e8377acebb7d169fa75b2ee92694e3b7403b93d80af933e14780f52fdaa3e285c7c4bf1a4333783ac252ba169b302b1ce14f0fb7d0633ee6992bb9d57ec87f0c754d56e354f8b5e351f69f12f881b75a2ce996b5833c6dcf4cff002afa8a9238d628d51142a28c2aa8c003d053a806ee145145020a28a2800a28a2800a28a2800a28a2800a28a2800aabaa6a969a2e9b75a85fdcc567656b1b4d3dc4ec1523451966627a00055892458a367760a8a3258f40077af32f8a5e24f13eafe12b23e01d1bc37e2ab2d55962b8b9d72fca5a476ee76b49e5843e7a819253729207193c50062683f1cb5cf89d63a0ea3e06f04dddd68f7fabc96ffdb3ad3a5bdb1d3e2c87bd882b3390ed858d582b37271819ae33f6cc97e28f8dacf46f871f0be3b8d3ee3582b75ab788b4f9d16ef4db38e68c31891e489599999723cc04a87c0ee0f889fb41f81fc27f0d3c65f16346d675cd5d345b692cedade24996c8dc87307ee21902c659648db70cf1b58f4604f99e9be15f8c3fb415e7823c5f71636966b1f86dd64d627967d12e12f5fe7014459927b67c44590ec195cab671401d5eb5f0bff68ff877f0fec0f80fc6a351bcb196e164d0f5a922d45ae23f3cfd9dc5dce8af8f2b1be3dc083f71bb527c62f0dfc46b39fc36f7fe03f87be22f04a5a45341e1fba7688d9788d9a42b3a48caa7cb779020c02c1a4390325873f6df017c75e0cd5bc2dabeadf1e2e354f06b46a9a9ea7af6bede5df79a8eae90c3b44617e642a4b96ca9391d2b2f47fd8fa3f096b1e17b9f14fc77f13d9df6844de6933693bedf4c6b38cabbf9cee1d77305c3e64e4720738a00b575e19fda6bc41e2082eacaff00c3d75ab58584d169fa878b74586c04374c32c2d96399de45fe1dd24414e33fed57947c46f8c9f1f740f1e58ffc2cdb3f85cf71a5d97d8c786df5790ff6bc776638da496085df31c7220c9955514b311900119f6bf08fc17a7f8c354f8cfacfed6b6da7e837535dc1a7b69f379f711ab02b2247e7b392e07f722cf715c078cbf632d37c49e1761f09be38df6a56579a43789354ff0084abce85df4adcc82402281a693e689cb46571c21c648a00a3e2ad47f663f097c46d73c41e33d03c217fa6dc5a88a7f0d780754b8d51ae2e9c80cf03bac115aaa72d856c92300e0e0f0b71e03fd8cbc4de288ed744f885e3cd04eb9bded65b9b4823b2d01b0484ba794079572303cb663c8c9279ae7bc2be054bcd065b9d37e217c1d8f4eb1712b78735bfb45b4b3a6e036979edc3396efb643807a8aeef41d4646f0de9be1dff008669f863e30fed496571ff0008cebf1dcea5768a486302c374f2ab0ec42900638a00a3f0fbf677f8f5e10f0f788b56f811f1113c57e1f96330df7fc23f7d2d9c93c6e182b882e150be403b5937720e09c566e9ff00b6f78e74fbdb9f067ed0fe104f881a34766f60f6fabd84769abd80231e6437063ddbb8e77673d723be8dc780be025c6a53e877f37c55fd9cf55b9754d9af42d77a7e7b198e124001e32463b922bd0bc2adf197e15786eeaefc1179e03fda9fc21a5a3451dca449aa6a1a6447ef23444f9ea840fba0ba81cf1400ff00d9de7d33c41e19fecffd99fe2b4de0bf17df3edd5bc3be3ebd02f9edd124548ac6e163f28a7ef19b84dcad86c8da01d9fda1fe387803e33341f0dbf696d07c45f0ebc67e1abd921b3f176830add5b30e80b9650ee84609c29e79056b9ef04f807f666fdb5e77b7b369bf67df8bc0e4e9b1ca0585c4e0fde851f68273cec051fd33826bd37c41f0aff68dfd977c329378ca1d17f68ff84565ff001f7a6de446e2fad6dc75923f314ba6073f2b381dc639a00daf80ba57c68fd9d3c37e28f11f837c670fed21f0c16d164d2f4dd2ee04f7524e5d061d5999e1511f99b82172485caf071b9ae7c44f819fb4efc5cf02dff8a6efc59f0bfe2b2471e9da4e9525a4b6b3a5d4ceae8c6544db261976e243b79e8335e15f037e10af89fe206a7e30fd903e35d9f8726990dcdc780fc48b243736ebc168de3c3acf182400c1481903757d37f0eec6c3f68e93c0da6fed11e1d5d3fe2fe9b73757da6b69d3369d2c715bb02b2347e62c849c16f954a8e32549c5007d3df09dbc69a2fdbfc3be27b392f6cb4d758b4cf11497693cb7f6e15555ae3eeb7da090ccc55027cc0024835e915e0d65e1ef14e9bf12352f89f63e35d67c6be08d434ffb45af85f4c9611021d8810c11940252c016dc654e49e1b3c7b2f8675e4f1368767a9c56d77671dcc62416f7f6ed04f1f62af1b72a411fe191cd006a5145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514572ff0011fe23687f0b7c2b79af6bd7d0d95adba12a246c195f1c228ee4fb5006bebfe20b0f0c69175a9ea7751da59dba3492492b0030067f3afcefd63c4fe35fdbdbe271d074a9a4d23c07a7ccc5d90379623078924fef3903807d6934bb5f88ff00b7d78dda6bbb89345f87f633ff00cb3cac2833f7547f1b91dcf4afbf7c03f0ebc3ff000cfc3f6fa4787f4db7d3eda2455668a30ad29031b9c8ea4f5e7d69149ab19ff09fe11f877e0df8561d0fc3d68b0443e69a7603ccb87c72ee7b9fe55dad14532428a28a0028a28a0028a42428249c0af8bbf6a5fdafa6fb45df817e1f4c64bc7260bdd5e3e4479e19223ebdb75033aef8f5fb5f0f0cf88a7f06782e18b53d731e4cb799de9048dc05503ab0ad8fd99bf66f5f04acfe2cf16da4377e30bf93cf1249f335b83ce3d37727e95e63fb25fecaceb791f8bfc4f1c8615712416b72a77cd20e448d9ec09fc6bedaa95aea3db4414515c47c4ff8cde12f843a3b6a1e26d5a2b25fe0b70774d21f4541cd51276f5e6ff173f682f05fc16b09a5f10eab1a5f2c7e645a6c3f35c4d9ce005ec091d4f15f336b5fb547c4bfda2356bbf0d7c1cf0fbd858fdd975cb83878d7b92df7533f89ad6d27f641f0cfc37d06f7e207c5ed727f18ea5636c6e2786e663f670c39099272f9380338193d2819f30fed07fb4978aff694f1458e9563693693a4c92ac165a644e4bc8cc7019c8ea4e7f0afd00fd967f67ed3fe03fc39b3b26b5b73e22ba4f3751bc4505dd8f3b377a0e95f357ec83f0965f8a1f182efe29cda57f62f85ec647fec7b3553b189c81b491c851dfdebefea2e37d82b1fc59e2dd2bc0fa0ddeb3ad5e4763a7db2ee796438fc07a93d8554f1f78fb46f86be19bbd735bba4b5b4b75240623748dd9547726be4fd1f42f1afeda5e22b6d57c470bf87fe17d95c7990d872ad7db4f1f5c8eadd076a4248a1610788ff006e3f884b777d6d71a47c2bd2270618c92a6ec83d33fc44e39ec01afb5b47d1ecf40d2edb4ed3ede3b4b2b6411c50c630aaa3a0149a368b63e1ed32df4ed36d21b1b1b740914102854403b002aed30b85145140828a28a0028a28a0028a28a0028a28a0028a28a0028a2a39a410c6ce73b5464e076a00c1f1b7898f8574b5be7b769acd640975329c9b68cab7ef36005a4f9822ec5f98efe3a57cfb79f0fb5593e18dfea1fb4278b6d3c43a2d8ea126a862d26c6648c5bb2911465235f354c64ab0dbce4739a87c17f187c45f133e2678c6e7e1df83efb46d02def218356f1778ca49e1b79c44ae8e2ced5c800270db86d0dceeea31ea3a878f3c03e1bf0debff00137ed1a6f886eb47d3bcbd5756f0e4497533c09f3ec0109247190b938c50066786e6d4a6f819e1a3f0c7c2dfd9b64d2c719d17c5cb24537d899d96663b8b379841f306fceeef8dd5e583e1dfc7cf05789be27dd7887e2ff87b4cf8793e8b2da787af2f6de2b48f4d9dc80b33a28458fcb1bb9de4138e2bd4dfe235d7c4fd074d1a27882d7c2fa4f8bacd8e83ab42186aab26c56245acb195ca7cc1b3c0caf3c8af29f8a3f05fc37e20f84fa6a78dedf54f1d7861b538ae354d4be23788db4bfecad9ba233a2a05186ded88ff008b70ef8a00f2ab1b7f80bf0a2eb57f136b3f1b65d7b4dd2aca6d06f7c3364c9716b6b797b1c66ea4b585816dae573b0065424af518185f0dfe2d7eca1e13d62f6cb4af1af8b758b7934c9ec21d0f537bb5d22e05c2f9674ff27cb3b4bf04646d5f99811c83d57857e267c3ef85be18d6b4ab6d57c0fab599301b1d0be1569b35d6ad25d3b0db2fda26dfe7bae49cb86ff6b1d2bdafe227c56f1b7853c57a7e99a37c36d0f53d2df4f4bf8f55f156b36f617b7d72b1824ac0a858ba8237305e09200e45007e7aea9fb567ecb9a65e6956effb36dfddc96167fd9f2fdb35011b40a06d2bb40c4840fe360189ebcd771e11fdb03e007817e1ee99e1ef066b1f107e1cc519323b7f66c37373b7323a28b9dc19e31214cab7ca5508c77aeefc03f1c3e227ed79e3fb0bc4f1ada7c36b658e7b37d234ff0009b5fb5a5c4608cc97b716ed1842c37302c981c75ae7f52f17fc61586c24d7bf690f8386ca09a5b09b4cd4a2b4ba8f7248ca653108370dd8c8030067a9eb401f39f8a7c41fb3f78dfc487c49e31f8cbf1275fd70b17f36c3c31696f839ce00326d1f955cf136b1f057c71a2e8cd65f1bef340874c9d2eedd6ffc07026ae932b71bee2d42aba80a19727392724f18ea7c47f18354b3bbd4639bc55f00f5a9ad2444261f05473c2fb8e03197ecf855c900927a9c735d29f177c5ef0feb96fe08b9f067c02f14ea3e208239b4dd22cf4fb2db710b024184c7b14ee00e32d9e38a00ecac3c6bf1d3f686f137806f7c1df103c1bf183c29a7dc6cd53438c4362d2c00aee17f67720b12c808f3114e371c7ad791f8abc57e04b5f8810ddeb5e03d73f656f15dc5c3db59eb7a0ddce8d1cab8dd2dc59baaeeb62c76f9911c6548c1c5731f11f45f87bf0d352fecaf893f05bc4ff03fc637a165b1d6bc3da9b5e5b4016452f3450c8e09e32bf2c876ee1c5775e0bd33e20f8b2facae23d13c3bfb5c7825bcab4b6bcbc01759b4de3ee4b2362e21d9c83e6968f8c83401b3f107c2bacdc68d6ba97c75f87ba5fc62f0a5c4a6187e2a7c389d12f624caed96e258c08dc10dcf9c011b705aaa787f5af8a5e15d4203fb30fc5fd4be25e83a59fb45df81f5bb88e4d460dbc32792e76dc438e3303b0fe75d86896be20f06f8aaf751fd972ce68eded62874ef10fc2a1729362fa39dd277ba170e7cc88ac813ce84e32803601af31f177c6ef0b7ed1575168fe28d06f7e04fc52f0e14b3d0758d32592d747d31cc99092468aad6e5db23cce473c62803d03e1af897e0a7c7af88179a8497575fb317c7b83642af0a8b4b35bb56904ac81f680f279811a29003f22e32735f4dfecffe3ef89fe0df8cd63f0e3e315ad8eb2d0dac977a678eb5968239ee37fca21b5750164c92a3036be09ca9af8d3e31fc4b9fe1dc16ff000f7f686f8596be38bb8fc9ba83e26693b2db537b775e2749e35fdf6d7dc159d807dbc8c8cd7d2f63f1a74efd967e1ef81e5f8a1aadcfc66f863a97fa77873c5b36942f67b16037462696463fbdfe14dbc8e496e31401f59f8a26bff05f893577d135b13eafab5820d1fc35acb0834c37319607ca95532acca0168c127e5dc00c9aafa3fc7887c33a469edf15ad6cfe1b6afa84cd05a5addde89e2b82bb5722655f2d59998ed8cb16da09ec71c2da7c4a9354b1bff8c7a1f8e26f1d7c2eb8d3de77d0749d3e292e74f902208de225891228321903e31c71d6b17c230fc4ef00783f4ff12e9bad37c4af05ea33aea7245e358cdaea3a45a31324931281cccca00da8a14019201e2803eb0073c8e94b5c37c31f19e97f1122d47c45e1df19d8f8b7c397722adaad88465b46550ae9e629cb648dd86008cfa57734005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005145799fc75f8f9e1cf80de176d4f5997cebd9430b3d3a23fbdb871d87a01dcd006b7c56f8c1e18f833e1b7d67c4d7eb6b0fdd8a15f9a59dbfba8bdffa57c5de1bf03f8b7f6f0f885ff096788da5d17e1dd84be5db5a0623cc507eea0eec7f89aacfc33f833e27fdb47c4d27c45f88b7d71a778652431e9da6db9c07404e5533f7541ead8e4e6beeaf0cf86b4ef07e8365a36936cb69a7d9c6228614e800feb487a5867853c27a4f82341b4d1b43b1874ed36d50247042b803dcfa93eb5af4514c41451450014514500148cc154b310aa06493d050cc14124e00e6be20fdb03f6a67bfbe9be1ef82eeb7c8cc12f353b398e77720c4b8edcf340d2b927ed61fb566a1abddcff0f7e19fdaaf7517630de5fe9e0b313d0c51ede7ea6b9efd943f647f12c9a9c5adf8db4f7d2ac6197cc7b5bbff005d72d9ce31d40cf735e8dfb0f7c18d63c16355d7bc49e1ff00b0dedd46a2d6f2790192453cb10bd467d4d7affc57fda7bc01f08ac6e1b54d6edeef528f2aba659c8249dd87f0903eefe352b5dc7b688f568e358d1554055518007402b8cf891f197c1ff09ac3ed5e27d6edb4e2ca4c76e5b74d2e3b2a0e4d7ca56bfb45fc67fda62e2f34ff00867e1f5f0c6899646d5ee796031d3cc236ab7fba09aed3e1afec1fa3c1247abfc48d5aebc67adb7cef0cb337911b641c039dcdf8f1542f5396f147ed79e3ff008d17f77a0fc13f0add490aafcfad5ca00ebfee86f957f124fb55bf877fb09df7897588fc4ff17bc433f8835591fcd934f590b21f677fe8a2beb9f0ff0086749f09e9eb63a369b6ba5d9af221b589635cfae00e4d69d2b0efd8c8f0cf84b45f05e971e9ba16996ba558a7482d6208bf538ea7dcd7c5bfb5078dfc43fb427c5cb6f82de0f629610ca0eab2646c6db866663e8bfcebe8bfda93e2f8f833f09751d5a09634d4ee08b5b3590f576e091f41935e61fb0dfc144f0af8464f887aebb4de22f102b4c1ee0106084b13d4f76ea4fa62975b02dae7d1de02f0759fc3ff0006e8fe1dd3f3f64d36d92dd09ea768e49fa9ae4be337c7cf0e7c1bd1e492f674bcd65c62d74985c19a563d323b0cf7ae03e27fed217bad7883fe103f85500d7bc533318e7d41706dac57bb96e848fcaaefc1ff00d95ed3c27af4be2af195f2f8b3c59337982e2705a3849eea1ba9f7a7e816eace37c0ff00067c57fb4178821f197c5b125a69309dfa77872362b1ed3c86619e9f5e4d7d536767069f690db5b4296f6f0a848e28d42aaa8e8001530e0629684ac26ee145145310514514005145140051451400514514005145140051451400573fe36f177fc217a1b6a2349d4f5b7f31614b3d26dccf3bb31c0f978c2fab1e057415e51f1fbe205b7c35d1749d6eff00c4579a3d8c77cb19d3f4ab35b9bdd5a66e21b5894ab70cdf7b03247f12f5a00e035bbaf1cfc4cf08f888fc52bad2fe0d7c3dd42d8426d22d447f6bf9619cca5eeb708610e04636aac995de0fdee25f17fc4bf0bfc3df106987e1f780350f88be2cd4608f4b97fe11d8824296b18186ba9db1161474dd93cf18157f43f867e22d534bbaf1afc53c78bf54b77b8bbb1f0ad8c6bf6182d980302182e084fb5226e0d26579765cb000d637c52d6bc5be27f85765e266f1137c07f87f1d93de7883ceb44fedc8e100feea220b470b9031b86e61918068030be2a5d689a07c74d0ee6f3e3d789fc34da89584f80746f2af8c539001638491a08f246415233c8207036bc5d26b3e26f06eb1e08bef86cde32d274bbc4b58b5ff008a7736c2c6fdcb829394542f200cc02ed8864ae38af01f87fe2ad2bc23e0d87c51f053c170fc20f0ddf5c86d6be2b7c5840ef7b01388dadf7ced2ced23173862aa31db3c6ce9b7de06d43c71716da2f85fc57fb437c4cb5791a4d7f56d49a0d0e5689a3977f98646b68634dea502a310540ebcd0068c3f15a7b05d3e2f87ede28d66e3429fec975a0fc34f085ad968d7123b3314492ee2661b176e640c15ba80a49153f847f67ff867f1c3c62755f8a7f0bfc7ba47892e3cf9e24f19ea2d75f68891312309a1626244f3176a6e41b8a955e38f67d0edbc5de26d52cb54d77e2ae9ba1dbdcdf4b0d9f87fc170c1243b931fe8ed752a334eea43063b101cf08b8af9dff6a4f1d5f6ad6be32d6b42f19f893f67eb7d35ed8eb5a95e40f2cfab48fe747008e08a42f1a2885cef503707e84ae28038af88bfb417c3a7f83a9f01745f87df137c53a05db082d75c9e0fecb56cbe51d6568c62307a168cae3ae6b8ed23e1febbf0afc3be2271fb38f867c4d6373a9d968f7b6be24d6a29ef2e1add42c775198e28a116f83b0bc6992fb99d9f26bc3bc2b67a37c5082fe3f147ed0de2cd4e38248da28bfe119bfbd37003038819a40109ff006c018ebc56dfc50f85bf06b5df11de8b6d7be2c7871e19991ef2e3c2b1dd6985140004496c61daa4863b9461b39c77201d8f807c33a5b5f6a66e7f62dd4aef49d566582586d7c45712daa3f980ab2065ca60ff0012b818f6ac2d4eebf67ef0afc42fb6f883c1ff0014ff00675f13c20c10c3a3dcb4b022efc0b88a47fde8c28f9829da4b71d2b375cf87bfb3d787cacfe07fda1fc73a6ebea124b232e8d752436530c7fad78903019fee8257d1b1cf5d7763f163c09a4e8da6f8f344d6ff0068ef832120d4adb53d2049b526c2b3a25c49099b623ab2f967606e49032450072ff11bc3fac697a4f88753bed323fda63c01aec8f6fa578b0dcdc4bade9b22c4591d26c33aaae72cacad192a01c67070fc3fe05f80de22f07daeb3f087e2378cfc29f162d21492dfc37aa22349a85d06188a199022827b649e9d2baad03c65f0efc3de2e7f137c14f8a7acfc0ff8897d7372975e1df1e5905d3842c15c47e6246d146859781206c9033b702b4349f06f8374f5d5b51fda83e19f8825bfd627fb641f12bc1930b8b09b0db80416dfba4e30bf202318ca83cd0072fadfc58f10693e38f0e587c51d5f5ef841e37d0679e5d1fc416da4ac7716ed2146924d422541f69599b20c88ed80843464357b5f8ebf688d0fe2b683a3f85ff68df869e668f793c26dbe26783e489ecefd54e04c18ae563c60baa36e03a85af20d0f47d7be247892e6ff00e1fd85afed05f0ba199dbfe108d6ee18eafa6405be5451239b8460a3e5962665e486eacb5eaff09fe1a5d687a24d07c0cf124adadcf74354bbf83ff1294db9161342331888b6db8dc0e448bb090477a00ced4b47d63c23e03d7fc10e743fda7be08e9b2b8b8baf0fca1b5bf0a41bdbfd5336e64c6d2579743b1864026ba7f82ba1dc7c35f8673f8d3e107c47b9f8b7f05ed1fccd77e1a5f58442ee0de7050098b08801f33b02b90a48dd5c6fecf325d2fc46935bf83de228fe1ff8fa39d34ad6fe0cf88da18e5bd8e1df2b5bd95c4a877211e67122868c6ef9cfcb9f55f80ba5dad8fc56f1c1f00f872dbe127c69d5632ba97c39f15df2dc68d776e1c3c92db18a30ecdfec6540ce47193401edde19f0cc1a5e9f21f855a749fb3eebd7421d4353f0e78834180e917d2b86852de565ff0056db6df3fe8f228c10c549639f50b1d4fc44c740f1578a3c157d63af698cda7df43a7ebb9d2eded1c664be44dca9320083e575322827033d7c324f881ad69f6f69a4780e0d07c6f15e5b4b65aa7c1cd6f555b7bfd32e60722e5eca59503cab976cac9d728c8c14e07d15f0fbc39a2f83d2187408c690b369af7f7de13f312e6e5e63b02b3485d880b868f683b4961cf18a00a3fb35fc43f845f1034bf105d7c286d3ededfedeefa959d9dbfd91bce3ff002dda12060480060e0618106bd9ebcafe13eb56df123c17a16a5a8e9527837c4ef04171aa68f006b59e299461e26e159e20d900fdd6038af53523a03400b45145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014515ce7c40f1f68ff000d3c2b7bafeb97496b636a85be6382ed8e117d493401ce7c6ff8e9e1bf813e139358d76e333b82b69631f32dcc98fbaa3d3d4f6af8efe0efc21f13fed85f115fe247c448e7b6f09c72936da7b332acaa3eec718ec9d093dea9f80fc3baf7edd7f19a5d7fc4f2496de09d15b315ac7c2edddf2c4a7a163fc46bf4374dd3adb48b0b7b2b3852dad2de358a28631854503000a0ad86e95a559e87a6dbd8585b4767656e8238a08576a228e800ab7451412145145001451450014515f3c7ed71fb4f69df047c253e9fa65f41278c6f136db5a7de6894f0646c74c0e99a00e33f6bcfda82db4b4b9f873e15b969b5cd423f26eefad5f3f640dc6d18fe23dfd0571df0e7c3ff00067f657f0cdb6afe2fd461f11f8eee225ba7b743e7bab9f982a81c2fb9635f327c21f03f8f3e34f8aa65f0fe9d2497776e5ae3589d1bcb8771f998bf4cfd39afb6fe10fec03e15f065e45aaf8b6fe4f186aa3e6314ebb6d8311ce57ab739ebf954ea69a247986adf1cfe34fed39a9c9a3f80745b8f0d7866e0f9325decc144ee5a6c0c67d16bd6be157ec1de0ff0b2fdbfc60dff00097eb6ec1da49b72c4a7bfcb9cb7d4d7d3163a7dae976b1dad9dbc56b6f18da9142815540ec00ab14ec4b7d8a7a568f63a158c565a75a43636910c2416e811147b015728a29921515cdc47676f24f3388e18d4bbbb1c00a0649a909c0c9e057c75fb64fed51a659e877bf0efc24edabf88353ff439a6b473b60dc71b411d5a803c7fe277c4ef0dfed29f1f125f126b3fd8df0e7c33bb6ee058ddb29e8800eac7f415ec1aa6a3f107f6a031e87e12b69bc19f0de15581ae651e5bdc443038c7b0e147e34ffd9cbf60fd2fc276369ab78eca6b3a83224d1e9bcf930375f9ff00bc7b63a57d7d6f6d159c090c112430c636ac71a85551e800a5b95738af84ff00067c35f077418f4ed0acc2ca57f7f7927334eddcb37d7b57754514c90a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800af25fda0bc453785746d2b50d0bc1bff09bf8f7ed2d6fe1cb131e561b89176bccf21e228957967cf4e9cd7ad578dfc72f8d1ff0a6ed52decadaf7c51e2ff11cad0683a05b43e61f315065982fcc215fbcedc9eb8140197a1fc5d1f0974ed23c27f113c61178bbe2aea71b5d7f6568960edf331f96348a14631420e104d3601c16247418df183e15783fc7dade87e30f8890ebbacdcc365bec3e1bc7389a19a78ff78c7ecc98fb4480ae72c4a8c678af3ef00c3e13fd93be285a43e2ed625f1ffc7ff8a1a8c7f6e6b089b7456cc5ce2156c84b58446472db982838f9703d17c71a3d9fecfbe6f8c586b5f12fe206b1a81d3b438f526321b5370e0186211a7ee6dd7ef39c13b54d00795fc6cf05693e2af137c3bbef8d9e2b5d30da5ccd3691f08fc300dc47a8b46cc2d084c077709c39daa8090a0a807752f0eeb5e2cf147c5a5f03f8eeded7c0de19800d5b4bf867e17b6c79b6f9cac9ab5ec40c50c4305da30df3ed230d8dadea3e14f86f61178f358f12ac96fa97c4ebe8e68356f1e70f69a0b958d52d2d125055d46d03cb0720862e417c5796eb9e1bd574d8351f0fdeea5aef833e0b69516a3ff09f78d3c5527d9aefc4534f17960dafde731fce42e028076ec048c100e675ff008cde2ed37c51e113a35fcbaa5aead13dce9fe15f82ba3acfa7dc2c9348b25c4ba84e850bab6558aa211b77715d478bbe0b0b8bcf137c33f0b58784fc21afebb696dae6a3abf8805e6b57f2d9ab1693ed2cf18837f9aceaa04a780e547395d3d3bf695f06780e3f01f86fe0268365a8785b57d2eeb50b9d62f44f63636767651f922576990120347b588196233c924d783787fe3b4977f1f354d235f9efbc71e2df13f85ccc56ce0b9bab0d367961631c5058bc8b13af952798cf232aece323730a00ba7e293e9f0da78674ff008c9e39d7a6d06586cb54d4fe15784e14b7bb8e77df0b8652c06c0447bb059b1c64735e01fb407c70f0bf8b2fc456fabfc6ef0c69718b98d8dfdd2cada86a6a51651229940526310ee0a484c2811f39af7ab1d1fc4ba7fc369fc41e144bc9fc1f7ba84d67e21d43c41e21d37c381e358fcb0bb6cd8a2ac64631bb7718d87ad7c81a57877c27368d3693e1bf885f0efc3fadfdae465bed424d551e06f94136d70d0b468a428c3901987a71401bbf0da1f86fe02d5f41bcbaf177c5ef0178ab505f356e6e34bb2fb34d1b70195e5993e5ff006d863e95e9b0fc48d07c3f1eafa57c2afda775dd2f57d46d9adefb4df88513cb15f4cc76aac53c2af0c002b121c3139f4032392d17c79f15b4992d746bcf8f7e00f12456d65258e9d25f6b2b20b42ca42ba5c496d90ca707e66e48e6b965bef0fae92ede33f135f5a6bd25cbc9776fabf83a0d4adeede462cf3fda62753245b89c3a31e08da08a00f5cf127817e21f847f67bd2f4df19f82bc11f18f459af2e24baf1841a95c6a373a246367335d5bf31a6d0f8237739cf2402ffd986ea2bad3a6b9f807f165bc237d2cc52f3e12f8da582f3edec01245b348628e60dd3042b0e72d9c0ac6d6fc2be06f04f84f41f17781be327f6578e353023bd8bc06bbf4cb48172565bbb138b854c021b2ae1490707a1f48d7fc2f747e1bc43e2cf823c1d6b7de32b396d346f8a5e0bb3fb44b0ac0cae2f6e21b742a91ba953e747865dd961d800721ab782fc17ac5f6b1378bbe1f789bf675f8c71892f3fb53c2b15d4fa5db4630df6b9e0425a18188652e8597863fc24577de1eb7bb4d1a583f68cb9d1ee06b9666cbc23f1e3c3b34771246db7e512dcc643a803043c8a3038240e6bacf86737c4d4f827e20f05ebfe28d2f4ef0a18a5d474af1cea97e9ad689a8d93ab2358ea374c576a31e55d4829f75802c81bc3fc05e19f1cfc13b7f88fe258acf4f16b8925d6be0eaef7d2ee34976f9ee602cec2684a729245b8a93f371401b1e2ab8d63e1efc42f0a59fc7b8aeb51b99003e1ff8e1e01655bd8e3219559e65056e50479dc2451220271b94293f47fc4cfd96f46b8d27c3fe22f12f88fc49e3211b86b4f89fe17b755d7b4c52321aebc953f69b7c705f6174cf231923e67f0feb11781fc0537c4afd9e35797c43f0beda277f197c32f13ddf9d2e9464dca4c71ed2554876559939e79cfcc077bfb2bdd78bad6d2ef52f81b7f6be34f81faa45713ebfe06f116a3f65bdd064752648564505cb30cec9146d6e338eb401f47784747f117892d7e1c6be7c27e0df8d3af58ea8626f89da7ea70c52c56dbe411dc6c440c5d61d8acbbcfcc78dd938f4df09c7a0f8bec7c473fc25d4acbc15e21b6d665b5d5fed1a6accd2cf18398e689c86087787050ae7b1eb5f2df867c63a9ddfc37d0bc51fb210d12c7c0da6d92cbaff00862e617975459d276678fc9896591a6994850e41cac6b821457ae7c6af16781fc3367e12d4bc69e08b1d3b43f17dd25abebf63749a55d68933209156e242e85e4593764e54008d9cf4201efbe1fd42ff0050f17dc5b6a5e0bbdb2bdb6b5109f16ecb45b6bb6c7ccb1013b4e17392048807bd761a0d8dce9ba6c36f777d2ea53a6edd753aaabbe589190a00e010381dabcdfe18c3f10e0f887e314d76fecf57f87b3436b3786efd6546bae63026470aa06dc8dc18e49dc79af48d16c63d36dbc88a79ee50b33892e25f31b93d01f41e9401a34514500145145001451450014514500145145001451450014514500145145001451450014514500145145001451450014514500145145004771711dac324d348b1451a96777380a07524d7c11f12354f147edc3f1263f0cf8660974ef0268d395bbbf7398d981c17cf738e8b5da7edb1f19350d4f58d3fe0ff0085b79d5f5668c5e4884a95563f22023b1ce4d7d0ff0002fe13587c19f877a7787acd732aaf9b752939324c4658e7d3352f5d0ad91b9f0fbc03a3fc33f09d8787f44b54b6b2b48c27caa0191b1cbb7a926ba4a28aa2428a28a0028a28a002a3b8b88ad619269a458a28d4b3bb901540ea49ec2b9df881f123c3bf0bfc3f36b1e24d4e1d3ace31c798c37c87fba8bd58fd2bf39ff688fdaefc4df1a9ae34ad03ced07c23928551b125c8cf591bd3fd9140cf6ffda13fe0a0363e17b9bad03e1f5b47adea6a0c6fa9499f2636e9f201f788f5e95c2fecd7fb1fea5f193529be21fc5bfb6cb0ddc9e6dbe9d70c55eeb3cee73d427a0ef51fec5bfb27c1e2e41e31f155b2cba42499b1818fcd33a9fbc7fd907f3afd0a8e3586358d142a280aaa3a003a0a07e467f877c35a5784b48b7d2f46b0834dd3edd76456f6e81554569d145048514955b52d52cf47b392eefeea1b2b58c65e6b8902228f726802d571ff00113e2d7857e15e98d79e23d5e0b1f9731dbeeccd29f4441c935e07f123f6b6d53c57af4be0cf83da5b6bfac48de536b38cdb459e0b29ef8fef1e2b5fe16fec8e175eb6f197c4fd524f17f8b4112ac3336fb6b76ed807ef11f9522addce23c79e32f89ff1f3c0faeeb162cbf0efe1ddac4f30b8b90cb797a8a3db90a7f0fc6bccbf611f817078fbc6573e3ad5ad9a4d2b479bfd01cbf13dc67ef30ee075aef3f6b4f89da8fc57f1d69df053c1532e679847a8c8aa400c3aae47f0a8eb5f57fc29f87761f0afc05a478674e5021b2842bbff00cf47fe263f534c3a1d75145141214514500145145001451450014514500145145001451450014514500145145001451450015e037975a4e8ff00b426a5e1ef0b69d73aa78cf5cb337daf7886e2e165fec2b4dbb6dd10374dcc3e585463f89bae6bdabc5136a96fe1dd4a4d12dedeef594b691aca0bc90c70c9384263576009552d80480700d7ce9f15341d7be206ad71e08f877aae83e17f15eb4d0c9f11355b5769afac6d4c21631012065d87c8b9c6d5c1c0a00e13f662d37c2b63e20f8a5e23d0b41bef16f8c34ebf9b4bb1f1cf8e2645bff106af1c3299ad2db728f2614f2d5404c6433f65c0ef3c23e30f881f077e10e97e26f8adabd8d9adc4d71acf8b2fb579415d2e16394b0b4443f3b7455faf193815c7f86fc3fe1df88df10fc39e15f0b69aba2fc27f81f7f24d7da8dccaf1cb75aa240c046abc0654599e59256c966200c0273e37e3bf8a5a07ed29ae5a7c6cf1b69dab2fc2ff0008ea274cf087846de60f378ab57130d87c9c156538da41e403d719a00fa17c0b7da47c43fec1bed76d747f097c19d6ed562f0cf82353588cfae4f2389c5dc9015cabe72c1016c86defcd7897eda9a6f8b7c6d1ebfa3f89ee5f549a1855bc2ff08fc201a76bb8c4c8b15e6a6cb83e52c9b0ec4c6003c8e48e165f885e37d5fe3b5febbe2e6b2d23e36dee9aede1ef0f5e31974df00e95e5832df5d1ce3cf318042819cb02461c28f39d7be37e9f6fe09f16e9be14d7b52b9f055f868fc61f1575f6ceb7e27931f369fa7ab00423728a0e422b92c545006afc4bf8aff0efe2ff008bfc47a24578fade8b73e1ad2b45f0ef87fc3b6bf61b7b1badcc3cbba99885558d896d8adb096c618a935df7c03f1178a60d4bc43a3d969371f157c45a3e932f86f55d735bba8adbc29a745004112cb201b2e5551a6570413f228000f9abc07c32be02f1378ab43d4b52f0a5e7fc21d2ea291f827e106872ac5a9ea3b8022f2f6553bca9001f31d8b37f0908057d07f13bf6b63f0261f137813e2ee93a6ead71ac7d8e6d2be1c680206b0d12de390b2457d72cac1ccc4219142b9c0ed91401c57ed09f0af4bf1578b34cb2bfb0d4be256b16b24513fc3ff8671c963e1fd2498834971e73ab2c624e492a02e49e7159de15f0558f86f58f12c9a3fc1cf82565a3d9d9c8cd71e23f19c7a9cd64a000b34b895c12acca182c6324ed079159ff00b5cfc45f8d162de10ff85b1afdbd9f80bc424ffc511f0e2ed20710afdd8a46c6e7c8c0f9b728ec01e2b03f67dd67419a3f17b7843f66ff000a4fab436526a90ea9e30d6c5f5a585a2336e6b88266e8aa0e768ddb80f6a00824f14784e1f078d12ebe3c781edde6bcf34695e1ef8771dddb421810de5bcb6e1bccc918607a77af60f823ac6a7e11f1569dac7c18f8bbe1df15bc3125aebdf0ff00c4d6a9a2cf793aa6c92385e54dcd9652554b161d0d794f867e3078bfc47f102f34eb1d1be0ec33d9c297105bcbe0bb6b3b19dd972a867b85428b9c0c97048395cd53f8a9f13bc39f6c7b3f8a5f01f468b47b8d4eeef6e7c51f0ff5494c2f7921f2649e3218c6d878b88cba825491d7240377e2d6ade1c4bbbad7351f0debfe1dd5639a59754d0fc75e1f9658209bcc055ad758b648e68864fca5b72838e0f15c3feccdfb4f7c4ff06fc3ff00889616f3eac7e18ddc7345717e2ddaf9743b89c1db21652aeaad93b88e0939ea4e5de09b5f187c46f1269fe09f02f8b87c7ff87f6317f6a47e08f125fcfa7c8e8a76988c46556f31036e02376518dd820115db7fc235e18bef86ba8fc55fd9b6e756d375ad3638ad7c4bf0b276170a96c1764c658bef5d46c41258e719cf0460007a07ec67e1f86d3e076a167e11d797c7973a95935cea7f087c4f649047aca79a51aeaca577e5b0926245e331a860a54356aea571e1cf8b9f0bf55d7fe0f4775a1c3e15334dadf81750bf91353d06e146125d2e60ff00b805860853e537461dab83f871f113c23e1ef0d9d4f4eb3b8d63e0ecba6b457d750db23eb1f0c755b8fdcbcb6f230f3162777dc9b4e4edf54f9bd4e1f09d978fbc79a65f7c10f17e9507c67f0ad9fdb96f0456b159f8ef4f95b7b4d7060500ccd9c3ab8ca9ea075a00f13b5bebed1bc4fe10d49754b0f04fc43d66dda6d33c792695259dbf88914f9771a75f5b1658a3b95923689b726c937a97c1656a4d2fc4777a96adac78f3e1bf88a5f853f14fc07677373ad7c37d41a47b1be813f7971f625c9fddb852cd01c81d5481cd7a1ea5a9de78d0f8cb5793c253788bc21aa5fdff00fc263e05b8d2eddd3c1b7914612e7508a47909f3f3224c8c8a04ca1c1f996bc7a3d0e6d766d2be1f78cf598f44f89ba6e26f87df1195ca43a84039b7b4b9b81f2ba483fd5c992633f2b71401e95f04f5097c1dad0f8ebf00b4bd675ed0efacde1d57e1e68fe583a6df6e32c905d71b9edb991e1970cca3e4e0715e81e00f1bf8d3e0fdb5dfc50f0869faff00c59f82faccd797faa68126dbabbd3efe4685991a3640e8d1b075dd865db8caae335e47f0bf58f12fc1c997e2df817c33a85c6b16733787bc7df0dd56565b660ee26786dd530b0332bba9076c6ed2201815ef562d67f04f50d2be23fc22f0786f877e2806efc43e21bab56b98cc133a86b286c6168f1701d7ca53b0ab3484739cd007b6fc31d4ad341d61fe26699e23bfd4f42d434f07c510eb3acc778345648d5a081638004460ae0162a4ed00b115ebff00b3e6a5e16d7bc07fdb1e0d4ba8342d42eee278ed6797cc8e190c87cdf28866531b3ee70558a92c48f41e5fa2f86fc1df0024d1fc63e16f05ea1e12f0adec2f65ad687a6da4924c2591b7c124d669bbe604905f3b82b2a9f940c7be787f4f8eeef21d7e19f52b486eec638d748b9c4714433bc318b19493e620f3ec4702803a2a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800ac9f1678821f09f86754d66e14bc1616d25cbaaf521549c7e95ad5c77c62d06ff00c51f0afc55a4e940b6a379a74d15ba8382ce54e07e3d3f1a067ccffb14f82d3e22f883c4df1775c58ef2f6fafa58aca398990dbe1b248cf4c6401ec2bec9af9f3f619f056a9e06f80f6567ac42d6b7d35dcf2bdbc8855e2f9b6ed607bfcbfad7d07490e5b8514514c90a28a2800af2bf8ebfb42f873e06e8665bf996ef599d48b3d2e261e64add89f45f7ae67f69dfda82c3e06e96ba75846ba878b2f1736d68412b183c077c7e83bd783f80fe0afd8f43bcf8d7f1ba5b9d46e49fb4c1a3bf5607ee6e07a72785f4eb40ec71b7fe19f10fc7869be24fc63d4e4d0fc0f6a0bd9e9f092925d73c430293d38e5bf1ab5fb37fecc727c67d63fb7f55b66d2fc116d2ed82df90d7783c2aff00b3ea6bacf07f86f5efdb33e202ea9aabb68df0ff00456d90d8dba611973c44bdb240f98d7dc1a1e8963e1bd26d74cd36da3b3b1b5411c30c630a8a3a0a43f21da4e9167a0e9b6f61a7db4769676e81228625daaa07b55caf07fda93e385c7c38d16d740f0fc8afe2ad68f916e2360d2400f1bc27727b562fecdbf03fe23782f5e1e24f1978eef35486e6d88fec59199c2b3739724e011e80502b753e92accf1278934df0968b77ab6af771d8e9f6a86496794e1540feb5a75f14ff00c1433e320fec9d2fe18787dcdeebbab5c235d430725573848cfbb139c7b0a623cc6eff00e0a0fe2cb5f889e23beb010dc787e6631d8d84c9b826de15c1e08cf535ce6a3f1a34df88cd7bacfc58f14ea1788a55adfc2fa2e36c9eccd9da83f335dd683ff04cad5ef2cf42b8bcf16c36466895f52b736c5a48188ced8c83863db9c57d09e0bfd83be137852c638eef47975fbac624b9d466625cfaed5200a5a32f447817c17fda57c63e3ef18e9be11f859e0df0ef85f4f85f2eb226f90db29192efc64e3d3bd7d67fb46fc5e8be0cfc2bd4f5af3621ab3c7e4d842c7efcc7b81dc0ebf957c7bfb437c3fd17f67bfda0bc15a87c3fba9b4492f66592f2cade4f9204dea0903a80c09c8359bfb4878baf7f6a8fda1b46f077839bfb434db3c449329223247cd2c87d00e9f8531173f66cf1f7877e1b787755f88daacb3788be26ebd3496f6ba501b9d416e18f71b8f3eb5ed16bf0f7e3ff00c4fb39b5dbff001a8f043ca0b5be950c67818e0363eefe3cd7a1fc02fd96f42f83b6ab7979e56b5e236e4df491fcb00feec60f4faf5aebfe3d7891bc31f09fc47736f7eb61a8bda3c76926fdac6423002fbd023e5bfd977f6acf185d7c5d93e19f8d675d665f3a4b58af571bd244273961f794e3eb5f7257c21fb05feced716de21baf887e2286492e90b0b29598e1a46fbedcf27193cfa9afbc28dc185145140828a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a00a5acade36977634f310bf3130b733e7cb126d3b776013b738ce01e2be3bf1d78cbe38fc31f01f87be1978745a7c46f8e1af2cb36a5e238ed56ded34bb52c424d21014315042a97c13b7241e95f51fc40bcb7d0e2d2b5ed4b5fb8d134ad2af04d72908f92ec488f02452f04ec0f2abf1fc48a4f00d7cf7e2ef14f82fe04eb9f1cbc69e16b8d575ef1d7f6147adde25e5e34b67033e7ecd6d16fc88d9890e23dbd187d2803a5d43c05e38f0f7867c09e11f08eb5a15a787f4f9d65f1df882e245fb4dc3222cb70026300cec58c8cc430571c6335f17fc57f8bfa47887e243fc639a3b383e0f7c27d45b4df05e87a6b1893c41ab83ba368940c6c570199c03850477aee7c59e17f16f837e03783fe1693771fc61f8d5ac7f6878be7d16d879f6d60ed9bb72b90b1ed478a33d07fad1d062b3bc63a3d87c3ff0088579acaf85e0b9f853f0960ff008457c2be1fb8b7f35b54f104c02f9c10fcac448ca5a56fbbcfe001e73e2c1a5687f15b50d07c4b7f74dacf8fbc3d1788be28f8d2e23114fa1584aa932e9f67173e48044519ddbd983a0c0da2af78b3c05f0f3c5ff123c5baaeb53c8bfb3efc16d12d2e34cf0ec29e4a5f5dce8248e16246e6698e3731e58e178ed178b3e1bc3a7ea7e27d33c59ac4de27d7fc2cb6de2bf895acfcb30d6b569405d33458947fcb24638207072df2f4c59f1e7c17d4fc2ebab5d788a3bbd63c15a3687378efc616b71708905e6ba62cd969b32a74489b6208c9cec2c7b7001e43e04f895aa785ee355bcd274e13fed09f12d5a7b5d4d645b68bc27a64803c6c9c1f2d9a21bf8202445075e2bb4f815a241a9dbeb779e09d0ad7c677be1bb6bcbdf11fc5bbab0fb4df5ddc88d9c5ae951cadfeb89c84b87566e4b6ddaa01f1df87ba46bde30f885a6786a5d4633e38f8a76e2efc41ae4d082748d2e7fdf623c709be10b2337002ba26060e7adf0deb7a8e87a3df5f7826dd9b42d3354bbf07fc36b6b084acba96a57604571a8c8532d33240848639d8f343b40031401e9df08b58f08784fe1a586a9e15f09d85b7c5cd52d9f54d57c57e3ad4e3d4acb43d39a5237dc4afb424b2c7c88a28c392715e2a9e16f8190ebd7d3784be1ffc4ef8a1e6332bdc59ceba4e91212df37925629251116e143b6718ce6a2d797c31e08be78efb4b87c4fe08f86b32e9a6c9e436c3c55ad48e5a567201668d5896da7e61180322b7fe2a7ed17e2af1668f61e07f8a136bc45d4916a76bf0e7c076d6da5c5628e9fe8f0c936c96424c7b5c43e59c07562c58900029f883c03e05d42deeb50f1e7c09f8abe08b1601bfb6744d73fb5b601c29963b8847ca3d770ae3fe15783ee57c577371f01fe2adb5eea6b04891787fc4d6cba7dd5ec6460c42198c96d3923a2efc923ee838ae9ecfc3ff0015bc01a8687a97c39f016bbf0c6fa49d67857c51aec4d71a9e0711ac570b11950f740a437a5735f123c71a4f89bc33e23d13e27fc2b87c05f1356ed2f2cfc55a1e94d661a4e8f1dd5bab050a47cdbe25c823ee9c934018ba85b693e20f893e19b6d4ada1f81be2fb699cebbae5b4b2a5a5b346a4893ec689bede62401b55b6316180bc9afa074af07de789fc509a9c89aefc2df897a7132e87f14f5244d36d3c52e72f125e5b025564923c7ef51df7f5907cd5e76bac44bf0d6d3c39f15567f1643acdb4177ff09a6837493df68ba5a4f185569195d6e50b0dde4e5244f2f048cd5df1e7886cfc03f0b754f016ab72bf16fe1b4296d17863c4ad733476565752a0769119a1692365565df6f148029183bb1401d1ddf8374ff1e6a9aaf8ebe155cb786be37e8568ba87897e1b5c58c72596aaf83f689ed519b6cb19466768b6b0f9fe502bd17e06ea1f0cbc4fe2af0a7c5ff86d1ffc20ff0014edf0358d0355965b5d0ee18ffc7e3a4f213b576ee014301bb8c66be68d07c79abc767e16d0eeb5cb5b4f12f872e16e7c05f10ece17b6b79ca91bec659648d19a22d80aeebf238dadfbb90b0f71d3fc53a659ebdac7c585b7b4b5f87f7922e97f133e18dfc8619ac6eae3093bdb42d8474762645652a413d05007da1f1d3e26785fe0af8df42f8a50e81a2f8a3e1c7c4386d745f106a96ae5dd5159dadaeb664c52c5fbd6572406c05f98e02d792f8afe18e977d6de28f84e9159f823e0d78a36eafe16f1659b79d3a4cd2af9b6f8989f26120b700215524e48af2ef12f8ca6f0b7c4bb9fd9875a86cbfe14678daca04f086b96862492d2d660b3472c17127cb209255d8c1ce4b60823a37d1ba2b6b7e2df0cea9f0e7e315ed9687e21d66586c7c1369aee896f7316f862631ce9179932338d80b65c64918c500785c3e00f883a1ebfe22f12e857b7edf1d3e197d8ec759d224d511ecbc43a2b5b2b19ca02db669136964572778ddf79abe94f82fa6ea1a958f872f3c07aeeb7e26f86faa29b5d4bc2f71736e8be1f59158cc1e69585d79c924819718c2a30c65948cdf0ef8ab5bf15785e6b36d2753ff85ebe1788ded8eb3aa691616171e2441234721b75133215da9b1833654aa9209e29be20f8dd17c2f6d1be2e5f45ad7852c7c437b0e87e30f09ea568c5ec67dac16e4cabc44e3f84a8db2ef0bc1c32807d81a5f86f4bd1ef2e2eacece286f2e12349ee147ef255450a9bdbab6000327d2a2b7f0ada5af896e75c8ee2fc5d5c44219206be95ad700f0c202de5ab7fb4141f7ae67e1ae93a0fc3df0fd8e9f078a6ef5bfed79e4bab7bdd6351fb44d7924877b98c938c739da83033c0aefa80168a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a004031d2968a2800a28a2800af34f8fdf192cfe09f806e75a9505c5fc87c9b2b7fefca4704fb0ef5e975f9e5fb7078b8eb9f1aecb44ba6c69fa6c71a322499cab619ce3b360e290ceaff665f84f73f10b58bcf8cff142ed6ed37b4d64b76c3cbe3f8883c055e8054d7d6be23fdb3be264896b34da6fc34d1e7f28c8081e632f5c01f799b1c7a035c86ade28d7ff006a4f11693e03f05432e8be10d323440a7e5da14619e423f1c0afb7be177c3ab0f85be0bb0f0fe9ff003a40374b36306690fde73f5a45b7d4d8f0c785f4bf06e876ba468f671d869f6c81238625c01ee7d49f5af11fda0bf6b1d37e155e7fc239a15b7f6ff8b67fdd25ac2722190f0a1877393d2b63f69cfda02dbe0cf85c5a5886baf166aca61d36d6319218f01c8f62781dcd711fb347ecc3ff0008adc1f881f10dd753f1b5f9f3c7da5b725aeee7bffcb4f7ed4c9f366bfc05fd9eaee1d547c42f88cdfdafe35bbfdf451dc7cc2c41e800e9bbf957d155e35f123f6b4f87bf0de5b9b5b8d50ea7a943906d2c5779dc3f84b7415e1bff000dc9e2ff001f5ecda7f823c16d34b27eea262af2bc6c780cc40da3f1a62b33df7f690f8f9a4fc09f01de5fcd750b6b9346cba7d8b1cb492740c47f7475af98ff00611f83137c45f106a1f19bc5f27f695dcd772fd816619ccb9f9e53f43903e95a5ad7ec2be30f89da56a1aff8c7c56d2f8ae7859aded18992346c6551989c019f4e0549fb29fed0763f04f4d97e157c48824f0deaba65d3ac134a9fba2acd9c311db2490dd08353adc7d0fb82b33c4de24d3fc27a2dcea9a9ddc567690216692670a3a7039ee6bcc7e267ed59f0f7e1c78664d4ff00b7acf59b92b9b7b1d3e7592495bb0e33b47d6be7df077843c65fb59ea12f8ebe23dfcbe1cf87b66ed2d8e92afb048abcee20f6ff0068f5a62b1f367c52f1f6a7e2cf1cf883c6178cc6eef257b6d3c6dfe1e836fd0719f5afa03f610f1c7807c0363ac45e2878740f19cd37fc7e6a9f279d0900ed462300641c8cf3599fb3efc2bff85d5f1fae7c55159791e02f0f5db7d8c4885a2b82a711aa93d7b31afb43c7ff00047c13f13ad6183c45e1fb5bd109cc7228f2e45f60cb838f6a637638bf895fb5f7c3bf87fa3c9716fad5b788350231158e9b20919891c648e00af23f865e07f1a7ed49af1f18f8fc5de87e198e406c749d86333275f941e8beadd4d7af785ff639f855e11d7a3d5ecbc3825b989b7c6b77334d1a37a856e3f3af676921b65552c912e30a09007d05215ec47a769d6da4d8c167670a5bdac281238a3180a076ab35cc788be27784fc22ac758f1169b6057aa4b70bbffef9073fa579278abf6e2f85fe1b9963b7d4e6d6491cb58c5955f625b14c47d05457c6daa7fc14834486565b0f09de5c28070d2dc2ae7f4ae0f5eff828b78b24597fb2b41d3e1127fabf3433347f5e706819fa0b457c1df0dff6d7f8b7e25d62d6c7fe107875b17122856b78248f8271d4718f735f75d9c92cd690493c5e44cc8acf1673b188e467be0d0226a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a28039af883ad787fc3de1f8efbc4a6d45825edac711ba42cbf6a79d23b6c60121bce68f040e0907b57c47e0ff03ea3e2cfda9a2f061d72cefec740b83e2ff1cdd456e6ea1d5b56918f9768cd8291240bb5551c865dbc0cd7d9df187c6da17c37f86faef8abc462d5b4dd16d9aff65d6dc3cb18dd12aeefe32e142e39dc4639af8b7c6df1ead7e337eceba9786af1d3c2bf142f658f4abc5d362bb8f4e32deed1e7bc91c4572d19ced93e656247bd0068782fc473ff00c2caf1e7ed3df10ec67b3f0ec774be0bf0b692ae2e27863fb70b49ae15b0022b4a18e3da4e7919bfaff8c2dbc55fb695af86ed63bab2f01fc26d1e4d7aeaf6ce63e5adec9113fe93b833498071b47cd9e7902b77fe10ef0e7c44f09f81fc03a9d8433f83347f1d4165a1c3e115648d1ac2d2591dafb31a800ceb2ee083058afcd926bcef56f8bd247f097c57e32f086b969e1cf19fc4cf1faf87b45bab782312ac0972b0b658ae0bac61d8b3671c63d2803c33c1be048bc69e0bf01f85aff53beb2d4be2978aaefe21788ef2f466e6db49b3de11e52a170aeeb2b0e38de3d2bbaf8e979a57c45f03e87e00f060d43c3d65f17fc553eadaa6b3aedd44f24fa458a465ee90a9c2c788c15424b10841fbd5aff1c6fec62d53f6a1f8897571a97f68f8674db3f87ba2489208e1d92c1034cbb140f98c8eedfdd0adc0e6b2fc43e11f0ef81f47f1616d6daf13e1a7c228fc3d63631a97b917faac6e9b860633970981cfef16803c8fc33e0c97c5df043c67e22f0d5ef86b43f1578f6e2fae6cf50babd9165d3bc3569849ad01da42302aabb5792a179e6acfc3ff008c31e8df10341f8a16fa23695a2fc34f85eb7367a20b7692c575096496d626639022699a4490b637301b7b64569b4083c2fe1f8fe1b4913e99aaf85bc096fa2dd0bf42b6ff00db1acdcadc4ab2c9fc0141f2c7ae08157fe2df886dbe19f81ff6b4f09d96836236cde1af0fc0a91978ad8795fbd55dc4f01e3664c9e1b07b50079fff00c22f17867e2af842d35d5b77f0ef8174483c65e224b97091ddea17082e1a2627ab191c44a48e8b8ae5dbc75e20f849a06a1f19ae75a6b7f897f1325d4d6cfecf6d1cbf62b46917ce943b9f32091d9f6c6ca32110f386e3e92f8c5f0df51baf89ff00b4e585ff008785d24be09d3f52d3a19260a92c50326250ca78e54fca71c8c57c83adf876d6dbe127c37d663f02eb47c35a9ebf2bcfe24650d7b74e890466c607191b4796e50b0e599801fbb3401d6683f0f3e1ff00893c3de1bd47e2ddcfc61d4fc6de208de5b79b4bb7b6bf12463eeec5964333607277633da85f0eea7f0ab419fe22fc32f88767f13bc0366ff65d4740d4d244bcb78a656575bab17dc1171c79e871b88c106bb2f885f0db553f1f3e2b78c3c1fe25d6bc25f10fc2f6b0f8920b3bbb610c92c6ca8248d640c465411f786d71918ed5e25f127c37e33f146bb7de3bd474982dfc6361aa4769e20d062d3960922ba5c08e736aa30e9314218a8c1903e400cb900d7f0a7c53b6f07f85e38acbc3d2f89fe13de5ec6757d03539515e0bf25a5516ce18c8bb1223b652a030dcae0e715b9a27c42b6f87fe1af88f0e816b37c48f855e21b21e626a7018e4d1efa53985e6894ec4910ef1be3015f030c3a04d3b55d5fc55f14bc2bac7c15f025d7867c717cb713ea1a2b5a21b1f3218992e7c979b0bf6778da4f3627e17803a815eabf0abfb23e226b917c42f80fe1ab5f0a789f44b4b86f177c3bba97ed76dac59752f6d1c9913231cab4791b76823b6403e75d33e1cf89b47b7f0edd3e8da878bfe186a733bd9c8642b6925c342c927cca4ac370bcb08cfccdb23e18119fa67c6de15bbf839a0f83b5cb8834cf1ef856fed8584be219955f4cd734f0df269fa83e4fd9eee21c24ff2e300123ef5751fb3fc2fe11d0fc7ff00173e1dde4b6fa259241a878b7e0a6b5a79711ab4cad34b107c031247e6491385046cda781cfb3eb971a47c50ff008587f11345d53c2fe20f821e24b4b6d42fd6fe00d058496f1817114b002af0dd3ff04caacd92323bd007c9dac597827c3b20f08f8b6e758d53e05ea922cfa56a730326b3e04be95032a38e4b44ca01e331cc815d09656afa07e13fecfb3fc6cf8757da2e95f11745f1478dbc1e89ff00089fc41d0756596792cb78916deea10e2589d59401b863079661c1f049ff00673f17ea3f0ffc3df11fe076a92f8a3c23ab471c36ff000f751db3ea6964976dbe19d00027845c97dcca0001c1ed91eaff000faffe12f8934fd2e4f0cc5a0fece5f15fc1dae1bc9ed65be9254d4811b5a1fb4a313e4339036658761c6680397f8bfa96a3f1697c37e2bd3a0d33c11e2ef8537cbe1df10e92baccb0ff00674904840ba8903348f6aca360d8a1c942b9718c77b77e24d1b45f8bfa87c46d1adf5ef899f0fbc79a49bbd623d334996e62764012725a7dbf6796dfcb33c3905ce1d78de0d3a7f165f7c23f8bfa4f8c3e2c7c3558bc5de21b492cf5ef883e0abcbb8b433a7ce802cb23470b219c2aa1dd1b63e5527e626a0f845a1c1f073fb73c2de17f15dc7c42f85be2cdd787c4da0eb51cd77a6dfa399e330d917df2bc691179508df2a83c1da4100fb63c157de00f853f0ffc29149602fac15e4bad16fededcdf9b8461bdaf237504465d583300475214102bdbf4bd52d35ad3ed6fac665b9b3b989668664e8e8c01047e06bc5be19786bc51e0af86725978834cd075e8a5d4a59233e1add67143652962b2471ca48468c3602a95000e31d2bd0be15f836d3e1ff8561d0acb5abdd760b6662973a85c79f2aa31ca216f455c01edcf7a00eca8a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a29280168aa936ad636fb8cb796f185ebbe5518fd6a85df8dbc3d636ef7171aee9b0c2832d23ddc600fd68036a8af3cd43f684f86ba6799f68f1b68c9b3ef0174adfcab9bd5bf6c4f845a3843278c6d6e3776b547971f5c0e2803d9e8af9c2eff6fef8456ea4c7a95fdd3671b62b26c9f7e715ce6a5ff051df0059c8ff0067d1b5abc807dd9446a9bb8f42695c7cacfab2f2f20d3ed65b9ba992dede252f24b23055503a924d7e5a7ed5d7571f153e31eadad7836c2ef53b081544b3db44d2060a305b81c0e3bd75bfb427ed8da8fc70d362d0fc23a0ea50687b435e8dbba477fe104a670beddeaf7c25fda8f58f859e0d8746f0dfc24bfbcba0b9bbbe9c4acd349ea709d3d06681f2989f05bf6c087e06f8165d1b4ef0435e6aef2992e2ea7b9d8b21ec301777eb5ed7e19ff8287daeb1628d73e08bd8ee547ef5619c3283edf2e715c06a1fb417c48d7ae85c43f00b4c769870f369323b127b93815b1e19f889fb44b44eda47c1dd1ec115b07fe25cb01cfb658134c76396f8a96ff133f69af881a3f8d3c21e0dbcb28b4a0b15a3dc950a194960c4b601e4fa7615d0eb9fb36fed1bf171ed13c5fe2bb5b2b552bba35bbe10773b231826bb037dfb5c6b9a686834fd0745593388c79292273d3049c558b7f855fb52ea8d0c977f11f4cd34b2fce8833b0fa615306a6c3b9b1e0dff00827e781b4555975fbfbef10dc606edcc218f23af03939f735d47c44f8c5e08fd96ec74ed1346d02391e619fb2e9e513628fe2763c93f5af2ff00f8649f8ddab4732eabf1a26092b7cf1c2d31041ebdc7e551c7ff0004dfb5d490beb7f10354bbb93fc71c20e3fefa6269937bee7d15e03fda03c15e3dd07fb4adb5ab5b0d8079f6f7d32c4f1123be4f23dc5707f19ecfe007c4d68e4f196b9a0bdec6a234bc8350549c2f61b90e48fad7036fff0004d3f0479710baf13ebd70ca7e72ad1a061e9f74e2b774dff8273fc29b19b7cbfdb17898ff005725de01fc5541a62307c27e0afd943c0f7b1ea30eb9a35fcf6ec248db50bf338461d085e84fe06b80fdb43f6bcf0e789bc2717833c0da847a85b5c156bcbdb752b1841d235e057b778cbf661f811f0bfc177baa6a3e17d3e08ada06d935e4ee5a49369da325b924d78ffec5bfb2fd87882faf3e20f89f4681f4b9998695a6dcc5be32093fbdc1e0803819a5e43f3391f817fb75695f077e1958f8593c3175a9bda9768e659822fcc7383c1279cf35d46adfb78fc51f102c8be1af874f024ab98656b69a76031d7a60d7da16df0afc1b6732cb07857478e45e8cb631e47fe3b5d3470c70a2a468b1a28c05500003d05023f3967f8bbfb527c4484c163a3ea96a8308cd65a7fd9f9ebcb354f37eca1fb4678d992e35bf11c31128085bbd5199941ea30a0e0d7e8b514c0fcffb7ff826cf8aafe3dfa9f8f6d1666032520925e7b824915d8786bfe09a1e1cb7b53fdbbe2cd4af6e4ffcf946b0c63f3c935f6851401e09e11fd883e13784ee96e3fb0e5d5a60a17fe26570d2a8f70bc0af4dd27e11f827418563b0f0a68f6e8a770c59a120fae48aeba8a04436b6705944b1dbc11c11af012240a07e02a6a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a00e63e245be987c217d7fac4b7b169da48fed595ac2e1e1908b7fdf63284120ecc15ce18120f06be48baf116a5f133c37e04b93e15bb9fc3bacc2ff12f55b96bb69e3b6962732db58a31023019b008c8c01dfad7d7de3e93538bc1daaff63696bacea6d0347058bba22cacdf2e097f97033939e300d7c79fb53fc27d63e1dfeccbe20d234dd49c4773a7e99e13b790325bc6b6af30f3dde28d56246dcc465547cbc500705e1bf106a1e1ff001b7c3cf13f89ed75ab8d2fc09e05d53c79abadd2472f9d73a95cbf971c0a848de0093126e60108fbb93585f0e3c33e17b8b8fd8ebc336967702e351d4350f1abadf91380a4348415438cefd854e4818e41e95b9f12ac7fe14fe97fb424d369fa94fe0ef04fc3cd2bc17a5bea10b7973cb701a392580b7046e78998af1b947a0ad4d0bf675d46ebf682fd9a673ad5d2685e15f0589e3beb151135cc9180c63650c7cb46dd83c907a77a00f34f0df80356f8b3a1fc4cb2f10f8b7fb0341d4be3747baefc416d246f7c234256df69fba0aaa2283f2f007602ba4f8911f86bc1ff0011bf68ebdd73544b7b3baf13786ed74fb3b98c8b7b9bb0e97020919177ecc5a8071f75598822bd0fe10fc2ff000ceadf05fc050ea5ac68fad783af3c75a96bb70daf6af3c17a674be916d3c978d944d2ab6d0e920c3162457837c53d2fc3d2fc09f8bfa8dfdb49e20d3ee7e2ea456dac4723c315a3a95469e56009d89e63a63d585005ff008d97167a6eb5fb40f886deec5f6a3aa7c4ad0740fb122ee2e901590a3172768dcc541078da3000e2b6be32e9fa3f8dbc13fb5869d67e20b7b38b4bf18689ac5dcfaa5af9715bcd2322347e6a64bafc8141206d21bb36697e3f6a971e00d4fe38de786b749e22f06f8e748f1e5ddaf907ca1692dbaae73b70ccc773127801979ab9e33f0f5af8a7e22fc67f875e1ab69da1f8c7f0f2d7c7365673c8871a947964b784f1bb705c9ebce0f4a00b12782346d2ff006a8f8e1a66a5aed844be25b7b3966b7bdd51eda4bcb4b9b6dfe540a3fd7e24c8d98e00e31d6be62baf04eb1f1fbe16e81e1ed1754d4357d2e3f070bbf0be8f0660b61abd8ca82fed96053b5a5686e0cdbb059b70f522be97d166857c33fb387c64f1578726bffdc45e0af13477eab6cf04eac63b7bb66900dac92838395e0f5c51f07fe0ac9f07fe25f8e3e1b69775787c69e13f13afc40f0a59c291fd9ef34a9905b4b1ef71841b64d921e4fee90a293c100f96b5cf065c78c3e13f873e20eb9a4ea1ad47e16d1eca4bfbbb733236b3a70b8582e2ca6914feee6b7ddcb71b9324f4ae3fe212da78e24d07c49e09f1b6a3e2bf17698b19d389b4922be5b1b6dab05b9010892ee009b9c824346d1b0e8d5f4f7c40b8d0be04f8c3c47f15be16788fc42ff0dbc425ed3c53a3683a7f99368b78c0bac812e156330f9ab860ea32095390d5c578b3f67bb2f0afc60b4f897f0ffe20bde786e4d7ad755d474f5b56b7d4bc37f6f45b9590a63ca1fbb2139c646536e6803cafe19f88af7c5135bf8bbc07e31b9f06fc54d2aee48ee753d4c476f1dda4ec0b497770711055c48b82acee640082071f4f7c359b59fda3ff00e10d834cf1e697f0ff00e3a785b478a5d2b5e6b762fa959cea5bca904b1aa4c803021915b92c791835c4fc46f0ce9fe1ff001678ebc42fe04d0b5df09de5ec3a5f8b34ef0edccd6e9796f31f363beb7329f2967528b2158981475f98042d9d3f1aafc2cf1f789fe1fddf87e6f885602cbc2d6f07853c657530b9b096e002a2dafbcc8d9232adfbb6db84c839028029f8ebc6de24f8b1e38f0caf853537f0c7ed51e0ab7bcb0d734d92c8411f89e384a90ab26424a5a242c2165c3877c638cfbe7ece5e3dbbf8cb1ea7e2cf036aba4f857c68b612c5e29f85f3d84515b3dd8c86b9388d5dd9c8fb8edf2e71b80e2bc20e94ff00162f2d3c3df127c0f6ff0007fe3a6971c50683e2ab7b596dada7b88f7989e79219bf76ac4828c1368645f98ab7975e91e1d4bad635283c1ff163c3527c2bfda0b50b74b5d0be2dda22bda6b17311dd0b99a3f93cc6c73c7cc38c8e9401e53a3f827c35f15bc73e1db9f873aa4ffb32fc53d16de4945a6b8b35be9bab3fda4b48f692c8fcc7e6b1021d982a40208155be2b7c51bcd3fc493e9ffb4d7c0a9ada6d4aca3d26f3c75a2492db4974e8f94b8658d96de50182384e08dbdfa57dd7f61dde25f87763f1abc27a378a75b7812cb47f1c6929f68325e3452c929da225f25762a1590632ec70178cd6d1fc029e1df06cf0f80fc57a6ebda1b5e4fa85ff00823c590410598b77cab47978ccd07ef0862f217cf200e6803c07e07378a975cd76c3e047ed2da5f8cb4ed0d36dbf81fc616d9122a48c936e9001b519c6e49232410e377519afe23d7bc51e19f8af63e21f89dfb22496b0d8df25f47ae7c3f9de56fb42290b3bc70e16720b1219c6e1dabd0b5afd957c25e23b5b7bbf177c0dd4be1a6a7fd9a6d757d73e1e6a6912312624090dbdbb37991bb124ef8f2a10673d69de20fd9aeebf6788f4db6f0ffc73f8c96b697cc67b4b5d3f4d3ac2aba01b44a122c6dc63e4600100fa500713f05fc45a9bea97f17c2ff13f8d347b279e49bfe105f88de19b996ce612c8d24b12dc720b12ccc33b5ba8258600fae7e0358e8bad4af7ba6784351f078b3769e56b3825d334dd42ea550924ab6d953210b1a732ae0678e79af12f02f8fbc53f10749d121f0cfed15af59eab726458878b7e1fc3026ab36e62a6306342880614ed27eee7dabea4f8530f8d7fb2229fc67ad68babde3da431bff61c4c205b846904ccaedcb061e571818657e00c5007754b45140051451400514514005145140051451400514514005145140051451400514514005145140051456378c3c4d6de0ef0bea7ad5d922dec60699b009e83da8013c59e32d13c0fa4cba96bba9dbe99671a96325c481738ec0773ec2be6cf157edfda08bc5b0f03f86755f195eb36d1e4c6c899ed8c024d796785bc15e29fdb33c4579e22d4b54b74d26cae16316d393b523273b51074e01e4f5afb9fc35e11d1bc23a6dbd8e93a6db58dbc08b1a2c310538031c9ea4d4eb72b447c8cbf13ff006a6f88f78c743f075a7852c2552aad791a8d9db3ba439cfe1566dff671fda03c6f1fda7c53f153fb1e7da505bd9b33607fc036ad7d93494ec1cdd8f8d74fff008275a5c4cd26bbf11757bd2cbf37909b4963d492cc78fc2afc3ff04dbf066e02e7c55afcf1631b0346bfae0d7d774b4c5767cdfa6fec01f0874f3196d3350ba65186f3af9f0fee40c575763fb1f7c22b17575f0659cac063333bbe7dce5abd96b1bc5de2ed2fc0fa15ceafac5d25a59c0a58b31e58ff00740ee4d017670771fb3e7c22f0cd8cf7b73e0ed0aced615df2cd7108daa07725abc07e274c9f1ebc4d6be00f879e1ad387872ce4479f5bb6815630b8c1c30180067a7535b3149e32fdae3c41320b8b8f0f7c3685f6ba46406b8c763fde27f215f4afc3ff0087ba27c33f0ec1a2e8368b6b691f2c7abc8ddd98f726a772b6dccdf85bf07bc33f08fc3aba4e836091ab1df35c48034933fab363f21dabb448923fb88abfee8c53e8aa2028a28a00292968a004a5a28a0029296bc5bf6a4f8f96df03fc073496e527f105f298ecadc9208cf06438f4edef401f3dfed25aedf7ed29f1eb45f85be1db86fecbd364dda84c33e5ee072ec71e838afb7740d16dfc3ba1d86976a8b1db59c09022a8c0c2803a57cf3fb16fc153e09f09cbe34d5649a6f11f89505c4fe7020c7192485e79cf39cd7d2d49771b0a28a298828a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a002be3dfda5bc41ae681e1df8997263f146bb61a9788347d1e1d2f6ac30dbc4e2312cb685a3738cfde6e84e48dbd6bec2ae57e23787b4ef15f8666d2b52d41b4cb5b89630d323aa96c3021016f5c63d6803f3fbf6aa6d666f863fb61f8752e6ff00fb22c750d02ea386fae0cf1c492083cc9220172b1e238f2bf31cc6c72735e9965716fe04fdb2be13595c7db25b3d4fe1f49a7d85c6f716f73711c6afb5371d818a83d00c92335e8da9781e5f1678ff00f68ed0b52d12ec69faf681631dbde4901105ce6dae9308c7867475c9c67195af9cb4db0b21f0f3e0af8dd3c4da3f8c74df867058ea335c45732c3ad5b5ba49e5dc892df0de646dc60b94da547245006cfc33f867a1f883e1e7c20f15d97876d3c2165a1f8fb529ef7c2fe21d78bb5b5dc92b4396675f9a4060f3042a17264561900e69fc72f84fa45bfec8bf1efc2da58d56d9f43f14de78925d2d620bf68506298fcbb9d9ad811b8be46307a62bb6f891e02f11787fc3bfb486922d9351b082f6d7c75a05e9b2171762e98ac93103cc0acb1f92517251800e082a016f62f83fe0df057c76f094bf15a3b2df2fc43f0cc5a6ea51b468824870cb203b467731c83cf61401e55e29d6bc2777f16f404bdf05dd5ce87f1e3c316da74babdc8536d04d1c2c6081e32a4b36c20e1b0381f7b903c9b4bfda4355f03dae91e27d4bc0d62e3e09dd2f85fc557572912de359dd3f910dc59aa29d8aaa9193f300d92a0724afac7eccba4df27c36d5fe1778cfc5f7d6be29f85be2017936a12ce93b7d8937496e5599788cc2e14f5230707b57a27c47f873e05f8cbf6ff109f15de5d7873e22787c786a38f4bb4173a7cec59de0ba795233b644724233b2ae7e5ead8a00f15d6f4df13f8d3c59f183f67fd72fb49f1045e23867f11f87758bb6b859ada79184f0db4a0a18c941b48119e16b8cb7f147c51f1f78e34efda074df84969fdabe05b897c33a9dbe9fabdcade5fa409e5dca25b8464785249259173b5b28abd572de8de19fd9dfc65f0a7e10f85fc41aef88758f1778f7e1feb973a95adb6a97110fb7d981e53c30172fb51a21b9598820f5dbd2ba293c46bf027e335878ebc37a749acfc3bf8bd2e9f03269d7a6e0586a2639ddeed46f300464f2f76d277146607e5c3002fc54bad63e1078e8f8a62f15f836f7c0ff00104226a3e0ef18ca9a7c934853045bdded652c0120472003af24d70b63f0223fd9bfe29ea3e2fbff00100d33e14ae970e81613ebd7ad76d74d753874b6f26250d3c6ab298d1a472ead197f994d7d07f106f3e1cc7a2f877e11fc5aba87c59a86af672de450ddd9315bef21b716017387ce02aa9dcc7819cd7ca7e2cd734ef155c6a9f027e2b7c39f106abe225d625b9f00ae92b911e932296b79a369a44e63f2b63aca432eedb90411401c4e8ff0b7e247ec63f153c4b045636bf143e09ea135dab89544f61a44f3260cb7d18577b711a49fbc6507747900f381f5a49f0e6cfe1efc11f0a783f42f871259781f5cbe96dfc43a0e9d752dddcda89897135bcb1b8dd18704e78ca95fbbc8af9f3e0fea5f1034df145f781ef3c137163e3b92ecaeafa4789ae89b4f156911853e54176a5a2fb4c4a09e777c8cea5b02bd27e1cb7c4e9fc497d75e08f1378962f067dafc8d5342f17d9476d75e1a7898b2594025223313c5246be60f3384c820d006a78ab45d4be03f8b3e183dce80ff0011fc1b7334963fbbf09c975a86876cc9b9089e32cc40720149324824a8ca1ceaf8c3e14fc44f04cb1de5f7d8be25fc3269aee7bcf0b5bd92d9dce8f6ec0b40f6464762cf103b420284e3d6a1d07c57adfc33d4174ef01787aeedb5bb59eeae3c49e00f106a8649ee6d899a41a969f3c8c7ce05f6ae10e08655608501aeb3497baf8ed15efc45f865f11fc4be1ebf0a6ce7f0d6a1146618ee21e1a192d66526176c63231d73cd0073df06fc3379e1ef08d9ea5f043e21c973e05b4b35922f01f8bb4f9aeae62936091a3495dc5cc1b91919632ac32411c3527893c33a75bf896d7e2f789bf67af11de78b2681acafa0f0eea10dfb3c64614cd6be746b32e0f19562a71c719af32f0e7ed41e0ab9f8e56b67e2df06eabf0b3e27de4705c3eb17f63262e6f895b37b42a09335bb3282b22100a447eeed2cdf767876dee61b7985e6acbabcad2925d634458bfe9980bd876dd93ea6803c3be09699e0bbed425d37c3fa478ffc1cf0b3ceb6baacb7b04122accf91196764281cb285079503195da6be89da3e94bb47a52d0065eb1e1fb6d66c16cddee2d615656ff429da06e3f872847ca7b8e869de1df0de97e13d260d2f46b1874dd3e12c63b6b75da89b9cbb607bb331fa9ad2a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800aa9ab6976fad6977561771896dae6368a44233952306add1401f98fadf81be2e7ec97f1c2eb50f09697a9eafe1d9a56921fb3c4f2db5c404e7cb902fdd2bd39c74cd7d7df0c7f6c0f0678c7488bfe120bc83c2dad2afefacee9ceccff00b2d8e7e879af79af37f127ece7f0ebc577d2de6a1e16b36bb94ee79a2063663ea706a6d62af7dcd5f01fc61f08fc4a9af22f0f6b10df4d6ac5648f051b8fe200f55f715d9ab075ca90c3d41af93bc63fb03d849746f3c13e2bbff0d5d104159099108f4ca9040fceb9cd1bf657f8f1e09b175d0be2840763168ed8cd3043cffb40e29859743ed5a2be45d2edff006adf0db4ad21d1b5d453b0473c919ddfed03f29a9b50f889fb5168b0f9f3781b48bf5625162b4c3b838fbc407e94c563dcfe2efc6ad0be0fe92971a8b9b9bf98e2db4f848f3253ebec3debc93c27f0b75efda0b52b6f19f8f2eae2c745690bd97875090be58e85bd8fd326bc3acb45f8e1a878d21f14788fe1e5eeb37914e26f265e108072140c9c0f6af661fb49fc5f81769f82d76d83f2ac6d2000761d2a3d4adb63e9cd2f4ab3d12c21b2b0b68ed2d215db1c312e1547a0156ebe7587e3e7c589ac51c7c16d405c30cf374368fc319a92d3e337c66d4a68e08be111b491ff00e5a5d5ded8d7ea6aae4d8fa1696bc0e2f891f1c26d4859ff00c2b6d36338cf9d25e9117fdf40e2a2d6fc4bfb42798af63e15f0fc4847faa5ba121fccb0a02c7d03499af9eb4dd63f68abe9364da3f86ecb8cef9a4c8ffc749ad5d6b49f8f9343fe85adf85616299c476f26777a6581a0763dc296be77d3fc2ffb44dc48a2efc59e1fb48f3862b6dbce3d4616baa8be197c49b8b7b8fb6fc50912775f93ec7a6c68aadf8927145c563d7a8af049fe06fc4dbc85e2b8f8c17cc84e479766a847e21ab447c03f13bdaaa4bf167c4be663e668c46074edc5007b06a5a95ae8f61717b7b3c76b6b0234924d2300aaa064926be08f02c969fb5a7ed597babead3b3786345cc9636b36192708d854c1ec7ef1acbfda2bc27e287f1c69bf0f7c31e2bd63c73aadd467ed51b4c49b719e8e01c018e4e6bdebe1ff00ec2be14f09e856492eafacff006a040d713dbdcf95fbc23e6c60703b75a9bb63d8fa45aeacec6358ccd0408a36aa970a001d85569bc4da3db3625d56ca238ce1ee107f5af269ff00647f03de4216ea5d62e65ce5a6935072cdf5abb6ff00b28fc3586158df437b82a31e64d732331fa9cd3d4343bf6f885e1848c39f11696109c6efb6478cfe750bfc4df08c6accde27d242a8c93f6d8f8fd6b87ff864ff00861b48ff008469704e7fd7c9ff00c556968bfb35fc35d0a4f32dbc2762f2608dd3a997affbc4d30d0bcbf1ebe1db46d20f18e93b54e0ff00a40fe54e93e3c7c3c8db6b78cb47076eeff8fa53c566dc7eccff000c6ea49247f0769fb9db71daa40cfb0078a8e1fd97fe16c2ccc3c19a731618f9958ff5a351686b2fc77f878c2323c65a39127ddff4a5fd79e3f1aded27c7be1bd7231269fafe9b7887a186e91bfad70f2fecb3f0b26501bc1b6040e9f7bfc6b96d77f61ef859abed6b6d32f348947f1d8ddbae7ea0e680d0f7c8e549541475704641539a7d7ccda8fec652690b6f2f82be22f88fc3d776eb85f3ee5a78d8678046460571bf10be217c7afd9aa38b58d76e74ef1b784919527b9540922738c1e8c0fbf229858fb2e8af21f807fb4c785ff680b3b81a42cf65aa5a207b9b0b903728271952382335ebd40828a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a002b27c47e15d27c5d670da6b1a7dbea36f0cf1dcc71dc26e0b2a1ca38f707a1ad6a2803c9fe237833c4bfdb5aef892d3c7ba8689a0ae976acda7dada7da0c125add1b89258d402cde6c5ba1650092318e6b1bc0be1cd13c39e20f17d9f847e18d87876eaee4567d6a0b04862bc49e3322c8e5943380e0068c676935ec9acddddd8e9b2cf6362752ba5dbb2d44ab16fcb007e66e060127f0ae1be305e6a10e93a4abd94377e19bcba5b2f114524a6268ace6528d309432ec58d983b367eea9c73401e3de14f1ff00c5bf155bf80ede19b45d76ff0041d566d07e25e9b676c161dfe4a3092179369c00e8d80a430738e00cf75e261a0693a4c5e14f095cd8f8467f07df596ad2d94d70d67045a70b9592e65088df3c463f347236ee201aaff1574bb7d3fc6d63e155b358343f885a75e6977373158c4f15bea10c49f669a4f9332334795fde12a05aa003ad72fae78abe28782f44d066b2b5d2f5cbcf06dcc163e25d1ec2ea15fb769b226c5bc4caee85902993ca6da0ec6ec05007a2dbf84fc31f16bc6de0cf8a3a06a3a7ea1a75be9f7d6af3dac4aeba9c370b1aaabbf52a8636f95ba1623039ae62f7c3fa5f87ad8fc13b3d4756d12e356b3bbd5f43d5e3611a42d1dc46e628c45b76ac4f2c4761c2b292bce4d7790f86fc3dae7c2b1a3689a8349a5eb366f3585ccb76f2c93799fbc5915dd8b37ccc1bafa76af31f885f0f53e29784749d2358d6aeaf35b4963fec2f1368fbc7f65ea76f182de74f1fde8da48c1218152db81c10b401cc7c4cf8c9e16d420d0fe20def87b49d53c3fe18bc5d3fc42faa39875cd0e4f33092796ac551727732b91907b8ad2f02e8f0e8ba0f887e1a5d78b749bff00f88b47ba9fc0eba544f35fc760d16d9d63902f97298fce050292f861c102baabeb8f0878374dd73c47e2492c351f195ce9b6da478baeb48ba5912dfe5d8b24b13c83cb404f5c038ec6b90fd9de1f177c1dd33c4bf07f5465d6b55f0c69cd71e0bd6afed7ca5d4ad4c7feabe5ebe4cbb15883b8ac8848ef4019de24f873a67ed15fb3df87b45b8b99347f89ba6594d378624d5a49ac2fe1bab71b239da36db23aab056270541c11cd73fa0f8dbc21fb5ceb69e00f885a4eabe14f8a5e112aed1acd3e9efaa462150e639b6c6de44b3127601c88811c735ddf8ebe206adf127e17f877c57f0ebc51631f8db406b5d6351d226296fe75a0702e61b88cabcd146543f0bf3640f5ae27c5fe11d6bf692d4349fed1d334dbad1f596b6d73c31f123c3364aeda788be75b3ba6660ecbe616db22fcae392809a00bff07ff690d37c4bf189be0df8e35d4d2fc73e1cb85bab0921b6fb244fb484fb124937cd39689f195552cbbf935dbea5e2fdbe28b8d03c7b63aad8785bfb567b5b1d6a1d6a1bab0d416763fe8f7b85530e3202464646000c48359775a7e81f11bc61e1cf087c55f0e5bd9fc60d253fb4345f182e9612d26b88240c9259cacdb9ca928cd0b601dadc60645d4b8f861f033e276a569af78617c3f7de2586cd2f7c4f2d98b7d0b55bc3b8c7bd7718a199a40dd46e240c93c1a00ee3c0be19d03c07e0b5d41af24f1f0d1ae678f4ed463b75bfbeb488b88c5ac4ca0b7eef1b0f39c29ddce6bc8aefc37e18f8f8fa95cb78cbfe1309347d716fb4c87c077a34ed6ac627f9648efa3f3537153d5982b103a135b9f0efe09dee8fe21d53c75f0e75983c36f2cf7ef79e11b6bf4bed1f58bb9012279a500bc4c64084ede57610000cd9abe1db43e3ef8c7acd878a7e0dea1f0dbc4f7fa6dd5ad978f745963769d4f12e2e221f2395e55a4193d8d007b6683e0fb1d33c3365e12f12ebff00f0966a46d5e017daa18e2beba8b0c8cc7cbda7215d8175c7def7a5f85fe09d2bc2f0dd5ce83a7de787f4cba3b4e8f711a2a8743833f1962ee3ab3b127826b93f03feccd65e0fbcd1c5f7886efc6ba7e977171716b178bada2d4ee6d99c45e5882ea50658f618d88e4e7cd3d30b8f6951b680168a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a29280168a8e6b88add774b2244beaec00fd6b075af88de16f0eac8da9788b4cb2f2c6e659ae90301eb8ce6803a2a2bcab56fda9be14e8f1abcfe36d31b71c010b990ff00e3a0d61de7edadf07ace3663e2e8a5dbfc3141231ffd06803dc28af9a6fbfe0a0df09eda42b0dc6a778a0e0b456671fa9ac3d4bfe0a3ff000fadff00e3cf47d6ef8f6fdcac7fccd03b33eb3a2be30ff879568d23660f02eaf34658aab2caa73edc0eb515d7fc14782ba7d9fe1c6a8c9fc5e64d823f25a570b33ed3a5af8b5bf6f7f16eaac66d0be126a57965d048ed231cf7076a62b3a4fdb8be2c3c87c8f841395e480d0dc647b7dda2e1667dc7457c3aff00b6ff00c5b5d8a3e0fcc19bd61b8c7fe834e8ff006daf8b8b2297f83f33c79f99563b8071f5db40599f70515f10dc7edc9f14e4c7d9fe0d5dc583c995276cfe482ad5afed85f1aefacdeeedfe0bdc4b6f19c3388a7fe58c9a02c7da9457c4fa5fed93f19f5bb87b7b2f83534970832cad1ceb803dc8ab527ed19fb476a570a965f0896d377f0cb0c8ddbd4b0a6163eceaf1efda6be3bdbfc0ff00033dd42629b5cbc3e4d95b393c9eee40ec2be75f167ed47fb42fc38d346a9e27f03e9961a731d8249e22a3776c61ebc56c3c0bf1bbf69cd60f8de2d3cea30994f917172eb1c0b8390a8ac7a0a4348faf7f639f83373e1fd227f883e241249e2af100697f78483142e436083fc4c79fa62be98af88acfc2dfb5e488bb358b0b38e34112c4d2418c01c1c6d35a767e0bfdae2e55bcdf15e936c474dc6224fe49420dcfb2a92be40ff8523fb4aebd7703ea5f14edb4e4236b9b3246d1feeaa804d68da7ec87f11af96e06b5f1bb5c7f338db6bbf041eb9cb0fd2988faa27beb6b504cd7114400c9f31c2ff3ae7f55f8a1e10d0cb8bff136936a5796125e2023f5af9bad7fe09efa75c4921d67e20f887510cb85d8e108fc496cd74fa1fec09f0b34b9164bd8754d6d8755bebd254f18e42814068775aafed51f0ab477952e3c67a7968c65844c5ff2c0e6b97d4bf6e6f845636fe647af4f7ed9c08ad6d2466fd40ad6b5fd8dfe1059fdcf06da93b8365e5918f1db96e95de693f093c15a1387d3fc29a3dab81b7747651838fae2811e0d37edfde1abcbc4b7d07c21e24d7643d561b6dadd7820739ab53fed37f133c410ac9e17f82fab18d98aacbaa49e583ef80062be91b5d26cac706dacededc8181e544abc7e02ad73eb40cf9b93c4dfb47f89ed9628fc33a07860b9c19de6f35d411d7049e9f4ae3754fd91fe26fc4e8f6f8ffe212dcc0d2ef36b0ef91147aaaf02bec3e696905cf27f829fb35783fe05b5c5ce8504d2ea773108a7bcb87cb301ce1474519af58a28a620a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800aa5ace9165af69379a6ea36d1ded85dc4d0cf6f328649118619483d4106aed250079c58e829a968be20d2741bcd6f44b9d3e38f4bb3179230489e18d5a39616903b32b064567f9b760f7c9ae73c09e29f0ff00c40f0c3f8e758d2eea1f11e8fa6dce9dabe9e8b33304dd9950dbe009839843212a4e0e07535de78f7e1fff00c268da3cd6fab5f6877fa5ddadd41796254b63237c6cae0ab2ba8da78c8ce4106bac58515998280cd8cb01c9c74a00f97fc27f038786df4ad3bc39e28b3d06d6db595d6fc17a5bb4eef069c618fed76b2095cbb2bb966da0e132b800703b4f887e36f88763a99bbf07785e7bcd3f45d5ededafac36c47fb5eca6004b3db3672b240c77153f7b041aa9f63f0ddbf8df4dd17ec3a76abe16d3353616971a74d24973a26a87f78d15c618b0590b9c0e14050187009eaf4dfed3bed1ed747d13c3da9f8360fed49d6e6e14db836db253379815f70962b8395253e61e69fba412a0173c3f6169637cb6de294d3dfc437d00b14d4de38a09357455dec1620cc57693cae7af23d6b03e2d6a49f0e3c0da5e87e1af13d8f863c47753adb68326b8af7115d4dbc136cee4123783b436720e0fcd820f45e15f0af8816eacb53d645925dc92c935fd9bcd2df470c9b76ab5948e57c853d4aed3c71c75aec354d2ac754b3305fdac3790060fe5ce81d7729c8383dc7ad00788dcc76337c4bd4752f065d58dbf8a74858bfe135d0ec34b84de6ad198898904b2056c67a306c11ef50fc2df80de02f0fdafc42d4b408b52bdf07f8989b6bcf075ca335b5a5c5bbc914c2089be68f7150bb4703cb529818025fd9dfc33ace8dad5e5d4c963e27f0b4f661340f1924857517b4f30b7d92f15f0ce55b3b641c6060815da7c37f885afeb9e2af12787bc47e129fc393d8dccb2d85ea90f6da8d9f9f2471ca08e524223cb23766561c3600024ff0000fc19e26f86ba6f83bc45a54be22d0ecc6fb58f5a90c9716e483b76c830c8c818a860430f5ef4fd1fc1de20d07c23a9e97adcf0f8fad6058d74bb6b88121b868d51576cf233147909dcdbc05ebd335e934500785c3e13f87fe2c5d73e16699a2c9e16d534cf235976b1b278520b870317304e0047954ae09c93d37020e0f77e13f006b5e1db4f0e4177e36d635bfecb132dcc9791c3bb51575c209884ce633c82b827be6bb8550b9c0c52d0020e94b451400514514005145140051451400514514005145140051451400514514005145140051454375796f63179b733c76f1f4df2b851f99a009a8af2bf1efed31e01f87b7525a5f6ac6f2f51439b7d3e333b73db238cfe35e4d27ed4be3ef88d7f241f0dfc0b34f668ff00f1f97c87e65e99238039f734ae3b33eacac0f15f8fbc3be07b17bbd7759b3d3215ef3ca013f41d4d7cf337c28f8fbe3ad63ccd7bc716ba06992a624b7d3188daa7a80001cfb935aabfb0af826f5524d6756d735abcc61ae2e2eb93f86296bd0765d4b7e23fdba3e19689f2da5d5eeb3263205a5b9c7d32d8ae1f54fdbd2fb52c9f09fc3ad53538718f3ae1580dde9f229e3f1af78f08fecf5f0f7c176704361e17d3de48801f69b9844b2b91dcb1ef5ded9e9d69a6c663b4b586d632725618c20cfae00a351fbbd8f917c3bf113f69ef880ccda7f8734bd06d245de93ea10796029e98dc4927f0a62fc05fda3f5cbcb89b52f8a30e9cb71cb25accfb47b050a0003dabec5a5a7626e7c8967fb07dfeb102378abe266b7a84fbcb3240cdb31edb9b83572dff00e09d3e06fb4996f75ed72f97fb8d2a8fd715f5752d160bb3e7dd2ff613f843a6dbac6fa14f78e39335c5db963f9103f4ae974ffd92fe1269b74971178274f9254181e76e917f10c4835ebb4530bb3cfe3fd9ff00e1bc4c193c11a229ff00af34ff000ade8be1cf85218d523f0d69088a301458c5c7fe3b5d151408cdb5f0ce91631ac76da5595bc6a772ac56e8a01f5c01d6ad7f67daff00cfb43ff7ec7f8558a280191c290aed8d1517d146053a968a004a2968a0028a28a004acff0010f8834ff0ae8d77aaea974967636a86496690e0003fad52f1c6bda87867c2f7fa9695a34de20beb74dd1e9d6ee15e5e7a027db9fc2be58f15f82be307ed4925b59f8834d5f0278560b80ef6f31226914f5e01f9881eb8eb49b1a39bfec1f13fedbff119f509a7b8d23e186973ed85581ff48c1e42fa93dcf6afb6b42d0ecbc37a3d9e97a740b6d63691ac50c48301540c0acef01781f4bf873e14b0f0fe8f118ac2cd362063924f727dc9ae82806c28a28a6212968a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2802858e83a6e9979777767a7db5a5d5e36fb99a08951a76fef3903e63ee79acf9f4bd434b95a5d2e4fb535d5e2c972ba8dcc8cb1458c379200383c0c2f0324d6fd1401856da9ea7ac5beeb5b29349786fda0953548831960472acf1f96e7870328c7b1195ed56e3d1608356b9d48191ae678d227dd23150aa588dabd01cb1c91c9e3d2b468a00cbd36f679aeafad24d326b182dd9560b8678cc572a464940ac5970782195793c669b6ebad7fc24178b70963fd89e5466da48ddfed065cb7981d48dbb40db820e79208e3275b1ed4b40051451400514514005145140051451400514514005145140051451400514514005145140051451400514514005792fc4cfd9f6d3e2b789e2bfd6bc41a92e951c411749b7709186cfdecfbfd2bd6a8a00f3ef047c05f037c3fdcda5e856ed3b001ae2e879d21c7bb671f857796f6d0dac62382248631d12350a07e02a5a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2803ffd9, '../../../admin/assets/img/firmas/berneymontoya.jpg', 2, 1, 1);
INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `email`, `user`, `clave`, `firma`, `urlfirma`, `rol`, `id_modulo`, `id_cargo`) VALUES
(5, 'Estefania', 'Mona', 'estefani.mona@samaracosmetics.com', 'emona', 'e72780e104a21a2d1b331a311e87f329', 0xffd8ffe000104a46494600010101006000600000ffdb0043000302020302020303030304030304050805050404050a070706080c0a0c0c0b0a0b0b0d0e12100d0e110e0b0b1016101113141515150c0f171816141812141514ffdb00430103040405040509050509140d0b0d1414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414ffc0001108015402ab03012200021101031101ffc4001d000100020203010100000000000000000000010206070304050809ffc4004d100001030302030505050407060405050001000203040511062107123108134151611422718191153242a1b1162352c117728292d1e1f02425334362a2263483f10918445364455473c2e2ffc40014010100000000000000000000000000000000ffc40014110100000000000000000000000000000000ffda000c03010002110311003f00fd4e77ddf5c28dc81e4ae9b792086f4528a5a821158fc1550114354a0b78f4d957e0a5dd54170f140e6ebf041d026c7a22086f4573d1554ee8214b9423d0159dd14346cac8207452888088882ae0a5bd109c20e882a49f0194dcf518574404444157052de8a51011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110548c272ab28f1411f2523a29557203959719272a7250496f90520615559bd104ae373727fc972220a35aac06109c2676ca094545740444404444044440444415dca96f45288088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880888808888088880a8e711d012aea394792037a792951d02940454738f82969282c88880888808888285c7d54872851cbe5b20b737450e76ea3c307aa823082cd77a29775556f8ab35054fc15dbd14395901111055c83f2565440574440444404444104e1434e5491940308251110111101111011141e882541e8a0755e0eb4d636dd09a7aaef37598c3494ece67728cb9c7c03478941ed4933618dd23dc18c68c9738e001e6560f74e3ae80b2d51a6add5d6982a03b94b3da038e7cb65f35d7d7f11fb56d4cf25ae39b4fe8c69e4672c9b49ea3c1eef3cfba3a0e856ccd2fd8b787b6db1b60bad0545dee3247cb2d54952f043bc4b434f283f920deb69bdd0dee863acb7d5c3594920cb6685fccd23f92ef309df2be27d53a0b53f640d4947aa74ddd2a2e9a1a49db0d650ce72608dc7eebb1b1db387f810bec8b05ee935259e8ee941289e8eae3134520f169ff58f920f4d11101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101141ca869282c8888088880888808888088880888838dcec7829ce5460eca5033e899f450e5280acde8a5101111011110140ea54a2022220222202222022220222202ab8e15955c328241ca950de8a50143ba295c6ff00fdf083a974b953d9e86a2b6ae66c14b4f1ba592471c06b40dcff00af35f2bb60afed69c4a92598cf0f0cecd28e46e79055c9b65be6493e3e03017bfc6fd4971e2e6bca4e15e9c95eca50e135eeb23fb91c637e424780fcc9f45bf348e97b6e8bd3d4366b4c0da7a0a58c32363475f371f324e493ea83bb6ab4d1d96862a2a2a486929616863218581ad681d000177b94792000741852831cd7da46935e691bb586b9ad7c15d03a1f79b9e571fbaef9100fc968dec61a92b63d337fd117690fda3a66b9d086b89e631927f2e607e457d24f1ffb2f99ed14add07db3eba1883a2a4d4b6befb97c1ef680491eb969fa941f4cb738dfaab2ab7eeab2022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220e36fdd0a514fc9046de2ac30a3af8291d104a83d14a20af32b2a96fa296f441288880888823214a8f1528088880888808888088880888808a8acde8807a2c0b8cfc488385fa12b6f0ffde553b1052423abe676cdf90ea7e0b3a73b7c657cd3ae5aee34f686b3e99639d369ed38d7555700018df20c65a7c37772b7e450657d9938632e8fd272ea2bbb4bf516a03ed754f9061f1c6497363fcf27e3e8b76b1b868c8556f4e831e1fc972202222087745f3871fa48f4ef1e38497d717440d4be8b99a3621c402dcfc1ebe905f3c76c7a710e9cd1d77e53feefd414e79da704071c11f90fa20fa159f77cbd3c9597142e6bd8d70e8e1cdf5dd72a022220222202222022220222202222022220222202222022220ab5e1c0107215951ad0dd80007900ae808888088880888808888088880888808888088880aa7a81fcd55c48e9febcd6bce27f123f67036c9686baaf5457465b4d0c639fb9e6cb5b23c0f5e83d0a0d87cdef633f00ac3aaf9b1bc1fd5da434257df6fdc41bb57ea2a369ad6ba3909863e50098f04ee3cfc3c96ffd315f25d74edaeb253cd2d452c52b9d8c64b980938f9a0f59111011110111101111071938529f9a86a0bede8a553725580c2094444044507a2095444c64a0ba2220283d14a20a0255d47c94a022220222202ab95910437a29444051d0295570ce0a0c438a9ade9f877a12efa827f78d2c27ba8fc5f21d9ad1ea4e3e8b5df652d115362d0d3ea3ba87bef5a8e735b3492b70fee8e4c60f8ef92efed2f13b413ddc4de24691e1a52b4c903a6170b8c8c764471b7c1df207e642fa229208e9e9e28a38c471c6de56340e8d1b0fc907337eeefd559474e8a5011110168ced8f183c189e7239bd96e14b381f07ff009ade6b4e76b4a77d47023519660ba2eea4c63ca46a0da161aa35b63b7d491ca66a78e4eb9eac057a6bc3d16f3268eb13cb794ba820247fe9b57b88088b8deee507fd7c907222d5fa9b8fba7b4c5dae16d9e0b954d5d0bf9656d3d364639412e049dc0cf5f42b3fb0de29b505a292e546f3252d546d96371f10420f45111011110111101111011110111101111011110111101111011110111101111011110111101111011155db0f1c7a20c6788bace9787fa3ae97eace57474911732371c778f3b35bf32405807003455c850d5eb6d501f26a8bf3bbd777ad03b8a738e48dadfc3b797861795c49a83c4de3469ed0ec0f96d169ff007a5d434e1ae7b778da7c3ae3af9adf11b5ad6800600d820c2b8c550ea5e19dfcc643659698c31f9973c86803e24aca2c547f66d968293af714f1c5f4680b0ae2bb7ed5aed2762df92bee6c965001398e1f7ce7d3a2d871b7946db20ba2220222202222022220a2b0185288236f44f051b9504f2f508247de50e716e7fc1617c4fe2ad9385b637d75d2a98d9dc08a7a5072f95fe0d006eb565aa3e26f19d8caf96ac690d3d50dcb20191339bd76c6f9dfc506e6bf6beb069a93bbb95e296965c6444e9473bbe016bfbbf697b051cc596fb7dc2ed1b4132490c780dc7c7aaefe9becff00a62ce44b7085d7dadc7ef2a2b4e438fc02d856db1dbad34ada6a2a1a6a481a30238620d6fe8835a583b4ce8abccb1c351593da2a24203595d096827c810b6ad354c5550b648656cac70cb5d1b83861787a874269fd510086e969a5ab6b4e5ae7460381f420642c26e1a2ee3c3a315c34d55d4496b80974d6d9497f233c4b7c481e2df98f141b65aacb1dd27aae8f54dbdb514ef2c79197c4efbcdf51e60f9ac81a76f5413e2a51101111011110154bb1f4cab2e19e46431bdf21e5635a4b9c7c0789fc906aae31f1ee9b85170b7db9968a9bedcaa9a66752d2b834b2307ae4f8ff0082f73859c60b0f166d53d55aa6745554aeeeeae867da581c3ae4797910b57f0b2c0fe29714751ebeab9a475b209c51d0331b39acddd8cf81f1f3caf238c9a70f01389b68e27e9d80d2d96b256d25fa8e99bfbbe539fde728d86df98f541f5237a6fd559746d174a5bc5b296be8a56cf49531b658a56f4735c320aee8e882579f7abac163b5565c6a9e23a6a589d33dee3b00d0495df3d168eed53a8e78f46d1e93b7bdc2e9a9aa5b44c6b3ef18c91cff000f0fcd0799d9aad13eaaba6a5e265d220daabdd4490d135c0e594cd7751e59c0fa2fa09be3b60fa85e368dd334ba3f4c5b6cb48d029e8a06c2ddf39206e7eb95edf4e882511101111016aded2d0f7fc12d54de4e7ff6769c6707efb7fd7c96d25ae7b4246e93837aa9ad1977b2ff00fd820c9740c8e9743e9e7bdbc8e75be9c969ea3f76d590af0b44f30d1b610e3977b053e4ff00e9b57ba82aff008e078ac2f89ba9e6b2582682dd3b1b7bab7329e922072fe779c0207c398e7c30bdfd477ca4d3367acba57ca21a3a589d2c8e271b0f2f5e807c56ade07415bae1d55c40bdb0b67b84b21b6d2b81c52c00f2e467f111b67e3e683adad74cd170d384171a68cf7979baf2d34957280e9259a43ef0f86c70b6b68bb37ecfe93b45b739752d2c7139de6e0d193f5cac1788713b51f13345e9f6b79a9e9df25cea9a402008c623cfc483f55b5075dd0591110111101111011110111101111011110111101111011110111101111011110111101111011110170c8e0c69738e1a012ef4185ccb10e2b5e8e9fe1cea4af69c3e1a194b4f4e571690d3f5c20d6fd9bdaed5377d73ade619fb52e8fa6a7c8ff931e06de99fd16f3c9002d73d9dacb1587837a6208e3313a5a5153273752f9097b8fe7f92cd351dea1d3f65aeb94eee58a9a2749f123a0f99d9061b4af76a5e32544a038d1e9fa3ee39838f2baa66f788c7a301fa85b19bd3a63758570a6d55343a4e3acb88ff007a5d647dc2ab2dc10e90e434ff0055bcadf4c2cdd0146473633bf921ca80d1cd9c6fe682c888808888088882ad5651d02af3faa09f9ac4389fafe9386da42b6f3540cce8c16c1037ef4b211eeb47f8f86165ce77ba7ebd70be6bb4dd2af8d7da1ab2463a49748e998df098f6314f29d8820f5dff0040839384bc26afe2557d3f10b8864d7d54c3bcb7db6520c5033390e2de9e2765f4746d6b5a03461b8c0c6c31e8a91c2d858c631bcad60e56803a0030b9b1807cd055df7ba2b37a7446ab208ebb1dd55db1cec0f9abaaf320d6bc46e5e1cda66d4f6c84f35248249a9e36ed2309f79a3c81c9f81dd665a4f5250eaed3d4379b6ccd9e8ab2312c6e6f867a823c083907e0bb776b653de6db5343571b65a6a9618a46380208231d0ad2dd97239ec147aaf4b54ca4bad7737be2613f7627e7031e1bb4941bddbd14a86f4528088880888820f45ad3b406aa7697e1c5718657475d5a5b474cd8ce1ee7bce36f1d867eab653b6dfc3c5682d7ed9b88bc78b1e9ea76b26a1d3d0fb7d5779bb3bdfc2d23d7641b3b855a459a1f40596d21b89a1803a638c66576effcc9fa2f5f56e9aa2d63a72e165b84625a3ae85d048d3e47fc0807e4bd86f4ca381c8c74f141f3c766fd555da5ef97be165fa77495d64797dbe670e5efe989c86b478e33d7e2be8661cb73d7e0be7aed2ba5ea74d5e2c3c54b345cf70b0ca19591b5bbcb4ce38276eb8c9fafa2de7a6af94ba9ac34175a195b351d642d9a2919d082107a0f7729f36e3277dd6808646711bb5549cd19968347d0e1ae232df697788f51cc7fbab79deebdb69b556563fee53c2f94fc1ad27f905a77b2c5b64aed2b79d5f5ac6bae3a8ae1354b9fcb83ddb5c4347d73b20de2dd959559f7559011110111101605c726b1fc26d50d7b5ae69a376438641dc2cf56bfe39f33b859a85ace52f306035c460fbc10647a25bc9a36c4d030050c000ffd36af6dc7701791a4dbdde97b4370016d2420f29dbee35776e35905b68ea2b2a5e23829e332c8f2766b5a0927e9941a438db5557c44d7760e1a5b647c74d30fb42f32b0ecd80670c27c092b765b2db05a2db4d43491b63a7a78db1c4c031ca00c05a5fb375a65d4953a8b88f716cc6b6fd52594bde0c06d2b0fb9ca3c0673f45b3788faa1ba3345dd6ea306586122167f1c8766b47c4941896840751716f585f84ad9e969638ad94ce68db6f79f83f1fd56d61d3ae5611c20d2eed29a128209985b5b53cd59545df78cb21e6393e8303e4b37e8104a2e17c819bb9dcade9b9015daef9a0ba281d14a022281d104a222022220222202222022220222ab8e10591625abf89da634208bedebd52db9d2383591cafcbc9ce3a05944323268d8f6383d8e68735de63c0a0e54444107a2e373c0763c719c7c179ba96f9069bb15c6eb520ba1a281f3b98d38710d04e07a9c607c57cb3a7753ea0ba32dfc62aa9aba9e89f7574135be425b1b28b3ca30dceff789cf9a0faedbd15975a8eae2aea78aa217892295a1ec78e8411907e8bb280aaecf8792b2f3ef55c2d96aacab3cbfecf03e6c38e07bad2773e03641a7b8ebc7ab9f0eab292d3a5ac336a4bccb97cfdd4124b1d33078b8337249f5d82f6381fc74a5e2e5a8b2aa8a5b2dfa1da7b7cd900e362f612012339f86170f671a89ae7c3a66a7b9c8d75c6f334b57513b8803979c86807f8474dfc9792cba5371138ef433e9f6779456385cdb8dc636f2b5eec90181df88e71f2ca0de8de9e6a5437246fb15280b5a768985d3706355b5b9ff00ca64e37380e04ede2b651e8bc2d65430dcb4adde96a2564114f492c4e9a4c06b399a464e7d7083cfe16d632bb871a66a213cd1bedd0e0b4e7a30058cdf6b9bc4cd6b069da2267b1d9e4151769d87dc9650331403c0ff0011f0e8b53703f5aea6d5bc3ea6d0fa6e3753cf6b91f4b577c908eee18b9896f201d490765f4668dd2541a2ac50db285b9630f349238e5d2487ef39c7cc941ef47f77cfd55d11011141384128baf53570d1c2e9a696386268f7a491c1ad1f1256b8bd7684d1d6da8752d1564b7faf69e51476981d3bf9bcb23608367642e37bb91a5c5c1ad1b973ba0fcd6a61ab3899ab598b3697a5d2f4cf6e4555ee6ef251ff00a6de9b63aaac7c0daed44e6c9acf57dd2feeea68e95fecb4c3d30dddc3af54195ea1e2fe8fd30e31dc35051b271bf730bfbd7ff75b9f258b3fb4b69be63dd505f278ff000c91dbddcaef51b2cbecbc35d25a631350582df48e637fe33a01cc31e25cedd78173e3fe8ab357cf452de077903b91ddd0696e7d0a0d96e28888308e33eb66f0fb8677ebd9e6ef21a773620ddc991deeb7f321637d98b488d2bc23b54b2c7cb5f74e6b8d539c72e73e4391927c863f358b76cbaf33689b069f8f98cf79bbc313434ece0d3b83e9b8fa2def68a18ad56da5a28006c34d13616b41e81a3083baac72a1aac821bd14aa38868c9381f1c264a0baab949385c5248236973886b5a325c48007c504bb03a9c1f8e3cb256a3e1469faca7e24ebebe49246ea1b8d446d81ad600472120ee3a8ff0012bd7d45ad5fa82ebfb396581d3ba76e24ac1272b5adc9cf291f0599e9fb15369eb5c5454cdc46cdf27392ef13f141eab3a79faab2ab91a82c8888088a0f441d3b956c56da3a8ac9dc190c11ba47b89c61ad0495a8fb3a513ef74ba875c55b5dedd7faf798dcf18c53c6e21807a75fa2ed7697d4d2da38772da289c3ed4bf48db753b31cc7df2398e3c76cfd56c0d11a661d1da52d7658778e8a06c59f3701ef1f99c941edb761b2bb7a29441e75f2d505f6d35b6ea96f35355c2e8246f9b5c31fcd697ecb575a8b6daf51685ae93357a5ebdd4d1b1c37ee1c72d3ebf1f55bd9dbe47a2d1b2d33747f6ab8268bf7706a9b3384918d819a139cfc70107b5da7b509b07076f218ee5a8ade4a38f7ea5ee0081f2cacc3865a719a4f40d8ad2d1bd3d2461e48eaf2399c7ea4ad57da369dbaa35970eb4a34190565cfda67637ffb51f527cfc56fc63435a00180360105d111011110111101609c69699386b7b635ed639d1b40e7d9a72f6ed9f0caced609c6907fa35bc80d0fe66b1bcae3807323763e610657658bb9b45147cad6f240c6e1bf77668e9e8b587699bb4f0f0e9d66a39dd05c2fb5315ba02ddc9e677bc3e9faada16b6f756da56e1a3961682d60c01ee8d82d37c4ba69f537685d0166e7028686096eb2b43b7e66921b91f241b674ad861d2da72db6980930d153b2004f8f28c13f3ebf35af389cf76aee22e90d231379a96394dd6e38c16b638ffe1b5df17787c16d2aaa98a969659e77362863617c8f71d9ad1b9fc96aae08f36b0b96a2d773b31f6a541a5a3cef8a68dd818cf4048ca0dbac000c0e8365e1eb6d514fa334c5d2f9541c69e869dd339a3f1103dd1f3270bdd6ee32b4876c3b84947c19aa8212e12d656d35380c382e0640e23fed41e268ce1bdff8c16dfda9d59a82ae16d765f456da5f75904793cb9cf5f13b2d43aa75cf157b337172dd4572b8cd7ed137094772d2d32b7bbce1cdcee58f006478745f6bd86963a0b25052c51f771c50318d6630000d1b2c4b8c3af34ee84d235551a83bb99b331d143478e67cef231cad1feba20cb6c37aa5d4569a5b950ca26a4aa67791bc7883fcc1c8f92f4d69cecb9417ca3e1742ebdc1252367a9927a3a798e5f1c0e20b41f2df271eab7137a6e82a49cedbad29a5389b71d59da0af766a59e5fb02d946e84c78cb2495ae6e5c0f9e4e16dad4573659ac770af9080ca681f2927c30d242f9abb2b568ba71135319807545352b647484ee5d349cc7e7b20fa9fc0f9ae324b5f92ec371d09ea574af376a5b0db2a6beb66105253b0c923dc7a0037c799f4f1caf9578cbaab88b7dd1555af69abe7d2fa7e8ea19f67dbe33c934d193bcd2798c630d283ebc6f452b1dd01a806aad1762bc025dedb450ce73d72e60256423a20945479c79f45aa35f71d23d35a81f60b0d82bb555f63199a9e8ce238463f13b077c786106da45adf84bc6cb3716a92a9b46d92dd78a2718eb6d354477f4e738c91e23d56c669e61941644441571f55abb8a7c589f4fd6c3a674cd1fdb3ababd87baa761f769dbd3bc908e801fd17a3c58e2637405be9e9e8a0371d45727186df42cdcbdff00c47c9a32b8784bc33768aa19ee37595b70d53733ded7d6bc6f93bf76d3fc23f920f947899c29b8cbc5cd0da5ea2e46f7aaae92fb65d6ae67b9d1c4ce6e6e46b4f4680d72fbc208c46c6b5a03400060741818c2f9fb87d4b1eabed3fabafc4730b4d27b1073864071939460f81e567e657d0ad686b761b20b28f151ccba574bbd159a95f555d590d153b07bd24cf0c68f9941aa7b586a29b4f706ae9ecee026ad961a4683d4873c138f902bd89f85b497fe09c1a29f23a96192dd1c224a771698e400383863febeab40f6a3e37e9ad5d74d1f66b1d7497a6d3dcc4d5705082e12805b80dfe2e8e1f359dc7a878d1c5183bbb659a8f4459e61c82aeb0975408fc481b9c91e88337ece37d9ab340b6cf57219abec733a82690fe3c1d8ff00af25b5dbf756aed0ba4f4f767ed1953f695edadefe6755d6dcaba40d74d21033807f41beeb07d41db1ec31482974ada2bf5455bf68844d31b1e7c39460b88f920fa2bd1619c5cb9d35ab871a924abaa8e9a375be760748e032e2c20003c4ad414dacbb41eaa6192834a5a6c104bf73ed2931235a7c719ce47a856b4f66bd4bacef315d78a1ab5f7b8e291b236d14796d38c7e139f0f879f541ad780b1eb4e31e82b7e9ab6569b268bb793056d76712d412ee62c601b8d88ebe6bebad25a3ed1a1ac905aacf46ca2a383a35bbb9ce3d5ce3d4b8f995a164e0d6bfe0eeabb85e385f35156d8ebe4e79b4fd63cb5b1bbc7909f0cec327385eab6edda075549ecc6cd63d250b861f55def7ce1f000b906f8aeb952db21335655434910fc551208c7d495acb50769cd0b60ab34cdb8cd759771cb6d80cbb8f0cec3f35e05b7b304576aa15daef535c356d53bde740f90c54e1de430738fa2da3a6b86fa634831bf645868681c1bcbcf1c439bfbc46506afa7e36eb9d731e747681a8869dfccd6d75ea5ee58cf27169c647ccaee52706751eb1aa8eb3881aa26af87622d16d3dd52e7c9d8c7305badadf742103ae3741f395d28e0ece3c4d8ef34d47243a16fac14f531d334f2514a31caf23c07afc56fdb3dea86fd411d65baaa2ada5907336685c1c082ad74b5525e68a5a4aea686ae964187c33b439aef8ad4757d9a2868ab2a2a34b6a5bbe946cc79bd9a864cc209f26f920dd049e9e3f3c2e0aaae8286274b533c74f13772f99e1a07ccad3b43c12d654beebb8a378e420f33c332f3f0c9d8a43d96b4ed75c3daeff0079bdea591bd61adad3ddb8f9968ff141905ffb41e8cb1cad861b91bd553cf2b29ed319a8767cbdddb2bc09b58713f880d7b74ee9f8b4a5bdc70daebc383a623f8847fc8ad97a7343d834953b60b3d9e8edec66c0c1080efef75fcd6418f1c6e834f51f00a4bc44d3adb54dd354cbd4d3990c14d9f2e469dc2d8ba6f4759747d20a6b3dae9add0e304411804fc5dd4fcd7b47c7f258c6b0e22e9fd094a67bcdca2a6c038846f23be03aa0c99df5f8ac6758f112c3a128fbebbd73237bb68e9dbefcb21f20d1bf8f8ad71fd24eb6e26548a7d1964367b349b3afd74183cb8fbcc679ac8744702ed1a6ab8ddeef23b526a17eefb8570e6c1ebee34e797e483c29a3d65c6673e19e99fa4f48bde0f338915950d077c01f7411e6b60d9f86da56cf6ca7a382cb432450b795ae96163dc77f17637595b7a2728f2415451e3d54a0f9bfb504866e27708e881c092e86477f64b57d1e0876e17cff00c6c8d970ed05c29a591deec334b316e3aedfff0095f408ff002410d2ac3aa0f82841e1eb1b3d4df2c3534f475668aa790ba39b2400ec6d9237c7c16bbb7ea6d6fa3a29e9af54edbdb69e9f9fbf8e1735cf786e794168dfc373beeb6f11ef0dba744e5f781c610682b2f14f8b3aba9df3dbb44c36d84f2f77257b8efe63190b3286d5a93525c25b6dfeb9b48dee5b29869227608270407671d56cd51ca3c9079360d336fd374fdcd0c0d8c6305d81ccedf3b95ec35a03555b9cff009a91b7a20b3ba2aab3ba286a096f4528aae4165c6fce320138dfe2aede8ba970effd92634a23352233dd0972185f8f77247867f541a56e864d73da5ed946581d6cd2d48ea8739db9f687f4c7aee0ff00656f28fcba63c3c96bde19681add3f3dcef17c7412df6e531967f6724b1bb01ca09eb8dfe456c46f5f3416444410ee8b4a71ea17d9f5a70d352c6790525dbd8e571e9cb300dff15bafc169ded43037fa39a6ad7004dbeeb47543d796419083c5a7075776b4aa90ef4fa6acfcacdf632487047fdc7e8b7db57cfdd9a03f52ea4d7dac24c9fb42bcc30970c618d24e3f31f41e4be811b34f820b22a0279b18db1d72ac3a20945e2ea9d536cd1963acbc5e2b23a0b752b39e59e53eeb46703e64af9ba6ff00e20ba323bd1a48ac9779e87bceefdbbdc6e7dec73726738f541f44ebbd6147a0b4c56df2e0d99f4b4ad05eda76f33ce4e361f35deb05f68f5259e92e741289692a582463da73d7c3e2b49f6a78b51ebae04cf2e8aaea76524d1fb654d4b9c399d4ec6f3f2b074249007a616a8eca1c50d4da46d365a1d4504d269cba380a4ae6ef0b493cb8c9ddae07ab7d33e283ed75aef8f218ee17ddc48e7b41310058e20e4c8d1b2d80d256b5ed152c90f0aae6633873a5a76f4cff00cd6a0cfed9198add4ac25ce2d898df78efb00327d5698a399f55dae2eb1900329b4e478e6393873f7c0f3dc7e6b74dbe3e4b7d334b8bc88db927c76ff35f3871275653f08fb4f51ea1b93bbab55d6c8e81cf7600e68f2ec0f5f747d50673c7dd4b593d250688b2cdcb7cd42fee799ae0d31403efbc9f0e87eab65e94d3f4da574edbed146d0da6a385b0b303ae06e7e6727e6b50f03acf59ae3505cf89d7984c335c7305ae9e43cdecf4c360e1e5cdbf4f25bcda40e8105ba05a07b5cc8f759744d3723a48a6d454bde35877201dc7d095be669190c6647bdac63772e71000f524af8cfb6671aed77ab6dbec9a7a5f6f9adb5f154cf5b0e4b29de1d86efd3ae107d07c5de35daf85d471c0d8df73bf55659476ba6f79ef79d9b9c7419f0f1c2c07865c19d45ac35447ae78a4f8eaab5b87dbacb261cca5cee0b874c8f003e7bac8382dc218e85d4dacefb7275ff525740d95b52fc18e9dae190183e0b75000b70771d37408fa1f1dd5d151c7afc33841ae38fb7736ce1dd5c11b836a2be58e92219ddce7b80c01e3b656aaec716be5b87112eaf2e7bdf726d2091c0005b1b483f0dd653c71bd4772d4d6fb7472874166a79ee958e8fdeeedcd61eec11e79fd5695e08eafae9b41d2682d2dcd26acd4734d72aeae8dc3968299cfc17b8ff1900e020fa0aaaa5bc64d64eb740f749a4ec728755b8b7dcaeaa6f48fc9cd6f53e195e476c88e36f67cbf332181ae8791acf478c7e4b6c68fd2b45a334fd25a2df1f253d3b71cc7ef48efc4f71f1738e493eab4876deaf923e165bedb0bc092e374869f909fbcdc127f3c20dabc168fbae136906e397fdd74fb7f602cdd791a56cedd3fa6ed56c67dda3a58e9c1feab40fe4bd63d10637af7540d29a62b6bd8def2a5ad0ca78c6097cae3cac0078eff00a2c77465a68b85fa424ba6a2aaa5a4aea83ed171ae970de691dbf2f3790f003c97a5ab6c0dd49aab4ec35b1ba5b6d2bdf5623e5243a76639093e1cbbfc72b55d5589fda238837065ce593f6274f54ba0651b0b986aa71f7b9b1e5fa141a9759712b46e9be3c69fd71a1aeb1c8cb8d60a4bdd1461ccef03b0d0f00ec7391f12bedf610465bb83bf55f1cf6b9e06697b5d974b7ecad929ad5a8eaee7151d33a932c0ec6e0b874d881ef75dd663c17ed0377b56a18787dc4ba575a750c20414d5ce05b1d4e366e49db246e08ebe283e995e6df6f349a76d35772ae9441474d1192591db00d1fcd778121bd4923afaad27c519a4e29eb9a0e1ed23dc2d54e456df2768d8c6d3910e7cc9c6c83b7c28b4d56b8d4157c42bcc586d40ee6cf4cec1f67a719fde63c1ce24f4fe6b701cf29c0c3baefe6b8a92962a2a68a9e089b1430b43191b4001a00d80fc9731f74f90ebf9a0f9cfb1e4e6b1bc43a89dce92b9d7c7b652e3d00cf28fccadff0077bcd158a864abb85543454918cba59dfcad1f35f2dc5a7f8a5c10d7fab22d1fa623d4366d4157ed74d3171e5a771dfdec1dbc7aecbd9b5f0035b7152e51dcf8af7e0ea361e68ec96d70e40739c38b76f1f541eede3b40ddb5bdce4b370b6d0fbed531c5b35daa0725243e4413d47cc7cd45afb35566a8a86dc3891a9eb352559ffe82090c74d1f8e078e324f805ba34e698b5e93b5c56eb4d04143471800470b40071e27ccaf59c83e63e3e70c7f60dfa2b5468bd2d0cf1e9bab74f534d49180f747ca373b6ff001ebb28b976d6b5d550c547a7b4e5d6e5a9ea00653d0c90e00908e980439c013d06e42fa69cd0ef03f10ba34f63b753d43aa23b7d2c750492656c2d0f27cf38ca0d09a4b8017be20d6536a6e2c5ca5b855e39e0b1c4f0da7a7077e5763a9dcedf0f1cade1a7f46d874ab7fdcd66a1b6e460ba969db1923d48192bdb441c4d85bce5cec39c320103a0f25ccd031d11aac82a5a1c81a0780fa2b2208c63a0c294440444404504e1473209e51e48ee8bc1d45acec9a569df3ddeeb4b6f63464f7d2807e9e3f05ad2e3da15f7c93d934269bb8ea8ab3d2774662a61ff005171f0fa20dbe6370a812778445c9831ed8f3cfa2c0f5971db4968b91d4f35c0dc6e19e51456f699a427c07bbb058a33861c42e21be1975bea66daa8012ffb22c839320fe17c9e3f9ad89a3b863a6742c4d167b4c14f2b460d53da1f33bd4bcee506b7fb738a3c5368fb229a3d0b6773b7acac6f3543d9e6c1e7f4f8af7b48767cd3d649e3b85ddf36a8bc6799f597221d977986f4fd56d603d3e0559071450b618dac635ac6346035a3000f40b900c2944044441c5e09bfc94b95b6c6e83e7ae2f0e5ed2dc2dcb9cc32899ac206db03d7eabe836f5f9af9f78fb5335af8c9c27ab600e63abdd0f3386cdce01dfe617d04dfbbd73e082c4613977524e1074410dea570cd3329d8e92591b1b1bb97bdc0003e6b8ae972a7b3d0cf5b572b60a68186492471c06b4755f3b3aa354f692bc4d1d2cf5361d051485bdf3080fab68f21d4e7e8833ed49da0f4e5aef1f64db1eebbd7e7df306d0c43c4b9e76dbc875cad63aab8a7c67ba475757a66c4c3474f54d83b9a7a7e79dc0ee1c5afe83041ea3a8dd6f0d11c29d35a0297b9b45b58d900e574d300f91dea5c7f92cd3cca0f9474c71f78a3a72dbf6aebad293d15a62ab6c0f926a70c7b9a76e61cae23afaafa92db5b0dca869eae9ddde53d446d963779b5c320fe6b57f6a3afa7b7f062f7dfb39cce6386268ebde1782dfd1663c2db7d4daf875a6e92b1fcf5515042d91c7ae790754195a222022220ab906fd51df1c2373e79416518c740a51014382944151d0ad3ddac5ce8b815a8a66679e21139ae69c161ef00e6cfcd6e23d1685ed997111f07cda43da26bc5c29a898df120bf248f86020c97b3469c3a7b83d63ef726a6b98eac98b860973cedf901f55b5979d62b6c767b3d0d0c4008a960642dc0c6cd6868fd17a282a5b9729f052a1dd10680ed635df6cd0e94d0ed7b5afd4373631f9193c8c20f4f89fc97b376d17c2fe1adae4b7374cd0d4d75737bb143494625aaa971006c00c8eb92e2478eeb19e3ec2d878f7c1ba97e4b1d5b246ecb872fbb83d3e7f985bb2d161a3d3a2aaa5e61755d44ae96a2adec6b1f212e2402e3e03a0f820d1dad6866e11f64fd414b52d31d4d4c52b194a1dccca6350fc36269f26823e795e55dac674ef083853a4632d75e2a26a77f2377d9c799c71f3fd577fb62f1134ad4707ef56565f68e5ba3a489cca48a50f7b8b5fcc46de80a8ecd16cbbf1365a1e21ea4858ca6a7a76d259291a72d646d686ba6f89c6c7af541f4ac7d06f9f55aafb4cd73e8785753c8f746e9ab69210e6f5de66ff82daadfbb9f15a6fb53dc29adfc3ba2357208a192ef48d748ed9ad01f924fd106da96aa1a1a133d44ad8a08e3e77c8f3801b8dc95f29ebcb3cddb03550b6db4ba8349593bc0dbb188f3c929d8f213d46c323c97af55a8affda7b524b65b3196d1c38a37f2575c58ec1adc1fb8c77d17d13a634d5bb495969ad56aa56d351d3b7958c037e9d49f127cd07cdf66aee3df0b29a3b347a7e8757daa8408e9ea23706bcc60600ce4787eabda8f8adc73bc35eda2e18525039bf8eb2a31f4cb80fcd7d1d81d709ca3c907cd0de15715f8af247fb7ba9dba7ecee397daad18e795bfc248ff0035b0eedc04d334fc30bce94b1dae9e8c56523a2121fbef9719639eeebf7805b53037d9463d107cf3d993898f8ed9170f352364a1d4f6461a76c750394cec6ecd2d276271fc97d08d3b641d96a6e357002d5c5d9296e0daca8b1ea1a3696d3dce90f2bb1d407f9e0f4dc1192b5bd0de3b4170b3fd9eb6d547afadcd3cad9a2931311e049d8f4c6c46507d4873e0161fc4be225bb86fa727b957480cce1c94d4cdddf3487eeb5a06e772b4eff4c7c6eb94fdd51f0ae3a40ed9b255cce0d1eb9dbe8bdfd15c0db9dd75543abf88d726deaf709e7a4b6c64fb25113bec0ec4f5415d0dc26b86a2d03a9eab51d4cf417fd5d1bfbf7b3fe252c64618c00fa75f9792cb3839c10b17066c9251db4beb2aa67074f5f50c6f7afc741b74031d16c76f8ab0007418410d181f35f37769aa73aab8a7c28d31c9de4325c4d64ccf36b48f0f835cbe90277c78f5d968114526aeed78fa9735d251e97b386b5c0ec2694671f1c39c837f331d30aea1bd14a0f36f958eb7d9ee154cd9f0d3c92376cee1a48dbc7e0be69ec3dc518354e96bfd92aab3bcba50d6495b377b1f74e0257b8b8e0edca0823eabea57b43bafe8b574bd9ef48b2f75770b7d34d687d61e6ab8a824ee993ee492ef1dfd36418e529fe9838dd4b728077ba6b4931c629707927ac7f88cf5e51fc977fb4df0969b88bc3eafaca6a760d416a61aba1a968c480b3de2dc8dfa671eab69e9fd3f6fd336b8a82db4b1d2d2b3a3183a9f124f89f55de99ac31bbbce5eef187731c0c20d27a0f8e304dd9d28759573c3eba9a9fd9248b24b9f54d3dd86f9924f29594f04f4755d834f4b76bbb9cebf5ee415b585dd63040e58fe431f52be75e04e9fa7bd71935569bf6c8e6d21a7eeb25ca3a573f31cd3b8e1be840232beca1510823f79927383d7d0fe883b0d180a7e4baadab0f2d0c6c8e0e277e5d82bbe69391ae642e7737504e0841cfca3c94aeb3e495a7dc88b863ab9c000570c1edc5ee33080373eef2177e683be8bcf7475ae92377b446c6820b99dd139f4072ba9536baea991c7ed5a88632e2792289830d23a6704f541ec13e1d133feb0b1faad312d63256bef57463648d8d22195ac2de5f10797627c7cd43b4947353c704d72b9ccd630b09f6c735cedf3925b8c9ea8320ceffe5b2af382e0dce1c7c32b193c3db51a6929a67575442f70716cb5b3386ce240fbdd37dfe4ad49c3ad3b45718aba1b5b63ab8492c9bbc90919ebd4a0c9b3d73d7c4f45026692073b73d46eba7159686373deda58c177de763afc5737d9b48e735c29e1cb47283c8361e48390d4c6d760c8d07c8b80506b21c91deb01033f795853c4cfbb1b07c1a14f2b37f75b923cb74158e764832d7b5c327769cabba40d6e49007c5742e777b758a032d755d350c60679a67b583f35835cb8dd6a74c692c56faed51559c06d0c07bbcff5cec8364b8ec7f92ead65ca9edd13e6aa9e3a689bd5f2bc340fcd6b6963e25eaec077d9fa4685d8248719ea48f2f20a6878016395c66d43555daa2a4eee757ceeee89ce76634ec8175ed0361f6c7d069e82b755dc9bee986d709731aef273cec3e4bca347c5bd75eed4d550688b7c9ffed819aa80f9ed95b52d361b758298416da1a7a185ade5e58630dfd373f35cc26969592bea03044c190f61249f523fd7441ae6c5d9e74e515736e57992af545cc1c9a8ba49ce3fb9d16cca3a1a7a1a76c34d4f153c2de91c4c0c68f800a68eae1ae81b341236589c480e6f4d8e0fe617650401e9ba9444044440444404444157283e0aea1dd10687ed714eea4d1961bf3232f7da2f14f3170fc0c2f01c7f20b7751d547574b0cf1383a3958246b874208cff00358571db4d9d59c25d4f6e6379e5751be58ffaccf787e8a9c03d4835570874cd717f7928a46c32fa3d9ee91f920d819cfaa90708d527a20d2fda0457eabaed2da12df2f70dbe543a4ac90388229e200bc023cf2b6a582c545a6ed14b6db7d3b29e9296311c6c6340c0006fb789587eb0b2c9fd2a68abdb473451b2a68e418fbbced05a7f22b61b3a2080cc630318e88ece3f356270b0be28f1128b86fa66a2e9527bda8e5e4a6a669cbe590f400796719f4ca0d63c5574bc54e2d58b43d28e7b6da9edb9dca5e6259ccd391191d33f15bfa3686b700003c0018dbc16ade0268aafb1586b6fb7df7f516a09fdb6af99b8310fc31fcbc96d56b795b8416507a294415e65651ca3c94a02222022a1255d01111055de017c9fdacae82ffc50d03a6daf25949590d5ccc07ab9d20e518f837f35f573bc73d0ed95f15c55cee26f6c28cb0c751454b561c5aec6447031c76c8fe2083ed48c72fbbe5b2e4546f4f5f4561d104a87745288342769ce15eace21d6e8db869034acb8d9eb1f2ba6a87e3bbe60395c01d8e0b56310f648d41aa2aa5aad6bc47ba5c9d2e0ba1a126361f4c38e3ae7c17d405a0907c5395069ed33d967879a4e92a994f6615753511398fabae2677b72d2d25a0ec0efe0b5f7674d62384770b970ab584a2d55745532496a9eadc1b1d540e765bcaef80fd57d44e03ae375af38b7c13d37c64b48a4bcd3f775510ff66af80013c07d0f88f4283d8d71c48d3fc3fb1cd75bcdd29e92958c2f68320e6930338681b9cfa2f9038a7a9f55f1eebf48cd73a492c5a0ae1788a1a1a573489aac1ff99f21d0f87d56edd19d9034969eba36baf3575bab258b9442cbabc3d8cc74f7475f9ae7e383229f893c25b2c6238a2fb51d29635a006b58d18031d3c506e1d3ba7a834bda29ed96ca5652d1d3b79638a3f4f127c49f35eb34602ab0876e15d01111011464267c903e4a1dd551d2068249c0f885e5d56a8b4d1bb966b9d2c67c39a66e507acac3a2c6bf6de8247725332b2b1d9c0f67a571cfcc8030b91b7eb9d4737b3d86a1b83806a268e3cfae324a0c8941385e0bcea099dd6868d991d39a577c3a00b95d6aaf95dfbdbb49ca7ab6389adc7c0f541ea48ef7492401e27c878ad33d9f226dceb35ceab91ed0dbcde6464409dc4718e41be7e2b655f2dcc8ec9707ba49e7229e4786c921232d69c6df158b7002d14f6fe1169d0da76c6e9e2352f05a33cef71767e3b8419e0bbd1e791b53139c003cac707119f40b91d5643f944533f6ea1b81f9ae56411464b991b5ae2304b5a012172900f51941d27cd50430b6068e61b991f8c7a6159d1cef00091918f1218491f0caee220ea963beeba47b81183b86fcc6375ab78e1a8aaa1b4d1e93b18965d417c2d8232dcb8c110239e471cede59f559e6b6d5b41a1b4e575eae52725252c7cce68fbcf3e0d68f124edf35adf81fa62e37696b75eea38dcdbc5d8b9d491499cd352bb768c78123c3d1060fc19d35070d3b44df34b454b1b219acb0cbde34e7bd90105cf39f12495f4eb77682b45d5c419daee81cc8db9934fc8e73ba13ef6cb7ab7c7cbc1000f453ca3c94a20222208e51e49807c139947320b28f92ead4d741431992a678e9d9d79a47868fccac6eb789d61a694431559aea8f08a86274e7fed4197728f25070df05844bacefd5bca2d3a4eaded76712dc2514ed1b7520e4ae38ed7ae2f0e0eacbbd159627347eee860ef9e091bfbced9066b34f1c11b9f248d8d8d192e240e5c7c562b7be2969cb1c82092e0daaa92e0d14f460cd2389f20deaa9270dad771aa351749abaed3001a7da6a0f274df0d6600cff0035efda34cdaac71b5b6fb7535186ec3b989ad3f5c65062d2eb1d4f702d168d233b58edc4f749db0340f32dfbdf25d6fd95d6d7f707dd75332d54e7ad2da2201d8f2e772d8bc83fd056c7cd06156ce12e9aa094cd3d09b9d51eb51717ba777fddb0f92cb2928a0a088454f0474f10e91c4c0d68f800bb488200c26075c6e9e2a03838673b20b2e1930d05c7007f11db1ea556a6a62a48649e695b1451b799ef79c068f32b0892babb8833c90503e5a4d387024ae6e5afa9df76c446fca7a17786f841eb68e97daa7bcd4c0fff0077cb587d9c781c01cee1e85dccb286fdd0bad414505b68e2a5a689b0411379191b060340f00bb3d360825111011110111101111011155c8382aa9d95904b048331c8c735c3cc1185a33b334c74b576b5d07512835566ba493c316fbd3c982d70f3df1f55be080ef3e98dbd5688e32d8ae7a035ad07142c3049531d3b053dee8a11932538d83c0f1e5fe4837c47f771d71b67cd4e7c1785a3b585ab5d58296f165aa6d550543799ae69dc79870ea0af6dbd10449089394900969c8c8e87cd5f1cadc21763ff0075aff885c69d3bc3da77b6a6a4d7dc46036df47fbc99c4ec32d1d065064fa9f535b748d9aa6eb76a96d250c0dcbdee3d4f8340f127c30b4a70fec171e35eb43af753517b3d868c96592df30c8201ff008ce07af9efe3f05dbb4e80d45c62bdd1ea1d78c6d0d869c896874e82e01cef074dbee56f3869d94f13228d8d646c01ad6b4001a074007a20e46faf55c8aa0655901111041385d5aba98e96096691c5b1c6c2f7728248037ce3fd6576d55cdf441a428f8bfaeef1ae45250682ab3a6fda5b19aea86189fdd9fc7b9c7ae16ee6677ca9e55206104a222022220f1f555d9b61d3975b8bb03d969a49864e325ad246ff0025f2bf624d3b2de6f9a97585602e2efdc46e70dfbc91dcef23e580b6af6b7d51fb39c1eb8c4c97bb9ee123695ad0772d3bb8fc80fcd777b2f69b769ee0f5a0c8cc4f5dcd56ecb39496bb01b91fd50106dc6f4524e14a20ab4e55911011110147c9417792e95c6ed476884cb5b590d233c1d348183f341dd7372b45f15a3355da278554f97e2315550437a6c07559dd571874fc733a9edf2545eea403fb9b7c0e9093f1e8b4eeb6be6a0bcf68cd032d2593eccae14154d83dbe50e1c8e1ef39cd6f4c7d7641f4d737ccae396a638013248d678fbce0161bfb31a9ee2c70afd506161663bbb7d30601ebcc772b929785d641c8eadf68bb4e067bcac9deecfcb38083bf55c44d3f4790eb9c32b81e5e4872f767e4175dbae26ad7345bac572ac07fe648c10c7d33f78af7edf65a1b54619474705281b0eea30177797d5062a2b755d54a032df4143161a79a799d238646e30df552dd3f7dab8c7b66a2918ec9cb28a063063cb246565580a5062b1e82b738b5f552d6dc1cd18ff69aa796fc700e17b14762b7d0c6d641434f1b5bd3118fd57a488281b8e830acde8a51011110704d1b6463daf1ccc7021c3cc63a2e1b4db61b45b69a869d819053c6236340c0006c365dce51e4a5011110151cee56927a0f1563d16afe356b1adb6d0d169bb13fff00115f1fecf010726067e290e3a6d94187dc3bde3ef125b42c73ff006274ecfcf50ec7bb5750370079819dd6fa631ac8dad6b5ad0d180d68d86dd1639c3cd0b43c3dd2d4966a305e221cd2cafddd2c877738fc4ac99dd0fa041a52e54af776b2b64ad7618cd3d2738f1dde7a2dda3c7e2b46555e2dd49da5aaebea6be08a0a3b0b63739ef1f7dd21d9bd77c782d94fd6cda88daeb5db6bae9ce32c7c5096467d79ddb20ca89c2a97755874955acee7ccd8696df6766016c933ccf20fec8d93f626bee918fb6b51d75449f8a1a2229e23f2033f9a0c8ee179a1b6c6e7d557414cdf39250d58d557152ccda83051c75b73971902929dce69f2dd77a8f873a728aa3be6dae2926fe398ba53ff00712b228608e18c323636360180d600001e4830f6dfb575d00f63b053db233d24b9547313fd86ee3e6b8bf64b525da23f6a6a79a02460c36d89b1b46e76e63d76c2ce7950340f0418752f0ab4ec58f69a375c64cf3192b6474849f8671f92c9e86db4b6e8847494d0d3300c72c4c0d1f92ee220a86f8e3753ca3c94a208e51e4a5146420945190baf3d5474b197cd236160fc5238347d4941d945855db8bda42ce5cda9d41461ed772f244e323be8d583de7b55e96b7c822a1a2badde62ee50ca6a6e5e63e432724a0dd67e1e8b17d45aeadda7668e919de5c2e328222a0a167792b8fae3ee8cf895aa3506aee2e6bea7645a774949a62dd2b72ea8afaa8db50e07cbf836c7af55c1a77417156d54ce8adacd39609de733575439f5753507c72ffe48365d3e97b96ad99951aa4b19481c2486cd0bb2c69c7fcd70fbe7d0ecb368618e18db1c6c6c6c68e50d68c003c82d40740f166ab227e23d240ce6c8f66b5b738c0f3f5cac6788972e24707f4fbafd55af6d7748e278cd157d108ccfff004b3977ce33f920fa311789a42f536a2d2d69bacf01a49ab69a3a87c07fe5973412df9657b68088880888808888088882bba37d77564405d7a8859346e89ec6c8c70e5735c32083e04792ec28c03d420f9eaf5c1cd67c33d475b7ce1656d29a2ad7f7955a76e1b424f898cf8138561c6ee295235b0d6709ea8559f743a1a80e8dcef3f82fa09cdf451cbb631b20f9fe4b4718f89ee636e55b4fa06d0fd9d0d23f9ea88feb79fa7a2cdf87fc07d35a06a9d5cd64d76bc3ff00e2dc6bdfcf23f38df1d0745b2b953976c636410cf056e815037976576f441288880888823c54a22022220222202abb6dd42970ca0f98bb41daaa78a3c6ad19a1e06bdf43047edb5ae6e406c65fef927faac007c57d2d494d15253c7042c6c7144d0c635a360d03007d30b8bec9a3172371f6487db8c7dc9a90c1de16673cbcdd719f05dd000e88251110151ce3d3f92e1a8aa8e96092599ed8e38da5ef7b8e0068ea4f92d275fc4fd53c53b9cf6ce1bc11d25b207f24fa92b633dd9f02211f888dbc0fc906e1bcdfedf60a492aee35f4f434d18cba49e40c0dff001f82d60eed11477cb81a2d2162b96a897706aa18cb29da7c32e3d47c171d93b3558c55fda1aa2e75dabee2fdde6be62d809ce768da7f5256dab6dae92d148ca5a2a5868e9a3186c50c618d1f00106b26d87891ab6663ee77aa5d3142eeb476e6f792907c0c87a15ebda782ba7a8dd14b5ec9efd54c3913dce532e7fb3d31fe2b60b5b8f05641d2a2b752dbe211d353c34ec6ec1b1461a02d2fafdcc8fb5270d8f2485e6dd5ade669f77183b2de9ca3c9691e2c426978fdc29adc80247d552fa9cb33841bb8354aab7eeecac8088880888808888088a33f54128bab515b152b4ba69a385a06ee91c001f9af2aab58da28dc03ab992b8ecd6d3874a4fc9b941efaaf32c6aa753dc24666dd62acab6f372f3cce6c231e60139c7c9719fdabaf6601b75abde19782ea8763e1ee81f54194e4e7fc975ea2e14f48099e78e10067df780bc1769496b4115d79b8546461cd86410b4efe4370bb14ba1ecb47289450c734ad18ef2a0994ff00dd941d1bcf12ec369b7d4d61ab35515346e964f65619395a3c49e83e6b54f0deb2f3ac351dcb8810d826a89ee2df67b63ab9e228a9698123233d79b7271d72164bc6991f748ec9a0ad1cb4d3dfa7c54ba2686886919bc8e2079ec02da168b54166b652505333bba7a58db144df26b46020c6e4a2d63718c35d5f6fb53496e7d9a2748f0df42ed924e1f415d8fb4aeb72b906070e49aa396324ff00d2d5987280bab72ae8e82df535529c450c4e91c7fe90327f241a63853a76dd271835cd5d2d342296d8f8e821696f316380cbbde764e7fc56f08d81ad0dc00318c2d49d9a2964aad07557fa8662aafd70a8ae7b8f5e52f2d6fe4dfcd6de6f9a0728f25288808aa5deabab5170a7a207bf9e3876cfef1e1bfa941dc458f4fadecd138b595bed2e1b72d331d293fdd042e376aba9983bd8ec572a8380419631034f5f1791e43c3c506484e14077aac5db55aa2b5ac7b292df6f63da322795f2bda7193b018fcd55b60bf54e4566a39236e7eed152b23dbcb2e05064ee7b580b9ce0d68ea49fe6bc6b96b6b1da09f6abad2c47a72f79ccefa05e71e1bdae62c35b2d75d0b0e796b2a9ef6b8fa8e9f92f5a874ad9ed78f65b5d1c0ece72d85bcdf5c20f163e25d0d6c863b7505cee4fc6c60a47721dff0088ec175aa2f9adab64a9650d828e858d388a6b854e73f26ac92f7a92d3a6695d5374b8d35be06ec5d3c8d68f82d7559c79a4bbd4368f45daeb35455bbacb0c4594f16e705ef23a7c31f141e84fa375c5f1d17da5ab994111de58ad7072103c838f8faac53545a7879a79cd8b515e6e5a9ae118f76defab92a2471c9c0e461c67e2bdd83446b7d690176acbf9b3d2caecbed5640d6e580e434cc77fa12b2dd21c33d39a2581f6bb6c51d46497554a4c933b3e25eedd06b0b2e93bdea493161d296ed0767947fe7aa210fae737fe9691ee15b2344f0bacfa29bdec41d5d7370fdedc2a8874ae3f1f0599728e5f3f52aa5dcbe1b20b6075c6eaae706825c7940ea4ff008ad63adfb40699d25586829657df2f192c1436dfde3b9bc013d02f06dfa6b5ff0013eac56ea5b8cba4ec7d63b550b877d235dfc6efc3f3dd064dc43e2cbb4b3e9a82c76c7ea0bc553cc51c10b862377839de247fa242c3f4b767faed47a9a1d55c46b87db5718cf7b05a49cd353127a11f74e3c80c7ea76ce97d1565d25018ed540c81e7efceecba693c32e7bbde3d3cd640d686803082b1b435a000303618e8b91110111101111011110111101111011110111101155cac80a8aeaae416450de8a50111101111011155c82c888808888088880888835df1f20ada8e106a965bc486abd8dce0232798b5a417818f12d0577f84afb3cdc38d3e6c1dd0b6fb1c6636c3d03b1ef7cf9b39cacbe66b1ed735cd6b816ee0f4c7afa2d4371d0fa8786575a8bbe8485b71b5d54864abd3734bddc6091ef3e9ddf85c76dbc708371b7a29580699e31586fd31a4a9926b1dddbb496fbb30c1231de2327dd3f10b3864c2567331c1cd2321cd208c79faa0e745569cfc1590169ae3753b5bc46e135612018ef6e8fd7de8cadcab4bf68fa7746cd0b736370ea3d474bfbdce39038f2ee8373b461a0295c6d3e87c8ae1a8ac8695a5d34d1c43a9ef1e1bb20ed22f186a6a29d99a6335593d053c4e767e78c29170ae9b022b7ba0690efde55480069036c8049dd07adcca0bbaf8af1c52de6a1c1d2d7c34adc6f1d3c1cd83e7cce3fc90e9e8aa1b236aea2aab049f78492b9adf935b8c7e883b55f7ca0b60ff006aad861cf40e70cfd174c6a464c1a28a92b2bb99bcc1cc8c46dfef3f942efd2db2928f97b9a68a22dd816b4647cfaaeda0f184b7baca6e66414d41293bb67719081e07dd38cae3160adaa800adbcd53de4fbcda5e589bf01819fcd7bc067a8cab20c7e1d176a6bcc92d27b53c8c73553dd2edf072f669e9a2a68c3228991b5bd1ac67280b9b947929411ca3c939479294405476c41f92baf1755de1960d3974b9c9cdc9494d24deef5f75a76f8a0d79c3f8e5d5dc54d57a9e7634d3501fb1e849f2079a423e78faadb63c7e2b5ef032cf35ab8696a7d4f31abae0ead99d20c38ba47176fe6718dcad88821dd16b2ed0fa8a5d3dc29bd1a6772d6563051403382e74a7970df5dd6c87c64c9cdcee03182d076f8ad35c418c6bae35693d2c3f7d6fb3b1d78afdb3878da261f89df08337e1dd0d1e8cd0f63b21a98fbda4a58e290641fde632fd874f789590d45c9f144d7414951505cec06b5b8dbcf27c17722a7644d70646d664efcad032b9397d107952545de5e66c3494f081d1f3cc5df9347f3556d15d2785c26b93237904669e01819f892bd9036e8a50780fd36da899afaaafaca9686867219b919919f7b0dc6fbae66697b4b64748eb7d3caf77e299bce7feece17b2b8c9c1c0f8ed8415a7a78e9d81b146d8dad1801ad007e4b91dd579978d436dd3f48fa9b8dc29a8206f57d44a1807d4ad6976ed29a75b38a6d3f4b5faaaaddd1b6e85c59fdfc7f241b7575eb2e14d6e84cd553c74f137abe570680b4d3abb8bdafda7b8a6a1d0b6d93612cceef6a80f3c781fa745ddb57673b5cf2f7fab2f374d5f59d5dedd50443f28c1f8a0ee5ffb4469aa2aa750d94556a8b8838f67b4c46419f22ec10179f4d5dc57d78d7725251687b6c9f8e7ccd561a7c4341d8fc70b68d8f4cda74c52b696d56ea6b7c2063969e30dcfc7037f9af4d06b0b2700ec14999efb2d5eabb8bb77d45d242f19cfe1603b0faad8f416fa6b5d3329e929e3a581a30d8e1606b47c82e671e5dbe2b13d5fc51d35a129dd2ddeeb0c2fc6d4f19e799c7c83467f904197ec3c175eb2b20a0a77cf533b29a160cba491c1ad1f1256931c68d65c42e6834169292263bffd52f47bb8a31fc5cbe27d0655e2e00dd75a4ded3c42d59577c2e39fb3285c61a567a7afc8041e96a6ed1964a5acfb374c52d46afbb3b20535b88e507d5dfe0bc3fd91e29714e5ff00c49768f4758dff007edb6b3cd348d38f75cece41f89f92dbba5743d8b45513696c96b828211ffdb67beee9d5c773d3c4af7c3404186683e1669ae1d5277364b6c70498f7aaa5f7e57e773971dfe9b2ccc78f92728f252820003a0c29444044440444404444044440444404451f88a094444044440504e1464e7a6427a94120e51dd1555d0515d11011143ba2094503a2940444404444107a2aaba202222022220a968241c6e3a29f928cfaaf1af3aaad3a75a1d71b8c14bcdf85f27bc7e0d19250725ef4cdab51c5dddcedd4b5edf013c61c47c0e321634ee145ae8dc64b3d75c6c2ece7968aa9c23cff0051d91f246712cdee378d3b68acbac80f2f792b3b9881f573bc3a74f35cbf66eafbc0cd5dd292cf13da331d04464907f68a0a3ec7a8acece73ad1a621b66e1471e324f982d5e59d737aa595f1b6b2db78702486d1534c4900e08c8f773f359350e83b6534eea8aaef6e95040064ae93bc1b6f90d3b0590c14d15347c90c4c8a30721b1b4347d020c0a1d45aeaa5ec64563a204bb99d24ee7c6c0d3d06327758671c2d5acefbc32b9cb510daa2347cb5bdd425ce78744fe76b838e70762b7a068d86174eef6d86f16daba0a8687d3d544e864691f85c083faa0c26d36fbbdcad76cac9715f14d1b260d75c5ed182d041d9a339cf4e8bdc82d35749512cb4d69b7c52168c4af99ce71f4fbabc8e0efb5db74b0b05c5a457596575092ece6489a7f75267c72c23e8567c31e5e883c98a6bab19ef52520e566796399d9e6f2c72ae47d45c4365e5a388b9ad059fbe3871f107dd5ea28e51e483cda79abdd1974949046ec7badef8923e3eeaec735407b41637948f79dcfe3fdd5db441d52670dcb5acc93b92e27f92e405fcf821bcbe609cae6551d4a08e5767aecae88808888088880b5c71e6a9f1f0f2aa923798e4afa8828c380dfdf900207cb2b629772fa0f55a3fb476bcb2e91aad1bf6bd6775147746d5cb14603a4e48c780f52506e6b7d1b2828a0a588622858d8da318c068007e8bb67e2be6d1c6fe26710de0e81d12ea5b6ca4f7572bb34b5ae1fc582401e1b2ec47a1b8f97e7c7356ebab658c9397454908931e980cc7e6837dde6e74f65b65557d5bc329a9a274d2389c00d6824ad4fd9dadf5378a3beebab842e8eb352d5f7b0093ef3699bb463d01f2f40b53f10746f132eda9ed3a067e22c9777dd62e6ae8e2a3e46434e0e4ba4c1f12303cd6c683875c47d2746c8e0e285053d1c2d6b626565b9ad6b580000639800001e4837bb5deef9a9e65f2cea5e36ea1d2552f87fa42b1df256000d3d15adcf71764f8b7607e6bd3d35c53e34eabc0b768fa58e09300565ca37d3307a869dfa63cd07d245dd5639a83887a6b4c4464ba5fa82847f0cb3b79be80e568fb9f0db8bdac5fcfa83507b340e279a96d550d8985be03eb8dcacb787bd9ef4ce980ca9aed3925c6e9cd87555d67654efe6d1d00f965070d676938eef54ea4d17a6ee7aa2a79b97bc6b0c708f5e6c1dbe38f8ae17daf8cdada4e5abb8dbf475097679697124fca7c0fdefd42dd74b4b0d1c2228228e1886c1913435a3e41761a07920d3d61ecd5a6a9263597fa8afd5b5d9cba4b9cce7479f30c1fe6b695aecf4165a36d2d051d3d1d3b76114118637e802efb80f25d4aeb8535b69e49eae78e9a166ee92578681f341db70df3e2abb01bec16b7b8f1d6c9dfba9ac54b70d515606d1dae9cb9b9f22f3b0ff35e7cdfd28eb2734c7ec1a3681e776bff007f545bf2d8141b1ef3a86dba7e964a9b95743450c6399ce99e06df0ea56adb976878aeb37b1e8ab0d7ea7a973b91b50d8cc74ed3eae237f0f2ebd57a96ce0169ff006b6d7dfaa2af555c81e6335ca52e68767a860e9f05b268e869edf08869608e9a16f4644c0d6f4f20834d1d17c53d78d9e2d45a8e9b4cdbe51ff95b4b03a6e5f22eff0032b2ad1dc0dd27a2ded9e1b736e17200035d5cdef643ea33b05b100c2941c6c6358de56801a3a01d02e444404444044440444404444044440444404444044440451f88a94107a2a9cf9aba20ab73e2aca3a7820e88251110111101155c9cc82c8a01c952808abcca474412888808888088a09c201385573b6cf4f9ac4b889c45a0e1e5ad953511cb5b5950f11525be98734d5121e81a3cbccac2dba435ef11a37cda8af4fd256b97a5aad4477fc9e4f94f43d7a20ceb51711f4d6956b85cef54b4cf07062ef39e4cf972b77cac77fa4bbcea4798f4b699ac9d8465b5b741ecd06fe201ddc17a3a4b837a534738cb436c6d4551ddd5758f33ca76f372cddadf7718dbc106bd6e8cd537c2d92f9aae4a46e30696ced1137d72e3b9eabdcb2f0ef4fd864ef60b747354fe2aaaa26695c7c4973b273f0593ab37a20a46c0c6800003a0c0c6cafca3c94a20222af36e82ca1c063a29441d4147132a5f50d686ccf68639d9ea067191e38caed0e8a510111101111011110111101114138412a0f45c151590d2c65f3cac8583f1c8e0d1f9ac0f5271d347e9de661ba36e1580f28a4a106591c4fc07a20b718f894de1ae996d544c6d45ceae414f49013f79e7c71e9fa95f32d0e897dbb8ada66efc527d3ce6e73bfbbfb56524979196b5b1e7019cc40f20bd8e2feb6bf6aed71a42ff0049a764a1b452cdddc3517806388c85c48716fd3e8bcded47c02d7daf34f506a6ba5fe86e5596c7869a6a180b238a1791ccf69f12081f441f54de7881a5749d2b4d75eedf450b5b8633bd6e703a00d6ef8f05ab75576b7b0db9cda7b1da2e57ba999dddc27ba3146f933eeb413bbb39f058de9ea4e12f0eec56a6dbe18f586a29606322638baa26964e50073020866eb60f0eb8595b517a8f586b2640ebd7291476c8da0416f61ea001b1763c50601a3f87dc60badeae77bada9b6e9aaabc3b35152e609eaa084f489807ddc602cda9fb32596e12b67d4d7abb6a8a8c0e6f6b9cb18e3d7381e0b73b4798df2a79b1e8831ed3bc3fd39a5636b2d364a1a1e5d83a381bcdfdec656445a0f5195c525432069748e6b183a971000f992b15d41c58d27a5c3c5c2fb48c7b46d1c6fef1e7fb2dca0cbc819e8aa0068c0d96a4771e65bdd4360d2da4af17b7bdd86cf2c7ecf0631d799cb95941c55d50d736aae16cd294cfc6d4b199e768f2c9db283665c2e5496b87bdabaa86923fe39e46b07d4ac02efc7bd2f4333a9a825aabf56104361b642e94b88f0c8dbe6a697815a7e6a86555fe5add4d58d1bbee3339eccf9860380b3ab5586dd63a76c36ea0a7a289bd1b044d60fc820d60dbd71435b063a86d74ba4adf2e089ab1dde5406ff57c0aeddb78194951522af555d6bb54d5e7219552b99034f90603bfcf65b51a3d3753803a041d5b75ba96d74ada6a4a78a9a08f66c70b031a3e002ed728f25288088880888808888088a0f440cef852aa3aab202222022220222202222022220222202222028fc454a8e8104a2a73faaba022282708251539fd54f3203b3e0a9bf8abbbaa840566f455566f441288aae416450de8a5011110151fe5e7e2aea8f19fd5069bd1b18d6dc6fd5578aafde45a7c476ea389cec863882e73b1e077eab7235bee8f35a1b594d75e08f116e3abe8ed12dd3495e9ac3746526f2534cd18ef48f2c75f9ee16ced25c4fd2fada95b3d9afb49581c07eebbd0d9067c0b4e0e50658d1e7bab2a028825cacaad56404444051ca3c94a202222022220228270abcdf341745c65c06e4e079e760bc7b8eafb2daf1ed577a3a7276c3a7683f441ee28c858049c60b4d43cc769a4b8df66c9019454ce23638ea7f55d6a8bf7102f3b5b2c34b6584bb1df5ca70f781e7ca106c7e6f9af06f9aeac3a6dae75caef4949819e57c80bbfba375889e19deefad6bb516b0ae9d9cc4ba9ede041190474cfd57b16ae11e93b3f76596786aa666fdfd6734cf27cc976507873f1ce96bf959a72c776bfc8edbbc869cb2207fac47f25d713f15354bc18a1b5e92a57370eefbfda661ea00f1c63aada90c2ca78db1c4c6c71b461ad68000f800b940c20d5d4fc0fa2b939b36a9bbdcb54543460b6aa62d886f9c0634edd4accec3a22c1a7306d967a3a278fc71c239ffbc4657bdca3c94a0c775b68db7eb9d3f5169b947cd0c9ef31edfbd1bc74737d42d6941ac6fbc26a56d9f57db6a2f5678f31c578a388ca5d1f8091bf55bb394792a3e36c8d2d73439a460823628348d978d9c1fb2cd356d03a8ed95446247c76e7472019f1c37385dcaeed51a221c3685d72bb1fff000a85ee1f985b3a4d2965964748fb3d03e477de7ba95849f89c2ef53dba9a940ee29a187ffe3606fe8834d47c6fd61a82363f4e70d6e53d3b8902a2be46c2df42075465af8d7a9d8054dd6cda5a32ee6229e3efa56b7cb3d16ec2df30ae834d53f679a7ba548aad53a92efa926db314b398e1cf97282b3bd3bc35d33a62360b6d928e07373895d187bfe6e3baca91051ac0d18680d036c00a79479655910111101111011110111101111011110111101141384072825111011110111101111011110111105012a5aaa73e594693e3b20e4445571c209e51e4a54732a677eb8417270aa7743f1518dd0577f056194e552825dd5429728413caa4744232aa01f341744440444404503a2940504654a20e29236c8d2c7b439ae1821c320fa15aef54f67fd0faae4967a8b1c3475926e6b284982518e9bb70b64a20d1eee06eafb1c6c669ae28de29299aecfb3dc226d4b40f204eeaa2cbc6fb307360d4162bcb31906aa98b24ebe43e4b78f28f24e51e4834cd26abe32d3c23da346592bce40e7a7b977791e270775c8389bc4ba5daa7863248efff0016e31b875f55b85c98cb506a3878db7d89ae15dc36d454ee6e43bbb6b6403e18eab97ff981a367289f4aea6a625b977796f76df9adaa1be1e1e4ae07d506b18fb426972de69a3bb529c67135be41fa02b9a3e3fe8d7b9ed15f50d73719e6a3947ea16c67b43b62011e442a3a08dc49746d24f525a1060b0f1c347ccd791737b5cdcfbaea69727001fe1f5547f1c74a372195755263f868e439f1f259e7b3c5cdcddd339ba6794657236368e8d03e4835dbb8db6697229282ed58720011d1b8788f35ca78937599ad75168cbdd4b5dcdff143211b1dbaf9ad84a3947920d7e3506bcb860d3e98a1b7b1c010eaeaee623e218ac2c3ae6e78159a8a8edb11fbedb6d212ef802ffd567ea3947920c021e15453730b9dfaf5747b8e70eac31371e5cad3d17ad6ae1ae97b2ccd9e92cb491cc0e44af673bb3e79764e564fcbbedb05741c3140c859c91b1ac67f0b4003e8b94340f05288231e38dd4a220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220e2f05390075c2354a08327aa73646ea0b798e7032a7eb9411cdb11955765cddb20ab777be7c55834f8841c4d3ccf76fb8db0b9550b0877bbcadf3db7566e47524fc505ce15543bd559bd103e4a01f30ac7a2aa0b0e8a5437a29414566f4554417450de8a50141ca944103a29444044440444404444044440444405572b2202222022220222202222022220222202a3b3e1d71b2ba20e08e473e57b4c6e6b5bb0713d573aa8006c0602b20222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220e3dc6c370a5110139bc14b93f0a09030a555aac80aae527a2aa02b0e8a1aac808aae52de8820752a4f450dfbc54bba20a7e2528a5c82114ee542096ab2220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220222202222022220e36ab0ea8882aefba54a220ba22202a22202b37a222087296f444412888808888088880aae44412de8a511011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111101111011110111107fffd9, '../../../admin/assets/img/firmas/ESTEFANIA MONÁ.jpg', 3, 1, 16),
(7, 'Cristian', 'Cano', '', 'ccano', 'cbc94f28956b5ca33cc45da19aaf0199', '', '../../../admin/assets/img/firmas/CRISTIAN CANO.jpg', 3, 3, 5),
(9, 'Sergio', 'Muñoz', '', 'smunoz', 'd9bae3215f4677ddf2fa9972e0bf1c00', '', '../../../admin/assets/img/firmas/ESTEFANIA MONÁ.jpg', 3, 3, 6),
(19, 'Juan pablo', 'Llano martinez', 'juan.llano@samaracosmetics.com', 'jllano', 'bbb2a4c5de9ec90c8dc409315ec2ce1c', '', '../../../admin/assets/img/firmas/JUAN PABLO LLANO.jpg', 3, 4, 4),
(20, 'SERGIO EDUARDO', 'VELANDIA OBANDO', 'sergio.velandia@teenus.com.co', 'svelandia', 'd9bae3215f4677ddf2fa9972e0bf1c00', '', '', 1, 1, 1),
(24, 'Berney', 'Montoya', 'berney.montoya@samaracosmectics.com', 'bmontoya1', '264e42adc0c8a830a100c3a426e501c3', '', '../../../admin/assets/img/firmas/logo-light-text2.png', 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viscosidad`
--

CREATE TABLE `viscosidad` (
  `id` int(11) NOT NULL,
  `limite_inferior` float NOT NULL,
  `limite_superior` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `viscosidad`
--

INSERT INTO `viscosidad` (`id`, `limite_inferior`, `limite_superior`) VALUES
(1, 1500, 5000),
(2, 1500, 4000),
(3, 1600, 3000),
(4, 1900, 2400),
(5, 2000, 7000),
(6, 2000, 5000),
(7, 2000, 12000),
(8, 2000, 4000),
(9, 2200, 3500),
(10, 2500, 7000),
(11, 2500, 5000),
(12, 2500, 6000),
(13, 2500, 4500),
(14, 3000, 12000),
(15, 3000, 7000),
(16, 3000, 10000),
(17, 3500, 10000),
(18, 3500, 6000),
(19, 3500, 5000),
(20, 3500, 5500),
(21, 4000, 6000),
(22, 4000, 10000),
(23, 4000, 7000),
(24, 4000, 8000),
(25, 4500, 15000),
(26, 5000, 6500),
(27, 5000, 6000),
(28, 6000, 9000),
(29, 6000, 18000),
(30, 6000, 9000),
(31, 7000, 13000),
(32, 7000, 10000),
(33, 10000, 25000),
(34, 15000, 30000),
(35, 20000, 40000),
(36, 40000, 80000),
(37, 70000, 130000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agitador`
--
ALTER TABLE `agitador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `apariencia`
--
ALTER TABLE `apariencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_area_modulo` (`id_modulo`);

--
-- Indices de la tabla `area_desinfeccion`
--
ALTER TABLE `area_desinfeccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id_batch`),
  ADD KEY `fk_batch_producto` (`id_producto`);

--
-- Indices de la tabla `batch_conciliacion_rendimiento`
--
ALTER TABLE `batch_conciliacion_rendimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `batch_condicionesmedio`
--
ALTER TABLE `batch_condicionesmedio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_condicionesmedio_batch` (`id_batch`),
  ADD KEY `fk_condicionesmedio_modulo` (`id_modulo`);

--
-- Indices de la tabla `batch_control_especificaciones`
--
ALTER TABLE `batch_control_especificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `batch_desinfectante_seleccionado`
--
ALTER TABLE `batch_desinfectante_seleccionado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulo` (`modulo`),
  ADD KEY `batch` (`batch`),
  ADD KEY `fk_despeje_firma` (`realizo`);

--
-- Indices de la tabla `batch_eliminado`
--
ALTER TABLE `batch_eliminado`
  ADD PRIMARY KEY (`id_batch`);

--
-- Indices de la tabla `batch_firmas2seccion`
--
ALTER TABLE `batch_firmas2seccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `batch_incidencias`
--
ALTER TABLE `batch_incidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `batch_muestras`
--
ALTER TABLE `batch_muestras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_muestras_batch` (`id_batch`);

--
-- Indices de la tabla `batch_req_ajuste`
--
ALTER TABLE `batch_req_ajuste`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `batch_solucion_pregunta`
--
ALTER TABLE `batch_solucion_pregunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_solucion_preguntas` (`id_pregunta`),
  ADD KEY `fk_solucion_modulo` (`id_modulo`),
  ADD KEY `fk_solucion_batch` (`id_batch`);

--
-- Indices de la tabla `batch_tanques`
--
ALTER TABLE `batch_tanques`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `batch_tanques_chks`
--
ALTER TABLE `batch_tanques_chks`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `condicionesmedio_tiempo`
--
ALTER TABLE `condicionesmedio_tiempo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tiempoCondicones_modulo` (`id_modulo`);

--
-- Indices de la tabla `densidad_gravedad`
--
ALTER TABLE `densidad_gravedad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `limite_inferior` (`limite_inferior`),
  ADD KEY `limite_superior` (`limite_superior`);

--
-- Indices de la tabla `desinfectante`
--
ALTER TABLE `desinfectante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empaque`
--
ALTER TABLE `empaque`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envasadora`
--
ALTER TABLE `envasadora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envase`
--
ALTER TABLE `envase`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escherichia`
--
ALTER TABLE `escherichia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre` (`nombre`);

--
-- Indices de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `firma`
--
ALTER TABLE `firma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_firma_area` (`id_area`),
  ADD KEY `fk_firma_batch` (`id_batch`),
  ADD KEY `fk_firma_primerfirma` (`id_primerfirma`),
  ADD KEY `fk_firma_segundafirma` (`id_segundafirma`);

--
-- Indices de la tabla `formula`
--
ALTER TABLE `formula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_formula_materiaprima` (`id_materiaprima`),
  ADD KEY `fk_formula_producto` (`id_producto`);

--
-- Indices de la tabla `formula_maestra`
--
ALTER TABLE `formula_maestra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grado_alcohol`
--
ALTER TABLE `grado_alcohol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `incidencias_motivo`
--
ALTER TABLE `incidencias_motivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_incidencias_motivo` (`id_incidencias`);

--
-- Indices de la tabla `instructivos_base`
--
ALTER TABLE `instructivos_base`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `instructivo_preparacion`
--
ALTER TABLE `instructivo_preparacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_instructivo_producto` (`id_producto`);

--
-- Indices de la tabla `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `linea_maquinaria`
--
ALTER TABLE `linea_maquinaria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_linea_maquinaria_linea` (`id_linea`),
  ADD KEY `fk_linea_maquinaria_agitador` (`id_agitador`),
  ADD KEY `fk_linea_maquinaria_marmita` (`id_marmita`),
  ADD KEY `fk_linea_maquinaria_envasadora` (`id_envasadora`),
  ADD KEY `fk_linea_maquinaria_loteadora` (`id_loteadora`);

--
-- Indices de la tabla `loteadora`
--
ALTER TABLE `loteadora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_linea_maquina` (`linea`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marmita`
--
ALTER TABLE `marmita`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD PRIMARY KEY (`referencia`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulo` (`modulo`);

--
-- Indices de la tabla `modulo_area_desinfeccion`
--
ALTER TABLE `modulo_area_desinfeccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_area_desinfeccion` (`id_area`),
  ADD KEY `fk_area_desinfeccion_modulo` (`id_modulo`);

--
-- Indices de la tabla `modulo_pregunta`
--
ALTER TABLE `modulo_pregunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pregunta_modulo` (`id_pregunta`),
  ADD KEY `fk_modulo_pregunta` (`id_modulo`);

--
-- Indices de la tabla `multipresentacion`
--
ALTER TABLE `multipresentacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_multipresentacion_batch` (`id_batch`),
  ADD KEY `fk_multipresentacion_referencia` (`referencia`);

--
-- Indices de la tabla `nombre_producto`
--
ALTER TABLE `nombre_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificacion_sanitaria`
--
ALTER TABLE `notificacion_sanitaria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `observaciones`
--
ALTER TABLE `observaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_observaciones_batch` (`id_batch`),
  ADD KEY `fk_observaciones_modulo` (`id_modulo`);

--
-- Indices de la tabla `observaciones_desinfectante`
--
ALTER TABLE `observaciones_desinfectante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_observaciones_desinfectante_desinfectante` (`id_desinfectante`),
  ADD KEY `fk_observaciones_desinfectante_modulo` (`id_modulo`),
  ADD KEY `fk_observaciones_desinfectante_batch` (`id_batch`);

--
-- Indices de la tabla `olor`
--
ALTER TABLE `olor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `otros`
--
ALTER TABLE `otros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ph`
--
ALTER TABLE `ph`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `poder_espumoso`
--
ALTER TABLE `poder_espumoso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre` (`nombre`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presentacion_comercial`
--
ALTER TABLE `presentacion_comercial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`referencia`),
  ADD KEY `fk_producto_apariencia` (`id_apariencia`),
  ADD KEY `fk_producto_color` (`id_color`),
  ADD KEY `fk_producto_densidad_gravedad` (`id_densidad_gravedad`),
  ADD KEY `fk_producto_escherichia` (`id_escherichia`),
  ADD KEY `fk_producto_grado_alcohol` (`id_grado_alcohol`),
  ADD KEY `fk_producto_linea` (`id_linea`),
  ADD KEY `fk_producto_marca` (`id_marca`),
  ADD KEY `fk_producto_nombre_producto` (`id_nombre_producto`),
  ADD KEY `fk_producto_notificacion_sanitaria` (`id_notificacion_sanitaria`),
  ADD KEY `fk_producto_olor` (`id_olor`),
  ADD KEY `fk_producto_ph` (`id_ph`),
  ADD KEY `fk_producto_poder_espumoso` (`id_poder_espumoso`),
  ADD KEY `fk_producto_presentacion_comercial` (`presentacion_comercial`),
  ADD KEY `fk_producto_propietario` (`id_propietario`),
  ADD KEY `fk_producto_pseudomona` (`id_pseudomona`),
  ADD KEY `fk_producto_staphylococcus` (`id_staphylococcus`),
  ADD KEY `fk_producto_untuosidad` (`id_untuosidad`),
  ADD KEY `fk_producto_viscosidad` (`id_viscosidad`),
  ADD KEY `fk_producto_recuento_mesofilo` (`id_recuento_mesofilos`),
  ADD KEY `multi` (`multi`),
  ADD KEY `nombre_referencia` (`nombre_referencia`),
  ADD KEY `fk_producto_tapa` (`id_tapa`),
  ADD KEY `fk_producto_etiqueta` (`id_etiqueta`),
  ADD KEY `fk_producto_envase` (`id_envase`),
  ADD KEY `fk_producto_otros` (`id_otros`),
  ADD KEY `fk_producto_empaque` (`id_empaque`);

--
-- Indices de la tabla `propietario`
--
ALTER TABLE `propietario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pseudomona`
--
ALTER TABLE `pseudomona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recuento_mesofilos`
--
ALTER TABLE `recuento_mesofilos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre` (`nombre`);

--
-- Indices de la tabla `staphylococcus`
--
ALTER TABLE `staphylococcus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre` (`nombre`),
  ADD KEY `nombre_2` (`nombre`);

--
-- Indices de la tabla `tanques`
--
ALTER TABLE `tanques`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tapa`
--
ALTER TABLE `tapa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `untuosidad`
--
ALTER TABLE `untuosidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_modulo` (`id_modulo`),
  ADD KEY `fk_usuario_cargo` (`id_cargo`);

--
-- Indices de la tabla `viscosidad`
--
ALTER TABLE `viscosidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `limite_inferior` (`limite_inferior`),
  ADD KEY `limite_superior` (`limite_superior`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agitador`
--
ALTER TABLE `agitador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `apariencia`
--
ALTER TABLE `apariencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `area_desinfeccion`
--
ALTER TABLE `area_desinfeccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `batch`
--
ALTER TABLE `batch`
  MODIFY `id_batch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `batch_conciliacion_rendimiento`
--
ALTER TABLE `batch_conciliacion_rendimiento`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `batch_condicionesmedio`
--
ALTER TABLE `batch_condicionesmedio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `batch_control_especificaciones`
--
ALTER TABLE `batch_control_especificaciones`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `batch_desinfectante_seleccionado`
--
ALTER TABLE `batch_desinfectante_seleccionado`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `batch_eliminado`
--
ALTER TABLE `batch_eliminado`
  MODIFY `id_batch` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `batch_firmas2seccion`
--
ALTER TABLE `batch_firmas2seccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `batch_incidencias`
--
ALTER TABLE `batch_incidencias`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `batch_muestras`
--
ALTER TABLE `batch_muestras`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT de la tabla `batch_req_ajuste`
--
ALTER TABLE `batch_req_ajuste`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `batch_solucion_pregunta`
--
ALTER TABLE `batch_solucion_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `batch_tanques`
--
ALTER TABLE `batch_tanques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `batch_tanques_chks`
--
ALTER TABLE `batch_tanques_chks`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `condicionesmedio_tiempo`
--
ALTER TABLE `condicionesmedio_tiempo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `densidad_gravedad`
--
ALTER TABLE `densidad_gravedad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `desinfectante`
--
ALTER TABLE `desinfectante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `envasadora`
--
ALTER TABLE `envasadora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `escherichia`
--
ALTER TABLE `escherichia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `firma`
--
ALTER TABLE `firma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formula`
--
ALTER TABLE `formula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT de la tabla `formula_maestra`
--
ALTER TABLE `formula_maestra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `grado_alcohol`
--
ALTER TABLE `grado_alcohol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `incidencias_motivo`
--
ALTER TABLE `incidencias_motivo`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `instructivos_base`
--
ALTER TABLE `instructivos_base`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `instructivo_preparacion`
--
ALTER TABLE `instructivo_preparacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `linea_maquinaria`
--
ALTER TABLE `linea_maquinaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `loteadora`
--
ALTER TABLE `loteadora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `marmita`
--
ALTER TABLE `marmita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `modulo_area_desinfeccion`
--
ALTER TABLE `modulo_area_desinfeccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulo_pregunta`
--
ALTER TABLE `modulo_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `multipresentacion`
--
ALTER TABLE `multipresentacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `nombre_producto`
--
ALTER TABLE `nombre_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `notificacion_sanitaria`
--
ALTER TABLE `notificacion_sanitaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=820;

--
-- AUTO_INCREMENT de la tabla `observaciones`
--
ALTER TABLE `observaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `observaciones_desinfectante`
--
ALTER TABLE `observaciones_desinfectante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `olor`
--
ALTER TABLE `olor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ph`
--
ALTER TABLE `ph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `poder_espumoso`
--
ALTER TABLE `poder_espumoso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `presentacion_comercial`
--
ALTER TABLE `presentacion_comercial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `propietario`
--
ALTER TABLE `propietario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `pseudomona`
--
ALTER TABLE `pseudomona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `recuento_mesofilos`
--
ALTER TABLE `recuento_mesofilos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `staphylococcus`
--
ALTER TABLE `staphylococcus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tanques`
--
ALTER TABLE `tanques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `untuosidad`
--
ALTER TABLE `untuosidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `viscosidad`
--
ALTER TABLE `viscosidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `fk_area_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `fk_batch_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`referencia`);

--
-- Filtros para la tabla `batch_condicionesmedio`
--
ALTER TABLE `batch_condicionesmedio`
  ADD CONSTRAINT `fk_condicionesmedio_batch` FOREIGN KEY (`id_batch`) REFERENCES `batch` (`id_batch`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_condicionesmedio_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `batch_desinfectante_seleccionado`
--
ALTER TABLE `batch_desinfectante_seleccionado`
  ADD CONSTRAINT `fk_despeje_firma` FOREIGN KEY (`realizo`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `condicionesmedio_tiempo`
--
ALTER TABLE `condicionesmedio_tiempo`
  ADD CONSTRAINT `fk_tiempoCondiciones_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id`);

--
-- Filtros para la tabla `firma`
--
ALTER TABLE `firma`
  ADD CONSTRAINT `fk_firma_area` FOREIGN KEY (`id_area`) REFERENCES `area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_firma_batch` FOREIGN KEY (`id_batch`) REFERENCES `batch` (`id_batch`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_firma_primerfirma` FOREIGN KEY (`id_primerfirma`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_firma_segundafirma` FOREIGN KEY (`id_segundafirma`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `incidencias_motivo`
--
ALTER TABLE `incidencias_motivo`
  ADD CONSTRAINT `fk_incidencias_motivo` FOREIGN KEY (`id_incidencias`) REFERENCES `incidencias` (`id`);

--
-- Filtros para la tabla `linea_maquinaria`
--
ALTER TABLE `linea_maquinaria`
  ADD CONSTRAINT `fk_linea_maquinaria_agitador` FOREIGN KEY (`id_agitador`) REFERENCES `agitador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_linea_maquinaria_envasadora` FOREIGN KEY (`id_envasadora`) REFERENCES `envasadora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_linea_maquinaria_linea` FOREIGN KEY (`id_linea`) REFERENCES `linea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_linea_maquinaria_loteadora` FOREIGN KEY (`id_loteadora`) REFERENCES `loteadora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_linea_maquinaria_marmita` FOREIGN KEY (`id_marmita`) REFERENCES `marmita` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD CONSTRAINT `fk_linea_maquina` FOREIGN KEY (`linea`) REFERENCES `linea` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_empaque` FOREIGN KEY (`id_empaque`) REFERENCES `empaque` (`id`),
  ADD CONSTRAINT `fk_producto_envase` FOREIGN KEY (`id_envase`) REFERENCES `envase` (`id`),
  ADD CONSTRAINT `fk_producto_etiqueta` FOREIGN KEY (`id_etiqueta`) REFERENCES `etiqueta` (`id`),
  ADD CONSTRAINT `fk_producto_otros` FOREIGN KEY (`id_otros`) REFERENCES `otros` (`id`),
  ADD CONSTRAINT `fk_producto_tapa` FOREIGN KEY (`id_tapa`) REFERENCES `tapa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
