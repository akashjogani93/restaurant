-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2023 at 10:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtable`
--

CREATE TABLE `addtable` (
  `table_ID` int(11) NOT NULL,
  `table_Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addtable`
--

INSERT INTO `addtable` (`table_ID`, `table_Name`) VALUES
(3, 'T1'),
(4, 'T2');

-- --------------------------------------------------------

--
-- Table structure for table `empreg`
--

CREATE TABLE `empreg` (
  `empid` int(11) NOT NULL,
  `empname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `path1` varchar(200) NOT NULL,
  `path2` varchar(200) NOT NULL,
  `salary` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `cap_code` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `empreg`
--

INSERT INTO `empreg` (`empid`, `empname`, `address`, `mobile`, `path1`, `path2`, `salary`, `type`, `uname`, `pass`, `cap_code`) VALUES
(1, 'sagar', 'machee', '7028890399', 'uploads/idprof/WhatsApp Image 2023-03-02 at 10.47.48 AM.jpeg', 'uploads/idprof/WhatsApp Image 2023-03-02 at 10.47.48 AM.jpeg', '', 'Cleark', '', '', 0),
(2, 'Akash', 'sambra', '7028890399', 'uploads/idprof/WhatsApp Image 2023-03-02 at 10.47.48 AM.jpeg', 'uploads/idprof/WhatsApp Image 2023-03-02 at 10.47.48 AM.jpeg', '', 'Captain', '', '', 2),
(3, 'Mahesh', 'sambra', '7676801529', '', '', '50000', 'Captain', 'mahesh', '12345', 3);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `slno` int(11) NOT NULL,
  `item_cat` varchar(200) NOT NULL,
  `itmnam` varchar(50) NOT NULL,
  `prc` varchar(40) NOT NULL,
  `prc2` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`slno`, `item_cat`, `itmnam`, `prc`, `prc2`) VALUES
(3, 'Staters', 'Papad', '30', '40'),
(4, 'Non-veg', 'Birayani', '100', '102'),
(5, 'Non-veg', 'Birayani', '100', '102'),
(6, 'Non-veg', 'Birayani', '100', '102'),
(7, 'Non-veg', 'Birayani', '100', '102'),
(8, 'Non-veg', 'Birayani', '100', '102'),
(9, 'Non-veg', 'Birayani', '100', '102'),
(10, 'Non-veg', 'Birayani', '100', '102'),
(11, 'Non-veg', 'Birayani', '100', '102'),
(12, 'Veg', 'Papad', '120', '80'),
(13, 'Veg', 'Birayani', '100', '150'),
(14, 'Staters', 'Pepsi', '15', '20'),
(15, 'Staters', 'Slice', '20', '25'),
(16, 'Staters', 'Salad papad', '30', '50');

-- --------------------------------------------------------

--
-- Table structure for table `item-categories`
--

CREATE TABLE `item-categories` (
  `cat_id` int(50) NOT NULL,
  `category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item-categories`
--

INSERT INTO `item-categories` (`cat_id`, `category`) VALUES
(1, 'Veg'),
(3, 'Non-veg'),
(4, 'Staters');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(10) NOT NULL,
  `pname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`) VALUES
(1, 'Rice');

-- --------------------------------------------------------

--
-- Table structure for table `store_room`
--

CREATE TABLE `store_room` (
  `store_id` int(11) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `item_unit` varchar(30) NOT NULL,
  `item_qty` varchar(20) NOT NULL,
  `item_rate` varchar(30) NOT NULL,
  `item_pur_date` varchar(30) NOT NULL,
  `item_total` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store_room`
--

INSERT INTO `store_room` (`store_id`, `item_name`, `item_unit`, `item_qty`, `item_rate`, `item_pur_date`, `item_total`) VALUES
(1, 'Rice', 'kg', '150', '45', '2023-03-03', '4500'),
(2, 'rice', 'kg', '150', '50', '2023-03-03', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `store_room_finish`
--

CREATE TABLE `store_room_finish` (
  `fid` int(11) NOT NULL,
  `item_id` varchar(20) NOT NULL,
  `item_name_finish` varchar(40) NOT NULL,
  `f_item_unit` varchar(40) NOT NULL,
  `f_item_rem_qty` varchar(40) NOT NULL,
  `f_item_finish_qty` varchar(40) NOT NULL,
  `given_date` varchar(30) NOT NULL,
  `type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store_room_finish`
--

INSERT INTO `store_room_finish` (`fid`, `item_id`, `item_name_finish`, `f_item_unit`, `f_item_rem_qty`, `f_item_finish_qty`, `given_date`, `type`) VALUES
(1, 'rice', 'rice', 'kg', '150', '50', '2023-03-03', 'kitchen1');

-- --------------------------------------------------------

--
-- Table structure for table `temtable`
--

CREATE TABLE `temtable` (
  `slno` int(10) NOT NULL,
  `date` int(11) NOT NULL,
  `itmno` int(10) NOT NULL,
  `itmnam` varchar(26) NOT NULL,
  `prc` double NOT NULL,
  `qty` double NOT NULL,
  `tot` double NOT NULL,
  `tabno` varchar(10) NOT NULL,
  `capname` varchar(50) NOT NULL,
  `status` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temtable`
--

INSERT INTO `temtable` (`slno`, `date`, `itmno`, `itmnam`, `prc`, `qty`, `tot`, `tabno`, `capname`, `status`) VALUES
(1, 2023, 3, 'Papad', 40, 1, 40, 'T1', 'Mahesh', 1),
(2, 2023, 3, 'Papad', 40, 1, 40, 'T1', 'Mahesh', 1),
(3, 2023, 3, 'Papad', 40, 1, 40, 'T1', 'Mahesh', 1),
(4, 2023, 3, 'Papad', 40, 1, 40, 'T1', 'Mahesh', 1),
(5, 2023, 3, 'Papad', 40, 1, 40, 'T1', 'Mahesh', 1),
(6, 2023, 3, 'Papad', 40, 1, 40, 'T1', 'Mahesh', 1),
(7, 2023, 3, 'Papad', 40, 1, 40, 'T2', 'Mahesh', 1),
(8, 2023, 3, 'Papad', 40, 1, 40, 'T2', 'Mahesh', 1),
(9, 2023, 3, 'Papad', 40, 1, 40, 'T2', 'Mahesh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userlist`
--

CREATE TABLE `userlist` (
  `id` bigint(20) NOT NULL,
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlist`
--

INSERT INTO `userlist` (`id`, `user`) VALUES
(1, 'Captain'),
(2, 'Cleark');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtable`
--
ALTER TABLE `addtable`
  ADD PRIMARY KEY (`table_ID`);

--
-- Indexes for table `empreg`
--
ALTER TABLE `empreg`
  ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`slno`);

--
-- Indexes for table `item-categories`
--
ALTER TABLE `item-categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `store_room`
--
ALTER TABLE `store_room`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `store_room_finish`
--
ALTER TABLE `store_room_finish`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `temtable`
--
ALTER TABLE `temtable`
  ADD PRIMARY KEY (`slno`);

--
-- Indexes for table `userlist`
--
ALTER TABLE `userlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addtable`
--
ALTER TABLE `addtable`
  MODIFY `table_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `empreg`
--
ALTER TABLE `empreg`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `item-categories`
--
ALTER TABLE `item-categories`
  MODIFY `cat_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `store_room`
--
ALTER TABLE `store_room`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `store_room_finish`
--
ALTER TABLE `store_room_finish`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temtable`
--
ALTER TABLE `temtable`
  MODIFY `slno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userlist`
--
ALTER TABLE `userlist`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
