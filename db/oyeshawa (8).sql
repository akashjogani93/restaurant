-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 06:24 AM
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
-- Database: `oyeshawa`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtable`
--

CREATE TABLE `addtable` (
  `table_ID` int(11) NOT NULL,
  `table_Name` varchar(20) NOT NULL,
  `ac` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addtable`
--

INSERT INTO `addtable` (`table_ID`, `table_Name`, `ac`) VALUES
(3, 'G-1', 'Non Ac'),
(4, 'G-2', 'Non Ac'),
(5, 'G-3', 'Non Ac'),
(6, 'G-4', 'Non Ac'),
(7, 'G-5', 'Non Ac'),
(8, 'G-6', 'Non Ac'),
(9, 'G-7', 'Non Ac'),
(10, 'G-8', 'Non Ac'),
(11, 'G-9', 'Non Ac'),
(12, 'G-10', 'Non Ac'),
(13, 'G-11', 'Non Ac'),
(14, 'G-12', 'Non Ac'),
(15, 'G-13', 'Non Ac'),
(16, 'G-14', 'Non Ac'),
(17, 'G-15', 'Non Ac'),
(18, 'G-16', 'Non Ac'),
(19, 'T-1', 'Non Ac'),
(20, 'T-2', 'Non Ac'),
(21, 'T-3', 'Non Ac'),
(22, 'T-4', 'Non Ac'),
(23, 'T-5', 'Non Ac'),
(24, 'T-6', 'Non Ac'),
(25, 'T-7', 'Non Ac'),
(26, 'T-8', 'Non Ac'),
(27, 'T-9', 'Non Ac'),
(28, 'T-10', 'Non Ac'),
(29, 'T-11', 'Non Ac'),
(30, 'T-12', 'Non Ac'),
(31, 'T-13', 'Non Ac'),
(32, 'UD-1', 'Non Ac'),
(33, 'UD-2', 'Non Ac'),
(34, 'UD-3', 'Non Ac'),
(35, 'UD-4', 'Non Ac'),
(36, 'UD-5', 'Non Ac'),
(37, 'UD-6', 'Non Ac'),
(38, 'UD-7', 'Non Ac');

-- --------------------------------------------------------

--
-- Table structure for table `assetsdamage`
--

CREATE TABLE `assetsdamage` (
  `id` int(10) NOT NULL,
  `pur_id` int(10) NOT NULL,
  `stock_id` int(10) NOT NULL,
  `product` varchar(100) NOT NULL,
  `qty` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assetsproduct`
--

CREATE TABLE `assetsproduct` (
  `product` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assetsproduct`
--

INSERT INTO `assetsproduct` (`product`, `id`) VALUES
('Tables', 1),
('Chair', 2);

-- --------------------------------------------------------

--
-- Table structure for table `assetspurchase`
--

CREATE TABLE `assetspurchase` (
  `id` int(10) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `remark` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assetspurchase`
--

INSERT INTO `assetspurchase` (`id`, `amount`, `date`, `remark`) VALUES
(1, 1000, '2023-11-12', 'Test'),
(2, 2000, '2023-12-09', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `assetspurchasedata`
--

CREATE TABLE `assetspurchasedata` (
  `id` int(10) NOT NULL,
  `pur_id` int(10) NOT NULL,
  `product` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `qty` double NOT NULL,
  `total` double NOT NULL,
  `remainQty` double NOT NULL,
  `remainTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assetspurchasedata`
--

INSERT INTO `assetspurchasedata` (`id`, `pur_id`, `product`, `amount`, `qty`, `total`, `remainQty`, `remainTotal`) VALUES
(1, 1, 'Tables', 100, 10, 1000, 0, 0),
(2, 2, 'Tables', 200, 10, 2000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `assetsstock`
--

CREATE TABLE `assetsstock` (
  `id` int(10) NOT NULL,
  `pur_id` int(10) NOT NULL,
  `product` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `qty` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assetsstock`
--

INSERT INTO `assetsstock` (`id`, `pur_id`, `product`, `amount`, `qty`) VALUES
(1, 0, 'Tables', 3000, 20);

-- --------------------------------------------------------

--
-- Table structure for table `beverages`
--

CREATE TABLE `beverages` (
  `id` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `stock` double NOT NULL,
  `date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beverages`
--

INSERT INTO `beverages` (`id`, `pid`, `stock`, `date`) VALUES
(1, 129, 10, '2023-12-02'),
(2, 129, 10, '2023-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `categoroy`
--

CREATE TABLE `categoroy` (
  `id` int(10) NOT NULL,
  `CategoryName` varchar(50) NOT NULL,
  `catType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoroy`
--

INSERT INTO `categoroy` (`id`, `CategoryName`, `catType`) VALUES
(1, 'Chicken', 'Kitchen'),
(2, 'Chinese', 'Kitchen'),
(3, 'Dailry ', 'Kitchen'),
(4, 'Dryfruit', 'Kitchen'),
(5, 'Grocery', 'Kitchen'),
(6, 'Masala', 'Kitchen'),
(7, 'Meat and Seafood', 'Kitchen'),
(8, 'Oil', 'Kitchen'),
(9, 'Spices and Condiments', 'Kitchen'),
(10, 'Sweet Corn', 'Kitchen'),
(11, 'Syrup', 'Kitchen'),
(16, 'Bakery and Staples', 'Bevarages'),
(17, 'Beverages And Desserts', 'Bevarages'),
(18, 'Bag', 'ParcelMaterial');

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
(1, 'Vivek Joshi', '', '', '', '', '', 'Captain', 'vivek123', 'vivek123', 1),
(2, 'Sudeep', '', '', '', '', '', 'Captain', 'sudeep', 'sudeep', 2),
(3, 'Naheed', '', '', '', '', '', 'Captain', 'Naheed', 'Naheed', 3),
(4, 'Amit', '', '', '', '', '', 'Captain', 'Amit', 'Amit', 4),
(5, 'Javid', '', '', '', '', '', 'Manager', 'Javid', 'Javid', 5),
(6, 'Akshay', '', '', '', '', '', 'Manager', 'Akshay', 'Akshay', 6);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `slno` bigint(10) NOT NULL,
  `date` varchar(120) NOT NULL,
  `time` varchar(120) NOT NULL,
  `capname` varchar(120) NOT NULL,
  `cap_code` double NOT NULL,
  `gtot` float NOT NULL,
  `discount` double NOT NULL,
  `discAmt` double NOT NULL,
  `afterDisc` double NOT NULL,
  `gst` double NOT NULL,
  `gstAmt` double NOT NULL,
  `afterGst` double NOT NULL,
  `roundplus` double NOT NULL,
  `roundminus` double NOT NULL,
  `nettot` double NOT NULL,
  `cashId` int(10) NOT NULL,
  `orde` varchar(100) NOT NULL,
  `pmode` varchar(200) NOT NULL,
  `status` double NOT NULL,
  `tabno` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`slno`, `date`, `time`, `capname`, `cap_code`, `gtot`, `discount`, `discAmt`, `afterDisc`, `gst`, `gstAmt`, `afterGst`, `roundplus`, `roundminus`, `nettot`, `cashId`, `orde`, `pmode`, `status`, `tabno`) VALUES
(1, '2023-11-18', '07:12 PM', 'Vivek Joshi', 1, 1590, 0, 0, 1590, 5, 79.5, 1669.5, 0.5, 0, 1670, 0, 'Table', 'Cash', 1, 'G-1'),
(2, '2023-11-18', '07:12 PM', 'Naheed', 3, 510, 0, 0, 510, 5, 25.5, 535.5, 0.5, 0, 536, 0, 'Table', 'Cash', 1, 'G-3'),
(3, '2023-11-28', '10:41 PM', 'Vivek Joshi', 1, 1410, 0, 0, 1410, 5, 70.5, 1480.5, 0.5, 0, 1481, 0, 'Table', 'Cash', 1, 'G-1'),
(4, '2023-11-28', '10:42 PM', 'Sudeep', 2, 930, 0, 0, 930, 5, 46.5, 976.5, 0.5, 0, 977, 0, 'Table', 'Cash', 1, 'G-5'),
(5, '2023-11-28', '10:42 PM', 'Vivek Joshi', 1, 2050, 0, 0, 2050, 5, 102.5, 2152.5, 0.5, 0, 2153, 0, 'Table', 'Cash', 1, 'G-4'),
(6, '2023-11-28', '10:42 PM', 'Sudeep', 2, 1290, 0, 0, 1290, 5, 64.5, 1354.5, 0.5, 0, 1355, 0, 'Table', 'Cash', 1, 'G-1'),
(7, '2023-11-28', '10:42 PM', 'Sudeep', 2, 720, 0, 0, 720, 5, 36, 756, 0, 0, 756, 0, 'Table', 'Cash', 1, 'G-10'),
(8, '2023-11-28', '10:42 PM', 'Naheed', 3, 1080, 0, 0, 1080, 5, 54, 1134, 0, 0, 1134, 0, 'Table', 'Cash', 1, 'G-3'),
(9, '2023-11-28', '10:43 PM', 'Sudeep', 2, 600, 0, 0, 600, 5, 30, 630, 0, 0, 630, 0, 'Table', 'Cash', 1, 'T-8'),
(10, '2023-11-30', '12:00 PM', 'Vivek Joshi', 1, 660, 0, 0, 660, 5, 33, 693, 0, 0, 693, 0, 'Table', 'Cash', 1, 'G-1'),
(11, '2023-11-30', '01:32 PM', 'Vivek Joshi', 1, 1320, 0, 0, 1320, 5, 66, 1386, 0, 0, 1386, 0, 'Table', 'Cash', 1, 'G-1'),
(12, '2023-12-01', '05:01 PM', 'Naheed', 3, 2130, 0, 0, 2130, 5, 106.5, 2236.5, 0.5, 0, 2237, 0, 'Table', 'Online', 1, 'G-1'),
(13, '2023-12-01', '05:03 PM', 'Sudeep', 2, 4050, 0, 0, 4050, 5, 202.5, 0, 0.5, 0, 4253, 0, 'Table', 'Card', 1, 'G-2'),
(14, '2023-12-01', '05:05 PM', 'Vivek Joshi', 1, 6520, 0, 0, 6520, 5, 326, 6846, 0, 0, 6846, 0, 'Table', 'Online', 1, 'G-3'),
(15, '2023-12-01', '05:24 PM', 'Vivek Joshi', 1, 4425, 0, 0, 4425, 5, 221.25, 4646.25, 0, 0.25, 4646, 0, 'Table', 'Not Setteled', 0, 'G-1');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `slno` int(11) NOT NULL,
  `item_cat` varchar(200) NOT NULL,
  `itmnam` varchar(50) NOT NULL,
  `prc` varchar(40) NOT NULL,
  `prc2` varchar(40) NOT NULL,
  `item_code` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`slno`, `item_cat`, `itmnam`, `prc`, `prc2`, `item_code`) VALUES
(13, 'Veg', 'Jeera Soda', '70', '70', 1),
(14, 'Veg', 'Lassi ', '120', '120', 2),
(15, 'Veg', 'Chaas', '120', '120', 3),
(16, 'Veg', 'Fresh Lime Water', '50', '50', 4),
(17, 'Veg', 'Fresh Lime Soda', '60', '60', 5),
(18, 'Veg', 'Aerated Drinks', '30', '30', 6),
(19, 'Veg', 'Bottled Water', '30', '30', 7),
(21, 'Veg', 'Bottel Of Soda', '20', '20', 8),
(22, 'Veg', 'Green Lime Mojito (Water)', '70', '70', 9),
(23, 'Veg', 'Green Lime Mojito (Soda)', '80', '80', 10),
(24, 'Veg', 'Blue Curacao(Water)', '70', '70', 11),
(25, 'Veg', 'Blue Curacao(soda)', '80', '80', 12),
(26, 'Veg', 'Lime Coriander(A tangy treat of lime)', '90', '90', 13),
(27, 'Veg', 'Lime Coriander(Coriander)', '110', '110', 14),
(28, 'Veg', 'Raindrop(Vegetable)', '90', '90', 15),
(29, 'Veg', 'Raindrop(baby corn)', '110', '110', 16),
(30, 'Veg', 'Sweet Corn(Vegetable)', '90', '90', 17),
(31, 'Veg', 'Sweet Corn(Chicken)', '110', '110', 18),
(33, 'Veg', 'Oye Shawa  Special (Chinese soup)', '110', '110', 19),
(34, 'Veg', 'Oye Shawa Special (Chef Chinese soup)', '130', '130', 20),
(35, 'Veg', 'Manchow Soup(Vegetables/Chicken, mushroom))', '90', '90', 21),
(36, 'Veg', 'Manchow Soup(Bumboo Shorts)', '110', '110', 22),
(37, 'Veg', 'Cream Of Almond', '110', '110', 23),
(38, 'Veg', 'Cream Of Mushroom', '100', '100', 24),
(39, 'Veg', 'Cream Of Tomato', '90', '90', 25),
(40, 'Veg', 'Cream Of Chicken', '110', '110', 26),
(41, 'Veg', 'Hot & Sour Soup(Julienne Vegetables)', '90', '90', 27),
(42, 'Veg', 'Sea Food Special(Clear Soup)', '120', '120', 28),
(43, 'Veg', 'Talumein(Julienne Vegetable)', '90', '90', 29),
(44, 'Veg', 'Talumein(Chicken)', '110', '110', 30),
(45, 'Veg', 'Veg Clear soup', '80', '80', 31),
(46, 'Veg', 'Chicken clear soup', '110', '110', 32),
(47, 'Veg', 'Sanghai Cottage Cheese', '160', '160', 33),
(48, 'Veg', 'Crispy Garlic Potato', '160', '160', 34),
(49, 'Veg', 'Crispy Assorted Vegetables', '160', '160', 35),
(50, 'Veg', 'Crispy Fried babycorn', '160', '160', 36),
(51, 'Veg', 'Corn Peper dry', '160', '160', 37),
(52, 'Veg', 'Cottage Cheese With Peanut sauce', '180', '180', 38),
(53, 'Veg', 'Crispy Honey Potato', '160', '160', 39),
(54, 'Veg', 'Hong kong style', '160', '160', 40),
(55, 'Veg', 'Dragon Roll With Cheese', '160', '160', 41),
(56, 'Veg', 'Gobi Schezawani dry', '150', '150', 42),
(57, 'Veg', 'Sliced Chicken sauce', '175', '175', 43),
(58, 'Veg', 'Sliced Mutton sauce', '190', '190', 44),
(59, 'Veg', 'Sliced Prawns sauce', '120', '120', 45),
(60, 'Veg', 'Hunan Chicken', '175', '175', 46),
(61, 'Veg', 'Hong Kong Chicken', '175', '175', 47),
(62, 'Veg', 'Chicken Spring Roll', '175', '175', 48),
(63, 'Veg', 'Panner Noodels(H)', '160', '160', 49),
(64, 'Veg', 'Panner Noodels(F)', '180', '180', 50),
(65, 'Veg', 'Malaysian Noodels(H)', '160', '160', 51),
(66, 'Veg', 'Malaysian Noodels(F)', '180', '180', 52),
(67, 'Veg', 'Singapore Noodles(H)', '140', '140', 53),
(68, 'Veg', 'Singapore Noodles(F)', '170', '170', 54),
(69, 'Veg', 'Thai Noodels(H)', '140', '140', 55),
(70, 'Veg', 'Thai Noodels(F)', '160', '160', 56),
(71, 'Veg', 'Lemon Garlic Chilli Noodels(H)', '140', '140', 57),
(72, 'Veg', 'Lemon Garlic Chilli Noodels(F)', '160', '160', 58),
(73, 'Veg', 'Shanghai Noodels(H)', '140', '140', 59),
(74, 'Veg', 'Shanghai Noodels(F)', '160', '160', 60),
(75, 'Veg', 'Chopsuey American/Chinese)(H)', '140', '140', 61),
(76, 'Veg', 'Chopsuey American/Chinese)(F)', '160', '160', 62),
(77, 'Veg', 'Hong kong Noodels(H)', '140', '140', 63),
(78, 'Veg', 'Hong kong Noodels(F)', '150', '150', 64),
(79, 'Veg', 'Hunan Chilli Noodels(H)', '140', '140', 65),
(80, 'Veg', 'Hunan Chilli Noodels(F)', '160', '160', 66),
(81, 'Veg', 'Jai Thai Special Noodels(H)', '140', '140', 67),
(82, 'Veg', 'Jai Thai Special Noodels(F)', '160', '160', 68),
(83, 'Veg', 'Hong Kong Fried Rice(H)', '150', '150', 69),
(84, 'Veg', 'Hong Kong Fried Rice(F)', '170', '170', 70),
(85, 'Veg', 'Thai Fried Rice(H)', '150', '170', 71),
(86, 'Veg', 'Thai Fried Rice(F)', '170', '170', 72),
(87, 'Veg', 'Panner Fried Rice(H)', '150', '150', 73),
(88, 'Veg', 'Panner Fried Rice(H)', '170', '170', 74),
(89, 'Veg', 'Shanghai Fried Rice(H)', '150', '150', 75),
(90, 'Veg', 'Shanghai Fried Rice(F)', '170', '170', 76),
(91, 'Veg', 'Chilli Garlic Mashroom Fried rice(H)', '150', '150', 77),
(92, 'Veg', 'Chilli Garlic Mashroom Fried rice(F)', '170', '170', 78),
(93, 'Veg', 'Schezewan Fried rice(H)', '150', '150', 79),
(94, 'Veg', 'Schezewan Fried rice(G)', '170', '170', 80),
(95, 'Veg', 'Stew Fried Rice(H)', '150', '150', 81),
(96, 'Veg', 'Stew Fried Rice(F)', '170', '170', 82),
(97, 'Veg', 'Leamon Garlic Fried rice(H)', '150', '150', 83),
(98, 'Veg', 'Mix Fried rice', '190', '190', 84),
(99, 'Veg', 'Egg Fried Rice', '150', '150', 85),
(100, 'Veg', 'Oye Shawa Khas-E-Dawat', '550', '550', 86),
(101, 'Veg', 'Sev Ki Tikki', '160', '160', 87),
(102, 'Veg', 'Veg Kurkure', '170', '170', 88),
(103, 'Veg', 'Dhai Ki Tikki', '200', '200', 89),
(104, 'Veg', 'Shaan-E-Aloo', '160', '160', 90),
(105, 'Veg', 'Panner Malai Seekh', '175', '175', 91),
(106, 'Veg', 'Kothmir seekh', '175', '175', 92),
(107, 'Veg', 'Bahaar-E-Babycorn', '165', '165', 93),
(108, 'Veg', 'Makai Moti Seekh', '175', '175', 94),
(109, 'Veg', 'Panner Peshwari', '175', '175', 95),
(110, 'Veg', 'Panner Tiranga Tikka', '195', '195', 96),
(111, 'Veg', 'Paneer Tikka Lal Bahadur', '175', '175', 97),
(112, 'Veg', 'Murgh Soja Shai Kebab', '275', '275', 98),
(113, 'Veg', 'Lemon Grass Tikka', '255', '255', 99),
(114, 'Veg', 'Murgh Dohraseekh Kebab', '275', '275', 100),
(115, 'Veg', 'Shola Ka Murgh', '275', '275', 101),
(116, 'Veg', 'Murgh gulab-E-Seekh', '265', '265', 102),
(117, 'Veg', 'Tiranga Mumtaz', '300', '300', 103),
(118, 'Veg', 'Mutton Dhooandar Boti', '335', '335', 104),
(119, 'Veg', 'Murgh Nainatal Kebab', '255', '255', 105),
(120, 'Veg', 'Hara Mutton chops', '300', '300', 106),
(121, 'Veg', 'Sholay Kebab', '265', '265', 107),
(122, 'Veg', 'Murgh Chapati', '210', '210', 108),
(123, 'Veg', 'Murgh Urwal', '215', '215', 109),
(124, 'Veg', 'Tawa Mutton Dry fry', '310', '310', 110),
(125, 'Veg', 'Tawa Mutton Hara pyaza', '310', '310', 111),
(126, 'Veg', 'Oye Shawa Khas-E-dawaat', '750', '750', 112),
(127, 'Veg', 'Jafrani Kofta', '190', '190', 113),
(128, 'Veg', 'Shabnam Curry', '165', '165', 114),
(129, 'Veg', 'Mushroom Hara Saag', '165', '165', 115),
(130, 'Veg', 'Sabzi Miloni', '165', '165', 116),
(131, 'Veg', 'Kabuli Channa Masala', '165', '165', 117),
(132, 'Veg', 'Lagaan Ki sabzi', '165', '165', 118),
(133, 'Veg', 'Subzi Zaykedar', '180', '180', 119),
(134, 'Veg', 'Hari Makai Khas', '175', '175', 120),
(135, 'Veg', 'Mushroom Takatin', '175', '175', 121),
(136, 'Veg', 'Aloo Gobi', '175', '175', 122),
(137, 'Veg', 'Paneer Khurchan', '175', '175', 123),
(138, 'Veg', 'Panner Kotimbir Kofta', '175', '175', 124),
(139, 'Veg', 'Panner Tikka Lababdar', '175', '175', 125),
(140, 'Veg', 'Panner Pasanda', '175', '175', 126),
(141, 'Veg', 'Tawa Panner', '185', '185', 127),
(142, 'Veg', 'Sarso Ka Saag', '165', '165', 128),
(143, 'Veg', 'Pindi Chole', '185', '185', 129),
(144, 'Veg', 'Tawa sabzi Ki Bahar', '185', '185', 130),
(145, 'Veg', 'Dal Palak', '135', '135', 131),
(146, 'Veg', 'Dal Double Tadka', '135', '135', 132),
(147, 'Veg', 'Dal Pancharangi', '145', '145', 133),
(148, 'Veg', 'Dal makhani', '135', '135', 134),
(149, 'Veg', 'Murgh Badami', '215', '215', 135),
(150, 'Veg', 'Murgh lababdar', '225', '225', 136),
(151, 'Veg', 'Murgh Mughlai', '225', '225', 137),
(152, 'Veg', 'Murgh Khurchan', '245', '245', 138),
(153, 'Veg', 'Murgh Pyaz ka Salan', '235', '235', 139),
(154, 'Veg', 'Kadai murgh', '215', '215', 140),
(155, 'Veg', 'Murgh Saag wala', '245', '245', 141),
(156, 'Veg', 'Murgh Makhani', '235', '235', 142),
(157, 'Veg', 'Murgh Handi', '215', '215', 143),
(158, 'Veg', 'Murgh Nanital Kofta', '215', '215', 144),
(159, 'Veg', 'Murgh Dhania Adraki', '215', '215', 145),
(160, 'Veg', 'Murgh Patiala', '265', '265', 146),
(161, 'Veg', 'Murgh Keema masala', '225', '225', 147),
(162, 'Veg', 'Murgh Korma', '245', '245', 148),
(163, 'Veg', 'Murgh Musallam(H)', '285', '285', 149),
(164, 'Veg', 'Murgh Musallam(F)', '485', '485', 150),
(165, 'Veg', 'Mutton Rogan Josh', '335', '335', 151),
(166, 'Veg', 'Saag Ghost', '350', '350', 152),
(167, 'Veg', 'Mutton Bhuna Ghost', '335', '335', 153),
(168, 'Veg', 'Ghost Korma', '340', '340', 154),
(169, 'Veg', 'Mutton Mughlai', '345', '345', 155),
(170, 'Veg', 'Tandoori Roti', '15', '15', 156),
(171, 'Veg', 'Butter Roti', '20', '20', 157),
(172, 'Veg', 'Kulcha ', '30', '30', 158),
(173, 'Veg', 'Butter Kulcha', '35', '35', 159),
(174, 'Veg', 'Missi Roti', '30', '30', 160),
(175, 'Veg', 'Miss roti(Wheat Flour)', '35', '35', 161),
(176, 'Veg', 'Pudina Ka Kulcha(H)', '30', '30', 162),
(177, 'Veg', 'Pudina Ka Kulcha(F)', '35', '35', 163),
(178, 'Veg', 'Khasta roti(H)', '30', '30', 164),
(179, 'Veg', 'Khasta roti(F)', '35', '35', 165),
(180, 'Veg', 'Peshwari Kulcha(H)', '60', '60', 166),
(181, 'Veg', 'Peshwari Kulcha(F)', '65', '65', 167),
(182, 'Veg', 'Makai ki Roti(H)', '30', '30', 168),
(183, 'Veg', 'Makai ki Roti(F)', '35', '35', 169),
(184, 'Veg', 'Lachha Paratha(H)', '35', '35', 170),
(185, 'Veg', 'Lachha Paratha(H)', '40', '40', 171),
(186, 'Veg', 'Paratha', '40', '40', 172),
(187, 'Veg', 'Butter Paratha', '45', '45', 173),
(188, 'Veg', 'Naan', '30', '30', 174),
(189, 'Veg', 'Butter Naan', '35', '35', 175),
(190, 'Veg', 'Lasooni Naan', '45', '45', 176),
(191, 'Veg', 'Cheese Naan', '45', '45', 177),
(192, 'Veg', 'Kashmiri Naan(H)', '120', '120', 178),
(193, 'Veg', 'Kashmiri Naan(F)', '125', '125', 179),
(194, 'Veg', 'Roti Ki Tokri(Bread Basket)', '170', '170', 180),
(195, 'Veg', 'Kashmiri Pilao', '190', '190', 181),
(196, 'Veg', 'Basmati Chawal', '90', '90', 182),
(197, 'Veg', 'Jeera Chawal', '110', '110', 183),
(198, 'Veg', 'Curd Rice', '100', '100', 184),
(199, 'Veg', 'Subzi Tawa Pulao', '160', '160', 185),
(200, 'Veg', 'Subzi Tawa pulao(Ghee & Rice', '130', '130', 186),
(201, 'Veg', 'Dal kulchi', '140', '140', 187),
(202, 'Veg', 'Murgh ki Kacchi dum biryani', '200', '200', 188),
(203, 'Veg', 'Murgh Hyderabadi Biryani', '210', '210', 189),
(204, 'Veg', 'Mutton Dum biryani', '240', '240', 190),
(205, 'Veg', 'Prawns Dum Biryani', '280', '280', 191),
(206, 'Veg', 'Khushka Rice', '190', '190', 192),
(207, 'Veg', 'Boondi Cucumber Raita', '100', '100', 193),
(208, 'Veg', 'Fresh Vegetable Raita', '120', '120', 194),
(209, 'Veg', 'Pineapple Raita', '120', '120', 195),
(210, 'Veg', 'Green Salad', '70', '70', 196),
(211, 'Veg', 'English Healthy salad', '150', '150', 197),
(212, 'Veg', 'Kimchi Salad', '110', '110', 198),
(213, 'Veg', 'Chinese Salad', '110', '110', 199),
(214, 'Veg', 'Roasted papad', '20', '20', 200),
(215, 'Veg', 'Fried Papad', '30', '30', 201),
(216, 'Veg', 'Masala Papad', '50', '50', 202),
(217, 'Veg', 'Hot & Sour Soup(Mushroom)', '110', '110', 203),
(218, 'Veg', 'Ghee Rice', '130', '130', 204),
(219, 'Veg', 'Afgani Chicken', '170', '190', 205),
(220, 'Veg', 'Thumsup', '80', '90', 257),
(221, 'Veg', 'Jeera masala', '150', '170', 233),
(222, 'Veg', 'Tangaddi', '120', '200', 209);

-- --------------------------------------------------------

--
-- Table structure for table `kot`
--

CREATE TABLE `kot` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `itmnam` varchar(50) NOT NULL,
  `qty` double NOT NULL,
  `tabno` varchar(50) NOT NULL,
  `capname` varchar(50) NOT NULL,
  `kot_num` int(11) NOT NULL,
  `kot` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `cap_code` int(10) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kot_cancel`
--

CREATE TABLE `kot_cancel` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `itmno` varchar(10) NOT NULL,
  `itmnam` varchar(50) NOT NULL,
  `prc` double NOT NULL,
  `qty` double NOT NULL,
  `tot` double NOT NULL,
  `tabno` varchar(30) NOT NULL,
  `kot_num` int(10) NOT NULL,
  `captain` varchar(50) NOT NULL,
  `cap_code` int(10) NOT NULL,
  `kot_time` varchar(50) NOT NULL,
  `cancel_time` varchar(50) NOT NULL,
  `reson` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kot_history`
--

CREATE TABLE `kot_history` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `itmno` int(10) NOT NULL,
  `itmnam` varchar(50) NOT NULL,
  `qty` double NOT NULL,
  `tabno` varchar(30) NOT NULL,
  `capname` varchar(50) NOT NULL,
  `cap_code` int(10) NOT NULL,
  `kot_num` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `logid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user`, `pass`, `type`, `logid`) VALUES
(0, 'admin', 'pass', 'admin', 1),
(5, 'Javid', 'Javid', 'Manager', 9),
(6, 'Akshay', 'Akshay', 'Manager', 10),
(1, 'vivek123', 'vivek123', 'Captain', 11),
(2, 'sudeep', 'sudeep', 'Captain', 12),
(3, 'Naheed', 'Naheed', 'Captain', 13),
(4, 'Amit', 'Amit', 'Captain', 14);

-- --------------------------------------------------------

--
-- Table structure for table `parcel`
--

CREATE TABLE `parcel` (
  `slno` int(10) NOT NULL,
  `date` date NOT NULL,
  `itmno` int(10) NOT NULL,
  `itmnam` varchar(26) NOT NULL,
  `prc` double NOT NULL,
  `qty` double NOT NULL,
  `tot` double NOT NULL,
  `tabno` varchar(20) NOT NULL,
  `billno` int(10) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL,
  `capname` varchar(100) NOT NULL,
  `kot` int(10) NOT NULL,
  `kot_num` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parcel`
--

INSERT INTO `parcel` (`slno`, `date`, `itmno`, `itmnam`, `prc`, `qty`, `tot`, `tabno`, `billno`, `status`, `capname`, `kot`, `kot_num`) VALUES
(3, '2023-11-02', 1, 'Jeera Soda', 70, 3, 210, 'PARCEL_1', 0, '1', '', 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `parcelmaterial`
--

CREATE TABLE `parcelmaterial` (
  `id` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `stock` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parcelmaterial`
--

INSERT INTO `parcelmaterial` (`id`, `pid`, `stock`, `date`) VALUES
(1, 130, 2, '2023-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(10) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `sellunit` varchar(50) NOT NULL,
  `tax` double NOT NULL,
  `cess` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `category`, `unit`, `sellunit`, `tax`, `cess`) VALUES
(1, 'Chanaa dal', 'Grocery', 'Kg', 'Kg', 0, 0),
(2, 'Phutani', 'Grocery', 'Kg', 'Kg', 0, 0),
(3, 'Kabuli Chana', 'Grocery', 'Kg', 'Kg', 0, 0),
(4, 'Badishop', 'Grocery', 'Kg', 'Kg', 0, 0),
(5, 'Kishmish', 'Dryfruit', 'Kg', 'Kg', 0, 0),
(6, 'Badam', 'Dryfruit', 'Kg', 'Kg', 0, 0),
(7, 'Javitri', 'Masala', 'Kg', 'Kg', 0, 0),
(8, 'Dhaniya', 'Masala', 'Kg', 'Kg', 0, 0),
(9, 'Rawa', 'Grocery', 'Kg', 'Kg', 0, 0),
(10, 'Besan', 'Grocery', 'Kg', 'Kg', 0, 0),
(11, 'Lavang', 'Masala', 'Kg', 'Kg', 0, 0),
(12, 'Hari Ilaichi', 'Masala', 'Kg', 'Kg', 0, 0),
(13, 'Kali Ilaichi', 'Masala', 'Kg', 'Kg', 0, 0),
(14, 'Rai', 'Masala', 'Kg', 'Kg', 0, 0),
(15, 'Starful', 'Masala', 'Kg', 'Kg', 0, 0),
(16, 'Dalchini', 'Masala', 'Kg', 'Kg', 0, 0),
(17, 'Baking soda', 'Masala', 'Kg', 'Kg', 0, 0),
(18, 'Kalonji', 'Masala', 'Kg', 'Kg', 0, 0),
(19, 'Black paper corn', 'Masala', 'Kg', 'Kg', 0, 0),
(20, 'Jeera', 'Masala', 'Kg', 'Kg', 0, 0),
(21, 'Jaifal', 'Masala', 'Kg', 'Kg', 0, 0),
(22, 'Tej Patta', 'Masala', 'Kg', 'Kg', 0, 0),
(23, 'Kali Dal', 'Grocery', 'Kg', 'Kg', 0, 0),
(24, 'Rajma Chitra', 'Grocery', 'Kg', 'Kg', 0, 0),
(25, 'Amulya cream', 'Dailry ', 'Kg', 'Kg', 0, 0),
(26, 'pavbhaji masala', 'Masala', 'Packet', 'Packet', 0, 0),
(27, 'Garam masala', 'Masala', 'Packet', 'Packet', 0, 0),
(28, 'Kitchen king', 'Masala', 'Packet', 'Packet', 0, 0),
(29, 'Meat Masala', 'Masala', 'Packet', 'Packet', 0, 0),
(30, 'Chat masala', 'Masala', 'Packet', 'Packet', 0, 0),
(31, 'Redchilli Powder', 'Masala', 'Packet', 'Packet', 0, 0),
(32, 'Tooty Fruity', 'Dailry ', 'Packet', 'Packet', 0, 0),
(33, 'Black paper Powder', 'Masala', 'Packet', 'Packet', 0, 0),
(34, 'Laungi Mirchi powder', 'Masala', 'Packet', 'Packet', 0, 0),
(35, 'Piri piri Sprinkler', 'Masala', 'Packet', 'Packet', 0, 0),
(36, 'Gulab jamun', 'Grocery', 'Packet', 'Packet', 0, 0),
(37, 'Veg Meyoniaise', 'Dailry ', 'Packet', 'Packet', 0, 0),
(38, 'Amulya Dairy whitener', 'Dailry ', 'Packet', 'Packet', 0, 0),
(39, 'Kachhi ghani', 'Oil', 'Bottle', 'Bottle', 0, 0),
(40, 'Lemon yellow powder', 'Grocery', 'Packet', 'Packet', 0, 0),
(41, 'Apple green powder', 'Masala', 'Packet', 'Packet', 0, 0),
(42, 'Kesari Powder', 'Masala', 'Packet', 'Packet', 0, 0),
(43, 'Honey', 'Syrup', 'Bottle', 'Bottle', 0, 0),
(44, 'Tomato Ketchup', 'Syrup', 'Bottle', 'Bottle', 0, 0),
(45, 'Pineapple  Syrup', 'Syrup', 'Bottle', 'Bottle', 0, 0),
(46, 'Tomato Pure', 'Syrup', 'Bottle', 'Bottle', 0, 0),
(47, 'Fruit cocktail syrup', 'Syrup', 'Bottle', 'Bottle', 0, 0),
(48, 'Shev', 'Masala', 'Packet', 'Packet', 0, 0),
(49, 'Coconut Powder', 'Masala', 'Packet', 'Packet', 0, 0),
(50, 'Corn Flakes', 'Masala', 'Packet', 'Packet', 0, 0),
(51, 'Tea powder', 'Masala', 'Packet', 'Packet', 0, 0),
(52, 'Papad', 'Masala', 'Packet', 'Packet', 0, 0),
(53, 'Jeera powder', 'Masala', 'Packet', 'Packet', 0, 0),
(54, 'Dhaniya Powder', 'Masala', 'Packet', 'Packet', 0, 0),
(55, 'Chinese Pepper Masala', 'Masala', 'Packet', 'Packet', 0, 0),
(56, 'Salt', 'Masala', 'Packet', 'Packet', 0, 0),
(57, 'Black Salt powder', 'Masala', 'Packet', 'Packet', 0, 0),
(58, 'whole Baby Corn', 'Masala', 'Bottle', 'Bottle', 0, 0),
(59, 'Noodles', 'Chinese', 'Packet', 'Packet', 0, 0),
(60, 'Corn Flour', 'Masala', 'Packet', 'Packet', 0, 0),
(61, 'Musterd Leaves', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(62, 'Oyester SOS', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(63, 'Red Pepper SoS', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(64, 'Mustard Powder', 'Spices and Condiments', 'Packet', 'Packet', 0, 0),
(65, 'Rose Water', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(66, 'Kewra Water', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(67, 'Coconut Milk', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(68, 'Sweet Corn cream style', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(69, 'Green Chilli Sauce', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(70, 'Soya Sauce', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(71, 'Chilli Suace', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(72, 'Blue Curaco', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(73, 'Green Mojito', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(74, 'Vinegar', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(75, 'Oil', 'Spices and Condiments', 'Packet', 'Packet', 0, 0),
(76, 'Tomato ketch up packet', 'Spices and Condiments', 'Packet', 'Packet', 0, 0),
(77, 'Coconut Oil', 'Spices and Condiments', 'Bottle', 'Bottle', 0, 0),
(78, 'Pickle', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(79, 'Eggs', 'Spices and Condiments', 'Piece', 'Piece', 0, 0),
(80, 'ghee', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(81, 'bread', 'Spices and Condiments', 'Packet', 'Packet', 0, 0),
(82, 'Baby corn crispy', 'Spices and Condiments', 'Packet', 'Packet', 0, 0),
(83, 'Green Jugani', 'Spices and Condiments', 'Piece', 'Piece', 0, 0),
(84, 'Yellow jugani', 'Spices and Condiments', 'Piece', 'Piece', 0, 0),
(85, 'Red Cabbage', 'Spices and Condiments', 'Piece', 'Piece', 0, 0),
(86, 'lemon', 'Spices and Condiments', 'Piece', 'Piece', 0, 0),
(87, 'amulya cheese', 'Spices and Condiments', 'Packet', 'Packet', 0, 0),
(88, 'butter', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(89, 'Paneer', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(90, 'Garlic', 'Spices and Condiments', 'Packet', 'Packet', 0, 0),
(91, 'gobi', 'Spices and Condiments', 'Piece', 'Piece', 0, 0),
(92, 'Red Shimla', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(93, 'Yellow Shimla', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(94, 'Red Chilli Big', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(95, 'Red Chilli Small', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(96, 'Peanut', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(97, 'Kaju kani', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(98, 'Magaj', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(99, 'kaju', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(100, 'Biryani Rice', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(101, 'Toor daal', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(102, 'Pohe', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(103, 'Sugar', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(104, 'Staff Rice', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(105, 'Testing powder', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(106, 'Maida', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(107, 'Atta', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(108, 'Masoor Dala', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(109, 'Dobe Daal ', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(110, 'Moong Dal', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(111, 'Masoor Dala', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(112, 'Harbura', 'Spices and Condiments', 'Kg', 'Kg', 0, 0),
(113, 'Chicken', 'Chicken', 'Kg', 'Kg', 0, 0),
(114, 'Boiler', 'Meat and Seafood', 'Kg', 'Kg', 0, 0),
(115, 'Leg', 'Meat and Seafood', 'Kg', 'Kg', 0, 0),
(116, 'Prawns', 'Meat and Seafood', 'Kg', 'Kg', 0, 0),
(117, 'fish', 'Meat and Seafood', 'Kg', 'Kg', 0, 0),
(118, 'Tanddor chicken', 'Meat and Seafood', 'Kg', 'Kg', 0, 0),
(119, 'Sweet corn ', 'Sweet Corn', 'Packet', 'Packet', 0, 0),
(120, 'Green peace', 'Meat and Seafood', 'Packet', 'Packet', 0, 0),
(121, 'Finger chips', 'Meat and Seafood', 'Packet', 'Packet', 0, 0),
(122, 'Fish fingers ', 'Meat and Seafood', 'Packet', 'Packet', 0, 0),
(123, 'Jumbo Fish steax', 'Meat and Seafood', 'Packet', 'Packet', 0, 0),
(124, 'Indian Tandoor', 'Meat and Seafood', 'Kg', 'Kg', 0, 0),
(125, 'Bash Fish', 'Meat and Seafood', 'Kg', 'Kg', 0, 0),
(126, 'King Fish', 'Meat and Seafood', 'Kg', 'Kg', 0, 0),
(127, 'Black salt', 'Meat and Seafood', 'Packet', 'Packet', 0, 0),
(128, 'Wings', 'Chicken', 'KG', 'KG', 0, 0),
(129, 'Slice', 'Beverages And Desserts', 'Box', 'Bottle', 5, 5),
(130, 'Carrybag', 'Bag', 'Packet', 'Packet', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_data`
--

CREATE TABLE `purchase_data` (
  `id` int(10) NOT NULL,
  `vendor` varchar(30) NOT NULL,
  `purchase_date` date NOT NULL,
  `totalamt` double NOT NULL,
  `pamt` double NOT NULL,
  `remark` varchar(50) NOT NULL,
  `venId` int(10) NOT NULL,
  `bill` int(10) NOT NULL,
  `gamt` double NOT NULL,
  `tax` double NOT NULL,
  `paymentMode` varchar(50) NOT NULL,
  `disc` double NOT NULL,
  `cessamount` double NOT NULL,
  `otheramt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_data`
--

INSERT INTO `purchase_data` (`id`, `vendor`, `purchase_date`, `totalamt`, `pamt`, `remark`, `venId`, `bill`, `gamt`, `tax`, `paymentMode`, `disc`, `cessamount`, `otheramt`) VALUES
(1, 'S A Frozen Food', '2023-11-28', 3000, 0, '', 6, 50, 3000, 0, 'Cash', 0, 0, 0),
(2, 'S A Frozen Food', '2023-11-28', 1410, 0, '', 6, 50, 1410, 0, 'Cash', 0, 0, 0),
(3, 'Daksh Enterprises', '2023-12-02', 300, 300, 'pass', 9, 20, 200, 10, 'Cash', 0, 10, 80),
(4, 'Daksh Enterprises', '2023-12-02', 100, 0, '', 9, 52, 100, 0, 'Other', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(10) NOT NULL,
  `qty` double NOT NULL,
  `venid` int(10) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  `bamt` double NOT NULL,
  `tax` double NOT NULL,
  `disc` double NOT NULL,
  `cess` double NOT NULL,
  `perCaseQty` double DEFAULT NULL,
  `pid` int(10) NOT NULL,
  `exp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `qty`, `venid`, `price`, `total`, `bamt`, `tax`, `disc`, `cess`, `perCaseQty`, `pid`, `exp`) VALUES
(1, 10, 1, 300, 3000, 3000, 0, 0, 0, 1, 128, '2025-12-31'),
(2, 10, 2, 100, 1000, 1000, 0, 0, 0, 1, 1, '2023-11-25'),
(3, 2, 2, 80, 160, 160, 0, 0, 0, 1, 2, '2023-12-03'),
(4, 5, 2, 50, 250, 250, 0, 0, 0, 1, 9, '2023-12-02'),
(5, 10, 3, 20, 220, 200, 10, 0, 10, 5, 129, '2023-12-31'),
(6, 10, 4, 10, 100, 100, 0, 0, 0, 1, 130, '2026-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `store_kitchen`
--

CREATE TABLE `store_kitchen` (
  `id` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `stock` double NOT NULL,
  `issued` double NOT NULL,
  `stockreturn` double NOT NULL,
  `perCaseQty` double NOT NULL,
  `date` varchar(10) NOT NULL,
  `stock_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store_kitchen`
--

INSERT INTO `store_kitchen` (`id`, `pid`, `stock`, `issued`, `stockreturn`, `perCaseQty`, `date`, `stock_id`) VALUES
(1, 128, 5, 0, 0, 0, '2023-11-28', 0),
(2, 128, 0, 1, 0, 0, '2023-11-28', 0),
(3, 128, 0, 1, 0, 0, '2023-11-28', 0),
(4, 128, 0, 1, 0, 0, '2023-11-28', 0),
(5, 128, 0, 0, 1, 0, '2023-11-28', 0),
(6, 128, 5, 0, 0, 0, '2023-11-29', 0),
(7, 128, 0, 1.5, 0, 0, '2023-12-02', 0),
(8, 128, 0, 1.1, 0, 0, '2023-12-02', 0),
(9, 128, 0, 2.1, 0, 0, '2023-12-02', 0),
(10, 128, 0, 0.1, 0, 0, '2023-12-02', 0),
(11, 128, 0, 0.1, 0, 0, '2023-12-02', 0),
(12, 128, 0, 0.1, 0, 0, '2023-12-02', 0),
(13, 128, 0, 0.1, 0, 0, '2023-12-02', 0),
(14, 128, 0, 0.1, 0, 0, '2023-12-02', 0),
(15, 128, 0, 0.1, 0, 0, '2023-12-02', 0),
(16, 128, 0, 0.1, 0, 0, '2023-12-02', 0),
(17, 128, 0, 0.1, 0, 0, '2023-12-02', 0),
(18, 128, 0, 0.1, 0, 0, '2023-12-02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `store_stock`
--

CREATE TABLE `store_stock` (
  `id` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `stock` double NOT NULL,
  `issuedStock` double NOT NULL,
  `stockReturn` double NOT NULL,
  `wastageStock` double NOT NULL,
  `stock_id` int(10) NOT NULL,
  `perCaseQty` double NOT NULL,
  `date` varchar(30) NOT NULL,
  `exp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store_stock`
--

INSERT INTO `store_stock` (`id`, `pid`, `stock`, `issuedStock`, `stockReturn`, `wastageStock`, `stock_id`, `perCaseQty`, `date`, `exp`) VALUES
(1, 1, 0.31, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(2, 2, 0.5, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(3, 3, 0.52, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(4, 4, 0.54, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(5, 5, 2.45, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(6, 6, 3.53, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(7, 7, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(8, 8, 0.8, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(9, 9, 2, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(10, 10, 1.24, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(11, 11, 0.47, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(12, 12, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(13, 13, 0.58, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(14, 14, 0.9, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(15, 15, 0.35, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(16, 16, 0.59, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(17, 17, 0.17, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(18, 18, 0.79, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(19, 19, 0.83, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(20, 20, 1, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(21, 21, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(22, 22, 0.25, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(23, 23, 2030, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(24, 24, 0.66, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(25, 25, 4, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(26, 26, 4, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(27, 27, 8, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(28, 28, 5, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(29, 29, 7, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(30, 30, 4, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(31, 31, 11, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(32, 32, 3, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(33, 33, 1, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(34, 34, 1, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(35, 35, 3, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(36, 36, 2, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(37, 37, 1, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(38, 38, 5, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(39, 39, 5, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(40, 40, 6, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(41, 41, 1, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(42, 42, 1, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(43, 43, 1, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(44, 44, 3, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(45, 45, 6, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(46, 46, 4, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(47, 47, 5, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(48, 48, 9, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(49, 49, 1, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(50, 50, 5, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(51, 51, 8, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(52, 52, 44, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(53, 53, 6, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(54, 54, 3, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(55, 55, 2, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(56, 56, 32, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(57, 57, 3, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(58, 58, 22, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(59, 59, 12, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(60, 60, 45, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(61, 61, 7, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(62, 62, 5, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(63, 63, 2, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(64, 64, 3, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(65, 65, 5, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(66, 66, 3, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(67, 67, 9, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(68, 68, 5, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(69, 69, 2, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(70, 70, 21, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(71, 71, 7, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(72, 72, 14, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(73, 73, 12, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(74, 74, 7, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(75, 75, 140, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(76, 76, 5, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(77, 77, 2, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(78, 78, 5, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(79, 79, 150, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(80, 80, 3, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(81, 81, 4, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(82, 82, 3, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(83, 83, 2, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(84, 84, 2, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(85, 85, 2, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(86, 86, 130, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(87, 87, 6, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(88, 88, 10, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(89, 89, 7, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(90, 90, 5, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(91, 91, 2, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(92, 92, 2.09, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(93, 93, 1.72, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(94, 94, 2.63, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(95, 95, 5.33, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(96, 96, 4.91, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(97, 97, 21.47, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(98, 98, 4, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(99, 99, 27.78, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(100, 100, 12.19, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(101, 101, 11.64, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(102, 102, 11.92, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(103, 103, 69.28, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(104, 104, 14.89, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(105, 105, 2.94, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(106, 106, 23.28, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(107, 107, 19.44, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(108, 108, 0.98, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(109, 109, 1.49, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(110, 110, 1.11, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(111, 111, 0.46, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(112, 112, 2.01, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(113, 113, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(114, 114, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(115, 115, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(116, 116, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(117, 117, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(118, 118, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(119, 119, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(120, 120, 6, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(121, 121, 3, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(122, 122, 4, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(123, 123, 1.5, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(124, 124, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(125, 125, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(126, 126, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(127, 127, 0, 0, 0, 0, 0, 1, '2023-11-23', '2024-01-01'),
(128, 128, 0, 0, 0, 0, 0, 1, '2023-11-28', ''),
(129, 128, 10, 0, 0, 0, 0, 1, '2023-11-28', '2025-12-31'),
(130, 1, 10, 0, 0, 0, 0, 1, '2023-11-28', '2023-11-25'),
(131, 2, 2, 0, 0, 0, 0, 1, '2023-11-28', '2023-12-03'),
(132, 9, 5, 0, 0, 0, 0, 1, '2023-11-28', '2023-12-02'),
(133, 128, 0, 5, 0, 0, 0, 0, '2023-11-28', ''),
(134, 128, 0, 0, 1, 0, 0, 0, '2023-11-28', ''),
(135, 1, 0, 0, 0, 5, 0, 0, '2023-11-28', ''),
(136, 128, 0, 0, 0, 1, 0, 0, '2023-11-28', ''),
(137, 128, 0, 5, 0, 0, 0, 0, '2023-11-29', ''),
(138, 1, 0, 0, 0, 1.31, 0, 0, '2023-12-02', ''),
(139, 129, 0, 0, 0, 0, 0, 1, '2023-12-02', ''),
(140, 129, 50, 0, 0, 0, 0, 0, '2023-12-02', '2023-12-31'),
(141, 129, 0, 10, 0, 0, 0, 0, '2023-12-02', ''),
(142, 130, 0, 0, 0, 0, 0, 1, '2023-12-02', ''),
(143, 130, 10, 0, 0, 0, 0, 0, '2023-12-02', '2026-06-10'),
(144, 130, 0, 2, 0, 0, 0, 0, '2023-12-02', ''),
(145, 129, 0, 10, 0, 0, 0, 0, '2023-12-02', '');

-- --------------------------------------------------------

--
-- Table structure for table `tabledata`
--

CREATE TABLE `tabledata` (
  `slno` int(11) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `itmno` int(10) NOT NULL,
  `itmnam` varchar(26) NOT NULL,
  `prc` double NOT NULL,
  `qty` double NOT NULL,
  `tot` double NOT NULL,
  `tabno` varchar(30) NOT NULL,
  `billno` int(10) UNSIGNED NOT NULL,
  `time` varchar(50) NOT NULL,
  `kot_num` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabledata`
--

INSERT INTO `tabledata` (`slno`, `date`, `itmno`, `itmnam`, `prc`, `qty`, `tot`, `tabno`, `billno`, `time`, `kot_num`, `status`) VALUES
(1, '2023-11-16', 3, 'Chaas', 120, 2, 240, 'G-1', 1, '04:50 PM', 0, ''),
(2, '2023-11-16', 5, 'Fresh Lime Soda', 60, 55, 3300, 'G-1', 1, '04:50 PM', 0, ''),
(4, '2023-11-16', 2, 'Lassi ', 120, 2, 240, 'G-2', 2, '04:51 PM', 1, ''),
(5, '2023-11-16', 3, 'Chaas', 120, 33, 3960, 'G-2', 2, '04:51 PM', 1, ''),
(6, '2023-11-16', 78, 'Chilli Garlic Mashroom Fri', 170, 2, 340, 'G-2', 2, '04:51 PM', 1, ''),
(7, '2023-11-16', 3, 'Chaas', 120, 10, 1200, 'G-1', 3, '05:30 PM', 1, ''),
(8, '2023-11-16', 10, 'Green Lime Mojito (Soda)', 80, 3, 240, 'G-1', 3, '05:30 PM', 1, ''),
(9, '2023-11-16', 36, 'Crispy Fried babycorn', 160, 3, 480, 'G-1', 3, '05:30 PM', 1, ''),
(10, '2023-11-16', 45, 'Sliced Prawns sauce', 120, 2, 240, 'G-1', 3, '05:30 PM', 1, ''),
(14, '2023-11-16', 5, 'Fresh Lime Soda', 60, 12, 720, 'G-5', 4, '05:32 PM', 0, ''),
(15, '2023-11-16', 25, 'Cream Of Tomato', 90, 3, 270, 'G-5', 4, '05:32 PM', 0, ''),
(16, '2023-11-16', 78, 'Chilli Garlic Mashroom Fri', 170, 3, 510, 'G-5', 4, '05:32 PM', 0, ''),
(17, '2023-11-18', 5, 'Fresh Lime Soda', 60, 11, 660, 'G-1', 1, '07:12 PM', 1, ''),
(18, '2023-11-18', 6, 'Aerated Drinks', 30, 6, 180, 'G-1', 1, '07:12 PM', 1, ''),
(19, '2023-11-18', 12, 'Blue Curacao(soda)', 80, 3, 240, 'G-1', 1, '07:12 PM', 1, ''),
(20, '2023-11-18', 78, 'Chilli Garlic Mashroom Fri', 170, 3, 510, 'G-1', 1, '07:12 PM', 1, ''),
(24, '2023-11-18', 4, 'Fresh Lime Water', 50, 6, 300, 'G-3', 2, '07:12 PM', 0, ''),
(25, '2023-11-18', 6, 'Aerated Drinks', 30, 5, 150, 'G-3', 2, '07:12 PM', 0, ''),
(26, '2023-11-18', 8, 'Bottel Of Soda', 20, 3, 60, 'G-3', 2, '07:12 PM', 0, ''),
(27, '2023-11-28', 1, 'Jeera Soda', 70, 3, 210, 'G-1', 3, '10:41 PM', 1, ''),
(28, '2023-11-28', 2, 'Lassi ', 120, 3, 360, 'G-1', 3, '10:41 PM', 1, ''),
(29, '2023-11-28', 5, 'Fresh Lime Soda', 60, 14, 840, 'G-1', 3, '10:41 PM', 1, ''),
(30, '2023-11-28', 12, 'Blue Curacao(soda)', 80, 3, 240, 'G-1', 3, '10:41 PM', 1, ''),
(34, '2023-11-28', 2, 'Lassi ', 120, 3, 360, 'G-5', 4, '10:42 PM', 2, ''),
(35, '2023-11-28', 5, 'Fresh Lime Soda', 60, 5, 300, 'G-5', 4, '10:41 PM', 2, ''),
(36, '2023-11-28', 6, 'Aerated Drinks', 30, 1, 30, 'G-5', 4, '10:41 PM', 2, ''),
(37, '2023-11-28', 12, 'Blue Curacao(soda)', 80, 3, 240, 'G-5', 4, '10:42 PM', 2, ''),
(41, '2023-11-28', 5, 'Fresh Lime Soda', 60, 6, 360, 'G-3', 8, '10:42 PM', 0, ''),
(44, '2023-11-28', 3, 'Chaas', 120, 3, 360, 'G-10', 7, '10:42 PM', 0, ''),
(45, '2023-11-28', 5, 'Fresh Lime Soda', 60, 6, 360, 'G-10', 7, '10:42 PM', 0, ''),
(47, '2023-11-28', 3, 'Chaas', 120, 3, 360, 'G-1', 6, '10:42 PM', 0, ''),
(48, '2023-11-28', 5, 'Fresh Lime Soda', 60, 4, 240, 'G-1', 6, '10:42 PM', 0, ''),
(49, '2023-11-28', 6, 'Aerated Drinks', 30, 6, 180, 'G-1', 6, '10:42 PM', 0, ''),
(50, '2023-11-28', 78, 'Chilli Garlic Mashroom Fri', 170, 3, 510, 'G-1', 6, '10:42 PM', 0, ''),
(54, '2023-11-28', 3, 'Chaas', 120, 5, 600, 'G-4', 5, '10:42 PM', 0, ''),
(55, '2023-11-28', 4, 'Fresh Lime Water', 50, 5, 250, 'G-4', 5, '10:42 PM', 0, ''),
(56, '2023-11-28', 12, 'Blue Curacao(soda)', 80, 6, 480, 'G-4', 5, '10:42 PM', 0, ''),
(57, '2023-11-28', 45, 'Sliced Prawns sauce', 120, 6, 720, 'G-4', 5, '10:42 PM', 0, ''),
(61, '2023-11-28', 3, 'Chaas', 120, 5, 600, 'T-8', 9, '10:43 PM', 0, ''),
(62, '2023-11-30', 3, 'Chaas', 120, 10, 1200, 'G-1', 10, '11:52 AM', 0, ''),
(63, '2023-11-30', 5, 'Fresh Lime Soda', 60, 5, 300, 'G-1', 10, '11:52 AM', 0, ''),
(65, '2023-11-30', 3, 'Chaas', 120, 10, 1200, 'G-1', 11, '01:22 PM', 1, ''),
(67, '2023-12-01', 5, 'Fresh Lime Soda', 60, 0, 0, 'G-1', 12, '05:00 PM', 1, ''),
(68, '2023-12-01', 20, 'Oye Shawa Special (Chef Ch', 130, 3, 390, 'G-1', 12, '05:00 PM', 3, ''),
(69, '2023-12-01', 45, 'Sliced Prawns sauce', 120, 6, 720, 'G-1', 12, '05:00 PM', 3, ''),
(70, '2023-12-01', 78, 'Chilli Garlic Mashroom Fri', 170, 6, 1020, 'G-1', 12, '05:00 PM', 3, ''),
(73, '2023-12-01', 6, 'Aerated Drinks', 30, 6, 180, 'G-2', 13, '05:03 PM', 0, ''),
(75, '2023-12-01', 12, 'Blue Curacao(soda)', 80, 3, 240, 'G-2', 13, '05:03 PM', 0, ''),
(76, '2023-12-01', 45, 'Sliced Prawns sauce', 120, 12, 1440, 'G-2', 13, '05:03 PM', 0, ''),
(77, '2023-12-01', 78, 'Chilli Garlic Mashroom Fri', 170, 6, 1020, 'G-2', 13, '05:03 PM', 0, ''),
(78, '2023-12-01', 96, 'Panner Tiranga Tikka', 195, 6, 1170, 'G-2', 13, '05:03 PM', 0, ''),
(81, '2023-12-01', 12, 'Blue Curacao(soda)', 80, 56, 4480, 'G-3', 14, '05:05 PM', 0, ''),
(82, '2023-12-01', 54, 'Singapore Noodles(F)', 170, 6, 1020, 'G-3', 14, '05:05 PM', 0, ''),
(83, '2023-12-01', 78, 'Chilli Garlic Mashroom Fri', 170, 6, 1020, 'G-3', 14, '05:05 PM', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tabletot`
--

CREATE TABLE `tabletot` (
  `slno` int(10) NOT NULL,
  `gndtot` double NOT NULL,
  `gst` double NOT NULL,
  `gstamt` double NOT NULL,
  `nettot` double NOT NULL,
  `date` date NOT NULL,
  `paymentmode` varchar(50) NOT NULL,
  `capnam` varchar(40) NOT NULL,
  `cap_code` double NOT NULL,
  `discount` double NOT NULL,
  `mobno` varchar(15) NOT NULL,
  `time` varchar(20) NOT NULL,
  `cahsh_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `disamt` double NOT NULL,
  `orde` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temtable`
--

CREATE TABLE `temtable` (
  `slno` int(10) NOT NULL,
  `date` date NOT NULL,
  `itmno` int(10) NOT NULL,
  `itmnam` varchar(26) NOT NULL,
  `prc` double NOT NULL,
  `qty` double NOT NULL,
  `tot` double NOT NULL,
  `tabno` varchar(20) NOT NULL,
  `capname` varchar(50) NOT NULL,
  `billno` int(10) UNSIGNED NOT NULL,
  `status` int(10) NOT NULL,
  `kot` int(10) NOT NULL,
  `kot_num` int(10) NOT NULL,
  `cap_code` int(10) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temtable`
--

INSERT INTO `temtable` (`slno`, `date`, `itmno`, `itmnam`, `prc`, `qty`, `tot`, `tabno`, `capname`, `billno`, `status`, `kot`, `kot_num`, `cap_code`, `time`) VALUES
(61, '2023-12-01', 5, 'Fresh Lime Soda', 60, 65, 3900, 'G-1', 'Vivek Joshi', 15, 1, 0, 0, 1, '05:23 PM'),
(62, '2023-12-01', 123, 'Paneer Khurchan', 175, 3, 525, 'G-1', 'Vivek Joshi', 15, 1, 0, 0, 1, '05:23 PM');

-- --------------------------------------------------------

--
-- Table structure for table `trash`
--

CREATE TABLE `trash` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `itemname` varchar(100) NOT NULL,
  `itmno` double NOT NULL,
  `prc` double NOT NULL,
  `qty` double NOT NULL,
  `tot` double NOT NULL,
  `tabno` varchar(50) NOT NULL,
  `capname` varchar(100) NOT NULL,
  `kot_num` double NOT NULL,
  `capcode` double NOT NULL,
  `time` varchar(50) NOT NULL,
  `uid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trash`
--

INSERT INTO `trash` (`id`, `date`, `itemname`, `itmno`, `prc`, `qty`, `tot`, `tabno`, `capname`, `kot_num`, `capcode`, `time`, `uid`) VALUES
(1, '2023-11-09', 'Fresh Lime Soda', 5, 60, 75, 4500, 'G-1', 'Vivek Joshi', 1, 1, '01:08 PM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trash_bill`
--

CREATE TABLE `trash_bill` (
  `id` int(10) NOT NULL,
  `date` varchar(10) NOT NULL,
  `itmno` int(10) NOT NULL,
  `itemnam` varchar(100) NOT NULL,
  `prc` double NOT NULL,
  `qty` double NOT NULL,
  `tot` double NOT NULL,
  `tabno` varchar(20) NOT NULL,
  `billno` int(11) NOT NULL,
  `time` varchar(20) NOT NULL,
  `kot_num` int(10) NOT NULL,
  `trashDate` varchar(10) NOT NULL,
  `trashTime` varchar(10) NOT NULL,
  `uid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trash_bill`
--

INSERT INTO `trash_bill` (`id`, `date`, `itmno`, `itemnam`, `prc`, `qty`, `tot`, `tabno`, `billno`, `time`, `kot_num`, `trashDate`, `trashTime`, `uid`) VALUES
(1, '2023-12-01', 3, 'Chaas', 120, 3, 360, 'G-1', 12, '05:00 PM', 1, '2023-12-01', '12:31:44 P', 0),
(2, '2023-12-01', 8, 'Bottel Of Soda', 20, 3, 60, 'G-2', 13, '05:03 PM', 0, '2023-12-01', '12:34:20 P', 0),
(3, '2023-12-01', 6, 'Aerated Drinks', 30, 6, 180, 'G-3', 14, '05:05 PM', 0, '2023-12-01', '12:36:42 P', 0);

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
(4, 'STW'),
(7, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `slno` int(10) NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `gst` varchar(30) NOT NULL,
  `fssi` varchar(30) NOT NULL,
  `adds` varchar(50) NOT NULL,
  `totalamt` double NOT NULL,
  `paid` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`slno`, `vendor`, `mobile`, `gst`, `fssi`, `adds`, `totalamt`, `paid`) VALUES
(1, 'Blue Star Chicken', '9448157348', '', '', 'Yamanapur Belgaum', 0, 0),
(2, 'Shree Banashankari Traders', '8867287164', '', '', 'Hanuman nagar, Belgaum', 0, 0),
(3, 'Sagar Vegetable Company', '9972492411', '', '', 'Somnath Nagr, Belgaum', 0, 0),
(4, 'Shri Krishna Traders', '9480830980', '29AEAFS8239K1ZG', '', 'Bauxite road, Belgaum', 0, 0),
(5, 'S A POWAR', '9448148566', '', '', 'Market Yard Belgaum', 0, 0),
(6, 'S A Frozen Food', '9739759180', '', '', 'Sangmeshwar Nagar,Main road Belgaum', 4410, 0),
(7, 'Vishal Mutton  Chicken Shop', '9945794166', '', '', 'Mujawar galli, Belgaum', 0, 0),
(8, 'Deepak Patil Enterprises', '7895875895', '', '', 'Bauxite road Belgaum', 0, 0),
(9, 'Daksh Enterprises', '9900042240', '', '', 'Ramtirth Nagar Belgaum', 400, 300),
(10, 'Jain Food Hub', '1111111111', '', '', 'Kalmath Road', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_payment`
--

CREATE TABLE `vendor_payment` (
  `id` int(10) NOT NULL,
  `vendor` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `amt` double NOT NULL,
  `paid` double NOT NULL,
  `remain` double NOT NULL,
  `pending` double NOT NULL,
  `disc` double NOT NULL,
  `settle` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_payment`
--

INSERT INTO `vendor_payment` (`id`, `vendor`, `date`, `amt`, `paid`, `remain`, `pending`, `disc`, `settle`) VALUES
(1, 'S A Frozen Food', '2023-11-28', 3000, 0, 3000, 3000, 0, 0),
(2, 'S A Frozen Food', '2023-11-28', 1410, 0, 1410, 4410, 0, 0),
(3, 'Daksh Enterprises', '2023-12-02', 300, 300, 0, 0, 0, 0),
(4, 'Daksh Enterprises', '2023-12-02', 100, 0, 100, 100, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wastage`
--

CREATE TABLE `wastage` (
  `id` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `qty` double NOT NULL,
  `date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wastage`
--

INSERT INTO `wastage` (`id`, `pid`, `qty`, `date`) VALUES
(1, 1, 5, '2023-11-28'),
(2, 128, 1, '2023-11-28'),
(3, 1, 1.31, '2023-12-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtable`
--
ALTER TABLE `addtable`
  ADD PRIMARY KEY (`table_ID`);

--
-- Indexes for table `assetsdamage`
--
ALTER TABLE `assetsdamage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assetsproduct`
--
ALTER TABLE `assetsproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assetspurchase`
--
ALTER TABLE `assetspurchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assetspurchasedata`
--
ALTER TABLE `assetspurchasedata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assetsstock`
--
ALTER TABLE `assetsstock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beverages`
--
ALTER TABLE `beverages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoroy`
--
ALTER TABLE `categoroy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empreg`
--
ALTER TABLE `empreg`
  ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`slno`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`slno`);

--
-- Indexes for table `kot`
--
ALTER TABLE `kot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kot_cancel`
--
ALTER TABLE `kot_cancel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kot_history`
--
ALTER TABLE `kot_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `parcel`
--
ALTER TABLE `parcel`
  ADD PRIMARY KEY (`slno`);

--
-- Indexes for table `parcelmaterial`
--
ALTER TABLE `parcelmaterial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `purchase_data`
--
ALTER TABLE `purchase_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_kitchen`
--
ALTER TABLE `store_kitchen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_stock`
--
ALTER TABLE `store_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabledata`
--
ALTER TABLE `tabledata`
  ADD PRIMARY KEY (`slno`);

--
-- Indexes for table `tabletot`
--
ALTER TABLE `tabletot`
  ADD PRIMARY KEY (`slno`);

--
-- Indexes for table `temtable`
--
ALTER TABLE `temtable`
  ADD PRIMARY KEY (`slno`);

--
-- Indexes for table `trash`
--
ALTER TABLE `trash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trash_bill`
--
ALTER TABLE `trash_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlist`
--
ALTER TABLE `userlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`slno`);

--
-- Indexes for table `vendor_payment`
--
ALTER TABLE `vendor_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wastage`
--
ALTER TABLE `wastage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addtable`
--
ALTER TABLE `addtable`
  MODIFY `table_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `assetsdamage`
--
ALTER TABLE `assetsdamage`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assetsproduct`
--
ALTER TABLE `assetsproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assetspurchase`
--
ALTER TABLE `assetspurchase`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assetspurchasedata`
--
ALTER TABLE `assetspurchasedata`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assetsstock`
--
ALTER TABLE `assetsstock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beverages`
--
ALTER TABLE `beverages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categoroy`
--
ALTER TABLE `categoroy`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `empreg`
--
ALTER TABLE `empreg`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `slno` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `kot`
--
ALTER TABLE `kot`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `kot_cancel`
--
ALTER TABLE `kot_cancel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kot_history`
--
ALTER TABLE `kot_history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `logid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `parcel`
--
ALTER TABLE `parcel`
  MODIFY `slno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parcelmaterial`
--
ALTER TABLE `parcelmaterial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `purchase_data`
--
ALTER TABLE `purchase_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `store_kitchen`
--
ALTER TABLE `store_kitchen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `store_stock`
--
ALTER TABLE `store_stock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `tabledata`
--
ALTER TABLE `tabledata`
  MODIFY `slno` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tabletot`
--
ALTER TABLE `tabletot`
  MODIFY `slno` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temtable`
--
ALTER TABLE `temtable`
  MODIFY `slno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `trash`
--
ALTER TABLE `trash`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trash_bill`
--
ALTER TABLE `trash_bill`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userlist`
--
ALTER TABLE `userlist`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `slno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vendor_payment`
--
ALTER TABLE `vendor_payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wastage`
--
ALTER TABLE `wastage`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
