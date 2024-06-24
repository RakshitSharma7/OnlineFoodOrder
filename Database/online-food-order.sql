-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2023 at 03:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online-food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(3, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(18, 'Burger', 'food_category635.jpg', 'Yes', 'Yes'),
(19, 'Pizza', 'food_category630.jpg', 'Yes', 'Yes'),
(20, 'Momos', 'food_category613.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(13, 'Crispy Chicken Burger', 'Spicy Crispy chicken Burger', '3.00', 'food_name2760.jpg', 18, 'Yes', 'Yes'),
(14, 'Mixed Veg Pizza', 'Thin crust pizza with mixed veg toppings.', '5.00', 'food_name6247.jpg', 19, 'Yes', 'Yes'),
(15, 'Peri Peri Momos', 'Chicken Stuffed Momos', '3.00', 'food_name8991.jpg', 20, 'Yes', 'Yes'),
(16, 'Meat Patty Burger', 'Juicy meat patty burger', '5.00', 'food_name9909.jpg', 18, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(2, 'Pizza', '5.00', 2, '10.00', '2022-08-28 02:56:37', 'Delivered', 'Aidan Wilcox', '+1 (836) 717-6713', 'heryzibuh@mailinator.com', 'Elit tempora qui ea'),
(3, 'Pizza', '5.00', 2, '10.00', '2022-08-28 02:59:27', 'Delivered', 'Tanek Wooten', '+1 (386) 245-7476', 'qywuq@mailinator.com', 'Consequatur maiores '),
(4, 'Pizza', '5.00', 2, '10.00', '2022-08-28 03:00:05', 'Cancelled', 'Zelenia Adkins', '+1 (346) 197-5659', 'firomyk@mailinator.com', 'Anim in dolores qui '),
(5, 'Pizza', '5.00', 3, '15.00', '2022-08-28 03:00:50', 'Delivered', 'Lesley Tucker', '+1 (941) 681-4914', 'xuwycavobe@mailinator.com', 'Velit et assumenda m'),
(6, 'Pizza', '5.00', 2, '10.00', '2022-08-28 03:22:02', 'Delivered', 'Ivana Wells', '+1 (412) 293-1119', 'welov@mailinator.com', 'Placeat do fugiat d'),
(7, 'Fried Chicken', '3.00', 3, '9.00', '2022-11-16 06:24:35', 'Delivered', 'Ginger Burnett', '+1 (912) 913-7508', 'suwigyz@mailinator.com', 'Expedita eiusmod qui'),
(8, 'Veg Pizza', '5.00', 3, '15.00', '2022-11-16 09:35:06', 'Ordered', 'Quinlan Griffin', '+1 (562) 418-1047', 'majamu@mailinator.com', 'Do dolore consectetu'),
(9, 'Crispy Chicken Burger', '3.00', 3, '9.00', '2022-11-16 09:42:57', 'Ordered', 'Kelsey Juarez', '+1 (264) 655-6727', 'xyletibi@mailinator.com', 'Delectus sit quo es'),
(10, 'Crispy Chicken Burger', '3.00', 25, '75.00', '2022-12-03 06:38:17', 'Ordered', 'Kimberly Solomon', '+1 (541) 589-3698', 'wahuvozaze@mailinator.com', 'Quas aliquid qui rep'),
(11, 'Crispy Chicken Burger', '3.00', 5, '15.00', '2022-12-12 09:40:45', 'Ordered', 'Whitney Wiley', '+1 (931) 546-7293', 'lobulypi@mailinator.com', 'Dolorem dolores pers'),
(12, 'Crispy Chicken Burger', '3.00', 97, '291.00', '2022-12-12 09:42:32', 'Cancelled', 'Thor Mccarty', '+1 (623) 212-7192', 'sulaqipu@mailinator.com', 'Sequi officia maiore');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_query`
--

CREATE TABLE `tbl_query` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_query`
--

INSERT INTO `tbl_query` (`id`, `name`, `email`, `status`, `message`) VALUES
(5, 'Hollee Cummings', 'nubyt@gmail.com', 'Resolved', 'Quidem provident al'),
(6, 'Buffy Oneil', 'wodelaro@gmail.com', 'Unresolved', 'Fuga Optio ad quia'),
(7, 'Raven Martinez', 'rubitarysy@mailinator.com', 'Resolved', 'Quos sed possimus s'),
(8, 'Marcia Fulton', 'vikyluru@mailinator.com', 'Unresolved', 'Soluta dolor volupta'),
(9, 'Tarik Acevedo', 'tisyfaret@mailinator.com', 'Resolved', 'Dolore do amet ut c'),
(10, 'Darryl Norton', 'voqahiges@mailinator.com', 'Unresolved', 'Lorem animi ex nisi'),
(11, 'Fritz Jenkins', 'fepawe@mailinator.com', 'Unresolved', 'Magni aliquid maiore'),
(12, 'Craig Herrera', 'husedizo@mailinator.com', 'Unresolved', 'Cum et perferendis v');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_query`
--
ALTER TABLE `tbl_query`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_query`
--
ALTER TABLE `tbl_query`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
