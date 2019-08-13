-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2018 a las 07:48:34
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_deporte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `codigo_alumno` int(11) NOT NULL,
  `documento` char(8) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `paterno` varchar(45) NOT NULL,
  `materno` varchar(45) NOT NULL,
  `sexo` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `foto` varchar(60) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`codigo_alumno`, `documento`, `nombres`, `paterno`, `materno`, `sexo`, `fecha_nacimiento`, `foto`, `estado`) VALUES
(10, '23423423', 'CHRISTIAN ', 'DIAZ', 'FLORES', 1, '2010-09-20', 'imgAlum1.jpg', 1),
(11, '23423423', 'ALMNO DOS', 'EJEMPLO', 'EJEMPLO', 1, '2010-02-11', 'defecto.jpg', 1),
(12, '53453453', 'ALUMNOTRES', 'EJEMPLO', 'EJEMPLO', 1, '2006-03-11', 'defecto.jpg', 1),
(13, '90980898', 'ALUMNO CUATRO', 'EJEMPL', 'EJEMPLO', 1, '2009-02-12', 'defecto.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `codigo_categoria` int(11) NOT NULL,
  `nombre` varchar(65) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`codigo_categoria`, `nombre`, `estado`) VALUES
(2, 'SUB-4', 1),
(3, 'SUB-5', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `codigo_docente` int(11) NOT NULL,
  `documento` char(8) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `paterno` varchar(45) NOT NULL,
  `materno` varchar(45) NOT NULL,
  `sexo` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `foto` varchar(60) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`codigo_docente`, `documento`, `nombres`, `paterno`, `materno`, `sexo`, `fecha_nacimiento`, `direccion`, `telefono`, `foto`, `estado`) VALUES
(2, '24324234', 'MANUEL', 'CIEZA', 'ROJAS', 1, '1961-03-12', 'CALLE ROMA 670', '495030', 'defecto.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `codigo_grupo` int(11) NOT NULL,
  `anio` char(4) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codigo_categoria` int(11) NOT NULL,
  `codigo_docente` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`codigo_grupo`, `anio`, `descripcion`, `fecha_registro`, `codigo_categoria`, `codigo_docente`, `estado`) VALUES
(2, '2018', 'VERANO JUNEVIL', '2018-03-10 15:50:07', 2, 2, 1),
(3, '2018', 'CAMPEONATO', '2018-03-13 22:30:17', 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `codigo_horario` int(11) NOT NULL,
  `dia` int(11) NOT NULL COMMENT '[LUN=>1,MAR=>2,MIE=>3,JUE=>4,VIE=>5,SAB=>6,DOM=>7]',
  `horario_inicio` time NOT NULL,
  `horario_fin` time NOT NULL,
  `codigo_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`codigo_horario`, `dia`, `horario_inicio`, `horario_fin`, `codigo_grupo`) VALUES
(7, 2, '01:00:00', '01:01:00', 2),
(8, 2, '16:30:00', '14:00:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `codigo_inscripcion` int(11) NOT NULL,
  `codigo_alumno` int(11) NOT NULL,
  `codigo_grupo` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`codigo_inscripcion`, `codigo_alumno`, `codigo_grupo`, `fecha_registro`, `estado`) VALUES
(9, 12, 2, '2018-03-10 21:18:07', 1),
(10, 11, 2, '2018-03-10 21:25:31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `codigo_registro` int(11) NOT NULL,
  `codigo_alumno` int(11) NOT NULL,
  `tricipital` decimal(6,2) DEFAULT NULL,
  `subescapular` decimal(6,2) DEFAULT NULL,
  `supraespinal` decimal(6,2) DEFAULT NULL,
  `abdominal` decimal(6,2) DEFAULT NULL,
  `muslo_anterior` decimal(6,2) DEFAULT NULL,
  `pierna_medial` decimal(6,2) DEFAULT NULL,
  `muneica` decimal(6,2) DEFAULT NULL,
  `femur` decimal(6,2) DEFAULT NULL,
  `humero` decimal(6,2) DEFAULT NULL,
  `bileocrestal` decimal(6,2) DEFAULT NULL,
  `biacromial` decimal(6,2) DEFAULT NULL,
  `mesoesternal` decimal(6,2) DEFAULT NULL,
  `brazo` decimal(6,2) DEFAULT NULL,
  `pierna` decimal(6,2) DEFAULT NULL,
  `talla` decimal(6,2) DEFAULT NULL,
  `talla_sentado` decimal(6,2) DEFAULT NULL,
  `peso` decimal(6,2) DEFAULT NULL,
  `por_adiposo` decimal(6,2) DEFAULT NULL,
  `por_muscular` decimal(6,2) DEFAULT NULL,
  `por_oseo` decimal(6,2) DEFAULT NULL,
  `por_residual` decimal(6,2) DEFAULT NULL,
  `peso_adiposo` decimal(6,2) DEFAULT NULL,
  `peso_muscular` decimal(6,2) DEFAULT NULL,
  `peso_oseo` decimal(6,2) DEFAULT NULL,
  `peso_residual` decimal(6,2) DEFAULT NULL,
  `endomorfia` decimal(6,2) DEFAULT NULL,
  `mesomorfia` decimal(6,2) DEFAULT NULL,
  `ectomorfia` decimal(6,2) DEFAULT NULL,
  `valor_x` decimal(6,2) DEFAULT NULL,
  `valor_y` decimal(6,2) DEFAULT NULL,
  `imc` decimal(6,2) DEFAULT NULL,
  `iem` decimal(6,2) DEFAULT NULL,
  `iai` decimal(6,2) DEFAULT NULL,
  `ictr` decimal(6,2) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL DEFAULT '1',
  `antropometricos` int(11) NOT NULL DEFAULT '0',
  `pliegues` int(11) NOT NULL DEFAULT '0',
  `diametros` int(11) NOT NULL DEFAULT '0',
  `perimetros` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`codigo_registro`, `codigo_alumno`, `tricipital`, `subescapular`, `supraespinal`, `abdominal`, `muslo_anterior`, `pierna_medial`, `muneica`, `femur`, `humero`, `bileocrestal`, `biacromial`, `mesoesternal`, `brazo`, `pierna`, `talla`, `talla_sentado`, `peso`, `por_adiposo`, `por_muscular`, `por_oseo`, `por_residual`, `peso_adiposo`, `peso_muscular`, `peso_oseo`, `peso_residual`, `endomorfia`, `mesomorfia`, `ectomorfia`, `valor_x`, `valor_y`, `imc`, `iem`, `iai`, `ictr`, `fecha_registro`, `estado`, `antropometricos`, `pliegues`, `diametros`, `perimetros`) VALUES
(10, 11, '12.20', '15.60', '23.00', '26.50', '21.60', '15.90', '6.05', '9.87', '7.15', '21.00', '38.00', '92.50', '32.50', '36.80', '163.00', '85.00', '50.00', '14.78', '46.00', '27.30', '12.05', '7.39', '22.93', '13.65', '6.03', '5.31', '6.77', '3.81', '-1.50', '4.42', '18.82', '91.76', '55.26', '56.75', '2018-03-19 14:52:32', 0, 1, 1, 1, 1),
(19, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9999.99', '9999.99', '9999.99', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-19 17:52:59', 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas_proyeccion_talla`
--

CREATE TABLE `medidas_proyeccion_talla` (
  `codigo_registro` int(11) NOT NULL,
  `talla` decimal(6,2) NOT NULL,
  `proyeccion_talla` decimal(6,2) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codigo_alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medidas_proyeccion_talla`
--

INSERT INTO `medidas_proyeccion_talla` (`codigo_registro`, `talla`, `proyeccion_talla`, `fecha_registro`, `codigo_alumno`) VALUES
(3, '122.00', '1.69', '2018-03-09 05:32:52', 11),
(4, '142.00', '1.69', '2018-03-11 16:20:52', 12),
(6, '22.00', '0.30', '2018-03-19 23:29:57', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_proyeccion_talla`
--

CREATE TABLE `tabla_proyeccion_talla` (
  `edad` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `percentil_H` decimal(6,2) DEFAULT NULL,
  `percentil_M` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tabla_proyeccion_talla`
--

INSERT INTO `tabla_proyeccion_talla` (`edad`, `item`, `percentil_H`, `percentil_M`) VALUES
(1, 0, '42.20', '44.70'),
(1, 1, '42.93', '45.51'),
(1, 2, '43.66', '46.32'),
(1, 3, '44.39', '47.13'),
(1, 4, '45.12', '47.94'),
(1, 5, '45.85', '48.75'),
(1, 6, '46.58', '49.56'),
(1, 7, '47.31', '50.37'),
(1, 8, '48.04', '51.18'),
(1, 9, '48.77', '51.99'),
(2, 0, '49.50', '52.80'),
(2, 1, '49.93', '53.22'),
(2, 2, '50.36', '53.64'),
(2, 3, '50.79', '54.06'),
(2, 4, '51.22', '54.48'),
(2, 5, '51.65', '54.90'),
(2, 6, '52.08', '55.32'),
(2, 7, '52.51', '55.74'),
(2, 8, '52.94', '56.16'),
(2, 9, '53.37', '56.58'),
(3, 0, '53.80', '57.00'),
(3, 1, '54.22', '57.48'),
(3, 2, '54.64', '57.96'),
(3, 3, '55.06', '58.44'),
(3, 4, '55.48', '58.92'),
(3, 5, '55.90', '59.40'),
(3, 6, '56.32', '59.88'),
(3, 7, '56.74', '60.36'),
(3, 8, '57.16', '60.84'),
(3, 9, '57.58', '61.32'),
(4, 0, '58.00', '61.80'),
(4, 1, '58.38', '62.24'),
(4, 2, '58.76', '62.68'),
(4, 3, '59.14', '63.12'),
(4, 4, '59.52', '63.56'),
(4, 5, '59.90', '64.00'),
(4, 6, '60.28', '64.44'),
(4, 7, '60.66', '64.88'),
(4, 8, '61.04', '65.32'),
(4, 9, '61.42', '65.76'),
(5, 0, '61.80', '66.20'),
(5, 1, '62.14', '66.61'),
(5, 2, '62.48', '67.02'),
(5, 3, '62.82', '67.43'),
(5, 4, '63.16', '67.84'),
(5, 5, '63.50', '68.25'),
(5, 6, '63.84', '68.66'),
(5, 7, '64.18', '69.07'),
(5, 8, '64.52', '69.48'),
(5, 9, '64.86', '69.89'),
(6, 0, '65.20', '70.30'),
(6, 1, '65.58', '70.67'),
(6, 2, '65.96', '71.04'),
(6, 3, '66.34', '71.41'),
(6, 4, '66.72', '71.78'),
(6, 5, '67.10', '72.15'),
(6, 6, '67.48', '72.52'),
(6, 7, '67.86', '72.89'),
(6, 8, '68.24', '73.36'),
(6, 9, '68.62', '73.63'),
(7, 0, '69.00', '74.00'),
(7, 1, '69.30', '74.35'),
(7, 2, '69.60', '74.70'),
(7, 3, '69.90', '75.05'),
(7, 4, '70.20', '75.40'),
(7, 5, '70.50', '75.75'),
(7, 6, '70.80', '76.10'),
(7, 7, '71.10', '76.45'),
(7, 8, '71.40', '76.80'),
(7, 9, '71.70', '77.15'),
(8, 0, '72.00', '77.50'),
(8, 1, '72.30', '77.82'),
(8, 2, '77.60', '78.14'),
(8, 3, '72.90', '78.46'),
(8, 4, '73.20', '78.78'),
(8, 5, '73.50', '79.10'),
(8, 6, '73.80', '79.42'),
(8, 7, '74.10', '79.74'),
(8, 8, '74.40', '80.06'),
(8, 9, '74.70', '80.38'),
(9, 0, '75.00', '80.70'),
(9, 1, '75.30', '81.07'),
(9, 2, '75.60', '81.44'),
(9, 3, '75.90', '81.81'),
(9, 4, '76.20', '82.18'),
(9, 6, '76.80', '82.92'),
(9, 7, '77.10', '83.29'),
(9, 8, '77.40', '83.66'),
(9, 9, '77.70', '84.03'),
(10, 0, '78.00', '84.40'),
(10, 1, '78.31', '84.80'),
(10, 2, '78.62', '85.20'),
(10, 3, '78.93', '85.60'),
(10, 4, '79.24', '86.00'),
(10, 5, '79.55', '86.40'),
(10, 6, '79.86', '86.80'),
(10, 7, '80.17', '87.20'),
(10, 8, '80.48', '87.60'),
(10, 9, '80.79', '88.00'),
(11, 0, '81.10', '88.40'),
(11, 1, '81.41', '88.85'),
(11, 2, '81.72', '89.30'),
(11, 3, '82.03', '89.75'),
(11, 4, '82.34', '90.20'),
(11, 5, '82.65', '90.65'),
(11, 6, '82.96', '91.10'),
(11, 7, '83.27', '91.55'),
(11, 8, '83.58', '92.00'),
(11, 9, '83.89', '92.45'),
(12, 0, '84.20', '92.90'),
(12, 1, '84.51', '93.26'),
(12, 2, '84.42', '93.62'),
(12, 3, '85.13', '93.98'),
(12, 4, '85.44', '94.34'),
(12, 5, '85.75', '94.70'),
(12, 6, '86.06', '95.06'),
(12, 7, '86.37', '95.42'),
(12, 8, '86.68', '95.78'),
(12, 9, '86.89', '96.14'),
(13, 0, '87.30', '96.50'),
(13, 1, '87.72', '96.68'),
(13, 2, '88.14', '96.86'),
(13, 3, '88.56', '97.04'),
(13, 4, '88.98', '97.22'),
(13, 5, '89.40', '97.40'),
(13, 6, '89.82', '97.58'),
(13, 7, '90.24', '97.76'),
(13, 8, '90.66', '97.94'),
(13, 9, '91.08', '98.12'),
(14, 0, '91.50', '98.30'),
(14, 1, '91.96', '98.38'),
(14, 2, '92.42', '98.46'),
(14, 3, '92.88', '98.54'),
(14, 4, '93.34', '98.62'),
(14, 5, '93.80', '98.70'),
(14, 6, '94.26', '98.78'),
(14, 7, '94.72', '98.86'),
(14, 8, '95.18', '98.94'),
(14, 9, '95.64', '99.02'),
(15, 0, '96.10', '99.10'),
(15, 1, '96.32', '99.15'),
(15, 2, '96.54', '99.20'),
(15, 3, '96.76', '99.25'),
(15, 4, '96.98', '99.30'),
(15, 5, '97.20', '99.35'),
(15, 6, '97.42', '99.40'),
(15, 7, '97.64', '99.45'),
(15, 8, '97.86', '99.50'),
(15, 9, '98.08', '99.95'),
(16, 0, '98.30', '99.60'),
(16, 1, '98.40', '99.64'),
(16, 2, '98.50', '99.68'),
(16, 3, '98.60', '99.72'),
(16, 4, '98.70', '99.76'),
(16, 5, '98.80', '99.80'),
(16, 6, '98.90', '99.84'),
(16, 7, '99.00', '99.88'),
(16, 8, '99.10', '99.92'),
(16, 9, '99.20', '99.96'),
(17, 0, '99.30', '99.97'),
(17, 1, '99.35', '99.97'),
(17, 2, '99.40', '99.97'),
(17, 3, '99.45', '99.98'),
(17, 4, '99.50', '99.98'),
(17, 5, '99.55', '99.98'),
(17, 6, '99.60', '99.99'),
(17, 7, '99.65', '99.99'),
(17, 8, '99.70', '99.99'),
(17, 9, '99.75', '100.00'),
(18, 0, '99.80', NULL),
(18, 1, '99.82', NULL),
(18, 2, '99.84', NULL),
(18, 3, '99.86', NULL),
(18, 4, '99.88', NULL),
(18, 5, '99.90', NULL),
(18, 6, '99.92', NULL),
(18, 7, '99.94', NULL),
(18, 8, '99.96', NULL),
(18, 9, '99.98', NULL),
(19, 0, '100.00', NULL),
(19, 1, NULL, NULL),
(19, 2, NULL, NULL),
(19, 3, NULL, NULL),
(19, 4, NULL, NULL),
(19, 5, NULL, NULL),
(19, 6, NULL, NULL),
(19, 7, NULL, NULL),
(19, 8, NULL, NULL),
(19, 9, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`codigo_alumno`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codigo_categoria`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`codigo_docente`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`codigo_grupo`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`codigo_horario`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`codigo_inscripcion`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`codigo_registro`);

--
-- Indices de la tabla `medidas_proyeccion_talla`
--
ALTER TABLE `medidas_proyeccion_talla`
  ADD PRIMARY KEY (`codigo_registro`);

--
-- Indices de la tabla `tabla_proyeccion_talla`
--
ALTER TABLE `tabla_proyeccion_talla`
  ADD PRIMARY KEY (`edad`,`item`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `codigo_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `codigo_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `codigo_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `codigo_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `codigo_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `codigo_inscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `codigo_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `medidas_proyeccion_talla`
--
ALTER TABLE `medidas_proyeccion_talla`
  MODIFY `codigo_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
