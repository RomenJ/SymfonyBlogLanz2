-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2023 a las 17:49:39
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `symfonybloglanz01`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tema_id` int(11) DEFAULT NULL,
  `creadate` datetime DEFAULT NULL,
  `oculto` tinyint(1) DEFAULT NULL,
  `texto` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `user_id`, `tema_id`, `creadate`, `oculto`, `texto`) VALUES
(1, 3, 1, '2018-01-11 11:13:00', 0, 'Cuando me hago un tremere puedo elegir no tener defecto de clan?'),
(2, 3, NULL, '2022-02-02 10:15:00', 0, 'Comentario de iniciación de personasjes? Destreza + D10 para iniciativa?'),
(3, 3, 1, '2022-07-12 10:08:00', 0, 'Tema de comentar personaje. Puedo ponerme destreza >5?'),
(5, 3, 4, NULL, NULL, 'Una vez mi cuadrilla y yo nos topamos con uno, escapó sólo una pequeña parte de nosotros. En concreto se salvó un brazo de todos nosotros.'),
(6, 3, 4, '2023-03-31 19:29:42', NULL, 'Fue la catástrofe xddd, el Olvido se lo comió todo xdd'),
(7, 3, 4, '2023-03-31 19:33:17', NULL, 'Pues yo tengo un amigo que surfeó un malesttrom con nivel destreza 10 y 12 éxitos en la tirada...Luego se lo tragó el olvido pero sus historias quedarán para toda la muerte xd'),
(13, 3, 9, '2023-04-05 14:26:51', 1, 'Sí, los Magos están locos'),
(14, 2, 9, '2023-04-05 14:27:46', NULL, 'No, los magos no están locos, son interdimensionales'),
(15, 2, 10, '2023-04-05 14:54:54', NULL, 'Abro tema, ¿los vampiros pueden traspasar el manto?'),
(16, 1, 5, '2023-04-05 17:37:18', NULL, 'Qué miedito la Fé verdadera en edad Oscura'),
(17, 2, 1, '2023-04-05 17:40:52', NULL, 'Aquí no puedes tener >5 pero si tu master te deja, puedes'),
(18, 3, 1, '2023-04-05 17:42:33', NULL, 'Mi master dice que si pongo 6 defectos me deja, eso no es ilegal?'),
(19, 1, 11, '2023-04-05 17:48:12', NULL, 'El fuego no afecta a los Pokemon de fuego en MdeT'),
(20, 3, 11, '2023-04-05 17:49:56', NULL, 'Lo siento user 1 no tiene razón. Los pokemon son ghouls de la Camarilla. Arden como toda criatura sobrenatural porque el fuego es divino y en MdT están todos condenados xd'),
(21, 5, 11, '2023-04-08 23:10:00', NULL, 'El Fuego no les afecta a los Pokemon de MdeT ya que los pokémon existen de la misma manera que la Fé Verdadera  y los puntos de Voluntad'),
(22, 6, 11, '2023-04-10 15:44:24', NULL, 'Lara tiene razón los Pokémon funcionan con fé verdadera y NO están condenados'),
(23, 2, 1, '2023-04-13 17:55:00', NULL, '`pues no'),
(24, 2, 1, '2023-04-24 16:21:42', NULL, 'Y como soy admin digo que no y si no te baneo'),
(25, 2, 2, '2023-04-24 17:01:58', NULL, '¿Cómo gano puntos de humanidad?'),
(26, 2, 8, '2023-04-27 17:24:21', NULL, 'La mano negra es un una seccion del sabbat'),
(27, 1, 1, '2023-05-02 17:41:48', NULL, 'Yo digo que sí el legal y punto'),
(28, 8, 13, '2023-05-02 18:28:15', NULL, 'la inquisición en muy divertida, se hacen amigos muy fácilmente...si uno sabe como usarla'),
(29, 3, 13, '2023-05-02 18:41:25', NULL, 'cuidado pepinillo,2, tienes sus peligros jugar con la inkisición xd'),
(30, 3, 2, '2023-05-02 21:18:32', NULL, 'pues muy sencillo, habla con tu narrador y te comentará que acciones/comportamientos te subirán humanidad'),
(31, 8, 2, '2023-05-02 21:28:27', NULL, 'en una de esas, tuve que ayudar a la viejecita a cruzar la calle para que el narrador me subiera un punto de humanidad'),
(32, 3, 12, '2023-05-03 22:28:08', NULL, 'el abrazo es una de los cuestiones más importantes'),
(33, 2, 12, '2023-05-04 12:10:59', NULL, 'SI ESPERAS QUE TUS PJ\'S SOBREVIVAN SÍ ES IMPORYANTES, SI ES UNA PARTIDA MONOSESIÓN...NO PIERDAD EL TIEMPO, ANA'),
(34, 2, 2, '2023-05-04 12:12:45', NULL, 'YO PREFIERO SUBIR HUMANIDAD CON LOS PUNTOS DE XP'),
(35, 3, 12, '2023-05-08 16:24:30', NULL, 'Yo tebgo razon'),
(36, 10, 12, '2023-06-01 16:10:07', NULL, 'no se peleen que el troll aquí soy yo'),
(37, 10, 14, '2023-06-01 16:15:11', NULL, 'hola soy un troll super malo y aquí os doy consejos de cómo trollear con estilo para que tus jugarores no se enfaden sin motivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230328152414', '2023-03-28 17:24:22', 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `creadate` datetime DEFAULT NULL,
  `oculto` tinyint(1) DEFAULT NULL,
  `descripcion` longtext DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`id`, `creator_id`, `name`, `creadate`, `oculto`, `descripcion`, `foto`) VALUES
(1, 1, 'Foro de Vampiro La Mascarada: tercera edición', '2023-03-28 19:34:00', 0, 'Foro tope retro para poder intercambiar batallas de este mítico juego', 'Leonardo-Diffusion-a-beauty-skeletongirl-wearing-a-blue-neon-a-0-6442d228c0b63.jpg'),
(2, 3, 'Vampiro: Edad Oscura', '2023-03-29 17:58:23', 0, 'La Edad Media fue una época en la que los Vástagos eran concebidos como dioses...o como demonios.', 'Leonardo-Diffusion-Portrait-of-a-skeletoncat-wearing-a-fantas-1-1-6442d268a6e3c.jpg'),
(3, 1, 'Wraith: el Olvido', '2023-03-31 19:01:02', 0, 'El juego de la factoría para espectros con cuentas pendientes. Tus grilletes son tu condención y su vez, lo único que te impide caer en el Olvido.', 'Leonardo-Diffusion-a-cute-skeleton-littleboy-wearing-a-red-neo-3-6442d2945a675.jpg'),
(6, 3, 'Demon:The fallen', '2023-04-03 16:01:55', 0, 'Demonios¡', 'Leonardo-Diffusion-white-chimpanzee-pretty-yong-woman-wearing-2-6442d3326a8ee.jpg'),
(8, 3, 'Los Magos', '2023-04-03 16:44:37', 1, 'Como los Tremere pero, además los mata el tiempo', NULL),
(9, 2, 'Mundo de Tinieblas', '2023-04-05 14:51:56', 0, 'Aquí es donde se realizan las preguntas sobre las partidas de mundo de Tinieblas', 'Leonardo-Signature-The-moon-passing-through-the-glass-of-a-got-1-644642bfb07da.jpg'),
(10, 2, 'Miscelánea', '2023-04-05 17:45:19', 0, 'Todas las cuestiones que no caen en otro lado, entran aquí', 'Leonardo-Diffusion-river-of-blood-hyper-realistic-style-moon-1-644642fa2be17.jpg'),
(11, 2, 'Foro Prueba', '2023-04-13 19:35:23', 0, 'asdsadasd', 'Leonardo-Diffusion-a-cute-batchild-wearing-a-fire-and-silver-s-3-6442d1f13b44f.jpg'),
(12, 2, 'Foro Vampiro 5º ed', '2023-04-21 20:07:46', 0, 'Para los fans de la quinta edición del juego', 'Leonardo-Diffusion-red-rabbit-pretty-woman-wearing-a-french-sp-3-6442d0f2bc012.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `id` int(11) NOT NULL,
  `creatortema_id` int(11) DEFAULT NULL,
  `foro_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `creadate` datetime DEFAULT NULL,
  `oculto` tinyint(1) DEFAULT NULL,
  `descrition` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`id`, `creatortema_id`, `foro_id`, `title`, `creadate`, `oculto`, `descrition`) VALUES
(1, 1, 1, 'Iniciación de personajes', '2026-02-02 14:14:00', 0, 'Calentando motores'),
(2, 3, 1, 'Puntos de humanidad', '2026-02-09 09:13:00', NULL, NULL),
(4, 3, 3, 'El Mäeltrom', '2023-03-31 19:22:49', NULL, '¿Te has topado alguna vez con este evento calamitoso del Mundo de Tinieblas? Cuéntanos tu expriencia ¡'),
(5, 3, 2, 'Fé verdadera', '2023-03-31 20:16:22', NULL, 'Claves y enclaves para no toparse nunca con un pnj con fé verdadera. Corred por vuestras no vidas.'),
(6, 3, 6, 'Fe verdadera 2', '2023-04-03 16:14:52', NULL, 'Las implicaciones de los personajes con fe verdadera en Demon'),
(7, 3, 6, 'Aguita Bendita', '2023-04-03 16:36:47', 1, 'Cuidado que el agua hace más que mojar'),
(8, 3, 1, 'La Mano Negra', '2023-04-04 23:04:32', NULL, 'La fuerza del Sabbath'),
(9, 3, 8, 'Los Magos están Locos', '2023-04-05 13:42:01', NULL, 'Todo un debate'),
(10, 2, 9, 'El Manto en el mundo de tinieblas', '2023-04-05 14:53:21', NULL, 'Jugar con diversos personajes en el mundo de Tinieblas es posible, pero no fácil'),
(11, 3, 10, 'Fuego', '2023-04-05 17:46:59', NULL, 'El fuego afecta por igual  a todas las criaturas de mundo de Tinieblas?Eh, eh?'),
(12, 2, 1, 'el abrazo vamp', '2023-05-02 12:09:36', 0, 'cómo definir bien un pj con trasfondo'),
(13, 8, 2, 'la inquisición 2', '2023-05-02 18:20:58', NULL, 'descripción de la inquisición 2'),
(14, 10, 2, 'la importancia de trollear a tus jugadores con coherencia', '2023-06-01 16:13:59', NULL, 'la mala suerte ocurre, y unos contextos son más proclives que otros a ella. no los mates por matarlos, espera que la líen para elegir el momento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `email`, `avatar`, `banned`) VALUES
(1, 'user1', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$2y$13$GaqCtYR7enfIZ.sZcYJS.eoPLFoj0CkHM2JT2ymBI5CUiz541ZGPy', 'user1@user1.com', 'Leonardo_Diffusion_A_high_resolution_photo_of_a_wolf_wearing_3.jpg', NULL),
(2, 'pepe', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$2y$13$TKeSkDwXji24TGqqihs8F.wkAIFACprXd15aG81eLpF.zKfgntTSu', 'pepe@pepe.es', 'davinel-642451c7769ea.png', NULL),
(3, 'ana', '[]', '$2y$13$rwgqvSI.8Dqkfhh9YlYXq..ulRA61yv0Qpz3iAyYUXztWsEyF6fGS', 'ana@ana.es', 'killy-642454dd08b22.png', NULL),
(4, 'userfail', '{\"1\":\"ROLE_USER\",\"2\":\"ROLE_ADMIN\"}', '$2y$13$HoNZh3KbxMTP3mmGLg4Nd.D/7MPgoPE5RSwqtWOsSv49pTBO/4xDq', 'userfail@fail.com', 'lecter-6431ac4cd5cee.png', 1),
(5, 'lara', '[]', '$2y$13$5tyNffUrgXaCsrUgo7o3CeTO7fGseMYxcTclWkW7aEL7e6Bvv9z7u', 'lara@lara.es', 'Leonardo_Diffusion_MasterPiece_high_detail_a_prettyskeleton_w_3.jpg', NULL),
(6, 'lara2', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$2y$13$4SItwAmjabJU173bS34pQuNypRg01.BfzYNmQOtIghk9HuZXHItf6', 'lara@lara.es', 'CapturaCibo-6433fecd21d1c.png', NULL),
(7, 'olga', '[]', '$2y$13$OUqKwSUJbC9gFuvLMEN3N.PUgL.7sIAemzK3HpO8IRreOm72tXQ/2', 'olga@o.es', 'Diseno-sin-titulo-643421154f1e3.png', 1),
(8, 'pepinillo2', '[]', '$2y$13$CCyxQKVlmUSTTIzdzX9a2edIN0eKsoclgNMztnxC8hD5eettS5eNC', 'pepe@epe.es', 'Leonardo-Diffusion-a-cute-sheepchild-wearing-a-blue-and-silver-3-645129566fa57.jpg', NULL),
(9, 'sdf', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$2y$13$ksdVk/nI1MfMiKuGgdKY8usLSc..FW.ywbHd3PZzaBfCv8U08fMSe', 'dsf@ajshd.com', 'Leonardo-Diffusion-a-pretty-woman-patinted-like-Sally-Tim-Burt-1-2-r-6478a2709a994.jpg', NULL),
(10, 'trollsupermalo', '[]', '$2y$13$x0qomsBCsEtzmk504xNFX.QH8aBho89JLsweFHz5m5VyGkSJqG4Li', 'trollisgood@tr.com', 'Leonardo-Diffusion-Christmas-purple-Pikachu-happy-smiling-th-0-6478a65e1f3ee.jpg', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B91E702A76ED395` (`user_id`),
  ADD KEY `IDX_4B91E702A64A8A17` (`tema_id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BC869C6361220EA6` (`creator_id`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_61E3A538732FE009` (`creatortema_id`),
  ADD KEY `IDX_61E3A538F5FF53F6` (`foro_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `FK_4B91E702A64A8A17` FOREIGN KEY (`tema_id`) REFERENCES `tema` (`id`),
  ADD CONSTRAINT `FK_4B91E702A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `FK_BC869C6361220EA6` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `FK_61E3A538732FE009` FOREIGN KEY (`creatortema_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_61E3A538F5FF53F6` FOREIGN KEY (`foro_id`) REFERENCES `foro` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
