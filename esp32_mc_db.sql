-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-12-2023 a las 01:14:36
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
-- Base de datos: `esp32_mc_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `esp32_id` varchar(50) DEFAULT NULL,
  `temperatura` int(11) DEFAULT NULL,
  `humedad` int(11) DEFAULT NULL,
  `status_read_sensor_dht11` varchar(50) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esp32_table_dht11_leds_update`
--

CREATE TABLE `esp32_table_dht11_leds_update` (
  `id` varchar(255) NOT NULL,
  `temperature` float(10,2) NOT NULL,
  `humidity` int(3) NOT NULL,
  `status_read_sensor_dht11` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `anemometro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `esp32_table_dht11_leds_update`
--

INSERT INTO `esp32_table_dht11_leds_update` (`id`, `temperature`, `humidity`, `status_read_sensor_dht11`, `time`, `date`, `anemometro`) VALUES
('esp32_01', 23.00, 11, 'SUCCESS', '17:58:23', '2023-12-04', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esp32_table_dht11_leds_update1`
--

CREATE TABLE `esp32_table_dht11_leds_update1` (
  `id` varchar(255) NOT NULL,
  `temperature` float(10,2) NOT NULL,
  `humidity` int(3) NOT NULL,
  `status_read_sensor_dht11` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `anemometro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `esp32_table_dht11_leds_update1`
--

INSERT INTO `esp32_table_dht11_leds_update1` (`id`, `temperature`, `humidity`, `status_read_sensor_dht11`, `time`, `date`, `anemometro`) VALUES
('esp32_02', 11.00, 0, 'SUCCESS', '17:58:45', '2023-12-04', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esp32_table_dht11_leds_update2`
--

CREATE TABLE `esp32_table_dht11_leds_update2` (
  `id` varchar(255) NOT NULL,
  `temperature` float(10,2) NOT NULL,
  `humidity` int(3) NOT NULL,
  `status_read_sensor_dht11` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `anemometro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `esp32_table_dht11_leds_update2`
--

INSERT INTO `esp32_table_dht11_leds_update2` (`id`, `temperature`, `humidity`, `status_read_sensor_dht11`, `time`, `date`, `anemometro`) VALUES
('esp32_03', 0.00, 10, 'SUCCESS', '17:58:57', '2023-12-04', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esp32_table_esp32_01`
--

CREATE TABLE `esp32_table_esp32_01` (
  `id` int(11) NOT NULL,
  `temperature` float(10,2) NOT NULL,
  `humidity` int(11) NOT NULL,
  `status_read_sensor_dht11` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `anemometro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas`
--

CREATE TABLE `tarjetas` (
  `id` int(11) NOT NULL,
  `esp32_id` varchar(50) DEFAULT NULL,
  `temperatura` int(11) DEFAULT NULL,
  `humedad` int(11) DEFAULT NULL,
  `status_read_sensor_dht11` varchar(50) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tarjetas`
--

INSERT INTO `tarjetas` (`id`, `esp32_id`, `temperatura`, `humedad`, `status_read_sensor_dht11`, `fecha_creacion`) VALUES
(1, 'esp32_01', 25, 50, 'OK', '2023-12-04 23:28:29'),
(2, 'esp32_01', 25, 50, 'OK', '2023-12-04 23:28:39'),
(3, 'esp32_01', 25, 50, 'OK', '2023-12-04 23:30:56'),
(4, 'esp32_01', 25, 50, 'OK', '2023-12-05 00:11:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `esp32_table_dht11_leds_update`
--
ALTER TABLE `esp32_table_dht11_leds_update`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `esp32_table_dht11_leds_update1`
--
ALTER TABLE `esp32_table_dht11_leds_update1`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `esp32_table_dht11_leds_update2`
--
ALTER TABLE `esp32_table_dht11_leds_update2`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `esp32_table_esp32_01`
--
ALTER TABLE `esp32_table_esp32_01`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `esp32_table_esp32_01`
--
ALTER TABLE `esp32_table_esp32_01`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
