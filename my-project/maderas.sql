-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: maderas
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `abonoarticulo`
--

DROP TABLE IF EXISTS `abonoarticulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abonoarticulo` (
  `abonoArticulo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `folioAbono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fkComprasCliente` bigint(20) unsigned NOT NULL,
  `fkEmpleado` bigint(20) unsigned NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `fecha` datetime NOT NULL,
  `abono` decimal(10,2) NOT NULL,
  `Saldo` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fkConcepto` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`abonoArticulo`),
  KEY `abonoarticulo_fkcomprascliente_foreign` (`fkComprasCliente`),
  KEY `abonoarticulo_fkempleado_foreign` (`fkEmpleado`),
  KEY `fk_abonoArticulo_concepto` (`fkConcepto`),
  CONSTRAINT `abonoarticulo_fkcomprascliente_foreign` FOREIGN KEY (`fkComprasCliente`) REFERENCES `comprascliente` (`pkcomprasCliente`),
  CONSTRAINT `abonoarticulo_fkempleado_foreign` FOREIGN KEY (`fkEmpleado`) REFERENCES `empleado` (`pkEmpleado`),
  CONSTRAINT `fk_abonoArticulo_concepto` FOREIGN KEY (`fkConcepto`) REFERENCES `concepto` (`pkConcepto`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abonoarticulo`
--

LOCK TABLES `abonoarticulo` WRITE;
/*!40000 ALTER TABLE `abonoarticulo` DISABLE KEYS */;
INSERT INTO `abonoarticulo` VALUES (1,'65f75545d8e11',2,1,1,'2024-03-17 13:40:37',100.00,1800.00,NULL,NULL,1),(2,'6605015e517e9',4,3,1,'2024-03-27 22:34:22',200.00,1800.00,NULL,NULL,1),(3,'6632fb319d812',11,1,1,'2024-05-01 20:32:17',100.00,2700.00,NULL,NULL,1),(4,'666df718bfcbd',4,1,1,'2024-06-15 14:18:32',333.00,1600.00,NULL,NULL,1),(5,'666f2abcb869c',4,1,1,'2024-06-16 12:11:08',0.00,1700.00,NULL,NULL,NULL),(6,'666f2b4d9a8b7',4,1,1,'2024-06-16 12:13:33',0.00,1700.00,NULL,NULL,NULL),(7,'666f2f29eff62',4,1,1,'2024-06-16 12:30:01',0.00,1700.00,NULL,NULL,NULL),(8,'666f344d37537',19,1,1,'2024-06-16 12:51:57',100.00,1000.00,NULL,NULL,1),(9,'666f368017358',19,1,1,'2024-06-16 13:01:20',0.00,2900.00,NULL,NULL,NULL),(11,'666f3829b0fa3',19,1,1,'2024-06-16 13:08:25',0.00,2000.00,NULL,NULL,5),(12,'666f3b09ed456',19,1,1,'2024-06-16 13:20:41',0.00,2000.00,NULL,NULL,5),(13,'666f3b27b2896',19,1,1,'2024-06-16 13:21:11',0.00,2000.00,NULL,NULL,5),(14,'666f3b90d7273',19,1,1,'2024-06-16 13:22:56',0.00,2000.00,NULL,NULL,5),(15,'666f3c2730f90',19,1,1,'2024-06-16 13:25:27',0.00,2000.00,NULL,NULL,5),(20,'666f467a5c2c8',19,1,1,'2024-06-16 20:09:30',2000.00,2000.00,NULL,NULL,2),(21,'666f477685843',19,1,1,'2024-06-16 14:13:42',900.00,2000.00,NULL,NULL,6),(22,'66707416d808a',14,1,1,'2024-06-17 17:36:22',3000.00,3000.00,NULL,NULL,2);
/*!40000 ALTER TABLE `abonoarticulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articulo`
--

DROP TABLE IF EXISTS `articulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulo` (
  `pkArticulo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombreArticulo` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fkCategoriaArticulo` bigint(20) unsigned NOT NULL,
  `cantidadMinima` int(11) NOT NULL,
  `cantidadActual` int(11) NOT NULL,
  `abonoOchoDias` decimal(10,2) NOT NULL,
  `abonoQuinceDias` decimal(10,2) NOT NULL,
  `abonoTreintaDias` decimal(10,2) NOT NULL,
  `imagenArticulo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatus` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkArticulo`),
  KEY `articulo_fkcategoriaarticulo_foreign` (`fkCategoriaArticulo`),
  CONSTRAINT `articulo_fkcategoriaarticulo_foreign` FOREIGN KEY (`fkCategoriaArticulo`) REFERENCES `categoriaarticulo` (`pkCategoriaArticulo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulo`
--

LOCK TABLES `articulo` WRITE;
/*!40000 ALTER TABLE `articulo` DISABLE KEYS */;
INSERT INTO `articulo` VALUES (1,'mueble 5',1,10,-85,100.00,200.00,300.00,'images/4o0aFIOvOtHxrMIA7bWyEsGPFyK7kcHRgVG7YPN9.jpg',0,NULL,NULL),(2,'mueble 5555',1,10,-100,100.00,200.00,300.00,'images/XgV9tH5hZiPWV3rN2PujXsNCV63LM6vU4ktBidFE.jpg',2,NULL,NULL),(3,'mueble 56767',1,1212,1212,1.00,2.00,3.00,NULL,3,NULL,NULL),(4,'mueble equisde',1,1212,1211,1.00,2.00,3.00,NULL,2,NULL,NULL),(5,'cama mediana',1,5,-120,10.00,20.00,30.00,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `articulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articulotipoventa`
--

DROP TABLE IF EXISTS `articulotipoventa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulotipoventa` (
  `pkArticuloTipoVenta` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fkTipoVenta` bigint(20) unsigned NOT NULL,
  `fkArticulo` bigint(20) unsigned NOT NULL,
  `cantidadTipoVenta` decimal(10,2) NOT NULL,
  `enganche` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkArticuloTipoVenta`),
  KEY `articulotipoventa_fktipoventa_foreign` (`fkTipoVenta`),
  KEY `articulotipoventa_fkarticulo_foreign` (`fkArticulo`),
  CONSTRAINT `articulotipoventa_fkarticulo_foreign` FOREIGN KEY (`fkArticulo`) REFERENCES `articulo` (`pkArticulo`),
  CONSTRAINT `articulotipoventa_fktipoventa_foreign` FOREIGN KEY (`fkTipoVenta`) REFERENCES `tipoventa` (`pkTipoVenta`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulotipoventa`
--

LOCK TABLES `articulotipoventa` WRITE;
/*!40000 ALTER TABLE `articulotipoventa` DISABLE KEYS */;
INSERT INTO `articulotipoventa` VALUES (1,1,1,1000.00,0.00,NULL,NULL),(2,2,1,1000.00,100.00,NULL,NULL),(3,3,1,2000.00,200.00,NULL,NULL),(4,4,1,3000.00,300.00,NULL,NULL),(5,1,2,1000.00,0.00,NULL,NULL),(6,2,2,1000.00,100.00,NULL,NULL),(7,3,2,3000.00,300.00,NULL,NULL),(8,4,2,3000.00,300.00,NULL,NULL),(9,1,3,1212.00,0.00,NULL,NULL),(10,2,3,121.00,1212.00,NULL,NULL),(11,3,3,1212.00,1212.00,NULL,NULL),(12,4,3,1212.00,1212.00,NULL,NULL),(13,1,4,1212.00,0.00,NULL,NULL),(14,2,4,121.00,1212.00,NULL,NULL),(15,3,4,2212.00,1212.00,NULL,NULL),(16,4,4,3212.00,1212.00,NULL,NULL),(17,1,5,1000.00,0.00,NULL,NULL),(18,2,5,2000.00,400.00,NULL,NULL),(19,3,5,3000.00,400.00,NULL,NULL),(20,4,5,4000.00,400.00,NULL,NULL);
/*!40000 ALTER TABLE `articulotipoventa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calle`
--

DROP TABLE IF EXISTS `calle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calle` (
  `pkCalle` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombreCalle` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fkColonia` bigint(20) unsigned NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkCalle`),
  KEY `calle_fkcolonia_foreign` (`fkColonia`),
  CONSTRAINT `calle_fkcolonia_foreign` FOREIGN KEY (`fkColonia`) REFERENCES `colonia` (`pkColonia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calle`
--

LOCK TABLES `calle` WRITE;
/*!40000 ALTER TABLE `calle` DISABLE KEYS */;
/*!40000 ALTER TABLE `calle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cambiosarticulos`
--

DROP TABLE IF EXISTS `cambiosarticulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cambiosarticulos` (
  `pkCambiosArticulos` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fkMovimientosArticulos` bigint(20) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fkArticulo` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkCambiosArticulos`),
  KEY `fkMovimientosArticulos` (`fkMovimientosArticulos`),
  KEY `fkArticulo` (`fkArticulo`),
  CONSTRAINT `cambiosarticulos_ibfk_1` FOREIGN KEY (`fkMovimientosArticulos`) REFERENCES `movimientosarticulos` (`pkMovimientosArticulos`),
  CONSTRAINT `cambiosarticulos_ibfk_2` FOREIGN KEY (`fkArticulo`) REFERENCES `articulo` (`pkArticulo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cambiosarticulos`
--

LOCK TABLES `cambiosarticulos` WRITE;
/*!40000 ALTER TABLE `cambiosarticulos` DISABLE KEYS */;
INSERT INTO `cambiosarticulos` VALUES (1,52,10,2,NULL,NULL),(2,54,10,2,NULL,NULL),(3,56,10,2,NULL,NULL),(4,58,10,2,NULL,NULL);
/*!40000 ALTER TABLE `cambiosarticulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoriaarticulo`
--

DROP TABLE IF EXISTS `categoriaarticulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoriaarticulo` (
  `pkCategoriaArticulo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombreCategoriaArticulo` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkCategoriaArticulo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoriaarticulo`
--

LOCK TABLES `categoriaarticulo` WRITE;
/*!40000 ALTER TABLE `categoriaarticulo` DISABLE KEYS */;
INSERT INTO `categoriaarticulo` VALUES (1,'Muebles',1,NULL,NULL);
/*!40000 ALTER TABLE `categoriaarticulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `pkCliente` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombreCliente` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fkColonia` bigint(20) unsigned NOT NULL,
  `calle` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numCasa` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcionDomicilio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagenDomicilio` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatus` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkCliente`),
  KEY `cliente_fkcolonia_foreign` (`fkColonia`),
  CONSTRAINT `cliente_fkcolonia_foreign` FOREIGN KEY (`fkColonia`) REFERENCES `colonia` (`pkColonia`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Ivan Alberto','6941197826',1,'Ignacio Allende','77','holiwis uwu','images/ZJ9WeY9gDuzfBo6JW9upTzLA0Yox6xsu4nazIW8v.jpg',0,NULL,NULL),(2,'Ernesto Osuna','6941197826',1,'Ignacio Allende','11','sdkdkdksj','images/6VQ1n5zkfhO1ILFTlA927IEKfhRVvQkG4Gl5bWWt.jpg',0,NULL,NULL),(3,'Ernesto Osuna','434334',1,'xsaadsd','22','jjjj','images/EADKNc2iZjMFbCtFIBhVM7mAJsFuwt3jQltYSugC.jpg',1,NULL,NULL),(4,'Ernesto Osuna','434334',1,'xsaadsd','22','jjjj','images/mk9wsFPOiN8RlYT888HrIhXYWlvAVC9NzC3XCIei.jpg',1,NULL,NULL),(5,'eduardo','6941197826',1,'jjwsjksdj','22','sjjefjkekefdjk',NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colonia`
--

DROP TABLE IF EXISTS `colonia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colonia` (
  `pkColonia` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombreColonia` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fkMunicipio` bigint(20) unsigned NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkColonia`),
  KEY `colonia_fkmunicipio_foreign` (`fkMunicipio`),
  CONSTRAINT `colonia_fkmunicipio_foreign` FOREIGN KEY (`fkMunicipio`) REFERENCES `municipio` (`pkMunicipio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colonia`
--

LOCK TABLES `colonia` WRITE;
/*!40000 ALTER TABLE `colonia` DISABLE KEYS */;
INSERT INTO `colonia` VALUES (1,'Centro',1,0,NULL,NULL),(2,'hhh',2,1,NULL,NULL);
/*!40000 ALTER TABLE `colonia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprascliente`
--

DROP TABLE IF EXISTS `comprascliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comprascliente` (
  `pkcomprasCliente` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `folioCompra` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fkCliente` bigint(20) unsigned NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `fecha` date NOT NULL,
  `cantidadASaldar` decimal(10,2) NOT NULL,
  `fkArticuloTipoVenta` bigint(20) unsigned NOT NULL,
  `estatusDeCobro` smallint(6) NOT NULL,
  `fkEmpleado` bigint(20) unsigned DEFAULT NULL,
  `diasDeuda` int(11) DEFAULT NULL,
  `ordenReparto` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkcomprasCliente`),
  KEY `comprascliente_fkcliente_foreign` (`fkCliente`),
  KEY `comprascliente_fkarticulotipoventa_foreign` (`fkArticuloTipoVenta`),
  KEY `comprascliente_fkempleado_foreign` (`fkEmpleado`),
  CONSTRAINT `comprascliente_fkarticulotipoventa_foreign` FOREIGN KEY (`fkArticuloTipoVenta`) REFERENCES `articulotipoventa` (`pkArticuloTipoVenta`),
  CONSTRAINT `comprascliente_fkcliente_foreign` FOREIGN KEY (`fkCliente`) REFERENCES `cliente` (`pkCliente`),
  CONSTRAINT `comprascliente_fkempleado_foreign` FOREIGN KEY (`fkEmpleado`) REFERENCES `empleado` (`pkEmpleado`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprascliente`
--

LOCK TABLES `comprascliente` WRITE;
/*!40000 ALTER TABLE `comprascliente` DISABLE KEYS */;
INSERT INTO `comprascliente` VALUES (1,'65f72c653c567',1,1,'2024-03-17',0.00,3,0,NULL,3,NULL,NULL,NULL),(2,'65f72c653f967',1,1,'2024-03-17',2900.00,3,0,3,NULL,2,NULL,NULL),(3,'65f72ebb4e683',1,0,'2024-03-17',1000.00,2,1,NULL,NULL,NULL,NULL,NULL),(4,'65f72ebb51604',1,0,'2024-03-17',1267.00,4,0,3,NULL,1,NULL,NULL),(5,'65f7484662a84',1,0,'2024-03-17',0.00,1,0,NULL,NULL,NULL,NULL,NULL),(6,'65f748cb92846',1,0,'2024-03-17',0.00,1,0,NULL,NULL,NULL,NULL,NULL),(7,'65f7497232e67',1,0,'2024-03-17',0.00,1,0,NULL,NULL,NULL,NULL,NULL),(8,'65f749ca01c1c',1,0,'2024-03-17',0.00,1,0,NULL,NULL,NULL,NULL,NULL),(9,'65f749f776fbf',1,0,'2024-03-17',0.00,1,0,NULL,NULL,NULL,NULL,NULL),(10,'660500e3c3539',2,0,'2024-03-27',0.00,5,0,NULL,NULL,NULL,NULL,NULL),(11,'660500e3c57f2',2,1,'2024-03-27',2600.00,7,0,3,NULL,2,NULL,NULL),(12,'6632faa51f232',4,0,'2024-05-01',0.00,5,0,NULL,NULL,NULL,NULL,NULL),(13,'6632faf52e967',2,0,'2024-05-01',0.00,5,0,NULL,NULL,NULL,NULL,NULL),(14,'6632fb53b254d',4,1,'2024-05-01',3000.00,7,1,3,NULL,NULL,NULL,NULL),(15,'6632fb616b590',1,1,'2024-05-01',2700.00,8,1,3,NULL,NULL,NULL,NULL),(16,'665e51ad20f86',5,0,'2024-06-03',0.00,5,0,NULL,NULL,NULL,NULL,NULL),(17,'665e51ad2253c',5,1,'2024-06-03',2700.00,7,1,NULL,NULL,NULL,NULL,NULL),(18,'666f312e1895f',4,1,'2024-06-16',0.00,15,1,NULL,NULL,NULL,NULL,NULL),(19,'298392euwd',2,0,'2024-06-16',0.00,2,0,2,NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `comprascliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `concepto`
--

DROP TABLE IF EXISTS `concepto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `concepto` (
  `pkConcepto` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombreConcepto` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkConcepto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `concepto`
--

LOCK TABLES `concepto` WRITE;
/*!40000 ALTER TABLE `concepto` DISABLE KEYS */;
INSERT INTO `concepto` VALUES (1,'Abono',NULL,NULL),(2,'Interés Morat\r\n',NULL,NULL),(3,'cambio de un mes a dos meses',NULL,NULL),(4,'cambio de un mes a un año',NULL,NULL),(5,'cambio de dos meses a un año',NULL,NULL),(6,'liquidación a un mes',NULL,NULL),(7,'liquidación a dos meses',NULL,NULL);
/*!40000 ALTER TABLE `concepto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos` (
  `pkDocumentos` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fkCliente` bigint(20) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkDocumentos`),
  KEY `documentos_fkcliente_foreign` (`fkCliente`),
  CONSTRAINT `documentos_fkcliente_foreign` FOREIGN KEY (`fkCliente`) REFERENCES `cliente` (`pkCliente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` VALUES (1,1,'stories_questions_Kevin_Llamas.pdf','public/3S0fboIih1jYWElEKGih7EEMIbfMRk1ER8zudJ8a.pdf',NULL,NULL),(2,1,'UcAka9O2nCoTxoNc27IemATIZ1Ec8IE4wxI2safA.pdf','public/WpN4YNf2HWWyZzyFth2cZT8Std9Vxx5wbqs9CKyJ.pdf',NULL,NULL),(3,2,'buy-svgrepo-com.svg','public/4NxHuW0yU0CWwYlfp8ZTrhGNoWZrrkc25sWrcJlE.svg',NULL,NULL),(4,2,'money-check-dollar-pen-svgrepo-com.svg','public/gEGvGMMgvycmw6ttSwi3i2ofnf1tzNjFHkRlh9M0.svg',NULL,NULL);
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `pkEmpleado` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombreEmpleado` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fkColonia` bigint(20) unsigned NOT NULL,
  `calle` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numCasa` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreUsuario` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contraseña` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fkTipoUsuario` bigint(20) unsigned NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkEmpleado`),
  KEY `empleado_fkcolonia_foreign` (`fkColonia`),
  KEY `empleado_fktipousuario_foreign` (`fkTipoUsuario`),
  CONSTRAINT `empleado_fkcolonia_foreign` FOREIGN KEY (`fkColonia`) REFERENCES `colonia` (`pkColonia`),
  CONSTRAINT `empleado_fktipousuario_foreign` FOREIGN KEY (`fkTipoUsuario`) REFERENCES `tipousuario` (`pkTipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'jefe',1,'ignacio allende','22','6941159726','jefe','jefe',1,1,NULL,NULL),(2,'Eliana Alvarez',1,'Ignacio Allende','66','6941197826','empleadito','empleadito',3,1,NULL,NULL),(3,'Elian Estrada Palomares',1,'Ignacio Allende','22','6941197826','cobrador','cobrador',2,1,NULL,NULL);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listaabono`
--

DROP TABLE IF EXISTS `listaabono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `listaabono` (
  `pkListaAbono` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fkArticulo` bigint(20) unsigned NOT NULL,
  `fkEmpleado` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkListaAbono`),
  KEY `listaabono_fkarticulo_foreign` (`fkArticulo`),
  KEY `listaabono_fkempleado_foreign` (`fkEmpleado`),
  CONSTRAINT `listaabono_fkarticulo_foreign` FOREIGN KEY (`fkArticulo`) REFERENCES `articulo` (`pkArticulo`),
  CONSTRAINT `listaabono_fkempleado_foreign` FOREIGN KEY (`fkEmpleado`) REFERENCES `empleado` (`pkEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listaabono`
--

LOCK TABLES `listaabono` WRITE;
/*!40000 ALTER TABLE `listaabono` DISABLE KEYS */;
/*!40000 ALTER TABLE `listaabono` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2023_03_10_180400_create_sessions_table',1),(7,'2023_12_21_220442_create_municipio_table',1),(8,'2023_12_21_221906_create_colonia_table',1),(9,'2023_12_21_221918_create_calle_table',1),(10,'2023_12_21_221955_create_cliente_table',1),(11,'2023_12_21_222003_create_categoria_articulo_table',1),(12,'2023_12_21_222005_create_articulo_table',1),(13,'2023_12_21_222029_create_tipo_movimiento_table',1),(14,'2023_12_21_222112_create_tipo_usuario_table',1),(15,'2023_12_21_222113_create_empleado_table',1),(16,'2023_12_21_222114_create_movimientos_articulos_table',1),(17,'2023_12_21_222125_create_lista_abono_table',1),(18,'2023_12_21_222138_create_tipo_venta_table',1),(19,'2023_12_21_222139_create_articulo_tipo_venta_table',1),(20,'2023_12_21_222220_create_compras_cliente_table',1),(21,'2023_12_21_222221_create_abono_articulo_table',1),(22,'2024_03_13_014345_create_documentos_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientosarticulos`
--

DROP TABLE IF EXISTS `movimientosarticulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimientosarticulos` (
  `pkMovimientosArticulos` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fkArticulo` bigint(20) unsigned NOT NULL,
  `fkTipoMovimiento` bigint(20) unsigned NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `fkEmpleado` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkMovimientosArticulos`),
  KEY `movimientosarticulos_fkempleado_foreign` (`fkEmpleado`),
  KEY `movimientosarticulos_fkarticulo_foreign` (`fkArticulo`),
  KEY `movimientosarticulos_fktipomovimiento_foreign` (`fkTipoMovimiento`),
  CONSTRAINT `movimientosarticulos_fkarticulo_foreign` FOREIGN KEY (`fkArticulo`) REFERENCES `articulo` (`pkArticulo`),
  CONSTRAINT `movimientosarticulos_fkempleado_foreign` FOREIGN KEY (`fkEmpleado`) REFERENCES `empleado` (`pkEmpleado`),
  CONSTRAINT `movimientosarticulos_fktipomovimiento_foreign` FOREIGN KEY (`fkTipoMovimiento`) REFERENCES `tipomovimiento` (`pktipoMovimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientosarticulos`
--

LOCK TABLES `movimientosarticulos` WRITE;
/*!40000 ALTER TABLE `movimientosarticulos` DISABLE KEYS */;
INSERT INTO `movimientosarticulos` VALUES (1,1,2,1,'2024-03-17',1,NULL,NULL),(2,1,2,1,'2024-03-17',1,NULL,NULL),(3,1,2,1,'2024-03-17',1,NULL,NULL),(4,1,2,1,'2024-03-17',1,NULL,NULL),(5,1,2,1,'2024-03-17',1,NULL,NULL),(6,1,2,1,'2024-03-17',1,NULL,NULL),(7,1,2,1,'2024-03-17',1,NULL,NULL),(8,1,2,1,'2024-03-17',1,NULL,NULL),(9,1,2,1,'2024-03-17',1,NULL,NULL),(10,1,1,15,'2024-03-20',1,NULL,NULL),(11,2,3,0,'2024-03-21',1,NULL,NULL),(12,2,2,1,'2024-03-27',1,NULL,NULL),(13,2,2,1,'2024-03-27',1,NULL,NULL),(14,2,2,1,'2024-05-01',1,NULL,NULL),(15,2,2,1,'2024-05-01',1,NULL,NULL),(16,2,2,1,'2024-05-01',1,NULL,NULL),(17,2,2,1,'2024-05-01',1,NULL,NULL),(18,2,3,0,'2024-06-03',1,NULL,NULL),(19,2,2,1,'2024-06-03',1,NULL,NULL),(20,2,2,1,'2024-06-03',1,NULL,NULL),(21,2,3,0,'2024-06-15',1,NULL,NULL),(22,2,3,0,'2024-06-15',1,NULL,NULL),(23,2,3,0,'2024-06-15',1,NULL,NULL),(24,2,3,0,'2024-06-15',1,NULL,NULL),(25,2,3,0,'2024-06-15',1,NULL,NULL),(26,2,3,0,'2024-06-15',1,NULL,NULL),(27,2,3,0,'2024-06-15',1,NULL,NULL),(28,4,4,0,'2024-06-15',1,NULL,NULL),(29,4,2,1,'2024-06-16',1,NULL,NULL),(30,4,3,0,'2024-06-16',1,NULL,NULL),(31,5,4,0,'2024-06-17',1,NULL,NULL),(32,1,5,10,'2024-06-17',1,NULL,NULL),(33,1,5,10,'2024-06-17',1,NULL,NULL),(34,5,5,10,'2024-06-17',1,NULL,NULL),(35,5,5,10,'2024-06-17',1,NULL,NULL),(36,5,5,10,'2024-06-17',1,NULL,NULL),(37,5,5,10,'2024-06-17',1,NULL,NULL),(38,5,5,10,'2024-06-17',1,NULL,NULL),(39,5,5,10,'2024-06-17',1,NULL,NULL),(40,5,5,10,'2024-06-17',1,NULL,NULL),(41,5,5,10,'2024-06-17',1,NULL,NULL),(42,5,5,10,'2024-06-17',1,NULL,NULL),(43,1,5,10,'2024-06-17',1,NULL,NULL),(44,1,5,10,'2024-06-17',1,NULL,NULL),(45,1,5,10,'2024-06-17',1,NULL,NULL),(46,1,5,10,'2024-06-17',1,NULL,NULL),(47,1,5,10,'2024-06-17',1,NULL,NULL),(48,1,5,10,'2024-06-17',1,NULL,NULL),(49,1,5,10,'2024-06-17',1,NULL,NULL),(50,1,5,10,'2024-06-17',1,NULL,NULL),(52,1,5,10,'2024-06-17',1,NULL,NULL),(53,5,5,10,'2024-06-18',1,NULL,NULL),(54,5,5,10,'2024-06-18',1,NULL,NULL),(55,2,5,10,'2024-06-18',1,NULL,NULL),(56,5,5,10,'2024-06-18',1,NULL,NULL),(57,2,5,10,'2024-06-18',1,NULL,NULL),(58,5,5,10,'2024-06-18',1,NULL,NULL),(59,2,1,10,'2024-06-18',1,NULL,NULL);
/*!40000 ALTER TABLE `movimientosarticulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipio`
--

DROP TABLE IF EXISTS `municipio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipio` (
  `pkMunicipio` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombreMunicipio` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkMunicipio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipio`
--

LOCK TABLES `municipio` WRITE;
/*!40000 ALTER TABLE `municipio` DISABLE KEYS */;
INSERT INTO `municipio` VALUES (1,'El Rosario',0,NULL,NULL),(2,'hhh',0,NULL,NULL),(3,'HELLO',1,NULL,NULL),(4,'WORLD',0,NULL,NULL),(5,'PRINT',0,NULL,NULL);
/*!40000 ALTER TABLE `municipio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipomovimiento`
--

DROP TABLE IF EXISTS `tipomovimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipomovimiento` (
  `pktipoMovimiento` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombreTipoMovimiento` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pktipoMovimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipomovimiento`
--

LOCK TABLES `tipomovimiento` WRITE;
/*!40000 ALTER TABLE `tipomovimiento` DISABLE KEYS */;
INSERT INTO `tipomovimiento` VALUES (1,'Abastecimiento',NULL,NULL),(2,'Desabastecimiento',NULL,NULL),(3,'Edición de articulo',NULL,NULL),(4,'Añadido',NULL,NULL),(5,'conversion de articulo ',NULL,NULL);
/*!40000 ALTER TABLE `tipomovimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipousuario` (
  `pkTipoUsuario` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombreTipoUsuario` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkTipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipousuario`
--

LOCK TABLES `tipousuario` WRITE;
/*!40000 ALTER TABLE `tipousuario` DISABLE KEYS */;
INSERT INTO `tipousuario` VALUES (1,'Administrador',NULL,NULL),(2,'Cobrador',NULL,NULL),(3,'Empleado',NULL,NULL);
/*!40000 ALTER TABLE `tipousuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoventa`
--

DROP TABLE IF EXISTS `tipoventa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoventa` (
  `pkTipoVenta` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombreTipoVenta` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkTipoVenta`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoventa`
--

LOCK TABLES `tipoventa` WRITE;
/*!40000 ALTER TABLE `tipoventa` DISABLE KEYS */;
INSERT INTO `tipoventa` VALUES (1,'Precio al contado',NULL,NULL),(2,'Precio al Mes',NULL,NULL),(3,'Precio 2 Meses',NULL,NULL),(4,'Precio a un Año',NULL,NULL);
/*!40000 ALTER TABLE `tipoventa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-18  9:42:13
