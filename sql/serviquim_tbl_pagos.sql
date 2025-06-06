-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: serviquim
-- ------------------------------------------------------
-- Server version	8.0.39

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
-- Table structure for table `tbl_pagos`
--

DROP TABLE IF EXISTS `tbl_pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_pagos` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_USUARIO` int NOT NULL,
  `NOMBRE` varchar(45) NOT NULL,
  `APELLIDO_PATERNO` varchar(45) NOT NULL,
  `APELLIDO_MATERNO` varchar(45) NOT NULL,
  `CODIGO_POSTAL` varchar(45) NOT NULL,
  `ESTADO` varchar(100) NOT NULL,
  `MUNICIPIO` varchar(100) NOT NULL,
  `CALLE` varchar(100) NOT NULL,
  `NUMERO_EXTERIOR` varchar(45) NOT NULL,
  `NUMERO_INTERIOR` varchar(45) NOT NULL,
  `NUMERO_TARJETA` varchar(16) NOT NULL,
  `CVC` varchar(3) NOT NULL,
  `MES` varchar(2) NOT NULL,
  `YEAR` varchar(4) NOT NULL,
  `IS_ACTIVO` tinyint NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID-USUARIO-PAGOS_idx` (`ID_USUARIO`),
  CONSTRAINT `ID-USUARIO-PAGOS` FOREIGN KEY (`ID_USUARIO`) REFERENCES `tbl_usuarios` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pagos`
--

LOCK TABLES `tbl_pagos` WRITE;
/*!40000 ALTER TABLE `tbl_pagos` DISABLE KEYS */;
INSERT INTO `tbl_pagos` VALUES (30,10,'1','1','1','1','1','1','1','1','1','1','1','1','1',1),(31,10,'1','1','1','1','1','1','1','1','1','1','1','1','1',1);
/*!40000 ALTER TABLE `tbl_pagos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-28 17:45:20
