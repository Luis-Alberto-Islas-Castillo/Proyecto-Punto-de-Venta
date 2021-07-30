-- Volcando estructura para tabla miscelanea.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla miscelanea.categorias: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `categoria`) VALUES
	(1, 'Marinela'),
	(2, 'Bebidas'),
	(3, 'Bimbo'),
	(4, 'Danone'),
	(5, 'Sabritas'),
	(6, 'Barcel'),
	(7, 'Bonafont'),
	(8, 'Gamesa'),
	(9, 'Lara'),
	(10, 'Totis'),
	(11, 'Abarrotes'),
	(12, 'Bebidas Alcoholicas');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla miscelanea.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  `compras` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla miscelanea.clientes: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `nombre`, `compras`) VALUES
	(1, 'Fernando Reyes', NULL),
	(2, 'Carmen Trejo', NULL),
	(3, 'Raul Jimenez', NULL),
	(4, 'Erika Rodriguez', NULL),
	(5, 'Juana Hernandez', NULL),
	(6, 'Ruben Perez', NULL),
	(7, 'Vicente Juarez', NULL),
	(8, 'Ramon Herrera', NULL),
	(9, 'Rosario Flores', NULL);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Volcando estructura para tabla miscelanea.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) DEFAULT NULL,
  `codigo` text,
  `descripcion` text,
  `imagen` text,
  `stock` int(11) DEFAULT NULL,
  `precio_compra` float DEFAULT NULL,
  `precio_venta` float DEFAULT NULL,
  `ventas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla miscelanea.productos: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id`, `id_categoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `ventas`) VALUES
	(1, 3, '101', 'Bimbuñoelos', 'views/img/productos/default/default.svg', 20, 13.12, 16, NULL),
	(2, 3, '102', 'Colchones', 'views/img/productos/default/default.svg', 20, 8.25, 10, NULL),
	(3, 3, '103', 'Donas 4p', 'views/img/productos/default/default.svg', 20, 9.84, 12, NULL),
	(4, 3, '104', 'Donos Azucaradas 6p', 'views/img/productos/default/default.svg', 20, 13.12, 16, NULL),
	(5, 3, '105', 'Mantecadas 6p', 'views/img/productos/default/default.svg', 20, 16.41, 20, NULL),
	(6, 1, '201', 'Barritas de Fresa', 'views/img/productos/default/default.svg', 20, 4.2, 5, NULL),
	(7, 1, '202', 'Bombonete', 'views/img/productos/default/default.svg', 20, 6.72, 8, NULL),
	(8, 1, '203', 'Trikitrakes', 'views/img/productos/default/default.svg', 20, 8.31, 9.972, NULL),
	(9, 2, '301', 'Coca 3L', 'Views/img/productos/default/default.svg', 20, 33, 39.6, NULL),
	(10, 2, '302', 'Coca 2L', 'views/img/productos/default/default.svg', 20, 20, 24, NULL),
	(11, 1, '204', 'Galletas Principe', 'views/img/productos/default/default.svg', 20, 11, 18.2, NULL),
	(12, 1, '205', 'Galletas Principe Limon', 'views/img/productos/default/default.svg', 20, 10, 14, NULL),
	(13, 1, '206', 'Barritas Piña', 'views/img/productos/206/811.jpg', 20, 3, 4.2, NULL);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla miscelanea.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  `usuario` text,
  `password` text,
  `perfil` text,
  `foto` text,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla miscelanea.usuarios: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`) VALUES
	(1, 'Norma Castillo', 'Norma', '$2a$07$usesomesillystringforeh13SwIG2YuGjH7WNZPTqAnpzOR7aksC', 'Administrador', 'views/img/usuarios/Norma/572.png', 1),
	(2, 'Luis Alberto', 'Luis', '$2a$07$usesomesillystringforeh13SwIG2YuGjH7WNZPTqAnpzOR7aksC', 'Encargado', 'views/img/usuarios/Luis/371.png', 1),
	(3, 'Juan Escorcia', 'Juan', '$2a$07$usesomesillystringfore3o3rgMihtU6XL7uuIsCWlL9jT3ZH/Wa', 'Administrador', 'views/img/usuarios/Juan/306.png', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla miscelanea.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text NOT NULL,
  `impuesto` float NOT NULL DEFAULT '0',
  `neto` float NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0',
  `metodo_pago` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla miscelanea.ventas: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` (`id`, `codigo`, `id_cliente`, `id_vendedor`, `productos`, `impuesto`, `neto`, `total`, `metodo_pago`, `fecha`) VALUES
	(0, 10, 1, 1, '[{"id":"1","descripcion":"Bimbuñoelos","cantidad":"1","stock":"9","precio":"16","total":"16"}]', 0, 16, 16, 'Efectivo', '2021-07-27 20:13:38');
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
