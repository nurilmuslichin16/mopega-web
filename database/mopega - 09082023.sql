-- --------------------------------------------------------
-- Host:                         mopega.my.id
-- Server version:               8.0.34-cll-lve - MySQL Community Server - GPL
-- Server OS:                    Linux
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for mopegamy_mopega
CREATE DATABASE IF NOT EXISTS `mopegamy_mopega` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mopegamy_mopega`;

-- Dumping structure for table mopegamy_mopega.tb_gangguan
CREATE TABLE IF NOT EXISTS `tb_gangguan` (
  `id_gangguan` int NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int NOT NULL,
  `tiket` varchar(10) NOT NULL,
  `ket` text NOT NULL,
  `report_date` datetime NOT NULL,
  `booking_date` datetime NOT NULL,
  `teknisi` int DEFAULT NULL,
  `status` tinyint NOT NULL,
  `send_order_at` datetime DEFAULT NULL,
  `otw_at` datetime DEFAULT NULL,
  `ogp_at` datetime DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL,
  `penyebab` text NOT NULL,
  `perbaikan` text NOT NULL,
  PRIMARY KEY (`id_gangguan`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table mopegamy_mopega.tb_gangguan: ~6 rows (approximately)
INSERT INTO `tb_gangguan` (`id_gangguan`, `id_pelanggan`, `tiket`, `ket`, `report_date`, `booking_date`, `teknisi`, `status`, `send_order_at`, `otw_at`, `ogp_at`, `closed_at`, `penyebab`, `perbaikan`) VALUES
	(3, 2, 'IN3452', 'TV tidak muncul channelnya', '2023-01-05 07:10:07', '2023-01-05 10:10:07', 232335772, 4, '2023-01-08 06:55:21', '2023-01-08 09:41:06', '2023-01-08 09:53:12', '2023-01-08 10:52:43', 'Kabel dimakan tikus', 'Tarik ulang'),
	(5, 8, 'IN31656', 'ONT Mati tidak bisa koneksi internet', '2023-07-16 07:46:59', '2023-07-16 12:46:59', 232335772, 4, '2023-07-17 21:02:16', '2023-07-17 21:40:31', '2023-07-17 21:40:44', '2023-07-17 21:41:00', 'kabel dropcore putus', 'tarik kabel ulang'),
	(6, 8, 'IN29379', 'ONT Mati sehingga tidak bisa koneksi internet', '2023-07-16 08:02:14', '2023-07-16 13:02:14', 232335772, 4, '2023-07-16 10:56:36', '2023-07-16 10:41:31', '2023-07-16 10:43:24', '2023-07-16 10:43:37', 'kabel dropcore putus', 'tarik kabel ulang'),
	(9, 1, 'IN49133', 'Coba kirim', '2023-07-16 08:13:29', '2023-07-16 13:13:29', 232335772, 4, '2023-07-16 10:46:01', '2023-07-16 10:26:36', '2023-07-16 10:27:30', '2023-07-16 10:29:06', 'kabel dropcore putus', 'tarik kabel ulang'),
	(10, 3, 'IN8323', 'Internet LOSS', '2023-07-17 21:19:37', '2023-07-18 01:19:37', 136684722, 4, '2023-08-01 21:47:01', '2023-08-01 21:47:23', '2023-08-01 21:48:38', '2023-08-01 21:50:01', 'kabel puts', 'sambung kabel'),
	(11, 6, 'IN6375', 'internet los', '2023-07-20 17:48:43', '2023-07-20 20:48:43', 136684722, 4, '2023-07-20 17:51:44', '2023-07-20 17:52:06', '2023-07-20 17:53:34', '2023-07-20 17:54:49', 'dimakan tikus', 'sambung kabel'),
	(13, 8, 'IN93086', 'los', '2023-08-02 09:29:35', '2023-08-02 14:29:35', 136684722, 4, '2023-08-02 10:51:33', '2023-08-02 11:05:31', '2023-08-02 11:06:42', '2023-08-09 05:33:24', 'kabel dimakan tikus', 'sambung kabel'),
	(14, 10, 'IN30699', 'inter tidak konek', '2023-08-02 10:46:33', '2023-08-02 15:46:33', 136684722, 4, '2023-08-02 10:52:24', '2023-08-02 10:53:10', '2023-08-02 10:55:43', '2023-08-02 10:56:35', 'kabel dimakan tikus', 'sambung kabel'),
	(15, 8, 'IN80674', 'internet los', '2023-08-09 05:22:49', '2023-08-09 10:22:49', 136684722, 4, '2023-08-09 05:25:55', '2023-08-09 05:26:48', '2023-08-09 05:26:56', '2023-08-09 05:27:20', 'kabel dimakan tikus', 'sambung kabel');

-- Dumping structure for table mopegamy_mopega.tb_log
CREATE TABLE IF NOT EXISTS `tb_log` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_gangguan` int NOT NULL,
  `action` tinyint NOT NULL COMMENT '0 : Wait Order, 1 : Ordered, 2 : On The Way, 3 : On Going Progress, 4 : Closed',
  `keterangan` text NOT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table mopegamy_mopega.tb_log: ~54 rows (approximately)
INSERT INTO `tb_log` (`id_log`, `id_gangguan`, `action`, `keterangan`, `waktu`) VALUES
	(1, 1, 0, 'Laporan gangguan berhasil di buat', '2023-01-03 06:51:03'),
	(2, 1, 1, 'Order Gangguan berhasil dikirim ke teknisi', '2023-01-03 07:51:03'),
	(3, 1, 2, 'Teknisi menuju lokasi pelanggan', '2023-01-03 08:51:03'),
	(4, 1, 3, 'Teknisi sedang melakukan pengecekan gangguan', '2023-01-03 09:51:03'),
	(5, 1, 4, 'Gangguan berhasil dikerjakan dan jaringan sudah normal', '2023-01-03 10:51:03'),
	(6, 2, 0, 'Internet lemot, tagihan sudah lunas.', '2023-01-05 00:46:06'),
	(7, 3, 0, 'TV tidak muncul channelnya', '2023-01-05 07:10:07'),
	(9, 3, 1, 'Order Gangguan berhasil dikirim ke teknisi', '2023-01-08 06:55:21'),
	(10, 3, 2, 'Teknisi menuju lokasi pelanggan', '2023-01-08 10:11:36'),
	(11, 3, 3, 'Teknisi sedang melakukan pengecekan gangguan', '2023-01-08 10:11:47'),
	(13, 3, 4, 'Gangguan berhasil dikerjakan dan jaringan sudah normal', '2023-01-08 10:52:43'),
	(14, 4, 0, 'ONT Mati tidak bisa koneksi internet', '2023-07-16 07:44:28'),
	(15, 5, 0, 'ONT Mati tidak bisa koneksi internet', '2023-07-16 07:46:59'),
	(16, 6, 0, 'ONT Mati sehingga tidak bisa koneksi internet', '2023-07-16 08:02:14'),
	(17, 7, 0, 'Kokokokkokwoekowewwoekowke', '2023-07-16 08:05:07'),
	(18, 8, 0, 'Kokokokkokwoekowewwoekowke', '2023-07-16 08:08:41'),
	(19, 9, 0, 'Coba kirim', '2023-07-16 08:13:29'),
	(20, 9, 1, 'Order Gangguan berhasil dikirim ke teknisi', '2023-07-16 10:46:01'),
	(21, 9, 2, 'Teknisi menuju lokasi pelanggan', '2023-07-16 10:26:36'),
	(22, 9, 3, 'Teknisi sedang melakukan pengecekan gangguan', '2023-07-16 10:27:30'),
	(23, 9, 4, 'Gangguan berhasil dikerjakan dan jaringan sudah normal', '2023-07-16 10:29:06'),
	(24, 6, 1, 'Order Gangguan berhasil dikirim ke teknisi', '2023-07-16 10:56:36'),
	(26, 6, 2, 'Teknisi menuju lokasi pelanggan', '2023-07-16 10:41:31'),
	(27, 6, 3, 'Teknisi sedang melakukan pengecekan gangguan', '2023-07-16 10:43:24'),
	(28, 6, 4, 'Gangguan berhasil dikerjakan dan jaringan sudah normal', '2023-07-16 10:43:37'),
	(29, 5, 1, 'Order Gangguan berhasil dikirim ke teknisi', '2023-07-17 21:02:16'),
	(30, 10, 0, 'Internet LOSS', '2023-07-17 21:19:37'),
	(31, 5, 2, 'Teknisi menuju lokasi pelanggan', '2023-07-17 21:40:31'),
	(32, 5, 3, 'Teknisi sedang melakukan pengecekan gangguan', '2023-07-17 21:40:44'),
	(33, 5, 4, 'Gangguan berhasil dikerjakan dan jaringan sudah normal', '2023-07-17 21:41:00'),
	(34, 11, 0, 'internet los', '2023-07-20 17:48:43'),
	(35, 11, 1, 'Order Gangguan berhasil dikirim ke teknisi', '2023-07-20 17:51:44'),
	(36, 11, 2, 'Teknisi menuju lokasi pelanggan', '2023-07-20 17:52:06'),
	(37, 11, 3, 'Teknisi sedang melakukan pengecekan gangguan', '2023-07-20 17:53:34'),
	(38, 11, 4, 'Gangguan berhasil dikerjakan dan jaringan sudah normal', '2023-07-20 17:54:49'),
	(39, 12, 0, 'lampu modem nyala merah', '2023-08-01 21:41:53'),
	(40, 10, 1, 'Order Gangguan berhasil dikirim ke teknisi', '2023-08-01 21:47:01'),
	(41, 10, 2, 'Teknisi menuju lokasi pelanggan', '2023-08-01 21:47:23'),
	(42, 10, 3, 'Teknisi sedang melakukan pengecekan gangguan', '2023-08-01 21:48:38'),
	(43, 10, 4, 'Gangguan berhasil dikerjakan dan jaringan sudah normal', '2023-08-01 21:50:01'),
	(44, 13, 0, 'los', '2023-08-02 09:29:35'),
	(45, 14, 0, 'inter tidak konek', '2023-08-02 10:46:33'),
	(46, 13, 1, 'Order Gangguan berhasil dikirim ke teknisi', '2023-08-02 10:51:33'),
	(47, 14, 1, 'Order Gangguan berhasil dikirim ke teknisi', '2023-08-02 10:52:24'),
	(48, 14, 2, 'Teknisi menuju lokasi pelanggan', '2023-08-02 10:53:10'),
	(49, 14, 3, 'Teknisi sedang melakukan pengecekan gangguan', '2023-08-02 10:55:43'),
	(50, 14, 4, 'Gangguan berhasil dikerjakan dan jaringan sudah normal', '2023-08-02 10:56:35'),
	(51, 13, 2, 'Teknisi menuju lokasi pelanggan', '2023-08-02 11:05:31'),
	(52, 13, 3, 'Teknisi sedang melakukan pengecekan gangguan', '2023-08-02 11:06:42'),
	(53, 15, 0, 'internet los', '2023-08-09 05:22:49'),
	(54, 15, 1, 'Order Gangguan berhasil dikirim ke teknisi', '2023-08-09 05:25:55'),
	(55, 15, 2, 'Teknisi menuju lokasi pelanggan', '2023-08-09 05:26:48'),
	(56, 15, 3, 'Teknisi sedang melakukan pengecekan gangguan', '2023-08-09 05:26:56'),
	(57, 15, 4, 'Gangguan berhasil dikerjakan dan jaringan sudah normal', '2023-08-09 05:27:20'),
	(58, 13, 4, 'Gangguan berhasil dikerjakan dan jaringan sudah normal', '2023-08-09 05:33:24');

-- Dumping structure for table mopegamy_mopega.tb_odp
CREATE TABLE IF NOT EXISTS `tb_odp` (
  `id_odp` int NOT NULL AUTO_INCREMENT,
  `nama_odp` varchar(50) NOT NULL,
  `koordinat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_odp`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table mopegamy_mopega.tb_odp: ~5 rows (approximately)
INSERT INTO `tb_odp` (`id_odp`, `nama_odp`, `koordinat`) VALUES
	(1, 'ODP-PKL-FN/107', '-7.01729793311838, 109.59716656625423'),
	(2, 'ODP-KDW-FC/029', '-6.893792810591495, 109.66696209008603'),
	(3, 'ODP-KDW-FA/001', '-6.890810445570343, 109.63022655470196'),
	(4, 'ODP-KJE-FN/023', '-6.961885116344638, 109.63475862419654'),
	(5, 'ODP-KDW-FA/087', '-6.992586048558718, 109.51458910917236');

-- Dumping structure for table mopegamy_mopega.tb_pelanggan
CREATE TABLE IF NOT EXISTS `tb_pelanggan` (
  `id_pelanggan` int NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_internet` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_voice` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `odp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `port` tinyint DEFAULT NULL,
  `sn_ont` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tipe` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_hp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `kota_kab` varchar(100) DEFAULT NULL,
  `kec` varchar(100) DEFAULT NULL,
  `kel` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table mopegamy_mopega.tb_pelanggan: ~5 rows (approximately)
INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_internet`, `no_voice`, `odp`, `port`, `sn_ont`, `tipe`, `email`, `no_hp`, `alamat`, `kota_kab`, `kec`, `kel`) VALUES
	(1, 'Nuril Muslichin', '142265342612', '02851627162', 'ODP-PKL-FN/107', 2, 'FHTT16T26H77', 'Indihome', 'nurilmuslichin16@gmail.com', '085229531170', 'Kramatsari ', NULL, NULL, NULL),
	(2, 'Seto Prayoga Putra', '14226537263', '0285172612', 'ODP-KDW-FA/087', 3, 'ZTEG09JUYD66', 'BGES / VPN IP', 'seto@gmail.com', '085263537262', 'Jl Pemuda No.45 Kota Pekalongan', NULL, NULL, NULL),
	(3, 'Fitriyah', '14222737648', '0285779228', 'ODP-KDW-FA/001', 8, 'FHTT87263527', 'WIFI ID', 'nurilmuslichin16@gmail.com', '085229531170', 'JL Pemuda No.45', NULL, NULL, NULL),
	(6, 'Andi Irawan', '14232323232', '28537272', 'ODP-KDW-FA/001', 1, 'FHTT920392', 'BGES / VPN IP', 'setokecret@gmail.com', '082232661066', 'karanganyar', NULL, NULL, NULL),
	(7, 'Indah Anindya', '14253442221', '28312215', 'ODP-KJE-FN/023', 4, 'ZTEG822HFJ', 'WIFI ID', 'indahanindya@gmail.com', '85324142331', 'Kajen', NULL, NULL, NULL),
	(8, 'Adi Nugroho', '14426635272', '085226374', 'ODP-KDW-FC/029', 2, 'FHTT52YGTT', 'Indihome', 'setokecret@gmail.com', '082232661066', 'Kramatsari 2', 'Kota Pekalongan', 'Pekalongan Barat', 'Pasirkratonkramat'),
	(9, 'manusia harimau', '1422191687', '0285156678', 'ODP-KDW-FA/001', 8, 'FHTT920392', 'Indihome', 'setokecret@gmail.com', '082232661066', 'legokkalonga karanganyar', NULL, NULL, NULL),
	(10, 'wahid', '12345678', '0823287', 'ODP-KDW-FA/001', 8, 'FHTT920392', 'Indihome', 'wahid@gmail.com', '082232661066', 'pekalongan', NULL, NULL, NULL),
	(11, 'Ardian Syarifudin', '142233222121', '0285332112', 'ODP-PKL-FG/101', 2, 'ZTEG122HSYAR', 'BGES / VPN IP', 'ardiansyarifudin7@gmail.com', '085229332212', 'Jl Umar 123', 'Kota Pekalongan', 'Pekalongan Timur', 'Noyontaan');

-- Dumping structure for table mopegamy_mopega.tb_teknisi
CREATE TABLE IF NOT EXISTS `tb_teknisi` (
  `id_telegram` bigint NOT NULL DEFAULT '0',
  `nik` int NOT NULL,
  `nama_teknisi` varchar(50) NOT NULL,
  `mitra` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_telegram`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table mopegamy_mopega.tb_teknisi: ~0 rows (approximately)
INSERT INTO `tb_teknisi` (`id_telegram`, `nik`, `nama_teknisi`, `mitra`, `status`) VALUES
	(136684722, 20961046, 'seto prajoko', 'TA', 0),
	(232335772, 16021999, 'Nuril Muslichin', 'KOPEGTEL', 0);

-- Dumping structure for table mopegamy_mopega.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table mopegamy_mopega.tb_user: ~0 rows (approximately)
INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `email`, `password`, `level`, `status`, `last_login`) VALUES
	(1, 'Team Leader', 'admin@gmail.com', '$2y$10$IjRv6I5uuuxyc0VViNufa.1k8KOoEIbuYrO8onFVmmvgJ2nE4ZH3G', 1, 1, '2023-08-09 18:29:23');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
