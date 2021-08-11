-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-08-2021 a las 22:34:21
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ppt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners`
--

CREATE TABLE `banners` (
  `ID` int(11) NOT NULL,
  `ruta` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `banners`
--

INSERT INTO `banners` (`ID`, `ruta`) VALUES
(1, 'public/img/Banner1.jpg'),
(2, 'public/img/Banner2.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campo_dinamico`
--

CREATE TABLE `campo_dinamico` (
  `ID` int(11) NOT NULL,
  `label` varchar(75) NOT NULL,
  `tipo` varchar(75) NOT NULL,
  `requerido` int(1) NOT NULL,
  `opcion` varchar(200) DEFAULT NULL,
  `Activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `campo_dinamico`
--

INSERT INTO `campo_dinamico` (`ID`, `label`, `tipo`, `requerido`, `opcion`, `Activo`) VALUES
(1, 'numero', 'radio', 1, '4,5,6,7,8', 1),
(2, 'test3', 'select', 1, 'rojo,azul,amarillo', 0),
(3, 'test4', 'checkbox', 1, '5,6,7,8', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(15) NOT NULL,
  `Mostrar` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID`, `Nombre`, `Mostrar`) VALUES
(1, 'Auricular', 1),
(2, 'Teclado', 1),
(3, 'Mouse', 1),
(4, 'Gamepad', 1),
(9, 'Silla', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `DNI` int(11) NOT NULL,
  `Imagen_Perfil` varchar(150) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellido` varchar(15) NOT NULL,
  `Correo` varchar(75) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `ID_Perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`DNI`, `Imagen_Perfil`, `Nombre`, `Apellido`, `Correo`, `Contraseña`, `ID_Perfil`) VALUES
(0, '', 'Anonimo', '', '', '', 1),
(1, 'dog.jpg', 'admin', 'admin', 'admin@gmail.com', '$2y$10$2PtRQ2Y9S3/m33ZExOKxZeF6mi3AQUgg6bHhwF/paaQXIbont3Dva', 4),
(343, 'car.png', 'Test', 'test', 'test@gmail.com', '$2y$10$k2pFO0uo6oZCC/23arBLSOf5bw43d3kWDlX5wkmO/WbBNd7K0ZFl.', 3),
(12345678, 'tank.jpg', 'Gabs', 'Lopez', 'test16@gmail.com', '$2y$10$yBiLagRx92jIigkdrXsZhe2VF7HqmO4dOQ6zdWF65VgJM2096ARsS', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `ID` bigint(15) NOT NULL,
  `Comentario` varchar(255) NOT NULL,
  `Valoracion` int(2) NOT NULL,
  `Fecha` datetime NOT NULL,
  `ID_Producto` int(2) NOT NULL,
  `ID_Cliente` int(11) NOT NULL,
  `Ip` varchar(15) NOT NULL,
  `Mostrar` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`ID`, `Comentario`, `Valoracion`, `Fecha`, `ID_Producto`, `ID_Cliente`, `Ip`, `Mostrar`) VALUES
(20210502185415, 'Muy Buenos me encantaron!!', 5, '2021-05-02 13:54:15', 1, 12345678, '', 1),
(20210502191813, 'Excelente Producto!!!!', 4, '2021-05-02 14:18:13', 1, 343, '', 1),
(20210502191838, 'Excelente para jugar!!!', 5, '2021-05-02 14:18:38', 2, 343, '', 0),
(20210607012903, 'test 2 de ip', 5, '2021-06-06 20:29:03', 1, 0, '192.168.56.1', 1),
(20210630064215, 'Muy bueno lo recomiendo', 5, '2021-06-30 01:42:16', 2, 0, '192.168.56.1', 1),
(20210701024927, 'muy bueno ', 5, '2021-06-30 21:49:27', 1, 0, '192.168.56.1', 1),
(20210720025709, 'Prueba 1 del insert con los campos dinamicos', 5, '2021-07-19 21:57:09', 1, 0, '192.168.56.1', 1),
(20210807195713, 'excelente teclado', 4, '2021-08-07 14:57:13', 2, 0, '192.168.56.1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condicion`
--

CREATE TABLE `condicion` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(15) NOT NULL,
  `Mostrar` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `condicion`
--

INSERT INTO `condicion` (`ID`, `Nombre`, `Mostrar`) VALUES
(1, 'Nuevo', 1),
(2, 'Destacado', 1),
(3, 'Proximamente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `celular` int(15) NOT NULL,
  `area` varchar(30) NOT NULL,
  `mensaje` varchar(50) NOT NULL,
  `fechaContacto` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`nombre`, `apellido`, `email`, `celular`, `area`, `mensaje`, `fechaContacto`) VALUES
('', '', '', 0, '', '', 0),
('Gato', 'Perro', 'gatoperro@gmail.com', 15565611, 'rrhh', 'asfasgasgaga', 20210504212059),
('test', 'test1', 'test@gmail.com', 15565611, 'ventas', 'prueba del insert del contacto', 20210806012522);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especificacion`
--

CREATE TABLE `especificacion` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especificacion`
--

INSERT INTO `especificacion` (`ID`, `Nombre`) VALUES
(1, 'Tipo de salida'),
(2, 'Tipo de copa'),
(3, 'Material Diadema'),
(4, 'Tipo de cable'),
(5, 'Diametro del diafragma'),
(6, 'Vibración'),
(7, 'Peso'),
(8, 'Arquitectura'),
(9, 'Tipo Switch'),
(10, 'Teclas Multimedia'),
(11, 'Dimensiones'),
(12, 'Resistente a salpicaduras'),
(13, 'Retroiluminación'),
(14, 'Tipo de conector'),
(15, 'Sensor Óptico'),
(16, 'Sensibilidad'),
(17, 'Cable Speedflex'),
(18, 'Botones'),
(19, 'Switches'),
(20, 'Iluminación'),
(21, 'Modelo'),
(22, 'Color'),
(23, 'Bluethoot'),
(24, 'Inalámbrico'),
(25, 'Touchpad'),
(26, 'Textura'),
(27, 'Conector para auriculares'),
(28, 'Velocidad USB'),
(29, 'Longitud de cable '),
(30, 'Efectos de luz'),
(31, 'Velocidad de sondeo'),
(32, 'Anti-ghosting multitecla'),
(33, 'Patrón de captación de micrófono'),
(34, 'Micrófono'),
(35, 'Respuesta de frecuencia'),
(36, 'Impedancia'),
(37, 'Sensibilidad'),
(38, 'Tamaño de cable'),
(39, 'Duración del switch'),
(40, 'Aceleración'),
(41, 'Grabación de macros'),
(42, 'Capacidad de Bateria'),
(43, 'Tiempo de carga'),
(44, 'Compatibilidad'),
(45, 'Tiempo de uso'),
(46, 'Indicadores LED'),
(47, 'Tamaño del clip para smartphone'),
(48, 'Orientación'),
(49, 'Reposa Muñecas'),
(50, 'Transductores'),
(51, 'Entrega de energía máxima'),
(52, 'Controladores'),
(57, 'especificación_test');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esp_descripcion`
--

CREATE TABLE `esp_descripcion` (
  `ID` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `ID_Especificacion` int(11) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Mostrar` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `esp_descripcion`
--

INSERT INTO `esp_descripcion` (`ID`, `ID_Producto`, `ID_Especificacion`, `Descripcion`, `Mostrar`) VALUES
(1, 1, 1, 'Stereo', 1),
(2, 1, 2, 'Circumaurales: Este tipo de auriculares se coloca rodeando completamente la oreja. Tacto suave y con aislamiento pasivo', 1),
(3, 1, 3, 'Metálica, flexible. Integrada a la estructura', 1),
(4, 1, 4, '2 m Engomado de alta resistencia.', 1),
(5, 1, 5, '50 mm con imanes de neodimio', 1),
(6, 1, 6, 'Si. Motor de vibración 30 mm', 1),
(7, 1, 7, '450 gr', 1),
(8, 2, 8, 'Mecánico', 1),
(9, 2, 9, 'Outemu Blue, táctil con click audible, fuerza de actuación 50 gr', 1),
(10, 2, 10, 'Si, a tráves de tecla FN', 1),
(11, 2, 11, '37.5×15.5×4.3 cm', 1),
(12, 2, 12, 'Sí', 1),
(13, 2, 13, 'RGB', 1),
(14, 2, 14, 'USB', 1),
(15, 2, 7, '1.06 kg', 1),
(16, 7, 33, 'Cardioide (unidireccional)', 0),
(17, 3, 15, 'Focus+ con 20 000 PPP', 1),
(18, 3, 16, 'niveles predeterminados: 400/800/1600/2400/3200', 1),
(19, 3, 17, '2,1 m/7 pies', 1),
(20, 3, 18, 'Ocho Hyperesponse programables de forma independiente', 1),
(21, 3, 19, 'Ópticos para ratón Razer™ con una duración de hasta 70 millones de clics', 1),
(22, 3, 11, '127,0 mm/5 pulgadas (largo) x 61,7 mm/2,43 pulgadas (ancho de agarre) x 42,7 mm/1,68 pulgadas (alto)', 1),
(23, 3, 20, 'Razer Chroma™ RGB con 16,8 millones de colores reales personalizables', 1),
(24, 3, 7, '82 g/2,9 oz (sin el cable)', 1),
(25, 4, 21, 'Xbox Series X/S Wireless Controller', 0),
(26, 4, 22, 'Carbon Black', 0),
(27, 4, 23, 'Sí', 0),
(28, 4, 24, 'Sí', 0),
(29, 4, 25, 'No', 0),
(30, 4, 6, 'No', 0),
(31, 4, 26, 'Antiderrape', 0),
(32, 4, 27, 'Estéreo de 3,5 mm', 0),
(33, 5, 8, 'Mecánico', 0),
(34, 5, 13, 'RGB (5 zonas) Lightsync', 0),
(35, 5, 19, 'Mech Dome', 0),
(36, 5, 12, 'Sí', 0),
(37, 5, 28, 'Máxima', 0),
(38, 5, 29, '1,8 m', 0),
(39, 5, 4, 'USB 2.0', 0),
(40, 5, 7, '1000 g', 0),
(41, 6, 8, 'Membrana', 0),
(42, 6, 13, 'RGB (personalización multicolor de 5 zonas)', 0),
(43, 6, 30, '6 modos LED y 3 niveles de brillo', 0),
(44, 6, 31, '1000 Hz', 0),
(45, 6, 10, 'Sí', 0),
(46, 6, 12, 'Sí', 0),
(47, 6, 32, 'Anti-ghosting multitecla', 0),
(48, 6, 7, '1.121 g', 0),
(49, 7, 34, 'Varilla', 0),
(50, 7, 35, '20 Hz-20 kHz', 0),
(51, 7, 36, '39 ohmios (pasiva), 5 kilohmios (activa)', 0),
(52, 7, 37, '107 dB SPL/mW', 0),
(53, 7, 4, '2 Metros', 0),
(54, 7, 7, '280 g', 0),
(55, 8, 4, 'USB (máxima velocidad 1000 Hz)', 0),
(56, 8, 22, 'Negro/Plateado', 0),
(57, 8, 18, '9 Programables', 0),
(58, 8, 39, '8 millones de clics', 0),
(59, 8, 40, '20 G', 0),
(60, 8, 41, 'El software incluido permite crear y asignar macros para una mejor capacidad de programación.', 0),
(61, 9, 4, 'wireless o wired (USB cable)', 0),
(62, 9, 42, '350 mA', 0),
(63, 9, 43, '1.5 h', 0),
(64, 9, 44, 'Android y PC', 0),
(65, 9, 45, '6 - 10 h (continuas)', 0),
(66, 9, 46, 'Gamepad, Mouse, Carga', 0),
(67, 9, 47, '4 - 8,5 cm', 0),
(68, 10, 48, 'Ambidiestro', 0),
(69, 10, 35, '1000 Hz', 0),
(70, 10, 37, '400/3200', 0),
(71, 10, 18, '5 Programables', 0),
(72, 10, 4, 'Cableado USB', 0),
(73, 10, 13, 'Sí, roja', 0),
(74, 10, 11, '12x7x3.9 cm', 0),
(75, 10, 7, '77 gr', 0),
(76, 11, 8, 'Mecánico', 0),
(77, 11, 24, 'No', 0),
(78, 11, 23, 'No', 0),
(79, 11, 18, '105 Teclas', 0),
(80, 11, 49, 'Sí', 0),
(81, 11, 29, '1.8 m', 0),
(82, 11, 7, '1.25 kg', 0),
(83, 12, 50, '50 mm', 0),
(84, 12, 36, '39 ohmios (pasiva), 5 kilohmios (activa)', 0),
(85, 12, 37, '107+/-3dB', 0),
(86, 12, 29, '2 Metros', 0),
(87, 12, 33, 'Cardioide (unidireccional)', 0),
(88, 12, 34, 'Varilla', 0),
(89, 12, 7, '280 g', 0),
(90, 13, 33, 'Unidireccional', 0),
(91, 13, 51, '50 mW', 0),
(92, 13, 52, '40 mm, con imanes de neodimio', 0),
(93, 13, 29, '1,3 m / 4,27 ft', 0),
(94, 13, 7, '278 g / 0.61 lbs', 0),
(95, 13, 36, '32 ± 15% Ω', 0),
(96, 13, 35, 'Micrófono: 100 Hz – 10 kHz', 0),
(97, 13, 37, 'Micrófono: 1 kHz: -41 ± 3 dB', 0),
(105, 1, 57, 'descripcion_test', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `ID` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `ruta` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`ID`, `ID_Producto`, `ruta`) VALUES
(1, 1, 'public/img/1/1.png'),
(2, 2, 'public/img/2/1.png'),
(3, 3, 'public/img/3/1.png'),
(4, 4, 'public/img/4/1.png'),
(5, 5, 'public/img/5/1.png'),
(6, 6, 'public/img/6/1.png'),
(7, 7, 'public/img/7/1.png'),
(8, 8, 'public/img/8/1.png'),
(9, 9, 'public/img/9/1.png'),
(10, 10, 'public/img/10/1.png'),
(11, 11, 'public/img/11/1.png'),
(12, 12, 'public/img/12/1.png'),
(13, 13, 'public/img/13/1.png'),
(15, 15, 'public/img/15/tank.jpg'),
(16, 14, 'public/img/14/tank.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(15) NOT NULL,
  `Mostrar` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`ID`, `Nombre`, `Mostrar`) VALUES
(1, 'Redragon', 1),
(2, 'Razer', 1),
(3, 'Microsoft', 1),
(4, 'Logitech', 1),
(5, 'HyperX', 1),
(6, 'Genius', 1),
(7, 'Corsair', 1),
(8, 'Scorpion', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`ID`, `Nombre`, `Activo`) VALUES
(1, 'Invitado', 1),
(2, 'Subscriptor', 1),
(3, 'Empleado', 1),
(4, 'Administrador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `Activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`ID`, `Nombre`, `Code`, `Activo`) VALUES
(1, 'Añadir Comentario', 'ADDCOM', 1),
(2, 'Editar Comentario', 'EDITCOM', 1),
(3, 'Eliminar Comentario', 'DELCOM', 1),
(4, 'Comprar Producto', 'BUYPROD', 1),
(5, 'Editar Producto', 'EDITPROD', 1),
(6, 'Añadir Producto', 'ADDPROD', 1),
(7, 'Eliminar Producto', 'DELPROD', 1),
(8, 'Editar Permiso', 'EDITPERM', 1),
(9, 'Añadir Usuario', 'ADDUSER', 1),
(10, 'Editar Usuario', 'EDITUSER', 1),
(11, 'Eliminar Usuario', 'DELUSER', 1),
(12, 'Añadir Filtro', 'ADDFILTRO', 1),
(13, 'Editar Filtro', 'EDITFILTRO', 1),
(14, 'Eliminar Filtro', 'DELFILTRO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(900) NOT NULL,
  `ID_Marca` int(11) NOT NULL,
  `ID_Categoria` int(11) NOT NULL,
  `ID_Condicion` int(11) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID`, `Nombre`, `Descripcion`, `ID_Marca`, `ID_Categoria`, `ID_Condicion`, `Precio`, `Activo`) VALUES
(1, 'Memecoleous H112', 'Adecuados tanto para niños como para adultos. Las almohadillas de los auriculares están hechos de espuma con memoria y se adhieren bien a los oídos, lo que da comodidad de uso durante largos periodos de juego y bloqueo el ruido ambiente, dando a los jugadores la concentración completa que necesitan. El Redragon Memecoleous ofrece un increíble nivel de sonido a gamers gracias a su sonido diseñado a medida. Su estilo de diseño único y su espectro de frecuencia combinados entregan una precisión impresionante. El Memecoleous está concebido para ser confortable luego de varias horas de uso.', 1, 1, 1, 343, 1),
(2, 'Kumara K552', 'El corazón de los teclados Redragon está equipado con tecnología Outemu, en este caso, los switches Outemu Blue, de click audible y con activación al ejercer sólo 50 gramos de fuerza sobre la tecla, hacen del Kumara un teclado que acompaña cualquier escritura o juego. La iluminación del Kumara K-552 RGB consta de teclas retroiluminadas configurables mediante software independiente para el gusto y comodidad del usuario, con posibilidades de guardar perfiles dentro de la memoria interna del teclado, logrando un resultado óptimo basado en sus necesidades. La construcción del teclado está realizada sobre ABS reforzado y placa de acero, combinado con teclas moldeadas por inyección láser de doble disparo y posteriormente grabadas, generan un producto durable y de excelente calidad, ideal para uso intensivo.', 1, 2, 1, 999, 1),
(3, 'Deathadder V2', 'El Razer DeathAdder V2 sigue en su línea, mantiene la forma característica a la vez que aligera su peso para un manejo más rápido y mejorado de tu juego. Va un paso más allá del diseño convencional de oficina, este diseño optimizado te proporciona mayor comodidad para el juego, indispensable para esas largas horas de asalto o cuando estás subiendo de rango.Los switches de este ratón ergonómico, que utilizan un haz de infrarrojos para registrar cada clic, se activan con un tiempo de respuesta de 0,2 milisegundos, tiempo líder del mercado. Al no requerir contacto físico, esta activación elimina la necesidad del retraso antirrebotes, con lo que nunca registrará pulsaciones involuntarias, lo que te proporciona un control aún más preciso y una ejecución perfecta.', 2, 3, 2, 999, 1),
(4, 'Joystick Xbox', 'Experimenta la comodidad mejorada y la sensación del nuevo control inalámbrico Xbox, con un diseño más elegante y aerodinámico, y una textura antiderrapante. Disfruta de la asignación personalizada de botones y de un rango inalámbrico que es casi el doble. Con el conector para auriculares estéreo de 3,5 mm, puedes conectar directamente cualquier tipo de auriculares compatibles. Y, gracias a la tecnología Bluetooth®, juega tus títulos favoritos en computadoras y tabletas con Windows 10*.', 3, 4, 1, 999, 1),
(5, 'Prodigy G213', 'El teclado G213 para juegos está dotado de teclas Logitech G Mech-Dome ajustadas especialmente para ofrecer una respuesta táctil superior y un perfil de desempeño global similar al de un teclado mecánico. Las teclas Mech-Dome tienen una altura estándar, ofrecen un recorrido total de 4 mm, una fuerza de actuación de 50 g y un funcionamiento silencioso.G213 tiene cinco zonas de iluminación individuales, cada una de ellas personalizable en una paleta de aproximadamente 16,8 millones de colores y distintos niveles de brillo, a juego con tu estilo personal, el sistema o el entorno. La tecnología LIGHTSYNC proporciona iluminación de próxima generación que sincroniza la iluminación y los perfiles del juego con tu contenido. Personalízalo todo de forma rápida y sencilla con Logitech G HUB.', 4, 2, 1, 999, 1),
(6, 'Alloy Core RGB', 'Gracias a su radiante barra de luz exclusiva de HyperX y a los efectos de iluminación RGB dinámicos y fluidos, el HyperX Alloy Core RGB es perfecto para jugadores que quieran mejorar el estilo y rendimiento de su teclado sin dejar la cartera tiritando. Cuenta con seis efectos de iluminación y tres niveles de brillo diferentes, lo que permite equilibrar la luminosidad y el presupuesto. Alloy Core RGB cuenta con una resistente carcasa de plástico reforzado; su estabilidad y fiabilidad son perfectas para los jugadores que busquen un teclado para un uso a largo plazo', 5, 2, 2, 999, 1),
(7, 'G332 Leatherette', 'Todo en estos audífonos es confort: Las ligeras copas y diadema de piel sintética de lujo se han creado para eliminar la presión en las orejas. Las copas giran hasta 90 grados para mayor confort.Los grandes transductores de audio de 50 mm producen un sonido completamente expansivo para una experiencia de juego más inmersiva. Ajusta el volumen confortable y rápidamente en cualquier plataforma con la rueda de volumen montada en copa.Tus audífonos funcionan con PC o Mac o con consolas de videojuegos incluidas PlayStation 4™, Xbox One™, Nintendo Switch™ y dispositivos móviles a través de cable con conector de 3,5 mm.', 4, 1, 2, 999, 1),
(8, 'Deathtaker', 'DeathTaker es un mouse láser profesional para juegos MMO/RTS de la línea GX gaming de Genius. Podrá personalizarlo para conquistar cualquier desafío en juegos MMO/RTS y llegar a ser un jugador imbatible.DeathTaker incluye una unidad aceleradora SCGii para un rango dpi que va de 100 a 5700 para que los jugadores puedan desplazarse fácilmente en el campo de batalla. Tiene un CPU de gran velocidad con un chip de memoria evitar los bloqueos de los ajustes macro de los juegos, y da a los jugadores 1-ms (8 veces más rápido) de tiempo de respuesta, más un cable trenzado con un conector USB dorado que provee una señal estable y sin interrupciones durante actividades de batalla.', 6, 3, 1, 999, 1),
(9, 'Marvo Gt-60', 'Podrás usarlo con tu PC, notebook, consola, tablet, iPad y gracias a su clip con agarre también con tu celular o iPhone. Además, gracias a su batería de larga duración, no tendrás que preocuparte por cambiar pilas o que la batería se termine en mitad del juego y gracias a sus controles tanto digitales como analógicos, se adapta a cualquier plataforma de juego. Podrás usarlo tanto de forma inalámbrica vía Bluetooth como con cable USB.', 8, 4, 2, 999, 1),
(10, 'Centrophorus M601', 'El Centrophorus es un mouse ambidiestro que destaca por todo, sí, todo. Desde su precio hasta su funcionalidad, pasando por componentes precisos y materiales de construcción de calidad. El Centrophorus se abre paso en el mercado demostrando que no es solo una cara bonita y una construcción sólida, sus switches Omron y su sensor Pixart 3317 óptico, aseguran movimiento fluído y clicks precisos. Todo conectado a la PC mediante una ficha USB recubierta en oro que la hace inoxidable y aporta la mejor conductividad posible. Sus dos botones laterales programables aseguran comodidad y funcionalidad en cualquier tipo de juego.', 1, 3, 1, 999, 1),
(11, 'K70 MK2 Rapidfire', 'El CORSAIR K70 RGB MK2 es un teclado mecánico premium para juegos diseñado para durar, con una estructura de aluminio, interruptores 100% CHERRY® MX y 8 MB de almacenamiento interno de perfiles.Este teclado Corsair de alto rendimiento permite que puedas disfrutar de horas ilimitadas de juegos. Está diseñado especialmente para que puedas expresar tanto tus habilidades como tu estilo. Podrás mejorar tu experiencia de gaming, ya seas un aficionado o todo un experto, y hacer que tus jugadas alcancen otro nivel. Una estructura de aluminio anodizado y cepillado de calidad aeroespacial proporciona una durabilidad ligera y resistente, diseñada para soportar miles de horas de juego.', 7, 2, 1, 999, 1),
(12, 'G432 7.1', 'Con los audífonos G432, estarás rodeado por el entorno del juego. Siente la emoción de estar totalmente inmerso en la acción y de que siempre te oigan para una experiencia de juego completa. El sonido envolvente de próxima generación DTS Headphone:X 2,02, El sonido envolvente DTS Headphone:X 2,0 y los preajustes de ecualizador requieren el software para juegos Logitech G HUB te permite oír al enemigo a tu espalda, pistas de habilidades especiales y entornos inmersivos, todo a tu alrededor. Disfruta de audio 3D que va más allá de los 7,1 canales que te hace sentirte en el centro de la acción.', 4, 1, 1, 999, 1),
(13, 'Electra V2', 'Sin adornos: simplemente pura euforia de audio. Los Razer Electra V2 son unos auriculares indispensables que se centran en lo que realmente importa: un sonido envolvente virtual equilibrado para todas tus necesidades de juegos y de música, todo ello concentrado en un diseño industrial elegante y cómodo. Los Razer Electra V2 te dan una posición auditiva incrementada para que sepas exactamente desde dónde ataca tu enemigo. Gracias a su avanzado software de sonido envolvente virtual 7,1 a través de Razer Synapse, también puedes calibrar los auriculares según tus preferencias de audio.', 2, 1, 2, 999, 1),
(14, 'Nombre_test', 'Descripcion_test', 3, 9, 2, 343, 1),
(15, 'Tanque', 'Modelo miniatura de un tanque', 4, 1, 2, 343, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_categoria_condicion`
--

CREATE TABLE `rel_categoria_condicion` (
  `ID_Categoria` int(11) NOT NULL,
  `ID_Condicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rel_categoria_condicion`
--

INSERT INTO `rel_categoria_condicion` (`ID_Categoria`, `ID_Condicion`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_categoria_marca`
--

CREATE TABLE `rel_categoria_marca` (
  `ID_Categoria` int(11) NOT NULL,
  `ID_Marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rel_categoria_marca`
--

INSERT INTO `rel_categoria_marca` (`ID_Categoria`, `ID_Marca`) VALUES
(1, 1),
(1, 2),
(1, 4),
(2, 1),
(2, 4),
(2, 5),
(2, 7),
(3, 1),
(3, 2),
(3, 6),
(4, 3),
(4, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_comentario_campodinamico`
--

CREATE TABLE `rel_comentario_campodinamico` (
  `ID` int(11) NOT NULL,
  `ID_CampoDinamico` int(11) NOT NULL,
  `ID_Comentario` bigint(15) NOT NULL,
  `Valor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rel_comentario_campodinamico`
--

INSERT INTO `rel_comentario_campodinamico` (`ID`, `ID_CampoDinamico`, `ID_Comentario`, `Valor`) VALUES
(1, 2, 20210720025709, 'rojo'),
(2, 1, 20210720025709, '5'),
(3, 3, 20210807195713, '6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_marca_condicion`
--

CREATE TABLE `rel_marca_condicion` (
  `ID_Marca` int(11) NOT NULL,
  `ID_Condicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rel_marca_condicion`
--

INSERT INTO `rel_marca_condicion` (`ID_Marca`, `ID_Condicion`) VALUES
(1, 1),
(3, 1),
(4, 1),
(6, 1),
(7, 1),
(2, 2),
(5, 2),
(4, 2),
(8, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_perfil_premiso`
--

CREATE TABLE `rel_perfil_premiso` (
  `ID_Perfil` int(11) NOT NULL,
  `ID_Permiso` int(11) NOT NULL,
  `Activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rel_perfil_premiso`
--

INSERT INTO `rel_perfil_premiso` (`ID_Perfil`, `ID_Permiso`, `Activo`) VALUES
(1, 1, 1),
(2, 1, 1),
(2, 4, 1),
(3, 1, 0),
(3, 2, 1),
(3, 3, 1),
(3, 4, 0),
(3, 5, 1),
(4, 1, 1),
(4, 2, 1),
(4, 3, 1),
(4, 4, 1),
(4, 5, 1),
(4, 6, 1),
(4, 7, 1),
(4, 8, 1),
(4, 9, 1),
(4, 10, 1),
(4, 11, 1),
(4, 12, 1),
(4, 13, 1),
(4, 14, 1),
(3, 13, 0),
(3, 14, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_producto_campodinamico`
--

CREATE TABLE `rel_producto_campodinamico` (
  `ID` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `ID_CampoDinamico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rel_producto_campodinamico`
--

INSERT INTO `rel_producto_campodinamico` (`ID`, `ID_Producto`, `ID_CampoDinamico`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `campo_dinamico`
--
ALTER TABLE `campo_dinamico`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`DNI`),
  ADD KEY `ID_Perfil` (`ID_Perfil`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Producto` (`ID_Producto`),
  ADD KEY `ID_Cliente` (`ID_Cliente`);

--
-- Indices de la tabla `condicion`
--
ALTER TABLE `condicion`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`fechaContacto`);

--
-- Indices de la tabla `especificacion`
--
ALTER TABLE `especificacion`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `esp_descripcion`
--
ALTER TABLE `esp_descripcion`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Producto` (`ID_Producto`),
  ADD KEY `ID_Especificacion` (`ID_Especificacion`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_IDProducto` (`ID_Producto`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_IDMarca` (`ID_Marca`),
  ADD KEY `FK_IDCategoria` (`ID_Categoria`),
  ADD KEY `FK_IDCondicion` (`ID_Condicion`);

--
-- Indices de la tabla `rel_categoria_condicion`
--
ALTER TABLE `rel_categoria_condicion`
  ADD KEY `ID_Categoria` (`ID_Categoria`),
  ADD KEY `ID_Condicion` (`ID_Condicion`);

--
-- Indices de la tabla `rel_categoria_marca`
--
ALTER TABLE `rel_categoria_marca`
  ADD KEY `ID_Categoria` (`ID_Categoria`),
  ADD KEY `ID_Marca` (`ID_Marca`);

--
-- Indices de la tabla `rel_comentario_campodinamico`
--
ALTER TABLE `rel_comentario_campodinamico`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_CampoDinamico` (`ID_CampoDinamico`),
  ADD KEY `ID_Comentario` (`ID_Comentario`);

--
-- Indices de la tabla `rel_marca_condicion`
--
ALTER TABLE `rel_marca_condicion`
  ADD KEY `ID_Marca` (`ID_Marca`),
  ADD KEY `ID_Condicion` (`ID_Condicion`);

--
-- Indices de la tabla `rel_perfil_premiso`
--
ALTER TABLE `rel_perfil_premiso`
  ADD KEY `ID_Perfil` (`ID_Perfil`),
  ADD KEY `ID_Permiso` (`ID_Permiso`);

--
-- Indices de la tabla `rel_producto_campodinamico`
--
ALTER TABLE `rel_producto_campodinamico`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Producto` (`ID_Producto`),
  ADD KEY `ID_CampoDinamico` (`ID_CampoDinamico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campo_dinamico`
--
ALTER TABLE `campo_dinamico`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `condicion`
--
ALTER TABLE `condicion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `especificacion`
--
ALTER TABLE `especificacion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `esp_descripcion`
--
ALTER TABLE `esp_descripcion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `rel_comentario_campodinamico`
--
ALTER TABLE `rel_comentario_campodinamico`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rel_producto_campodinamico`
--
ALTER TABLE `rel_producto_campodinamico`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`DNI`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `FK_IDProducto` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_IDCategoria` FOREIGN KEY (`ID_Categoria`) REFERENCES `categoria` (`ID`),
  ADD CONSTRAINT `FK_IDCondicion` FOREIGN KEY (`ID_Condicion`) REFERENCES `condicion` (`ID`),
  ADD CONSTRAINT `FK_IDMarca` FOREIGN KEY (`ID_Marca`) REFERENCES `marca` (`ID`);

--
-- Filtros para la tabla `rel_categoria_condicion`
--
ALTER TABLE `rel_categoria_condicion`
  ADD CONSTRAINT `rel_categoria_condicion_ibfk_1` FOREIGN KEY (`ID_Categoria`) REFERENCES `categoria` (`ID`),
  ADD CONSTRAINT `rel_categoria_condicion_ibfk_2` FOREIGN KEY (`ID_Condicion`) REFERENCES `condicion` (`ID`);

--
-- Filtros para la tabla `rel_categoria_marca`
--
ALTER TABLE `rel_categoria_marca`
  ADD CONSTRAINT `rel_categoria_marca_ibfk_1` FOREIGN KEY (`ID_Categoria`) REFERENCES `categoria` (`ID`),
  ADD CONSTRAINT `rel_categoria_marca_ibfk_2` FOREIGN KEY (`ID_Marca`) REFERENCES `marca` (`ID`);

--
-- Filtros para la tabla `rel_comentario_campodinamico`
--
ALTER TABLE `rel_comentario_campodinamico`
  ADD CONSTRAINT `rel_comentario_campodinamico_ibfk_1` FOREIGN KEY (`ID_CampoDinamico`) REFERENCES `campo_dinamico` (`ID`),
  ADD CONSTRAINT `rel_comentario_campodinamico_ibfk_2` FOREIGN KEY (`ID_Comentario`) REFERENCES `comentario` (`ID`);

--
-- Filtros para la tabla `rel_marca_condicion`
--
ALTER TABLE `rel_marca_condicion`
  ADD CONSTRAINT `rel_marca_condicion_ibfk_1` FOREIGN KEY (`ID_Marca`) REFERENCES `marca` (`ID`),
  ADD CONSTRAINT `rel_marca_condicion_ibfk_2` FOREIGN KEY (`ID_Condicion`) REFERENCES `condicion` (`ID`);

--
-- Filtros para la tabla `rel_producto_campodinamico`
--
ALTER TABLE `rel_producto_campodinamico`
  ADD CONSTRAINT `rel_producto_campodinamico_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID`),
  ADD CONSTRAINT `rel_producto_campodinamico_ibfk_2` FOREIGN KEY (`ID_CampoDinamico`) REFERENCES `campo_dinamico` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
