-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2024 at 10:00 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan`
--

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
-- Table structure for table `jenis_infrastrukturs`
--

CREATE TABLE `jenis_infrastrukturs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pengaduans`
--

CREATE TABLE `jenis_pengaduans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(5, '2024_05_13_173650_add_role_to_users_table', 1),
(6, '2024_05_13_180334_create_pengaduans_table', 1),
(7, '2024_05_14_165016_create_tindakans_table', 1),
(8, '2024_05_20_153852_create_jenis_infrastrukturs_table', 2),
(9, '2024_05_20_153934_create_jenis_pengaduans_table', 2);

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
-- Table structure for table `pengaduans`
--

CREATE TABLE `pengaduans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pengaduan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','in_progress','resolved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `prioritas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `komentar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_kejadian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kejadian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_masalah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_infrastruktur` enum('jalan','jembatan','saluran_air') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_masalah_lingkungan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_masalah_lingkungan` text COLLATE utf8mb4_unicode_ci,
  `lokasi_masalah_kenyamanan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_masalah_kenyamanan` text COLLATE utf8mb4_unicode_ci,
  `foto_bukti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaduans`
--

INSERT INTO `pengaduans` (`id`, `nama`, `email`, `telepon`, `jenis_pengaduan`, `judul`, `deskripsi`, `user_id`, `status`, `prioritas`, `komentar`, `lokasi_kejadian`, `jenis_kejadian`, `lokasi_masalah`, `jenis_infrastruktur`, `lokasi_masalah_lingkungan`, `jenis_masalah_lingkungan`, `lokasi_masalah_kenyamanan`, `jenis_masalah_kenyamanan`, `foto_bukti`, `created_at`, `updated_at`) VALUES
(15, 'SOBIRIN RAMBE S,DS', 'S@GMAIL.COM', '0837437473', 'infrastruktur', 'Kerusakan Jalan', 'terjadi kerusakan jalan', 4, 'in_progress', 'penting', NULL, NULL, NULL, 'jln.tunggang', 'jalan', NULL, NULL, NULL, NULL, '1716192116.jpeg', '2024-05-20 08:01:56', '2024-05-20 08:03:05'),
(16, 'ROFIL BOTAK', 'birin@gmail.com', '0837437473', 'keamanan', 'pembegalan', 'terjadi begal', 4, 'resolved', 'sangat penting', 'sudah selesai', 'jalan tunggang', 'begal anggota motor', NULL, NULL, NULL, NULL, NULL, NULL, '1716192967.png', '2024-05-20 08:16:07', '2024-05-21 13:40:05'),
(17, 'birin', 'taufik123@gmail.com', '0837437473', 'ada', 'ada', 'ada', 4, 'in_progress', 'penting', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1716202208.jpeg', '2024-05-20 10:50:08', '2024-05-20 10:55:03'),
(18, 'frandito', 'S@GMAIL.COM', '0837437473', 'lingkungan', '1', '1', 4, 'in_progress', 'sangat penting', NULL, NULL, NULL, NULL, NULL, '1', '1', NULL, NULL, '1716223076.jpeg', '2024-05-20 16:37:56', '2024-05-21 14:44:06'),
(19, 'rama', 'S@GMAIL.COM', '0837437473', 'infrastruktur', '2', '2', 4, 'in_progress', 'sangat penting', NULL, NULL, NULL, '2', 'jembatan', NULL, NULL, NULL, NULL, '1716299096.jpeg', '2024-05-21 13:44:56', '2024-05-21 14:32:54'),
(20, 'rama', 'S@GMAIL.COM', '0837437473', 'keamanan', '4444444444444', '333333333333333', 4, 'pending', 'penting', NULL, '33333333333', '33333333333', NULL, NULL, NULL, NULL, NULL, NULL, '1716303069.jpg', '2024-05-21 14:51:09', '2024-05-21 14:51:47');

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
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tindakans`
--

CREATE TABLE `tindakans` (
  `id` bigint UNSIGNED NOT NULL,
  `pengaduan_id` bigint UNSIGNED NOT NULL,
  `deskripsi_tindakan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_personil` int DEFAULT NULL,
  `personil1_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personil2_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personil3_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laporan_progress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tindakans`
--

INSERT INTO `tindakans` (`id`, `pengaduan_id`, `deskripsi_tindakan`, `status`, `jumlah_personil`, `personil1_id`, `personil2_id`, `personil3_id`, `laporan_progress`, `created_at`, `updated_at`) VALUES
(21, 15, 'butuh pengecekan lokasi', 'selesai', NULL, '3', '3', '6', 'laporan/1716299667_sobirin.docx', '2024-05-20 08:03:27', '2024-05-21 13:54:32'),
(22, 16, 'halllo', 'selesai', 2, '3', '6', NULL, NULL, '2024-05-20 10:43:20', '2024-05-20 16:19:03'),
(23, 17, 'yyyyyyyyyyyy', 'selesai', 2, '3', '6', NULL, 'laporan/1716204018_sobirin.docx', '2024-05-20 10:55:14', '2024-05-20 16:13:11'),
(24, 19, 'adasdasdadsasdasdasdasdasd', NULL, NULL, '3', '6', NULL, 'laporan/1716308355_Screenshot (32).jpg', '2024-05-21 14:33:12', '2024-05-21 16:19:15'),
(25, 18, 'kerjakan', NULL, 2, '3', '6', '3', 'laporan/1716305669_IMG_1091.HEIC', '2024-05-21 14:44:15', '2024-05-21 16:14:42');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'masyarakat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'taufik pratama', 'taufik123@gmail.com', NULL, '$2y$12$rBjxgcJN0V6v0a29SzjRn.ZHkpexF5UjCsDNjyozk9ohSV2GPA.Ou', NULL, '2024-05-17 16:49:16', '2024-05-17 16:49:16', 'petugas'),
(2, 'rambe', 'S@GMAIL.COM', NULL, '$2y$12$kp3.IjduTpV2ZR8pbWCkDuCCceKTwKfDrvc9J81P/TqqVZCdyozFG', NULL, '2024-05-17 16:50:02', '2024-05-18 11:57:31', 'departemen'),
(3, 'ridho', 'ridho@gmail.com', NULL, '$2y$12$K/XBO5sbo/UfesvmEI6fguFrx0HbuooIU/eu2P4iC5OCuKOYoL7WC', NULL, '2024-05-17 16:50:15', '2024-05-17 16:51:01', 'anggota'),
(4, 'rama', 'rama@gmail.com', NULL, '$2y$12$dzAnuXoRreoJYQHr.6z2pOjTSFwr6SIEzw35o5W7MBfpFRQuokRUS', NULL, '2024-05-17 16:50:31', '2024-05-17 16:50:31', 'masyarakat'),
(5, 'botak', 'botak@gmail.com', NULL, '$2y$12$1EPM2m7tSM9Tf3Mr6Szhv.R9As.JEn2rbXKEtubnkx2dotQj/DVpG', NULL, '2024-05-17 16:50:46', '2024-05-17 16:50:46', 'admin'),
(6, 'anggota1', 'anggota1@gmail.com', NULL, '$2y$12$/Lg36kquztn1CYUyK5HsIOZrnynSUlairxoY76ZACXNLsmsfrHGRS', NULL, '2024-05-17 21:41:49', '2024-05-17 21:41:58', 'anggota');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_infrastrukturs`
--
ALTER TABLE `jenis_infrastrukturs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_pengaduans`
--
ALTER TABLE `jenis_pengaduans`
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
-- Indexes for table `pengaduans`
--
ALTER TABLE `pengaduans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengaduans_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `tindakans`
--
ALTER TABLE `tindakans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tindakans_pengaduan_id_foreign` (`pengaduan_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_infrastrukturs`
--
ALTER TABLE `jenis_infrastrukturs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_pengaduans`
--
ALTER TABLE `jenis_pengaduans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengaduans`
--
ALTER TABLE `pengaduans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tindakans`
--
ALTER TABLE `tindakans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengaduans`
--
ALTER TABLE `pengaduans`
  ADD CONSTRAINT `pengaduans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD CONSTRAINT `personal_access_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tindakans`
--
ALTER TABLE `tindakans`
  ADD CONSTRAINT `tindakans_pengaduan_id_foreign` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
