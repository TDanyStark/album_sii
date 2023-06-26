-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2023 a las 22:12:27
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `album_sii`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `nombre_paciente` varchar(255) DEFAULT NULL,
  `tratamiento_correcto` varchar(255) DEFAULT NULL,
  `esta_habilitada` tinyint(1) DEFAULT NULL,
  `orden_paciente` int(11) DEFAULT NULL,
  `orden_tratamiento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `imagen`, `nombre_paciente`, `tratamiento_correcto`, `esta_habilitada`, `orden_paciente`, `orden_tratamiento`) VALUES
(1, 'DIANA', 'DIANA', 'TRA3', 1, 1, 2),
(2, 'GABRIEL', 'GABRIEL', 'TRA2', 1, 2, 3),
(3, 'SANDRA', 'SANDRA', 'TRA1', 1, 3, 1),
(4, 'IVÁN', 'IVÁN', 'TRA3', 1, 4, 5),
(5, 'NATALIA', 'NATALIA', 'TRA1', 1, 5, 4),
(6, 'DAVID', 'DAVID', 'TRA2', 1, 6, 7),
(7, 'CÉSAR', 'CÉSAR', 'TRA1', 1, 7, 9),
(8, 'LORENA', 'LORENA', 'TRA3', 1, 8, 8),
(9, 'SONIA', 'SONIA', 'TRA1', 1, 9, 10),
(10, 'SARA', 'SARA', 'TRA1', 1, 10, 6),
(11, 'SAMUEL', 'SAMUEL', 'TRA1', 0, 11, 12),
(12, 'INGRID', 'INGRID', 'TRA3', 0, 12, 13),
(13, 'IGNACIO', 'IGNACIO', 'TRA2', 0, 13, 14),
(14, 'IVANNA', 'IVANNA', 'TRA1', 0, 14, 11),
(15, 'SANTIAGO', 'SANTIAGO', 'TRA3', 0, 15, 15),
(16, 'VERÓNICA', 'VERÓNICA', 'TRA1', 0, 16, 18),
(17, 'IAN', 'IAN', 'TRA2', 0, 17, 16),
(18, 'ISABEL', 'ISABEL', 'TRA1', 0, 18, 19),
(19, 'ALEJANDRA', 'ALEJANDRA', 'TRA3', 0, 19, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso`
--

CREATE TABLE `progreso` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `order_eleccion` int(11) DEFAULT NULL,
  `completed` tinyint(1) NOT NULL,
  `fecha_interaccion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `progreso`
--

INSERT INTO `progreso` (`id`, `usuario_id`, `paciente_id`, `order_eleccion`, `completed`, `fecha_interaccion`) VALUES
(571, 19, 1, 2, 0, '2023-06-23 15:12:05'),
(572, 19, 2, 3, 0, '2023-06-23 15:12:05'),
(573, 19, 3, 1, 0, '2023-06-23 15:12:05'),
(574, 19, 4, 5, 0, '2023-06-23 15:12:05'),
(575, 19, 5, 4, 0, '2023-06-23 15:12:05'),
(576, 19, 6, 7, 0, '2023-06-23 15:12:05'),
(577, 19, 7, 9, 0, '2023-06-23 15:12:05'),
(578, 19, 8, 8, 0, '2023-06-23 15:12:05'),
(579, 19, 9, 10, 0, '2023-06-23 15:12:05'),
(580, 19, 10, 6, 0, '2023-06-23 15:12:05'),
(581, 19, 11, 12, 0, '2023-06-23 15:12:05'),
(582, 19, 12, 13, 0, '2023-06-23 15:12:05'),
(583, 19, 13, 14, 0, '2023-06-23 15:12:05'),
(584, 19, 14, 11, 0, '2023-06-23 15:12:05'),
(585, 19, 15, 15, 0, '2023-06-23 15:12:05'),
(586, 19, 16, 18, 0, '2023-06-23 15:12:05'),
(587, 19, 17, 16, 0, '2023-06-23 15:12:05'),
(588, 19, 18, 19, 0, '2023-06-23 15:12:05'),
(589, 19, 19, 17, 0, '2023-06-23 15:12:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `cedula` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `terminos` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `cedula`, `email`, `terminos`) VALUES
(19, 'Daniel Amado', '123', 'daniel.amadove@gmail.com', 'true');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `paciente_id` (`paciente_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `progreso`
--
ALTER TABLE `progreso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=590;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD CONSTRAINT `progreso_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `progreso_ibfk_2` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
