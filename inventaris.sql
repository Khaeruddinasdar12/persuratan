-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2019 at 05:19 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `databarangs`
--

CREATE TABLE `databarangs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `databarangs`
--

INSERT INTO `databarangs` (`id`, `nama`, `kondisi`, `jumlah`, `stok`, `foto`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Monitor', 'Layak Pakai', 1, 1, 'inventaris/n9tPqQwVEiuLwlKBWDACrnGoUtxNaylVuB5qImIj.png', 1, '2019-08-24 20:37:50', '2019-08-24 20:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_06_015158_create_users_table', 1),
(2, '2019_08_06_015217_create_password_resets_table', 1),
(3, '2019_08_06_015241_create_databarangs_table', 1),
(4, '2019_08_06_015300_create_peminjamans_table', 1),
(5, '2019_08_06_015325_create_persuratans_table', 1),
(6, '2019_08_08_002911_perbaikan_persuratan', 2),
(7, '2019_08_24_234948_create_persuratans_table', 3),
(8, '2019_08_24_235334_create_databarangs_table', 4),
(9, '2019_08_24_235432_create_peminjamans_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_barang` int(10) UNSIGNED NOT NULL,
  `peminjam` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_kembali` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `accepted_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `kode_barang`, `peminjam`, `jumlah`, `kondisi`, `tanggal_kembali`, `created_by`, `accepted_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'a', 1, 'Layak Pakai', '2019-08-25 03:49:29', 1, 'Khaeruddin Asdar', '2019-08-24 20:38:12', '2019-08-24 20:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `persuratans`
--

CREATE TABLE `persuratans` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_surat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dari_kepada` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_surat` enum('surat_masuk','surat_keluar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` enum('kord_dpo','dpo','kord_tim_ahli','tim_ahli','ketum','sekum','bendum','wk1','wk2','kord_keorganisasian','staff_keorganisasian','kord_P&R','staff_P&R','kord_tools','staff_tools','kord_keilmuan','kord_program','staff_program','kord_jaringan','staff_jaringan','kord_hardware','staff_hardware','kord_multimedia','staff_multimedia','all_crew') COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noreg` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_surat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `jabatan`, `phone`, `noreg`, `status_surat`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Khaeruddin Asdar', 'khaeruddinasdar12@gmail.com', '2019-08-05 17:00:00', '$2y$10$BWeJmunUT/9ckZGHxz8k/uctMss7Ed2Hsg2kf0fu3aYorJEVWV0bi', 'sekum', '082344949501', '829.KD.XVII.18', 'ngeri', 'anggota/ffotbOEhC1JPs3s6AviKG3QYxO9Hstlga8Tuh2s2.png', 'nEerMF18oqs0jjrV18WQdZaJz83vHX1aUx7Cuykk2Ikv0edjYHJFojPDBBqV', '2019-08-05 18:56:41', '2019-08-26 11:07:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `databarangs`
--
ALTER TABLE `databarangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `databarangs_created_by_foreign` (`created_by`);

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
-- Indexes for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjamans_created_by_foreign` (`created_by`),
  ADD KEY `peminjamans_kode_barang_foreign` (`kode_barang`);

--
-- Indexes for table `persuratans`
--
ALTER TABLE `persuratans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persuratans_created_by_foreign` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `databarangs`
--
ALTER TABLE `databarangs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `persuratans`
--
ALTER TABLE `persuratans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `databarangs`
--
ALTER TABLE `databarangs`
  ADD CONSTRAINT `databarangs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `peminjamans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `peminjamans_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `databarangs` (`id`);

--
-- Constraints for table `persuratans`
--
ALTER TABLE `persuratans`
  ADD CONSTRAINT `persuratans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
