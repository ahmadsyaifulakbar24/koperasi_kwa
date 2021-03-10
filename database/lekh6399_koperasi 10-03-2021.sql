-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Mar 2021 pada 16.16
-- Versi server: 10.2.36-MariaDB-cll-lve
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lekh6399_koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `main_settings`
--

CREATE TABLE `main_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_setting` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `main_settings`
--

INSERT INTO `main_settings` (`id`, `name_setting`, `value`) VALUES
(1, 'bunga', '2'),
(2, 'simpanan_pokok', '20000'),
(3, 'saldo', '952667');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_01_28_032915_create_user_levels_table', 1),
(6, '2021_01_28_034038_create_params_table', 1),
(7, '2021_01_28_034734_create_main_settings_table', 1),
(8, '2021_01_28_035655_create_user_koperasi_details_table', 1),
(9, '2021_01_28_040650_create_transactions_table', 1),
(10, '2021_01_28_041350_create_sub_transactions_table', 1),
(11, '2021_01_28_041959_create_pinjaman_table', 1),
(12, '2021_03_05_032028_create_vw_user_transaction_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `params`
--

CREATE TABLE `params` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `param_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_param` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `param` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `params`
--

INSERT INTO `params` (`id`, `param_id`, `category_param`, `param`, `order`, `active`) VALUES
(1, NULL, 'pendidikan', 'SD', 1, 1),
(2, NULL, 'pendidikan', 'SMP', 2, 1),
(3, NULL, 'pendidikan', 'SLTA', 3, 1),
(4, NULL, 'pendidikan', 'D3', 4, 1),
(5, NULL, 'pendidikan', 'S1', 5, 1),
(6, NULL, 'pendidikan', 'S2', 6, 1),
(7, NULL, 'pendidikan', 'S3', 7, 1),
(8, NULL, 'jabatan', 'JAJARAN DIREKSI', 1, 1),
(9, NULL, 'jabatan', 'ADMIN HD (MANAGER OPS.)', 2, 1),
(10, NULL, 'jabatan', 'TEKNISI', 3, 1),
(11, NULL, 'jabatan', 'SALES / MARKETING', 4, 1),
(12, NULL, 'status_keluarga', 'Kepala Rumah Tangga', 1, 1),
(13, NULL, 'status_keluarga', 'Istri', 2, 1),
(14, NULL, 'status_keluarga', 'Anak', 1, 1),
(15, NULL, 'status_keluarga', 'Orang Tua', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(17, 'App\\Models\\User', 1, 'Win32', '6cd3f53858cc295f1860f59cae0c173f9596155add3508d20baafd3a009a1a0b', '[\"*\"]', '2021-03-10 02:10:33', '2021-03-10 00:13:35', '2021-03-10 02:10:33'),
(18, 'App\\Models\\User', 1, 'MacIntel', '50c06bf44f1f5b04b84d026ad34beeb306142901df99da334ab29414c9d3d5b4', '[\"*\"]', '2021-03-10 02:14:54', '2021-03-10 00:20:33', '2021-03-10 02:14:54'),
(19, 'App\\Models\\User', 1, 'MacIntel', '94fe56c3e699d53195dd661c61937d5cfe5cd9bd3ac433896fb4341643ae2e43', '[\"*\"]', '2021-03-10 02:16:00', '2021-03-10 00:36:39', '2021-03-10 02:16:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `angsuran` bigint(20) DEFAULT NULL,
  `besar_pinjaman` bigint(20) NOT NULL,
  `tenor` int(11) DEFAULT NULL,
  `total_bayar` bigint(20) DEFAULT NULL,
  `sisa_bayar` bigint(20) DEFAULT NULL,
  `status` enum('approved','rejected','pending','paid_off') COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `transaction_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_off_date` timestamp NULL DEFAULT NULL,
  `contract` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `user_id`, `angsuran`, `besar_pinjaman`, `tenor`, `total_bayar`, `sisa_bayar`, `status`, `approved_date`, `transaction_type`, `description`, `paid_off_date`, `contract`, `created_at`, `updated_at`) VALUES
(1, 20, 516667, 5000000, 12, 5000000, 4166667, 'approved', '2021-01-29 10:00:00', 'pinjaman', NULL, NULL, NULL, '2021-01-29 10:00:00', NULL),
(2, 11, 569333, 3050000, 6, 3050000, 3050000, 'approved', '2021-02-04 10:00:00', 'pinjaman', NULL, NULL, NULL, '2021-02-04 10:00:00', NULL),
(3, 9, 120000, 1000000, 10, 1000000, 900000, 'approved', '2021-02-03 10:00:00', 'pinjaman', NULL, NULL, NULL, '2021-02-03 10:00:00', NULL),
(4, 33, 289333, 2800000, 12, 2800000, 2566667, 'approved', '2021-02-08 10:00:00', 'pinjaman', NULL, NULL, NULL, '2021-02-08 10:00:00', NULL),
(5, 34, 373333, 2000000, 6, 2000000, 1666667, 'approved', '2021-02-18 10:00:00', 'pinjaman', NULL, NULL, NULL, '2021-02-18 10:00:00', NULL),
(6, 12, 280000, 1500000, 6, 1500000, 1500000, 'approved', '2021-03-03 10:00:00', 'pinjaman', NULL, NULL, NULL, '2021-03-03 10:00:00', NULL),
(7, 35, 1027140, 1000000, 1, 1000000, 1000000, 'approved', '2021-03-07 10:00:00', 'pinjaman', NULL, NULL, NULL, '2021-03-07 10:00:00', NULL),
(8, 30, 353333, 1000000, 3, 1000000, 1000000, 'approved', '2021-03-07 10:00:00', 'pinjaman', NULL, NULL, NULL, '2021-03-07 10:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_transactions`
--

CREATE TABLE `sub_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('simpanan_sukarela','simpanan_wajib','simpanan_pokok','tagihan_pinjaman','saldo_koperasi','min_saldo_koperasi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `besaran` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sub_transactions`
--

INSERT INTO `sub_transactions` (`id`, `transaction_id`, `type`, `besaran`, `created_at`, `updated_at`) VALUES
(1, 1, 'simpanan_wajib', 50000, NULL, NULL),
(2, 1, 'simpanan_sukarela', 30000, NULL, NULL),
(3, 1, 'simpanan_pokok', 20000, NULL, NULL),
(4, 2, 'simpanan_wajib', 50000, NULL, NULL),
(5, 2, 'simpanan_sukarela', 30000, NULL, NULL),
(6, 2, 'simpanan_pokok', 20000, NULL, NULL),
(7, 3, 'simpanan_wajib', 50000, NULL, NULL),
(8, 3, 'simpanan_sukarela', 30000, NULL, NULL),
(9, 3, 'simpanan_pokok', 20000, NULL, NULL),
(10, 4, 'simpanan_wajib', 20000, NULL, NULL),
(11, 4, 'simpanan_sukarela', 10000, NULL, NULL),
(12, 4, 'simpanan_pokok', 20000, NULL, NULL),
(13, 5, 'simpanan_wajib', 50000, NULL, NULL),
(14, 5, 'simpanan_pokok', 20000, NULL, NULL),
(15, 6, 'simpanan_wajib', 20000, NULL, NULL),
(16, 6, 'simpanan_pokok', 20000, NULL, NULL),
(17, 6, 'simpanan_sukarela', 10000, NULL, NULL),
(18, 7, 'simpanan_wajib', 50000, NULL, NULL),
(19, 7, 'simpanan_pokok', 20000, NULL, NULL),
(20, 8, 'simpanan_wajib', 50000, NULL, NULL),
(21, 8, 'simpanan_pokok', 20000, NULL, NULL),
(22, 9, 'simpanan_wajib', 20000, NULL, NULL),
(23, 9, 'simpanan_pokok', 20000, NULL, NULL),
(24, 1, 'simpanan_pokok', 50000, NULL, NULL),
(25, 10, 'simpanan_sukarela', 30000, NULL, NULL),
(26, 10, 'simpanan_wajib', 20000, NULL, NULL),
(27, 11, 'simpanan_wajib', 20000, NULL, NULL),
(28, 11, 'simpanan_pokok', 20000, NULL, NULL),
(29, 12, 'simpanan_wajib', 50000, NULL, NULL),
(30, 12, 'simpanan_pokok', 20000, NULL, NULL),
(31, 12, 'simpanan_sukarela', 30000, NULL, NULL),
(32, 13, 'simpanan_wajib', 20000, NULL, NULL),
(33, 13, 'simpanan_pokok', 20000, NULL, NULL),
(34, 14, 'simpanan_wajib', 50000, NULL, NULL),
(35, 14, 'simpanan_pokok', 20000, NULL, NULL),
(36, 14, 'simpanan_sukarela', 20000, NULL, NULL),
(37, 15, 'simpanan_wajib', 20000, NULL, NULL),
(38, 15, 'simpanan_pokok', 20000, NULL, NULL),
(39, 15, 'simpanan_sukarela', 20000, NULL, NULL),
(40, 16, 'simpanan_wajib', 20000, NULL, NULL),
(41, 16, 'simpanan_pokok', 20000, NULL, NULL),
(42, 16, 'simpanan_sukarela', 110000, NULL, NULL),
(43, 17, 'simpanan_wajib', 20000, NULL, NULL),
(44, 17, 'simpanan_pokok', 20000, NULL, NULL),
(45, 17, 'simpanan_sukarela', 10000, NULL, NULL),
(46, 18, 'simpanan_wajib', 20000, NULL, NULL),
(47, 18, 'simpanan_pokok', 20000, NULL, NULL),
(48, 18, 'simpanan_sukarela', 10000, NULL, NULL),
(49, 19, 'simpanan_wajib', 20000, NULL, NULL),
(50, 19, 'simpanan_pokok', 20000, NULL, NULL),
(51, 19, 'simpanan_sukarela', 10000, NULL, NULL),
(52, 20, 'simpanan_sukarela', 60000, NULL, NULL),
(53, 21, 'simpanan_wajib', 50000, NULL, NULL),
(54, 21, 'simpanan_pokok', 20000, NULL, NULL),
(55, 21, 'simpanan_sukarela', 50000, NULL, NULL),
(56, 22, 'saldo_koperasi', 5000000, NULL, NULL),
(57, 23, 'simpanan_wajib', 20000, NULL, NULL),
(58, 23, 'simpanan_pokok', 20000, NULL, NULL),
(59, 24, 'simpanan_wajib', 50000, NULL, NULL),
(60, 24, 'simpanan_sukarela', 50000, NULL, NULL),
(61, 25, 'simpanan_wajib', 20000, NULL, NULL),
(62, 25, 'simpanan_sukarela', 33333, NULL, NULL),
(63, 88, 'tagihan_pinjaman', 516667, NULL, NULL),
(64, 26, 'simpanan_wajib', 100000, NULL, NULL),
(65, 26, 'simpanan_sukarela', 30000, NULL, NULL),
(66, 26, 'simpanan_pokok', 20000, NULL, NULL),
(67, 27, 'simpanan_wajib', 100000, NULL, NULL),
(68, 27, 'simpanan_sukarela', 80000, NULL, NULL),
(69, 27, 'simpanan_pokok', 20000, NULL, NULL),
(70, 28, 'simpanan_wajib', 100000, NULL, NULL),
(71, 29, 'simpanan_wajib', 100000, NULL, NULL),
(72, 30, 'simpanan_wajib', 50000, NULL, NULL),
(73, 30, 'simpanan_sukarela', 100000, NULL, NULL),
(74, 31, 'simpanan_wajib', 50000, NULL, NULL),
(75, 31, 'simpanan_sukarela', 50000, NULL, NULL),
(76, 31, 'simpanan_pokok', 20000, NULL, NULL),
(77, 32, 'simpanan_sukarela', 50000, NULL, NULL),
(78, 33, 'simpanan_wajib', 50000, NULL, NULL),
(79, 33, 'simpanan_sukarela', 50000, NULL, NULL),
(80, 33, 'simpanan_pokok', 20000, NULL, NULL),
(81, 34, 'simpanan_wajib', 50000, NULL, NULL),
(82, 35, 'simpanan_wajib', 100000, NULL, NULL),
(83, 35, 'simpanan_sukarela', 20000, NULL, NULL),
(84, 35, 'simpanan_pokok', 20000, NULL, NULL),
(85, 36, 'simpanan_wajib', 100000, NULL, NULL),
(86, 37, 'simpanan_wajib', 50000, NULL, NULL),
(87, 38, 'simpanan_wajib', 50000, NULL, NULL),
(88, 39, 'simpanan_wajib', 50000, NULL, NULL),
(89, 40, 'simpanan_wajib', 50000, NULL, NULL),
(90, 40, 'simpanan_sukarela', 30000, NULL, NULL),
(91, 40, 'simpanan_pokok', 20000, NULL, NULL),
(92, 41, 'simpanan_wajib', 50000, NULL, NULL),
(93, 41, 'simpanan_sukarela', 50000, NULL, NULL),
(94, 41, 'simpanan_pokok', 20000, NULL, NULL),
(95, 42, 'simpanan_wajib', 20000, NULL, NULL),
(96, 42, 'simpanan_sukarela', 30000, NULL, NULL),
(97, 42, 'simpanan_pokok', 20000, NULL, NULL),
(98, 43, 'simpanan_wajib', 20000, NULL, NULL),
(99, 43, 'simpanan_sukarela', 20000, NULL, NULL),
(100, 43, 'simpanan_pokok', 20000, NULL, NULL),
(101, 44, 'simpanan_wajib', 20000, NULL, NULL),
(102, 44, 'simpanan_sukarela', 80000, NULL, NULL),
(103, 45, 'simpanan_wajib', 50000, NULL, NULL),
(104, 45, 'simpanan_sukarela', 100000, NULL, NULL),
(105, 46, 'saldo_koperasi', 2550000, NULL, NULL),
(106, 47, 'simpanan_wajib', 20000, NULL, NULL),
(107, 47, 'simpanan_sukarela', 10000, NULL, NULL),
(108, 89, 'tagihan_pinjaman', 120000, NULL, NULL),
(109, 48, 'saldo_koperasi', 2800000, NULL, NULL),
(110, 49, 'simpanan_wajib', 20000, NULL, NULL),
(111, 50, 'simpanan_wajib', 50000, NULL, NULL),
(112, 50, 'simpanan_pokok', 20000, NULL, NULL),
(113, 51, 'simpanan_wajib', 20000, NULL, NULL),
(114, 52, 'simpanan_wajib', 20000, NULL, NULL),
(115, 53, 'simpanan_wajib', 100000, NULL, NULL),
(116, 53, 'simpanan_sukarela', 10000, NULL, NULL),
(117, 53, 'simpanan_pokok', 20000, NULL, NULL),
(118, 54, 'simpanan_wajib', 20000, NULL, NULL),
(119, 54, 'simpanan_sukarela', 60000, NULL, NULL),
(120, 54, 'simpanan_pokok', 20000, NULL, NULL),
(121, 55, 'simpanan_wajib', 50000, NULL, NULL),
(122, 55, 'simpanan_sukarela', 20000, NULL, NULL),
(123, 56, 'simpanan_wajib', 50000, NULL, NULL),
(124, 57, 'simpanan_wajib', 50000, NULL, NULL),
(125, 58, 'simpanan_wajib', 100000, NULL, NULL),
(126, 59, 'simpanan_wajib', 50000, NULL, NULL),
(127, 60, 'simpanan_wajib', 20000, NULL, NULL),
(128, 60, 'simpanan_sukarela', 33333, NULL, NULL),
(129, 90, 'tagihan_pinjaman', 516667, NULL, NULL),
(130, 61, 'simpanan_wajib', 20000, NULL, NULL),
(131, 62, 'simpanan_wajib', 50000, NULL, NULL),
(132, 63, 'simpanan_wajib', 20000, NULL, NULL),
(133, 64, 'simpanan_wajib', 20000, NULL, NULL),
(134, 65, 'simpanan_wajib', 50000, NULL, NULL),
(135, 65, 'simpanan_sukarela', 100000, NULL, NULL),
(136, 66, 'simpanan_wajib', 50000, NULL, NULL),
(137, 67, 'simpanan_wajib', 50000, NULL, NULL),
(138, 67, 'simpanan_sukarela', 100000, NULL, NULL),
(139, 68, 'simpanan_wajib', 50000, NULL, NULL),
(140, 69, 'simpanan_wajib', 50000, NULL, NULL),
(141, 70, 'simpanan_wajib', 20000, NULL, NULL),
(142, 71, 'simpanan_wajib', 20000, NULL, NULL),
(143, 72, 'simpanan_wajib', 50000, NULL, NULL),
(144, 73, 'simpanan_wajib', 50000, NULL, NULL),
(145, 74, 'simpanan_wajib', 20000, NULL, NULL),
(146, 75, 'simpanan_wajib', 20000, NULL, NULL),
(147, 76, 'simpanan_wajib', 20000, NULL, NULL),
(148, 76, 'simpanan_sukarela', 30000, NULL, NULL),
(149, 91, 'tagihan_pinjaman', 120000, NULL, NULL),
(150, 77, 'simpanan_wajib', 20000, NULL, NULL),
(151, 78, 'simpanan_wajib', 50000, NULL, NULL),
(152, 79, 'simpanan_wajib', 50000, NULL, NULL),
(153, 80, 'simpanan_wajib', 20000, NULL, NULL),
(154, 81, 'simpanan_wajib', 20000, NULL, NULL),
(155, 82, 'simpanan_wajib', 50000, NULL, NULL),
(156, 92, 'tagihan_pinjaman', 289333, NULL, NULL),
(157, 83, 'simpanan_wajib', 50000, NULL, NULL),
(158, 93, 'tagihan_pinjaman', 373333, NULL, NULL),
(159, 84, 'simpanan_wajib', 100000, NULL, NULL),
(160, 85, 'simpanan_wajib', 100000, NULL, NULL),
(161, 86, 'simpanan_wajib', 50000, NULL, NULL),
(162, 86, 'simpanan_sukarela', 20000, NULL, NULL),
(163, 86, 'simpanan_pokok', 20000, NULL, NULL),
(164, 87, 'simpanan_wajib', 100000, NULL, NULL),
(165, 87, 'simpanan_sukarela', 30000, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pinjaman_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('simpanan','pinjaman','saldo_koperasi','min_saldo_koperasi') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'simpanan',
  `bukti_pembayaran` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `pinjaman_id`, `title`, `message`, `type`, `bukti_pembayaran`, `approved_date`, `created_at`, `updated_at`) VALUES
(1, 12, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-12 10:00:01', '2021-01-12 10:00:00', NULL),
(2, 11, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-12 10:00:02', '2021-01-12 10:00:00', NULL),
(3, 30, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-12 10:00:03', '2021-01-12 10:00:00', NULL),
(4, 20, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-12 10:00:04', '2021-01-12 10:00:00', NULL),
(5, 13, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-14 10:00:00', '2021-01-14 10:00:00', NULL),
(6, 3, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-15 10:00:00', '2021-01-15 10:00:00', NULL),
(7, 26, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-15 10:00:00', '2021-01-15 10:00:00', NULL),
(8, 23, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-15 10:00:00', '2021-01-15 10:00:00', NULL),
(9, 18, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-15 10:00:00', '2021-01-15 10:00:00', NULL),
(10, 19, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-15 10:00:00', '2021-01-15 10:00:00', NULL),
(11, 24, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-15 10:00:00', '2021-01-15 10:00:00', NULL),
(12, 16, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-15 10:00:00', '2021-01-15 10:00:00', NULL),
(13, 5, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-29 10:00:00', '2021-01-29 10:00:00', NULL),
(14, 29, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-29 10:00:00', '2021-01-29 10:00:00', NULL),
(15, 7, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-29 10:00:00', '2021-01-29 10:00:00', NULL),
(16, 31, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-29 10:00:00', '2021-01-29 10:00:00', NULL),
(17, 9, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-29 10:00:00', '2021-01-29 10:00:00', NULL),
(18, 22, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-29 10:00:00', '2021-01-29 10:00:00', NULL),
(19, 37, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-29 10:00:00', '2021-01-29 10:00:00', NULL),
(20, 24, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-29 10:00:00', '2021-01-29 10:00:00', NULL),
(21, 27, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-29 10:00:00', '2021-01-29 10:00:00', NULL),
(22, 1, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-29 10:00:00', '2021-01-29 10:00:00', NULL),
(23, 17, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-01-30 10:00:00', '2021-01-30 10:00:00', NULL),
(24, 13, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-03 10:00:00', '2021-02-03 10:00:00', NULL),
(25, 20, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-03 10:00:00', '2021-02-03 10:00:00', NULL),
(26, 14, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-03 10:00:00', '2021-02-03 10:00:00', NULL),
(27, 21, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-03 10:00:00', '2021-02-03 10:00:00', NULL),
(28, 14, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-03 10:00:00', '2021-02-03 10:00:00', NULL),
(29, 21, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-03 10:00:00', '2021-02-03 10:00:00', NULL),
(30, 30, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(31, 8, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(32, 8, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(33, 10, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(34, 10, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(35, 15, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(36, 15, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(37, 26, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(38, 23, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(39, 19, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(40, 25, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(41, 28, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(42, 4, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(43, 6, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(44, 18, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(45, 11, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(46, 1, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(47, 9, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-04 10:00:00', '2021-02-04 10:00:00', NULL),
(48, 1, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-08 10:00:00', '2021-02-08 10:00:00', NULL),
(49, 3, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-09 10:00:00', '2021-02-09 10:00:00', NULL),
(50, 34, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-18 10:00:00', '2021-02-18 10:00:00', NULL),
(51, 5, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-18 10:00:00', '2021-02-18 10:00:00', NULL),
(52, 17, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-18 10:00:00', '2021-02-18 10:00:00', NULL),
(53, 36, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-18 10:00:00', '2021-02-18 10:00:00', NULL),
(54, 32, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-18 10:00:00', '2021-02-18 10:00:00', NULL),
(55, 12, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-02-18 10:00:00', '2021-02-18 10:00:00', NULL),
(56, 26, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(57, 10, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(58, 15, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(59, 8, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(60, 20, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(61, 3, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(62, 19, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(63, 5, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(64, 17, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(65, 12, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(66, 11, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(67, 30, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(68, 13, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(69, 23, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(70, 18, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(71, 24, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(72, 16, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(73, 29, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(74, 7, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(75, 31, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(76, 9, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(77, 22, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(78, 25, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(79, 28, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(80, 4, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(81, 6, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(82, 33, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(83, 34, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(84, 14, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(85, 21, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-02 10:00:00', '2021-03-02 10:00:00', NULL),
(86, 35, NULL, 'invoice', '-', 'simpanan', 'image_lunas.png', '2021-03-03 10:00:00', '2021-03-03 10:00:00', NULL),
(87, 36, NULL, 'invoice', '', 'simpanan', 'image_lunas.png', '2021-03-03 10:00:00', '2021-03-03 10:00:00', NULL),
(88, 20, 1, 'invoice  pinjaman', '-', 'pinjaman', 'image_lunas.png', '2021-02-03 17:00:00', '2021-02-03 17:00:00', NULL),
(89, 9, 3, 'invoice pinjaman', '-', 'pinjaman', 'image_lunas.png', '2021-02-04 17:00:00', '2021-02-04 17:00:00', NULL),
(90, 20, 1, 'invoice pinjaman', 'NULL', 'pinjaman', 'image_lunas.png', '2021-03-02 17:00:00', '2021-03-02 17:00:00', NULL),
(91, 9, 3, 'invoice pinjaman', '-', 'pinjaman', 'image_lunas.png', '2021-03-02 17:00:00', '2021-03-02 17:00:00', NULL),
(92, 33, 4, 'invoice pinjaman', '-', 'pinjaman', 'image_lunas.png', '2021-03-02 17:00:00', '2021-03-02 17:00:00', NULL),
(93, 34, 5, 'invoice pinjaman', '-', 'pinjaman', 'image_lunas.png', '2021-03-02 17:00:00', '2021-03-02 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `no_id` bigint(20) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` bigint(20) NOT NULL,
  `pendidikan_id` bigint(20) UNSIGNED NOT NULL,
  `jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `user_level_id` bigint(20) UNSIGNED NOT NULL,
  `profile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `code`, `username`, `name`, `email`, `email_verified_at`, `no_id`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telp`, `pendidikan_id`, `jabatan_id`, `user_level_id`, `profile`, `active`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2020010000, 'admin', 'Admin', 'admin@admin.com', '2021-03-09 02:06:57', 1111111111111111, 'laki-laki', 'jakarta', '2000-03-24', '-', 89657341120, 4, 9, 1, NULL, 1, '$2y$10$IjXr29gHEAXkQmyo81XbPu5/ZUrtvGJ2gj75Q8PCvaDTZg99oVOIm', 'FRj2qScz6r', NULL, NULL),
(3, 2020010007, 'adit', 'Aditya Bayu Irawan', 'aditbay.ir@gmail.com', NULL, 3276021604960014, 'laki-laki', 'Bogor', '1996-04-16', 'Jalan Kemang Dalam II No 36 RT 02 RW 02 No 36, Sukatani, Tapos, Depok', 81210294688, 5, 9, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 00:15:37'),
(4, 2020010030, 'muzaeni', 'AHMAD MUZAENI', 'ghassani.ahmad12@gmail.com', NULL, 3171011606820001, 'laki-laki', 'JAKARTA', '1982-06-16', 'JL.KEBON JAHE 7 NO.17 RT.02 RW.12', 81384342747, 4, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 00:18:43'),
(5, 2020010014, 'syaiful', 'Ahmad Syaiful Akbar', 'ipulbelcram@gmail.com', NULL, 3174082403000005, 'laki-laki', 'Jakarta', '2000-03-24', 'Citayam Kp.Kelapa desa rawa panjang rt05/20 No.83', 89657341120, 5, 9, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 00:19:06'),
(6, 2020010031, 'nurul', 'AYU NURUL FITRIANI', 'ayunurul12@gmail.com', NULL, 3201135208890002, 'perempuan', 'Bogor', '1989-08-12', 'Kp. Bambon RT 01/07 No. 36 Ragajaya Bojong gede kab. Bogor 16920', 81315625933, 5, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 01:49:10'),
(7, 2020010016, 'syahputra', 'Bayu syahputra', 'abbay.xct05@gmail.com', NULL, 1274012205870002, 'laki-laki', 'Medan / tanjung balai', '1987-05-22', 'Jalan raya setu cileungsi', 81389211122, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 01:51:19'),
(8, 2020010027, 'sulaeman', 'Dede sulaeman', 'ahmadzaki100314@gmail.com', NULL, 3201031002830010, 'laki-laki', 'Bogor 10-02-1983', '1983-10-02', 'Kp sanja rt 005/001', 8991023373, 2, 10, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 01:53:38'),
(9, 2020010018, 'lestari', 'DEWI LESTARI', 'dewwilestari25@gmail.com', NULL, 3603126912810006, 'perempuan', 'Magetan', '1981-12-29', 'Jln. Raya sabililah kp. Dukuh ds pasir mukti citeureup bogor', 81283648369, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 01:54:44'),
(10, 2020010025, 'donny', 'DONNY SAPUTRA', 'opunkfals429@gmail.com', NULL, 3276020303960003, 'laki-laki', 'BOGOR', '1996-03-03', 'Jl kampung Cilangkap rt01rw03', 89699234328, 2, 10, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 01:55:31'),
(11, 2020010003, 'elya', 'Elya Herawati', 'llyapiliang680@gmail.com', NULL, 3201135010760012, 'perempuan', 'Jakarta', '1976-10-10', 'Kp sawah rt 1/8 no 55 bojong gede kab bogor', 81381010521, 4, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 01:57:27'),
(12, 2020010002, 'suryanih', 'Eva Suryanih', 'evasuryanih02@gmail.com', NULL, 3201134206760004, 'perempuan', 'Bogor', '1976-06-02', 'Kp sawah rt 01 RW 08,Bojonggede Bogor.', 85213776566, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 01:58:40'),
(13, 2020010006, 'ginda', 'Ginda Asrizal Hasibuan', 'ghindaghinda67@gmail.com', NULL, 3201036109940001, 'laki-laki', 'Medan', '1997-10-05', 'DS.leuwinutug rt02/02 kec.citereup kab.bogor', 82114892569, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:00:48'),
(14, 2020010023, 'lukas', 'LUKAS DAPA TALU', 'maezarouli@gmail.com', NULL, 3217061605750013, 'laki-laki', 'WAIKABUBAK', '1975-05-16', 'Cidahu Regency No 12 A', 81322708599, 1, 8, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 01:59:26'),
(15, 2020010026, 'sutrisno', 'MOHAMAD TRI SUTRISNO', 'navyasaharsutrisno@gmail.com', NULL, 3276102607970003, 'laki-laki', 'BANJAR NEGARA', '1997-07-26', 'KP. CIMPAEUN RT01/RW13, KEL.CIMPAEUN, KEC. TAPOS KOTA DEPOK', 81380466123, 3, 10, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:01:50'),
(16, 2020010013, 'yuliantini', 'Nina Yuliantini', 'Ninayuliantini10@gmail.com', NULL, 3201285007930003, 'perempuan', 'Bogor', '1993-07-10', 'Kp.cijeruk rt 03/rw 03', 81210784797, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 01:47:09'),
(17, 2020010021, 'hilmi', 'Nur Hilmi', 'nurhilmi.mail@gmail.com', NULL, 3173040410001001, 'laki-laki', 'Jakarta', '2000-10-04', 'Puri Artha Sentosa C6/25', 81911147742, 5, 9, 101, NULL, 1, '$2y$10$ZNyCLxjFIiKkTKo2Pi233eGeJEv2nGsZ2nIOu5FMPfW297bsEOhqu', NULL, NULL, '2021-03-10 00:33:10'),
(18, 2020010010, 'suwartinah', 'Retno Suwartinah', 'retnoanggora77@gmail.com', NULL, 1803095906950002, 'perempuan', 'Kotabumi', '1995-06-19', 'Jalam pemuda, Kampung Bojong Jati, RT/RW 002/016, Kel.Depok, kec.pancoran mas, Depok', 81384404626, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:02:55'),
(19, 2020010011, 'rivan', 'Rivan Launing', 'rivanv806@gmail.com', NULL, 3201010710920001, 'laki-laki', 'Bogor', '1992-10-07', 'Kp. Nanggewer Mekar RT 05 RW 02', 82129144502, 5, 9, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:05:03'),
(20, 2020010005, 'robertus', 'Robertus Sulistyo Ardi Nugroho', 'beartu62@gmail.com', NULL, 3201042203930002, 'laki-laki', 'Bogor', '1993-03-22', 'Kp Sidamukti RT 003/01 no 6 Sukamaju Cilodong Depok', 82116172693, 3, 9, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:04:44'),
(21, 2020010024, 'rosalina', 'ROSALINA ROLINA', 'maezarou@gmail.com', NULL, 3217064504760018, 'perempuan', 'Bandung', '1976-04-05', 'Cidahu Regency No 12 A', 81224898382, 6, 8, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:02:58'),
(22, 2020010019, 'henry', 'Ryan Henry Sipahelut', 'Teredanryan@gmail.com', NULL, 3276051706860006, 'laki-laki', 'Depok', '1987-06-17', 'Puri Bukit Depok blok P6/17. Sasak panjang, Tajurhalang. Kabupaten Bogor', 82111313665, 5, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 01:50:34'),
(23, 2020010009, 'sawalludin', 'Sawalludin pulungan', 'Sawaljjn30@gmail.com', NULL, 3201312907020003, 'laki-laki', 'Bogor', '2002-07-29', 'Jl ciapus gg purnama rt01 rw02 desa sukamantri kecamatan tamansari Kabupaten bogor', 85156474429, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:05:54'),
(24, 2020010012, 'shella', 'Shella fadillah s', 'Shelyank.only@gmail.com', NULL, 3276056701880009, 'perempuan', 'Jakarta', '1988-01-27', 'Jl proklamasi raya blok 9 no 3 depok 2 tengah 16411', 81210706588, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:05:33'),
(25, 2020010028, 'kuwarti', 'Sri kuwarti sulis tyo utami', 'Kuwarti19@gmail.com', NULL, 3174025905810001, 'perempuan', 'Jakarta', '1981-05-19', 'Kp parung belimbing rt2/17 kel depok kec pancoran mas kota depok', 81284102544, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:10:44'),
(26, 2020010008, 'syahril', 'SYAHRIL PULUNGAN', 'sahrilpulungan1@gmail.com', NULL, 3201311810920001, 'laki-laki', 'BOGOR', '1992-10-18', 'BOGOR,KP CIMANGGLID RT 01 RW 02 KECAMATAN TAMANSARI (CIAPUS)', 82279775864, 3, 10, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:01:25'),
(27, 2020010020, 'theresia', 'Theresia Methania', 'theresia.metania@gmail.com', NULL, 3276104304820003, 'perempuan', 'palembang', '1982-03-04', 'griya telaga permai, blok e2 no.5, jalan raya bogor km.40,7 cilangkap, tapos, depok', 81314555975, 5, 8, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 01:51:22'),
(28, 2020010029, 'wahyudin', 'WAHYUDIN', 'wdin24375@gmail.com', NULL, 3201131604770005, 'laki-laki', 'BOGOR', '1977-04-16', 'Kp.kelapa rt.03/18 rawa panjang kec.bojonggede', 81283843300, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:11:22'),
(29, 2020010015, 'wildan', 'WILDAN ALFATH GHANI', 'wildanghani@gmail.com', NULL, 3174090308990004, 'laki-laki', 'DEPOK', '1999-08-03', 'Perum. Puri Bukit Depok blok O10/7 RT 15/10 Sasakpanjang Tajur halang, Kab. Bogor', 89521752015, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 01:49:52'),
(30, 2020010004, 'yusuf', 'Yusuf setiana', 'annatea84@gmail.com', NULL, 3276100907840002, 'laki-laki', 'Garut', '1984-07-09', 'Kp jatijajar no.17 rt. 08/01 jatijajar tapos depok', 82111883424, 4, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:11:49'),
(31, 2020010017, 'zuhriyanti', 'Zuhriyanti', 'yantizy72@gmail.com', NULL, 3175094507720028, 'perempuan', 'Jakarta', '1972-07-05', 'Jln. Masjid fathul ghofur gg. TijahRt 03/04 no. 58 cibubur ciracas jaktim', 81310753406, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:12:21'),
(32, 2020010035, 'arni', 'Arni pusporini', 'arnipusporini@gmail.com', NULL, 3201376805000002, 'perempuan', 'Jakarta', '2000-05-28', 'Perumahan Puri bukit Depok blok t5 no 13 sasakpanjang Tajurhalang kab Bogor', 81211096027, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:02:05'),
(33, 2020010032, 'saprudin', 'Hari Saprudin', 'harisaprudin2@gmail.com', NULL, 3276020803860009, 'laki-laki', 'Bogor', '1986-03-08', 'Cilangkap kp nyencle rt 03/12 kec tapos kota depok', 81219470688, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:14:42'),
(34, 2020010033, 'rifki', 'RIFKI SUHARLAN', 'Suharlanrifki@gmail.com', NULL, 3171071307840006, 'laki-laki', 'Jakarta', '1984-07-13', 'JL.SABENI RAYA NO.10 RT012/12 KEBON MELATI TANAH ABANG JAKARTA PUSAT', 87786436495, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:13:00'),
(35, 2020010036, 'dian_kusuma', 'RIZKI DIAN KUSUMA PRADANA', 'rizkikusumapradana@gmail.com', NULL, 3521091106910004, 'laki-laki', 'TUBAN', '1991-06-11', 'Jl tanah tinggi gang moh ali 1 no 9 rt 08 rw 03 tanah tinggi johar baru jakarta pusat', 85890377190, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 01:56:21'),
(36, 2020010034, 'rustam', 'RUSTAM YULIANTO', 'rustamyulian99@gmail.com', NULL, 3276021807820011, 'laki-laki', 'BOGOR', '1982-07-18', 'Kp.kelapa dua GG belimbing 3 RT 04/09 no.57 Kel Tugu kec Cimanggis Depok', 81318158939, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, '2021-03-10 02:05:23'),
(37, 2020010037, 'dimas', 'Dimas Dwi Syahputra', 'dimas@gmail.com', NULL, 1111111111111119, 'laki-laki', 'Bogor', '1982-07-18', 'alamat', 33333333333, 3, 11, 101, NULL, 1, '$2y$10$nh7XJYsv2cQmbkTMxnmuP.SaEsFtHGQpjYR2E7iCnubU.yiU4uNMW', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_koperasi_details`
--

CREATE TABLE `user_koperasi_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status_keluarga_id` bigint(20) UNSIGNED NOT NULL,
  `nama_ahliwaris` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `besar_simpanan_wajib` bigint(20) NOT NULL,
  `upload_ktp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo_simpanan` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_koperasi_details`
--

INSERT INTO `user_koperasi_details` (`id`, `user_id`, `status_keluarga_id`, `nama_ahliwaris`, `besar_simpanan_wajib`, `upload_ktp`, `saldo_simpanan`) VALUES
(1, 1, 12, 'juminto', 20000, 'ktp.jpg', 0),
(3, 3, 14, 'Orang Tua', 20000, 'IMG_20200414_223325 - Aditya Bayu Irawan.jpg', 70000),
(4, 4, 12, 'GHASSANI HAMIZAH AHMAD, MISHALL AZKADINA AHMAD, NAZNIN KHAIRA AHMAD', 20000, 'IMG_20210114_153702 - Ghassani Hamizah Ahmad.jpg', 70000),
(5, 5, 14, 'Juminto', 20000, 'KTP - Ahmad Syaiful Akbar.jpg', 60000),
(6, 6, 13, 'Nadine Anindita Keana', 20000, 'photo_2021-03-10_15-42-57.jpg', 60000),
(7, 7, 12, 'Arbani Samoris', 20000, 'photo_2021-03-10_15-44-39.jpg', 60000),
(8, 8, 12, 'Ahmad zakky sulaeman', 50000, 'photo_2021-03-10_15-44-04.jpg', 200000),
(9, 9, 13, 'Argya mahardika satriani', 20000, 'photo_2021-03-10_15-45-43.jpg', 110000),
(10, 10, 12, 'Srinuraini', 50000, 'photo_2021-03-10_15-45-35.jpg', 200000),
(11, 11, 13, 'Desta putri harahap', 50000, 'photo_2021-03-10_15-45-10.jpg', 280000),
(12, 12, 12, 'Haerunisa ardana', 50000, 'photo_2021-03-10_15-44-22.jpg', 300000),
(13, 13, 14, 'Masrohani daulay', 50000, 'photo_2021-03-10_15-45-02.jpg', 200000),
(14, 14, 12, 'Gabriel Le Rato Talu', 100000, 'ktp lukas.jpg', 330000),
(15, 15, 12, 'NAVYA SAHAR SUTRISNO', 100000, 'photo_2021-03-10_15-45-06.jpg', 320000),
(16, 16, 13, 'Maulidana yusuf', 50000, '1610677507523-473002419 - Nina Yuliantini.jpg', 130000),
(17, 17, 14, 'Fajar Dewi', 20000, 'KTP.jpg', 60000),
(18, 18, 13, 'Zaura Noventy Pramono', 20000, 'photo_2021-03-10_15-44-57.jpg', 140000),
(19, 19, 12, 'Ela Nurlaela', 50000, 'photo_2021-01-14_17-19-26 - Rivan L.jpg', 180000),
(20, 20, 14, 'Adrianus Danu Setyo Nugroho', 20000, 'photo_2021-03-10_15-44-42.jpg', 136667),
(21, 21, 13, 'Gabriel Le Rato Talu', 100000, 'ktp rosalina.jpg', 380000),
(22, 22, 12, 'Andre Henryan Sipahelut', 20000, 'IMG_20200703_143720_718 - Ryan HS.jpg', 50000),
(23, 23, 14, 'Asri Pulungan', 50000, 'photo_2021-03-10_15-41-05.jpg', 150000),
(24, 24, 12, 'Muhammad Irfad Mutaqqin', 20000, 'IMG_20201103_103840_536 - shella fadillah.jpg', 100000),
(25, 25, 13, 'Farah syifa ramadhina', 50000, 'photo_2021-03-10_15-45-40.jpg', 130000),
(26, 26, 12, 'ROCHMANIA', 50000, 'IMG_20210113_163231_897 - Syahril Pulungan.jpg', 150000),
(27, 27, 12, 'Wigy, karl, Gio, Lowell', 50000, 'ktp meta nu life - Theresia Metania.jpg', 100000),
(28, 28, 12, 'Siti khodijah', 50000, 'photo_2021-03-10_15-45-22.jpg', 150000),
(29, 29, 14, '-', 50000, '0001 - wildan ghani.jpg', 120000),
(30, 30, 12, 'Anjaryani', 50000, 'photo_2021-03-10_15-45-30.jpg', 380000),
(31, 31, 12, 'Muhamad Alif Nurmansyah', 20000, 'photo_2021-03-10_15-44-07.jpg', 150000),
(32, 32, 14, 'Ahmad rahmat', 20000, 'IMG-20191125-WA0016 - Arniii Pusporini.jpg', 80000),
(33, 33, 12, 'Hasbi', 50000, 'photo_2021-03-10_15-44-29.jpg', 50000),
(34, 34, 12, 'PUTRA ADITYA PRATAMA', 50000, 'photo_2021-03-10_15-44-54.jpg', 100000),
(35, 35, 12, 'YUSUF ALWI FARIZKI', 50000, 'Screenshot_2021-02-27-21-00-27-289_com.google.android.apps.photos - Rizki Ganteng.jpg', 70000),
(36, 36, 14, 'RUSTAM', 100000, 'photo_2021-03-10_15-44-11.jpg', 240000),
(37, 37, 14, 'DIMAS', 20000, '-', 30000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_levels`
--

CREATE TABLE `user_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_levels`
--

INSERT INTO `user_levels` (`id`, `level`) VALUES
(1, 'super admin'),
(100, 'admin'),
(101, 'member');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vw_user_transaction`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vw_user_transaction` (
`user_id` bigint(20) unsigned
,`code` bigint(20) unsigned
,`transactions_id` bigint(20) unsigned
,`pinjaman_id` bigint(20) unsigned
,`type_transaction` enum('simpanan','pinjaman','saldo_koperasi','min_saldo_koperasi')
,`transaction_approved_date` timestamp
,`transaction_created_at` timestamp
,`sub_transactions_id` bigint(20) unsigned
,`type_sub_transaction` enum('simpanan_sukarela','simpanan_wajib','simpanan_pokok','tagihan_pinjaman','saldo_koperasi','min_saldo_koperasi')
,`besaran` bigint(20)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_user_transaction`
--
DROP TABLE IF EXISTS `vw_user_transaction`;

CREATE ALGORITHM=UNDEFINED DEFINER=`lekh6399_koperasi`@`localhost` SQL SECURITY DEFINER VIEW `vw_user_transaction`  AS  select `a`.`id` AS `user_id`,`a`.`code` AS `code`,`b`.`id` AS `transactions_id`,`b`.`pinjaman_id` AS `pinjaman_id`,`b`.`type` AS `type_transaction`,`b`.`approved_date` AS `transaction_approved_date`,`b`.`created_at` AS `transaction_created_at`,`c`.`id` AS `sub_transactions_id`,`c`.`type` AS `type_sub_transaction`,`c`.`besaran` AS `besaran` from (`sub_transactions` `c` left join (`transactions` `b` left join `users` `a` on(`a`.`id` = `b`.`user_id`)) on(`b`.`id` = `c`.`transaction_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `main_settings`
--
ALTER TABLE `main_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `params`
--
ALTER TABLE `params`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pinjaman_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sub_transactions`
--
ALTER TABLE `sub_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_transactions_transaction_id_foreign` (`transaction_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_pinjaman_id_foreign` (`pinjaman_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_code_unique` (`code`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_no_id_unique` (`no_id`),
  ADD KEY `users_user_level_id_foreign` (`user_level_id`),
  ADD KEY `users_pendidikan_id_foreign` (`pendidikan_id`),
  ADD KEY `users_jabatan_id_foreign` (`jabatan_id`);

--
-- Indeks untuk tabel `user_koperasi_details`
--
ALTER TABLE `user_koperasi_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_koperasi_details_user_id_foreign` (`user_id`),
  ADD KEY `user_koperasi_details_status_keluarga_id_foreign` (`status_keluarga_id`);

--
-- Indeks untuk tabel `user_levels`
--
ALTER TABLE `user_levels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `main_settings`
--
ALTER TABLE `main_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `params`
--
ALTER TABLE `params`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `sub_transactions`
--
ALTER TABLE `sub_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `user_koperasi_details`
--
ALTER TABLE `user_koperasi_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `user_levels`
--
ALTER TABLE `user_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD CONSTRAINT `pinjaman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_transactions`
--
ALTER TABLE `sub_transactions`
  ADD CONSTRAINT `sub_transactions_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_pinjaman_id_foreign` FOREIGN KEY (`pinjaman_id`) REFERENCES `pinjaman` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `params` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_pendidikan_id_foreign` FOREIGN KEY (`pendidikan_id`) REFERENCES `params` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_user_level_id_foreign` FOREIGN KEY (`user_level_id`) REFERENCES `user_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_koperasi_details`
--
ALTER TABLE `user_koperasi_details`
  ADD CONSTRAINT `user_koperasi_details_status_keluarga_id_foreign` FOREIGN KEY (`status_keluarga_id`) REFERENCES `params` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_koperasi_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
