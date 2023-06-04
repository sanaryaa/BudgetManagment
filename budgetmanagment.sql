-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2023 at 09:30 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budgetmanagment`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow_items`
--

CREATE TABLE `borrow_items` (
  `borrow_id` int(11) NOT NULL,
  `person_name` varchar(65) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `food_id` int(11) NOT NULL,
  `item_name` varchar(65) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`food_id`, `item_name`, `price`, `date`, `user_id`) VALUES
(134, 'moz', 3, '2023-06-06', 22);

-- --------------------------------------------------------

--
-- Table structure for table `health_items`
--

CREATE TABLE `health_items` (
  `health_id` int(11) NOT NULL,
  `item_name` varchar(65) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lent_items`
--

CREATE TABLE `lent_items` (
  `lent_id` int(11) NOT NULL,
  `person_name` varchar(65) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_items`
--

CREATE TABLE `other_items` (
  `others_id` int(11) NOT NULL,
  `item_name` varchar(65) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_items`
--

CREATE TABLE `shopping_items` (
  `shop_id` int(11) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopping_items`
--

INSERT INTO `shopping_items` (`shop_id`, `item_name`, `price`, `date`, `user_id`) VALUES
(20, 'fast', 1, '2023-05-02', 7),
(22, 'skirt', 15, '2023-06-08', 22);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `last_name` varchar(65) NOT NULL,
  `username` varchar(65) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(5) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `role`, `password`) VALUES
(16, 'sanarya', 'hamakarim', 'sanarya', 'sanarya@gmail.com', 'admin', '$2y$10$66D7Q.a1KDUBha5Hrj0QWefZcG15ntMpjcrpwDHnD82tqOMZLY.n.'),
(17, 'Eman', 'jamal', 'emanjse', 'emanjse@gmail.com', 'admin', '$2y$10$xOAOHl4JyNAlId2fINjOeugmrFUtCfsCdt7ENkiTQ8XydzKj2GhQ.'),
(21, 'sanarya', 'hamakrim', 'sanaaa', 'sanarya1@gmail.com', 'user', '$2y$10$8xoelZuP.Gy363imX2bVSOyA/.goRbUqSsXpYb3H3SXPB4KxSG.e2'),
(22, 'shnya', 'ali', 'shniaaa', 'shnia@gmail.com', 'user', '$2y$10$zVb6OJmPhtSFuh.XLlZUFOXPWQwxXjY89Ja/oAy4JTf/tPMPs6jiS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrow_items`
--
ALTER TABLE `borrow_items`
  ADD PRIMARY KEY (`borrow_id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `health_items`
--
ALTER TABLE `health_items`
  ADD PRIMARY KEY (`health_id`);

--
-- Indexes for table `lent_items`
--
ALTER TABLE `lent_items`
  ADD PRIMARY KEY (`lent_id`);

--
-- Indexes for table `other_items`
--
ALTER TABLE `other_items`
  ADD PRIMARY KEY (`others_id`);

--
-- Indexes for table `shopping_items`
--
ALTER TABLE `shopping_items`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrow_items`
--
ALTER TABLE `borrow_items`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `health_items`
--
ALTER TABLE `health_items`
  MODIFY `health_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lent_items`
--
ALTER TABLE `lent_items`
  MODIFY `lent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `other_items`
--
ALTER TABLE `other_items`
  MODIFY `others_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shopping_items`
--
ALTER TABLE `shopping_items`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
