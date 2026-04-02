-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2026 at 06:29 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_access`
--

CREATE TABLE `admin_access` (
  `id` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `adds` int(11) DEFAULT NULL,
  `edit` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `date_change` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_access`
--

INSERT INTO `admin_access` (`id`, `id_group`, `id_menu`, `adds`, `edit`, `deleted`, `date_change`, `date_create`) VALUES
(322, 3, 20, 20, 20, 20, '2026-04-01 19:23:37', '2026-04-01 19:23:37'),
(323, 3, 30, 30, 30, 30, '2026-04-01 19:23:37', '2026-04-01 19:23:37'),
(324, 2, 6, 6, 6, 6, '2026-04-02 02:38:39', '2026-04-02 02:38:39'),
(325, 2, 28, 28, 28, 28, '2026-04-02 02:38:39', '2026-04-02 02:38:39'),
(326, 2, 29, 29, 29, 29, '2026-04-02 02:38:39', '2026-04-02 02:38:39'),
(327, 2, 10, 10, 10, 10, '2026-04-02 02:38:39', '2026-04-02 02:38:39'),
(328, 2, 11, 11, 11, 11, '2026-04-02 02:38:39', '2026-04-02 02:38:39'),
(329, 2, 20, 20, 20, 20, '2026-04-02 02:38:39', '2026-04-02 02:38:39'),
(330, 2, 27, 27, 27, 27, '2026-04-02 02:38:39', '2026-04-02 02:38:39'),
(331, 2, 30, 30, 30, 30, '2026-04-02 02:38:39', '2026-04-02 02:38:39'),
(332, 1, 6, 6, 6, 6, '2026-04-02 02:38:47', '2026-04-02 02:38:47'),
(333, 1, 28, 28, 28, 28, '2026-04-02 02:38:47', '2026-04-02 02:38:47'),
(334, 1, 29, 29, 29, 29, '2026-04-02 02:38:47', '2026-04-02 02:38:47'),
(335, 1, 10, 10, 10, 10, '2026-04-02 02:38:47', '2026-04-02 02:38:47'),
(336, 1, 11, 11, 11, 11, '2026-04-02 02:38:47', '2026-04-02 02:38:47'),
(337, 1, 12, 12, 12, 12, '2026-04-02 02:38:47', '2026-04-02 02:38:47'),
(338, 1, 13, 13, 13, 13, '2026-04-02 02:38:47', '2026-04-02 02:38:47'),
(339, 1, 20, 20, 20, 20, '2026-04-02 02:38:47', '2026-04-02 02:38:47'),
(340, 1, 27, 27, 27, 27, '2026-04-02 02:38:47', '2026-04-02 02:38:47'),
(341, 1, 30, 30, 30, 30, '2026-04-02 02:38:47', '2026-04-02 02:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `admin_group`
--

CREATE TABLE `admin_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(3) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_group`
--

INSERT INTO `admin_group` (`id`, `name`, `status`, `date_create`) VALUES
(1, 'Developer', 1, '2020-07-19 02:14:54'),
(2, 'Admin', 1, '2026-04-01 03:11:31'),
(3, 'Approver', 1, '2026-04-01 03:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `level` int(3) NOT NULL,
  `url` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `status` int(3) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `name`, `icon`, `level`, `url`, `sort`, `parent`, `status`, `date_create`) VALUES
(6, 'Master Data', 'typcn typcn-book', 1, '#', 4, 0, 1, '2020-07-26 04:07:38'),
(10, 'Pengaturan', 'typcn typcn-spanner-outline', 1, '#', 5, 0, 1, '2020-07-26 04:09:13'),
(11, 'User', 'typcn typcn-user-outline', 2, 'users', 1, 10, 1, '2020-07-26 04:09:35'),
(12, 'Akses Level', 'typcn typcn-group-outline', 2, 'group', 2, 10, 1, '2020-07-26 04:09:58'),
(13, 'Menu', 'typcn typcn-th-menu-outline', 2, 'menu', 3, 10, 1, '2020-07-26 04:10:12'),
(20, 'Dashboard', 'typcn typcn-home-outline', 1, 'dashboard', 1, 0, 1, '2020-08-01 16:23:17'),
(27, 'Booking', 'fa fa-bus', 1, 'booking', 2, 0, 1, '2026-04-01 09:05:52'),
(28, 'Driver', 'fa fa-list', 2, 'drivers', 2, 6, 1, '2026-04-01 14:58:48'),
(29, 'Kendaraan', 'fa fa-list', 2, 'vehicles', 7, 6, 1, '2026-04-01 15:24:41'),
(30, 'Approval', 'fa fa-id-card-o', 1, 'approval', 3, 0, 1, '2026-04-01 16:17:33');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(300) NOT NULL,
  `id_group` int(11) NOT NULL,
  `status` int(3) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `name`, `email`, `phonenumber`, `gender`, `address`, `password`, `id_group`, `status`, `date_create`) VALUES
(1, 'Adi Murianto', 'dev@mail.com', '080808082121', 'laki-laki', '-', '2c470e39f2f0201c8a1df7b2818c5e0174cc91a6', 1, 1, '2020-10-17 02:16:19'),
(2, 'Admin', 'admin@mail.com', '0811111111', 'laki-laki', 'Jakarta', '036d0ef7567a20b5a4ad24a354ea4a945ddab676', 2, 1, '2026-04-01 13:40:38'),
(3, 'Manager Operasional', 'manager@mail.com', '0822222222', 'laki-laki', 'Bandung', '7715b2326ac61db73b83e89aee9fed700d58f643', 3, 1, '2026-04-01 13:40:38'),
(4, 'Supervisor Tambang', 'spv@mail.com', '0833333333', 'laki-laki', 'Kalimantan', '6d1473df0dbed78d919c8f86d50ddf3f1c60206b', 3, 1, '2026-04-01 13:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `approver_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approvals`
--

INSERT INTO `approvals` (`id`, `booking_id`, `approver_id`, `level`, `status`, `approved_at`) VALUES
(1, 1, 3, 1, 'approved', '2026-04-01 07:00:00'),
(2, 1, 4, 2, 'approved', '2026-04-01 07:30:00'),
(3, 2, 3, 1, 'pending', '2026-04-02 00:52:02'),
(4, 3, 3, 1, 'pending', '2026-04-02 10:00:00'),
(5, 3, 4, 2, 'rejected', '2026-04-02 11:00:00'),
(6, 2, 4, 2, 'approved', '2026-04-02 00:00:00'),
(7, 8, 4, 1, 'approved', '2026-04-02 05:23:37'),
(8, 8, 3, 2, 'approved', '2026-04-01 21:57:03'),
(9, 9, 3, 1, 'pending', NULL),
(10, 9, 4, 2, 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_logs`
--

CREATE TABLE `app_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_logs`
--

INSERT INTO `app_logs` (`id`, `user_id`, `action`, `created_at`) VALUES
(1, 2, 'Login sistem', '2026-04-01 13:40:38'),
(2, 3, 'Membuat booking kendaraan', '2026-04-01 13:40:38'),
(3, 3, 'Approve booking', '2026-04-01 13:40:38'),
(4, 4, 'Reject booking', '2026-04-01 13:40:38'),
(5, 2, 'Input BBM kendaraan', '2026-04-01 13:40:38'),
(6, 1, 'Update Booking Id : 3', '2026-04-02 03:21:49'),
(7, 1, 'Update Booking Id : 1', '2026-04-02 03:22:26'),
(8, 4, 'Update Approval Id : 7', '2026-04-02 03:23:37'),
(9, 2, 'Create Booking Id : 9', '2026-04-02 04:28:03'),
(10, 2, 'Update Booking Id : 8', '2026-04-02 04:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `requester_name` varchar(100) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `vehicle_id`, `driver_id`, `requester_name`, `purpose`, `start_date`, `end_date`, `status`, `created_by`, `created_at`) VALUES
(1, 1, 1, 'Andi', 'Meeting client', '2026-03-14 00:00:00', '2026-03-29 00:00:00', 'approved', 2, '2026-03-22 13:40:38'),
(2, 1, 2, 'Rina', 'Pengiriman barang', '2026-03-31 00:00:00', '2026-04-06 00:00:00', 'pending', 2, '2026-04-01 13:40:38'),
(3, 3, 1, 'Dedi', 'Survey tambang', '2026-04-03 00:00:00', '2026-04-04 00:00:00', 'rejected', 2, '2026-04-01 13:40:38'),
(8, 3, 2, 'Hafidz', 'Survey Lapangan', '2026-04-08 00:00:00', '2026-04-10 00:00:00', 'approved', 1, '2026-04-01 18:45:02'),
(9, 1, 3, 'Abdul', 'Survey Lokasi', '2026-04-13 00:00:00', '2026-04-15 00:00:00', 'pending', 2, '2026-04-02 04:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `phone`, `status`) VALUES
(1, 'Budi', '080000000000', 1),
(2, 'Joko', '081212121212', 1),
(3, 'Ahmad', '081111222333', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fuel_logs`
--

CREATE TABLE `fuel_logs` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `liters` decimal(10,2) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fuel_logs`
--

INSERT INTO `fuel_logs` (`id`, `vehicle_id`, `date`, `liters`, `cost`) VALUES
(1, 1, '2026-04-01', '20.00', '300000.00'),
(2, 2, '2026-04-02', '35.00', '525000.00'),
(3, 1, '2026-04-03', '15.00', '225000.00');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` enum('pusat','cabang','tambang') DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `type`, `region_id`) VALUES
(1, 'Head Office Bandung', 'pusat', 1),
(2, 'Cabang Bekasi', 'cabang', 1),
(3, 'Site Tambang A', 'tambang', 2);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`) VALUES
(1, 'Jawa Barat'),
(2, 'Kalimantan Timur');

-- --------------------------------------------------------

--
-- Table structure for table `service_logs`
--

CREATE TABLE `service_logs` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `service_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_logs`
--

INSERT INTO `service_logs` (`id`, `vehicle_id`, `service_date`, `description`, `cost`) VALUES
(1, 1, '2026-03-25', 'Ganti oli', '500000.00'),
(2, 3, '2026-03-28', 'Perbaikan mesin', '2000000.00');

-- --------------------------------------------------------

--
-- Table structure for table `usage_logs`
--

CREATE TABLE `usage_logs` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `start_km` int(11) DEFAULT NULL,
  `end_km` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usage_logs`
--

INSERT INTO `usage_logs` (`id`, `booking_id`, `vehicle_id`, `start_km`, `end_km`) VALUES
(1, 1, 1, 10000, 10150),
(2, 2, 2, 20000, 20250);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `plate_number` varchar(20) DEFAULT NULL,
  `type` enum('orang','barang') DEFAULT NULL,
  `ownership` enum('perusahaan','sewa') DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `status` enum('available','used','maintenance') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `plate_number`, `type`, `ownership`, `location_id`, `status`) VALUES
(1, 'B 1234 CD', 'orang', 'perusahaan', 1, 'available'),
(2, 'B 5678 EF', 'barang', 'sewa', 2, 'maintenance'),
(3, 'KT 9012 GH', 'orang', 'perusahaan', 2, 'available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_access`
--
ALTER TABLE `admin_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_group`
--
ALTER TABLE `admin_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `approver_id` (`approver_id`);

--
-- Indexes for table `app_logs`
--
ALTER TABLE `app_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuel_logs`
--
ALTER TABLE `fuel_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_logs`
--
ALTER TABLE `service_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `usage_logs`
--
ALTER TABLE `usage_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_access`
--
ALTER TABLE `admin_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT for table `admin_group`
--
ALTER TABLE `admin_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `app_logs`
--
ALTER TABLE `app_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fuel_logs`
--
ALTER TABLE `fuel_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_logs`
--
ALTER TABLE `service_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usage_logs`
--
ALTER TABLE `usage_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approvals`
--
ALTER TABLE `approvals`
  ADD CONSTRAINT `approvals_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  ADD CONSTRAINT `approvals_ibfk_2` FOREIGN KEY (`approver_id`) REFERENCES `admin_user` (`id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`);

--
-- Constraints for table `fuel_logs`
--
ALTER TABLE `fuel_logs`
  ADD CONSTRAINT `fuel_logs_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`);

--
-- Constraints for table `service_logs`
--
ALTER TABLE `service_logs`
  ADD CONSTRAINT `service_logs_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Constraints for table `usage_logs`
--
ALTER TABLE `usage_logs`
  ADD CONSTRAINT `usage_logs_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
