-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2021 at 05:27 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(50) NOT NULL,
  `item_id` int(50) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `item_id`, `item_name`, `price`) VALUES
(7, 7, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `email` varchar(50) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deliverydriver`
--

CREATE TABLE `deliverydriver` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nic` varchar(10) NOT NULL,
  `license` varchar(20) NOT NULL,
  `contact` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliverydriver`
--

INSERT INTO `deliverydriver` (`id`, `username`, `nic`, `license`, `contact`, `email`, `password`, `status`) VALUES
(66, ' driver ', '982670080V', 'B123458', 771234567, 'driver1@gmail.com', '$2y$10$pM4PvVH8NhckWMtUjcfZX.KBI8HXCwu4CbBYK0y3L1e3tkBlYR2ya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `foodName` varchar(30) NOT NULL,
  `calories` int(11) NOT NULL,
  `protein` float NOT NULL,
  `fat` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `foodName`, `calories`, `protein`, `fat`) VALUES
(15, 'Brinjal', 26, 1.2, 0.2),
(16, 'Carrot', 40, 1.1, 0.2),
(17, 'Mango', 65, 0.7, 0.3),
(18, 'Cabbage', 27, 1.8, 0.1),
(19, 'Barley', 346, 9, 1.4),
(20, 'potato', 82, 2, 0.1),
(21, 'Buscuits', 435, 7.4, 13.2),
(22, 'Jack beans', 353, 22, 3.9),
(23, 'Bread', 245, 7.8, 1.4),
(26, 'rice', 357, 7.5, 1.8);

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `inbox_id` int(30) NOT NULL,
  `from_id` int(20) NOT NULL,
  `to_id` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`inbox_id`, `from_id`, `to_id`, `email`, `subject`, `message`, `status`) VALUES
(12, 17, 1, 'nutritionist@gmail.com', 'regarding password', 'password cannot change', 1),
(17, 17, 1, 'nutritionist@gmail.com', 'Renew Medical ID', 'I renew my medical id and changed it on the system', 0),
(20, 44, 2, 'shifnasfk@gmail.com', 'fssdsdsd', 'ddsdddsdsddss', 1),
(21, 44, 2, 'shifnasfk@gmail.com', 'dfdsfsfsdfs', 'fsfsdfdfsd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mealplan`
--

CREATE TABLE `mealplan` (
  `request_id` int(30) NOT NULL,
  `meal_type` varchar(50) NOT NULL,
  `food` varchar(50) NOT NULL,
  `quantity` int(255) NOT NULL,
  `mealplan_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mealplan`
--

INSERT INTO `mealplan` (`request_id`, `meal_type`, `food`, `quantity`, `mealplan_id`) VALUES
(14, 'breakfast', 'rice', 100, 20),
(14, 'breakfast', 'Brinjal', 56, 21),
(14, 'breakfast', 'potato', 30, 22),
(14, 'lunch', 'rice', 30, 23),
(18, 'breakfast', 'Barley', 300, 24),
(18, 'lunch', 'rice', 300, 25),
(18, 'lunch', 'potato', 45, 26),
(18, 'dinner', 'Jack beans', 89, 27);

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

CREATE TABLE `menu_item` (
  `id` int(11) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `image` varchar(250) NOT NULL,
  `res_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_item`
--

INSERT INTO `menu_item` (`id`, `item_name`, `description`, `price`, `image`, `res_id`) VALUES
(1, 'Chettinad Prawn Masala', 'Boasting a fine, red hue, it is gushed with spices, and had about fifteen fat, deshelled prawns, cooked to perfection in a rich, creamy gravy. There is a nice balance between sweet and spicy elements, and a lot of masala taste. ', 800.00, 'assets/uploads/Chettinad Prawn Masala.jpg', 20),
(2, 'Garlic Naan', 'Crispy, warm, and delivered the promised flavours. it has lots and lots of smashed up paneer in its entire inner surface.', 140.00, 'assets/uploads/Paneer Naan.jpg', 20),
(16, 'Chocolate Surprise Donut', 'Buy 6 x 2 regular Free (Premium Donuts)', 200.00, 'assets/uploads/Chocolate Surprise Donut.jpeg', 64),
(17, 'Elephant House Regular Hot Dog', 'Buy 3 x 1 regular Free (Premium Donuts)', 210.00, 'assets/uploads/Elephant House Regular Hot Dog.jpeg', 64),
(18, 'Maguro', 'Slice of Fresh tuna served with Japanese horseradish and pickled ginger.', 1850.00, 'assets/uploads/Maguro.jpg', 65),
(19, 'Salmon', 'Slices of fresh salmon served with Japanese horseradish and pickled ginger.', 2550.00, 'assets/uploads/Salmon.jpg', 65),
(20, 'Modha', 'Slices of fresh modha fish served with Japanese horseradish and pickled ginger.', 990.00, 'assets/uploads/Modha.jpg', 65);

-- --------------------------------------------------------

--
-- Table structure for table `nutritionist`
--

CREATE TABLE `nutritionist` (
  `user_id` int(30) NOT NULL,
  `medical_id` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `tele_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nutritionist`
--

INSERT INTO `nutritionist` (`user_id`, `medical_id`, `name`, `username`, `email`, `password`, `tele_no`) VALUES
(17, ' 20171011', 'Dr.Anura Seneviratne', 'nutritionist', 'nutritionist123@gmail.com', '$2y$10$tjmDDtA4mzLbUuERY07G9OwCvel5U3XXs/WVPAtek8lgJkKi3HjL.', '0772020027');

-- --------------------------------------------------------

--
-- Table structure for table `orderd`
--

CREATE TABLE `orderd` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderd`
--

INSERT INTO `orderd` (`id`, `order_id`, `menu_item_id`, `qty`, `price`) VALUES
(1, 1, 1, 2, 300),
(2, 1, 2, 3, 400);

-- --------------------------------------------------------

--
-- Table structure for table `orderh`
--

CREATE TABLE `orderh` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(250) NOT NULL,
  `ddate` date NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `driver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderh`
--

INSERT INTO `orderh` (`id`, `customer_name`, `ddate`, `accepted`, `driver_id`) VALUES
(1, 'Pathmika', '2021-03-01', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image` varchar(100) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `description`, `image`, `user_id`) VALUES
(28, 'Health related tips', 'This post is for food bloggers and food blog readers alike! My hope here is just to bring up a little think/talk/virtual coffee date sesh about what food bloggers should write about. ', 'assets/posts/Health-Tip.jpg', 17),
(33, '	\r\nRecipe tips\r\n', 'This post is for food bloggers and food blog readers alike! My hope here is just to bring up a little think/talk/virtual coffee date sesh about what food bloggers should write about.', '	\r\nassets/posts/Health-Tip.jpg', 20),
(34, 'Cooking Tips', 'This post is for food bloggers and food blog readers alike! My hope here is just to bring up a little think/talk/virtual coffee date sesh about what food bloggers should write about.', '	\r\n	\r\nassets/posts/img1.jpg', 44),
(35, 'Tasty Recipe', 'This post is for food bloggers and food blog readers alike! My hope here is just to bring up a little think/talk/virtual coffee date sesh about what food bloggers should write about.', '	\r\nassets/posts/img2.jpg', 45);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `reply_id` int(30) NOT NULL,
  `inbox_id` int(30) NOT NULL,
  `from_id` int(30) NOT NULL,
  `to_id` int(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `reply` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`reply_id`, `inbox_id`, `from_id`, `to_id`, `email`, `subject`, `reply`) VALUES
(5, 12, 1, 17, 'admin@gmail.com', 'regarding password', 'I\'ll check and let you know.'),
(10, 20, 2, 44, 'nutritionist123@gmail.com', 'fssdsdsd', 'sxdfsdffs'),
(12, 12, 1, 17, 'nutritionist@gmail.com', 'regarding password', 'Okay');

-- --------------------------------------------------------

--
-- Table structure for table `req_driver`
--

CREATE TABLE `req_driver` (
  `id` int(20) NOT NULL,
  `drivername` varchar(250) NOT NULL,
  `nic` varchar(100) NOT NULL,
  `license` varchar(100) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `req_driver`
--

INSERT INTO `req_driver` (`id`, `drivername`, `nic`, `license`, `contact`, `email`, `password`, `user_type_id`) VALUES
(1, 'driver1', '982670080V', 'B123456', '0771234567', 'driver1@gmail.com', '$2y$10$yKJ5YL4PtgN6/zH5KsouVuDxGirkmT9lyp0d8N74TwZ4RVce2qdfm', 5);

-- --------------------------------------------------------

--
-- Table structure for table `req_meal_plans`
--

CREATE TABLE `req_meal_plans` (
  `request_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `age` int(100) NOT NULL,
  `height` double NOT NULL,
  `weight` double NOT NULL,
  `bmi` float NOT NULL,
  `activity_level` varchar(100) NOT NULL,
  `preference` varchar(100) NOT NULL,
  `notes` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `specialNotes` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `req_meal_plans`
--

INSERT INTO `req_meal_plans` (`request_id`, `user_id`, `name`, `gender`, `age`, `height`, `weight`, `bmi`, `activity_level`, `preference`, `notes`, `status`, `specialNotes`) VALUES
(14, 44, 'Shifna Shafiq', 'female', 22, 1.75, 42, 13.7143, 'lightly', 'anything', 'need high protein diet', 1, 'use this plan for two weeks and contact me again'),
(18, 48, 'nisal nelaka', 'male', 22, 1.75, 62, 20.2449, 'extremely', 'vegetarian', 'need more nutrition diet', 1, 'If this plan is not suitable let me know'),
(20, 45, 'Juzly Ahamed', 'male', 22, 1.86, 58, 16.7649, 'lightly', 'anything', 'get diabetes drugs', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `req_seller`
--

CREATE TABLE `req_seller` (
  `id` int(30) NOT NULL,
  `resname` varchar(250) NOT NULL,
  `resaddress` varchar(250) NOT NULL,
  `sellername` varchar(250) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `req_seller`
--

INSERT INTO `req_seller` (`id`, `resname`, `resaddress`, `sellername`, `phonenumber`, `email`, `password`, `user_type_id`) VALUES
(6, 'Green Food', '520 / 19, High Level Road', 'seller3', '0113467359', 'seller3@gmail.com', '$2y$10$tASPDHcZqoZBq2nEztE.queY/El3V6pymho4B5jiAMit9bF9lngaG', 4);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int(30) NOT NULL,
  `code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`id`, `code`, `email`) VALUES
(15, '16061668ef39ab', 'juzlyahamed8@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `location` varchar(30) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `location`, `description`, `image`) VALUES
(7, 'Green Food', 'colombo 10', 'Ensconced in a great banyan tree in the heart of Colombo’s entertainment district, Green Food serves signature Sinhala cuisine, escapism and enchantment. To have dined there is to have glimpsed at an ancient Sri Lanka that has long-since begun to disappear into a blur of Western technicolour. It seems odd to hoist this restaurant up as a paragon of authenticity, because Green Food is a venture from the masters of the plush and fashionable at Cinnamon Grand. But perhaps every Sri Lankan has a soft corner for the village of yore: paddy farmers dressed in loincloths that out-skimp most bikinis, women returning from the well with clay pots balanced on heads, and children picking fruit in trees – and it is admiration for rural Sri Lanka that defines Green Food. Despite being within 100 metres from the the glitz of London Grill or Lagoon, there is not a hint of falseness about the place.', 'assets/images/restaurant/1.jpg'),
(8, 'The Escape', 'Galle', 'The Escape in Galle is a worthy lunch spot if you\'re in the neighbourhood, or even a little beyond. We made our trip to this rice & curry spot all the way from Karapitiya and was quite satisfied with our meal.At The Escape, you get a wide spread of proteins - eggs, chicken (free-range and broiler), pork, sausages, and over 15 veg curries to choose from. We chose Brinjal Moju, Tempered Okra, Boiled Manioc and Dhal curry to go with this Omelette Rice & Curry (Rs. 320). Every buth plate here gets a couple of papadums and fried paprika.Boasting with curry kicks, the dhal curry was a delight. The tempered okra wasn\'t too oily, the brinjal moju added a tinge of sweetness to the meal, and we enjoyed having a bit of scraped coconut with the boiled manioc. If you\'re a vegetarian, this is a good combination.', './assets/images/restaurant/2.jpg'),
(9, ' Walawwa Kade', 'Kandy', 'Over the course of time, we learnt that photographing a plate/pack of rice & curry needs no styling. Colourful curries, golden-hued papadam and a heap of white/red/yellow rice - all these add up to a perfectly beautiful picture that glams up your Instagram feed. And that\'s how Walawwa Kade drew our attention.\r\n\r\nWalawwa Kade is a cloud kitchen that does expensive rice & curry, which looks so darn good on their social media platforms. We\'ve been eyeing on it for quite some time now, and just last week we managed to grab some for ourselves through PickMe Food.\r\n\r\nThe Rice & Curry\r\nAlmost everything they\'ve got here is priced above Rs. 450, so it\'s almost twice as much as your usual buth packet.\r\n\r\nSo does it really worth it? Well, let\'s find out.', './assets/images/restaurant/3.jpg'),
(10, 'Monkeybean Cafe', 'Colombo 7', 'Monkeybean does no monkey business. It\'s all about good coffee, even better paninis, and rich desserts. Dinesh was over the moon when he found out that they\'re branching out to the coffee street in Colombo - the Stratford Avenue.\r\n\r\nAfter much anticipation, we found ourselves here for a lunch review, unfortunately, without their favourite monkey - Dinesh.\r\n\r\nFood\r\nIf you\'re at Monkeybean, that one thing you shouldn\'t miss trying out is the range of SriPaninis they\'ve got. Homemade bread, packed to the brim with a bunch of delicious Sri Lankan-style fillings, these paninis are absolutely mouthful.\r\n\r\nThis Meatball Panini (Rs. 640) was a delight. Meatballs cooked with a super Sri Lankan touch, it was fiery and delicious. They\'re super generous with their fillings too, so every bite is a rich, meaty treat.\r\n\r\nThe panini bread is also a highlight here. Like we mentioned previously, they bake their own bread, so you\'re guaranteed to get the freshest, crispiest panini bread.', './assets/images/restaurant/4.jpg'),
(11, 'Vege Dine', 'Maharagama', 'It\'s an extensive menu, assorted with a whole heap of curries and rice-based varieties, which reflect the rich culinary styles of Sri Lanka. They\'ve got set menus for lunchtime, which are available for dine-in and takeaway, and we opted to the former. However, if you\'re choosing the latter, it\'s less expensive.\r\nEvery element in this spread was well-executed. The dhal was full of curry kicks, the Kiri Ala was hella creamy and milky, while the mallum provided a fresh crunch. \r\nThe undeniable star of the meal was the mutton curry. Lavished with an abundance of finest spices that our culinary fare is well known for, it was a spicy, aromatic affair. T', './assets/images/restaurant/5.jpg'),
(12, 'Matara Bath Kade', 'Colombo 7', 'We were excited to review the Matara Bath Kade. A virtual kitchen by Mona\'s, Matara Bath Kade is all about pork, and available for delivery. But, if you love pork, this is probably a choice that you should not consider.\r\n\r\nHere\'s why.\r\n\r\nFood\r\nPretty much everything at Matara Bath Kade is supposed to have pork in them - from pizza, fried rice and kottu to bites, burgers and pasta. Our order included the Spicy Salami Pizza (Rs. 1875), Black Pork Kottu (Rs. 890) and a side of Potato Wedges (Rs. 450).\r\n\r\nLike a pack of wolves that gathers around a pack of bacon, we were super stoked to try out the food. But oy vey! Within just a few seconds, our expectations started to fall apart.\r\n', './assets/images/restaurant/6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `res_id` int(30) NOT NULL,
  `resname` varchar(200) NOT NULL,
  `resaddress` varchar(200) NOT NULL,
  `sellername` varchar(100) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `businesstype` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`res_id`, `resname`, `resaddress`, `sellername`, `phonenumber`, `email`, `password`, `businesstype`) VALUES
(20, ' Laksala ', 'Colombo10', 'Pathmika', '0774563456', 'pathmika@gmail.com', '$2y$10$pvG9RjejfP0KtThO6JEpM.c2nzBJqWp8bg5HRIFPXBcvas3UHDU0y', 'Restaurant'),
(64, ' Gonuts With Donuts - Marino Mall ', '590 Galle Main Rd, Colombo 003', 'Seller1', '0771234567', 'seller1@gmail.com', '$2y$10$fwLu/ag3JkxGgqryoQmiyOTFFaGS2IfG7pn31KPlCF6SovTOAJ8si', 'Restaurant'),
(65, ' Yumi-Japanese Restaurant ', 'No 25 Galle Face Center Rd, Colombo 01100', 'seller2', '0111234567', 'seller2@gmail.com', '$2y$10$qLQ7tM8RheH.Yj1D7UST/uhfzfxmkUafRt4mfbLhxdqzbnuovNXm6', 'Restaurant');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_details`
--

CREATE TABLE `shipping_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `tele` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_details`
--

INSERT INTO `shipping_details` (`id`, `order_id`, `address`, `tele`) VALUES
(1, 1, 'Horana', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `trans_id` int(10) NOT NULL,
  `order_id` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`trans_id`, `order_id`, `user_id`, `date`, `payment_type`, `amount`, `status`) VALUES
(1, '11', '11', '2021-03-20', 'payable', 1112, 'paid'),
(2, '12', '12', '2020-11-12', 'recievable', 1200, 'Paid'),
(3, '15', '18', '2021-03-31', 'payable', 1500, 'not_paid'),
(4, '116', '218', '2021-03-24', 'recievable', 112, 'not_paid'),
(5, '112', '112', '2021-03-30', 'recievable', 12000, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `user_type_id`) VALUES
(8, 'admin1@gmail.com', 'admin', '$2y$10$3KmuW9AsHzXtsIRm3L8dcONycj.AOtkUhmaMi5GAuV.qfRLYZuo8q', 1),
(17, 'nutritionist123@gmail.com', 'nutritionist', '$2y$10$tjmDDtA4mzLbUuERY07G9OwCvel5U3XXs/WVPAtek8lgJkKi3HjL.', 2),
(20, 'pathmika@gmail.com', 'pathmika', '$2y$10$pvG9RjejfP0KtThO6JEpM.c2nzBJqWp8bg5HRIFPXBcvas3UHDU0y', 4),
(44, 'shifnasfk@gmail.com', 'shifna', '$2y$10$J.aYSDnv6Gql.DjR3q4xru8fHofHRAzadr64Tf0VNyMuXN2n4v.1K', 3),
(45, 'juzlyAhamed8@gmail.com', 'juzly', '$2y$10$ddHPb4fi8nqiZsxNQ/o6JeF.qbNlUueLYllyJ93oy5biS4D6tjkkq', 3),
(46, 'pramukaseneviratne@gmail.com', 'pramuka', '$2y$10$uuThqjTJb1o35RuzlrQcG.N4kAJXWXbePlXy/P2oTMx.MHpXWdHwu', 3),
(48, 'nelakafernando@gmail.com', 'nisal', '$2y$10$0uvAi0GWZg1Q6FBlPMKyhOH4WtlcrtWAl1MaS8znzka6rZuaoOlq6', 3),
(64, 'seller1@gmail.com', 'Seller1', '$2y$10$fwLu/ag3JkxGgqryoQmiyOTFFaGS2IfG7pn31KPlCF6SovTOAJ8si', 4),
(65, 'seller2@gmail.com', 'seller2', '$2y$10$qLQ7tM8RheH.Yj1D7UST/uhfzfxmkUafRt4mfbLhxdqzbnuovNXm6', 4),
(66, 'driver1@gmail.com', 'driver', '$2y$10$pM4PvVH8NhckWMtUjcfZX.KBI8HXCwu4CbBYK0y3L1e3tkBlYR2ya', 5),
(67, 'nimal@gmail.com', 'nimal', '$2y$10$dwEJA5oflvBbcfhqOO8hfeMD.HQhBDvH4hOELOfQhXAbRuecmDvwi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tele_no` varchar(10) NOT NULL,
  `age` int(100) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `height` double NOT NULL,
  `weight` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `name`, `username`, `email`, `password`, `tele_no`, `age`, `gender`, `height`, `weight`) VALUES
(44, 'Shifna Shafiq', 'shifna', 'shifnasfk@gmail.com', '$2y$10$J.aYSDnv6Gql.DjR3q4xru8fHofHRAzadr64Tf0VNyMuXN2n4v.1K', '0775634564', 22, 'female', 1.75, 42),
(45, 'Juzly Ahamed', 'juzly', 'juzlyAhamed8@gmail.com', '$2y$10$ddHPb4fi8nqiZsxNQ/o6JeF.qbNlUueLYllyJ93oy5biS4D6tjkkq', '0773425683', 22, 'male', 1.86, 58),
(46, 'Pramuka Seneviratne', 'pramuka', 'pramukaseneviratne@gmail.com', '$2y$10$uuThqjTJb1o35RuzlrQcG.N4kAJXWXbePlXy/P2oTMx.MHpXWdHwu', '0772020027', 22, 'male', 1.6, 42),
(48, 'nisal nelaka', 'nisal', 'nelakafernando@gmail.com', '$2y$10$0uvAi0GWZg1Q6FBlPMKyhOH4WtlcrtWAl1MaS8znzka6rZuaoOlq6', '0775437867', 22, 'male', 1.75, 62),
(67, '', 'nimal', 'nimal@gmail.com', '$2y$10$dwEJA5oflvBbcfhqOO8hfeMD.HQhBDvH4hOELOfQhXAbRuecmDvwi', '', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(5) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(1, 'ADMIN'),
(2, 'NUTRITIONIST'),
(3, 'USER'),
(4, 'SELLER'),
(5, 'DRIVER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart.item.id.fk` (`item_id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `deliverydriver`
--
ALTER TABLE `deliverydriver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `foodName` (`foodName`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`inbox_id`),
  ADD KEY `inbox.from.user.id` (`from_id`),
  ADD KEY `inbox.to.user.id` (`to_id`);

--
-- Indexes for table `mealplan`
--
ALTER TABLE `mealplan`
  ADD PRIMARY KEY (`mealplan_id`),
  ADD KEY `mealplan.request.id.fk` (`request_id`);

--
-- Indexes for table `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rest_id_fk` (`res_id`);

--
-- Indexes for table `nutritionist`
--
ALTER TABLE `nutritionist`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user.user_email_fk` (`email`),
  ADD KEY `user.user_username_fk` (`username`);

--
-- Indexes for table `orderd`
--
ALTER TABLE `orderd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_item_id_fk` (`menu_item_id`);

--
-- Indexes for table `orderh`
--
ALTER TABLE `orderh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `inbox_id.inbox.id.fk` (`inbox_id`),
  ADD KEY `reply.from.id.fk` (`from_id`);

--
-- Indexes for table `req_driver`
--
ALTER TABLE `req_driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_meal_plans`
--
ALTER TABLE `req_meal_plans`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user.id.fk` (`user_id`);

--
-- Indexes for table `req_seller`
--
ALTER TABLE `req_seller`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `sellername_fk` (`sellername`),
  ADD KEY `selleremail` (`email`);

--
-- Indexes for table `shipping_details`
--
ALTER TABLE `shipping_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user.user_type_id_fk` (`user_type_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `deliverydriver`
--
ALTER TABLE `deliverydriver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `inbox_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `mealplan`
--
ALTER TABLE `mealplan`
  MODIFY `mealplan_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orderd`
--
ALTER TABLE `orderd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderh`
--
ALTER TABLE `orderh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `req_driver`
--
ALTER TABLE `req_driver`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `req_meal_plans`
--
ALTER TABLE `req_meal_plans`
  MODIFY `request_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `req_seller`
--
ALTER TABLE `req_seller`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `res_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `shipping_details`
--
ALTER TABLE `shipping_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `trans_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inbox`
--
ALTER TABLE `inbox`
  ADD CONSTRAINT `inbox.from.user.id` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inbox.to.user.id` FOREIGN KEY (`to_id`) REFERENCES `users` (`user_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mealplan`
--
ALTER TABLE `mealplan`
  ADD CONSTRAINT `mealplan.request.id.fk` FOREIGN KEY (`request_id`) REFERENCES `req_meal_plans` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_item`
--
ALTER TABLE `menu_item`
  ADD CONSTRAINT `rest_id_fk` FOREIGN KEY (`res_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `nutritionist`
--
ALTER TABLE `nutritionist`
  ADD CONSTRAINT `user.user_email_fk` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user.user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user.user_username_fk` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `orderd`
--
ALTER TABLE `orderd`
  ADD CONSTRAINT `menu_item_id_fk` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_item` (`id`);

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `inbox_id.inbox.id.fk` FOREIGN KEY (`inbox_id`) REFERENCES `inbox` (`inbox_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reply.from.id.fk` FOREIGN KEY (`from_id`) REFERENCES `users` (`user_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `req_meal_plans`
--
ALTER TABLE `req_meal_plans`
  ADD CONSTRAINT `user.id.fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `seller.user.id.fk` FOREIGN KEY (`res_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `selleremail` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user.user_type_id_fk` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `userdetails.user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
