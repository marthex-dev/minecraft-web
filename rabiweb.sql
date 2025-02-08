-- MySQL dump 10.19  Distrib 10.3.37-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: rabiwebcom_webscript
-- ------------------------------------------------------
-- Server version	10.3.37-MariaDB

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
-- Table structure for table `AdminChat`
--

DROP TABLE IF EXISTS `AdminChat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AdminChat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accID` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AdminChat`
--

LOCK TABLES `AdminChat` WRITE;
/*!40000 ALTER TABLE `AdminChat` DISABLE KEYS */;
/*!40000 ALTER TABLE `AdminChat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BannedUsers`
--

DROP TABLE IF EXISTS `BannedUsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BannedUsers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) DEFAULT NULL,
  `accID` int(11) DEFAULT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `expiry` int(11) DEFAULT NULL,
  `expiryDate` date NOT NULL,
  `regdate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BannedUsers`
--

LOCK TABLES `BannedUsers` WRITE;
/*!40000 ALTER TABLE `BannedUsers` DISABLE KEYS */;
/*!40000 ALTER TABLE `BannedUsers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Broadcast`
--

DROP TABLE IF EXISTS `Broadcast`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Broadcast` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `updateDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `expiryDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Broadcast`
--

LOCK TABLES `Broadcast` WRITE;
/*!40000 ALTER TABLE `Broadcast` DISABLE KEYS */;
INSERT INTO `Broadcast` (`id`, `heading`, `content`, `link`, `creationDate`, `updateDate`, `expiryDate`) VALUES (1,'RabiWebV1.3','RabiWeb Gelişmiş Minecraft Web Sitesi Otomasyonu','https://rabi.web.tr','2022-09-11 02:25:22','2022-09-11 02:25:22','1000-01-01 00:00:00');
/*!40000 ALTER TABLE `Broadcast` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cases`
--

DROP TABLE IF EXISTS `Cases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `priceStatus` int(11) DEFAULT 0,
  `serverID` int(11) DEFAULT NULL,
  `caseDuration` int(11) DEFAULT NULL,
  `casePrice` int(11) DEFAULT NULL,
  `caseContent` text DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cases`
--

LOCK TABLES `Cases` WRITE;
/*!40000 ALTER TABLE `Cases` DISABLE KEYS */;
/*!40000 ALTER TABLE `Cases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CasesHistory`
--

DROP TABLE IF EXISTS `CasesHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CasesHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accID` int(11) DEFAULT NULL,
  `caseID` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `award` int(11) DEFAULT NULL,
  `expiryDate` datetime DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CasesHistory`
--

LOCK TABLES `CasesHistory` WRITE;
/*!40000 ALTER TABLE `CasesHistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `CasesHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Chests`
--

DROP TABLE IF EXISTS `Chests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Chests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT 1,
  `status` int(11) DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Chests`
--

LOCK TABLES `Chests` WRITE;
/*!40000 ALTER TABLE `Chests` DISABLE KEYS */;
INSERT INTO `Chests` (`id`, `accID`, `productID`, `type`, `status`, `creationDate`) VALUES (15,1,8,1,1,'2022-09-11 02:14:24');
/*!40000 ALTER TABLE `Chests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ChestsHistory`
--

DROP TABLE IF EXISTS `ChestsHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ChestsHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accID` int(11) DEFAULT NULL,
  `chestID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `chestType` int(11) DEFAULT 1,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ChestsHistory`
--

LOCK TABLES `ChestsHistory` WRITE;
/*!40000 ALTER TABLE `ChestsHistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `ChestsHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CreditHistory`
--

DROP TABLE IF EXISTS `CreditHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CreditHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accID` int(11) DEFAULT NULL,
  `paymentID` varchar(255) DEFAULT NULL,
  `paymentAPI` int(11) DEFAULT NULL,
  `paymentStatus` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `earnings` int(11) DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CreditHistory`
--

LOCK TABLES `CreditHistory` WRITE;
/*!40000 ALTER TABLE `CreditHistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `CreditHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Downloads`
--

DROP TABLE IF EXISTS `Downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Downloads`
--

LOCK TABLES `Downloads` WRITE;
/*!40000 ALTER TABLE `Downloads` DISABLE KEYS */;
/*!40000 ALTER TABLE `Downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Games`
--

DROP TABLE IF EXISTS `Games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `star` int(11) DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `updateDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Games`
--

LOCK TABLES `Games` WRITE;
/*!40000 ALTER TABLE `Games` DISABLE KEYS */;
/*!40000 ALTER TABLE `Games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GiftHistory`
--

DROP TABLE IF EXISTS `GiftHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GiftHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accID` int(11) DEFAULT NULL,
  `giftID` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `award` int(11) DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GiftHistory`
--

LOCK TABLES `GiftHistory` WRITE;
/*!40000 ALTER TABLE `GiftHistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `GiftHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Gifts`
--

DROP TABLE IF EXISTS `Gifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Gifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `giftType` int(11) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  `productServer` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `giftTime` int(11) DEFAULT NULL,
  `giftExpiry` date DEFAULT NULL,
  `amountType` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Gifts`
--

LOCK TABLES `Gifts` WRITE;
/*!40000 ALTER TABLE `Gifts` DISABLE KEYS */;
/*!40000 ALTER TABLE `Gifts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Menu`
--

DROP TABLE IF EXISTS `Menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `tab` int(11) DEFAULT NULL,
  `parent` int(10) unsigned NOT NULL DEFAULT 0,
  `sort` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Menu`
--

LOCK TABLES `Menu` WRITE;
/*!40000 ALTER TABLE `Menu` DISABLE KEYS */;
INSERT INTO `Menu` (`id`, `heading`, `link`, `icon`, `tab`, `parent`, `sort`) VALUES (34,'‏‏‏‏‏‏‏‏Ana Sayfa','index','mdi-home',0,0,1),(35,'Mağaza','magaza','mdi-cart',0,0,2),(37,'Kredi','kredi','mdi-currency-try',0,0,3),(38,'Kredi Yükle','kredi/yukle','#',0,37,4),(39,'Kredi Gönder','kredi/gonder','#',0,37,5),(41,'Destek','destek','mdi-lifebuoy',0,0,7),(42,'İndir','indir','mdi-download',0,0,8),(45,'Wiki','wiki','mdi-book-open-page-variant ',0,0,6),(48,'Discord','https://discord.gg/','mdi-discord',0,0,9);
/*!40000 ALTER TABLE `Menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `News`
--

DROP TABLE IF EXISTS `News`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `News` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accID` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT 1,
  `commentsStatus` int(11) DEFAULT NULL,
  `updateDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `News`
--

LOCK TABLES `News` WRITE;
/*!40000 ALTER TABLE `News` DISABLE KEYS */;
INSERT INTO `News` (`id`, `accID`, `category`, `image`, `heading`, `slug`, `content`, `tags`, `views`, `commentsStatus`, `updateDate`, `creationDate`) VALUES (3,3,2,'fc9ee6e7c0cc094b99787e6472e60f91.png','Sunucumuz Açılıyor','sunucumuz-aciliyor','<p>RabiWeb sunucumuz kapalı beta olarak açılmıştır. </p><p>Sunucumuz içerisinde; Survival ve Skyblock oyun modları ile sizler için en iyi oyun deneyimini sunmayı hedefliyoruz.</p><p>Discord Sunucumuz : <a href=\"https://discord.gg/tDky9RMhqk\" target=\"_blank\">https://discord.gg/tDky9RMhqk</a></p>','survivaltr,survival sunucusu,extended survival',92,1,'2022-07-06 05:41:53','2022-07-06 05:37:52'),(4,3,2,'e1e2e8de6d4da141a05f1790c93859dc.png','Açılışa Özel 2x Kredi Etkinliği','acilisa-ozel-2x-kredi-etkinligi','<p>SkyBlock sunucumuz açıldı. SkyBlock sunucumuzun açılışı şerefine x2 Kredi etkinliği yapıyoruz. Web sitemiz üzerine bakiye yükleyen herkes %100 Kredi bonusuyla yükleme yapacaktır.</p><p>15 Temmuz’a Kadar 2x Kredi Etkinliğimiz Devam Edecektir!</p><p>Kredi Yüklemek için :&nbsp;<a href=\"https://minetr.net/kredi/yukle\" target=\"_blank\">Kredi Yükle</a></p><p>Discord Sunucumuz : <a href=\"https://discord.gg/minetr\" target=\"_blank\">Discord</a></p>','2x kredi,2x kredi etkinliği',107,1,'2022-07-15 03:53:29','2022-07-08 07:39:56'),(5,1,3,'27937e4824e518072c6a6a38c71d581b.png','RabiWebV1.1','rabiwebv1-1','<p><div style=\"margin: 0px 28.7969px 0px 14.3906px; padding: 0px; width: 436.797px; text-align: left; float: right; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"></div></p><div style=\"margin: 0px 14.3906px 0px 28.7969px; padding: 0px; width: 436.797px; float: left; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\"><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500\'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır. Beşyüz yıl boyunca varlığını sürdürmekle kalmamış, aynı zamanda pek değişmeden elektronik dizgiye de sıçramıştır. 1960\'larda Lorem Ipsum pasajları da içeren Letraset yapraklarının yayınlanması ile ve yakın zamanda Aldus PageMaker gibi Lorem Ipsum sürümleri içeren masaüstü yayıncılık yazılımları ile popüler olmuştur.</p><div><br></div></div><div style=\"margin: 0px 28.7969px 0px 14.3906px; padding: 0px; width: 436.797px; float: right; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\"></div>','deneme',3,1,'2023-01-19 09:58:16','2022-09-11 02:16:54');
/*!40000 ALTER TABLE `News` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NewsCategory`
--

DROP TABLE IF EXISTS `NewsCategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NewsCategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `updateDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NewsCategory`
--

LOCK TABLES `NewsCategory` WRITE;
/*!40000 ALTER TABLE `NewsCategory` DISABLE KEYS */;
INSERT INTO `NewsCategory` (`id`, `heading`, `slug`, `color`, `status`, `creationDate`, `updateDate`) VALUES (2,'Güncelleme','guncelleme','#F6AD55',1,'1000-01-01 00:00:00','2022-07-08 12:10:18'),(3,'Genel','genel','#EB1313',1,'1000-01-01 00:00:00','1000-01-01 00:00:00');
/*!40000 ALTER TABLE `NewsCategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NewsComments`
--

DROP TABLE IF EXISTS `NewsComments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NewsComments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accID` int(11) DEFAULT NULL,
  `newsID` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `updateDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NewsComments`
--

LOCK TABLES `NewsComments` WRITE;
/*!40000 ALTER TABLE `NewsComments` DISABLE KEYS */;
/*!40000 ALTER TABLE `NewsComments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Notifications`
--

DROP TABLE IF EXISTS `Notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accID` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `data` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Notifications`
--

LOCK TABLES `Notifications` WRITE;
/*!40000 ALTER TABLE `Notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `Notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pages`
--

DROP TABLE IF EXISTS `Pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pages`
--

LOCK TABLES `Pages` WRITE;
/*!40000 ALTER TABLE `Pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `Pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PasswordRecovery`
--

DROP TABLE IF EXISTS `PasswordRecovery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PasswordRecovery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accID` int(11) DEFAULT NULL,
  `recoveryKey` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PasswordRecovery`
--

LOCK TABLES `PasswordRecovery` WRITE;
/*!40000 ALTER TABLE `PasswordRecovery` DISABLE KEYS */;
INSERT INTO `PasswordRecovery` (`id`, `accID`, `recoveryKey`, `status`, `creationDate`) VALUES (1,1,'720690c32a591fc120812f2f1575661e',0,'2022-09-11 02:21:18');
/*!40000 ALTER TABLE `PasswordRecovery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Payments`
--

DROP TABLE IF EXISTS `Payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `paymentData` text DEFAULT NULL,
  `paymentStatus` text DEFAULT NULL,
  `paymentType` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Payments`
--

LOCK TABLES `Payments` WRITE;
/*!40000 ALTER TABLE `Payments` DISABLE KEYS */;
INSERT INTO `Payments` (`id`, `heading`, `slug`, `paymentData`, `paymentStatus`, `paymentType`) VALUES (1,'EFT (IBAN)','eft','W3sicmVhbG5hbWUiOiJLdXRheSBLZXNraW4iLCJiYW5rbmFtZSI6IlFOQiBcLyBFTlBBUkEiLCJpYmFuIjoiVFI1MiAwMDExIDEwMDAgMDAwMCAwMDkwIDk4NzUgMTIifV0=','0',3),(2,'İninal','ininal','WyJYWFhYWFhYWFhYWFhYWFhYIl0=','0',3),(3,'Papara','papara','WyJYWFhYWFhYWFhYWFhYWFhYWFgiXQ==','0',4),(4,'Shipy (Kredi Kartı)','shipy-cc','XXXXXXXXXXXXXXXX','0',4),(5,'Shipy (Mobil Ödeme)','shipy-mobile','XXXXXXXXXXXXXXX','0',5),(6,'PayTR','paytr','eyJtZXJjaGFudElEIjoiIiwibWVyY2hhbnRLZXkiOiIiLCJtZXJjaGFudFNhbHQiOiIifQ==','1',4),(13,'Paywant','paywant','eyJhcGlLZXkiOiJYWFhYWFhYWFhYIiwiYXBpU2VjcmV0S2V5IjoiWFhYWFhYWFhYWCIsImNvbW1pc3Npb25UeXBlIjoiMSJ9','0',5),(14,'Shopier','shopier','eyJhcGlLZXkiOiJYWFhYWFhYWFhYIiwiYXBpU2VjcmV0S2V5IjoiWFhYWFhYWFhYWCIsImNvbW1pc3Npb25UeXBlIjoiMSJ9','0',5);
/*!40000 ALTER TABLE `Payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProductExpiryCommands`
--

DROP TABLE IF EXISTS `ProductExpiryCommands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProductExpiryCommands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) DEFAULT NULL,
  `accID` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `expiryDate` datetime DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProductExpiryCommands`
--

LOCK TABLES `ProductExpiryCommands` WRITE;
/*!40000 ALTER TABLE `ProductExpiryCommands` DISABLE KEYS */;
INSERT INTO `ProductExpiryCommands` (`id`, `productID`, `accID`, `status`, `expiryDate`, `creationDate`) VALUES (1,2,8,1,'2022-08-14 21:07:58','2022-07-15 21:07:58');
/*!40000 ALTER TABLE `ProductExpiryCommands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT 0,
  `discountPrice` int(11) DEFAULT NULL,
  `discountDuration` int(11) DEFAULT NULL,
  `discountExpiry` date DEFAULT NULL,
  `serverID` int(11) DEFAULT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `commands` text DEFAULT NULL,
  `expiryCommands` text DEFAULT NULL,
  `stockStatus` int(11) DEFAULT 0,
  `stock` int(11) DEFAULT 0,
  `totalSales` int(11) DEFAULT 0,
  `duration` int(11) DEFAULT 0,
  `durationDay` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` (`id`, `heading`, `content`, `image`, `price`, `discount`, `discountPrice`, `discountDuration`, `discountExpiry`, `serverID`, `categoryID`, `commands`, `expiryCommands`, `stockStatus`, `stock`, `totalSales`, `duration`, `durationDay`) VALUES (1,'VIP','<p>Yardım Paketleri ( <span style=\"background-color: transparent; font-size: 0.8125rem;\">Üç günde bir kullanılabilir yardım sandığı alırsınız. \" Detay için tıkla \" )</span></p><p>+10,000 Kip</p><p>+500 Bonus Claim</p><p>Tab\'da isminizin başına Yıldız eklenir</p><p>Ücretsiz Geri Dönüş (/back)</p><p>Ücretsiz Işınlanma + Işınlanma süresi kısaltma (/tpa)</p><p>Ev Ayarlama Hakkı ( +1 Totalde 2 )</p><p>Clan oyuncu limiti +3</p><p>+5 Loto Bileti</p><p>+10 İhaleye eşya koyma sınırı arttırma ( 20 )</p>','0aaf82006307558771a7b0a994a73b56.png',50,0,NULL,0,NULL,2,1,'WyJ2aXB2ZXIgdmlwICV1c2VybmFtZSUiXQ==','WyJ2aXBhbCB2aXAgJXVzZXJuYW1lJSJd',0,0,1,1,30),(2,'VIP+','<p>Yardım Paketleri ( Üç günde bir kullanılabilir yardım sandığı alırsınız. \" Detay için tıkla \" )<br></p><p>+25,000 Kip</p><p>+1200 Bonus Claim</p><p>Tab\'da isminizin başına Yıldız eklenir</p><p>Özel binek (/yoldaş)</p><p>Sohbet renginizi değiştirin.</p><p>Ücretsiz Geri Dönüş (/back)</p><p>Ücretsiz Işınlanma + Işınlanma süresi kısaltma (/tpa)</p><p>Ev Ayarlama Hakkı ( +1 Totalde 2 )</p><p>Clan oyuncu limiti +5</p><p>+5 Loto Bileti</p><p>+15 İhaleye eşya koyma sınırı arttırma ( 25 )</p>','22254f8c612835cdfab431e2b1840468.png',75,0,NULL,0,NULL,2,1,'WyJ2aXB2ZXIgdmlwcGx1cyAldXNlcm5hbWUlIl0=','WyJ2aXBhbCB2aXBwbHVzICV1c2VybmFtZSUiXQ==',0,0,1,1,30),(3,'KVIP','<p>Yardım Paketleri ( Üç günde bir kullanılabilir yardım sandığı alırsınız. \" Detay için tıkla \" )</p><p>+45,000 Kip</p><p>+2100 Bonus Claim</p><p>Tab\'da isminizin başına Yıldız eklenir</p><p>Özel binek (/yoldaş)</p><p>Sohbet renginizi değiştirin.</p><p>Ücretsiz Geri Dönüş (/back)</p><p>Ücretsiz Işınlanma + Işınlanma süresi kısaltma (/tpa)</p><p>Ücretsiz Şapkalar</p><p>Ev Ayarlama Hakkı ( +3 Totalde 4 )</p><p>Clan oyuncu limiti +7</p><p>Diyarlarda %15 Drop Bonusu</p><p>+10 Loto Bileti</p><p>+20 İhaleye eşya koyma sınırı arttırma ( 30 )</p><p>+3 Nether Bileti</p><p>+1 Işınlanma Yüzüğü</p>','edd68340125e63c4e5da88ca9b9e07e5.png',120,0,NULL,0,NULL,2,1,'WyJ2aXB2ZXIga3ZpcCAldXNlcm5hbWUlIl0=','WyJ2aXBhbCBrdmlwICV1c2VybmFtZSUiXQ==',0,0,0,1,30),(4,'KVIP+','<p>Yardım Paketleri ( Üç günde bir kullanılabilir yardım sandığı alırsınız. \" Detay için tıkla \" )</p><p>+155,000 Kip</p><p>+4000 Bonus Claim</p><p>Tab\'da isminizin başına Yıldız eklenir</p><p>Özel binek (/yoldaş)</p><p>Sohbet renginizi değiştirin.</p><p>Ücretsiz Geri Dönüş (/back)</p><p>Ücretsiz Işınlanma + Işınlanma süresi kısaltma (/tpa)</p><p>Ücretsiz Şapkalar</p><p>Ev Ayarlama Hakkı ( +5 Totalde 6 )</p><p>Etkinliklerde %15 Bonus Para</p><p>Clan oyuncu limiti +10</p><p>Diyarlarda %25 Drop Bonusu</p><p>+15 Loto Bileti</p><p>+25 İhaleye eşya koyma sınırı arttırma ( 35 )</p><p>+5 Nether Bileti</p><p>+1 Işınlanma Yüzüğü</p>','86a261e90a6a5eac2056c107d0933aa5.png',170,0,NULL,0,NULL,2,1,'WyJ2aXB2ZXIga3ZpcHBsdXMgJXVzZXJuYW1lJSJd','WyJ2aXBhbCBrdmlwcGx1cyAldXNlcm5hbWUlIl0=',0,0,0,1,30),(5,'VIP','<p>AFK moduna geçebilme /afk</p><p>Kafaya bir blok takabilme /hat</p><p>Açlık barını doldurabilme /feed</p><p>Eşya tamir edebilme /repair</p><p>Bölgelere beklemeden gidebilme /warp</p><p>Işınlanmalara beklemeden gidebilme /tpa</p><p>VIP Kiti /kit vip</p><p>1 Tane Vip Kasası Anahtarı</p><p>1 Adet Domuz Spawner</p><p>1 Adet Zombi Spawner</p><p>5000 Oyun Parası</p><p>Patates ve Havuç Tarım Küresi</p>','41deafe07e75985cb3598e9a129452b0.png',20,0,NULL,0,NULL,3,2,'WyJ2aXB2ZXIgJXVzZXJuYW1lJSB2aXAgMzAiXQ==','WyIiXQ==',1,28,2,1,30),(6,'VIP+','<p>AFK moduna geçebilme /afk</p><p>Kafaya bir blok takabilme /hat</p><p>Açlık barını doldurabilme /feed</p><p>Uçabilme Hakkı /fly</p><p>Eşya tamir edebilme /repair</p><p>Bölgelere beklemeden gidebilme /warp</p><p>Işınlanmalara beklemeden gidebilme /tpa</p><p>VIP+ Kiti /kit vip+</p><p>1 Tane Vip Kasası Anahtarı</p><p>1 Adet Koyun Spawner</p><p>1 Adet İskelet Spawner</p><p>10.000 Oyun Parası</p><p>Patates ve Havuç Tarım Küresi</p>','8cf80508ec2c403223ed3cc8fd58ffd0.png',40,0,NULL,0,NULL,3,2,'WyJ2aXB2ZXIgJXVzZXJuYW1lJSB2aXArIDMwIl0=','WyIiXQ==',0,0,0,1,30),(7,'UVIP','<p>AFK moduna geçebilme /afk</p><p>Kafaya bir blok takabilme /hat</p><p>Canını ve Açık barını doldurabilme /heal</p><p>Açlık barını doldurabilme /feed</p><p>Uçabilme Hakkı /fly</p><p>Eşya tamir edebilme /repair</p><p>Bölgelere beklemeden gidebilme /warp</p><p>Işınlanmalara beklemeden gidebilme /tpa</p><p>UVIP Kiti /kit uvip</p><p>1 Tane Vip Kasası Anahtarı</p><p>1 Adet Iron Golem Spawner</p><p>1 Adet İnek Spawner</p><p>1 Adet Blaze Spawner</p><p>25.000 Oyun Parası</p><p>Patates, Havuç, NetherWart ve Şeker Kamışı Tarım Küresi</p>','dd9c12058e1cac9a8fba3a9cf3430327.png',70,0,NULL,0,NULL,3,2,'WyJ2aXB2ZXIgJXVzZXJuYW1lJSB1dmlwIDMwIl0=','WyIiXQ==',0,0,0,1,30),(8,'UVIP+','<p>AFK moduna geçebilme /afk</p><p>Kafaya bir blok takabilme /hat</p><p>Canını ve Açık barını doldurabilme /heal</p><p>Açlık barını doldurabilme /feed</p><p>Uçabilme Hakkı /fly</p><p>Eşya tamir edebilme /repair</p><p>Bölgelere beklemeden gidebilme /warp</p><p>Işınlanmalara beklemeden gidebilme /tpa</p><p>UVIP+ Kiti /kit uvip+</p><p>1 Tane Vip Kasası Anahtarı</p><p>1 Adet Tavuk Spawner</p><p>1 Adet Iron Golem Spawner</p><p>2 Adet Zombie Pigman Spawner</p><p>55.000 Oyun Parası</p><p>Patates, Havuç, NetherWart ve Şeker Kamışı Tarım Küresi</p>','da0e73ff436f4277df21812bf23dd5d8.png',100,0,NULL,0,NULL,3,2,'WyJ2aXB2ZXIgJXVzZXJuYW1lJSB1dmlwKyAzMCJd','WyIiXQ==',0,0,0,1,30),(9,'20 DK Fly','<p>20 Dakika fly elde etmenize yarar. Kullanımı /tf yazarak açılır ve /tf yazarak kapanır.</p>','d399734aa13c60097c8b73ec9f69ba2d.png',10,0,NULL,0,NULL,3,3,'WyJcL3RmIGdpdmUgJXVzZXJuYW1lJSAyIG1pbnMiXQ==',NULL,0,0,0,0,NULL),(10,'Blaze Binek','<p>Blaze bineği, uçabilir fakat kimseye saldıramaz. Binek yönetim panelinden yanınıza tekrardan çağırılabilir veya gönderilebilir.</p>','57ea7cb11ae523a2d1817a4cb08017ad.png',25,0,NULL,0,NULL,2,4,'WyIiXQ==',NULL,1,5,0,0,NULL),(11,'Phantom Binek','<p>Phantom bineği, uçabilir fakat kimseye saldıramaz. Binek yönetim panelinden yanınıza tekrardan çağırılabilir veya gönderilebilir.<br></p>','c5754a90e3f5939ec806276dd6da114f.png',10,0,NULL,0,NULL,2,4,'WyIiXQ==',NULL,0,0,0,0,NULL),(12,'Ravager Binek','<p>Ravager bineğin canı, diğer bineklere göre daha fazladır ve yıkım özelliğine sahiptir. Yine de hiç bir oyuncuya zarar vermez.</p>','3a8695ddace081a0a463cb394f36e206.png',70,0,NULL,0,NULL,2,4,'WyIiXQ==',NULL,1,2,0,0,NULL),(13,'Örümcek Binek','<p>Duvarlara tırmanabilir. </p><p>Binek yönetim panelinden yanınıza tekrardan çağırılabilir veya gönderilebilir.</p>','1fd31bf066974734d25f557f23a93bcd.png',50,0,NULL,0,NULL,2,4,'WyIiXQ==',NULL,1,5,0,0,NULL),(14,'100k Kip','<p>Extended Survival içerisinde 100.000 Kip Oyun içi Para</p>','811dbf9a4e441f06bdf0237caf71ecb1.png',100,0,NULL,0,NULL,2,5,'WyJlY28gZ2l2ZSAldXNlcm5hbWUlIDEwMDAwMCJd',NULL,0,0,0,0,NULL),(15,'250k Kip','<p>Extended Survival içerisinde 250.000 Kip oyun içi para.<br></p>','f60beb5cc2d7b74240571b3f800ca4bf.png',200,0,NULL,0,NULL,2,5,'WyJlY28gZ2l2ZSAldXNlcm5hbWUlIDI1MDAwMCJd',NULL,0,0,9,0,NULL),(16,'100Pkip','<p>Extended Survival içerisinde 100 Premium Kip Oyun içi Para<br></p>','d723716dd6fd870f2cbf26f4e2d26fd2.png',200,0,NULL,0,NULL,2,5,'WyJ2aXBjb2luIHZlciAldXNlcm5hbWUlIDEwMCJd',NULL,0,0,1,0,NULL),(17,'500Pkip','<p>Extended Survival içerisinde 500 Premium Kip Oyun içi Para<br></p>','e817fb2d290703eeda0a9bb9c1bb7617.png',300,0,NULL,0,NULL,2,5,'WyJ2aXBjb2luIHZlciAldXNlcm5hbWUlIDUwMCJd',NULL,0,0,0,0,NULL),(18,'25k Kip','<p>Extended Survival içerisinde 25.000 Kip oyun içi para.<br></p>',NULL,20,0,NULL,0,NULL,2,5,'WyJlY28gZ2l2ZSAldXNlcm5hbWUlIDI1MDAwIl0=',NULL,0,0,0,0,NULL);
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProductsCategories`
--

DROP TABLE IF EXISTS `ProductsCategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProductsCategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `serverID` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProductsCategories`
--

LOCK TABLES `ProductsCategories` WRITE;
/*!40000 ALTER TABLE `ProductsCategories` DISABLE KEYS */;
INSERT INTO `ProductsCategories` (`id`, `heading`, `slug`, `serverID`, `parent`, `image`) VALUES (1,'VIP Üyelikler','vip-uyelikler',2,0,'d0adb46d5e355d58615b750aba883460.png'),(2,'VIP','vip',3,0,'7a28ebb780fae0184194fe79d56a2a42.png'),(3,'Diğer','diger',3,0,'9fab815a4cac7bb59c88ebf242fb224b.jpg'),(4,'Binekler','binekler',2,0,'0992a10e6dcdee713e5360cb54cf15f1.png'),(5,'Diğer','diger-761',2,0,'a79fe06779c1f5e70d23c7c1b5583488.png');
/*!40000 ALTER TABLE `ProductsCategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Servers`
--

DROP TABLE IF EXISTS `Servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `serverIP` varchar(255) DEFAULT NULL,
  `serverPort` varchar(255) DEFAULT NULL,
  `senderType` int(11) DEFAULT NULL,
  `senderPort` varchar(255) DEFAULT NULL,
  `senderPassword` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Servers`
--

LOCK TABLES `Servers` WRITE;
/*!40000 ALTER TABLE `Servers` DISABLE KEYS */;
INSERT INTO `Servers` (`id`, `heading`, `slug`, `serverIP`, `serverPort`, `senderType`, `senderPort`, `senderPassword`, `image`) VALUES (1,'Extended Survival','extended-survival','45.131.1.87','31625',2,'9876','MTIzcXdl','cec8a80bb22814803fbfe1916f83a433.png');
/*!40000 ALTER TABLE `Servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sessions`
--

DROP TABLE IF EXISTS `Sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accID` int(11) DEFAULT NULL,
  `loginToken` char(32) DEFAULT NULL,
  `creationIP` varchar(255) DEFAULT NULL,
  `expiryDate` datetime DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sessions`
--

LOCK TABLES `Sessions` WRITE;
/*!40000 ALTER TABLE `Sessions` DISABLE KEYS */;
INSERT INTO `Sessions` (`id`, `accID`, `loginToken`, `creationIP`, `expiryDate`, `creationDate`) VALUES (1,1,'1d1283cb180518b89994e1c345376abb','46.154.40.223','2022-07-06 08:56:10','2022-07-06 08:32:11'),(127,233,'1f1feed974101662ee4ed6740f809a24','81.215.207.132','2023-01-19 10:11:41','2023-01-19 09:47:42'),(128,233,'9514e406bc0825c81d0dfaf9be8bb35e','81.215.207.132','2024-01-19 10:00:49','2023-01-19 10:00:49');
/*!40000 ALTER TABLE `Sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Settings`
--

DROP TABLE IF EXISTS `Settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serverName` varchar(255) DEFAULT NULL,
  `siteHeading` varchar(255) DEFAULT NULL,
  `serverIP` varchar(255) DEFAULT NULL,
  `serverPort` varchar(255) DEFAULT NULL,
  `serverVersion` varchar(255) DEFAULT NULL,
  `googleTags` mediumtext DEFAULT NULL,
  `googleDescription` varchar(255) DEFAULT NULL,
  `facebookURL` varchar(255) DEFAULT NULL,
  `twitterURL` varchar(255) DEFAULT NULL,
  `instagramURL` varchar(255) DEFAULT NULL,
  `youtubeURL` varchar(255) DEFAULT NULL,
  `discordURL` varchar(255) DEFAULT NULL,
  `eMail` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `aboutUs` text DEFAULT NULL,
  `rules` text DEFAULT NULL,
  `supportMessageTemplate` text DEFAULT NULL,
  `serverLogo` varchar(255) DEFAULT NULL,
  `serverFavicon` varchar(255) DEFAULT NULL,
  `avatarApi` int(11) DEFAULT NULL,
  `onlineApi` int(11) DEFAULT NULL,
  `encryptionMethod` int(11) DEFAULT NULL,
  `sslStatus` int(11) DEFAULT NULL,
  `licenseCheck` varchar(255) DEFAULT NULL,
  `maintenanceMode` int(11) DEFAULT NULL,
  `maintenanceData` text DEFAULT NULL,
  `sendCreditStatus` int(11) DEFAULT NULL,
  `sendGiftStatus` int(11) DEFAULT NULL,
  `mostProductsStatus` int(11) DEFAULT NULL,
  `preloader` int(11) DEFAULT NULL,
  `2faStatus` int(11) DEFAULT NULL,
  `commentsStatus` int(11) DEFAULT NULL,
  `oneSignalStatus` int(11) DEFAULT NULL,
  `oneSignalAppID` varchar(255) DEFAULT NULL,
  `oneSignalRestApiKey` varchar(255) DEFAULT NULL,
  `liveChat` int(11) DEFAULT NULL,
  `liveChatJS` mediumtext DEFAULT NULL,
  `bonusCreditStatus` int(11) DEFAULT NULL,
  `bonusCredit` int(11) DEFAULT NULL,
  `analyticsStatus` int(11) DEFAULT NULL,
  `analyticsID` varchar(255) DEFAULT NULL,
  `recaptchaStatus` int(11) DEFAULT NULL,
  `recaptchaSiteKey` varchar(255) DEFAULT NULL,
  `recaptchaSecretKey` varchar(255) DEFAULT NULL,
  `recaptchaActive` text DEFAULT NULL,
  `minimumPayCredit` int(11) DEFAULT NULL,
  `maximumPayCredit` int(11) DEFAULT NULL,
  `newsLimit` int(11) DEFAULT NULL,
  `registerLimit` int(11) DEFAULT NULL,
  `smtpType` int(11) DEFAULT NULL,
  `smtpServer` varchar(255) DEFAULT NULL,
  `smtpPort` varchar(255) DEFAULT NULL,
  `smtpSecurity` int(11) DEFAULT NULL,
  `smtpMail` varchar(255) DEFAULT NULL,
  `smtpPassword` varchar(255) DEFAULT NULL,
  `smtpTemplate` text DEFAULT NULL,
  `storeWebhook` int(11) DEFAULT NULL,
  `storeWebhookData` text DEFAULT NULL,
  `creditWebhook` int(11) DEFAULT NULL,
  `creditWebhookData` text DEFAULT NULL,
  `caseWebhook` int(11) DEFAULT NULL,
  `caseWebhookData` text DEFAULT NULL,
  `supportWebhook` int(11) DEFAULT NULL,
  `supportWebhookData` text DEFAULT NULL,
  `commentsWebhook` int(11) DEFAULT NULL,
  `commentsWebhookData` text DEFAULT NULL,
  `productUpdateDate` datetime DEFAULT NULL,
  `onlineJS` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Settings`
--

LOCK TABLES `Settings` WRITE;
/*!40000 ALTER TABLE `Settings` DISABLE KEYS */;
INSERT INTO `Settings` (`id`, `serverName`, `siteHeading`, `serverIP`, `serverPort`, `serverVersion`, `googleTags`, `googleDescription`, `facebookURL`, `twitterURL`, `instagramURL`, `youtubeURL`, `discordURL`, `eMail`, `phone`, `whatsapp`, `aboutUs`, `rules`, `supportMessageTemplate`, `serverLogo`, `serverFavicon`, `avatarApi`, `onlineApi`, `encryptionMethod`, `sslStatus`, `licenseCheck`, `maintenanceMode`, `maintenanceData`, `sendCreditStatus`, `sendGiftStatus`, `mostProductsStatus`, `preloader`, `2faStatus`, `commentsStatus`, `oneSignalStatus`, `oneSignalAppID`, `oneSignalRestApiKey`, `liveChat`, `liveChatJS`, `bonusCreditStatus`, `bonusCredit`, `analyticsStatus`, `analyticsID`, `recaptchaStatus`, `recaptchaSiteKey`, `recaptchaSecretKey`, `recaptchaActive`, `minimumPayCredit`, `maximumPayCredit`, `newsLimit`, `registerLimit`, `smtpType`, `smtpServer`, `smtpPort`, `smtpSecurity`, `smtpMail`, `smtpPassword`, `smtpTemplate`, `storeWebhook`, `storeWebhookData`, `creditWebhook`, `creditWebhookData`, `caseWebhook`, `caseWebhookData`, `supportWebhook`, `supportWebhookData`, `commentsWebhook`, `commentsWebhookData`, `productUpdateDate`, `onlineJS`) VALUES (1,'RabiWeb Minecraft Web Otomasyonu','Survival, SkyBlock Sunucusu','eu.sonoyuncu.network','25565','1.8-1.19','survival sunucusu, skyblock sunucusu, minecraft survival, minecraft skyblock','Türkiyenin en iyi minecraft Web otomasyonu sağlayıcısı.','','','','','https://discord.gg/E5W8xAzPtF','info@webze.org','+90 850 244 2740','+90 850 244 2740','RabiWeb, 2020\'nin başlarında kurulan asıl amacı Minecraft Web Otomasyonları geliştirmek olan bir firmadır.','<p><strong>1</strong>-) Kendinizi yetkili gibi tanıtmak yasaktır. <span class=\"text-danger\">Cezası: Süresiz sunucudan uzaklaştırılmak.</span></p>','<p>Merhaba <strong><span class=\"text-primary\">%username%</span></strong>,</p><p>%message%</p><p>İyi Oyunlar, Webze</p>','754f3244df98798ca794f9ddd7e965df.gif','3012cc4c7aad092c43ca30f7f5b17628.png',0,0,0,1,'OASIS-C6-070F8-A5251-F6F16-70AFD-C2854-237A2-2020',0,'eyJtYWludGVuYW5jZUhlYWRpbmciOiJXZWIgU2l0ZW1peiBCYWtcdTAxMzFtZGFkXHUwMTMxciIsIm1haW50ZW5hbmNlQ29udGVudCI6Ilx1MDE1ZXUgYW5kYSBiYWtcdTAxMzFtZGF5XHUwMTMxei4gS1x1MDEzMXNhIHNcdTAwZmNyZSBzb25yYSBnZXJpIGRcdTAwZjZuZWNlXHUwMTFmaXoiLCJtYWludGVuYW5jZUR1cmF0aW9uIjoiMSIsIm1haW50ZW5hbmNlRXhwaXJ5IjoiMjAyMi0wOS0xNCIsIm1haW50ZW5hbmNlRXhwaXJ5VGltZSI6IjA6MDAifQ==',1,1,1,1,NULL,1,NULL,NULL,NULL,0,'',0,100,0,'',0,'','','eyJsb2dpblJlY2FwdGNoYSI6bnVsbCwicmVnaXN0ZXJSZWNhcHRjaGEiOm51bGwsInJlY292ZXJ5UmVjYXB0Y2hhIjpudWxsfQ==',10,1000,3,3,1,'server5.poyrazhosting.com','465',0,'rabi@webze.xyz','.ryUk{3,A8P5','<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<meta name=\"viewport\" content=\"width=device-width\">\r\n<style type=\"text/css\">\r\n    [EmailCSS]\r\n</style>\r\n<!--[if gte mso 9]>\r\n    <style type=\"text/css\">\r\n        .container-radius{\r\n            padding-left: 48px;\r\n            padding-right: 48px;\r\n            padding-top 32px;\r\n        }\r\n        a{\r\n            text-decoration: none;\r\n            text-underline-style: none;\r\n            text-underline-color: none;\r\n        }\r\n        .padding-title{\r\n            padding-top: 10px;\r\n            padding-bottom:10px;\r\n            padding-left: 8px;\r\n            padding-right: 8px;\r\n            margin-top: 16px;\r\n            margin-bottom: 0;\r\n        }\r\n        @media only screen and (max-width: 628px) {\r\n            .small-float-center {\r\n                margin: 0 auto !important;\r\n                float: none !important;\r\n                text-align: center !important\r\n            }\r\n            .container-radius{\r\n                border-spacing: 0 !important;\r\n                padding-left: 16px!important;\r\n                padding-right: 16px!important;\r\n                padding-top: 16px!important;\r\n            }\r\n        }\r\n    </style>\r\n<![endif]-->\r\n\r\n<!--[if mso]>\r\n    <style>\r\n        .padding-title {\r\n            padding-top: 10px;\r\n            padding-bottom: 10px;\r\n            padding-left: 8px;\r\n            padding-right: 8px;\r\n            margin-bottom: 0;\r\n            margin-top: 16px;\r\n        }\r\n        .container-radius {\r\n            padding-top: 32px;\r\n        }\r\n        @media only screen and (max-width: 628px) {\r\n            .small-float-center {\r\n                margin: 0 auto !important;\r\n                float: none !important;\r\n                text-align: center !important;\r\n            }\r\n            .container-radius {\r\n                border-spacing: 0 !important;\r\n                padding-left: 16px !important;\r\n                padding-right: 16px !important;\r\n                padding-top: 16px !important;\r\n            }\r\n        }\r\n    </style>\r\n<![endif]-->\r\n\r\n<span class=\"preheader\" style=\"color: #fff; display: none !important; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; mso-hide: all !important; opacity: 0; overflow: hidden; visibility: hidden;\"></span>\r\n<table class=\"body\" style=\"\r\n        margin: 0;\r\n        background: #262c3a !important;\r\n        border-collapse: collapse;\r\n        border-color: transparent;\r\n        border-spacing: 0;\r\n        color: #0a0a0a;\r\n        font-family: Roboto, sans-serif;\r\n        font-size: 16px;\r\n        font-weight: 400;\r\n        height: 100%;\r\n        line-height: 1.3;\r\n        margin: 0;\r\n        padding: 0;\r\n        text-align: left;\r\n        vertical-align: top;\r\n        width: 100%;\r\n    \">\r\n    <!--[if gte mso 9]>\r\n        <v:background xmlns:v=\"urn:schemas-microsoft-com:vml\" fill=\"t\">\r\n            <v:fill type=\"tile\" color=\"#fff\" />\r\n        </v:background>\r\n    <![endif]-->\r\n    <tbody>\r\n        <tr style=\"padding: 0; text-align: left; vertical-align: top;\">\r\n            <td class=\"center\" align=\"center\" valign=\"top\" style=\"\r\n                    -moz-hyphens: auto;\r\n                    -webkit-hyphens: auto;\r\n                    margin: 0;\r\n                    border-collapse: collapse !important;\r\n                    color: #0a0a0a;\r\n                    font-family: Roboto, sans-serif;\r\n                    font-size: 16px;\r\n                    font-weight: 400;\r\n                    hyphens: auto;\r\n                    line-height: 1.3;\r\n                    margin: 0;\r\n                    padding: 0;\r\n                    text-align: left;\r\n                    vertical-align: top;\r\n                    word-wrap: break-word;\r\n                \">\r\n                <center data-parsed=\"\" style=\"min-width: 580px; width: 100%;\">\r\n                    <table class=\"spacer float-center\" style=\"margin: 0 auto; border-collapse: collapse; border-color: transparent; border-spacing: 0; float: none; margin: 0 auto; padding: 0; text-align: center; vertical-align: top; width: 100%;\">\r\n                        <tbody>\r\n                            <tr style=\"padding: 0; text-align: left; vertical-align: top;\">\r\n                                <td height=\"0\" style=\"\r\n                                        -moz-hyphens: auto;\r\n                                        -webkit-hyphens: auto;\r\n                                        margin: 0;\r\n                                        border-collapse: collapse !important;\r\n                                        color: #0a0a0a;\r\n                                        font-family: Roboto, sans-serif;\r\n                                        font-size: 40px;\r\n                                        font-weight: 400;\r\n                                        hyphens: auto;\r\n                                        line-height: 40px;\r\n                                        margin: 0;\r\n                                        mso-line-height-rule: exactly;\r\n                                        padding: 0;\r\n                                        text-align: left;\r\n                                        vertical-align: top;\r\n                                        word-wrap: break-word;\r\n                                    \">\r\n                                     \r\n                                </td>\r\n                            </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <table align=\"center\" class=\"container header float-center\" style=\"\r\n                            margin: 0 auto;\r\n                            background: 0 0;\r\n                            border-collapse: collapse;\r\n                            border-color: transparent;\r\n                            border-spacing: 0;\r\n                            float: none;\r\n                            margin: 0 auto;\r\n                            padding: 0;\r\n                            text-align: center;\r\n                            vertical-align: top;\r\n                            width: 580px;\r\n                            max-width: 580px;\r\n                        \">\r\n                        <tbody>\r\n                            <tr style=\"padding: 0; text-align: left; vertical-align: top;\">\r\n                                <td style=\"\r\n                                        -moz-hyphens: auto;\r\n                                        -webkit-hyphens: auto;\r\n                                        margin: 0;\r\n                                        border-collapse: collapse !important;\r\n                                        color: #0a0a0a;\r\n                                        font-family: Roboto, sans-serif;\r\n                                        font-size: 16px;\r\n                                        font-weight: 400;\r\n                                        hyphens: auto;\r\n                                        line-height: 1.3;\r\n                                        margin: 0;\r\n                                        padding: 0;\r\n                                        text-align: left;\r\n                                        vertical-align: top;\r\n                                        word-wrap: break-word;\r\n                                    \">\r\n                                    <table class=\"row collapse logo-wrapper\" style=\"background: 0 0; border-collapse: collapse; border-color: transparent; border-spacing: 0; display: table; padding: 0; position: relative; text-align: left; vertical-align: top; width: 100%;\">\r\n                                        <tbody>\r\n                                            <tr style=\"padding: 0; text-align: left; vertical-align: top;\">\r\n                                                <th class=\"small-12 large-6 columns first\" style=\"\r\n                                                        margin: 0 auto;\r\n                                                        color: #0a0a0a;\r\n                                                        font-family: Roboto, sans-serif;\r\n                                                        font-size: 16px;\r\n                                                        font-weight: 400;\r\n                                                        line-height: 1.3;\r\n                                                        margin: 0 auto;\r\n                                                        padding: 0;\r\n                                                        padding-bottom: 0;\r\n                                                        padding-left: 0;\r\n                                                        padding-right: 0;\r\n                                                        text-align: center;\r\n                                                        width: 200px;\r\n                                                    \">\r\n                                                    <table style=\"border-collapse: collapse; border-color: transparent; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;\">\r\n                                                        <tbody>\r\n                                                            <tr style=\"padding: 0; text-align: left; vertical-align: top;\">\r\n                                                                <th valign=\"middle\" height=\"49\" style=\"margin: 0; color: #0a0a0a; font-family: Roboto, sans-serif; font-size: 16px; font-weight: 400; line-height: 1.3; margin: 0; padding: 0; text-align: center;\">\r\n                                                                    <img width=\"200\" class=\"header-logo\" src=\"https://cdn.discordapp.com/attachments/783384061208559647/783738473903292486/logoaaa.png\" alt=\"\" style=\"\r\n                                                                            -ms-interpolation-mode: bicubic;\r\n                                                                            clear: both;\r\n                                                                            display: block;\r\n                                                                            max-width: 220px;\r\n                                                                            width: auto;\r\n                                                                            height: auto;\r\n                                                                            outline: 0;\r\n                                                                            text-decoration: none;\r\n                                                                            max-height: 49px;\r\n                                                                            margin: auto;\r\n                                                                        \">\r\n                                                                </th>\r\n                                                            </tr>\r\n                                                        </tbody>\r\n                                                    </table>\r\n                                                </th>\r\n                                            </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <table class=\"spacer float-center\" style=\"margin: 0 auto; border-collapse: collapse; border-color: transparent; border-spacing: 0; float: none; margin: 0 auto; padding: 0; text-align: center; vertical-align: top; width: 100%;\">\r\n                        <tbody>\r\n                            <tr style=\"padding: 0; text-align: left; vertical-align: top;\">\r\n                                <td height=\"32px\" style=\"\r\n                                        -moz-hyphens: auto;\r\n                                        -webkit-hyphens: auto;\r\n                                        margin: 0;\r\n                                        border-collapse: collapse !important;\r\n                                        color: #0a0a0a;\r\n                                        font-family: Roboto, sans-serif;\r\n                                        font-size: 32px;\r\n                                        font-weight: 400;\r\n                                        hyphens: auto;\r\n                                        line-height: 32px;\r\n                                        margin: 0;\r\n                                        mso-line-height-rule: exactly;\r\n                                        padding: 0;\r\n                                        text-align: left;\r\n                                        vertical-align: top;\r\n                                        word-wrap: break-word;\r\n                                    \">\r\n                                     \r\n                                </td>\r\n                            </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" class=\"container body-drip float-center\" style=\"\r\n                            margin: 0 auto;\r\n                            border-bottom-left-radius: 3px;\r\n                            border-bottom-right-radius: 3px;\r\n                            border-collapse: collapse;\r\n                            border-color: transparent;\r\n                            border-spacing: 0;\r\n                            float: none;\r\n                            margin: 0 auto;\r\n                            padding: 0;\r\n                            text-align: center;\r\n                            vertical-align: top;\r\n                            width: 580px;\r\n                            max-width: 580px;\r\n                        \">\r\n                        <tbody>\r\n                            <tr style=\"padding: 0; text-align: left; vertical-align: top;\">\r\n                                <td style=\"\r\n                                        -moz-hyphens: auto;\r\n                                        -webkit-hyphens: auto;\r\n                                        margin: 0;\r\n                                        border-collapse: collapse !important;\r\n                                        color: #0a0a0a;\r\n                                        font-family: Roboto, sans-serif;\r\n                                        font-size: 16px;\r\n                                        font-weight: 400;\r\n                                        hyphens: auto;\r\n                                        line-height: 1.3;\r\n                                        margin: 0;\r\n                                        padding: 0;\r\n                                        text-align: left;\r\n                                        vertical-align: top;\r\n                                        word-wrap: break-word;\r\n                                    \">\r\n                                    <table class=\"container-radius\" style=\"\r\n                                            display: table;\r\n                                            padding-bottom: 32px;\r\n                                            border-spacing: 48px 0;\r\n                                            border-collapse: separate;\r\n                                            width: 100%;\r\n                                            background: #fff;\r\n                                            max-width: 580px;\r\n                                            box-shadow: 0 10px 100px 0 rgba(77, 77, 119, 0.16);\r\n                                            border-top-left-radius: 10px;\r\n                                            border-top-right-radius: 10px;\r\n                                            border-bottom-left-radius: 10px;\r\n                                            border-bottom-right-radius: 10px;\r\n                                            position: relative;\r\n                                        \">\r\n                                        <tbody>\r\n                                            <tr>\r\n                                                <td>\r\n                                                    <table class=\"row\" style=\"border-collapse: collapse; border-color: transparent; border-spacing: 0; display: table; padding: 0; position: relative; text-align: left; vertical-align: top; width: 100%;\">\r\n                                                        <tbody>\r\n                                                            <tr style=\"padding: 0; text-align: left; vertical-align: top;\"></tr>\r\n                                                        </tbody>\r\n                                                    </table>\r\n                                                    <table class=\"spacer mobile-hide\" style=\"border-collapse: collapse; border-color: transparent; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;\">\r\n                                                        <tbody>\r\n                                                            <tr style=\"padding: 0; text-align: left; vertical-align: top;\">\r\n                                                                <td height=\"32px\" style=\"\r\n                                                                        -moz-hyphens: auto;\r\n                                                                        -webkit-hyphens: auto;\r\n                                                                        margin: 0;\r\n                                                                        border-collapse: collapse !important;\r\n                                                                        color: #0a0a0a;\r\n                                                                        font-family: Roboto, sans-serif;\r\n                                                                        font-size: 32px;\r\n                                                                        font-weight: 400;\r\n                                                                        hyphens: auto;\r\n                                                                        line-height: 32px;\r\n                                                                        margin: 0;\r\n                                                                        mso-line-height-rule: exactly;\r\n                                                                        padding: 0;\r\n                                                                        text-align: left;\r\n                                                                        vertical-align: top;\r\n                                                                        word-wrap: break-word;\r\n                                                                    \"></td>\r\n                                                            </tr>\r\n                                                        </tbody>\r\n                                                    </table>\r\n                                                    <p style=\"margin-top: 0 !important; margin-bottom: 1rem !important;\">Merhaba <strong>%username%</strong>,</p>\r\n                                                    <p style=\"margin-top: 0 !important; margin-bottom: 1rem !important;\"><br></p>\r\n                                                    <p style=\"margin-top: 0 !important; margin-bottom: 1rem !important;\">Şifre sıfırlama isteğinizi aldık, aşağıdaki bağlantıyı kullanarak şifrenizi değiştirebilirsiniz.</p>\r\n                                                    <p style=\"margin-top: 0 !important; margin-bottom: 1rem !important;\"><br></p>\r\n                                                    <div style=\"margin: 1.25rem 0 !important;\">\r\n                                                        <a href=\"%url%\" style=\"\r\n                                                                color: #ffffff !important;\r\n                                                                background-color: #f3755d !important;\r\n                                                                padding: 0.5rem 1.5rem !important;\r\n                                                                margin-bottom: 1rem !important;\r\n                                                                text-decoration: none !important;\r\n                                                                text-align: center !important;\r\n                                                                vertical-align: middle !important;\r\n                                                                border-radius: 2rem !important;\r\n                                                                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;\r\n                                                            \">\r\n                                                            Şifreyi Değiştir\r\n                                                        </a>\r\n                                                    </div>\r\n                                                </td>\r\n                                            </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                    <table class=\"spacer\" style=\"border-collapse: collapse; border-color: transparent; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;\">\r\n                                        <tbody>\r\n                                            <tr style=\"padding: 0; text-align: left; vertical-align: top;\">\r\n                                                <td height=\"40px\" style=\"\r\n                                                        -moz-hyphens: auto;\r\n                                                        -webkit-hyphens: auto;\r\n                                                        margin: 0;\r\n                                                        border-collapse: collapse !important;\r\n                                                        color: #0a0a0a;\r\n                                                        font-family: Roboto, sans-serif;\r\n                                                        font-size: 40px;\r\n                                                        font-weight: 400;\r\n                                                        hyphens: auto;\r\n                                                        line-height: 40px;\r\n                                                        margin: 0;\r\n                                                        mso-line-height-rule: exactly;\r\n                                                        padding: 0;\r\n                                                        text-align: left;\r\n                                                        vertical-align: top;\r\n                                                        word-wrap: break-word;\r\n                                                    \">\r\n                                                     \r\n                                                </td>\r\n                                            </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                    <table class=\"spacer float-center\" style=\"margin: 0 auto; border-collapse: collapse; border-color: transparent; border-spacing: 0; float: none; margin: 0 auto; padding: 0; text-align: center; vertical-align: top; width: 100%;\">\r\n                                        <tbody>\r\n                                            <tr style=\"padding: 0; text-align: center; vertical-align: top;\">\r\n                                                <td height=\"40px\" style=\"\r\n                                                        -moz-hyphens: auto;\r\n                                                        -webkit-hyphens: auto;\r\n                                                        margin: 0;\r\n                                                        border-collapse: collapse !important;\r\n                                                        color: #0a0a0a;\r\n                                                        font-family: Roboto, sans-serif;\r\n                                                        font-size: 40px;\r\n                                                        font-weight: 400;\r\n                                                        hyphens: auto;\r\n                                                        line-height: 40px;\r\n                                                        margin: 0;\r\n                                                        mso-line-height-rule: exactly;\r\n                                                        padding: 0;\r\n                                                        text-align: center;\r\n                                                        vertical-align: top;\r\n                                                        word-wrap: break-word;\r\n                                                    \">\r\n                                                     \r\n                                                </td>\r\n                                            </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                        </tbody>\r\n                    </table>\r\n                    <!-- prevent Gmail on iOS font size manipulation -->\r\n                </center>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>',0,'eyJ3ZWJob29rIjoiIiwidGl0bGUiOiJNYVx1MDExZmF6YSIsImNvbG9yIjoiI0M0NEI0QiIsImltYWdlIjoiIiwiY29udGVudCI6IkBldmVyeW9uZSIsImRlc2NyaXB0aW9uIjoiJmd0OyAqKiV1c2VybmFtZSUqKiBhZGxcdTAxMzEga3VsbGFuXHUwMTMxY1x1MDEzMSAqKiVzZXJ2ZXIlKiogc3VudWN1c3VuZGFuICoqJXByb2R1Y3QlKiogXHUwMGZjclx1MDBmY25cdTAwZmNuXHUwMGZjIHNhdFx1MDEzMW4gYWxkXHUwMTMxLiJ9',0,'eyJ3ZWJob29rIjoiIiwidGl0bGUiOiJLcmVkaSIsImNvbG9yIjoiIzg4M0EzQSIsImltYWdlIjoiIiwiY29udGVudCI6IkBldmVyeW9uZSIsImRlc2NyaXB0aW9uIjoiJmd0OyAqKiV1c2VybmFtZSUqKiBhZGxcdTAxMzEga3VsbGFuXHUwMTMxY1x1MDEzMSAqKiVjcmVkaXQlIGtyZWRpKiogKCVtb25leSUgVEwpIHlcdTAwZmNrbGVkaS4ifQ==',0,'eyJ3ZWJob29rIjoiIiwidGl0bGUiOiJLYXNhIEFcdTAwZTdcdTAxMzFsXHUwMTMxbVx1MDEzMSIsImNvbG9yIjoiIzYxMUMxQyIsImltYWdlIjoiIiwiY29udGVudCI6IkBldmVyeW9uZSIsImRlc2NyaXB0aW9uIjoiKioldXNlcm5hbWUlKiogYWRsXHUwMTMxIGt1bGxhblx1MDEzMWNcdTAxMzEgKiolY2FzZSUqKiBhZGxcdTAxMzEga2FzYWRhbiAqKiVhd2FyZCUqKiBcdTAwZjZkXHUwMGZjbFx1MDBmYyBrYXphbmRcdTAxMzEuIn0=',0,'eyJ3ZWJob29rIjoiIiwidGl0bGUiOiJEZXN0ZWsgTWVzYWpcdTAxMzEiLCJjb2xvciI6IiM3OTVFNUUiLCJpbWFnZSI6IiIsImNvbnRlbnQiOiJAZXZlcnlvbmUiLCJkZXNjcmlwdGlvbiI6IiZndDsgKioldXNlcm5hbWUlKiogYWRsXHUwMTMxIGt1bGxhblx1MDEzMWNcdTAxMzEgZGVzdGVrIG1lc2FqXHUwMTMxIGdcdTAwZjZuZGVyZGkuXHJcbiVwYW5lbHVybCUifQ==',0,'eyJ3ZWJob29rIjoiIiwidGl0bGUiOiJZb3J1bWxhciIsImNvbG9yIjoiI0I4OEI4QiIsImltYWdlIjoiIiwiY29udGVudCI6IkBldmVyeW9uZSIsImRlc2NyaXB0aW9uIjoiJmd0OyAqKiV1c2VybmFtZSUqKiBhZGxcdTAxMzEga3VsbGFuXHUwMTMxY1x1MDEzMSBoYWJlcmUgeW9ydW0geWFwdFx1MDEzMS5cclxuJW5ld3N1cmwlIn0=','2021-01-24 08:30:04',1);
/*!40000 ALTER TABLE `Settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Slider`
--

DROP TABLE IF EXISTS `Slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `updateDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `type` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Slider`
--

LOCK TABLES `Slider` WRITE;
/*!40000 ALTER TABLE `Slider` DISABLE KEYS */;
INSERT INTO `Slider` (`id`, `heading`, `content`, `link`, `creationDate`, `updateDate`, `type`, `image`) VALUES (2,'Deneme','<p>Deneme</p>','#','2023-01-19 09:54:10','2023-01-19 09:57:51',1,'73a53651f32d84f524a71bbac9b68e42.png');
/*!40000 ALTER TABLE `Slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `StoreHistory`
--

DROP TABLE IF EXISTS `StoreHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `StoreHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `serverID` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT 1,
  `price` int(11) DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StoreHistory`
--

LOCK TABLES `StoreHistory` WRITE;
/*!40000 ALTER TABLE `StoreHistory` DISABLE KEYS */;
INSERT INTO `StoreHistory` (`id`, `accID`, `productID`, `serverID`, `type`, `price`, `creationDate`) VALUES (15,1,8,3,1,100,'2022-09-11 02:14:24');
/*!40000 ALTER TABLE `StoreHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SupportAnswers`
--

DROP TABLE IF EXISTS `SupportAnswers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SupportAnswers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SupportAnswers`
--

LOCK TABLES `SupportAnswers` WRITE;
/*!40000 ALTER TABLE `SupportAnswers` DISABLE KEYS */;
/*!40000 ALTER TABLE `SupportAnswers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SupportCategory`
--

DROP TABLE IF EXISTS `SupportCategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SupportCategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SupportCategory`
--

LOCK TABLES `SupportCategory` WRITE;
/*!40000 ALTER TABLE `SupportCategory` DISABLE KEYS */;
INSERT INTO `SupportCategory` (`id`, `heading`) VALUES (1,'Genel Destek'),(2,'Bug Bildirimi'),(3,'Muhasebe'),(4,'Oyuncu Şikayet');
/*!40000 ALTER TABLE `SupportCategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SupportMessages`
--

DROP TABLE IF EXISTS `SupportMessages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SupportMessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supportID` int(11) DEFAULT NULL,
  `accID` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SupportMessages`
--

LOCK TABLES `SupportMessages` WRITE;
/*!40000 ALTER TABLE `SupportMessages` DISABLE KEYS */;
/*!40000 ALTER TABLE `SupportMessages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SupportTickets`
--

DROP TABLE IF EXISTS `SupportTickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SupportTickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accID` int(11) DEFAULT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `serverID` int(11) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `updateDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SupportTickets`
--

LOCK TABLES `SupportTickets` WRITE;
/*!40000 ALTER TABLE `SupportTickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `SupportTickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Theme`
--

DROP TABLE IF EXISTS `Theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `youtubeEmbed` varchar(255) DEFAULT NULL,
  `broadcast` int(11) DEFAULT NULL,
  `slider` int(11) DEFAULT NULL,
  `sliderType` int(11) DEFAULT NULL,
  `sliceHeading` varchar(255) DEFAULT NULL,
  `sliceSubHeading` varchar(255) DEFAULT NULL,
  `slice` int(11) DEFAULT NULL,
  `sliceType` int(11) DEFAULT NULL,
  `sidebar` int(11) DEFAULT NULL,
  `discord` int(11) DEFAULT NULL,
  `discordTheme` int(11) DEFAULT NULL,
  `discordServerID` varchar(255) DEFAULT NULL,
  `colors` text DEFAULT NULL,
  `newsCardType` int(11) DEFAULT NULL,
  `headerType` int(11) DEFAULT NULL,
  `headerTheme` int(11) DEFAULT NULL,
  `menuType` int(11) DEFAULT NULL,
  `footerType` int(11) DEFAULT NULL,
  `headerLogo` varchar(255) DEFAULT NULL,
  `headerBgStatus` int(11) DEFAULT NULL,
  `headerBg` varchar(255) DEFAULT NULL,
  `sliceBg` varchar(255) DEFAULT NULL,
  `loginBgStatus` int(11) DEFAULT NULL,
  `loginBg` varchar(255) DEFAULT NULL,
  `css` mediumtext DEFAULT NULL,
  `discordOnlineCount` int(11) DEFAULT NULL,
  `serverOnlineCount` int(11) DEFAULT NULL,
  `onlineUpdateDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Theme`
--

LOCK TABLES `Theme` WRITE;
/*!40000 ALTER TABLE `Theme` DISABLE KEYS */;
INSERT INTO `Theme` (`id`, `theme`, `type`, `youtubeEmbed`, `broadcast`, `slider`, `sliderType`, `sliceHeading`, `sliceSubHeading`, `slice`, `sliceType`, `sidebar`, `discord`, `discordTheme`, `discordServerID`, `colors`, `newsCardType`, `headerType`, `headerTheme`, `menuType`, `footerType`, `headerLogo`, `headerBgStatus`, `headerBg`, `sliceBg`, `loginBgStatus`, `loginBg`, `css`, `discordOnlineCount`, `serverOnlineCount`, `onlineUpdateDate`) VALUES (1,'2021',1,'Z34SBGwdbq8',1,1,1,'RabiWeb\'i tercih etmeye ne dersin?','Hemen ücretsiz kayıt ol ve aramıza katıl!',1,0,1,1,1,'1015722057524334722','eyJjb2xvciI6WyIjMkQzNzQ4IiwiIzFBMjAyQyIsIiNGNkEyNTUiLCIjRTJFOEYwIiwiIzFBMjAyQyIsIiNFMkU4RjAiLCIjNjFERjY5IiwiIzdGOURGRiJdfQ==',0,1,0,1,1,'1d32aff703d85d15bae502cbe4041b19.gif',1,'95e2748135f602543100869ac0c8c7bf.jpg','58b4e151bcdfb33814b5bf87c7307796.jpg',0,'','',0,0,'2021-01-24 05:31:04');
/*!40000 ALTER TABLE `Theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `realname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `credit` int(11) NOT NULL DEFAULT 0,
  `permission` int(11) DEFAULT 0,
  `ip` varchar(40) DEFAULT NULL,
  `skype` varchar(255) DEFAULT '-',
  `discord` varchar(255) DEFAULT '-',
  `lastlogin` bigint(20) NOT NULL DEFAULT 0,
  `x` double NOT NULL DEFAULT 0,
  `y` double NOT NULL DEFAULT 0,
  `z` double NOT NULL DEFAULT 0,
  `world` varchar(255) NOT NULL DEFAULT 'world',
  `regdate` bigint(20) NOT NULL DEFAULT 0,
  `regip` varchar(40) DEFAULT NULL,
  `yaw` float DEFAULT NULL,
  `pitch` float DEFAULT NULL,
  `email` varchar(255) DEFAULT 'player@email.com',
  `isLogged` smallint(6) NOT NULL DEFAULT 0,
  `hasSession` smallint(6) NOT NULL DEFAULT 0,
  `totp` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=234 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` (`id`, `username`, `realname`, `password`, `credit`, `permission`, `ip`, `skype`, `discord`, `lastlogin`, `x`, `y`, `z`, `world`, `regdate`, `regip`, `yaw`, `pitch`, `email`, `isLogged`, `hasSession`, `totp`) VALUES (1,'admin','admin','$SHA$x8LQqM48ZxY6RNo9$cba24ccc930315bea1cd53be3785d4d4a91e75bd7ae51a3f549d15ca3a9f9735',20,6,'78.174.107.203','-','-',1662885219000,0,0,0,'world',1650809439000,'213.74.87.28',NULL,NULL,'contact@rabi.web.tr',0,0,NULL),(233,'demo','demo','$SHA$WvG2LNmayyFJleCm$8d941ed7670bfd0d1f70909eee638aad3c3b929a39c9568537ddd47599c3cf80',0,6,'81.215.207.132','-','-',1674111649000,0,0,0,'world',1674110862000,'81.215.207.132',NULL,NULL,'demo@gmail.com',0,0,NULL);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VipExpiryCommands`
--

DROP TABLE IF EXISTS `VipExpiryCommands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VipExpiryCommands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) DEFAULT NULL,
  `accID` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `expiryDate` datetime DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VipExpiryCommands`
--

LOCK TABLES `VipExpiryCommands` WRITE;
/*!40000 ALTER TABLE `VipExpiryCommands` DISABLE KEYS */;
/*!40000 ALTER TABLE `VipExpiryCommands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VipFeatures`
--

DROP TABLE IF EXISTS `VipFeatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VipFeatures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `serverID` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `updateDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VipFeatures`
--

LOCK TABLES `VipFeatures` WRITE;
/*!40000 ALTER TABLE `VipFeatures` DISABLE KEYS */;
/*!40000 ALTER TABLE `VipFeatures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Vips`
--

DROP TABLE IF EXISTS `Vips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Vips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT 0,
  `discountPrice` int(11) DEFAULT NULL,
  `discountDuration` int(11) DEFAULT NULL,
  `discountExpiry` date DEFAULT NULL,
  `serverID` int(11) DEFAULT NULL,
  `commands` text DEFAULT NULL,
  `expiryCommands` text DEFAULT NULL,
  `stockStatus` int(11) DEFAULT 0,
  `stock` int(11) DEFAULT 0,
  `totalSales` int(11) DEFAULT 0,
  `duration` int(11) DEFAULT 0,
  `durationDay` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vips`
--

LOCK TABLES `Vips` WRITE;
/*!40000 ALTER TABLE `Vips` DISABLE KEYS */;
/*!40000 ALTER TABLE `Vips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aegisauth_users`
--

DROP TABLE IF EXISTS `aegisauth_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aegisauth_users` (
  `uuid` char(36) NOT NULL,
  `name` char(16) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `registered` tinyint(1) DEFAULT NULL,
  `premium` tinyint(1) DEFAULT NULL,
  `onlineId` char(37) DEFAULT NULL,
  `premiumAnswer` char(4) DEFAULT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aegisauth_users`
--

LOCK TABLES `aegisauth_users` WRITE;
/*!40000 ALTER TABLE `aegisauth_users` DISABLE KEYS */;
INSERT INTO `aegisauth_users` (`uuid`, `name`, `password`, `registered`, `premium`, `onlineId`, `premiumAnswer`) VALUES ('d7dd22c4-bc09-3cc1-8c3b-291ae16000d9','MODLOFF',NULL,0,1,'099fa402-cdf7-4875-9c84-d351157671bd.','YES');
/*!40000 ALTER TABLE `aegisauth_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'rabiwebcom_webscript'
--

--
-- Dumping routines for database 'rabiwebcom_webscript'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-19 10:21:28
