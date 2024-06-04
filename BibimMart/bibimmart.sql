-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 09:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bibimmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_ref_number` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `shipper_id` int(11) NOT NULL,
  `product_cat_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `gcash_acc_name` varchar(255) NOT NULL,
  `gcash_acc_num` int(11) NOT NULL,
  `gcash_ref_num` int(11) NOT NULL,
  `secondary_receiver` varchar(50) NOT NULL,
  `secondary_address` varchar(255) NOT NULL,
  `gcash_amt_sent` int(15) NOT NULL,
  `total_amt_to_pay` int(11) NOT NULL,
  `shipping_tracking_num` int(11) NOT NULL,
  `order_phase` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 - Cart\r\n2 - Checkout\r\n3 - Pending\r\n4 - Confirmed\r\n5 - Delivered\r\n6 - Shipped\r\n0 - Cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_ref_number`, `customer_id`, `product_id`, `order_date`, `shipper_id`, `product_cat_id`, `qty`, `payment_method`, `gcash_acc_name`, `gcash_acc_num`, `gcash_ref_num`, `secondary_receiver`, `secondary_address`, `gcash_amt_sent`, `total_amt_to_pay`, `shipping_tracking_num`, `order_phase`) VALUES
(69, 'LYZ476YI', 17, 3, '2024-06-03 14:33:37', 1, 1, 2, '2', '', 0, 0, 'RIZZA TUSCANO', 'POLANGUI', 0, 60, 0, '3'),
(70, '22PSWY6Z', 17, 42, '2024-06-03 14:33:42', 1, 1, 3, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 735, 735, 0, '0'),
(71, 'OHRO79K1', 17, 6, '2024-06-03 14:36:36', 2, 4, 3, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 1065, 1065, 0, '4'),
(72, 'OHRO79K1', 17, 23, '2024-06-03 14:40:16', 2, 14, 1, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 1065, 1065, 0, '4'),
(73, 'OHRO79K1', 17, 30, '2024-06-03 14:46:53', 2, 15, 1, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 1065, 1065, 0, '4'),
(74, 'OHRO79K1', 17, 4, '2024-06-03 14:46:59', 2, 12, 3, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 1065, 1065, 0, '4'),
(75, 'KEJ1JAI2', 17, 18, '2024-06-03 15:17:50', 1, 14, 1, '2', '', 0, 0, 'RIZZA TUSCANO', 'POLANGUI', 0, 109, 0, '0'),
(76, '6SHHLDC1', 17, 28, '2024-06-03 15:17:57', 1, 12, 1, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 490, 490, 0, '0'),
(77, '6SHHLDC1', 17, 24, '2024-06-03 15:18:37', 1, 14, 1, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 490, 490, 0, '0'),
(78, '6SHHLDC1', 17, 23, '2024-06-03 15:18:46', 1, 14, 1, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 490, 490, 0, '0'),
(79, '6SHHLDC1', 17, 13, '2024-06-03 15:18:52', 1, 17, 3, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 490, 490, 0, '0'),
(81, 'RTSP0NBZ', 17, 12, '2024-06-03 15:26:52', 1, 13, 2, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 169, 169, 0, '4'),
(82, 'RTSP0NBZ', 17, 19, '2024-06-03 15:26:57', 1, 14, 1, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 169, 169, 0, '3'),
(83, 'JFXZVIIL', 17, 37, '2024-06-03 15:28:52', 2, 16, 3, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 470, 470, 0, '3'),
(84, 'JFXZVIIL', 17, 20, '2024-06-03 15:30:11', 2, 2, 1, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 470, 470, 0, '3'),
(85, 'JC69IE85', 17, 31, '2024-06-03 15:30:16', 1, 15, 1, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 1882, 1882, 0, '0'),
(86, 'JFXZVIIL', 17, 3, '2024-06-03 15:30:19', 2, 1, 1, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 470, 470, 0, '3'),
(87, 'JC69IE85', 17, 10, '2024-06-03 15:30:24', 1, 4, 9, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 1882, 1882, 0, '0'),
(88, 'JC69IE85', 17, 40, '2024-06-03 15:31:27', 1, 17, 1, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 1882, 1882, 0, '0'),
(89, 'JC69IE85', 17, 14, '2024-06-03 15:31:36', 1, 13, 1, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 1882, 1882, 0, '0'),
(91, 'VQUFK77M', 17, 42, '2024-06-03 16:22:36', 1, 1, 3, '1', 'RIZZA TUSCANO', 2147483647, 2147483647, 'RIZZA TUSCANO', 'POLANGUI', 735, 735, 0, '6'),
(92, 'M2N5ZRA2', 17, 26, '2024-06-03 16:22:46', 2, 12, 3, '1', 'Jessa Mae ', 2147483647, 52784957, 'Jessa Mae', 'polangui', 294, 294, 0, '6'),
(93, '', 17, 13, '2024-06-03 16:22:53', 0, 17, 1, '', '', 0, 0, '', '', 0, 0, 0, '1'),
(94, '', 17, 18, '2024-06-03 17:02:32', 0, 14, 1, '', '', 0, 0, '', '', 0, 0, 0, '1'),
(95, '', 17, 15, '2024-06-03 17:02:37', 0, 13, 1, '', '', 0, 0, '', '', 0, 0, 0, '1'),
(96, '', 17, 40, '2024-06-03 17:02:48', 0, 17, 1, '', '', 0, 0, '', '', 0, 0, 0, '1'),
(97, '', 20, 24, '2024-06-04 03:20:50', 0, 14, 4, '', '', 0, 0, '', '', 0, 0, 0, '1'),
(98, '', 20, 1, '2024-06-04 03:21:16', 0, 3, 1, '', '', 0, 0, '', '', 0, 0, 0, '1'),
(99, '', 20, 10, '2024-06-04 03:21:20', 0, 4, 1, '', '', 0, 0, '', '', 0, 0, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `order_phase`
--

CREATE TABLE `order_phase` (
  `order_phase_id` int(11) NOT NULL,
  `order_phase_desc` varchar(255) NOT NULL,
  `order_phase_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_phase`
--

INSERT INTO `order_phase` (`order_phase_id`, `order_phase_desc`, `order_phase_admin`) VALUES
(0, 'Cancelled', ''),
(1, 'cart', ''),
(2, 'checkout', 'New'),
(3, 'Pending', ''),
(4, 'confirmed', ''),
(5, 'Delivered', ''),
(6, 'Shipped', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `payment_method_desc` varchar(55) NOT NULL,
  `payment_method_status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`payment_method_id`, `payment_method_desc`, `payment_method_status`) VALUES
(1, 'Gcash', 'A'),
(2, 'COD', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_image` varchar(150) NOT NULL,
  `qty` int(11) NOT NULL,
  `product_status` tinyint(4) NOT NULL,
  `trending` tinyint(4) NOT NULL,
  `product_desc` varchar(150) NOT NULL,
  `product_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `product_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_image`, `qty`, `product_status`, `trending`, `product_desc`, `product_price`, `selling_price`, `product_added`, `product_cat_id`) VALUES
(1, 'Chacharoni', '1717242048.png', 50, 1, 1, 'noodles na  may ewan na kulay black', 15, 13, '2024-05-27 10:46:10', 3),
(2, 'samyang', '1717242096.png', 1, 1, 0, 'basta noodles', 60, 55, '2024-05-27 14:37:54', 3),
(3, 'kimchi ramyun', '1717242183.png', 5, 1, 1, 'basta kimchi', 30, 15, '2024-05-28 03:06:06', 1),
(4, 'soju', '1717243282.png', 20, 1, 1, 'drinks', 100, 90, '2024-05-30 20:35:09', 12),
(5, 'Nongshim Chapajetti', '1717471797.png', 50, 1, 1, 'N/a', 105, 99, '2024-06-01 05:13:33', 3),
(6, ' Mirim Sauce', '1717471529.png', 50, 1, 1, 'N/A', 255, 109, '2024-06-01 05:18:12', 4),
(7, ' Gochuchang', '1717259454.png', 50, 1, 1, 'N/A', 255, 205, '2024-06-01 05:19:35', 3),
(8, ' Guk Ganjang', '1717257056.png', 50, 1, 1, 'N/A', 109, 189, '2024-06-01 05:20:54', 4),
(10, 'Ssamjang', '1717259335.png', 50, 1, 1, 'Spicy Dipping Sauce', 155, 150, '2024-06-01 05:22:25', 4),
(11, ' Triangle Gimbap', '1717257193.png', 50, 1, 1, 'N/A', 85, 85, '2024-06-01 05:25:34', 13),
(12, ' Dosirak', '1717257166.png', 50, 1, 1, 'N/A', 67, 67, '2024-06-01 05:27:42', 13),
(13, 'Kimbap', '1717257002.png', 30, 1, 1, ' Korean seaweed rice roll filled with a variety of delicious fillings', 155, 150, '2024-06-01 05:30:45', 17),
(14, ' Hanseong Luncheon Meat', '1717256797.png', 5, 1, 1, 'N/A', 202, 199, '2024-06-01 05:32:05', 13),
(15, ' Tuna', '1717251764.png', 20, 1, 1, 'Canned Tuna', 120, 120, '2024-06-01 05:33:38', 13),
(16, ' Daerim Hanip Kkochida', '1717256820.png', 35, 1, 1, 'N/A', 105, 99, '2024-06-01 05:35:19', 13),
(17, ' Cheese Sausage', '1717258077.png', 20, 1, 1, 'N/A', 95, 95, '2024-06-01 05:36:16', 13),
(18, 'Pepero', '1717258196.png', 30, 1, 1, 'Stick biscuits coated with chocolate', 109, 109, '2024-06-01 05:39:38', 14),
(19, ' Ssaekang', '1717258211.png', 30, 1, 1, 'Shrimp', 35, 35, '2024-06-01 05:46:41', 14),
(20, ' Mongshell', '1717258301.png', 20, 1, 1, 'Vanilla Chocolate Ice Cream', 95, 95, '2024-06-01 05:49:16', 2),
(21, ' Turtle Chips', '1717258460.png', 30, 1, 1, 'N/A', 30, 30, '2024-06-01 05:50:34', 14),
(22, ' Onion Rings', '1717257421.png', 20, 1, 1, 'N/A', 30, 30, '2024-06-01 05:53:00', 14),
(23, ' Crab Chips', '1717258497.png', 20, 1, 1, 'N/A', 25, 25, '2024-06-01 05:57:33', 14),
(24, ' Malang', '1717258623.png', 20, 1, 1, 'N/A', 85, 85, '2024-06-01 05:59:01', 14),
(25, ' Milk', '1717256679.png', 30, 1, 1, 'Banana Flavor', 56, 56, '2024-06-01 06:01:34', 12),
(26, ' Milkis', '1717255918.png', 20, 1, 1, 'Canned Milk', 98, 98, '2024-06-01 06:03:50', 12),
(28, ' Kimchi Energy Drinks', '1717257444.png', 20, 1, 1, 'Kimchi Flavor', 105, 105, '2024-06-01 06:08:35', 12),
(29, ' Sticky Barley Rice', '1717258642.png', 20, 1, 1, 'N/A', 205, 205, '2024-06-01 06:11:39', 15),
(30, ' Organic Rice', '1717258841.png', 20, 1, 1, 'White Rice', 159, 159, '2024-06-01 06:13:05', 15),
(31, ' Gawaji', '1717258856.png', 20, 1, 1, 'N/A', 165, 165, '2024-06-01 06:18:20', 15),
(32, 'Together Chocolate & Milk', '1717258870.png', 20, 1, 1, 'Chocolate and Milk Ice Cream', 120, 120, '2024-06-01 06:19:37', 2),
(33, 'Jinju Corndog', '1717259018.png', 20, 1, 1, 'Mini Corndog', 156, 156, '2024-06-01 06:22:11', 14),
(34, ' Soju-Watermelon', '1717257716.png', 20, 1, 1, 'Watermelon flavor', 205, 205, '2024-06-01 06:23:23', 12),
(35, ' Fanfare Vanilla', '1717257377.png', 20, 1, 1, 'Vanilla Ice cream', 95, 95, '2024-06-01 06:24:08', 2),
(36, ' Haita Baraba', '1717259056.png', 20, 1, 1, 'White Vanilla Cone', 87, 87, '2024-06-01 06:25:05', 2),
(37, ' Work Glove', '1717256647.png', 10, 1, 1, 'N/A', 115, 115, '2024-06-01 06:27:36', 16),
(38, 'Cf Brown Pan', '1717253286.png', 5, 1, 1, 'Non-sticky pan', 290, 290, '2024-06-01 06:28:26', 16),
(39, ' Persil Power Ge', '1717257639.png', 10, 1, 1, 'Dishwashing Liquid', 165, 165, '2024-06-01 06:29:27', 16),
(40, 'Gamtae Seaweed', '1717259210.png', 20, 1, 1, 'N/A', 120, 120, '2024-06-01 06:31:44', 17),
(41, ' Fried Seaweed Roll', '1717259223.png', 20, 1, 1, 'N/A', 195, 195, '2024-06-01 06:32:36', 17),
(42, ' HaeDamchon Young', '1717259351.png', 20, 1, 1, 'Radish Kimchi', 245, 245, '2024-06-01 06:33:31', 1),
(43, ' Kkakdugi', '1717257245.png', 10, 1, 1, ' Cubed Radish Kimchi', 450, 450, '2024-06-01 06:34:34', 1),
(44, 'Cafe Latte', '1717252014.png', 20, 1, 1, 'Canned Coffee', 85, 85, '2024-06-01 06:07:20', 12);

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

CREATE TABLE `product_cat` (
  `product_cat_id` int(11) NOT NULL,
  `product_cat_name` varchar(50) NOT NULL,
  `product_cat_desc` varchar(50) NOT NULL,
  `product_cat_image` varchar(191) NOT NULL,
  `product_status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`product_cat_id`, `product_cat_name`, `product_cat_desc`, `product_cat_image`, `product_status`) VALUES
(1, 'Kimchi', 'kimchi etoh', '1717241124.png', '1'),
(2, 'Frozen Goods bago', 'maagnuw na pagkaon', 'frozen-goods.png', '1'),
(3, 'Noodles', 'panset hahah', '1717241085.png', '1'),
(4, 'Sauces', 'patis at ibapa', 'sauces.png', '1'),
(12, 'Drinks', 'korean drinks', '1717241058.png', '1'),
(13, 'Processed Food', 'Ready to eat foods', '1717241034.png', '1'),
(14, 'Snacks', 'N/A', '1717220286.png', '1'),
(15, 'Rice/Grain', 'N/A', '1717240988.png', '1'),
(16, 'Life style', '', '1717223202.png', '1'),
(17, 'Seaweeds', '', '1717223414.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `shippers`
--

CREATE TABLE `shippers` (
  `shipper_id` int(11) NOT NULL,
  `shipping_company` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shippers`
--

INSERT INTO `shippers` (`shipper_id`, `shipping_company`) VALUES
(1, 'J&T EXPRESS'),
(2, 'FLASH EXPRESS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `customer_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`customer_id`, `username`, `email`, `password`, `firstname`, `lastname`, `age`, `address`, `contact_number`, `user_type`, `date_added`) VALUES
(16, 'admin', 'admin@gmail.com', 'admin', 'admin', 'barotilla', '21', 'Libon', '0987654321', 'A', '2024-05-17 14:55:40'),
(17, 'customer', 'customer@gmail.com', 'customer', 'customer', 'customer', '21', 'mars', '09876543212', 'C', '2024-05-17 15:01:05'),
(18, 'janet', 'janer', 'janet', 'janet', 'janet', '11', 'Libon', '9876543', 'A', '2024-05-24 06:09:54'),
(19, 'sample', 'sample@gmail.com', 'sample1', 'sam', 'mig', '20', 'zone 1', 'sample1', 'A', '2024-05-27 13:21:14'),
(20, 'rizza', 'tuscanorizza922@gmail.com', '12345', 'rizza', 'tuscano', '20', 'balinad', '09915300334', 'C', '2024-05-28 01:00:26'),
(21, 'sample2', 'sample@gmail.com', '123456', 'sam', 'ple', '20', 'zone 1 polangui', '09915300339', 'C', '2024-05-28 05:00:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_phase`
--
ALTER TABLE `order_phase`
  ADD PRIMARY KEY (`order_phase_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_cat`
--
ALTER TABLE `product_cat`
  ADD PRIMARY KEY (`product_cat_id`);

--
-- Indexes for table `shippers`
--
ALTER TABLE `shippers`
  ADD PRIMARY KEY (`shipper_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product_cat`
--
ALTER TABLE `product_cat`
  MODIFY `product_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `shippers`
--
ALTER TABLE `shippers`
  MODIFY `shipper_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
