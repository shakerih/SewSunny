-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2018 at 10:32 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sew_sunny`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` varchar(20) NOT NULL,
  `categoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
('CAT_0', 'crochet'),
('CAT_1', 'cross stitch'),
('CAT_2', 'sewing'),
('CAT_3', 'knitting');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `projectID` int(11) NOT NULL,
  `commentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`projectID`, `commentID`, `userID`, `time`, `comment`) VALUES
(1, 4, 3, '2018-04-08 02:34:04', 'houfp;vb'),
(1, 6, 3, '2018-04-08 03:05:27', 'bbbbbbbbbb');

-- --------------------------------------------------------

--
-- Table structure for table `favourite_project`
--

CREATE TABLE `favourite_project` (
  `userID` int(255) NOT NULL,
  `projectID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourite_project`
--

INSERT INTO `favourite_project` (`userID`, `projectID`) VALUES
(0, 0),
(0, 0),
(1, 0),
(1, 0),
(3, 1),
(3, 2),
(4, 1),
(5, 1),
(5, 29),
(6, 1),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `materialID` int(11) NOT NULL,
  `materialName` varchar(100) NOT NULL,
  `quantity` float NOT NULL,
  `unit` varchar(100) NOT NULL,
  `projectID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`materialID`, `materialName`, `quantity`, `unit`, `projectID`) VALUES
(3, 'wool', 1, 'roll', 1),
(4, 'yarn', 1, 'rolls', 29),
(5, 'knitting poles', 2, 'items', 29),
(6, 'something', 5, 'pcs', 30);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `userID` int(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avgRating` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`userID`, `username`, `name`, `email`, `password`, `avgRating`) VALUES
(1, 'bunnyStitcher', 'eva li', 'yla312@sfu.ca', '$rHD3JDaBYYMxSGOe.zyo0Jmpxh5s3vpkJZedMtcITw.1o4Ss3vpkJZedMtcI', 4.6),
(2, 'sloth_knits', 'hanieh s', 'hshakeri@sfu.ca', '$2y$10$KDhXterHD3JDaBYYMxSGOe.zyo0Jmpxh5s3vpkJZedMtcITw.1o4S', 4.2),
(3, 'hh', 'hh', 'hh', '$2y$10$Ey8k37RlR.r9Tmwd7GhNLO5CP3mjBH449XXaVLpnefwfAMVtC/Et6', 0),
(4, 'hshakeri', 'hanieh', 'hshakeri@sfu.ca', '$2y$10$EXAGTm9Hae.aRdiZFpKm7ebleSm1FuzdL3St9a9TU175mC/0Nv9rS', 0),
(5, 'eg', 'example', 'eg@sfu.ca', '$2y$10$Pk1KpFFmrZhgE9WDhyljWezM4Z72laVy7.lG/QvdjAetDJI/at15C', 0),
(6, 'ab', 'abc', 'abc@sfu.ca', '$2y$10$SlWovwHn6bpzcVCqtucJ8eKXBQ0P8VydxvHTrwnbadnI1QTFTN2sG', 0),
(7, 'eva', 'eva', 'eva@sfu.ca', '$2y$10$zuS.v.A/eCgskIYOB4L/COoMoTKY178JQnSN04HXWseKH54BXKsCW', 0);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `projectID` int(20) NOT NULL,
  `projectTitle` varchar(50) NOT NULL,
  `levelDifficulty` varchar(20) NOT NULL,
  `userID` int(255) NOT NULL,
  `description` text NOT NULL,
  `imgURL` varchar(255) NOT NULL,
  `time` varchar(10) NOT NULL,
  `categoryID` varchar(20) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projectID`, `projectTitle`, `levelDifficulty`, `userID`, `description`, `imgURL`, `time`, `categoryID`, `tag`) VALUES
(1, 'Simple Double Crochet Hat', 'Beginner', 0, 'The pattern in this post is for a hat worked in medium weight yarn with a 5.50 mm (I) crochet hook. I do have many other hat options available if you are using different yarn/hook sizes and I have included them below to make it easier for you to find them!', 'https://cdn3.oombawkadesigncrochet.com/wp-content/uploads/2014/02/hdc+hat+pattern+cotton+oombawkadesigncrochet1-300x199.jpg', '00:00:00', 'CAT_0', 'crochet, hat'),
(2, 'Heart Cross Stitch', 'Beginner', 1, 'It’s that time of year. Time to pull out all the hearts and the pink, right? This year I’m sticking with the black and white theme from Christmas (remember these trees?) and keeping my Valentine’s day decor neutral. If you love geometric and graphic designs, then this simple cross stitched heart art is for you. And if you love pink, you can easily customize to your favorite color.', 'https://helloglow.co/wp-content/uploads/2014/01/cross-stitch-heart-8.jpg', '00:00:00', 'CAT_1', 'cross stitch, heart'),
(3, 'Summer Skirt Sewing', 'Beginner', 0, 'Have you been noticing the summer trend? I’m sharing sewing tutorials/patterns and ideas every Wed.. and I’m trying to go every other week with ME {women’s} ideas and kids sewing projects. This week I’ve got a super simple summer skirt sewing tutorial for you. If you have a sewing machine collecting dust, this is the perfect project to dust it off and sew something for yourself. The skirt is easy to sew and fully sizable based on measurements…', 'https://lifesewsavory.com/wp-content/uploads/2014/07/summerskirt1-1024x871.jpg', '00:00:00', 'CAT_2', 'sewing, skirt'),
(4, 'Herringbone Stitch Knitting', 'Advanced', 1, 'This technique is another nice way to tack up a hem. It can be applied to the cuffs, neck or hemline of a sweater. It involves two simple movements that are illustrated below.', 'http://tutorials.knitpicks.com/wp-content/uploads/2009/12/herringbone2.jpg', '00:00:00', 'CAT_3', 'knitting, herringbone, stitching'),
(5, 'Gradient Dyed Yarn Scarf', 'Advanced', 0, 'Sometimes you don’t want a solid color when you are dyeing yarn. It is possible to achieve gradated color when dyeing at home. In our Gradated Dyeing Tutorial, we demonstrate the technique using a finished scarf knit in our Bare yarn. This method can be used on either yarn or a completed project.', 'http://cag.kp.images.s3.amazonaws.com/NING/PDFimages/109_Dyeing_11.jpg', '00:00:00', 'CAT_3', 'knitting, dyeing, yarn'),
(29, 'Knit Sweater', '1', 5, 'cable knit sweater perfect for the winter season ', 'https://cdn.lookastic.com/beige-cable-sweater/cable-knit-sweater-original-124755.jpg', '1522725700', 'CAT_3', 'sweater'),
(30, 'example', '2', 6, 'some description', '', '1522786538', 'CAT_2', 'sewing');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `projectID` int(11) NOT NULL,
  `rateID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`projectID`, `rateID`, `userID`, `rating`) VALUES
(1, 18, 3, 4),
(1, 20, 3, 4),
(1, 22, 3, 4),
(1, 25, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE `steps` (
  `projectID` int(11) NOT NULL,
  `stepID` int(11) NOT NULL,
  `stepnumber` int(11) NOT NULL,
  `instructions` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`projectID`, `stepID`, `stepnumber`, `instructions`) VALUES
(1, 1, 2, 'double knit 25 rows'),
(1, 2, 1, 'prepare all materials'),
(29, 3, 1, 'prepare materials'),
(29, 4, 2, 'cable knit 50 rows'),
(30, 5, 1, 'step 1 '),
(30, 6, 2, 'step 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `favourite_project`
--
ALTER TABLE `favourite_project`
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`materialID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`projectID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rateID`);

--
-- Indexes for table `steps`
--
ALTER TABLE `steps`
  ADD PRIMARY KEY (`stepID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `materialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `userID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projectID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `steps`
--
ALTER TABLE `steps`
  MODIFY `stepID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
