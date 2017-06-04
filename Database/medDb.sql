-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 04, 2017 at 07:41 PM
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

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`id`, `username`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'felichio', 'Felix', 'Safaridis', 'fsafaridis@hotmail.com', '9c69098d379350e157eff4ad93150662007b8fb2');

-- --------------------------------------------------------

--
-- Table structure for table `Clientele`
--

CREATE TABLE `Clientele` (
  `id` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `patientId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Clientele`
--

INSERT INTO `Clientele` (`id`, `doctorId`, `patientId`) VALUES
(15, 1, 3),
(16, 1, 4),
(19, 1, 8),
(20, 1, 9),
(27, 1, 16),
(37, 1, 26),
(21, 7, 10),
(22, 7, 11),
(36, 7, 25),
(23, 8, 12),
(24, 8, 13),
(25, 8, 14),
(26, 8, 15),
(28, 9, 17),
(29, 9, 18),
(32, 9, 21),
(30, 10, 19),
(31, 10, 20),
(34, 11, 23),
(35, 11, 24),
(38, 12, 27);

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

--
-- Dumping data for table `Doctor`
--

INSERT INTO `Doctor` (`id`, `username`, `firstname`, `lastname`, `email`, `amka`, `password`) VALUES
(1, 'monster', 'John', 'StrangleLove', 'example@example.com', '12220295872', '9c69098d379350e157eff4ad93150662007b8fb2'),
(7, 'Monty', 'Python', 'Snake', 'snake@gmail.com', '48328543221', '9c69098d379350e157eff4ad93150662007b8fb2'),
(8, 'Sakis', 'Sakis', 'Kappas', 'agios@lol.com', '56198737811', '9c69098d379350e157eff4ad93150662007b8fb2'),
(9, 'Makis', 'Makis', 'Lol', 'ex@exex.gr', '11111111113', '9c69098d379350e157eff4ad93150662007b8fb2'),
(10, 'Travolda', 'John', 'Rambo', 'example@ee.egg', '60987103941', '9c69098d379350e157eff4ad93150662007b8fb2'),
(11, 'Travoldaa', 'Bill', 'LOlsa', 'example@eeee.ss', '72345551631', '9c69098d379350e157eff4ad93150662007b8fb2'),
(12, 'Dildo', 'Baggins', 'Mousar', 'example@qwerty.com', '60987104444', '9c69098d379350e157eff4ad93150662007b8fb2');

-- --------------------------------------------------------

--
-- Table structure for table `Drug`
--

CREATE TABLE `Drug` (
  `code` char(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `dosage` tinytext NOT NULL,
  `price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Drug`
--

INSERT INTO `Drug` (`code`, `name`, `dosage`, `price`) VALUES
('3919073564', 'Clarityne', '1pill/day', '3.60'),
('4322342343', 'Depon', '3times/week', '29.15'),
('3919073568', 'Marko', '4times/week', '52.34'),
('5919073567', 'Parashok', '1time/week', '95.14'),
('4322341512', 'Polo', '1pill/day', '13.01'),
('5919073522', 'Sea', '3times/week', '1.45'),
('3919073514', 'Www', '3times/week', '34.63'),
('3919073522', 'Zanax', '1pill/day', '985.15');

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

--
-- Dumping data for table `Patient`
--

INSERT INTO `Patient` (`id`, `firstname`, `lastname`, `amka`, `dateOfBirth`) VALUES
(3, 'S4', 'Voldermod', '42416578590', '2016-11-07'),
(4, 'AMqe', 'Alonsooww', '56198737813', '2017-06-01'),
(8, 'asd', 'asd', '12220295873', '2017-06-14'),
(9, 'Baki', 'Alonso', '59413849301', '2017-06-14'),
(10, 'Lavita', 'Luiza', '72345551678', '2017-06-05'),
(11, 'Polo', 'Python', '60987103951', '2016-12-14'),
(12, 'Montana', 'Veronica', '80976413589', '2017-05-29'),
(13, 'Hana', 'Voitsek', '60987103954', '2017-06-07'),
(14, 'Dragki', 'Lola', '56198737813', '2017-06-07'),
(15, 'Abloba', 'Vatraxos', '80976413583', '2017-06-05'),
(16, 'Dragggki', 'wonder', '11111111112', '2017-06-06'),
(17, 'Nobody', 'Maigaiver', '11111111114', '2017-06-22'),
(18, 'Ela', 'Mou', '56198737813', '2017-06-04'),
(19, 'Dina', 'Bed', '60987103990', '2017-06-10'),
(20, 'asdad', 'sdfsdf', '42416578234', '2017-06-19'),
(21, 'sdf', 'dfgdfg', '56198737812', '2017-06-14'),
(23, 'sdf', 'qeqweq', '42416578532', '2017-06-16'),
(24, 'werw', 'werwer', '60987103990', '2017-06-07'),
(25, 'Livia', 'Montana', '60987103992', '2017-06-05'),
(26, 'Wicher', 'Hunter', '99198737819', '2017-01-02'),
(27, 'Banana', 'Man', '60987103922', '1991-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `Prescription`
--

CREATE TABLE `Prescription` (
  `id` int(11) NOT NULL,
  `clienteleId` int(11) NOT NULL,
  `dateOfIssue` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Prescription`
--

INSERT INTO `Prescription` (`id`, `clienteleId`, `dateOfIssue`) VALUES
(9, 27, '2017-06-02 22:19:03'),
(11, 21, '2017-06-02 22:23:08'),
(12, 16, '2017-06-04 12:12:08'),
(17, 16, '2017-06-04 13:15:30'),
(18, 15, '2017-06-04 16:30:38'),
(19, 37, '2017-06-04 16:31:44'),
(20, 38, '2017-06-04 16:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `Therapy`
--

CREATE TABLE `Therapy` (
  `prescriptionId` int(11) NOT NULL,
  `drugCode` char(10) NOT NULL,
  `dosage` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Therapy`
--

INSERT INTO `Therapy` (`prescriptionId`, `drugCode`, `dosage`) VALUES
(9, '3919073514', ''),
(9, '3919073564', ''),
(9, '3919073568', ''),
(9, '4322342343', ''),
(9, '5919073522', ''),
(11, '4322341512', 'Bingo/day'),
(11, '5919073522', 'trivia/week'),
(12, '3919073564', ''),
(12, '4322342343', ''),
(17, '3919073564', ''),
(18, '3919073522', ''),
(18, '5919073522', 'Bilbbbo/month'),
(19, '4322341512', ''),
(19, '5919073567', ''),
(20, '3919073568', '3moons/day'),
(20, '4322342343', '5pills/week');

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
  ADD UNIQUE KEY `doctorId_2` (`doctorId`,`patientId`),
  ADD KEY `doctorId` (`doctorId`),
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
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `Patient`
--
ALTER TABLE `Patient`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Clientele`
--
ALTER TABLE `Clientele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `Doctor`
--
ALTER TABLE `Doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `Patient`
--
ALTER TABLE `Patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `Prescription`
--
ALTER TABLE `Prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
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
