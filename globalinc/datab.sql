-- MySQL dump 10.11
--
-- Host: localhost    Database: db_tup
-- ------------------------------------------------------
-- Server version	5.0.45-community-nt

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
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(11) NOT NULL auto_increment,
  `ques_id` int(11) NOT NULL,
  `value` varchar(300) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL auto_increment,
  `ques` text NOT NULL,
  `created_on` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ad_category`
--

DROP TABLE IF EXISTS `tbl_ad_category`;
CREATE TABLE `tbl_ad_category` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ad_category`
--

LOCK TABLES `tbl_ad_category` WRITE;
/*!40000 ALTER TABLE `tbl_ad_category` DISABLE KEYS */;
INSERT INTO `tbl_ad_category` VALUES (1,'240X30');
/*!40000 ALTER TABLE `tbl_ad_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` VALUES (1,'Administrator','8f850e4f06d4e33f2cce9720e1d540b51de3a9ceca0ca5fd68f83e85a01bd1cc3781827d61c1cde838645ea85c6cf41879faed5f771c86f907628813187c89eef3f62f5232f3b54','pratik.raghubanshi@gmail.com','f3f62f5232f3b54'),(2,'admin','6100c0614b4fcf5cb91d194a1fb8f7d6e6e0ca840ac40894b52cfd0f75b0fb709195d7b002bcfa47b922c41ef01752b023f3b59f50e05608881fd87170b45c71422d50207de5ccb','admin@itechnepal.com','422d50207de5ccb'),(3,'pratik','82f4631c51dc3c24d0f24ced7e5444f7c062a3d7ac90828a53bf80c71b330829bc5404b053f04e4b0030a162ccd56ae417b1256d6d3003facebdd1f3582371fbae59e4740185791','pratik.raghubanshi@gmail.com','ae59e4740185791');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_advertisement`
--

DROP TABLE IF EXISTS `tbl_advertisement`;
CREATE TABLE `tbl_advertisement` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `display` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_advertisement`
--

LOCK TABLES `tbl_advertisement` WRITE;
/*!40000 ALTER TABLE `tbl_advertisement` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_advertisement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_events`
--

DROP TABLE IF EXISTS `tbl_events`;
CREATE TABLE `tbl_events` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `shortdesc` text NOT NULL,
  `description` mediumtext NOT NULL,
  `posted_on` date NOT NULL,
  `date_tracker` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `posted_by` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_events`
--

LOCK TABLES `tbl_events` WRITE;
/*!40000 ALTER TABLE `tbl_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_features`
--

DROP TABLE IF EXISTS `tbl_features`;
CREATE TABLE `tbl_features` (
  `id` int(11) NOT NULL auto_increment,
  `feature_name` varchar(255) NOT NULL,
  `isactive` int(11) NOT NULL,
  `menu_function` varchar(255) NOT NULL,
  `default_link` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_features`
--

LOCK TABLES `tbl_features` WRITE;
/*!40000 ALTER TABLE `tbl_features` DISABLE KEYS */;
INSERT INTO `tbl_features` VALUES (1,'Pages',1,'get_admin_pages_menu',''),(2,'Articles',1,'get_admin_article_menu','?page=manage_news'),(3,'Slider',1,'',''),(4,'Resources',1,'get_admin_resource',''),(5,'Associates',1,'get_admin_associates_menu',''),(6,'Advertisement',1,'get_admin_ad_menu',''),(7,'Public Poll',1,'','?page=manage_poll'),(8,'Event Calendar',0,'','?page=manage_events'),(9,'Scheduler',1,'','?page=manage_program'),(10,'Useful Links',0,'','?page=manage_partners'),(11,'MessageBox',0,'','?page=manage_message'),(12,'Sweety Calendar',0,'','');
/*!40000 ALTER TABLE `tbl_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_horoscope`
--

DROP TABLE IF EXISTS `tbl_horoscope`;
CREATE TABLE `tbl_horoscope` (
  `id` int(11) NOT NULL auto_increment,
  `shine` int(255) NOT NULL,
  `description` text NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_horoscope`
--

LOCK TABLES `tbl_horoscope` WRITE;
/*!40000 ALTER TABLE `tbl_horoscope` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_horoscope` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_images`
--

DROP TABLE IF EXISTS `tbl_images`;
CREATE TABLE `tbl_images` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `isprimary` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_images`
--

LOCK TABLES `tbl_images` WRITE;
/*!40000 ALTER TABLE `tbl_images` DISABLE KEYS */;
INSERT INTO `tbl_images` VALUES (1,'test','test','21482.jpeg',1,0);
/*!40000 ALTER TABLE `tbl_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_login_attempt`
--

DROP TABLE IF EXISTS `tbl_login_attempt`;
CREATE TABLE `tbl_login_attempt` (
  `id` int(11) NOT NULL auto_increment,
  `ip` varchar(20) NOT NULL,
  `logstatus` int(11) NOT NULL,
  `userid` int(11) default NULL,
  `login_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `initializer` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `logout_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login_attempt`
--

LOCK TABLES `tbl_login_attempt` WRITE;
/*!40000 ALTER TABLE `tbl_login_attempt` DISABLE KEYS */;
INSERT INTO `tbl_login_attempt` VALUES (1,'127.0.0.1',0,0,'2013-06-21 09:27:18',32715,'bdce6d118713b6d72567d3c566c40bfb','0000-00-00 00:00:00'),(2,'127.0.0.1',0,1,'2013-07-03 09:22:18',25952,'8ecaf2632e8c58b39a98f8a9d1cee5de','0000-00-00 00:00:00'),(3,'127.0.0.1',0,0,'2013-07-04 04:46:08',16983,'0cf9735757dc4b4ebce6132eea787505','0000-00-00 00:00:00'),(4,'127.0.0.1',0,1,'2013-07-04 04:46:20',16983,'0cf9735757dc4b4ebce6132eea787505','0000-00-00 00:00:00'),(5,'127.0.0.1',0,1,'2013-07-05 09:24:17',9157,'d4987982b4276f394bfa0c07b911e6ba','0000-00-00 00:00:00'),(6,'127.0.0.1',0,0,'2013-07-15 06:31:26',29372,'c91db575a37ce6dad73b633ea74c7805','0000-00-00 00:00:00'),(7,'127.0.0.1',0,0,'2013-07-15 06:31:39',29372,'c91db575a37ce6dad73b633ea74c7805','0000-00-00 00:00:00'),(8,'127.0.0.1',0,0,'2013-07-15 06:31:42',29372,'c91db575a37ce6dad73b633ea74c7805','0000-00-00 00:00:00'),(9,'127.0.0.1',0,0,'2013-07-15 06:31:44',29372,'c91db575a37ce6dad73b633ea74c7805','0000-00-00 00:00:00'),(13,'127.0.0.1',2,1,'2013-07-17 06:57:30',5036,'bb75ba9ecc7968134adc8d8f78ef16b9','2013-07-17 06:57:30'),(14,'127.0.0.1',2,1,'2013-07-17 06:59:09',8467,'09f49e71ededfd027b08010cfba6d678','2013-07-17 06:59:09'),(15,'127.0.0.1',2,1,'2013-07-17 07:00:23',30837,'aac7788606366211e18a620639ce71c1','2013-07-17 07:04:24'),(16,'127.0.0.1',2,1,'2013-07-17 07:14:53',8202,'412937992b235d2896166c06281006d0','0000-00-00 00:00:00'),(17,'192.168.1.102',0,2,'2013-07-17 07:15:41',9526,'465221a1e1e787952366067ee6bfc1ba','0000-00-00 00:00:00'),(18,'192.168.1.103',2,2,'2013-07-17 07:17:38',1349,'b97f209bc0673c9f29a6c3679be954cf','2013-07-17 07:29:24'),(19,'192.168.1.103',2,2,'2013-07-17 07:29:44',29850,'84a2837a6cd1a20d38a37a0a0067711c','2013-07-17 10:33:07'),(20,'127.0.0.1',1,1,'2013-07-17 08:54:21',8202,'412937992b235d2896166c06281006d0','0000-00-00 00:00:00'),(21,'192.168.1.103',2,2,'2013-07-17 08:59:53',29850,'84a2837a6cd1a20d38a37a0a0067711c','2013-07-17 10:33:07'),(22,'127.0.0.1',2,1,'2013-07-17 09:45:38',18279,'117b9aa6290fbc3f47eb2509a4879559','2013-07-17 12:20:10'),(23,'127.0.0.1',1,1,'2013-07-17 12:21:09',13778,'a2eee4bae44bf12cf213fae793eb04ca','0000-00-00 00:00:00'),(24,'127.0.0.1',1,1,'2013-07-18 06:30:04',4053,'c9d8cea1b200a09220a214919febdca9','0000-00-00 00:00:00'),(25,'127.0.0.1',1,1,'2013-07-18 10:59:54',851,'b9609bb4616beaa045c4bb5f8a76668b','0000-00-00 00:00:00'),(26,'127.0.0.1',2,1,'2013-07-19 05:05:38',15652,'855327796f55f8947776648de6356a7c','2013-07-19 06:19:30'),(27,'127.0.0.1',2,1,'2013-07-19 06:19:36',4875,'9ee5bc189df116ee9b529ddea10b98a1','2013-07-19 07:12:15'),(28,'192.168.1.105',2,3,'2013-07-19 07:07:09',9704,'4ea3afdb62d609d93ccc9c6264539fc2','2013-07-19 08:09:52'),(29,'127.0.0.1',1,1,'2013-07-19 09:00:55',23055,'a580d3e51637d96fda6d6d0feb3fd48e','0000-00-00 00:00:00'),(30,'127.0.0.1',1,1,'2013-07-21 05:56:48',7234,'fe184c40d5de2a67537aabd46a278d58','0000-00-00 00:00:00'),(31,'192.168.1.103',2,2,'2013-07-21 10:33:56',28390,'152ec081b091731426fdde7de360f1d7','2013-07-21 10:49:51'),(32,'192.168.1.103',0,1,'2013-07-21 10:50:03',21312,'8e414bf590242e5914ff0b34825d59f6','0000-00-00 00:00:00'),(33,'192.168.1.103',0,1,'2013-07-21 10:50:45',21312,'8e414bf590242e5914ff0b34825d59f6','0000-00-00 00:00:00'),(34,'192.168.1.103',0,1,'2013-07-21 10:52:02',21312,'8e414bf590242e5914ff0b34825d59f6','0000-00-00 00:00:00'),(35,'192.168.1.103',0,1,'2013-07-21 10:53:14',21312,'8e414bf590242e5914ff0b34825d59f6','0000-00-00 00:00:00'),(36,'127.0.0.1',2,1,'2013-07-22 08:39:22',2617,'5c10bf3f868a3693ec4d029cbf8fd0d1','2013-07-22 10:08:55'),(37,'127.0.0.1',1,1,'2013-07-22 10:11:35',4000,'ba4d3c78898cecd7662247502b518c92','0000-00-00 00:00:00'),(38,'192.168.1.103',1,2,'2013-07-23 05:52:48',6740,'6d229918c276b5fd8f16acecef5de307','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tbl_login_attempt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_message`
--

DROP TABLE IF EXISTS `tbl_message`;
CREATE TABLE `tbl_message` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `posted_on` date NOT NULL,
  `status` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_message`
--

LOCK TABLES `tbl_message` WRITE;
/*!40000 ALTER TABLE `tbl_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_news`
--

DROP TABLE IF EXISTS `tbl_news`;
CREATE TABLE `tbl_news` (
  `id` int(11) NOT NULL auto_increment,
  `type` int(11) NOT NULL,
  `title` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `shortdesc` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `description` longtext character set utf8 collate utf8_unicode_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `posted_on` date NOT NULL,
  `sub_type` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `highlight` int(11) NOT NULL,
  `featured` int(11) NOT NULL,
  `headline` int(11) NOT NULL,
  `counter` int(11) NOT NULL,
  `attachments` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_news`
--

LOCK TABLES `tbl_news` WRITE;
/*!40000 ALTER TABLE `tbl_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_news_type`
--

DROP TABLE IF EXISTS `tbl_news_type`;
CREATE TABLE `tbl_news_type` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `has_subcat` char(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_news_type`
--

LOCK TABLES `tbl_news_type` WRITE;
/*!40000 ALTER TABLE `tbl_news_type` DISABLE KEYS */;
INSERT INTO `tbl_news_type` VALUES (1,'News &amp; Events',0,''),(2,'Programs',0,'');
/*!40000 ALTER TABLE `tbl_news_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_newscomment`
--

DROP TABLE IF EXISTS `tbl_newscomment`;
CREATE TABLE `tbl_newscomment` (
  `id` int(11) NOT NULL auto_increment,
  `message` varchar(255) NOT NULL,
  `news_id` int(11) NOT NULL,
  `posted_on` date NOT NULL,
  `posted_by` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `country` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newscomment`
--

LOCK TABLES `tbl_newscomment` WRITE;
/*!40000 ALTER TABLE `tbl_newscomment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_newscomment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_newsstatus`
--

DROP TABLE IF EXISTS `tbl_newsstatus`;
CREATE TABLE `tbl_newsstatus` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newsstatus`
--

LOCK TABLES `tbl_newsstatus` WRITE;
/*!40000 ALTER TABLE `tbl_newsstatus` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_newsstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_page`
--

DROP TABLE IF EXISTS `tbl_page`;
CREATE TABLE `tbl_page` (
  `id` int(11) NOT NULL auto_increment,
  `pagelabel` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `description` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `topic` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `shortdesc` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `heading` text NOT NULL,
  `p_order` int(11) NOT NULL,
  `has_subpage` char(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_page`
--

LOCK TABLES `tbl_page` WRITE;
/*!40000 ALTER TABLE `tbl_page` DISABLE KEYS */;
INSERT INTO `tbl_page` VALUES (1,'About','','','','',0,'About Us',0,'n'),(2,'Contact us','','','','',0,'Contact us',0,'n');
/*!40000 ALTER TABLE `tbl_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_partner`
--

DROP TABLE IF EXISTS `tbl_partner`;
CREATE TABLE `tbl_partner` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `shortdesc` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_partner`
--

LOCK TABLES `tbl_partner` WRITE;
/*!40000 ALTER TABLE `tbl_partner` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_partner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_program`
--

DROP TABLE IF EXISTS `tbl_program`;
CREATE TABLE `tbl_program` (
  `pro_id` int(11) NOT NULL auto_increment,
  `day` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `title` varchar(100) NOT NULL,
  `station` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `highlight` enum('0','1') NOT NULL default '0',
  `rj_id` int(11) NOT NULL,
  PRIMARY KEY  (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_program`
--

LOCK TABLES `tbl_program` WRITE;
/*!40000 ALTER TABLE `tbl_program` DISABLE KEYS */;
INSERT INTO `tbl_program` VALUES (1,'Sunday','Waafg','','','02:05:00','16:25:00','0',0),(2,'Monday','rt','','','17:00:00','18:00:00','0',0),(3,'Monday','adsfasdf','','','18:00:00','18:20:00','0',0);
/*!40000 ALTER TABLE `tbl_program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_resource`
--

DROP TABLE IF EXISTS `tbl_resource`;
CREATE TABLE `tbl_resource` (
  `r_id` int(11) NOT NULL auto_increment,
  `type` int(11) NOT NULL,
  `title` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `file` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `shortdesc` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `sub_type` int(11) NOT NULL,
  PRIMARY KEY  (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_resource`
--

LOCK TABLES `tbl_resource` WRITE;
/*!40000 ALTER TABLE `tbl_resource` DISABLE KEYS */;
INSERT INTO `tbl_resource` VALUES (1,3,'My gallery','','','','2013-07-18 07:01:14',0),(2,5,'test','','http://www.youtube.com/v/','teset','2013-07-18 09:31:45',0);
/*!40000 ALTER TABLE `tbl_resource` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_resource_cat`
--

DROP TABLE IF EXISTS `tbl_resource_cat`;
CREATE TABLE `tbl_resource_cat` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `enabled` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_resource_cat`
--

LOCK TABLES `tbl_resource_cat` WRITE;
/*!40000 ALTER TABLE `tbl_resource_cat` DISABLE KEYS */;
INSERT INTO `tbl_resource_cat` VALUES (1,'Audio','',1),(2,'Downloads','',0),(3,'Gallery','?page=manage_gallery',1),(5,'Video','?page=manage_video',1);
/*!40000 ALTER TABLE `tbl_resource_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_resource_sub_cat`
--

DROP TABLE IF EXISTS `tbl_resource_sub_cat`;
CREATE TABLE `tbl_resource_sub_cat` (
  `id` int(11) NOT NULL auto_increment,
  `type` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `featured` int(11) NOT NULL,
  `shortdesc` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `updated_on` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `position` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_resource_sub_cat`
--

LOCK TABLES `tbl_resource_sub_cat` WRITE;
/*!40000 ALTER TABLE `tbl_resource_sub_cat` DISABLE KEYS */;
INSERT INTO `tbl_resource_sub_cat` VALUES (1,1,'Archive',0,'','','2013-06-24 05:04:36',0);
/*!40000 ALTER TABLE `tbl_resource_sub_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_seo`
--

DROP TABLE IF EXISTS `tbl_seo`;
CREATE TABLE `tbl_seo` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `tbl_name` varchar(200) NOT NULL,
  `res_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `keywords` (`keywords`),
  FULLTEXT KEY `description` (`description`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_seo`
--

LOCK TABLES `tbl_seo` WRITE;
/*!40000 ALTER TABLE `tbl_seo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_seo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_shine`
--

DROP TABLE IF EXISTS `tbl_shine`;
CREATE TABLE `tbl_shine` (
  `id` int(11) NOT NULL auto_increment,
  `shine` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shine`
--

LOCK TABLES `tbl_shine` WRITE;
/*!40000 ALTER TABLE `tbl_shine` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_shine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_site_settings`
--

DROP TABLE IF EXISTS `tbl_site_settings`;
CREATE TABLE `tbl_site_settings` (
  `id` int(11) NOT NULL auto_increment,
  `options` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `option_values` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_site_settings`
--

LOCK TABLES `tbl_site_settings` WRITE;
/*!40000 ALTER TABLE `tbl_site_settings` DISABLE KEYS */;
INSERT INTO `tbl_site_settings` VALUES (1,'sitename','Janapriya FM 102.4 MHZ'),(2,'district',''),(3,'banner','28182.png'),(4,'allow_page_file_uploads','n'),(5,'allow_article_file_uploads','n'),(6,'allow_article_comments','n'),(7,'slider_limit','5'),(8,'allow_category_add_news','n'),(9,'allow_category_add_associates','n'),(10,'site_email',''),(11,'site_phone',''),(12,'allow_category_add_pages','n'),(13,'allow_category_add_ad','n');
/*!40000 ALTER TABLE `tbl_site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_slider`
--

DROP TABLE IF EXISTS `tbl_slider`;
CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `shortdesc` text NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider`
--

LOCK TABLES `tbl_slider` WRITE;
/*!40000 ALTER TABLE `tbl_slider` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_staff_cat`
--

DROP TABLE IF EXISTS `tbl_staff_cat`;
CREATE TABLE `tbl_staff_cat` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `has_subcat` char(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_staff_cat`
--

LOCK TABLES `tbl_staff_cat` WRITE;
/*!40000 ALTER TABLE `tbl_staff_cat` DISABLE KEYS */;
INSERT INTO `tbl_staff_cat` VALUES (1,'Rj Profile',0,''),(2,'Management Team',0,'');
/*!40000 ALTER TABLE `tbl_staff_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_staffs`
--

DROP TABLE IF EXISTS `tbl_staffs`;
CREATE TABLE `tbl_staffs` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `dob` date NOT NULL,
  `s_order` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `publish` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_staffs`
--

LOCK TABLES `tbl_staffs` WRITE;
/*!40000 ALTER TABLE `tbl_staffs` DISABLE KEYS */;
INSERT INTO `tbl_staffs` VALUES (1,'test','test','test',1,'','','','test','0000-00-00',0,'','',0);
/*!40000 ALTER TABLE `tbl_staffs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_prev`
--

DROP TABLE IF EXISTS `tbl_user_prev`;
CREATE TABLE `tbl_user_prev` (
  `id` int(11) NOT NULL auto_increment,
  `admin_id` int(11) NOT NULL,
  `pages` int(11) NOT NULL,
  `slider` int(11) NOT NULL,
  `resources` int(11) NOT NULL,
  `advertisement` int(11) default NULL,
  `public_poll` int(11) default NULL,
  `scheduler` int(11) default NULL,
  `articles` int(11) default NULL,
  `associates` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_prev`
--

LOCK TABLES `tbl_user_prev` WRITE;
/*!40000 ALTER TABLE `tbl_user_prev` DISABLE KEYS */;
INSERT INTO `tbl_user_prev` VALUES (1,2,0,0,0,NULL,NULL,NULL,NULL,NULL),(2,3,1,1,1,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_user_prev` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_visits`
--

DROP TABLE IF EXISTS `tbl_visits`;
CREATE TABLE `tbl_visits` (
  `res_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `visits` int(11) NOT NULL,
  KEY `res_id` (`res_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_visits`
--

LOCK TABLES `tbl_visits` WRITE;
/*!40000 ALTER TABLE `tbl_visits` DISABLE KEYS */;
INSERT INTO `tbl_visits` VALUES (5,'article',14),(2,'article',3),(4,'article',9),(7,'article',3),(6,'article',5),(3,'article',3),(1,'article',3);
/*!40000 ALTER TABLE `tbl_visits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_zodiac_group`
--

DROP TABLE IF EXISTS `tbl_zodiac_group`;
CREATE TABLE `tbl_zodiac_group` (
  `id` int(11) NOT NULL auto_increment,
  `posted_date` date NOT NULL,
  `tithi` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_zodiac_group`
--

LOCK TABLES `tbl_zodiac_group` WRITE;
/*!40000 ALTER TABLE `tbl_zodiac_group` DISABLE KEYS */;
INSERT INTO `tbl_zodiac_group` VALUES (1,'2013-01-01','fgs');
/*!40000 ALTER TABLE `tbl_zodiac_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE `votes` (
  `id` int(11) NOT NULL auto_increment,
  `option_id` int(11) NOT NULL,
  `voted_on` datetime NOT NULL,
  `ip` varchar(16) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `votes`
--

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-07-23  6:45:11
