-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2018 at 09:36 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jeffreym_hackathon`
--

-- --------------------------------------------------------

--
-- Table structure for table `Task`
--

CREATE TABLE `Task` (
  `id` int(11) NOT NULL,
  `nameOfBuilding` varchar(255) DEFAULT NULL,
  `hasElevator` enum('Y','N') DEFAULT NULL,
  `hasRamp` enum('Y','N') DEFAULT NULL,
  `numElevators` int(11) DEFAULT NULL,
  `numFloors` int(11) DEFAULT NULL,
  `Latitude` double DEFAULT NULL,
  `Longitude` double DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `building_type` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Task`
--

INSERT INTO `Task` (`id`, `nameOfBuilding`, `hasElevator`, `hasRamp`, `numElevators`, `numFloors`, `Latitude`, `Longitude`, `address`, `building_type`) VALUES
(1, 'Music', 'Y', 'Y', 2, 10, 40.8734499, -73.893275, '250 Bedford Park Blvd W, Bronx, NY', 'extracurricular'),
(2, 'Apex', 'Y', 'N', 1, 3, 40.867, -73.894, '250 Bedford Park Blvd W, Bronx, NY', 'student_classroom'),
(3, 'Gillet Hall', 'Y', 'N', 2, 5, 40.8739962, -73.8945999, '250 Bedford Park Blvd W, Bronx, NY', 'student_classroom'),
(4, 'Shuster', 'Y', 'Y', 1, 5, 40.875, -75.894, '250 Bedford Park Blvd W, Bronx, NY', 'student_classroom'),
(5, 'Carman', 'Y', 'N', 2, 6, 40.87153139999999, -73.89648319999999, '250 Bedford Park Blvd W, Bronx, NY', 'student_classroom'),
(6, 'Student Life', 'N', 'N', 0, 2, 40.8705924, -73.8958401, '250 Bedford Park Blvd W, Bronx, NY', 'extracurricular'),
(7, 'Davis ', 'Y', 'Y', 1, 6, 40.87240870000001, -73.89588599999999, '250 Bedford Park Blvd W, Bronx, NY', 'student_classroom'),
(8, 'Science ', 'Y', 'Y', 2, 5, 40.8744564, -73.8940487, '250 Bedford Park Blvd W, Bronx, NY', 'student_classroom'),
(9, 'Library', 'Y', 'N', 3, 3, 40.862, 62.763, '250 Bedford Park Blvd W, Bronx, NY', 'student_classroom'),
(10, 'Old Gym', 'N', 'Y', 1, 4, 40.823, 62.763, '250 Bedford Park Blvd W, Bronx, NY', 'extracurricular'),
(11, 'Bookstore', 'N', 'Y', 0, 1, 40.873, 73.8942, '250 Bedford Park Blvd W, Bronx, NY', 'extracurricular');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Task`
--
ALTER TABLE `Task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Task`
--
ALTER TABLE `Task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
