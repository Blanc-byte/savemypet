-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 06:06 PM
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
-- Database: `petapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `pet_type` varchar(254) NOT NULL,
  `breed` varchar(254) NOT NULL,
  `service` varchar(254) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` varchar(254) NOT NULL DEFAULT 'pending',
  `date` datetime(6) DEFAULT NULL,
  `room` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `customerid`, `pet_type`, `breed`, `service`, `total_price`, `status`, `date`, `room`) VALUES
(20, 2, 'Dog', 'Chihuahua', 'Basic Grooming', 20, 'done', '2024-12-22 23:20:00.000000', 'ROOM 2'),
(21, 3, 'Cat', 'Wolfiii', 'Full Grooming', 50, 'pending', NULL, NULL),
(22, 4, 'Dog', 'Hyper Boolean', 'Nail Clipping,Teeth Cleaning', 35, 'pending', NULL, NULL),
(23, 5, 'Rabbit', 'Usual', 'Basic Grooming,Nail Clipping', 38, 'pending', NULL, NULL),
(24, 2, 'Dog', 'Chihuahua', 'Basic Grooming,De-shedding', 55, 'scheduled', '2024-12-22 13:34:00.000000', 'ROOM 2');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(254) NOT NULL,
  `status` varchar(254) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `status`) VALUES
(1, 'ROOM 1', 'available'),
(2, 'ROOM 2', 'available'),
(3, 'ROOM 3', 'available'),
(4, 'ROOM 4', 'available'),
(5, 'ROOM 5', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `description` varchar(254) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(254) NOT NULL,
  `pet_type` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `description`, `price`, `status`, `pet_type`) VALUES
(1, 'Basic Grooming Advance', 25, 'available', 'Doggy'),
(2, 'Basic Grooming', 15, 'available', 'Cat'),
(3, 'Full Grooming', 50, 'available', 'Dog'),
(4, 'Full Grooming', 40, 'available', 'Cat'),
(5, 'Nail Clipping', 10, 'available', 'Dog'),
(6, 'Nail Clipping', 8, 'available', 'Cat'),
(7, 'Teeth Cleaning', 25, 'available', 'Dog'),
(8, 'Teeth Cleaning', 20, 'available', 'Cat'),
(9, 'Ear Cleaning', 15, 'available', 'Dog'),
(10, 'Ear Cleaning', 12, 'available', 'Cat'),
(11, 'Medicated Bath', 30, 'available', 'Dog'),
(12, 'Medicated Bath', 25, 'available', 'Cat'),
(13, 'De-shedding', 35, 'available', 'Dog'),
(14, 'De-shedding', 30, 'available', 'Cat'),
(15, 'Puppy Trim', 40, 'available', 'Dog'),
(16, 'Lion Cut', 45, 'available', 'Cat'),
(17, 'Basic Grooming', 20, 'available', 'Dog'),
(18, 'Basic Grooming', 15, 'available', 'Cat'),
(19, 'Basic Grooming', 25, 'available', 'Rabbit'),
(20, 'Full Grooming', 50, 'available', 'Dog'),
(21, 'Full Grooming', 40, 'available', 'Cat'),
(22, 'Full Grooming', 60, 'available', 'Rabbit'),
(23, 'Nail Clipping', 10, 'available', 'Dog'),
(24, 'Nail Clipping', 8, 'available', 'Cat'),
(25, 'Nail Clipping', 18, 'available', 'Rabbit'),
(26, 'Teeth Cleaning', 25, 'available', 'Dog'),
(27, 'Teeth Cleaning', 20, 'available', 'Cat'),
(28, 'Teeth Cleaning', 35, 'available', 'Rabbit'),
(29, 'Ear Cleaning', 15, 'available', 'Dog'),
(30, 'Ear Cleaning', 12, 'available', 'Cat'),
(31, 'Ear Cleaning', 22, 'available', 'Rabbit'),
(32, 'Medicated Bath', 30, 'available', 'Dog'),
(33, 'Medicated Bath', 25, 'available', 'Cat'),
(34, 'Medicated Bath', 40, 'available', 'Rabbit'),
(35, 'De-shedding', 35, 'available', 'Dog'),
(36, 'De-shedding', 30, 'available', 'Cat'),
(37, 'De-shedding', 45, 'available', 'Rabbit'),
(38, 'Puppy Trim', 40, 'available', 'Dog'),
(39, 'Lion Cut', 45, 'available', 'Cat'),
(40, 'Rabbit Fur Trim', 55, 'available', 'Rabbit');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(254) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Save my Pet', 'savemypet@gmail.com', NULL, '$2y$10$vFW9xHEJ2Qz1FhFnzAnl2Op6UpyPkp9VmPhkjh5s6rrq71UcwaOF6', NULL, '2024-12-18 04:59:30', '2024-12-18 04:59:30', 'admin'),
(2, 'Faker', 'faker@gmail.com', NULL, '$2y$10$a014yu1on/q7/xxXk5PkReqYfDuK/7E4IdNIfMEu1jvszZaXYsuLS', NULL, '2024-12-18 05:26:13', '2024-12-18 05:26:13', 'customer'),
(3, 'Lusty', 'lusty@gmail.com', NULL, '$2y$10$UlB.gks1b3GaN5Js77.08uC6xiYnxFa34kxLyzrz.xHTp4J7gB5PO', NULL, '2024-12-19 05:05:17', '2024-12-19 05:05:17', 'customer'),
(4, 'Sanford', 'sanford@gmail.com', NULL, '$2y$10$KD4/92piW.e/PfHwY.Jzf.gQPyDJ5h66oQQnbFQmmKrwMwuwIreHq', NULL, '2024-12-19 05:08:15', '2024-12-19 05:08:15', 'customer'),
(5, 'Wise', 'wise@gmail.com', NULL, '$2y$10$vTP8Hw6YrMaXwKVN2PeSieZRGSuXXOeTJw0e8P/hZL1HgMnAIecem', NULL, '2024-12-19 05:08:59', '2024-12-19 05:08:59', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
