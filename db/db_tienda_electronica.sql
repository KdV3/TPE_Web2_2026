-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2026 a las 23:49:09
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
-- Base de datos: `db_tienda_electronica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES
(1, 'Electrodomestico'),
(2, 'Computadora'),
(3, 'Paquetes'),
(9, 'CategoriaEjemplo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` text NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `precio` double NOT NULL,
  `descuento` int(3) NOT NULL,
  `fecha_publicacion` date NOT NULL DEFAULT current_timestamp(),
  `id_vendedor` int(11) NOT NULL,
  `direccion_img` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `id_categoria`, `precio`, `descuento`, `fecha_publicacion`, `id_vendedor`, `direccion_img`) VALUES
(1, 'Heladera 1001 mejorada edit', 'Congela aun mas', 1, 260001, 2, '2026-05-14', 1, NULL),
(3, 'Heladera sin imagen', 'distinto', 1, 120000, 10, '2026-05-14', 2, NULL),
(5, 'Paquete electrodomesticos para cocina', 'heladera, horno, microondas, cafetera etc.', 3, 700000, 5, '2026-05-18', 1, NULL),
(6, 'Heladera Marca Generica 1001 con imagen', 'esta vez se puede ver', 1, 260001, 0, '2026-05-20', 2, 'https://thfvnext.bing.com/th/id/OIP.Uq7VI5OTnEAI4ltPiIqzQgHaHa?w=216&h=216&c=7&r=0&o=7&cb=thfvnextfalcon&pid=1.7&rm=3'),
(7, 'Paquete de componentes para la computadora', 'Incluye mouse, teclado, parlantes, monitor, gabinete etc.', 3, 500000, 15, '2026-05-20', 2, 'https://thfvnext.bing.com/th/id/OIP.YjEWO_-WgSE42oIKfXRqcgHaHR?w=198&h=194&c=7&r=0&o=7&cb=thfvnextfalcon&pid=1.7&rm=3'),
(8, 'Paquete de componentes para la computadora', 'a', 3, 500000, 15, '2026-05-20', 1, 'https://thfvnext.bing.com/th/id/OIP.YjEWO_-WgSE42oIKfXRqcgHaHR?w=198&h=194&c=7&r=0&o=7&cb=thfvnextfalcon&pid=1.7&rm=3'),
(9, 'Producto Ejemplo', 'Texto de ejemplo', 9, 10000, 0, '2026-05-21', 3, 'https://tse4.mm.bing.net/th/id/OIP.T1XbCZG09O71SbnnW2qHogHaEe?r=0&cb=thfvnextfalcon&rs=1&pid=ImgDetMain&o=7&rm=3'),
(11, 'Producto Ejemplo 2 edit', 'Ejemplo edit', 2, 350033, 3, '2026-05-21', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `id_vendedor` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `tel_contacto` varchar(25) NOT NULL,
  `informacion` text NOT NULL,
  `img_logo` varchar(100) DEFAULT NULL,
  `contrasenia` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`id_vendedor`, `nombre`, `email`, `direccion`, `tel_contacto`, `informacion`, `img_logo`, `contrasenia`) VALUES
(1, 'admin', 'admin@gmail.com', 'Direccion Ejemplo - 123451', '540002222', 'Info', NULL, '$2y$10$P9ttgRU.qNBu/O3QI93qJO8MhfgMpfeKegXjod4r.EL3.391VLUze'),
(2, 'admin2', 'admin2@gmail.com', 'Direccion Ejemplo - 123', '540002222', 'Info', NULL, '$2y$10$2x9ZzQS3pw7SOUilWfL/nOg5FnPPuEbUsDEOmvb9hs997I/5wV1Ey'),
(3, 'webadmin', 'webadmin@gmail.com', 'Ejemplo 123 ', '+5411111111', 'Información breve sobre nuestro negocio y nuestros productos.', NULL, '$2y$10$5CrjVGIKqDADT2MbNnF35OdkN3oG4cnZzSJcAyaOH1SxSAsq1yjJi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `vendedor` (`id_vendedor`),
  ADD KEY `categoria` (`id_categoria`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`id_vendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id_vendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`id_vendedor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
