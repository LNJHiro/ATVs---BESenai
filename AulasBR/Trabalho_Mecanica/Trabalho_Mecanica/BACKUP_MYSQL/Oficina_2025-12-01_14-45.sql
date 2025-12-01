-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: Oficina
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `Oficina`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `Oficina` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `Oficina`;

--
-- Table structure for table `assume`
--

DROP TABLE IF EXISTS `assume`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assume` (
  `ID_Mecanico` int NOT NULL,
  `ID_OS` int NOT NULL,
  PRIMARY KEY (`ID_Mecanico`,`ID_OS`),
  KEY `ID_OS` (`ID_OS`),
  CONSTRAINT `assume_ibfk_1` FOREIGN KEY (`ID_Mecanico`) REFERENCES `mecanico` (`ID_Mecanico`),
  CONSTRAINT `assume_ibfk_2` FOREIGN KEY (`ID_OS`) REFERENCES `os` (`ID_OS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assume`
--

LOCK TABLES `assume` WRITE;
/*!40000 ALTER TABLE `assume` DISABLE KEYS */;
/*!40000 ALTER TABLE `assume` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `ID_Cliente` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `CPF` varchar(11) DEFAULT NULL,
  `Telefone` varchar(15) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_Cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Carlos Silva','12345678901','11987654321','carlos.silva@gmail.com'),(2,'Mariana Oliveira','98765432100','11999887766','mariana.oliveira@gmail.com'),(3,'João Pereira','45678912300','11988776655','joao.pereira@hotmail.com');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contem`
--

DROP TABLE IF EXISTS `contem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contem` (
  `ID_Estoque` int NOT NULL,
  `ID_Peca` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_Estoque`,`ID_Peca`),
  KEY `ID_Peca` (`ID_Peca`),
  CONSTRAINT `contem_ibfk_1` FOREIGN KEY (`ID_Estoque`) REFERENCES `estoque` (`ID_Estoque`),
  CONSTRAINT `contem_ibfk_2` FOREIGN KEY (`ID_Peca`) REFERENCES `peca` (`ID_Peca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contem`
--

LOCK TABLES `contem` WRITE;
/*!40000 ALTER TABLE `contem` DISABLE KEYS */;
/*!40000 ALTER TABLE `contem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estoque`
--

DROP TABLE IF EXISTS `estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estoque` (
  `ID_Estoque` int NOT NULL AUTO_INCREMENT,
  `ID_Peca` varchar(20) DEFAULT NULL,
  `Quantidade` int NOT NULL,
  `Quantidade_Minima` int DEFAULT '5',
  `Localizacao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Estoque`),
  KEY `ID_Peca` (`ID_Peca`),
  CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`ID_Peca`) REFERENCES `peca` (`ID_Peca`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estoque`
--

LOCK TABLES `estoque` WRITE;
/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
INSERT INTO `estoque` VALUES (1,'FILTRO-001',25,5,'Prateleira A1'),(2,'PAST-001',12,4,'Prateleira B2'),(3,'VELA-001',30,8,'Prateleira C3'),(4,'CORR-001',2,2,'Prateleira D4');
/*!40000 ALTER TABLE `estoque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gera`
--

DROP TABLE IF EXISTS `gera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gera` (
  `ID_Veiculo` int NOT NULL,
  `ID_OS` int NOT NULL,
  PRIMARY KEY (`ID_Veiculo`,`ID_OS`),
  KEY `ID_OS` (`ID_OS`),
  CONSTRAINT `gera_ibfk_1` FOREIGN KEY (`ID_Veiculo`) REFERENCES `veiculo` (`ID_Veiculo`),
  CONSTRAINT `gera_ibfk_2` FOREIGN KEY (`ID_OS`) REFERENCES `os` (`ID_OS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gera`
--

LOCK TABLES `gera` WRITE;
/*!40000 ALTER TABLE `gera` DISABLE KEYS */;
/*!40000 ALTER TABLE `gera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mecanico`
--

DROP TABLE IF EXISTS `mecanico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mecanico` (
  `ID_Mecanico` int NOT NULL AUTO_INCREMENT,
  `Nome_Mecanico` varchar(70) DEFAULT NULL,
  `Telefone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ID_Mecanico`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mecanico`
--

LOCK TABLES `mecanico` WRITE;
/*!40000 ALTER TABLE `mecanico` DISABLE KEYS */;
INSERT INTO `mecanico` VALUES (1,'Rafael Souza','11911112222'),(2,'Fernando Lima','11922223333'),(3,'Diego Santos','11933334444');
/*!40000 ALTER TABLE `mecanico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `os`
--

DROP TABLE IF EXISTS `os`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `os` (
  `ID_OS` int NOT NULL AUTO_INCREMENT,
  `Data_Abertura` date DEFAULT NULL,
  `Data_Encerramento` date DEFAULT NULL,
  `Descricao_Problema` varchar(255) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Mecanico_Responsavel` int DEFAULT NULL,
  `Pecas_Utilizadas` varchar(255) DEFAULT NULL,
  `Valor_Total` decimal(10,2) DEFAULT NULL,
  `ID_Cliente` int DEFAULT NULL,
  `ID_Veiculo` int DEFAULT NULL,
  PRIMARY KEY (`ID_OS`),
  KEY `Mecanico_Responsavel` (`Mecanico_Responsavel`),
  KEY `ID_Cliente` (`ID_Cliente`),
  KEY `ID_Veiculo` (`ID_Veiculo`),
  CONSTRAINT `os_ibfk_1` FOREIGN KEY (`Mecanico_Responsavel`) REFERENCES `mecanico` (`ID_Mecanico`),
  CONSTRAINT `os_ibfk_2` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`ID_Cliente`),
  CONSTRAINT `os_ibfk_3` FOREIGN KEY (`ID_Veiculo`) REFERENCES `veiculo` (`ID_Veiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `os`
--

LOCK TABLES `os` WRITE;
/*!40000 ALTER TABLE `os` DISABLE KEYS */;
INSERT INTO `os` VALUES (1,'2025-01-10','2025-01-10','Troca de óleo e filtro','Concluído',1,'FILTRO-001',120.00,1,1),(2,'2025-01-05','2025-01-07','Revisão geral','Concluído',2,'FILTRO-001, VELA-001',450.00,2,2),(3,'2025-01-12',NULL,'Freio fazendo ruído','Em andamento',3,'PAST-001',220.00,3,3),(4,'2025-01-10','2025-01-10','Troca de óleo e filtro','Concluído',1,'FILTRO-001',120.00,1,1),(5,'2025-01-05','2025-01-07','Revisão geral','Concluído',2,'FILTRO-001, VELA-001',450.00,2,2),(6,'2025-01-12',NULL,'Freio fazendo ruído','Em andamento',3,'PAST-001',220.00,3,3);
/*!40000 ALTER TABLE `os` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peca`
--

DROP TABLE IF EXISTS `peca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peca` (
  `ID_Peca` varchar(20) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Descricao` text,
  `Preco_Custo` decimal(5,2) NOT NULL,
  `Preco_Venda` decimal(5,2) NOT NULL,
  PRIMARY KEY (`ID_Peca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peca`
--

LOCK TABLES `peca` WRITE;
/*!40000 ALTER TABLE `peca` DISABLE KEYS */;
INSERT INTO `peca` VALUES ('CORR-001','Correia Dentada','Correia dentada original',120.00,200.00),('FILTRO-001','Filtro de Óleo','Filtro de óleo para motor',15.00,25.00),('PAST-001','Pastilha de Freio','Pastilha de freio dianteira',45.00,80.00),('VELA-001','Velas de Ignição','Jogo com 4 velas de ignição',30.00,55.00);
/*!40000 ALTER TABLE `peca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pertence`
--

DROP TABLE IF EXISTS `pertence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pertence` (
  `ID_Servico` int NOT NULL,
  `ID_OS` int NOT NULL,
  PRIMARY KEY (`ID_Servico`,`ID_OS`),
  KEY `ID_OS` (`ID_OS`),
  CONSTRAINT `pertence_ibfk_1` FOREIGN KEY (`ID_Servico`) REFERENCES `servico` (`ID_Servico`),
  CONSTRAINT `pertence_ibfk_2` FOREIGN KEY (`ID_OS`) REFERENCES `os` (`ID_OS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pertence`
--

LOCK TABLES `pertence` WRITE;
/*!40000 ALTER TABLE `pertence` DISABLE KEYS */;
/*!40000 ALTER TABLE `pertence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `possui`
--

DROP TABLE IF EXISTS `possui`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `possui` (
  `ID_Peca` varchar(20) NOT NULL,
  `ID_OS` int NOT NULL,
  PRIMARY KEY (`ID_Peca`,`ID_OS`),
  KEY `ID_OS` (`ID_OS`),
  CONSTRAINT `possui_ibfk_1` FOREIGN KEY (`ID_Peca`) REFERENCES `peca` (`ID_Peca`),
  CONSTRAINT `possui_ibfk_2` FOREIGN KEY (`ID_OS`) REFERENCES `os` (`ID_OS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `possui`
--

LOCK TABLES `possui` WRITE;
/*!40000 ALTER TABLE `possui` DISABLE KEYS */;
/*!40000 ALTER TABLE `possui` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servico`
--

DROP TABLE IF EXISTS `servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servico` (
  `ID_Servico` int NOT NULL AUTO_INCREMENT,
  `Descricao` varchar(100) DEFAULT NULL,
  `Data_Entrada` date DEFAULT NULL,
  `Data_Saida` date DEFAULT NULL,
  PRIMARY KEY (`ID_Servico`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico`
--

LOCK TABLES `servico` WRITE;
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
INSERT INTO `servico` VALUES (1,'Troca de óleo','2025-01-10','2025-01-10'),(2,'Revisão completa','2025-01-05','2025-01-07'),(3,'Troca de pastilha de freio','2025-01-12','2025-01-12');
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tem`
--

DROP TABLE IF EXISTS `tem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tem` (
  `ID_Cliente` int NOT NULL,
  `ID_Veiculo` int NOT NULL,
  PRIMARY KEY (`ID_Cliente`,`ID_Veiculo`),
  KEY `ID_Veiculo` (`ID_Veiculo`),
  CONSTRAINT `tem_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`ID_Cliente`),
  CONSTRAINT `tem_ibfk_2` FOREIGN KEY (`ID_Veiculo`) REFERENCES `veiculo` (`ID_Veiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tem`
--

LOCK TABLES `tem` WRITE;
/*!40000 ALTER TABLE `tem` DISABLE KEYS */;
INSERT INTO `tem` VALUES (1,1),(2,2),(3,3);
/*!40000 ALTER TABLE `tem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veiculo`
--

DROP TABLE IF EXISTS `veiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `veiculo` (
  `ID_Veiculo` int NOT NULL AUTO_INCREMENT,
  `Placa` varchar(7) NOT NULL,
  `Modelo` varchar(50) DEFAULT NULL,
  `Marca` varchar(50) DEFAULT NULL,
  `Ano` year NOT NULL,
  PRIMARY KEY (`ID_Veiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veiculo`
--

LOCK TABLES `veiculo` WRITE;
/*!40000 ALTER TABLE `veiculo` DISABLE KEYS */;
INSERT INTO `veiculo` VALUES (1,'ABC1D23','Civic','Honda',2018),(2,'FGH2I45','Corolla','Toyota',2020),(3,'JKL3M67','Gol','Volkswagen',2015);
/*!40000 ALTER TABLE `veiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'Oficina'
--

--
-- Dumping routines for database 'Oficina'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-01 14:45:46
