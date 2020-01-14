CREATE DATABASE gdlwebcamp;
USE gdlwebcamp;



--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `editado` datetime NOT NULL,
  `nivel` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id_admin`, `usuario`, `nombre`, `password`, `editado`, `nivel`) VALUES
(1, 'admin', 'Jesus Antonio Quintero Cardona', '$2y$12$t7mvmJ52w1nyg9sthD4wIOYtOc1BZCUbO7fxHJyimcALc3keBAgMe', '2019-09-25 14:14:49', 1),
(6, 'admin2', 'Jhon Mario Quintero Cardona', '$2y$12$VsborDfVg8bVze9MADG27eHLwky1b1wRX1rzcmRu8qBQBw2tGoKlm', '2019-09-25 14:20:05', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_evento`
--

CREATE TABLE `categoria_evento` (
  `id_categoria` tinyint(10) UNSIGNED NOT NULL,
  `cat_evento` varchar(50) NOT NULL,
  `icono` varchar(15) NOT NULL,
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_evento`
--

INSERT INTO `categoria_evento` (`id_categoria`, `cat_evento`, `icono`, `editado`) VALUES
(1, 'Seminario', 'fa-university', '2019-09-18 17:51:30'),
(2, 'Conferencias', 'fa-comment', '2019-09-18 17:51:31'),
(3, 'Talleres', 'fa-code', '2019-09-18 17:51:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` tinyint(10) UNSIGNED NOT NULL,
  `nombre_evento` varchar(60) NOT NULL,
  `fecha_evento` date NOT NULL,
  `hora_evento` time NOT NULL,
  `id_categoria` tinyint(10) UNSIGNED NOT NULL,
  `id_invitado` tinyint(10) UNSIGNED NOT NULL,
  `clave` varchar(10) NOT NULL,
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_evento`, `nombre_evento`, `fecha_evento`, `hora_evento`, `id_categoria`, `id_invitado`, `clave`, `editado`) VALUES
(1, 'Responsive Web Design', '2016-12-09', '19:00:00', 3, 1, 'taller_01', '2019-09-26 09:59:52'),
(2, 'Flexbox', '2016-12-09', '12:00:00', 3, 2, 'taller_02', '0000-00-00 00:00:00'),
(3, 'HTML5 y CSS3', '2016-12-09', '14:00:00', 3, 3, 'taller_03', '0000-00-00 00:00:00'),
(4, 'Drupal', '2016-12-09', '17:00:00', 3, 4, 'taller_04', '0000-00-00 00:00:00'),
(5, 'WordPress', '2016-12-09', '19:00:00', 3, 5, 'taller_05', '0000-00-00 00:00:00'),
(6, 'Como ser freelancer', '2016-12-09', '10:00:00', 2, 6, 'conf_01', '0000-00-00 00:00:00'),
(7, 'Tecnologías del Futuro', '2016-12-09', '17:00:00', 2, 1, 'conf_02', '0000-00-00 00:00:00'),
(8, 'Seguridad en la Web', '2016-12-09', '19:00:00', 2, 2, 'conf_03', '0000-00-00 00:00:00'),
(9, 'Diseño UI y UX para móviles', '2016-12-09', '10:00:00', 1, 6, 'sem_01', '0000-00-00 00:00:00'),
(10, 'AngularJS', '2016-12-10', '10:00:00', 3, 1, 'taller_06', '0000-00-00 00:00:00'),
(11, 'PHP y MySQL', '2016-12-10', '12:00:00', 3, 2, 'taller_07', '0000-00-00 00:00:00'),
(12, 'JavaScript Avanzado', '2016-12-10', '14:00:00', 3, 3, 'taller_08', '0000-00-00 00:00:00'),
(13, 'SEO en Google', '2016-12-10', '17:00:00', 3, 4, 'taller_09', '0000-00-00 00:00:00'),
(14, 'De Photoshop a HTML5 y CSS3', '2016-12-10', '19:00:00', 3, 5, 'taller_10', '0000-00-00 00:00:00'),
(15, 'PHP Intermedio y Avanzado', '2016-12-10', '21:00:00', 3, 6, 'taller_11', '0000-00-00 00:00:00'),
(16, 'Como crear una tienda online que venda millones en pocos día', '2016-12-10', '10:00:00', 2, 6, 'conf_04', '0000-00-00 00:00:00'),
(17, 'Los mejores lugares para encontrar trabajo', '2016-12-10', '17:00:00', 2, 1, 'conf_05', '0000-00-00 00:00:00'),
(18, 'Pasos para crear un negocio rentable ', '2016-12-10', '19:00:00', 2, 2, 'conf_06', '0000-00-00 00:00:00'),
(19, 'Aprende a Programar en una mañana', '2016-12-10', '10:00:00', 1, 3, 'sem_02', '0000-00-00 00:00:00'),
(20, 'Diseño UI y UX para móviles', '2016-12-10', '17:00:00', 1, 5, 'sem_03', '0000-00-00 00:00:00'),
(21, 'Laravel', '2016-12-11', '10:00:00', 3, 1, 'taller_12', '0000-00-00 00:00:00'),
(22, 'Crea tu propia API', '2016-12-11', '12:00:00', 3, 2, 'taller_13', '0000-00-00 00:00:00'),
(23, 'JavaScript y jQuery', '2016-12-11', '14:00:00', 3, 3, 'taller_14', '0000-00-00 00:00:00'),
(24, 'Creando Plantillas para WordPress', '2016-12-11', '17:00:00', 3, 4, 'taller_15', '0000-00-00 00:00:00'),
(25, 'Tiendas Virtuales en Magento', '2016-12-11', '19:00:00', 3, 5, 'taller_16', '0000-00-00 00:00:00'),
(26, 'Como hacer Marketing en línea', '2016-12-11', '10:00:00', 2, 6, 'conf_07', '0000-00-00 00:00:00'),
(27, '¿Con que lenguaje debo empezar?', '2016-12-11', '17:00:00', 2, 2, 'conf_08', '0000-00-00 00:00:00'),
(28, 'Frameworks y librerias Open Source', '2016-12-11', '19:00:00', 2, 3, 'conf_09', '0000-00-00 00:00:00'),
(29, 'Creando una App en Android en una mañana', '2016-12-11', '10:00:00', 1, 4, 'sem_04', '0000-00-00 00:00:00'),
(30, 'Creando una App en iOS en una tarde', '2016-12-11', '17:00:00', 1, 1, 'sem_05', '0000-00-00 00:00:00'),
(35, 'Seguridad Informatica', '2019-09-06', '16:00:00', 1, 3, '', '2019-09-27 14:32:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitados`
--

CREATE TABLE `invitados` (
  `id_invitado` tinyint(10) UNSIGNED NOT NULL,
  `nombre_invitado` varchar(30) NOT NULL,
  `apellido_invitado` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `url_imagen` varchar(50) DEFAULT NULL,
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `invitados`
--

INSERT INTO `invitados` (`id_invitado`, `nombre_invitado`, `apellido_invitado`, `descripcion`, `url_imagen`, `editado`) VALUES
(1, 'Rafael', 'Bautista', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Suscipit cumque optio architecto. Odit, natus perspiciatis nostrum excepturi fugiat an', 'invitado1.jpg', '2019-09-26 15:31:25'),
(2, 'Shari', 'Herrera', 'sectetur adipisicing elit. Suscipit cumque optio architecto. Odit, natus perspiciatis nostrum excepturi fugiat an', 'invitado2.jpg', '0000-00-00 00:00:00'),
(3, 'Gregorio', 'Sanchez', 'sectetur adipisicing elit. Suscipit cumque optio architecto. Odit, natus perspiciatis nostrum excepturi fugiat an', 'invitado3.jpg', '0000-00-00 00:00:00'),
(4, 'Susana', 'Rivera', 'sectetur adipisicing elit. Suscipit cumque optio architecto. Odit, natus perspiciatis nostrum excepturi fugiat an', 'invitado4.jpg', '0000-00-00 00:00:00'),
(5, 'Harold', 'Garcia', 'sectetur adipisicing elit. Suscipit cumque optio architecto. Odit, natus perspiciatis nostrum excepturi fugiat an', 'invitado5.jpg', '0000-00-00 00:00:00'),
(6, 'Susan', 'Sanchez', 'sectetur adipisicing elit. Suscipit cumque optio architecto. Odit, natus perspiciatis nostrum excepturi fugiat an', 'invitado6.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regalos`
--

CREATE TABLE `regalos` (
  `id_regalo` int(11) UNSIGNED NOT NULL,
  `nombre_regalo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `regalos`
--

INSERT INTO `regalos` (`id_regalo`, `nombre_regalo`) VALUES
(1, 'Pulsera'),
(2, 'Etiquetas'),
(3, 'Plumas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrados`
--

CREATE TABLE `registrados` (
  `id_registrado` bigint(20) UNSIGNED NOT NULL,
  `nombre_registrado` varchar(50) NOT NULL,
  `apellido_registrado` varchar(50) NOT NULL,
  `email_registrado` varchar(100) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `pases_articulos` longtext NOT NULL,
  `talleres_registrados` longtext NOT NULL,
  `regalo` int(11) UNSIGNED DEFAULT NULL,
  `total_pagado` varchar(50) NOT NULL,
  `pagado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `registrados`
--

INSERT INTO `registrados` (`id_registrado`, `nombre_registrado`, `apellido_registrado`, `email_registrado`, `fecha_registro`, `pases_articulos`, `talleres_registrados`, `regalo`, `total_pagado`, `pagado`) VALUES
(10, 'Jesus Antonio', 'Quintero Cardona', 'jquinterocard@gmail.com', '2018-09-24 00:00:00', '{\"un_dia\":{\"cantidad\":\"0\"},\"pase_completo\":{\"cantidad\":\"2\"},\"pase_2dias\":{\"cantidad\":\"3\"},\"camisas\":1,\"etiquetas\":2}', '{\"eventos\":[\"9\"]}', 3, '248.3', 1),
(11, 'Jhon Mario', 'Quintero Cardona', 'jhonqc@gmail.com', '2019-09-25 15:53:47', '{\"un_dia\":{\"cantidad\":\"\"},\"pase_completo\":{\"cantidad\":\"\"},\"pase_2dias\":{\"cantidad\":\"1\"},\"camisas\":1}', '{\"eventos\":[\"15\"]}', 1, '54.3', 1),
(13, 'daniel', 'zapata', 'dani@dani.com', '2019-09-28 12:12:43', '{\"un_dia\":{\"cantidad\":\"1\"},\"pase_completo\":{\"cantidad\":\"\"},\"pase_2dias\":{\"cantidad\":\"\"}}', '{\"eventos\":[\"9\"]}', 1, '30', 1),
(14, 'andrea', 'Gimenez', 'dani@dani.com', '2019-09-28 12:13:23', '{\"un_dia\":{\"cantidad\":\"1\"},\"pase_completo\":{\"cantidad\":\"\"},\"pase_2dias\":{\"cantidad\":\"\"}}', '{\"eventos\":[\"9\"]}', 2, '30', 1),
(15, 'Pablo', 'Ramirez', 'pablo@gmail.com', '2019-09-28 12:14:50', '{\"un_dia\":{\"cantidad\":\"\"},\"pase_completo\":{\"cantidad\":\"\"},\"pase_2dias\":{\"cantidad\":\"1\"},\"camisas\":1,\"etiquetas\":1}', '{\"eventos\":[\"2\",\"3\"]}', 2, '56.3', 1),
(16, 'Andrea', 'Lopetegui', 'andrea@outlook.com', '2019-09-29 02:36:14', '{\"un_dia\":\"1\",\"pase_completo\":\"\",\"pase_2dias\":\"\",\"camisas\":1,\"etiquetas\":2}', '{\"eventos\":[\"2\"]}', 2, '43.3', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `categoria_evento`
--
ALTER TABLE `categoria_evento`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_invitado` (`id_invitado`);

--
-- Indices de la tabla `invitados`
--
ALTER TABLE `invitados`
  ADD PRIMARY KEY (`id_invitado`);

--
-- Indices de la tabla `regalos`
--
ALTER TABLE `regalos`
  ADD PRIMARY KEY (`id_regalo`);

--
-- Indices de la tabla `registrados`
--
ALTER TABLE `registrados`
  ADD PRIMARY KEY (`id_registrado`),
  ADD KEY `regalo` (`regalo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `categoria_evento`
--
ALTER TABLE `categoria_evento`
  MODIFY `id_categoria` tinyint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` tinyint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `invitados`
--
ALTER TABLE `invitados`
  MODIFY `id_invitado` tinyint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `regalos`
--
ALTER TABLE `regalos`
  MODIFY `id_regalo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `registrados`
--
ALTER TABLE `registrados`
  MODIFY `id_registrado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_evento` (`id_categoria`),
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`id_invitado`) REFERENCES `invitados` (`id_invitado`);

--
-- Filtros para la tabla `registrados`
--
ALTER TABLE `registrados`
  ADD CONSTRAINT `registrados_ibfk_1` FOREIGN KEY (`regalo`) REFERENCES `regalos` (`id_regalo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
