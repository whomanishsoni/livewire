-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2026 at 03:10 AM
-- Server version: 8.0.33
-- PHP Version: 8.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livewire_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-30293729476c7817a0aad61ef5772507', 'i:2;', 1767800113),
('laravel-cache-30293729476c7817a0aad61ef5772507:timer', 'i:1767800113;', 1767800113),
('laravel-cache-80838ee65557e365bbb4dcac98b806d9', 'i:1;', 1767888089),
('laravel-cache-80838ee65557e365bbb4dcac98b806d9:timer', 'i:1767888089;', 1767888089),
('laravel-cache-c254943e50f55af63a60b3fa4f4043f0', 'i:1;', 1767880186),
('laravel-cache-c254943e50f55af63a60b3fa4f4043f0:timer', 'i:1767880186;', 1767880186),
('laravel-cache-c525a5357e97fef8d3db25841c86da1a', 'i:1;', 1767880316),
('laravel-cache-c525a5357e97fef8d3db25841c86da1a:timer', 'i:1767880316;', 1767880316),
('laravel-cache-e8b9563b2caebf5e73ef9b771002cb33', 'i:1;', 1767888047),
('laravel-cache-e8b9563b2caebf5e73ef9b771002cb33:timer', 'i:1767888047;', 1767888047);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2026_01_05_140524_create_roles_table', 1),
(4, '2026_01_05_141036_create_users_table', 1),
(5, '2026_01_07_144904_create_permissions_table', 1),
(6, '2026_01_07_144933_create_permission_role_table', 1),
(7, '2026_01_07_152710_remove_permissions_column_from_roles_table', 2),
(8, '2026_01_08_140335_create_schools_table', 3),
(9, '2026_01_08_140339_create_subscription_plans_table', 3),
(10, '2026_01_08_140347_create_modules_table', 3),
(11, '2026_01_08_140356_create_subscriptions_table', 3),
(12, '2026_01_08_140400_create_plan_module_table', 3),
(13, '2026_01_08_140403_add_school_id_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_prefix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `slug`, `label`, `description`, `icon`, `route_prefix`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'students', 'students', 'Student Management', 'Manage student enrollment, profiles, and academic records', 'fas fa-user-graduate', 'students', 1, 1, '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(2, 'teachers', 'teachers', 'Teacher Management', 'Manage teacher profiles, assignments, and performance', 'fas fa-chalkboard-teacher', 'teachers', 1, 2, '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(3, 'classes', 'classes', 'Class Management', 'Manage class schedules, assignments, and student groupings', 'fas fa-school', 'classes', 1, 3, '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(4, 'subjects', 'subjects', 'Subject Management', 'Manage curriculum subjects and course offerings', 'fas fa-book', 'subjects', 1, 4, '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(5, 'exams', 'exams', 'Examination Management', 'Manage exams, grades, and academic assessments', 'fas fa-clipboard-check', 'exams', 1, 5, '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(6, 'attendance', 'attendance', 'Attendance Tracking', 'Track student and teacher attendance records', 'fas fa-calendar-check', 'attendance', 1, 6, '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(7, 'finance', 'finance', 'Financial Management', 'Manage fees, payments, and financial records', 'fas fa-money-bill-wave', 'finance', 1, 7, '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(8, 'library', 'library', 'Library Management', 'Manage library resources and book circulation', 'fas fa-book-open', 'library', 1, 8, '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(9, 'transport', 'transport', 'Transport Management', 'Manage school transportation and routes', 'fas fa-bus', 'transport', 1, 9, '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(10, 'hostel', 'hostel', 'Hostel Management', 'Manage dormitory accommodations and residents', 'fas fa-home', 'hostel', 1, 10, '2026-01-08 08:43:22', '2026-01-08 08:43:22');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `label`, `module`, `description`, `created_at`, `updated_at`) VALUES
(1, 'view_users', 'View Users', 'users', 'Can view Users list and details', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(2, 'create_users', 'Create Users', 'users', 'Can create new Users', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(3, 'edit_users', 'Edit Users', 'users', 'Can edit existing Users', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(4, 'delete_users', 'Delete Users', 'users', 'Can delete Users', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(5, 'view_roles', 'View Roles', 'roles', 'Can view Roles list and details', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(6, 'create_roles', 'Create Roles', 'roles', 'Can create new Roles', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(7, 'edit_roles', 'Edit Roles', 'roles', 'Can edit existing Roles', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(8, 'delete_roles', 'Delete Roles', 'roles', 'Can delete Roles', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(9, 'view_dashboard', 'View Dashboard', 'dashboard', 'Can access the main dashboard', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(10, 'view_settings', 'View Settings', 'settings', 'Can access settings page', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(11, 'edit_profile', 'Edit Profile', 'settings', 'Can edit their profile', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(12, 'change_password', 'Change Password', 'settings', 'Can change password', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(13, 'manage_appearance', 'Manage Appearance', 'settings', 'Can change appearance settings', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(14, 'manage_two_factor', 'Manage Two-Factor Auth', 'settings', 'Can manage two-factor authentication', '2026-01-07 09:50:52', '2026-01-07 09:50:52'),
(15, 'view_students', 'View Student Management', 'students', 'Can view Student Management list and details', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(16, 'create_students', 'Create Student Management', 'students', 'Can create new Student Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(17, 'edit_students', 'Edit Student Management', 'students', 'Can edit existing Student Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(18, 'delete_students', 'Delete Student Management', 'students', 'Can delete Student Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(19, 'view_teachers', 'View Teacher Management', 'teachers', 'Can view Teacher Management list and details', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(20, 'create_teachers', 'Create Teacher Management', 'teachers', 'Can create new Teacher Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(21, 'edit_teachers', 'Edit Teacher Management', 'teachers', 'Can edit existing Teacher Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(22, 'delete_teachers', 'Delete Teacher Management', 'teachers', 'Can delete Teacher Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(23, 'view_classes', 'View Class Management', 'classes', 'Can view Class Management list and details', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(24, 'create_classes', 'Create Class Management', 'classes', 'Can create new Class Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(25, 'edit_classes', 'Edit Class Management', 'classes', 'Can edit existing Class Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(26, 'delete_classes', 'Delete Class Management', 'classes', 'Can delete Class Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(27, 'view_subjects', 'View Subject Management', 'subjects', 'Can view Subject Management list and details', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(28, 'create_subjects', 'Create Subject Management', 'subjects', 'Can create new Subject Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(29, 'edit_subjects', 'Edit Subject Management', 'subjects', 'Can edit existing Subject Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(30, 'delete_subjects', 'Delete Subject Management', 'subjects', 'Can delete Subject Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(31, 'view_exams', 'View Examination Management', 'exams', 'Can view Examination Management list and details', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(32, 'create_exams', 'Create Examination Management', 'exams', 'Can create new Examination Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(33, 'edit_exams', 'Edit Examination Management', 'exams', 'Can edit existing Examination Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(34, 'delete_exams', 'Delete Examination Management', 'exams', 'Can delete Examination Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(35, 'view_attendance', 'View Attendance Tracking', 'attendance', 'Can view Attendance Tracking list and details', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(36, 'create_attendance', 'Create Attendance Tracking', 'attendance', 'Can create new Attendance Tracking', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(37, 'edit_attendance', 'Edit Attendance Tracking', 'attendance', 'Can edit existing Attendance Tracking', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(38, 'delete_attendance', 'Delete Attendance Tracking', 'attendance', 'Can delete Attendance Tracking', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(39, 'view_finance', 'View Financial Management', 'finance', 'Can view Financial Management list and details', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(40, 'create_finance', 'Create Financial Management', 'finance', 'Can create new Financial Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(41, 'edit_finance', 'Edit Financial Management', 'finance', 'Can edit existing Financial Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(42, 'delete_finance', 'Delete Financial Management', 'finance', 'Can delete Financial Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(43, 'view_library', 'View Library Management', 'library', 'Can view Library Management list and details', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(44, 'create_library', 'Create Library Management', 'library', 'Can create new Library Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(45, 'edit_library', 'Edit Library Management', 'library', 'Can edit existing Library Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(46, 'delete_library', 'Delete Library Management', 'library', 'Can delete Library Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(47, 'view_transport', 'View Transport Management', 'transport', 'Can view Transport Management list and details', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(48, 'create_transport', 'Create Transport Management', 'transport', 'Can create new Transport Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(49, 'edit_transport', 'Edit Transport Management', 'transport', 'Can edit existing Transport Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(50, 'delete_transport', 'Delete Transport Management', 'transport', 'Can delete Transport Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(51, 'view_hostel', 'View Hostel Management', 'hostel', 'Can view Hostel Management list and details', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(52, 'create_hostel', 'Create Hostel Management', 'hostel', 'Can create new Hostel Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(53, 'edit_hostel', 'Edit Hostel Management', 'hostel', 'Can edit existing Hostel Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(54, 'delete_hostel', 'Delete Hostel Management', 'hostel', 'Can delete Hostel Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 12, NULL, NULL),
(2, 1, 6, NULL, NULL),
(3, 1, 2, NULL, NULL),
(5, 1, 4, NULL, NULL),
(6, 1, 11, NULL, NULL),
(7, 1, 7, NULL, NULL),
(8, 1, 3, NULL, NULL),
(9, 1, 13, NULL, NULL),
(10, 1, 14, NULL, NULL),
(11, 1, 9, NULL, NULL),
(12, 1, 5, NULL, NULL),
(13, 1, 10, NULL, NULL),
(14, 1, 1, NULL, NULL),
(15, 2, 12, NULL, NULL),
(16, 2, 11, NULL, NULL),
(17, 2, 3, NULL, NULL),
(18, 2, 9, NULL, NULL),
(19, 2, 5, NULL, NULL),
(20, 2, 10, NULL, NULL),
(21, 2, 1, NULL, NULL),
(22, 3, 12, NULL, NULL),
(23, 3, 11, NULL, NULL),
(24, 3, 9, NULL, NULL),
(25, 3, 10, NULL, NULL),
(26, 1, 8, NULL, NULL),
(27, 6, 12, NULL, NULL),
(28, 6, 6, NULL, NULL),
(29, 6, 2, NULL, NULL),
(30, 6, 8, NULL, NULL),
(31, 6, 4, NULL, NULL),
(32, 6, 11, NULL, NULL),
(33, 6, 7, NULL, NULL),
(34, 6, 3, NULL, NULL),
(35, 6, 13, NULL, NULL),
(36, 6, 14, NULL, NULL),
(37, 6, 9, NULL, NULL),
(38, 6, 5, NULL, NULL),
(39, 6, 10, NULL, NULL),
(40, 6, 1, NULL, NULL),
(41, 7, 12, NULL, NULL),
(42, 7, 2, NULL, NULL),
(43, 7, 11, NULL, NULL),
(44, 7, 7, NULL, NULL),
(45, 7, 3, NULL, NULL),
(46, 7, 13, NULL, NULL),
(47, 7, 9, NULL, NULL),
(48, 7, 5, NULL, NULL),
(49, 7, 10, NULL, NULL),
(50, 7, 1, NULL, NULL),
(51, 8, 12, NULL, NULL),
(52, 8, 11, NULL, NULL),
(53, 8, 9, NULL, NULL),
(54, 8, 10, NULL, NULL),
(55, 8, 1, NULL, NULL),
(56, 9, 12, NULL, NULL),
(57, 9, 11, NULL, NULL),
(58, 9, 9, NULL, NULL),
(59, 9, 10, NULL, NULL),
(60, 10, 12, NULL, NULL),
(61, 10, 11, NULL, NULL),
(62, 10, 9, NULL, NULL),
(63, 10, 10, NULL, NULL),
(64, 11, 12, NULL, NULL),
(65, 11, 6, NULL, NULL),
(66, 11, 2, NULL, NULL),
(67, 11, 8, NULL, NULL),
(68, 11, 4, NULL, NULL),
(69, 11, 11, NULL, NULL),
(70, 11, 7, NULL, NULL),
(71, 11, 3, NULL, NULL),
(72, 11, 13, NULL, NULL),
(73, 11, 14, NULL, NULL),
(74, 11, 9, NULL, NULL),
(75, 11, 5, NULL, NULL),
(76, 11, 10, NULL, NULL),
(77, 11, 1, NULL, NULL),
(78, 12, 12, NULL, NULL),
(79, 12, 2, NULL, NULL),
(80, 12, 11, NULL, NULL),
(81, 12, 7, NULL, NULL),
(82, 12, 3, NULL, NULL),
(83, 12, 13, NULL, NULL),
(84, 12, 9, NULL, NULL),
(85, 12, 5, NULL, NULL),
(86, 12, 10, NULL, NULL),
(87, 12, 1, NULL, NULL),
(88, 13, 12, NULL, NULL),
(89, 13, 11, NULL, NULL),
(90, 13, 9, NULL, NULL),
(91, 13, 10, NULL, NULL),
(92, 13, 1, NULL, NULL),
(93, 14, 12, NULL, NULL),
(94, 14, 11, NULL, NULL),
(95, 14, 9, NULL, NULL),
(96, 14, 10, NULL, NULL),
(97, 15, 12, NULL, NULL),
(98, 15, 11, NULL, NULL),
(99, 15, 9, NULL, NULL),
(100, 15, 10, NULL, NULL),
(101, 16, 12, NULL, NULL),
(102, 16, 6, NULL, NULL),
(103, 16, 2, NULL, NULL),
(104, 16, 8, NULL, NULL),
(105, 16, 4, NULL, NULL),
(106, 16, 11, NULL, NULL),
(107, 16, 7, NULL, NULL),
(108, 16, 3, NULL, NULL),
(109, 16, 13, NULL, NULL),
(110, 16, 14, NULL, NULL),
(111, 16, 9, NULL, NULL),
(112, 16, 5, NULL, NULL),
(113, 16, 10, NULL, NULL),
(114, 16, 1, NULL, NULL),
(115, 17, 12, NULL, NULL),
(116, 17, 2, NULL, NULL),
(117, 17, 11, NULL, NULL),
(118, 17, 7, NULL, NULL),
(119, 17, 3, NULL, NULL),
(120, 17, 13, NULL, NULL),
(121, 17, 9, NULL, NULL),
(122, 17, 5, NULL, NULL),
(123, 17, 10, NULL, NULL),
(124, 17, 1, NULL, NULL),
(125, 18, 12, NULL, NULL),
(126, 18, 11, NULL, NULL),
(127, 18, 9, NULL, NULL),
(128, 18, 10, NULL, NULL),
(129, 18, 1, NULL, NULL),
(130, 19, 12, NULL, NULL),
(131, 19, 11, NULL, NULL),
(132, 19, 9, NULL, NULL),
(133, 19, 10, NULL, NULL),
(134, 20, 12, NULL, NULL),
(135, 20, 11, NULL, NULL),
(136, 20, 9, NULL, NULL),
(137, 20, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plan_module`
--

CREATE TABLE `plan_module` (
  `id` bigint UNSIGNED NOT NULL,
  `subscription_plan_id` bigint UNSIGNED NOT NULL,
  `module_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plan_module`
--

INSERT INTO `plan_module` (`id`, `subscription_plan_id`, `module_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 2, 6, NULL, NULL),
(4, 2, 3, NULL, NULL),
(5, 2, 5, NULL, NULL),
(6, 2, 7, NULL, NULL),
(7, 2, 1, NULL, NULL),
(8, 2, 4, NULL, NULL),
(9, 2, 2, NULL, NULL),
(10, 3, 6, NULL, NULL),
(11, 3, 3, NULL, NULL),
(12, 3, 5, NULL, NULL),
(13, 3, 7, NULL, NULL),
(14, 3, 10, NULL, NULL),
(15, 3, 8, NULL, NULL),
(16, 3, 1, NULL, NULL),
(17, 3, 4, NULL, NULL),
(18, 3, 2, NULL, NULL),
(19, 3, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gray',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `label`, `color`, `created_at`, `updated_at`) VALUES
(16, 'super_admin', 'Super Administrator', 'red', '2026-01-08 09:02:35', '2026-01-08 09:02:35'),
(17, 'admin', 'School Administrator', 'purple', '2026-01-08 09:02:35', '2026-01-08 09:02:35'),
(18, 'teacher', 'Teacher', 'blue', '2026-01-08 09:02:35', '2026-01-08 09:02:35'),
(19, 'parent', 'Parent', 'green', '2026-01-08 09:02:35', '2026-01-08 09:02:35'),
(20, 'student', 'Student', 'orange', '2026-01-08 09:02:35', '2026-01-08 09:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `settings` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `domain`, `address`, `phone`, `email`, `description`, `logo`, `is_active`, `settings`, `created_at`, `updated_at`) VALUES
(1, 'Green Valley High School', 'greenvalley', '123 Education Street, Springfield, IL 62701', '+1-555-0123', 'admin@greenvalley.edu', 'A premier high school focused on academic excellence and student development.', NULL, 1, '{\"currency\": \"USD\", \"timezone\": \"America/Chicago\", \"academic_year_end\": \"05-30\", \"academic_year_start\": \"08-15\"}', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(2, 'Riverside Elementary School', 'riverside', '456 Learning Avenue, Riverside, CA 92501', '+1-555-0456', 'contact@riverside.edu', 'Nurturing young minds through innovative teaching methods.', NULL, 1, '{\"currency\": \"USD\", \"timezone\": \"America/Los_Angeles\", \"academic_year_end\": \"06-15\", \"academic_year_start\": \"09-01\"}', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(3, 'Mountain View Academy', 'mountainview', '789 Knowledge Boulevard, Denver, CO 80201', '+1-555-0789', 'info@mountainview.edu', 'Specialized education for gifted students with advanced curriculum.', NULL, 1, '{\"currency\": \"USD\", \"timezone\": \"America/Denver\", \"academic_year_end\": \"05-25\", \"academic_year_start\": \"08-20\"}', '2026-01-08 08:43:22', '2026-01-08 08:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('IiFoLYGuTAQU3bnL2k1ULcdLUeD2pYmRKti73Yqf', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUXo3bzdKRmFYOFUzZ3ZCdE9mSHFDUEVsS1pUTmhaSk53RE9STU84RyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vbGl2ZXdpcmUudGVzdCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1767888162);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `school_id` bigint UNSIGNED NOT NULL,
  `subscription_plan_id` bigint UNSIGNED NOT NULL,
  `starts_at` datetime NOT NULL,
  `ends_at` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `price` decimal(10,2) DEFAULT NULL,
  `billing_period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `school_id`, `subscription_plan_id`, `starts_at`, `ends_at`, `status`, `price`, `billing_period`, `metadata`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2026-01-08 14:13:22', '2027-01-08 14:13:22', 'active', 79.99, 'monthly', '[]', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(2, 2, 1, '2026-01-08 14:13:22', '2027-01-08 14:13:22', 'active', 29.99, 'monthly', '[]', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(3, 3, 3, '2026-01-08 14:13:22', '2027-01-08 14:13:22', 'active', 199.99, 'monthly', '[]', '2026-01-08 08:43:22', '2026-01-08 08:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `billing_period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `max_users` int DEFAULT NULL,
  `max_storage_gb` int DEFAULT NULL,
  `features` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `name`, `slug`, `description`, `price`, `billing_period`, `max_users`, `max_storage_gb`, `features`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Basic', 'basic', 'Essential school management features for small schools', 29.99, 'monthly', 50, 10, '[\"Student Management\", \"Teacher Management\", \"Basic Reporting\", \"Email Support\"]', 1, 1, '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(2, 'Professional', 'professional', 'Advanced features for growing educational institutions', 79.99, 'monthly', 200, 50, '[\"All Basic features\", \"Class Management\", \"Subject Management\", \"Examination Management\", \"Attendance Tracking\", \"Financial Management\", \"Priority Support\"]', 1, 2, '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(3, 'Enterprise', 'enterprise', 'Complete solution for large educational organizations', 199.99, 'monthly', 1000, 500, '[\"All Professional features\", \"Library Management\", \"Transport Management\", \"Hostel Management\", \"Advanced Analytics\", \"API Access\", \"24/7 Phone Support\", \"Custom Integrations\"]', 1, 3, '2026-01-08 08:43:22', '2026-01-08 08:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `school_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role_id`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `school_id`) VALUES
(123, 'Super Administrator', 'superadmin@schoolsaas.com', '2026-01-08 09:02:35', 16, '$2y$12$CJ9pN2UnxwFXXwzegky2ReH5Ol8wOZQGZDCGRPYn6nFIp3miwdLOG', NULL, NULL, NULL, NULL, '2026-01-08 09:02:35', '2026-01-08 09:02:35', NULL),
(124, 'Dr. Sarah Principal - Green Valley High School', 'principal@greenvalley.edu', '2026-01-08 09:02:35', 17, '$2y$12$YKuzyLyvdqM5EBWyq7NfRu4NgwKR3Nz3UvE6hLqhJXeuNsz1BdbSa', NULL, NULL, NULL, NULL, '2026-01-08 09:02:35', '2026-01-08 09:02:35', 1),
(125, 'Mr. John Deputy - Green Valley High School', 'deputy@greenvalley.edu', '2026-01-08 09:02:35', 17, '$2y$12$Mqx50Q/bxzfEsYwW.iYE0eXsXgovceg7N01CcWGY5GcP19QPExGUm', NULL, NULL, NULL, NULL, '2026-01-08 09:02:35', '2026-01-08 09:02:35', 1),
(126, 'Mrs. Mary Admin - Green Valley High School', 'admin@greenvalley.edu', '2026-01-08 09:02:35', 17, '$2y$12$8a7A87ZjVuTZvujqItK39edYvbOB2BLnHoy0x.YPpfE5x/qF0zk1a', NULL, NULL, NULL, NULL, '2026-01-08 09:02:36', '2026-01-08 09:02:36', 1),
(127, 'Ms. Emily Johnson - Green Valley High School', 'emily.johnson@greenvalley.edu', '2026-01-08 09:02:36', 18, '$2y$12$H.SDheu1d5.kaOKRT8JqWOLyTSj3xvJ4PfA8SI5EoPIRhhjuqtNYa', NULL, NULL, NULL, NULL, '2026-01-08 09:02:36', '2026-01-08 09:02:36', 1),
(128, 'Mr. David Smith - Green Valley High School', 'david.smith@greenvalley.edu', '2026-01-08 09:02:36', 18, '$2y$12$PD1Ce39DaWchiW8SqEw9peJOWZwYS4nlxNL6i3cDfl3/1KQjhb0LW', NULL, NULL, NULL, NULL, '2026-01-08 09:02:36', '2026-01-08 09:02:36', 1),
(129, 'Mrs. Lisa Brown - Green Valley High School', 'lisa.brown@greenvalley.edu', '2026-01-08 09:02:36', 18, '$2y$12$J0C9X.jCWRnj3ieJRVaJpesw5di1gTSIvytLSaCHM1Io/Zo/DKeYK', NULL, NULL, NULL, NULL, '2026-01-08 09:02:36', '2026-01-08 09:02:36', 1),
(130, 'Mr. Robert Wilson - Green Valley High School', 'robert.wilson@greenvalley.edu', '2026-01-08 09:02:36', 18, '$2y$12$AwUDv/mG9WbJSN3CnyBLUuClUfVye8b.OsoZTgeA6jlIApAvVtB7i', NULL, NULL, NULL, NULL, '2026-01-08 09:02:37', '2026-01-08 09:02:37', 1),
(131, 'Mrs. Jennifer Davis - Green Valley High School', 'jennifer.davis@greenvalley.com', '2026-01-08 09:02:37', 19, '$2y$12$sceMFviwOSoCObegq0toCOZ/rKnlHd0neYbw.InlDQWLglc5CNbbO', NULL, NULL, NULL, NULL, '2026-01-08 09:02:37', '2026-01-08 09:02:37', 1),
(132, 'Mr. Michael Garcia - Green Valley High School', 'michael.garcia@greenvalley.com', '2026-01-08 09:02:37', 19, '$2y$12$7yYsmOoSA5zxpcgsTKbw5ePFUGzXWCXk3hv1RNQOQdVYEASvtLl2q', NULL, NULL, NULL, NULL, '2026-01-08 09:02:37', '2026-01-08 09:02:37', 1),
(133, 'Mrs. Patricia Lee - Green Valley High School', 'patricia.lee@greenvalley.com', '2026-01-08 09:02:37', 19, '$2y$12$7jPjJGsIeeiAvk24bA.cjerDVElb2V/hADPoSMftHrECCpgMn4RA6', NULL, NULL, NULL, NULL, '2026-01-08 09:02:37', '2026-01-08 09:02:37', 1),
(134, 'Emma Johnson - Green Valley High School', 'emma.johnson@greenvalley.edu', '2026-01-08 09:02:37', 20, '$2y$12$LOacyVh6//vXEMMdxbGKd.c73X4uIhms6hMdeETd0o0t4keUpZGiS', NULL, NULL, NULL, NULL, '2026-01-08 09:02:37', '2026-01-08 09:02:37', 1),
(135, 'Noah Smith - Green Valley High School', 'noah.smith@greenvalley.edu', '2026-01-08 09:02:37', 20, '$2y$12$JF1Yd7HWDnwwvNIGq.p0y.XHq/hVQvkQ1jtSvDi2YlXUEzsHsk7VW', NULL, NULL, NULL, NULL, '2026-01-08 09:02:38', '2026-01-08 09:02:38', 1),
(136, 'Olivia Brown - Green Valley High School', 'olivia.brown@greenvalley.edu', '2026-01-08 09:02:38', 20, '$2y$12$XnjUkCbag7xVVZlDMsUrDOZNiGVpkk1.Mdzc8huCnu/jd5jbxVKi6', NULL, NULL, NULL, NULL, '2026-01-08 09:02:38', '2026-01-08 09:02:38', 1),
(137, 'Liam Wilson - Green Valley High School', 'liam.wilson@greenvalley.edu', '2026-01-08 09:02:38', 20, '$2y$12$o0UazIDBz3FGYKOWvqBCq.iDNYfM8jT/7ZtNy0Tj.ErXyP8UY4nt6', NULL, NULL, NULL, NULL, '2026-01-08 09:02:38', '2026-01-08 09:02:38', 1),
(138, 'Sophia Davis - Green Valley High School', 'sophia.davis@greenvalley.edu', '2026-01-08 09:02:38', 20, '$2y$12$Rmu7oc1FeVr.oZUDhbVBzuTB/9SezlBN8fyEJjDNwzgxGZEqiMei.', NULL, NULL, NULL, NULL, '2026-01-08 09:02:38', '2026-01-08 09:02:38', 1),
(139, 'Mason Garcia - Green Valley High School', 'mason.garcia@greenvalley.edu', '2026-01-08 09:02:38', 20, '$2y$12$1TAt8tYEvY1OorBNCaDufOMZVyun6vUp5V8DGAm5EPh3O0vtIe4SK', NULL, NULL, NULL, NULL, '2026-01-08 09:02:38', '2026-01-08 09:02:38', 1),
(140, 'Isabella Lee - Green Valley High School', 'isabella.lee@greenvalley.edu', '2026-01-08 09:02:38', 20, '$2y$12$9uEcgaGMGHohjqkK1JJK7uteetGKW6.HTOptlanDdW7QEFKepPCUq', NULL, NULL, NULL, NULL, '2026-01-08 09:02:39', '2026-01-08 09:02:39', 1),
(141, 'Ethan Martinez - Green Valley High School', 'ethan.martinez@greenvalley.edu', '2026-01-08 09:02:39', 20, '$2y$12$G/8zPb76gRlI1sJGYbv5vOR32wBfyWkTSbV60eiDY53TTRzkGq8ay', NULL, NULL, NULL, NULL, '2026-01-08 09:02:39', '2026-01-08 09:02:39', 1),
(142, 'Dr. Sarah Principal - Riverside Elementary School', 'principal@riverside.edu', '2026-01-08 09:02:39', 17, '$2y$12$97JG/vxlxj5fiZIJpzMEAuT/mmrN.v4OwztU1V1SBU4hBGV0zw0mu', NULL, NULL, NULL, NULL, '2026-01-08 09:02:39', '2026-01-08 09:02:39', 2),
(143, 'Mr. John Deputy - Riverside Elementary School', 'deputy@riverside.edu', '2026-01-08 09:02:39', 17, '$2y$12$74D0cakiLkEuxL1LQLPoGu0BwmxsEuhlRphsoWCKYzVv0xW4vSwEK', NULL, NULL, NULL, NULL, '2026-01-08 09:02:39', '2026-01-08 09:02:39', 2),
(144, 'Mrs. Mary Admin - Riverside Elementary School', 'admin@riverside.edu', '2026-01-08 09:02:39', 17, '$2y$12$6vNE.ivNziOd5VNHPc2iDu04wD.4PBl4D6y4oQzhMxkFjV0hN2V0G', NULL, NULL, NULL, NULL, '2026-01-08 09:02:39', '2026-01-08 09:02:39', 2),
(145, 'Ms. Emily Johnson - Riverside Elementary School', 'emily.johnson@riverside.edu', '2026-01-08 09:02:39', 18, '$2y$12$tJr6Dd7fCwBj0in/AXJXzuaf0r7F8szHGb8PNi7/SzQlYN.Qc4Kom', NULL, NULL, NULL, NULL, '2026-01-08 09:02:40', '2026-01-08 09:02:40', 2),
(146, 'Mr. David Smith - Riverside Elementary School', 'david.smith@riverside.edu', '2026-01-08 09:02:40', 18, '$2y$12$/7hJtk.fviD8lgeki9FGz.Hadi1wNt1zwZkcnN94v2g7NDgryoCNi', NULL, NULL, NULL, NULL, '2026-01-08 09:02:40', '2026-01-08 09:02:40', 2),
(147, 'Mrs. Lisa Brown - Riverside Elementary School', 'lisa.brown@riverside.edu', '2026-01-08 09:02:40', 18, '$2y$12$n6wTMnRcqrwzPmXmFqcsdeuyBmSpOYFNsYivyzoq45gMKij58FcHW', NULL, NULL, NULL, NULL, '2026-01-08 09:02:40', '2026-01-08 09:02:40', 2),
(148, 'Mr. Robert Wilson - Riverside Elementary School', 'robert.wilson@riverside.edu', '2026-01-08 09:02:40', 18, '$2y$12$TiiyF.FQsASR0pkig59FF.gCFl0lgzkZJ7czCqmVmR8NQc0B6.QTa', NULL, NULL, NULL, NULL, '2026-01-08 09:02:40', '2026-01-08 09:02:40', 2),
(149, 'Mrs. Jennifer Davis - Riverside Elementary School', 'jennifer.davis@riverside.com', '2026-01-08 09:02:40', 19, '$2y$12$PuNYLOMgxFLe5JDHAWjwguRLr.7WxAnqsj7vnv40VTxeVka/ptMw.', NULL, NULL, NULL, NULL, '2026-01-08 09:02:40', '2026-01-08 09:02:40', 2),
(150, 'Mr. Michael Garcia - Riverside Elementary School', 'michael.garcia@riverside.com', '2026-01-08 09:02:40', 19, '$2y$12$IWExecznAX0K6xtYoCjLOuB4ikOw9p/ktm6pJCi0SiDjNWMT8bRVG', NULL, NULL, NULL, NULL, '2026-01-08 09:02:41', '2026-01-08 09:02:41', 2),
(151, 'Mrs. Patricia Lee - Riverside Elementary School', 'patricia.lee@riverside.com', '2026-01-08 09:02:41', 19, '$2y$12$4.J923KOVr9ixRmrwOt8Xe8kliSczkvhXM9dHI4R8J9q2FsvzQxUG', NULL, NULL, NULL, NULL, '2026-01-08 09:02:41', '2026-01-08 09:02:41', 2),
(152, 'Emma Johnson - Riverside Elementary School', 'emma.johnson@riverside.edu', '2026-01-08 09:02:41', 20, '$2y$12$gVcNRd7qyQnvkZ2v0HO.AeoVxqdH6KAqL16y.jV2bpTizTHSqmFL2', NULL, NULL, NULL, NULL, '2026-01-08 09:02:41', '2026-01-08 09:02:41', 2),
(153, 'Noah Smith - Riverside Elementary School', 'noah.smith@riverside.edu', '2026-01-08 09:02:41', 20, '$2y$12$tHaNm4vk9XU023yTDyqIeuvQoF/tb0aKFHOa99/iY.woIigapm3ii', NULL, NULL, NULL, NULL, '2026-01-08 09:02:41', '2026-01-08 09:02:41', 2),
(154, 'Olivia Brown - Riverside Elementary School', 'olivia.brown@riverside.edu', '2026-01-08 09:02:41', 20, '$2y$12$gl.F2Ip8UMQGCO6JYkAMO.5g1UlzXJxTq1igL/TGuBaWsE1E4V6TO', NULL, NULL, NULL, NULL, '2026-01-08 09:02:41', '2026-01-08 09:02:41', 2),
(155, 'Liam Wilson - Riverside Elementary School', 'liam.wilson@riverside.edu', '2026-01-08 09:02:41', 20, '$2y$12$KJgPm8zezgaUOM4DcW0gnO9358QKz2geFI2mgUbAHDtmOZAu3a6wK', NULL, NULL, NULL, NULL, '2026-01-08 09:02:42', '2026-01-08 09:02:42', 2),
(156, 'Sophia Davis - Riverside Elementary School', 'sophia.davis@riverside.edu', '2026-01-08 09:02:42', 20, '$2y$12$z4Fyo.hF0TLyvSltTUkxI.9KeW7EZ1NBgalqX5N88sQ5QJNrfoqAu', NULL, NULL, NULL, NULL, '2026-01-08 09:02:42', '2026-01-08 09:02:42', 2),
(157, 'Mason Garcia - Riverside Elementary School', 'mason.garcia@riverside.edu', '2026-01-08 09:02:42', 20, '$2y$12$S/CalJIFdsMjI13wEF5bEun3MEouMUnKbZSgG6cLDzrpC1REQGJaO', NULL, NULL, NULL, NULL, '2026-01-08 09:02:42', '2026-01-08 09:02:42', 2),
(158, 'Isabella Lee - Riverside Elementary School', 'isabella.lee@riverside.edu', '2026-01-08 09:02:42', 20, '$2y$12$./1M1lzt3.tyLWfn9vt3Q.lT3cbSg47NYW7l3zRDyLkwYt5fy9B1O', NULL, NULL, NULL, NULL, '2026-01-08 09:02:42', '2026-01-08 09:02:42', 2),
(159, 'Ethan Martinez - Riverside Elementary School', 'ethan.martinez@riverside.edu', '2026-01-08 09:02:42', 20, '$2y$12$lQxaq38ImQl5sG2zW62bdOhZi6XE9b/0lmf40HM0Ohr1WAmDE3ywW', NULL, NULL, NULL, NULL, '2026-01-08 09:02:42', '2026-01-08 09:02:42', 2),
(160, 'Dr. Sarah Principal - Mountain View Academy', 'principal@mountainview.edu', '2026-01-08 09:02:42', 17, '$2y$12$nd.1IwdR/4hQdp3JH7bqweDb1zZOQ0YV9mcHgc1.u7wtqZN7orf.u', NULL, NULL, NULL, NULL, '2026-01-08 09:02:43', '2026-01-08 09:02:43', 3),
(161, 'Mr. John Deputy - Mountain View Academy', 'deputy@mountainview.edu', '2026-01-08 09:02:43', 17, '$2y$12$XLXohPCIT/AYRbhTR0BR7ePjD/W9UWYO9qjq.ZSgNKtLaVZzg0oMu', NULL, NULL, NULL, NULL, '2026-01-08 09:02:43', '2026-01-08 09:02:43', 3),
(162, 'Mrs. Mary Admin - Mountain View Academy', 'admin@mountainview.edu', '2026-01-08 09:02:43', 17, '$2y$12$lq0w/EBHb.BNUiCZaT/wwOMuV5XA5lonLaHsN.ooVzkJad1OrOTqa', NULL, NULL, NULL, NULL, '2026-01-08 09:02:43', '2026-01-08 09:02:43', 3),
(163, 'Ms. Emily Johnson - Mountain View Academy', 'emily.johnson@mountainview.edu', '2026-01-08 09:02:43', 18, '$2y$12$EZz7Z9E4L5NSouWT5YXWeeUHijFBcNeHjQbxSXMjsnQrNHMuFHWju', NULL, NULL, NULL, NULL, '2026-01-08 09:02:43', '2026-01-08 09:02:43', 3),
(164, 'Mr. David Smith - Mountain View Academy', 'david.smith@mountainview.edu', '2026-01-08 09:02:43', 18, '$2y$12$pf8KVHS6nDp/LOgHvbc.x.NIXl15vjFCPY4kcQmx4aRffpV1zwY7m', NULL, NULL, NULL, NULL, '2026-01-08 09:02:43', '2026-01-08 09:02:43', 3),
(165, 'Mrs. Lisa Brown - Mountain View Academy', 'lisa.brown@mountainview.edu', '2026-01-08 09:02:43', 18, '$2y$12$dQ60fueiDKe5CD7Pab3Wy.h/3VSt9cD5zn8Z4weGgruBLSvMVb1xe', NULL, NULL, NULL, NULL, '2026-01-08 09:02:44', '2026-01-08 09:02:44', 3),
(166, 'Mr. Robert Wilson - Mountain View Academy', 'robert.wilson@mountainview.edu', '2026-01-08 09:02:44', 18, '$2y$12$KnJtVGNXkWflUSP87g26vu/567ek10q4mhxgJXF7enpBQLqRckqS6', NULL, NULL, NULL, NULL, '2026-01-08 09:02:44', '2026-01-08 09:02:44', 3),
(167, 'Mrs. Jennifer Davis - Mountain View Academy', 'jennifer.davis@mountainview.com', '2026-01-08 09:02:44', 19, '$2y$12$LwuwpsctKUTaCLbtsikEjuwdWtYiwvaJ29VIJ0WZEVjPlraCZL3qO', NULL, NULL, NULL, NULL, '2026-01-08 09:02:44', '2026-01-08 09:02:44', 3),
(168, 'Mr. Michael Garcia - Mountain View Academy', 'michael.garcia@mountainview.com', '2026-01-08 09:02:44', 19, '$2y$12$N2sgqGIqNscW2q4cbCdm6.w5x8n9F.bHUwyQcBJAplqR4YVB1.uIG', NULL, NULL, NULL, NULL, '2026-01-08 09:02:44', '2026-01-08 09:02:44', 3),
(169, 'Mrs. Patricia Lee - Mountain View Academy', 'patricia.lee@mountainview.com', '2026-01-08 09:02:44', 19, '$2y$12$71boYfyYOciXvgtaGml9n.Mg8O6v5O/bONjGHZbQ/gM71fIgGu0DC', NULL, NULL, NULL, NULL, '2026-01-08 09:02:44', '2026-01-08 09:02:44', 3),
(170, 'Emma Johnson - Mountain View Academy', 'emma.johnson@mountainview.edu', '2026-01-08 09:02:44', 20, '$2y$12$iTkeaU10q/WRrA/XpTKAWujzzv0G8BJ2.msbYBTOi8NfMP9MrE0aK', NULL, NULL, NULL, NULL, '2026-01-08 09:02:45', '2026-01-08 09:02:45', 3),
(171, 'Noah Smith - Mountain View Academy', 'noah.smith@mountainview.edu', '2026-01-08 09:02:45', 20, '$2y$12$gHf0kvOzYqATonE0D3XOo.f1oGBY/aUO2rW8YkcrgMI72vZULxZXO', NULL, NULL, NULL, NULL, '2026-01-08 09:02:45', '2026-01-08 09:02:45', 3),
(172, 'Olivia Brown - Mountain View Academy', 'olivia.brown@mountainview.edu', '2026-01-08 09:02:45', 20, '$2y$12$erQjlCbBJuzbhx7lYkEnEuGEuTU1LxkbmvS1J9kdF0BZrJXWIuvCu', NULL, NULL, NULL, NULL, '2026-01-08 09:02:45', '2026-01-08 09:02:45', 3),
(173, 'Liam Wilson - Mountain View Academy', 'liam.wilson@mountainview.edu', '2026-01-08 09:02:45', 20, '$2y$12$S3GxAR7ZBektWzyJuG2fi.20FCNUKSSqYsMr3xCTPEfOhlSWRCoaC', NULL, NULL, NULL, NULL, '2026-01-08 09:02:45', '2026-01-08 09:02:45', 3),
(174, 'Sophia Davis - Mountain View Academy', 'sophia.davis@mountainview.edu', '2026-01-08 09:02:45', 20, '$2y$12$jTrwayTm70OEkcAmvTdsPu6x0/gmgxzcT11QXgCe7gW4VXg5X4jhu', NULL, NULL, NULL, NULL, '2026-01-08 09:02:45', '2026-01-08 09:02:45', 3),
(175, 'Mason Garcia - Mountain View Academy', 'mason.garcia@mountainview.edu', '2026-01-08 09:02:45', 20, '$2y$12$Yu0Jh0/WxMQAZbccW3H56OimplVv4bpTLbyqCkN.K1ACiI6X277CG', NULL, NULL, NULL, NULL, '2026-01-08 09:02:46', '2026-01-08 09:02:46', 3),
(176, 'Isabella Lee - Mountain View Academy', 'isabella.lee@mountainview.edu', '2026-01-08 09:02:46', 20, '$2y$12$8RbA9emWi4Soa7OOwT0FguAr908tm/yABb2JwdcCPkz/z7dix9Yqu', NULL, NULL, NULL, NULL, '2026-01-08 09:02:46', '2026-01-08 09:02:46', 3),
(177, 'Ethan Martinez - Mountain View Academy', 'ethan.martinez@mountainview.edu', '2026-01-08 09:02:46', 20, '$2y$12$ZZGsQAh6UM62CQqLW0.0AOkKxE2nAvjyBbSd5a3SLlGuFAmDrmnlC', NULL, NULL, NULL, NULL, '2026-01-08 09:02:46', '2026-01-08 09:02:46', 3);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modules_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_role_role_id_permission_id_unique` (`role_id`,`permission_id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `plan_module`
--
ALTER TABLE `plan_module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plan_module_subscription_plan_id_module_id_unique` (`subscription_plan_id`,`module_id`),
  ADD KEY `plan_module_module_id_foreign` (`module_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schools_domain_unique` (`domain`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_school_id_subscription_plan_id_unique` (`school_id`,`subscription_plan_id`),
  ADD KEY `subscriptions_subscription_plan_id_foreign` (`subscription_plan_id`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_plans_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_school_id_foreign` (`school_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `plan_module`
--
ALTER TABLE `plan_module`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `plan_module`
--
ALTER TABLE `plan_module`
  ADD CONSTRAINT `plan_module_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plan_module_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscriptions_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
