-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2018 at 11:07 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cisco_finesse`
--

-- --------------------------------------------------------

--
-- Table structure for table `cisco_finesse_installs`
--

CREATE TABLE `cisco_finesse_installs` (
  `id` int(11) NOT NULL,
  `fqdn` varchar(300) NOT NULL,
  `port` varchar(10) NOT NULL,
  `username` varchar(49) NOT NULL,
  `password` varchar(199) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cisco_finesse_installs`
--

INSERT INTO `cisco_finesse_installs` (`id`, `fqdn`, `port`, `username`, `password`) VALUES
(8, 'uccx.sandbox.local', '8445', 'agentone', 'Twocare123!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cisco_finesse_installs`
--
ALTER TABLE `cisco_finesse_installs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cisco_finesse_installs`
--
ALTER TABLE `cisco_finesse_installs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
