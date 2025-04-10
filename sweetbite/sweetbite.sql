-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2025 at 10:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sweetbite`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `place` varchar(255) NOT NULL,
  `slots` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `name`, `date`, `time`, `fee`, `place`, `slots`, `image`, `description`) VALUES
(4, 'fondant workshop', '2025-04-05', '10:30:00', 400.00, 'sweetbite', 3, 'about.jpg', 'cake fondant workshop for nandhini'),
(5, 'Cream making', '2025-04-05', '14:00:00', 500.00, 'sweetbite', 15, 'aneta-voborilova-YfMr24OQW6U-unsplash.jpg', 'Cake cream workshop');

-- --------------------------------------------------------

--
-- Table structure for table `cake_registration`
--

CREATE TABLE `cake_registration` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `slot` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `experience` varchar(10) DEFAULT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cake_registration`
--

INSERT INTO `cake_registration` (`id`, `name`, `email`, `phone`, `slot`, `age`, `experience`, `registered_at`) VALUES
(1, 'Makanesha Vadivel', 'makaneshav.22msc@kongu.edu', '08940089119', 'weekday9-12', 32, 'Yes', '2025-03-27 11:49:20'),
(2, 'Mansa', 'makaneshav.22msc@kongu.edu', '8940089119', 'weekday9-12', 15, 'Yes', '2025-03-27 11:53:05'),
(3, 'ragavi', 'ragavit.22msc@kongu.edu', '6380601352', 'weekday2-5', 20, 'No', '2025-04-03 09:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `combo_registration`
--

CREATE TABLE `combo_registration` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `slot` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `experience` varchar(10) DEFAULT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `combo_registration`
--

INSERT INTO `combo_registration` (`id`, `name`, `email`, `phone`, `slot`, `age`, `experience`, `registered_at`) VALUES
(1, 'Makanesha V', 'makaneshamanasa@gmail.com', '8940089119', 'weekday2-5', 22, 'No', '2025-04-02 09:56:38');

-- --------------------------------------------------------

--
-- Table structure for table `cookie_registration`
--

CREATE TABLE `cookie_registration` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `slot` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `experience` varchar(10) DEFAULT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cookie_registration`
--

INSERT INTO `cookie_registration` (`id`, `name`, `email`, `phone`, `slot`, `age`, `experience`, `registered_at`) VALUES
(1, 'Makanesha Vadivel', 'makaneshamanasa@gmail.com', '8940089119', 'weekend2-5', 22, 'No', '2025-04-03 07:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` enum('piece','g','kg') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `quantity`, `unit`) VALUES
(1, 'vanilla cupcake', 20.00, 2, 'piece'),
(2, 'Red velvet cupcake', 30.00, 1, 'piece'),
(4, 'Macroons', 30.00, 1, 'piece'),
(5, 'chocolate cupcake', 15.00, 1, 'piece');

-- --------------------------------------------------------

--
-- Table structure for table `pastry_registration`
--

CREATE TABLE `pastry_registration` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `slot` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `experience` varchar(10) DEFAULT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pastry_registration`
--

INSERT INTO `pastry_registration` (`id`, `name`, `email`, `phone`, `slot`, `age`, `experience`, `registered_at`) VALUES
(1, 'Makanesha Vadivel', 'makaneshamanasa@gmail.com', '8940089119', 'weekend9-12', 20, 'Yes', '2025-03-28 06:04:16'),
(2, 'Makanesha Vadivel', 'makaneshamanasa@gmail.com', '8940089119', 'weekday2-5', 20, 'No', '2025-03-30 03:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`) VALUES
(1, 'Makanesha', 'makaneshamanasa@gmail.com', '8940089119', '$2y$10$1sXoJHz8f8l5aynUotcFvOmW9DZaTI1wkkYX09QJ/LAZPMiz3OTSK'),
(5, 'Subiksha', 'subikshapr.22msc@kongu.edu', '9924251696', '$2y$10$w5OW0siMmvHCM12dOPB8HOQWfHkD4qbQVNncSlwJ5I95gCTahAIBm'),
(6, 'nandhini', 'nandhiniv.22msc@kongu.edu', '7200852922', '$2y$10$20RzvS.wtVfoFuS/XI8X9.8tfzZ2vZ6a9HcR9URw1YqJOGGYvO8G6'),
(7, 'ragavi', 'ragavit.22msc@kongu.edu', '6380601352', '$2y$10$tc429c6xw/J5p8jFGX84tuivRgG60SW58irHEOkkCOsYjnDjWx94.');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_registrations`
--

CREATE TABLE `workshop_registrations` (
  `id` int(11) NOT NULL,
  `announcement_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `availability` varchar(10) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshop_registrations`
--

INSERT INTO `workshop_registrations` (`id`, `announcement_id`, `name`, `email`, `phone`, `availability`, `registration_date`) VALUES
(1, 4, 'Makanesha Vadivel', 'makaneshav.22msc@kongu.edu', '08940089119', 'Yes', '2025-03-28 10:11:57'),
(2, 5, 'Makanesha Vadivel', 'sanmathys.22msc@kongu.edu', '8940089119', 'Yes', '2025-03-28 10:14:13'),
(3, 4, 'Subiksha', 'subikshapr.22msc@kongu.edu', '9942451696', 'Yes', '2025-03-28 10:26:43'),
(4, 4, 'Subiksha', 'sanmathys.22msc@kongu.edu', '08940089119', 'Yes', '2025-04-03 07:15:01'),
(5, 5, 'ragavi', 'ragavit.22msc@kongu.edu', '6380601352', 'Yes', '2025-04-03 09:19:08'),
(6, 5, 'ragavi', 'ragavit.22msc@kongu.edu', '6380601352', 'Yes', '2025-04-03 09:48:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cake_registration`
--
ALTER TABLE `cake_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `combo_registration`
--
ALTER TABLE `combo_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_registration`
--
ALTER TABLE `cookie_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pastry_registration`
--
ALTER TABLE `pastry_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workshop_registrations`
--
ALTER TABLE `workshop_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcement_id` (`announcement_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cake_registration`
--
ALTER TABLE `cake_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `combo_registration`
--
ALTER TABLE `combo_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cookie_registration`
--
ALTER TABLE `cookie_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pastry_registration`
--
ALTER TABLE `pastry_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `workshop_registrations`
--
ALTER TABLE `workshop_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `workshop_registrations`
--
ALTER TABLE `workshop_registrations`
  ADD CONSTRAINT `workshop_registrations_ibfk_1` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
