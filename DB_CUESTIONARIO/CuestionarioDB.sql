/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: CuestionarioDB
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `AsignacionCuestionarioFinal`
--

DROP TABLE IF EXISTS `AsignacionCuestionarioFinal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AsignacionCuestionarioFinal` (
  `asig_id` int(11) NOT NULL AUTO_INCREMENT,
  `asig_tipoCuestionarioId` int(11) NOT NULL,
  `asig_usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`asig_id`),
  KEY `fk_tipoCuestionarioId` (`asig_tipoCuestionarioId`),
  KEY `fk_usuarioId` (`asig_usuarioId`),
  CONSTRAINT `fk_tipoCuestionarioId` FOREIGN KEY (`asig_tipoCuestionarioId`) REFERENCES `TipoCuestionario` (`tipoCues_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_usuarioId` FOREIGN KEY (`asig_usuarioId`) REFERENCES `Usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AsignacionCuestionarioFinal`
--

LOCK TABLES `AsignacionCuestionarioFinal` WRITE;
/*!40000 ALTER TABLE `AsignacionCuestionarioFinal` DISABLE KEYS */;
INSERT INTO `AsignacionCuestionarioFinal` VALUES
(3,2,169);
/*!40000 ALTER TABLE `AsignacionCuestionarioFinal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PreguntasCues`
--

DROP TABLE IF EXISTS `PreguntasCues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PreguntasCues` (
  `preguntasCues_id` int(11) NOT NULL AUTO_INCREMENT,
  `preguntasCues_nombre` varchar(90) NOT NULL,
  `preguntasTipoCues` int(11) NOT NULL,
  PRIMARY KEY (`preguntasCues_id`),
  KEY `preguntasTipoCues` (`preguntasTipoCues`),
  CONSTRAINT `PreguntasCues_ibfk_1` FOREIGN KEY (`preguntasTipoCues`) REFERENCES `TipoCuestionario` (`tipoCues_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PreguntasCues`
--

LOCK TABLES `PreguntasCues` WRITE;
/*!40000 ALTER TABLE `PreguntasCues` DISABLE KEYS */;
INSERT INTO `PreguntasCues` VALUES
(126,'Que es mar veloz que la luz',169),
(127,'Que es mas lentro de la luz',169),
(128,'Que es la teorial formal?',169),
(129,'Que es esta tercera pregunta?',169),
(130,'Que es esta pregunta fianl',169),
(131,'Esta es otra pregunta',169),
(132,'esta es otro tiop de pregunata',169),
(133,'Este es una pregunta mas adicional',169),
(134,'nuestro tipo de pregunta',169),
(135,'pregunta adiciaonl',169),
(136,'Este es ootra pregunta adicional',169),
(137,'Este es una pregunta adicional final',169),
(138,'pregutna ejemplo',169),
(139,'Pregunta ejemplo',169),
(140,'Este es un tipo de pregunta adicional ',169),
(141,'Este es un tipo de pregunta adicional ',169),
(142,'Este es un tipo de pregunta adicional ',169),
(143,'Este es un tipo de pregunta adicional ',169),
(144,'Este es un tipo de pregunta adicional ',169),
(145,'Este es un tipo de pregunta adicional ',169),
(146,'Este es un tipo de pregunta adicional ',169),
(147,'Este es un tipo de pregunta adicional ',169),
(148,'Este es un tipo de pregunta adicional ',169),
(149,'Este es un tipo de pregunta adicional ',169),
(150,'Este es mi pregunta final ?',169);
/*!40000 ALTER TABLE `PreguntasCues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RespuestasCues`
--

DROP TABLE IF EXISTS `RespuestasCues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RespuestasCues` (
  `respuestasCues_id` int(11) NOT NULL AUTO_INCREMENT,
  `respuestasCues_nombre` varchar(200) NOT NULL,
  `preguntasCues` int(11) NOT NULL,
  `respuestasCues_correcta` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`respuestasCues_id`),
  KEY `preguntasCues` (`preguntasCues`),
  CONSTRAINT `RespuestasCues_ibfk_1` FOREIGN KEY (`preguntasCues`) REFERENCES `PreguntasCues` (`preguntasCues_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RespuestasCues`
--

LOCK TABLES `RespuestasCues` WRITE;
/*!40000 ALTER TABLE `RespuestasCues` DISABLE KEYS */;
INSERT INTO `RespuestasCues` VALUES
(51,'velocidad',127,1),
(52,'tiempo',127,0),
(53,'nueva forma de vida',128,1),
(54,'es una teroia olvidada',128,0),
(55,'este es un tipo de respuesta',129,1),
(56,'este es otro tipo de respuesta final',129,0),
(57,'uan respuesta',130,1),
(58,'uan cosnsfidji',130,0),
(59,'respuesta una final pregunta',131,1),
(60,'Es es otroo tipo de respuesta final',131,0),
(61,'si es una respuesta nuva',133,1),
(62,'otro tipo de espuesta.',133,0),
(63,'esta es una pregunta distintia',134,1),
(64,'una otra pregunaa',134,0),
(65,'repsuest 1',135,1),
(66,'respuesta 2',135,0),
(67,'respuesta genral 1',149,0),
(68,'respuesta general 2',149,1),
(140,'respuesat 1',150,0),
(141,'respuesta 2',150,0),
(142,'respuesta 3',150,1),
(144,'teoria formal con nueva respuesta',128,0),
(145,'tercera pregunta respuesta nueva',129,0),
(146,'pregunta final con nueva respuesta',130,0),
(147,'otra pregunta con respuesta nueva',131,0),
(148,'pregunta adicional con nueva respuestas',133,0),
(149,'tipo pregunta con nueva respuesta',134,0);
/*!40000 ALTER TABLE `RespuestasCues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Rol`
--

DROP TABLE IF EXISTS `Rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(80) NOT NULL,
  `rol_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Rol`
--

LOCK TABLES `Rol` WRITE;
/*!40000 ALTER TABLE `Rol` DISABLE KEYS */;
INSERT INTO `Rol` VALUES
(1,'administrador',1),
(2,'usuario',1);
/*!40000 ALTER TABLE `Rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TipoCuestionario`
--

DROP TABLE IF EXISTS `TipoCuestionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TipoCuestionario` (
  `tipoCues_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipoCues_tema` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`tipoCues_id`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TipoCuestionario`
--

LOCK TABLES `TipoCuestionario` WRITE;
/*!40000 ALTER TABLE `TipoCuestionario` DISABLE KEYS */;
INSERT INTO `TipoCuestionario` VALUES
(169,'Fisica');
/*!40000 ALTER TABLE `TipoCuestionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(80) NOT NULL,
  `usuario_apellido` varchar(80) NOT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `usuario_password` varchar(100) NOT NULL,
  `usuario_rolId` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `usuario_rolId` (`usuario_rolId`),
  CONSTRAINT `Usuario_ibfk_1` FOREIGN KEY (`usuario_rolId`) REFERENCES `Rol` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` VALUES
(1,'juan','carlos','juan@hotmail.com','juan1234',1),
(2,'marco','polo','marco@hotmail.com','marcoPol07@',2),
(3,'luis','zapata','luis@hotmail.com','$2y$10$9q2IDTXM/lg6roqetqVh3e2UHK/yhX5aPFlQS/75usDGFqAV2bbUO',2),
(4,'PP','LOPEZ','a@gmail.com','$2y$10$K1QwHw8kFgOeSFXOqftuB.wt9QvPHukkvcidm9yYBQnbjci3N7fU.',1);
/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-22  3:55:19
