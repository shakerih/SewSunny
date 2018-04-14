-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2018 at 12:40 AM
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
(1, 6, 1, '2018-04-09 04:05:49', '~o(^_^)o~ love it!'),
(1, 13, 7, '2018-04-14 18:30:31', 'So cute! Thanks for teaching and sharing!');

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
(1, 'Easy'),
(2, 'Intermediate'),
(3, 'Difficult');

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
(7, 8),
(3, 1),
(3, 2);

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
(1, '5.5 mm crochet hook', 1, 'piece', 8),
(2, 'cotton yarn', 4, 'roll', 8),
(5, 'knitting poles', 2, 'items', 8),
(6, 'something', 5, 'pcs', 8),
(7, 'Scissors', 1, 'pcs', 8),
(8, 'Yarn Needle', 1, 'pcs', 8),
(9, 'Plastic', 5, 'mm', 8),
(10, 'Wood Dowel', 64, 'mm', 8),
(11, 'Pendleton Wool Fabric', 64, 'cm', 8),
(12, 'Thread', 4, 'pcs', 8),
(13, 'crochet hook', 1, 'piece', 1),
(14, 'yarn', 1, 'roll', 1);

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
(7, 'bunny', 'eva', 'eva@sfu.ca', '$2y$10$e4wvuFpNckGG5VwcnBYa3uZDB.bPgG5UOngO2W7mZrEupWOPf9s8S', 0),
(8, 'nicole', 'Nicole', 'nicole@craft.ca', '$2y$10$idmuUlCo8IS4nLzcvP8QveDW6ST21WKVcIv3/41chwDYU2//fLzYu', 0);

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
  `time` varchar(30) NOT NULL,
  `categoryID` varchar(20) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projectID`, `projectTitle`, `levelDifficulty`, `userID`, `description`, `imgURL`, `time`, `categoryID`, `tag`) VALUES
(1, 'Baby Crochet Hat', '1', 2, 'Beginner crocheters often want to learn how to crochet a baby hat. Crochet hats are popular because they work up quickly and make great gifts.', 'http://cdn3.craftsy.com/blog/wp-content/uploads/2017/03/how-to-crochet-baby-hat.jpg', '2018-04-09 08:12', 'CAT_0', 'crochet, hat'),
(2, 'Heart Cross Stitch', '1', 1, '\0It\'s that time of year. Time to pull out all the hearts and the pink, right? This year I\'m sticking with the black and white theme from Christmas (remember these trees?) and keeping my Valentine\'s day decor neutral. If you love geometric and graphic designs, then this simple cross stitched heart art is for you. And if you love pink, you can easily customize to your favorite color.', 'https://helloglow.co/wp-content/uploads/2014/01/cross-stitch-heart-8.jpg', '2018-04-09 18:21', 'CAT_1', 'cross stitch, heart'),
(3, 'Summer Skirt Sewing', '1', 2, 'Have you been noticing the summer trend? I\'m sharing sewing tutorials/patterns and ideas every Wed.. and I\'m trying to go every other week with ME {women\'s} ideas and kids sewing projects. This week I\'ve got a super simple summer skirt sewing tutorial for you. If you have a sewing machine collecting dust, this is the perfect project to dust it off and sew something for yourself. The skirt is easy to sew and fully sizable based on measurements...', 'https://lifesewsavory.com/wp-content/uploads/2014/07/summerskirt1-1024x871.jpg', '2018-03-08 08:45', 'CAT_2', 'sewing, skirt'),
(4, 'Herringbone Stitch Knitting', '1', 1, 'This technique is another nice way to tack up a hem. It can be applied to the cuffs, neck or hemline of a sweater. It involves two simple movements that are illustrated below.', 'http://tutorials.knitpicks.com/wp-content/uploads/2009/12/herringbone2.jpg', '2018-03-07 14:08', 'CAT_3', 'knitting, herringbone, stitching'),
(5, 'Gradient Dyed Yarn Scarf', '1', 2, 'Sometimes you don\'t want a solid color when you are dyeing yarn. It is possible to achieve gradated color when dyeing at home. In our Gradated Dyeing Tutorial, we demonstrate the technique using a finished scarf knit in our Bare yarn. This method can be used on either yarn or a completed project.', 'http://cag.kp.images.s3.amazonaws.com/NING/PDFimages/109_Dyeing_11.jpg', '2018-03-25 10:55', 'CAT_3', 'knitting, dyeing, yarn'),
(6, 'Knit Sweater', '1', 5, 'cable knit sweater perfect for the winter season ', 'https://cdn.lookastic.com/beige-cable-sweater/cable-knit-sweater-original-124755.jpg', '2018-04-08 09:54', 'CAT_3', 'sweater'),
(7, 'DIY Felt Narwhal', '1', 4, 'Craft the high seas with our adorable-as-all-get-out felt narwhal project! Narwhals are such special sea creatures... they swim so gracefully and their unique sword-like tooth inspires such intrigue. Did you know a group of narwhals is called a blessing? Craft a few of these narwhals for a blessed blessing of your own!', 'https://s3-us-west-2.amazonaws.com/lia-griffith-media/wp-content/uploads/2017/10/Felt_Narwhal_Stuffie.jpg', '2018-02-29 11:15', 'CAT_2', 'sewing, felt, DIY'),
(8, 'Pendleton Wall Hanging', '1', 7, 'This stylish wall hanging is a great way to bring a sense of personality and warmth to your home. Give any space a creative and cozy feel by turning your favorite Pendleton wool fabric into a wall hanging. With just a few additional materials and a handful of simple steps, youâ€™ll be amazed at how such an easy project can yield such artistic results! A nice accent piece that can be moved from room to room, from one season to the next. This easy-to-make tapestry is both trendy and timeless â€“ have fun creating and we promise youâ€™ll enjoy it for years to come.', 'https://s3-us-west-2.amazonaws.com/lia-griffith-media/wp-content/uploads/2017/06/Blanket_Wall_Art.jpg', '2018-04-10 12:09', 'CAT_2', 'sewing, wall hanging'),
(9, 'Quilted Skull Pillow', '2', 8, 'Hi friends,\r\n\r\nI am sharing with you today a project I made wayyyy back in October of 2014 (please forgive any blurry photos). This is a fun quilted pillow project just in time for Halloween - The Quilted Skull Pillow. You can make this as scary or as cute as you like and customize your colors to your Halloween decor. This design can also be used for a custom skull quilt block for a fun Halloween quilt!', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull25-1170x780.jpg', '2017-09-15 14:11', 'CAT_0', 'sewing, pillow, DIY');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `projectID` int(11) NOT NULL,
  `rateID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`projectID`, `rateID`, `userID`, `rating`) VALUES
(1, 18, 3, 4),
(2, 20, 3, 4),
(3, 22, 3, 4),
(4, 25, 3, 3),
(8, 28, 7, 4),
(8, 30, 7, 5),
(8, 31, 7, 2),
(8, 32, 7, 4),
(8, 33, 7, 5),
(8, 34, 7, 3),
(8, 35, 7, 5),
(8, 36, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE `steps` (
  `projectID` int(11) NOT NULL,
  `stepID` int(11) NOT NULL,
  `stepnumber` int(11) NOT NULL,
  `instructions` varchar(500) NOT NULL,
  `instruct_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`projectID`, `stepID`, `stepnumber`, `instructions`, `instruct_photo`) VALUES
(1, 1, 1, 'Choose your yarn - you can make a crochet baby hat out of any yarn you want. However, some choices are better than others for baby items.', 'http://cdn3.craftsy.com/blog/wp-content/uploads/2017/03/Promo_20170131_SprightlyCLP_2189_null.jpg'),
(1, 2, 2, 'Choose a size - babies have heads of very different sizes depending on their age, so you need to plan for the size you want to make. You could take an exact measurement of babyâ€™s head and do the math to figure out the size.', 'http://cdn3.craftsy.com/blog/wp-content/uploads/2017/03/newborn-crochet-hats.jpg'),
(8, 7, 1, 'Gather the tools and materials listed above.', ''),
(8, 8, 2, 'Hem the left and right sides of the fabric to finish the edges.', ''),
(8, 9, 3, 'On the bottom edge, fold over twice by 1/2\'\' and pin.', ''),
(8, 10, 4, 'Sew across with a straight stitch using matching thread.', ''),
(8, 11, 5, 'On the top edge, create an overlock stitch to prevent unraveling by using a zigzag stitch on a regular machine or a serger.', ''),
(8, 12, 6, 'Create a pocket at the top by folding over by 3\'\' and sewing a straight stitch using a thread color that matches the pattern. We used the h', ''),
(8, 13, 7, 'Insert the pole into the pocket.', ''),
(8, 14, 8, 'Create 5\'\' yarn tassels using the tutorial on our site.', ''),
(8, 15, 9, 'We used nine tassels for our 62 1/2\'\' wide wall hanging.', ''),
(8, 16, 10, 'Use a yarn needle to sew tassels evenly spaced along the bottom edge. Knot and trim the yarn.', 'https://s3-us-west-2.amazonaws.com/lia-griffith-media/wp-content/uploads/2017/06/Pendleton_Wallhanging_Tutorial2.jpg'),
(9, 17, 1, 'Cut your fabrics according to the measurements above, use a 1/4â€³ seam allowance unless otherwise noted.', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull1.jpg'),
(9, 18, 2, 'First we will need to create our patchwork skull. Take 24 of your 26 dark 3â€³ squares and group into twoâ€™s right side facing each other. Take a ruler and draw a line down the middle from one point to the other with a fabric pen or pencil.', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull3.jpg'),
(9, 19, 3, 'At your sewing machine using your sewing foot as a guide stitch along each side of the line leaving a 1/4â€³ space on each side like shown. Chain stitching makes the process go by quickly and easily.', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull4.jpg'),
(9, 20, 4, 'Taking your ruler and rotary cutter, cut down the center of each line - you will now have two separate HSTâ€™s. Iron open your seams and trim down to 2.5â€³ square. Follow the same steps for your two remaining 3â€³ dark squares and your two 3â€³ white squares.', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull5.jpg'),
(9, 21, 5, 'Once you have all of your HST trimmed down to 2.5â€³ square, lay out your skull shape in the pattern above. You will fill in the skull shape with the solid white 2.5â€³ squares and the four half white / half dark squares you created in the step before. The darker HST will be your skull background.\r\n\r\n', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull6.jpg'),
(9, 22, 6, 'Now at your machine, stitch all of your squares into rows, and your rows into the full skull shape. It helps to iron your seam allowances in the back opposite directions so that you may nest your seams together easily.', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull7.jpg'),
(9, 23, 7, 'Take your two border pieces measuring 3.25â€³ x 15â€³ and stitch on each side of your skull piece. Once you have ironed your seam allowances flat, add your two border pieces measuring 2.25â€³ x 19â€³ to the top and bottom of your skull piece. Iron seams and square up your pillow front to 18â€³ x 18â€³.', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull10.jpg'),
(9, 24, 8, 'Iron your fusible fleece measuring 18â€³ x 18â€³ to the backside of your pillow front and quilt using a coordinating thread.', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull11.jpg'),
(9, 25, 9, 'Take your small piece of black fabric measuring 5â€³ x 7â€³ fused with heat n bond and cut out two circles for the skullâ€™s eyes, a triangle with rounded corners for the nose, and a rectangle piece for the mouth. Get creative and make the skull as sweet or as scary looking as you like.', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull12.jpg'),
(9, 26, 10, 'Once you have places all of your pieces, iron them down with a hot iron - cool - and stitch around the edges with a blanket stitch or tight zig-zag on your machine. This step will complete your pillow front.', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull13.jpg'),
(9, 27, 11, ' Take your two pieces of backing fabric measuring 13â€³ x 18â€³ and double fold one side of each (fold over 1/2â€³ and iron, fold a second time 1/2â€³ and iron).', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull14.jpg'),
(9, 28, 12, 'Lay your pillow front right side up and place your two envelope back pieces right side down with two folded pieces towards middle. Pin in place and stitch around the entire pillow.', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull16.jpg'),
(9, 29, 13, 'A quick snip of the edges and a zig - zag stitch around the pillow makes for a clean finish for the inside of your pillow. Turn right side out and poke out corners with a pointed object - and you are finished!', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull17.jpg'),
(1, 30, 3, 'Crochet a flat circle to the desired diameter', ''),
(1, 31, 4, 'ROUND 1: Ch 3 and work 9 dc in third chain from hook. (Or crochet a magic ring and make 10 dc inside it.) Join the last stitch to the top of the first stitch to close the ring. (Total of 10 dc st.)', 'http://cdn3.craftsy.com/blog/wp-content/uploads/2017/03/crochet-baby-hat-round-1.jpg'),
(1, 32, 5, 'ROUND 2: Chain 3 (counts as first dc). 1 dc in same stitch as ch 3. 2 dc in each stitch around. Sl st to top of ch 3 to finish round. (Total of 20 dc st.)', 'http://cdn3.craftsy.com/blog/wp-content/uploads/2017/03/crochet-baby-hat-round-2.jpg'),
(1, 33, 6, 'ROUND 3: Chain 3 (counts as first dc). 2 dc in next stitch. *1 dc, 2 dc. Repeat from * around. Sl st to top of ch 3 to finish round. (Total of 30 dc st.)', 'http://cdn3.craftsy.com/blog/wp-content/uploads/2017/03/crochet-baby-hat-round-3.jpg'),
(1, 34, 7, 'You can finish off your crochet hat after Step 6 and it will look fine. However, a crochet baby hat always looks a little cleaner with an edging to border the bottom of it. You can use any edging that you want!', 'http://cdn3.craftsy.com/blog/wp-content/uploads/2017/03/crochet-baby-hat.jpg'),
(9, 37, 14, 'I hope that you enjoyed this tutorial!', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull22.jpg');

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
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `materialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `userID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projectID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `steps`
--
ALTER TABLE `steps`
  MODIFY `stepID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
