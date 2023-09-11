-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2022 at 05:08 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `dbl_category`
--

CREATE TABLE `dbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbl_category`
--

INSERT INTO `dbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(23, 'PIZZA', 'food_category_436.jpg', 'Yes', 'Yes'),
(24, 'drinks', 'food_category_999.png', 'Yes', 'No'),
(25, 'non veg', 'food_category_255.jpg', 'Yes', 'No'),
(27, 'BURGER', 'food_category_854.jpg', 'Yes', 'Yes'),
(31, 'VEG', 'food_category_468.jpg', 'Yes', 'Yes'),
(32, 'NON VEG', 'food_category_282.jpg', 'Yes', 'Yes'),
(33, 'VEG PIZZA ', 'food_category_200.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `dbl_food`
--

CREATE TABLE `dbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbl_food`
--

INSERT INTO `dbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(16, 'PIZZA', 'PIZZA with the chees', '48.00', 'Food-Name-31.jpg', 23, 'yes', 'yes'),
(17, 'BURGER', 'Chicken Burger', '45.00', 'Food-Name-532.jpg', 27, 'yes', 'yes'),
(19, 'MOMO', 'MOMO', '22.00', 'Food-Name-3308.jpg', 23, 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(2, 'shinto', 'shinto@12444', 'e3cdde1a7ca7157a27d27b1fa9c5dc5d'),
(3, 'abraham.k.j', 'abraham@47', '6907d34f671fd18a4708a1cfb8214b2c'),
(26, 'abrahaamkk', 'abrahammkk', '25ed1bcb423b0b7200f485fc5ff71c8e'),
(27, 'sample', 'sample', '5e8ff9bf55ba3508199d22e984129be6'),
(31, 'john', 'john@123', '58c2bd8a8be6198468412a24a56acf0b');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'PIZZA', '48.00', 1, '48.00', '2022-06-07 03:32:33', 'Delivered', 'shibin', '9998979695', 'hi@gmail.com', 'pulpallypp'),
(2, 'PIZZA', '48.00', 4, '192.00', '2022-06-07 03:34:50', 'Cancelled', 'shintooo', '9998979690', 'hii@gmail.com', 'pulpally,wayanad,india,aaaaa'),
(3, 'MOMO', '24.00', 3, '72.00', '2022-06-07 03:37:29', 'Cancelled', 'shibin', '9998979695', 'hi@gmail.com', 'fdjfjfj'),
(4, 'PIZZA', '48.00', 3, '144.00', '2022-06-07 04:14:28', 'Delivered', 'shinto', '9998979695', 'hi@gmail.com', 'ssssssssssss'),
(5, 'MOMO', '24.00', 3, '72.00', '2022-06-07 10:12:17', 'On Delivery', 'john', '9998979695', 'john@gmail.com', 'djjshfjhjshd'),
(6, 'PIZZA', '48.00', 1, '48.00', '2022-07-28 06:29:38', 'Ordered', 'shibin', '9998979695', 'hi@gmail.com', 'kkk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dbl_category`
--
ALTER TABLE `dbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dbl_food`
--
ALTER TABLE `dbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbl_category`
--
ALTER TABLE `dbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `dbl_food`
--
ALTER TABLE `dbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
