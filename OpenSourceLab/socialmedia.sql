-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 23, 2019 at 12:00 AM
-- Server version: 10.3.14-MariaDB
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialmedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

DROP TABLE IF EXISTS `tblposts`;
CREATE TABLE IF NOT EXISTS `tblposts` (
  `PostID` int(11) NOT NULL AUTO_INCREMENT,
  `Post` varchar(500) NOT NULL,
  `PostTime` datetime NOT NULL,
  `UserID` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`PostID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`PostID`, `Post`, `PostTime`, `UserID`, `likes`) VALUES
(86, 'hey i love the idea of you going to class', '2019-11-21 13:41:21', 6, 0),
(87, 'I am going to the City for thanksgiving', '2019-11-21 23:55:07', 7, 0),
(88, 'Anyone want to go play basketball ?', '2019-11-21 23:59:30', 6, 1),
(89, 'I want some food anyone down', '2019-11-22 00:02:09', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblreplies`
--

DROP TABLE IF EXISTS `tblreplies`;
CREATE TABLE IF NOT EXISTS `tblreplies` (
  `ReplyID` int(11) NOT NULL AUTO_INCREMENT,
  `Reply` varchar(500) NOT NULL,
  `ReplyTime` datetime NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`ReplyID`),
  KEY `fk_post_reply` (`PostID`),
  KEY `fk_user_reply` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblreplies`
--

INSERT INTO `tblreplies` (`ReplyID`, `Reply`, `ReplyTime`, `UserID`, `PostID`, `likes`) VALUES
(103, 'lol you funny i am always in class', '2019-11-21 23:36:10', 6, 86, 1),
(104, 'lmaoo you don&#39;t come to class at all', '2019-11-21 23:54:26', 7, 86, 0),
(105, 'ok you can come with us', '2019-11-21 23:56:36', 7, 87, 0),
(107, 'Can i come with y&#39;all', '2019-11-21 23:59:08', 6, 87, 0),
(108, 'ok we out', '2019-11-22 00:01:23', 6, 88, 0),
(109, 'me let go now', '2019-11-22 00:01:51', 7, 88, 0),
(110, 'ok let me know when you ready', '2019-11-22 00:03:20', 7, 89, 0),
(111, 'me give me like 30 minutes', '2019-11-22 00:03:53', 6, 89, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblroles`
--

DROP TABLE IF EXISTS `tblroles`;
CREATE TABLE IF NOT EXISTS `tblroles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(30) NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblroles`
--

INSERT INTO `tblroles` (`RoleID`, `RoleName`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE IF NOT EXISTS `tblusers` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `RoleID` int(11) NOT NULL,
  PRIMARY KEY (`UserID`),
  KEY `RoleID` (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`UserID`, `Username`, `Password`, `Email`, `RoleID`) VALUES
(6, 'meissabayo', '$2y$10$rFsRA8bXqMzVqAxutV4C/.FM8bPcqyuqivbUoBWsTTY7QtAkgAdKC', 'meissamessi@gmail.com', 2),
(7, 'meissa', '$2y$10$lX1t0mBi6I//..P5JKywY.82e.5CvPefdRO5e3X7h7k2kyyM3acWC', 'bayom@alfredstate.edu', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD CONSTRAINT `UserID` FOREIGN KEY (`UserID`) REFERENCES `tblusers` (`UserID`);

--
-- Constraints for table `tblreplies`
--
ALTER TABLE `tblreplies`
  ADD CONSTRAINT `fk_post_reply` FOREIGN KEY (`PostID`) REFERENCES `tblposts` (`PostID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_reply` FOREIGN KEY (`UserID`) REFERENCES `tblusers` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD CONSTRAINT `RoleID` FOREIGN KEY (`RoleID`) REFERENCES `tblroles` (`RoleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
