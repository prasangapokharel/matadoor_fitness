-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2024 at 01:15 PM
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
-- Database: `matadoor_fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'Halla Noble', 'ryjyfi@mailinator.com', NULL, 'Quo rerum enim lauda', '2024-08-31 11:12:57'),
(2, 'Melvin Lowery', 'ryrojy@mailinator.com', NULL, 'Eaque libero accusam', '2024-08-31 12:43:27'),
(3, 'Melvin Lowery', 'ryrojy@mailinator.com', NULL, 'Eaque libero accusam', '2024-08-31 12:43:31'),
(4, 'Sylvia Richardson', 'feconu@mailinator.com', NULL, 'Alias dolore provide', '2024-09-01 15:49:56'),
(5, 'Prasanga Pokharel', 'incpractical@gmail.com', NULL, 'hi love', '2024-09-01 17:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_posts`
--

CREATE TABLE `gallery_posts` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_posts`
--

INSERT INTO `gallery_posts` (`id`, `image_path`, `description`, `created_at`) VALUES
(8, 'diet.png', 'Balanced Diet Plans for Optimal Health', '2024-09-01 08:24:51'),
(9, 'tredmil.png', 'Tredmil Section available now', '2024-09-01 08:29:42'),
(10, 'dumbell.png', 'High-Quality Dumbbells for Effective Workouts\r\n\r\n', '2024-09-01 08:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `gym_registrations`
--

CREATE TABLE `gym_registrations` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `emergency_name` varchar(255) NOT NULL,
  `emergency_phone` varchar(15) NOT NULL,
  `emergency_relationship` varchar(255) NOT NULL,
  `fitness_level` enum('beginner','intermediate','advanced') NOT NULL,
  `health_conditions` text DEFAULT NULL,
  `fitness_goals` text DEFAULT NULL,
  `membership_type` enum('monthly','yearly','family') NOT NULL,
  `training_sessions` enum('personal','group') NOT NULL,
  `referral_source` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `plan` enum('monthly','6 months','yearly') NOT NULL,
  `status` enum('Paid','Unpaid') DEFAULT 'Unpaid',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `days_left` int(11) DEFAULT 0,
  `duration` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_registrations`
--

INSERT INTO `gym_registrations` (`id`, `full_name`, `dob`, `gender`, `contact_number`, `email`, `address`, `emergency_name`, `emergency_phone`, `emergency_relationship`, `fitness_level`, `health_conditions`, `fitness_goals`, `membership_type`, `training_sessions`, `referral_source`, `created_at`, `plan`, `status`, `start_date`, `end_date`, `days_left`, `duration`) VALUES
(43, 'Upton Adams', '0000-00-00', 'male', '+1 (286) 987-29', 'kegune@mailinator.com', '', '', '', '', 'beginner', NULL, NULL, 'monthly', 'personal', '', '2024-09-05 11:04:17', 'monthly', 'Paid', NULL, '2024-10-05', 0, NULL),
(44, 'Russell Lopez', '0000-00-00', 'male', '+1 (339) 597-75', 'kujuq@mailinator.com', '', '', '', '', 'beginner', NULL, NULL, 'monthly', 'personal', '', '2024-09-05 11:05:00', 'yearly', 'Paid', NULL, '2025-09-05', 0, NULL),
(45, 'Sahil Malik', '0000-00-00', 'male', '984456334', 'Mohhamad@gmail.com', '', '', '', '', 'beginner', NULL, NULL, 'monthly', 'personal', '', '2024-09-05 11:11:45', 'monthly', 'Paid', NULL, '2024-10-05', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `type` enum('Monthly','Weekly','Yearly') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `price`, `type`, `created_at`) VALUES
(9, 'Monthly', 1500.00, '', '2024-09-05 11:03:58'),
(10, 'Yearly', 10000.00, '', '2024-09-05 11:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_title`, `meta_description`, `meta_keywords`) VALUES
(1, 'MATADOOR- Inaruwa No1 GYM', 'Best GYM of Nepal', 'fitness, web');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_posts`
--
ALTER TABLE `gallery_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gym_registrations`
--
ALTER TABLE `gym_registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gallery_posts`
--
ALTER TABLE `gallery_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gym_registrations`
--
ALTER TABLE `gym_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
