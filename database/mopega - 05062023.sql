-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.22-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
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


-- Dumping database structure for mopega
CREATE DATABASE IF NOT EXISTS `mopega` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `mopega`;

-- Dumping structure for table mopega.tb_gangguan
CREATE TABLE IF NOT EXISTS `tb_gangguan` (
  `id_gangguan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NOT NULL,
  `tiket` varchar(10) NOT NULL,
  `ket` text NOT NULL,
  `report_date` datetime NOT NULL,
  `booking_date` datetime NOT NULL,
  `teknisi` int(11) DEFAULT NULL,
  `status` tinyint(2) NOT NULL,
  `send_order_at` datetime DEFAULT NULL,
  `otw_at` datetime DEFAULT NULL,
  `ogp_at` datetime DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL,
  `penyebab` text NOT NULL DEFAULT '-',
  `perbaikan` text NOT NULL DEFAULT '-',
  PRIMARY KEY (`id_gangguan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mopega.tb_gangguan: ~3 rows (approximately)
INSERT INTO `tb_gangguan` (`id_gangguan`, `id_pelanggan`, `tiket`, `ket`, `report_date`, `booking_date`, `teknisi`, `status`, `send_order_at`, `otw_at`, `ogp_at`, `closed_at`, `penyebab`, `perbaikan`) VALUES
	(1, 1, 'IN12345', 'Wifi tidak bisa connect', '2023-01-03 06:51:03', '2023-01-03 09:51:04', 232335772, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kabel fiber optic putus digigit tikus', 'Tarik ulang kabel FO dari ODP 150M'),
	(2, 1, 'IN12921', 'Internet lemot, tagihan sudah lunas.', '2023-01-05 00:46:06', '2023-01-05 05:46:06', NULL, 0, NULL, NULL, NULL, NULL, '-', '-'),
	(3, 2, 'IN3452', 'TV tidak muncul channelnya', '2023-01-05 07:10:07', '2023-01-05 10:10:07', 232335772, 4, '2023-01-08 06:55:21', '2023-01-08 09:41:06', '2023-01-08 09:53:12', '2023-01-08 10:52:43', 'Kabel dimakan tikus', 'Tarik ulang');

-- Dumping structure for table mopega.tb_log
CREATE TABLE IF NOT EXISTS `tb_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_gangguan` int(11) NOT NULL,
  `action` tinyint(2) NOT NULL COMMENT '0 : Wait Order, 1 : Ordered, 2 : On The Way, 3 : On Going Progress, 4 : Closed',
  `keterangan` text NOT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mopega.tb_log: ~11 rows (approximately)
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
	(13, 3, 4, 'Gangguan berhasil dikerjakan dan jaringan sudah normal', '2023-01-08 10:52:43');

-- Dumping structure for table mopega.tb_pelanggan
CREATE TABLE IF NOT EXISTS `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(50) NOT NULL,
  `no_internet` varchar(20) NOT NULL,
  `no_voice` varchar(20) NOT NULL,
  `odp` varchar(20) NOT NULL,
  `port` tinyint(2) NOT NULL,
  `sn_ont` varchar(20) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mopega.tb_pelanggan: ~3 rows (approximately)
INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_internet`, `no_voice`, `odp`, `port`, `sn_ont`, `tipe`, `email`, `no_hp`, `alamat`) VALUES
	(1, 'Nuril Muslichin', '142265342612', '02851627162', 'ODP-PKL-FN/107', 2, 'FHTT16T26H77', 'Indihome', 'admin@gmail.com', '086227327232', 'Lapangan Bebekan '),
	(2, 'Seto Prayoga Putra', '14226537263', '0285172612', 'ODP-KDW-FA/087', 3, 'ZTEG09JUYD66', 'BGES / VPN IP', 'seto@gmail.com', '085263537262', 'Jl Pemuda No.45 Kota Pekalongan'),
	(3, 'Fitriyah', '14222737648', '0285779228', 'ODP-KDW-FA/001', 8, 'FHTT87263527', 'WIFI ID', 'fitriyah@gmail.com', '087663773642', 'Kedungwuni Gg13 ');

-- Dumping structure for table mopega.tb_teknisi
CREATE TABLE IF NOT EXISTS `tb_teknisi` (
  `id_telegram` bigint(19) NOT NULL DEFAULT 0,
  `nik` int(11) NOT NULL,
  `nama_teknisi` varchar(50) NOT NULL,
  `mitra` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_telegram`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mopega.tb_teknisi: ~2 rows (approximately)
INSERT INTO `tb_teknisi` (`id_telegram`, `nik`, `nama_teknisi`, `mitra`, `status`) VALUES
	(232335771, 997282, 'Seto Setiawan', 'TELKOM AKSES', 0),
	(232335772, 16021999, 'Nuril Muslichin', 'KOPEGTEL', 1);

-- Dumping structure for table mopega.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mopega.tb_user: ~0 rows (approximately)
INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `email`, `password`, `level`, `status`, `last_login`) VALUES
	(1, 'Team Leader', 'admin@gmail.com', '$2y$10$IjRv6I5uuuxyc0VViNufa.1k8KOoEIbuYrO8onFVmmvgJ2nE4ZH3G', 1, 1, '2023-07-03 19:49:58');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
