#TPE - Tienda de Videojuegos
---------------------------------------

#Integrantes del grupo
---------------------------------------

NOMBRE Y APELLIDO: HERNÁN LUIS VALEA.
EMAIL: valea.190455@gmail.com

NOMBRE Y APELLIDO: GONZALO RUSSO. 
EMAIL: GONZALORUSSO39@GMAIL.COM

---------------------------------------
#GUÍA PARA DESPLEGAR EL SITIO
---------------------------------------

Para poder visualizar el sitio web en cualquier dispositivo, primero es necesario iniciar los servicios de Apache y MySQL desde el panel de XAMPP.
Después, abrí el Explorador de archivos y dirigite a la ruta C:/xampp/htdocs, que es donde se almacenan los proyectos del servidor local.
Dentro de esa carpeta, abrí la consola de Git y ejecutá el comando para clonar el repositorio desde GitHub.
Una vez completado el proceso, abrí tu navegador web y en la barra de direcciones escribí:

localhost/nombre_de_la_carpeta

De esta manera, el sitio se ejecutará localmente y podrás acceder a él desde cualquier dispositivo conectado a la misma red.

DATOS DE ACCESO PARA EL SITIO:

Nombre de usuario: webadmin
Contraseña: admin

#Temática del TPE:
---------------------------------------

Catalogo de Videojuegos.

Descripción:

El sitio contendrá un catalogo videojuegos, donde cada juego va tener una categoría consola.

--------------------------------------------------------
#Diagrama de Entidad-Relación (DER): 
-------------------------------------------------------
El DER está en el archivo: 
DiagramaOk.jpeg
## 🎮 Diagrama de base de datos

 
![Diagrama ER](./DiagramaOk.jpeg)

Descripción general del DER:
----------------------------
El modelo contiene:

Videojuego: Cada juego disponible en el catálogo. ID Auto incrementable, Nombre, ID_consola.
Consola: ID auto incrementable, nombre consola, nompre empresa.


---------------------------------------------------------------

#Tabla Usuarios:
-------------------------------------------------------------
Usuario: ID auto incrementable, rol, email, password.

---------------------------------------------------------

#Código SQL de la BBDD
-----------------------------------------------------------

El código de la DB se encuentra en


## 🗄️ Base de datos:
tp_tienda_videojuegos.sql

```sql

 
-- Base de datos: `tp_tienda_videojuegos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consola`
--

CREATE TABLE `consola` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `empresa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consola`
--

INSERT INTO `consola` (`id`, `nombre`, `empresa`) VALUES
(1, 'PS3', 'SONY'),
(2, 'XBOX', 'MICROSOFT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego`
--

CREATE TABLE `juego` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_consola` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `genero` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juego`
--

INSERT INTO `juego` (`id`, `nombre`, `id_consola`, `imagen`, `genero`) VALUES
(90, 'BLACK OPS 2', 1, './img/juego/68f442958abb1.jpeg', 'SHOOTER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `passwordd` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `passwordd`) VALUES
(1, 'webadmin', '$2y$10$jhAiFnD0o5vqVC1MW3Dubua5I51NVZRj4rzU3G8pY8s3xqsQm40W.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consola`
--
ALTER TABLE `consola`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `juego`
--
ALTER TABLE `juego`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_consola`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consola`
--
ALTER TABLE `consola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `juego`
--
ALTER TABLE `juego`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `juego`
--
ALTER TABLE `juego`
  ADD CONSTRAINT `juego_ibfk_1` FOREIGN KEY (`id_consola`) REFERENCES `consola` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
