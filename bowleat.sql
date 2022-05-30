-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2020 at 04:36 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bowleat`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `contact_number`, `subject`, `message`, `created_date`) VALUES
(1, 'Admin', 'admin@gmail.com', '012-3342356', 'Test', 'Hello', '2020-11-19 02:11:49'),
(2, 'Sara', 'sara@gmail.com', '0124638234', 'Excellent taste', 'I love the unagi special so much. It is my go-to bowl every time I purchase from Bowl Eat. Keep it up.', '2020-11-19 02:36:44'),
(3, 'Zean', 'zean@gmail.com', '013-4393424', 'Missing Order', 'Hello, I have placed an order on 11/11/2020 but I did not receive my order. Please get back to me to discuss this matter', '2020-11-19 02:37:52'),
(4, 'Annie', 'annie@gmail.com', '019-2384823', 'New toppings suggestion', 'Hello, I have a new topping suggestion for the menu. Please email me to discuss more', '2020-11-19 02:38:52'),
(5, 'mj', 'mj@gmail.com', '012-3342356', '123', 'test1', '2020-11-19 03:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `product_id` int(5) NOT NULL,
  `category_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` double(8,2) NOT NULL,
  `picture` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `category_id`, `name`, `description`, `price`, `picture`) VALUES
(1, 100, 1, 'Miso Salmon', 'A mixture of Japanese taste comes with Miso paste.', 19.90, 'images/salmon.png'),
(2, 101, 1, 'Shoyu Salmon', 'The perfect choice for first time healthy bowl goers to taste the marriage of Hawaii and Japan!', 19.90, 'images/salmon-2.png'),
(3, 102, 1, 'Spicy Tuna', 'With birdâ€™s eye chili into the shoyu marinade for that immense kick, it\'s a punch to your taste buds!', 21.90, 'images/salmon-3.png'),
(4, 200, 2, 'Herb Chicken', 'Marinade herb chicken with specialised garlic sauce? What a great combination!', 16.90, 'images/chicken.png'),
(5, 201, 2, 'Cajun Chicken Breast', 'Tender chicken breast marinated overnight in buttermilk and infused perfectly with Cajun seasoning.', 16.90, 'images/chicken-2.png'),
(6, 300, 3, 'Mango Salad Shrimp', 'Tropical mango salsa made fresh daily and tossed with our lightly grilled shrimp.', 20.90, 'images/shrimp.png'),
(7, 400, 4, 'Avo-Lover', 'Chunks of avocado drizzled with lemon juice to keep you going for more!', 14.90, 'images/veggie.png'),
(8, 401, 4, 'Hawaiian Tofu', 'Chucks of tofu drizzled with herby lime sauce to keep you craving for more', 14.90, 'images/veggie-2.png'),
(9, 500, 5, 'Unagi Special', 'Freshwater eel with the impeccable combination of Asian-inspired garnishes such as onsen egg, pickled radish, furikake, carrots and fish roe.', 28.90, 'images/unagi.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`, `registration_date`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2020-11-19 01:15:11'),
(3, 'mingjian', 'mingjian@gmail.com', 'user', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2020-11-19 02:51:00'),
(4, 'Annie', 'annie@gmail.com', 'user', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2020-11-19 02:51:10'),
(6, 'mj', 'mj@gmail.com', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2020-11-19 03:39:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
