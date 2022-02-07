-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2022 at 11:47 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `idEvent` int(11) NOT NULL,
  `_idTime` int(11) NOT NULL,
  `sport` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `teamHome` varchar(45) DEFAULT NULL,
  `teamAway` varchar(45) DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`idEvent`, `_idTime`, `sport`, `city`, `country`, `teamHome`, `teamAway`, `link`) VALUES
(1, 0, 'Football', 'Salzburg', 'Austria', 'Salburg', 'Sturm', 'https://something.com/'),
(2, 1, 'Ice Hokey', 'Vancouver', 'Canada', 'KAC', 'Capitals', '12'),
(3, 2, 'Tennis', 'Paris', 'France', 'Eiffel Tower', 'Einstein', '1'),
(4, 3, 'Swimming', 'Atlantis', 'Pacific', 'Poseidon', 'Neptune', NULL),
(5, 4, 'Fishing', 'Tokyo', 'Japan', 'Tokyo', 'Hawaii', NULL),
(6, 6, 'Football', 'California', 'USA', 'Bulls', 'Angels', NULL),
(7, 7, 'Esport', 'Meta', 'Facebook', 'VR Chat', '2nd Life', NULL),
(8, 8, 'Kayaking', 'Amazon', 'Rainforest', 'Fish', 'Sharks', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `times`
--

CREATE TABLE `times` (
  `idTime` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `times`
--

INSERT INTO `times` (`idTime`, `time`, `date`) VALUES
(0, '00:04:13', '2022-02-07'),
(1, '11:04:30', '2022-02-06'),
(2, '17:05:36', '2022-02-08'),
(3, '12:07:24', '2022-02-11'),
(4, '22:30:25', '2022-02-01'),
(6, '07:03:49', '2022-01-12'),
(7, '08:03:49', '2022-03-17'),
(8, '14:11:25', '2022-02-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`idEvent`),
  ADD KEY `events_ibfk_1` (`_idTime`);

--
-- Indexes for table `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`idTime`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `idEvent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`_idTime`) REFERENCES `times` (`idTime`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
