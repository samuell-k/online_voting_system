-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 03:31 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sfms`
--

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE `storage` (
  `store_id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `file_type` varchar(20) NOT NULL,
  `date_uploaded` varchar(100) NOT NULL,
  `stud_no` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storage`
--

INSERT INTO `storage` (`store_id`, `filename`, `file_type`, `date_uploaded`, `stud_no`) VALUES
(30, 'postgresql_import_instructions (1) (4) (1).docx', 'application/vnd.open', '2024-10-07 17:05:14', 1234),
(35, 'download (3).php', 'application/octet-st', '2024-10-08, 01:04 PM', 123);

--
-- Triggers `storage`
--
DELIMITER $$
CREATE TRIGGER `before_delete_storage` BEFORE DELETE ON `storage` FOR EACH ROW BEGIN
    IF OLD.stud_no = 11 THEN
        DELETE FROM storage2 WHERE store_id = OLD.store_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `storage2`
--

CREATE TABLE `storage2` (
  `store_id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `file_type` varchar(20) NOT NULL,
  `date_uploaded` varchar(100) NOT NULL,
  `stud_no` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stud_id` int(11) NOT NULL,
  `stud_no` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `yr&sec` varchar(5) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stud_id`, `stud_no`, `firstname`, `lastname`, `gender`, `yr&sec`, `password`) VALUES
(5, 123, 'samuel', 'kamanzi', 'Male', '1A', '202cb962ac59075b964b07152d234b70'),
(6, 1234, 'jean', 'kamanzi', 'Male', '1B', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `username`, `password`, `status`) VALUES
(1, 'Administrator', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator'),
(3, 'samuel', 'kamanzi', 'samuel', '202cb962ac59075b964b07152d234b70', 'Regular');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `storage2`
--
ALTER TABLE `storage2`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `storage2`
--
ALTER TABLE `storage2`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
