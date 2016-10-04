-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 04, 2016 at 12:13 PM
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
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `aid` int(10) NOT NULL,
  `adesc` varchar(2000) NOT NULL,
  `qid` int(10) NOT NULL,
  `uid_ans` int(11) NOT NULL,
  `answered_date` date NOT NULL,
  `best_ans` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`aid`, `adesc`, `qid`, `uid_ans`, `answered_date`, `best_ans`) VALUES
(1, 'You need bread and filling', 1, 3, '2016-09-24', 1),
(2, 'get some bread and toaster', 1, 4, '2016-09-25', 0),
(3, 'you need potatoes and lots of oil and spices', 3, 7, '2016-09-25', 0),
(8, 'Cut the potatoes in *&quot;small&quot;&lt;&gt;      pieces.', 3, 4, '2016-09-25', 0),
(13, 'go to subway', 1, 2, '2016-09-30', 0),
(14, 'Mix together flour and cocoa powder', 2, 2, '2016-09-30', 0),
(15, 'Yes you can', 4, 2, '2016-09-30', 0),
(16, 'Test answer', 5, 2, '2016-10-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `qid` int(10) NOT NULL,
  `qtitle` varchar(200) NOT NULL,
  `qcontent` varchar(800) NOT NULL,
  `uid` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `views` int(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`qid`, `qtitle`, `qcontent`, `uid`, `created_date`, `views`) VALUES
(1, 'How to make a sandwich?', 'Please tell me how to make a sandwich in 5 mins', 1, '2016-09-22', 0),
(2, 'How to make a chocolate cake', 'Do we make chocolate cake with chocolates?', 1, '2016-09-22', 0),
(3, 'Crisp Roasted Potatoes', 'How to make crisp roasted potatoes in microwave', 2, '2016-09-23', 0),
(4, 'Re chill wine', 'Can you re chill wine?', 1, '2016-09-23', 0),
(5, 'Samosa', 'How to make samosa', 1, '2016-09-23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_tag`
--

DROP TABLE IF EXISTS `question_tag`;
CREATE TABLE IF NOT EXISTS `question_tag` (
  `qid_fk` int(10) NOT NULL,
  `tag_id_fk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL DEFAULT '0',
  `tags` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `votes_ans`
--

DROP TABLE IF EXISTS `votes_ans`;
CREATE TABLE IF NOT EXISTS `votes_ans` (
  `vid_ans` int(10) NOT NULL,
  `vote_ans` int(10) NOT NULL,
  `aid` int(10) NOT NULL,
  `vote_ans_uid` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes_ans`
--

INSERT INTO `votes_ans` (`vid_ans`, `vote_ans`, `aid`, `vote_ans_uid`) VALUES
(5, 1, 1, 4),
(6, -1, 1, 5),
(8, 1, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `votes_ques`
--

DROP TABLE IF EXISTS `votes_ques`;
CREATE TABLE IF NOT EXISTS `votes_ques` (
  `vid_ques` int(10) NOT NULL,
  `vote_ques` int(10) NOT NULL,
  `qid` int(10) NOT NULL,
  `vote_ques_uid` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes_ques`
--

INSERT INTO `votes_ques` (`vid_ques`, `vote_ques`, `qid`, `vote_ques_uid`) VALUES
(8, 1, 1, 2),
(10, -1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `uid` (`uid_ans`),
  ADD KEY `Answers_ibfk_1` (`qid`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `question_tag`
--
ALTER TABLE `question_tag`
  ADD KEY `tag_id_fk` (`tag_id_fk`),
  ADD KEY `Qid_fk` (`qid_fk`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `votes_ans`
--
ALTER TABLE `votes_ans`
  ADD PRIMARY KEY (`vid_ans`),
  ADD UNIQUE KEY `aid` (`aid`,`vote_ans_uid`),
  ADD UNIQUE KEY `aid_2` (`aid`,`vote_ans_uid`),
  ADD KEY `ans_uid` (`vote_ans_uid`);

--
-- Indexes for table `votes_ques`
--
ALTER TABLE `votes_ques`
  ADD PRIMARY KEY (`vid_ques`),
  ADD UNIQUE KEY `qid` (`qid`,`vote_ques_uid`),
  ADD KEY `V_uid` (`vote_ques_uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `qid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `votes_ans`
--
ALTER TABLE `votes_ans`
  MODIFY `vid_ans` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `votes_ques`
--
ALTER TABLE `votes_ques`
  MODIFY `vid_ques` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `question` (`Qid`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`uid_ans`) REFERENCES `user` (`uid`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `question_tag`
--
ALTER TABLE `question_tag`
  ADD CONSTRAINT `question_tag_ibfk_1` FOREIGN KEY (`tag_id_fk`) REFERENCES `tags` (`Tag_id`),
  ADD CONSTRAINT `question_tag_ibfk_2` FOREIGN KEY (`Qid_fk`) REFERENCES `question` (`Qid`);

--
-- Constraints for table `votes_ans`
--
ALTER TABLE `votes_ans`
  ADD CONSTRAINT `votes_ans_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `answers` (`aid`),
  ADD CONSTRAINT `votes_ans_ibfk_2` FOREIGN KEY (`vote_ans_uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `votes_ques`
--
ALTER TABLE `votes_ques`
  ADD CONSTRAINT `votes_ques_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `question` (`Qid`),
  ADD CONSTRAINT `votes_ques_ibfk_2` FOREIGN KEY (`vote_ques_uid`) REFERENCES `user` (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
