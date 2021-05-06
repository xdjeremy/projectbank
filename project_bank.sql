-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: mysql-xdjer.alwaysdata.net
-- Generation Time: May 06, 2021 at 03:07 PM
-- Server version: 10.5.8-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xdjer_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `client_num` int(11) NOT NULL,
  `acc_num` bigint(21) NOT NULL,
  `acc_balance` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `client_num`, `acc_num`, `acc_balance`) VALUES
(1, 1, 130502769095, 47420),
(2, 2, 622202213734, 19931),
(3, 3, 924397315570, 0),
(4, 8, 353493715618, 9649),
(5, 4, 785064812606, 0),
(6, 9, 521866723207, 22500),
(7, 5, 753302020709, 0),
(8, 6, 348343473151, 0),
(9, 7, 218353475160, 500),
(10, 10, 263788427289, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `client_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_num` int(11) NOT NULL,
  `client_fname` varchar(25) NOT NULL,
  `client_lname` varchar(25) NOT NULL,
  `client_address` varchar(50) NOT NULL,
  `client_phone` bigint(20) NOT NULL,
  `client_email` varchar(40) NOT NULL,
  `client_pass` varchar(100) NOT NULL,
  `client_type_code` char(10) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_num`, `client_fname`, `client_lname`, `client_address`, `client_phone`, `client_email`, `client_pass`, `client_type_code`, `active`) VALUES
(1, 'admin', 'admin', 'none', 9479936649, 'admin', '$2y$12$6RvlaF0ThO/ZfwndixKM4.DYfwmccEO.8Pd6cFSiqf1WieLn/7W6K', '1', 1),
(2, 'Fujiko', 'Silangcruz', 'Taytay', 9166272386, 'fujikoblancasilangcruz@gmail.com', '$2y$10$GPDPi76Q8tvx8P38UKMU6OpkUGN2MUC3q/8PbMtgDnMn5qc8uU4cu', '1', 1),
(3, 'Ramir', 'Castro', 'Bacoor, Cavite City, Philippines', 9064799592, 'kikosaurus9@yahoo.com', '$2y$10$TZ8mNjNYIYNhKRQ24fKKputiHwAlkejxEgQW1kPTe6VQBFEF/1kS.', '1', 1),
(4, 'Angelou', 'Domingo', '64 Buensuceso Homes 2 Parañaque', 9978770074, 'awdomingo@mymail.mapua.edu.ph', '$2y$10$Quc8oK4Uuyq0lJoFbjBy3.Y5YpVexVhkh2cPRoWNa5daigPRX3BZu', '1', 1),
(5, 'Jamie Beatrice', 'Olivar', '15 M. Santiago St., Parada Sta. Maria, Bulacan', 9330251300, 'jblolivar@mymail.mapua.edu.ph', '$2y$10$GAvGi6xRTA8NJVfZpH.DOepZPKHKbiNBD.5pgLFSMUV/hTA/qy/am', '1', 1),
(6, 'Mark', 'Paez', 'Cainta', 9479938842, 'mark@gmail.com', '$2y$10$qjxQZYbyRqROp0cCSa1vu.SW5nOTj653vOdEeXAOsK580MQSkFbqG', '1', 1),
(7, 'Jenet', 'Lim', '123bakerstreet, America', 9123456789, 'babyjoey@gmail.com', '$2y$10$jsSBI2se1eSZegYPXOs7KOQWT.FiroBF0kt.enBtzlS5BORmCEwmq', '2', 1),
(8, 'James', 'Johnson', 'Toronto, Canada', 9051234592, 'ramirfrancocastro@gmail.com', '$2y$10$80cx/y6.OPSFcmvuyZ/RluFPJfKF5TIWixmPCxQfLdSqCnNWVmdCK', '1', 1),
(9, 'Jeremy', 'Francisco', 'Cainta', 9479936649, 'jeremy.fran@icloud.com', '$2y$10$FuZzXuNvfJlCUIT1fadNKeshwzTgRvf0UD1eniAc6vxc4fLSOAdlC', '1', 1),
(10, 'James', 'Lim', '123 baker street', 9123456789, 'babyjoey@gnmail.com', '$2y$10$oDSY.ylgCutokNuUMmoNcuQSa5FpYlu.assLqTeicMQIQe37rUD5i', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `client_num` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `IP_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `client_num`, `date_time`, `IP_address`) VALUES
(1, 1, '2021-05-06 10:39:26', '136.158.35.10'),
(2, 1, '2021-05-06 10:48:27', '136.158.35.10'),
(3, 1, '2021-05-06 11:57:37', '152.32.104.67'),
(4, 2, '2021-05-06 11:58:23', '152.32.104.67'),
(5, 1, '2021-05-06 11:58:46', '136.158.35.10'),
(6, 1, '2021-05-06 12:06:15', '136.158.35.10'),
(7, 1, '2021-05-06 12:25:03', '2001:4451:871:b000:9d8d:dd53:2df0:2ad5'),
(8, 1, '2021-05-06 12:25:23', '120.29.97.152'),
(9, 3, '2021-05-06 12:25:41', '2001:4451:871:b000:9d8d:dd53:2df0:2ad5'),
(10, 1, '2021-05-06 12:27:30', '136.158.35.10'),
(11, 1, '2021-05-06 12:29:30', '2001:4450:46dd:de00:3507:9902:6259:cd19'),
(12, 1, '2021-05-06 12:30:27', '120.29.97.152'),
(13, 1, '2021-05-06 12:33:05', '136.158.35.10'),
(14, 1, '2021-05-06 12:33:13', '120.29.97.152'),
(15, 8, '2021-05-06 12:34:36', '2001:4451:871:b000:9d8d:dd53:2df0:2ad5'),
(16, 4, '2021-05-06 12:38:02', '2001:4450:46dd:de00:3507:9902:6259:cd19'),
(17, 1, '2021-05-06 12:49:10', '120.29.97.152'),
(18, 1, '2021-05-06 12:50:41', '2001:4450:46dd:de00:3507:9902:6259:cd19'),
(19, 1, '2021-05-06 13:09:30', '136.158.35.10'),
(20, 9, '2021-05-06 13:09:48', '136.158.35.10'),
(21, 9, '2021-05-06 13:09:59', '136.158.35.10'),
(22, 1, '2021-05-06 13:10:07', '136.158.35.10'),
(23, 9, '2021-05-06 13:10:28', '136.158.35.10'),
(24, 1, '2021-05-06 13:23:44', '2001:4450:46dd:de00:f958:fcf9:d8:8a3b'),
(25, 7, '2021-05-06 13:25:33', '120.29.97.152');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `acc_num` bigint(50) NOT NULL,
  `payee` bigint(100) NOT NULL,
  `acc_balance` int(11) NOT NULL,
  `amount` float NOT NULL,
  `ref_num` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `date`, `acc_num`, `payee`, `acc_balance`, `amount`, `ref_num`) VALUES
(1, '2021-05-06', 130502769095, 622202213734, 80000, -20000, 40361003),
(2, '2021-05-06', 622202213734, 130502769095, 20000, 20000, 40361003),
(3, '2021-05-06', 622202213734, 130502769095, 19931, -69, 75874237),
(4, '2021-05-06', 130502769095, 622202213734, 80069, 69, 75874237),
(5, '2021-05-06', 130502769095, 353493715618, 70069, -10000, 80045972),
(6, '2021-05-06', 353493715618, 130502769095, 10000, 10000, 80045972),
(7, '2021-05-06', 130502769095, 353493715618, 70000, -69, 3303405),
(8, '2021-05-06', 353493715618, 130502769095, 10069, 69, 3303405),
(9, '2021-05-06', 353493715618, 130502769095, 9649, -420, 44570643),
(10, '2021-05-06', 130502769095, 353493715618, 70420, 420, 44570643),
(11, '2021-05-06', 130502769095, 521866723207, 47420, -23000, 72745518),
(12, '2021-05-06', 521866723207, 130502769095, 23000, 23000, 72745518),
(13, '2021-05-06', 521866723207, 218353475160, 22500, -500, 76963094),
(14, '2021-05-06', 218353475160, 521866723207, 500, 500, 76963094);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_num`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
