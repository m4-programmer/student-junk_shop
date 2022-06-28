-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2022 at 03:56 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `junk_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_viewed` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `date_viewed`) VALUES
(1, 4, 53, 1, ''),
(2, 4, 8, 1, ''),
(3, 4, 47, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cat_slug` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `cat_slug`) VALUES
(1, 'Kitchen Utensil', 'kitchen-utensil'),
(2, 'Electrical Appliance', 'electrical-appliance'),
(3, 'Cooking Appliance', 'cooking-appliance'),
(4, 'Reading Equipment', 'reading-equipment'),
(5, 'Others', 'others'),
(6, 'Sleeping Equipment', 'sleeping-equipment');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `sold` enum('yes','no') NOT NULL DEFAULT 'no',
  `photo` varchar(200) NOT NULL,
  `date_view` date NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `category_id`, `name`, `description`, `slug`, `price`, `sold`, `photo`, `date_view`, `counter`) VALUES
(1, 7, 1, 'ceramic flat plate and soup bowl 6pcs', '<p>This is a very strong ceramic plate. it has a very good durability and it is very professional for student&#39;s to use</p>\r\n', 'ceramic-flat-plate-and-soup-bowl-6pcs', 4000, 'no', 'ceramic-flat-plate-and-soup-bowl-6pcs_1656408017.jpg', '2022-06-28', 5),
(2, 2, 1, 'dinner plates (4 in 1 set)', '<p>This plate is of high quality and has the following features:</p>\r\n\r\n<ul>\r\n	<li>it is unbreakable</li>\r\n	<li>it is easy to wash</li>\r\n	<li>it is in good shape and conditions.</li>\r\n	<li>you will enjoy buying it</li>\r\n</ul>\r\n', 'dinner-plates-4-1-set', 5000, 'no', 'dinner-plates-4-1-set.jpg', '2022-06-28', 3),
(3, 3, 1, 'Gold cutlery set (6pcs of spoons and Forks)', '<p>This is a quality Gold spoon, that can be used for eating.</p>\r\n\r\n<p>it will add colour to your kitchen and house.</p>\r\n\r\n<p>it has many advantages, such as:</p>\r\n\r\n<ol>\r\n	<li>the gold does not worn out.</li>\r\n	<li>it has no expiry date.</li>\r\n	<li>it is easy to wash</li>\r\n</ol>\r\n', 'gold-cutlery-set-6pcs-of-spoons-and-forks', 7000, 'no', 'gold-cutlery-set.jpg', '0000-00-00', 0),
(4, 3, 1, 'Double Layer Plate-Dish Rack With Cover', '<p>You can use it to put your plates, spoons, forks and any kitchen utensil</p>\r\n', 'double-layer-plate-dish-rack-cover', 5400, 'no', 'double-layer-plate-dish-rack-cover.jpg', '2022-06-28', 1),
(5, 3, 1, 'plates and cup', '<ul>\r\n	<li>10 pcs of plates</li>\r\n	<li>4 pcs of deep cup</li>\r\n	<li>5pcs of rounded cup</li>\r\n</ul>\r\n\r\n<p>All for #3900</p>\r\n', 'plates-and-cup', 3900, 'no', 'plates-and-cup.jpg', '2022-06-28', 1),
(6, 3, 3, 'kerosene stove (BIG)', '<p>This stove is still in goodd health</p>\r\n', 'kerosene-stove-big', 4600, 'no', 'kerosene-stove-big.jpg', '2022-06-28', 2),
(7, 7, 1, 'plates and spoon holder', '<p>It is very good</p>\r\n', 'plates-and-spoon-holder', 2000, 'no', 'plates-and-spoon-holder.jpg', '0000-00-00', 0),
(8, 7, 1, '5 pcs of deep and flat plates', '<p>5 pcs of deep and flat plates</p>\r\n', '5-pcs-of-deep-and-flat-plates', 4000, 'no', '5-pcs-of-deep-and-flat-plates.jpg', '2022-06-28', 2),
(9, 7, 2, 'Ceiling Fan', '<p>Nice Ceiling Fan</p>\r\n', 'ceiling-fan', 6000, 'no', 'ceiling-fan.jpg', '0000-00-00', 0),
(10, 7, 2, 'Brand New Standing Fan', '<p>Brand New Standing Fan</p>\r\n', 'brand-new-standing-fan', 10000, 'no', 'brand-new-standing-fan.jpg', '0000-00-00', 0),
(11, 7, 2, 'Hanging Fan', '<p>Hanging Fan</p>\r\n', 'hanging-fan', 8000, 'no', 'hanging-fan.jpg', '2022-06-28', 1),
(12, 7, 2, 'Small Table Fan', '<p>Small Table Fan</p>\r\n', 'small-table-fan', 7800, 'no', 'small-table-fan.jpg', '0000-00-00', 0),
(13, 7, 2, '3 blade standing fan', '<p>3 blade standing fan</p>\r\n', '3-blade-standing-fan', 6000, 'no', '3-blade-standing-fan.jpg', '2022-06-28', 2),
(14, 2, 2, '5 blade standing Fan', '<p>5 blade standing Fan</p>\r\n', '5-blade-standing-fan', 11000, 'no', '5-blade-standing-fan.jpg', '0000-00-00', 0),
(15, 2, 2, 'blue electric iron', '<p>blue electric iron</p>\r\n', 'blue-electric-iron', 5500, 'no', 'blue-electric-iron.jpg', '0000-00-00', 0),
(16, 2, 2, 'iron pressing board', '<p>iron pressing board</p>\r\n', 'iron-pressing-board', 3000, 'no', 'iron-pressing-board.jpg', '2022-06-28', 1),
(17, 3, 2, 'table fan and solar panel', '<p>table fan and solar panel</p>\r\n', 'table-fan-and-solar-panel', 15000, 'no', 'table-fan-and-solar-panel.jpg', '0000-00-00', 0),
(18, 3, 2, 'pink pressing iron', '<p>pink pressing iron</p>\r\n', 'pink-pressing-iron', 7050, 'no', 'pink-pressing-iron.jpg', '0000-00-00', 0),
(19, 3, 2, 'Red Generator', '<p>Red Generator</p>\r\n', 'red-generator', 60000, 'no', 'red-generator.jpg', '0000-00-00', 0),
(20, 2, 2, 'light blue iron', '<p>light blue iron</p>\r\n', 'light-blue-iron', 12000, 'no', 'light-blue-iron.jpg', '0000-00-00', 0),
(21, 2, 2, 'yellow big generator', '<p>yellow big generator</p>\r\n', 'yellow-big-generator', 80500, 'no', 'yellow-big-generator.jpg', '0000-00-00', 0),
(22, 7, 2, 'blue generator with Tire', '<p>blue generator with Tire</p>\r\n', 'blue-generator-tire', 100000, 'no', 'blue-generator-tire.jpg', '0000-00-00', 0),
(23, 2, 2, 'Big Tired Yellow Generator', '<p>Big Tired Yellow Generator</p>\r\n', 'big-tired-yellow-generator', 120000, 'no', 'big-tired-yellow-generator.jpg', '0000-00-00', 0),
(24, 2, 2, '2 blade fast fan', '<p>2 blade fast fan</p>\r\n', '2-blade-fast-fan', 6600, 'no', '2-blade-fast-fan.jpg', '0000-00-00', 0),
(25, 3, 3, '2 in 1 gold hot plate', '<p>2 in 1 gold hot plate</p>\r\n', '2-1-gold-hot-plate', 6000, 'no', '2-1-gold-hot-plate.jpg', '0000-00-00', 0),
(26, 2, 3, 'white electric hot plate', '<p>white electric hot plate</p>\r\n', 'white-electric-hot-plate', 6000, 'no', 'white-electric-hot-plate.jpg', '0000-00-00', 0),
(27, 2, 3, '2 in 1 white hot plate', '<p>2 in 1 white hot plate</p>\r\n', '2-1-white-hot-plate', 8000, 'no', '2-1-white-hot-plate.jpg', '0000-00-00', 0),
(28, 2, 3, 'medium kerosene stove', '<p>medium kerosene stove</p>\r\n', 'medium-kerosene-stove', 3600, 'no', 'medium-kerosene-stove.jpg', '0000-00-00', 0),
(29, 7, 3, 'Brand new Hot plate', '<p>Brand new Hot plate</p>\r\n', 'brand-new-hot-plate', 8900, 'no', 'brand-new-hot-plate.jpg', '0000-00-00', 0),
(30, 7, 3, '2 in 1 hot plate', '<p>2 in 1 hot plate</p>\r\n', '2-1-hot-plate', 9700, 'no', '2-1-hot-plate.jpg', '0000-00-00', 0),
(31, 7, 3, 'table-top-gas-cooker', '<p>table-top-gas-cooker</p>\r\n', 'table-top-gas-cooker', 11000, 'no', 'table-top-gas-cooker.jpg', '2022-06-28', 1),
(32, 7, 4, 'Glass table', '<p>Glass table</p>\r\n', 'glass-table', 8700, 'no', 'glass-table.jpg', '0000-00-00', 0),
(33, 2, 4, 'glass center table', '<p>glass center table</p>\r\n', 'glass-center-table', 13000, 'no', 'glass-center-table.jpg', '0000-00-00', 0),
(34, 5, 4, 'Wooden reading table', '<ul>\r\n	<li>Wooden reading table</li>\r\n	<li>can be used while lying on the bed</li>\r\n</ul>\r\n', 'wooden-reading-table', 6400, 'no', 'wooden-reading-table.jpg', '0000-00-00', 0),
(35, 5, 4, 'Plastic Table (medium)', '<p>Plastic Table (medium)</p>\r\n', 'plastic-table-medium', 3500, 'no', 'plastic-table-medium.jpg', '2022-06-28', 2),
(36, 7, 5, 'Dinner Table', '<p>Dinner Table</p>\r\n', 'dinner-table', 10000, 'no', 'dinner-table.jpg', '2022-06-28', 1),
(37, 7, 4, 'Center Table', '<p>Center Table</p>\r\n', 'center-table', 9500, 'no', 'center-table.jpg', '0000-00-00', 0),
(38, 5, 4, '1 table 1 chair', '<p>1 pcs table x 1 pcs chair</p>\r\n', '1-table-1-chair', 11300, 'no', '1-table-1-chair.jpg', '0000-00-00', 0),
(39, 5, 4, '1 pcs Plastic chair', '<p>1 pcs of Plastic chair</p>\r\n', '1-pcs-plastic-chair', 4300, 'no', '1-pcs-plastic-chair.jpg', '0000-00-00', 0),
(40, 5, 5, '5 layers shoe rack', '<p>5 layers shoe rack</p>\r\n', '5-layers-shoe-rack', 7800, 'no', '5-layers-shoe-rack.jpg', '0000-00-00', 0),
(41, 5, 1, 'Kitchen Cupboard', '<p>Kitchen Cupboard</p>\r\n', 'kitchen-cupboard', 5000, 'no', 'kitchen-cupboard.jpg', '0000-00-00', 0),
(42, 5, 4, 'small book shelf', '<p>small book shelf</p>\r\n', 'small-book-shelf', 6400, 'no', 'small-book-shelf.jpg', '0000-00-00', 0),
(43, 5, 4, 'reading lamp', '<p>reading lamp</p>\r\n', 'reading-lamp', 4500, 'no', 'reading-lamp.jpg', '0000-00-00', 0),
(44, 5, 5, 'Wall Mirror', '<p>Wall Mirror</p>\r\n', 'wall-mirror', 1500, 'no', 'wall-mirror.jpg', '0000-00-00', 0),
(45, 5, 5, '12 pcs of Hanger', '<p>12 pcs of Hanger</p>\r\n', '12-pcs-of-hanger', 2500, 'no', '12-pcs-of-hanger.jpg', '0000-00-00', 0),
(46, 5, 5, 'wonder hanger', '<p>wonder hanger</p>\r\n', 'wonder-hanger', 4300, 'no', 'wonder-hanger.jpg', '0000-00-00', 0),
(47, 3, 4, '3pcs of plastic chairs', '<blockquote>\r\n<p>3pcs of plastic chairs</p>\r\n</blockquote>\r\n', '3pcs-of-plastic-chairs', 6700, 'no', '3pcs-of-plastic-chairs.jpg', '2022-06-28', 3),
(48, 4, 4, 'handless plastic chair', '<p>handless plastic chair</p>\r\n', 'handless-plastic-chair', 6000, 'no', 'handless-plastic-chair.jpg', '0000-00-00', 0),
(49, 4, 4, 'black reading lamp', '<p>black reading lamp</p>\r\n', 'black-reading-lamp', 4000, 'no', 'black-reading-lamp.jpg', '0000-00-00', 0),
(50, 6, 4, 'handful chair', '<p>handful chair<a id=\"chair\" name=\"chair\"></a></p>\r\n', 'handful-chair', 3000, 'no', 'handful-chair.jpg', '0000-00-00', 0),
(51, 6, 2, '5 pcs of energy bulb', '<p>5 pcs of energy bulb</p>\r\n', '5-pcs-of-energy-bulb', 5000, 'no', '5-pcs-of-energy-bulb.jpg', '0000-00-00', 0),
(52, 6, 4, 'blue reading lamp', '<p>blue reading lamp</p>\r\n\r\n<hr />\r\n<p>&nbsp;</p>\r\n', 'blue-reading-lamp', 3400, 'no', 'blue-reading-lamp.jpg', '0000-00-00', 0),
(53, 6, 4, 'book shelve', '<p>book shelve</p>\r\n', 'book-shelve', 4500, 'no', 'book-shelve.jpg', '2022-06-28', 7),
(54, 4, 4, 'energic lamp', '<p>energic lamp</p>\r\n\r\n<hr />\r\n<p>&nbsp;</p>\r\n', 'energic-lamp', 4000, 'no', 'energic-lamp.jpg', '0000-00-00', 0),
(55, 4, 4, 'book shelve', '<p>Book shelve</p>\r\n', 'book-shelve', 6000, 'no', 'book-shelve.jpg', '0000-00-00', 0),
(56, 6, 5, 'cloth hanger and shoe rack', '<p>cloth hanger and shoe rack</p>\r\n', 'cloth-hanger-and-shoe-rack', 7000, 'no', 'cloth-hanger-and-shoe-rack.jpg', '0000-00-00', 0),
(57, 6, 5, 'wall mirror', '<p>wall mirror</p>\r\n', 'wall-mirror', 3800, 'no', 'wall-mirror.jpg', '0000-00-00', 0),
(58, 6, 5, 'cloth dryer', '<p>cloth dryer</p>\r\n', 'cloth-dryer', 4000, 'no', 'cloth-dryer.jpg', '0000-00-00', 0),
(59, 4, 5, 'fancy wall mirror', '<p>fancy wall mirror</p>\r\n', 'fancy-wall-mirror', 4300, 'no', 'fancy-wall-mirror.jpg', '0000-00-00', 0),
(60, 4, 5, 'cloth hanger', '<p>cloth hanger</p>\r\n', 'cloth-hanger', 3600, 'no', 'cloth-hanger.jpg', '0000-00-00', 0),
(61, 4, 5, 'medium mirror', '<p>medium mirror</p>\r\n', 'medium-mirror', 2300, 'no', 'medium-mirror.jpg', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `type` int(1) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `whatsapp` varchar(70) DEFAULT NULL,
  `my_product` int(5) NOT NULL DEFAULT 0,
  `photo` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `firstname`, `lastname`, `address`, `contact_info`, `whatsapp`, `my_product`, `photo`, `status`, `created_on`) VALUES
(1, 'admin@admin.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'Admin', 'Admin', 'Behind Flat', '1123112342342343', NULL, 0, 'card-1.0492a641.png', 1, '2018-05-01'),
(2, 'miraboy13@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'Adolphus', 'Miracle', 'Odims', '08127872082', NULL, 12, '2011_cowboys_and_aliens-1680x1050.jpg', 1, '2022-06-13'),
(3, 'dav120@a.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'Liberty', 'Dolpe', 'hilltop side', '08123783923', 'web.whatsapp.com', 9, '2010_the_expendables_movie-1600x1200.jpg', 1, '2022-06-18'),
(4, 'edoka@a.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'Mathias', 'Edoka', 'hilltop', '08023454321', NULL, 7, '', 1, '2022-06-18'),
(5, 'mia@a.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'Excel', 'Mia', 'behind flat', '123456789', NULL, 11, '', 1, '2022-06-18'),
(6, 'test@a.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'Test', 'Tesla123', 'Green House', '12345', NULL, 7, '', 1, '2022-06-23'),
(7, 'gift@a.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'Gift', 'Daniel', 'hilltop', '08127872082', NULL, 15, 'devil_may_cry_4-1920x1080.jpg', 1, '2022-06-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
