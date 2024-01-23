-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-12-2023 a las 00:39:03
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `esp32_table_dht11_leds_update`
--
ALTER TABLE `esp32_table_dht11_leds_update`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
