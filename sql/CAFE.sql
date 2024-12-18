-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cafeteria
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'bebidas'),(2,'snacks'),(3,'desayuno'),(4,'reposteria');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,' Café Capuccino Grande','Es un cafe capuccino grande',20.00,'5522146676845ce1c8adc8d219fc13c3',20,1),(2,' Gelatina','Es una gelatina',20.00,'0b51fc77103415015942de6ce8435fe3',20,3),(3,' Cake BlueBerry','Es un pastel de moras azules, contiene leche, azucar, crema pastelera, etc.',35.00,'804b3c77e3081b3845ba02a8f09d2fa7',20,4),(4,' Helado','Contiene dos bolas de helado, es leche descremada, sin azucar.',22.00,'ab95bf786b971bf770d5c09efd7501ee',15,4),(7,' Pizza','Es una pizza',20.00,'9c0ec068d14806a617dde9cf8eea8cbd',20,3),(8,' CheeseCake','1 Barra de mantequilla derretida (90 g)\n30 Galletas Marías molidas\n3 Paquetes de queso crema a temperatura ambiente (190 g c/u)\n1 Lata de Leche Condensada LA LECHERA®\n1 Lata de Media Crema NESTLÉ®\n2 Limones su ralladura\n2 Limones su jugo\n3 Sobres de grenetina (7 g c/u) hidratada en 1/4 de taza de agua y disuelta a baño María\n1/4 Taza de fresas desinfectadas',13.00,'5f3df46e0f2d59977588b6ab3b30fcae',20,4),(9,' Galletas','1 1/2 Barras de Mantequilla sin sal a temperatura ambiente (135 g)\n1 Lata de Leche Condensada LA LECHERA®\n1 Cucharadita de Esencia de vainilla\n1 Huevo\n2 1/2 Tazas de Harina de trigo\n1 Cucharadita de Polvo para hornear\n1 Taza de Chocolate semiamargo en chispas',15.00,'5daecaa101e5622a647cde691dfd78cb',20,2),(10,' Malteada','1 (240 ml) de leche de almendras [o leche de su preferencia]\n2 cucharadas (10 g) de cacao en polvo [o salsa de chocolate]\n3 tazas (390 g) de yogur helado sin grasa, sabor chocolate\n3 tazas (390 g) de cubos de hielo',36.00,'23741ef823c66ba77d0c13f0a6c76677',20,1),(11,' Mollete','1 Lata Frijoles enlatados refritos negros\r\n1 Lata Leche Evaporada CARNATION® CLAVEL®\r\nGramo Cebolla en polvo\r\nGramo Sal\r\n6 Piezas *Bolillos cortados por la mitad y sin migajón\r\n2 Tazas Queso Chihuahua rallado',20.00,'7a84418ae746105996f941479f863813',20,3),(12,' Waffles','-harina\r\n-huevo\r\n-leche\r\n-levadura\r\n-mantequilla',45.00,'bd470a0a4df0c225a96cf46df8ac4e8e',20,3),(13,' Sincronizada','La sincronizada es un sándwich fundamentado en una tortilla. Es frecuentemente confundida con las quesadillas mexicanas. Se denominan así por «sincronizarse» las dos tortillas cubriendo el contenido de jamón y queso.(actualizado)',20.50,'3af3d32413ff8644fdfc558042dd688f',20,3);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_productos`
--

DROP TABLE IF EXISTS `ticket_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` int(11) DEFAULT NULL,
  `id_productos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_productos`
--

LOCK TABLES `ticket_productos` WRITE;
/*!40000 ALTER TABLE `ticket_productos` DISABLE KEYS */;
INSERT INTO `ticket_productos` VALUES (1,1,12),(2,1,11),(3,1,10),(4,1,7),(5,1,4),(6,1,9),(7,1,11),(8,2,1),(9,2,2),(10,2,3),(11,2,4),(12,2,7),(13,3,10),(14,3,11),(15,3,12),(16,3,7),(17,3,1),(18,3,2),(19,4,10),(20,4,13),(21,4,7),(22,4,1),(23,4,2),(24,5,10),(25,5,11),(26,6,10),(27,6,11),(28,6,12),(29,7,10),(30,7,11),(31,7,12),(32,8,10),(33,8,11),(34,8,12),(35,9,11),(36,9,7),(37,9,8),(38,9,2),(39,9,1);
/*!40000 ALTER TABLE `ticket_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'completado',
  `order_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,2,20.35,'2024-12-18 04:09:46','COMPLETED',' 2MU60995NY0301235'),(2,4,0.00,'2024-12-18 04:22:49','COMPLETED',' 91B15805V96661725'),(3,4,0.00,'2024-12-18 04:37:03','COMPLETED',' 7UJ11205LD890624S'),(4,4,140.14,'2024-12-18 04:53:09','COMPLETED',' 9GD14979517151725'),(5,4,69.96,'2024-12-18 04:58:03','COMPLETED',' 4FM122703K500984M'),(6,4,122.16,'2024-12-18 05:00:44','COMPLETED',' 8UR61700WM395543R'),(7,4,122.16,'2024-12-18 05:02:19','COMPLETED',' 4P912523999025931'),(8,2,122.16,'2024-12-18 05:12:28','COMPLETED',' 7W704200J1661650H'),(9,2,112.88,'2024-12-18 07:06:55','COMPLETED',' 0VK301620R6205445');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) DEFAULT NULL,
  `apellido` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  `token` varchar(13) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  ` empleado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,' Kevin','Juarez','correo@correo.com','$2y$10$Cdcy17dW5EhKahM5FcIBR.SbYZp3UxwaIM9svQiMjkQeLHz2CJSlK',1,'673b4d7555460',1,NULL),(3,' Shery','Ortega','shery@gmail.com','$2y$10$fIHhBkXmlP616YBGA.NMJOiLKLS.BmbkwpBY4go5vcmgFAe2x4LLa',1,'',0,NULL),(4,' Iran','San Agustin','iran123@gmail.com','$2y$10$.MQ1sjX6c7igdTyRmkqjpekrWo89F1MSdmx4X4VkjqA27tn8UcSEe',1,'',0,NULL),(5,' Monty','Montiel','monty@gmail.com','$2y$10$vSs0Hr59MzJ46pk6JKfA4.TAH7vA/5NZQemiwjGbUdrea8EU3nbsq',1,'',0,NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-18  7:55:29
