-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 05, 2025 at 12:45 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems22`
--

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'শনিবার', '2025-03-05 05:52:02', '2025-03-05 06:42:20'),
(2, 1, 'রবিবার', '2025-03-05 05:53:42', '2025-03-05 06:42:31'),
(3, 1, 'সোমবার', '2025-03-05 05:53:59', '2025-03-05 06:42:45'),
(4, 1, 'মঙ্গলবার', '2025-03-05 05:54:07', '2025-03-05 06:43:03'),
(5, 1, 'বুধবার', '2025-03-05 05:54:15', '2025-03-05 06:43:18'),
(6, 1, 'বৃহস্পতিবার', '2025-03-05 05:54:25', '2025-03-05 06:43:36'),
(7, 1, 'শুক্রবার', '2025-03-05 05:54:33', '2025-03-05 06:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedules`
--

CREATE TABLE `exam_schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `sub_subject_id` bigint UNSIGNED DEFAULT NULL,
  `student_class_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_schedules`
--

INSERT INTO `exam_schedules` (`id`, `user_id`, `subject_id`, `sub_subject_id`, `student_class_id`, `name`, `exam_date`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 1, 'First Semister', '2025-01-01', '10:00:00', '13:00:00', '2025-03-04 12:43:13', '2025-03-04 12:43:13'),
(2, 2, 1, 2, 1, 'First Semister', '2025-02-01', '10:00:00', '13:00:00', '2025-03-04 12:43:41', '2025-03-04 12:43:41'),
(3, 2, 2, 3, 1, 'First Semister', '2025-03-01', '10:00:00', '13:00:00', '2025-03-04 12:44:22', '2025-03-04 12:44:22'),
(4, 2, 2, 4, 1, 'First Semister', '2025-04-01', '10:00:00', '13:00:00', '2025-03-04 12:45:06', '2025-03-04 12:45:06'),
(5, 2, 3, 5, 1, 'First Semister', '2025-05-01', '10:00:00', '13:00:00', '2025-03-04 12:45:48', '2025-03-04 12:45:48'),
(8, 2, 4, 6, 1, 'First Semester', '2025-06-01', '10:00:00', '13:00:00', '2025-03-04 12:59:41', '2025-03-04 12:59:41'),
(9, 2, 5, 7, 1, 'First Semester', '2025-07-01', '10:00:00', '13:00:00', '2025-03-04 13:09:28', '2025-03-04 13:09:28'),
(10, 2, 6, 8, 1, 'First Semester', '2025-10-01', '10:00:00', '13:00:00', '2025-03-04 13:10:00', '2025-03-04 13:10:00'),
(11, 2, 7, 9, 2, 'First Semester', '2025-01-01', '14:00:00', '17:00:00', '2025-03-04 13:10:56', '2025-03-04 13:10:56'),
(12, 2, 7, 10, 2, 'First Semester', '2025-02-01', '14:00:00', '17:00:00', '2025-03-04 13:11:30', '2025-03-04 13:11:30'),
(13, 2, 8, 11, 2, 'First Semester', '2025-03-01', '14:00:00', '17:00:00', '2025-03-04 13:12:10', '2025-03-04 13:12:10'),
(14, 2, 8, 12, 2, 'First Semester', '2025-04-01', '14:00:00', '17:00:00', '2025-03-04 13:12:47', '2025-03-04 13:12:47'),
(15, 2, 9, 13, 2, 'First Semester', '2025-05-01', '14:00:00', '17:00:00', '2025-03-04 13:13:29', '2025-03-04 13:13:29'),
(16, 1, 10, 14, 2, 'First Semister', '2025-06-01', '14:00:00', '17:00:00', '2025-03-04 13:26:49', '2025-03-04 13:26:49'),
(17, 1, 11, 15, 2, 'First Semister', '2025-07-01', '14:00:00', '17:00:00', '2025-03-04 13:26:49', '2025-03-04 13:26:49'),
(18, 1, 12, 16, 2, 'First Semister', '2025-08-01', '14:00:00', '17:00:00', '2025-03-04 13:26:49', '2025-03-04 13:26:49'),
(20, 1, 13, 18, 3, 'First Semister', '2025-11-01', '14:00:00', '17:00:00', '2025-03-04 13:35:50', '2025-03-04 13:35:50'),
(22, 1, 13, 17, 3, 'First Semister', '2025-01-09', '14:00:00', '17:00:00', '2025-03-04 13:39:45', '2025-03-04 13:39:45'),
(24, 1, 14, 19, 3, 'First Semister', '2025-01-12', '14:00:00', '17:00:00', '2025-03-04 13:39:45', '2025-03-04 13:39:45'),
(25, 1, 14, 20, 3, 'First Semister', '2025-01-13', '14:00:00', '17:00:00', '2025-03-04 13:39:45', '2025-03-04 13:39:45'),
(26, 1, 15, 21, 3, 'First Semister', '2025-01-14', '14:00:00', '17:00:00', '2025-03-04 13:39:45', '2025-03-04 13:39:45'),
(27, 1, 16, 22, 3, 'First Semister', '2025-01-15', '14:00:00', '17:00:00', '2025-03-04 13:39:45', '2025-03-04 13:39:45'),
(28, 1, 17, 23, 3, 'First Semister', '2025-01-16', '14:00:00', '17:00:00', '2025-03-04 13:39:45', '2025-03-04 13:39:45'),
(29, 1, 18, 24, 3, 'First Semister', '2025-01-18', '14:00:00', '17:00:00', '2025-03-04 13:39:45', '2025-03-04 13:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_12_31_185113_create_student_classes_table', 2),
(6, '2025_01_02_110128_create_subjects_table', 3),
(7, '2025_01_03_114841_create_sub_subjects_table', 4),
(8, '2025_01_04_171536_create_exam_schedules_table', 5),
(9, '2025_02_11_173136_create_routines_table', 6),
(11, '2025_03_05_112647_create_days_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'authToken', 'e68b7d1367e7453ad9d8b319544287580d9c3fa76636995968a31e8beacbb2cc', '[\"*\"]', '2025-03-04 09:54:21', NULL, '2025-03-04 06:59:51', '2025-03-04 09:54:21'),
(2, 'App\\Models\\User', 2, 'authToken', '0e2d5ebc236c258ed2c3db381dce3d64aa77f57ab011fb2dcb501c0481fb3213', '[\"*\"]', '2025-03-04 13:42:14', NULL, '2025-03-04 10:14:47', '2025-03-04 13:42:14'),
(3, 'App\\Models\\User', 1, 'authToken', '12371bd610a54fa77603db074fe087d3335cdf1d4ca397ae59fdab0417e4c189', '[\"*\"]', '2025-03-05 06:44:07', NULL, '2025-03-05 03:50:47', '2025-03-05 06:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `routines`
--

CREATE TABLE `routines` (
  `id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `sub_subject_id` bigint UNSIGNED DEFAULT NULL,
  `student_class_id` bigint UNSIGNED NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `starting_time` time NOT NULL,
  `ending_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_classes`
--

CREATE TABLE `student_classes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_classes`
--

INSERT INTO `student_classes` (`id`, `user_id`, `name`, `section`, `capacity`, `created_at`, `updated_at`) VALUES
(1, 1, 'SIX', NULL, '0', '2025-03-04 11:10:33', '2025-03-04 11:10:33'),
(2, 1, 'SEVEN', NULL, '0', '2025-03-04 11:10:33', '2025-03-04 11:10:33'),
(3, 1, 'EIGHT', NULL, '0', '2025-03-04 11:10:33', '2025-03-04 11:10:33'),
(4, 1, 'NINE', NULL, '0', '2025-03-04 11:10:33', '2025-03-04 11:10:33'),
(5, 1, 'TEN', NULL, '0', '2025-03-04 11:10:33', '2025-03-04 11:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `student_class_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `user_id`, `student_class_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Bangla', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(2, 1, 1, 'English', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(3, 1, 1, 'Mathematics', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(4, 1, 1, 'Science', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(5, 1, 1, 'Social Science', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(6, 1, 1, 'ICT', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(7, 1, 2, 'Bangla', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(8, 1, 2, 'English', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(9, 1, 2, 'Mathematics', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(10, 1, 2, 'Science', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(11, 1, 2, 'Social Science', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(12, 1, 2, 'ICT', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(13, 1, 3, 'Bangla', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(14, 1, 3, 'English', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(15, 1, 3, 'Mathematics', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(16, 1, 3, 'Science', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(17, 1, 3, 'Social Science', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(18, 1, 3, 'ICT', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(19, 1, 4, 'Bangla', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(20, 1, 4, 'English', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(21, 1, 4, 'Mathematics', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(22, 1, 4, 'ICT', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(23, 1, 4, 'Physic', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(24, 1, 4, 'Chemistry', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(25, 1, 4, 'Biology', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(26, 1, 4, 'Geography', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(27, 1, 4, 'History', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(28, 1, 4, 'Civics', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(29, 1, 4, 'Economics', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(30, 1, 5, 'Bangla', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(31, 1, 5, 'English', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(32, 1, 5, 'Mathematics', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(33, 1, 5, 'ICT', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(34, 1, 5, 'Physic', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(35, 1, 5, 'Chemistry', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(36, 1, 5, 'Biology', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(37, 1, 5, 'Geography', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(38, 1, 5, 'History', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(39, 1, 5, 'Civics', '2025-03-04 11:42:00', '2025-03-04 11:42:00'),
(40, 1, 5, 'Economics', '2025-03-04 11:42:00', '2025-03-04 11:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `sub_subjects`
--

CREATE TABLE `sub_subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `student_class_id` bigint UNSIGNED NOT NULL,
  `sub_subject_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `sub_subject_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `full_marks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_subjects`
--

INSERT INTO `sub_subjects` (`id`, `user_id`, `subject_id`, `student_class_id`, `sub_subject_name`, `sub_subject_code`, `full_marks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'First Paper', '101', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(2, 1, 1, 1, 'Second Paper', '102', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(3, 1, 2, 1, 'First Paper', '101', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(4, 1, 2, 1, 'Second Paper', '102', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(5, 1, 3, 1, 'null', '103', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(6, 1, 4, 1, 'null', '104', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(7, 1, 5, 1, 'null', '105', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(8, 1, 6, 1, 'null', '106', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(9, 1, 7, 2, 'First Paper', '101', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(10, 1, 7, 2, 'Second Paper', '102', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(11, 1, 8, 2, 'First Paper', '101', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(12, 1, 8, 2, 'Second Paper', '102', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(13, 1, 9, 2, 'null', '103', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(14, 1, 10, 2, 'null', '104', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(15, 1, 11, 2, 'null', '105', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(16, 1, 12, 2, 'null', '106', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(17, 1, 13, 3, 'First Paper', '101', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(18, 1, 13, 3, 'Second Paper', '102', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(19, 1, 14, 3, 'First Paper', '101', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(20, 1, 14, 3, 'Second Paper', '102', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(21, 1, 15, 3, 'null', '103', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(22, 1, 16, 3, 'null', '104', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(23, 1, 17, 3, 'null', '105', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(24, 1, 18, 3, 'null', '106', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(25, 1, 19, 4, 'First Paper', '101', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(26, 1, 19, 4, 'Second Paper', '102', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(27, 1, 20, 4, 'First Paper', '101', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(28, 1, 20, 4, 'Second Paper', '102', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(29, 1, 21, 4, 'null', '103', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(30, 1, 22, 4, 'null', '104', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(31, 1, 23, 4, 'First Paper', '221', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(32, 1, 23, 4, 'Second Paper', '222', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(33, 1, 24, 4, 'First Paper', '223', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(34, 1, 24, 4, 'Second Paper', '224', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(35, 1, 25, 4, 'First Paper', '225', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(36, 1, 25, 4, 'Second Paper', '226', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(37, 1, 26, 4, 'First Paper', '511', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(38, 1, 26, 4, 'Second Paper', '512', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(39, 1, 27, 4, 'First Paper', '515', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(40, 1, 27, 4, 'Second Paper', '516', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(41, 1, 28, 4, 'First Paper', '505', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(42, 1, 28, 4, 'Second Paper', '506', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(43, 1, 29, 4, 'First Paper', '303', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(44, 1, 29, 4, 'Second Paper', '304', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(45, 1, 30, 5, 'First Paper', '101', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(46, 1, 30, 5, 'Second Paper', '102', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(47, 1, 31, 5, 'First Paper', '101', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(48, 1, 31, 5, 'Second Paper', '102', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(49, 1, 32, 5, 'null', '103', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(50, 1, 33, 5, 'null', '104', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(51, 1, 34, 5, 'First Paper', '221', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(52, 1, 34, 5, 'Second Paper', '222', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(53, 1, 35, 5, 'First Paper', '223', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(54, 1, 35, 5, 'Second Paper', '224', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(55, 1, 36, 5, 'First Paper', '225', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(56, 1, 36, 5, 'Second Paper', '226', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(57, 1, 37, 5, 'First Paper', '511', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(58, 1, 37, 5, 'Second Paper', '512', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(59, 1, 38, 5, 'First Paper', '515', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(60, 1, 38, 5, 'Second Paper', '516', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(61, 1, 39, 5, 'First Paper', '505', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(62, 1, 39, 5, 'Second Paper', '506', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(63, 1, 40, 5, 'First Paper', '303', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04'),
(64, 1, 40, 5, 'Second Paper', '304', '100', '2025-03-04 12:41:04', '2025-03-04 12:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','student') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `otp` int NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `otp`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'SANJOY KUNDU', 'sanjoykundu187@gmail.com', NULL, '$2y$12$ivbQs.USzJ1vUmaa5P6BOutFlWwrNdV1WwN.zz8Sp8FlBCIN8HjVC', 'student', 0, NULL, '2025-03-04 06:59:40', '2025-03-04 06:59:40'),
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$12$3fBe50Hb3SPcqAkkkFWUd.8gz0/v0ej6UQbCCw0RibRER0PNUxRAC', 'admin', 0, NULL, '2025-03-04 10:13:55', '2025-03-04 10:13:55'),
(3, 'Amir', 'amir@gmail.com', NULL, '$2y$12$pFbVdn5pN0gJFKVfo2lpw.ladb/SAttVQnY0S84icGT.L/8CPf19i', 'student', 0, NULL, '2025-03-04 10:13:55', '2025-03-04 10:13:55'),
(4, 'Nurul', 'nurul@gmail.com', NULL, '$2y$12$tOk1bIi7iFhp9z/wTKh61eJinBej7FmyqxtOcHm7fLUo8B5g8t3dy', 'student', 0, NULL, '2025-03-04 10:13:56', '2025-03-04 10:13:56'),
(5, 'Rifqi', 'rifqi@gmail.com', NULL, '$2y$12$sSDSjPv59iDc5Pi2yYS2oOizNeGyT5I.KvYY1wberIUdAdJCGQH5u', 'student', 0, NULL, '2025-03-04 10:13:56', '2025-03-04 10:13:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `days_name_unique` (`name`),
  ADD KEY `days_user_id_foreign` (`user_id`);

--
-- Indexes for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_schedules_user_id_foreign` (`user_id`),
  ADD KEY `exam_schedules_subject_id_foreign` (`subject_id`),
  ADD KEY `exam_schedules_sub_subject_id_foreign` (`sub_subject_id`),
  ADD KEY `exam_schedules_student_class_id_foreign` (`student_class_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `routines`
--
ALTER TABLE `routines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `routines_subject_id_foreign` (`subject_id`),
  ADD KEY `routines_sub_subject_id_foreign` (`sub_subject_id`),
  ADD KEY `routines_student_class_id_foreign` (`student_class_id`);

--
-- Indexes for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_classes_name_unique` (`name`),
  ADD KEY `student_classes_user_id_foreign` (`user_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjects_user_id_foreign` (`user_id`),
  ADD KEY `subjects_student_class_id_foreign` (`student_class_id`);

--
-- Indexes for table `sub_subjects`
--
ALTER TABLE `sub_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_subjects_user_id_foreign` (`user_id`),
  ADD KEY `sub_subjects_subject_id_foreign` (`subject_id`),
  ADD KEY `sub_subjects_student_class_id_foreign` (`student_class_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `routines`
--
ALTER TABLE `routines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_classes`
--
ALTER TABLE `student_classes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sub_subjects`
--
ALTER TABLE `sub_subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `days`
--
ALTER TABLE `days`
  ADD CONSTRAINT `days_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  ADD CONSTRAINT `exam_schedules_student_class_id_foreign` FOREIGN KEY (`student_class_id`) REFERENCES `student_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_schedules_sub_subject_id_foreign` FOREIGN KEY (`sub_subject_id`) REFERENCES `sub_subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_schedules_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_schedules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `routines`
--
ALTER TABLE `routines`
  ADD CONSTRAINT `routines_student_class_id_foreign` FOREIGN KEY (`student_class_id`) REFERENCES `student_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `routines_sub_subject_id_foreign` FOREIGN KEY (`sub_subject_id`) REFERENCES `sub_subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `routines_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD CONSTRAINT `student_classes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_student_class_id_foreign` FOREIGN KEY (`student_class_id`) REFERENCES `student_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subjects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_subjects`
--
ALTER TABLE `sub_subjects`
  ADD CONSTRAINT `sub_subjects_student_class_id_foreign` FOREIGN KEY (`student_class_id`) REFERENCES `student_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_subjects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
