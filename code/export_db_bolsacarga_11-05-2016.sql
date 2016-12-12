-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2016 a las 23:25:39
-- Versión del servidor: 6.0.4
-- Versión de PHP: 6.0.0-dev

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `servicio_carga`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `account`
-- 

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `Muser` varchar(45) NOT NULL,
  `Mpassword` varchar(250) NOT NULL,
  `salt` varchar(80) NOT NULL,
  `usertype` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `account`
-- 

INSERT INTO `account` VALUES (1, 'drigox90rih@gmail.com', 'c8a00ff8f99a223d43b8c602f61c99fef310cb6e', 'F3HCCZHMVH', '0');
INSERT INTO `account` VALUES (2, 'rodrigo.ediaz.f@gmail.com', 'dc4add83cb36fc98c586364ca342feffe7bb46df', 'CET2Q2OT1L', '1');
INSERT INTO `account` VALUES (3, 'rodiaz@openmailbox.org', 'dc4add83cb36fc98c586364ca342feffe7bb46df', 'CET2Q2OT1L', '2');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `calculo_distancia_ciudades`
-- 

CREATE TABLE IF NOT EXISTS `calculo_distancia_ciudades` (
  `idciudad1` int(11) NOT NULL,
  `idciudad2` int(11) NOT NULL,
  `distancia` int(10) NOT NULL,
  KEY `idciudad1` (`idciudad1`,`idciudad2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Relacion de distancia entre ciudades';

-- 
-- Volcar la base de datos para la tabla `calculo_distancia_ciudades`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `camion`
-- 

CREATE TABLE IF NOT EXISTS `camion` (
  `idcamion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patente` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `anio` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `toneladas` int(10) NOT NULL,
  `idchofer_fk` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idcamion`),
  KEY `idchofer_fk` (`idchofer_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Datos Camion = Equipo' AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `camion`
-- 

INSERT INTO `camion` VALUES (1, 'ZS47A4', '2013', 'Camion Rampla', 23, 2);
INSERT INTO `camion` VALUES (3, 'PL235R', '2015', 'Camioncito', 2, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `chofer`
-- 

CREATE TABLE IF NOT EXISTS `chofer` (
  `idchofer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `RUT` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `idtransportista_fk` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idchofer`),
  KEY `idtransportista` (`idtransportista_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Datos Chofer' AUTO_INCREMENT=5 ;

-- 
-- Volcar la base de datos para la tabla `chofer`
-- 

INSERT INTO `chofer` VALUES (1, 'Esteban', 'Flores', '134657255-', '569123544635', 1);
INSERT INTO `chofer` VALUES (2, 'Pepe', 'Popa', '6661999-6', '34654367', 1);
INSERT INTO `chofer` VALUES (4, 'Otros', 'Choferes', '345678-9', '34567323', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ciudad`
-- 

CREATE TABLE IF NOT EXISTS `ciudad` (
  `idciudad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `latitud` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitud` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idregion_fk` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idciudad`),
  KEY `idregion_fk` (`idregion_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Ciudades por region' AUTO_INCREMENT=723 ;

-- 
-- Volcar la base de datos para la tabla `ciudad`
-- 

INSERT INTO `ciudad` VALUES (377, 'Iquique', NULL, NULL, 1);
INSERT INTO `ciudad` VALUES (378, 'Alto Hospicio', NULL, NULL, 1);
INSERT INTO `ciudad` VALUES (379, 'Pozo Almonte', NULL, NULL, 1);
INSERT INTO `ciudad` VALUES (380, 'Camiña', NULL, NULL, 1);
INSERT INTO `ciudad` VALUES (381, 'Colchane', NULL, NULL, 1);
INSERT INTO `ciudad` VALUES (382, 'Huara', NULL, NULL, 1);
INSERT INTO `ciudad` VALUES (383, 'Pica', NULL, NULL, 1);
INSERT INTO `ciudad` VALUES (384, 'Antofagasta', NULL, NULL, 2);
INSERT INTO `ciudad` VALUES (385, 'Mejillones', NULL, NULL, 2);
INSERT INTO `ciudad` VALUES (386, 'Sierra Gorda', NULL, NULL, 2);
INSERT INTO `ciudad` VALUES (387, 'Taltal', NULL, NULL, 2);
INSERT INTO `ciudad` VALUES (388, 'Calama', NULL, NULL, 2);
INSERT INTO `ciudad` VALUES (389, 'Ollagüe', NULL, NULL, 2);
INSERT INTO `ciudad` VALUES (390, 'San Pedro de Atacama', NULL, NULL, 2);
INSERT INTO `ciudad` VALUES (391, 'Tocopilla', NULL, NULL, 2);
INSERT INTO `ciudad` VALUES (392, 'Maria Elena', NULL, NULL, 2);
INSERT INTO `ciudad` VALUES (393, 'Copiapo', NULL, NULL, 3);
INSERT INTO `ciudad` VALUES (394, 'Caldera', NULL, NULL, 3);
INSERT INTO `ciudad` VALUES (395, 'Tierra Amarilla', NULL, NULL, 3);
INSERT INTO `ciudad` VALUES (396, 'Chañaral', NULL, NULL, 3);
INSERT INTO `ciudad` VALUES (397, 'Diego de Almagro', NULL, NULL, 3);
INSERT INTO `ciudad` VALUES (398, 'Vallenar', NULL, NULL, 3);
INSERT INTO `ciudad` VALUES (399, 'Alto del Carmen', NULL, NULL, 3);
INSERT INTO `ciudad` VALUES (400, 'Freirina', NULL, NULL, 3);
INSERT INTO `ciudad` VALUES (401, 'Huasco', NULL, NULL, 3);
INSERT INTO `ciudad` VALUES (402, 'La Serena', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (403, 'Coquimbo', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (404, 'Andacollo', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (405, 'La Higuera', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (406, 'Paihuano', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (407, 'Vicuña', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (408, 'Illapel', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (409, 'Canela', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (410, 'Los Vilos', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (411, 'Salamanca', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (412, 'Ovalle', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (413, 'Combarbala', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (414, 'Monte Patria', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (415, 'Punitaqui', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (416, 'Rio Hurtado', NULL, NULL, 4);
INSERT INTO `ciudad` VALUES (417, 'Valparaiso', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (418, 'Casablanca', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (419, 'Concon', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (420, 'Juan Fernandez', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (421, 'Puchuncavi', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (422, 'Quintero', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (423, 'Viña del Mar', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (424, 'Isla de Pascua', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (425, 'Los Andes', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (426, 'Calle Larga', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (427, 'Rinconada', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (428, 'San Esteban', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (429, 'La Ligua', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (430, 'Cabildo', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (431, 'Papudo', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (432, 'Petorca', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (433, 'Zapallar', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (434, 'Quillota', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (435, 'La Calera', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (436, 'Hijuelas', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (437, 'La Cruz', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (438, 'Nogales', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (439, 'San Antonio', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (440, 'Algarrobo', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (441, 'Cartagena', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (442, 'El Quisco', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (443, 'El Tabo', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (444, 'Santo Domingo', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (445, 'San Felipe', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (446, 'Catemu', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (447, 'Llay Llay', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (448, 'Panquehue', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (449, 'Putaendo', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (450, 'Santa Maria', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (451, 'Quilpue', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (452, 'Limache', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (453, 'Olmue', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (454, 'Villa Alemana', NULL, NULL, 5);
INSERT INTO `ciudad` VALUES (455, 'Rancagua', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (456, 'Codegua', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (457, 'Coinco', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (458, 'Coltauco', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (459, 'Doñihue', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (460, 'Graneros', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (461, 'Las Cabras', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (462, 'Machali', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (463, 'Malloa', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (464, 'Mostazal', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (465, 'Olivar', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (466, 'Peumo', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (467, 'Pichidegua', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (468, 'Quinta de Tilcoco', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (469, 'Rengo', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (470, 'Requinoa', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (471, 'San Vicente', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (472, 'Pichilemu', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (473, 'La Estrella', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (474, 'Litueche', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (475, 'Marchihue', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (476, 'Navidad', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (477, 'Paredones', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (478, 'San Fernando', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (479, 'Chepica', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (480, 'Chimbarongo', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (481, 'Lolol', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (482, 'Nancagua', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (483, 'Palmilla', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (484, 'Peralillo', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (485, 'Placilla', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (486, 'Pumanque', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (487, 'Santa Cruz', NULL, NULL, 6);
INSERT INTO `ciudad` VALUES (488, 'Talca', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (489, 'Constitucion', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (490, 'Curepto', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (491, 'Empedrado', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (492, 'Maule', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (493, 'Pelarco', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (494, 'Pencahue', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (495, 'Rio Claro', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (496, 'San Clemente', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (497, 'San Rafael', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (498, 'Cauquenes', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (499, 'Chanco', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (500, 'Pelluhue', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (501, 'Curico', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (502, 'Hualañe', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (503, 'Licanten', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (504, 'Molina', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (505, 'Rauco', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (506, 'Romeral', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (507, 'Sagrada Familia', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (508, 'Teno', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (509, 'Vichuquen', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (510, 'Linares', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (511, 'Colbun', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (512, 'Longavi', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (513, 'Parral', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (514, 'Retiro', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (515, 'San Javier', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (516, 'Villa Alegre', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (517, 'Yerbas Buenas', NULL, NULL, 7);
INSERT INTO `ciudad` VALUES (518, 'Concepcion', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (519, 'Coronel', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (520, 'Chiguayante', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (521, 'Florida', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (522, 'Hualqui', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (523, 'Lota', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (524, 'Penco', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (525, 'San Pedro de la Paz', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (526, 'Santa Juana', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (527, 'Talcahuano', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (528, 'Tome', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (529, 'Hualpen', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (530, 'Lebu', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (531, 'Arauco', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (532, 'Cañete', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (533, 'Contulmo', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (534, 'Curanilahue', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (535, 'Los alamos', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (536, 'Tirua', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (537, 'Los angeles', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (538, 'Antuco', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (539, 'Cabrero', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (540, 'Laja', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (541, 'Mulchen', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (542, 'Nacimiento', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (543, 'Negrete', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (544, 'Quilaco', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (545, 'Quilleco', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (546, 'San Rosendo', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (547, 'Santa Barbara', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (548, 'Tucapel', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (549, 'Yumbel', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (550, 'Alto Biobio', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (551, 'Chillan', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (552, 'Bulnes', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (553, 'Cobquecura', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (554, 'Coelemu', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (555, 'Coihueco', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (556, 'Chillan Viejo', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (557, 'El Carmen', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (558, 'Ninhue', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (559, 'Ñiquen', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (560, 'Pemuco', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (561, 'Pinto', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (562, 'Portezuelo', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (563, 'Quillon', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (564, 'Quirihue', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (565, 'Ranquil', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (566, 'San Carlos', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (567, 'San Fabian', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (568, 'San Ignacio', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (569, 'San Nicolas', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (570, 'Treguaco', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (571, 'Yungay', NULL, NULL, 8);
INSERT INTO `ciudad` VALUES (572, 'Temuco', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (573, 'Carahue', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (574, 'Cunco', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (575, 'Curarrehue', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (576, 'Freire', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (577, 'Galvarino', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (578, 'Gorbea', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (579, 'Lautaro', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (580, 'Loncoche', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (581, 'Melipeuco', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (582, 'Nueva Imperial', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (583, 'Padre las Casas', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (584, 'Perquenco', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (585, 'Pitrufquen', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (586, 'Pucon', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (587, 'Saavedra', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (588, 'Teodoro Schmidt', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (589, 'Tolten', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (590, 'Vilcun', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (591, 'Villarrica', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (592, 'Cholchol', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (593, 'Angol', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (594, 'Collipulli', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (595, 'Curacautin', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (596, 'Ercilla', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (597, 'Lonquimay', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (598, 'Los Sauces', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (599, 'Lumaco', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (600, 'Puren', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (601, 'Renaico', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (602, 'Traiguen', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (603, 'Victoria', NULL, NULL, 9);
INSERT INTO `ciudad` VALUES (604, 'Puerto Montt', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (605, 'Calbuco', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (606, 'Cochamo', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (607, 'Fresia', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (608, 'Frutillar', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (609, 'Los Muermos', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (610, 'Llanquihue', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (611, 'Maullin', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (612, 'Puerto Varas', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (613, 'Castro', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (614, 'Ancud', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (615, 'Chonchi', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (616, 'Curaco de Velez', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (617, 'Dalcahue', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (618, 'Puqueldon', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (619, 'Queilen', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (620, 'Quellon', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (621, 'Quemchi', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (622, 'Quinchao', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (623, 'Osorno', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (624, 'Puerto Octay', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (625, 'Purranque', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (626, 'Puyehue', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (627, 'Rio Negro', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (628, 'San Juan de la Costa', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (629, 'San Pablo', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (630, 'Chaiten', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (631, 'Futaleufu', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (632, 'Hualaihue', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (633, 'Palena', NULL, NULL, 10);
INSERT INTO `ciudad` VALUES (634, 'Coyhaique', NULL, NULL, 11);
INSERT INTO `ciudad` VALUES (635, 'Lago Verde', NULL, NULL, 11);
INSERT INTO `ciudad` VALUES (636, 'Aysen', NULL, NULL, 11);
INSERT INTO `ciudad` VALUES (637, 'Cisnes', NULL, NULL, 11);
INSERT INTO `ciudad` VALUES (638, 'Guaitecas', NULL, NULL, 11);
INSERT INTO `ciudad` VALUES (639, 'Cochrane', NULL, NULL, 11);
INSERT INTO `ciudad` VALUES (640, 'OHiggins', NULL, NULL, 11);
INSERT INTO `ciudad` VALUES (641, 'Tortel', NULL, NULL, 11);
INSERT INTO `ciudad` VALUES (642, 'Chile Chico', NULL, NULL, 11);
INSERT INTO `ciudad` VALUES (643, 'Rio Ibañez', NULL, NULL, 11);
INSERT INTO `ciudad` VALUES (644, 'Punta Arenas', NULL, NULL, 12);
INSERT INTO `ciudad` VALUES (645, 'Laguna Blanca', NULL, NULL, 12);
INSERT INTO `ciudad` VALUES (646, 'Rio Verde', NULL, NULL, 12);
INSERT INTO `ciudad` VALUES (647, 'San Gregorio', NULL, NULL, 12);
INSERT INTO `ciudad` VALUES (648, 'Cabo de Hornos', NULL, NULL, 12);
INSERT INTO `ciudad` VALUES (649, 'Antartica', NULL, NULL, 12);
INSERT INTO `ciudad` VALUES (650, 'Porvenir', NULL, NULL, 12);
INSERT INTO `ciudad` VALUES (651, 'Primavera', NULL, NULL, 12);
INSERT INTO `ciudad` VALUES (652, 'Timaukel', NULL, NULL, 12);
INSERT INTO `ciudad` VALUES (653, 'Natales', NULL, NULL, 12);
INSERT INTO `ciudad` VALUES (654, 'Torres del Paine', NULL, NULL, 12);
INSERT INTO `ciudad` VALUES (655, 'Santiago', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (656, 'Cerrillos', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (657, 'Cerro Navia', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (658, 'Conchali', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (659, 'El Bosque', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (660, 'Estacion Central', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (661, 'Huechuraba', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (662, 'Independencia', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (663, 'La Cisterna', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (664, 'La Florida', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (665, 'La Granja', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (666, 'La Pintana', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (667, 'La Reina', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (668, 'Las Condes', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (669, 'Lo Barnechea', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (670, 'Lo Espejo', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (671, 'Lo Prado', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (672, 'Macul', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (673, 'Maipu', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (674, 'Ñuñoa', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (675, 'Pedro Aguirre Cerda', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (676, 'Peñalolen', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (677, 'Providencia', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (678, 'Pudahuel', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (679, 'Quilicura', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (680, 'Quinta Normal', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (681, 'Recoleta', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (682, 'Renca', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (683, 'San Joaquin', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (684, 'San Miguel', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (685, 'San Ramon', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (686, 'Vitacura', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (687, 'Puente Alto', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (688, 'Pirque', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (689, 'San Jose de Maipo', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (690, 'Colina', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (691, 'Lampa', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (692, 'Tiltil', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (693, 'San Bernardo', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (694, 'Buin', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (695, 'Calera de Tango', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (696, 'Paine', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (697, 'Melipilla', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (698, 'Alhue', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (699, 'Curacavi', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (700, 'Maria Pinto', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (701, 'San Pedro', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (702, 'Talagante', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (703, 'El Monte', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (704, 'Isla de Maipo', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (705, 'Padre Hurtado', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (706, 'Peñaflor', NULL, NULL, 13);
INSERT INTO `ciudad` VALUES (707, 'Valdivia', NULL, NULL, 14);
INSERT INTO `ciudad` VALUES (708, 'Corral', NULL, NULL, 14);
INSERT INTO `ciudad` VALUES (709, 'Lanco', NULL, NULL, 14);
INSERT INTO `ciudad` VALUES (710, 'Los Lagos', NULL, NULL, 14);
INSERT INTO `ciudad` VALUES (711, 'Mafil', NULL, NULL, 14);
INSERT INTO `ciudad` VALUES (712, 'Mariquina', NULL, NULL, 14);
INSERT INTO `ciudad` VALUES (713, 'Paillaco', NULL, NULL, 14);
INSERT INTO `ciudad` VALUES (714, 'Panguipulli', NULL, NULL, 14);
INSERT INTO `ciudad` VALUES (715, 'La Union', NULL, NULL, 14);
INSERT INTO `ciudad` VALUES (716, 'Futrono', NULL, NULL, 14);
INSERT INTO `ciudad` VALUES (717, 'Lago Ranco', NULL, NULL, 14);
INSERT INTO `ciudad` VALUES (718, 'Rio Bueno', NULL, NULL, 14);
INSERT INTO `ciudad` VALUES (719, 'Arica', NULL, NULL, 15);
INSERT INTO `ciudad` VALUES (720, 'Camarones', NULL, NULL, 15);
INSERT INTO `ciudad` VALUES (721, 'Putre', NULL, NULL, 15);
INSERT INTO `ciudad` VALUES (722, 'General Lagos', NULL, NULL, 15);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `empresa`
-- 

CREATE TABLE IF NOT EXISTS `empresa` (
  `idempresa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RUT` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giro` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fono` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_representante_legal` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rut_representante_legal` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_representante_legal` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idaccount` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idempresa`),
  KEY `idaccount` (`idaccount`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Datos Empresa' AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `empresa`
-- 

INSERT INTO `empresa` VALUES (1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2);
INSERT INTO `empresa` VALUES (2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `generadorcarga`
-- 

CREATE TABLE IF NOT EXISTS `generadorcarga` (
  `idgeneradorcarga` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idaccount` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idgeneradorcarga`),
  KEY `idaccount` (`idaccount`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Generador Carga asociada al tipo de cuenta' AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `generadorcarga`
-- 

INSERT INTO `generadorcarga` VALUES (1, 3);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `match_ofertas`
-- 

CREATE TABLE IF NOT EXISTS `match_ofertas` (
  `idmatch` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idofertacarga` int(10) unsigned NOT NULL,
  `idofertatransportista` int(10) unsigned NOT NULL,
  `estado_oferta` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `orden_carga` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idmatch`),
  KEY `idofertatransportista` (`idofertatransportista`),
  KEY `idofertacarga` (`idofertacarga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Match entre las ofertas habilitadas' AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `match_ofertas`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ofertacarga`
-- 

CREATE TABLE IF NOT EXISTS `ofertacarga` (
  `idofertacarga` int(11) NOT NULL AUTO_INCREMENT,
  `origen_region` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `origen_ciudad` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `origen_direccion` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `destino_region` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `destino_ciudad` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `destino_direccion` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `distancia` int(10) NOT NULL,
  `fecha_carga` date NOT NULL,
  `fecha_descarga` date NOT NULL,
  `cantidad_carga` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_carga` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_camion` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `detalle` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `idgeneradorcarga_fk` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idofertacarga`),
  KEY `idgeneradorcarga_fk` (`idgeneradorcarga_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Oferta de Cargas para Transportar' AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `ofertacarga`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ofertatransportista`
-- 

CREATE TABLE IF NOT EXISTS `ofertatransportista` (
  `idofertatransportista` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patente` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_camion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ubicacion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `destino_preferente` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_disponibilidad` date NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `idtransportista_fk` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idofertatransportista`),
  KEY `idtransportista_fk` (`idtransportista_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Oferta de Transportistas disponibles' AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `ofertatransportista`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `region`
-- 

CREATE TABLE IF NOT EXISTS `region` (
  `idregion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `latitud` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitud` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idregion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Regiones de Chile' AUTO_INCREMENT=16 ;

-- 
-- Volcar la base de datos para la tabla `region`
-- 

INSERT INTO `region` VALUES (1, 'Tarapaca', '1', NULL, NULL);
INSERT INTO `region` VALUES (2, 'Antofagasta', '2', NULL, NULL);
INSERT INTO `region` VALUES (3, 'Atacama', '3', NULL, NULL);
INSERT INTO `region` VALUES (4, 'Coquimbo', '4', NULL, NULL);
INSERT INTO `region` VALUES (5, 'Valparaiso', '5', NULL, NULL);
INSERT INTO `region` VALUES (6, 'Region del Libertador Gral. Bernardo OHiggins', '6', NULL, NULL);
INSERT INTO `region` VALUES (7, 'Region del Maule', '7', NULL, NULL);
INSERT INTO `region` VALUES (8, 'Region del Biobio', '8', NULL, NULL);
INSERT INTO `region` VALUES (9, 'Region de la Araucania', '9', NULL, NULL);
INSERT INTO `region` VALUES (10, 'Region de Los Lagos', '10', NULL, NULL);
INSERT INTO `region` VALUES (11, 'Region Aisen del Gral. Carlos Ibañez del Campo', '11', NULL, NULL);
INSERT INTO `region` VALUES (12, 'Region de Magallanes y de la Antartica Chilena', '12', NULL, NULL);
INSERT INTO `region` VALUES (13, 'Region Metropolitana de Santiago', '13', NULL, NULL);
INSERT INTO `region` VALUES (14, 'Region de Los Rios', '14', NULL, NULL);
INSERT INTO `region` VALUES (15, 'Arica y Parinacota', '15', NULL, NULL);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `transportista`
-- 

CREATE TABLE IF NOT EXISTS `transportista` (
  `idtransportista` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idaccount` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idtransportista`),
  KEY `idaccount` (`idaccount`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Transportista asociado al tipo de cuenta' AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `transportista`
-- 

INSERT INTO `transportista` VALUES (1, 2);

-- 
-- Filtros para las tablas descargadas (dump)
-- 

-- 
-- Filtros para la tabla `camion`
-- 
ALTER TABLE `camion`
  ADD CONSTRAINT `camion_ibfk_1` FOREIGN KEY (`idchofer_fk`) REFERENCES `chofer` (`idchofer`) ON DELETE NO ACTION ON UPDATE CASCADE;

-- 
-- Filtros para la tabla `chofer`
-- 
ALTER TABLE `chofer`
  ADD CONSTRAINT `chofer_ibfk_1` FOREIGN KEY (`idtransportista_fk`) REFERENCES `transportista` (`idtransportista`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Filtros para la tabla `ciudad`
-- 
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`idregion_fk`) REFERENCES `region` (`idregion`) ON DELETE NO ACTION ON UPDATE CASCADE;

-- 
-- Filtros para la tabla `empresa`
-- 
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`idaccount`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

-- 
-- Filtros para la tabla `match_ofertas`
-- 
ALTER TABLE `match_ofertas`
  ADD CONSTRAINT `match_ofertas_ibfk_1` FOREIGN KEY (`idofertatransportista`) REFERENCES `ofertatransportista` (`idofertatransportista`) ON DELETE NO ACTION ON UPDATE CASCADE;

-- 
-- Filtros para la tabla `ofertacarga`
-- 
ALTER TABLE `ofertacarga`
  ADD CONSTRAINT `ofertacarga_ibfk_1` FOREIGN KEY (`idgeneradorcarga_fk`) REFERENCES `generadorcarga` (`idgeneradorcarga`) ON DELETE NO ACTION ON UPDATE CASCADE;

-- 
-- Filtros para la tabla `ofertatransportista`
-- 
ALTER TABLE `ofertatransportista`
  ADD CONSTRAINT `ofertatransportista_ibfk_1` FOREIGN KEY (`idtransportista_fk`) REFERENCES `transportista` (`idtransportista`) ON DELETE NO ACTION ON UPDATE CASCADE;

-- 
-- Filtros para la tabla `transportista`
-- 
ALTER TABLE `transportista`
  ADD CONSTRAINT `transportista_ibfk_1` FOREIGN KEY (`idaccount`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
