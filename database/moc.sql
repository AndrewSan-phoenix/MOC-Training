-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 09:57 AM
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
-- Database: `moc`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `timetable` longtext NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `fees` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `name`, `course_id`, `timetable`, `start_date`, `end_date`, `fees`, `created_at`, `updated_at`) VALUES
(1, 'Batch 3', 2, 'Tue, Thur, Fri', '2025-02-04', '2025-05-30', 81.00, '2025-05-07 19:43:28', '2025-05-22 19:49:52'),
(2, 'Batch 2', 3, 'Sat, Sun', '2025-05-31', '2025-10-05', 43.00, '2025-05-07 20:02:50', '2025-05-21 22:07:29'),
(4, 'Batch 2', 4, 'Mon, Tue, Wed, Thur, Fri', '2025-05-05', '2025-05-09', 94.00, '2025-05-07 20:03:31', '2025-05-21 22:08:47'),
(5, 'Batch 2', 2, 'Tue, Thur, Fri', '2021-03-23', '2022-09-09', 79.00, '2025-05-09 02:10:42', '2025-05-21 22:06:08'),
(6, 'Batch 1', 4, 'Mon, Tue, Wed, Thur, Fri', '2024-12-23', '2024-12-27', 75.00, '2025-05-09 02:11:00', '2025-05-21 22:08:33'),
(7, 'Batch 1', 2, 'Tue, Thur, Fri', '2015-11-03', '2016-02-12', 85.00, '2025-05-09 02:11:10', '2025-05-21 22:05:48'),
(8, 'Batch 1', 1, 'Mon, Wed, Fri', '2020-07-13', '2020-10-30', 23.00, '2025-05-09 02:23:29', '2025-05-21 22:09:08'),
(9, 'Batch 1', 3, 'Sat, Sun', '2025-02-20', '2025-05-27', 34.00, '2025-05-09 02:23:46', '2025-05-22 19:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `batch_details`
--

CREATE TABLE `batch_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `lecture_date` date NOT NULL,
  `lecture_title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch_details`
--

INSERT INTO `batch_details` (`id`, `batch_id`, `teacher_id`, `lecture_date`, `lecture_title`, `created_at`, `updated_at`) VALUES
(7, 4, 9, '1981-06-15', 'Facilis corporis inc', '2025-05-09 12:41:08', '2025-05-09 12:41:08'),
(8, 1, 10, '1996-10-21', 'Minima perspiciatis', '2025-05-09 12:41:15', '2025-05-09 12:41:15'),
(9, 2, 5, '2000-09-30', 'Doloremque vero alia', '2025-05-09 12:41:20', '2025-05-09 12:41:20'),
(10, 6, 8, '2013-01-11', 'Aperiam modi tempore', '2025-05-09 12:41:27', '2025-05-09 12:41:27'),
(11, 4, 8, '2016-03-22', 'Error quo quod et ex', '2025-05-15 00:22:47', '2025-05-15 00:22:47'),
(12, 5, 5, '1983-06-26', 'Praesentium dolor it', '2025-05-15 00:23:08', '2025-05-15 00:23:37'),
(13, 8, 4, '1976-09-22', 'Et pariatur Sit al', '2025-05-15 00:34:00', '2025-05-15 00:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('moc_training_cache_356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1748236319),
('moc_training_cache_356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1748236319;', 1748236319);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'International Trade (Basic Course)​', '2025-05-07 19:43:05', '2025-05-21 03:35:59'),
(2, 'International Trade (Advanced Course)', '2025-05-09 04:00:42', '2025-05-21 03:36:37'),
(3, 'International Trade (Weekend Course)', '2025-05-09 04:00:49', '2025-05-21 03:36:55'),
(4, 'Short Course on (How to Start Export Business in Myanmar)', '2025-05-09 04:00:55', '2025-05-21 03:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `enroll_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`id`, `batch_id`, `course_id`, `student_id`, `enroll_date`, `created_at`, `updated_at`) VALUES
(3, 1, 4, 13, '2025-05-01', '2025-05-09 12:19:02', '2025-05-09 12:19:02'),
(6, 9, 3, 2, '1975-08-19', '2025-05-09 12:19:43', '2025-05-09 12:19:43'),
(7, 2, 3, 5, '2016-03-29', '2025-05-09 12:19:52', '2025-05-09 12:19:52'),
(8, 5, 1, 15, '2025-05-04', '2025-05-15 00:51:55', '2025-05-15 00:51:55'),
(9, 2, 3, 10, '2025-04-30', '2025-05-22 07:25:40', '2025-05-22 07:25:40'),
(10, 9, 3, 4, '2014-01-09', '2025-05-24 04:08:52', '2025-05-24 04:20:06'),
(11, 5, 2, 16, '2025-05-06', '2025-05-24 04:11:20', '2025-05-24 04:11:20'),
(12, 6, 4, 11, '2025-05-05', '2025-05-24 20:56:59', '2025-05-24 20:56:59'),
(13, 5, 2, 3, '2025-05-14', '2025-05-25 20:25:17', '2025-05-25 20:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `file_name`, `description`, `batch_id`, `created_at`, `updated_at`) VALUES
(3, 'galleries/FM5gzzr38rMzmtNKFwEmmXtcsIvueNFHxkbRRZiU.png', 'Our Destination', 2, '2025-05-08 01:08:21', '2025-05-14 00:59:05'),
(6, 'galleries/agTnxc7656dgeU3Lv59RBQdBVShVHu4FRVvL0zC0.png', 'Webinar', 1, '2025-05-09 12:53:07', '2025-05-14 00:59:55'),
(10, 'galleries/3sbB7WSwzbZAxv8mojWwAAbEGPP4Ajod4NIlwUyc.png', 'Opening Ceremony', 5, '2025-05-13 19:29:23', '2025-05-14 01:01:31'),
(11, 'galleries/8Mv3Sb2L1pEY7Utqs72SiJ1QDKfTTGZKW1qxGgA9.png', 'Our Department', 6, '2025-05-14 01:03:01', '2025-05-14 01:03:01'),
(13, 'galleries/Q03BrczvdVmzdw7emilq5MqJtCNsjdxcnWhc75JJ.jpg', 'GL', 1, '2025-05-14 03:01:27', '2025-05-14 03:01:27'),
(14, 'galleries/LeYrrR7oEd4IuEb7tMkKfIlIAL1mqZZUfU0n4mQe.png', 'meet', 1, '2025-05-14 03:01:48', '2025-05-14 03:01:48'),
(15, 'galleries/o2j3NxI9gd6xxfaWa0vQMpY0e1pVR2blDWIkY9yU.png', 'Main Building', 1, '2025-05-14 03:02:12', '2025-05-14 03:02:12'),
(16, 'galleries/I733uw6DxtSWGudlYZCRxsQxXNCTCQwxHDIeE3go.png', 'Hall building', 2, '2025-05-14 03:02:47', '2025-05-14 03:02:47'),
(17, 'galleries/bADGXJGTWsLOPkiDi2CWmEvQ37K3sgjKr2XdN4El.jpg', 'instructior', 4, '2025-05-14 03:03:19', '2025-05-14 03:03:19'),
(18, 'galleries/2xhLP39EB1rsvxwwp2S33XZHSx3SFRpP0F4SY7U4.png', 'pizza', 4, '2025-05-14 03:03:33', '2025-05-14 03:03:33'),
(19, 'galleries/LdQ24oJgYzco0qXNIZiszneWgbltnwcoV6WvXEiY.png', 'Yum yum', 4, '2025-05-14 03:03:49', '2025-05-14 03:03:49'),
(20, 'galleries/gASxosIV11thMEBNtfotjr3nhISHTzwDwmMDyGav.png', 'face to face', 5, '2025-05-14 03:04:11', '2025-05-14 03:04:11'),
(21, 'galleries/vR2n1CFSwI5vN4rLfQYbgg8Gp3Y2vnSF4ycjwWlZ.png', 'tradingfood', 4, '2025-05-14 03:05:23', '2025-05-14 03:05:23'),
(22, 'galleries/FYT3EzWExb5tRza1K5Evt5ezDIgYhfPRIqX9xxJ9.jpg', 'mountain', 2, '2025-05-14 03:09:47', '2025-05-14 03:09:47'),
(23, 'galleries/a77KPrEr2kG0SUHeYoV9Cu7NOAKbfuTVqZmQ2sUY.jpg', 'Graduation', 7, '2025-05-14 03:11:08', '2025-05-14 03:11:08'),
(24, 'galleries/c6qBA2EnHdZrrV2QamLCmkER9pW9AZ3lCQghuLzh.png', 'mr.lin', 7, '2025-05-14 03:11:40', '2025-05-14 03:11:40'),
(25, 'galleries/Ej2XBHU6w0mkvQpuQdNKFtGANq0dvVDdyTtbHtx8.jpg', 'celebration', 8, '2025-05-14 03:12:29', '2025-05-14 03:12:29'),
(26, 'galleries/fqRhtBhbkJ4kNXqeF8cWw8vlmn8qZ2lgZ3bjD3Rg.png', 'Sun Rising', 8, '2025-05-14 03:13:12', '2025-05-14 03:13:12'),
(27, 'galleries/stzWK3zz0T4gL1V2ZP2pK7vJEbWVdEOreyt2QMg2.png', 'wave', 9, '2025-05-14 03:13:54', '2025-05-14 03:13:54'),
(28, 'galleries/V8ncWrBmCGSQ9dQwSq2ZE4LsjLyhMKvVNkHdnu1t.jpg', 'Protect Forests', 1, '2025-05-15 04:10:24', '2025-05-15 04:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_06_023603_create_students_table', 1),
(5, '2025_05_06_023629_create_teachers_table', 1),
(6, '2025_05_06_023645_create_courses_table', 1),
(7, '2025_05_06_023704_create_batches_table', 1),
(8, '2025_05_06_023723_create_batch_details_table', 1),
(9, '2025_05_06_023747_create_enrolls_table', 1),
(10, '2025_05_06_023802_create_galleries_table', 1),
(11, '2025_05_10_073928_add_batch_id_to_students_table', 1),
(12, '2025_05_14_033009_add_profile_image_to_students_table', 1),
(13, '2025_05_14_040849_add_profile_image_to_teachers_table', 1),
(14, '2025_05_22_071759_add_column_to_enroll_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('M3BeF9rqdZ9qGGJy6vzHr5I3JfIHhduloH2TjrC1', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTElvZkhubTk1QTB0YVc0Mnp6OGZZRnFkSjRsdGJpZEtKRW90TEZLQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1748243841);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '1 => male, 2 => female',
  `nrc` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `profile_image`, `name`, `dob`, `gender`, `nrc`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
(2, 'profile_images/9Dc5JpATLz0NIxGvFZYqqJqNpQDlLAGRTbuvwFRW.jpg', 'Ma Aye Aye Soe', '1989-07-19', 2, 'In sed in cupiditate', '+1 (954) 955-1958', 'tiqag@mailinator.com', 'Alias officia omnis ', '2025-05-08 21:09:02', '2025-05-22 03:11:58'),
(3, 'profile_images/qNdgf3i71dCpVPNcHSoSdSZOfgeRmLDHqrTFI2fI.png', 'Mg Kaung Htet Hein', '2010-09-27', 1, 'Reprehenderit lauda', '+1 (398) 245-8327', 'zociq@mailinator.com', 'Omnis aute veritatis', '2025-05-08 21:09:29', '2025-05-21 22:12:31'),
(4, 'profile_images/95toY9i7R8LVLolCXGPjymrhsnv6tOByN6WTQFdR.png', 'Ma Khin Thuzar', '1972-06-24', 2, 'Illum amet fuga A', '+1 (363) 301-9026', 'fuqefi@mailinator.com', 'Ut rerum expedita ve', '2025-05-08 21:09:43', '2025-05-25 22:36:30'),
(5, 'profile_images/klMsi0ni9tX3128QfHdYU2yD63vQdktyYTclozZy.png', 'TaShya William', '2005-03-11', 2, 'Omnis rem pariatur ', '+1 (423) 627-7776', 'fuqiho@mailinator.com', 'Et qui magnam perfer', '2025-05-08 21:09:49', '2025-05-25 22:36:56'),
(9, 'profile_images/Gq7DU4Wbk6qMyWlGadJMHChHQ5qLkRMFERnmrP7o.png', 'Ingrid Padilla', '1978-01-26', 2, 'Voluptatem dolorem r', '+1 (118) 446-4886', 'pixeku@mailinator.com', 'Consequatur Incidun', '2025-05-08 21:12:23', '2025-05-25 22:38:19'),
(10, 'profile_images/wC9qRntpDN2hFjDWs6Po8HS3FQu011rRk4FSPaVv.png', 'Marcia Jefferson', '1995-09-25', 2, 'Sed est quis et sap', '+1 (743) 769-4396', 'laguwimyxi@mailinator.com', 'Possimus debitis au', '2025-05-08 21:12:29', '2025-05-25 22:38:43'),
(11, 'profile_images/3PPz2gGQW5KF8nrMhHfF0gQNS71nqPHLDBHLGE9y.png', 'Kyla Hudson', '1977-03-20', 1, 'Non aut consectetur', '+1 (802) 478-4847', 'warimir@mailinator.com', 'Fugiat doloribus ne', '2025-05-08 21:12:36', '2025-05-25 22:39:44'),
(12, NULL, 'Jonas Macias', '1987-12-07', 3, 'Modi culpa itaque o', '+1 (113) 425-8489', 'xyxomuje@mailinator.com', 'Rerum voluptas culpa', '2025-05-08 21:12:47', '2025-05-08 21:12:47'),
(13, 'profile_images/rEqcU87wNWXKKlnssiQNZDpGAu7vENqDNXzoewtC.png', 'Samson Blackwell', '2015-10-08', 2, 'Non deserunt culpa ', '+1 (255) 903-5881', 'soxezezyw@mailinator.com', 'Illo quos qui ipsam ', '2025-05-08 22:31:04', '2025-05-25 22:41:01'),
(15, NULL, 'Penelope Cochran', '2003-05-01', 3, 'Labore sit aut dese', '+1 (306) 519-9422', 'lurovem@mailinator.com', 'Fugiat eiusmod ea in', '2025-05-08 23:09:42', '2025-05-08 23:09:42'),
(16, 'profile_images/DnmoEBzJcMpetYIfMJ88pBMBwERs4v1UUD4YRTeA.png', 'Dolan Dixon', '1984-03-14', 2, 'Quasi ut adipisci co', '+1 (114) 212-8186', 'cyxacu@mailinator.com', 'Possimus est quia m', '2025-05-13 19:27:47', '2025-05-25 22:40:30'),
(17, 'profile_images/UnINc3Dgof1c9jKCqRahwjo4nMRhOW9WyX5QJna5.jpg', 'Xerxes Santana', '1999-07-27', 1, 'Excepturi enim delec', '+1 (521) 684-5672', 'jofyfegu@mailinator.com', 'Nisi expedita ullam ', '2025-05-13 21:18:01', '2025-05-13 21:18:01');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `dob` date NOT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '1 => male, 2 => female',
  `nrc` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `profile_image`, `name`, `position`, `organization`, `dob`, `gender`, `nrc`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
(4, 'profile_images/TfyL6W27NHqVi4zzBj9ipAnoE69MrLRP1XBlLSE2.png', '0000000', 'Nulla nulla debitis ', 'Wong and Barton Traders', '1978-07-12', 1, 'Pariatur Sed quia u', '+1 (367) 252-3983', 'wyfo@mailinator.com', 'Inventore sint ut co', '2025-05-09 02:06:49', '2025-05-22 02:48:02'),
(5, 'profile_images/GnbAYIkyIQj44SsiCDqmaHXYpMBfCmRRV1M0zYRu.jpg', 'Darryl Bradley', 'Et blanditiis dolore', 'Britt and Brown Plc', '1983-04-13', 2, 'Ex aut doloribus per', '+1 (674) 625-7013', 'hyxydabe@mailinator.com', 'Culpa similique blan', '2025-05-09 02:06:57', '2025-05-22 02:48:10'),
(8, 'profile_images/FZtkSd3N0ydNSebeh9X6sw6aC2Se0DfAlBviMdJ8.jpg', 'Hilary Strong', 'Exercitation rerum e', 'Diaz Stuart Plc', '2010-10-25', 2, 'Aut fugiat quos labo', '+1 (947) 238-5248', 'qeberazope@mailinator.com', 'Voluptas tempora ips', '2025-05-09 02:07:17', '2025-05-22 02:48:33'),
(9, 'profile_images/Xl8wcy9BCgil54nOJwNhvNRNDoZ3R0OEcs6jeNWA.png', 'Jerry Singleton', 'Enim eu est quaerat ', 'Compton and Saunders Plc', '1980-12-28', 1, 'Quibusdam amet sed ', '+1 (685) 571-2695', 'jekydozil@mailinator.com', 'Nulla Nam non eu cor', '2025-05-09 08:44:31', '2025-05-22 02:48:48'),
(10, 'profile_images/EJBOCEZZ4GU44CXlbx0IhC1XftLNjMubvcqYcDyU.png', 'Jescie Craft', 'Ullamco architecto d', 'Morse and Bonner Inc', '1993-02-13', 2, 'In voluptas iusto qu', '+1 (671) 186-8971', 'napyju@mailinator.com', 'Vel est quae quo ali', '2025-05-09 08:44:49', '2025-05-22 02:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$12$xi9nK6ioHo7.Emdm1be4Se7716GNCytIVfj8.6WQgzmubq8WVuZ9O', NULL, '2025-05-07 19:40:13', '2025-05-07 19:40:13'),
(2, 'user', 'user', 'useraung123@gmail.com', NULL, '$2y$12$cInPlPx5QIz8aer9k6Ql0eSdKKj8kukgaEoGlEzLLAdxosPkcWCKi', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batches_course_id_foreign` (`course_id`);

--
-- Indexes for table `batch_details`
--
ALTER TABLE `batch_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_details_batch_id_foreign` (`batch_id`),
  ADD KEY `batch_details_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enroll_batch_id_foreign` (`batch_id`),
  ADD KEY `enroll_student_id_foreign` (`student_id`),
  ADD KEY `enroll_course_id_foreign` (`course_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_batch_id_foreign` (`batch_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_nrc_unique` (`nrc`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_nrc_unique` (`nrc`),
  ADD UNIQUE KEY `teachers_phone_unique` (`phone`),
  ADD UNIQUE KEY `teachers_email_unique` (`email`);

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
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `batch_details`
--
ALTER TABLE `batch_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batches`
--
ALTER TABLE `batches`
  ADD CONSTRAINT `batches_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `batch_details`
--
ALTER TABLE `batch_details`
  ADD CONSTRAINT `batch_details_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batch_details_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enroll_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enroll_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
