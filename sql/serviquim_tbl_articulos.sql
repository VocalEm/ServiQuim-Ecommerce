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
-- Table structure for table `tbl_articulos`
--

DROP TABLE IF EXISTS `tbl_articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_articulos` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `SKU` varchar(50) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `DESCRIPCION` mediumtext,
  `CATEGORIA` int DEFAULT NULL,
  `MARCA` int NOT NULL,
  `IMAGEN` varchar(45) DEFAULT NULL,
  `PRECIO` decimal(10,2) NOT NULL,
  `IS_ACTIVO` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `SKU_UNIQUE` (`SKU`),
  KEY `MARCA_idx` (`MARCA`),
  KEY `CATEGORIA_idx` (`CATEGORIA`),
  CONSTRAINT `CATEGORIA` FOREIGN KEY (`CATEGORIA`) REFERENCES `tbl_categorias` (`ID`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `MARCA` FOREIGN KEY (`MARCA`) REFERENCES `tbl_marcas` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_articulos`
--

LOCK TABLES `tbl_articulos` WRITE;
/*!40000 ALTER TABLE `tbl_articulos` DISABLE KEYS */;
INSERT INTO `tbl_articulos` VALUES (2,'D-1-1-1','Dispensador Bobina TORK','Excelente dispensador bobina para toalla rollo, efectivo para el area de trabajo. Mejorando la productividad y la limpieza del personal',1,1,'Dispensador_circular_higienico.jpg',800.00,1),(3,'D-1-1-2','Dispensador Cuadrado TORK','Minimalista y efectivo, sin necesidad de ocupar mucho espacio en el trabajo mejora la productividad y la higiene de tu area de trabajo',1,1,'Dispensador_toalla_negro.jpg',750.00,1),(4,'D-1-1-3','Dispensador Clasico TORK','Lo bueno nunca pasa de moda, diseño robusto, confiable y funcional este dispensador de toalla rollo tiene todo lo necesario para la productividad de la oficina.',1,1,'Dispensador_clasico.webp',650.00,1),(5,'D-1-1-4','Dispensador Jabon TORK','Intuitivo y robusto este dispensador especialmente diseñados para los baños del area de trabajo tienen gran durabilidad y logran mantener la higiene en la oficina',1,1,'Dispensador_jabon_negro.webp',900.00,1),(6,'D-1-1-5','Dispensador Jabon Blanco TORK','Intuitivo y robusto este dispensador especialmente diseñados para los baños del area de trabajo tienen gran durabilidad y logran mantener la higiene en la oficina',1,1,'Dispensador_jabon_blanco.jpg',850.00,1),(7,'D-1-1-6','Dispensador Higienico - Color Negro','Facil de usar y recargar, este dispensador de papel higienico es perfecto para hacer efectivo el uso del papel en la oficina',1,1,'Dispensador_higienico_negro.webp',800.00,1),(8,'D-1-1-7','Dispensador Higienico - Color Blanco','Facil de usar y recargar, este dispensador de papel higienico es perfecto para hacer efectivo el uso del papel en la oficina',1,1,'Dispensador_higienico_blanco.webp',600.00,1),(9,'D-1-1-8','Dispensador Servilleta - Color Negro','Para tu comedor o para tu restaurante este dispensador controla el gasto de servilletas, logrando un ahorro y mostrando compromiso con la higiene.',1,1,'Dispensador_servilleta_negro.jpg',500.00,1),(10,'P-3-1-1','Paquete de Servilleta TORK','Papel de servilleta, excelente para tus dispensadores y tu negocio.',3,1,'Papel_servilleta_tork.jpg',200.00,1),(11,'P-3-3-2','Paquete Elite Premium','Toalla rollo de la mas alta calidad para la limpieza de los espacios de trabajo y la de tus empleados.',3,3,'Papel_Elite_Premium.png',350.00,1),(12,'P-3-3-3','Paquete Elite MaxWipe','Toalla rollo extra absorbente para limpiar la mayor cantidad de liquido posible, excelente para la limpieza de muebles y objetos',3,3,'Papel_Elite_Max.jpeg',400.00,1),(13,'Q-4-4-1','SQR-100 N','Desengrasante Neutro concentrado Manufacturado por SERVIQUIM',4,4,'Quimico_rojo.jpg',600.00,1),(14,'Q-4-4-2','CAR-WASH-T','Jabon para carroceria Manufacturado por SERVIQUIM',4,4,'Quimico_rosa.png',650.00,1),(15,'Q-4-4-3','LAVALIT BIOLIMON','Detergente sin enjuage, excelente limpiador neutro Manufacturado por SERVIQUIM',4,4,'Quimico_amarillo.jpg',750.00,1),(16,'Q-4-4-4','BRILLOLIT','Protector para rines y llantas Manufacturado por SERVIQUIM',4,4,'Quimico_negro.png',650.00,1),(17,'Q-4-4-5','GREASER WASTE','Sistema para eliminación de grasas y residuos en tuberías Manufacturado por SERVIQUIM',4,4,'Quimico_verde.jpg',450.00,1),(18,'Q-4-4-6','BRILLOLIT ODM','Brillo y protección para llantas Manufacturado por SERVIQUIM',4,4,'Quimico_azul.png',750.00,1);
/*!40000 ALTER TABLE `tbl_articulos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-28 17:45:21
