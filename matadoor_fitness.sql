-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 04:47 PM
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
(3, 'Melvin Lowery', 'ryrojy@mailinator.com', NULL, 'Eaque libero accusam', '2024-08-31 12:43:31');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_registrations`
--

INSERT INTO `gym_registrations` (`id`, `full_name`, `dob`, `gender`, `contact_number`, `email`, `address`, `emergency_name`, `emergency_phone`, `emergency_relationship`, `fitness_level`, `health_conditions`, `fitness_goals`, `membership_type`, `training_sessions`, `referral_source`, `created_at`) VALUES
(12, 'Sierra Butler', '1995-02-08', 'female', '+1 (852) 207-14', 'kafipyrepi@mailinator.com', 'Vero cupiditate vel ', 'Craig Frazier', '+1 (305) 513-96', 'Ullamco voluptatem f', 'beginner', 'Commodo amet ullam ', 'Ipsum quisquam rem e', 'yearly', 'group', 'Nostrum aspernatur m', '2024-08-31 14:31:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gym_registrations`
--
ALTER TABLE `gym_registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gym_registrations`
--
ALTER TABLE `gym_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
