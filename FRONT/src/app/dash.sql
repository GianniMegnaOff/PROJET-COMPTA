-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 03, 2019 at 12:43 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `API`
--

-- --------------------------------------------------------

--
-- Table structure for table `Assignation`
--

CREATE TABLE `Assignation` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_projet` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `role_on_project` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `last_name` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` int(11) DEFAULT NULL,
  `siret` int(11) DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`id`, `last_name`, `first_name`, `mail`, `adress`, `zip_code`, `siret`, `company_name`, `updated_at`, `created_at`) VALUES
(69, 'John', 'Doe', 'j.doe@gmail.com', '106 Avenue de Paris', 94800, 929980980, 'SARL E-print', '2019-05-24 20:11:44', '2019-05-24 20:11:44'),
(70, 'Louis', 'Emile', 'g.megna@icloud.com', '14 Rue Carnot', 94800, 234234234, 'MyUmbrella', '2019-05-25 12:23:26', '2019-05-25 12:23:26'),
(71, 'Marc', 'Palo', 'm.palo@gmail.com', '13 Rue de Recollets', 75010, 67890, 'EDF France', '2019-05-29 00:10:26', '2019-05-29 00:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `Deal`
--

CREATE TABLE `Deal` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `airline` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_05_22_163349_users', 1),
(6, '2019_05_22_165343_products', 3),
(7, '2019_05_22_165353_deals', 3),
(43, '2014_10_12_000000_create_users_table', 4),
(44, '2014_10_12_100000_create_password_resets_table', 4),
(45, '2019_05_22_165446_customers', 4),
(46, '2019_05_22_165509_quote', 4),
(47, '2019_05_22_165517_projects', 4),
(48, '2019_05_22_165605_role', 4),
(49, '2019_05_22_165614_assignations', 4),
(50, '2019_05_22_170055_users', 4),
(51, '2019_05_22_170132_payment', 4),
(52, '2019_05_22_170231_role_on_project', 4),
(53, '2019_05_22_171556_deals', 4),
(54, '2019_05_22_171808_products', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Payment`
--

CREATE TABLE `Payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tax` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`id`, `name`, `price`, `description`, `tax`, `created_at`, `updated_at`) VALUES
(11, 'Rédaction des contenus', 200, 'Rédaction de tous les contenus éditoriaux du site internet', 20, '2019-05-24 20:10:45', '2019-05-24 20:10:45'),
(12, 'Création des structures HTML', 500, 'Création des structures HTML des pages principales', 20, '2019-05-28 19:41:04', '2019-05-28 19:41:04'),
(13, 'Création de la charte graphique', 200, 'Création de la charte graphique (couleurs, font, collatéraux).', 20, '2019-05-29 00:04:30', '2019-05-29 00:04:30'),
(14, 'Création d\'un back-office', 1000, 'Création d\'un back-office en Laravel', 20, '2019-05-29 00:04:59', '2019-05-29 00:04:59'),
(15, 'Création d\'un back-office', 1200, 'Création d\'un back-office en Symfonie', 20, '2019-05-29 00:05:15', '2019-05-29 00:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `Project`
--

CREATE TABLE `Project` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `statut` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Project`
--

INSERT INTO `Project` (`id`, `name`, `comment`, `id_client`, `statut`, `created_at`, `updated_at`) VALUES
(23, 'Création du site vitrine', 'Création d\'un site vitrine administrable sous Wordpress', 69, 0, '2019-05-24 20:12:31', '2019-05-24 20:12:31'),
(25, 'Création d\'un CMS', 'Création d\'un CMS personnalisé pour le service comptabilité', 70, 0, '2019-05-25 12:24:53', '2019-05-25 12:24:53'),
(26, 'Site intranet', 'Création d\'un espace intranet pour les RH', 70, 0, '2019-05-29 00:06:10', '2019-05-29 00:06:10'),
(27, 'Création site vitrine', 'Création d\'un site vitrine à destination des franchisés', 71, 0, '2019-05-29 00:11:06', '2019-05-29 00:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `Quote`
--

CREATE TABLE `Quote` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_projet` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `payment_ate` datetime NOT NULL,
  `payment_type` int(11) NOT NULL,
  `deals` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE `Role` (
  `id` int(10) UNSIGNED NOT NULL,
  `Name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RoleOnProject`
--

CREATE TABLE `RoleOnProject` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_projet` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(10) UNSIGNED NOT NULL,
  `family_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pofil_picture` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Assignation`
--
ALTER TABLE `Assignation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Deal`
--
ALTER TABLE `Deal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `Payment`
--
ALTER TABLE `Payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Project`
--
ALTER TABLE `Project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Quote`
--
ALTER TABLE `Quote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RoleOnProject`
--
ALTER TABLE `RoleOnProject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
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
-- AUTO_INCREMENT for table `Assignation`
--
ALTER TABLE `Assignation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `Deal`
--
ALTER TABLE `Deal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `Payment`
--
ALTER TABLE `Payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Project`
--
ALTER TABLE `Project`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `Quote`
--
ALTER TABLE `Quote`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Role`
--
ALTER TABLE `Role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RoleOnProject`
--
ALTER TABLE `RoleOnProject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
