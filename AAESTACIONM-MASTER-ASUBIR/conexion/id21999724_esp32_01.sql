-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-04-2024 a las 05:07:53
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id21999724_esp32_01`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esp32_01_tableupdate`
--

CREATE TABLE `esp32_01_tableupdate` (
  `id` varchar(255) NOT NULL,
  `temperature` float(10,2) NOT NULL,
  `humidity` int(3) NOT NULL,
  `status_read_sensor_dht11` varchar(255) NOT NULL,
  `veleta` varchar(255) NOT NULL,
  `anemometro` int(3) NOT NULL,
  `pluviometro` int(3) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `esp32_01_tableupdate`
--

INSERT INTO `esp32_01_tableupdate` (`id`, `temperature`, `humidity`, `status_read_sensor_dht11`, `veleta`, `anemometro`, `pluviometro`, `time`, `date`) VALUES
('esp32_01', 0.00, 0, 'FAILED', '0', 0, 0, '00:07:50', '2024-04-03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `esp32_01_tableupdate`
--
ALTER TABLE `esp32_01_tableupdate`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
