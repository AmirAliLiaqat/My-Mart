-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2022 at 04:03 PM
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
-- Database: `my_mart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `activity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `username`, `number`, `email`, `message`, `activity`) VALUES
(6, 'Amir Ali', '03090886518', 'amirliaqat2020@gmail.com', 'Hello Admin, How are you???', '12:46:20:pm Sep 24 2022');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `site_favicon` varchar(255) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `site_description` text NOT NULL,
  `footer_text` text NOT NULL,
  `currency_format` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `site_title`, `site_favicon`, `site_logo`, `site_description`, `footer_text`, `currency_format`) VALUES
(1, 'My Mart', 'site_favicon_10.png', 'site_logo_38.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta obcaecati modi earum perspiciatis expedita deleniti doloribus nobis enim non consequuntur.', 'Copyright © 2022. All Rights Reserved.', 'Rs');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` text NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `payment_method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 9, 'Amir Ali', '03090886518', 'amirliaqat2020@gmail.com', 'cash on delivery', 'house no 321, street no 10 koh-e-noor, Lahore, Punjab, Pakistan- 54760', ', Samsung Galaxy Note 20 (1) , Honor 20 Pro 4GB 64GB (1) , Oppo F21 3GB 32GB (1) ', 141997, '26-Sep-2022', 'completed'),
(2, 9, 'Amir Ali', '03090886518', 'amirliaqat2020@gmail.com', 'bank transfer', 'house no 321, street no 10 koh-e-noor, Lahore, Punjab, Pakistan- 54760', ', Vivo V9Pro (Nebula Purple, 6GB RAM, Snapdragon 660AIE) (2) ', 80000, '28-Sep-2022', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `sale` varchar(255) NOT NULL,
  `currency` varchar(11) NOT NULL,
  `product_status` varchar(100) NOT NULL,
  `date_added` varchar(255) NOT NULL,
  `updated_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_img`, `name`, `product_description`, `price`, `sale`, `currency`, `product_status`, `date_added`, `updated_date`) VALUES
(2, 'product_img_62.jpg', 'Honor 20 Pro 4GB 64GB', 'lorem ipsum dolor sit amet consectetur adipisicing elit. Atque officiis itaque corporis facilis tempora veritatis, esse soluta nobis distinctio reprehenderit molestias face', '31999', '20%', 'Rs', 'publish', '01:09:33:pm Sep 24 2022', '03:54:09:pm Sep 28 2022'),
(3, 'product_img_55.jpg', 'Samsung Galaxy Note 20', 'lorem ipsum dolor sit amet consectetur adipisicing elit. Atque officiis itaque corporis facilis tempora veritatis, esse soluta nobis distinctio reprehenderit molestias face', '84999', '30%', 'Rs', 'publish', '01:13:16:pm Sep 24 2022', '03:54:15:pm Sep 28 2022'),
(4, 'product_img_12.jpg', 'Oppo F21 3GB 32GB', 'lorem ipsum dolor sit amet consectetur adipisicing elit. Atque officiis itaque corporis facilis tempora veritatis, esse soluta nobis distinctio reprehenderit molestias face', '24999', '0%', 'Rs', 'publish', '01:15:01:pm Sep 24 2022', '03:40:14:pm Sep 28 2022'),
(5, 'product_img_99.jpg', 'Iphone 11 Pro Max', 'lorem ipsum dolor sit amet consectetur adipisicing elit. Atque officiis itaque corporis facilis tempora veritatis, esse soluta nobis distinctio reprehenderit molestias face', '229999', '10%', 'Rs', 'publish', '01:17:26:pm Sep 24 2022', '03:40:22:pm Sep 28 2022'),
(6, 'product_img_42.jpg', 'Vivo V9Pro (Nebula Purple, 6GB RAM, Snapdragon 660AIE)', 'lorem ipsum dolor sit amet consectetur adipisicing elit. Atque officiis itaque corporis facilis tempora veritatis, esse soluta nobis distinctio reprehenderit molestias face', '40000', '0%', 'Rs', 'publish', '06:02:21:pm Sep 27 2022', '03:40:29:pm Sep 28 2022'),
(7, 'product_img_58.png', 'Vivo Y73 8GB 128GB', 'lorem ipsum dolor sit amet consectetur adipisicing elit. Atque officiis itaque corporis facilis tempora veritatis, esse soluta nobis distinctio reprehenderit molestias face', '43999', '0%', 'Rs', 'publish', '03:30:31:pm Sep 28 2022', '03:39:23:pm Sep 28 2022');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` bigint(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `last_login_details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `profile_pic`, `fname`, `lname`, `email`, `password`, `phone`, `country`, `city`, `zip`, `status`, `last_login_details`) VALUES
(7, 'profile_pic_11.png', 'Admin', '01', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '23544', 'Pakistan', 'Lahore', '54760', 'admin', '04:07:32:pm Sep 29 2022'),
(8, 'profile_pic_55.jpg', 'User', '01', 'user01@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '23568', 'Pakistan', 'Lahore', '54760', 'admin', '10:11:39:am Sep 23 2022'),
(9, 'profile_pic_39.jpg', 'User', '02', 'user02@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '23568', 'Pakistan', 'Lahore', '54760', 'user', '05:23:20:pm Sep 29 2022');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
