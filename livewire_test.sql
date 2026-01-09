-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2026 at 12:51 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

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
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_prefix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `slug`, `label`, `description`, `icon`, `route_prefix`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(24, 'students', 'students', 'Student Management', 'Manage student enrollment, profiles, and academic records', 'user', 'students', 1, 1, '2026-01-09 04:13:16', '2026-01-09 04:13:16'),
(25, 'teachers', 'teachers', 'Teacher Management', 'Manage teacher profiles, assignments, and performance', 'academic-cap', 'teachers', 1, 2, '2026-01-09 04:13:16', '2026-01-09 04:13:16'),
(26, 'classes', 'classes', 'Class Management', 'Manage class schedules, assignments, and student groupings', 'building-storefront', 'classes', 1, 3, '2026-01-09 04:13:16', '2026-01-09 04:13:16'),
(27, 'subjects', 'subjects', 'Subject Management', 'Manage curriculum subjects and course offerings', 'book-open', 'subjects', 1, 4, '2026-01-09 04:13:16', '2026-01-09 04:13:16'),
(28, 'exams', 'exams', 'Examination Management', 'Manage exams, grades, and academic assessments', 'clipboard-document-list', 'exams', 1, 5, '2026-01-09 04:13:16', '2026-01-09 04:13:16'),
(29, 'attendance', 'attendance', 'Attendance Tracking', 'Track student and teacher attendance records', 'calendar', 'attendance', 1, 6, '2026-01-09 04:13:16', '2026-01-09 04:13:16'),
(30, 'finance', 'finance', 'Financial Management', 'Manage fees, payments, and financial records', 'banknotes', 'finance', 1, 7, '2026-01-09 04:13:16', '2026-01-09 04:13:16'),
(31, 'library', 'library', 'Library Management', 'Manage library resources and book circulation', 'book-open', 'library', 1, 8, '2026-01-09 04:13:16', '2026-01-09 04:13:16'),
(32, 'transport', 'transport', 'Transport Management', 'Manage school transportation and routes', 'truck', 'transport', 1, 9, '2026-01-09 04:13:16', '2026-01-09 04:13:16'),
(33, 'hostel', 'hostel', 'Hostel Management', 'Manage dormitory accommodations and residents', 'home-modern', 'hostel', 1, 10, '2026-01-09 04:13:16', '2026-01-09 04:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(54, 'delete_hostel', 'Delete Hostel Management', 'hostel', 'Can delete Hostel Management', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(55, 'view_schools', 'View School Management', 'schools', 'Can view School Management list and details', '2026-01-09 03:30:18', '2026-01-09 03:30:18'),
(56, 'create_schools', 'Create School Management', 'schools', 'Can create new School Management', '2026-01-09 03:30:18', '2026-01-09 03:30:18'),
(57, 'edit_schools', 'Edit School Management', 'schools', 'Can edit existing School Management', '2026-01-09 03:30:18', '2026-01-09 03:30:18'),
(58, 'delete_schools', 'Delete School Management', 'schools', 'Can delete School Management', '2026-01-09 03:30:18', '2026-01-09 03:30:18'),
(59, 'view_subscriptions', 'View Subscription Management', 'subscriptions', 'Can view Subscription Management list and details', '2026-01-09 03:30:18', '2026-01-09 03:30:18'),
(60, 'create_subscriptions', 'Create Subscription Management', 'subscriptions', 'Can create new Subscription Management', '2026-01-09 03:30:18', '2026-01-09 03:30:18'),
(61, 'edit_subscriptions', 'Edit Subscription Management', 'subscriptions', 'Can edit existing Subscription Management', '2026-01-09 03:30:18', '2026-01-09 03:30:18'),
(62, 'delete_subscriptions', 'Delete Subscription Management', 'subscriptions', 'Can delete Subscription Management', '2026-01-09 03:30:18', '2026-01-09 03:30:18'),
(63, 'view_subscription_plans', 'View Subscription Plan Management', 'subscription_plans', 'Can view Subscription Plan Management list and details', '2026-01-09 03:30:18', '2026-01-09 03:30:18'),
(64, 'create_subscription_plans', 'Create Subscription Plan Management', 'subscription_plans', 'Can create new Subscription Plan Management', '2026-01-09 03:30:18', '2026-01-09 03:30:18'),
(65, 'edit_subscription_plans', 'Edit Subscription Plan Management', 'subscription_plans', 'Can edit existing Subscription Plan Management', '2026-01-09 03:30:18', '2026-01-09 03:30:18'),
(66, 'delete_subscription_plans', 'Delete Subscription Plan Management', 'subscription_plans', 'Can delete Subscription Plan Management', '2026-01-09 03:30:18', '2026-01-09 03:30:18'),
(67, 'view_modules', 'View Modules', 'modules', 'Can view Modules list and details', '2026-01-09 04:11:30', '2026-01-09 04:11:30'),
(68, 'create_modules', 'Create Modules', 'modules', 'Can create new Modules', '2026-01-09 04:11:30', '2026-01-09 04:11:30'),
(69, 'edit_modules', 'Edit Modules', 'modules', 'Can edit existing Modules', '2026-01-09 04:11:30', '2026-01-09 04:11:30'),
(70, 'delete_modules', 'Delete Modules', 'modules', 'Can delete Modules', '2026-01-09 04:11:30', '2026-01-09 04:11:30'),
(71, 'view_plan_modules', 'View Plan_modules', 'plan_modules', 'Can view Plan_modules list and details', '2026-01-09 04:11:30', '2026-01-09 04:11:30'),
(72, 'create_plan_modules', 'Create Plan_modules', 'plan_modules', 'Can create new Plan_modules', '2026-01-09 04:11:30', '2026-01-09 04:11:30'),
(73, 'edit_plan_modules', 'Edit Plan_modules', 'plan_modules', 'Can edit existing Plan_modules', '2026-01-09 04:11:30', '2026-01-09 04:11:30'),
(74, 'delete_plan_modules', 'Delete Plan_modules', 'plan_modules', 'Can delete Plan_modules', '2026-01-09 04:11:30', '2026-01-09 04:11:30');

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
(1, 26, 12, NULL, NULL),
(2, 26, 36, NULL, NULL),
(3, 26, 24, NULL, NULL),
(4, 26, 32, NULL, NULL),
(5, 26, 40, NULL, NULL),
(6, 26, 52, NULL, NULL),
(7, 26, 44, NULL, NULL),
(8, 26, 68, NULL, NULL),
(9, 26, 72, NULL, NULL),
(10, 26, 6, NULL, NULL),
(11, 26, 56, NULL, NULL),
(12, 26, 16, NULL, NULL),
(13, 26, 28, NULL, NULL),
(14, 26, 64, NULL, NULL),
(15, 26, 60, NULL, NULL),
(16, 26, 20, NULL, NULL),
(17, 26, 48, NULL, NULL),
(18, 26, 2, NULL, NULL),
(19, 26, 38, NULL, NULL),
(20, 26, 26, NULL, NULL),
(21, 26, 34, NULL, NULL),
(22, 26, 42, NULL, NULL),
(23, 26, 54, NULL, NULL),
(24, 26, 46, NULL, NULL),
(25, 26, 70, NULL, NULL),
(26, 26, 74, NULL, NULL),
(27, 26, 8, NULL, NULL),
(28, 26, 58, NULL, NULL),
(29, 26, 18, NULL, NULL),
(30, 26, 30, NULL, NULL),
(31, 26, 66, NULL, NULL),
(32, 26, 62, NULL, NULL),
(33, 26, 22, NULL, NULL),
(34, 26, 50, NULL, NULL),
(35, 26, 4, NULL, NULL),
(36, 26, 37, NULL, NULL),
(37, 26, 25, NULL, NULL),
(38, 26, 33, NULL, NULL),
(39, 26, 41, NULL, NULL),
(40, 26, 53, NULL, NULL),
(41, 26, 45, NULL, NULL),
(42, 26, 69, NULL, NULL),
(43, 26, 73, NULL, NULL),
(44, 26, 11, NULL, NULL),
(45, 26, 7, NULL, NULL),
(46, 26, 57, NULL, NULL),
(47, 26, 17, NULL, NULL),
(48, 26, 29, NULL, NULL),
(49, 26, 65, NULL, NULL),
(50, 26, 61, NULL, NULL),
(51, 26, 21, NULL, NULL),
(52, 26, 49, NULL, NULL),
(53, 26, 3, NULL, NULL),
(54, 26, 13, NULL, NULL),
(55, 26, 14, NULL, NULL),
(56, 26, 35, NULL, NULL),
(57, 26, 23, NULL, NULL),
(58, 26, 9, NULL, NULL),
(59, 26, 31, NULL, NULL),
(60, 26, 39, NULL, NULL),
(61, 26, 51, NULL, NULL),
(62, 26, 43, NULL, NULL),
(63, 26, 67, NULL, NULL),
(64, 26, 71, NULL, NULL),
(65, 26, 5, NULL, NULL),
(66, 26, 55, NULL, NULL),
(67, 26, 10, NULL, NULL),
(68, 26, 15, NULL, NULL),
(69, 26, 27, NULL, NULL),
(70, 26, 63, NULL, NULL),
(71, 26, 59, NULL, NULL),
(72, 26, 19, NULL, NULL),
(73, 26, 47, NULL, NULL),
(74, 26, 1, NULL, NULL),
(75, 27, 12, NULL, NULL),
(76, 27, 36, NULL, NULL),
(77, 27, 24, NULL, NULL),
(78, 27, 32, NULL, NULL),
(79, 27, 40, NULL, NULL),
(80, 27, 52, NULL, NULL),
(81, 27, 44, NULL, NULL),
(82, 27, 16, NULL, NULL),
(83, 27, 28, NULL, NULL),
(84, 27, 20, NULL, NULL),
(85, 27, 48, NULL, NULL),
(86, 27, 2, NULL, NULL),
(87, 27, 38, NULL, NULL),
(88, 27, 26, NULL, NULL),
(89, 27, 34, NULL, NULL),
(90, 27, 42, NULL, NULL),
(91, 27, 54, NULL, NULL),
(92, 27, 46, NULL, NULL),
(93, 27, 18, NULL, NULL),
(94, 27, 30, NULL, NULL),
(95, 27, 22, NULL, NULL),
(96, 27, 50, NULL, NULL),
(97, 27, 37, NULL, NULL),
(98, 27, 25, NULL, NULL),
(99, 27, 33, NULL, NULL),
(100, 27, 41, NULL, NULL),
(101, 27, 53, NULL, NULL),
(102, 27, 45, NULL, NULL),
(103, 27, 11, NULL, NULL),
(104, 27, 7, NULL, NULL),
(105, 27, 17, NULL, NULL),
(106, 27, 29, NULL, NULL),
(107, 27, 21, NULL, NULL),
(108, 27, 49, NULL, NULL),
(109, 27, 3, NULL, NULL),
(110, 27, 13, NULL, NULL),
(111, 27, 35, NULL, NULL),
(112, 27, 23, NULL, NULL),
(113, 27, 9, NULL, NULL),
(114, 27, 31, NULL, NULL),
(115, 27, 39, NULL, NULL),
(116, 27, 51, NULL, NULL),
(117, 27, 43, NULL, NULL),
(118, 27, 5, NULL, NULL),
(119, 27, 10, NULL, NULL),
(120, 27, 15, NULL, NULL),
(121, 27, 27, NULL, NULL),
(122, 27, 19, NULL, NULL),
(123, 27, 47, NULL, NULL),
(124, 27, 1, NULL, NULL),
(125, 28, 12, NULL, NULL),
(126, 28, 11, NULL, NULL),
(127, 28, 35, NULL, NULL),
(128, 28, 23, NULL, NULL),
(129, 28, 9, NULL, NULL),
(130, 28, 31, NULL, NULL),
(131, 28, 10, NULL, NULL),
(132, 28, 15, NULL, NULL),
(133, 28, 27, NULL, NULL),
(134, 29, 12, NULL, NULL),
(135, 29, 11, NULL, NULL),
(136, 29, 9, NULL, NULL),
(137, 29, 10, NULL, NULL),
(138, 29, 15, NULL, NULL),
(139, 30, 12, NULL, NULL),
(140, 30, 11, NULL, NULL),
(141, 30, 9, NULL, NULL),
(142, 30, 10, NULL, NULL),
(143, 30, 15, NULL, NULL);

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
(20, 1, 24, NULL, NULL),
(21, 1, 25, NULL, NULL),
(22, 2, 29, NULL, NULL),
(23, 2, 26, NULL, NULL),
(24, 2, 28, NULL, NULL),
(25, 2, 30, NULL, NULL),
(26, 2, 24, NULL, NULL),
(27, 2, 27, NULL, NULL),
(28, 2, 25, NULL, NULL),
(29, 3, 29, NULL, NULL),
(30, 3, 26, NULL, NULL),
(31, 3, 28, NULL, NULL),
(32, 3, 30, NULL, NULL),
(33, 3, 33, NULL, NULL),
(34, 3, 31, NULL, NULL),
(35, 3, 24, NULL, NULL),
(36, 3, 27, NULL, NULL),
(37, 3, 25, NULL, NULL),
(38, 3, 32, NULL, NULL),
(39, 4, 27, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gray',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `label`, `color`, `created_at`, `updated_at`) VALUES
(26, 'super_admin', 'Super Administrator', 'red', '2026-01-09 04:13:16', '2026-01-09 04:13:16'),
(27, 'admin', 'School Administrator', 'purple', '2026-01-09 04:13:17', '2026-01-09 04:13:17'),
(28, 'teacher', 'Teacher', 'blue', '2026-01-09 04:13:17', '2026-01-09 04:13:17'),
(29, 'parent', 'Parent', 'green', '2026-01-09 04:13:17', '2026-01-09 04:13:17'),
(30, 'student', 'Student', 'orange', '2026-01-09 04:13:17', '2026-01-09 04:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `domain` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('09hqaZA5jnkUz5TvzdDhVxEz7XLo7i5tLxY9BzQA', 178, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTXp1czlCRWR3ZmtiMXJKUU90OTQzV2JtWjJKZkwzbURqcmVoQlRkQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vbGl2ZXdpcmUudGVzdC9zdWJzY3JpcHRpb25zIjtzOjU6InJvdXRlIjtzOjE5OiJzdWJzY3JpcHRpb25zLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTc4O3M6MzoidXJsIjthOjA6e319', 1767961965),
('fCARE5MzLICLVyuAtdPNhaA8dYXbMFS5wGLnDyYp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRTZjVm9iRW00TlZHaldiOXZsbUdtZ0kyaGNoSW5ZalE0UzZzT1hzUSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cHM6Ly9saXZld2lyZS50ZXN0L2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwczovL2xpdmV3aXJlLnRlc3QvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767958623),
('H2Xdz1jTA20IbGjXtFzZNbx3hg1sUAlhIwVyUzu2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.24.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSzF4WkoyTW9yUGNnWWh6MUh1UjVaUkIzcnJDVDdlNnR0MEVCYW9pYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vbGl2ZXdpcmUudGVzdC8/aGVyZD1wcmV2aWV3IjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767958734),
('nBdZmqYQvO8gJx64LIOpYWHfktMQhMe6RXWy8Lva', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.24.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2ZpcldEYU9XaTVMa01GdGtRcXN3N1pFdk05dzVhODJXTWhGQjZiYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vbGl2ZXdpcmUudGVzdC8/aGVyZD1wcmV2aWV3IjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767958728),
('VgwTr8LUmiBLDX34K6qpeaRlD1JV2adgLT7wKvB3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.24.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNVpoR2xPb1dIOWxjZVVSMDByeEsxTzVXQ1B5Rmg1SjVTbm1rTXZrViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vbGl2ZXdpcmUudGVzdC8/aGVyZD1wcmV2aWV3IjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767959164);

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
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `price` decimal(10,2) DEFAULT NULL,
  `billing_period` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `school_id`, `subscription_plan_id`, `starts_at`, `ends_at`, `status`, `price`, `billing_period`, `metadata`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2026-01-08 14:13:22', '2027-01-08 14:13:22', 'active', 79.99, 'monthly', '[]', '2026-01-08 08:43:22', '2026-01-09 04:43:05'),
(2, 2, 1, '2026-01-08 14:13:22', '2027-01-08 14:13:22', 'active', 29.99, 'monthly', '[]', '2026-01-08 08:43:22', '2026-01-08 08:43:22'),
(3, 3, 3, '2026-01-08 14:13:22', '2027-01-08 14:13:22', 'active', 199.99, 'monthly', '[]', '2026-01-08 08:43:22', '2026-01-08 08:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `billing_period` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `school_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role_id`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `school_id`) VALUES
(178, 'Super Admin', 'superadmin@isp.com', '2026-01-09 04:13:17', 26, '$2y$12$RaOARh5Ur52rI3jWB4X0MOF9rqkqLuBjuXbdXUJPu5XTo2PP.l.9m', NULL, NULL, NULL, NULL, '2026-01-09 04:13:18', '2026-01-09 04:13:18', NULL),
(179, 'Dr. Sarah Principal - Green Valley High School', 'principal@greenvalley.edu', '2026-01-09 04:13:18', 27, '$2y$12$H2FouLGMpE1zJ6jKWcKRI.nIl1hOgw/PkhP4ii7wb0xojWDToSRSO', NULL, NULL, NULL, NULL, '2026-01-09 04:13:18', '2026-01-09 04:13:18', 1),
(180, 'Mr. John Deputy - Green Valley High School', 'deputy@greenvalley.edu', '2026-01-09 04:13:18', 27, '$2y$12$50EG0GzT6Vg0dR2gYFTujOZvex3JlB3bODsFov63tb6fzYHHppDxS', NULL, NULL, NULL, NULL, '2026-01-09 04:13:19', '2026-01-09 04:13:19', 1),
(181, 'Mrs. Mary Admin - Green Valley High School', 'admin@greenvalley.edu', '2026-01-09 04:13:19', 27, '$2y$12$TjFQ74VMM7i/TslAY9elK.dAMOQ9T7NrLcuaORQP9HWeMAPekgtgu', NULL, NULL, NULL, NULL, '2026-01-09 04:13:19', '2026-01-09 04:13:19', 1),
(182, 'Ms. Emily Johnson - Green Valley High School', 'emily.johnson@greenvalley.edu', '2026-01-09 04:13:19', 28, '$2y$12$bc1zcK7wzO0QINT1T.r1luv2fXtnLAE.6ui.TNW4l3zfv8ta3eddO', NULL, NULL, NULL, NULL, '2026-01-09 04:13:19', '2026-01-09 04:13:19', 1),
(183, 'Mr. David Smith - Green Valley High School', 'david.smith@greenvalley.edu', '2026-01-09 04:13:19', 28, '$2y$12$W5nISy9INDwosemMbTsUveLUbNpn0r7QmRgKhjudwZ/7OyPT71bYG', NULL, NULL, NULL, NULL, '2026-01-09 04:13:20', '2026-01-09 04:13:20', 1),
(184, 'Mrs. Lisa Brown - Green Valley High School', 'lisa.brown@greenvalley.edu', '2026-01-09 04:13:20', 28, '$2y$12$Gql9j7.UIV/2pf/QXDt11eUn6AujLu4CZ2WrzuMhzIno0d4fj/CsK', NULL, NULL, NULL, NULL, '2026-01-09 04:13:20', '2026-01-09 04:13:20', 1),
(185, 'Mr. Robert Wilson - Green Valley High School', 'robert.wilson@greenvalley.edu', '2026-01-09 04:13:20', 28, '$2y$12$.EWFMHUa/x4gLBLODzatGu6fywcYT75ZrYVGmcwjFuzcyWGBoYI5m', NULL, NULL, NULL, NULL, '2026-01-09 04:13:21', '2026-01-09 04:13:21', 1),
(186, 'Mrs. Jennifer Davis - Green Valley High School', 'jennifer.davis@greenvalley.com', '2026-01-09 04:13:21', 29, '$2y$12$qrqS2JTUXtwIm.w8vaw/t.i8x.PHgHpVHchLUhdq8MIz/C0/6bwU.', NULL, NULL, NULL, NULL, '2026-01-09 04:13:21', '2026-01-09 04:13:21', 1),
(187, 'Mr. Michael Garcia - Green Valley High School', 'michael.garcia@greenvalley.com', '2026-01-09 04:13:21', 29, '$2y$12$FcPS8bQMuKf2YVcj4ibeN.yToQFQp8mcdRLncFMPRCKWk30AGfaZC', NULL, NULL, NULL, NULL, '2026-01-09 04:13:22', '2026-01-09 04:13:22', 1),
(188, 'Mrs. Patricia Lee - Green Valley High School', 'patricia.lee@greenvalley.com', '2026-01-09 04:13:22', 29, '$2y$12$EJ.m1vBzTr1tg3ACfE4D1uwTNAxYvU7CXP6lI1./dIMYAtXS4iISe', NULL, NULL, NULL, NULL, '2026-01-09 04:13:22', '2026-01-09 04:13:22', 1),
(189, 'Emma Johnson - Green Valley High School', 'emma.johnson@greenvalley.edu', '2026-01-09 04:13:22', 30, '$2y$12$5GatHIA0GVnIFsY43uBKJ.P7wIl50FPmRAVg5mKzNkDLnOvOHRyye', NULL, NULL, NULL, NULL, '2026-01-09 04:13:23', '2026-01-09 04:13:23', 1),
(190, 'Noah Smith - Green Valley High School', 'noah.smith@greenvalley.edu', '2026-01-09 04:13:23', 30, '$2y$12$XsjirqkhziDmBEWnD3PwXeDgNKiCHjdRGomCbzJgkN4ev/AYKYVdG', NULL, NULL, NULL, NULL, '2026-01-09 04:13:23', '2026-01-09 04:13:23', 1),
(191, 'Olivia Brown - Green Valley High School', 'olivia.brown@greenvalley.edu', '2026-01-09 04:13:23', 30, '$2y$12$HWo.xyySGQHOTkS76G7I0edeP0kgvNLEu0eu/M6OzVxBxlyOPBEv.', NULL, NULL, NULL, NULL, '2026-01-09 04:13:23', '2026-01-09 04:13:23', 1),
(192, 'Liam Wilson - Green Valley High School', 'liam.wilson@greenvalley.edu', '2026-01-09 04:13:23', 30, '$2y$12$qo4eMus.53sOFjo4npf4fezifwc7TErWhkM5hKZKrHrorKyCpRw/u', NULL, NULL, NULL, NULL, '2026-01-09 04:13:24', '2026-01-09 04:13:24', 1),
(193, 'Sophia Davis - Green Valley High School', 'sophia.davis@greenvalley.edu', '2026-01-09 04:13:24', 30, '$2y$12$/rPamEZEcVhfl7WA4Q27m.6aLd8bE/NWr8hl.6sH1hpqZNsM30cgS', NULL, NULL, NULL, NULL, '2026-01-09 04:13:24', '2026-01-09 04:13:24', 1),
(194, 'Mason Garcia - Green Valley High School', 'mason.garcia@greenvalley.edu', '2026-01-09 04:13:24', 30, '$2y$12$N53FX34YgwpkPRU02D0esuKeA/j5WoC9jcCl/DFDSPS3h56jUmkH.', NULL, NULL, NULL, NULL, '2026-01-09 04:13:25', '2026-01-09 04:13:25', 1),
(195, 'Isabella Lee - Green Valley High School', 'isabella.lee@greenvalley.edu', '2026-01-09 04:13:25', 30, '$2y$12$PpVbpeeOf0QLGrxGGgTSuOxPhsBktPwdqnbDfR6X6Myv26vbiIDoy', NULL, NULL, NULL, NULL, '2026-01-09 04:13:25', '2026-01-09 04:13:25', 1),
(196, 'Ethan Martinez - Green Valley High School', 'ethan.martinez@greenvalley.edu', '2026-01-09 04:13:25', 30, '$2y$12$ghiKPdq/vR1RSmVoVhIOmugMf9r1NBr7YXPVL4Fb8IVWkgV2S7KMq', NULL, NULL, NULL, NULL, '2026-01-09 04:13:26', '2026-01-09 04:13:26', 1),
(197, 'Dr. Sarah Principal - Riverside Elementary School', 'principal@riverside.edu', '2026-01-09 04:13:26', 27, '$2y$12$B4xwF6ta3KPPrGgLJG9BwuEIly3ceEuSRqEGYKDqTPa0CYBECAkAy', NULL, NULL, NULL, NULL, '2026-01-09 04:13:26', '2026-01-09 04:13:26', 2),
(198, 'Mr. John Deputy - Riverside Elementary School', 'deputy@riverside.edu', '2026-01-09 04:13:26', 27, '$2y$12$qs3WXLyyEnun.nX72OdA0ujPg5Oo1QEzrUbZyNKbbQvail5XtB7KS', NULL, NULL, NULL, NULL, '2026-01-09 04:13:27', '2026-01-09 04:13:27', 2),
(199, 'Mrs. Mary Admin - Riverside Elementary School', 'admin@riverside.edu', '2026-01-09 04:13:27', 27, '$2y$12$l5eSdmiNPFLfGLVR1tJvoew0qlSlD79Z9A4C5i5zc5wnjyMHc2dHi', NULL, NULL, NULL, NULL, '2026-01-09 04:13:27', '2026-01-09 04:13:27', 2),
(200, 'Ms. Emily Johnson - Riverside Elementary School', 'emily.johnson@riverside.edu', '2026-01-09 04:13:27', 28, '$2y$12$lHnVJ9FYjyltEuaQHBN34O1m0Tpw4iOpPe0UGi8WpHR5QJXFr8/q6', NULL, NULL, NULL, NULL, '2026-01-09 04:13:28', '2026-01-09 04:13:28', 2),
(201, 'Mr. David Smith - Riverside Elementary School', 'david.smith@riverside.edu', '2026-01-09 04:13:28', 28, '$2y$12$advn.CIF5.KjBF36lPcXSOCyq94xzpQXYtTJQdAyM4T1oePNw.ZEi', NULL, NULL, NULL, NULL, '2026-01-09 04:13:28', '2026-01-09 04:13:28', 2),
(202, 'Mrs. Lisa Brown - Riverside Elementary School', 'lisa.brown@riverside.edu', '2026-01-09 04:13:28', 28, '$2y$12$JkC0zbqewUJOTQO7dmOpPemTArIVpIDV.3TrqpCumZl6Cj/nztL/2', NULL, NULL, NULL, NULL, '2026-01-09 04:13:28', '2026-01-09 04:13:28', 2),
(203, 'Mr. Robert Wilson - Riverside Elementary School', 'robert.wilson@riverside.edu', '2026-01-09 04:13:28', 28, '$2y$12$U/bMbm8nD5h1ac6gjg8IJepmX/tU0sco26TyWM06RT1HKJzCnYlu6', NULL, NULL, NULL, NULL, '2026-01-09 04:13:29', '2026-01-09 04:13:29', 2),
(204, 'Mrs. Jennifer Davis - Riverside Elementary School', 'jennifer.davis@riverside.com', '2026-01-09 04:13:29', 29, '$2y$12$oxc09QoQCZgOIg7XdvoANeVWaEr3ggvo/tuMc9neDH6a26lf3e63O', NULL, NULL, NULL, NULL, '2026-01-09 04:13:29', '2026-01-09 04:13:29', 2),
(205, 'Mr. Michael Garcia - Riverside Elementary School', 'michael.garcia@riverside.com', '2026-01-09 04:13:29', 29, '$2y$12$uzUg.evRJdXJuA7kTKPj0eY3pn.pyOYgIl6zDDfxYFidIrb3GScPW', NULL, NULL, NULL, NULL, '2026-01-09 04:13:29', '2026-01-09 04:13:29', 2),
(206, 'Mrs. Patricia Lee - Riverside Elementary School', 'patricia.lee@riverside.com', '2026-01-09 04:13:29', 29, '$2y$12$CJsn7DIThXM1VGdbJZ4gJuf9lxLFTVEu2lmN9NcyZafe3u8XTRWMK', NULL, NULL, NULL, NULL, '2026-01-09 04:13:30', '2026-01-09 04:13:30', 2),
(207, 'Emma Johnson - Riverside Elementary School', 'emma.johnson@riverside.edu', '2026-01-09 04:13:30', 30, '$2y$12$Vn8Gp9/MOF8Jm0dqlfJIQuR3hMJkRKzXOqKFn8X.0m.aWIQfNCpCG', NULL, NULL, NULL, NULL, '2026-01-09 04:13:30', '2026-01-09 04:13:30', 2),
(208, 'Noah Smith - Riverside Elementary School', 'noah.smith@riverside.edu', '2026-01-09 04:13:30', 30, '$2y$12$6FRe8oTHyGlkDWLFqR6a/O0IeVZGfgg5eS6wdF2KeiLU93IYxZQJK', NULL, NULL, NULL, NULL, '2026-01-09 04:13:31', '2026-01-09 04:13:31', 2),
(209, 'Olivia Brown - Riverside Elementary School', 'olivia.brown@riverside.edu', '2026-01-09 04:13:31', 30, '$2y$12$70qVIj2V2d/trv51oPnfP.8.gvv6yild.cTpgLS4xodUEKbqr3ZjG', NULL, NULL, NULL, NULL, '2026-01-09 04:13:31', '2026-01-09 04:13:31', 2),
(210, 'Liam Wilson - Riverside Elementary School', 'liam.wilson@riverside.edu', '2026-01-09 04:13:31', 30, '$2y$12$nmBqrbpjtisRmEfXRyH9Mewf3WD7shetT6hCyP1neJSjFfAm9PpzC', NULL, NULL, NULL, NULL, '2026-01-09 04:13:31', '2026-01-09 04:13:31', 2),
(211, 'Sophia Davis - Riverside Elementary School', 'sophia.davis@riverside.edu', '2026-01-09 04:13:31', 30, '$2y$12$9j.MGG/oerkKAwGjbDWNJehcRstj0NEeOjJvf/eyY69k0fbvqsgc6', NULL, NULL, NULL, NULL, '2026-01-09 04:13:32', '2026-01-09 04:13:32', 2),
(212, 'Mason Garcia - Riverside Elementary School', 'mason.garcia@riverside.edu', '2026-01-09 04:13:32', 30, '$2y$12$u7ywmJVCbLgxwaYQMPVHjuyPUE46.eF1oOLr4YcDB4hdK1bHtCmJy', NULL, NULL, NULL, NULL, '2026-01-09 04:13:32', '2026-01-09 04:13:32', 2),
(213, 'Isabella Lee - Riverside Elementary School', 'isabella.lee@riverside.edu', '2026-01-09 04:13:32', 30, '$2y$12$N.1SYjLwmeYogjRzlE8wyeiKfFISvyLgV0V/EEQtEUdkZP1i1HJ56', NULL, NULL, NULL, NULL, '2026-01-09 04:13:33', '2026-01-09 04:13:33', 2),
(214, 'Ethan Martinez - Riverside Elementary School', 'ethan.martinez@riverside.edu', '2026-01-09 04:13:33', 30, '$2y$12$X/z4cU7IidAzmaydNRD/iecff7qY/VhURw/sEjP73QW3t5GYFaQuy', NULL, NULL, NULL, NULL, '2026-01-09 04:13:33', '2026-01-09 04:13:33', 2),
(215, 'Dr. Sarah Principal - Mountain View Academy', 'principal@mountainview.edu', '2026-01-09 04:13:33', 27, '$2y$12$bJYvql43Mt0b3qOY0TO2..NLzBxweyYFMg..MRCJoh5ndhQhcjtmu', NULL, NULL, NULL, NULL, '2026-01-09 04:13:33', '2026-01-09 04:13:33', 3),
(216, 'Mr. John Deputy - Mountain View Academy', 'deputy@mountainview.edu', '2026-01-09 04:13:33', 27, '$2y$12$vB97Iptco9Z4FyN.R3mANeNrQYspXe9aGWKcHfyKLJDLnTX1ti7WG', NULL, NULL, NULL, NULL, '2026-01-09 04:13:34', '2026-01-09 04:13:34', 3),
(217, 'Mrs. Mary Admin - Mountain View Academy', 'admin@mountainview.edu', '2026-01-09 04:13:34', 27, '$2y$12$c/MG8hr.lbSaeUhlpYwoXesBlr6NgZipTA1tCvNqYpIc0WL6hwP2y', NULL, NULL, NULL, NULL, '2026-01-09 04:13:34', '2026-01-09 04:13:34', 3),
(218, 'Ms. Emily Johnson - Mountain View Academy', 'emily.johnson@mountainview.edu', '2026-01-09 04:13:34', 28, '$2y$12$xkovDoGgkprO67Qo9OsKm.83M145wAXTFbZ4zurYC3riuogA6bHDm', NULL, NULL, NULL, NULL, '2026-01-09 04:13:35', '2026-01-09 04:13:35', 3),
(219, 'Mr. David Smith - Mountain View Academy', 'david.smith@mountainview.edu', '2026-01-09 04:13:35', 28, '$2y$12$ijH5c2SYPUU1UflnB7I8ZeZB/GYBdcuNTTmCmGPFRSssdBQ.j6Lcy', NULL, NULL, NULL, NULL, '2026-01-09 04:13:35', '2026-01-09 04:13:35', 3),
(220, 'Mrs. Lisa Brown - Mountain View Academy', 'lisa.brown@mountainview.edu', '2026-01-09 04:13:35', 28, '$2y$12$Nt3waQAvYyBoHKH6AYkN7uo8gni72leiPVnwNSmHUAHXI9KJYOXdm', NULL, NULL, NULL, NULL, '2026-01-09 04:13:35', '2026-01-09 04:13:35', 3),
(221, 'Mr. Robert Wilson - Mountain View Academy', 'robert.wilson@mountainview.edu', '2026-01-09 04:13:35', 28, '$2y$12$1doGnQ/FM/tmgCEMy2sGxOfQXQDSIoUFCIdTTrJ0mY4qXMPoxpBLC', NULL, NULL, NULL, NULL, '2026-01-09 04:13:36', '2026-01-09 04:13:36', 3),
(222, 'Mrs. Jennifer Davis - Mountain View Academy', 'jennifer.davis@mountainview.com', '2026-01-09 04:13:36', 29, '$2y$12$lIOG7xGkMoVl6a5/I/E5X.uwr5jXHrANqSr.VkVFdjLOtfyerH/La', NULL, NULL, NULL, NULL, '2026-01-09 04:13:36', '2026-01-09 04:13:36', 3),
(223, 'Mr. Michael Garcia - Mountain View Academy', 'michael.garcia@mountainview.com', '2026-01-09 04:13:36', 29, '$2y$12$ERloz34DbIS9xnc/iyBma.BhpTPszeB2G6PissVOFZXlA40.0svnq', NULL, NULL, NULL, NULL, '2026-01-09 04:13:37', '2026-01-09 04:13:37', 3),
(224, 'Mrs. Patricia Lee - Mountain View Academy', 'patricia.lee@mountainview.com', '2026-01-09 04:13:37', 29, '$2y$12$PZUUTK9nD.bD.ExUSCddmel2KBsW8DNZQlLDVrTckgAN.Am3Z47be', NULL, NULL, NULL, NULL, '2026-01-09 04:13:37', '2026-01-09 04:13:37', 3),
(225, 'Emma Johnson - Mountain View Academy', 'emma.johnson@mountainview.edu', '2026-01-09 04:13:37', 30, '$2y$12$/Y6I9CgogZNsHbcT9hZEBOCNRzRCM6k8Etppja31d6w7RSFpcLBVy', NULL, NULL, NULL, NULL, '2026-01-09 04:13:37', '2026-01-09 04:13:37', 3),
(226, 'Noah Smith - Mountain View Academy', 'noah.smith@mountainview.edu', '2026-01-09 04:13:37', 30, '$2y$12$gdsDimIXLMbqh6BZRtf7OOMjD4W.ftsR8NKiFTgqVUbQEKtiJEfBW', NULL, NULL, NULL, NULL, '2026-01-09 04:13:38', '2026-01-09 04:13:38', 3),
(227, 'Olivia Brown - Mountain View Academy', 'olivia.brown@mountainview.edu', '2026-01-09 04:13:38', 30, '$2y$12$YKMQ.9ssitI1YRVuEjuLxO5mVjVfJMy9.COMBfwn5xCc2gyvb2t0S', NULL, NULL, NULL, NULL, '2026-01-09 04:13:38', '2026-01-09 04:13:38', 3),
(228, 'Liam Wilson - Mountain View Academy', 'liam.wilson@mountainview.edu', '2026-01-09 04:13:38', 30, '$2y$12$B7YhH.3i.VspecQqgoOkP.MThqyyXALO8SnDYRJrH3dmXPf8h3DYG', NULL, NULL, NULL, NULL, '2026-01-09 04:13:39', '2026-01-09 04:13:39', 3),
(229, 'Sophia Davis - Mountain View Academy', 'sophia.davis@mountainview.edu', '2026-01-09 04:13:39', 30, '$2y$12$jYS/jTwK7TUcyYROYYXBeubdnxwGeIzEfwIN6It7OIJLNIxIHx3yK', NULL, NULL, NULL, NULL, '2026-01-09 04:13:39', '2026-01-09 04:13:39', 3),
(230, 'Mason Garcia - Mountain View Academy', 'mason.garcia@mountainview.edu', '2026-01-09 04:13:39', 30, '$2y$12$wEW2RYIa92B0fgAU1GfVxOCReDcqF0Qu0ZfQRuGPmgTS6f7g5K2Pu', NULL, NULL, NULL, NULL, '2026-01-09 04:13:39', '2026-01-09 04:13:39', 3),
(231, 'Isabella Lee - Mountain View Academy', 'isabella.lee@mountainview.edu', '2026-01-09 04:13:39', 30, '$2y$12$Lky/nin13Q7FwRKONtTo9.eKJKWszaegGkFUr6RxUc/CWEXi/JwOm', NULL, NULL, NULL, NULL, '2026-01-09 04:13:40', '2026-01-09 04:13:40', 3),
(232, 'Ethan Martinez - Mountain View Academy', 'ethan.martinez@mountainview.edu', '2026-01-09 04:13:40', 30, '$2y$12$ca6bW1VtbW1fKW22v0OuWOaZLM8w6KPphZY4mtuAmy7xKOgetXLYC', NULL, NULL, NULL, NULL, '2026-01-09 04:13:40', '2026-01-09 04:13:40', 3);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `plan_module`
--
ALTER TABLE `plan_module`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
