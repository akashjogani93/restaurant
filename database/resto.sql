-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2023 at 09:18 AM
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
-- Table structure for table `beverages`
--

CREATE TABLE `beverages` (
  `id` int(10) NOT NULL,
  `pname` varchar(30) NOT NULL,
  `pid` int(11) NOT NULL,
  `punit` varchar(30) NOT NULL,
  `givenDate` date NOT NULL,
  `uqty` double NOT NULL,
  `rqty` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categoroy`
--

CREATE TABLE `categoroy` (
  `id` int(10) NOT NULL,
  `CategoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoroy`
--

INSERT INTO `categoroy` (`id`, `CategoryName`) VALUES
(1, 'Beverages And Desserts'),
(2, 'Produce'),
(3, 'Grains and Legumes'),
(4, 'Meat and Seafood'),
(5, 'Dairy and Eggs'),
(6, 'Spices and Condiments'),
(7, 'Bakery and Staples'),
(8, 'Canned and Jarred Goods'),
(9, 'Miscellaneous');

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
-- Table structure for table `kitchen_used`
--

CREATE TABLE `kitchen_used` (
  `id` int(10) NOT NULL,
  `pname` varchar(30) NOT NULL,
  `pid` int(30) NOT NULL,
  `punit` varchar(30) NOT NULL,
  `givenDate` date NOT NULL,
  `uqty` double NOT NULL,
  `rqty` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `status` int(10) NOT NULL
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
  `kot_num` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kot_history`
--

CREATE TABLE `kot_history` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `itmnam` varchar(50) NOT NULL,
  `qty` double NOT NULL,
  `tabno` varchar(30) NOT NULL,
  `capname` varchar(50) NOT NULL,
  `kot_num` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kot_history`
--

INSERT INTO `kot_history` (`id`, `date`, `itmnam`, `qty`, `tabno`, `capname`, `kot_num`) VALUES
(1, '2023-08-18', 'Jeera Soda', 1, 'G-1', 'Vivek Joshi', 1),
(2, '2023-08-18', 'Chaas', 3, 'G-1', 'Vivek Joshi', 1),
(4, '2023-08-18', 'Jeera Soda', 5, 'G-2', 'Vivek Joshi', 2),
(5, '2023-08-18', 'Jeera Soda', 5, 'G-3', 'Vivek Joshi', 3),
(6, '2023-08-18', 'Jeera Soda', 5, 'G-5', 'Vivek Joshi', 4),
(7, '2023-08-18', 'Fresh Lime Soda', 6, 'G-5', 'Vivek Joshi', 4),
(9, '2023-08-18', 'Jeera Soda', 6, 'G-10', 'Vivek Joshi', 5),
(10, '2023-08-18', 'Jeera Soda', 1, 'G-6', 'Vivek Joshi', 6),
(11, '2023-08-18', 'Jeera Soda', 1, 'G-15', 'Vivek Joshi', 7),
(12, '2023-08-18', 'Jeera Soda', 6, 'T-5', 'Vivek Joshi', 8),
(13, '2023-08-18', 'Jeera Soda', 6, 'T-2', 'Vivek Joshi', 9),
(14, '2023-08-18', 'Jeera Soda', 5, 'T-3', 'Vivek Joshi', 10),
(15, '2023-08-18', 'Jeera Soda', 1, 'T-4', 'Vivek Joshi', 11),
(16, '2023-08-18', 'Jeera Soda', 1, 'G-11', 'Vivek Joshi', 12),
(17, '2023-08-18', 'Jeera Soda', 1, 'G-12', 'Vivek Joshi', 13),
(18, '2023-08-18', 'Jeera Soda', 1, 'G-13', 'Vivek Joshi', 14),
(19, '2023-08-18', 'Jeera Soda', 1, 'G-14', 'Vivek Joshi', 15),
(20, '2023-08-18', 'Jeera Soda', 1, 'G-15', 'Vivek Joshi', 16),
(21, '2023-08-18', 'Jeera Soda', 1, 'PARCEL_1', '', 17),
(22, '2023-08-18', 'Chaas', 3, 'PARCEL_1', '', 17),
(24, '2023-08-18', 'Blue Curacao(soda)', 2, 'PARCEL_5', '', 18),
(25, '2023-08-18', 'Jeera Soda', 1, 'PARCEL_4', '', 19),
(26, '2023-08-18', 'Jeera Soda', 1, 'PARCEL_2', '', 20);

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
(1, '2023-08-18', 1, 'Jeera Soda', 70, 1, 70, 'PARCEL_1', 0, '1', '', 19, 17),
(2, '2023-08-18', 3, 'Chaas', 120, 3, 360, 'PARCEL_1', 0, '1', '', 20, 17),
(3, '2023-08-18', 1, 'Jeera Soda', 70, 1, 70, 'PARCEL_2', 0, '1', '', 21, 20),
(4, '2023-08-18', 1, 'Jeera Soda', 70, 1, 70, 'PARCEL_4', 0, '1', '', 22, 19),
(5, '2023-08-18', 12, 'Blue Curacao(soda)', 80, 2, 160, 'PARCEL_5', 0, '1', '', 23, 18);

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
  `pname` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `tax` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `category`, `unit`, `tax`) VALUES
(1, 'Onions', 'Produce', 'kg', 18),
(2, 'Tomatoes', 'Produce', 'kg', 18),
(4, 'Potatoes', 'Produce', 'kg', 0),
(5, 'Garlic', 'Produce', 'kg', 0),
(6, 'Bell peppers', 'Produce', 'kg', 0),
(7, 'Green chilies', 'Produce', 'kg', 0),
(8, 'Lemons', 'Produce', 'kg', 0),
(9, 'Cilantro', 'Produce', 'kg', 0),
(10, 'Mint leaves', 'Produce', 'kg', 0),
(11, 'Lettuce or salad greens', 'Produce', 'kg', 0),
(12, 'Fresh herbs', 'Produce', 'kg', 0),
(13, 'Rice Basmati', 'Grains and Legumes', 'kg', 0),
(14, 'Belgaum rice', 'Grains and Legumes', 'kg', 0),
(15, 'Wheat flour', 'Grains and Legumes', 'kg', 0),
(16, 'Lentils', 'Grains and Legumes', 'kg', 0),
(17, 'Chickpeas', 'Grains and Legumes', 'kg', 0),
(18, 'Black beans or kidney beans', 'Grains and Legumes', 'kg', 0),
(19, 'Pasta', 'Grains and Legumes', 'kg', 0),
(20, 'Chicken', 'Meat and Seafood', 'kg', 0),
(21, 'Beef', 'Meat and Seafood', 'kg', 0),
(22, 'Fish', 'Meat and Seafood', 'kg', 0),
(23, 'Shrimp', 'Meat and Seafood', 'kg', 0),
(24, 'Lamb or mutton', 'Meat and Seafood', 'kg', 0),
(25, 'Milk', 'Dairy and Eggs', 'litre', 0),
(26, 'Butter', 'Meat and Seafood', 'kg', 0),
(27, 'Ghee', 'Meat and Seafood', 'kg', 0),
(28, 'Cream', 'Meat and Seafood', 'kg', 0),
(29, 'Yogurt', 'Meat and Seafood', 'kg', 0),
(30, 'Cheese', 'Meat and Seafood', 'kg', 0),
(31, 'Paneer', 'Meat and Seafood', 'kg', 0),
(32, 'Eggs', 'Meat and Seafood', 'pack', 0),
(33, 'Cumin', 'Spices and Condiments', 'kg', 0),
(34, 'Coriander', 'Spices and Condiments', 'kg', 0),
(35, 'Turmeric', 'Spices and Condiments', 'kg', 0),
(36, 'Garam masala', 'Spices and Condiments', 'kg', 0),
(37, 'Chili powder', 'Spices and Condiments', 'kg', 0),
(38, 'Paprika', 'Spices and Condiments', 'kg', 0),
(39, 'Mustard seeds', 'Spices and Condiments', 'kg', 0),
(40, 'Fenugreek seeds', 'Spices and Condiments', 'kg', 0),
(41, 'Cardamom', 'Spices and Condiments', 'kg', 0),
(42, 'Cinnamon', 'Spices and Condiments', 'kg', 0),
(43, 'Nutmeg', 'Spices and Condiments', 'kg', 0),
(44, 'Bay leaves', 'Spices and Condiments', 'kg', 0),
(45, 'Vinegar', 'Spices and Condiments', 'bottle', 0),
(46, 'Soy sauce', 'Spices and Condiments', 'bottle', 0),
(47, 'Hot sauce', 'Spices and Condiments', 'bottle', 0),
(48, 'Ketchup', 'Spices and Condiments', 'packet', 0),
(49, 'Mayonnaise', 'Spices and Condiments', 'kg', 0),
(50, 'Mustard', 'Spices and Condiments', 'kg', 0),
(51, 'Olive oil', 'Spices and Condiments', 'litre', 0),
(52, 'Vegetable oil', 'Spices and Condiments', 'litre', 0),
(53, 'Bread', 'Bakery and Staples', 'packet', 0),
(54, 'Naan or Roti', 'Bakery and Staples', 'packet', 0),
(55, 'Pita bread', 'Bakery and Staples', 'packet', 0),
(56, 'Tortillas', 'Bakery and Staples', 'packet', 0),
(57, 'Sugar', 'Bakery and Staples', 'kg', 0),
(58, 'Salt', 'Bakery and Staples', 'kg', 0),
(59, 'All-purpose flour', 'Bakery and Staples', 'kg', 0),
(60, 'Baking powder', 'Bakery and Staples', 'kg', 0),
(61, 'Baking soda', 'Bakery and Staples', 'kg', 0),
(62, 'Yeast', 'Bakery and Staples', 'kg', 0),
(63, 'Canned tomatoes', 'Canned and Jarred Goods', 'kg', 0),
(64, 'Tomato paste', 'Canned and Jarred Goods', 'kg', 0),
(65, 'Coconut milk', 'Canned and Jarred Goods', 'litre', 0),
(66, 'Pickles', 'Canned and Jarred Goods', 'kg', 0),
(67, 'Chutneys', 'Canned and Jarred Goods', 'kg', 0),
(68, 'Olives', 'Canned and Jarred Goods', 'kg', 0),
(69, 'Coffee', 'Beverages And Desserts', 'kg', 0),
(70, 'Tea leaves or tea bags', 'Beverages And Desserts', 'kg', 0),
(71, 'Soft drinks', 'Beverages And Desserts', 'litre', 0),
(72, 'Juices', 'Beverages And Desserts', 'litre', 0),
(73, 'Bisleri ', 'Beverages And Desserts', 'litre', 0),
(74, 'Nuts', 'Miscellaneous', 'kg', 0),
(75, 'Raisins', 'Miscellaneous', 'kg', 0),
(76, 'Honey', 'Miscellaneous', 'bottle', 0),
(77, 'Cooking wine ', 'Miscellaneous', 'litre', 0);

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
  `tax` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  `pname` varchar(30) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `qty` double NOT NULL,
  `venid` int(10) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  `bamt` double NOT NULL,
  `tax` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock1`
--

CREATE TABLE `stock1` (
  `id` int(30) NOT NULL,
  `category` varchar(50) NOT NULL,
  `pname` varchar(30) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `qty` double NOT NULL,
  `venid` int(30) NOT NULL,
  `exp` date NOT NULL
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
  `tabno` varchar(30) NOT NULL,
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
  `kot_num` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temtable`
--

INSERT INTO `temtable` (`slno`, `date`, `itmno`, `itmnam`, `prc`, `qty`, `tot`, `tabno`, `capname`, `billno`, `status`, `kot`, `kot_num`) VALUES
(1, '2023-08-18', 1, 'Jeera Soda', 70, 1, 70, 'G-1', 'Vivek Joshi', 0, 1, 1, 1),
(2, '2023-08-18', 3, 'Chaas', 120, 3, 360, 'G-1', 'Vivek Joshi', 0, 1, 2, 1),
(3, '2023-08-18', 1, 'Jeera Soda', 70, 5, 350, 'G-2', 'Vivek Joshi', 0, 1, 3, 2),
(4, '2023-08-18', 1, 'Jeera Soda', 70, 5, 350, 'G-3', 'Vivek Joshi', 0, 1, 4, 3),
(5, '2023-08-18', 1, 'Jeera Soda', 70, 5, 350, 'G-5', 'Vivek Joshi', 0, 1, 5, 4),
(6, '2023-08-18', 5, 'Fresh Lime Soda', 60, 6, 360, 'G-5', 'Vivek Joshi', 0, 1, 6, 4),
(7, '2023-08-18', 1, 'Jeera Soda', 70, 6, 420, 'G-10', 'Vivek Joshi', 0, 1, 7, 5),
(8, '2023-08-18', 1, 'Jeera Soda', 70, 1, 70, 'G-6', 'Vivek Joshi', 0, 1, 8, 6),
(9, '2023-08-18', 1, 'Jeera Soda', 70, 1, 70, 'G-15', 'Vivek Joshi', 0, 1, 9, 7),
(10, '2023-08-18', 1, 'Jeera Soda', 70, 6, 420, 'T-5', 'Vivek Joshi', 0, 1, 10, 8),
(11, '2023-08-18', 1, 'Jeera Soda', 70, 6, 420, 'T-2', 'Vivek Joshi', 0, 1, 11, 9),
(12, '2023-08-18', 1, 'Jeera Soda', 70, 5, 350, 'T-3', 'Vivek Joshi', 0, 1, 12, 10),
(13, '2023-08-18', 1, 'Jeera Soda', 70, 1, 70, 'T-4', 'Vivek Joshi', 0, 1, 13, 11),
(14, '2023-08-18', 1, 'Jeera Soda', 70, 1, 70, 'G-11', 'Vivek Joshi', 0, 1, 14, 12),
(15, '2023-08-18', 1, 'Jeera Soda', 70, 1, 70, 'G-12', 'Vivek Joshi', 0, 1, 15, 13),
(16, '2023-08-18', 1, 'Jeera Soda', 70, 1, 70, 'G-13', 'Vivek Joshi', 0, 1, 16, 14),
(17, '2023-08-18', 1, 'Jeera Soda', 70, 1, 70, 'G-14', 'Vivek Joshi', 0, 1, 17, 15),
(18, '2023-08-18', 1, 'Jeera Soda', 70, 1, 70, 'G-15', 'Vivek Joshi', 0, 1, 18, 16);

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

-- --------------------------------------------------------

--
-- Table structure for table `vestage`
--

CREATE TABLE `vestage` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `pname` varchar(30) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `qty` double NOT NULL,
  `venId` int(10) NOT NULL,
  `exp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtable`
--
ALTER TABLE `addtable`
  ADD PRIMARY KEY (`table_ID`);

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
-- Indexes for table `kitchen_used`
--
ALTER TABLE `kitchen_used`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `stock1`
--
ALTER TABLE `stock1`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addtable`
--
ALTER TABLE `addtable`
  MODIFY `table_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `beverages`
--
ALTER TABLE `beverages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categoroy`
--
ALTER TABLE `categoroy`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `empreg`
--
ALTER TABLE `empreg`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `item-categories`
--
ALTER TABLE `item-categories`
  MODIFY `cat_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kitchen_used`
--
ALTER TABLE `kitchen_used`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kot`
--
ALTER TABLE `kot`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `kot_cancel`
--
ALTER TABLE `kot_cancel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kot_history`
--
ALTER TABLE `kot_history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `logid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `parcel`
--
ALTER TABLE `parcel`
  MODIFY `slno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parsetable`
--
ALTER TABLE `parsetable`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `purchase_data`
--
ALTER TABLE `purchase_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock1`
--
ALTER TABLE `stock1`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

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
  MODIFY `slno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `userlist`
--
ALTER TABLE `userlist`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `slno` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_payment`
--
ALTER TABLE `vendor_payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
