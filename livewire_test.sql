-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 10, 2026 at 07:16 AM
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

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-04220c94a698d9f1cbc63fd2722ae3aa', 'i:1;', 1768022189),
('laravel-cache-04220c94a698d9f1cbc63fd2722ae3aa:timer', 'i:1768022189;', 1768022189),
('laravel-cache-3016d9409a6f0d97870820c7888516e1', 'i:1;', 1768026796),
('laravel-cache-3016d9409a6f0d97870820c7888516e1:timer', 'i:1768026796;', 1768026796),
('laravel-cache-auth_token_5e9eRYMmKgvjt9uGPM1bBRbMc0JFW79vXQrU8px104cQmZiFGUF0eoKRA9iLBOLZ', 'i:182;', 1768022431),
('laravel-cache-auth_token_Wr9gTNVqehznoHB6fGRH6yhKdJ6IB4f2Y0NsiucYpUoUPzSqazxOlqy6XxfBmqCu', 'i:179;', 1768022203),
('laravel-cache-e8b9563b2caebf5e73ef9b771002cb33', 'i:1;', 1768021961),
('laravel-cache-e8b9563b2caebf5e73ef9b771002cb33:timer', 'i:1768021961;', 1768021961);

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
(13, '2026_01_08_140403_add_school_id_to_users_table', 3),
(14, '2026_01_09_150108_add_sort_order_to_subscriptions_table', 4),
(15, '2026_01_10_063710_remove_plan_modules_permissions', 4);

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
(1, 'dashboard', 'dashboard', 'Dashboard', 'Main dashboard and overview', 'home', 'dashboard', 1, 0, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(2, 'users', 'users', 'User Management', 'Manage system users and accounts', 'users', 'users', 1, 1, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(3, 'roles', 'roles', 'Role Management', 'Manage roles and permissions', 'shield-check', 'roles', 1, 2, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(4, 'schools', 'schools', 'School Management', 'Manage schools and institutions', 'building-office', 'schools', 1, 3, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(5, 'subscriptions', 'subscriptions', 'Subscription Management', 'Manage school subscriptions', 'credit-card', 'subscriptions', 1, 4, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(6, 'subscription_plans', 'subscription-plans', 'Subscription Plan Management', 'Manage subscription plans and pricing', 'document-duplicate', 'subscription_plans', 1, 5, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(7, 'settings', 'settings', 'Settings', 'System and user settings', 'cog-6-tooth', 'settings', 1, 6, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(8, 'students', 'students', 'Student Management', 'Manage student enrollment, profiles, and academic records', 'user', 'students', 1, 10, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(9, 'teachers', 'teachers', 'Teacher Management', 'Manage teacher profiles, assignments, and performance', 'academic-cap', 'teachers', 1, 11, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(10, 'classes', 'classes', 'Class Management', 'Manage class schedules, assignments, and student groupings', 'building-storefront', 'classes', 1, 12, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(11, 'subjects', 'subjects', 'Subject Management', 'Manage curriculum subjects and course offerings', 'book-open', 'subjects', 1, 13, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(12, 'exams', 'exams', 'Examination Management', 'Manage exams, grades, and academic assessments', 'clipboard-document-list', 'exams', 1, 14, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(13, 'attendance', 'attendance', 'Attendance Tracking', 'Track student and teacher attendance records', 'calendar', 'attendance', 1, 15, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(14, 'finance', 'finance', 'Financial Management', 'Manage fees, payments, and financial records', 'banknotes', 'finance', 1, 16, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(15, 'library', 'library', 'Library Management', 'Manage library resources and book circulation', 'book-open', 'library', 1, 17, '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(16, 'transport', 'transport', 'Transport Management', 'Manage school transportation and routes', 'truck', 'transport', 1, 18, '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(17, 'hostel', 'hostel', 'Hostel Management', 'Manage dormitory accommodations and residents', 'home-modern', 'hostel', 1, 19, '2026-01-10 01:44:50', '2026-01-10 01:44:50');

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
(1, 'view_dashboard', 'View Dashboard', 'dashboard', 'Can view Dashboard list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(5, 'view_users', 'View User Management', 'users', 'Can view User Management list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(6, 'create_users', 'Create User Management', 'users', 'Can create new User Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(7, 'edit_users', 'Edit User Management', 'users', 'Can edit existing User Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(8, 'delete_users', 'Delete User Management', 'users', 'Can delete User Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(9, 'view_roles', 'View Role Management', 'roles', 'Can view Role Management list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(10, 'create_roles', 'Create Role Management', 'roles', 'Can create new Role Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(11, 'edit_roles', 'Edit Role Management', 'roles', 'Can edit existing Role Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(12, 'delete_roles', 'Delete Role Management', 'roles', 'Can delete Role Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(13, 'view_schools', 'View School Management', 'schools', 'Can view School Management list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(14, 'create_schools', 'Create School Management', 'schools', 'Can create new School Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(15, 'edit_schools', 'Edit School Management', 'schools', 'Can edit existing School Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(16, 'delete_schools', 'Delete School Management', 'schools', 'Can delete School Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(17, 'view_subscriptions', 'View Subscription Management', 'subscriptions', 'Can view Subscription Management list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(18, 'create_subscriptions', 'Create Subscription Management', 'subscriptions', 'Can create new Subscription Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(19, 'edit_subscriptions', 'Edit Subscription Management', 'subscriptions', 'Can edit existing Subscription Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(20, 'delete_subscriptions', 'Delete Subscription Management', 'subscriptions', 'Can delete Subscription Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(21, 'view_subscription_plans', 'View Subscription Plan Management', 'subscription_plans', 'Can view Subscription Plan Management list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(22, 'create_subscription_plans', 'Create Subscription Plan Management', 'subscription_plans', 'Can create new Subscription Plan Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(23, 'edit_subscription_plans', 'Edit Subscription Plan Management', 'subscription_plans', 'Can edit existing Subscription Plan Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(24, 'delete_subscription_plans', 'Delete Subscription Plan Management', 'subscription_plans', 'Can delete Subscription Plan Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(25, 'view_settings', 'View Settings', 'settings', 'Can view Settings list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(29, 'view_students', 'View Student Management', 'students', 'Can view Student Management list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(30, 'create_students', 'Create Student Management', 'students', 'Can create new Student Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(31, 'edit_students', 'Edit Student Management', 'students', 'Can edit existing Student Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(32, 'delete_students', 'Delete Student Management', 'students', 'Can delete Student Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(33, 'view_teachers', 'View Teacher Management', 'teachers', 'Can view Teacher Management list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(34, 'create_teachers', 'Create Teacher Management', 'teachers', 'Can create new Teacher Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(35, 'edit_teachers', 'Edit Teacher Management', 'teachers', 'Can edit existing Teacher Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(36, 'delete_teachers', 'Delete Teacher Management', 'teachers', 'Can delete Teacher Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(37, 'view_classes', 'View Class Management', 'classes', 'Can view Class Management list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(38, 'create_classes', 'Create Class Management', 'classes', 'Can create new Class Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(39, 'edit_classes', 'Edit Class Management', 'classes', 'Can edit existing Class Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(40, 'delete_classes', 'Delete Class Management', 'classes', 'Can delete Class Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(41, 'view_subjects', 'View Subject Management', 'subjects', 'Can view Subject Management list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(42, 'create_subjects', 'Create Subject Management', 'subjects', 'Can create new Subject Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(43, 'edit_subjects', 'Edit Subject Management', 'subjects', 'Can edit existing Subject Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(44, 'delete_subjects', 'Delete Subject Management', 'subjects', 'Can delete Subject Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(45, 'view_exams', 'View Examination Management', 'exams', 'Can view Examination Management list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(46, 'create_exams', 'Create Examination Management', 'exams', 'Can create new Examination Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(47, 'edit_exams', 'Edit Examination Management', 'exams', 'Can edit existing Examination Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(48, 'delete_exams', 'Delete Examination Management', 'exams', 'Can delete Examination Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(49, 'view_attendance', 'View Attendance Tracking', 'attendance', 'Can view Attendance Tracking list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(50, 'create_attendance', 'Create Attendance Tracking', 'attendance', 'Can create new Attendance Tracking', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(51, 'edit_attendance', 'Edit Attendance Tracking', 'attendance', 'Can edit existing Attendance Tracking', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(52, 'delete_attendance', 'Delete Attendance Tracking', 'attendance', 'Can delete Attendance Tracking', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(53, 'view_finance', 'View Financial Management', 'finance', 'Can view Financial Management list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(54, 'create_finance', 'Create Financial Management', 'finance', 'Can create new Financial Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(55, 'edit_finance', 'Edit Financial Management', 'finance', 'Can edit existing Financial Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(56, 'delete_finance', 'Delete Financial Management', 'finance', 'Can delete Financial Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(57, 'view_library', 'View Library Management', 'library', 'Can view Library Management list and details', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(58, 'create_library', 'Create Library Management', 'library', 'Can create new Library Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(59, 'edit_library', 'Edit Library Management', 'library', 'Can edit existing Library Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(60, 'delete_library', 'Delete Library Management', 'library', 'Can delete Library Management', '2026-01-10 01:44:49', '2026-01-10 01:44:49'),
(61, 'view_transport', 'View Transport Management', 'transport', 'Can view Transport Management list and details', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(62, 'create_transport', 'Create Transport Management', 'transport', 'Can create new Transport Management', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(63, 'edit_transport', 'Edit Transport Management', 'transport', 'Can edit existing Transport Management', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(64, 'delete_transport', 'Delete Transport Management', 'transport', 'Can delete Transport Management', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(65, 'view_hostel', 'View Hostel Management', 'hostel', 'Can view Hostel Management list and details', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(66, 'create_hostel', 'Create Hostel Management', 'hostel', 'Can create new Hostel Management', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(67, 'edit_hostel', 'Edit Hostel Management', 'hostel', 'Can edit existing Hostel Management', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(68, 'delete_hostel', 'Delete Hostel Management', 'hostel', 'Can delete Hostel Management', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(69, 'edit_profile', 'Edit Profile', 'settings', 'Can edit their profile', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(70, 'change_password', 'Change Password', 'settings', 'Can change password', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(71, 'manage_appearance', 'Manage Appearance', 'settings', 'Can change appearance settings', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(72, 'manage_two_factor', 'Manage Two-Factor Auth', 'settings', 'Can manage two-factor authentication', '2026-01-10 01:44:50', '2026-01-10 01:44:50');

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
(1, 1, 70, NULL, NULL),
(2, 1, 50, NULL, NULL),
(3, 1, 38, NULL, NULL),
(4, 1, 46, NULL, NULL),
(5, 1, 54, NULL, NULL),
(6, 1, 66, NULL, NULL),
(7, 1, 58, NULL, NULL),
(8, 1, 10, NULL, NULL),
(9, 1, 14, NULL, NULL),
(10, 1, 30, NULL, NULL),
(11, 1, 42, NULL, NULL),
(12, 1, 22, NULL, NULL),
(13, 1, 18, NULL, NULL),
(14, 1, 34, NULL, NULL),
(15, 1, 62, NULL, NULL),
(16, 1, 6, NULL, NULL),
(17, 1, 52, NULL, NULL),
(18, 1, 40, NULL, NULL),
(19, 1, 48, NULL, NULL),
(20, 1, 56, NULL, NULL),
(21, 1, 68, NULL, NULL),
(22, 1, 60, NULL, NULL),
(23, 1, 12, NULL, NULL),
(24, 1, 16, NULL, NULL),
(25, 1, 32, NULL, NULL),
(26, 1, 44, NULL, NULL),
(27, 1, 24, NULL, NULL),
(28, 1, 20, NULL, NULL),
(29, 1, 36, NULL, NULL),
(30, 1, 64, NULL, NULL),
(31, 1, 8, NULL, NULL),
(32, 1, 51, NULL, NULL),
(33, 1, 39, NULL, NULL),
(34, 1, 47, NULL, NULL),
(35, 1, 55, NULL, NULL),
(36, 1, 67, NULL, NULL),
(37, 1, 59, NULL, NULL),
(38, 1, 69, NULL, NULL),
(39, 1, 11, NULL, NULL),
(40, 1, 15, NULL, NULL),
(41, 1, 31, NULL, NULL),
(42, 1, 43, NULL, NULL),
(43, 1, 23, NULL, NULL),
(44, 1, 19, NULL, NULL),
(45, 1, 35, NULL, NULL),
(46, 1, 63, NULL, NULL),
(47, 1, 7, NULL, NULL),
(48, 1, 71, NULL, NULL),
(49, 1, 72, NULL, NULL),
(50, 1, 49, NULL, NULL),
(51, 1, 37, NULL, NULL),
(52, 1, 1, NULL, NULL),
(53, 1, 45, NULL, NULL),
(54, 1, 53, NULL, NULL),
(55, 1, 65, NULL, NULL),
(56, 1, 57, NULL, NULL),
(57, 1, 9, NULL, NULL),
(58, 1, 13, NULL, NULL),
(59, 1, 25, NULL, NULL),
(60, 1, 29, NULL, NULL),
(61, 1, 41, NULL, NULL),
(62, 1, 21, NULL, NULL),
(63, 1, 17, NULL, NULL),
(64, 1, 33, NULL, NULL),
(65, 1, 61, NULL, NULL),
(66, 1, 5, NULL, NULL),
(67, 2, 70, NULL, NULL),
(68, 2, 50, NULL, NULL),
(69, 2, 38, NULL, NULL),
(70, 2, 46, NULL, NULL),
(71, 2, 54, NULL, NULL),
(72, 2, 66, NULL, NULL),
(73, 2, 58, NULL, NULL),
(74, 2, 30, NULL, NULL),
(75, 2, 42, NULL, NULL),
(76, 2, 34, NULL, NULL),
(77, 2, 62, NULL, NULL),
(78, 2, 6, NULL, NULL),
(79, 2, 52, NULL, NULL),
(80, 2, 40, NULL, NULL),
(81, 2, 48, NULL, NULL),
(82, 2, 56, NULL, NULL),
(83, 2, 68, NULL, NULL),
(84, 2, 60, NULL, NULL),
(85, 2, 32, NULL, NULL),
(86, 2, 44, NULL, NULL),
(87, 2, 36, NULL, NULL),
(88, 2, 64, NULL, NULL),
(89, 2, 51, NULL, NULL),
(90, 2, 39, NULL, NULL),
(91, 2, 47, NULL, NULL),
(92, 2, 55, NULL, NULL),
(93, 2, 67, NULL, NULL),
(94, 2, 59, NULL, NULL),
(95, 2, 69, NULL, NULL),
(96, 2, 11, NULL, NULL),
(97, 2, 31, NULL, NULL),
(98, 2, 43, NULL, NULL),
(99, 2, 35, NULL, NULL),
(100, 2, 63, NULL, NULL),
(101, 2, 7, NULL, NULL),
(102, 2, 71, NULL, NULL),
(103, 2, 49, NULL, NULL),
(104, 2, 37, NULL, NULL),
(105, 2, 1, NULL, NULL),
(106, 2, 45, NULL, NULL),
(107, 2, 53, NULL, NULL),
(108, 2, 65, NULL, NULL),
(109, 2, 57, NULL, NULL),
(110, 2, 9, NULL, NULL),
(111, 2, 25, NULL, NULL),
(112, 2, 29, NULL, NULL),
(113, 2, 41, NULL, NULL),
(114, 2, 33, NULL, NULL),
(115, 2, 61, NULL, NULL),
(116, 2, 5, NULL, NULL),
(117, 3, 70, NULL, NULL),
(118, 3, 69, NULL, NULL),
(119, 3, 49, NULL, NULL),
(120, 3, 37, NULL, NULL),
(121, 3, 1, NULL, NULL),
(122, 3, 45, NULL, NULL),
(123, 3, 25, NULL, NULL),
(124, 3, 29, NULL, NULL),
(125, 3, 41, NULL, NULL),
(126, 4, 70, NULL, NULL),
(127, 4, 69, NULL, NULL),
(128, 4, 1, NULL, NULL),
(129, 4, 25, NULL, NULL),
(130, 4, 29, NULL, NULL),
(131, 5, 70, NULL, NULL),
(132, 5, 69, NULL, NULL),
(133, 5, 1, NULL, NULL),
(134, 5, 25, NULL, NULL),
(135, 5, 29, NULL, NULL);

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
(1, 1, 8, NULL, NULL),
(2, 1, 9, NULL, NULL),
(3, 2, 13, NULL, NULL),
(4, 2, 10, NULL, NULL),
(5, 2, 12, NULL, NULL),
(6, 2, 14, NULL, NULL),
(7, 2, 8, NULL, NULL),
(8, 2, 11, NULL, NULL),
(9, 2, 9, NULL, NULL),
(10, 3, 13, NULL, NULL),
(11, 3, 10, NULL, NULL),
(12, 3, 12, NULL, NULL),
(13, 3, 14, NULL, NULL),
(14, 3, 17, NULL, NULL),
(15, 3, 15, NULL, NULL),
(16, 3, 8, NULL, NULL),
(17, 3, 11, NULL, NULL),
(18, 3, 9, NULL, NULL),
(19, 3, 16, NULL, NULL);

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
(1, 'super_admin', 'Super Administrator', 'red', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(2, 'admin', 'School Administrator', 'purple', '2026-01-10 01:44:51', '2026-01-10 01:44:51'),
(3, 'teacher', 'Teacher', 'blue', '2026-01-10 01:44:51', '2026-01-10 01:44:51'),
(4, 'parent', 'Parent', 'green', '2026-01-10 01:44:51', '2026-01-10 01:44:51'),
(5, 'student', 'Student', 'orange', '2026-01-10 01:44:51', '2026-01-10 01:44:51');

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
(1, 'Green Valley High School', 'greenvalley', '123 Education Street, Springfield, IL 62701', '+1-555-0123', 'admin@greenvalley.edu', 'A premier high school focused on academic excellence and student development.', NULL, 1, '{\"currency\": \"USD\", \"timezone\": \"America/Chicago\", \"academic_year_end\": \"05-30\", \"academic_year_start\": \"08-15\"}', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(2, 'Riverside Elementary School', 'riverside', '456 Learning Avenue, Riverside, CA 92501', '+1-555-0456', 'contact@riverside.edu', 'Nurturing young minds through innovative teaching methods.', NULL, 1, '{\"currency\": \"USD\", \"timezone\": \"America/Los_Angeles\", \"academic_year_end\": \"06-15\", \"academic_year_start\": \"09-01\"}', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(3, 'Mountain View Academy', 'mountainview', '789 Knowledge Boulevard, Denver, CO 80201', '+1-555-0789', 'info@mountainview.edu', 'Specialized education for gifted students with advanced curriculum.', NULL, 1, '{\"currency\": \"USD\", \"timezone\": \"America/Denver\", \"academic_year_end\": \"05-25\", \"academic_year_start\": \"08-20\"}', '2026-01-10 01:44:50', '2026-01-10 01:44:50');

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
('uuKHsJqHlwH2itJQs47RfAw5zj2MxPUFNXUyETng', 178, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoid3JzOHgyaWlBVVluSkFIcUZNWnE4SzZkcGVwdk5NcnhuR2ppVkJnOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cHM6Ly9saXZld2lyZS50ZXN0L3JvbGVzIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vbGl2ZXdpcmUudGVzdC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE3ODt9', 1768029344);

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
  `sort_order` int NOT NULL DEFAULT '0',
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `school_id`, `subscription_plan_id`, `starts_at`, `ends_at`, `status`, `price`, `billing_period`, `sort_order`, `metadata`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2026-01-10 07:14:50', '2027-01-10 07:14:50', 'active', 79.99, 'monthly', 0, '[]', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(2, 2, 1, '2026-01-10 07:14:50', '2027-01-10 07:14:50', 'active', 29.99, 'monthly', 0, '[]', '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(3, 3, 3, '2026-01-10 07:14:50', '2027-01-10 07:14:50', 'active', 199.99, 'monthly', 0, '[]', '2026-01-10 01:44:50', '2026-01-10 01:44:50');

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
(1, 'Basic', 'basic', 'Essential school management features for small schools', 29.99, 'monthly', 50, 10, '[\"Student Management\", \"Teacher Management\", \"Basic Reporting\", \"Email Support\"]', 1, 1, '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(2, 'Professional', 'professional', 'Advanced features for growing educational institutions', 79.99, 'monthly', 200, 50, '[\"All Basic features\", \"Class Management\", \"Subject Management\", \"Examination Management\", \"Attendance Tracking\", \"Financial Management\", \"Priority Support\"]', 1, 2, '2026-01-10 01:44:50', '2026-01-10 01:44:50'),
(3, 'Enterprise', 'enterprise', 'Complete solution for large educational organizations', 199.99, 'monthly', 1000, 500, '[\"All Professional features\", \"Library Management\", \"Transport Management\", \"Hostel Management\", \"Advanced Analytics\", \"API Access\", \"24/7 Phone Support\", \"Custom Integrations\"]', 1, 3, '2026-01-10 01:44:50', '2026-01-10 01:44:50');

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
(1, 'Super Admin', 'superadmin@example.com', '2026-01-10 01:44:51', 1, '$2y$12$3tI0tsp6LBmEpp7zGWE8GOSDFqjls2ZTd6gZpd/CeZ3WEHciUhTo.', NULL, NULL, NULL, NULL, '2026-01-10 01:44:51', '2026-01-10 01:44:51', NULL),
(2, 'Dr. Sarah Principal - Green Valley High School', 'principal@greenvalley.edu', '2026-01-10 01:44:51', 2, '$2y$12$cDAMz8YqWq0t/Bvm3BcSvuzHNV6ZRNvfsrxuKcrUYAWSgjKi6GsoO', NULL, NULL, NULL, NULL, '2026-01-10 01:44:52', '2026-01-10 01:44:52', 1),
(3, 'Mr. John Deputy - Green Valley High School', 'deputy@greenvalley.edu', '2026-01-10 01:44:52', 2, '$2y$12$M3T6ctOKptUYeshXB5Y7GepgyKm3fLmJTdkjsJNHf6uYUO0/0CEIO', NULL, NULL, NULL, NULL, '2026-01-10 01:44:52', '2026-01-10 01:44:52', 1),
(4, 'Mrs. Mary Admin - Green Valley High School', 'admin@greenvalley.edu', '2026-01-10 01:44:52', 2, '$2y$12$Yrd3jEBg50Gk0sITapdBaeioVW82fd63aOXTYvnLsEXv0VNuC7ASe', NULL, NULL, NULL, NULL, '2026-01-10 01:44:52', '2026-01-10 01:44:52', 1),
(5, 'Ms. Emily Johnson - Green Valley High School', 'emily.johnson@greenvalley.edu', '2026-01-10 01:44:52', 3, '$2y$12$OFJNT0pVbJRfROANSD5JtuXrIPTq4TGE2u7jOz7SzqW8s1//Yuu3O', NULL, NULL, NULL, NULL, '2026-01-10 01:44:52', '2026-01-10 01:44:52', 1),
(6, 'Mr. David Smith - Green Valley High School', 'david.smith@greenvalley.edu', '2026-01-10 01:44:52', 3, '$2y$12$3kDqCytCuFlzZG5geAk21.CR5BrcckTXamqKLLEK8YpIJM5mVy1km', NULL, NULL, NULL, NULL, '2026-01-10 01:44:53', '2026-01-10 01:44:53', 1),
(7, 'Mrs. Lisa Brown - Green Valley High School', 'lisa.brown@greenvalley.edu', '2026-01-10 01:44:53', 3, '$2y$12$Lzj8nTbQtz91rp1rcJdyE.FZSBjzWIhZ6SQZ0ZnQslRC7ylF4GbwO', NULL, NULL, NULL, NULL, '2026-01-10 01:44:53', '2026-01-10 01:44:53', 1),
(8, 'Mr. Robert Wilson - Green Valley High School', 'robert.wilson@greenvalley.edu', '2026-01-10 01:44:53', 3, '$2y$12$5H3z0ezCs6dI3wZIxBDmkebYJ2pZChaDPQtLWFe4/mUDOxzJ1DGgO', NULL, NULL, NULL, NULL, '2026-01-10 01:44:53', '2026-01-10 01:44:53', 1),
(9, 'Mrs. Jennifer Davis - Green Valley High School', 'jennifer.davis@greenvalley.com', '2026-01-10 01:44:53', 4, '$2y$12$xTE6iCDWhrX5KVGvsG8by.duNTDGDPv1n8./KnZX4qkjDcrpDJ7gu', NULL, NULL, NULL, NULL, '2026-01-10 01:44:53', '2026-01-10 01:44:53', 1),
(10, 'Mr. Michael Garcia - Green Valley High School', 'michael.garcia@greenvalley.com', '2026-01-10 01:44:53', 4, '$2y$12$7iZ2rcHiX.7a0zskDzegrun2Fp75h5Y5zzPWUsvmi7tXE1RHrTtqu', NULL, NULL, NULL, NULL, '2026-01-10 01:44:54', '2026-01-10 01:44:54', 1),
(11, 'Mrs. Patricia Lee - Green Valley High School', 'patricia.lee@greenvalley.com', '2026-01-10 01:44:54', 4, '$2y$12$TZR3zl/Hvf.Cbj/lprU40eJWM5yjnZjJq07q5QoWwud.gGN8rHUY6', NULL, NULL, NULL, NULL, '2026-01-10 01:44:54', '2026-01-10 01:44:54', 1),
(12, 'Emma Johnson - Green Valley High School', 'emma.johnson@greenvalley.edu', '2026-01-10 01:44:54', 5, '$2y$12$ear/amboVgyJZCCCe9nKXOe4xYgXga891DdzpcKYZ6wN86MFPp8TK', NULL, NULL, NULL, NULL, '2026-01-10 01:44:54', '2026-01-10 01:44:54', 1),
(13, 'Noah Smith - Green Valley High School', 'noah.smith@greenvalley.edu', '2026-01-10 01:44:54', 5, '$2y$12$PMEIX42apMOeBtvGNdK4feKg2VdkXs8yNSmil3Yvs7.WBPn3/aClu', NULL, NULL, NULL, NULL, '2026-01-10 01:44:54', '2026-01-10 01:44:54', 1),
(14, 'Olivia Brown - Green Valley High School', 'olivia.brown@greenvalley.edu', '2026-01-10 01:44:54', 5, '$2y$12$leoDUxUO5jkIcvib9MSRq.YrBn03gz28sMZLU.82Jhvs12RSONodm', NULL, NULL, NULL, NULL, '2026-01-10 01:44:55', '2026-01-10 01:44:55', 1),
(15, 'Liam Wilson - Green Valley High School', 'liam.wilson@greenvalley.edu', '2026-01-10 01:44:55', 5, '$2y$12$34dyGoH0lwvrMnF77U/NvO151GcyvFgNX8WappPh3ZV8gBxkbBn4a', NULL, NULL, NULL, NULL, '2026-01-10 01:44:55', '2026-01-10 01:44:55', 1),
(16, 'Sophia Davis - Green Valley High School', 'sophia.davis@greenvalley.edu', '2026-01-10 01:44:55', 5, '$2y$12$Vimttt4nAWt2Ii3ALmdVJO3e.wUjfUYTVepQyeJqLXOZO/uHfWEt6', NULL, NULL, NULL, NULL, '2026-01-10 01:44:55', '2026-01-10 01:44:55', 1),
(17, 'Mason Garcia - Green Valley High School', 'mason.garcia@greenvalley.edu', '2026-01-10 01:44:55', 5, '$2y$12$ce1URjY6BSaKR/CRaQUP/uHkehrBNNqEQHLJweIT24mlfhLJsddeG', NULL, NULL, NULL, NULL, '2026-01-10 01:44:55', '2026-01-10 01:44:55', 1),
(18, 'Isabella Lee - Green Valley High School', 'isabella.lee@greenvalley.edu', '2026-01-10 01:44:55', 5, '$2y$12$cVK9uK6zet4KAT2auuUhbOWnqv2dPhumXLDv729NJxwr312pEL9ZS', NULL, NULL, NULL, NULL, '2026-01-10 01:44:56', '2026-01-10 01:44:56', 1),
(19, 'Ethan Martinez - Green Valley High School', 'ethan.martinez@greenvalley.edu', '2026-01-10 01:44:56', 5, '$2y$12$TqVCEaN32SO6VbuFucD.9e5UKqgt9s/6qJmSqjGFU/8LUsEskYvMG', NULL, NULL, NULL, NULL, '2026-01-10 01:44:56', '2026-01-10 01:44:56', 1),
(20, 'Dr. Sarah Principal - Riverside Elementary School', 'principal@riverside.edu', '2026-01-10 01:44:56', 2, '$2y$12$ID5WceZn7xr2wDOHbCusPOpse9powZd0LglOYgMsYbbWfzmGWa3G.', NULL, NULL, NULL, NULL, '2026-01-10 01:44:56', '2026-01-10 01:44:56', 2),
(21, 'Mr. John Deputy - Riverside Elementary School', 'deputy@riverside.edu', '2026-01-10 01:44:56', 2, '$2y$12$2I1JChZJSTJpfAO6G60uJOlvwy7Xj8.wD8x9WtnCO27f/9tJJutyK', NULL, NULL, NULL, NULL, '2026-01-10 01:44:56', '2026-01-10 01:44:56', 2),
(22, 'Mrs. Mary Admin - Riverside Elementary School', 'admin@riverside.edu', '2026-01-10 01:44:56', 2, '$2y$12$3/wthQOvKq6tq5A9gJZpmu7FC4UoaDAqFOIBfx1xtBS7i7Z.ZYEc.', NULL, NULL, NULL, NULL, '2026-01-10 01:44:57', '2026-01-10 01:44:57', 2),
(23, 'Ms. Emily Johnson - Riverside Elementary School', 'emily.johnson@riverside.edu', '2026-01-10 01:44:57', 3, '$2y$12$HljOE.Qxk692h6gWaWOdEu9MvaawooXeP78omOGGBDz3lGC/ytmoW', NULL, NULL, NULL, NULL, '2026-01-10 01:44:57', '2026-01-10 01:44:57', 2),
(24, 'Mr. David Smith - Riverside Elementary School', 'david.smith@riverside.edu', '2026-01-10 01:44:57', 3, '$2y$12$BQ4HJ5/UCvdcW6OvM.RBYeEQHYfCpJhfkkPgmCFTPXAuXR3DW2F6a', NULL, NULL, NULL, NULL, '2026-01-10 01:44:57', '2026-01-10 01:44:57', 2),
(25, 'Mrs. Lisa Brown - Riverside Elementary School', 'lisa.brown@riverside.edu', '2026-01-10 01:44:57', 3, '$2y$12$Ztmm1Q7dq5xGp0WZVZyNG.24EkOb12JX18HWKPgbES5oJ2ceBAc8i', NULL, NULL, NULL, NULL, '2026-01-10 01:44:57', '2026-01-10 01:44:57', 2),
(26, 'Mr. Robert Wilson - Riverside Elementary School', 'robert.wilson@riverside.edu', '2026-01-10 01:44:57', 3, '$2y$12$XX4XLfndf4lGBzb7mSvWpe3pFBz8id.RaeX67iweDID.9/y6vwlFe', NULL, NULL, NULL, NULL, '2026-01-10 01:44:58', '2026-01-10 01:44:58', 2),
(27, 'Mrs. Jennifer Davis - Riverside Elementary School', 'jennifer.davis@riverside.com', '2026-01-10 01:44:58', 4, '$2y$12$twNZKqqIGeRaf3.F7A178.V/gLN.mvmKkZqWgz8fmJtuZl88KRqF6', NULL, NULL, NULL, NULL, '2026-01-10 01:44:58', '2026-01-10 01:44:58', 2),
(28, 'Mr. Michael Garcia - Riverside Elementary School', 'michael.garcia@riverside.com', '2026-01-10 01:44:58', 4, '$2y$12$hdxrlXUozjnxL1XYP4ocIO8t.MxIPbWLmuzsfOYWktMYtzH0mVkFK', NULL, NULL, NULL, NULL, '2026-01-10 01:44:58', '2026-01-10 01:44:58', 2),
(29, 'Mrs. Patricia Lee - Riverside Elementary School', 'patricia.lee@riverside.com', '2026-01-10 01:44:58', 4, '$2y$12$9Sf8dOdOdpPR3QueisXOJOEnx5l/K6OkO7xF7QGmSJzd0XUQOTWCe', NULL, NULL, NULL, NULL, '2026-01-10 01:44:58', '2026-01-10 01:44:58', 2),
(30, 'Emma Johnson - Riverside Elementary School', 'emma.johnson@riverside.edu', '2026-01-10 01:44:58', 5, '$2y$12$d31K9D/Fla01xlOi6cTTyuRUjRb4ElRy.65J5OrnwLGs.Y1nLxrK2', NULL, NULL, NULL, NULL, '2026-01-10 01:44:59', '2026-01-10 01:44:59', 2),
(31, 'Noah Smith - Riverside Elementary School', 'noah.smith@riverside.edu', '2026-01-10 01:44:59', 5, '$2y$12$AlWjH6MOZxPYHWAExn5lmuN573Y9LiAH.dBEOmLTBvKDLuXSeRRFy', NULL, NULL, NULL, NULL, '2026-01-10 01:44:59', '2026-01-10 01:44:59', 2),
(32, 'Olivia Brown - Riverside Elementary School', 'olivia.brown@riverside.edu', '2026-01-10 01:44:59', 5, '$2y$12$ip2U8sS94IUjxCBsCfmKd.1/tKox6FvdpY4TwN2EfDVcNxv.f31le', NULL, NULL, NULL, NULL, '2026-01-10 01:44:59', '2026-01-10 01:44:59', 2),
(33, 'Liam Wilson - Riverside Elementary School', 'liam.wilson@riverside.edu', '2026-01-10 01:44:59', 5, '$2y$12$oTHyLsbRMyMPNenpnb0fbePODb/5b6vMI3gkb7Qjl/x0RsWSJ/d9m', NULL, NULL, NULL, NULL, '2026-01-10 01:44:59', '2026-01-10 01:44:59', 2),
(34, 'Sophia Davis - Riverside Elementary School', 'sophia.davis@riverside.edu', '2026-01-10 01:44:59', 5, '$2y$12$nJyzLta/1jYw2Zzv94DUGOqTUzl6U6k3y4h4rkxein8PsLTGOZccC', NULL, NULL, NULL, NULL, '2026-01-10 01:44:59', '2026-01-10 01:44:59', 2),
(35, 'Mason Garcia - Riverside Elementary School', 'mason.garcia@riverside.edu', '2026-01-10 01:44:59', 5, '$2y$12$NcM/A/smyXJ2theV7hdqLuDuuK9kIg5eTssDWSb6ixesbOdhcV/v2', NULL, NULL, NULL, NULL, '2026-01-10 01:45:00', '2026-01-10 01:45:00', 2),
(36, 'Isabella Lee - Riverside Elementary School', 'isabella.lee@riverside.edu', '2026-01-10 01:45:00', 5, '$2y$12$5xEzGGJo6b5XElRLXwYioerSsn5Dur97tlW8HkkpAB1J9B9HlaAmK', NULL, NULL, NULL, NULL, '2026-01-10 01:45:00', '2026-01-10 01:45:00', 2),
(37, 'Ethan Martinez - Riverside Elementary School', 'ethan.martinez@riverside.edu', '2026-01-10 01:45:00', 5, '$2y$12$cKQCR50XHwZHnXmxGKc1xeE1Hkzy5rihGu3ywWm9nfxfDyBpZosQa', NULL, NULL, NULL, NULL, '2026-01-10 01:45:00', '2026-01-10 01:45:00', 2),
(38, 'Dr. Sarah Principal - Mountain View Academy', 'principal@mountainview.edu', '2026-01-10 01:45:00', 2, '$2y$12$gZxFkp.dEVnA4U9PPvm8YexM8fDSGIN2ypSMsJoD2arnG2JWAHwIa', NULL, NULL, NULL, NULL, '2026-01-10 01:45:00', '2026-01-10 01:45:00', 3),
(39, 'Mr. John Deputy - Mountain View Academy', 'deputy@mountainview.edu', '2026-01-10 01:45:00', 2, '$2y$12$QmVu5B36UOBysYpYbW8RlOQlbiQ4weCo2XU4Ii7UOqZ5ruk5LdXee', NULL, NULL, NULL, NULL, '2026-01-10 01:45:01', '2026-01-10 01:45:01', 3),
(40, 'Mrs. Mary Admin - Mountain View Academy', 'admin@mountainview.edu', '2026-01-10 01:45:01', 2, '$2y$12$flAIlA8Y6jmbTgrpasK3JegWur9SLWN81vcKtECDFnvF6ISS7j8Aq', NULL, NULL, NULL, NULL, '2026-01-10 01:45:01', '2026-01-10 01:45:01', 3),
(41, 'Ms. Emily Johnson - Mountain View Academy', 'emily.johnson@mountainview.edu', '2026-01-10 01:45:01', 3, '$2y$12$Gwr/I0kdeVJ6e4Tlg28LZuBw8tA03Uj3tOtJDC0x3NHGJDMAeozHC', NULL, NULL, NULL, NULL, '2026-01-10 01:45:01', '2026-01-10 01:45:01', 3),
(42, 'Mr. David Smith - Mountain View Academy', 'david.smith@mountainview.edu', '2026-01-10 01:45:01', 3, '$2y$12$tI.LfhE0BYFR9rXIzolcBOYdppGi9L/Ua0BM40ETNMH/WqrZhfoiG', NULL, NULL, NULL, NULL, '2026-01-10 01:45:01', '2026-01-10 01:45:01', 3),
(43, 'Mrs. Lisa Brown - Mountain View Academy', 'lisa.brown@mountainview.edu', '2026-01-10 01:45:01', 3, '$2y$12$J9P4n/mLbC/Y7Q/ujBg64uJyNSLStJmwBEm/1NmVdQ4IMj4YfVR.a', NULL, NULL, NULL, NULL, '2026-01-10 01:45:02', '2026-01-10 01:45:02', 3),
(44, 'Mr. Robert Wilson - Mountain View Academy', 'robert.wilson@mountainview.edu', '2026-01-10 01:45:02', 3, '$2y$12$pvh2b4vNfQMQFVDB/lgdVe7OCpCp1RBFCmacm1cVKNSf/I2A0ptBO', NULL, NULL, NULL, NULL, '2026-01-10 01:45:02', '2026-01-10 01:45:02', 3),
(45, 'Mrs. Jennifer Davis - Mountain View Academy', 'jennifer.davis@mountainview.com', '2026-01-10 01:45:02', 4, '$2y$12$eZ6SWowDQWVjAsO8y2rnKuihBF/QHh9KhPoMdB85xWmkzShVVFxJ.', NULL, NULL, NULL, NULL, '2026-01-10 01:45:02', '2026-01-10 01:45:02', 3),
(46, 'Mr. Michael Garcia - Mountain View Academy', 'michael.garcia@mountainview.com', '2026-01-10 01:45:02', 4, '$2y$12$MKSUZ4iSeuKrIn417ZsJqe/hc9o/l3CMBmhdcUvVGGRjBqvaulrFe', NULL, NULL, NULL, NULL, '2026-01-10 01:45:02', '2026-01-10 01:45:02', 3),
(47, 'Mrs. Patricia Lee - Mountain View Academy', 'patricia.lee@mountainview.com', '2026-01-10 01:45:02', 4, '$2y$12$At3TSNKlYRq8m767fEwZDOJgY5bGM8G4Bl0L7SF5aeLhQUOILAYqC', NULL, NULL, NULL, NULL, '2026-01-10 01:45:03', '2026-01-10 01:45:03', 3),
(48, 'Emma Johnson - Mountain View Academy', 'emma.johnson@mountainview.edu', '2026-01-10 01:45:03', 5, '$2y$12$yGqINgV1UKQ.j/qT54YEX.gmoA891OppmR5GoJ0RtPmOZWj9JK1jK', NULL, NULL, NULL, NULL, '2026-01-10 01:45:03', '2026-01-10 01:45:03', 3),
(49, 'Noah Smith - Mountain View Academy', 'noah.smith@mountainview.edu', '2026-01-10 01:45:03', 5, '$2y$12$Al6f6hA3Y6NfvVCfrifJzOvdgJKU/bp2G/0rUdYPI2qsxzYI9oVRi', NULL, NULL, NULL, NULL, '2026-01-10 01:45:03', '2026-01-10 01:45:03', 3),
(50, 'Olivia Brown - Mountain View Academy', 'olivia.brown@mountainview.edu', '2026-01-10 01:45:03', 5, '$2y$12$5.ceeTiTyt1U/7FiDhWYPuyiJ2dDRLMvCFtLNsFJHdMY2GXd.tZKi', NULL, NULL, NULL, NULL, '2026-01-10 01:45:04', '2026-01-10 01:45:04', 3),
(51, 'Liam Wilson - Mountain View Academy', 'liam.wilson@mountainview.edu', '2026-01-10 01:45:04', 5, '$2y$12$ZUl.Bvh5FPSawIVU0Fztkue6U0whM4QYTXuQvudSzweOPAFa1akga', NULL, NULL, NULL, NULL, '2026-01-10 01:45:04', '2026-01-10 01:45:04', 3),
(52, 'Sophia Davis - Mountain View Academy', 'sophia.davis@mountainview.edu', '2026-01-10 01:45:04', 5, '$2y$12$3xlfK3BzjyQMFpQG0ABGPeXXWPjP2qgNxH5ENUmCYp/y3utnrXa.u', NULL, NULL, NULL, NULL, '2026-01-10 01:45:04', '2026-01-10 01:45:04', 3),
(53, 'Mason Garcia - Mountain View Academy', 'mason.garcia@mountainview.edu', '2026-01-10 01:45:04', 5, '$2y$12$uL2Hj1wuA56JE4aGnbzIZeeP4ZJyHzvekt1Ym7a98lLTDHC6IiGVW', NULL, NULL, NULL, NULL, '2026-01-10 01:45:04', '2026-01-10 01:45:04', 3),
(54, 'Isabella Lee - Mountain View Academy', 'isabella.lee@mountainview.edu', '2026-01-10 01:45:04', 5, '$2y$12$8MjszdiE.2g3tgWNShc/Z.z90gn747zQpzjTmvS.U/KlPdXF1Gy4u', NULL, NULL, NULL, NULL, '2026-01-10 01:45:05', '2026-01-10 01:45:05', 3),
(55, 'Ethan Martinez - Mountain View Academy', 'ethan.martinez@mountainview.edu', '2026-01-10 01:45:05', 5, '$2y$12$sER/TBV0bsruRrN7YQmf9eM2Wnbov8la7al4UmgpRUw6.43jEZW0W', NULL, NULL, NULL, NULL, '2026-01-10 01:45:05', '2026-01-10 01:45:05', 3);

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `plan_module`
--
ALTER TABLE `plan_module`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
