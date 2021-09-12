-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2013 at 02:55 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `socialgroupmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat`
--

CREATE TABLE IF NOT EXISTS `tbl_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `receiverid` int(11) NOT NULL,
  `posted` datetime NOT NULL,
  `message` longtext NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `receiverid` (`receiverid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_chat`
--

INSERT INTO `tbl_chat` (`id`, `userid`, `receiverid`, `posted`, `message`, `status`) VALUES
(5, 7, 1, '2012-05-11 13:11:22', 'hello arnab', 1),
(6, 1, 7, '2012-05-11 13:11:54', 'hi', 1),
(7, 1, 7, '2012-05-11 13:32:10', 'hello', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chatrequest`
--

CREATE TABLE IF NOT EXISTS `tbl_chatrequest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `receiverid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `receiverid` (`receiverid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_chatrequest`
--

INSERT INTO `tbl_chatrequest` (`id`, `userid`, `receiverid`, `status`) VALUES
(5, 7, 1, 0),
(6, 1, 7, 0),
(7, 7, 1, 0),
(8, 1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `updateid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `commenttime` time NOT NULL,
  `commentdate` date NOT NULL,
  `comment` longtext NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `updateid` (`updateid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`id`, `updateid`, `userid`, `commenttime`, `commentdate`, `comment`, `status`) VALUES
(1, 2, 1, '18:40:34', '2012-04-29', 'hello							', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contactinfo`
--

CREATE TABLE IF NOT EXISTS `tbl_contactinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `emailid` varchar(200) NOT NULL,
  `homephoneno` bigint(20) NOT NULL,
  `cellphoneno` bigint(20) NOT NULL,
  `housenumber` varchar(200) NOT NULL,
  `town` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_contactinfo`
--

INSERT INTO `tbl_contactinfo` (`id`, `userid`, `emailid`, `homephoneno`, `cellphoneno`, `housenumber`, `town`, `city`, `state`, `country`, `status`) VALUES
(1, 1, 'arnab@gmail.com', 26271193, 9477884316, 'H101', 'Howrah', 'Howrah', 'West Bengal', 'India', 1),
(2, 7, '', 0, 0, '', '', '', '', '', 1),
(3, 8, '', 0, 0, '', '', '', '', '', 1),
(4, 9, '', 0, 0, '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_education`
--

CREATE TABLE IF NOT EXISTS `tbl_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `primaryschool` varchar(200) NOT NULL,
  `highschool` varchar(200) NOT NULL,
  `graduation` varchar(200) NOT NULL,
  `postgraduation` varchar(200) NOT NULL,
  `otherqualification` varchar(200) NOT NULL,
  `employee` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_education`
--

INSERT INTO `tbl_education` (`id`, `userid`, `primaryschool`, `highschool`, `graduation`, `postgraduation`, `otherqualification`, `employee`, `status`) VALUES
(1, 1, 'Sishu Mangal', 'Howrah Vivekananda Institution', 'B.P.Poddar Institute Of MAnagement And Technology', '', '', '', 1),
(2, 7, 'Modern Academy', 'Modern Academy', '', '', '', '', 1),
(3, 8, '', '', '', '', '', '', 1),
(4, 9, '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_friendlist`
--

CREATE TABLE IF NOT EXISTS `tbl_friendlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requesterid` int(11) NOT NULL,
  `acceptorid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `requesterid` (`requesterid`),
  KEY `acceptorid` (`acceptorid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_friendlist`
--

INSERT INTO `tbl_friendlist` (`id`, `requesterid`, `acceptorid`, `status`) VALUES
(7, 7, 1, 1),
(8, 8, 7, 1),
(9, 8, 1, 1),
(10, 1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE IF NOT EXISTS `tbl_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `imagename` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_gallery`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallerycomments`
--

CREATE TABLE IF NOT EXISTS `tbl_gallerycomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imageid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `imageid` (`imageid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_gallerycomments`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

CREATE TABLE IF NOT EXISTS `tbl_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `creationdate` date NOT NULL,
  `ownerid` int(11) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `noofmembers` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ownerid` (`ownerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`id`, `name`, `creationdate`, `ownerid`, `tags`, `noofmembers`, `description`, `status`) VALUES
(1, 'CMC Ltd.', '2012-04-29', 1, '', 3, '', 1),
(2, 'Travel', '2012-04-29', 1, '', 1, '', 1),
(3, 'Books', '2012-04-29', 1, '', 1, '', 1),
(4, 'asdfgh', '2012-04-29', 1, '', 0, '', 1),
(5, '1234', '2012-04-29', 1, '', 0, '', 1),
(6, 'bppimt', '2012-05-11', 1, '', 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grouplist`
--

CREATE TABLE IF NOT EXISTS `tbl_grouplist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dateofjoin` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_grouplist`
--

INSERT INTO `tbl_grouplist` (`id`, `groupid`, `userid`, `dateofjoin`, `status`) VALUES
(1, 1, 1, '2012-04-29', 1),
(2, 2, 1, '2012-04-29', 1),
(3, 3, 1, '2012-04-29', 1),
(5, 6, 1, '2012-05-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grouppost`
--

CREATE TABLE IF NOT EXISTS `tbl_grouppost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `posterid` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `messagebody` longtext NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `displaystatus` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`),
  KEY `posterid` (`posterid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_grouppost`
--

INSERT INTO `tbl_grouppost` (`id`, `groupid`, `posterid`, `type`, `messagebody`, `time`, `date`, `displaystatus`, `status`) VALUES
(1, 1, 1, 'message', 'one', '18:41:29', '2012-04-29', 1, 1),
(5, 1, 1, 'photo', 'flower', '19:19:55', '2012-04-29', 1, 1),
(6, 2, 1, 'photo', 'new flower', '13:20:41', '2012-04-30', 1, 1),
(7, 1, 1, 'photo', 'hgshdghsgsd', '15:20:40', '2012-05-03', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grouppostcomments`
--

CREATE TABLE IF NOT EXISTS `tbl_grouppostcomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`),
  KEY `postid` (`postid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_grouppostcomments`
--

INSERT INTO `tbl_grouppostcomments` (`id`, `groupid`, `postid`, `userid`, `comment`, `date`, `time`, `status`) VALUES
(1, 1, 1, 1, 'hello one							', '2012-04-29', '18:42:01', 1),
(4, 1, 1, 1, 'two one						', '2012-04-29', '19:02:25', 1),
(5, 1, 1, 1, 'two one						', '2012-04-29', '19:02:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_interests`
--

CREATE TABLE IF NOT EXISTS `tbl_interests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `favouritesports` varchar(200) NOT NULL,
  `televisionshows` varchar(200) NOT NULL,
  `favouritemusics` varchar(200) NOT NULL,
  `hobbies` varchar(200) NOT NULL,
  `favouritebooks` varchar(200) NOT NULL,
  `religiousview` varchar(200) NOT NULL,
  `politicalview` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_interests`
--

INSERT INTO `tbl_interests` (`id`, `userid`, `favouritesports`, `televisionshows`, `favouritemusics`, `hobbies`, `favouritebooks`, `religiousview`, `politicalview`, `status`) VALUES
(1, 1, 'Cricket', 'Man vs Wild', 'All', '', 'Sherlok Holmes', 'Hindu', 'None', 1),
(2, 7, '', '', '', '', '', '', '', 1),
(3, 8, '', '', '', '', '', '', '', 1),
(4, 9, '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE IF NOT EXISTS `tbl_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `name`, `status`) VALUES
(1, 'Howrah', 1),
(2, 'Kolkata', 1),
(3, 'Burdwan', 1),
(4, 'North 24 Parganas', 1),
(5, 'East Midnapore', 1),
(6, 'West Midnapore', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE IF NOT EXISTS `tbl_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `threadid` int(11) NOT NULL,
  `messagedate` date NOT NULL,
  `messagetime` time NOT NULL,
  `receiverid` int(11) NOT NULL,
  `senderid` int(11) NOT NULL,
  `body` longtext NOT NULL,
  `receiverstatus` int(11) NOT NULL,
  `senderstatus` int(11) NOT NULL,
  `readstatus` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `threadid` (`threadid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`id`, `threadid`, `messagedate`, `messagetime`, `receiverid`, `senderid`, `body`, `receiverstatus`, `senderstatus`, `readstatus`, `status`) VALUES
(7, 3, '2012-05-11', '13:07:59', 7, 1, 'hi saurav', 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notes`
--

CREATE TABLE IF NOT EXISTS `tbl_notes` (
  `noteid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `note` longtext NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`noteid`,`userid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notes`
--

INSERT INTO `tbl_notes` (`noteid`, `userid`, `note`, `status`) VALUES
(3, 1, 'fdgdfg234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_personaldetails`
--

CREATE TABLE IF NOT EXISTS `tbl_personaldetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `aboutme` longtext NOT NULL,
  `languagesknown` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `sexualorientation` varchar(200) NOT NULL,
  `relationshipstatus` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_personaldetails`
--

INSERT INTO `tbl_personaldetails` (`id`, `userid`, `aboutme`, `languagesknown`, `gender`, `sexualorientation`, `relationshipstatus`, `status`) VALUES
(1, 1, 'I am simple', 'Select', 'Male', 'Select', 'Select', 1),
(2, 7, 'I am a simple boy', 'Select', 'Male', 'Straight', 'Not Saying', 1),
(3, 8, '', '', '', '', '', 1),
(4, 9, '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thread`
--

CREATE TABLE IF NOT EXISTS `tbl_thread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `initiatorid` int(11) NOT NULL,
  `receiverid` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `creationdate` date NOT NULL,
  `creationtime` time NOT NULL,
  `noofmessages` int(11) NOT NULL,
  `lastmessagedate` date NOT NULL,
  `initiatorstatus` int(11) NOT NULL,
  `receiverstatus` int(11) NOT NULL,
  `impstatus` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `initiatorid` (`initiatorid`),
  KEY `receiverid` (`receiverid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_thread`
--

INSERT INTO `tbl_thread` (`id`, `initiatorid`, `receiverid`, `subject`, `creationdate`, `creationtime`, `noofmessages`, `lastmessagedate`, `initiatorstatus`, `receiverstatus`, `impstatus`, `status`) VALUES
(3, 1, 7, 'cse', '2012-05-11', '13:07:49', 1, '2012-05-11', 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_updates`
--

CREATE TABLE IF NOT EXISTS `tbl_updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `type` varchar(200) NOT NULL,
  `description` longtext NOT NULL,
  `displaystatus` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_updates`
--

INSERT INTO `tbl_updates` (`id`, `userid`, `date`, `time`, `type`, `description`, `displaystatus`, `status`) VALUES
(1, 1, '2012-04-29', '18:39:40', 'message', 'one', 0, 1),
(2, 1, '2012-04-29', '18:40:24', 'photo', '', 0, 1),
(3, 1, '2012-04-30', '13:27:16', 'photo', 'animal', 0, 1),
(5, 1, '2012-05-03', '15:19:51', 'photo', 'hello', 0, 1),
(6, 1, '2012-05-06', '15:02:04', 'photo', '', 0, 1),
(7, 7, '2012-05-11', '12:20:01', 'message', 'hello', 0, 1),
(8, 7, '2012-05-11', '12:20:19', 'photo', 'This is a nice picture', 0, 1),
(9, 1, '2012-05-11', '13:04:26', 'message', 'good afternoon', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `emailid` varchar(200) NOT NULL,
  `secemailid` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `securityquestion` varchar(200) NOT NULL,
  `securityanswer` varchar(200) NOT NULL,
  `loginstatus` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `emailid`, `secemailid`, `password`, `location`, `dateofbirth`, `gender`, `securityquestion`, `securityanswer`, `loginstatus`, `status`) VALUES
(1, 'Arnab Das', 'arnab@gmail.com', 'arnab.das@gmail.com', '123456', 'Howrah', '1991-02-09', 'male', 'Where is your birth place??', 'Burdwan', 0, 1),
(7, 'Saurav Das', 'herosiriusblack@gmail.com', 'saurav@gmail.com', 'anusha', 'Kolkata', '1990-08-31', 'male', 'Where is your birth place??', 'Kolkata', 0, 1),
(8, 'Debasis Choudhury', 'debasis@gmail.com', '', 'asdfghj', 'Kolkata', '1990-07-14', 'male', 'What is my nick name??', 'sanju', 0, 1),
(9, 'Rishav Das', 'rishav@gmail.com', '', 'zxcvbn', 'Kolkata', '1990-04-28', 'male', 'Where is your birth place??', 'Kestopore', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `whiteboard`
--

CREATE TABLE IF NOT EXISTS `whiteboard` (
  `whiteboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` char(32) NOT NULL,
  `color` char(6) NOT NULL,
  `offsetx1` int(11) NOT NULL,
  `offsetx2` int(11) NOT NULL,
  `offsety1` int(11) NOT NULL,
  `offsety2` int(11) NOT NULL,
  `length` int(11) DEFAULT NULL,
  PRIMARY KEY (`whiteboard_id`)
) ENGINE=MEMORY DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `whiteboard`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  ADD CONSTRAINT `tbl_chat_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_chat_ibfk_2` FOREIGN KEY (`receiverid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_chatrequest`
--
ALTER TABLE `tbl_chatrequest`
  ADD CONSTRAINT `tbl_chatrequest_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_chatrequest_ibfk_2` FOREIGN KEY (`receiverid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD CONSTRAINT `tbl_comments_ibfk_1` FOREIGN KEY (`updateid`) REFERENCES `tbl_updates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_contactinfo`
--
ALTER TABLE `tbl_contactinfo`
  ADD CONSTRAINT `tbl_contactinfo_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_education`
--
ALTER TABLE `tbl_education`
  ADD CONSTRAINT `tbl_education_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_friendlist`
--
ALTER TABLE `tbl_friendlist`
  ADD CONSTRAINT `tbl_friendlist_ibfk_1` FOREIGN KEY (`requesterid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_friendlist_ibfk_2` FOREIGN KEY (`acceptorid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD CONSTRAINT `tbl_gallery_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_gallerycomments`
--
ALTER TABLE `tbl_gallerycomments`
  ADD CONSTRAINT `tbl_gallerycomments_ibfk_1` FOREIGN KEY (`imageid`) REFERENCES `tbl_gallery` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_gallerycomments_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_group`
--
ALTER TABLE `tbl_group`
  ADD CONSTRAINT `tbl_group_ibfk_1` FOREIGN KEY (`ownerid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_grouplist`
--
ALTER TABLE `tbl_grouplist`
  ADD CONSTRAINT `tbl_grouplist_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `tbl_group` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_grouplist_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_grouppost`
--
ALTER TABLE `tbl_grouppost`
  ADD CONSTRAINT `tbl_grouppost_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `tbl_group` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_grouppost_ibfk_2` FOREIGN KEY (`posterid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_grouppostcomments`
--
ALTER TABLE `tbl_grouppostcomments`
  ADD CONSTRAINT `tbl_grouppostcomments_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `tbl_group` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_grouppostcomments_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `tbl_grouppost` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_grouppostcomments_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_interests`
--
ALTER TABLE `tbl_interests`
  ADD CONSTRAINT `tbl_interests_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD CONSTRAINT `tbl_messages_ibfk_1` FOREIGN KEY (`threadid`) REFERENCES `tbl_thread` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  ADD CONSTRAINT `tbl_notes_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_personaldetails`
--
ALTER TABLE `tbl_personaldetails`
  ADD CONSTRAINT `tbl_personaldetails_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_thread`
--
ALTER TABLE `tbl_thread`
  ADD CONSTRAINT `tbl_thread_ibfk_1` FOREIGN KEY (`initiatorid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_thread_ibfk_2` FOREIGN KEY (`receiverid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_updates`
--
ALTER TABLE `tbl_updates`
  ADD CONSTRAINT `tbl_updates_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;
