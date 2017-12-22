-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 31-05-2017 a las 08:08:21
-- Versión del servidor: 10.1.23-MariaDB
-- Versión de PHP: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `musica`
--
CREATE DATABASE IF NOT EXISTS musica;
USE musica;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilos`
--

CREATE TABLE `estilos` (
  `id_estilo` int(11) NOT NULL,
  `nombre` varchar(24) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estilos`
--

INSERT INTO `estilos` (`id_estilo`, `nombre`) VALUES
(7, 'hip-hop'),
(8, 'pop'),
(9, 'rock'),
(10, 'electronica'),
(11, 'flamenco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilo_usuario`
--

CREATE TABLE `estilo_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_estilo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estilo_usuario`
--

INSERT INTO `estilo_usuario` (`id_usuario`, `id_estilo`) VALUES
(23, 7),
(24, 7),
(24, 8),
(25, 11),
(26, 10),
(27, 9),
(27, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `id_estilo` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `edad_min` int(11) NOT NULL,
  `edad_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `id_estilo`, `nombre`, `edad_min`, `edad_max`) VALUES
(24, 7, 'rap y hip-hop', 10, 30),
(25, 8, 'poperos', 17, 40),
(26, 11, 'Flamenquines', 10, 18),
(27, 11, 'The old school flamenco', 30, 50),
(29, 10, 'Destrozando neuronas', 18, 30),
(30, 9, 'Viejas leyendas del Rock', 18, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_usuario`
--

CREATE TABLE `grupo_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grupo_usuario`
--

INSERT INTO `grupo_usuario` (`id_usuario`, `id_grupo`) VALUES
(23, 24),
(24, 24),
(24, 25),
(25, 27),
(26, 29),
(27, 29),
(27, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `idUsuOrigen` int(11) NOT NULL,
  `idUsuDestino` int(11) DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `titulo` varchar(42) COLLATE utf8_spanish_ci NOT NULL,
  `texto` text COLLATE utf8_spanish_ci NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `idUsuOrigen`, `idUsuDestino`, `id_grupo`, `titulo`, `texto`, `leido`) VALUES
(36, 22, NULL, NULL, 'Bienvenidos', 'Bienvenidos a Melomania, aqui encontrareis un lugar en el compartir nuestra aficion por la musica', 1),
(37, 23, NULL, NULL, 'Hola', 'Hola a todos, soy nuevo aqui.', 1),
(38, 23, NULL, 24, 'Nueva cancion de Ambkor', 'habeis escuchado el nuevo tema de Ambkor con Magic Magno?', 1),
(39, 24, NULL, 25, 'Rihana', 'Estoy deseando que Rihana saque un nuevo disco', 1),
(40, 24, 23, NULL, 'Hola', 'Hola, he visto que tu tambien estas en el grupo de rap', 1),
(41, 24, NULL, 24, 'Nueva cancion de Natos y Waor', 'Natos y Waor van a sacar nuevo tema el proximo mes de junio', 1),
(42, 25, NULL, 27, 'Nuevo concierto del cigala', 'El proximo dia 28 de Junio, El cigala da un concierto en Madrid', 1),
(43, 26, NULL, 29, 'Festival Decode', 'Alguien por aquí va al festival Decode?', 1),
(44, 27, NULL, 29, 'Festival Decode', 'Si, Daniel Garcia, yo voy tambien al Decode, espero verte por alli', 1),
(45, 27, NULL, 30, 'Retirada de Baron Rojo', 'Parece que este año se retira Baron Rojo de los escenarios', 1),
(46, 27, 26, NULL, 'Hola', 'Has leido mi mensaje, en el grupo de destrozando neuronas?', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(42) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(42) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(42) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(42) COLLATE utf8_spanish_ci NOT NULL,
  `type` enum('user','admin') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'user',
  `fech_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `contrasena`, `type`, `fech_nacimiento`) VALUES
(22, 'admin', 'admin', 'admin@melomania.com', '1234', 'admin', '1992-04-13'),
(23, 'Carlos', 'Gomez', 'cga.xtr@gmail.com', 'cap232', 'user', '1992-04-13'),
(24, 'Marta', 'Rodriguez', 'marta@gmail.com', '1234', 'user', '2000-05-10'),
(25, 'Jesus', 'Gonzalez', 'juango@gmail.com', '1234', 'user', '1983-08-24'),
(26, 'Daniel', 'Garcia', 'dgarci13@gmail.com', '1234', 'user', '1996-04-12'),
(27, 'Loreto', 'Garcia', 'loga@gmail.com', '1234', 'user', '1996-09-12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`id_estilo`);

--
-- Indices de la tabla `estilo_usuario`
--
ALTER TABLE `estilo_usuario`
  ADD PRIMARY KEY (`id_usuario`,`id_estilo`) USING BTREE,
  ADD KEY `id_estilo` (`id_estilo`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`,`id_estilo`) USING BTREE,
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_estilo` (`id_estilo`);

--
-- Indices de la tabla `grupo_usuario`
--
ALTER TABLE `grupo_usuario`
  ADD PRIMARY KEY (`id_usuario`,`id_grupo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuOrigen` (`idUsuOrigen`),
  ADD KEY `idUsuDestino` (`idUsuDestino`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estilos`
--
ALTER TABLE `estilos`
  MODIFY `id_estilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estilo_usuario`
--
ALTER TABLE `estilo_usuario`
  ADD CONSTRAINT `estilo_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estilo_usuario_ibfk_2` FOREIGN KEY (`id_estilo`) REFERENCES `estilos` (`id_estilo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`id_estilo`) REFERENCES `estilos` (`id_estilo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo_usuario`
--
ALTER TABLE `grupo_usuario`
  ADD CONSTRAINT `grupo_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `grupo_usuario_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`idUsuOrigen`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`idUsuDestino`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `mensajes_ibfk_3` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
