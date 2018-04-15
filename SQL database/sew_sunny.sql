-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2018 at 08:46 AM
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
(1, 13, 7, '2018-04-14 18:30:31', 'So cute! Thanks for teaching and sharing!'),
(9, 20, 7, '2018-04-14 23:31:03', 'Thanks so much for this pillow tutorialâ€¦.Iâ€™m going to start tonight.'),
(9, 21, 3, '2018-04-15 01:38:00', 'This is so cute, I love it!!');

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
(14, 'yarn', 1, 'roll', 1),
(15, '12â€³ x 12â€³ cardstock paper', 1, 'piece', 2),
(16, 'yarn', 1, 'roll', 2),
(17, 'big needle', 1, 'piece', 2),
(18, 'scissors', 1, 'pair', 2),
(19, 'tape', 1, 'roll', 2),
(20, 'hole punch', 1, ' ', 2),
(21, 'embroidery hoop', 1, '8â€³ diameter', 3),
(22, 'embroidery needle', 1, 'piece', 3),
(23, 'embroidery floss', 7, 'bundle', 3),
(24, 'thimble', 1, 'piece', 3),
(25, 'needle threader', 1, 'piece', 3),
(26, 'scissors', 1, 'pair', 3),
(27, '12â€™ x12â€™ cotton fabric', 1, 'piece', 3),
(28, 'masking tape', 1, ' ', 3),
(29, '10mm knitting needles', 1, ' ', 4),
(30, 'yarn', 1, 'roll', 4),
(31, 'wool yarn (light)', 5, ' roll', 5),
(32, 'water', 4, 'liter', 5),
(33, 'white vinegar', 1, 'bottle', 5),
(34, 'bowl', 1, ' ', 5),
(35, 'pot', 1, ' ', 5),
(36, 'tongs', 1, 'pair ', 5),
(37, 'measuring spoong', 1, ' ', 5),
(38, 'chair', 1, ' ', 5),
(39, 'old sweater', 1, 'piece', 6),
(40, 'non-stretch fabric', 1, 'piece', 6),
(41, 'needdle', 1, ' piece', 6),
(42, 'pins', 10, 'piece', 6),
(43, 'scissors', 1, 'pair', 6),
(44, 'buttons', 4, ' ', 6),
(45, 'pen', 1, ' ', 6),
(46, 'batting', 1, 'piece', 6),
(52, 'sewing Needle', 1, 'pcs', 7),
(53, 'hot glue gun', 1, ' ', 7),
(54, 'scissors', 1, 'pair ', 7),
(55, 'wooden skewer', 1, 'set', 7),
(56, 'cotton fabric', 1, 'pcs', 23),
(57, 'felt', 2, 'pcs', 23),
(58, 'sewing machine', 1, 'pcs', 23),
(59, 'needle and thread', 1, 'pcs', 23),
(60, 'pins', 10, 'pcs', 23),
(61, 'scissors', 1, 'pcs', 23),
(62, 'embroidery floss', 1, 'pcs', 23),
(63, 'iron and ironing board', 1, 'pcs', 23),
(64, 'red felt', 1, 'pcs', 24),
(65, 'white felt', 1, 'pcs', 24),
(66, 'embroidery floss', 1, 'rolls', 24),
(67, 'small chipboard', 1, 'pcs', 24),
(68, 'black permanent marker', 1, 'pcs', 24),
(69, 'scissors', 1, 'pcs', 24),
(70, 'sewing needle', 1, 'pcs', 24),
(71, 'thin magnet', 1, 'items', 24),
(72, 'scissors', 1, 'pcs', 25),
(73, 'cotton fabric', 1, 'pcs', 25),
(74, 'needle and thread', 1, 'pcs', 25),
(75, 'pins', 10, 'pcs', 25);

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
(4, 'hshakeri', 'hanieh', 'hshakeri@sfu.ca', '$2y$10$DgQsOGtPyyjnLTR6LTbCsemveHw3g5ubK0aa16hZBvw2ArZiJFFEy', 0),
(5, 'eg', 'example', 'eg@sfu.ca', '$2y$10$Pk1KpFFmrZhgE9WDhyljWezM4Z72laVy7.lG/QvdjAetDJI/at15C', 0),
(6, 'ab', 'abc', 'abc@sfu.ca', '$2y$10$SlWovwHn6bpzcVCqtucJ8eKXBQ0P8VydxvHTrwnbadnI1QTFTN2sG', 0),
(7, 'bunny', 'eva', 'eva@sfu.ca', '$2y$10$e4wvuFpNckGG5VwcnBYa3uZDB.bPgG5UOngO2W7mZrEupWOPf9s8S', 0),
(8, 'nicole', 'Nicole', 'nicole@craft.ca', '$2y$10$idmuUlCo8IS4nLzcvP8QveDW6ST21WKVcIv3/41chwDYU2//fLzYu', 0),
(9, 'Rachel ', 'Rachel ', 'rachel@craft.com', '$2y$10$lLAhP0CS8OmLkv/UBFjo/.U/b/y3hHz7uJq.x2J0WlWzR3t76vAQu', 0),
(10, 'Emily', 'em', 'emily@craft.com', '$2y$10$xZ/7JwpBKmosSVwHzppSR.MDckulpiQ/JK57c0zaKLWCBWBo.sDOO', 0),
(11, 'CraveTheGood', 'Emma', 'CraveTheGood@craft.com', '$2y$10$wPhYFaP88DTsQTxFXnlHmOupbkiRTs2CtJsC4v6u/29mKzmtf/gYC', 0),
(12, 'CraftersAndMothers', 'mother', ' CraftersAndMothers@craft.com', '$2y$10$RJkBcXeQVmlfSTqJdqJVOOoOI3grRjQfNIDmMYA/H2oCZdnREjcXO', 0),
(13, 'LiaGriffith', 'LiaGriffith', 'LiaGriffith@craft.com', '$2y$10$/QgvoF7//sdvf3r3Gs82cOf6lNZk8kWjN3Orl7BJ/8QGIahbWwR.q', 0);

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
(2, 'Heart Cross Stitch', '1', 1, 'Itâ€™s that time of year. Time to pull out all the hearts and the pink, right? This year Iâ€™m sticking with the black and white theme from Christmas (remember these trees?) and keeping my Valentineâ€™s day decor neutral. If you love geometric and graphic designs, then this simple cross stitched heart art is for you. And if you love pink, you can easily customize to your favorite color.', 'https://helloglow.co/wp-content/uploads/2014/01/cross-stitch-heart-8.jpg', '2018-04-09 18:21', 'CAT_1', 'cross stitch, heart'),
(3, 'DIY: Heart Embroidery', '1', 9, 'There are hundreds of different types of embroidery stitches in existence. For this beginner project, Iâ€™ve chosen just seven: three basic outline stitches (Running Stitch, Back Stitch and Chain Stitch) and four decorative stitches (Threaded Running Stitch, Cross Stitch, Star Stitch and Fern Stitch). To make these stitches as easy to learn as possible Iâ€™ve included both photos with written instructions and a video link for each stitch.', 'http://adventures-in-making.com/wp-content/uploads/2016/01/embroidery-sampler-38.jpg', '2018-03-08 08:45', 'CAT_2', 'sewing, DIY, heart, embroidery'),
(4, 'Herringbone Stitch Knitting (Detailed)', '3', 10, 'Ever wanted to learn how to knit the herringbone stitch? Itâ€™s one of my favorites because of its simple, classic and minimalist look. It can seem really daunting to knit, but trust me you will easily be able to pick it up and be knitting up a gorgeous piece in no time!', 'https://i1.wp.com/thebluemouseknits.com/wp-content/uploads/2017/09/herringbone.tutorial-17.jpg?resize=1170%2C550', '2018-03-07 14:08', 'CAT_3', 'knitting, herringbone'),
(5, 'How to Dye Gradient (Ombre) Yarn ', '1', 11, 'Itâ€™s a hobby I would recommend to anyone. After a few rows, I find myself completely de-stressed. Itâ€™s like yoga, but for people who don\'t like exercise. ha.', 'https://cdn.instructables.com/FZT/RUAG/IU2TPMLB/FZTRUAGIU2TPMLB.LARGE.jpg?width=400', '2018-03-25 10:55', 'CAT_3', 'knitting, dyeing, yarn, DIY'),
(6, 'Knitted Puffer Vest from Old Sweater', '2', 12, 'I love winter fashion because itâ€™s the perfect season for layers. And the best way to layer for extra warmth and mobility is a vest.\r\n<br><br>\r\nI loved how this knitted puffer vest turned out, and although I like knitting I prefer the convenience of making it from an old sweater. If we knit the vest it would take a lot longer and it will be way more expensive. Also itâ€™s a great project to make something amazing out of an item that could end up in the landfill. You can find awesome wool or even cashmere sweaters at a thrift store, so this project is very affordable and it’ll take you only one afternoon.', 'https://cdn.instructables.com/FW5/5O3C/JE4KLZ5P/FW55O3CJE4KLZ5P.LARGE.jpg', '2018-04-08 09:54', 'CAT_3', 'sweater, craft, DIY, knitting'),
(7, 'DIY Felt Narwhal', '1', 13, 'Craft the high seas with our adorable-as-all-get-out felt narwhal project! Narwhals are such special sea creatures... they swim so gracefully and their unique sword-like tooth inspires such intrigue. Did you know a group of narwhals is called a blessing? Craft a few of these narwhals for a blessed blessing of your own!', 'https://s3-us-west-2.amazonaws.com/lia-griffith-media/wp-content/uploads/2017/10/Felt_Narwhal_Stuffie.jpg', '2018-02-29 11:15', 'CAT_2', 'sewing, felt, DIY'),
(8, 'Pendleton Wall Hanging', '1', 13, 'This stylish wall hanging is a great way to bring a sense of personality and warmth to your home. Give any space a creative and cozy feel by turning your favorite Pendleton wool fabric into a wall hanging. With just a few additional materials and a handful of simple steps, youâ€™ll be amazed at how such an easy project can yield such artistic results! A nice accent piece that can be moved from room to room, from one season to the next. This easy-to-make tapestry is both trendy and timeless â€“ have fun creating and we promise youâ€™ll enjoy it for years to come.', 'https://s3-us-west-2.amazonaws.com/lia-griffith-media/wp-content/uploads/2017/06/Blanket_Wall_Art.jpg', '2018-04-10 12:09', 'CAT_2', 'sewing, wall hanging'),
(9, 'Quilted Skull Pillow', '2', 8, 'Hi friends,\r\n\r\nI am sharing with you today a project I made wayyyy back in October of 2014 (please forgive any blurry photos). This is a fun quilted pillow project just in time for Halloween - The Quilted Skull Pillow. You can make this as scary or as cute as you like and customize your colors to your Halloween decor. This design can also be used for a custom skull quilt block for a fun Halloween quilt!', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull25-1170x780.jpg', '2017-09-15 14:11', 'CAT_2', 'sewing, pillow, DIY'),
(23, 'DIY: Spring Chicken Plushies', '1', 9, 'This is a fairly straightforward tutorial that can be done using a sewing machine or sewn completely by hand. I love coming up with ways to use up fabric scraps and this project is perfect for that since the all the pieces are quite small.', 'uploads/chicken-plushies-22b.jpg', '2018-04-14 22:42', 'CAT_2', 'DIY, sewing'),
(24, 'DIY: Target My Heart Pincushion', '1', 9, 'About 12 years ago I stitched together a utilitarian pillow stuffed with cloth scraps and called it a pincushion. It was my sad companion through many a sewing project, and as much as I wanted to replace it I never made the time.', 'uploads/IMG_4390_hearttargetpincushion.jpg', '2018-04-14 22:49', 'CAT_2', 'DIY, felt, sewing'),
(25, 'Sew a Shibori Beach Bag', '1', 13, 'This bag is lightweight, over-sized and perfect for all your beach towels, magazines and sun hat!', 'uploads/Beach_Tote_Shibori_TieDye_Indigo_DIY.jpg', '2018-04-14 22:55', 'CAT_2', 'DIY, bag, sewing');

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
  `instructions` varchar(1000) NOT NULL,
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
(9, 35, 14, 'I hope that you enjoyed this tutorial!', 'https://modernhandcraft.com/wp-content/uploads/2014/10/skull22.jpg'),
(2, 36, 1, 'Start by punching out the heart holes using the pattern template. Use a single hole punch with a simple hammer to punch the hole. A long armed hole punch would also do the job.', 'https://i1.wp.com/helloglow.co/wp-content/uploads/2014/01/cross-stitch-heart-2.jpg?w=650&ssl=1'),
(2, 37, 2, 'Thread your yarn onto the needle or bodkin, tape the end of the yarn to the back of the card stock and start stitching. This is just simple cross stitch. Stitch diagonally all one direction and when you reach the end of the row cross over the stitches diagonally the other direction. Move the the next row and repeat.', 'https://i1.wp.com/helloglow.co/wp-content/uploads/2014/01/cross-stitch-heart-4.jpg?w=650&ssl=1'),
(2, 38, 3, 'The art fits perfectly into a 12-inch square frame (mine is from IKEA). I use this frame to change up my seasonal decor all the time (like the  tree art I did for winter).', 'https://i2.wp.com/helloglow.co/wp-content/uploads/2014/01/cross-stitch.jpg?w=650&ssl=1'),
(3, 39, 1, 'Prep the Pattern & Fabric\r\n\r\nPrint pattern onto white copy paper. Then cut 1.25â€³ from both the top and bottom of the page to create a square piece of paper with the pattern at the center.\r\n\r\nCut your fabric to size. I cut mine to be 12â€³ x12â€³ square leaving me plenty of extra. You could also get away with a 10â€³ x10â€³ piece of fabric too. Press your fabric to rid of any wrinkles using a hot iron.', 'http://adventures-in-making.com/wp-content/uploads/2016/01/embroidery-sampler-1b.jpg'),
(3, 40, 2, 'Transfer the Pattern to Fabric Using the Light Method\r\n\r\nThe easiest way to transfer a design onto a light-color fabric is to trace it. Place the square paper pattern face down onto the center of the square fabric and secure with washi tape or pins. Flip over and use a light table or my favorite tool to transfer the pattern to the fabric using a fine lead pencil or nonpermanent fabric marking pen. You can also tape your fabric/design to a sunny window and use the natural light to trace.', 'http://adventures-in-making.com/wp-content/uploads/2016/01/embroidery-sampler-3.jpg'),
(3, 41, 3, 'Prepare the Fabric & Floss\r\n\r\nPlace the fabric into your embroidery hoop making sure the design is centered. To make your fabric taut, spread it over the smaller inside hoop and fit the larger outside hoop over the top with your fabric in between. Tighten the little screw on the outer hoop and gently pull on the edges of the fabric until you have a taut surface to work with.', 'http://adventures-in-making.com/wp-content/uploads/2016/01/embroidery-sampler-5.jpg'),
(3, 42, 4, 'Threading your needle\r\n\r\nThreading the needle can be a little tricky, especially when using all six plies of floss. It may help to slightly dampen your finger and twist the end of the thread into a point, or try squeezing the floss ends flat between your thumb and forefinger. Then slide the needleâ€™s eye onto the floss (instead of pushing the floss through the eye). If all else fails, use a needle threader.\r\n\r\nOnce youâ€™ve threaded your needle, knot the longer end of the floss by first wrappin', ''),
(3, 43, 5, 'Stitching the Design\r\n\r\n1. Running Stitch: To begin stitching the Heart Sampler, letâ€™s start with the most basic embroidery stitch- the Running Stitch. Begin at the center dashed line of the heart pattern. Starting at the bottom, pull the threaded needle to the front of the fabric at A (see photo above). Then return to the back of the fabric at B. The distance from A to B can be as long or short as you want. For this project, I recommend making small, even stitches of equal length. End your la', 'http://adventures-in-making.com/wp-content/uploads/2016/01/running-stitch.jpg'),
(3, 44, 6, 'Stitching the Design\r\n\r\n2. Back Stitch: Move over to the next line on the pattern (from the middle running stitch). Starting at the bottom of the pattern, bring your needle through to the front of the fabric at A (see photo above). Then go backwards and return your needle to the back of your fabric at B. Next your going to move your needle forward, coming up at C. Repeat this process to create consecutive back stitches by once again working backwards, poking your needle through at the end of the', 'http://adventures-in-making.com/wp-content/uploads/2016/01/back-stitch.jpg'),
(3, 45, 7, 'Stitching the Design\r\n\r\n3. Cross Stitch: Next we are going to try our first decorative stitch! Starting at the bottom of your pattern, bring your needle through to the front of the fabric at A and then back down again at B (creating a diagonal straight stitch). Next make a second stitch from C to D. Make sure each cross (x) overlap is in the same direction. Once you finish your row and tie off, notice what the back or your stitches look like. The back of a Cross Stitch row should look like the i', 'http://adventures-in-making.com/wp-content/uploads/2016/01/cross-stitch.jpg'),
(3, 46, 8, 'Stitching the Design\r\n\r\n4. Threaded Running Stitch: First make a line of small close Running Stitches. End the floss. Start a second floss strand (in a different color) at the same spot as the first line of running stitches, bringing your needle to the front of your fabric at A. Working on the front only, without stitching through the fabric, insert the needle under the first Running Stitch, then through the second Running Stitch. Continue weaving back and forth under the Running Stitches until ', 'http://adventures-in-making.com/wp-content/uploads/2016/01/threaded-running-stitch.jpg'),
(3, 47, 9, 'Stitching the Design\r\n\r\n5. Chain Stitch: Start again at the bottom of the pattern and move your way up. Bring the threaded needle to the front at A. Insert the needle back into the fabric at A and then just poke the needle back up to the front at B. Loop the thread under the needle point then pull the thread through to create your first chain. Begin the next stitch in the same way by inserting the needle back into the fabric at B (now under the loop), coming up at C (outside the loop). Bring the', 'http://adventures-in-making.com/wp-content/uploads/2016/01/chain-stitch.jpg'),
(3, 48, 10, 'Stitching the Design\r\n\r\n6. Fern Stitch: Fern Stitch consists of three Straight Stitches of equal length radiating from the same central point A. Starting at the top of the pattern and moving your way down, bring the thread through at A and then make a Straight Stitch to B. Bring the thread back through again at point A and make another Straight Stitch to C. Bring the thread back through at point A (for the final time) and make a final straight stitch to D. Repeat this pattern by moving the needl', 'http://adventures-in-making.com/wp-content/uploads/2016/01/fern-stitch.jpg'),
(3, 49, 11, 'Stitching the Design\r\n\r\n7. Star Stitch: This is an Eight Point Star Stitch. Begin by first making a basic cross stitch. Then make another cross stitch diagonally on top of the first one to form a star.', 'http://adventures-in-making.com/wp-content/uploads/2016/01/star-stitch.jpg'),
(3, 50, 12, 'Finishing for Display\r\n\r\nOn your last stitch, return the needle to the back of the fabric. To tie off, pass the needle under a previous stitch creating a loop. Bring the needle back through the floss loop, and tighten. I recommend pulling the thread gently when tying off to ensure that the knot ends up snuggly next to your fabric (and not half an inch away). Avoid yanking the floss.', 'http://adventures-in-making.com/wp-content/uploads/2016/01/embroidery-sampler-36.jpg'),
(4, 51, 1, 'To begin the right side of the pattern: Knit the first stitch of the row normally.', ''),
(4, 52, 2, 'Slip the next stitch knit-wise', 'https://i2.wp.com/thebluemouseknits.com/wp-content/uploads/2017/09/herringbone.tutorial-2.jpg?resize=1024%2C1024'),
(4, 53, 3, 'Knit the next stitch normally', 'https://i1.wp.com/thebluemouseknits.com/wp-content/uploads/2017/09/herringbone.tutorial-5.jpg?resize=1024%2C1024'),
(4, 54, 4, 'Now the last 2 stitches on your right hand needles are a slipped stitch and a knit stitch (as shown below).', 'https://i2.wp.com/thebluemouseknits.com/wp-content/uploads/2017/09/herringbone.tutorial-8.jpg?resize=1024%2C1024'),
(4, 55, 5, 'Next, take your left hand needle and insert it into the slipped stitch on the right hand needle as shown below.', 'https://i0.wp.com/thebluemouseknits.com/wp-content/uploads/2017/09/herringbone.tutorial-9.jpg?resize=1024%2C1024'),
(4, 56, 6, 'Lift that slipped stitch over the knit stitch next to it and off the right hand needle, but DON’T drop the stitch off the left hand needle, leave it there (as shown below).', 'https://i2.wp.com/thebluemouseknits.com/wp-content/uploads/2017/09/herringbone.tutorial-10.jpg?resize=1024%2C1024'),
(4, 57, 7, 'The stitches should look like the photo below.', 'https://i1.wp.com/thebluemouseknits.com/wp-content/uploads/2017/09/herringbone.tutorial-11.jpg?resize=1024%2C1024'),
(4, 58, 8, 'Next, insert the right hand needle into the back of the stitch on the left hand needle (the slipped stitch you just passed over).', 'https://i1.wp.com/thebluemouseknits.com/wp-content/uploads/2017/09/herringbone.tutorial-12.jpg?resize=1024%2C1024'),
(4, 59, 9, 'And knit it through the back loop (It’s like knitting the stitch normally, but you are inserting your needle into the back loop instead of the front which you have already set up for).', 'https://i0.wp.com/thebluemouseknits.com/wp-content/uploads/2017/09/herringbone.tutorial-15.jpg?resize=1024%2C1024'),
(4, 60, 10, 'Then slip the stitch you just worked into off of your left hand needle like you would when knitting normally. After you do so it should look like the photo below.', 'https://i2.wp.com/thebluemouseknits.com/wp-content/uploads/2017/09/herringbone.tutorial-16.jpg?resize=1024%2C1024'),
(4, 61, 11, 'You have just completed a repeat for the row. Repeat these steps again until you reach the last stitch in the row. Knit the last stitch normally.\r\n\r\nTurn your work and begin working the wrong side.', 'https://i0.wp.com/thebluemouseknits.com/wp-content/uploads/2017/09/herringbone.tutorial-20.jpg?resize=1024%2C1024'),
(4, 62, 12, 'Insert your right hand needle into the first 2 stitches on the left hand needle ', 'https://i0.wp.com/thebluemouseknits.com/wp-content/uploads/2017/09/herringbone.tutorial-21.jpg?resize=1024%2C1024'),
(4, 63, 13, 'Repeat these steps for the wrong side of your work through the end. Turn and repeat the steps for the right side again. You are only doing these 2 row repeats for the rest of your project. Pretty easy, right? It may take a little practice, but I’m sure you’ll have it down in no time!', 'https://i1.wp.com/thebluemouseknits.com/wp-content/uploads/2017/09/herringbone.tutorial-27.jpg?resize=1024%2C1024'),
(5, 64, 1, 'Gather all materials.', ''),
(5, 65, 2, 'Soak it up\r\n<br><br>\r\nIn a bowl large enough to hold the ball of yarn, mix cold tap water and vinegar together in a 4:1 ratio.\r\n<br><br>\r\nDrop the ball in the yarn, and gently squeeze out the air bubbles to ensure that even the inner most layers get the vinegar water, then weigh it down in the bowl.\r\n<br><br>\r\nSoak the ball for at least 30 minutes. It is important to do this step as it helps set the dye.', 'https://cdn.instructables.com/F19/N54B/IU2TPK2O/F19N54BIU2TPK2O.LARGE.jpg?width=467'),
(5, 66, 3, 'Mix it up\r\n<br><br>\r\nFill your pot with water and add at least a cup of vinegar - bring to a simmer.\r\n<br><br>\r\nAt this point you\'re ready to mix up your dye. My red colour is a mixture of Wilton black, red red, and rose pink. I didn\'t measure, I just dipped a stir stick into my dye, then stirred into the water, until I achieved the colour I wanted.\r\n<br><br>\r\nUse a clear cup to check the colour of the dye - It should be darker than you want the yarn to be.', 'https://cdn.instructables.com/FT7/2JDV/IU2TPLC2/FT72JDVIU2TPLC2.LARGE.jpg'),
(5, 67, 4, 'Colour it up\r\n<br><br>\r\nAt this point, your yarn should have been soaking for at least 30 minutes. Gently drain the water out of the ball of yarn by squeezing.\r\n<br><br>\r\nCarefully drop the yarn into the pot with your water, vinegar, and food colouring.\r\n<br><br>\r\nIf the ball isn\'t covered by water, add some of the vinegar water the ball was soaking in to your pot.', 'https://cdn.instructables.com/FB6/8HM2/IU2TPMX9/FB68HM2IU2TPMX9.LARGE.jpg?width=400'),
(5, 68, 5, 'Clean it up\r\n<br><br>\r\nOnce the colour makes you happy, remove the pot from heat and transfer to the sink. Slowly cool the water by running cold water into the pot. Avoid huge temperature shocks and too much agitation as those can felt your yarn.\r\n<br><br>\r\nAs the yarn ball becomes cool enough to handle, hold it directly under the cold running water and gently squeeze and rinse until the water runs clear.', 'https://cdn.instructables.com/FNW/U8C7/IU2TPJV7/FNWU8C7IU2TPJV7.LARGE.jpg?width=400'),
(5, 69, 6, 'Wrap it up\r\n<br><br>\r\nOnce your yarn is rinsed and drained, unwind the ball and wrap around chair legs - not too tight, or it will be impossible to remove - to dry.\r\n<br><br>\r\nTie each section with a small piece of scrap yarn in a contrasting colour - this keeps it from tangling.', 'https://cdn.instructables.com/FXX/EJOY/IU2TPMBE/FXXEJOYIU2TPMBE.LARGE.jpg?width=600'),
(5, 70, 7, 'Twist it up\r\n<br><br>\r\nCarefully remove the dried yarn from the chair legs, and twist your yarn into a beautiful skein and admire your handiwork before putting it to work!', 'https://cdn.instructables.com/F0T/P4SH/IU2TPW2D/F0TP4SHIU2TPW2D.LARGE.jpg?width=800'),
(6, 71, 1, 'Gather Your Materials.', 'https://cdn.instructables.com/FUI/RVJG/JE4KJMQT/FUIRVJGJE4KJMQT.LARGE.jpg'),
(6, 72, 2, 'Make the Pattern.\r\n<br><br>\r\nTo make the pattern find a sweater or loose Tshirt and put it on top of the paper.\r\n<br><br>\r\nWith the pen, draw the outline of the back, leave one inch as seam allowance.\r\n<br><br>\r\nWith that as a guide, make the front pieces, the arm curve should be the same, but make the neck line lower.\r\n<br><br>\r\nDo not cut that outline, cut at least 2 inches outside that outline, as shown in the picture. The only line that you have to cut is the bottom one.', 'https://cdn.instructables.com/FV6/0I1K/JE4KJMPS/FV60I1KJE4KJMPS.LARGE.jpg'),
(6, 73, 3, 'Make a Sandwich.\r\n<br><br>\r\nUsually, knitted sweaters have two different stitches on each side, pick the one you like the most and turn the sweater so that the one you donâ€™t want is facing you\r\n<br><br>\r\nWe will use the back of the sweater for our back piece and the front for our two front pieces, this way if you have a cardigan it will work too.\r\n<br><br>\r\nWe are going to take advantage of the lower edge of the sweater, align that edge with the bottom edge of your back pattern.\r\n<br><br>\r\nAt the back put the lining fabric, good side facing the sweater, with 1 1/2â€³ folded at the bottom.\r\n<br><br>\r\nNow pin the three layers; at the top the paper, then the sweater, then the lining.\r\n<br><br>\r\nNote that because we havenâ€™t cut the sweater, thereâ€™s another layer of sweater at the bottom (the front of the sweater) just donâ€™t pin it with the other three layers. ', 'https://cdn.instructables.com/F0J/13FM/JE4KJMO7/F0J13FMJE4KJMO7.LARGE.jpg'),
(6, 74, 4, 'Sew.\r\n<br><br>\r\nNow sew through the line using a zig zag stitch. With the lining fabric below and the paper above, sewing the knitted fabric is very easy, you wonâ€™t even need a special foot.\r\n<br><br>\r\nDo not sew at the bottom.', 'https://cdn.instructables.com/FRT/JM5I/JE4KJMNX/FRTJM5IJE4KJMNX.LARGE.jpg'),
(6, 75, 5, 'Finish the Back.\r\n<br><br>\r\nNow pull out the paper, if you pull both sides of the seam at the same time it wonâ€™t leave a lot of paper. It doesnâ€™t matter if thereâ€™s a little bit of paper, but if you want you can use the water soluble paper that quilters use.\r\n<br><br>\r\nCut the back piece leaving 1/4â€³ outside the seam.\r\n<br><br>\r\nThrough the opening at the bottom turn the back piece good side out.', 'https://cdn.instructables.com/FNH/UU2W/JE4KJMNJ/FNHUU2WJE4KJMNJ.LARGE.jpg'),
(6, 76, 6, 'Make the Front Pieces.\r\n<br><br>\r\nNow that we are handling the cut sweater, we have to be careful or it can unravel. So, try not to move it a lot.\r\n<br><br>\r\nMake the sandwich the same way, with the paper on top, then the knitted fabric and then the lining. Remember that the good sides of the fabrics should be facing each other.\r\n<br><br>\r\nPin it, sew it, take off the paper and turn.', 'https://cdn.instructables.com/FGX/XYGW/JE4KJMMX/FGXXYGWJE4KJMMX.LARGE.jpg'),
(6, 77, 7, 'Assemble the Vest.\r\n<br><br>\r\nNow sew the sides of the vest, joining the back and the front pieces.\r\n<br><br>\r\nThen sew the shoulders.', 'https://cdn.instructables.com/FWY/27TF/JE4KJMMU/FWY27TFJE4KJMMU.LARGE.jpg'),
(6, 78, 8, 'Batting.\r\n<br><br>\r\nUse the vest as a guide to cut three pieces of batting (1 back and 2 front).\r\n<br><br>\r\nInsert the batting through the bottom.\r\n<br><br>\r\nTo make it stay in place even after washing the vest, we are going to make some stitches a the top of each piece (near to the shoulder) and at the bottom. Sewing the batting only to the lining.', 'https://cdn.instructables.com/F0H/CZHA/JE4KJMMR/F0HCZHAJE4KJMMR.LARGE.jpg'),
(6, 79, 9, 'Finishing Touches.\r\n<br><br>\r\nWith the sewing machine, using a regular stitch, youâ€™ll have to sew all the bottom.\r\n<br><br>\r\nOf you would like to add some horizontal stitches (like the typical puffer vest), you can make them now (and skip the hand sewing). I like mine the way it is now so Iâ€™ll leave it this way.\r\n<br><br>\r\nFinally add a button on one side and a thin elastic on the other, or clasp and the puffer vest is ready!', 'https://cdn.instructables.com/FLF/VB0R/JE4KJMML/FLFVB0RJE4KJMML.LARGE.jpg'),
(6, 80, 10, 'Have Fun!\r\n<br><br>\r\nAs with every versatile garment, the most fun part is making outfits with the clothes that you already have in your wardrobe. I highly recommend this vest in gray, it goes with everything!', 'https://cdn.instructables.com/FIL/LZYO/JE4KJMMD/FILLZYOJE4KJMMD.LARGE.jpg?'),
(7, 101, 1, 'Gather the tools and materials listed above.', ''),
(7, 102, 2, 'Cut out the felt pieces according to the pattern', ''),
(7, 103, 3, 'Blanket stitch the sides of the tusk, then use a dowel to stuff polyfill in as you sew.', ''),
(7, 104, 4, 'Blanket stitch the fins, then stuff with polyfill. Use a dowel if needed.', ''),
(7, 105, 5, 'Blanket stitch the middle of each body piece.', ''),
(7, 106, 6, 'Lightly glue in the tusk and fins to the sides of the white bottom piece.', ''),
(7, 107, 7, 'Sew the button eyes to the gray top piece.', ''),
(7, 108, 8, 'Blanket stitch the two body pieces together leaving an opening.', ''),
(7, 109, 9, 'Stuff the narwhal body with polyfill. Use a dowel if needed.', ''),
(7, 110, 10, 'Draw dots on the fins and the back of the body with a black art marker.', 'https://s3-us-west-2.amazonaws.com/lia-griffith-media/wp-content/uploads/2017/10/FeltNarwhal_Tutorial.jpg'),
(23, 111, 1, 'Press your fabric and cut out the pattern pieces using fabric scissors. Remember not to mix up your scissors! You donâ€™t want to dull the blade of your fabric only scissors by using them to cut paper.', ''),
(23, 112, 2, 'Use a cotton fabric of your choice to cut out pattern pieces A + B. Then choose a coordinating cotton fabric to cut out pattern piece C. Use red felt to cut out pattern piece D and yellow felt to cut out E (as shown below).', 'http://adventures-in-making.com/wp-content/uploads/2016/03/chicken-plushies-1.jpg'),
(23, 113, 3, 'Once you have your pieces cut, lay the first pattern piece A (with right side facing up) onto your work surface. Place the felt pieces D + E on top as shown below. Then place pattern piece B (right side facing down) as shown and secure with a pin.', 'http://adventures-in-making.com/wp-content/uploads/2016/03/chicken-plushies-3.jpg'),
(23, 114, 4, 'Sew along the edge to secure the felt pieces and pattern piece B into place.', 'http://adventures-in-making.com/wp-content/uploads/2016/03/chicken-plushies-4.jpg'),
(23, 115, 5, 'Next place the second pattern piece A directly on top (right side facing down). Pin in place and then flip over.', 'http://adventures-in-making.com/wp-content/uploads/2016/03/chicken-plushies-5.jpg'),
(23, 116, 6, 'lip up the bottom (sewn side) of piece B and pin the un-sewn side into place as shown in the photo below.', 'http://adventures-in-making.com/wp-content/uploads/2016/03/chicken-plushies-6.jpg'),
(23, 117, 7, 'Sew all the way around the outside leaving about a Â½â€ opening near the top or neck of the bird. Make small cuts in the fabric (making sure not to cut through your stitches) as shown below.', 'http://adventures-in-making.com/wp-content/uploads/2016/03/chicken-plushies-7.jpg'),
(23, 118, 8, 'Then cut a few notches where indicated on the pattern (this will prevent the fabric from puckering once we turn the fabric right side out).', 'http://adventures-in-making.com/wp-content/uploads/2016/03/chicken-plushies-8.jpg'),
(23, 119, 9, 'Now youâ€™re ready to turn the fabric right side out and stuff with fiberfill. Use the end of a pencil to turn out completely and stuff.', 'http://adventures-in-making.com/wp-content/uploads/2016/03/chicken-plushies-9.jpg'),
(23, 120, 10, 'Use a needle and thread to whip stitch the opening closed. Set the bird body aside.\r\n<br><br>\r\nNow itâ€™s time to sew the wings. Place two pattern piece Câ€™s together (right sides face in). Sew around leaving a small opening. Turn right side out and whip stitch the opening closed. Repeat for the second wing.', 'http://adventures-in-making.com/wp-content/uploads/2016/03/chicken-plushies-10.jpg'),
(23, 121, 11, 'Thread your needle with a matching thread and stitch the wings onto the body of the bird as shown in the photo below.', 'http://adventures-in-making.com/wp-content/uploads/2016/03/chicken-plushies-11.jpg'),
(23, 122, 12, 'Cut a length of embroidery floss. Divide the strands into 3 plys and thread onto a needle. Poke your needle behind a wing (to hide your knot) and come up near the top where you want to start your first eye. Use a straight stitch to add a U shape eye on one side of the bird. Then poke your needle through to the other side and stitch the second eye. Hide the end of your thread by poking your needle back through the bird and coming out farther down near a seam. Cut off excess thread with scissors.', 'http://adventures-in-making.com/wp-content/uploads/2016/03/chicken-plushies-12.jpg'),
(23, 123, 13, 'And youâ€™re done! Make a few to decorate your home this spring or gift them to your chicken-loving friends and family this Easter!', 'http://adventures-in-making.com/wp-content/uploads/2016/03/chicken-plushies-24b.jpg'),
(24, 124, 1, 'Prepare all materials', 'http://adventures-in-making.com/wp-content/uploads/2016/01/IMG_4290_hearttargetpincushion.jpg'),
(24, 125, 2, 'First use the â€œWrist Guardâ€ template piece to cut a small heart out of chipboard. This will be place inside the pincushion to keep you from pushing pins all the way through. Use your favorite adhesive to attach one magnet to this piece of chipboard.', 'http://adventures-in-making.com/wp-content/uploads/2016/01/IMG_4294_hearttargetpincushion.jpg'),
(24, 126, 3, 'Next tape a small piece of white felt to the template sheet and use a window to trace the rings of the target shape with your black marker. You may need to go over it a few times to make the rings as dark as possible.\r\n\r\n', 'http://adventures-in-making.com/wp-content/uploads/2016/01/IMG_4304_hearttargetpincushion.jpg'),
(24, 127, 4, 'Set this piece aside for a moment to dry or you will end up with marker all over your hands. (Which is fun!) While you are waiting, use the â€œHeartâ€ template to cut two red heart pieces, then when the target is dry cut just outside of the first dark ring. Keep all your little fabric scraps for the stuffing steps later. (Waste not, want not and all that.)', 'http://adventures-in-making.com/wp-content/uploads/2016/01/IMG_4314_hearttargetpincushion.jpg'),
(24, 128, 5, 'Place the target piece in the center of one of the heart pieces and pinch or pin them together. Using black thread or embroidery floss whip the target down to attach it to the pincushion. (I used a blanket appliquÃ© stitch around my target, similar to the one Rachel used in her Alphabet Hoop Art DIY . You can watch a video of how it is done here. If this looks tricky to you, use any old stitch you want!)', 'http://adventures-in-making.com/wp-content/uploads/2016/01/IMG_4315_hearttargetpincushion.jpg'),
(24, 129, 6, 'When the target is all stitched down make a sandwich with the remaining pieces: target+heart piece, chipboard+magnet piece, plain heart piece.', 'http://adventures-in-making.com/wp-content/uploads/2016/01/IMG_4317_hearttargetpincushion.jpg'),
(24, 130, 7, 'Then use thread (or floss) to stitch the two red felt heart pieces together, beginning at the top of one side. (For this stitching I used a blanket stitch. You can see a video of a pro doing it here. Any stitch should work to make this little pillow, so play around with it!)\r\n\r\n', 'http://adventures-in-making.com/wp-content/uploads/2016/01/IMG_4326_hearttargetpincushion.jpg'),
(24, 131, 8, 'When you reach the top of the other side of the heart, stop sewing and collect your scraps to stuff. Any large scraps can be cut into tinier pieces that will fluff up the inside of you cushion.', 'http://adventures-in-making.com/wp-content/uploads/2016/01/IMG_4327_hearttargetpincushion.jpg'),
(24, 132, 9, 'Start to fill the space between the chipboard wrist guard and the heart+target piece, using a little bit of stuffing at a time. Make sure to press into the point and sides of your heart to make it really puff.', 'http://adventures-in-making.com/wp-content/uploads/2016/01/IMG_4331_hearttargetpincushion.jpg'),
(24, 133, 10, 'When youâ€™ve got it almost over-full stitch up the remaining open space and tie a firm knot. Tuck your thread-end into the heart or trim it and youâ€™re all done!', 'http://adventures-in-making.com/wp-content/uploads/2016/01/IMG_4380_hearttargetpincushion.jpg'),
(24, 134, 11, 'So, why did I have you include a magnet? Because magnets are awesome! If youâ€™re prone to losing straight pins like a startled porcupine loses quills youâ€™ll appreciate the pin collecting magic of a strong magnet. Have a magnetic board or fridge in your making space? Smack your pincushion there for safe keeping!', 'http://adventures-in-making.com/wp-content/uploads/2016/01/IMG_4329_hearttargetpincushion.jpg'),
(24, 135, 12, 'you can make a magnetic wrist band. Cut a piece of elastic a little bit smaller than your wrist, and glue a magnet to one end. Sew the two ends together to form a loop, stitching around the magnet.\r\n\r\n', 'http://adventures-in-making.com/wp-content/uploads/2016/01/IMG_4335_hearttargetpincushion.jpg'),
(24, 136, 13, 'Then you should be able to attach your pincushion temporarily to your wrist whenever itâ€™s convenient.', 'http://adventures-in-making.com/wp-content/uploads/2016/01/IMG_4376_hearttargetpincushion.jpg'),
(25, 137, 1, 'My first tip is to do it outdoors and wear old clothes. Itâ€™s a messy process so approach it as you would a painting project and protect the things you love.', ''),
(25, 138, 2, 'My second tip is to hang your pieces on a clothes line as they come out of the dye so they will have space to oxidize. ', ''),
(25, 139, 3, 'My third tip is to feel free to re-dip some of your pieces to achieve a darker tone. ', 'https://s3-us-west-2.amazonaws.com/lia-griffith-media/wp-content/uploads/2015/07/IndigoToteBagTutorial.jpg');

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
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `materialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `userID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projectID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `steps`
--
ALTER TABLE `steps`
  MODIFY `stepID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
