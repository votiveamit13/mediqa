-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2024 at 03:38 PM
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
-- Database: `phpserve_mediqa`
--

-- --------------------------------------------------------

--
-- Table structure for table `professional_certificate_table`
--

CREATE TABLE `professional_certificate_table` (
  `professionalcert_id` int(11) NOT NULL,
  `cert_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professional_certificate_table`
--

INSERT INTO `professional_certificate_table` (`professionalcert_id`, `cert_id`, `name`, `created_at`, `updated_at`) VALUES
(154, 21, 'Auxiliary Midwife', '2024-08-29 07:35:45', '2024-08-29 07:35:45'),
(155, 21, 'Enrolled Nurse (Student)', '2024-08-29 07:36:07', '2024-08-29 07:36:07'),
(156, 21, 'Healthcare Assistant (HCA)', '2024-08-29 07:36:32', '2024-08-29 07:36:32'),
(157, 21, 'Midwife Assistant', '2024-08-29 07:36:55', '2024-08-29 07:36:55'),
(158, 21, 'Midwife Student', '2024-08-29 07:37:16', '2024-08-29 07:37:16'),
(159, 21, 'Midwife Technician', '2024-08-29 07:37:40', '2024-08-29 07:37:40'),
(160, 21, 'Nurse Aide', '2024-08-29 07:37:59', '2024-08-29 07:37:59'),
(161, 21, 'Nurse Assistant', '2024-08-29 07:38:22', '2024-08-29 07:38:22'),
(162, 21, 'Nurse Auxiliary', '2024-08-29 07:38:41', '2024-08-29 07:38:41'),
(163, 21, 'Nurse Student', '2024-08-29 07:39:01', '2024-08-29 07:39:01'),
(164, 21, 'Student Midwife', '2024-08-29 07:39:21', '2024-08-29 07:39:21'),
(165, 21, 'Temporary Nurse Aide', '2024-08-29 07:39:42', '2024-08-29 07:39:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `professional_certificate_table`
--
ALTER TABLE `professional_certificate_table`
  ADD PRIMARY KEY (`professionalcert_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `professional_certificate_table`
--
ALTER TABLE `professional_certificate_table`
  MODIFY `professionalcert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
