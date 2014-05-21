-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2014 at 08:07 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `report`
--
CREATE DATABASE IF NOT EXISTS `report` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `report`;

-- --------------------------------------------------------

--
-- Table structure for table `assign_project`
--

CREATE TABLE IF NOT EXISTS `assign_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL,
  `task` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `assign_by` varchar(255) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `priority` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `assign_project`
--

INSERT INTO `assign_project` (`id`, `project_name`, `task`, `start_date`, `end_date`, `assign_by`, `assign_to`, `remark`, `priority`, `status`) VALUES
(26, 'ABC', 'testing error', '2014-05-10', '2014-05-11', 'OM', 19, 'asdjaslda\r\ndfajadaskjd;adkl dad', 'adadka;kd;asd', 'complete'),
(27, 'ABC', 'testing error', '2014-05-10', '2014-05-11', 'OM', 19, 'asdjaslda\r\ndfajadaskjd;adkl dad', 'adadka;kd;asd', 'complete'),
(28, 'RTL2', 'testing error', '2014-05-10', '2014-05-11', 'OM', 16, 'aaaa', 'aaaa', 'complete'),
(29, 'RTL2', 'error', '2014-05-12', '2014-05-13', 'OM', 19, 'testing', 'testing', 'complete'),
(30, 'RTL2', 'error', '2014-05-12', '2014-05-13', 'OM', 19, 'testing', 'testing', 'complete'),
(31, 'RTL2', 'error', '2014-05-12', '2014-05-13', 'OM', 19, 'testing', 'testing', 'complete'),
(32, 'RTL2', 'error', '2014-05-12', '2014-05-13', 'OM', 19, 'testing', 'testing', 'complete'),
(33, '0', '0', '0000-00-00', '0000-00-00', '0', 0, '0', '0', 'pending'),
(34, 'RTL2', 'error', '2014-05-12', '2014-05-13', 'OM', 19, 'testing', 'testing', ''),
(35, '0', '0', '0000-00-00', '0000-00-00', '0', 0, '0', '0', 'pending'),
(36, 'ABC', 'testing error', '2014-05-29', '2014-05-20', 'OM', 16, 'a', 'a', 'complete'),
(37, '0', '0', '0000-00-00', '0000-00-00', '0', 0, '0', '0', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE IF NOT EXISTS `employer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employer_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `employer_name`) VALUES
(1, 'OM'),
(4, 'Labee'),
(5, 'WJPR');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_name`) VALUES
(1, 'ABC'),
(2, 'XYZ'),
(3, 'RTL2');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) NOT NULL,
  `role_priority` int(2) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_priority`) VALUES
(16, 'Employee', 2),
(18, 'Admin', 1),
(19, 'Employee', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `lname`, `dob`, `address`, `phone`, `email`, `username`, `password`) VALUES
(16, 'harish', 'bhatt', '1989-03-05', 'arera', 9589665588, 'demo11@gmail.com', 'harish', 'harish'),
(18, 'admin', 'admin', '2014-05-08', 'admin', 0, 'aloknema.11@gmail.com', 'admin', 'admin'),
(19, 'devendra', 'sahu', '2014-05-08', 'riva', 7845124578, 'support@innctech.com', 'devendra', 'devendra');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
