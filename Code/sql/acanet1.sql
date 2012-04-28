-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2011 at 04:01 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `community`
--

INSERT INTO `community` (`community_id`, `name`, `type`, `short_description`, `updated_date`) VALUES
(42, 'For Global Institute', 'institution', '', '0000-00-00 00:00:00'),
(43, 'Community for Bangladesh University of Engineering And Technology', 'institution', 'One of the oldest university of Bangladesh', '0000-00-00 00:00:00'),
(44, 'Community for Dhaka University', 'institution', 'One of the oldest institution in Bangladesh.', '0000-00-00 00:00:00'),
(45, 'Community for North South University', 'institution', 'private university', '0000-00-00 00:00:00'),
(46, 'Community for Khulna University of Engineering and Technology', 'institution', 'One of the oldest Engineering Institute in Bangladesh, formerly was a part of BIT', '0000-00-00 00:00:00'),
(47, 'Community for Computer Science and Engineering', 'field', 'Create emulate and Simulate ', '0000-00-00 00:00:00'),
(48, 'Community for Mechanical Engineering', 'field', 'One of the oldest dept in BUET', '0000-00-00 00:00:00'),
(49, 'Community for Computer Science and Engineering', 'field', 'global cse', '0000-00-00 00:00:00'),
(50, 'Community for Business Administration', 'field', 'one of the fields in Dhaka University', '0000-00-00 00:00:00'),
(51, 'Community for Dept of Physics', 'field', 'dummy', '0000-00-00 00:00:00'),
(52, 'Community for Fine Arts', 'field', 'Fine arts dept of NSU', '0000-00-00 00:00:00'),
(53, 'Community for Fashion Designing', 'field', 'fashion Designing of NSU', '0000-00-00 00:00:00'),
(54, 'Community for Electrical and Electronics Engineering', 'field', 'EEE dept of KUET', '0000-00-00 00:00:00'),
(55, 'Community for Civil Engineering', 'field', 'civil', '0000-00-00 00:00:00'),
(56, 'Community for Rajsahi Uni', 'institution', 'greater rajsahi', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`content_id`, `type`, `content_link`, `publisher_name`, `date_time`, `description`) VALUES
(31, 'link', 'http://www.google.com', 'oly', '2011-06-09 09:22:00', 'my personal homepage'),
(32, 'link', 'http://www.google.com', 'oly', '2011-06-09 09:25:15', 'asdasd'),
(33, 'link', 'asdasdas', 'oly', '2011-06-09 09:25:47', 'aasd'),
(34, 'link', 'asdas', 'oly', '2011-06-09 09:29:02', 'adasdas'),
(35, 'link', 'asdasd', 'oly', '2011-06-09 09:31:33', 'asdasdasd'),
(36, 'link', 'asdasd', 'oly', '2011-06-09 09:32:58', 'asdasdasd'),
(37, 'link', 'aasdasdaas', 'oly', '2011-06-09 09:35:26', 'dasdasd');

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

--
-- Dumping data for table `content_community`
--

INSERT INTO `content_community` (`content_id`, `community_id`) VALUES
(35, 43),
(37, 43);

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

--
-- Dumping data for table `course`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `title`, `description`, `start_date_time`, `end_date_time`, `publisher_name`, `date_time`) VALUES
(13, 'testing ', 'testing', '2011-06-09 04:10:00', '2011-06-20 04:10:00', 'oly', NULL),
(14, 'Project Show', 'Intra dept. project show', '2011-06-14 00:00:00', '2011-06-23 00:00:00', 'oly', NULL);

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

--
-- Dumping data for table `event_community`
--

INSERT INTO `event_community` (`event_id`, `community_id`) VALUES
(13, 49),
(14, 49);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`field_id`, `institution_id`, `name`, `short_name`, `community_id`, `short_description`, `updated_date`, `status`) VALUES
(6, 12, 'Computer Science and Engineering', 'CSE', 47, 'Create emulate and Simulate ', '0000-00-00 00:00:00', 'approved'),
(7, 12, 'Mechanical Engineering', 'ME', 48, 'One of the oldest dept in BUET', '0000-00-00 00:00:00', 'approved'),
(8, 0, 'Computer Science and Engineering', 'CSE', 49, 'global cse', '0000-00-00 00:00:00', 'approved'),
(9, 13, 'Business Administration', 'BBA', 50, 'one of the fields in Dhaka University', '0000-00-00 00:00:00', 'approved'),
(10, 13, 'Dept of Physics', 'DP', 51, 'dummy', '0000-00-00 00:00:00', 'approved'),
(11, 14, 'Fine Arts', 'FA', 52, 'Fine arts dept of NSU', '0000-00-00 00:00:00', 'approved'),
(12, 14, 'Fashion Designing', 'FD', 53, 'fashion Designing of NSU', '0000-00-00 00:00:00', 'approved'),
(13, 15, 'Electrical and Electronics Engineering', 'EEE', 54, 'EEE dept of KUET', '0000-00-00 00:00:00', 'approved'),
(14, 12, 'Civil Engineering', 'CE', 55, 'civil', '0000-00-00 00:00:00', 'pending');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`institution_id`, `name`, `short_name`, `location`, `community_id`, `campuses`, `short_description`, `updated_date`, `status`) VALUES
(0, 'Global', 'gdsfsdfds', 'dfdsfdsf', 42, 'dfdsfdsfs', 'dfsdsfdsfd', '0000-00-00 00:00:00', 'approved'),
(12, 'Bangladesh University of Engineering And Technology', 'BUET', 'Polashi', 43, 'Polashi', 'One of the oldest university of Bangladesh', '0000-00-00 00:00:00', 'approved'),
(13, 'Dhaka University', 'DU', 'Dhaka', 44, 'Dhaka', 'One of the oldest institution in Bangladesh.', '0000-00-00 00:00:00', 'approved'),
(14, 'North South University', 'NSU', 'Dhaka', 45, 'Gulshan,Dhanmondi', 'private university', '0000-00-00 00:00:00', 'approved'),
(15, 'Khulna University of Engineering and Technology', 'KUET', 'Khulna', 46, 'khulna', 'One of the oldest Engineering Institute in Bangladesh, formerly was a part of BIT', '0000-00-00 00:00:00', 'pending'),
(16, 'Rajsahi Uni', 'RU', 'Rajsahi', 56, 'Rajsahi', 'greater rajsahi', '0000-00-00 00:00:00', 'pending');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `heading`, `content`, `type`, `publisher_name`, `date_time`) VALUES
(2, 'Programming contest', 'coming soon', 'NCPCC', 'oly', '2011-06-09 08:45:44');

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

--
-- Dumping data for table `news_community`
--

INSERT INTO `news_community` (`news_id`, `community_id`) VALUES
(2, 49);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `publisher_name`, `date_time`) VALUES
(47, 'Hi buetians', 'I''m oly from cse 07!!!', 'oly', '2011-06-09 09:20:47'),
(48, '', 'replying in my own post', 'oly', '2011-06-09 09:21:05');

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

--
-- Dumping data for table `post_community`
--

INSERT INTO `post_community` (`post_id`, `community_id`) VALUES
(47, 43),
(48, 43);

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

--
-- Dumping data for table `post_reply`
--

INSERT INTO `post_reply` (`post_id`, `community_id`, `reply_id`) VALUES
(47, 43, 48);

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

--
-- Dumping data for table `request`
--


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

--
-- Dumping data for table `subject`
--


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

--
-- Dumping data for table `subject_course`
--


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

--
-- Dumping data for table `subject_field`
--


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

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `name`, `address`, `contact_number`, `mail_address`, `type`, `status`, `verification_data`, `privacy`) VALUES
('admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'admin''s address', '01713256789', 'admin@admin.com', 'admin', 'activated', 'abcdef', ''),
('ibrahim', 'e10adc3949ba59abbe56e057f20f883e', 'Ibrahim Rashid', 'moghbazar', '016170131678', 'ibrahim12@gmail.com', 'subscriber', 'activated', 'abcdef', ''),
('oly', 'e10adc3949ba59abbe56e057f20f883e', 'Kazi Nasir Uddin Oly', 'Room No.:4002 Shere Bangla Hall', '01552300022', 'oly07buet@yahoo.com', 'subscriber', 'activated', 'abcdef', ''),
('shafiul', 'e10adc3949ba59abbe56e057f20f883e', 'Shafiul Azam', 'tikatoli', '01717421422', 'shafiul@yahoo.com', 'subscriber', 'activated', 'abcdef', ''),
('sifat', 'e10adc3949ba59abbe56e057f20f883e', 'Tarequl Islam Sifat', 'Room No.:4002 Shere Bangla Hall', '01713747516', 'sifat@something.com', 'subscriber', 'activated', 'abcdef', '');

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

--
-- Dumping data for table `user_community`
--

INSERT INTO `user_community` (`username`, `community_id`, `role`) VALUES
('ibrahim', 43, 'subscriber'),
('ibrahim', 48, 'subscriber'),
('oly', 43, 'subscriber'),
('oly', 47, 'subscriber'),
('oly', 48, 'subscriber'),
('oly', 49, 'subscriber'),
('oly', 55, 'subscriber'),
('oly', 56, 'subscriber'),
('shafiul', 43, 'subscriber'),
('shafiul', 44, 'subscriber'),
('shafiul', 45, 'subscriber'),
('shafiul', 46, 'subscriber'),
('shafiul', 50, 'subscriber'),
('shafiul', 51, 'subscriber'),
('shafiul', 52, 'subscriber'),
('shafiul', 53, 'subscriber'),
('shafiul', 54, 'subscriber');

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

--
-- Dumping data for table `user_field`
--

INSERT INTO `user_field` (`username`, `field_id`, `role`, `referer`) VALUES
('ibrahim', 6, 'banned', 'oly'),
('ibrahim', 7, 'member', 'oly'),
('ibrahim', 8, 'banned', 'oly'),
('oly', 6, 'owner', NULL),
('oly', 7, 'owner', NULL),
('oly', 8, 'owner', NULL),
('oly', 14, 'owner', NULL),
('shafiul', 9, 'owner', NULL),
('shafiul', 10, 'owner', NULL),
('shafiul', 11, 'owner', NULL),
('shafiul', 12, 'owner', NULL),
('shafiul', 13, 'owner', NULL);

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
-- Dumping data for table `user_institution`
--

INSERT INTO `user_institution` (`username`, `institution_id`, `role`, `referer`) VALUES
('ibrahim', 12, 'member', 'oly'),
('ibrahim', 14, 'banned', 'shafiul'),
('oly', 12, 'member', 'shafiul'),
('oly', 16, 'owner', NULL),
('shafiul', 12, 'owner', NULL),
('shafiul', 13, 'owner', NULL),
('shafiul', 14, 'owner', NULL),
('shafiul', 15, 'owner', NULL);

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
