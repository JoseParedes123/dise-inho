-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2025 a las 17:49:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `samazon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `ID_Compra` int(11) NOT NULL,
  `ID_Usuario` int(11) DEFAULT NULL,
  `ID_Producto` int(11) DEFAULT NULL,
  `Cantidad_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID_Categoria` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID_Categoria`, `Nombre`) VALUES
(1, '[Electronica]'),
(2, '[Informatica]'),
(3, '[Hogar y cocina]'),
(4, '[Libros]'),
(5, '[Jugetes y juegos]'),
(6, '[Deportes]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_Producto` int(11) NOT NULL,
  `ID_Categoria` int(11) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `oferta` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_Producto`, `ID_Categoria`, `Nombre`, `Descripcion`, `Stock`, `Precio`, `oferta`) VALUES
(7, 1, 'Arduino UNO', 'Placa Programación Arduino Uno R3 Smd Atmega328 C/cable Usb', 50, 12299.00, 0),
(8, 1, 'Protoboard', 'Protoboard Experimental 400 Puntos 83x55 Arduino Electronica.', 50, 4700.00, 0),
(9, 1, 'Cables Para Macho Hembra 20cm Protoboard 40 Unidades', 'Kit de 40 cables tipo jumper macho-hembra de 20cm c/u. Cables flexibles de diferentes colores. Ideal para uso en protoboard, con arduino y prototipado en general.', 40, 3099.00, 0),
(10, 1, 'Sensor Distancia Ultrasonido Ultrasonico Sr04 Hc Arduino', 'El sensor HC-SR04 es una excelente opción como sensor de distancia ultrasónico. Su relación de costo/beneficio lo hace óptimo para un gran abanico de aplicaciones.', 20, 4099.00, 0),
(11, 1, 'Modulo Detector Sensor De Obstaculos Infrarrojo Pic Arduino', 'Este Modulo sensor infrarrojo emisor y receptor se puede adaptar a luz ambiente y a la distancia de deteccion de objetos a traves de un potenciometro que viene en su PCB, La distancia de deteccion puede variarse entre 2cm y 30cm.', 30, 3344.00, 0),
(12, 1, 'Kit 600 Resistencias 1/4 1% 30 Valores Diversos', 'Pack de 600 Resistencias 1/4 W •TOLERANCIA: 1 % .POTENCIA :1/4 W 30 Valores .20 unidades de cada una', 50, 13410.00, 0),
(1, 2, 'Computadora Gaming Pro', 'PC gaming de última generación con procesador Intel i7, 16GB RAM, SSD 1TB y tarjeta gráfica RTX 3060.', 10, 899999.00, 0),
(2, 2, 'Laptop Ultraligera', 'Portátil de 14 pulgadas, peso inferior a 1kg, batería de 12 horas y pantalla táctil Full HD.', 20, 749999.00, 0),
(3, 2, 'Tablet Multiusos', 'Tablet de 10 pulgadas con stylus incluido, ideal para trabajo creativo y entretenimiento.', 20, 399999.00, 0),
(4, 2, 'Monitor Curvo 32\"', 'Pantalla curva con resolución 4K, tasa de refresco 144Hz y tecnología FreeSync.', 10, 429990.00, 0),
(5, 2, 'Teclado Mecánico RGB', 'Teclado gaming con switches mecánicos, iluminación RGB personalizable y reposamuñecas.', 15, 89999.00, 0),
(6, 2, 'Ratón Inalámbrico', 'Ratón ergonómico con sensor de alta precisión, batería de larga duración y diseño ambidiestro.', 15, 49999.00, 0),
(13, 3, 'Cocina Pro', 'Cocina de 6 hornallas, horno eléctrico multifunción, encendido automático y grill.', 10, 899999.00, 0),
(14, 3, 'Bacha de cocina', 'Bacha doble de acero inoxidable 304, 85x50cm, con desagüe y accesorios incluidos.', 10, 249999.00, 0),
(15, 3, 'Licuadora', 'Licuadora de 1000W, jarra de vidrio 1.5L, 5 velocidades y función pulso.', 10, 79999.00, 0),
(16, 3, 'Horno', 'Horno eléctrico 60L, convección, luz interior, timer y 6 funciones de cocción.', 10, 299999.00, 0),
(17, 3, 'Microondas', 'Microondas digital 28L, 900W, 10 niveles de potencia, grill y descongelado rápido.', 10, 159999.00, 0),
(18, 3, 'Set de Cubiertos', 'Set 24 piezas acero inoxidable 18/10, incluye estuche organizador de madera.', 10, 89999.00, 0),
(19, 4, 'Odisea', 'Edición de lujo de la Odisea de Homero, tapa dura, traducción comentada y mapas ilustrados.', 10, 45999.00, 0),
(20, 4, 'El Principito', 'Edición bilingüe español-francés, ilustraciones originales restauradas, tapa dura.', 10, 29999.00, 0),
(21, 4, 'Alicia en el País de las Maravillas', 'Edición coleccionista con ilustraciones originales de John Tenniel, papel premium.', 10, 35999.00, 0),
(22, 4, 'Harry Potter Saga Completa', 'Box set de los 7 libros de Harry Potter, edición especial 25º aniversario.', 15, 199999.00, 0),
(23, 4, 'IT', 'Novela de Stephen King, edición especial con prólogo del autor y material extra.', 10, 39999.00, 0),
(24, 4, 'La Caída de Berlín', 'Libro histórico sobre la batalla final de la Segunda Guerra Mundial, con fotografías inéditas.', 15, 42999.00, 0),
(25, 5, 'Nintendo Switch', 'Consola Nintendo Switch OLED, incluye Joy-Con, dock para TV y 64GB de almacenamiento interno.', 15, 349999.00, 0),
(26, 5, 'Xbox Series X', 'Consola Xbox Series X con 1TB SSD, resolución 4K, hasta 120 FPS y ray tracing.', 15, 499999.00, 0),
(27, 5, 'Playstation 5', 'PS5 con lector de discos, control DualSense, SSD de 825GB y soporte para juegos en 4K.', 15, 499999.00, 0),
(28, 5, 'Juguete Muñeco Spiderman', 'Figura articulada de Spider-Man de 30cm, con 20 puntos de articulación y accesorios.', 15, 29999.00, 0),
(29, 5, 'Muñeco de Sonic', 'Peluche oficial de Sonic the Hedgehog, 25cm de altura, material suave y lavable.', 15, 24999.00, 0),
(30, 5, 'VideoJuego Atari', 'Consola Atari Flashback con 100 juegos clásicos preinstalados y 2 controles inalámbricos.', 15, 79999.00, 0),
(31, 6, 'Balón Primera división', 'Balón oficial de la Primera División, material sintético de alta calidad y costuras reforzadas.', 15, 899999.00, 0),
(32, 6, 'Balón de Basket', 'La Pelota de Basketball Baloncesto N7 de la marca RUMISH es la compañera ideal para tu pasión por el deporte. Con un tamaño 7 y una circunferencia de 24 cm', 15, 749999.00, 0),
(33, 6, 'Balón de Voley', 'El modelo ATTACK de NassaU está compuesto con PVC de alta resistencia y es cosido a máquina. A su vez, posee una textura suave y agradable al tacto.', 15, 399999.00, 0),
(34, 6, 'Pelota de beisbol', 'Pelota lisa de cuero sintetico para Softball y Beisbol. Ideal para tus entrenamientos y juegos. Núcleo de corcho. 24 cm de circunferencia. Peso aproximado de 147 grs.', 15, 429999.00, 0),
(35, 6, 'Raqueta de Tennis', 'Ideal para exhibir tu raqueta favorita o decorar tu ambiente si sos fanático de este deporte. Material: plástico Incluye los elementos para instalarlo.', 15, 89999.00, 0),
(36, 6, 'Camiseta Selección Argentina', 'Parte de un uniforme especial que conmemora el aniversario número 50 de la primera colaboración entre Argentina y adidas.', 15, 49999.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellido` varchar(100) DEFAULT NULL,
  `EMail` varchar(100) DEFAULT NULL,
  `Contraseña` varchar(50) DEFAULT NULL,
  `Numero_telefono` int(11) DEFAULT NULL,
  `DNI` int(9) NOT NULL,
  `Tarjeta` int(11) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `Nombre`, `Apellido`, `EMail`, `Contraseña`, `Numero_telefono`, `DNI`, `Tarjeta`, `edad`) VALUES
(1, 'dfd', 'dsfgjk', 'emmanuelvilla2008@gmail.com', '$2y$10$qIqN6thSv355QJVPonw0zOdEvp71osLsnFPdYplpM2C', 456, 3459, NULL, NULL),
(2, 'dfd', 'dsfgjk', 'emmanuelvilla2008@gmail.com', '$2y$10$uQDCossGUDG7Ccd.2GyasODibG2y.FR8/ZvPKN1srZZ', 456, 3459, NULL, NULL),
(3, '', '', '', '$2y$10$5ZvY6EFwhgQhjKO2.p4tz.2xxJAF0js30nkFbW.5bvP', 0, 0, NULL, NULL),
(4, 'BENJAMÍN', 'parede', 'spider-black@gmail.com', '$2y$10$WwDZRVKB2i91.ggXGdadEOdFEbZ837RT4LK1yo78e0A', 2147483647, 49384958, 28374859, 18),
(5, 'marcos', 'latella', 'maRCO._.OLIvaREs@gmail.com', '$2y$10$rizz799kaZnlBna4b9Qq2.JKcww9nJdyym/o.xf8wyJ', 2147483647, 49387594, 94839405, 18),
(6, 'eee', 'aaa', 'eeeaaa@gmail.com', '$2y$10$HS05OJq1Z6EwhG7UrurJKOdKZfwxScz3BZ5DeuvwUl8', 2147483647, 49389485, 38928473, 19),
(7, 'tt', 'aa', 'ttaa@gmail.com', '246813579', 2147483647, 493827483, 37819384, 20),
(8, 'emma', 'villa', 'emmavilla@gmail.com', '12345678', 2147483647, 49384954, 28940394, 20),
(9, 'alma', 'carena', 'lamacarena@gmail.com', '987654', 2147483647, 49387594, 20394052, 21);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`ID_Compra`),
  ADD KEY `ID_Usuario` (`ID_Usuario`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_Categoria`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_Producto`),
  ADD KEY `ID_Categoria` (`ID_Categoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `ID_Compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID_Producto`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`ID_Categoria`) REFERENCES `categoria` (`ID_Categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
