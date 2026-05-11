-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 14, 2026 at 04:00 AM
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
-- Table structure for table `professional_certificate`
--

CREATE TABLE `professional_certificate` (
  `id` int(11) NOT NULL,
  `ordering_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professional_certificate`
--

INSERT INTO `professional_certificate` (`id`, `ordering_id`, `name`, `created_at`, `updated_at`) VALUES
(6, 1, 'ACLS (Advanced Cardiovascular Life Support)', '2024-08-14 05:19:19', '2024-08-14 05:19:19'),
(7, 2, 'BLS (Basic Life Support)', '2024-08-14 05:19:32', '2024-08-14 05:19:32'),
(8, 3, 'CPR (Cardiopulmonary Resuscitation)', '2024-08-14 05:20:00', '2024-08-14 05:20:00'),
(9, 4, 'NRP (Neonatal Resuscitation Program)', '2024-08-14 05:20:16', '2024-08-14 05:20:16'),
(10, 5, 'PALS (Pediatric Advanced Life Support)', '2024-08-14 05:20:31', '2024-08-14 05:20:31'),
(11, 6, 'RN (Registered Nurse)', '2024-08-14 05:20:49', '2024-08-14 05:20:49'),
(12, 8, 'CNA (Certified Nursing Assistant) / EN (Enrolled Nurse)', '2024-08-14 05:21:04', '2024-08-14 05:21:04'),
(13, 9, 'LPN (Licensed Practical Nurse) / LVN (Licensed Vocational Nurse)', '2024-08-14 05:21:20', '2024-08-14 05:21:20'),
(14, 10, 'CRNA (Certified Registered Nurse Anesthetist)', '2024-08-14 05:21:35', '2024-08-14 05:21:35'),
(15, 11, 'CNM (Certified Nurse Midwife)', '2024-08-14 05:21:49', '2024-08-14 05:21:49'),
(16, 12, 'ONS/ONCC (Oncology Nursing Society/Oncology Nursing Certification Corporation)', '2024-08-14 05:22:02', '2024-08-14 05:22:02'),
(17, 13, 'MSW/AiM (Maternity Support Worker/Assistant in Midwifery ) / Midwife Assistant', '2024-08-14 05:22:16', '2024-08-14 05:22:16'),
(18, 7, 'NP (Nurse Practioner) / (APRN) Advanced Practice Registered Nurse', '2024-08-28 23:15:28', '2024-08-28 23:15:28'),
(19, 14, 'AIN (Assistant in Nursing) / NA (Nurse Associate) / HCA (Healthcare Assistant)', '2024-08-28 23:16:40', '2024-08-28 23:16:40'),
(20, 15, 'RPN (Registered Practical Nurse) / RGN (Registered General Nurse)', '2024-08-28 23:17:10', '2024-08-28 23:17:10'),
(21, 16, 'No License/Certification', '2024-08-28 23:17:33', '2024-08-28 23:17:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `professional_certificate`
--
ALTER TABLE `professional_certificate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `professional_certificate`
--
ALTER TABLE `professional_certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
