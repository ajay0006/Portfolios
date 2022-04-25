-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2022 at 01:38 AM
-- Server version: 8.0.28
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aisharealestate`
--
DROP DATABASE if exists aisharealestate;
CREATE DATABASE aisharealestate;
use aisharealestate;

CREATE TABLE `aisharealestate`.`users`
(
    
    `userid`   VARCHAR(16)  NOT NULL,
    `fName`    VARCHAR(256) NOT NULL,
    `lName`    VARCHAR(256) NOT NULL,
    `password` VARCHAR(256) NOT NULL,
    `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT
    
) ENGINE = InnoDB COMMENT = 'List of users that can view the dashboard';
-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Email` varchar(320) NOT NULL,
  `Age` int NOT NULL,
  `Contact_Num` varchar(50) NOT NULL,
  `City` varchar(25) NOT NULL,
  `Postal_Code` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Province` varchar(10) NOT NULL,
  `Move_Cohousing` varchar(5) DEFAULT NULL,
  `RentAmount` int DEFAULT NULL,
  `Investor` varchar(5) DEFAULT NULL,
  `Invest_Amount` int DEFAULT NULL,
  `Visit_Short_Stay` varchar(5) DEFAULT NULL,
  `Comments` varchar(500) DEFAULT NULL,
  `Date_Message` Date NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_us`
--

-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
-- Add user 
DROP USER if exists 'TESTUSER'@'localhost';
CREATE USER 'TESTUSER'@'localhost' IDENTIFIED BY '1234';

GRANT ALL PRIVILEGES ON aisharealestate.* TO 'TESTUSER'@'localhost';

FLUSH PRIVILEGES;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
