-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2018 at 09:45 PM
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
('CAT_0', 'Crochet'),
('CAT_1', 'Cross Stitch'),
('CAT_2', 'Sewing'),
('CAT_3', 'Knitting');

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
(1, 4, 2, '2018-04-09 03:14:21', 'Turned out great. It was fast and easy.'),
(1, 6, 1, '2018-04-09 04:05:49', '~o(^_^)o~ love it!');

-- --------------------------------------------------------

--
-- Table structure for table `difficulty`
--

CREATE TABLE `difficulty` (
  `difficultyID` int(10) NOT NULL,
  `difficultyName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `difficulty`
--

INSERT INTO `difficulty` (`difficultyID`, `difficultyName`) VALUES
(0, 'Easy'),
(1, 'Intermediate'),
(2, 'Difficult');

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
(6, 1),
(7, 1),
(7, 2),
(7, 31);

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
(1, '5.5 mm crochet hook', 1, 'piece', 1),
(2, 'cotton yarn', 4, 'roll', 1),
(4, 'yarn', 1, 'rolls', 29),
(5, 'knitting poles', 2, 'items', 29),
(6, 'something', 5, 'pcs', 30),
(7, 'Scissors', 1, 'pcs', 31),
(8, 'Yarn Needle', 1, 'pcs', 31),
(9, 'Plastic', 5, 'mm', 31),
(10, 'Wood Dowel', 64, 'mm', 31),
(11, 'Pendleton Wool Fabric', 64, 'cm', 31),
(12, 'Thread', 4, 'pcs', 31),
(13, 'Yarn', 1, 'rolls', 31),
(14, 'test', 1, 'pounds', 0),
(15, 'paper', 2, 'pounds', 0),
(16, 'test', 1, 'pcs', 0),
(17, 'steel', 1, 'cm', 0),
(18, 'paper', 1, 'kg', 0),
(19, 'lo', 1, 'items', 0),
(20, 'key', 1, 'pcs', 32),
(21, 'ji', 9, 'pcs', 0),
(22, 'keu', 1, 'items', 0),
(23, 'keu', 1, 'items', 0),
(24, 'hi', 2, 'meter', 33),
(25, 'material name2', 2, 'pounds', 34),
(26, 'material name', 1, 'pounds', 34),
(27, 'material name', 2, 'meter', 35),
(28, 'material name', 2, 'pounds', 36),
(29, 'material name', 2, 'pounds', 0),
(30, 'material name', 1, 'meter', 39),
(31, 'material names', 2, 'pounds', 0),
(32, 'material namedf', 2, 'pounds', 0),
(33, 'material name3r4', 3, 'cm', 9),
(34, 'material nameewr', 2, 'meter', 10);

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
  `projectID` int(255) NOT NULL,
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
(1, 'Half Double Crochet Hat', '0', 0, 'The pattern in this post is for a hat worked in medium weight yarn with a 5.50 mm (I) crochet hook. I do have many other hat options available if you are using different yarn/hook sizes and I have included them below to make it easier for you to find them!', 'https://cdn1.oombawkadesigncrochet.com/wp-content/uploads/2014/02/hdc+hat+pattern+cotton+oombawkadesigncrochet1.jpg', '00:00:00', 'CAT_0', 'crochet, hat'),
(2, 'Heart Cross Stitch', '0', 1, '\0It\'s that time of year. Time to pull out all the hearts and the pink, right? This year I\'m sticking with the black and white theme from Christmas (remember these trees?) and keeping my Valentine\'s day decor neutral. If you love geometric and graphic designs, then this simple cross stitched heart art is for you. And if you love pink, you can easily customize to your favorite color.', 'https://helloglow.co/wp-content/uploads/2014/01/cross-stitch-heart-8.jpg', '00:00:00', 'CAT_1', 'cross stitch, heart'),
(3, 'Summer Skirt Sewing', '0', 0, 'Have you been noticing the summer trend? I\'m sharing sewing tutorials/patterns and ideas every Wed.. and I\'m trying to go every other week with ME {women\'s} ideas and kids sewing projects. This week I\'ve got a super simple summer skirt sewing tutorial for you. If you have a sewing machine collecting dust, this is the perfect project to dust it off and sew something for yourself. The skirt is easy to sew and fully sizable based on measurements...', 'https://lifesewsavory.com/wp-content/uploads/2014/07/summerskirt1-1024x871.jpg', '00:00:00', 'CAT_2', 'sewing, skirt'),
(4, 'Herringbone Stitch Knitting', '0', 1, 'This technique is another nice way to tack up a hem. It can be applied to the cuffs, neck or hemline of a sweater. It involves two simple movements that are illustrated below.', 'http://tutorials.knitpicks.com/wp-content/uploads/2009/12/herringbone2.jpg', '00:00:00', 'CAT_3', 'knitting, herringbone, stitching'),
(5, 'Gradient Dyed Yarn Scarf', '0', 0, 'Sometimes you don\'t want a solid color when you are dyeing yarn. It is possible to achieve gradated color when dyeing at home. In our Gradated Dyeing Tutorial, we demonstrate the technique using a finished scarf knit in our Bare yarn. This method can be used on either yarn or a completed project.', 'http://cag.kp.images.s3.amazonaws.com/NING/PDFimages/109_Dyeing_11.jpg', '00:00:00', 'CAT_3', 'knitting, dyeing, yarn'),
(6, 'Knit Sweater', '0', 5, 'cable knit sweater perfect for the winter season ', 'https://cdn.lookastic.com/beige-cable-sweater/cable-knit-sweater-original-124755.jpg', '1522725700', 'CAT_3', 'sweater'),
(7, 'DIY Felt Narwhal', '0', 4, 'Craft the high seas with our adorable-as-all-get-out felt narwhal project! Narwhals are such special sea creatures... they swim so gracefully and their unique sword-like tooth inspires such intrigue. Did you know a group of narwhals is called a blessing? Craft a few of these narwhals for a blessed blessing of your own!', 'https://s3-us-west-2.amazonaws.com/lia-griffith-media/wp-content/uploads/2017/10/Felt_Narwhal_Stuffie.jpg', '1522786538', 'CAT_2', 'sewing, felt, DIY'),
(8, 'Pendleton Wall Hanging', '0', 7, 'This stylish wall hanging is a great way to bring a sense of personality and warmth to your home. Give any space a creative and cozy feel by turning your favorite Pendleton wool fabric into a wall hanging. With just a few additional materials and a handful of simple steps, youâ€™ll be amazed at how such an easy project can yield such artistic results! A nice accent piece that can be moved from room to room, from one season to the next. This easy-to-make tapestry is both trendy and timeless â€“ have fun creating and we promise youâ€™ll enjoy it for years to come.', 'https://s3-us-west-2.amazonaws.com/lia-griffith-media/wp-content/uploads/2017/06/Blanket_Wall_Art.jpg', '1523255204', 'CAT_2', 'sewing, wall hanging');

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
(2, 20, 3, 4),
(3, 22, 3, 4),
(4, 25, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE `steps` (
  `projectID` int(11) NOT NULL,
  `stepID` int(11) NOT NULL,
  `stepnumber` int(11) NOT NULL,
  `instructions` varchar(140) NOT NULL,
  `instruct_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`projectID`, `stepID`, `stepnumber`, `instructions`, `instruct_photo`) VALUES
(1, 1, 2, 'double knit 25 rows', ''),
(1, 2, 1, 'prepare all materials', ''),
(29, 3, 1, 'prepare materials', ''),
(29, 4, 2, 'cable knit 50 rows', ''),
(30, 5, 1, 'step 1 ', ''),
(30, 6, 2, 'step 2', ''),
(31, 7, 1, 'Gather the tools and materials listed above.', ''),
(31, 8, 2, 'Hem the left and right sides of the fabric to finish the edges.', ''),
(31, 9, 3, 'On the bottom edge, fold over twice by 1/2\'\' and pin.', ''),
(31, 10, 4, 'Sew across with a straight stitch using matching thread.', ''),
(31, 11, 5, 'On the top edge, create an overlock stitch to prevent unraveling by using a zigzag stitch on a regular machine or a serger.', ''),
(31, 12, 6, 'Create a pocket at the top by folding over by 3\'\' and sewing a straight stitch using a thread color that matches the pattern. We used the h', ''),
(31, 13, 7, 'Insert the pole into the pocket.', ''),
(31, 14, 8, 'Create 5\'\' yarn tassels using the tutorial on our site.', ''),
(31, 15, 9, 'We used nine tassels for our 62 1/2\'\' wide wall hanging.', ''),
(31, 16, 10, 'Use a yarn needle to sew tassels evenly spaced along the bottom edge. Knot and trim the yarn.', 'https://s3-us-west-2.amazonaws.com/lia-griffith-media/wp-content/uploads/2017/06/Pendleton_Wallhanging_Tutorial2.jpg'),
(32, 23, 1, 'hi', ''),
(33, 27, 1, 'wh', ''),
(34, 28, 1, '2', ''),
(35, 29, 1, 'h', ''),
(36, 30, 1, 'f', ''),
(39, 32, 1, '23', ''),
(0, 33, 1, 'dsf', ''),
(0, 34, 1, 'sdfdf', ''),
(9, 35, 1, '32432', ''),
(10, 36, 1, 'few', '');

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
-- Indexes for table `difficulty`
--
ALTER TABLE `difficulty`
  ADD PRIMARY KEY (`difficultyID`);

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
  MODIFY `materialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `userID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projectID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `steps`
--
ALTER TABLE `steps`
  MODIFY `stepID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
