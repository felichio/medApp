-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2017 at 03:16 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medDb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Clientele`
--

CREATE TABLE `Clientele` (
  `id` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `patientId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Doctor`
--

CREATE TABLE `Doctor` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `amka` char(11) NOT NULL,
  `password` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Drug`
--

CREATE TABLE `Drug` (
  `code` char(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `dosage` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Patient`
--

CREATE TABLE `Patient` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `amka` char(11) NOT NULL,
  `dateOfBirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Prescription`
--

CREATE TABLE `Prescription` (
  `id` int(11) NOT NULL,
  `clienteleId` int(11) NOT NULL,
  `dateOfIssue` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Therapy`
--

CREATE TABLE `Therapy` (
  `prescriptionId` int(11) NOT NULL,
  `drugCode` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Clientele`
--
ALTER TABLE `Clientele`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctorId` (`doctorId`,`patientId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `Doctor`
--
ALTER TABLE `Doctor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `amka` (`amka`);

--
-- Indexes for table `Drug`
--
ALTER TABLE `Drug`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `Patient`
--
ALTER TABLE `Patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `amka` (`amka`);

--
-- Indexes for table `Prescription`
--
ALTER TABLE `Prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clienteleId` (`clienteleId`);

--
-- Indexes for table `Therapy`
--
ALTER TABLE `Therapy`
  ADD UNIQUE KEY `prescriptionId` (`prescriptionId`,`drugCode`),
  ADD KEY `drugCode` (`drugCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Clientele`
--
ALTER TABLE `Clientele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Doctor`
--
ALTER TABLE `Doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Prescription`
--
ALTER TABLE `Prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Clientele`
--
ALTER TABLE `Clientele`
  ADD CONSTRAINT `Clientele_ibfk_1` FOREIGN KEY (`doctorId`) REFERENCES `Doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Clientele_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `Patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Prescription`
--
ALTER TABLE `Prescription`
  ADD CONSTRAINT `Prescription_ibfk_1` FOREIGN KEY (`clienteleId`) REFERENCES `Clientele` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Therapy`
--
ALTER TABLE `Therapy`
  ADD CONSTRAINT `Therapy_ibfk_1` FOREIGN KEY (`prescriptionId`) REFERENCES `Prescription` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Therapy_ibfk_2` FOREIGN KEY (`drugCode`) REFERENCES `Drug` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
