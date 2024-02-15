-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 06:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbusms`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` int(11) NOT NULL,
  `makeid` int(11) DEFAULT NULL,
  `kilometer` decimal(12,2) DEFAULT NULL,
  `last_maintenance` date DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Working',
  `garageid` int(11) DEFAULT NULL,
  `vehicletype` varchar(10) DEFAULT NULL,
  `regno` varchar(20) DEFAULT NULL,
  `seatingcapacity` int(3) DEFAULT NULL,
  `standingcapacity` int(3) DEFAULT NULL,
  `enginecapacity` int(5) DEFAULT NULL,
  `dateregistered` date DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `fitnessexp` date DEFAULT NULL,
  `insuranceexp` date DEFAULT NULL,
  `roadtaxexp` date DEFAULT NULL,
  `modelid` int(11) DEFAULT NULL,
  `chassisno` varchar(100) DEFAULT NULL,
  `engineno` varchar(100) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `makeid`, `kilometer`, `last_maintenance`, `status`, `garageid`, `vehicletype`, `regno`, `seatingcapacity`, `standingcapacity`, `enginecapacity`, `dateregistered`, `age`, `fitnessexp`, `insuranceexp`, `roadtaxexp`, `modelid`, `chassisno`, `engineno`, `color`) VALUES
(1, 5, '249306.90', NULL, 'Working', 3, 'Fleet', '1002FB10', 34, 5, 6925, '2010-02-24', 13, '2025-01-26', NULL, '2024-01-31', 1, 'MBK210H08358', 'FE6212-666B', 'BLUE'),
(2, 5, '54169.70', NULL, 'Working', 3, 'Fleet', '2807MR22', 16, 0, 2488, '2022-03-25', 1, '2026-03-16', NULL, '2024-03-31', 5, 'JN1UC4E26Z004955', 'YD25 106912B', 'WHITE'),
(3, 8, '80000.00', '2024-01-04', 'Maintenance', 1, 'Fleet', '10079OC22', 50, 12, 6700, '2022-10-12', 1, '2024-04-14', NULL, '2024-09-30', 5, 'LZYTAGD69N1012770', '93034285', 'BLUE'),
(4, 5, '925830.30', NULL, 'Working', 1, 'Fleet', '2581MY11', 64, 5, 6925, '2010-05-02', 12, '2025-01-26', NULL, '2024-04-30', 2, 'SP210PSN04430', 'FE6052-101B', 'BLUE'),
(5, 8, '137581.20', NULL, 'Working', 5, 'Fleet', '10085OC22', 50, 12, 6700, '2022-10-12', 1, '2026-03-16', NULL, '2024-01-31', 5, 'LZYTAGD61N1012780', '93034286', 'BLUE'),
(6, 5, '121417.00', NULL, 'Working', 5, 'Fleet', '2814MR22', 16, 0, 2488, '2022-03-25', 1, '2024-04-14', NULL, '2024-03-31', 5, 'JN1UC4E26Z0040892', 'YD25 106099B', 'WHITE'),
(7, 8, '81139.70', NULL, 'Working', 2, 'Fleet', '10097OC22', 50, 12, 6700, '2022-10-12', 1, '2025-01-26', NULL, '2024-09-30', 5, 'LZYTAGD65N1012782', '93034300', 'BLUE'),
(8, 5, '70277.80', NULL, 'Working', 2, 'Fleet', '2809MR22', 16, 0, 2488, '2022-03-25', 1, '2026-03-16', NULL, '2024-04-30', 5, 'JN1UC4E26Z0040952', 'YD25 106784B', 'WHITE'),
(9, 8, '99018.16', NULL, 'Working', 4, 'Fleet', '10099OC22', 50, 12, 6700, '2022-10-12', 1, '2024-04-14', NULL, '2024-01-31', 5, 'LZYTAGD60N1012785', '93034294', 'BLUE'),
(10, 5, '65590.85', NULL, 'Working', 4, 'Fleet', '2812MR22', 16, 0, 2488, '2022-03-25', 1, '2025-01-26', NULL, '2024-03-31', 5, 'JN1UC4E26Z004885', 'YD25 106049B', 'WHITE');

-- --------------------------------------------------------

--
-- Table structure for table `bus_spare_parts`
--

CREATE TABLE `bus_spare_parts` (
  `bus_id` int(11) NOT NULL,
  `spare_part_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `dailyservice`
--

CREATE TABLE `dailyservice` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `diff` decimal(12,2) NOT NULL DEFAULT 0.00,
  `newkm` decimal(12,2) NOT NULL DEFAULT 0.00,
  `lastkm` decimal(12,2) NOT NULL DEFAULT 0.00,
  `busid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dailyservice`
--

INSERT INTO `dailyservice` (`id`, `date`, `diff`, `newkm`, `lastkm`, `busid`) VALUES
(9, '2024-01-03', '219.50', '68569.50', '68350.00', 3),
(20, '2024-01-04', '4630.50', '73200.00', '68569.50', 3),
(21, '2024-01-05', '6800.00', '80000.00', '73200.00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `garage`
--

CREATE TABLE `garage` (
  `id` int(11) NOT NULL,
  `name` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `garage`
--

INSERT INTO `garage` (`id`, `name`) VALUES
(1, 'FSD\r\n'),
(2, 'LTKD\r'),
(3, 'ROD\r\n'),
(4, 'RRD'),
(5, 'SOD\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `maintenancerec`
--

CREATE TABLE `maintenancerec` (
  `id` int(11) NOT NULL,
  `last_maintenance` date NOT NULL,
  `busid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `maintenancerec`
--

INSERT INTO `maintenancerec` (`id`, `last_maintenance`, `busid`) VALUES
(1, '2024-01-04', 3);

-- --------------------------------------------------------

--
-- Table structure for table `make`
--

CREATE TABLE `make` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `make`
--

INSERT INTO `make` (`id`, `name`) VALUES
(1, 'Ashok Leyland'),
(2, 'BYD (E-Bus)\r\n'),
(3, 'Kia\r\n'),
(4, 'Land Cruiser'),
(5, 'Nissan\r\n'),
(6, 'Tata'),
(7, 'Toyota'),
(8, 'Yutong\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `makeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `name`, `makeid`) VALUES
(1, 'MKB\r\n', 5),
(2, 'SP 210\r\n', 5),
(3, 'MICRO\r\n', 5),
(4, 'NV350\r\n', 5),
(5, 'Yutong-Semi Low Floor\r\n', 8),
(6, 'Semi Low Floor - AC', 8),
(7, 'Model1 Ashok', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `RoleId` int(3) NOT NULL,
  `Level` int(2) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`RoleId`, `Level`, `Name`, `Description`) VALUES
(1, 0, 'Admin', 'A person who manages and oversees the operations of an organization or a system'),
(2, 1, 'Administrative Clerk', 'A person who performs administrative tasks to support the work of other employees'),
(3, 2, 'Workshop Supervisor', 'A person who oversees and coordinates the activities of a workshop');

-- --------------------------------------------------------

--
-- Table structure for table `spare_parts`
--

CREATE TABLE `spare_parts` (
  `id` int(11) NOT NULL,
  `part_name` varchar(50) DEFAULT NULL,
  `part_number` varchar(50) DEFAULT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `spare_parts`
--

INSERT INTO `spare_parts` (`id`, `part_name`, `part_number`, `date_added`) VALUES
(1, 'Engine Oil Filter', 'A6511800109', '2023-04-01'),
(2, 'Air Filter', 'A6510940404', '2023-04-02'),
(3, 'Brake Disc', 'A6294210112', '2023-04-03'),
(4, 'Brake Pad Set', 'A0084200620', '2023-04-04'),
(5, 'Fuel Filter', 'A6510901652', '2023-04-05'),
(6, 'V-Belt', 'A0149976892', '2023-04-06'),
(7, 'Oil Filter', '2781800009', '2023-04-07'),
(8, 'Spark Plug', '0041596903', '2023-04-08'),
(9, 'Air Filter', '2780940004', '2023-04-09'),
(10, 'Brake Disc', '0004213012', '2023-04-10'),
(11, 'Brake Pad Set', '0054207420', '2023-04-11'),
(12, 'Fuel Filter', '6510902852', '2023-04-12'),
(13, 'V-Belt', '0149976892', '2023-04-13'),
(14, 'Oil Filter', '2761800009', '2023-04-14'),
(15, 'Spark Plug', '0041591803', '2023-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(16) DEFAULT NULL,
  `Level` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `Name`, `Email`, `Username`, `Password`, `Level`) VALUES
(1, 'Admin', 'admin@garagealpha.com', 'admin', 'admin', 0),
(2, 'User A Clerk', 'userclerk@garagealpha.com', 'userclerk', 'test1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `make_id` (`makeid`),
  ADD KEY `bus_modelfk` (`modelid`),
  ADD KEY `bus_garagefk` (`garageid`);

--
-- Indexes for table `bus_spare_parts`
--
ALTER TABLE `bus_spare_parts`
  ADD PRIMARY KEY (`bus_id`,`spare_part_id`),
  ADD KEY `spare_part_id` (`spare_part_id`);

--
-- Indexes for table `dailyservice`
--
ALTER TABLE `dailyservice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_fk` (`busid`);

--
-- Indexes for table `garage`
--
ALTER TABLE `garage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenancerec`
--
ALTER TABLE `maintenancerec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_bus_mtce` (`busid`);

--
-- Indexes for table `make`
--
ALTER TABLE `make`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `makeid` (`makeid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleId`);

--
-- Indexes for table `spare_parts`
--
ALTER TABLE `spare_parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dailyservice`
--
ALTER TABLE `dailyservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `garage`
--
ALTER TABLE `garage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `maintenancerec`
--
ALTER TABLE `maintenancerec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `make`
--
ALTER TABLE `make`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `spare_parts`
--
ALTER TABLE `spare_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_garagefk` FOREIGN KEY (`garageid`) REFERENCES `garage` (`id`),
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`makeid`) REFERENCES `make` (`id`),
  ADD CONSTRAINT `bus_modelfk` FOREIGN KEY (`modelid`) REFERENCES `model` (`id`);

--
-- Constraints for table `bus_spare_parts`
--
ALTER TABLE `bus_spare_parts`
  ADD CONSTRAINT `bus_spare_parts_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`id`),
  ADD CONSTRAINT `bus_spare_parts_ibfk_2` FOREIGN KEY (`spare_part_id`) REFERENCES `spare_parts` (`id`);

--
-- Constraints for table `dailyservice`
--
ALTER TABLE `dailyservice`
  ADD CONSTRAINT `bus_fk` FOREIGN KEY (`busid`) REFERENCES `bus` (`id`);

--
-- Constraints for table `maintenancerec`
--
ALTER TABLE `maintenancerec`
  ADD CONSTRAINT `FK_bus_mtce` FOREIGN KEY (`busid`) REFERENCES `bus` (`id`);

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`makeid`) REFERENCES `make` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
