-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2026 at 12:44 AM
-- Server version: 10.6.25-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediqa_mediqa`
--

-- --------------------------------------------------------

--
-- Table structure for table `healthcare_saved_searches`
--

CREATE TABLE `healthcare_saved_searches` (
  `id` int(11) NOT NULL,
  `health_care_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `filter_summary` varchar(255) DEFAULT NULL,
  `result_count` int(11) DEFAULT NULL,
  `last_run_at` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `healthcare_saved_searches`
--

INSERT INTO `healthcare_saved_searches` (`id`, `health_care_id`, `name`, `job_id`, `filter_summary`, `result_count`, `last_run_at`, `created_at`, `updated_at`) VALUES
(33, 330, 'Night Shift', NULL, NULL, NULL, NULL, '2026-04-10 12:00:19', '2026-04-10 12:00:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `healthcare_saved_searches`
--
ALTER TABLE `healthcare_saved_searches`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `healthcare_saved_searches`
--
ALTER TABLE `healthcare_saved_searches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
