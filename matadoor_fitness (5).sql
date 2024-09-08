-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 01:25 PM
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

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `image_path`, `description`, `created_at`) VALUES
(21, 'loading.9fb7e9bb.gif', '<p>Flowbite is an open-source library of UI components based on the utility-first Tailwind CSS framework featuring dark mode support, a Figma design system, templates, and more.</p>\r\n<p>It includes all of the commonly used components that a website requires, such as buttons, dropdowns, navigation bars, modals, but also some more advanced interactive elements such as datepickers.</p>\r\n<p>All of the elements are built using the utility classes from Tailwind CSS and vanilla JavaScript with support for TypeScript.</p>', '2024-09-08 10:03:42'),
(22, 'canvas-slogan.96f0e860.gif', '<p>Flowbite डार्क मोड समर्थन, Figma डिजाइन प्रणाली, टेम्प्लेटहरू, र थप विशेषताहरू उपयोगिता-पहिलो Tailwind CSS फ्रेमवर्कमा आधारित UI कम्पोनेन्टहरूको खुला स्रोत पुस्तकालय हो।</p>\r\n<p>यसमा बटनहरू, ड्रपडाउनहरू, नेभिगेसन बारहरू, मोडलहरू, तर डेटपिकरहरू जस्ता थप उन्नत अन्तरक्रियात्मक तत्वहरू जस्ता वेबसाइटलाई आवश्यक पर्ने सबै सामान्य रूपमा प्रयोग हुने कम्पोनेन्टहरू समावेश हुन्छन्।</p>\r\n<p>सबै तत्वहरू TypeScript को लागि समर्थन सहित Tailwind CSS र vanilla JavaScript बाट उपयोगिता वर्गहरू प्रयोग गरेर बनाइएका छन्।</p>', '2024-09-08 10:15:29');

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
  `emergency_phone` varchar(15) NOT NULL,
  `fitness_level` enum('beginner','intermediate','advanced') NOT NULL,
  `health_conditions` text DEFAULT NULL,
  `membership_type` enum('monthly','yearly','family') NOT NULL,
  `training_sessions` enum('personal','group') NOT NULL,
  `referral_source` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Paid','Unpaid') DEFAULT 'Unpaid',
  `start_date` date DEFAULT NULL,
  `days_left` int(11) DEFAULT 0,
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `plan_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_registrations`
--

INSERT INTO `gym_registrations` (`id`, `full_name`, `dob`, `gender`, `contact_number`, `email`, `address`, `emergency_phone`, `fitness_level`, `health_conditions`, `membership_type`, `training_sessions`, `referral_source`, `created_at`, `status`, `start_date`, `days_left`, `plan_id`, `plan_name`, `duration`, `plan_end_date`) VALUES
(72, 'Griffith Mcfarland', '2012-06-29', 'other', '+1 (951) 741-13', 'towezuso@mailinator.com', '', '+1 (232) 284-20', 'intermediate', 'Aut aspernatur esse ', 'monthly', 'personal', 'Dicta tempora volupt', '2024-09-07 14:13:39', 'Paid', NULL, 0, 16, 'Monthly', 30, NULL),
(73, 'Yardley Ballard', '1977-03-05', 'other', '+1 (125) 133-41', 'jozuwaxize@mailinator.com', '', '+1 (797) 681-24', 'intermediate', 'Duis ex reprehenderi', 'monthly', 'personal', 'Esse tempore quia ', '2024-09-07 14:25:21', 'Unpaid', NULL, 0, 14, 'Monthly', 30, NULL),
(74, 'Patrick Cox', '1990-02-24', 'male', '+1 (309) 961-58', 'lyqoxyq@mailinator.com', '', '+1 (235) 403-44', 'beginner', 'Ut consectetur quam ', 'monthly', 'personal', 'Eos corporis vitae l', '2024-09-07 14:27:33', 'Paid', NULL, 0, 15, 'Yearly', 365, NULL),
(75, 'Arsenio Monroe', '1980-05-05', 'female', '+1 (392) 597-36', 'cezyz@mailinator.com', 'Placeat quas dolore', '', 'intermediate', 'Sed dolor modi amet', 'monthly', 'group', 'Eveniet quia nostru', '2024-09-07 15:20:12', 'Paid', NULL, 0, 15, '', NULL, NULL),
(76, 'Idola Peterson', '2002-05-23', 'female', '+1 (155) 477-69', 'kaselizumu@mailinator.com', '', '+1 (215) 323-50', 'advanced', 'Dolores amet fugiat', 'monthly', 'personal', 'Labore duis ea nihil', '2024-09-07 15:32:59', 'Paid', NULL, 0, 15, 'Yearly', 365, NULL),
(77, 'Prasanga Raman Pokharel', '1992-03-11', 'male', '+1 (897) 454-93', 'xigu@mailinator.com', '', '+1 (835) 816-73', 'intermediate', 'Quod cupiditate fugi', 'monthly', 'personal', 'Eaque amet et conse', '2024-09-07 15:50:16', 'Paid', NULL, 0, 16, 'Half Year', 182, NULL),
(78, 'Igor Reilly', '1989-01-05', 'other', '+1 (865) 222-77', 'sagytaze@mailinator.com', 'Iure sit aut quo cor', '', 'intermediate', 'Magna consequatur d', 'yearly', 'personal', 'Adipisicing in esse', '2024-09-07 17:18:47', 'Paid', NULL, 0, 14, '', NULL, NULL),
(79, 'Delilah Booth', '2001-07-21', 'other', '+1 (143) 413-70', 'cejiciso@mailinator.com', '', '+1 (897) 894-32', 'intermediate', 'Anim quo earum sit ', 'monthly', 'personal', 'Ut inventore exceptu', '2024-09-07 17:19:15', 'Paid', NULL, 0, 15, 'Yearly', 365, NULL),
(80, 'Willow Carson', '1996-09-28', 'male', '+1 (293) 904-85', 'vigykuh@mailinator.com', 'Consectetur voluptat', '', 'intermediate', 'Provident ut sed ma', 'yearly', 'group', 'Voluptate ut ullamco', '2024-09-07 17:26:59', 'Paid', NULL, 0, 15, '', NULL, NULL),
(81, 'Simon Spears', '1986-02-21', 'female', '+1 (665) 518-77', 'sadaf@mailinator.com', '', '+1 (536) 365-31', 'beginner', 'Aliqua Eos enim mo', 'monthly', 'personal', 'Hic ad ut quia eum s', '2024-09-08 10:13:36', 'Paid', NULL, 0, 14, 'Monthly', 30, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `qr_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `logo`, `currency`, `qr_code`) VALUES
(1, 'Khalti', 'download (3).png', 'NPR', NULL),
(2, 'Khalti', 'download (3).png', 'NPR', NULL),
(3, 'Khalti', 'download (3).png', 'NPR', NULL),
(4, 'Khalti', 'download (3).png', 'NPR', NULL),
(5, 'Esewa', 'download esewa.jpeg', 'NPR', 'images333.png');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `price`, `duration`, `created_at`) VALUES
(14, 'Monthly', 1500.00, 30, '2024-09-07 12:51:14'),
(15, 'Yearly', 10000.00, 365, '2024-09-07 12:51:29'),
(16, 'Half Year', 5000.00, 182, '2024-09-07 15:49:53');

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
(1, 'MATADOOR- Inaruwa No1 GYM', 'jh', 'fitness');

-- --------------------------------------------------------

--
-- Table structure for table `visit_logs`
--

CREATE TABLE `visit_logs` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `visit_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visit_logs`
--

INSERT INTO `visit_logs` (`id`, `ip_address`, `visit_time`, `country`) VALUES
(1, '::1', '2024-09-08 08:08:40', NULL),
(2, '::1', '2024-09-08 08:17:26', NULL),
(3, '::1', '2024-09-08 08:26:09', 'Unknown'),
(4, '::1', '2024-09-08 08:48:44', 'Unknown'),
(5, '::1', '2024-09-08 09:55:30', 'Unknown'),
(6, '::1', '2024-09-08 10:04:56', 'Unknown'),
(7, '::1', '2024-09-08 10:16:18', 'Unknown'),
(8, '::1', '2024-09-08 10:29:40', 'Unknown'),
(9, '::1', '2024-09-08 10:34:12', 'Unknown'),
(10, '::1', '2024-09-08 10:34:48', 'Unknown'),
(11, '::1', '2024-09-08 10:34:54', 'Unknown'),
(12, '::1', '2024-09-08 10:35:13', 'Unknown');

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
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `visit_logs`
--
ALTER TABLE `visit_logs`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `gallery_posts`
--
ALTER TABLE `gallery_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gym_registrations`
--
ALTER TABLE `gym_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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

--
-- AUTO_INCREMENT for table `visit_logs`
--
ALTER TABLE `visit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_plan_durations` ON SCHEDULE EVERY 1 DAY STARTS '2024-09-07 20:05:32' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    -- Update the plan end dates based on the duration
    UPDATE gym_registrations
    SET plan_end_date = DATE_SUB(plan_end_date, INTERVAL 1 DAY)
    WHERE plan_end_date IS NOT NULL AND plan_end_date < NOW();
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
