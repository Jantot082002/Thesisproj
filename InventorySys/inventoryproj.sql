-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 11:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventoryproj`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('Student','Teacher') NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `student_id` varchar(50) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowers`
--

INSERT INTO `borrowers` (`id`, `name`, `type`, `email`, `created_at`, `updated_at`, `student_id`, `grade`, `employee_id`, `department`) VALUES
(20, 'janjan', 'Student', 'nimrodbanayag2@gmail.com', '2024-07-28 10:06:10', '2024-07-28 10:06:10', '2113356', '4th year', '', ''),
(21, 'kakay', 'Teacher', 'kakay@gmail.con', '2024-07-28 10:06:20', '2024-07-28 10:06:20', '', '', '543233', 'cbit'),
(22, 'nana', 'Student', 'nana@gmail.com', '2024-08-02 09:51:59', '2024-08-02 09:51:59', '2113351', '1st year', '', ''),
(23, 'Rose', 'Student', 'rose@gmail.com', '2024-09-30 07:41:23', '2024-09-30 07:41:23', '2113506', '4th year', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_records`
--

CREATE TABLE `borrow_records` (
  `record_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrow_date` date NOT NULL,
  `borrower_type` enum('Student','Teacher','','') NOT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_records`
--

INSERT INTO `borrow_records` (`record_id`, `borrower_id`, `product_id`, `quantity`, `borrow_date`, `borrower_type`, `return_date`) VALUES
(47, 23, 63, 50, '2024-09-30', 'Student', NULL),
(48, 23, 63, 50, '0000-00-00', 'Student', '2024-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`) VALUES
(1, 'Tools and Equipments', '2024-07-27 10:34:07'),
(3, 'Foods', '2024-07-29 07:11:43'),
(4, 'Things', '2024-09-30 07:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `expired_products`
--

CREATE TABLE `expired_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `warehouse` enum('WareHouse A','WareHouse B','WareHouse C','') DEFAULT NULL,
  `row_number` int(11) NOT NULL,
  `column_number` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `expiration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expired_products`
--

INSERT INTO `expired_products` (`id`, `product_name`, `category`, `price`, `supplier`, `warehouse`, `row_number`, `column_number`, `quantity`, `created_at`, `expiration_date`) VALUES
(77, 'paper', 'Things', 25.00, 'Gogoy', '', 5, 3, 100, '2024-10-21 16:55:47', '2024-10-08');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `username`, `login_time`) VALUES
(1, 'Jantot', '2024-07-27 08:48:09'),
(2, 'admin', '2024-07-30 03:55:31'),
(3, 'janjan', '2024-07-30 04:15:16'),
(4, 'admin', '2024-07-30 04:19:14'),
(5, 'janjan', '2024-07-30 04:21:23'),
(6, 'admin', '2024-07-30 04:25:41'),
(7, 'janjan', '2024-07-30 07:38:44'),
(8, 'admin', '2024-07-30 07:39:49'),
(9, 'janjan', '2024-07-30 07:43:17'),
(10, 'admin', '2024-07-30 08:22:15'),
(11, 'admin', '2024-08-02 05:27:16'),
(12, 'janjan', '2024-08-02 07:09:56'),
(13, 'admin', '2024-08-02 07:17:47'),
(14, 'admin', '2024-08-02 07:31:39'),
(15, 'janjan', '2024-08-02 07:34:11'),
(16, 'admin', '2024-08-02 08:02:43'),
(17, 'janjan', '2024-08-02 10:01:55'),
(18, 'admin', '2024-08-03 05:00:45'),
(19, 'janjan', '2024-08-03 05:11:31'),
(20, 'admin', '2024-08-03 12:00:03'),
(21, 'admin', '2024-08-04 01:33:39'),
(22, 'admin', '2024-08-04 03:17:47'),
(23, 'admin', '2024-08-04 03:19:52'),
(24, 'admin', '2024-08-04 03:25:13'),
(25, 'admin', '2024-08-06 08:21:33'),
(26, 'admin', '2024-08-06 09:14:17'),
(27, 'admin', '2024-08-06 09:18:25'),
(28, 'janjan', '2024-08-06 10:09:04'),
(29, 'admin', '2024-08-06 10:11:25'),
(30, 'janjan', '2024-08-06 10:12:45'),
(31, 'admin', '2024-08-06 10:18:05'),
(32, 'admin', '2024-08-09 11:57:29'),
(33, 'admin', '2024-08-09 12:00:17'),
(34, 'janjan', '2024-08-09 13:49:06'),
(35, 'admin', '2024-08-10 05:51:47'),
(36, 'admin', '2024-08-10 06:01:29'),
(37, 'admin', '2024-08-14 05:05:00'),
(38, 'admin', '2024-08-14 05:06:48'),
(39, 'admin', '2024-08-14 08:29:17'),
(40, 'admin', '2024-08-31 09:01:46'),
(41, 'admin', '2024-08-31 09:08:18'),
(42, 'admin', '2024-08-31 09:12:03'),
(43, 'admin', '2024-08-31 09:12:45'),
(44, 'admin', '2024-08-31 10:40:43'),
(45, 'janjan', '2024-08-31 14:18:59'),
(46, 'admin', '2024-09-01 08:06:12'),
(47, 'janjan', '2024-09-01 08:22:08'),
(48, 'admin', '2024-09-01 08:24:21'),
(49, 'admin', '2024-09-01 08:30:54'),
(50, 'admin', '2024-09-30 07:18:08'),
(51, 'Jantot', '2024-09-30 07:23:57'),
(52, 'admin', '2024-10-01 09:04:27'),
(53, 'admin', '2024-10-21 03:43:44'),
(54, 'user', '2024-10-21 04:07:26'),
(55, 'admin', '2024-10-21 06:36:22'),
(56, 'admin', '2024-10-21 06:36:49'),
(57, 'admin', '2024-10-21 06:36:49'),
(58, 'admin', '2024-10-21 06:36:49'),
(59, 'user', '2024-10-21 07:15:48'),
(60, 'admin', '2024-10-21 08:46:58'),
(61, 'admin', '2024-10-21 08:46:58'),
(62, 'user', '2024-10-21 09:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `received_date` date DEFAULT NULL,
  `status` enum('Pending','Received') DEFAULT 'Pending',
  `delivery_duration` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `supplier_id`, `product_name`, `quantity`, `order_date`, `received_date`, `status`, `delivery_duration`) VALUES
(30, 21, 'phone', 5, '2024-08-14 06:00:53', '2024-08-14', 'Received', 0),
(33, 9, 'ballpen', 150, '2024-08-31 09:15:04', '2024-08-31', 'Received', 0),
(34, 10, 'bag', 300, '2024-08-31 09:15:14', '2024-08-31', 'Received', 0),
(35, 21, 'paper', 300, '2024-08-31 09:15:30', '2024-08-31', 'Received', 0),
(36, 7, 'dsaf', 12, '2024-10-21 06:59:30', NULL, 'Pending', 23);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `warehouse` enum('WareHouse A','WareHouse B','WareHouse C','') DEFAULT NULL,
  `row_number` int(11) DEFAULT NULL,
  `column_number` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `expiration_date` date DEFAULT NULL,
  `is_expired` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `category`, `price`, `supplier`, `created_at`, `warehouse`, `row_number`, `column_number`, `quantity`, `expiration_date`, `is_expired`) VALUES
(62, 'Gatas', 'Foods', 13.00, 'Rose', '2024-09-30 07:43:49', 'WareHouse A', 2, 3, 20, '2024-10-30', 0),
(63, 'Paper', 'Things', 25.00, 'Gogoy', '2024-09-30 07:46:34', 'WareHouse C', 2, 3, 100, '2024-11-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` int(11) NOT NULL,
  `purchase_code` varchar(255) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `idNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `email`, `username`, `password`, `role`, `created_at`, `profile_picture`) VALUES
(2, 'nimrodbanayag1@gmail.com', 'admin', '$2y$10$9N8u0xwnIQAX6Y4kdBWve.NoV5k/D1kpDTeq0fDREAI4F2S4W0FLy', 'admin', '2024-07-30 03:55:24', 'uploads/c0545b9bd69536f6c307c31d1f066d4e_1722223871360_0.webp.jpg'),
(3, 'janjanbanayag@yahoo.com', 'janjan', '$2y$10$24cybosrM7/2ChDLHh5Ngeltdsg8IE/J57ugzOfX9p57LAShWeS..', 'user', '2024-07-30 04:15:08', 'uploads/received_1125632258431337.jpeg'),
(4, 'nimrodbanayag3@gmail.com', 'Jantot', '$2y$10$Jht/KXTNi.H8MtLsTtpvyOh5DbM1ha4saV1oln1TfOedB4UEI8eN.', 'user', '2024-09-30 07:22:30', NULL),
(5, 'jantot@yahoo.com', 'janjan1', '$2y$10$IWo0uo12s58YF4D86VNW/.fA1fyDWHJP9aWOc3XXXyXACrkUudOOe', 'user', '2024-10-21 03:50:19', NULL),
(6, 'jan@gmail.com', 'user', '$2y$10$vH8yS87NtIolZfXl2A2FmecTr9NvZEIAm9mW7I1Mgc9pmm2AKmm5W', 'user', '2024-10-21 04:07:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `return_records`
--

CREATE TABLE `return_records` (
  `id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `subscribed_at`) VALUES
(1, 'nimrodbanayag1@gmail.com', '2024-09-01 09:11:59'),
(2, 'banayag1@gmail.com', '2024-09-01 09:13:50'),
(3, 'janjanbanayag@yahoo.com', '2024-09-01 09:30:31');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `SupplierID` int(11) NOT NULL,
  `SupplierName` varchar(255) NOT NULL,
  `SupplierContact` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`SupplierID`, `SupplierName`, `SupplierContact`, `CreatedAt`) VALUES
(7, 'kakay', '2147483647', '2024-07-27 12:32:30'),
(8, 'janjan', '09123435564', '2024-07-27 12:37:46'),
(9, 'jeboy', '09876675654', '2024-07-27 12:42:32'),
(10, 'Epor', '09123789456', '2024-07-29 07:12:04'),
(21, 'Gogoy', '09124375691', '2024-08-04 03:21:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `borrow_records`
--
ALTER TABLE `borrow_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `borrower_id` (`borrower_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `expired_products`
--
ALTER TABLE `expired_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `return_records`
--
ALTER TABLE `return_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrower_id` (`borrower_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`SupplierID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `borrow_records`
--
ALTER TABLE `borrow_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expired_products`
--
ALTER TABLE `expired_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `return_records`
--
ALTER TABLE `return_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `SupplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow_records`
--
ALTER TABLE `borrow_records`
  ADD CONSTRAINT `borrow_records_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`),
  ADD CONSTRAINT `borrow_records_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`SupplierID`);

--
-- Constraints for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD CONSTRAINT `purchase_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `return_records`
--
ALTER TABLE `return_records`
  ADD CONSTRAINT `return_records_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`),
  ADD CONSTRAINT `return_records_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
