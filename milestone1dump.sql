-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 22, 2016 at 11:20 PM
-- Server version: 10.0.19-MariaDB-1~trusty-log
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `RecipeStack`
--
CREATE DATABASE IF NOT EXISTS `RecipeStack` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `RecipeStack`;

-- --------------------------------------------------------

--
-- Table structure for table `Answers`
--

DROP TABLE IF EXISTS `Answers`;
CREATE TABLE IF NOT EXISTS `Answers` (
  `aid` int(10) NOT NULL,
  `ADesc` varchar(10000) NOT NULL,
  `Qid` int(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `answered_date` date NOT NULL,
  `Best_ans` binary(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Question`
--

DROP TABLE IF EXISTS `Question`;
CREATE TABLE IF NOT EXISTS `Question` (
  `Qid` int(10) NOT NULL,
  `QTitle` varchar(200) NOT NULL,
  `QContent` varchar(800) NOT NULL,
  `uid` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `views` int(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Question`
--

INSERT INTO `Question` (`Qid`, `QTitle`, `QContent`, `uid`, `created_date`, `views`) VALUES
(1, 'How to make a sandwich?', 'Please tell me how to make a sandwich in 5 mins', 1, '2016-09-22', 0),
(2, 'How to make a chocolate cake', 'Do we make chocolate cake with chocolates?', 1, '2016-09-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_on` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `created_on`) VALUES
(1, 'kkall002@odu.edu', '1234', '2016-09-20'),
(2, 'admin', 'cs518pa$$', NULL),
(3, 'jbrunelle', 'M0n@rch$', NULL),
(4, 'pvenkman', 'imadoctor', NULL),
(5, 'rstantz', '"; INSERT INTO Customers (CustomerName,Address,City) Values(@0,@1,@2); --', NULL),
(6, 'dbarrett', 'fr1ed3GGS', NULL),
(7, 'ltully', '<!--<i>', NULL),
(8, 'espengler', 'don''t cross the streams', NULL),
(9, 'janine', '--!drop tables;', NULL),
(10, 'winston', 'zeddM0r3', NULL),
(11, 'gozer', 'd3$truct0R', NULL),
(12, 'slimer', 'f33dM3', NULL),
(13, 'zuul', '105"; DROP TABLE', NULL),
(14, 'keymaster', 'n0D@na', NULL),
(15, 'gatekeeper', '$l0r', NULL),
(16, 'staypuft', 'm@r$hM@ll0w', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Votes`
--

DROP TABLE IF EXISTS `Votes`;
CREATE TABLE IF NOT EXISTS `Votes` (
  `vote` int(10) NOT NULL,
  `aid` int(10) NOT NULL,
  `ans_uid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Answers`
--
ALTER TABLE `Answers`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `Qid` (`Qid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `Question`
--
ALTER TABLE `Question`
  ADD PRIMARY KEY (`Qid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `Votes`
--
ALTER TABLE `Votes`
  ADD KEY `aid` (`aid`),
  ADD KEY `ans_uid` (`ans_uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Question`
--
ALTER TABLE `Question`
  MODIFY `Qid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Answers`
--
ALTER TABLE `Answers`
  ADD CONSTRAINT `Answers_ibfk_1` FOREIGN KEY (`Qid`) REFERENCES `Question` (`Qid`),
  ADD CONSTRAINT `Answers_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `Question`
--
ALTER TABLE `Question`
  ADD CONSTRAINT `Question_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `Votes`
--
ALTER TABLE `Votes`
  ADD CONSTRAINT `Votes_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `Answers` (`aid`),
  ADD CONSTRAINT `Votes_ibfk_2` FOREIGN KEY (`ans_uid`) REFERENCES `user` (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
