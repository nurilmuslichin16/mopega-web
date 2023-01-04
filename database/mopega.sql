-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jan 2023 pada 01.25
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mopega`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gangguan`
--

CREATE TABLE `tb_gangguan` (
  `id_gangguan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tiket` varchar(10) NOT NULL,
  `ket` text NOT NULL,
  `report_date` datetime NOT NULL,
  `booking_date` datetime NOT NULL,
  `teknisi` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `send_order_at` datetime DEFAULT NULL,
  `otw_at` datetime DEFAULT NULL,
  `ogp_at` datetime DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL,
  `penyebab` text NOT NULL DEFAULT '-',
  `perbaikan` text NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_gangguan`
--

INSERT INTO `tb_gangguan` (`id_gangguan`, `id_pelanggan`, `tiket`, `ket`, `report_date`, `booking_date`, `teknisi`, `status`, `send_order_at`, `otw_at`, `ogp_at`, `closed_at`, `penyebab`, `perbaikan`) VALUES
(1, 1, 'IN12345', 'Wifi tidak bisa connect', '2023-01-03 06:51:03', '2023-01-03 09:51:04', 232335772, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '-', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_log`
--

CREATE TABLE `tb_log` (
  `id_log` int(11) NOT NULL,
  `id_gangguan` int(11) NOT NULL,
  `action` tinyint(2) NOT NULL COMMENT '0 : Wait Order, 1 : Ordered, 2 : On The Way, 3 : On Going Progress, 4 : Closed',
  `keterangan` text NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_log`
--

INSERT INTO `tb_log` (`id_log`, `id_gangguan`, `action`, `keterangan`, `waktu`) VALUES
(1, 1, 0, 'Laporan gangguan berhasil di buat', '2023-01-03 06:51:03'),
(2, 1, 1, 'Order Gangguan berhasil dikirim ke teknisi', '2023-01-03 07:51:03'),
(3, 1, 2, 'Teknisi menuju lokasi pelanggan', '2023-01-03 08:51:03'),
(4, 1, 3, 'Teknisi sedang melakukan pengecekan gangguan', '2023-01-03 09:51:03'),
(5, 1, 4, 'Gangguan berhasil dikerjakan dan jaringan sudah normal', '2023-01-03 10:51:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `no_internet` varchar(20) NOT NULL,
  `no_voice` varchar(20) NOT NULL,
  `odp` varchar(20) NOT NULL,
  `port` tinyint(2) NOT NULL,
  `sn_ont` varchar(20) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_internet`, `no_voice`, `odp`, `port`, `sn_ont`, `tipe`, `email`, `no_hp`, `alamat`) VALUES
(1, 'Nuril Muslichin', '142265342612', '02851627162', 'ODP-PKL-FN/107', 2, 'FHTT16T26H77', 'Indihome', 'nurilmuslichin16@gmail.com', '085229531170', 'Jl Pemuda No.45'),
(2, 'Seto Prayoga Putra', '14226537263', '0285172612', 'ODP-KDW-FA/087', 3, 'ZTEG09JUYD66', 'BGES / VPN IP', 'seto@gmail.com', '085261526252', 'Jl Panjang No 22 Gg 1'),
(3, 'Fitriyah', '14222737648', '0285779228', 'ODP-KDW-FA/001', 8, 'FHTT87263527', 'WIFI ID', 'fitriyah@gmail.com', '087663773642', 'Kedungwuni Gg13 ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_teknisi`
--

CREATE TABLE `tb_teknisi` (
  `id_telegram` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `nama_teknisi` varchar(50) NOT NULL,
  `mitra` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_teknisi`
--

INSERT INTO `tb_teknisi` (`id_telegram`, `nik`, `nama_teknisi`, `mitra`, `status`) VALUES
(232335771, 997282, 'Seto Setiawan', 'TELKOM AKSES', 0),
(232335772, 999916, 'Nur', 'KOPEGTEL', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `email`, `password`, `level`, `status`, `last_login`) VALUES
(1, 'Team Leader', 'admin@gmail.com', '$2y$10$IjRv6I5uuuxyc0VViNufa.1k8KOoEIbuYrO8onFVmmvgJ2nE4ZH3G', 1, 1, '2023-01-04 00:44:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_gangguan`
--
ALTER TABLE `tb_gangguan`
  ADD PRIMARY KEY (`id_gangguan`);

--
-- Indeks untuk tabel `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  ADD PRIMARY KEY (`id_telegram`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_gangguan`
--
ALTER TABLE `tb_gangguan`
  MODIFY `id_gangguan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  MODIFY `id_telegram` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232335773;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
