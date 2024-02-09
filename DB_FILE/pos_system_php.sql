-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 09, 2024 at 02:34 PM
-- Server version: 10.6.15-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u744732095_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `is_ban` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not_ban,1=ban',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone`, `is_ban`, `created_at`, `role`) VALUES
(9, 'Admin', 'admin@gmail.com', '$2y$10$4tlLWIzQe.49hUzNCpw2jO5EIjuU8zNQmsdQREuS.3V3nqh20Ix0C', '09619874193', 0, '2024-02-06 03:29:43', 'Admin'),
(10, 'Cashier', 'cashier@gmail.com', '$2y$10$B4W0DvM3beKNeqDG13zPUeQhnanjZS7AR0S8F84bWSCPE9Jx/4HTK', '09698141230', 0, '2024-02-09 03:51:56', 'Cashier');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`) VALUES
(6, 'Canned Goods', '', 1),
(7, 'Frozen Goods', '', 0),
(8, 'Bread', '', 0),
(9, 'Dairy', '', 0),
(10, 'Personal Care', '', 0),
(11, 'Noodles', '', 0),
(12, 'Snacks', '', 0),
(13, 'Cleaning Supplies', '', 0),
(14, 'Condiments', '', 0),
(16, 'ice cream', 'cookies \\\'n cream flavor all goods', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `order_placed_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice_no`, `total_amount`, `order_date`, `order_placed_by_id`) VALUES
(19, 'INV-1707486495', '1388', '2024-02-08', 9),
(20, 'INV-1707486581', '957', '2024-02-09', 9),
(21, 'INV-1707487060', '1050', '2024-02-10', 9),
(22, 'INV-1707487412', '1120', '2024-02-11', 9),
(23, 'INV-1707487465', '2460', '2024-02-12', 9),
(24, 'INV-1707487570', '1226', '2024-02-13', 9),
(25, 'INV-1707487635', '1400', '2024-02-14', 9),
(26, 'INV-1707487701', '2390', '2024-02-15', 9),
(27, 'INV-1707487771', '2560', '2024-02-16', 9);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(19, 6, 9, 123, 20),
(20, 7, 9, 123, 20),
(21, 8, 10, 123, 1),
(22, 9, 9, 13, 1),
(23, 10, 9, 13, 1),
(24, 10, 11, 75, 10),
(25, 11, 9, 13, 2),
(26, 11, 12, 59, 3),
(27, 12, 13, 92, 1),
(28, 12, 11, 75, 1),
(29, 13, 9, 13, 1),
(30, 14, 11, 75, 1),
(31, 15, 13, 92, 1),
(32, 16, 13, 92, 2),
(33, 17, 12, 59, 1),
(34, 18, 14, 23, 1),
(35, 19, 12, 59, 1),
(36, 19, 14, 23, 3),
(37, 19, 16, 156, 5),
(38, 19, 34, 48, 10),
(39, 20, 37, 150, 3),
(40, 20, 32, 39, 3),
(41, 20, 34, 48, 3),
(42, 20, 43, 24, 6),
(43, 20, 48, 40, 1),
(44, 20, 17, 62, 1),
(45, 21, 28, 105, 10),
(46, 22, 22, 15, 12),
(47, 22, 42, 127, 1),
(48, 22, 48, 40, 12),
(49, 22, 45, 95, 3),
(50, 22, 30, 48, 1),
(51, 23, 34, 48, 20),
(52, 23, 37, 150, 10),
(53, 24, 31, 57, 3),
(54, 24, 49, 55, 7),
(55, 24, 47, 670, 1),
(56, 25, 40, 93, 10),
(57, 25, 33, 31, 5),
(58, 25, 28, 105, 3),
(59, 26, 18, 167, 10),
(60, 26, 34, 48, 15),
(61, 27, 38, 53, 10),
(62, 27, 39, 35, 10),
(63, 27, 40, 93, 10),
(64, 27, 37, 150, 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `quantity`, `image`, `status`, `created_at`) VALUES
(9, 13, 'Tide Bar Original Scent 125g', '', 13, 5, 'assets/uploads/products/1707365391.jpg', 1, '2024-02-08 04:09:51'),
(11, 5, 'Coca Cola Regular 1.5L', '', 75, 0, 'assets/uploads/products/1707453488.webp', 0, '2024-02-09 03:06:46'),
(12, 8, 'Gardenia White Classic 400g', '', 59, 4, 'assets/uploads/products/1707453559.png', 0, '2024-02-09 03:09:12'),
(13, 5, 'Mug Root Beer 2L', '', 92, 1, 'assets/uploads/products/1707453631.jpg', 0, '2024-02-09 03:13:34'),
(14, 6, 'Century Tuna Flakes in Oil 95g', '', 23, 6, 'assets/uploads/products/1707453694.jpg', 0, '2024-02-09 03:15:02'),
(15, 6, 'Century Tuna Hot and Spicy 420g', '', 96, 13, 'assets/uploads/products/1707453745.jpg', 0, '2024-02-09 03:16:33'),
(16, 7, 'Purefoods Tender Juicy Hotdog Classic 500g', '', 156, 3, 'assets/uploads/products/1707453806.webp', 0, '2024-02-09 03:20:53'),
(17, 7, 'Oreo Ice Cream Cone', '', 62, 14, 'assets/uploads/products/1707453858.jpg', 0, '2024-02-09 03:22:18'),
(18, 7, 'Selecta Double Dutch 750mL', '', 167, 2, 'assets/uploads/products/1707453932.avif', 0, '2024-02-09 03:23:29'),
(19, 12, 'Clover Chips Cheese 85g', '', 42, 11, 'assets/uploads/products/1707453981.jpg', 0, '2024-02-09 03:26:56'),
(20, 12, 'Skyflakes Crackers 24 Packs', '', 127, 6, 'assets/uploads/products/1707454029.jpg', 0, '2024-02-09 03:28:10'),
(21, 11, 'Lucky Me Pancit Canton Sweet & Spicy 80g', '', 15, 20, 'assets/uploads/products/1707454094.jpg', 0, '2024-02-09 03:30:44'),
(22, 11, 'Lucky Me Pancit Canton Chilimansi 80g', '', 15, 2, 'assets/uploads/products/1707464054.jpeg', 0, '2024-02-09 07:34:14'),
(23, 13, 'Femme Tissue 12 Rolls 2ply', '', 127, 6, 'assets/uploads/products/1707464167.jpeg', 0, '2024-02-09 07:36:07'),
(24, 13, 'Cheers Trash Bag Black Small', '', 23, 22, 'assets/uploads/products/1707464269.jpeg', 0, '2024-02-09 07:37:49'),
(25, 13, 'Cheers Trash Bag Black Medium', '', 34, 24, 'assets/uploads/products/1707464309.jpeg', 0, '2024-02-09 07:38:29'),
(26, 13, 'Cheers Trash Bag Black Large', '', 46, 17, 'assets/uploads/products/1707464339.jpeg', 0, '2024-02-09 07:38:59'),
(27, 9, 'Dari Creme Classic 225g', '', 70, 20, 'assets/uploads/products/1707465647.png', 0, '2024-02-09 08:00:47'),
(28, 9, 'Nestle Fresh Milk 1L', '', 105, 2, 'assets/uploads/products/1707465820.webp', 0, '2024-02-09 08:03:40'),
(29, 10, 'Hana Shampoo Garden Blooms and Lychees Scent 200ml', '', 94, 30, 'assets/uploads/products/1707466338.webp', 0, '2024-02-09 08:12:18'),
(30, 14, 'Silver Swan Soy Sauce 1L', '', 48, 22, 'assets/uploads/products/1707466733.webp', 0, '2024-02-09 08:18:53'),
(31, 9, 'Eden Cheese Original 160g', '', 57, 52, 'assets/uploads/products/1707466856.webp', 0, '2024-02-09 08:20:56'),
(32, 12, 'Calbee Honey Butter Potato Chips 60g', '', 39, 57, 'assets/uploads/products/1707466949.webp', 0, '2024-02-09 08:22:29'),
(33, 12, 'Cheezy Corn Crunch 70g', '', 31, 65, 'assets/uploads/products/1707467110.jpg', 0, '2024-02-09 08:25:10'),
(34, 9, 'Nestle Yogurt Blissful Berry Mix 125g', '', 48, 9, 'assets/uploads/products/1707467212.webp', 0, '2024-02-09 08:26:52'),
(35, 13, 'Ariel Power Liquid Detergent Sunrise Fresh 810g', '', 200, 74, 'assets/uploads/products/1707467492.webp', 0, '2024-02-09 08:31:32'),
(36, 9, 'Anchor Cheese Singles 200G', '', 247, 46, 'assets/uploads/products/1707467552.jpg', 0, '2024-02-09 08:32:32'),
(37, 9, 'Magnolia Gold Butter Unsalted 225G', '', 150, 38, 'assets/uploads/products/1707467774.jpg', 0, '2024-02-09 08:33:38'),
(38, 14, 'Silver Swan Vinegar 1L', '', 53, 32, 'assets/uploads/products/1707467949.jpg', 0, '2024-02-09 08:39:09'),
(39, 14, 'Del Monte Original Blend Ketchup', '', 35, 8, 'assets/uploads/products/1707468043.png', 0, '2024-02-09 08:40:43'),
(40, 14, 'Lady\'s Choice Regular Mayonaise 220ml', '', 93, 29, 'assets/uploads/products/1707468105.webp', 0, '2024-02-09 08:41:45'),
(41, 14, 'Jufran Red Hot Chili Sauce 165g', '', 45, 67, 'assets/uploads/products/1707468165.jpg', 0, '2024-02-09 08:42:45'),
(42, 14, 'CJ Gold Gochujang (Chili Paste) 200g', '', 127, 30, 'assets/uploads/products/1707468226.webp', 0, '2024-02-09 08:43:46'),
(43, 14, 'Silver Swan Patis Seasoning 350ML', '', 24, 78, 'assets/uploads/products/1707468286.png', 0, '2024-02-09 08:44:46'),
(44, 8, 'Marby Cheese Bread Bites', '', 44, 21, 'assets/uploads/products/1707469211.jpg', 0, '2024-02-09 09:00:11'),
(45, 8, 'High Fiber Whole Wheat Bread 600g', '', 95, 81, 'assets/uploads/products/1707470065.png', 0, '2024-02-09 09:14:25'),
(46, 10, 'Safeguard Soap Lemon 135g', '', 50, 7, 'assets/uploads/products/1707470189.webp', 0, '2024-02-09 09:15:32'),
(47, 10, 'Dove Body Wash Sensitive Skin 1L', '', 670, 47, 'assets/uploads/products/1707470253.jpg', 0, '2024-02-09 09:17:33'),
(48, 12, 'Oishi Gourmet Potato Chips Salted Egg 60g', '', 40, 68, 'assets/uploads/products/1707470326.jpg', 0, '2024-02-09 09:18:46'),
(49, 8, 'Gardenia Hamburger Buns 325G', '', 55, 26, 'assets/uploads/products/1707470380.jpg', 0, '2024-02-09 09:19:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
