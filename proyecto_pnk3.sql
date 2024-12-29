-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 29, 2024 at 04:39 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyecto_pnk3`
--

-- --------------------------------------------------------

--
-- Table structure for table `comunas`
--

DROP TABLE IF EXISTS `comunas`;
CREATE TABLE IF NOT EXISTS `comunas` (
  `idcomunas` int NOT NULL AUTO_INCREMENT,
  `comuna` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `idprovincias` int NOT NULL,
  PRIMARY KEY (`idcomunas`,`idprovincias`),
  KEY `fk_comunas_provincias1_idx` (`idprovincias`)
) ENGINE=InnoDB AUTO_INCREMENT=347 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `comunas`
--

INSERT INTO `comunas` (`idcomunas`, `comuna`, `estado`, `idprovincias`) VALUES
(1, 'Iquique', 1, 1),
(2, 'Alto Hospicio', 1, 1),
(3, 'Pozo Almonte', 1, 2),
(4, 'Cami–a', 1, 2),
(5, 'Colchane', 1, 2),
(6, 'Huara', 1, 2),
(7, 'Pica', 1, 2),
(8, 'Antofagasta', 1, 3),
(9, 'Mejillones', 1, 3),
(10, 'Sierra Gorda', 1, 3),
(11, 'Taltal', 1, 3),
(12, 'Calama', 1, 4),
(13, 'Ollague', 1, 4),
(14, 'San Pedro De Atacama', 1, 4),
(15, 'Tocopilla', 1, 5),
(16, 'Mar’a Elena', 1, 5),
(17, 'Copiap—', 1, 6),
(18, 'Caldera', 1, 6),
(19, 'Tierra Amarilla', 1, 6),
(20, 'Cha–aral', 1, 7),
(21, 'Diego De Almagro', 1, 7),
(22, 'Vallenar', 1, 8),
(23, 'Alto Del Carmen', 1, 8),
(24, 'Freirina', 1, 8),
(25, 'Huasco', 1, 8),
(26, 'La Serena', 1, 9),
(27, 'Coquimbo', 1, 9),
(28, 'Andacollo', 1, 9),
(29, 'La Higuera', 1, 9),
(30, 'Paiguano', 1, 9),
(31, 'Vicu–a', 1, 9),
(32, 'Illapel', 1, 10),
(33, 'Canela', 1, 10),
(34, 'Los Vilos', 1, 10),
(35, 'Salamanca', 1, 10),
(36, 'Ovalle', 1, 11),
(37, 'Combarbal‡', 1, 11),
(38, 'Monte Patria', 1, 11),
(39, 'Punitaqui', 1, 11),
(40, 'R’o Hurtado', 1, 11),
(41, 'Valpara’so', 1, 12),
(42, 'Casablanca', 1, 12),
(43, 'Conc—n', 1, 12),
(44, 'Juan Fern‡ndez', 1, 12),
(45, 'Puchuncav’', 1, 12),
(46, 'Quintero', 1, 12),
(47, 'Vi–a Del Mar', 1, 12),
(48, 'Isla De Pascua', 1, 13),
(49, 'Los Andes', 1, 14),
(50, 'Calle Larga', 1, 14),
(51, 'Rinconada', 1, 14),
(52, 'San Esteban', 1, 14),
(53, 'La Ligua', 1, 15),
(54, 'Cabildo', 1, 15),
(55, 'Papudo', 1, 15),
(56, 'Petorca', 1, 15),
(57, 'Zapallar', 1, 15),
(58, 'Quillota', 1, 16),
(59, 'Calera', 1, 16),
(60, 'Hijuelas', 1, 16),
(61, 'La Cruz', 1, 16),
(62, 'Nogales', 1, 16),
(63, 'San Antonio', 1, 17),
(64, 'Algarrobo', 1, 17),
(65, 'Cartagena', 1, 17),
(66, 'El Quisco', 1, 17),
(67, 'El Tabo', 1, 17),
(68, 'Santo Domingo', 1, 17),
(69, 'San Felipe', 1, 18),
(70, 'Catemu', 1, 18),
(71, 'Llaillay', 1, 18),
(72, 'Panquehue', 1, 18),
(73, 'Putaendo', 1, 18),
(74, 'Santa Mar’a', 1, 18),
(75, 'QuilpuŽ', 1, 19),
(76, 'Limache', 1, 19),
(77, 'OlmuŽ', 1, 19),
(78, 'Villa Alemana', 1, 19),
(79, 'Rancagua', 1, 20),
(80, 'Codegua', 1, 20),
(81, 'Coinco', 1, 20),
(82, 'Coltauco', 1, 20),
(83, 'Do–ihue', 1, 20),
(84, 'Graneros', 1, 20),
(85, 'Las Cabras', 1, 20),
(86, 'Machali', 1, 20),
(87, 'Malloa', 1, 20),
(88, 'Mostazal', 1, 20),
(89, 'El Olivar', 1, 20),
(90, 'Peumo', 1, 20),
(91, 'Pichidegua', 1, 20),
(92, 'Quinta De Tilcoco', 1, 20),
(93, 'Rengo', 1, 20),
(94, 'Requinoa', 1, 20),
(95, 'San Vicente', 1, 20),
(96, 'Pichilemu', 1, 21),
(97, 'La Estrella', 1, 21),
(98, 'Litueche', 1, 21),
(99, 'Marchihue', 1, 21),
(100, 'Navidad', 1, 21),
(101, 'Paredones', 1, 21),
(102, 'San Fernando', 1, 22),
(103, 'ChŽpica', 1, 22),
(104, 'Chimbarongo', 1, 22),
(105, 'Lolol', 1, 22),
(106, 'Nancagua', 1, 22),
(107, 'Palmilla', 1, 22),
(108, 'Peralillo', 1, 22),
(109, 'Placilla', 1, 22),
(110, 'Pumanque', 1, 22),
(111, 'Santa Cruz', 1, 22),
(112, 'Talca', 1, 23),
(113, 'Constituci—n', 1, 23),
(114, 'Curepto', 1, 23),
(115, 'Empedrado', 1, 23),
(116, 'Maule', 1, 23),
(117, 'Pelarco', 1, 23),
(118, 'Pencahue', 1, 23),
(119, 'R’o Claro', 1, 23),
(120, 'San Clemente', 1, 23),
(121, 'San Rafael', 1, 23),
(122, 'Cauquenes', 1, 24),
(123, 'Chanco', 1, 24),
(124, 'Pelluhue', 1, 24),
(125, 'Curic—', 1, 25),
(126, 'Huala–e', 1, 25),
(127, 'LicantŽn', 1, 25),
(128, 'Molina', 1, 25),
(129, 'Rauco', 1, 25),
(130, 'Romeral', 1, 25),
(131, 'Sagrada Familia', 1, 25),
(132, 'Teno', 1, 25),
(133, 'VichuquŽn', 1, 25),
(134, 'Linares', 1, 26),
(135, 'Colbœn', 1, 26),
(136, 'Longav’', 1, 26),
(137, 'Parral', 1, 26),
(138, 'Retiro', 1, 26),
(139, 'San Javier', 1, 26),
(140, 'Villa Alegre', 1, 26),
(141, 'Yerbas Buenas', 1, 26),
(142, 'Concepci—n', 1, 27),
(143, 'Coronel', 1, 27),
(144, 'Chiguayante', 1, 27),
(145, 'Florida', 1, 27),
(146, 'Hualqui', 1, 27),
(147, 'Lota', 1, 27),
(148, 'Penco', 1, 27),
(149, 'San Pedro de la Paz', 1, 27),
(150, 'Santa Juana', 1, 27),
(151, 'Talcahuano', 1, 27),
(152, 'TomŽ', 1, 27),
(153, 'HualpŽn', 1, 27),
(154, 'Lebu', 1, 28),
(155, 'Arauco', 1, 28),
(156, 'Ca–ete', 1, 28),
(157, 'Contulmo', 1, 28),
(158, 'Curanilahue', 1, 28),
(159, 'Los Alamos', 1, 28),
(160, 'Tirua', 1, 28),
(161, 'Los Angeles', 1, 29),
(162, 'Antuco', 1, 29),
(163, 'Cabrero', 1, 29),
(164, 'Laja', 1, 29),
(165, 'MulchŽn', 1, 29),
(166, 'Nacimiento', 1, 29),
(167, 'Negrete', 1, 29),
(168, 'Quilaco', 1, 29),
(169, 'Quilleco', 1, 29),
(170, 'San Rosendo', 1, 29),
(171, 'Santa B‡rbara', 1, 29),
(172, 'Tucapel', 1, 29),
(173, 'Yumbel', 1, 29),
(174, 'Alto Biob’o', 1, 29),
(175, 'Chill‡n', 1, 30),
(176, 'Bulnes', 1, 30),
(177, 'Cobquecura', 1, 30),
(178, 'Coelemu', 1, 30),
(179, 'Coihueco', 1, 30),
(180, 'Chill‡n Viejo', 1, 30),
(181, 'El Carmen', 1, 30),
(182, 'Ninhue', 1, 30),
(183, '„iquŽn', 1, 30),
(184, 'Pemuco', 1, 30),
(185, 'Pinto', 1, 30),
(186, 'Portezuelo', 1, 30),
(187, 'Quill—n', 1, 30),
(188, 'Quirihue', 1, 30),
(189, 'Ranquil', 1, 30),
(190, 'San Carlos', 1, 30),
(191, 'San Fabi‡n', 1, 30),
(192, 'San Ignacio', 1, 30),
(193, 'San Nicol‡s', 1, 30),
(194, 'Treguaco', 1, 30),
(195, 'Yungay', 1, 30),
(196, 'Temuco', 1, 31),
(197, 'Carahue', 1, 31),
(198, 'Cunco', 1, 31),
(199, 'Curarrehue', 1, 31),
(200, 'Freire', 1, 31),
(201, 'Galvarino', 1, 31),
(202, 'Gorbea', 1, 31),
(203, 'Lautaro', 1, 31),
(204, 'Loncoche', 1, 31),
(205, 'Melipeuco', 1, 31),
(206, 'Nueva Imperial', 1, 31),
(207, 'Padre Las Casas', 1, 31),
(208, 'Perquenco', 1, 31),
(209, 'PitrufquŽn', 1, 31),
(210, 'Puc—n', 1, 31),
(211, 'Saavedra', 1, 31),
(212, 'Teodoro Schmidt', 1, 31),
(213, 'ToltŽn', 1, 31),
(214, 'Vilcœn', 1, 31),
(215, 'Villarrica', 1, 31),
(216, 'Cholchol', 1, 31),
(217, 'Angol', 1, 32),
(218, 'Collipulli', 1, 32),
(219, 'Curacaut’n', 1, 32),
(220, 'Ercilla', 1, 32),
(221, 'Lonquimay', 1, 32),
(222, 'Los Sauces', 1, 32),
(223, 'Lumaco', 1, 32),
(224, 'Puren', 1, 32),
(225, 'Renaico', 1, 32),
(226, 'TraiguŽn', 1, 32),
(227, 'Victoria', 1, 32),
(228, 'Puerto Montt', 1, 33),
(229, 'Calbuco', 1, 33),
(230, 'Cocham—', 1, 33),
(231, 'Fresia', 1, 33),
(232, 'Frutillar', 1, 33),
(233, 'Los Muermos', 1, 33),
(234, 'Llanquihue', 1, 33),
(235, 'Maull’n', 1, 33),
(236, 'Puerto Varas', 1, 33),
(237, 'Castro', 1, 34),
(238, 'Ancud', 1, 34),
(239, 'Chonchi', 1, 34),
(240, 'Curaco de Velez', 1, 34),
(241, 'Dalcahue', 1, 34),
(242, 'Puqueld—n', 1, 34),
(243, 'QueilŽn', 1, 34),
(244, 'Quell—n', 1, 34),
(245, 'Quemchi', 1, 34),
(246, 'Quinchao', 1, 34),
(247, 'Osorno', 1, 35),
(248, 'Puerto Octay', 1, 35),
(249, 'Purranque', 1, 35),
(250, 'Puyehue', 1, 35),
(251, 'R’o Negro', 1, 35),
(252, 'San Juan de la Costa', 1, 35),
(253, 'San Pablo', 1, 35),
(254, 'ChaitŽn', 1, 36),
(255, 'Futaleufœ', 1, 36),
(256, 'Hualaihue', 1, 36),
(257, 'Palena', 1, 36),
(258, 'Coihayque', 1, 37),
(259, 'Lago Verde', 1, 37),
(260, 'AisŽn', 1, 38),
(261, 'Cisnes', 1, 38),
(262, 'Guaitecas', 1, 38),
(263, 'Cochrane', 1, 39),
(264, 'OHiggins', 1, 39),
(265, 'Tortel', 1, 39),
(266, 'Chile Chico', 1, 40),
(267, 'R’o Ib‡–ez', 1, 40),
(268, 'Punta Arenas', 1, 41),
(269, 'Laguna Blanca', 1, 41),
(270, 'R’o Verde', 1, 41),
(271, 'San Gregorio', 1, 41),
(272, 'Cabo de Hornos', 1, 42),
(273, 'Ant‡rtica', 1, 42),
(274, 'Porvenir', 1, 43),
(275, 'Primavera', 1, 43),
(276, 'Timaukel', 1, 43),
(277, 'Natales', 1, 44),
(278, 'Torres del Paine', 1, 44),
(279, 'Santiago', 1, 45),
(280, 'Cerrillos', 1, 45),
(281, 'Cerro Navia', 1, 45),
(282, 'Conchal’', 1, 45),
(283, 'El Bosque', 1, 45),
(284, 'Estaci—n Central', 1, 45),
(285, 'Huechuraba', 1, 45),
(286, 'Independencia', 1, 45),
(287, 'La Cisterna', 1, 45),
(288, 'La Florida', 1, 45),
(289, 'La Granja', 1, 45),
(290, 'La Pintana', 1, 45),
(291, 'La Reina', 1, 45),
(292, 'Las Condes', 1, 45),
(293, 'Lo Barnechea', 1, 45),
(294, 'Lo Espejo', 1, 45),
(295, 'Lo Prado', 1, 45),
(296, 'Macul', 1, 45),
(297, 'Maipœ', 1, 45),
(298, '„u–oa', 1, 45),
(299, 'Pedro Aguirre Cerda', 1, 45),
(300, 'Pe–alolŽn', 1, 45),
(301, 'Providencia', 1, 45),
(302, 'Pudahuel', 1, 45),
(303, 'Quilicura', 1, 45),
(304, 'Quinta Normal', 1, 45),
(305, 'Recoleta', 1, 45),
(306, 'Renca', 1, 45),
(307, 'San Joaqu’n', 1, 45),
(308, 'San Miguel', 1, 45),
(309, 'San Ram—n', 1, 45),
(310, 'Vitacura', 1, 45),
(311, 'Puente Alto', 1, 46),
(312, 'Pirque', 1, 46),
(313, 'San JosŽ De Maipo', 1, 46),
(314, 'Colina', 1, 47),
(315, 'Lampa', 1, 47),
(316, 'Tiltil', 1, 47),
(317, 'San Bernardo', 1, 48),
(318, 'Buin', 1, 48),
(319, 'Calera De Tango', 1, 48),
(320, 'Paine', 1, 48),
(321, 'Melipilla', 1, 49),
(322, 'AlhuŽ', 1, 49),
(323, 'Curacav’', 1, 49),
(324, 'Mar’a Pinto', 1, 49),
(325, 'San Pedro', 1, 49),
(326, 'Talagante', 1, 50),
(327, 'El Monte', 1, 50),
(328, 'Isla De Maipo', 1, 50),
(329, 'Padre Hurtado', 1, 50),
(330, 'Pe–aflor', 1, 50),
(331, 'Valdivia', 1, 51),
(332, 'Corral', 1, 51),
(333, 'Lanco', 1, 51),
(334, 'Los Lagos', 1, 51),
(335, 'M‡fil', 1, 51),
(336, 'Mariquina', 1, 51),
(337, 'Paillaco', 1, 51),
(338, 'Panguipulli', 1, 51),
(339, 'La Uni—n', 1, 52),
(340, 'Futrono', 1, 52),
(341, 'Lago Ranco', 1, 52),
(342, 'R’o Bueno', 1, 52),
(343, 'Arica', 1, 53),
(344, 'Camarones', 1, 53),
(345, 'Putre', 1, 54),
(346, 'General Lagos', 1, 54);

-- --------------------------------------------------------

--
-- Table structure for table `fotografias`
--

DROP TABLE IF EXISTS `fotografias`;
CREATE TABLE IF NOT EXISTS `fotografias` (
  `idfotografias` int NOT NULL AUTO_INCREMENT,
  `Foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `principal` int DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `idpropiedad` int NOT NULL,
  PRIMARY KEY (`idfotografias`,`idpropiedad`),
  KEY `fk_fotografias_propiedad1_idx` (`idpropiedad`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `fotografias`
--

INSERT INTO `fotografias` (`idfotografias`, `Foto`, `principal`, `estado`, `idpropiedad`) VALUES
(3, 'casa2.jpg', 1, 1, 2),
(4, 'casa.jpg', 1, 1, 9),
(5, 'casa.jpg', 0, 1, 2),
(7, 'departamento1.png', 1, 1, 11),
(8, 'casa3.jpg', 1, 1, 27),
(9, 'casa.jpg', 1, 1, 28),
(10, 'casa2.jpg', 0, 1, 28),
(11, 'casa3.jpg', 0, 1, 28),
(12, 'terreno1.jpg', 1, 1, 29),
(13, 'casa(1).jpg', 1, 1, 30),
(14, 'terreno3.jpg', 1, 1, 41),
(17, 'terreno2.jpg', 1, 1, 33),
(18, 'casa3.jpg', 1, 1, 45),
(19, 'casa.jpg', 1, 1, 46),
(23, 'perro.jpg', 1, 1, 50),
(25, 'departamento1.png', 1, 1, 52);

-- --------------------------------------------------------

--
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
CREATE TABLE IF NOT EXISTS `propiedades` (
  `idpropiedad` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(70) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `Descripcion` varchar(20000) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `Direccion` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `Precio` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `cant_banos` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `cant_dorm` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `areaTotal_terreno` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `areaConstruida` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fechaPublicacion` date NOT NULL,
  `estado` int DEFAULT NULL,
  `idsector` int NOT NULL,
  `id_usuario` int NOT NULL,
  `tipo_propiedad` int NOT NULL,
  `idregion` int DEFAULT NULL,
  `idprovincias` int DEFAULT NULL,
  `idcomunas` int DEFAULT NULL,
  PRIMARY KEY (`idpropiedad`,`idsector`,`id_usuario`),
  KEY `fk_propiedad_sector1_idx` (`idsector`),
  KEY `fk_propiedades_usuarios1_idx` (`id_usuario`),
  KEY `fk_region` (`idregion`),
  KEY `fk_provincia` (`idprovincias`),
  KEY `fk_comuna` (`idcomunas`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `propiedades`
--

INSERT INTO `propiedades` (`idpropiedad`, `nombre`, `Descripcion`, `Direccion`, `Precio`, `cant_banos`, `cant_dorm`, `areaTotal_terreno`, `areaConstruida`, `fechaPublicacion`, `estado`, `idsector`, `id_usuario`, `tipo_propiedad`, `idregion`, `idprovincias`, `idcomunas`) VALUES
(2, 'Casa en la Folorida La Serena', 'casa 5para 6 personas', 'Calle Arquitecto - C. Andres Murillo 1490, 1720340 La Serena, Coquimbo', '5400000', '1', '2', '3', '4', '2024-06-22', 1, 1, 517, 1, 4, 9, 26),
(9, 'd', 'das', 'dsa', '321', '', '', '', '', '2024-06-05', 1, 3, 519, 2, 4, 9, 27),
(11, 'departamento para 1 persona', 'depa para 1 persona, esta feo', '4 esquinas la serena', '312000', '1', '1', '123', '123', '2024-06-17', 1, 1, 517, 2, 4, 9, 26),
(27, 'Casa en la Folorida La Serena', 'casa hasta para 6 personas', 'Andres Murillo 1490 Colina el pino', '75000000', '2', '3', '300', '270', '2024-06-18', 1, 1, 517, 1, 4, 9, 26),
(28, 'casa endgame', 'casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas casa para 6 personas', 'Calle Andres Murillo', '5476500', '3', '1', '23451', '12354', '2021-06-22', 1, 5, 517, 1, 4, 9, 31),
(29, 'dsadas', '5', 'dsadsa', '321312', '1', '2', '3', '4', '2024-06-22', 1, 3, 519, 3, 4, 9, 27),
(30, 'Matias Araya Olivares', 'depa para 1 persona, esta feo', 'Calle Andres Murillo 1490', '540000', '1', '1', '1223', '1223', '2024-06-22', 1, 4, 519, 1, 4, 9, 31),
(33, 'terreno de 100.000 m2', 'terreno', 'donde ud. decida', '10000000000', '0', '0', '100000', '0', '2024-06-23', 1, 4, 519, 3, 4, 9, 31),
(41, 'dsadsa', '312312', 'Ruta D-359 SAN ISIDRO - VICUÑA Vicuña, 1760000 Coquimbo', '3121', '0', '0', '0', '0', '2024-06-23', 1, 4, 519, 3, 4, 9, 31),
(45, 'casa de prueba React', 'React', 'Ruta D-359 SAN ISIDRO - VICUÑA Vicuña, 1760000 Coquimbo', '3121', '1', '12', '3', '4', '2024-07-08', 1, 4, 519, 1, 4, 9, 31),
(46, 'REACT', 'casa 5para 6 personas', 'Calle Arquitecto - C. Andres Murillo 1490, 1720340 La Serena, Coquimbo', '5400000', '1', '2', '3', '4', '2024-06-22', 1, 1, 517, 1, 4, 9, 26),
(50, 'REACT', 'REACT REACT REACT REACT REACT REACT REACT REACTREACT REACT REACT REACTREACT REACT REACT REACT REACT REACT REACT REACTREACT REACT REACT REACT REACT REACT REACT REACT REACT REACT REACT REACT REACT REACT REACT REACTREACT REACT REACT REACT REACT REACT REACT  REACT REACT REACT  REACT REACT REACT  REACT REACT REACT  REACT REACT REACT  REACT REACT REACT  REACT REACT REACT \r\n', 'Calle Arquitecto - C. Andres Murillo 1490, 1720340 La Serena, Coquimbo', '5400000', '1', '2', '3', '4', '2024-06-22', 1, 1, 517, 1, 4, 9, 26),
(51, 'Matias Araya Olivares', 'dxvgbhinjok', 'Calle Andres Murillo 1490', '540000', '1', '11', '1', '1', '2024-07-10', 1, 3, 517, 2, NULL, NULL, NULL),
(52, 'depa desde creacion prop', 'depa para 1 persona, esta feo', 'Calle Andres Murillo 1490', '5400000', '2', '2', '2', '2', '2024-07-10', 1, 1, 517, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `provincias`
--

DROP TABLE IF EXISTS `provincias`;
CREATE TABLE IF NOT EXISTS `provincias` (
  `idprovincias` int NOT NULL AUTO_INCREMENT,
  `provincia` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `idregion` int NOT NULL,
  PRIMARY KEY (`idprovincias`,`idregion`),
  KEY `fk_provincias_region_idx` (`idregion`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `provincias`
--

INSERT INTO `provincias` (`idprovincias`, `provincia`, `estado`, `idregion`) VALUES
(1, 'Iquique', 1, 1),
(2, 'Tamarugal', 1, 1),
(3, 'Antofagasta', 1, 2),
(4, 'El Loa', 1, 2),
(5, 'Tocopilla', 1, 2),
(6, 'Copiapó', 1, 3),
(7, 'Chañaral', 1, 3),
(8, 'Huasco', 1, 3),
(9, 'Elqui', 1, 4),
(10, 'Choapa', 1, 4),
(11, 'Limarí', 1, 4),
(12, 'Valparaíso', 1, 5),
(13, 'Isla De Pascua', 1, 5),
(14, 'Los Andes', 1, 5),
(15, 'Petorca', 1, 5),
(16, 'Quillota', 1, 5),
(17, 'San Antonio', 1, 5),
(18, 'San Felipe', 1, 5),
(19, 'Marga Marga', 1, 5),
(20, 'Cachapoal', 1, 6),
(21, 'Cardenal Caro', 1, 6),
(22, 'Colchagua', 1, 6),
(23, 'Talca', 1, 7),
(24, 'Cauquenes', 1, 7),
(25, 'Curicó', 1, 7),
(26, 'Linares', 1, 7),
(27, 'Concepción', 1, 8),
(28, 'Arauco', 1, 8),
(29, 'Bío-Bío', 1, 8),
(30, 'Ñuble', 1, 8),
(31, 'Cautín', 1, 9),
(32, 'Malleco', 1, 9),
(33, 'Llanquihue', 1, 10),
(34, 'Chiloé', 1, 10),
(35, 'Osorno', 1, 10),
(36, 'Palena', 1, 10),
(37, 'Coihayque', 1, 11),
(38, 'Aisén', 1, 11),
(39, 'Capitán Prat', 1, 11),
(40, 'General Carrera', 1, 11),
(41, 'Magallanes', 1, 12),
(42, 'Antártica Chilena', 1, 12),
(43, 'Tierra del Fuego', 1, 12),
(44, 'Última Esperanza', 1, 12),
(45, 'Santiago', 1, 13),
(46, 'Cordillera', 1, 13),
(47, 'Chacabuco', 1, 13),
(48, 'Maipo', 1, 13),
(49, 'Melipilla', 1, 13),
(50, 'Talagante', 1, 13),
(51, 'Valdivia', 1, 14),
(52, 'Ranco', 1, 14),
(53, 'Arica', 1, 15),
(54, 'Parinacota', 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `idregion` int NOT NULL AUTO_INCREMENT,
  `region` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`idregion`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`idregion`, `region`, `estado`) VALUES
(1, 'Tarapacá', 1),
(2, 'Antofagasta', 1),
(3, 'Atacama', 1),
(4, 'Coquimbo', 1),
(5, 'Valparaíso', 1),
(6, 'Libertador General Bernardo OHiggins', 1),
(7, 'Maule', 1),
(8, 'Biobío', 1),
(9, 'La Araucanía', 1),
(10, 'Los Lagos', 1),
(11, 'Aysén del General Carlos Ibáñez del Campo', 1),
(12, 'Magallanes y de la Antártica Chilena', 1),
(13, 'Metropolitana de Santiago', 1),
(14, 'Los Ríos', 1),
(15, 'Arica y Parinacota', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

DROP TABLE IF EXISTS `sector`;
CREATE TABLE IF NOT EXISTS `sector` (
  `idsector` int NOT NULL AUTO_INCREMENT,
  `sector` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `idcomunas` int NOT NULL,
  PRIMARY KEY (`idsector`,`idcomunas`),
  KEY `fk_sector_comunas1_idx` (`idcomunas`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`idsector`, `sector`, `estado`, `idcomunas`) VALUES
(1, 'La Florida', 1, 26),
(2, 'Las Compañias', 1, 26),
(3, 'Bosque San Carlos', 1, 27),
(4, 'Diaguitas', 1, 31),
(5, 'Valle del Elqui', 1, 31),
(6, 'Peñuelas', 1, 27);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_propiedad`
--

DROP TABLE IF EXISTS `tipo_propiedad`;
CREATE TABLE IF NOT EXISTS `tipo_propiedad` (
  `idtipo_propiedad` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`idtipo_propiedad`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipo_propiedad`
--

INSERT INTO `tipo_propiedad` (`idtipo_propiedad`, `tipo`, `estado`) VALUES
(1, 'Casa', 1),
(2, 'Departamento', 1),
(3, 'Terreno', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id_tipo` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo`, `tipo`, `estado`) VALUES
(1, 'ADMINISTRADOR', 1),
(2, 'PROPIETARIO', 1),
(3, 'VENDEDOR', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `imgPerfil` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `rut` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `telefono` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `contrasena` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `antecedentes` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `propiedades` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `sexo` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `id_tipo` int DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=530 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `imgPerfil`, `rut`, `email`, `telefono`, `nombre`, `contrasena`, `antecedentes`, `propiedades`, `nacimiento`, `sexo`, `estado`, `id_tipo`) VALUES
(517, 'IMG_7376(1).JPG', '20.460.248-4', 'maraya@gmail.com', '33131', 'Matias Araya Olivares', 'c8837b23ff8aaa8a2dde915473ce0991', NULL, '1', '2000-07-03', 'Hombre', 1, 1),
(519, 'cute octopus.png', '20127233-5', 'raraya@gmail.com', '2147483647', 'Rodrigo Araya Olivares', 'c8837b23ff8aaa8a2dde915473ce0991', NULL, NULL, '2014-02-26', 'Hombre', 1, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comunas`
--
ALTER TABLE `comunas`
  ADD CONSTRAINT `fk_comunas_provincias1` FOREIGN KEY (`idprovincias`) REFERENCES `provincias` (`idprovincias`);

--
-- Constraints for table `fotografias`
--
ALTER TABLE `fotografias`
  ADD CONSTRAINT `fk_fotografias_propiedad1` FOREIGN KEY (`idpropiedad`) REFERENCES `propiedades` (`idpropiedad`);

--
-- Constraints for table `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `fk_comuna` FOREIGN KEY (`idcomunas`) REFERENCES `comunas` (`idcomunas`),
  ADD CONSTRAINT `fk_propiedad_sector1` FOREIGN KEY (`idsector`) REFERENCES `sector` (`idsector`),
  ADD CONSTRAINT `fk_propiedades_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `fk_provincia` FOREIGN KEY (`idprovincias`) REFERENCES `provincias` (`idprovincias`),
  ADD CONSTRAINT `fk_region` FOREIGN KEY (`idregion`) REFERENCES `region` (`idregion`);

--
-- Constraints for table `provincias`
--
ALTER TABLE `provincias`
  ADD CONSTRAINT `fk_provincias_region` FOREIGN KEY (`idregion`) REFERENCES `region` (`idregion`);

--
-- Constraints for table `sector`
--
ALTER TABLE `sector`
  ADD CONSTRAINT `fk_sector_comunas1` FOREIGN KEY (`idcomunas`) REFERENCES `comunas` (`idcomunas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
