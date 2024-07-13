-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 09:15 AM
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
-- Database: `event_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `no_of_awards` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `name`, `no_of_awards`, `event_id`) VALUES
(1, 'Certificate of Participation', 1, 4),
(2, 'Certificate of completion', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

CREATE TABLE `campuses` (
  `id` int(11) NOT NULL,
  `campus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campuses`
--

INSERT INTO `campuses` (`id`, `campus`) VALUES
(1, 'Tapesia'),
(2, 'Azara'),
(3, 'Kharguli');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept`, `school_id`) VALUES
(1, 'Department of Computer Applications', 1),
(3, 'Department of Computer Science and Engineering', 1),
(4, 'Department of Civil Engineering', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `enrollment_no` varchar(256) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `phone` varchar(256) NOT NULL,
  `type` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `fee_payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `enrollment_no`, `event_id`, `name`, `phone`, `type`, `date`, `fee_payment`) VALUES
(1, '2406101136054', 4, 'Ashish Toppo', '09864134261', 1, '2024-06-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_add_det`
--

CREATE TABLE `enrollment_add_det` (
  `id` int(11) NOT NULL,
  `enrollment_no` varchar(256) NOT NULL,
  `event_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `field_value` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment_add_det`
--

INSERT INTO `enrollment_add_det` (`id`, `enrollment_no`, `event_id`, `field_id`, `field_value`) VALUES
(1, '2406101136054', 4, 1, 'ashishtoppo8958@gmail.com'),
(2, '2406101136054', 4, 2, 'dengaon, karbi anglong, assam');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_details`
--

CREATE TABLE `enrollment_details` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `field_name` varchar(256) NOT NULL,
  `field_type` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment_details`
--

INSERT INTO `enrollment_details` (`id`, `event_id`, `field_name`, `field_type`) VALUES
(1, 4, 'Email', 'email'),
(2, 4, 'address', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_types`
--

CREATE TABLE `enrollment_types` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `enrollment_type` varchar(256) NOT NULL,
  `enrollment_charges` varchar(256) NOT NULL,
  `enrollment_charges_curr` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment_types`
--

INSERT INTO `enrollment_types` (`id`, `event_id`, `enrollment_type`, `enrollment_charges`, `enrollment_charges_curr`) VALUES
(1, 4, 'participant', '200', 'INR');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(256) NOT NULL,
  `event_description` text NOT NULL,
  `one_day_event` int(11) NOT NULL,
  `public` int(11) NOT NULL,
  `logo` varchar(256) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `updated_on` date NOT NULL,
  `enrollment_details` int(11) NOT NULL,
  `enrollment` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `ended` int(11) NOT NULL DEFAULT 0,
  `need_enrollment` int(11) NOT NULL DEFAULT 1,
  `theme` int(11) NOT NULL DEFAULT 1,
  `dept_id` int(11) NOT NULL DEFAULT 0,
  `school_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_description`, `one_day_event`, `public`, `logo`, `created_by`, `created_on`, `updated_on`, `enrollment_details`, `enrollment`, `active`, `ended`, `need_enrollment`, `theme`, `dept_id`, `school_id`) VALUES
(3, 'New Event', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has sur', 0, 1, '/default_items/event_logo.png', 1, '2024-05-27', '2024-05-27', 0, 0, 1, 0, 0, 2, 0, 0),
(4, 'hello world', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, con', 0, 0, '/default_items/event_logo.png', 1, '2024-05-27', '2024-05-27', 0, 0, 0, 1, 0, 1, 0, 0),
(5, 'New Event CA', 'v asfdscd', 0, 1, '/default_items/event_logo.png', 1, '2024-06-05', '2024-06-05', 0, 0, 1, 0, 0, 1, 1, 1),
(6, 'kjhkjbkj', '/,n.nklnm', 0, 1, '/default_items/event_logo.png', 1, '2024-06-06', '2024-06-06', 0, 0, 1, 0, 0, 1, 0, 1),
(7, 'hello world 3', 'hello world 3', 1, 1, '/default_items/event_logo.png', 1, '2024-06-09', '2024-06-09', 0, 0, 1, 0, 0, 1, 1, 1),
(8, 'hello world 6', 'hello world 6', 1, 1, '/default_items/event_logo.png', 1, '2024-06-09', '2024-06-09', 0, 0, 1, 0, 0, 1, 0, 0),
(9, 'hello world 9', 'this is updated', 1, 1, '/default_items/event_logo.png', 1, '2024-06-09', '2024-06-09', 0, 0, 1, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_det`
--

CREATE TABLE `event_det` (
  `event_id` int(11) NOT NULL,
  `requires_portal` int(11) NOT NULL,
  `need_enrollment` int(11) NOT NULL,
  `offer_certificate` int(11) NOT NULL,
  `need_enroll_charge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_timings`
--

CREATE TABLE `event_timings` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `one_day_event` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_timings`
--

INSERT INTO `event_timings` (`id`, `event_id`, `one_day_event`, `start_date`, `end_date`, `start_time`, `end_time`) VALUES
(1, 3, 0, '2024-05-28', '2024-05-29', NULL, NULL),
(2, 4, 0, '2024-06-10', '2024-06-19', NULL, NULL),
(3, 5, 0, '2024-06-04', '2024-06-07', NULL, NULL),
(4, 6, 0, '2024-06-06', '2024-06-14', NULL, NULL),
(5, 7, 1, '2024-06-12', '2024-06-12', '00:00:00', '00:00:00'),
(6, 8, 1, '2024-06-10', '2024-06-10', '00:00:00', '00:00:00'),
(7, 9, 1, '2024-06-20', '2024-06-20', '01:10:00', '01:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `multi_day_event_date`
--

CREATE TABLE `multi_day_event_date` (
  `id` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `one_day_event_date`
--

CREATE TABLE `one_day_event_date` (
  `id` int(11) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `date_on` date NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` mediumtext NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `school` varchar(50) NOT NULL,
  `campus_id` int(11) NOT NULL,
  `color` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `school`, `campus_id`, `color`) VALUES
(0, 'default', 0, '#464a47'),
(1, 'School of Technology', 2, '#4da163'),
(2, 'School of Humanities and Social Sciences', 1, '#4d8fd1'),
(3, 'School of Fundamental and Applied Science', 1, '#8a5691'),
(4, 'School of Commerce and Management', 2, '#a1904f'),
(5, 'School of Life Sciences', 1, '#bf34b1');

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE `winners` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `prize_id` int(11) NOT NULL,
  `winner_id` int(11) NOT NULL,
  `certificate_no` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `winners`
--

INSERT INTO `winners` (`id`, `event_id`, `prize_id`, `winner_id`, `certificate_no`) VALUES
(10, 4, 1, 1, '41143809'),
(11, 4, 2, 1, '42190876'),
(12, 4, 2, 1, '42148702');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campuses`
--
ALTER TABLE `campuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `en_no` (`enrollment_no`);

--
-- Indexes for table `enrollment_add_det`
--
ALTER TABLE `enrollment_add_det`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment_details`
--
ALTER TABLE `enrollment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment_types`
--
ALTER TABLE `enrollment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_timings`
--
ALTER TABLE `event_timings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_day_event_date`
--
ALTER TABLE `multi_day_event_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `one_day_event_date`
--
ALTER TABLE `one_day_event_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `winners`
--
ALTER TABLE `winners`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `campuses`
--
ALTER TABLE `campuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enrollment_add_det`
--
ALTER TABLE `enrollment_add_det`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrollment_details`
--
ALTER TABLE `enrollment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrollment_types`
--
ALTER TABLE `enrollment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event_timings`
--
ALTER TABLE `event_timings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `multi_day_event_date`
--
ALTER TABLE `multi_day_event_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `one_day_event_date`
--
ALTER TABLE `one_day_event_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `winners`
--
ALTER TABLE `winners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
