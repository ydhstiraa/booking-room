-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2023 at 04:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking_room`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id`, `nama`, `status`) VALUES
(1, 'Laptop Asus', 'Active'),
(2, 'Proyektor Lenovo', 'Active'),
(3, 'Sound System Portable', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `detail_alat`
--

CREATE TABLE `detail_alat` (
  `id` int(11) NOT NULL,
  `pemesanan_id` int(11) DEFAULT NULL,
  `alat_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `pemesanan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `user_id`, `status`, `timestamp`, `pemesanan_id`) VALUES
(1, 1, 'Approved', '2023-07-22 03:34:59', 58),
(2, 1, 'Approved', '2023-07-22 03:37:38', 56),
(3, 1, 'Approved', '2023-07-22 03:38:25', 57),
(4, 1, 'Approved', '2023-07-22 03:40:16', 54),
(5, 1, 'Approved', '2023-07-22 03:47:01', 60),
(6, 1, 'Approved', '2023-07-22 03:47:41', 60),
(7, 1, 'Approved', '2023-07-22 03:47:46', 37),
(9, 1, 'Approved', '2023-07-22 03:51:07', 60),
(10, 1, 'Canceled', '2023-07-22 03:51:11', 60),
(11, 1, 'Approved', '2023-07-22 03:58:42', 60),
(12, 1, 'Canceled', '2023-07-22 03:58:46', 60),
(13, 1, 'Approved', '2023-07-22 03:58:50', 37),
(14, 1, 'Canceled', '2023-07-22 03:58:53', 37),
(15, 1, 'Finished', '2023-07-22 04:02:08', 36),
(16, 1, 'Approved', '2023-07-22 04:02:27', 60),
(17, 1, 'Confirmed', '2023-07-22 04:02:32', 60),
(19, 1, 'Approved', '2023-07-22 07:09:11', 61),
(20, 1, 'Canceled', '2023-07-22 07:55:22', 61),
(21, 1, 'Approved', '2023-07-22 13:43:38', 61),
(22, 1, 'Canceled', '2023-07-22 13:43:41', 61),
(23, 1, 'Confirmed', '2023-07-22 13:50:16', 60),
(24, 3, 'Approved', '2023-07-23 07:56:41', 62),
(25, 3, 'Confirmed', '2023-07-23 07:56:48', 62),
(26, 1, 'Approved', '2023-07-23 10:24:16', 63),
(27, 1, 'Confirmed', '2023-07-23 10:25:41', 63),
(28, 1, 'Finished', '2023-07-23 10:26:29', 63),
(29, 1, 'Approved', '2023-07-23 10:28:23', 61),
(30, 1, 'Confirmed', '2023-07-23 10:28:35', 61);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `ruangan_id` int(11) DEFAULT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `jumlah_kursi` int(11) NOT NULL,
  `no_wa` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `ruangan_id`, `nama_pemesan`, `tanggal_pemesanan`, `jam_mulai`, `jam_selesai`, `status`, `jumlah_kursi`, `no_wa`, `email`, `keterangan`, `timestamp`) VALUES
(35, NULL, 'Yudhistira', '2023-07-14', '13:00:00', '15:00:00', 'Finished', 30, '089669208080', '', 'acara keluarga sahabat AOV', '2023-07-17 01:35:00'),
(36, 1, 'Labib Aisy', '2023-07-27', '15:00:00', '20:00:00', 'Finished', 10, '0895359490235', '', 'Main bareng pemain Call of Duty', '2023-07-17 01:35:00'),
(60, 2, 'bambang kopling joko wkwkwk', '2023-07-21', '16:00:00', '20:00:00', 'Confirmed', 12, '089669208080', 'ayundakismawati512@gmail.com', 'wkkwkwk', '2023-07-22 03:46:18'),
(61, 2, 'Yudhistira', '2023-07-28', '13:00:00', '20:00:00', 'Confirmed', 15, '089669208080', 'ayundakismawati512@gmail.com', 'Gathering AOV', '2023-07-22 05:41:07'),
(62, 1, 'Freyana Putri', '2023-07-24', '16:00:00', '20:00:00', 'Confirmed', 0, '089669208080', 'freyana@email.com', 'meet and greet fans JKT48', '2023-07-23 07:56:18'),
(63, 1, 'Gath AOV', '2023-07-25', '15:00:00', '21:00:00', 'Finished', 40, '089522986696', 'dandyjp12@gmail.com', 'gathering aov', '2023-07-23 10:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama`, `kapasitas`, `deskripsi`, `status`) VALUES
(1, 'Ruang Mabar', 40, 'Ruang untuk mabar terdapat meja dan kursi monitor', 'Active'),
(2, 'Ruang Nobar', 30, 'Ruang nobar untuk Nonton Bareng turnament online tanpa meja dan kursi', 'Active'),
(5, 'asd', 123, '123tambah kursi baru 5 juta', 'Inactive'),
(6, 'Lapangan Basket', 100, 'Lapangan basket seluas 1 hektar', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'user',
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `level`, `status`, `created_at`) VALUES
(1, 'Super Admin', 'admin', 'admin@email.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Active', '2023-07-12 13:16:53'),
(2, 'Bambang Gedhe', 'bambang123', 'bambang@email.com', 'd0394cac3b218e5e801636723eadbd0e', 'user', 'Active', '2023-07-21 14:35:51'),
(3, 'Selva', 'selva', 'selva@email.com', '202cb962ac59075b964b07152d234b70', 'user', 'Active', '2023-07-22 14:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `validasi`
--

CREATE TABLE `validasi` (
  `id` int(11) NOT NULL,
  `pemesanan_id` int(11) DEFAULT NULL,
  `kode_validasi` varchar(255) DEFAULT NULL,
  `kode_tracking` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Active',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `validasi`
--

INSERT INTO `validasi` (`id`, `pemesanan_id`, `kode_validasi`, `kode_tracking`, `status`, `timestamp`) VALUES
(1, 58, NULL, '64bb401413cec', NULL, '2023-07-22 02:33:56'),
(2, 59, NULL, '64bb403d2017e', 'Active', '2023-07-22 02:34:37'),
(3, 60, NULL, '64bb510a4b076', 'Active', '2023-07-22 03:46:18'),
(4, 61, NULL, '64bb6bf38c01d', 'Active', '2023-07-22 05:41:07'),
(5, 62, NULL, '64bcdd22bdc10', 'Active', '2023-07-23 07:56:18'),
(6, 63, NULL, '64bcff698805b', 'Active', '2023-07-23 10:22:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_alat`
--
ALTER TABLE `detail_alat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesanan_id` (`pemesanan_id`),
  ADD KEY `alat_id` (`alat_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_pemesanan_id` (`pemesanan_id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruangan_id` (`ruangan_id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `validasi`
--
ALTER TABLE `validasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesanan_id` (`pemesanan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_alat`
--
ALTER TABLE `detail_alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `validasi`
--
ALTER TABLE `validasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
