--
-- Base de datos: `prueba_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL COMMENT 'Identificador del empleado',
  `nombre` varchar(255) NOT NULL COMMENT 'Nombre completo del empleado campo tipo text solo debe permitir letras con o sin tilde y espacios. no deben permitir caracteres especiales ni numeros. Obligatorio',
  `email` varchar(255) NOT NULL COMMENT 'Correo electronico del empleado. campo tipo text|email. solo debe permitir una estructura de correo',
  `sexo` char(1) NOT NULL COMMENT 'Campo tipo radio button. M para masculino y F para femenino. Obligatorio',
  `area_id` int(11) NOT NULL COMMENT 'Area de la empresa a la que pertenece el empleado. campo tipo select. obligatorio',
  `boletin` int(11) NOT NULL COMMENT '1 para Recibir boletin. 0 para No recibir boletin. Campo tipo CheckBox. opcional',
  `descripcion` text NOT NULL COMMENT 'Se describe la experiencia del empleado. Campo tipo textarea. Obligatorio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_id` (`area_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del empleado';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `area_id` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
