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
  PRIMARY KEY (`idhorarios`),
  KEY `fk_horarios_monitores1_idx` (`monitores_cedula`),
  CONSTRAINT `fk_horarios_monitores1` FOREIGN KEY (`monitores_cedula`) REFERENCES `monitores` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` VALUES (1,'Lunes','07:00:00','13:00:00',1085233145),(2,'Martes','09:00:00','13:00:00',1085233145),(3,'Jueves','13:00:00','16:00:00',1085233145),(4,'Viernes','14:00:00','15:00:00',1085233145),(5,'Miercoles','15:00:00','16:00:00',1085233145);
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
  `laboratoristas_members_id` int(11) NOT NULL,
  PRIMARY KEY (`idlaboratorios`),
  KEY `fk_laboratorios_laboratoristas1_idx` (`laboratoristas_members_id`),
  CONSTRAINT `fk_laboratorios_laboratoristas1` FOREIGN KEY (`laboratoristas_members_id`) REFERENCES `laboratoristas` (`members_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorios`
--

LOCK TABLES `laboratorios` WRITE;
/*!40000 ALTER TABLE `laboratorios` DISABLE KEYS */;
INSERT INTO `laboratorios` VALUES (2,'Electronica','Laboratorio de electronica para precticas pri','Alvernia',1),(3,'Quimica','laboratorio de quimica para prcticas','Alvernia',1),(4,'Fisica','Labroatario de practicas de fisica y derviada','Alvernia',1085277182);
/*!40000 ALTER TABLE `laboratorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratoristas`
--

DROP TABLE IF EXISTS `laboratoristas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratoristas` (
  `members_id` int(11) NOT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`members_id`),
  KEY `fk_laboratoristas_members1_idx` (`members_id`),
  CONSTRAINT `fk_laboratoristas_members1` FOREIGN KEY (`members_id`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratoristas`
--

LOCK TABLES `laboratoristas` WRITE;
/*!40000 ALTER TABLE `laboratoristas` DISABLE KEYS */;
INSERT INTO `laboratoristas` VALUES (1,'test','user','3017700964','calle 17'),(1085277182,NULL,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias`
--

DROP TABLE IF EXISTS `materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materias` (
  `idmaterias` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmaterias`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias`
--

LOCK TABLES `materias` WRITE;
/*!40000 ALTER TABLE `materias` DISABLE KEYS */;
INSERT INTO `materias` VALUES (1,'Fisica'),(2,'Ondas y ocilaciones'),(3,'Investigacion'),(4,'Quimica'),(5,'Redes'),(6,'Electronica Digital');
/*!40000 ALTER TABLE `materias` ENABLE KEYS */;
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
INSERT INTO `members` VALUES (1,'test_user','test@example.com','admin','00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc','f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef'),(1085277182,'juank','juaguzman@umariana.edu.co','usua','e560f6630596c2a20cad7700d740438da55c511095aa1ec751ca2ec94df53ed00717694630795511fd5674d8c9a12972693207c460607366f5254c539ab23750','e27f312897a5f8b4d15c9b97b8ee8014331b680dc21f5539b92f18a62ea4053a5b6388815d3e1409ab5c404aaa41f5847399c31df6e1f2cb4046ae921f3f91a6');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
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
  `estado` enum('fr','dn') NOT NULL,
  `laboratoristas_members_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cedula`),
  KEY `fk_monitores_laboratoristas1_idx` (`laboratoristas_members_id`),
  CONSTRAINT `fk_monitores_laboratoristas1` FOREIGN KEY (`laboratoristas_members_id`) REFERENCES `laboratoristas` (`members_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitores`
--

LOCK TABLES `monitores` WRITE;
/*!40000 ALTER TABLE `monitores` DISABLE KEYS */;
INSERT INTO `monitores` VALUES (45615,'HUIH','HUHIU',446546,'mkbuyyu','buyuv',5,'dn',1),(1234567,'mTest','mUser',3201584562,'sasd','sadsad',8,'fr',1),(41755279,'Martha Cecilia','escandom',3002025075,'mmoncayo@gmail.com','sistemas',5,'fr',NULL),(108523512,'camilo','QuiÃ±ones',3014568912,'juagu@umariana.edu.co','Sistemas',7,'dn',1085277182),(1085233145,'juan','guzman',20256048,'juans_891111@hotmail.com','ambiental',6,'fr',NULL);
/*!40000 ALTER TABLE `monitores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mregistro`
--

DROP TABLE IF EXISTS `mregistro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mregistro` (
  `idmentradas` int(11) NOT NULL AUTO_INCREMENT,
  `horaen` time NOT NULL,
  `horasal` time DEFAULT NULL,
  `fecha` date NOT NULL,
  `monitores_cedula` int(10) NOT NULL,
  PRIMARY KEY (`idmentradas`),
  KEY `fk_mentradas_monitores1_idx` (`monitores_cedula`),
  CONSTRAINT `fk_mentradas_monitores1` FOREIGN KEY (`monitores_cedula`) REFERENCES `monitores` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mregistro`
--

LOCK TABLES `mregistro` WRITE;
/*!40000 ALTER TABLE `mregistro` DISABLE KEYS */;
INSERT INTO `mregistro` VALUES (3,'07:05:10','09:16:34','2016-04-01',45615),(7,'09:39:12','09:47:34','2016-03-29',45615),(8,'09:40:36','09:47:34','2016-03-30',45615),(9,'09:44:26','10:07:17','2016-03-31',1234567),(10,'09:48:55','18:31:57','2016-03-31',45615),(11,'10:37:52','18:31:57','2016-03-31',45615),(12,'11:41:45','18:31:57','2016-03-31',45615),(13,'17:58:23','18:31:57','2016-03-31',45615),(14,'18:31:05','18:31:57','2016-03-31',45615),(15,'18:31:51','18:31:57','2016-03-31',45615),(16,'11:55:46',NULL,'2016-04-01',45615),(17,'13:49:27',NULL,'2016-04-03',108523512);
/*!40000 ALTER TABLE `mregistro` ENABLE KEYS */;
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
  `horasal` time DEFAULT NULL,
  `fecha` date NOT NULL,
  `monitores_cedula` int(10) NOT NULL,
  PRIMARY KEY (`idmsalidas`),
  KEY `fk_mentradas_monitores1_idx` (`monitores_cedula`),
  CONSTRAINT `fk_mentradas_monitores10` FOREIGN KEY (`monitores_cedula`) REFERENCES `monitores` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  `idpracticas` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pract` varchar(45) CHARACTER SET utf8 NOT NULL,
  `docente` varchar(45) CHARACTER SET utf8 NOT NULL,
  `guia` enum('COMPLETA','INCOMPLETA') COLLATE utf8_spanish2_ci NOT NULL,
  `numgrupos` int(2) NOT NULL,
  `numestudiantes` int(2) NOT NULL,
  `obsdocente` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `obscordinador` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `laboratoristas_members_id` int(11) NOT NULL,
  `laboratorios_idlaboratorios` int(11) NOT NULL,
  `monitores_cedula` int(10) NOT NULL,
  `materias_idmaterias` int(11) NOT NULL,
  `programa_idprograma` int(11) NOT NULL,
  `horapl` time NOT NULL,
  `horaini` time NOT NULL,
  `horaplfn` time NOT NULL,
  `horafin` time DEFAULT NULL,
  `fecha` date NOT NULL,
  `estado` enum('in','fn') COLLATE utf8_spanish2_ci NOT NULL,
  `numficha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpracticas`),
  KEY `fk_practicas_laboratorios1_idx` (`laboratorios_idlaboratorios`),
  KEY `fk_practicas_monitores1_idx` (`monitores_cedula`),
  KEY `fk_practicas_materias1_idx` (`materias_idmaterias`),
  KEY `fk_practicas_programa1_idx` (`programa_idprograma`),
  KEY `fk_practicas_laboratoristas1_idx` (`laboratoristas_members_id`),
  CONSTRAINT `fk_practicas_laboratorios` FOREIGN KEY (`laboratorios_idlaboratorios`) REFERENCES `laboratorios` (`idlaboratorios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_practicas_laboratoristas` FOREIGN KEY (`laboratoristas_members_id`) REFERENCES `laboratoristas` (`members_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_practicas_materias` FOREIGN KEY (`materias_idmaterias`) REFERENCES `materias` (`idmaterias`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_practicas_monitores` FOREIGN KEY (`monitores_cedula`) REFERENCES `monitores` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_practicas_programa` FOREIGN KEY (`programa_idprograma`) REFERENCES `programa` (`idprograma`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practicas`
--

LOCK TABLES `practicas` WRITE;
/*!40000 ALTER TABLE `practicas` DISABLE KEYS */;
INSERT INTO `practicas` VALUES (3,'MUR','testDos','COMPLETA',2,45,NULL,'',1,2,45615,2,2,'07:00:00','07:15:00','12:00:00',NULL,'2016-03-31','in',1),(5,'ssss','ssss','COMPLETA',2,10,NULL,'                           \r\n                ',1,2,45615,3,2,'19:00:00','00:44:09','10:00:00',NULL,'2016-04-01','in',2),(6,'ssss','ssss','COMPLETA',2,10,'prueba docente de practica','prueba de fin de practica',1,2,45615,2,1,'10:00:00','00:46:22','12:00:00','11:54:29','2016-04-01','fn',3),(7,'testpractica','testDocente','COMPLETA',2,20,NULL,'el Docente rompe una probeta ',1,2,45615,2,1,'07:00:00','00:49:46','12:00:00','11:48:30','2016-04-01','fn',4),(8,'testpractica','testDocente','COMPLETA',2,20,'ppprrrrrr','ooo',1,2,45615,2,1,'07:00:00','17:50:40','12:00:00','11:37:25','2016-03-31','fn',5),(9,'testpractica','testDocente','COMPLETA',2,20,NULL,'prueba tests fin practica',1,2,45615,2,1,'07:00:00','17:52:46','12:00:00','11:52:51','2016-03-31','fn',6),(10,'tets2','testpr2','COMPLETA',2,10,NULL,'                           \r\n                ',1,2,45615,1,1,'07:00:00','17:53:12','10:00:00',NULL,'2016-03-31','in',7),(11,'tets2','testpr2','COMPLETA',2,10,NULL,'                           \r\n                ',1,2,45615,1,1,'07:00:00','17:57:42','10:00:00',NULL,'2016-03-31','in',8),(12,'Tratamiento de datos','Javier Villalba','COMPLETA',3,12,NULL,'                           \r\n                ',1,2,45615,3,1,'07:00:00','18:00:21','11:00:00',NULL,'2016-03-31','in',9),(13,'Tratamiento de datos','Javier Villalba','COMPLETA',3,12,NULL,'                           \r\n                ',1,2,45615,3,1,'07:00:00','18:01:03','11:00:00',NULL,'2016-03-31','in',10),(14,'Tratamiento de datos','Javier Villalba','COMPLETA',3,12,NULL,'                           \r\n                ',1,2,45615,3,1,'07:00:00','18:07:41','11:00:00',NULL,'2016-03-31','in',11),(15,'prractestQuimica','doctestQuimica','COMPLETA',5,25,NULL,'                           \r\n                ',1,3,45615,4,3,'07:00:00','11:56:49','08:00:00',NULL,'2016-04-01','in',2),(16,'prractestQuimica','doctestQuimica','COMPLETA',5,25,NULL,'                           \r\n                ',1,3,45615,4,3,'07:00:00','12:04:36','08:00:00',NULL,'2016-04-01','in',1),(17,'RedesGrandes','Villalba','COMPLETA',3,15,NULL,'Practica demasiado corta',1,2,45615,5,2,'07:00:00','12:06:55','08:00:00',NULL,'2016-04-01','in',12),(18,'casas','pedro','COMPLETA',2,15,NULL,'',1085277182,4,108523512,1,1,'07:00:00','14:40:45','10:00:00','14:41:50','2016-04-03','fn',1);
/*!40000 ALTER TABLE `practicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programa`
--

DROP TABLE IF EXISTS `programa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programa` (
  `idprograma` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `director` varchar(45) NOT NULL,
  PRIMARY KEY (`idprograma`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programa`
--

LOCK TABLES `programa` WRITE;
/*!40000 ALTER TABLE `programa` DISABLE KEYS */;
INSERT INTO `programa` VALUES (1,'Sistemas','Andres'),(2,'Ambiental','chucho'),(3,'Procesos','jam');
/*!40000 ALTER TABLE `programa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programa_has_matrias`
--

DROP TABLE IF EXISTS `programa_has_matrias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programa_has_matrias` (
  `programa_idprograma` int(11) NOT NULL,
  `materias_idmaterias` int(11) NOT NULL,
  PRIMARY KEY (`programa_idprograma`,`materias_idmaterias`),
  KEY `fk_programa_has_matrias_materias1_idx` (`materias_idmaterias`),
  CONSTRAINT `fk_programa_has_matrias_materias1` FOREIGN KEY (`materias_idmaterias`) REFERENCES `materias` (`idmaterias`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_programa_has_matrias_programa1` FOREIGN KEY (`programa_idprograma`) REFERENCES `programa` (`idprograma`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programa_has_matrias`
--

LOCK TABLES `programa_has_matrias` WRITE;
/*!40000 ALTER TABLE `programa_has_matrias` DISABLE KEYS */;
INSERT INTO `programa_has_matrias` VALUES (1,1),(2,1),(3,1),(1,2),(2,2),(3,2),(1,3),(2,3),(3,3),(2,4),(3,4),(1,5),(2,5),(3,5),(1,6),(2,6),(3,6);
/*!40000 ALTER TABLE `programa_has_matrias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programas_has_laboratorios`
--

DROP TABLE IF EXISTS `programas_has_laboratorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programas_has_laboratorios` (
  `programa_idprograma` int(11) NOT NULL,
  `laboratorios_idlaboratorios` int(11) NOT NULL,
  KEY `fk_programas_has_laboratorios_programa1_idx` (`programa_idprograma`),
  KEY `fk_programas_has_laboratorios_laboratorios1_idx` (`laboratorios_idlaboratorios`),
  CONSTRAINT `fk_programas_has_laboratorios_laboratorios1` FOREIGN KEY (`laboratorios_idlaboratorios`) REFERENCES `laboratorios` (`idlaboratorios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_programas_has_laboratorios_programa1` FOREIGN KEY (`programa_idprograma`) REFERENCES `programa` (`idprograma`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programas_has_laboratorios`
--

LOCK TABLES `programas_has_laboratorios` WRITE;
/*!40000 ALTER TABLE `programas_has_laboratorios` DISABLE KEYS */;
INSERT INTO `programas_has_laboratorios` VALUES (1,2),(1,4),(2,2),(2,3),(2,4),(3,2),(3,3),(3,4);
/*!40000 ALTER TABLE `programas_has_laboratorios` ENABLE KEYS */;
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

-- Dump completed on 2016-04-03 15:47:43
