-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: syrglab
-- ------------------------------------------------------
-- Server version	5.6.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleados` (
  `cedula` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `dependencia` varchar(45) NOT NULL,
  `estado` enum('fr','dn') NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (1085277182,2525,'juan','guzman','labs','dn');
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entradas`
--

DROP TABLE IF EXISTS `entradas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entradas` (
  `identrada` int(11) NOT NULL AUTO_INCREMENT,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `empleados_cedula` int(11) NOT NULL,
  PRIMARY KEY (`identrada`),
  KEY `fk_entradas_empleados1_idx` (`empleados_cedula`),
  CONSTRAINT `fk_entradas_empleados1` FOREIGN KEY (`empleados_cedula`) REFERENCES `empleados` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entradas`
--

LOCK TABLES `entradas` WRITE;
/*!40000 ALTER TABLE `entradas` DISABLE KEYS */;
INSERT INTO `entradas` VALUES (1,'08:47:39','2016-03-24',1085277182),(2,'08:50:14','2016-03-24',1085277182);
/*!40000 ALTER TABLE `entradas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horarios` (
  `idhorarios` int(11) NOT NULL AUTO_INCREMENT,
  `dia` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `horaentra` time NOT NULL,
  `horasale` time NOT NULL,
  `monitores_cedula` int(10) NOT NULL,
  PRIMARY KEY (`idhorarios`,`monitores_cedula`),
  KEY `fk_horarios_monitores1_idx` (`monitores_cedula`),
  CONSTRAINT `fk_horarios_monitores1` FOREIGN KEY (`monitores_cedula`) REFERENCES `monitores` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` VALUES (1,'Lunes','07:00:00','13:00:00',1085233145),(2,'Martes','14:00:00','16:00:00',1085233145),(3,'Jueves','13:00:00','16:00:00',1085233145),(4,'Viernes','14:00:00','15:00:00',1085233145),(5,'Miercoles','15:00:00','16:00:00',1085233145);
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratorios`
--

DROP TABLE IF EXISTS `laboratorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratorios` (
  `idlaboratorios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `sede` enum('Alvernia','otros') DEFAULT NULL,
  `laboratoristas_idlaboratoristas` int(11) NOT NULL,
  PRIMARY KEY (`idlaboratorios`),
  KEY `fk_laboratorios_laboratoristas1_idx` (`laboratoristas_idlaboratoristas`),
  CONSTRAINT `fk_laboratorios_laboratoristas1` FOREIGN KEY (`laboratoristas_idlaboratoristas`) REFERENCES `laboratoristas` (`idlaboratoristas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorios`
--

LOCK TABLES `laboratorios` WRITE;
/*!40000 ALTER TABLE `laboratorios` DISABLE KEYS */;
INSERT INTO `laboratorios` VALUES (2,'Electronica','Laboratorio de electronica para precticas pri','Alvernia',1);
/*!40000 ALTER TABLE `laboratorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratoristas`
--

DROP TABLE IF EXISTS `laboratoristas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratoristas` (
  `idlaboratoristas` int(11) NOT NULL AUTO_INCREMENT,
  `members_id` int(11) NOT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idlaboratoristas`),
  KEY `fk_laboratoristas_members1_idx` (`members_id`),
  CONSTRAINT `fk_laboratoristas_members1` FOREIGN KEY (`members_id`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratoristas`
--

LOCK TABLES `laboratoristas` WRITE;
/*!40000 ALTER TABLE `laboratoristas` DISABLE KEYS */;
INSERT INTO `laboratoristas` VALUES (1,1085233784,'Martin ','Moncayo','3017700964','calle 17');
/*!40000 ALTER TABLE `laboratoristas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_login_attempts_members_idx` (`user_id`),
  CONSTRAINT `fk_login_attempts_members` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
INSERT INTO `login_attempts` VALUES (2,2,'1458104323');
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rol` enum('admin','usua') DEFAULT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'test_user','test@example.com','admin','00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc','f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef'),(2,'juaguzman','juancarlos_891111@hotmail.com','usua','fb8083dd4e560168186f2010b8ef2d86c1c4b01b632cb2a6d9239246ed523f10008e8d41afca1cac6597a96105cffe63c91856f51ee68988db358f3dcdd94331','82ad186ce4e6c073bdb8f0cac396cceedfbcc70ff493d9c2858725ae6a4798c1c96e2a8da6a9fb68316ba562c84d2346971727acad14150ca862b20438e0f026'),(8945,'jkl','jk@gmail','admin','sa7d7sa8c','sadasdasd54654'),(1085233784,'mmoncayo','mmoncayo@gmail.com','admin','d4658b4123053cba6ce74c286de7b5bf92f25bb2a1ce63bced5f6a18c1e158792cf396fba6a702fbbca0ff84ed706824a5be4b95415b5865a71bf31dd5cffa3d','ce28cc97e7b47ef5274174fdfa00bf54774b23d22205e0f11549d9d9cbdf4311d3799d9832f4af16bb00d5d2f1b5d584cab767f2b451620e3c733d607ec539b6'),(1085325895,'fer93','ferchita1909@hotmail.com','usua','37420204cdcd62a9af338c5914eeef582af433ca3f4da290d27e6809e82b42e791cd5999076dbb08929a120eef282e18929943f9b99a764ecbc1601cb0541122','3f079ad918fc1c9a069e11904e2d4fc10d5f82fc05d33150e6aaba7bb7771d372c5a1d06b062edef7d0c5529cdbe5f9d6d79b648162f7619a4552b1859db43aa');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mentradas`
--

DROP TABLE IF EXISTS `mentradas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mentradas` (
  `idmentradas` int(11) NOT NULL AUTO_INCREMENT,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `monitores_cedula` int(10) NOT NULL,
  PRIMARY KEY (`idmentradas`),
  KEY `fk_mentradas_monitores1_idx` (`monitores_cedula`),
  CONSTRAINT `fk_mentradas_monitores1` FOREIGN KEY (`monitores_cedula`) REFERENCES `monitores` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mentradas`
--

LOCK TABLES `mentradas` WRITE;
/*!40000 ALTER TABLE `mentradas` DISABLE KEYS */;
/*!40000 ALTER TABLE `mentradas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitores`
--

DROP TABLE IF EXISTS `monitores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monitores` (
  `cedula` int(10) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `celular` bigint(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `programa` varchar(45) NOT NULL,
  `semestre` int(2) NOT NULL,
  `estado` enum('fr','dn') DEFAULT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitores`
--

LOCK TABLES `monitores` WRITE;
/*!40000 ALTER TABLE `monitores` DISABLE KEYS */;
INSERT INTO `monitores` VALUES (1234567,'asdasd','asdsade',3201584562,'sasd','sadsad',8,'fr'),(41755279,'Martha Cecilia','escandom',3002025075,'mmoncayo@gmail.com','sistemas',5,NULL),(1085233145,'juan','guzman',20256048,'juans_891111@hotmail.com','ambiental',6,'fr'),(1085277152,'camilo','peres',2147483647,'juancarlos_891111@hotmail.com','ambiental',6,'fr'),(1085277182,'andres','sadsadsad',2147483647,'juagu@umariana.edu.co','ambiental',7,'fr'),(1085277185,'Ã±ato Ã±Ã±','bbbbb',2147483647,'juans16_891111@hotmail.com','ambiental',9,'fr');
/*!40000 ALTER TABLE `monitores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitores_has_laboratorios`
--

DROP TABLE IF EXISTS `monitores_has_laboratorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monitores_has_laboratorios` (
  `monitores_cedula` int(10) NOT NULL,
  `laboratorios_idlaboratorios` int(11) NOT NULL,
  PRIMARY KEY (`monitores_cedula`,`laboratorios_idlaboratorios`),
  KEY `fk_monitores_has_laboratorios_laboratorios1_idx` (`laboratorios_idlaboratorios`),
  KEY `fk_monitores_has_laboratorios_monitores1_idx` (`monitores_cedula`),
  CONSTRAINT `fk_monitores_has_laboratorios_laboratorios1` FOREIGN KEY (`laboratorios_idlaboratorios`) REFERENCES `laboratorios` (`idlaboratorios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_monitores_has_laboratorios_monitores1` FOREIGN KEY (`monitores_cedula`) REFERENCES `monitores` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitores_has_laboratorios`
--

LOCK TABLES `monitores_has_laboratorios` WRITE;
/*!40000 ALTER TABLE `monitores_has_laboratorios` DISABLE KEYS */;
/*!40000 ALTER TABLE `monitores_has_laboratorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `msalidas`
--

DROP TABLE IF EXISTS `msalidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msalidas` (
  `idmsalidas` int(11) NOT NULL AUTO_INCREMENT,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `monitores_cedula` int(10) NOT NULL,
  PRIMARY KEY (`idmsalidas`),
  KEY `fk_msalidas_monitores1_idx` (`monitores_cedula`),
  CONSTRAINT `fk_msalidas_monitores1` FOREIGN KEY (`monitores_cedula`) REFERENCES `monitores` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msalidas`
--

LOCK TABLES `msalidas` WRITE;
/*!40000 ALTER TABLE `msalidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `msalidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practicas`
--

DROP TABLE IF EXISTS `practicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `practicas` (
  `idpracticas` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `numgrupos` int(2) DEFAULT NULL,
  `programa` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `profesor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`idpracticas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practicas`
--

LOCK TABLES `practicas` WRITE;
/*!40000 ALTER TABLE `practicas` DISABLE KEYS */;
/*!40000 ALTER TABLE `practicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salidas`
--

DROP TABLE IF EXISTS `salidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salidas` (
  `idsalida` int(11) NOT NULL AUTO_INCREMENT,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `empleados_cedula` int(11) NOT NULL,
  PRIMARY KEY (`idsalida`),
  KEY `fk_salidas_empleados1_idx` (`empleados_cedula`),
  CONSTRAINT `fk_salidas_empleados1` FOREIGN KEY (`empleados_cedula`) REFERENCES `empleados` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salidas`
--

LOCK TABLES `salidas` WRITE;
/*!40000 ALTER TABLE `salidas` DISABLE KEYS */;
INSERT INTO `salidas` VALUES (1,'08:49:09','2016-03-24',1085277182);
/*!40000 ALTER TABLE `salidas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-27 18:11:10
