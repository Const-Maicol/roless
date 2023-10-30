-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2023 a las 22:57:46
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `online_store`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `BuscarProductos` (IN `busqueda` VARCHAR(255))   BEGIN
    SELECT Id, Name AS titulo, Description AS description, Images AS url, '' AS otra_columna
    FROM products
    WHERE Name LIKE CONCAT('%', busqueda, '%') OR
          category LIKE CONCAT('%', busqueda, '%') OR
          Images LIKE CONCAT('%', busqueda, '%')
    UNION
    SELECT id, titulo, description, url, ''
    FROM img
    WHERE titulo LIKE CONCAT('%', busqueda, '%') OR
          description LIKE CONCAT('%', busqueda, '%') OR
          url LIKE CONCAT('%', busqueda, '%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarUsuario` (IN `p_nombre` VARCHAR(100), IN `p_username` VARCHAR(100), IN `p_pass` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_numberofdocument` VARCHAR(20), IN `p_numbercellphone` VARCHAR(20), IN `p_typeofdocument` VARCHAR(10), IN `p_gender` VARCHAR(10))   BEGIN
    INSERT INTO usuarios (p_nombre, p_username, p_pass, p_email, p_numberofdocument, p_numbercellphone, p_typeofdocument, p_gender)
    VALUES (p_nombre, p_username, p_pass, p_email, p_numberofdocument, p_numbercellphone, p_typeofdocument, p_gender);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_select_all_products` ()   BEGIN
SELECT product_id,product_name,product_descriptions,product_code,product_value,product_img,ST.status_name,TPRO.typeProduct_name 
FROM product PRO 
INNER JOIN status ST ON PRO.status_id=ST.status_id
INNER JOIN typeproduct TPRO ON PRO.typeProduct_id=TPRO.typeProduct_id
WHERE ST.status_id=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_select_all_products_like` (IN `nameProdcut` VARCHAR(40))   BEGIN
SELECT product_id,product_name,product_descriptions,product_code,product_value,product_img,ST.status_name,TPRO.typeProduct_name 
FROM product PRO 
INNER JOIN status ST ON PRO.status_id=ST.status_id
INNER JOIN typeproduct TPRO ON PRO.typeProduct_id=TPRO.typeProduct_id
WHERE product_name LIKE CONCAT('%', nameProdcut , '%') AND ST.status_id=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_product` (IN `p_product_id` INT, IN `p_name` VARCHAR(100), IN `p_description` TEXT, IN `p_images` VARCHAR(100), IN `p_description_detailed` TEXT, IN `p_category` INT, IN `p_due_date` DATE)   BEGIN
    UPDATE `products`
    SET
        `Name` = p_name,
        `Description` = p_description,
        `Images` = p_images,
        `description_detailed` = p_description_detailed,
        `category` = p_category,
        `due_date` = p_due_date
    WHERE
        `Id` = p_product_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `userModules` (IN `idUser` INT(11))   BEGIN
    SELECT MO.nameModule, MO.route FROM rol_modules RM 
INNER JOIN module MO ON RM.idModule=MO.idModule
WHERE RM.idRol=(SELECT idRol FROM usuarios WHERE p_Id=idUser);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document_type`
--

CREATE TABLE `document_type` (
  `DocumentType_id` int(11) NOT NULL,
  `DocumentType_name` varchar(60) NOT NULL,
  `DocumentType_descriptions` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `document_type`
--

INSERT INTO `document_type` (`DocumentType_id`, `DocumentType_name`, `DocumentType_descriptions`) VALUES
(1, 'CC', 'Cedula'),
(2, 'TI', 'Tarjeta de Identidad '),
(4, 'CE', 'CÉDULA DE EXTRANJERIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gendertype`
--

CREATE TABLE `gendertype` (
  `GenderType_id` int(11) NOT NULL,
  `GenderType_name` varchar(60) NOT NULL,
  `GenderType_descriptions` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gendertype`
--

INSERT INTO `gendertype` (`GenderType_id`, `GenderType_name`, `GenderType_descriptions`) VALUES
(1, 'M', 'Masculino'),
(2, 'F', 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img`
--

CREATE TABLE `img` (
  `id` int(30) NOT NULL,
  `url` varchar(300) NOT NULL,
  `description` text DEFAULT NULL,
  `titulo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `img`
--

INSERT INTO `img` (`id`, `url`, `description`, `titulo`) VALUES
(1, 'https://i.ytimg.com/vi/iKe3Pv-zcD8/hq720.jpg?sqp=-oaymwEXCK4FEIIDSFryq4qpAwkIARUAAIhCGAE=&rs=AOn4CLDvuzRLyFeumZSt0jTv4zUdPqlpww', 'Juguete de Disney Junior', 'Herramientas Many a la obra'),
(2, 'https://www.ilapak.co.uk/var/site/storage/images/_aliases/gallery_img/1/8/6/3/3681-1-eng-GB/Ilapak_frozen_pizza.jpg', 'Pizza Familiar', 'Pizza con diversos ingredientes '),
(3, 'https://i.pinimg.com/originals/13/2d/f0/132df05c09ac8b2482487f4782f16b83.jpg', 'Helado de distintos sabores', 'Producto'),
(4, 'https://img.freepik.com/fotos-premium/imagenes-hd-fondo-hamburguesa_773230-288.jpg?w=2000', 'Hamburguesa especial con diversos ingredientes de la casa', 'Comida'),
(5, 'https://img.freepik.com/foto-gratis/vista-superior-sabrosa-ensalada-frutas-diferentes-frutas-sobre-fondo-blanco_140725-142053.jpg', 'Comida', 'Lleva distintas frutas tipicas de cada region de Colombia'),
(6, 'https://images.unsplash.com/photo-1603569283847-aa295f0d016a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8ZnJ1aXQlMjBqdWljZXxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80', 'Estas bebidas son hechas artesanalmente', 'Comida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `Id` int(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Images` varchar(100) NOT NULL,
  `description_detailed` text NOT NULL,
  `category` int(11) NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`Id`, `Name`, `Description`, `Images`, `description_detailed`, `category`, `due_date`) VALUES
(2, 'Lavadora  Lga', 'Ciclo Pre-Lavado + Normal, la lavdaora se encarga del lavado completo,Smart Motion ', 'https://www.tenerifeelectrodomesticos.com/10691-superlarge_default/lavadora-lg-inox.jpg', 'Lavadora LG Smart Inverter con 10 años de garantía, tiene un rendimiento de lavado superior, más limpio, más higiénico, El Motor Smart Inverter es confiable, silencioso y duradero', 1, '2023-08-31'),
(3, 'Estufa Abba', 'Ahorra tiempo cocinando', 'https://exitocol.vtexassets.com/arquivos/ids/2148758/Estufa-Abba-6-Puestos-Gaspr-VRefl-1568404_a.jpg', 'La estufa Romero Reflex gas natural, te ofrece un contraste único de colores y acabados', 1, '2023-08-31'),
(4, 'Carros Hot Wheels x 5 MATTEL\r\n', 'Cada paquete incluye 5 vehículos Hot Wheels, Cada paquete se vende por separado', 'https://wallpaperaccess.com/full/539660.jpg', 'Este paquete de 5 Carros de Juguete HOT WHEELS MATTEL es perfecta para iniciar o aumentar una colección', 3, '2023-08-31'),
(5, 'Tio rico', 'Desarrolla la estrategia y destreza mental,Juego de mesa para la diversión de grandes y pequeños', 'https://http2.mlstatic.com/D_NQ_NP_903292-MCO43317330849_082020-F.jpg', 'Sé rico, muy rico tanto y más que Tío Rico, con propiedades, casas y castillos buena renta y muchos pesos en efectivo.', 3, '2023-08-31'),
(6, 'Hot Wheels City Robo Tiburón MATTEL', 'Carga los autos en el lanzadorLos autos cambian de color,Impulsa el desarrollo de los niños', 'https://http2.mlstatic.com/D_NQ_NP_727457-MLM43767113424_102020-F.jpg', 'HOT WHEELS™ City está bajo el ataque de un gigantesco TIBURÓN. Los niños querrán averiguar si sus autos son lo suficientemente rápidos como para atravesar la ola sin ser devorados. ', 3, '2023-08-31'),
(7, 'Sandwich con papas fritas', 'Este producto esta hecho con los mejores ingredientes, los cuales son cultivados y utilizados para la preparacion de dicho alimento', 'https://www.romagnolipatate.it/images/club_sandwhich-min.jpg', 'Esta preparacion viene con tomate,lechuga,pan,salsa de tomate, papas fritas(A la francesa)', 2, '2023-08-31'),
(8, 'Ensalada fresca de vegetales', 'El opta con los mejores ingredientes, los cuales son cultivados de nuestras granjas y usados para la preparacion de esta rica preparacion', 'https://versionfinal.com.ve/wp-content/uploads/2016/02/ensalada-saludable-1.jpg', 'La receta es hecha por campesinos... Nos reservamos el derecho de admisión', 2, '2023-08-31'),
(9, 'Dorilocos especiales', 'Este preparacion esta realizada por uno de nuestro mejores chef el cual con todo el amor del mundo se dedico a crear esta hermosa receta', 'https://i.pinimg.com/originals/8f/26/d7/8f26d71e2f053eb4092fec77cdcb791c.jpg', 'La receta de este producto es secreta y jamás sera encontrada', 2, '2023-08-31'),
(49, 'a', '', '', '', 2, '2023-08-31'),
(50, 'a', '', '', '', 2, '2023-08-31'),
(56, 'mamam', 'sada', 'https://tse3.mm.bing.net/th?id=OIP.j0QsMZwRuDNAkXGTKatgtAHaHa&pid=Api&P=0&h=180', 'dsdsadsaa', 1, '2023-08-31'),
(57, 's', 's', 's', 's', 3, '2023-08-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `Id` int(30) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `idUser` int(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`Id`, `Name`, `Description`, `idUser`) VALUES
(1, 'cliente', 'Es un cliente', 0),
(2, 'admin', 'Es un admin', 0),
(3, 'vendedor', 'Es un vendedor', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(10) NOT NULL,
  `status_descriptions` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`status_id`, `status_name`, `status_descriptions`) VALUES
(1, 'Active', 'This is Active'),
(2, ' Block', 'This is Block');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typeproduct`
--

CREATE TABLE `typeproduct` (
  `typeProduct_id` int(11) NOT NULL,
  `typeProduct_name` varchar(20) NOT NULL,
  `typeProduct_descriptions` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `typeproduct`
--

INSERT INTO `typeproduct` (`typeProduct_id`, `typeProduct_name`, `typeProduct_descriptions`) VALUES
(1, 'Electrodomesticos', 'Tecnología '),
(2, 'Mercado', 'Mercado'),
(3, 'Juguetes', 'Juguetes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `p_Id` int(50) NOT NULL,
  `p_nombre` varchar(100) NOT NULL,
  `p_username` varchar(100) NOT NULL,
  `p_pass` varchar(100) NOT NULL,
  `p_email` varchar(100) NOT NULL,
  `p_numberofdocument` int(50) NOT NULL,
  `p_numbercellphone` int(20) NOT NULL,
  `p_typeofdocument` int(11) NOT NULL,
  `p_gender` int(11) DEFAULT NULL,
  `rol` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`p_Id`, `p_nombre`, `p_username`, `p_pass`, `p_email`, `p_numberofdocument`, `p_numbercellphone`, `p_typeofdocument`, `p_gender`, `rol`) VALUES
(2, 'Maicol', 'a', 'a', 'a@a.a', 12, 12, 1, 1, 1),
(10, 'Maicols', 'Mike', '$2y$10$S5f789RyiEL1dQPjAi0UH.WovE9hQ4HYJh2GR361mFc1Y20h6BwZS', 'msh112@a.a', 126547, 23554134, 1, 1, 1),
(11, 'MA', 'MAAA', '1', '1@A.A', 1, 23, 2, 2, 1),
(13, 'maicol', 'mai', '123', 'a@a.a', 0, 32, 1, 1, 2),
(14, 'Nuevo Usuario', 'nuevo_usuario', '123456', 'nuevo@usuario.com', 123456, 789012345, 1, 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`DocumentType_id`);

--
-- Indices de la tabla `gendertype`
--
ALTER TABLE `gendertype`
  ADD PRIMARY KEY (`GenderType_id`);

--
-- Indices de la tabla `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `sta` (`category`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indices de la tabla `typeproduct`
--
ALTER TABLE `typeproduct`
  ADD PRIMARY KEY (`typeProduct_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`p_Id`),
  ADD KEY `Idgender` (`p_gender`),
  ADD KEY `Document` (`p_typeofdocument`),
  ADD KEY `usuarios_ibfk_1` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `document_type`
--
ALTER TABLE `document_type`
  MODIFY `DocumentType_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `gendertype`
--
ALTER TABLE `gendertype`
  MODIFY `GenderType_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `img`
--
ALTER TABLE `img`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `Id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `typeproduct`
--
ALTER TABLE `typeproduct`
  MODIFY `typeProduct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `p_Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `sta` FOREIGN KEY (`category`) REFERENCES `typeproduct` (`typeProduct_id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `Document` FOREIGN KEY (`p_typeofdocument`) REFERENCES `document_type` (`DocumentType_id`),
  ADD CONSTRAINT `Idgender` FOREIGN KEY (`p_gender`) REFERENCES `gendertype` (`GenderType_id`),
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
