-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2011 at 12:49 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `acanet`
--

-- --------------------------------------------------------

--
-- Table structure for table `community`
--

CREATE TABLE IF NOT EXISTS `community` (
  `community_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` enum('institution','subject','field','course','group') NOT NULL,
  `short_description` text NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`community_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `content_id` int(10) NOT NULL AUTO_INCREMENT,
  `type` enum('link','text') NOT NULL,
  `content_link` varchar(100) NOT NULL,
  `publisher_name` char(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  KEY `publisher_id` (`publisher_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_community`
--

CREATE TABLE IF NOT EXISTS `content_community` (
  `content_id` int(10) NOT NULL,
  `community_id` int(10) NOT NULL,
  PRIMARY KEY (`content_id`,`community_id`),
  KEY `community_id` (`community_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(10) NOT NULL AUTO_INCREMENT,
  `field_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `community_id` int(10) NOT NULL,
  `short_description` text NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `field_id` (`field_id`),
  KEY `community_id` (`community_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start_date_time` datetime NOT NULL,
  `end_date_time` datetime NOT NULL,
  `publisher_name` char(20) NOT NULL,
  `date_time` date DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  KEY `publisher_id` (`publisher_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_community`
--

CREATE TABLE IF NOT EXISTS `event_community` (
  `event_id` int(10) NOT NULL,
  `community_id` int(10) NOT NULL,
  PRIMARY KEY (`event_id`,`community_id`),
  KEY `community_id` (`community_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE IF NOT EXISTS `field` (
  `field_id` int(10) NOT NULL AUTO_INCREMENT,
  `institution_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `community_id` int(10) NOT NULL,
  `short_description` text NOT NULL,
  `updated_date` datetime NOT NULL,
  `status` enum('pending','approved') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`field_id`),
  KEY `community_id` (`community_id`),
  KEY `institution_id` (`institution_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE IF NOT EXISTS `institution` (
  `institution_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `community_id` int(10) NOT NULL,
  `campuses` text NOT NULL,
  `short_description` text NOT NULL,
  `updated_date` datetime NOT NULL,
  `status` enum('pending','approved') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`institution_id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `short_name` (`short_name`),
  KEY `community_id` (`community_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(10) NOT NULL AUTO_INCREMENT,
  `heading` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `publisher_name` char(20) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`news_id`),
  KEY `publisher_name` (`publisher_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `news_community`
--

CREATE TABLE IF NOT EXISTS `news_community` (
  `news_id` int(10) NOT NULL,
  `community_id` int(10) NOT NULL,
  PRIMARY KEY (`news_id`,`community_id`),
  KEY `community_id` (`community_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `publisher_name` char(20) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `publisher_id` (`publisher_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Table structure for table `post_community`
--

CREATE TABLE IF NOT EXISTS `post_community` (
  `post_id` int(10) NOT NULL,
  `community_id` int(10) NOT NULL,
  PRIMARY KEY (`post_id`,`community_id`),
  KEY `community_id` (`community_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_reply`
--

CREATE TABLE IF NOT EXISTS `post_reply` (
  `post_id` int(10) NOT NULL,
  `community_id` int(10) NOT NULL,
  `reply_id` int(10) NOT NULL,
  PRIMARY KEY (`post_id`,`community_id`,`reply_id`),
  KEY `community_id` (`community_id`),
  KEY `reply_id` (`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `request_id` int(10) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `sender_name` char(20) NOT NULL,
  `referer_name` char(20) NOT NULL,
  `community_id` int(10) NOT NULL,
  `date_time` datetime NOT NULL,
  `status` enum('pending','accepted','denied') NOT NULL,
  PRIMARY KEY (`request_id`),
  KEY `sender_id` (`sender_name`,`community_id`),
  KEY `community_id` (`community_id`),
  KEY `referer_id` (`referer_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subejct_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `community_id` int(10) NOT NULL,
  `short_description` text NOT NULL,
  `updated_date` date NOT NULL,
  PRIMARY KEY (`subejct_id`),
  KEY `field_id` (`community_id`),
  KEY `community_id` (`community_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject_course`
--

CREATE TABLE IF NOT EXISTS `subject_course` (
  `subject_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  PRIMARY KEY (`subject_id`,`course_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subject_field`
--

CREATE TABLE IF NOT EXISTS `subject_field` (
  `subject_id` int(10) NOT NULL,
  `field_id` int(10) NOT NULL COMMENT 'Only Global Fields',
  PRIMARY KEY (`subject_id`,`field_id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` char(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `mail_address` varchar(100) NOT NULL,
  `type` enum('admin','moderator','subscriber') NOT NULL,
  `status` enum('pending','activated','deactivated') NOT NULL,
  `verification_data` varchar(100) NOT NULL COMMENT 'email verifiacation ',
  `privacy` char(4) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_community`
--

CREATE TABLE IF NOT EXISTS `user_community` (
  `username` char(20) NOT NULL,
  `community_id` int(10) NOT NULL,
  `role` enum('admin','subscriber') NOT NULL,
  PRIMARY KEY (`username`,`community_id`),
  KEY `user_id` (`username`),
  KEY `community_id` (`community_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_field`
--

CREATE TABLE IF NOT EXISTS `user_field` (
  `username` char(20) NOT NULL,
  `field_id` int(10) NOT NULL,
  `role` enum('owner','member','moderator','pending','banned') NOT NULL DEFAULT 'member',
  `referer` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`username`,`field_id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_institution`
--

CREATE TABLE IF NOT EXISTS `user_institution` (
  `username` char(20) NOT NULL,
  `institution_id` int(10) NOT NULL,
  `role` enum('owner','member','moderator','pending','banned') NOT NULL DEFAULT 'pending',
  `referer` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`username`,`institution_id`),
  KEY `institution_id` (`institution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`publisher_name`) REFERENCES `user` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `content_community`
--
ALTER TABLE `content_community`
  ADD CONSTRAINT `content_community_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `content_community_ibfk_2` FOREIGN KEY (`community_id`) REFERENCES `community` (`community_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `field` (`field_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_ibfk_4` FOREIGN KEY (`community_id`) REFERENCES `community` (`community_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`publisher_name`) REFERENCES `user` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `event_community`
--
ALTER TABLE `event_community`
  ADD CONSTRAINT `event_community_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_community_ibfk_2` FOREIGN KEY (`community_id`) REFERENCES `community` (`community_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `field`
--
ALTER TABLE `field`
  ADD CONSTRAINT `field_ibfk_1` FOREIGN KEY (`community_id`) REFERENCES `community` (`community_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `field_ibfk_2` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`institution_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `institution`
--
ALTER TABLE `institution`
  ADD CONSTRAINT `institution_ibfk_1` FOREIGN KEY (`community_id`) REFERENCES `community` (`community_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`publisher_name`) REFERENCES `user` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `news_community`
--
ALTER TABLE `news_community`
  ADD CONSTRAINT `news_community_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`news_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `news_community_ibfk_2` FOREIGN KEY (`community_id`) REFERENCES `community` (`community_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`publisher_name`) REFERENCES `user` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `post_community`
--
ALTER TABLE `post_community`
  ADD CONSTRAINT `post_community_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_community_ibfk_2` FOREIGN KEY (`community_id`) REFERENCES `community` (`community_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_reply`
--
ALTER TABLE `post_reply`
  ADD CONSTRAINT `post_reply_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_reply_ibfk_2` FOREIGN KEY (`community_id`) REFERENCES `community` (`community_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_reply_ibfk_3` FOREIGN KEY (`reply_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`community_id`) REFERENCES `community` (`community_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`sender_name`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_4` FOREIGN KEY (`referer_name`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_2` FOREIGN KEY (`community_id`) REFERENCES `community` (`community_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_course`
--
ALTER TABLE `subject_course`
  ADD CONSTRAINT `subject_course_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subejct_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_field`
--
ALTER TABLE `subject_field`
  ADD CONSTRAINT `subject_field_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subejct_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_field_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `field` (`field_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_community`
--
ALTER TABLE `user_community`
  ADD CONSTRAINT `user_community_ibfk_2` FOREIGN KEY (`community_id`) REFERENCES `community` (`community_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_community_ibfk_3` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_field`
--
ALTER TABLE `user_field`
  ADD CONSTRAINT `user_field_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `field` (`field_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_field_ibfk_3` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_institution`
--
ALTER TABLE `user_institution`
  ADD CONSTRAINT `user_institution_ibfk_2` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`institution_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_institution_ibfk_3` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
