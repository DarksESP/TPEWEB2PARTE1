#TPE - Tienda de Videojuegos
---------------------------------------

#Integrantes del grupo
---------------------------------------

NOMBRE Y APELLIDO: HERNÁN LUIS VALEA.
EMAIL: valea.190455@gmail.com

NOMBRE Y APELLIDO: GONZALO RUSSO. 
EMAIL: GONZALORUSSO39@GMAIL.COM

#XAMPP INSTALACIÓN DEL PROYECTO 
---------------------------------------
Primero, instalá XAMPP y abrí su Panel de Control. Arrancá Apache para que tu servidor web funcione y MySQL si tu proyecto necesita base de datos. Todo lo que quieras que se muestre en el navegador debe estar dentro de la carpeta htdocs de XAMPP, que es la raíz de tu servidor local. Si todavía no tenés tu proyecto, podés clonarlo desde GitHub usando git clone dentro de htdocs. Una vez que tengas la carpeta de tu proyecto, podés actualizarla en cualquier momento con git pull para traer los últimos cambios del repositorio remoto. Después abrí el navegador y escribí http://localhost/nombre-del-proyecto para ver tu aplicación funcionando. El menú de navegación (nav) y todos los archivos se cargarán automáticamente según cómo los tengas en tu proyecto.

---------------------------------------
#Temática del TPE:
---------------------------------------

Catalogo de Videojuegos.

Descripción:

El sitio contendrá un catalogo videojuegos, donde cada juego va tener una categoría consola.

--------------------------------------------------------
#Diagrama de Entidad-Relación (DER): 
-------------------------------------------------------
El DER está en el archivo: 
DIAGRAMADER-.jpeg
## 🎮 Diagrama de base de datos

 
![Diagrama ER](./DIAGRAMADER-.jpeg)

Descripción general del DER:
----------------------------
El modelo contiene:

Videojuego: Cada juego disponible en el catálogo. ID Auto incrementable, Nombre, ID_consola, descripcion, imagen, audio.

Consola: ID auto incrementable, nombre consola, nombre empresa, imagen.


---------------------------------------------------------------

#Tabla Usuarios:
-------------------------------------------------------------
Usuario: ID auto incrementable, nombre, password.

---------------------------------------------------------

#Código SQL de la BBDD
-----------------------------------------------------------

El código de la DB se encuentra en


## 🗄️ Base de datos:
tp_tienda_videojuegos.sql

```sql
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2025 a las 22:21:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp_tienda_videojuegos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consola`
--

CREATE TABLE `consola` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `empresa` varchar(50) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consola`
--

INSERT INTO `consola` (`id`, `nombre`, `empresa`, `imagen`) VALUES
(32, 'PS2', 'PLAYSTATION', './img/juego/690ed88c188ad.png'),
(33, 'PS3', 'PLAYSTATION', './img/juego/690ed8b5ec276.png'),
(36, 'PS4', 'SONY', './img/juego/690ff6148e62a.jpg'),
(37, 'PS5', 'PLAYSTATION', './img/juego/690ffc2990924.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego`
--

CREATE TABLE `juego` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_consola` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `genero` varchar(300) NOT NULL,
  `descripcion` text NOT NULL,
  `audio_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juego`
--

INSERT INTO `juego` (`id`, `nombre`, `id_consola`, `imagen`, `genero`, `descripcion`, `audio_url`) VALUES
(187, 'DARK SOULS 3', 37, './img/juego/691157e4bd164.jpg', 'RPG', 'En Dark Souls III, el jugador encarna al “Ashen One”, un guerrero resucitado destinado a unir las llamas y enfrentar el inevitable fin del mundo. Ambientado en el reino decadente de Lothric, la historia gira en torno al ciclo eterno de luz y oscuridad, donde reyes y héroes caídos deben ser enfrentados para restaurar o destruir el equilibrio.\r\n\r\nA lo largo del juego, el jugador explora un mundo oscuro y peligroso, lleno de enemigos mortales, jefes colosales y secretos escondidos. La narrativa se transmite principalmente a través del ambiente, los diálogos crípticos y los objetos del juego, ofreciendo una experiencia inmersiva y desafiante sobre sacrificio, destino y la lucha contra la decadencia.', 'uploads/audios/audio_691157e4b7aad4.24614538.mp3'),
(212, 'THE WITCHER 3', 36, './img/juego/691f7edc6a07a.jpg', 'RPG', 'Historia de The Witcher 3: Wild Hunt\r\n\r\nThe Witcher 3: Wild Hunt sigue a Geralt de Rivia, un cazador de monstruos conocido como brujo, mientras busca a su hija adoptiva Ciri, quien está siendo perseguida por la temible Cacería Salvaje, un grupo de espectros interdimensionales.\r\n\r\nLa historia transcurre en un mundo abierto devastado por la guerra, lleno de conflictos políticos, criaturas sobrenaturales y decisiones morales complejas. A medida que Geralt la busca, se involucra con reinos humanos y no humanos, facciones rivales y personajes con sus propios intereses, enfrentando monstruos y tomando decisiones que afectan directamente el destino de pueblos enteros.\r\n\r\nLa narrativa combina la aventura épica con elecciones personales profundas, explorando temas de lealtad, venganza, amor y las consecuencias de las acciones en un mundo donde la línea entre el bien y el mal rara vez es clara.', 'ruta_o_url_de_audio.mp3'),
(213, 'DARK SIDERS 2', 33, './img/juego/691f798c647b1.jpg', 'RPG', 'Historia de Darksiders II\r\n\r\nLa historia sigue a Muerte, uno de los Cuatro Jinetes del Apocalipsis, mientras intenta salvar a su hermano Guerra, acusado injustamente de desencadenar el Apocalipsis antes de tiempo. Convencido de su inocencia, Muerte emprende un viaje a través de distintos reinos —como el Reino de los Constructores, el Reino de los Muertos y el propio Abismo— para encontrar una forma de restaurar la Humanidad, ya que devolverla a la vida es la única prueba que puede limpiar el nombre de Guerra.\r\n\r\nEn el camino descubre una amenaza más grande: la Corrupción, una fuerza oscura que está consumiendo mundos enteros y afectando incluso a seres poderosos. Para cumplir su misión, Muerte debe enfrentarse a criaturas legendarias, pactar con entidades antiguas y cargar con el peso de los pecados de su propia raza, los Nephilim. Su viaje es tanto una lucha contra la Corrupción como una búsqueda de redención personal.', 'uploads/audios/audio_691f798c63c4a2.48977346.mp3'),
(214, 'WATCH DOGS 1', 36, './img/juego/691f79db4da46.jpg', 'ACCION', 'Historia de Watch Dogs 1\r\n\r\nEn Watch Dogs, seguís la historia de Aiden Pearce, un hacker brillante convertido en vigilante. Después de que un trabajo de hackeo sale mal, unos criminales envían un mensaje dirigido a él… pero la que termina muriendo es su sobrina Lena, de apenas 6 años. Consumido por la culpa y la necesidad de justicia, Aiden se propone descubrir quién ordenó el ataque y por qué.\r\n\r\nLa historia transcurre en una versión ficticia de Chicago controlada por ctOS, un sistema central que conecta cámaras, semáforos, celulares, bases de datos, energía, transporte… prácticamente toda la ciudad. Aiden usa sus habilidades para hackear ctOS en tiempo real, infiltrarse en redes, exponer secretos y manipular el entorno urbano mientras se mete cada vez más profundo en una red de crimen organizado, corrupción política y vigilantes con sus propios intereses.\r\n\r\nA lo largo del juego, su búsqueda de venganza lo enfrenta a mafias, hackers rivales, corporaciones tecnológicas y viejos aliados con agendas dudosas, todo mientras lucha por mantener unida a su familia y evitar que su cruzada destruya a quienes aún le quedan.', 'uploads/audios/audio_691f79db4d22b2.36035938.mp3'),
(215, 'PAY DAY 2', 33, './img/juego/691f7a3d488ec.jpg', 'ACCION', 'Historia de Payday 2\r\n\r\nPayday 2 sigue a la Payday Gang, un grupo de criminales profesionales (Dallas, Hoxton, Chains y Wolf) que regresa a Washington D.C. para realizar una nueva ola de golpes cada vez más ambiciosos. Aunque el juego es principalmente cooperativo y centrado en misiones, sí tiene un hilo narrativo: la banda trabaja para distintos contactos —mafiosos, políticos corruptos, mercenarios y figuras del crimen organizado— que los contratan para robos, rescates, hackeos, tráfico ilegal y operaciones secretas.\r\n\r\nA medida que avanzan, la pandilla se ve involucrada en una guerra de poder entre organizaciones criminales y entidades gubernamentales. Los atracos se vuelven más grandes y sofisticados, revelando una trama que conecta desde bancos y museos hasta conspiraciones internacionales. En paralelo, la banda intenta mantener su reputación como los ladrones más temidos y eficientes del país, mientras escapa del FBI y de fuerzas de seguridad cada vez más pesadas.\r\n\r\nLa historia se expande misión a misión, mostrando cómo la Payday Gang evoluciona de simples ladrones a una leyenda del crimen.', NULL),
(216, 'GTA SAN ANDREAS', 32, './img/juego/691f7a84e2874.jpg', 'ACCION', 'Historia de GTA: San Andreas\r\n\r\nGrand Theft Auto: San Andreas sigue la historia de Carl “CJ” Johnson, quien vuelve a Los Santos luego de varios años en Liberty City porque su madre fue asesinada. Al regresar, encuentra a su familia dividida y a su barrio dominado por pandillas rivales, corrupción policial y traiciones dentro de su propia banda, los Grove Street Families.\r\n\r\nCJ decide quedarse para reconstruir a su familia, recuperar el respeto perdido y descubrir quién estuvo detrás del crimen que lo trajo de vuelta. Su viaje lo lleva a través de todo el estado ficticio de San Andreas —Los Santos, San Fierro y Las Venturas— donde se mete en guerras de pandillas, trabajos para mafias, operaciones secretas, carreras ilegales y alianzas peligrosas.\r\n\r\nA lo largo de la historia, CJ tiene que lidiar con agentes corruptos como Tenpenny, viejos amigos que lo traicionan, y nuevos aliados que lo ayudan a crecer hasta convertirse en una figura poderosa en el mundo criminal. Es una historia de familia, lealtad, traición y ascenso desde abajo en un entorno lleno de violencia y ambición.', NULL),
(217, 'GTA 5', 33, './img/juego/691f7af517316.jpg', 'ACCION', 'GTA V sigue a tres protagonistas muy distintos cuyos destinos se cruzan en la ciudad de Los Santos.\r\nMichael De Santa es un ex ladrón de bancos frustrado con su vida familiar; Franklin Clinton es un joven que busca escapar de los pequeños delitos de su barrio y encontrar un camino hacia algo más grande; y Trevor Philips es un criminal impredecible que vive en el desierto y que se mueve entre la locura y la lealtad.\r\n\r\nEl encuentro entre Michael y Franklin reabre viejas heridas del pasado y desencadena el regreso de Michael al mundo del crimen, lo que finalmente atrae a Trevor nuevamente a su vida. Los tres terminan formando una alianza tan útil como inestable, uniéndose para realizar golpes sofisticados y de alto riesgo, cada uno con sus propias motivaciones: dinero, poder, venganza o simplemente adrenalina.\r\n\r\nA lo largo de su historia, el juego muestra cómo estos personajes navegan un mundo lleno de corrupción policial, mafias, choques con agencias gubernamentales e intereses cruzados. Mientras intentan sacar provecho de sus habilidades y mantenerse un paso adelante de sus enemigos, también deben lidiar con conflictos internos, tensiones entre ellos y decisiones que pueden cambiar el rumbo de sus vidas.\r\n\r\nEs una historia de crimen, ambición, amistad quebrada y supervivencia en una ciudad tan peligrosa como llena de oportunidades', NULL),
(218, 'BLOODBORNE', 36, './img/juego/691f7b58dc444.jpg', 'RPG', 'Descripción de la historia de Bloodborne\r\n\r\nBloodborne se desarrolla en Yharnam, una ciudad gótica famosa por una misteriosa “sangre curativa” capaz de sanar cualquier enfermedad. Atraído por esta promesa, el protagonista —un Cazador— llega a la ciudad justo cuando todo se ha salido de control: la sangre que debía curar comenzó a corromper a la gente, transformándola en bestias violentas.\r\n\r\nDurante la Noche de la Cacería, el Cazador se ve atrapado en un ciclo de pesadillas, criaturas grotescas y secretos prohibidos. A medida que explora Yharnam, descubre que detrás de la plaga de bestias hay rituales antiguos, una orden de eruditos que jugó con fuerzas incomprensibles y la presencia de seres cósmicos que trascienden la lógica humana.\r\n\r\nLa historia se basa en piezas sueltas —diálogos breves, objetos, escenarios— pero gira alrededor de un tema central:\r\nla búsqueda del conocimiento y el precio de desafiar lo desconocido.\r\n\r\nMientras avanza, el Cazador intenta comprender el origen de la enfermedad, la conexión entre la sangre, las pesadillas y estos seres superiores, y el rol que él mismo cumplirá en el destino de Yharnam.', NULL),
(219, 'GOD OF WAR 1', 32, './img/juego/691f7d87b892f.jpg', 'HACK AND SLASH', 'Kratos inicia su viaje de venganza contra Ares, el dios de la guerra.', NULL),
(220, 'Final Fantasy X', 32, NULL, 'RPG', 'Tidus y Yuna buscan salvar el mundo de Spira de la amenaza de Sin.', NULL),
(222, 'Metal Gear Solid 2', 32, NULL, 'Sigilo', 'Raiden debe detener un complot que amenaza con un conflicto global.', NULL),
(223, 'Kingdom Hearts', 32, NULL, 'RPG', 'Sora viaja por distintos mundos Disney luchando contra la oscuridad.', NULL),
(224, 'RESIDENT EVIL 4', 32, './img/juego/691f81003f51f.jpg', 'TERROR', 'Historia de Resident Evil 4\r\n\r\nEn Resident Evil 4, Leon S. Kennedy, ahora agente especial del gobierno de EE. UU., es enviado a una remota región de Europa para rescatar a Ashley Graham, la hija del presidente, que ha sido secuestrada por un misterioso culto llamado Los Iluminados.\r\n\r\nAl llegar, Leon descubre que los aldeanos locales están infectados por un parásito llamado Las Plagas, que los convierte en violentos y obedientes al culto. A medida que avanza, enfrenta hordas de enemigos, resuelve acertijos y lucha contra jefes sobrenaturales, mientras intenta desentrañar los oscuros secretos del culto y proteger a Ashley de un destino fatal.\r\n\r\nLa historia combina terror, acción y suspenso, mostrando cómo Leon se enfrenta a un enemigo que va más allá de los zombis tradicionales y pone a prueba su habilidad, ingenio y resistencia.', NULL),
(225, 'DEVIL MAY CRY 3', 32, './img/juego/691f82b8aab2b.jpeg', 'ACCION', 'Dante lucha contra su hermano Vergil y los demonios de la familia Sparda.', NULL),
(226, 'SILENT HILL 2', 32, './img/juego/691f8334167fd.jpeg', 'TERROR', 'James busca a su esposa fallecida mientras enfrenta horrores en Silent Hill.', NULL),
(227, 'Gran Turismo 4', 32, NULL, 'Carreras', 'Compite en una amplia variedad de coches y circuitos por la gloria en GT.', NULL),
(228, 'Okami', 32, NULL, 'Aventura', 'Amaterasu, la diosa lobo, restaura la vida y el color en un mundo corrompido.', NULL),
(229, 'Shadow of the Colossus', 32, NULL, 'Aventura', 'Un joven intenta resucitar a una chica enfrentando colosos gigantes.', NULL),
(230, 'ICO', 32, NULL, 'Aventura', 'Un joven debe escapar de un castillo junto a una misteriosa niña.', NULL),
(231, 'Ratchet & Clank', 32, NULL, 'Plataformas', 'Ratchet y Clank luchan para salvar el universo de la amenaza de Chairman Drek.', NULL),
(232, 'Jak and Daxter', 32, NULL, 'Plataformas', 'Jak y Daxter exploran mundos peligrosos mientras enfrentan a enemigos oscuros.', NULL),
(233, 'Prince of Persia: Sands of Time', 32, NULL, 'Aventura', 'El príncipe busca detener el flujo del tiempo y salvar su reino.', NULL),
(234, 'Tekken 5', 32, NULL, 'Lucha', 'Los mejores luchadores del mundo compiten en el torneo más peligroso.', NULL),
(235, 'ICO & Shadow of the Colossus Collection', 32, NULL, 'Aventura', 'Colección que une ambos juegos icónicos de aventura y exploración.', NULL),
(236, 'Bully', 32, NULL, 'Aventura', 'Jimmy Hopkins se enfrenta a la vida escolar llena de pandillas y travesuras.', NULL),
(237, 'Persona 3', 32, NULL, 'JRPG', 'Estudiantes combaten sombras durante la hora oculta, mientras exploran sus vínculos.', NULL),
(238, 'Silent Hill 3', 32, NULL, 'Terror', 'Heather Mason debe enfrentar horrores que conectan con el pasado de su madre.', NULL),
(239, 'THE LAST OF US', 33, './img/juego/691f83e8f0a4a.png', 'AVENTURA', 'Joel y Ellie atraviesan Estados Unidos post-apocalíptico lleno de infectados.', NULL),
(240, 'Uncharted: Drake\'s Fortune', 33, NULL, 'Aventura', 'Nathan Drake busca tesoros perdidos mientras enfrenta enemigos mortales.', NULL),
(242, 'Metal Gear Solid 4', 33, NULL, 'Sigilo', 'Old Snake debe detener a Liquid Ocelot y evitar un conflicto global.', NULL),
(243, 'Red Dead Redemption', 33, NULL, 'Aventura', 'John Marston busca a los miembros de su antigua banda para asegurar el futuro de su familia.', NULL),
(244, 'Grand Theft Auto IV', 33, NULL, 'Acción', 'Niko Bellic llega a Liberty City buscando su sueño americano mientras enfrenta su pasado.', NULL),
(246, 'Heavy Rain', 33, NULL, 'Aventura', 'Una serie de personajes buscan al asesino del Origami mientras toman decisiones críticas.', NULL),
(247, 'Infamous', 33, NULL, 'Acción', 'Cole MacGrath obtiene poderes eléctricos y debe decidir entre el bien y el mal.', NULL),
(248, 'Killzone 2', 33, NULL, 'Shooter', 'La ISA lucha por sobrevivir frente al ejército de Helghan.', NULL),
(249, 'LittleBigPlanet', 33, NULL, 'Plataformas', 'Sackboy explora mundos creativos y resuelve puzzles mientras crea sus propios niveles.', NULL),
(250, 'Ratchet & Clank Future: Tools of Destruction', 33, NULL, 'Plataformas', 'Ratchet y Clank viajan por el espacio para salvar el universo.', NULL),
(251, 'Journey', 33, NULL, 'Aventura', 'Un viajero explora un desierto en busca de un gran templo en la cima de la montaña.', NULL),
(252, 'Ni no Kuni: Wrath of the White Witch', 33, NULL, 'RPG', 'Oliver busca salvar a su madre y descubrir un mundo mágico con la ayuda de hechiceros.', NULL),
(253, 'Gran Turismo 5', 33, NULL, 'Carreras', 'Compite en autos realistas y circuitos desafiantes en este simulador de conducción.', NULL),
(254, 'Bayonetta', 33, NULL, 'Acción', 'Una bruja con poderes sobrenaturales lucha contra ángeles y demonios en combates espectaculares.', NULL),
(255, 'Resistance 3', 33, NULL, 'Shooter', 'La humanidad lucha contra los Quimera en una guerra desesperada.', NULL),
(256, 'Sly Cooper: Thieves in Time', 33, NULL, 'Plataformas', 'Sly y su banda viajan en el tiempo para salvar el legado de los Cooper.', NULL),
(257, 'Assassin\'s Creed II', 33, NULL, 'Aventura', 'Ezio Auditore busca vengar a su familia mientras se convierte en asesino.', NULL),
(261, 'Spider-Man', 36, NULL, 'Acción', 'Peter Parker protege Nueva York mientras enfrenta a villanos clásicos y nuevos.', NULL),
(263, 'The Last Guardian', 36, NULL, 'Aventura', 'Un niño se hace amigo de una criatura gigante llamada Trico y enfrentan juntos peligros.', NULL),
(264, 'Uncharted 4: A Thief\'s End', 36, NULL, 'Aventura', 'Nathan Drake sale de retiro para buscar un tesoro perdido mientras enfrenta viejos enemigos.', NULL),
(265, 'Persona 5', 36, NULL, 'JRPG', 'Los Phantom Thieves luchan contra la corrupción dentro de la sociedad japonesa.', NULL),
(266, 'Gran Turismo Sport', 36, NULL, 'Carreras', 'Simulador de conducción con autos y circuitos realistas.', NULL),
(267, 'Monster Hunter: World', 36, NULL, 'Acción RPG', 'Cazadores enfrentan monstruos gigantes en un mundo abierto y dinámico.', NULL),
(268, 'The Witcher 3: Wild Hunt', 36, NULL, 'RPG', 'Geralt busca a Ciri mientras enfrenta guerras, monstruos y decisiones difíciles.', NULL),
(269, 'Death Stranding', 36, NULL, 'Aventura', 'Sam Bridges atraviesa Estados Unidos post-apocalíptico para reconectar a la humanidad.', NULL),
(270, 'Sekiro: Shadows Die Twice', 36, NULL, 'Acción', 'Un shinobi busca rescatar a su joven señor mientras enfrenta enemigos mortales y jefes enormes.', NULL),
(271, 'Resident Evil 2', 36, NULL, 'Terror', 'Leon y Claire deben sobrevivir a un brote viral que convierte a la gente en zombis.', NULL),
(272, 'Control', 36, NULL, 'Acción', 'Jesse Faden explora un misterioso edificio y descubre poderes sobrenaturales.', NULL),
(273, 'Ghost of Tsushima', 36, NULL, 'Acción', 'Jin Sakai defiende Tsushima de la invasión mongola mientras forja su camino como samurái.', NULL),
(274, 'Days Gone', 36, NULL, 'Aventura', 'Deacon St. John sobrevive en un mundo lleno de infectados y pandillas peligrosas.', NULL),
(275, 'FIFA 21', 36, NULL, 'Deportes', 'Simulador de fútbol con equipos, torneos y ligas reales.', NULL),
(276, 'NBA 2K21', 36, NULL, 'Deportes', 'Simulador de baloncesto con jugadores, equipos y modos de juego completos.', NULL),
(277, 'Assassin\'s Creed Odyssey', 36, NULL, 'Aventura', 'Kassandra o Alexios exploran la Antigua Grecia mientras desentrañan secretos familiares y mitológicos.', NULL),
(278, 'Call of Duty: Modern Warfare', 36, NULL, 'Shooter', 'Soldados modernos enfrentan conflictos internacionales y misiones peligrosas.', NULL),
(280, 'Spider-Man: Miles Morales', 37, NULL, 'Acción', 'Miles descubre sus poderes y protege Nueva York de una nueva amenaza.', NULL),
(281, 'Ratchet & Clank: Rift Apart', 37, NULL, 'Plataformas', 'Ratchet y Clank viajan entre dimensiones para detener a un emperador interdimensional.', NULL),
(282, 'Returnal', 37, NULL, 'Shooter', 'Selene queda atrapada en un planeta alienígena con ciclos temporales y enemigos mortales.', NULL),
(284, 'Resident Evil Village', 37, NULL, 'Terror', 'Ethan Winters busca a su hija secuestrada mientras enfrenta horrores en un pueblo remoto.', NULL),
(287, 'FIFA 23', 37, NULL, 'Deportes', 'Simulador de fútbol con ligas y torneos actualizados.', NULL),
(288, 'NBA 2K23', 37, NULL, 'Deportes', 'Simulador de baloncesto con jugadores y equipos reales.', NULL),
(289, 'Final Fantasy VII Remake', 37, NULL, 'RPG', 'Reimaginación del clásico juego donde Cloud lucha contra Shinra y Sephiroth.', NULL),
(290, 'Gran Turismo 7', 37, NULL, 'Carreras', 'Simulador de conducción con coches, circuitos y físicas realistas.', NULL),
(291, 'Deathloop', 37, NULL, 'Acción', 'Dos asesinos atrapados en un bucle temporal intentan eliminarse mutuamente.', NULL),
(292, 'Kena: Bridge of Spirits', 37, NULL, 'Aventura', 'Kena ayuda a espíritus a encontrar paz mientras explora un mundo mágico.', NULL),
(293, 'Ghostwire: Tokyo', 37, NULL, 'Aventura', 'El jugador combate fantasmas y descubre secretos sobrenaturales en Tokio.', NULL),
(294, 'Stray', 37, NULL, 'Aventura', 'Un gato explora una ciudad futurista habitada por robots para encontrar a su familia.', NULL),
(295, 'Sackboy: A Big Adventure', 37, NULL, 'Plataformas', 'Sackboy recorre mundos coloridos para derrotar a enemigos y salvar a amigos.', NULL),
(296, 'Hogwarts Legacy', 37, NULL, 'RPG', 'Explora el mundo mágico de Harry Potter en el siglo XIX como estudiante de Hogwarts.', NULL),
(297, 'Resident Evil 4 Remake', 37, NULL, 'Terror', 'Leon S. Kennedy viaja a un pueblo europeo para rescatar a la hija del presidente en una versión moderna del clásico.', NULL),
(298, 'Call of Duty: Modern Warfare II', 37, NULL, 'Shooter', 'Soldados modernos enfrentan conflictos internacionales en operaciones peligrosas.', NULL);

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
(5, 'webadmin', '$2y$10$6Ge281/ahvQXqKlraqhHPuA7xIQ.YwO4o7uN465K/w58B7jv/BtCG');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `juego`
--
ALTER TABLE `juego`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `juego`
--
ALTER TABLE `juego`
  ADD CONSTRAINT `juego_ibfk_1` FOREIGN KEY (`id_consola`) REFERENCES `consola` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
