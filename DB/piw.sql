-- MySQL dump 10.13  Distrib 8.0.12, for macos10.13 (x86_64)
--
-- Host: localhost    Database: piw
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Administrador`
--

DROP TABLE IF EXISTS `Administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Administrador` (
  `idAdministrador` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `contraseña` varchar(45) NOT NULL,
  `tipo` varchar(13) NOT NULL DEFAULT 'Administrador',
  PRIMARY KEY (`idAdministrador`),
  UNIQUE KEY `correo_UNIQUE` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Administrador`
--

LOCK TABLES `Administrador` WRITE;
/*!40000 ALTER TABLE `Administrador` DISABLE KEYS */;
INSERT INTO `Administrador` VALUES (1,'root','example@gmail.com','toor','Administrador');
/*!40000 ALTER TABLE `Administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Citas`
--

DROP TABLE IF EXISTS `Citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Citas` (
  `idCita` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idDentista` int(11) NOT NULL,
  PRIMARY KEY (`idCita`),
  KEY `fk_Cita_Usuario_idx` (`idUsuario`),
  KEY `fk_Cita_Dentista_idx` (`idDentista`),
  CONSTRAINT `fk_Cita_Dentista` FOREIGN KEY (`idDentista`) REFERENCES `dentista` (`iddentista`) ON DELETE CASCADE,
  CONSTRAINT `fk_Cita_Usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Citas`
--

LOCK TABLES `Citas` WRITE;
/*!40000 ALTER TABLE `Citas` DISABLE KEYS */;
INSERT INTO `Citas` VALUES (1,'2019-11-25','15:00:00',1,1),(2,'2019-11-26','13:00:00',2,1),(3,'2019-11-27','12:00:00',1,2),(4,'2019-11-28','14:00:00',2,2);
/*!40000 ALTER TABLE `Citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Dentista`
--

DROP TABLE IF EXISTS `Dentista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Dentista` (
  `idDentista` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `telefono` int(30) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `correo` varchar(45) NOT NULL,
  `contraseña` varchar(45) NOT NULL,
  `tipo` varchar(8) NOT NULL DEFAULT 'Dentista',
  PRIMARY KEY (`idDentista`),
  UNIQUE KEY `correo_UNIQUE` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Dentista`
--

LOCK TABLES `Dentista` WRITE;
/*!40000 ALTER TABLE `Dentista` DISABLE KEYS */;
INSERT INTO `Dentista` VALUES (1,'Gustavo','Cortes Galindo',2846296,22183902,'Avenida San Claudio 100 Jardines de San Manuel','Especialista en Ortodoncia graduado de la BUAP','d1@gmail.com','d1','Dentista'),(2,'Carlos','Reyes Cortes',304628,222830273,'Calle A 1014 Jardines de San Manuel','Especialidad en Entodoncia graduado de la BUAP','d2@gmail.com','d2','Dentista');
/*!40000 ALTER TABLE `Dentista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Solicitudes`
--

DROP TABLE IF EXISTS `Solicitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Solicitudes` (
  `idSolicitud` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `cedula` int(10) NOT NULL,
  `telefono` int(30) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `correo` varchar(45) NOT NULL,
  `contraseña` varchar(45) NOT NULL,
  `tipo` varchar(8) NOT NULL DEFAULT 'Dentista',
  PRIMARY KEY (`idSolicitud`),
  UNIQUE KEY `correo_UNIQUE` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Solicitudes`
--

LOCK TABLES `Solicitudes` WRITE;
/*!40000 ALTER TABLE `Solicitudes` DISABLE KEYS */;
INSERT INTO `Solicitudes` VALUES (1,'Ricardo','Ubaldo Velazquez',123456,221123456,'Calle C 1014 Jardines de San Manuel','Especialidad en Endodoncia graduado de la BUAP','ricardo_x18@hotmail.com','123456','Dentista'),(2,'Jahir','Ramos Lucero',654321,222865440,'Gran avenida 2002 CP 72000','Especialista en Ortodoncia graduado de la BUAP','javier_pr95@outlook.com','toor','Dentista');
/*!40000 ALTER TABLE `Solicitudes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `telefono` int(30) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `contraseña` varchar(45) NOT NULL,
  `tipo` varchar(7) DEFAULT 'Usuario',
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `correo_UNIQUE` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` VALUES (1,'Javier','Martinez Castillo',222123456,'Calle 24 poniente 104 colonia centro C.P. 72000','u1@gmail.com','u1','Usuario'),(2,'Pedro','García Jimenez',222987654,'Calle 18 poniente 1024','u2@gmail.com','u2','Usuario');
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

-- Dump completed on 2019-11-25 16:32:32
