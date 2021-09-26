-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 14, 2021 at 10:14 AM
-- Server version: 5.7.35-log
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magangpe_monitoring_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_bimbingan`
--

CREATE TABLE `data_bimbingan` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `dosenpembimbing_id` int(11) DEFAULT NULL,
  `dosenpembimbing2_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pembimbingindustri_id` int(11) DEFAULT NULL,
  `mulai_magang` date DEFAULT NULL,
  `selesai_magang` date DEFAULT NULL,
  `jenis_pekerjaan` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_bimbingan`
--

INSERT INTO `data_bimbingan` (`id`, `mahasiswa_id`, `dosenpembimbing_id`, `dosenpembimbing2_id`, `pembimbingindustri_id`, `mulai_magang`, `selesai_magang`, `jenis_pekerjaan`, `created_at`, `updated_at`) VALUES
(10, 24, 16, 18, 11, '2021-07-03', '2021-08-03', 'xxx xxx1', '2021-07-22 07:00:37', '2021-07-22 07:00:37'),
(11, 83, 18, 24, 11, '2021-09-07', '2021-10-03', 'xxx xxx1', '2021-09-07 02:22:41', '2021-09-07 02:22:41'),
(12, 82, 18, 22, 11, '2021-07-03', '2021-08-03', 'xxx xxx1', '2021-07-22 06:58:33', '2021-07-22 06:58:33'),
(14, 36, 9, 27, 11, '2021-07-05', '2021-07-31', NULL, '2021-07-22 08:27:06', '2021-07-22 08:27:06'),
(15, 80, 18, 17, 11, '2021-07-01', '2021-08-01', 'salto walik', '2021-07-22 06:56:19', '2021-07-22 06:56:19'),
(17, 94, 22, 23, NULL, '2021-07-21', '2022-07-20', NULL, '2021-07-22 06:23:08', '2021-07-22 06:23:08'),
(18, 98, 23, 16, NULL, '2021-07-21', '2022-07-20', NULL, '2021-07-22 06:24:58', '2021-07-22 06:24:58'),
(19, 73, 16, 22, NULL, NULL, NULL, NULL, '2021-07-22 06:48:24', '2021-07-22 06:48:24'),
(20, 78, 17, 24, NULL, NULL, NULL, NULL, '2021-07-22 06:48:46', '2021-07-22 06:48:46'),
(21, 90, 22, 21, NULL, NULL, NULL, NULL, '2021-07-22 06:49:16', '2021-07-22 06:49:16'),
(22, 91, 22, 18, NULL, NULL, NULL, NULL, '2021-07-22 06:49:47', '2021-07-22 06:49:47'),
(23, 95, 23, 21, NULL, NULL, NULL, NULL, '2021-07-22 06:50:18', '2021-07-22 06:50:18'),
(24, 99, 23, 16, NULL, NULL, NULL, NULL, '2021-07-22 06:51:48', '2021-07-22 06:51:48'),
(25, 75, 17, 16, NULL, NULL, NULL, NULL, '2021-07-22 06:52:16', '2021-07-22 06:52:16'),
(26, 87, 18, 23, NULL, NULL, NULL, NULL, '2021-07-22 06:52:51', '2021-07-22 06:52:51'),
(27, 79, 17, 22, NULL, NULL, NULL, NULL, '2021-07-22 06:53:46', '2021-07-22 06:53:46'),
(28, 74, 16, 17, NULL, NULL, NULL, NULL, '2021-07-22 06:54:10', '2021-07-22 06:54:10'),
(29, 77, 17, 23, NULL, NULL, NULL, NULL, '2021-07-22 06:54:34', '2021-07-22 06:54:34'),
(30, 84, 21, 18, NULL, NULL, NULL, NULL, '2021-07-22 06:55:03', '2021-07-22 06:55:03'),
(31, 51, 12, 13, NULL, NULL, NULL, NULL, '2021-07-22 06:55:07', '2021-07-22 06:55:07'),
(32, 81, 18, 23, NULL, NULL, NULL, NULL, '2021-07-22 06:55:32', '2021-07-22 06:55:32'),
(33, 89, 21, 17, NULL, NULL, NULL, NULL, '2021-07-22 06:55:54', '2021-07-22 06:55:54'),
(34, 56, 13, 15, NULL, NULL, NULL, NULL, '2021-07-22 06:55:57', '2021-07-22 06:55:57'),
(35, 65, 12, 14, NULL, NULL, NULL, NULL, '2021-07-22 06:56:21', '2021-07-22 06:56:21'),
(36, 59, 13, 12, NULL, NULL, NULL, NULL, '2021-07-22 06:56:39', '2021-07-22 06:56:39'),
(37, 72, 16, 21, NULL, NULL, NULL, NULL, '2021-07-22 06:56:51', '2021-07-22 06:56:51'),
(38, 58, 20, 13, NULL, NULL, NULL, NULL, '2021-07-22 06:56:55', '2021-07-22 06:56:55'),
(39, 64, 14, 25, NULL, NULL, NULL, NULL, '2021-07-22 06:57:14', '2021-07-22 06:57:14'),
(40, 67, 15, 14, NULL, NULL, NULL, NULL, '2021-07-22 06:57:29', '2021-07-22 06:57:29'),
(41, 93, 22, 21, NULL, NULL, NULL, NULL, '2021-07-22 06:57:33', '2021-07-22 06:57:33'),
(42, 97, 23, 21, NULL, NULL, NULL, NULL, '2021-07-22 06:58:00', '2021-07-22 06:58:00'),
(43, 61, 14, 20, NULL, NULL, NULL, NULL, '2021-07-22 06:58:33', '2021-07-22 06:58:33'),
(44, 63, 14, 13, NULL, NULL, NULL, NULL, '2021-07-22 06:58:52', '2021-07-22 06:58:52'),
(45, 96, 23, 18, NULL, NULL, NULL, NULL, '2021-07-22 06:59:06', '2021-07-22 06:59:06'),
(46, 70, 15, 25, NULL, NULL, NULL, NULL, '2021-07-22 06:59:10', '2021-07-22 06:59:10'),
(47, 53, 12, 20, NULL, NULL, NULL, NULL, '2021-07-22 06:59:29', '2021-07-22 06:59:29'),
(48, 92, 22, 23, NULL, NULL, NULL, NULL, '2021-07-22 06:59:30', '2021-07-22 06:59:30'),
(49, 60, 13, 25, NULL, NULL, NULL, NULL, '2021-07-22 06:59:46', '2021-07-22 06:59:46'),
(50, 86, 21, 22, NULL, NULL, NULL, NULL, '2021-07-22 06:59:56', '2021-07-22 06:59:56'),
(51, 62, 14, 25, NULL, NULL, NULL, NULL, '2021-07-22 07:00:15', '2021-07-22 07:00:15'),
(52, 66, 20, 25, NULL, NULL, NULL, NULL, '2021-07-22 07:00:33', '2021-07-22 07:00:33'),
(53, 69, 15, 25, NULL, NULL, NULL, NULL, '2021-07-22 07:00:50', '2021-07-22 07:00:50'),
(54, 76, 17, 16, NULL, NULL, NULL, NULL, '2021-07-22 07:00:59', '2021-07-22 07:00:59'),
(55, 57, 13, 25, NULL, NULL, NULL, NULL, '2021-07-22 07:01:06', '2021-07-22 07:01:06'),
(56, 25, 12, 15, NULL, NULL, NULL, NULL, '2021-07-22 07:01:22', '2021-07-22 07:01:22'),
(57, 88, 21, 22, NULL, NULL, NULL, NULL, '2021-07-22 07:01:33', '2021-07-22 07:01:33'),
(58, 55, 20, 12, NULL, NULL, NULL, NULL, '2021-07-22 07:01:38', '2021-07-22 07:01:38'),
(59, 68, 15, 12, NULL, NULL, NULL, NULL, '2021-07-22 07:01:52', '2021-07-22 07:01:52'),
(60, 22, 16, 24, NULL, NULL, NULL, NULL, '2021-07-22 07:02:12', '2021-07-22 07:02:12'),
(61, 52, 14, 12, NULL, NULL, NULL, NULL, '2021-07-22 07:02:13', '2021-07-22 07:02:13'),
(62, 54, 20, 25, NULL, NULL, NULL, NULL, '2021-07-22 07:02:29', '2021-07-22 07:02:29'),
(63, 85, 21, 17, NULL, NULL, NULL, NULL, '2021-07-22 07:02:31', '2021-07-22 07:02:31'),
(64, 71, 15, 20, NULL, NULL, NULL, NULL, '2021-07-22 07:05:09', '2021-07-22 07:05:09'),
(65, 20, 8, 29, NULL, NULL, NULL, NULL, '2021-07-22 08:21:10', '2021-07-22 08:21:10'),
(66, 23, 8, 26, NULL, NULL, NULL, NULL, '2021-07-22 08:29:44', '2021-07-22 08:29:44'),
(67, 28, 28, 8, NULL, NULL, NULL, NULL, '2021-07-22 08:22:08', '2021-07-22 08:22:08'),
(68, 30, 28, 8, NULL, NULL, NULL, NULL, '2021-07-22 08:22:31', '2021-07-22 08:22:31'),
(69, 29, 9, 8, NULL, NULL, NULL, NULL, '2021-07-22 07:39:00', '2021-07-22 07:39:00'),
(70, 39, 10, 29, NULL, NULL, NULL, NULL, '2021-07-22 08:21:30', '2021-07-22 08:21:30'),
(71, 40, 10, 11, NULL, NULL, NULL, NULL, '2021-07-22 07:53:20', '2021-07-22 07:53:20'),
(72, 41, 10, 27, NULL, NULL, NULL, NULL, '2021-07-22 08:27:54', '2021-07-22 08:27:54'),
(73, 42, 10, 26, NULL, NULL, NULL, NULL, '2021-07-22 08:29:54', '2021-07-22 08:29:54'),
(74, 37, 10, 9, NULL, NULL, NULL, NULL, '2021-07-22 07:42:26', '2021-07-22 07:42:26'),
(75, 38, 29, 10, NULL, NULL, NULL, NULL, '2021-07-22 08:20:11', '2021-07-22 08:20:11'),
(76, 43, 29, 10, NULL, NULL, NULL, NULL, '2021-07-22 08:20:39', '2021-07-22 08:20:39'),
(77, 31, 9, 10, NULL, NULL, NULL, NULL, '2021-07-22 07:35:38', '2021-07-22 07:35:38'),
(78, 34, 9, 27, NULL, NULL, NULL, NULL, '2021-07-22 08:27:17', '2021-07-22 08:27:17'),
(79, 33, 9, 26, NULL, NULL, NULL, NULL, '2021-07-22 08:29:20', '2021-07-22 08:29:20'),
(80, 32, 29, 9, NULL, NULL, NULL, NULL, '2021-07-22 08:20:54', '2021-07-22 08:20:54'),
(81, 35, 27, 9, NULL, NULL, NULL, NULL, '2021-07-22 08:23:37', '2021-07-22 08:23:37'),
(82, 49, 11, 28, NULL, NULL, NULL, NULL, '2021-07-22 08:36:39', '2021-07-22 08:36:39'),
(83, 45, 11, 26, NULL, NULL, NULL, NULL, '2021-07-22 08:29:32', '2021-07-22 08:29:32'),
(84, 50, 11, 26, NULL, NULL, NULL, NULL, '2021-07-22 08:30:10', '2021-07-22 08:30:10'),
(85, 48, 8, 11, NULL, NULL, NULL, NULL, '2021-07-22 08:52:33', '2021-07-22 08:52:33'),
(86, 44, 28, 11, NULL, NULL, NULL, NULL, '2021-07-22 08:21:50', '2021-07-22 08:21:50'),
(87, 46, 27, 11, NULL, NULL, NULL, NULL, '2021-07-22 08:26:48', '2021-07-22 08:26:48'),
(88, 27, 28, 29, NULL, NULL, NULL, NULL, '2021-07-22 08:53:16', '2021-07-22 08:53:16'),
(89, 47, 28, 26, NULL, NULL, NULL, NULL, '2021-07-22 08:53:35', '2021-07-22 08:53:35'),
(90, 26, 27, 29, NULL, NULL, NULL, NULL, '2021-07-22 08:53:03', '2021-07-22 08:53:03');

-- --------------------------------------------------------

--
-- Table structure for table `data_kompetensi`
--

CREATE TABLE `data_kompetensi` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `jurusan` varchar(191) DEFAULT NULL,
  `capaian_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kompetensi`
--

INSERT INTO `data_kompetensi` (`id`, `mahasiswa_id`, `jurusan`, `capaian_id`, `created_at`, `updated_at`) VALUES
(5, 36, 'Teknologi Geologi', 7, '2021-07-05 03:30:29', '0000-00-00 00:00:00'),
(6, 36, 'Teknologi Geologi', 7, '2021-07-05 03:34:26', '0000-00-00 00:00:00'),
(7, 83, 'Teknologi Pertambangan', 1, '2021-07-06 01:53:24', '0000-00-00 00:00:00'),
(8, 83, 'Teknologi Pertambangan', 1, '2021-07-06 04:55:20', '0000-00-00 00:00:00'),
(9, 36, 'Teknologi Geologi', 7, '2021-07-16 07:57:38', '0000-00-00 00:00:00'),
(10, 83, 'Teknologi Pertambangan', 1, '2021-07-24 13:26:54', '0000-00-00 00:00:00'),
(11, 83, 'Teknologi Pertambangan', 1, '2021-07-24 13:27:06', '0000-00-00 00:00:00'),
(12, 83, 'Teknologi Pertambangan', 4, '2021-07-25 14:17:48', '0000-00-00 00:00:00'),
(13, 83, 'Teknologi Pertambangan', 1, '2021-07-25 14:19:51', '0000-00-00 00:00:00'),
(14, 83, 'Teknologi Pertambangan', 5, '2021-09-07 02:38:36', '0000-00-00 00:00:00'),
(15, 83, 'Teknologi Pertambangan', 3, '2021-09-07 09:32:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `data_laporan`
--

CREATE TABLE `data_laporan` (
  `id` int(11) NOT NULL,
  `id_data_bimbingan` int(11) DEFAULT NULL,
  `capaian_id` int(10) UNSIGNED DEFAULT NULL,
  `tanggal_laporan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kegiatan_pekerjaan` varchar(191) DEFAULT NULL,
  `deskripsi_pekerjaan` text,
  `durasi` int(11) DEFAULT NULL,
  `output` varchar(191) DEFAULT NULL,
  `approve_dosen` enum('mengamati','mengikuti','terampil','pending') NOT NULL DEFAULT 'pending',
  `approve_dosen2` enum('mengamati','mengikuti','terampil','pending') NOT NULL DEFAULT 'pending',
  `approve_industri` enum('mengamati','mengikuti','terampil','pending') NOT NULL DEFAULT 'pending',
  `status_laporan` enum('approve','rejected','pending') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_laporan`
--

INSERT INTO `data_laporan` (`id`, `id_data_bimbingan`, `capaian_id`, `tanggal_laporan`, `kegiatan_pekerjaan`, `deskripsi_pekerjaan`, `durasi`, `output`, `approve_dosen`, `approve_dosen2`, `approve_industri`, `status_laporan`, `created_at`, `updated_at`) VALUES
(16, 14, 7, '2021-07-16 07:57:38', 'Melakluakn pemantauan', 'Peledakan di lapangan terbang Gunung kidul', 5, 'lapangan terbang hilang', 'mengamati', 'mengamati', 'mengamati', 'approve', '2021-07-05 02:58:59', '2021-07-16 07:57:38'),
(17, 11, 1, '2021-07-24 13:26:54', 'mencoba menulis', 'lorem ipsum', 7, 'met si dolor', 'terampil', 'terampil', 'mengikuti', 'approve', '2021-07-05 16:34:20', '2021-07-24 13:26:54'),
(18, 11, 1, '2021-07-24 13:27:06', 'mencoba menulis part 2', 'mencangkul', 6, 'mampu mencangkul', 'mengamati', 'terampil', 'terampil', 'approve', '2021-07-06 04:36:45', '2021-07-24 13:27:06'),
(19, 11, 1, '2021-07-25 14:19:51', 'mencangkul', 'mencangkul adalah bla bla bla', 4, 'mencangkul tanah', 'terampil', 'mengikuti', 'mengamati', 'approve', '2021-07-19 03:17:23', '2021-07-25 14:19:51'),
(20, 11, 4, '2021-07-25 14:17:48', 'mengebor', 'mengebor adalah...', 3, 'mengebor', 'terampil', 'terampil', 'terampil', 'approve', '2021-07-25 14:13:46', '2021-07-25 14:17:48'),
(21, 11, 5, '2021-09-07 02:38:36', 'mencangkul', '1232eaweasdasd123123123', 4, 'mencangkul tanah', 'mengamati', 'terampil', 'terampil', 'approve', '2021-09-07 02:24:17', '2021-09-07 02:38:36'),
(22, 11, 3, '2021-09-07 09:32:33', 'mencangkul', '123qwaeawdasdasdagfasfafsafasf', 3, 'mencangkul tanah', 'mengikuti', 'mengamati', 'terampil', 'approve', '2021-09-07 09:22:08', '2021-09-07 09:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `dosenpembimbing`
--

CREATE TABLE `dosenpembimbing` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `gelar_depan` varchar(191) DEFAULT NULL,
  `nama` varchar(191) DEFAULT NULL,
  `gelar_belakang` varchar(191) DEFAULT NULL,
  `nidn` int(11) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `jk` varchar(191) DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosenpembimbing`
--

INSERT INTO `dosenpembimbing` (`id`, `user_id`, `gelar_depan`, `nama`, `gelar_belakang`, `nidn`, `email`, `jk`, `avatar`, `created_at`, `updated_at`) VALUES
(8, 31, 'Ir.', 'Sabtanto Joko', 'M.T', 12345, 'sabtanto.suprapto@esdm.go.id', 'Laki-Laki', NULL, '2021-06-17 07:28:05', '2021-05-18 01:04:02'),
(9, 32, 'Dr.', 'Adang Saputra', 'S.Si.Komp., M.Si.', 12345, 'adang.saputra@esdm.go.id', 'Laki-Laki', NULL, '2021-06-17 07:28:12', '2021-05-18 01:06:02'),
(10, 33, NULL, 'Dadan Wildan', 'S.T. , M.Si', 12345, 'dadan.wildan@esdm.go.id', 'Laki-Laki', NULL, '2021-06-17 07:28:26', '2021-05-18 01:06:45'),
(11, 34, NULL, 'Fiati Nurmaya', 'S.T. , M.T.', 12345, 'fiati.nurmaya@esdm.go.id', 'Perempuan', NULL, '2021-06-17 07:28:40', '2021-05-18 01:07:22'),
(12, 35, 'Dr. mont.', 'Imelda Hutabarat', 'S.T. , M.T.', 12345, 'imelda.hutabarat@esdm.go.id', 'Perempuan', NULL, '2021-06-17 07:28:55', '2021-05-18 01:08:14'),
(13, 36, 'Drs.', 'Wahid Sugiman', 'M.T', 12345, 'wahid.sugiman@esdm.go.id', 'Laki-Laki', NULL, '2021-06-17 07:29:24', '2021-05-18 01:08:49'),
(14, 37, 'Dr. forest.', 'Tedi Yunanto', 'S.Hut. , M.Si', 12345, 'tedi.yunanto@esdm.go.id', 'Laki-Laki', NULL, '2021-06-17 07:29:40', '2021-05-18 01:09:34'),
(15, 38, NULL, 'Denny Lumban Raja', 'S.Kom., M.T', 12345, 'denny.raja@esdm.go.id', 'Laki-Laki', NULL, '2021-06-17 07:29:51', '2021-05-18 01:10:03'),
(16, 39, 'Ir.', 'Suparno', 'M.Si.', 2147483647, 'suparno.031961@esdm.go.id', 'Laki-Laki', NULL, '2021-07-22 06:04:37', '2021-07-22 06:04:37'),
(17, 40, 'Dr.', 'Asep Rohman', 'S.T., M.T', 2147483647, 'asep.rohman@esdm.go.id', 'Laki-Laki', NULL, '2021-07-22 06:03:10', '2021-07-22 06:03:10'),
(18, 41, NULL, 'Rochsyid Anggara', 'S.T. , M.T.', 2147483647, 'rochsyid.anggara@esdm.go.id', 'Laki-Laki', NULL, '2021-07-22 06:03:37', '2021-07-22 06:03:37'),
(20, 123, NULL, 'Infantri Putra', 'S.T., M.B.A', 12345, 'infantri.putra@esdm.go.id', 'Laki-Laki', NULL, '2021-06-17 07:34:18', '2021-06-17 07:34:18'),
(21, 124, NULL, 'Yudi Rahayudin', 'S.T., M.T., Ph.D', 2147483647, 'yudi.rahayudin@esdm.go.id', 'Laki-Laki', NULL, '2021-07-22 06:50:45', '2021-07-22 06:50:45'),
(22, 125, NULL, 'Mesias Citra Dewi', 'S.T., M.Si', 350405890, 'mesias.dewi@esdm.go.id', 'Perempuan', NULL, '2021-07-22 06:04:07', '2021-07-22 06:04:07'),
(23, 126, NULL, 'Dian Eka Aryanti', 'S.T., M.T.', 12345, 'dian.aryanti@esdm.go.id', 'Perempuan', NULL, '2021-06-17 07:43:27', '2021-06-17 07:43:27'),
(24, 128, 'Ir.', 'Apud Djadjulie', 'M.T.', 12345, 'apuddjajulie@gmail.com', 'Laki-Laki', NULL, '2021-07-22 06:17:14', '2021-07-22 06:17:14'),
(25, 129, 'Ir.', 'Bouman Tiroi Situmorang', 'M.T.,IPU', 2147483647, 'boumant@yahoo.com', 'Laki-Laki', NULL, '2021-07-22 06:49:22', '2021-07-22 06:49:22'),
(26, 130, 'Ir.', 'Priatna', 'M.T', 12345, 'priatna@esdm.go.id', 'Laki-Laki', NULL, '2021-07-25 14:37:52', '2021-07-25 14:37:52'),
(27, 131, 'Ir.', 'Oman Abdurahman', 'M.T', 12345, 'oman.abdurahman@esdm.go.id', 'Laki-Laki', NULL, '2021-07-22 08:27:24', '2021-07-22 08:27:24'),
(28, 132, 'Ir.', 'Benny Bensaman', 'M.T', 12345, 'bensaman@gmail.com', 'Laki-Laki', NULL, '2021-07-22 08:11:48', '2021-07-22 08:11:48'),
(29, 133, 'Dr. Ir.', 'Achmad Djumarma Wirakusumah', 'Dipl. Seis', 12345, 'ade.wirakusumah@gmail.com', 'Laki-Laki', NULL, '2021-07-22 08:18:46', '2021-07-22 08:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `industri`
--

CREATE TABLE `industri` (
  `id` int(11) NOT NULL,
  `nama_industri` varchar(191) DEFAULT NULL,
  `kategori_industri` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `alamat` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industri`
--

INSERT INTO `industri` (`id`, `nama_industri`, `kategori_industri`, `email`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'PT ANTAM Tbk', 'Aneka Tambang', 'antam@gmail.com', 'Jakarta', '2021-06-17 07:49:16', '2021-06-17 07:49:16'),
(4, 'PT Geo Dipa', 'Gas alam', 'geodipa@gmail.com', 'Patuha', '2021-04-26 20:42:27', '2021-04-26 20:42:27'),
(5, 'PT sukses bersama', 'Metalurgi', 'sukses@mail.com', 'subang', '2021-04-27 19:24:54', '2021-04-27 19:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nim` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_angkatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `user_id`, `nama`, `email`, `nim`, `jk`, `agama`, `alamat`, `jurusan`, `tahun_angkatan`, `avatar`, `created_at`, `updated_at`) VALUES
(20, 28, 'Abraham Brami Tangkawarow', 'Abraham.brami@gmail.com', '19131001', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Abraham Brami_D3G119001_Geologi.jpg', '2021-05-17 19:17:58', '2021-05-17 19:17:58'),
(21, 29, 'Wahyu Sibarani', 'mahasiswa2@mail.com', '19133025', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'wahyu.jpg', '2021-05-17 19:20:22', '2021-05-17 19:20:22'),
(22, 30, 'Abimanyu Mahardika', 'Mahardhikaabimanyu@gmail.com', '19132001', 'Laki-Laki', 'Islam', 'alamatdummyy', 'Teknologi Pertambangan', '2019', 'ABIMANYU MAHARDHIKA.jpg', '2021-05-17 19:21:31', '2021-05-18 01:04:43'),
(23, 42, 'Airi Rinjani Fatimah Hari', 'airirinjanii@gmail.com', '19131002', 'Perempuan', 'Islam', 'bandung', 'Teknologi Geologi', '2019', 'Airi Rinjani .jpg', '2021-05-18 18:18:47', '2021-05-18 18:18:47'),
(24, 43, 'Achmad Parobi', 'Aparobi15@gmail.com\r\n', '19132002', 'Laki-Laki', 'Islam', 'Bandung', 'Teknologi Pertambangan', '2019', 'ACHMAD PAROBI.jpg', '2021-05-18 18:19:49', '2021-05-18 18:19:50'),
(25, 44, 'Aqil Syauqi', 'syauqiaqil68@gmail.com', '19133003', 'Laki-Laki', 'Islam', 'Bandung', 'Teknologi Metalurgi', '2019', 'Aqil syauqi.jpg', '2021-05-18 18:21:52', '2021-05-18 18:21:52'),
(26, 46, 'Alvi M Rerizki', 'alvimr856@gmail.com', '19131003', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', NULL, '2021-06-03 02:45:27', '2021-06-03 02:45:27'),
(27, 47, 'Anggi Amelia', 'anggiiaamelia@gmail.com', '19131004', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', NULL, '2021-06-03 02:49:17', '2021-06-03 02:49:17'),
(28, 48, 'Bima Krisna Komsu', 'Bimakomsu@gmail.com', '19131005', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', NULL, '2021-06-03 02:51:33', '2021-06-03 02:51:33'),
(29, 49, 'Choirunnisa Assa\'diyah', 'canissa007@gmail.com', '19131006', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Choirunnisa\' Assa\'diyah-D3G119006-GEOLOGI.jpg', '2021-06-03 02:52:44', '2021-06-03 02:52:44'),
(30, 50, 'Dandi Hardiansyah', 'nightfuries269@gmail.com', '19131007', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Dandi H_D3G119007_Geologi.jpg', '2021-06-03 02:54:02', '2021-06-03 02:54:02'),
(31, 51, 'Gladys Shafira Maheswari Wirawan', 'gladyshafiram@gmail.com', '19131008', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', NULL, '2021-06-03 02:54:51', '2021-06-03 02:54:51'),
(32, 52, 'Hikmat Alamsyah', 'alamsyahhikmat0@gmail.com', '19131009', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Hikmat Alamsyah_D3G119009_Geologi 1.jpg', '2021-06-03 02:55:44', '2021-06-03 02:55:44'),
(33, 53, 'Ilmi Lestari', 'Ilmileztari19@gmail.com', '19131010', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Ilmi Lestari_D3G119010_Geologi.jpg', '2021-06-03 02:57:03', '2021-06-03 02:57:03'),
(34, 54, 'Insan Kamil', 'kinsan023@gmail.com', '19131011', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Insan Kamil_D3G119011_Geologi 1.jpg', '2021-06-03 02:58:12', '2021-06-03 02:58:12'),
(35, 55, 'Jasin Arrasyid Nugraha', 'jasinarrasyidnugraha@gmail.com', '19131012', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Jasin Arrasyid_D3G119012_Geologi 1.jpg', '2021-06-03 02:58:56', '2021-06-03 02:58:57'),
(36, 56, 'Joy Moses Simbolon', 'joymosessimbolon929@gmail.com', '19131013', 'Laki-Laki', 'Kristen', 'alamatdummy', 'Teknologi Geologi', '2019', 'Joys Moses_D3G119013_Geologi 1.jpg', '2021-06-03 03:00:07', '2021-06-03 03:00:07'),
(37, 57, 'Jundan Firdaus', 'jundanfirdaus@gmail.com', '19131014', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Jundan Firdaus_D3G119014_Geologi.jpg', '2021-06-03 03:00:54', '2021-06-03 03:00:54'),
(38, 58, 'Khumaerotul Millah', 'khumairamillah@gmail.com', '19131015', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Khumaerotul Millah_D3G119015_Geologi.jpg', '2021-06-03 03:02:01', '2021-06-03 03:02:01'),
(39, 59, 'M. Permana Jaya', 'permanaj364@gmail.com', '19131016', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'M Permana J_D3G119016_Geologi.jpg', '2021-06-03 03:02:46', '2021-06-03 03:02:46'),
(40, 60, 'Made Deva Widya Permana', 'permanadeva865@gmail.com', '19131017', 'Laki-Laki', 'Hindu', 'alamatdummy', 'Teknologi Geologi', '2019', 'Made Deva_D3G119017_Geologi 1.jpg', '2021-06-03 03:03:45', '2021-06-03 03:03:45'),
(41, 61, 'Melina Yuliati Nurfadlilah Hartono', 'melinaazizihartono@gmail.com', '19131018', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Melina Yuliati_D3G119018_Geologi 1.jpg', '2021-06-03 03:04:52', '2021-06-03 03:04:52'),
(42, 62, 'Nelly Apriliani Djunaedi', 'nellyaprl02@gmail.com', '19131019', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Nelly Apriliani_D3G119019_Geologi.jpg', '2021-06-03 03:05:36', '2021-06-03 03:05:36'),
(43, 63, 'Nila Umam Maftukhah', 'nilaumammaftukhah@gmail.com', '19131019', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', NULL, '2021-06-03 03:06:36', '2021-06-03 03:06:36'),
(44, 64, 'Prawita Putri Apriana', 'prawitaapriana04@gmail.com', '19131021', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Prawita Putri_D3G119021_Geologi.jpg', '2021-06-03 03:07:31', '2021-06-03 03:07:31'),
(45, 65, 'Rafsanjani Firdaus Gandara', 'rafsanjanifg13@gmail.com', '19131022', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Rafsanjani_D3G119022_Geologi 1.jpg', '2021-06-03 03:08:19', '2021-06-03 03:08:19'),
(46, 66, 'Satrya Bhakti Wibawa', 'satryabhakti@gmail.com', '19131023', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'Satrya Bhakti_D3G119023_Geologi 1.jpg', '2021-06-03 03:09:03', '2021-06-03 03:09:04'),
(47, 67, 'Sigit Setiawan', 'sigitprotectionss9832@gmail.com', '19131024', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', NULL, '2021-06-03 03:09:50', '2021-06-03 03:09:50'),
(48, 68, 'Tiara Oktaviani', 'tiaraoktavianihahiha@gmail.com', '19131025', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', 'tiara merah.jpg', '2021-06-03 03:11:42', '2021-06-03 03:11:42'),
(49, 69, 'Yosafat Anugrah Prasetyo', 'yosafatprsty@gmail.com', '19131026', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', NULL, '2021-06-03 03:12:22', '2021-06-03 03:12:22'),
(50, 70, 'Zakhra Bekti Utami', 'zahrauta50@gmail.com', '19131027', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Geologi', '2019', NULL, '2021-06-03 03:14:13', '2021-06-03 03:14:13'),
(51, 71, 'Aditya Meilany Histy', 'histymeilany@gmail.com', '19133001', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', NULL, '2021-06-03 06:52:36', '2021-07-22 06:53:42'),
(52, 72, 'Annisa Chitra Alviana', 'annisa.chitra.ac@gmail.com', '19133002', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'citra.jpg', '2021-06-03 06:53:37', '2021-06-03 06:53:37'),
(53, 73, 'Ariel Arnaldo', 'ariel.arnaldo.1203@gmail.com', '19133004', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', NULL, '2021-06-03 06:54:46', '2021-06-03 06:54:46'),
(54, 74, 'Assyfaunnisa', 'assyfaunnisa04@gmail.com', '19133005', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', NULL, '2021-06-03 06:56:06', '2021-06-03 06:56:06'),
(55, 75, 'Chandra Chevi Somantri', 'candracs90@gmail.com', '19133006', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'chandra.jpg', '2021-06-03 06:57:08', '2021-06-03 06:57:08'),
(56, 76, 'Dartha Tri Saputra', 'darthasaputra28@gmail.com', '19133007', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'darta.jpg', '2021-06-03 06:58:58', '2021-06-03 06:58:58'),
(57, 77, 'Fazira Amadea Kamal', 'faziraamadea11@gmail.com', '19133009', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', NULL, '2021-06-03 07:00:06', '2021-06-03 07:00:06'),
(58, 78, 'Fikri Mulfi Muhammad Dinar', 'fikrimulmulfi77@gmail.com', '19133010', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'fikri mulfi ACENG.jpg', '2021-06-03 07:03:29', '2021-06-03 07:03:29'),
(59, 79, 'Firza Mohammad Farid', 'firzamohfarid@gmail.com', '19133011', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'firza.jpg', '2021-06-03 07:04:33', '2021-06-03 07:04:33'),
(60, 80, 'Golda Grathcia Novita Manggorani Sinaga', 'goldasinaga123@gmail.com', '19133012', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'golda.jpg', '2021-06-03 07:05:39', '2021-06-03 07:05:39'),
(61, 81, 'I Made Dwi Suputra Mahayana', 'imadedwisuputra@gmail.com', '19133013', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'I made dwi.jpg', '2021-06-03 07:06:35', '2021-06-03 07:06:35'),
(62, 82, 'Imando Saputra Banjar Nahor', 'imandosaputra21@gmail.com', '19133014', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'imando.jpg', '2021-06-03 07:07:57', '2021-06-03 07:07:57'),
(63, 83, 'Kartika Alicia Syarief', 'kartikaalivcias@gmail.com', '19133015', 'Perempuan', 'Islam', 'Alamatdummy', 'Teknologi Metalurgi', '2019', 'kartika.jpg', '2021-06-03 07:08:50', '2021-06-03 07:08:50'),
(64, 84, 'Kristian Hengka Palanyo', 'hengkakristian21@gmail.com', '19133016', 'Laki-Laki', 'Islam', 'Alamatdummy', 'Teknologi Metalurgi', '2019', 'henka.jpg', '2021-06-03 07:10:08', '2021-06-03 07:10:08'),
(65, 85, 'Mochamad Rifqi Fauzi Rachman', 'fauzirifqi696@gmail.com', '19133017', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'moch Rifqi.jpg', '2021-06-03 07:11:32', '2021-06-03 07:11:32'),
(66, 86, 'Muhammad Chairul Luthfi Kamal', 'ayangkamal23@gmail.com', '19133018', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', NULL, '2021-06-03 07:12:37', '2021-06-03 07:12:37'),
(67, 87, 'Nabila Putri Wisnu Pratami', 'nabilaputri2101@gmail.com', '19133020', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'nabila.jpg', '2021-06-03 07:13:36', '2021-06-03 07:13:36'),
(68, 88, 'Nanda Ihsan Nashrulloh', 'nandaihsannn@gmail.com', '19133021', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'nanda.jpg', '2021-06-03 07:17:55', '2021-06-03 07:17:55'),
(69, 89, 'Riyadhul Ulum', 'ulumriyadhul99@gmail.com', '19133022', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'Riyadhul ulum.jpg', '2021-06-03 07:18:35', '2021-06-03 07:18:35'),
(70, 90, 'Sultan Tabah Muharam', 'sultantabahm@gmail.com', '19133023', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'sultan.jpg', '2021-06-03 07:19:16', '2021-06-03 07:19:16'),
(71, 91, 'Vidia Anggriani', 'anggrianividia@gmail.com', '19133024', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Metalurgi', '2019', 'vidia.jpg', '2021-06-03 07:20:05', '2021-06-03 07:20:05'),
(72, 92, 'Ahmad Mujahid', 'abdullahmuklis403@gmail.com', '19132003', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', NULL, '2021-06-04 03:19:51', '2021-06-04 03:19:51'),
(73, 93, 'Andi Waylani', 'pojokphotography@gmail.com', '19132004', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'ANDI WAYLANI.jpg', '2021-06-04 03:22:41', '2021-06-04 03:22:41'),
(74, 94, 'Deby Habibah', 'debyhabibah93@gmail.com', '19132005', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'DEBY HABIBAH.jpg', '2021-06-04 03:23:25', '2021-06-04 03:23:25'),
(75, 95, 'Difo Dupatra Koster', 'divocoster@gmail.com', '19132006', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'DIFO DUPATRA KOSTER.jpg', '2021-06-04 03:23:59', '2021-06-04 03:23:59'),
(76, 96, 'Fahrul Razi', 'fahrullrazii@gmail.com', '19132007', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'FAHRUL RAZI.jpg', '2021-06-04 03:24:31', '2021-06-04 03:24:31'),
(77, 97, 'Firdha Fajriatunnisa', 'firdhafajriatunnissa123@gmail.com', '19132008', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'FIRDHA FAJRIATUNNISSA.jpg', '2021-06-04 03:25:29', '2021-06-04 03:25:29'),
(78, 98, 'Ian Duar', 'ianduar@gmail.com', '19132009', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'IAN DUAR.jpg', '2021-06-04 03:26:00', '2021-06-04 03:26:00'),
(79, 99, 'Jamaludin Kori', 'jamaludinqori18@gmail.com', '19132010', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'JAMALUDIN KORI.jpg', '2021-06-04 03:26:35', '2021-06-04 03:26:35'),
(80, 100, 'Mardhyya Sana\'a Salamah', 'agalmaga@gmail.com', '19132011', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'MARDHYYA SANA\'A SALAMAH.jpg', '2021-06-04 03:27:28', '2021-06-04 03:27:29'),
(81, 101, 'Mochammad Abdul Aziz', 'mochaaziss@gmail.com', '19132012', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'MOCHAMMAD ABDUL AZIS.jpg', '2021-06-04 03:28:01', '2021-06-04 03:28:01'),
(82, 102, 'Mohammad Akif Kamaludin', 'akif.kamaludn@gmail.com', '19132013', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'MOHAMMAD AKIF KAMALUDIN.jpg', '2021-06-04 03:29:13', '2021-06-04 03:29:13'),
(83, 103, 'Mohammad Fajar Ryandhi', 'fajarfv18@gmail.com', '19132014', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'MOHAMMAD FAJAR RYANDHI.jpg', '2021-06-04 03:29:55', '2021-06-04 03:29:55'),
(84, 104, 'Muhammad Faris Akbar', 'faris.akbar1721@gmail.com', '19132015', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'MUHAMAD FARIS AKBAR.jpg', '2021-06-04 03:30:38', '2021-06-04 03:30:38'),
(85, 105, 'Muhammad Fillah Aditsyah', 'muhamadfillah1@gmail.com', '19132016', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'MUHAMAD FILLAH ADITSYAH.jpg', '2021-06-04 03:34:01', '2021-06-04 03:34:01'),
(86, 106, 'Muhammad Sahrul Aryanto', 'Msahrula2017@gmail.com', '19132017', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'MUHAMAD SAHRUL ARYANTO.jpg', '2021-06-04 03:34:43', '2021-06-04 03:34:43'),
(87, 107, 'Muhammad Bagas Ruseno Adjie', 'ruseno.adji271@gmail.com', '19132018', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'MUHAMMAD BAGAS RUSENO ADJIE.jpg', '2021-06-04 03:35:22', '2021-07-22 06:53:14'),
(88, 108, 'Muhammad Rifqan', 'muhammad.rifqan1@gmail.com', '19132019', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'MUHAMMAD RIFQAN.jpg', '2021-06-04 03:36:05', '2021-06-04 03:36:05'),
(89, 109, 'Muhammad Rizqi Rafi', 'rizqyrafi@gmail.com', '19132020', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'MUHAMMAD RIZQI RAFI.jpg', '2021-06-04 03:37:04', '2021-06-04 03:37:04'),
(90, 110, 'Pangestu Eko Lariyanto', 'pangestueko20@gmail.com', '19132021', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'PANGESTU EKO LARIYANTO.jpg', '2021-06-04 03:37:55', '2021-06-04 03:37:55'),
(91, 111, 'Putra Deswijaya', 'putradswj@gmail.com', '19132022', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'PUTRA DESWIJAYA.jpg', '2021-06-04 03:38:50', '2021-06-04 03:38:50'),
(92, 112, 'Ratu Shifa Alamanda', 'ratushifaa@gmail.com', '19132023', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'RATU SHIFA ALAMANDA.jpg', '2021-06-04 03:39:28', '2021-06-04 03:39:28'),
(93, 113, 'Rayhan Revi Fadzillah', 'rehanrevi54@gmail.com', '19132024', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'RAYHAN REVI FADZILLAH.jpg', '2021-06-04 03:40:20', '2021-06-04 03:40:20'),
(94, 114, 'Ricki Darmawan', 'darmawanricki7@gmail.con', '19132025', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'RICKI DARMAWAN.jpg', '2021-06-04 03:41:35', '2021-06-04 03:41:35'),
(95, 115, 'Rizki  Hidayatullah', 'rzkhidayatullah@gmail.com', '19132026', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'RIZKI HIDAYATULLAH.jpg', '2021-06-04 03:42:54', '2021-07-22 06:51:15'),
(96, 116, 'Samuel Unedo Simbolon', 'samuelunedosimbolon02@gmail.com', '19132027', 'Laki-Laki', 'Kristen', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'SAMUEL UNEDO SIMBOLON.jpg', '2021-06-04 03:43:44', '2021-06-04 03:43:44'),
(97, 117, 'Sukma Puspita Dhevi', 'dewitari110@gmail.com', '19132029', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'SUKMA PUSPITA DHEVI.jpg', '2021-06-04 03:44:29', '2021-06-04 03:44:29'),
(98, 118, 'Selvianti', 'Selvianti3112@gmail.com', '19132028', 'Perempuan', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'SELVIANTI.jpg', '2021-06-04 03:44:56', '2021-06-04 03:44:56'),
(99, 119, 'Wahyu Suryanto', 'wahyumaretasuryantoanggraini@gmail.com', '19132030', 'Laki-Laki', 'Islam', 'alamatdummy', 'Teknologi Pertambangan', '2019', 'WAHYU SURYANTO.jpg', '2021-06-04 03:45:33', '2021-06-04 03:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `master_capaian`
--

CREATE TABLE `master_capaian` (
  `id` int(11) NOT NULL,
  `jurusan` varchar(191) DEFAULT NULL,
  `deskripsi_capaian` text,
  `kategori_capaian` enum('sikap','pengetahuan','keterampilan umum','keterampilan khusus') DEFAULT NULL,
  `bobot_capaian` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_capaian`
--

INSERT INTO `master_capaian` (`id`, `jurusan`, `deskripsi_capaian`, `kategori_capaian`, `bobot_capaian`, `created_at`, `updated_at`) VALUES
(1, 'Teknologi Pertambangan', 'Mampu memilih metode penambangan dan peralatan yang digunakan.', 'keterampilan khusus', NULL, '2021-05-03 09:07:32', '2021-05-03 02:07:32'),
(2, 'Teknologi Pertambangan', 'Mampu melaksanakan kegiatan pemberaian pada tambang terbuka dan tambang bawah tanah', 'keterampilan khusus', NULL, '2021-05-03 00:57:36', '2021-05-03 00:57:36'),
(3, 'Teknologi Pertambangan', 'Mampu menentukan alat muat dan angkut berdasarkan target produksi', 'keterampilan khusus', NULL, '2021-05-03 00:58:01', '2021-05-03 00:58:01'),
(4, 'Teknologi Pertambangan', 'Mampu melaksanakan kegiatan produksi pada tambang terbuka dan tambang bawah tanah', 'keterampilan khusus', NULL, '2021-05-03 00:58:17', '2021-05-03 00:58:17'),
(5, 'Teknologi Pertambangan', 'Mampu mengaplikasikan K3 dan lingkungan tambang', 'keterampilan khusus', NULL, '2021-05-03 00:58:31', '2021-05-03 00:58:31'),
(6, 'Teknologi Geologi', 'Mampu memecahkan permasalahan geoteknik, hidrogeologi, dan geoinformatika', 'keterampilan khusus', NULL, '2021-05-06 18:39:34', '2021-05-06 18:39:34'),
(7, 'Teknologi Geologi', 'Mampu menafsirkan fenomena geologi', 'keterampilan khusus', NULL, '2021-05-06 18:39:57', '2021-05-06 18:39:57'),
(8, 'Teknologi Geologi', 'Mampu memetakan mineral bijih logam dan bukan logam, serta batubara', 'keterampilan khusus', NULL, '2021-05-06 18:40:14', '2021-05-06 18:40:14'),
(9, 'Teknologi Geologi', 'Mampu melakukan eksplorasi mineral dan batubara', 'keterampilan khusus', NULL, '2021-05-06 18:40:31', '2021-05-06 18:40:31'),
(10, 'Teknologi Geologi', 'Mampu memproses dan menganalisis data', 'keterampilan khusus', NULL, '2021-05-06 18:40:42', '2021-05-06 18:40:42'),
(11, 'Teknologi Metalurgi', 'Membuat penyelesaian masalah dalam proses dan operasi pengolahan dan pemurnian mineral dan batubara.', 'keterampilan khusus', NULL, '2021-05-24 04:11:53', '2021-05-24 04:11:53'),
(12, 'Teknologi Metalurgi', 'Merancang, Mengembangkan dan memanfaatkan proses alir pengolahan dan pemurnian mineral serta pengembangan dan pemanfaatan batubara.', 'keterampilan khusus', NULL, '2021-05-24 04:12:48', '2021-05-24 04:12:48'),
(13, 'Teknologi Metalurgi', 'Merancang dan merekayasa diagram alir proses ekstraksi logam non ferrous dan ferrous.', 'keterampilan khusus', NULL, '2021-05-24 04:15:24', '2021-05-24 04:15:24'),
(14, 'Teknologi Metalurgi', 'Merancang dan mengembangkan dan memanfaatkan proses alir mineral non logam.', 'keterampilan khusus', NULL, '2021-05-24 04:16:03', '2021-05-24 04:16:03'),
(15, 'Teknologi Metalurgi', 'Merancang, mengembangkan dan memanfaatkan teknologi metalurgi mekanik.', 'keterampilan khusus', NULL, '2021-05-24 04:16:31', '2021-05-24 04:16:31'),
(16, 'Teknologi Metalurgi', 'Mengoperasikan dan menerapkan keilmuan kimia fisik dan thermodinamika.', 'keterampilan khusus', NULL, '2021-05-24 04:17:10', '2021-05-24 04:17:10'),
(17, 'Teknologi Metalurgi', 'Merencanakan, mengaplikasikan dan menilai kegiatan K3 dan Lingkungan Metalurgi.', 'keterampilan khusus', NULL, '2021-05-24 04:18:10', '2021-05-24 04:18:10'),
(18, 'Teknologi Metalurgi', 'Mengoperasikan dan menerapkan keilmuan pirometalurgi, hidrometalurgi dan elektrometalurgi.', 'keterampilan khusus', NULL, '2021-05-24 04:19:00', '2021-05-24 04:19:00'),
(19, 'Teknologi Metalurgi', 'Mengoperasikan dan menerapkan keilmuan mineralogi dan kristalografi.', 'keterampilan khusus', NULL, '2021-05-24 04:19:37', '2021-05-24 04:19:37'),
(20, 'Teknologi Metalurgi', 'Mengoperasikan dan menerapkan aplikasi software metalurgi', 'keterampilan khusus', NULL, '2021-05-24 04:20:04', '2021-05-24 04:20:04');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_04_13_031042_create_mahasiswa_table', 1),
(5, '2021_05_19_150843_add_default_to_data_laporan_table', 2),
(6, '2021_05_20_132739_add_capaian_id_to_data_laporan', 3),
(7, '2021_07_15_195117_add_dosenpembimbing2_id_to_data_bimbingan_table', 4),
(8, '2021_07_15_202519_add_approve_dosen2_to_table_data_laporan', 4);

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
-- Table structure for table `pembimbingindustri`
--

CREATE TABLE `pembimbingindustri` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `jk` varchar(191) DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `industri_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembimbingindustri`
--

INSERT INTO `pembimbingindustri` (`id`, `user_id`, `nama`, `email`, `jk`, `avatar`, `industri_id`, `created_at`, `updated_at`) VALUES
(10, 45, 'Dony Maulana Yusuf Rifai', 'dmyr@mail.com', 'Laki-Laki', NULL, 1, '2021-05-20 06:33:08', '2021-05-20 06:33:08'),
(11, 127, 'Tes Pembimbing Lapangan 1', 'tesseract@tex123446.com', 'Laki-Laki', NULL, 1, '2021-07-03 12:31:33', '2021-07-03 12:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'jokerbancet@gmail.com', NULL, '$2y$10$w8bjEBd/1DlvLjOGi/aYGO3RYhxOQKg1eKiwaUeA2os3CVF6Yrdpm', 'admin', 'qB2KIBCEkRYMjxnDWLG1NXbyXuB4ash97kH1mTzZcYVf4ZjDzOnoYYQMGbYX', '2021-04-22 22:50:41', '2021-04-22 22:50:41'),
(28, 'Abraham Brami Tangkawarow', 'Abraham.brami@gmail.com ', NULL, '$2y$10$jz4/x1hGZuuzhZcu1WuTpu8lHbjS3SF1xDFRKf1QO0Eu/7HfSk7q.', 'mahasiswa', 'xWrtH6qDTJeTJgkYkdGvYHaWC5cb2f5lQnTGFN2mvDauogAE6SP1a0sz75Jw', '2021-05-17 19:17:58', '2021-05-17 19:17:58'),
(29, 'Wahyu Sibarani', 'mahasiswa2@mail.com', NULL, '$2y$10$P5qukgOL5Z7tEwtFKge5beZFEnMqCzSOuCbzohVuq5HZ0xkCEt0nm', 'mahasiswa', 'tXtukiYPYAIjsF5lEU0uaVMxXYWM05jHslizYyqrbjoKUeQLhoSBO15rccj2', '2021-05-17 19:20:22', '2021-05-17 19:20:22'),
(30, 'Abimanyu Mahardika', 'Mahardhikaabimanyu@gmail.com', NULL, '$2y$10$mg//MxzIM/.Tfws7HkDfH.M8lALe437DMyrHKZuvGadVNiGg1pJTi', 'mahasiswa', '1BvzQ3jdDYbp5eNPp9DQJzwZgtktN0njBTPQF9TgRVYJKppK48sIZLBFDzu4', '2021-05-17 19:21:31', '2021-05-17 19:21:31'),
(31, 'Sabtanto Joko', 'sabtanto.suprapto@esdm.go.id', NULL, '$2y$10$1fkUhtfrbC0fCPREhKx1muhCdSnoktowvN3ybNZoDG0Q95l/McYlC', 'dosenpembimbing', 'n4RFBh0XFD5aSKF0H426DmsTnXXPOCYev1IRhaF3CQ0BsAptWR8OmhjwunQG', '2021-05-18 01:04:02', '2021-05-18 01:04:02'),
(32, 'Adang Saputra', 'adang.saputra@esdm.go.id', NULL, '$2y$10$SABJaNsfQoQXyAadh2pBEuL4Qy3kL5riTlCKPKHZ0RJqXnkTvLwha', 'dosenpembimbing', 'rHvlaQDpAb1nPWw9iMEkBzEV0IGEXQvff5c0geTZXY1qGCGoBk5jdQXq4cFq', '2021-05-18 01:06:00', '2021-05-18 01:06:00'),
(33, 'Dadan Wildan', 'dadan.wildan@esdm.go.id', NULL, '$2y$10$NNcy0s6rJxMhbm6pFBp4nueK11Hj6p9uqqTO9WmfdkkYRKnpfElHi', 'dosenpembimbing', 'OsHGyU5eifCGQu8FemCuvG6ASqeFZwXMRprgTLV3NMR6ZIBynqXwubGYpryf', '2021-05-18 01:06:45', '2021-05-18 01:06:45'),
(34, 'Fiati Nurmaya', 'fiati.nurmaya@esdm.go.id', NULL, '$2y$10$gADuTppXtSHMJht0AvQZ5erk2fEafeux3Rtp/kTVMLjB//l9g0IAG', 'dosenpembimbing', 'Ka7Rt36GYrQROgXluaer309ielOWWOqXTeGm0levtGvaBxHrTaPKA9yCkYoD', '2021-05-18 01:07:20', '2021-05-18 01:07:20'),
(35, 'Imelda Hutabarat', 'imelda.hutabarat@esdm.go.id', NULL, '$2y$10$YWA6r2.kBMEe4aDVJMlRkeLJWFEmWsZJDUF9dY0jasxc7C31nO9de', 'dosenpembimbing', '9KWVqdRcakkCUR6pPHoi3wmKL4qMPlg0cKRTmvggF7y9VcomNva45l4YSiVu', '2021-05-18 01:08:14', '2021-05-18 01:08:14'),
(36, 'Wahid Sugiman', 'wahid.sugiman@esdm.go.id', NULL, '$2y$10$wLog1MjGsrJ9Fzceb0NTM.OAcppWb/xNaBMiY0mbRn7KYnFATSgui', 'dosenpembimbing', '7oG0hJXkKcBLpa8fCpSYDFzmPViX8Rk79R9gaHYj9Kbm7RzJ5amYw0aUWVuq', '2021-05-18 01:08:49', '2021-05-18 01:08:49'),
(37, 'Tedi Yunanto', 'tedi.yunanto@esdm.go.id', NULL, '$2y$10$10jtWnAgwXyNtENNFigUdOi5iddS17PFBA/zM8KOoAo4TAmlHs5bW', 'dosenpembimbing', 'xZBJcqQiKGmW8BkQZhKPWjGuPAp1j1V7X0HFByt6V1SygOMIWHeKcwpyvkVj', '2021-05-18 01:09:31', '2021-05-18 01:09:31'),
(38, 'Denny Lumban Raja', 'denny.raja@esdm.go.id', NULL, '$2y$10$ICsqa/DPFzhGqE.xAtOFAOpDzO6mRP63o3TV3Td.ewKkbhozd.Qru', 'dosenpembimbing', 'FkiJCOoJxBuQVsekqp2QEoQEFxQ02dxSNP5DS6mTVQ9kRMZxGcjmaGdsVc95', '2021-05-18 01:10:03', '2021-05-18 01:10:03'),
(39, 'Suparno', 'suparno.031961@esdm.go.id', NULL, '$2y$10$fU8kZyDM94QMj5lmhopiKu3356IqWFbOSotItbPvPfeWbNaIqEcJ.', 'dosenpembimbing', 'hpdjxnsu5T2wCmRb7uZDZOOVa3x0VG0t4w0ZecIHvCLnPpdKLbFXdLH22rll', '2021-05-18 01:36:52', '2021-05-18 01:36:52'),
(40, 'Asep Rohman', 'asep.rohman@esdm.go.id', NULL, '$2y$10$mJASKY6nW5fqGuZaZTUSReZd.vEjKT4eJogWMVnL/QHfsB9iWcSni', 'dosenpembimbing', 'Jm9eXZcwaxwqBLQ2Iizhh20DUet0OItNxYjYMzg0SKE9qAH84jXTZ8oWc0NE', '2021-05-18 01:37:31', '2021-05-18 01:37:31'),
(41, 'Rochsyid Anggara', 'rochsyid.anggara@esdm.go.id', NULL, '$2y$10$nMcMh0oRRqnxV3GL7kZNJ..Swd2gOipeoXSq1BvXWs9p2opPM/MQG', 'dosenpembimbing', 'EmBO4KBLrdas4efxzd25zfILx3vKKos1HyptRhXjYK7oHQn1lgG8KfoHjdTj', '2021-05-18 01:38:05', '2021-05-18 01:38:05'),
(42, 'Airi Rinjani Fatimah Hari', 'airirinjanii@gmail.com', NULL, '$2y$10$s8LqoJHYzJer0m9.FjrPkexZRzodwD.xJzdF8w9Y8r7zqkHOwCHDK', 'mahasiswa', 'nwcb4xeY8ppE2deMOSSX058lEt4upC9fN4wYLu9xWAYXFJI9t3r2WbK5HVwU', '2021-05-18 18:18:47', '2021-05-18 18:18:47'),
(43, 'Achmad Parobi', 'Aparobi15@gmail.com\r\n', NULL, '$2y$10$SNP3spODACmNmUWXUySpo.u2BqPrapaZkuve0PlAAJcML/qYN8tEW', 'mahasiswa', 'Oe8MaAhXNHIo5qaa8blDIXKpxxSpp4LJk3TPNvGiKZ49ZKRpg0gERLTvXJAS', '2021-05-18 18:19:49', '2021-05-18 18:19:49'),
(44, 'Aqil Syauqi', 'syauqiaqil68@gmail.com', NULL, '$2y$10$4lLz1YUNFuHyd8ua1l5kjuYiDoP6JE1WB2CPaaQ4pP95iqlGjlURG', 'mahasiswa', 'n35Ewprzi104CvQBDRIHpzdEuReQBP7f1sNd0WRI9VEkWDtiDhKXnKTSwFDW', '2021-05-18 18:21:51', '2021-05-18 18:21:51'),
(45, 'Dony Maulana Yusuf Rifai', 'dmyr@mail.com', NULL, '$2y$10$LcX0cB4.p3ATE8edLw1ypOFq46odqmaagVRak/Dt4AUP.7NXypCay', 'pembimbingindustri', 'k24TIHyLugzcmCQjsDPWszglDWeAmTRRPyQlFqL7TAYUOvltFIqx8trWpBVG', '2021-05-20 06:33:08', '2021-05-20 06:33:08'),
(46, 'Alvi M Rerizki', 'alvimr856@gmail.com', NULL, '$2y$10$tuOiF9Zfa7AfXSO.0w6.rOmeIqnVSPVl2W5SKPMxRRZD63bsw7cgq', 'mahasiswa', 'bWXAoKa1QFXR2ijmqody26dhn0D9sWpNBrOqIRSVrhawHjuePuDUlHAIuOsu', '2021-06-03 02:45:27', '2021-06-03 02:45:27'),
(47, 'Anggi Amelia', 'anggiiaamelia@gmail.com', NULL, '$2y$10$h2roY0yfHX.se6rAve9vXuf1le1wjurmLI8XfAJKmkoglXWMg4G4W', 'mahasiswa', 'EJcy1pv7tyJigxwNP2KsYWxvk4AMxpQ0FDa77oIZHGJOiV7gpbL9bXIJukC9', '2021-06-03 02:49:15', '2021-06-03 02:49:15'),
(48, 'Bima Krisna Komsu', 'Bimakomsu@gmail.com', NULL, '$2y$10$Mis5lSaMoNhFQ/xZRsnAfuYxPlTP5SSa7N03Smgu7SsySJ1v/szJy', 'mahasiswa', '38P9OmIBqPqXPD767LiS19dZjfRkkfk620QnXYJjSLSu2AQGvsVl3rL5wItK', '2021-06-03 02:51:30', '2021-06-03 02:51:30'),
(49, 'Choirunnisa Assa\'diyah', 'canissa007@gmail.com', NULL, '$2y$10$H.p1Dsk2Aw1dVxCPtbGed.co8RW.W9QsU6UDaixRbwZ49JArPVASi', 'mahasiswa', 'yviZnwTcfej4nGR8jva2nXyV4CVaZ0AcKTFNUNIpF0eOrzBT3v1tf2J1Ao1C', '2021-06-03 02:52:44', '2021-06-03 02:52:44'),
(50, 'Dandi Hardiansyah', 'nightfuries269@gmail.com', NULL, '$2y$10$9gz8MN4EWF/pdpiJIta4FeaOM4f9fbEnSfcoARmLEOFEejjtHWPS6', 'mahasiswa', 'I3cWLWQjvgvt60eNlDpoDr3vZhGsEafy78pVpjV2zkkrTU0mvMccGOzFL55Z', '2021-06-03 02:54:01', '2021-06-03 02:54:01'),
(51, 'Gladys Shafira Maheswari Wirawan', 'gladyshafiram@gmail.com', NULL, '$2y$10$aaJ9J9sVTjLM2KZtM7urDOeU1bVX8/CRJ6jeN/QzhKtg3JrX3wfrG', 'mahasiswa', 'gqGtIhHt7HvkaCZghIUJqnomLd4pSJ1Xzl6sQBIMR3RwokEvlvkFYyMUxcDg', '2021-06-03 02:54:50', '2021-06-03 02:54:50'),
(52, 'Hikmat Alamsyah', 'alamsyahhikmat0@gmail.com', NULL, '$2y$10$FbjxbrpHsW8ZhUWfR53TFOc0HSfXvXLorefucm06FSE0bPhWOL/Ka', 'mahasiswa', 'OkJYkXcmT0NjyfNAHrwoa3NWyWOc3uYoxfXBRqcu4b72U51gB0d0Etb3X9KM', '2021-06-03 02:55:42', '2021-06-03 02:55:42'),
(53, 'Ilmi Lestari', 'Ilmileztari19@gmail.com', NULL, '$2y$10$ZBnU/i3p2iXULJgAEOi.UenVKWKpD3STfivRzNH1ZlcbidzGUyiWW', 'mahasiswa', 'N8e0VQ239dKWzJPOppY1alocnAygMDaNetqAD53iSXSx8ET633TcB7CNGvQj', '2021-06-03 02:57:01', '2021-06-03 02:57:01'),
(54, 'Insan Kamil', 'kinsan023@gmail.com', NULL, '$2y$10$3o9vMSlCT3pMDsk52LwQ7OpuNkCYyo0JX12USsz6302WmpFe66462', 'mahasiswa', '89pTn1yYMwStljRSF3KMTQELyuW4E3O8vrhud8Md106VPk288AWbiiHuvJSm', '2021-06-03 02:58:12', '2021-06-03 02:58:12'),
(55, 'Jasin Arrasyid Nugraha', 'jasinarrasyidnugraha@gmail.com', NULL, '$2y$10$H3TV4LtqTZxKqRukWdnw9eAjj.hgSsoU3VEOJit3XeAmwccKI7Tte', 'mahasiswa', 'gd1EG0UVUWlT5IZ1JKnTti9igQw8dyYe4v8VnBcYaIfApEFFm7fqZikD1wIl', '2021-06-03 02:58:56', '2021-06-03 02:58:56'),
(56, 'Joy Moses Simbolon', 'joymosessimbolon929@gmail.com', NULL, '$2y$10$3Pw7qN1G9a5g7I9C9fJz0ev/W62WyftlIErhURYAGAnUTO/Aex4RW', 'mahasiswa', 'jFrComQJmlsOFJl50QjrrbZqWkkO0Cw0Qiu6urM6sonAn3pxP0AI6HeyGPfo', '2021-06-03 03:00:06', '2021-06-03 03:00:06'),
(57, 'Jundan Firdaus', 'jundanfirdaus@gmail.com', NULL, '$2y$10$AhSSC3nJE38jQJydbqqSDu2vCKIAWCbkh3u9BpFISv.R6vxLDI1cW', 'mahasiswa', '574IcJVGdOwkxUhytP39xtEFmSWDzmyYmvzVOlzbUwyrwJdMOTQruKPpmjyQ', '2021-06-03 03:00:54', '2021-06-03 03:00:54'),
(58, 'Khumaerotul Millah', 'khumairamillah@gmail.com', NULL, '$2y$10$sZe4kSXLRDoLQgZ8xTqoA.pST5ysZYhbR3MJrWoTJVurcpvMVeYiK', 'mahasiswa', 'OQqzIfUZ20lqjRyXr8TWQKt7R2ECHwKAfmV7ZFTLkG52PiCunnayn8MvFtjk', '2021-06-03 03:01:59', '2021-06-03 03:01:59'),
(59, 'M. Permana Jaya', 'permanaj364@gmail.com', NULL, '$2y$10$9zuTECDaB8V9188amb1FTOHzfuS35rgf/PTj3FJjCsIde/VoLqU9O', 'mahasiswa', 'iQnRPMvfHIaBibpCCuIQpByzoZQZhvBM5SMXU7PFcVEx1ihM29MdfEzwjLnA', '2021-06-03 03:02:46', '2021-06-03 03:02:46'),
(60, 'Made Deva Widya Permana', 'permanadeva865@gmail.com', NULL, '$2y$10$MsmcY6/aqD3wwTxzltnES.Y8lVl7FttNRcKWKm8QliKckhzQKvO4i', 'mahasiswa', 'emqdnVkffe2FLJ8ROKzuYTkEu4UeVuxHsC9r3WJpnCbQPwhRdRVmFj3IuP6h', '2021-06-03 03:03:43', '2021-06-03 03:03:43'),
(61, 'Melina Yuliati Nurfadlilah Hartono', 'melinaazizihartono@gmail.com', NULL, '$2y$10$z37JHQ6RfmLcPN4kkrn67OyRRcbkme7qkD./B9XrfzQxM2o2AJ5Hm', 'mahasiswa', 'QO49h1A9SsM1VCtMRiLVLBwwdhrAFA1MrW3kmyeGjZjbZlBjZ1L2GOV6yVkl', '2021-06-03 03:04:51', '2021-06-03 03:04:51'),
(62, 'Nelly Apriliani Djunaedi', 'nellyaprl02@gmail.com', NULL, '$2y$10$Zwxvb1BChKccyHuo194t2eGyXd/41B2813yk1mFyx9tVYjU079tVi', 'mahasiswa', 'R4vFrydeQ6AZo40WfFVxXnE90I0ItcEhjmZ6n6lhzMcN6o2JHYY965VkhHd2', '2021-06-03 03:05:36', '2021-06-03 03:05:36'),
(63, 'Nila Umam Maftukhah', 'nilaumammaftukhah@gmail.com', NULL, '$2y$10$UAguOzBJ7H0zi/tcc9wi2OTR145vCVMkw4eRYlyEN.LATYC5daqYW', 'mahasiswa', 'uTMcOgqzxb1LNGApP4MGSRyucDcRV3wQF3kNi9j1Hj1ft62q8wT3C5NVAcjl', '2021-06-03 03:06:34', '2021-06-03 03:06:34'),
(64, 'Prawita Putri Apriana', 'prawitaapriana04@gmail.com', NULL, '$2y$10$vBoMfJT97aQsgrg.tWOIKen11sHzGGTzFH4urmTJlSiBmPamJs9Wi', 'mahasiswa', 'POx6bAJPs8tdkSfYvO8sUyZjkBgLosos2Kmw4UwAhqfh6ZDGD9F0xMx91VjN', '2021-06-03 03:07:30', '2021-06-03 03:07:30'),
(65, 'Rafsanjani Firdaus Gandara', 'rafsanjanifg13@gmail.com', NULL, '$2y$10$CTSQ8RibPk0BZx8bdOuaYemEVTDvRQQpRj1zzdBvuVl12Cs8V27A2', 'mahasiswa', '6PfqPEqqnMhcVSWPaZJCMIdiWOGvprI8gD00ZLLAGIunxPpzjLcacGQ70aVz', '2021-06-03 03:08:19', '2021-06-03 03:08:19'),
(66, 'Satrya Bhakti Wibawa', 'satryabhakti@gmail.com', NULL, '$2y$10$0PCo7w/mOFjRj5y96EPcqumg4pqf2b0.szkaYHDOhQ/yKVs.QI3Oq', 'mahasiswa', 'gW9aIsqDEWnqg2mQYjNqcVrkreP4zX7Gz0MGUssuEQ2wEYOItIO7WxRZu3bF', '2021-06-03 03:09:03', '2021-06-03 03:09:03'),
(67, 'Sigit Setiawan', 'sigitprotectionss9832@gmail.com', NULL, '$2y$10$9R1LnRgSRr8V02jT4pJg9eiqtRcsxWMUQWz0o0gWsuAsCwnLalzl.', 'mahasiswa', 'vfiaiGIL8cVVi2LR6QYw4WFmShsuJFzNJY59kRuxFouiZT7JErvCL6CmRu6d', '2021-06-03 03:09:50', '2021-06-03 03:09:50'),
(68, 'Tiara Oktaviani', 'tiaraoktavianihahiha@gmail.com', NULL, '$2y$10$l5fLiGUbpNrMrxe51hscl.nhTVq7ykVK1N6GToLHJNFvxccFW4yyK', 'mahasiswa', '78OEQ9lMYjSbKYlZyjH5Siqt3S8ZlpIlT4lW57RbUDxa5xQAuFBP4PNSLDAT', '2021-06-03 03:11:42', '2021-06-03 03:11:42'),
(69, 'Yosafat Anugrah Prasetyo', 'yosafatprsty@gmail.com', NULL, '$2y$10$LA0kt6pF9s1dZNwSWoQliurnED3xgRrzw24EL8.weu4h4lhhI9DEu', 'mahasiswa', 'yxXV2y5bKAbjxyUzlsLKbggwedu1k81IzjsQQTmmoiFda033UHSbgs71VljF', '2021-06-03 03:12:20', '2021-06-03 03:12:20'),
(70, 'Zakhra Bekti Utami', 'zahrauta50@gmail.com', NULL, '$2y$10$3WHGjfFioNj0TuuriRNPU.NvzbHiTeL6ZjhvvfPGAkvXLkA9HcVwS', 'mahasiswa', '8BDcGxNAvJc76Cp9OSaY3jaVDQewUmdiCMJdMfawLbMFMBBf6zyCO95cfYgy', '2021-06-03 03:14:11', '2021-06-03 03:14:11'),
(71, 'Aditya Meilany Histy', 'histymeilany@gmail.com', NULL, '$2y$10$9PlYWFkSRxAy9AQFXyypxezx7/PNAqg69Q51vIJwuW3tWCwqJoyw6', 'mahasiswa', 'hENOxuCyHAnZldGyZJaztpChBBTfYbg9hKXJbLVPQQxoJfGR3tplILu6ce6G', '2021-06-03 06:52:36', '2021-06-03 06:52:36'),
(72, 'Annisa Chitra Alviana', 'annisa.chitra.ac@gmail.com', NULL, '$2y$10$yyP.9g42IWO2IS2CWVP.6O.SogJBMyYTXTWrMDpvwQwwXYRXUbJ4G', 'mahasiswa', 'vgR7M9iEnBHTPlWD7VMf0itOtyG7dZG7LMUqICgnNHaTKbLmYQijqc4CEitm', '2021-06-03 06:53:37', '2021-06-03 06:53:37'),
(73, 'Ariel Arnaldo', 'ariel.arnaldo.1203@gmail.com', NULL, '$2y$10$yTC5FC5MjHOp0Fp51b9uA.GqLzb5mdbrTscWiVaXKoQgTOPjmEHf.', 'mahasiswa', 'XqcEBahwGzSD3cvibXFNHx7gTiTnbqDx89XgdPMR17PX2kCVYoDnADgYVmLP', '2021-06-03 06:54:43', '2021-06-03 06:54:43'),
(74, 'Assyfaunnisa', 'assyfaunnisa04@gmail.com', NULL, '$2y$10$5k3TlmJRGATfRDHdtxrGDu/ALk2yEjgchLdFd2b.pXGuxwtn.2hMS', 'mahasiswa', 'ZIcbrCDvBKqnDdRSMqgNr6OfMR01WCYvqSR2GUBeMxhlPGcVJYq8XBmhaex5', '2021-06-03 06:56:03', '2021-06-03 06:56:03'),
(75, 'Chandra Chevi Somantri', 'candracs90@gmail.com', NULL, '$2y$10$n4Au5VPqCvYgjl2//bJ/dO7ShNDvBP/xW65XJhqDfhWofcNTSXvG6', 'mahasiswa', '5EtF0FfcJfDxo1TLGwgn3eVsoartk5N6s4LFzauhvBC2HpNm4nZwbDYxUb1G', '2021-06-03 06:57:06', '2021-06-03 06:57:06'),
(76, 'Dartha Tri Saputra', 'darthasaputra28@gmail.com', NULL, '$2y$10$eABT5T8L4dGuKZDtxtabmOjmXPg0mg3r63iSz8Me9Rktis.HE2TXO', 'mahasiswa', 'Gl8UfGewtp9Rtee7PvrJDKE3pFEMgzLIHcAQWL1mEZZZdS1TmejcWXMHarax', '2021-06-03 06:58:56', '2021-06-03 06:58:56'),
(77, 'Fazira Amadea Kamal', 'faziraamadea11@gmail.com', NULL, '$2y$10$moP88NYvx80tUTQGgoTSDeCNuI/L2bfvww65ANan4EpCobiSu5xA6', 'mahasiswa', 'pWd1YHMBn848GgNd8aqM4FW0VwAFxFR2adriM2z9UY7OUn8XxRKkG5pb29Zq', '2021-06-03 07:00:04', '2021-06-03 07:00:04'),
(78, 'Fikri Mulfi Muhammad Dinar', 'fikrimulmulfi77@gmail.com', NULL, '$2y$10$9Z1Ti47TUTNjEGODRNgLq.ztVh5g0GB6ULq0DCnCAkq.9Day5G67a', 'mahasiswa', 'nthCGbQ7uz8jlURu4lkeH0QOQNZwsfGIfdHoc8SyD7ATNrFaMPt7vmWk3Mx6', '2021-06-03 07:03:27', '2021-06-03 07:03:27'),
(79, 'Firza Mohammad Farid', 'firzamohfarid@gmail.com', NULL, '$2y$10$gRvQcqrhi2PCJLcojlR3XeykDWZu1sM3czWvNLEkf.2GFswYdxDHi', 'mahasiswa', 'mjvAHBpnRxYLJS0xU4jtEWlJ25skwCz9Sd5XWa8ZphBsWHGSYAsaxzFOtINu', '2021-06-03 07:04:31', '2021-06-03 07:04:31'),
(80, 'Golda Grathcia Novita Manggorani Sinaga', 'goldasinaga123@gmail.com', NULL, '$2y$10$Jd6UtMCUXKNu7z13A5JVCeeC6dNlrcD7ftPyuwnTnDv2YV6UCCtBe', 'mahasiswa', 'dkJu2SeiOSmoqRERLq8XNEhS7lwKI7bA1YP6VSltGKRLKfJFB3H8b2qvKZJD', '2021-06-03 07:05:39', '2021-06-03 07:05:39'),
(81, 'I Made Dwi Suputra Mahayana', 'imadedwisuputra@gmail.com', NULL, '$2y$10$HO3hCTDGCnWyxEPEA8m2PeYiQCmQxY1yJH3aMWdgFVO1K54dUBvTy', 'mahasiswa', 'uALgsR8KRc0huwnXZCe8TsBJ4ZyFSNsZSZT5sw80keUtx0g4nUKMYT2IrR0Q', '2021-06-03 07:06:34', '2021-06-03 07:06:34'),
(82, 'Imando Saputra Banjar Nahor', 'imandosaputra21@gmail.com', NULL, '$2y$10$XbdVOn1RryhALDfjP7LnIuqEXVpqcUazvpYyZOAJpb6.HIExBjPqK', 'mahasiswa', 'dcdfjqnDiZTqzzp2eWJVnupMbvDGLHAyfFy62vK8lrJjNqxiZ6aI35YgxI2W', '2021-06-03 07:07:57', '2021-06-03 07:07:57'),
(83, 'Kartika Alicia Syarief', 'kartikaalivcias@gmail.com', NULL, '$2y$10$h6ZQY4ASMkCGruBZl6U/d.zKOlIQ1GdbspigSTTNxKMNgztXPBcJi', 'mahasiswa', 'bInm3hhkMw6LVWDox9Q3DUe8RhQZ7CR0z2yfaFqLTsyyw8HECW36EhlJBG4Y', '2021-06-03 07:08:50', '2021-06-03 07:08:50'),
(84, 'Kristian Hengka Palanyo', 'hengkakristian21@gmail.com', NULL, '$2y$10$DYUwrqwxPN4nEYxvik2u8uVQ1bFMuR1.vhyrfeBmbtvHWKaeMzJ12', 'mahasiswa', 'zUIGXQKtVqGsjxRvJ41EHvrJ3WySGXYBWs1jnSdRWouQ3S08DM0mEC14Hc8g', '2021-06-03 07:10:08', '2021-06-03 07:10:08'),
(85, 'Mochamad Rifqi Fauzi Rachman', 'fauzirifqi696@gmail.com', NULL, '$2y$10$G31ke87rQCODZuSReMBQ3eiIIJhtac4qOCv6YhMW6Me2OjYqpVC82', 'mahasiswa', 'MVlt9n6Di2QGdGld1aVnjnWDy1UPZziqLQDGmdp43sC4ZNClf2vVuGA8lnUg', '2021-06-03 07:11:31', '2021-06-03 07:11:31'),
(86, 'Muhammad Chairul Luthfi Kamal', 'ayangkamal23@gmail.com', NULL, '$2y$10$EtT4dp2wwDa/QzFOyMoFBOXu7z.kEsse.nWWiwedt8CZgsirv9m5i', 'mahasiswa', 'M1FuLKtHhXc67B0EPYJCtLwQCkQnPlrqSUYBECRqlzYreMuULjVJ6bRrCGeM', '2021-06-03 07:12:35', '2021-06-03 07:12:35'),
(87, 'Nabila Putri Wisnu Pratami', 'nabilaputri2101@gmail.com', NULL, '$2y$10$gpJmc5Z18N6xEq8czVE6peQAguLMrgDv97zr5k2DSqGlEVrlKFp6m', 'mahasiswa', 'tFcaUXZ62899S3N56sJOocFQE7TiAgAtdP0COorOxRzolLDHLaACrhqrKWXv', '2021-06-03 07:13:35', '2021-06-03 07:13:35'),
(88, 'Nanda Ihsan Nashrulloh', 'nandaihsannn@gmail.com', NULL, '$2y$10$Q4XrkxzKAZ2PiM32/MKApOho7U7TVvRTwcRLvQBwdDQvU3m1h3FKK', 'mahasiswa', 'QoFl9WsgdeimPIaqdrDayHuSeQRtpvvsrtzGmecYaTCaEMLUSxFtuYJLEC7g', '2021-06-03 07:17:54', '2021-06-03 07:17:54'),
(89, 'Riyadhul Ulum', 'ulumriyadhul99@gmail.com', NULL, '$2y$10$MmBEfaID/vqky8IM356we.AyGKoXnWsBNfZsjeM6VQ51GT70ZGrJO', 'mahasiswa', 'fF3OtSTn6L5XZQVJnUx9hWbREQaIw1NWNcARlcyTsy8pzqS8bOxzm9kEDPEQ', '2021-06-03 07:18:35', '2021-06-03 07:18:35'),
(90, 'Sultan Tabah Muharam', 'sultantabahm@gmail.com', NULL, '$2y$10$0ulpPe7WiGVuXUrO6CfpZOR/zaKaBwCgxJAasirLWrES3SiCKldia', 'mahasiswa', '6w38ZnpNfA7J2kun0Ot7xb5SFNJq0WXVA7G09DAr3b03rGMU0z8lrQwtPnNJ', '2021-06-03 07:19:15', '2021-06-03 07:19:15'),
(91, 'Vidia Anggriani', 'anggrianividia@gmail.com', NULL, '$2y$10$MinHWz7ZZ/C9MCP.LTvCludj79UHkYUSyu96nh2TxMu61077356jG', 'mahasiswa', 'MZiXEVk2vkKGdTI4bIz2kjb7OwxoE77CR0iQfF0GpkTScTqEr58E7GHlzNIN', '2021-06-03 07:20:05', '2021-06-03 07:20:05'),
(92, 'Ahmad Mujahid', 'abdullahmuklis403@gmail.com', NULL, '$2y$10$OrBvrUrC4H7aNZR0iJcgjuLlKDyVRq11PhkxG4AiErqih4Ze.OzCq', 'mahasiswa', '5kHqbi06CsJs4Gmc21DGXKwADIULenV4Jt3RklEYyHHP4mbOuLq82koZuxPy', '2021-06-04 03:19:51', '2021-06-04 03:19:51'),
(93, 'Andi Waylani', 'pojokphotography@gmail.com', NULL, '$2y$10$giKDvR4VpZ8hThbnRhI2OuC7nILJV7pcf3qbbFhp8dCftzZ3Dr81S', 'mahasiswa', 'TZohZobjf3hB9petughhIywBI6aWe1WtTIYIve0vVX33yzTNFCj76vWvERjg', '2021-06-04 03:22:41', '2021-06-04 03:22:41'),
(94, 'Deby Habibah', 'debyhabibah93@gmail.com', NULL, '$2y$10$MGAQnTF71D34xPLl3ZHmr.IGCZHrsxYDHsIKiWmbuhxkJLvrJ2tnq', 'mahasiswa', 'wQ34qu3n7cRLpUIiTkdNQdnaUlc4pRhsot2BdQHC6PTFFzj4X76HlYQuWY5t', '2021-06-04 03:23:25', '2021-06-04 03:23:25'),
(95, 'Difo Dupatra Koster', 'divocoster@gmail.com', NULL, '$2y$10$6xX8wQmw7bb.8Bc6yudeme8C.vZQxs9dVd3uqmcvVN5LA/W.byzH2', 'mahasiswa', 'GuSjtdjiHbbqEtJ1BxjUB59uiVNFznGGDxcrYFP9ro9O5MOB5viWY4rr2cN3', '2021-06-04 03:23:59', '2021-06-04 03:23:59'),
(96, 'Fahrul Razi', 'fahrullrazii@gmail.com', NULL, '$2y$10$9mqY7ww8MxsTj3O2ZAvGmeugdbvS5zfY7OsbdyyquJ/BMvLS9zpQG', 'mahasiswa', 'CgTzrCYKTqQbsFSdzQGjlCaJELjBZBngWfsJ0ieOntqiMWCM8bDC0o3CikH9', '2021-06-04 03:24:31', '2021-06-04 03:24:31'),
(97, 'Firdha Fajriatunnisa', 'firdhafajriatunnissa123@gmail.com', NULL, '$2y$10$/9stqHweqPNZwyYhYMuPk.gAfllSNBqLs6ozfp0sDiSC3D9t1UPRS', 'mahasiswa', 'Io6bF2CCr4qWpnzwtHKalC6NzbxHxdDHrliZym4A4xUjleIyz9MOoHDyEGR3', '2021-06-04 03:25:29', '2021-06-04 03:25:29'),
(98, 'Ian Duar', 'ianduar@gmail.com', NULL, '$2y$10$gsbIrlkKKpOKO8QH0HEsK.vmx7ZSO1yc1LUb5WMPqHZiZ7UPmsVwO', 'mahasiswa', 'NMOwipgzwETXhAKshQ4ljTYcpLyjrk6lmJmwNfhwmDpC0PGDkAd8nz56wntN', '2021-06-04 03:26:00', '2021-06-04 03:26:00'),
(99, 'Jamaludin Kori', 'jamaludinqori18@gmail.com', NULL, '$2y$10$9MiLZjxTy3eKoBwygdlyJucZ4P.vHhCviQAlOgkWddWSsIZQ9naia', 'mahasiswa', 'wCDH8w1yHGvih8ySyi6jTHLOvf0xdzTP7rcj0Irp0jJgGAJ2SwIaa0U1QaJl', '2021-06-04 03:26:35', '2021-06-04 03:26:35'),
(100, 'Mardhyya Sana\'a Salamah', 'agalmaga@gmail.com', NULL, '$2y$10$.lHHN/KN0hUXCpf0Bzai9OlRAb3GBW0zkkAm6BoHPURhnOmj4T/da', 'mahasiswa', 'UrV0yEopKGZAPIoAFSV6wqHcCRB2lO8RsECqtvR8gUkGzB6NPApGQP2B3yVe', '2021-06-04 03:27:28', '2021-06-04 03:27:28'),
(101, 'Mochammad Abdul Aziz', 'mochaaziss@gmail.com', NULL, '$2y$10$RFLlrsq/5R.yfn7HixC5dep0XbkNZZbN3NR3FrOBIGhenU5vJa4qe', 'mahasiswa', 'IJqeV5yNjbF28oXXvDt6ohSBbYUfY0KraxzOBuaZgCEnfaXQw95qm0mkjJDw', '2021-06-04 03:28:01', '2021-06-04 03:28:01'),
(102, 'Mohammad Akif Kamaludin', 'akif.kamaludn@gmail.com', NULL, '$2y$10$PpZYXixBu9dYGZ/7Wqcq6.CIeZioKV73cypKSCbORtQQhVegllyP.', 'mahasiswa', 'kZ013Wx16pGlQ3x5mrGw36TX1PoUx236mOKcRY5oYw7HiYMiFX5KJQlLtoW7', '2021-06-04 03:29:13', '2021-06-04 03:29:13'),
(103, 'Mohammad Fajar Ryandhi', 'fajarfv18@gmail.com', NULL, '$2y$10$mumjqdKNc.jY2.C.0Oc36Oa2VzC86Y4sfKuIFbwnfIt3K6k2TZaha', 'mahasiswa', 'x7MBskIS5VU6lUyvd1YYVhGAqlndD1d91OasZKOpbKq7MMwkcXwqLNJ7OqgX', '2021-06-04 03:29:55', '2021-06-04 03:29:55'),
(104, 'Muhammad Faris Akbar', 'faris.akbar1721@gmail.com', NULL, '$2y$10$SBMjSvE9RWyW/KOD/jRObOTDp2w3ZHByppubQ6FyTQrirknvZwAK.', 'mahasiswa', 'oFvJFankY1tjMr50wYodbklaXAFvpvLbvfETUPgpRjww1OUE0HbjqYcrh8HL', '2021-06-04 03:30:36', '2021-06-04 03:30:36'),
(105, 'Muhammad Fillah Aditsyah', 'muhamadfillah1@gmail.com', NULL, '$2y$10$jJRrjCl9YMyEaenJRgi5i.ET6enyXjxe5hcU2YutT1MQwysehMTFq', 'mahasiswa', 'dKaMx9Yp0U2K1J15dAVWwVqwzcjAainFI2g5Zgs1G1h4aqfCmLCIDVVIJ4mX', '2021-06-04 03:34:00', '2021-06-04 03:34:00'),
(106, 'Muhammad Sahrul Aryanto', 'Msahrula2017@gmail.com', NULL, '$2y$10$Jq1aKE/1fm94ob.7yL1MBuVk7ZkNXtfZOvCUzlGGvx.pvOBjl4gc6', 'mahasiswa', 'bgbQ0lns9PuVkNT3qRhmGuLhvfwlUbbgHlDyrfnYUseGWghGBG225muxFPNI', '2021-06-04 03:34:42', '2021-06-04 03:34:42'),
(107, 'Muhammad bagas Ruseno Adjie', 'ruseno.adji271@gmail.com', NULL, '$2y$10$eWd0EZnywWKxKcY./IhEXObu7t.NABKsmgOLXG1aHMcRZglOCN9ZC', 'mahasiswa', 'XlJjhjavldCoaNTPZrSFcSRcoJr9n1jaTYXBOvf4aAho9K1UNXZp0O1Ferss', '2021-06-04 03:35:21', '2021-06-04 03:35:21'),
(108, 'Muhammad Rifqan', 'muhammad.rifqan1@gmail.com', NULL, '$2y$10$zNQckb0si.tNGHkHXj5OxOrvgg/zg01Ct0rsJ17dxnXbsLO15.c0.', 'mahasiswa', 'HlCegXcWqxybXVuSJiFmZkGuqKskVdMoEvUqmptbCwevIRlwdXaZ7YkXR2vr', '2021-06-04 03:36:05', '2021-06-04 03:36:05'),
(109, 'Muhammad Rizqi Rafi', 'rizqyrafi@gmail.com', NULL, '$2y$10$9k7xSALfU8LgGVAIcvkuU.paCGrKRVXdvJTPCkaBuzufFUN8Avrxi', 'mahasiswa', 'sIda3ATebKwkmwfyCHrzqaeIwrQtekBMAVMckKmS3TxmlSvevCYzT1eQqcob', '2021-06-04 03:37:03', '2021-06-04 03:37:03'),
(110, 'Pangestu Eko Lariyanto', 'pangestueko20@gmail.com', NULL, '$2y$10$xnm2R5tY96YiN.g54Ha6COpd9mc9Cf398PUjhLhXENLYSPC3oUR9e', 'mahasiswa', 'HH8yAWb7gxGGA0Ah49NWwBCTaRzRQ5QNI76ONoPll3ihHMHCX82CxUBLkOCE', '2021-06-04 03:37:55', '2021-06-04 03:37:55'),
(111, 'Putra Deswijaya', 'putradswj@gmail.com', NULL, '$2y$10$o41PcZGmiczzMd7Ns5TcX.iKs3S2jcKxvqrWpwB2ECsPMiHg8Oc9u', 'mahasiswa', 'TQax7Mq2271c5rT18ntPr1vdg0dxsI4OMnpUFaRKBaAaYuyfa6rvMvRkDdx8', '2021-06-04 03:38:48', '2021-06-04 03:38:48'),
(112, 'Ratu Shifa Alamanda', 'ratushifaa@gmail.com', NULL, '$2y$10$7Oo4ynMeAECl4BB.sthrG.WX0IE0AI28hsDOluIuXc5maHUUUOqIe', 'mahasiswa', 'KJ0hTtGb4J6jM0pmfWhV7UZrIzWiwq0g386rHPBGH7S1vEEAX9rxlTLU6swS', '2021-06-04 03:39:28', '2021-06-04 03:39:28'),
(113, 'Rayhan Revi Fadzillah', 'rehanrevi54@gmail.com', NULL, '$2y$10$BCNjPSOHt4kVDtncV9SyOORN.o9pG4oi8LjMhfR28ZU9wboKyvDq2', 'mahasiswa', '9gFiMwbxD6tpGC5l7uKdhBSQ5iGpRCr68T3yvt4G4QgfuIfTS6MlVoiUdRDY', '2021-06-04 03:40:20', '2021-06-04 03:40:20'),
(114, 'Ricki Darmawan', 'darmawanricki7@gmail.con', NULL, '$2y$10$jBWXLyqB6LGm2Nz4CUNuBOA8EqhKrUyEl4lMgpxSVEE8wW9KfYYSa', 'mahasiswa', 'JTTARJWqAG9gnbXgzYkV0BaWwndaoPzSJrQ0wrpTElfQdcWQQ4koWcyy2TPx', '2021-06-04 03:41:33', '2021-06-04 03:41:33'),
(115, 'Rizki  Hidatullah', 'rzkhidayatullah@gmail.com', NULL, '$2y$10$ur0s.PGHSfQS6qjcRsOitOwp3jhKP6889i3eWejNx8V4BuCagQGa6', 'mahasiswa', 'F1HA5WroIFOUQH2xWeem7sM6sPoug2ASjCQRMcYmAwf6JKgVubCpd52gG6rz', '2021-06-04 03:42:54', '2021-06-04 03:42:54'),
(116, 'Samuel Unedo Simbolon', 'samuelunedosimbolon02@gmail.com', NULL, '$2y$10$CyuKq3oV9vvBoyf69NeGhe1ddSgCf3aISvJHo0jbX0TC75yBsG.de', 'mahasiswa', 'u1hiPmha7Ba3vT6n5FcYrPb7ww8RRKEacXapfRAIE3QWpWlpByusdV8lZPzF', '2021-06-04 03:43:44', '2021-06-04 03:43:44'),
(117, 'Sukma Puspita Dhevi', 'dewitari110@gmail.com', NULL, '$2y$10$p9yXshjJb5BThpD.2WuyVOY9jSxl71jMhXBdeCATqWIrOHZ3hXNmy', 'mahasiswa', 'tNrHVUhSRbmRTQ97MSRDArMJXmmN34aYcvlwXldSYNoA9bizUcbb8TqV9tHm', '2021-06-04 03:44:29', '2021-06-04 03:44:29'),
(118, 'Selvianti', 'Selvianti3112@gmail.com', NULL, '$2y$10$Eo6VDekFg5GsvcQTHi6FmOij6p6IKarEjxMSMk0CW4R5VYjt6tMY6', 'mahasiswa', '9Q9kIue0I7nvE2WYSJ6jgfwIcr98KzQuUdCY0lX4QtiCgwnRz46TLPRsdskv', '2021-06-04 03:44:55', '2021-06-04 03:44:55'),
(119, 'Wahyu Suryanto', 'wahyumaretasuryantoanggraini@gmail.com', NULL, '$2y$10$RPZXUtljFSnkcz2pAJRmx.8juuUmwSeZAWrW0tlyctke.6SSv73Ea', 'mahasiswa', 'RKgZnvadqub4rIt51QQHiZpwzoYE2HlBMtrqUfXrgq09ssijUEbXtyeN2FkI', '2021-06-04 03:45:33', '2021-06-04 03:45:33'),
(122, 'admin', 'admin@admin.com', NULL, '$2y$10$pw3h5sR3uPW840biMldotuWcDqgDFRrO5SKdBHBMc1i9F3DkR9A9u', 'admin', 'R8bRemx8itf2MYLBJ1BUFgQYzYjtmXaKYvv7mWyO3mYtNz5Ekkh7kIB2Rvpg', '2021-06-17 06:20:48', '2021-06-17 06:22:03'),
(123, 'Infantri Putra', 'infantri.putra@esdm.go.id', NULL, '$2y$10$ecF3gwkfvtaxzBNtWGQEwe3Ew8PDJ.PEXYzF3q.llAA4hzJY9sGKG', 'dosenpembimbing', 'gBF3YcA4xvZLmY7R6ciMOLIBNIOxzPbkQReVPTkOBNZv1nh8O59LxkeBqbkM', '2021-06-17 07:34:18', '2021-06-17 07:34:18'),
(124, 'Yudi rahayudi', 'yudi.rahayudin@esdm.go.id', NULL, '$2y$10$C7RqLvO4UlTFOXnVDs0A7u92zH2T6DeB6sMVInxec90mb8vOMWK2W', 'dosenpembimbing', 'mUHVlXPwI2dgeWpCALJeXGkCOPSb8WhJz7pNLnAnFQmuc2c3f8pQmHIoKHBc', '2021-06-17 07:40:37', '2021-06-17 07:40:37'),
(125, 'Mesias Citra Dewi', 'mesias.dewi@esdm.go.id', NULL, '$2y$10$MNxpjeuQxIqfmVJ/J8OHG.BAI5IgYFgS7CK9IVTlH.Sxjw5mpJk3m', 'dosenpembimbing', 'MVsWCAKc6MA72tVVCQAwcyEgbn4CK6uV1wntCyqYFN77vqG09cJodNosniHw', '2021-06-17 07:42:44', '2021-06-17 07:42:44'),
(126, 'Dian Eka Aryanti', 'dian.aryanti@esdm.go.id', NULL, '$2y$10$7iHF5meJzRexqMjTf3cf/uulCQUcwKVJyveCZBKjHTs6HFCUmQpOK', 'dosenpembimbing', 'f15GqYVDucaceXHpXQItpIo6ZFq3Tr9FdRWTUEGSzI0Rm6tkiZTjK4i8CDm5', '2021-06-17 07:43:27', '2021-06-17 07:43:27'),
(127, 'Tes Pembimbing Lapangan 1', 'tesseract@tex123446.com', NULL, '$2y$10$MJ1sMCDyE6DXgv2/yMnQC.WvFJC39PREj0Tddik3zmB1qTvKIBlx2', 'pembimbingindustri', 'rp2r3qynXE3USyX0xNDdYOb45QplRfbYD36F2cEZGjRrkdQ8hTLkLZlkNJjb', '2021-07-03 12:31:33', '2021-07-03 12:31:33'),
(128, 'Apud Djadjulie', 'apuddjajulie@gmail.com', NULL, '$2y$10$5mzHVgRLKcBXfJg1zGkgi.Z1evuHj/PnxlK9Uto2Ujcn7GEgahSbi', 'dosenpembimbing', 'AI4EMJIwQh9QFqJrSTaoFFKLQ8Iy2DfwXgqoXcCCAj15ZOl9qC4Oq0JFaaQN', '2021-07-22 06:17:14', '2021-07-22 06:17:14'),
(129, 'Bouman Tiroi Situmorang', 'boumant@yahoo.com', NULL, '$2y$10$htVwXiD8M0tYg./4uPIiC.QVh1QxH1cyxP1ia3EUJQ2ZiH4Uy.aIq', 'dosenpembimbing', 'nrQkmkYxHX2FPNfnMaIydtU8Tykf2Mkbnxt5nLWyocKG6gjvN9Lc6ck4Sr3X', '2021-07-22 06:49:22', '2021-07-22 06:49:22'),
(130, 'Priatna', 'priatna@esdm.go.id', NULL, '$2y$10$ZeqmKdZzTjHgfu9/G0cGye3lQq46bkoqnRMfTFiFhv/EMqQA9RO5m', 'dosenpembimbing', 'GpJn19r4T1EEpBbXaNGjey1lN2bkZtZdwsWhZ80W3wJ1rbvf8tWGPDBOS3DV', '2021-07-22 08:08:40', '2021-07-22 08:08:40'),
(131, 'Oman Abdurohman', 'oman.abdurahman@esdm.go.id', NULL, '$2y$10$lLCRPLE4X3Z16ug21Ta1L.S0dLT5JpiSOsv/8btD/vSzfRHnFLIAG', 'dosenpembimbing', 'MILE0IKoQlHcM3P4sBWIINTIfSylvR7RTQ11C7SkU3DsUqnyvIVrDlC18Tg9', '2021-07-22 08:11:00', '2021-07-22 08:11:00'),
(132, 'Benny Bensaman', 'bensaman@gmail.com', NULL, '$2y$10$nbXzoeS/vhhMhruC8N45MeEtAVs4yuce0wY.IZnHYTKoZPzh3ko8C', 'dosenpembimbing', '9vHHPMoBFROSUA1YyZ1aDaRUizJMGqvclTODfqmLZczMCQxg1dOFaHHsk0rK', '2021-07-22 08:11:48', '2021-07-22 08:11:48'),
(133, 'Achmad Djumarma Wirakusumah', 'ade.wirakusumah@gmail.com', NULL, '$2y$10$MoVMJglFP68jFywIhFCAJeLFfRORACxkG9L5Y/dL/vMsCdF1DiXnu', 'dosenpembimbing', 'xGSks2JTv7PYdtbkX5hc8ZuCTY3WlcMMGL3iPHeSPq2iVOl4VHmk2VpQgJv4', '2021-07-22 08:18:46', '2021-07-22 08:18:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_bimbingan`
--
ALTER TABLE `data_bimbingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_kompetensi`
--
ALTER TABLE `data_kompetensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_laporan`
--
ALTER TABLE `data_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosenpembimbing`
--
ALTER TABLE `dosenpembimbing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `industri`
--
ALTER TABLE `industri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_capaian`
--
ALTER TABLE `master_capaian`
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
-- Indexes for table `pembimbingindustri`
--
ALTER TABLE `pembimbingindustri`
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
-- AUTO_INCREMENT for table `data_bimbingan`
--
ALTER TABLE `data_bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `data_kompetensi`
--
ALTER TABLE `data_kompetensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `data_laporan`
--
ALTER TABLE `data_laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `dosenpembimbing`
--
ALTER TABLE `dosenpembimbing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `industri`
--
ALTER TABLE `industri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `master_capaian`
--
ALTER TABLE `master_capaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembimbingindustri`
--
ALTER TABLE `pembimbingindustri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
