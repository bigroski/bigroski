-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 15, 2013 at 04:35 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_tayas`
--
CREATE DATABASE IF NOT EXISTS `db_tayas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_tayas`;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ques_id` int(11) NOT NULL,
  `value` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ques` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `salt`) VALUES
(1, 'Administrator', '8f850e4f06d4e33f2cce9720e1d540b51de3a9ceca0ca5fd68f83e85a01bd1cc3781827d61c1cde838645ea85c6cf41879faed5f771c86f907628813187c89eef3f62f5232f3b54', 'pratik.raghubanshi@gmail.com', 'f3f62f5232f3b54'),
(2, 'admin', '6100c0614b4fcf5cb91d194a1fb8f7d6e6e0ca840ac40894b52cfd0f75b0fb709195d7b002bcfa47b922c41ef01752b023f3b59f50e05608881fd87170b45c71422d50207de5ccb', 'admin@itechnepal.com', '422d50207de5ccb'),
(3, 'pratik', '82f4631c51dc3c24d0f24ced7e5444f7c062a3d7ac90828a53bf80c71b330829bc5404b053f04e4b0030a162ccd56ae417b1256d6d3003facebdd1f3582371fbae59e4740185791', 'pratik.raghubanshi@gmail.com', 'ae59e4740185791');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advertisement`
--

CREATE TABLE IF NOT EXISTS `tbl_advertisement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `display` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ad_category`
--

CREATE TABLE IF NOT EXISTS `tbl_ad_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_ad_category`
--

INSERT INTO `tbl_ad_category` (`id`, `category`) VALUES
(1, '240X30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE IF NOT EXISTS `tbl_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `shortdesc` text NOT NULL,
  `description` mediumtext NOT NULL,
  `posted_on` date NOT NULL,
  `date_tracker` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `posted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_features`
--

CREATE TABLE IF NOT EXISTS `tbl_features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature_name` varchar(255) NOT NULL,
  `isactive` int(11) NOT NULL,
  `menu_function` varchar(255) NOT NULL,
  `default_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_features`
--

INSERT INTO `tbl_features` (`id`, `feature_name`, `isactive`, `menu_function`, `default_link`) VALUES
(1, 'Pages', 1, 'get_admin_pages_menu', ''),
(2, 'Articles', 1, 'get_admin_article_menu', '?page=manage_news'),
(3, 'Slider', 0, '', ''),
(4, 'Resources', 0, 'get_admin_resource', ''),
(5, 'Associates', 0, 'get_admin_associates_menu', ''),
(6, 'Advertisement', 0, 'get_admin_ad_menu', ''),
(7, 'Public Poll', 0, '', '?page=manage_poll'),
(8, 'Event Calendar', 0, '', '?page=manage_events'),
(9, 'Scheduler', 0, '', '?page=manage_program'),
(10, 'Useful Links', 0, '', '?page=manage_partners'),
(11, 'MessageBox', 0, '', '?page=manage_message'),
(12, 'Sweety Calendar', 0, '', ''),
(13, 'product catelogue', 1, 'get_admin_product_menu', '?page=product_catelogue');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_horoscope`
--

CREATE TABLE IF NOT EXISTS `tbl_horoscope` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shine` int(255) NOT NULL,
  `description` text NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE IF NOT EXISTS `tbl_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `isprimary` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_images`
--

INSERT INTO `tbl_images` (`id`, `title`, `caption`, `image`, `type`, `isprimary`) VALUES
(1, 'test', 'test', '21482.jpeg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_attempt`
--

CREATE TABLE IF NOT EXISTS `tbl_login_attempt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) NOT NULL,
  `logstatus` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `initializer` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `logout_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_activity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `tbl_login_attempt`
--

INSERT INTO `tbl_login_attempt` (`id`, `ip`, `logstatus`, `userid`, `login_time`, `initializer`, `token`, `logout_time`, `last_activity`) VALUES
(1, '127.0.0.1', 0, 0, '2013-06-21 09:27:18', 32715, 'bdce6d118713b6d72567d3c566c40bfb', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '127.0.0.1', 0, 1, '2013-07-03 09:22:18', 25952, '8ecaf2632e8c58b39a98f8a9d1cee5de', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '127.0.0.1', 0, 0, '2013-07-04 04:46:08', 16983, '0cf9735757dc4b4ebce6132eea787505', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '127.0.0.1', 0, 1, '2013-07-04 04:46:20', 16983, '0cf9735757dc4b4ebce6132eea787505', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '127.0.0.1', 0, 1, '2013-07-05 09:24:17', 9157, 'd4987982b4276f394bfa0c07b911e6ba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '127.0.0.1', 0, 0, '2013-07-15 06:31:26', 29372, 'c91db575a37ce6dad73b633ea74c7805', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '127.0.0.1', 0, 0, '2013-07-15 06:31:39', 29372, 'c91db575a37ce6dad73b633ea74c7805', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '127.0.0.1', 0, 0, '2013-07-15 06:31:42', 29372, 'c91db575a37ce6dad73b633ea74c7805', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '127.0.0.1', 0, 0, '2013-07-15 06:31:44', 29372, 'c91db575a37ce6dad73b633ea74c7805', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, '127.0.0.1', 2, 1, '2013-07-17 06:57:30', 5036, 'bb75ba9ecc7968134adc8d8f78ef16b9', '2013-07-17 06:57:30', '0000-00-00 00:00:00'),
(14, '127.0.0.1', 2, 1, '2013-07-17 06:59:09', 8467, '09f49e71ededfd027b08010cfba6d678', '2013-07-17 06:59:09', '0000-00-00 00:00:00'),
(15, '127.0.0.1', 2, 1, '2013-07-17 07:00:23', 30837, 'aac7788606366211e18a620639ce71c1', '2013-07-17 07:04:24', '0000-00-00 00:00:00'),
(16, '127.0.0.1', 0, 1, '2013-07-17 07:14:53', 8202, '412937992b235d2896166c06281006d0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, '192.168.1.102', 0, 2, '2013-07-17 07:15:41', 9526, '465221a1e1e787952366067ee6bfc1ba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '192.168.1.103', 2, 2, '2013-07-17 07:17:38', 1349, 'b97f209bc0673c9f29a6c3679be954cf', '2013-07-17 07:29:24', '0000-00-00 00:00:00'),
(19, '192.168.1.103', 2, 2, '2013-07-17 07:29:44', 29850, '84a2837a6cd1a20d38a37a0a0067711c', '2013-07-17 10:33:07', '0000-00-00 00:00:00'),
(20, '127.0.0.1', 0, 1, '2013-07-17 08:54:21', 8202, '412937992b235d2896166c06281006d0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, '192.168.1.103', 2, 2, '2013-07-17 08:59:53', 29850, '84a2837a6cd1a20d38a37a0a0067711c', '2013-07-17 10:33:07', '0000-00-00 00:00:00'),
(22, '127.0.0.1', 2, 1, '2013-07-17 09:45:38', 18279, '117b9aa6290fbc3f47eb2509a4879559', '2013-07-17 12:20:10', '0000-00-00 00:00:00'),
(23, '127.0.0.1', 0, 1, '2013-07-17 12:21:09', 13778, 'a2eee4bae44bf12cf213fae793eb04ca', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, '127.0.0.1', 0, 1, '2013-07-18 06:30:04', 4053, 'c9d8cea1b200a09220a214919febdca9', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, '127.0.0.1', 0, 1, '2013-07-18 10:59:54', 851, 'b9609bb4616beaa045c4bb5f8a76668b', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, '127.0.0.1', 2, 1, '2013-07-19 05:05:38', 15652, '855327796f55f8947776648de6356a7c', '2013-07-19 06:19:30', '0000-00-00 00:00:00'),
(27, '127.0.0.1', 2, 1, '2013-07-19 06:19:36', 4875, '9ee5bc189df116ee9b529ddea10b98a1', '2013-07-19 07:12:15', '0000-00-00 00:00:00'),
(28, '192.168.1.105', 2, 3, '2013-07-19 07:07:09', 9704, '4ea3afdb62d609d93ccc9c6264539fc2', '2013-07-19 08:09:52', '0000-00-00 00:00:00'),
(29, '127.0.0.1', 0, 1, '2013-07-19 09:00:55', 23055, 'a580d3e51637d96fda6d6d0feb3fd48e', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, '127.0.0.1', 0, 1, '2013-07-21 05:56:48', 7234, 'fe184c40d5de2a67537aabd46a278d58', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, '192.168.1.103', 2, 2, '2013-07-21 10:33:56', 28390, '152ec081b091731426fdde7de360f1d7', '2013-07-21 10:49:51', '0000-00-00 00:00:00'),
(32, '192.168.1.103', 0, 1, '2013-07-21 10:50:03', 21312, '8e414bf590242e5914ff0b34825d59f6', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, '192.168.1.103', 0, 1, '2013-07-21 10:50:45', 21312, '8e414bf590242e5914ff0b34825d59f6', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, '192.168.1.103', 0, 1, '2013-07-21 10:52:02', 21312, '8e414bf590242e5914ff0b34825d59f6', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, '192.168.1.103', 0, 1, '2013-07-21 10:53:14', 21312, '8e414bf590242e5914ff0b34825d59f6', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, '127.0.0.1', 2, 1, '2013-07-22 08:39:22', 2617, '5c10bf3f868a3693ec4d029cbf8fd0d1', '2013-07-22 10:08:55', '0000-00-00 00:00:00'),
(37, '127.0.0.1', 0, 1, '2013-07-22 10:11:35', 4000, 'ba4d3c78898cecd7662247502b518c92', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, '192.168.1.103', 1, 2, '2013-07-23 05:52:48', 6740, '6d229918c276b5fd8f16acecef5de307', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, '127.0.0.1', 2, 1, '2013-09-05 10:19:51', 24394, '6e1bbd2a9405e095ad3724fbda10ff23', '2013-09-05 15:02:12', '2013-09-05 14:55:01'),
(40, '127.0.0.1', 0, 1, '2013-09-05 15:02:25', 18327, '1240a4a97d0d89f30d5379d3ba2908dd', '0000-00-00 00:00:00', '2013-09-05 15:15:02'),
(41, '127.0.0.1', 0, 1, '2013-09-05 15:17:20', 11652, 'bc74c07f0661edee391e12954f5c1f60', '0000-00-00 00:00:00', '2013-09-05 16:44:41'),
(42, '127.0.0.1', 0, 1, '2013-09-06 06:26:34', 19347, '6e1e1a96dc2e463ab3587bc7f07222bb', '0000-00-00 00:00:00', '2013-09-06 08:00:06'),
(43, '127.0.0.1', 0, 1, '2013-09-06 08:29:51', 5704, '46c0890738d223376ebe458514d98fcc', '0000-00-00 00:00:00', '2013-09-06 08:35:52'),
(44, '127.0.0.1', 2, 1, '2013-09-15 10:53:19', 31157, '317154699fcca354ff10ba1a03db2536', '2013-09-15 13:08:10', '2013-09-15 13:08:07'),
(45, '127.0.0.1', 2, 1, '2013-09-15 13:08:22', 30182, 'dbd6968bd5664e6ef62dd92ee9cfc273', '2013-09-15 16:31:26', '2013-09-15 16:31:25'),
(46, '127.0.0.1', 1, 1, '2013-09-15 16:31:30', 25124, '3fd0b33dcd19a01319d4011701d2d16f', '0000-00-00 00:00:00', '2013-09-15 16:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE IF NOT EXISTS `tbl_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `posted_on` date NOT NULL,
  `status` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE IF NOT EXISTS `tbl_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shortdesc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `posted_on` date NOT NULL,
  `sub_type` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `highlight` int(11) NOT NULL,
  `featured` int(11) NOT NULL,
  `headline` int(11) NOT NULL,
  `counter` int(11) NOT NULL,
  `attachments` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newscomment`
--

CREATE TABLE IF NOT EXISTS `tbl_newscomment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  `news_id` int(11) NOT NULL,
  `posted_on` date NOT NULL,
  `posted_by` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `country` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsstatus`
--

CREATE TABLE IF NOT EXISTS `tbl_newsstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news_type`
--

CREATE TABLE IF NOT EXISTS `tbl_news_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `has_subcat` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_news_type`
--

INSERT INTO `tbl_news_type` (`id`, `category`, `parent_id`, `has_subcat`) VALUES
(1, 'News/Campaign', 0, ''),
(2, 'Participation', 0, ''),
(3, 'Campaign', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

CREATE TABLE IF NOT EXISTS `tbl_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagelabel` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `topic` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shortdesc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `heading` text NOT NULL,
  `p_order` int(11) NOT NULL,
  `has_subpage` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `pagelabel`, `description`, `image`, `topic`, `shortdesc`, `parent_id`, `heading`, `p_order`, `has_subpage`) VALUES
(1, 'Corporate', '', '', '', '', 0, 'About Us', 0, 'y'),
(2, 'Contact us', '', '', '', '', 0, 'Contact us', 0, 'n'),
(3, 'History', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>', '30503.jpeg', '', 'test', 1, 'Company History', 0, 'n'),
(4, 'Press Room', '', '', '', '', 0, 'Press Room', 0, 'n'),
(5, 'Corporateeererer', '<p>\r\n	adsf</p>', '', '', 'asdf', 1, 'asdf', 0, 'n'),
(6, 'Advertisement', '', '', '', '', 0, 'Advertisement', 0, 'n'),
(7, 'Campaigns', '', '', '', '', 0, 'Campaigns', 0, 'n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_partner`
--

CREATE TABLE IF NOT EXISTS `tbl_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `shortdesc` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE IF NOT EXISTS `tbl_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(11) NOT NULL,
  `product_price` varchar(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `short_code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `product_name`, `product_code`, `product_price`, `product_image`, `cat_id`, `short_code`) VALUES
(1, 'Damla NEW 2 Bag 1 Kg (Assorted)', '5567', '0', '19883.jpeg', 9, '1 Kg x 8'),
(2, 'Damla NEW 2 Bag 500 Gr (Assorted)', '5574', '0', '23560.jpeg', 9, '500 Gr x 12'),
(3, 'Damla NEW 2 Bag 350 Gr (Assorted)', '5575', '0', '20385.jpeg', 9, '350 Gr x 12'),
(4, 'Damla NEW 2 Pvc 1 Kg (Assorted)', '5568', '0', '9670.jpeg', 9, '1 Kg x 8'),
(5, 'Damla NEW 2 Bag 90 Gr (Melon-Pineapple)', '5572', '0', '6535.jpeg', 9, '90 Gr x 24'),
(6, 'Damla NEW 2 Bag 90 Gr (Watermelon-Tropical)', '5571', '0', '12468.jpeg', 9, '90 Gr x 24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_cat`
--

CREATE TABLE IF NOT EXISTS `tbl_product_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `has_products` int(11) NOT NULL,
  `has_subcat` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_product_cat`
--

INSERT INTO `tbl_product_cat` (`id`, `category`, `category_image`, `parent_id`, `has_products`, `has_subcat`) VALUES
(1, 'Candies', '5564.jpeg', 0, 0, 'Y'),
(2, 'Compound Chocolates', '14661.jpeg', 0, 0, 'Y'),
(3, 'Chocolates', '6298.jpeg', 0, 0, 'Y'),
(4, 'Spread Chocolates', '5579.jpeg', 0, 0, 'Y'),
(5, 'Eclairs', '20904.jpeg', 1, 0, 'Y'),
(6, 'Soft Candies With Filling', '9409.jpeg', 1, 0, 'Y'),
(7, 'Soft Candies', '9318.jpeg', 1, 0, 'Y'),
(8, 'Hard Candies', '17319.jpeg', 1, 0, 'Y'),
(9, 'Damla', '30324.jpeg', 6, 0, ''),
(10, 'Damla Mini', '30621.jpeg', 6, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program`
--

CREATE TABLE IF NOT EXISTS `tbl_program` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) NOT NULL,
  `station` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `highlight` enum('0','1') NOT NULL DEFAULT '0',
  `rj_id` int(11) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_program`
--

INSERT INTO `tbl_program` (`pro_id`, `day`, `title`, `station`, `description`, `start_time`, `end_time`, `highlight`, `rj_id`) VALUES
(1, 'Sunday', 'Waafg', '', '', '02:05:00', '16:25:00', '0', 0),
(2, 'Monday', 'rt', '', '', '17:00:00', '18:00:00', '0', 0),
(3, 'Monday', 'adsfasdf', '', '', '18:00:00', '18:20:00', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resource`
--

CREATE TABLE IF NOT EXISTS `tbl_resource` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `shortdesc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sub_type` int(11) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_resource`
--

INSERT INTO `tbl_resource` (`r_id`, `type`, `title`, `file`, `url`, `shortdesc`, `date`, `sub_type`) VALUES
(1, 3, 'My gallery', '', '', '', '2013-07-18 07:01:14', 0),
(2, 5, 'test', '', 'http://www.youtube.com/v/', 'teset', '2013-07-18 09:31:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resource_cat`
--

CREATE TABLE IF NOT EXISTS `tbl_resource_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `enabled` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_resource_cat`
--

INSERT INTO `tbl_resource_cat` (`id`, `category`, `url`, `enabled`) VALUES
(1, 'Audio', '', 1),
(2, 'Downloads', '', 0),
(3, 'Gallery', '?page=manage_gallery', 1),
(5, 'Video', '?page=manage_video', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resource_sub_cat`
--

CREATE TABLE IF NOT EXISTS `tbl_resource_sub_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `featured` int(11) NOT NULL,
  `shortdesc` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_resource_sub_cat`
--

INSERT INTO `tbl_resource_sub_cat` (`id`, `type`, `title`, `featured`, `shortdesc`, `image`, `updated_on`, `position`) VALUES
(1, 1, 'Archive', 0, '', '', '2013-06-24 05:04:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seo`
--

CREATE TABLE IF NOT EXISTS `tbl_seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `tbl_name` varchar(200) NOT NULL,
  `res_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `keywords` (`keywords`),
  FULLTEXT KEY `description` (`description`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shine`
--

CREATE TABLE IF NOT EXISTS `tbl_shine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shine` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `options` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `option_values` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_site_settings`
--

INSERT INTO `tbl_site_settings` (`id`, `options`, `option_values`) VALUES
(1, 'sitename', 'Tayas Confictionary'),
(2, 'district', ''),
(3, 'banner', '28182.png'),
(4, 'allow_page_file_uploads', 'n'),
(5, 'allow_article_file_uploads', 'n'),
(6, 'allow_article_comments', 'n'),
(7, 'slider_limit', '5'),
(8, 'allow_category_add_news', 'y'),
(9, 'allow_category_add_associates', 'n'),
(10, 'site_email', ''),
(11, 'site_phone', ''),
(12, 'allow_category_add_pages', 'y'),
(13, 'allow_category_add_ad', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE IF NOT EXISTS `tbl_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `shortdesc` text NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staffs`
--

CREATE TABLE IF NOT EXISTS `tbl_staffs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_staffs`
--

INSERT INTO `tbl_staffs` (`id`, `firstname`, `middlename`, `lastname`, `type`, `image`, `post`, `email`, `about`, `dob`, `s_order`, `address`, `contact`, `publish`) VALUES
(1, 'test', 'test', 'test', 1, '', '', '', 'test', '0000-00-00', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_cat`
--

CREATE TABLE IF NOT EXISTS `tbl_staff_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `has_subcat` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_staff_cat`
--

INSERT INTO `tbl_staff_cat` (`id`, `category`, `parent_id`, `has_subcat`) VALUES
(1, 'Rj Profile', 0, ''),
(2, 'Management Team', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_prev`
--

CREATE TABLE IF NOT EXISTS `tbl_user_prev` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `pages` int(11) NOT NULL,
  `articles` int(11) DEFAULT NULL,
  `product_catelogue` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_user_prev`
--

INSERT INTO `tbl_user_prev` (`id`, `admin_id`, `pages`, `articles`, `product_catelogue`) VALUES
(1, 2, 0, NULL, NULL),
(2, 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visits`
--

CREATE TABLE IF NOT EXISTS `tbl_visits` (
  `res_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `visits` int(11) NOT NULL,
  KEY `res_id` (`res_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_visits`
--

INSERT INTO `tbl_visits` (`res_id`, `type`, `visits`) VALUES
(5, 'article', 14),
(2, 'article', 3),
(4, 'article', 9),
(7, 'article', 3),
(6, 'article', 5),
(3, 'article', 3),
(1, 'article', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_zodiac_group`
--

CREATE TABLE IF NOT EXISTS `tbl_zodiac_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posted_date` date NOT NULL,
  `tithi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_zodiac_group`
--

INSERT INTO `tbl_zodiac_group` (`id`, `posted_date`, `tithi`) VALUES
(1, '2013-01-01', 'fgs');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `voted_on` datetime NOT NULL,
  `ip` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
