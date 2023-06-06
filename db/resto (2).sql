-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 09:19 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto`
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
(1, '1', 'Non Ac'),
(2, '2', 'Non Ac'),
(3, '3', 'Non Ac'),
(4, '4', 'Non Ac'),
(5, '5', 'Non Ac'),
(6, '6', 'Non Ac'),
(7, '7', 'Non Ac'),
(8, '8', 'Non Ac'),
(9, '9', 'Non Ac'),
(10, '10', 'Non Ac'),
(11, '11', 'Non Ac'),
(12, '12', 'Non Ac'),
(13, '14', 'Non Ac'),
(14, '15', 'Non Ac'),
(15, '16', 'Non Ac'),
(16, '17', 'Non Ac'),
(17, '18', 'Non Ac'),
(18, '19', 'Non Ac'),
(19, '20', 'Non Ac'),
(20, '21', 'Ac'),
(21, '22', 'Ac'),
(22, '23', 'Ac'),
(23, '24', 'Ac'),
(24, '25', 'Ac'),
(25, '26', 'Ac'),
(26, '27', 'Ac'),
(27, '29', 'Ac'),
(28, '30', 'Ac'),
(29, '31', 'Non-Chargeable'),
(30, '32', 'Non-Chargeable'),
(31, '33', 'Non-Chargeable'),
(32, '34', 'Non-Chargeable'),
(33, '35', 'Non-Chargeable'),
(34, '36', 'Non-Chargeable'),
(35, '37', 'Non-Chargeable'),
(36, '37', 'Non-Chargeable'),
(37, '38', 'Non-Chargeable'),
(38, '39', 'Non-Chargeable'),
(39, '40', 'Non-Chargeable');

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
(1, 'ARUNKUMAR', '', '9686926555', '', '', '', 'Captain', '', '', 1),
(2, 'NAGARAJ', '', '9999999999', '', '', '', 'Cashier', 'manager', 'MANAGER', 2),
(3, 'NAGARAJ', '', '', '', '', '', 'Cashier', 'NAGARAJ', 'NAGARAJ', 3),
(4, 'SHYAM', '', '', '', '', '', 'STW', '', '', 4),
(5, 'VEERESH', '', '', '', '', '', 'STW', '', '', 5),
(6, 'VEERESH NEW', '', '', '', '', '', 'STW', '', '', 6),
(7, 'BASAVARAJ', '', '', '', '', '', 'STW', '', '', 7),
(8, 'NAYANA', '', '', '', '', '', 'STW', '', '', 8);

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
(1, 'Veg', 'GREEN SALAD', '80', '90', 1),
(2, 'Veg', 'CUCUMBER SALAD', '80', '90', 2),
(3, 'Veg', 'TOSSED SALAD', '100', '110', 3),
(4, 'Veg', 'MEXICAN SALAD', '120', '130', 4),
(5, 'Veg', 'RUSSIAN SALAD', '120', '130', 5),
(6, 'Veg', 'TANDOORI SALAD', '80', '90', 6),
(7, 'Veg', 'DRY PAPAD', '25', '35', 7),
(8, 'Veg', 'MASALA PAPAD', '60', '70', 8),
(9, 'Veg', 'FINGER CHIPS', '100', '110', 9),
(10, 'Veg', 'PANEER PAKODA', '200', '220', 10),
(11, 'Veg', 'CHEESE PAKODA', '240', '250', 11),
(12, 'Veg', 'ASSORTED PAKODA', '110', '120', 12),
(13, 'Veg', 'VEG HARA BARA KABAB', '180', '190', 13),
(14, 'Veg', 'ALOO CORN TIKKI', '120', '130', 14),
(15, 'Veg', 'CAPSICUM PAKODA', '100', '110', 15),
(16, 'Veg', 'T ROTI', '30', '35', 16),
(17, 'Veg', 'T BUTTER ROTI', '40', '45', 17),
(18, 'Veg', 'T KULCHA', '40', '45', 18),
(19, 'Veg', 'T BUTTER KULCHA', '50', '55', 19),
(20, 'Veg', 'MASALA KULCHA', '40', '50', 20),
(21, 'Veg', 'BUTTER NAAN', '60', '65', 21),
(22, 'Veg', 'CHEESE GARLIC NAAN', '90', '95', 22),
(23, 'Veg', 'CHEESE GARLIC BUTTER NAAN', '95', '100', 23),
(24, 'Veg', 'PLAIN NAAN', '50', '55', 24),
(25, 'Veg', 'ALOO PARATHA', '70', '75', 25),
(26, 'Veg', 'MIX PARATHA', '75', '80', 26),
(27, 'Veg', 'PANEER PARATHA', '90', '100', 27),
(28, 'Veg', 'CHEESE PARATHA', '100', '110', 28),
(29, 'Veg', 'STEAMED RICE', '80', '90', 29),
(30, 'Veg', 'JEERA RICE', '140', '150', 30),
(31, 'Veg', 'GHEE RICE', '160', '170', 31),
(32, 'Veg', 'VEG PULAO', '140', '150', 32),
(33, 'Veg', 'GREEN PEAS PULAO', '120', '130', 33),
(34, 'Veg', 'VEG BIRIYANI', '160', '170', 34),
(35, 'Veg', 'VEG HYD BIRIYANI', '180', '190', 35),
(36, 'Veg', 'MASALA RICE', '120', '130', 36),
(37, 'Veg', 'PALAK RICE', '150', '160', 37),
(38, 'Veg', 'CURD RICE', '120', '130', 38),
(39, 'Veg', 'PLAIN RICE', '70', '80', 39),
(40, 'Veg', 'VEG FRIED RICE', '150', '170', 40),
(41, 'Veg', 'CORN FRIED RICE', '160', '180', 41),
(42, 'Veg', 'ONION CHILLY FRIED RICE', '160', '180', 42),
(43, 'Veg', 'GINGER RICE', '180', '200', 43),
(44, 'Veg', 'PANEER FRIED RICE', '180', '200', 44),
(45, 'Veg', 'SCZ FRIED RICE', '160', '180', 45),
(46, 'Veg', 'BURNT GARLIC FRIED RICE', '120', '140', 46),
(47, 'Veg', 'SINGAPURI FRIED RICE', '150', '170', 47),
(48, 'Veg', 'HONGKONG FRIED RICE', '180', '200', 48),
(49, 'Veg', 'AMERICAN CHOPSEY', '150', '170', 49),
(50, 'Veg', 'VEG HAKKA NOODLES', '160', '180', 50),
(51, 'Veg', 'VEG SCZ NOODLES', '130', '150', 51),
(52, 'Veg', 'VEG TRP SCZ NDLS', '140', '160', 52),
(53, 'Veg', 'PANEER TIKKA', '200', '220', 53),
(54, 'Veg', 'HARIYALI PANEER TIKKA', '200', '220', 54),
(55, 'Veg', 'AACHARI PANEER TIKKA', '200', '220', 55),
(56, 'Veg', 'KALIMIRCH PANEER TIKKA', '200', '220', 56),
(57, 'Veg', 'METHI PANEER TIKKA', '200', '220', 57),
(58, 'Veg', 'TANDOORI BABYCORN', '120', '140', 58),
(59, 'Veg', 'TANDOORI MUSHROOM', '160', '180', 59),
(60, 'Veg', 'TANDOORI GOBI', '110', '130', 60),
(61, 'Veg', 'VEG SEEK KABAB', '160', '180', 61),
(62, 'Veg', 'VEG CHEESE SEEK KABAB', '170', '190', 62),
(63, 'Veg', 'PANEER MALAI TIKKA', '200', '220', 63),
(64, 'Veg', 'SHIVA SPL VEG KABAB', '180', '200', 64),
(65, 'Veg', 'UTTARA KARNATAKA THALI', '200', '210', 65),
(66, 'Veg', 'PUNJABI THALI', '200', '230', 66),
(67, 'Veg', 'SPL PUNJABI THALI', '250', '260', 67),
(68, 'Veg', 'MIX VEG MASALA', '180', '190', 68),
(69, 'Veg', 'VEG TAWA MASALA', '180', '190', 69),
(70, 'Veg', 'VEG JAIPURI', '200', '220', 70),
(71, 'Veg', 'VEG HANDI', '180', '190', 71),
(72, 'Veg', 'VEG KADAI', '180', '190', 72),
(73, 'Veg', 'VEG KOLHAPURI', '180', '190', 73),
(74, 'Veg', 'VEG HYDERABADI', '180', '190', 74),
(75, 'Veg', 'VEG MAKHANWALA', '180', '190', 75),
(76, 'Veg', 'VEG BHUNA MASALA', '180', '190', 76),
(77, 'Veg', 'VEG SHAM SAVERA', '220', '240', 77),
(78, 'Veg', 'VEG MARTHA', '220', '240', 78),
(79, 'Veg', 'VEG KHEEMA MASALA', '180', '190', 79),
(80, 'Veg', 'VEG KASHMIRI MASALA', '220', '210', 80),
(81, 'Veg', 'GREEN PEAS MASALA', '180', '190', 81),
(82, 'Veg', 'MUSHROOM MASALA', '200', '220', 82),
(83, 'Veg', 'KAJU MASALA', '220', '240', 83),
(84, 'Veg', 'VEG KOFTA', '190', '200', 84),
(85, 'Veg', 'CAPSICUM MASALA', '150', '160', 85),
(86, 'Veg', 'TOMATO CURRY', '160', '170', 86),
(87, 'Veg', 'BHENDI MASALA', '160', '170', 87),
(88, 'Veg', 'CHANA MASALA', '160', '170', 88),
(89, 'Veg', 'CORN PALAK', '160', '170', 89),
(90, 'Veg', 'CHEESE MASALA', '200', '220', 90),
(91, 'Veg', 'KAJU PANEER', '220', '240', 91),
(92, 'Veg', 'PANEER MAKHANWALA', '200', '220', 92),
(93, 'Veg', 'PANEER PEPPER DRY', '200', '220', 93),
(94, 'Veg', 'PANEER PUNJABI', '200', '220', 94),
(95, 'Veg', 'PANEER BUTTER MASALA', '200', '220', 95),
(96, 'Veg', 'PANEER RAJWADI', '200', '220', 96),
(97, 'Veg', 'PANEER PALAK', '200', '220', 97),
(98, 'Veg', 'PANEER KOFTA', '200', '220', 98),
(99, 'Veg', 'MUTTER PANEER ', '200', '220', 99),
(100, 'Veg', 'ALOO JEERA PUNJABI', '180', '190', 101),
(101, 'Veg', 'ALOO JEERA DRY', '180', '190', 102),
(102, 'Veg', 'ALOO MUTTER', '180', '190', 103),
(103, 'Veg', 'MADIKE MASALA', '160', '170', 104),
(104, 'Veg', 'MADIKE FRY', '160', '170', 105),
(105, 'Veg', 'FRESH MANGO JUICE', '90', '90', 106),
(106, 'Veg', 'FRESH APPLE JUICE', '90', '90', 107),
(107, 'Veg', 'FRESH FRUIT JUICE', '90', '90', 108),
(108, 'Veg', 'FRESH ORANGE JUICE', '90', '90', 109),
(109, 'Veg', 'FRESH LIME JUICE', '40', '50', 110),
(110, 'Veg', 'VIRGIN MOJITHO', '150', '150', 111),
(111, 'Veg', 'VIRGIN COLODA', '150', '150', 112),
(112, 'Veg', 'MANGO SMOOTHE', '150', '150', 113),
(113, 'Veg', 'BLUE ANGEL', '150', '150', 114),
(114, 'Veg', 'MICKEY MOUSE', '150', '150', 115),
(115, 'Veg', 'KIWI COOLER', '150', '150', 116),
(116, 'Veg', 'STRAWBERRY SURPRISE', '150', '150', 117),
(117, 'Veg', 'FRESH LIME SODA', '50', '60', 118),
(118, 'Veg', 'SWEET LASSI', '70', '80', 119),
(119, 'Veg', 'MASALA BUTTER MILK', '40', '50', 120),
(120, 'Veg', 'TOMATO SOUP', '90', '100', 121),
(121, 'Veg', 'VEG MANCHOW SOUP', '90', '100', 122),
(122, 'Veg', 'VEG CLEAR SOUP', '90', '100', 123),
(123, 'Veg', 'VEG HOT & SOUR SOUP', '90', '100', 124),
(124, 'Veg', 'VEG SWEET CORN SOUP', '90', '100', 125),
(125, 'Veg', 'LEMON CORIENDER SOUP', '90', '100', 126),
(126, 'Veg', 'VEG LUNG FUNG SOUP', '90', '100', 127),
(127, 'Veg', 'VEG TUM YUM SOUP', '90', '100', 128),
(128, 'Veg', 'GULAB JAMUN', '20', '25', 129),
(129, 'Veg', 'GAJAR HALWA', '40', '50', 130),
(130, 'Veg', 'MINERAL WATER', '19.04', '19.04', 133),
(131, 'Veg', 'TEA HALF', '10', '15', 137),
(132, 'Veg', 'COFFEE / TEA / MILK', '20', '30', 138),
(133, 'Veg', 'FRENCH POTATO', '120', '130', 139),
(134, 'Veg', 'HONEY CHILLY POTATO', '120', '130', 140),
(135, 'Veg', 'GOBI MANCHURIAN', '130', '140', 141),
(136, 'Veg', 'GOBI CHILLY', '130', '140', 142),
(137, 'Veg', 'GOBI 65 DRY', '130', '140', 143),
(138, 'Veg', 'VEG CRISPY', '150', '160', 145),
(139, 'Veg', 'PANEER MANCHURIAN', '200', '220', 146),
(140, 'Veg', 'PANEER CHILLY', '200', '220', 147),
(141, 'Veg', 'PANEER SAUTE', '200', '220', 148),
(142, 'Veg', 'PANEER SALT & PEPPER', '200', '220', 149),
(143, 'Veg', 'VEG MANCHURIAN', '120', '130', 154),
(144, 'Veg', 'BABYCORN CRISPY', '170', '180', 157),
(145, 'Veg', 'BABYCORN MANCHURIAN', '170', '180', 159),
(146, 'Veg', 'BABYCORN PEPPER DRY', '160', '170', 160),
(147, 'Veg', 'MUSHROOM SALT & PEPPER', '180', '190', 162),
(148, 'Veg', 'BUTTER FRY MUSHROOM', '180', '190', 163),
(149, 'Veg', 'MUSHROOM MANCHURIAN', '180', '190', 164),
(150, 'Veg', 'DAL FRY', '120', '130', 165),
(151, 'Veg', 'DAL TADKA', '140', '150', 166),
(152, 'Veg', 'DAL KOLHAPURI', '120', '130', 167),
(153, 'Veg', 'DAL MAKHAN', '140', '150', 168),
(154, 'Veg', 'DAL PALAK', '140', '150', 169),
(155, 'Veg', 'YELLOW DAL', '130', '140', 170),
(156, 'Veg', 'ONION PAKODA', '110', '120', 171),
(157, 'Veg', 'VEG KURMA', '180', '190', 172),
(158, 'Veg', 'MUSHROOM KOLHAPURI', '200', '220', 173),
(159, 'Veg', 'KAJU KURMA', '220', '240', 175),
(160, 'Veg', 'BHENDI FRY', '150', '160', 176),
(161, 'Veg', 'PANEER MASALA', '200', '220', 177),
(162, 'Veg', 'PLAIN PALAK', '180', '190', 178),
(163, 'Veg', 'ALOO PALAK', '180', '190', 179),
(164, 'Veg', 'BAIGAN MASALA', '150', '160', 180),
(165, 'Veg', 'JOWAR ROTI', '15', '20', 181),
(166, 'Veg', 'MASALA PARATHA', '70', '80', 182),
(167, 'Veg', 'TOMATO RICE', '120', '130', 183),
(168, 'Veg', 'FRIED RICE', '120', '130', 184),
(169, 'Veg', 'LEMON RICE', '120', '130', 185),
(170, 'Veg', 'PARCEL BOX', '5', '5', 186),
(171, 'Veg', 'KAJU KOLHAPURI', '220', '240', 190),
(172, 'Veg', 'DAL FRY HALF', '60', '80', 191),
(173, 'Veg', 'PLAIN RICE HALF', '35', '55', 192),
(174, 'Veg', 'FRIED RICE HALF', '60', '80', 195),
(175, 'Veg', 'CURD RICE HALF', '60', '80', 196),
(176, 'Veg', 'MASALA RICE HALF', '60', '80', 200),
(177, 'Veg', 'CURDS', '20', '30', 201),
(178, 'Veg', 'DHAI KADAI', '130', '150', 213),
(179, 'Veg', 'SPL CURD RICE', '110', '130', 214),
(180, 'Veg', 'BHENDI CHILLY FRY', '110', '120', 215),
(181, 'Veg', 'PLAIN BUTTER MILK', '30', '40', 216),
(182, 'Veg', 'DAL KICHIDI', '150', '170', 217),
(183, 'Veg', 'OIL FRY PAPAD', '30', '40', 218),
(184, 'Veg', 'SODA', '25', '35', 219),
(185, 'Veg', 'JEERA SODA', '20', '20', 225),
(186, 'Veg', 'KAJU MUSH MASALA', '200', '220', 232),
(187, 'Veg', 'CHILLY FRY', '40', '50', 233),
(188, 'Veg', 'PANEER BURJI MASALA', '200', '220', 234),
(189, 'Veg', 'PANEER GHEE ROAST', '220', '240', 235),
(190, 'Veg', 'ALOO GOBI DRY', '180', '190', 236),
(191, 'Veg', 'MILK', '20', '25', 238),
(192, 'Veg', 'GOBI MUTTER MASALA', '180', '190', 241),
(193, 'Veg', 'S I PAPAD', '10', '15', 242),
(194, 'Veg', 'PANEER KOLHAPURI', '200', '220', 243),
(195, 'Veg', 'MUSHROOM PEPPER DRY', '200', '220', 244),
(196, 'Veg', 'ALOO TOMATO', '160', '170', 245),
(197, 'Veg', 'CHANA FRY', '160', '170', 248),
(198, 'Veg', 'PANEER TIKKA MASALA', '200', '220', 249),
(199, 'Veg', 'MALAI KOFTA', '220', '230', 250),
(200, 'Veg', 'KASHMIRI PULAO', '180', '200', 252),
(201, 'Veg', 'PANEER SHAHI KURMA', '230', '250', 253),
(202, 'Veg', 'STUFF CAPSICUM M/S', '180', '200', 254),
(203, 'Veg', 'BADAM MILK', '30', '40', 255),
(204, 'Veg', 'PALAK KICHIDI', '170', '190', 258),
(205, 'Veg', 'MUSHROOM FRIED RICE', '180', '200', 259),
(206, 'Veg', 'PALAK MUTTER ', '180', '200', 260),
(207, 'Veg', 'PANEER BURJI', '210', '240', 261),
(208, 'Veg', 'MUSHROOM BIRIYANI', '200', '220', 263),
(209, 'Veg', 'KAJU FRY', '200', '220', 264),
(210, 'Veg', 'MUSHROOM SOUP', '90', '100', 265),
(211, 'Veg', 'KERLA PAROTHA', '40', '50', 266),
(212, 'Veg', 'CHILLY ROTI', '35', '50', 267),
(213, 'Veg', 'MEHTI ROTI', '50', '70', 268),
(214, 'Veg', 'MEHTI DAL', '130', '150', 269),
(215, 'Veg', 'VEG DAL', '150', '170', 270),
(216, 'Veg', 'SHAM SAVERA', '220', '240', 274),
(217, 'Veg', 'ALOO GOBI PUNJABI', '180', '200', 275),
(218, 'Veg', 'ALOO METHI', '180', '200', 276),
(219, 'Veg', 'CORN PALAK', '200', '220', 277),
(220, 'Veg', 'VEG KOFTA', '220', '240', 278),
(221, 'Veg', 'VEG PLATTER', '350', '370', 279),
(222, 'Veg', 'PANEER HARIYALI TIKKA', '200', '220', 280),
(223, 'Veg', 'CHEESE PAKODA', '220', '240', 281),
(224, 'Veg', 'ALOO PAKODA', '110', '130', 282),
(225, 'Veg', 'PANEER GUNTUR', '200', '220', 283),
(226, 'Veg', 'PANEER SHANGHAI', '200', '220', 284),
(227, 'Veg', 'PANEER LEMON CORIENDER', '200', '220', 285),
(228, 'Veg', 'GOBI CHINA DON', '180', '190', 286),
(229, 'Veg', 'CHEESE FINGER', '220', '240', 287),
(230, 'Veg', 'CHAPATI', '15', '20', 288),
(231, 'Veg', 'ONION RING PAKODA', '110', '130', 289),
(232, 'Veg', 'MUSHROOM TIKKA', '200', '220', 290),
(233, 'Veg', 'PANEER KHEEMA MASALA', '200', '220', 291),
(234, 'Veg', 'VEG MAHARAJA', '180', '190', 292),
(235, 'Veg', 'MUSHROOM PANEER', '200', '220', 293),
(236, 'Veg', 'PANEER KURMA', '200', '220', 294),
(237, 'Veg', 'BABYCORN MASALA', '180', '200', 297),
(238, 'Veg', 'VEG NOODLES', '150', '160', 298),
(239, 'Veg', 'SCHEZWAN NOODLES', '160', '170', 299),
(240, 'Veg', 'VEG CHOPSUEY', '160', '170', 300),
(241, 'Veg', 'SINGAPURI NOODLES', '160', '170', 301),
(242, 'Veg', 'TOMATO SEV MASALA', '180', '190', 302),
(243, 'Veg', 'SALTED LASSI', '70', '80', 303),
(244, 'Veg', 'PANEER KADAI', '200', '220', 304),
(245, 'Veg', 'PANEER NOODLES', '200', '220', 306),
(246, 'Veg', 'CAPSICUM FRIED RICE', '160', '180', 309),
(247, 'Veg', 'SINGLE IDLY WADA', '60', '70', 310),
(248, 'Veg', 'VEG PATIYALA', '250', '260', 311),
(249, 'Veg', 'MUSHROOM CHILLY', '200', '220', 314),
(250, 'Veg', 'PANEER BIRIYANI', '200', '220', 315),
(251, 'Veg', 'IDLY WADA PLATE', '70', '80', 316),
(252, 'Veg', 'IDLY PLATE', '40', '50', 317),
(253, 'Veg', 'WADA PLATE', '50', '60', 318),
(254, 'Veg', 'SINGLE WADA', '30', '35', 319),
(255, 'Veg', 'SINGLE IDLY', '20', '25', 320),
(256, 'Veg', 'IDLY WADA DIP', '80', '90', 321),
(257, 'Veg', 'SINGLE IDLY WADA DIP', '70', '80', 322),
(258, 'Veg', 'PLATE WADA DIP', '60', '70', 323),
(259, 'Veg', 'SINGLE WADA DIP', '35', '40', 324),
(260, 'Veg', 'UPMA', '40', '50', 325),
(261, 'Veg', 'KESARI BATH', '50', '60', 326),
(262, 'Veg', 'CHOWCHOW BATH', '90', '110', 327),
(263, 'Veg', 'PULAO B/F', '50', '60', 328),
(264, 'Veg', 'AVALAKKI / POHA', '50', '60', 330),
(265, 'Veg', 'POORI BHAJI', '70', '80', 332),
(266, 'Veg', 'DVG BENNE DOSA', '90', '100', 333),
(267, 'Veg', 'BENNE MASALA DOSA', '80', '90', 334),
(268, 'Veg', 'SINGLE BENNE DOSA', '50', '60', 335),
(269, 'Veg', 'MASALA DOSA', '70', '80', 336),
(270, 'Veg', 'SET DOSA', '70', '80', 337),
(271, 'Veg', 'PLAIN DOSA', '60', '70', 338),
(272, 'Veg', 'ONION DOSA', '80', '100', 339),
(273, 'Veg', 'KHALI DOSA', '60', '70', 340),
(274, 'Veg', 'CUT DOSA', '70', '80', 341),
(275, 'Veg', 'GIRMITT MANDAKKI', '40', '50', 342),
(276, 'Veg', 'GARLIC MANDAKKI', '40', '50', 343),
(277, 'Veg', 'MIRCHI PLATE', '50', '60', 344),
(278, 'Veg', 'TEA HALF', '10', '15', 346),
(279, 'Veg', 'BOOST', '30', '40', 347),
(280, 'Veg', 'OPEN DOSA', '80', '90', 348),
(281, 'Veg', 'VANILLA SINGLE SCOOP', '35', '35', 349),
(282, 'Veg', 'VANILLA DOUBLE SCOOP', '60', '60', 350),
(283, 'Veg', 'ST/BERRY SINGLE SCOOP', '35', '35', 351),
(284, 'Veg', 'ST/BERRY DOUBLE SCOOP', '60', '60', 352),
(285, 'Veg', 'MANGO SINGLE SCOOP', '40', '40', 353),
(286, 'Veg', 'MANGO DOUBLE SCOOP', '75', '75', 354),
(287, 'Veg', 'CHOCOLATE SINGLE SCOOP', '40', '40', 355),
(288, 'Veg', 'CHOCOLATE DOUBLE SCOOP', '75', '75', 356),
(289, 'Veg', 'FRESH P/A SINGLE SCOOP', '40', '40', 357),
(290, 'Veg', 'FRESH P/A DOUBLE SCOOP', '75', '75', 358),
(291, 'Veg', 'PLAIN PISTA SINGLE SCOOP', '40', '40', 359),
(292, 'Veg', 'PLAIN PISTA DOUBLE SCOOP', '75', '75', 360),
(293, 'Veg', 'BTR SCO SINGLE SCOOP', '40', '40', 361),
(294, 'Veg', 'BTR SCO DOUBLE SCOOP', '75', '75', 362),
(295, 'Veg', 'BL CURR SINGLE SCOOP', '45', '45', 363),
(296, 'Veg', 'BL CURR DOUBLE SCOOP', '85', '85', 364),
(297, 'Veg', 'LYCHEE SINGLE SCOOP', '45', '45', 365),
(298, 'Veg', 'LYCHEE DOUBLE SCOOP', '85', '85', 366),
(299, 'Veg', 'KESAR P SINGLE SCOOP', '50', '50', 367),
(300, 'Veg', 'KESAR P DOUBLE SCOOP', '95', '95', 368),
(301, 'Veg', 'RAJBHOG SINGLE SCOOP', '55', '55', 369),
(302, 'Veg', 'RAJBHOG DOUBLE SCOOP', '100', '100', 370),
(303, 'Veg', 'DRY FRUIT SP SINGLE SCOOP', '50', '50', 371),
(304, 'Veg', 'DRY FRUIT SP DOUBLE SCOOP', '95', '95', 372),
(305, 'Veg', 'GUDBAD ICE CREAM', '130', '130', 373),
(306, 'Veg', 'SHIVA SPL ICE CREAM', '150', '150', 374),
(307, 'Veg', 'FRUIT MILK SHAKE', '90', '90', 375),
(308, 'Veg', 'BUTTER DAL FRY', '140', '150', 376),
(309, 'Veg', 'COMBI FRIED RICE', '200', '220', 378),
(310, 'Veg', 'LEMON CORIENDER SOUP', '90', '100', 379),
(311, 'Veg', 'PALAK DOSA', '80', '90', 380),
(312, 'Veg', 'ICE CREAM SHAKE', '120', '120', 384),
(313, 'Veg', 'COLD COFFEE WITH ICE CREAM', '120', '120', 385),
(314, 'Veg', 'EXTRA ICE CREAM', '25', '25', 386),
(315, 'Veg', 'VEG RAITHA', '70', '80', 387),
(316, 'Veg', 'FRUIT RAITHA', '90', '100', 388),
(317, 'Veg', 'MANGO MILK SHAKE', '90', '90', 389),
(318, 'Veg', 'SITAPHAL MILK SHAKE', '90', '90', 390),
(319, 'Veg', 'FIG MILK SHAKE', '90', '90', 391),
(320, 'Veg', 'AVACADO MILK SHAKE', '90', '90', 392),
(321, 'Veg', 'CHIKKU MILK SHAKE', '90', '90', 393),
(322, 'Veg', 'PASSION FRUIT MILK SHAKE', '90', '90', 394);

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
(2, 'Non-veg');

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
(2, 'manager', 'MANAGER', 'Cashier', 7),
(3, 'NAGARAJ', 'NAGARAJ', 'Cashier', 8);

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

-- --------------------------------------------------------

--
-- Table structure for table `parsetable`
--

CREATE TABLE `parsetable` (
  `id` int(10) NOT NULL,
  `parce_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(10) NOT NULL,
  `pname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `readymadeitem`
--

CREATE TABLE `readymadeitem` (
  `slno` int(10) UNSIGNED NOT NULL,
  `itmnam` varchar(40) NOT NULL,
  `qty` double NOT NULL,
  `prc` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `item_total` varchar(30) NOT NULL,
  `remain` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `tabno` varchar(10) NOT NULL,
  `billno` int(10) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `cahsh_id` int(10) NOT NULL
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
  `tabno` varchar(10) NOT NULL,
  `capname` varchar(50) NOT NULL,
  `status` int(10) UNSIGNED NOT NULL,
  `billno` int(10) UNSIGNED NOT NULL,
  `kot` int(10) NOT NULL,
  `kot_num` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(7, 'Cashier');

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
-- Indexes for table `parsetable`
--
ALTER TABLE `parsetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `readymadeitem`
--
ALTER TABLE `readymadeitem`
  ADD PRIMARY KEY (`slno`);

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
  MODIFY `table_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `empreg`
--
ALTER TABLE `empreg`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT for table `item-categories`
--
ALTER TABLE `item-categories`
  MODIFY `cat_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `logid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `parcel`
--
ALTER TABLE `parcel`
  MODIFY `slno` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parsetable`
--
ALTER TABLE `parsetable`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `readymadeitem`
--
ALTER TABLE `readymadeitem`
  MODIFY `slno` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_room`
--
ALTER TABLE `store_room`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_room_finish`
--
ALTER TABLE `store_room_finish`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabledata`
--
ALTER TABLE `tabledata`
  MODIFY `slno` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabletot`
--
ALTER TABLE `tabletot`
  MODIFY `slno` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temtable`
--
ALTER TABLE `temtable`
  MODIFY `slno` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userlist`
--
ALTER TABLE `userlist`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
