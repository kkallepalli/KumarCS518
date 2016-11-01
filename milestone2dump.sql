-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2016 at 11:15 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`aid`, `adesc`, `qid`, `uid_ans`, `answered_date`, `best_ans`) VALUES
(1, 'You need bread and filling', 1, 3, '2016-09-24', 1),
(2, 'get some bread and toaster', 1, 4, '2016-09-25', 0),
(3, 'you need potatoes and lots of oil and spices', 3, 7, '2016-09-25', 1),
(8, 'Cut the potatoes in *&quot;small&quot;&lt;&gt;      pieces.', 3, 4, '2016-09-25', 0),
(13, 'go to subway', 1, 2, '2016-09-30', 0),
(14, 'Mix together flour and cocoa powder', 2, 2, '2016-09-30', 0),
(15, 'Yes you can', 4, 2, '2016-09-30', 0),
(16, 'Test answer', 5, 2, '2016-10-03', 0),
(17, 'Zuul test answer', 5, 13, '2016-10-04', 0),
(22, 'Cut the potatoes in ''select * from quiz     pieces.', 3, 4, '2016-10-04', 0),
(23, 'You cannot cook in 2 mins', 6, 1, '2016-10-04', 0),
(24, 'go to dominos', 9, 4, '2016-10-17', 1),
(25, 'California Pizza Kitchen is the best place in Norfolk!', 11, 8, '2016-10-17', 1),
(26, 'Get ready to eat Dhokla from the Indian stores. Saves a lot of you time.', 14, 7, '2016-10-17', 0),
(27, 'Mazzika in colley avenue.', 15, 7, '2016-10-17', 0),
(28, 'I guess buffalo wild wings', 10, 10, '2016-10-17', 0),
(29, 'Buy the frozen pizza from seven 11 and just heat it.', 13, 10, '2016-10-17', 1),
(32, 'hello', 2, 8, '2016-10-17', 0),
(36, 'hello :) smiley', 2, 10, '2016-10-18', 1),
(37, 'hello :)', 2, 10, '2016-10-18', 0),
(38, 'hello :)', 9, 10, '2016-10-18', 0),
(40, 'hello :)', 12, 1, '2016-10-18', 0),
(41, 'Wine should be at room temperature :)', 4, 1, '2016-10-18', 1),
(42, 'select * from pizza', 11, 1, '2016-10-18', 0),
(43, 'I believe we can..', 6, 2, '2016-10-18', 0),
(44, 'test comment', 18, 1, '2016-10-18', 0),
(45, 'test comment 1', 18, 12, '2016-10-18', 0),
(46, '', 10, 17, '2016-10-20', 0),
(47, 'Five guys', 10, 1, '2016-10-25', 0),
(48, 'Try Del Vecchios', 10, 1, '2016-10-25', 0),
(49, 'Ynot pizza', 11, 1, '2016-10-25', 0),
(50, 'Dominos', 11, 1, '2016-10-25', 0),
(51, 'Fry chopped potatoes', 3, 1, '2016-10-25', 0),
(52, 'This is another answer', 2, 17, '2016-10-25', 0),
(53, 'this an answer', 6, 17, '2016-10-25', 0),
(54, 'this &amp;lt;b&amp;gt; is &amp;lt;/b&amp;gt; an answer', 23, 17, '2016-10-31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `Qid` int(10) NOT NULL,
  `qtitle` varchar(200) NOT NULL,
  `qcontent` varchar(800) NOT NULL,
  `uid` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `views` int(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`Qid`, `qtitle`, `qcontent`, `uid`, `created_date`, `views`) VALUES
(1, 'How to make a sandwich?', 'Please tell me how to make a sandwich in 5 mins', 1, '2016-09-22', 0),
(2, 'How to make a chocolate cake', 'Do we make chocolate cake with chocolates?', 1, '2016-09-22', 0),
(3, 'Crisp Roasted Potatoes', 'How to make crisp roasted potatoes in microwave', 2, '2016-09-23', 0),
(4, 'Re chill wine', 'Can you re chill wine?', 1, '2016-09-23', 0),
(5, 'Samosa', 'How to make samosa', 1, '2016-09-23', 0),
(6, 'Pumpkin Apple Streusel Muffins', 'How to bake pumpkin muffins in 2 mins', 2, '2016-10-04', 0),
(9, 'Garlic Breads', 'how to make stuffed garlic breads &lt;b&gt;', 1, '2016-10-17', 0),
(10, 'Potato fries', 'Where can I find the best loaded potato fries in Norfolk?', 7, '2016-10-17', 0),
(11, 'Pizza', 'Best place to have pizza in Norfolk', 9, '2016-10-17', 0),
(12, 'Street food', 'Please suggest a good place for street food', 9, '2016-10-17', 0),
(13, 'Pizza', 'How to make pizzas at home?', 8, '2016-10-17', 0),
(14, 'Dhokla', 'How do we make dhokla', 9, '2016-10-17', 0),
(15, 'Arabic food', 'please suggest a good place which serves Arabic food ', 10, '2016-10-17', 0),
(16, 'Burritos', 'How to make burritos', 10, '2016-10-17', 0),
(18, '&quot;what does &lt;!-- mean&quot;', 'test', 1, '2016-10-18', 0),
(22, 'Brinjal Curry', 'How to cook spicy brinjal curry', 1, '2016-10-22', 0),
(23, 'Best eateries around ODU', 'please suggest some good eateries around ODU', 17, '2016-10-25', 0),
(24, 'This is &lt;b&gt; a question&lt;/b&gt; !', 'This is &lt;b&gt; a question&lt;/b&gt; !', 17, '2016-10-31', 0),
(25, 'Chinese food', 'Which is the best Chinese restaurant in Norfolk?', 86, '2016-10-31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_tag`
--

DROP TABLE IF EXISTS `question_tag`;
CREATE TABLE IF NOT EXISTS `question_tag` (
  `qid_fk` int(10) NOT NULL,
  `tag_id_fk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_tag`
--

INSERT INTO `question_tag` (`qid_fk`, `tag_id_fk`) VALUES
(22, 1),
(10, 9),
(5, 1),
(14, 1),
(1, 9),
(2, 9),
(3, 9),
(11, 9),
(4, 9),
(6, 9),
(23, 1),
(24, 1),
(25, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL,
  `tags` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tags`) VALUES
(1, 'Indian'),
(2, 'Chinese'),
(3, 'French'),
(4, 'French'),
(5, 'Greek'),
(6, 'Italian'),
(7, 'Thai'),
(8, 'Mediterrian'),
(9, 'American'),
(10, 'Continental'),
(11, 'Cuban'),
(12, 'Mexican'),
(13, 'Malaysian'),
(14, 'Singapore'),
(15, 'Spanish');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contact` varchar(10) DEFAULT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `upic` longtext,
  `created_on` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `firstname`, `lastname`, `address`, `email`, `contact`, `username`, `password`, `upic`, `created_on`) VALUES
(1, 'Kumar', 'Kallepalli', 'Norfolk, VA', 'kkall002@odu.edu', '7072171427', 'kkall002@odu.edu', '1234', '1.jpg', '2016-09-20'),
(2, 'Admin', 'admin', 'Norfolk, VA', 'admin@xyz.com', '123-234-34', 'admin', 'cs518pa$$', '2.png', NULL),
(3, 'Justin', 'Brunelle', 'Norfolk, VA', 'jbrun@xyz.com', '342458697', 'jbrunelle', 'M0n@rch$', NULL, NULL),
(4, 'Peter', 'Venkman', 'Norfolk, VA', 'pven@xyz.com', '343453466', 'pvenkman', 'imadoctor', '4.jpg', NULL),
(5, 'Ray', 'stantz', 'Norfolk, VA', 'rstan@xyz.com', '756756645', 'rstantz', '"; INSERT INTO Customers (CustomerName,Address,City) Values(@0,@1,@2); --', '5.jpg', NULL),
(6, 'Dana', 'Barrett', 'Norfolk, VA', 'dbar@xyz.com', '977565645', 'dbarrett', 'fr1ed3GGS', '6.jpg', NULL),
(7, 'Louis', 'tully', 'Norfolk, VA', 'ltul@xyz.com', '5656454343', 'ltully', '<!--<i>', '7.jpg', NULL),
(8, 'Egon ', 'Spengler', 'Norfolk, VA', 'espen@xyz.com', '4564564564', 'espengler', 'don''t cross the streams', '8.jpg', NULL),
(9, 'Janine ', 'Melnitz', 'Norfolk, VA', 'jmel@xyz.com', '6456454578', 'janine', '--!drop tables;', '9.jpg', NULL),
(10, 'Winston ', 'Zeddemore', 'Norfolk, VA', 'wzed@xyz.com', '367786655', 'winston', 'zeddM0r3', '10.jpg', NULL),
(11, 'gozer', 'gozer', 'Norfolk, VA', 'gozer@xyz.com', '7455656454', 'gozer', 'd3$truct0R', NULL, NULL),
(12, 'slimer', 'slimer', 'Norfolk, VA', 'slimer@xyz.com', '7566453453', 'slimer', 'f33dM3', NULL, NULL),
(13, 'Zuul', 'Zuul', 'Norfolk, VA', 'zuul@xyz.com', '365767454', 'zuul', '105"; DROP TABLE', NULL, NULL),
(14, 'keymaster', 'keymaster', 'Norfolk, VA', 'keymas@xyz.com', '423547345', 'keymaster', 'n0D@na', NULL, NULL),
(15, 'gatekeeper', 'gatekeeper', 'Norfolk, VA', 'gatek@xyz.com', '7567238348', 'gatekeeper', '$l0r', NULL, NULL),
(16, 'Stay', 'Puft', 'Norfolk, VA', 'stayp@xyz.com', '723739843', 'staypuft', 'm@r$hM@ll0w', NULL, NULL),
(17, 'Satya', 'Narayan', 'Norfolk, VA', 'satya@xyz.com', '7575757575', 'satya', 'pass123', '17.jpg', '2016-10-19'),
(50, 'Maheedhar', 'Gunnam', 'Norfolk, VA', 'mgunn@xyz.com', '956389456', 'maheedhar', '1234', NULL, '2016-10-21'),
(55, 'Deepthi', 'Lakshminarayana', 'Norfolk, VA', 'deepthi@xyz.com', '784548743', 'Deepthi', '1234', NULL, '2016-10-21'),
(86, 'Surbhi', 'Shankar', 'Norfolk, VA', 'abc@xyz.com', '123-234-34', 'sshankar', 'abcd', '86.jpg', '2016-10-24');

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes_ans`
--

INSERT INTO `votes_ans` (`vid_ans`, `vote_ans`, `aid`, `vote_ans_uid`) VALUES
(5, 1, 1, 4),
(6, -1, 1, 5),
(8, 1, 1, 6),
(9, 1, 28, 1),
(14, 1, 40, 1),
(15, 1, 8, 1),
(17, -1, 3, 1),
(19, 1, 23, 1),
(20, 1, 36, 17),
(21, -1, 14, 17),
(24, 1, 32, 17),
(25, -1, 37, 17),
(29, 1, 52, 17),
(33, 1, 48, 10),
(35, 1, 49, 10);

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes_ques`
--

INSERT INTO `votes_ques` (`vid_ques`, `vote_ques`, `qid`, `vote_ques_uid`) VALUES
(8, 1, 1, 2),
(10, -1, 1, 1),
(11, 1, 2, 2),
(14, 1, 2, 7),
(16, 1, 10, 10),
(18, 1, 9, 7),
(21, -1, 12, 7),
(23, 1, 10, 1),
(24, 1, 6, 1),
(26, 1, 10, 17),
(27, 1, 2, 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `uid` (`uid_ans`),
  ADD KEY `answers_ibfk_1` (`qid`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`Qid`),
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
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

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
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `Qid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `votes_ans`
--
ALTER TABLE `votes_ans`
  MODIFY `vid_ans` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `votes_ques`
--
ALTER TABLE `votes_ques`
  MODIFY `vid_ques` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
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
