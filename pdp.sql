-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2017 a las 15:57:20
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pdp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created`, `modified`) VALUES
(5, 'Inglés B1', 'Inglés B1', '2017-12-03 16:55:08', '2017-12-03 16:55:08'),
(6, 'Inglés C1', 'Inglés C1', '2017-12-03 16:55:19', '2017-12-03 16:55:19'),
(9, 'Otra Categoría', 'asdfasd', '2017-12-08 11:20:14', '2017-12-08 11:20:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriescompetences`
--

CREATE TABLE IF NOT EXISTS `categoriescompetences` (
  `id` int(10) NOT NULL,
  `competence_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoriescompetences`
--

INSERT INTO `categoriescompetences` (`id`, `competence_id`, `category_id`) VALUES
(1, 6, 6),
(2, 6, 5),
(20, 36, 5),
(22, 36, 6),
(23, 7, 5),
(24, 7, 6),
(25, 37, 5),
(26, 38, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competences`
--

CREATE TABLE IF NOT EXISTS `competences` (
  `id` int(10) unsigned NOT NULL,
  `subject_id` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `competences`
--

INSERT INTO `competences` (`id`, `subject_id`, `name`, `description`, `created`, `modified`) VALUES
(6, 13, 'Part 1: Transformación de oraciones', 'Saber transformar oraciones', '2017-12-03 16:57:11', '2017-12-03 16:57:11'),
(7, 13, 'Parte 2: Mensaje corto (35 – 45 palabras)', 'Saber redactar correctamente mensajes cortos', '2017-12-03 16:57:42', '2017-12-08 11:26:49'),
(36, 13, 'Parte 3: Saber hablar como una persona', 'Hablar vamos', '2017-12-07 19:32:16', '2017-12-08 11:23:55'),
(37, 15, 'Parte 1: Escuchar como una persona', 'Escuchar', '2017-12-08 13:11:42', '2017-12-08 13:11:42'),
(38, 16, 'Parte 1: Reading y esas cosas', 'asdfsad', '2017-12-09 16:10:36', '2017-12-09 16:11:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(10) unsigned NOT NULL,
  `competence_id` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contents`
--

INSERT INTO `contents` (`id`, `competence_id`, `name`, `description`, `created`, `modified`) VALUES
(1, 6, 'Contenido 1', 'DEscripción 1', NULL, NULL),
(2, 36, 'Contenido 2', 'DEscripción 2', NULL, NULL),
(4, 36, 'Contenido 3', 'patata', NULL, '2017-12-10 12:34:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) unsigned NOT NULL,
  `content_id` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `store` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `description`, `created`, `modified`) VALUES
(13, 'Writting B1', 'Writting B1', '2017-12-03 16:55:40', '2017-12-03 16:55:40'),
(15, 'Listening', 'Escuchar', '2017-12-08 13:11:20', '2017-12-08 13:11:20'),
(16, 'Reading B1', 'sadfds', '2017-12-09 16:10:12', '2017-12-09 16:10:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `dni` int(10) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `dni`, `username`, `email`, `address`, `password`, `role`, `created`, `modified`) VALUES
(1, 11111111, 'Alumno', 'Alumno@alumno.com', 'Direccion', '$2y$10$902/oGcJGGkb0TDrUak8/Oa9o7c7sFdKXpvdyNky5REztNP6ztjsy', 'Alumno', '2017-11-27 12:55:36', NULL),
(2, 22222222, 'Gestor de contenidos', 'Gestor@gestor.com', 'Direccion', '$2y$10$R/d9zlAVF0X21yWYYaFSTORV3r7b6UXmWPNA69euZaR5zNau3u.NK', 'Gestor de contenidos', '2017-11-27 12:55:36', NULL),
(3, 33333333, 'Administrator', 'Administrator@Administrator.com', 'Direccion', '$2y$10$/ryAXZZf5SAOTJsZvILpZOSy0Yo8AdYR6MLxhSt72rMnZpwgCm67e', 'Administrador', '2017-11-27 12:55:36', NULL),
(4, 71526091, 'Guillermo', 'guillermo@guillermoblanco.es', 'c/ Avda Buenos Aires, 80', '$2y$10$o2MjqxPYgn9.xC1XOl0pYePMdBQSFvBNBsuOnl07u/rS5fzMVpBuK', 'Administrador', '2017-11-30 18:15:46', '2017-11-30 18:15:46'),
(6, 12321, 'Paco', 'paco@paco.com', 'asdfas', '$2y$10$EF9hCMJglpMkqlZYlyAUDeoBaiQlKI1M9xr6jqqTiREoOvRhj3/D2', 'Alumno', '2017-12-09 12:53:27', '2017-12-09 12:53:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userscompetences`
--

CREATE TABLE IF NOT EXISTS `userscompetences` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) NOT NULL,
  `competence_id` int(10) NOT NULL,
  `booleannote` varchar(14) DEFAULT NULL,
  `numericnote` int(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `userscompetences`
--

INSERT INTO `userscompetences` (`id`, `user_id`, `competence_id`, `booleannote`, `numericnote`, `created`, `modified`) VALUES
(26, 6, 6, NULL, NULL, NULL, NULL),
(27, 6, 7, NULL, NULL, NULL, NULL),
(28, 6, 36, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoriescompetences`
--
ALTER TABLE `categoriescompetences`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `userscompetences`
--
ALTER TABLE `userscompetences`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `categoriescompetences`
--
ALTER TABLE `categoriescompetences`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `competences`
--
ALTER TABLE `competences`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `userscompetences`
--
ALTER TABLE `userscompetences`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
