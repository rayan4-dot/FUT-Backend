-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 04:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fut`
--

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `club_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`club_id`, `name`, `logo`) VALUES
(1, 'Barcelona', 'uploads/fcb.png'),
(2, 'Real Madrid', 'uploads/rm.png'),
(4, 'Al Nassr', 'uploads/nasser.webp'),
(5, 'Liverpool', 'uploads/liverpool.png'),
(6, 'Al Hilal', 'uploads/hilal.webp'),
(7, 'Atletico Madrid', 'uploads/atm.webp');

-- --------------------------------------------------------

--
-- Table structure for table `gk`
--

CREATE TABLE `gk` (
  `player_id` int(11) NOT NULL,
  `diving` int(11) NOT NULL CHECK (`diving` between 0 and 100),
  `handling` int(11) NOT NULL CHECK (`handling` between 0 and 100),
  `kicking` int(11) NOT NULL CHECK (`kicking` between 0 and 100),
  `reflexes` int(11) NOT NULL CHECK (`reflexes` between 0 and 100),
  `name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE `nationality` (
  `nationality_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `flag` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`nationality_id`, `name`, `flag`) VALUES
(1, 'Brazil', 'uploads/brazill.png'),
(2, 'spain', 'uploads/spain.png'),
(3, 'Morocco', 'uploads/maroc.png'),
(4, 'Argentina', 'uploads/argentina.webp'),
(5, 'Portugal', 'uploads/portugal.png'),
(6, 'Germany', 'uploads/germany.webp'),
(7, 'Slovakia', 'uploads/oblak.webp');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(50) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 0 and 100),
  `pace` int(11) NOT NULL CHECK (`pace` between 0 and 100),
  `shooting` int(11) NOT NULL CHECK (`shooting` between 0 and 100),
  `passing` int(11) NOT NULL CHECK (`passing` between 0 and 100),
  `dribbling` int(11) NOT NULL CHECK (`dribbling` between 0 and 100),
  `defending` int(11) NOT NULL CHECK (`defending` between 0 and 100),
  `physical` int(11) NOT NULL CHECK (`physical` between 0 and 100),
  `club_id` int(11) DEFAULT NULL,
  `nationality_id` int(11) DEFAULT NULL,
  `playerImage` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `name`, `position`, `rating`, `pace`, `shooting`, `passing`, `dribbling`, `defending`, `physical`, `club_id`, `nationality_id`, `playerImage`) VALUES
(1, 'Kylian Mbappé', 'LW', 92, 38, 50, 21, 21, 36, 97, 2, 1, 'kylian.webp'),
(2, 'Cristiano Ronaldo', 'ST', 54, 67, 89, 27, 17, 35, 20, 4, 5, 'cristiano.webp'),
(3, 'Mohammed Salah', 'RB', 89, 88, 78, 67, 67, 67, 89, 5, 3, 'salah.webp'),
(4, 'Neymar', 'LW', 27, 83, 25, 11, 19, 11, 91, 6, 1, 'ney.webp'),
(6, 'Leo messi', 'ST', 16, 63, 81, 97, 50, 51, 40, 1, 4, 'messi.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`club_id`);

--
-- Indexes for table `gk`
--
ALTER TABLE `gk`
  ADD PRIMARY KEY (`player_id`);

--
-- Indexes for table `nationality`
--
ALTER TABLE `nationality`
  ADD PRIMARY KEY (`nationality_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`),
  ADD KEY `club_id` (`club_id`),
  ADD KEY `nationality_id` (`nationality_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nationality`
--
ALTER TABLE `nationality`
  MODIFY `nationality_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gk`
--
ALTER TABLE `gk`
  ADD CONSTRAINT `gk_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`);

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `club` (`club_id`),
  ADD CONSTRAINT `players_ibfk_2` FOREIGN KEY (`nationality_id`) REFERENCES `nationality` (`nationality_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
