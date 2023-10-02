-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2023 at 12:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BACKUP_TRACKING`
--

-- --------------------------------------------------------

--
-- Table structure for table `BACKUP_CATEGORY`
--

CREATE TABLE `BACKUP_CATEGORY` (
  `Id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `User` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `CreatedBy` int(11) NULL,
  `ModifiedBy` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `FILE_PERMISSION`
--

CREATE TABLE `FILE_PERMISSION` (
  `Id` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `FILE_TRACKING_PARENT` int(11) NOT NULL,
  `Create` tinyint(1) NOT NULL,
  `Update` tinyint(1) NOT NULL,
  `Read` tinyint(1) NOT NULL,
  `SoftDelete` tinyint(1) NOT NULL,
  `HardDelete` tinyint(1) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `CreatedBy` int(11) NULL,
  `ModifiedBy` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `FILE_TRACKING_CHILD`
--

CREATE TABLE `FILE_TRACKING_CHILD` (
  `Id` int(11) NOT NULL,
  `FILE_TRACKING_PARENT` int(11) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Path` varchar(250) NOT NULL,
  `SoftDelete` tinyint(1) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `CreatedBy` int(11) NULL,
  `ModifiedBy` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `FILE_TRACKING_PARENT`
--

CREATE TABLE `FILE_TRACKING_PARENT` (
  `Id` int(11) NOT NULL,
  `Filename` varchar(50) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `User` int(11) NOT NULL,
  `FILE_TYPE` int(11) NOT NULL,
  `Path` varchar(250) NOT NULL,
  `SoftDelete` tinyint(1) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `CreatedBy` int(11) NULL,
  `ModifiedBy` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file type`
--

CREATE TABLE `FILE_TYPE` (
  `Id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `User` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `CreatedBy` int(11) NULL,
  `ModifiedBy` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `FULL_BACKUP`
--

CREATE TABLE `FULL_BACKUP` (
  `Id` int(11) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Path` varchar(300) NOT NULL,
  `BACKUP_CATEGORY` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `SoftDelete` tinyint(1) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `CreatedBy` int(11) NULL,
  `ModifiedBy` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `PERMISSIONS`
--

CREATE TABLE `PERMISSIONS` (
  `Id` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `User` int(11) NOT NULL,
  `FB_Create` tinyint(1) NOT NULL,
  `FB_Update` tinyint(1) NOT NULL,
  `FB_Read` tinyint(1) NOT NULL,
  `FB_SoftDelete` tinyint(1) NOT NULL,
  `FB_HardDelete` tinyint(1) NOT NULL,
  `FT_Create` tinyint(1) NOT NULL,
  `FT_Update` tinyint(1) NOT NULL,
  `FT_Read` tinyint(1) NOT NULL,
  `FT_SoftDelete` tinyint(1) NOT NULL,
  `FT_HardDelete` tinyint(1) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `CreatedBy` int(11) NULL,
  `ModifiedBy` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ROLE`
--

CREATE TABLE `ROLE` (
  `Id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `User` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `CreatedBy` int(11) NULL,
  `ModifiedBy` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `Role` int(11) DEFAULT NULL,
  `Parent` int(11) DEFAULT NULL,
  `Permissions` int(11) DEFAULT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `CreatedBy` int(11) NULL,
  `ModifiedBy` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BACKUP_CATEGORY`
--
ALTER TABLE `BACKUP_CATEGORY`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `FILE_PERMISSION`
--
ALTER TABLE `FILE_PERMISSION`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `FILE_TRACKING_CHILD`
--
ALTER TABLE `FILE_TRACKING_CHILD`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `FILE_TRACKING_PARENT`
--
ALTER TABLE `FILE_TRACKING_PARENT`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `FILE_TYPE`
--
ALTER TABLE `FILE_TYPE`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `FULL_BACKUP`
--
ALTER TABLE `FULL_BACKUP`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `PERMISSIONS`
--
ALTER TABLE `PERMISSIONS`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `ROLE`
--
ALTER TABLE `ROLE`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BACKUP_CATEGORY`
--
ALTER TABLE `BACKUP_CATEGORY`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `FILE_PERMISSION`
--
ALTER TABLE `FILE_PERMISSION`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `FILE_TRACKING_CHILD`
--
ALTER TABLE `FILE_TRACKING_CHILD`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `FILE_TRACKING_PARENT`
--
ALTER TABLE `FILE_TRACKING_PARENT`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `FILE_TYPE`
--
ALTER TABLE `FILE_TYPE`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `FULL_BACKUP`
--
ALTER TABLE `FULL_BACKUP`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `PERMISSIONS`
--
ALTER TABLE `PERMISSIONS`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ROLE`
--
ALTER TABLE `ROLE`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `USER`
--
ALTER TABLE `USER`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
