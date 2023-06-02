-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:4324
-- Tiempo de generación: 02-06-2023 a las 21:25:54
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursosql`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `p_apellido` varchar(20) NOT NULL,
  `s_apellido` varchar(20) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL COMMENT 'Tomamos 60 caracteres por el modo de hasheado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id`, `nombre`, `p_apellido`, `s_apellido`, `email`, `nickname`, `password`) VALUES
(1, 'Patricio', 'Estrella', '', 'patrick@star.es', 'Patrick', '$2y$10$/urACpPaXRzTv7UIoOQ6Du7uoxHvHFLbRE5Y3dieXKZr0eXbqExIe'),
(2, 'Bob', 'Esponja', '', 'BobSponge@gmail.com', 'boby', '$2y$10$SC3TFmG5WdV9lwrr9X3yNuEooZk18coyI8R.5cYA4mQjYuE2EWwh6'),
(4, 'Arenita', 'Mejillas', '', 'arenita@star.es', 'Arenita', '$2y$10$/rWM1atpzXQv2y12/epexeJFgk.ZN/YTDsXEgN7Yc6S2Qy6y6H29i'),
(5, 'Calamardo', 'Tentáculos ', 'Verdes', 'Klmardo@fondode.com', 'KLMARDO', '$2y$10$6E1aJLhpmOXln6A6hVPvvOQH2jRSfaJe7wd//iBKXrlA/w.Y115am');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EMAIL` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
