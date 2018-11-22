-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2018 at 11:03 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pollution_detector`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `ID` int(255) NOT NULL,
  `Image_path` varchar(255) NOT NULL,
  `Left` int(10) DEFAULT NULL,
  `Top` int(10) DEFAULT NULL,
  `Height` int(10) DEFAULT NULL,
  `Width` int(10) DEFAULT NULL,
  `Pollutant_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `list_of_pollutant`
--

CREATE TABLE `list_of_pollutant` (
  `Pollutant_ID` int(11) NOT NULL,
  `Pollutant_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_of_pollutant`
--

INSERT INTO `list_of_pollutant` (`Pollutant_ID`, `Pollutant_name`) VALUES
(1, 'Plastic Bottle'),
(2, 'Oil'),
(3, 'Cigarette Butt'),
(4, 'Mix Debris'),
(5, 'Plastic Container'),
(6, 'Plastic Straws'),
(7, 'Cotton Buds'),
(8, 'Other');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Pollutant_ID` (`Pollutant_ID`);

--
-- Indexes for table `list_of_pollutant`
--
ALTER TABLE `list_of_pollutant`
  ADD PRIMARY KEY (`Pollutant_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `list_of_pollutant`
--
ALTER TABLE `list_of_pollutant`
  MODIFY `Pollutant_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`Pollutant_ID`) REFERENCES `list_of_pollutant` (`Pollutant_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
