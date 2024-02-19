-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 03:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trialfoto`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaalbum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggaldibuat` date NOT NULL,
  `userid` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `namaalbum`, `deskripsi`, `tanggaldibuat`, `userid`, `created_at`, `updated_at`) VALUES
(8, 'guardian', 'hallo', '2024-02-18', 1, '2024-02-18 02:07:16', '2024-02-18 02:07:16'),
(9, 'hallo', 'hallo', '2024-02-18', 1, '2024-02-18 02:08:43', '2024-02-18 02:08:43'),
(11, 'atomic', 'da', '2024-02-19', 2, '2024-02-18 16:50:34', '2024-02-18 16:50:34'),
(12, 'guardian', 'd', '2024-02-19', 2, '2024-02-18 16:54:14', '2024-02-18 16:54:14'),
(13, 'atomic', 'w', '2024-02-19', 1, '2024-02-18 18:13:24', '2024-02-18 18:13:24');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggalunggah` date NOT NULL,
  `lokasifile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `albumid` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `judul`, `deskripsi`, `tanggalunggah`, `lokasifile`, `userid`, `albumid`, `created_at`, `updated_at`) VALUES
(9, 'zero', 'hallo', '2024-02-18', 'public/img/Q5mTHvwoEjlShZkCnaqCWqvFkekUsdZhmx3kVYCO.png', 1, 8, '2024-02-18 02:07:38', '2024-02-18 02:07:38'),
(10, 'ato', 'a', '2024-02-18', 'public/img/b5IwbbxaxIF8IEcI6szTxwlt4fbiPH6zaa8YbBPR.png', 1, 9, '2024-02-18 02:09:03', '2024-02-18 02:09:03'),
(11, 'first', 'hallo', '2024-02-18', 'public/img/FkA9ufLJqXFrSynBaz1zOleaDF0KQYel30J9tRwr.png', 1, 9, '2024-02-18 02:10:19', '2024-02-18 02:10:19'),
(13, 'zero', 'hallo', '2024-02-19', 'public/img/djoRzDfuUDImTRozuF4WJPzbsXu2tpHD2I3hnC7R.png', 2, 11, '2024-02-18 16:50:49', '2024-02-18 16:50:49'),
(14, 'first', 'd', '2024-02-19', 'public/img/LRTVRhSASmwVUvqdvVgfrzfIntlpsLpHlvAUjezu.png', 2, 12, '2024-02-18 16:54:31', '2024-02-18 16:54:31'),
(15, 'wr', 'w', '2024-02-19', 'public/img/0ANy96bc3HXHSZmBbvadu4wQdQAltxn8esU9BAd2.png', 1, 13, '2024-02-18 18:13:41', '2024-02-18 18:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fotoid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `isikomentar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggalkomentar` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komentarfoto`
--

INSERT INTO `komentarfoto` (`id`, `fotoid`, `userid`, `isikomentar`, `tanggalkomentar`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'hallo bang', '2024-02-17', '2024-02-17 06:06:11', '2024-02-17 06:06:11'),
(3, 10, 1, 'hallo', '2024-02-18', '2024-02-18 04:59:48', '2024-02-18 04:59:48'),
(4, 9, 1, 'hallo', '2024-02-18', '2024-02-18 05:08:38', '2024-02-18 05:08:38'),
(5, 9, 1, 'hola', '2024-02-19', '2024-02-18 18:14:02', '2024-02-18 18:14:02'),
(7, 9, 2, 'yoo', '2024-02-19', '2024-02-18 18:30:56', '2024-02-18 18:30:56'),
(8, 14, 2, 'halo', '2024-02-19', '2024-02-18 18:54:34', '2024-02-18 18:54:34'),
(9, 13, 2, 'halo', '2024-02-19', '2024-02-18 19:03:20', '2024-02-18 19:03:20'),
(10, 10, 1, 'halo', '2024-02-19', '2024-02-18 21:12:10', '2024-02-18 21:12:10');

-- --------------------------------------------------------

--
-- Table structure for table `likefoto`
--

CREATE TABLE `likefoto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fotoid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `tanggallike` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likefoto`
--

INSERT INTO `likefoto` (`id`, `fotoid`, `userid`, `tanggallike`, `created_at`, `updated_at`) VALUES
(18, 9, 1, '2024-02-19', '2024-02-19 06:00:01', '2024-02-19 06:00:01'),
(21, 9, 2, '2024-02-19', '2024-02-19 06:20:06', '2024-02-19 06:20:06');

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
(57, '2014_10_12_000000_create_users_table', 1),
(58, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(59, '2019_08_19_000000_create_failed_jobs_table', 1),
(60, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(61, '2024_01_24_005555_create_album_table', 1),
(62, '2024_01_24_021500_create_likefoto_table', 1),
(63, '2024_01_24_021517_create_komentarfoto_table', 1),
(64, '2024_01_24_021531_create_foto_table', 1);

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namalengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `namalengkap`, `alamat`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'rooky', 'rooky52', 'rooky@gmail.com', NULL, '$2y$12$b8xJ3VSsKUCmT9yh1Ju2LufOMWobHEFutpMt4lVDYXVYoGv.yTtIa', 'rooky dermawan', 'buntar', NULL, '2024-02-17 05:19:11', '2024-02-17 05:19:11'),
(2, 'kevin', 'kev', 'kevin@gmail.com', NULL, '$2y$12$ZY3tD/aKPFeaqfZO3oZfNuOAl.de14gb12OOhz9/2De5248DeCJZO', 'kevinstark', 'buntar', NULL, '2024-02-17 22:59:04', '2024-02-17 22:59:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likefoto`
--
ALTER TABLE `likefoto`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
