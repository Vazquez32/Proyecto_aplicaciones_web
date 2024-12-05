-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2024 a las 01:53:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hambre_cero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `id` int(11) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `lavar_alimentos` varchar(50) DEFAULT NULL,
  `origen_alimentos` varchar(50) DEFAULT NULL,
  `consumo_fuera` varchar(50) DEFAULT NULL,
  `acceso_canasta` varchar(50) DEFAULT NULL,
  `donar_alimentos` varchar(50) DEFAULT NULL,
  `facil_acceso` varchar(50) DEFAULT NULL,
  `alimentacion_balanceada` varchar(50) DEFAULT NULL,
  `tipo_alimentos` text DEFAULT NULL,
  `orientacion_alimentaria` varchar(50) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `encuestas`
--

INSERT INTO `encuestas` (`id`, `region`, `lavar_alimentos`, `origen_alimentos`, `consumo_fuera`, `acceso_canasta`, `donar_alimentos`, `facil_acceso`, `alimentacion_balanceada`, `tipo_alimentos`, `orientacion_alimentaria`, `fecha_registro`) VALUES
(1, 'Mixteca', 'siempre', 'tienda_local', 'diariamente', 'no_accesibles', 'si', 'bancos', 'muy_balanceada', 'comida_chatarra, comida_rapida', 'Sí', '2024-11-28 19:00:54'),
(2, 'Mixteca', 'siempre', 'supermercado', 'diariamente', 'poco_accesibles', 'quisiera', 'bancos', 'muy_balanceada', 'frutas_verduras, alimentos_origen_animal', 'Sí', '2024-11-28 19:21:49'),
(3, 'Sierra Nororiental', 'siempre', 'mercado', 'semanalmente', 'muy_accesibles', 'no_interes', 'bancos', 'muy_balanceada', 'alimentos_origen_animal, embutidos, comida_chatarra', 'Sí', '2024-11-28 19:44:43'),
(4, 'Valle de Atlixco y Matamoros', 'siempre', 'tienda_local', 'diariamente', 'poco_accesibles', 'quisiera', 'comedor', 'poco_balanceada', 'frutas_verduras, alimentos_origen_animal, cereales', 'Sí', '2024-11-28 20:01:04'),
(5, 'Valle de Atlixco y Matamoros', 'siempre', 'mercado', 'diariamente', 'muy_accesibles', 'quisiera', 'comedor', 'poco_balanceada', 'alimentos_origen_animal, cereales', 'Sí', '2024-11-28 20:06:35'),
(6, 'Valle de Atlixco y Matamoros', 'siempre', 'supermercado', 'semanalmente', 'muy_accesibles', 'quisiera', 'comedor', 'muy_balanceada', 'frutas_verduras, alimentos_origen_animal, embutidos', 'Sí', '2024-11-28 20:26:04'),
(7, 'Mixteca', 'siempre', 'tienda_local', 'semanalmente', 'poco_accesibles', 'si', 'comedor', 'poco_balanceada', 'alimentos_origen_animal', 'Sí', '2024-11-28 20:38:59'),
(8, 'Angelópolis', 'nunca', 'tienda_local', 'semanalmente', 'muy_accesibles', 'quisiera', 'promover', 'muy_balanceada', 'frutas_verduras, alimentos_origen_animal, embutidos', 'Sí', '2024-11-28 20:51:36'),
(9, 'Sierra Norte', 'a_veces', 'supermercado', 'ocasionalmente', 'muy_accesibles', 'no_interes', 'apoyos', 'poco_balanceada', 'comida_chatarra', 'No', '2024-11-29 00:03:18'),
(10, 'Valle de Atlixco y Matamoros', 'a_veces', 'mercado', 'diariamente', 'muy_accesibles', 'si', 'comedor', 'no_balanceada', 'cereales, comida_chatarra, comida_rapida', 'Poco', '2024-11-29 00:24:29'),
(11, 'Valle de Atlixco y Matamoros', 'siempre', 'mercado', 'nunca', 'muy_accesibles', 'si', 'bancos', 'muy_balanceada', 'frutas_verduras, alimentos_origen_animal, embutidos, comida_rapida', 'Sí', '2024-11-29 00:34:57'),
(12, 'Sierra Norte', 'a_veces', 'supermercado', 'semanalmente', 'no_accesibles', 'si', 'apoyos', 'muy_balanceada', 'embutidos, comida_chatarra', 'Sí', '2024-11-29 00:35:21'),
(13, 'Sierra Norte', 'a_veces', 'supermercado', 'semanalmente', 'muy_accesibles', 'quisiera', 'bancos', 'muy_balanceada', 'frutas_verduras, alimentos_origen_animal, embutidos', 'Poco', '2024-11-29 00:35:49'),
(14, 'Mixteca', 'siempre', 'supermercado', 'diariamente', 'muy_accesibles', 'si', 'apoyos', 'muy_balanceada', 'embutidos, cereales', 'No', '2024-11-29 00:36:10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
