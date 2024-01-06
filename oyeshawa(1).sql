-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2024 at 12:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `qty` double NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assetsproduct`
--

CREATE TABLE `assetsproduct` (
  `product` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `venId` int(10) NOT NULL,
  `date` varchar(10) NOT NULL,
  `remainQty` double NOT NULL,
  `remainTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assetsstock`
--

CREATE TABLE `assetsstock` (
  `id` int(10) NOT NULL,
  `pur_id` int(10) NOT NULL,
  `stock` double NOT NULL,
  `damage` double NOT NULL,
  `amount` double NOT NULL,
  `damageAmount` double NOT NULL,
  `date` date NOT NULL,
  `qty` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beverages`
--

CREATE TABLE `beverages` (
  `id` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `stock` double NOT NULL,
  `date` varchar(10) NOT NULL,
  `issued` double NOT NULL,
  `stockreturn` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beverages`
--

INSERT INTO `beverages` (`id`, `pid`, `stock`, `date`, `issued`, `stockreturn`) VALUES
(2, 225, 0, '2024-01-05', 2, 0),
(3, 225, 0, '2024-01-05', 2, 0),
(4, 225, 0, '2024-01-05', 2, 0);

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
(1, 'Chinese Sausage', 'Kitchen'),
(2, 'Masala', 'Kitchen'),
(3, 'Dairy', 'Kitchen'),
(4, 'Grocery', 'Kitchen'),
(5, 'Chinese', 'Kitchen'),
(6, 'Dryfruit', 'Kitchen'),
(7, 'Meat & Sea Food ', 'Kitchen'),
(8, 'Pantry', 'Kitchen'),
(9, 'Fuel', 'Kitchen'),
(10, 'Packing Material', 'Material'),
(11, 'Cleaning Product', 'Material'),
(12, 'Syrup', 'Kitchen'),
(13, 'Chicken', 'Kitchen'),
(14, 'Liquids', 'Kitchen'),
(15, 'Vegitables', 'Kitchen'),
(16, 'english Vegitable', 'Kitchen'),
(17, 'Colors', 'Kitchen'),
(18, 'Drinks', 'Kitchen'),
(19, 'Tandoor', 'Kitchen'),
(20, 'Oils', 'Kitchen'),
(21, 'indian ', 'Kitchen'),
(22, 'Mislaneous', 'Material'),
(23, 'House Keeping', 'Material'),
(24, 'Percel Material', 'Material'),
(25, 'Stationary', 'Material'),
(33, 'Flavours', 'Bevarages');

-- --------------------------------------------------------

--
-- Table structure for table `dayshedule`
--

CREATE TABLE `dayshedule` (
  `id` int(10) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(20) NOT NULL,
  `userid` int(10) NOT NULL,
  `shedule` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dayshedule`
--

INSERT INTO `dayshedule` (`id`, `date`, `time`, `userid`, `shedule`) VALUES
(1, '2024-01-05', '12:56 PM', 6, 1);

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
(6, 'Akshay', '', '', '', '', '', 'Manager', 'Akshay', 'Akshay', 6),
(7, 'Akash Jogani', '', '9742020863', '', '', '', 'Manager', '', '', 7);

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
(1, '2024-01-05', '02:09 PM', 'Vivek Joshi', 1, 120, 0, 0, 120, 5, 6, 126, 0, 0, 126, 6, 'Table', 'Online', 1, 't-7'),
(2, '2024-01-05', '02:13 PM', 'Vivek Joshi', 1, 947.6, 0, 0, 947.6, 5, 47.38, 994.98, 0.02, 0, 995, 6, 'Table', 'Online', 1, 'T-10'),
(3, '2024-01-05', '02:16 PM', 'Vivek Joshi', 1, 343.8, 0, 0, 343.8, 5, 17.19, 360.99, 0.01, 0, 361, 6, 'Table', 'Cash', 1, 'T-6'),
(4, '2024-01-05', '02:32 PM', 'Vivek Joshi', 1, 1848.8, 0, 0, 1848.8, 5, 92.44, 1941.24, 0, 0.24, 1941, 6, 'Table', 'Online', 1, 'T-3'),
(5, '2024-01-05', '02:38 PM', 'Vivek Joshi', 1, 688.8, 0, 0, 688.8, 5, 34.44, 723.24, 0, 0.24, 723, 6, 'Table', 'Cash', 1, 'T-4'),
(6, '2024-01-05', '02:49 PM', 'Naheed', 3, 1143.8, 0, 0, 1143.8, 5, 57.19, 1200.99, 0.01, 0, 1201, 6, 'Table', 'Online', 1, 'T-9'),
(7, '2024-01-05', '03:10 PM', 'Vivek Joshi', 1, 23.8, 100, 23.8, 0, 5, 0, 0, 0, 0, 0, 6, 'Table', 'NC', 1, 'T-1'),
(8, '2024-01-05', '03:34 PM', 'Naheed', 3, 733.8, 0, 0, 733.8, 5, 36.69, 770.49, 0, 0.49, 770, 6, 'Table', 'Cash', 1, 'T-5'),
(9, '2024-01-05', '03:38 PM', 'Naheed', 3, 997.6, 0, 0, 997.6, 5, 49.88, 1047.48, 0, 0.48, 1047, 6, 'Table', 'Online', 1, 'T-1'),
(10, '2024-01-05', '03:45 PM', 'Naheed', 3, 948.8, 0, 0, 948.8, 5, 47.44, 996.24, 0, 0.24, 996, 6, 'Table', 'Online', 1, 'T-10'),
(11, '2024-01-05', '04:22 PM', 'Naheed', 3, 460, 0, 0, 460, 5, 23, 483, 0, 0, 483, 6, 'Table', 'Online', 1, 'T-6'),
(12, '2024-01-05', '04:21 PM', 'Naheed', 3, 2412.8, 0, 0, 2412.8, 5, 120.64, 2533.44, 0, 0.44, 2533, 6, 'Table', 'Online', 1, 'G-1');

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
  `item_code` int(10) NOT NULL,
  `status` double NOT NULL,
  `pid` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`slno`, `item_cat`, `itmnam`, `prc`, `prc2`, `item_code`, `status`, `pid`) VALUES
(1, 'veg', 'BOILED EGG', '20', '20', 349, 0, 0),
(2, 'veg', 'BUTTER GARLIC MUSHROOM', '175', '175', 615, 0, 0),
(3, 'veg', 'CASHEWNUT FRY', '120', '120', 342, 0, 0),
(4, 'veg', 'CHICKEN COMBINATION FRIED RICE', '200', '200', 769, 0, 0),
(5, 'veg', 'CHICKEN MASALA', '215', '215', 1046, 0, 0),
(6, 'veg', 'DAL KHICHADI WITH TADKA', '160', '160', 629, 0, 0),
(7, 'veg', 'DRUMS OF HEAVEN', '230', '230', 340, 0, 0),
(8, 'veg', 'EGG KOHLAPURI', '160', '160', 343, 0, 0),
(9, 'veg', 'EGG MAKHANWALA', '160', '160', 363, 0, 0),
(10, 'veg', 'EGG MASALA', '160', '160', 355, 0, 0),
(11, 'veg', 'FISH TAWA FRY', '260', '260', 357, 0, 0),
(12, 'veg', 'FRESH CHEESE', '150', '150', 360, 0, 0),
(13, 'veg', 'MURGH TIKKA', '265', '265', 337, 0, 0),
(14, 'veg', 'MUTTON SHEEK KABAB', '310', '310', 346, 0, 0),
(15, 'veg', 'OYE SHAWA SPECIAL STARTER (NV)', '400', '400', 981, 0, 0),
(16, 'veg', 'PANEER IN BARBQUE SAUCE', '225', '225', 976, 0, 0),
(17, 'veg', 'PANNER CHILLY', '160', '160', 356, 0, 0),
(18, 'veg', 'PEANUT MASALA', '50', '50', 344, 0, 0),
(19, 'veg', 'PLAIN CURD', '30', '30', 352, 0, 0),
(20, 'veg', 'RASGULLA 1PS', '50', '50', 1125, 0, 0),
(21, 'veg', 'SABZI LAJAWAB', '175', '175', 362, 0, 0),
(22, 'veg', 'SLICED CHICKEN IN BLACK BEAN SAUCE', '180', '180', 350, 0, 0),
(23, 'veg', 'SLICED CHICKEN IN GREEN SAUCE', '180', '180', 630, 0, 0),
(24, 'veg', 'SLICED CHICKEN IN OYESTER SAUCE', '180', '180', 347, 0, 0),
(25, 'veg', 'SLICED CHICKEN IN SOYA SAUCE', '160', '160', 341, 0, 0),
(26, 'veg', 'TANDORI FISH TIKKA', '380', '380', 358, 0, 0),
(27, 'veg', 'TANDORI KING FISH', '500', '500', 361, 0, 0),
(28, 'veg', 'TANGRI MUMTAJ SINGLE PIECE', '150', '150', 339, 0, 0),
(29, 'veg', 'VEG BALL MANCHURIAN', '180', '180', 359, 0, 0),
(30, 'veg', 'VEG BIRYANI', '160', '160', 353, 0, 0),
(31, 'veg', 'VEG GREEN THAI CURRY', '180', '180', 354, 0, 0),
(32, 'veg', 'EGG MUSSALLAM', '290', '290', 563, 0, 0),
(33, 'veg', 'AAM PANA', '70', '70', 881, 0, 0),
(35, 'veg', 'AERATED DRINKS (250 ML)', '20', '20', 511, 0, 0),
(36, 'veg', 'AERATED DRINKS (250 ML)', '25', '25', 619, 0, 0),
(37, 'veg', 'BASIL COTTAGE CHEESE TIKKA', '160', '160', 697, 0, 0),
(38, 'veg', 'BOTTEL OF SODA (1LTR)', '50', '50', 766, 0, 0),
(39, 'veg', 'BOTTLE OF SODA', '19.05', '19.05', 108, 0, 0),
(40, 'veg', 'BOTTLED WATER', '23.8', '23.8', 107, 0, 0),
(41, 'veg', 'CHAAS (BUTTER MILK)', '120', '120', 103, 0, 0),
(42, 'veg', 'CHEESE KURKURE', '160', '160', 698, 0, 0),
(43, 'veg', 'CHIKKU MILK SHAKE', '100', '100', 680, 0, 0),
(44, 'veg', 'CHOCOLATE MILK SHAKE', '100', '100', 690, 0, 0),
(45, 'veg', 'CORN TEMPORE', '140', '140', 704, 0, 0),
(46, 'veg', 'COTTAGE CHEESE ACHARI TIKKA', '160', '160', 695, 0, 0),
(47, 'veg', 'COTTAGE CHEESE MAKHAMALI TIKKA', '160', '160', 700, 0, 0),
(48, 'veg', 'FRENCH ONION SOUP', '100', '100', 694, 0, 0),
(49, 'veg', 'FRESH LIME SODA', '60', '60', 105, 0, 0),
(50, 'veg', 'FRESH LIME WATER', '50', '50', 104, 0, 0),
(51, 'veg', 'FRUIT PUNCH', '100', '100', 691, 0, 0),
(52, 'veg', 'GUAWA JUICE', '150', '150', 800, 0, 0),
(53, 'veg', 'JAL JEERA', '70', '70', 101, 0, 0),
(54, 'veg', 'LASKA SOUP (V)', '100', '100', 693, 0, 0),
(55, 'veg', 'LASSI (SWEET/SALT)', '120', '120', 102, 0, 0),
(56, 'veg', 'LASSI (SWEET/SALT) HALF', '80', '80', 841, 0, 0),
(57, 'veg', 'LIPU GOBI', '140', '140', 703, 0, 0),
(58, 'veg', 'ORANGE JUICE', '50', '50', 679, 0, 0),
(59, 'veg', 'PANGO TILL ROLL', '140', '140', 701, 0, 0),
(60, 'veg', 'PLAIN RABADI', '60', '60', 737, 0, 0),
(61, 'veg', 'PUDHINA KHATTA MEETHA', '70', '70', 109, 0, 0),
(62, 'veg', 'STRAWBERRY MILK SHAKE', '100', '100', 689, 0, 0),
(63, 'veg', 'TOMATO DHANIYA SHORBA', '100', '100', 692, 0, 0),
(64, 'veg', 'VEG CHETTINAD', '150', '150', 705, 0, 0),
(65, 'veg', 'VEG KUM KUM', '160', '160', 702, 0, 0),
(66, 'veg', 'ZAKHMI DIL', '160', '160', 696, 0, 0),
(67, 'veg', 'CHICKEN CLEAR SOUP', '100', '100', 130, 0, 0),
(68, 'veg', 'CHICKEN HAWAIN SALAD', '180', '180', 824, 0, 0),
(69, 'veg', 'CREAM OF ALMOND', '110', '110', 124, 0, 0),
(70, 'veg', 'CREAM OF CHICKEN', '110', '110', 127, 0, 0),
(71, 'veg', 'CREAM OF MUSHROOM', '100', '100', 125, 0, 0),
(72, 'veg', 'CREAM OF TOMATO SOUP', '90', '90', 126, 0, 0),
(73, 'veg', 'EGG MANCHOW SOUP', '100', '100', 1124, 0, 0),
(74, 'veg', 'HOT N SOUR SOUP(NV)', '110', '110', 117, 0, 0),
(75, 'veg', 'HOT N SOUR SOUP(V)', '90', '90', 116, 0, 0),
(76, 'veg', 'LASKA SOUP (NV)', '110', '110', 842, 0, 0),
(77, 'veg', 'LEMON CORIANDER SOUP (NV)', '110', '110', 111, 0, 0),
(78, 'veg', 'LEMON CORIANDER SOUP (V)', '90', '90', 110, 0, 0),
(79, 'veg', 'MANCHOW SOUP (V)', '90', '90', 114, 0, 0),
(80, 'veg', 'MANCHOW SOUP(NV)', '110', '110', 115, 0, 0),
(81, 'veg', 'NON VEG MINI COMBO', '420', '420', 642, 0, 0),
(82, 'veg', 'OYE SHAWA SPECIAL SOUP (NV)', '130', '130', 123, 0, 0),
(83, 'veg', 'OYE SHAWA SPECIAL SOUP (V)', '110', '110', 122, 0, 0),
(84, 'veg', 'POMFRET IN REACHEDO MASALA FRY', '250', '250', 773, 0, 0),
(85, 'veg', 'PRAWNS HANDI', '350', '350', 852, 0, 0),
(86, 'veg', 'RAINDROP SOUP(NV)', '110', '110', 121, 0, 0),
(87, 'veg', 'RAINDROP SOUP(V)', '90', '90', 120, 0, 0),
(88, 'veg', 'SEA FOOD SPECIAL (CLEAR SOUP)', '120', '120', 128, 0, 0),
(89, 'veg', 'SWEET CORN SOUP (NV)', '110', '110', 113, 0, 0),
(90, 'veg', 'SWEET CORN SOUP (V)', '90', '90', 112, 0, 0),
(91, 'veg', 'TALUMIN SOUP (NV)', '110', '110', 119, 0, 0),
(92, 'veg', 'TALUMIN SOUP (V)', '90', '90', 118, 0, 0),
(93, 'veg', 'VEG CLEAR SOUP', '80', '80', 129, 0, 0),
(94, 'veg', 'ACHARI  BABY CORN TIKKA', '165', '165', 751, 0, 0),
(95, 'veg', 'BENDI FRY', '180', '180', 854, 0, 0),
(96, 'veg', 'CHICKEN SPRING ROLL WITH CHEESE', '225', '225', 825, 0, 0),
(97, 'veg', 'CORN CHAT', '160', '160', 899, 0, 0),
(98, 'veg', 'COTTAGE CHEESE WITH PEANUT SAUCE', '170', '170', 138, 0, 0),
(99, 'veg', 'CRIPSY ASSORTED VEGETABLES', '160', '160', 132, 0, 0),
(100, 'veg', 'CRIPSY HONEY POTATO', '160', '160', 134, 0, 0),
(101, 'veg', 'CRISPY FRIED BABYCORN', '160', '160', 137, 0, 0),
(102, 'veg', 'CRISPY GARLIC POTATO', '160', '160', 136, 0, 0),
(103, 'veg', 'DRAGON ROLL WITH CHEESE', '160', '160', 135, 0, 0),
(104, 'veg', 'EGG IN SHANGHAI SAUCE', '140', '140', 1063, 0, 0),
(105, 'veg', 'GOBI CHILLY', '150', '150', 877, 0, 0),
(106, 'veg', 'GOBI SCHEZWAN DRY', '150', '150', 140, 0, 0),
(107, 'veg', 'HONG KONG BABY CORN', '175', '175', 651, 0, 0),
(108, 'veg', 'LOBESTER IN OYESTER SAUCE', '8000', '8000', 588, 0, 0),
(109, 'veg', 'MURGH BUTTER GARLIC', '180', '180', 738, 0, 0),
(110, 'veg', 'MUSHROOM HONGKONG', '160', '160', 139, 0, 0),
(111, 'veg', 'PANEER NOODLES (V)', '160', '160', 658, 0, 0),
(112, 'veg', 'PANEER SCHEZWAN DRY', '190', '190', 757, 0, 0),
(113, 'veg', 'PRAWNS IN BLACK BEAN SAUCE', '350', '350', 479, 0, 0),
(114, 'veg', 'SHANGHAI COTTAGE CHEESE', '160', '160', 131, 0, 0),
(115, 'veg', 'SLICED CHICKEN IN GREEN SAUCE', '180', '180', 903, 0, 0),
(116, 'veg', 'SQUID', '350', '350', 782, 0, 0),
(117, 'veg', 'VEGETABLE  DAY  NIGHT', '160', '160', 133, 0, 0),
(118, 'veg', 'CHEES CORN NEGETS', '200', '200', 923, 0, 0),
(119, 'veg', 'CHICKEN SPRING ROLL', '175', '175', 147, 0, 0),
(120, 'veg', 'CHINESE PLATER (NV)', '500', '500', 1100, 0, 0),
(121, 'veg', 'EGG FRIED RICE WITH EXTRA EGG', '160', '160', 835, 0, 0),
(122, 'veg', 'FISH FRIED RICE', '280', '280', 1010, 0, 0),
(123, 'veg', 'HONG KONG CHICKEN', '175', '175', 145, 0, 0),
(124, 'veg', 'HONG KONG NOODLES WITH PRAWNS', '220', '220', 863, 0, 0),
(125, 'veg', 'HONG KONG STYLE', '160', '160', 645, 0, 0),
(126, 'veg', 'HUNAN CHICKEN', '175', '175', 144, 0, 0),
(127, 'veg', 'HUNAN CHILLI NOODLES[V]', '0', '0', 650, 0, 0),
(128, 'veg', 'MUTTON IN SAUCE', '290', '290', 142, 0, 0),
(129, 'veg', 'PRAWNS IN SAUCE', '250', '250', 143, 0, 0),
(130, 'veg', 'PRAWNS SCHEZWAN NOODLES', '300', '300', 917, 0, 0),
(131, 'veg', 'SINGAPORE NOODLES [NV]', '170', '170', 649, 0, 0),
(132, 'veg', 'SINGAPORE NOODLES [V]', '150', '150', 648, 0, 0),
(133, 'veg', 'SLICED CHICKEN IN CRUSH PEPPER', '180', '180', 146, 0, 0),
(134, 'veg', 'SLICED CHICKEN IN PEANUT BUTTER SAUCE', '180', '180', 365, 0, 0),
(135, 'veg', 'SLICED CHICKEN IN SAUCE', '160', '160', 141, 0, 0),
(136, 'veg', 'WINGS GHEE ROAST', '280', '280', 924, 0, 0),
(137, 'veg', 'CHILLI GARLIC MUSHROOM FRIED RICE(NV)', '170', '170', 181, 0, 0),
(138, 'veg', 'CHILLI GARLIC MUSHROOM FRIED RICE(V)', '150', '150', 180, 0, 0),
(139, 'veg', 'CHOPSUEY[AMERICAN/CHINENE] (NV)', '160', '160', 161, 0, 0),
(140, 'veg', 'CHOPSUEY[AMERICAN/CHINENE] (V)', '140', '140', 160, 0, 0),
(141, 'veg', 'CHOWMEIN (NV)', '180', '180', 163, 0, 0),
(142, 'veg', 'CHOWMEIN (V)', '140', '140', 162, 0, 0),
(143, 'veg', 'EGG FRIED RICE', '150', '150', 189, 0, 0),
(144, 'veg', 'GREEN PEAS PULAO', '160', '160', 345, 0, 0),
(145, 'veg', 'HONG KONG NOODLES (NV)', '150', '150', 165, 0, 0),
(146, 'veg', 'HONG KONG NOODLES (V)', '140', '140', 164, 0, 0),
(147, 'veg', 'HONGKONG FRIED RICE (NV)', '170', '170', 169, 0, 0),
(148, 'veg', 'HONGKONG FRIED RICE (V)', '150', '150', 168, 0, 0),
(149, 'veg', 'HUNAN CHILLI FRIED RICE(NV)', '170', '170', 177, 0, 0),
(150, 'veg', 'HUNAN CHILLI FRIED RICE(V)', '150', '150', 176, 0, 0),
(151, 'veg', 'HUNNAN CHILLI NOODLES (NV)', '160', '160', 167, 0, 0),
(152, 'veg', 'HUNNAN CHILLI NOODLES (V)', '140', '140', 166, 0, 0),
(153, 'veg', 'KADAI MURGH (BL)', '235', '235', 884, 0, 0),
(154, 'veg', 'LEMON GARLIC CHILLY NOODLES (NV)', '160', '160', 157, 0, 0),
(155, 'veg', 'LEMON GARLIC CHILLY NOODLES (V)', '140', '140', 156, 0, 0),
(156, 'veg', 'LEMON GARLIC FRIED RICE (NV)', '170', '170', 187, 0, 0),
(157, 'veg', 'LEMON GARLIC FRIED RICE (V)', '150', '150', 186, 0, 0),
(158, 'veg', 'MALAYSIAN NOODLES (NV)', '180', '180', 151, 0, 0),
(159, 'veg', 'MALAYSIAN NOODLES (V)', '160', '160', 150, 0, 0),
(160, 'veg', 'MIX FRIED RICE (NV)', '200', '200', 188, 0, 0),
(161, 'veg', 'MIX FRIED RICE (V)', '180', '180', 951, 0, 0),
(162, 'veg', 'MURGH MAKHANI (BL)', '255', '255', 888, 0, 0),
(163, 'veg', 'MUTTON KHEEMA MASALA', '330', '330', 394, 0, 0),
(164, 'veg', 'MUTTON MUSSALLAM FULL', '800', '800', 781, 0, 0),
(165, 'veg', 'NAZI KOREAN FRIED RICE(NV)', '170', '170', 173, 0, 0),
(166, 'veg', 'NAZI KOREAN FRIED RICE(V)', '150', '150', 172, 0, 0),
(167, 'veg', 'NAZI KOREAN NOODLES (NV)', '170', '170', 153, 0, 0),
(168, 'veg', 'NAZI KOREAN NOODLES (V)', '150', '150', 152, 0, 0),
(169, 'veg', 'PAN FRY NOODLES (NV)', '180', '180', 149, 0, 0),
(170, 'veg', 'PAN FRY NOODLES (V)', '160', '160', 148, 0, 0),
(171, 'veg', 'PECKING FRIED RICE (NV)', '170', '170', 175, 0, 0),
(172, 'veg', 'PECKING FRIED RICE (V)', '150', '150', 174, 0, 0),
(173, 'veg', 'PUNJABI BIRYANI', '160', '160', 740, 0, 0),
(174, 'veg', 'PUNJABI PULAO', '160', '160', 739, 0, 0),
(175, 'veg', 'SCHEZWAN FRIED RICE(NV)', '170', '170', 183, 0, 0),
(176, 'veg', 'SCHEZWAN FRIED RICE(V)', '150', '150', 182, 0, 0),
(177, 'veg', 'SHANGHAI FRIED RICE (NV)', '170', '170', 179, 0, 0),
(178, 'veg', 'SHANGHAI FRIED RICE (V)', '150', '150', 178, 0, 0),
(179, 'veg', 'SHANGHAI NOODLES (NV)', '160', '160', 159, 0, 0),
(180, 'veg', 'SHANGHAI NOODLES (V)', '140', '140', 158, 0, 0),
(181, 'veg', 'STEW FRIED RICE (NV)', '170', '170', 185, 0, 0),
(182, 'veg', 'STEW FRIED RICE (V)', '150', '150', 184, 0, 0),
(183, 'veg', 'THAI FRIED RICE (NV)', '170', '170', 171, 0, 0),
(184, 'veg', 'THAI FRIED RICE (V)', '150', '150', 170, 0, 0),
(185, 'veg', 'THAI NOODLES (NV)', '160', '160', 155, 0, 0),
(186, 'veg', 'THAI NOODLES (V)', '140', '140', 154, 0, 0),
(187, 'veg', 'AMRITSARI TIKKI', '180', '180', 845, 0, 0),
(188, 'veg', 'BAHAR-E -BABYCORN', '165', '165', 196, 0, 0),
(189, 'veg', 'CHICKEN TANDOORI LOLYPOP', '275', '275', 823, 0, 0),
(190, 'veg', 'DESI VIDESHI', '165', '165', 199, 0, 0),
(191, 'veg', 'HARA BHARA KABAB', '175', '175', 805, 0, 0),
(192, 'veg', 'KHUMB KHAZANA', '250', '250', 699, 0, 0),
(193, 'veg', 'KOTHMIRI SHEEKH', '175', '175', 191, 0, 0),
(194, 'veg', 'MAKAI MOTI SHEEKH', '175', '175', 192, 0, 0),
(195, 'veg', 'MURGH ACHARI TIKKA', '280', '280', 925, 0, 0),
(196, 'veg', 'MURGH BADAMI TIKKA', '265', '265', 905, 0, 0),
(197, 'veg', 'MURGH GULMOHAR SHEEK KABAB', '320', '320', 930, 0, 0),
(198, 'veg', 'MURGH HARIYALI TIKKA', '275', '275', 388, 0, 0),
(199, 'veg', 'MUTTON GHEE ROAST', '360', '360', 523, 0, 0),
(200, 'veg', 'PANEER HARIYALI TIKKA', '180', '180', 897, 0, 0),
(201, 'veg', 'PANEER MALAI SHEEKH', '175', '175', 195, 0, 0),
(202, 'veg', 'PANEER PESHAWARI', '175', '175', 198, 0, 0),
(203, 'veg', 'PANEER TIKKA LAL BAHADUR', '175', '175', 194, 0, 0),
(204, 'veg', 'PANEER TIRANGA TIKKA', '195', '195', 193, 0, 0),
(205, 'veg', 'PHALDHARI VEGETABLE', '175', '175', 197, 0, 0),
(206, 'veg', 'RED SNAPPER', '1500', '1500', 956, 0, 0),
(207, 'veg', 'ROJALI KABAB', '280', '280', 850, 0, 0),
(208, 'veg', 'SHAAN-E-ALOO', '160', '160', 190, 0, 0),
(209, 'veg', 'SHAHI CAPSICUM (V)', '250', '250', 1024, 0, 0),
(210, 'veg', 'SHANGHAI BABY CORN', '160', '160', 687, 0, 0),
(211, 'veg', 'TANDOOR KNG FISH', '900', '900', 779, 0, 0),
(212, 'veg', 'BABY KING FISH CURRY', '450', '450', 1067, 0, 0),
(213, 'veg', 'CARET KABAB', '200', '200', 879, 0, 0),
(214, 'veg', 'CHICKEN 65', '200', '200', 809, 0, 0),
(215, 'veg', 'DAHI KI TIKKI', '285', '285', 203, 0, 0),
(216, 'veg', 'GOLDEN FRIED PRAWNS', '350', '350', 673, 0, 0),
(217, 'veg', 'KALMI KABAB 1 PIESE', '100', '100', 742, 0, 0),
(218, 'veg', 'MURGH DRY FRY', '225', '225', 683, 0, 0),
(219, 'veg', 'MURGH IRANI KABAB', '350', '350', 984, 0, 0),
(220, 'veg', 'MURGH SESMI KABAB', '290', '290', 911, 0, 0),
(221, 'veg', 'OYE SHAWA KHAS-E-DAWAT (V)', '550', '550', 200, 0, 0),
(222, 'veg', 'SEV KI TIKKI', '160', '160', 201, 0, 0),
(223, 'veg', 'STUFFED CAPSICUM (NV)', '220', '220', 1033, 0, 0),
(224, 'veg', 'TONA FISH', '800', '800', 817, 0, 0),
(225, 'veg', 'VEGETARIAN KURKURE', '170', '170', 202, 0, 0),
(226, 'veg', 'AMRITSARI MACHALI', '350', '350', 224, 0, 0),
(227, 'veg', 'ANJAAL TAWA FRY', '0', '0', 223, 0, 0),
(228, 'veg', 'BABY KING FISH 2PC', '500', '500', 533, 0, 0),
(229, 'veg', 'BANGADA', '150', '150', 222, 0, 0),
(230, 'veg', 'BARKOT RAWA FRY', '250', '250', 788, 0, 0),
(231, 'veg', 'BLACK POMFRET', '300', '300', 532, 0, 0),
(232, 'veg', 'BLACK POMFRET BIG', '700', '700', 644, 0, 0),
(233, 'veg', 'BOMBAY DUCK', '350', '350', 1000, 0, 0),
(234, 'veg', 'BOMBIL RAWA FRY', '400', '400', 1002, 0, 0),
(235, 'veg', 'BUTTER FISH TAWA FRY', '300', '300', 221, 0, 0),
(236, 'veg', 'CRAB 1PC', '150', '150', 509, 0, 0),
(237, 'veg', 'FISH KOLIWADA', '0', '0', 225, 0, 0),
(238, 'veg', 'FISH MANCHURI', '350', '350', 833, 0, 0),
(239, 'veg', 'FISH MASALA', '350', '350', 786, 0, 0),
(240, 'veg', 'FISH MASALA FULL', '700', '700', 609, 0, 0),
(241, 'veg', 'FISH PLATTER', '1200', '1200', 815, 0, 0),
(242, 'veg', 'FISH TIKKA MASALA', '380', '380', 468, 0, 0),
(243, 'veg', 'GOBRA FISH', '1000', '1000', 1001, 0, 0),
(244, 'veg', 'HARA MUTTON CHOPS', '300', '300', 208, 0, 0),
(245, 'veg', 'KING FISH', '350', '350', 230, 0, 0),
(246, 'veg', 'LEMON GRASS TIKKA', '255', '255', 209, 0, 0),
(247, 'veg', 'LOBSTER', '8000', '8000', 816, 0, 0),
(248, 'veg', 'MURG DOHRASHEEK KABAB', '275', '275', 205, 0, 0),
(249, 'veg', 'MURG GULAB -E-SHEEK', '265', '265', 206, 0, 0),
(250, 'veg', 'MURG NAINITAL KABAB', '255', '255', 212, 0, 0),
(251, 'veg', 'MURG SOJA SHAHI KABAB', '275', '275', 204, 0, 0),
(252, 'veg', 'MURGH CHATPATA', '210', '210', 214, 0, 0),
(253, 'veg', 'MURGH URWAL', '215', '215', 215, 0, 0),
(254, 'veg', 'MUTTON DHOOANDHAR BOTI', '335', '335', 207, 0, 0),
(255, 'veg', 'MUTTON SUKKHA', '310', '310', 456, 0, 0),
(256, 'veg', 'MUTTON TAWA HARA PYAZA', '335', '335', 217, 0, 0),
(257, 'veg', 'OYE SHAWA KHAS-E-DAWAT (NV)', '750', '750', 218, 0, 0),
(258, 'veg', 'POMFRET CURRY', '500', '500', 758, 0, 0),
(259, 'veg', 'POMFRET CURRY', '500', '500', 801, 0, 0),
(260, 'veg', 'POMFRET TAWA FRY', '250', '250', 219, 0, 0),
(261, 'veg', 'PRAWNS TAWA FRY', '300', '300', 220, 0, 0),
(262, 'veg', 'RAWAS CURRY', '500', '500', 1127, 0, 0),
(263, 'veg', 'RED SNAPPER CURRY', '400', '400', 813, 0, 0),
(264, 'veg', 'SALMON FISH', '800', '800', 1003, 0, 0),
(265, 'veg', 'SHOLA KA MURG', '275', '275', 210, 0, 0),
(266, 'veg', 'SHOLAY KABAB', '265', '265', 213, 0, 0),
(267, 'veg', 'SLICED KING FISH 1PC', '225', '225', 997, 0, 0),
(268, 'veg', 'SONAM FISH', '1000', '1000', 819, 0, 0),
(269, 'veg', 'SQUID GHEE ROST', '250', '250', 792, 0, 0),
(270, 'veg', 'TANDOOR KING FISH', '2200', '2200', 556, 0, 0),
(271, 'veg', 'TANGRI MUMTAJ', '300', '300', 211, 0, 0),
(272, 'veg', 'TAWA MUTTON DRY FRY', '310', '310', 216, 0, 0),
(273, 'veg', 'TIGER PRAWNS', '1000', '1000', 814, 0, 0),
(274, 'veg', 'TIGER PRAWNS MAHARAJA', '600', '600', 996, 0, 0),
(275, 'veg', 'TUNA FISH', '500', '500', 998, 0, 0),
(276, 'veg', 'WHITE POMFRET', '700', '700', 999, 0, 0),
(277, 'veg', 'BANGDA', '0', '0', 231, 0, 0),
(278, 'veg', 'BUTTER FISH', '0', '0', 229, 0, 0),
(279, 'veg', 'CRAB 2 PS', '300', '300', 232, 0, 0),
(280, 'veg', 'DAL DOUBLE TADKA', '135', '135', 243, 0, 0),
(281, 'veg', 'DAL MAKHANI', '185', '185', 241, 0, 0),
(282, 'veg', 'DAL PALAK', '135', '135', 244, 0, 0),
(283, 'veg', 'DAL PANCHARANGI', '145', '145', 242, 0, 0),
(284, 'veg', 'GREEN SAUCE', '0', '0', 234, 0, 0),
(285, 'veg', 'LADY FISH', '500', '500', 227, 0, 0),
(286, 'veg', 'LASOONI PALAK', '180', '180', 1112, 0, 0),
(287, 'veg', 'PINDI CHOLE', '185', '185', 237, 0, 0),
(288, 'veg', 'PRAWNS', '400', '400', 228, 0, 0),
(289, 'veg', 'RANI FISH', '800', '800', 1004, 0, 0),
(290, 'veg', 'RED SAUCE', '0', '0', 233, 0, 0),
(291, 'veg', 'SARSON KA SAAG', '165', '165', 238, 0, 0),
(292, 'veg', 'TANDOOR POMFRET', '550', '550', 226, 0, 0),
(293, 'veg', 'TAWA PANEER', '185', '185', 239, 0, 0),
(294, 'veg', 'TAWA SUBJI KI BAHAR', '185', '185', 240, 0, 0),
(295, 'veg', 'VEG PATIYALA', '200', '200', 586, 0, 0),
(296, 'veg', 'WHITE SAUCE', '0', '0', 236, 0, 0),
(297, 'veg', 'YELLOW SAUCE', '0', '0', 235, 0, 0),
(298, 'veg', 'CHICKEN GRAVY', '80', '80', 794, 0, 0),
(299, 'veg', 'ENGLISH BHAJI DESHI TADKA', '180', '180', 253, 0, 0),
(300, 'veg', 'HARI MAKAI KHAS', '175', '175', 254, 0, 0),
(301, 'veg', 'JAFRANI KOFTA', '190', '190', 245, 0, 0),
(302, 'veg', 'KABULI CHANNA MASALA', '165', '165', 247, 0, 0),
(303, 'veg', 'KADAI MURGH', '215', '215', 266, 0, 0),
(304, 'veg', 'LAGAAN KI SABZI', '165', '165', 252, 0, 0),
(305, 'veg', 'MURG NAINITAL KOFTA', '215', '215', 268, 0, 0),
(306, 'veg', 'MURGH  MUSSALLAM SPECIAL', '450', '450', 974, 0, 0),
(307, 'veg', 'MURGH BADAMI', '215', '215', 259, 0, 0),
(308, 'veg', 'MURGH HANDI', '215', '215', 267, 0, 0),
(309, 'veg', 'MURGH HANDI (HALF)', '150', '150', 1078, 0, 0),
(310, 'veg', 'MURGH KHEEMA MASALA (FULL)', '450', '450', 1133, 0, 0),
(311, 'veg', 'MURGH KHURCHAN', '245', '245', 265, 0, 0),
(312, 'veg', 'MURGH LABABDAR', '225', '225', 264, 0, 0),
(313, 'veg', 'MURGH MAKHANI', '235', '235', 263, 0, 0),
(314, 'veg', 'MURGH MUGHALAI', '225', '225', 260, 0, 0),
(315, 'veg', 'MURGH MUGHLAI', '225', '225', 671, 0, 0),
(316, 'veg', 'MURGH MUSSALAM SPECIAL', '1500', '1500', 818, 0, 0),
(317, 'veg', 'MURGH PYAAZ KA SALAN', '235', '235', 261, 0, 0),
(318, 'veg', 'MURGH SAAG WALA', '245', '245', 262, 0, 0),
(319, 'veg', 'MUSHROOM HARA SAAG', '165', '165', 249, 0, 0),
(320, 'veg', 'MUSHROOM TAKATIN', '175', '175', 246, 0, 0),
(321, 'veg', 'MUTTON KOLHAPURI', '300', '300', 795, 0, 0),
(322, 'veg', 'PANEER KOTHAMARI KOFTA', '175', '175', 256, 0, 0),
(323, 'veg', 'PANEER KURCHAN', '175', '175', 255, 0, 0),
(324, 'veg', 'PANEER PASANDA', '175', '175', 258, 0, 0),
(325, 'veg', 'PANEER TIKKA LABABDAR', '175', '175', 257, 0, 0),
(326, 'veg', 'SABZI MILONI', '165', '165', 251, 0, 0),
(327, 'veg', 'SHABNAM CURRY', '165', '165', 250, 0, 0),
(328, 'veg', 'SUBZI ZAYKEDAR', '180', '180', 248, 0, 0),
(329, 'veg', 'BOONDI RAITA', '100', '100', 280, 0, 0),
(330, 'veg', 'CHEES CHERRY PINEAPPLE', '150', '150', 672, 0, 0),
(331, 'veg', 'CUCUMBER RAITA', '100', '100', 281, 0, 0),
(332, 'veg', 'FRESH VEGETABLES RAITA', '120', '120', 282, 0, 0),
(333, 'veg', 'FRIUT TRAIFFLE', '120', '120', 822, 0, 0),
(334, 'veg', 'GOSHT KORMA', '340', '340', 278, 0, 0),
(335, 'veg', 'MURGH DHANIYA ADRAKI', '215', '215', 269, 0, 0),
(336, 'veg', 'MURGH KHEEMA MASALA', '225', '225', 271, 0, 0),
(337, 'veg', 'MURGH KORMA', '245', '245', 272, 0, 0),
(338, 'veg', 'MURGH MUSSALLAM (FULL)', '485', '485', 274, 0, 0),
(339, 'veg', 'MURGH MUSSALLAM (HALF)', '285', '285', 273, 0, 0),
(340, 'veg', 'MURGH PATIYALA', '265', '265', 270, 0, 0),
(341, 'veg', 'MUTTON BHUNA GOSHT', '335', '335', 277, 0, 0),
(342, 'veg', 'MUTTON MUGHLAI', '345', '345', 279, 0, 0),
(343, 'veg', 'MUTTON ROGAN JOSH', '355', '355', 275, 0, 0),
(344, 'veg', 'PINEAPPLE RAITA', '120', '120', 283, 0, 0),
(345, 'veg', 'SAAG GOSHT', '350', '350', 276, 0, 0),
(346, 'veg', 'CHINESE SALAD', '110', '110', 289, 0, 0),
(347, 'veg', 'CUCUMBER RING SALAD', '90', '90', 285, 0, 0),
(348, 'veg', 'ENGLISH HEALTHY SALAD', '150', '150', 287, 0, 0),
(349, 'veg', 'GREEK SALAD', '150', '150', 286, 0, 0),
(350, 'veg', 'GREEN SALAD', '70', '70', 284, 0, 0),
(351, 'veg', 'KIM CHI SALAD', '110', '110', 288, 0, 0),
(352, 'veg', 'FRIED PAPAD', '30', '30', 291, 0, 0),
(353, 'veg', 'MASALA CHAT', '30', '30', 1093, 0, 0),
(354, 'veg', 'MASALA PAPAD', '50', '50', 292, 0, 0),
(355, 'veg', 'ROASTED BUTTER PAPAD', '30', '30', 756, 0, 0),
(356, 'veg', 'ROASTED PAPAD', '20', '20', 290, 0, 0),
(357, 'veg', 'BUTTER CHEES GARLIC NAAN', '85', '85', 866, 0, 0),
(358, 'veg', 'CHAPATI', '15', '15', 771, 0, 0),
(359, 'veg', 'CHEES NAAN EXTRA CHEES', '75', '75', 846, 0, 0),
(360, 'veg', 'HARI MIRCH KI ROTI', '30', '30', 299, 0, 0),
(361, 'veg', 'HARI MIRCH KI ROTI BUTTER', '35', '35', 300, 0, 0),
(362, 'veg', 'KASHMIRI NAAN', '120', '120', 319, 0, 0),
(363, 'veg', 'KASHMIRI NAAN (BUTTER)', '125', '125', 320, 0, 0),
(364, 'veg', 'KHASTA ROTI', '30', '30', 297, 0, 0),
(365, 'veg', 'KHASTA ROTI BUTTER', '35', '35', 298, 0, 0),
(366, 'veg', 'KULCHA', '30', '30', 303, 0, 0),
(367, 'veg', 'KULCHA BUTTER', '35', '35', 304, 0, 0),
(368, 'veg', 'LACHA PARATHA', '35', '35', 311, 0, 0),
(369, 'veg', 'LACHA PARATHA BUTTER', '40', '40', 312, 0, 0),
(370, 'veg', 'MAKAI KI ROTI', '30', '30', 301, 0, 0),
(371, 'veg', 'MAKAI KI ROTI BUTTER', '35', '35', 302, 0, 0),
(372, 'veg', 'METHI KULCHA', '30', '30', 307, 0, 0),
(373, 'veg', 'METHI KULCHA BUTTER', '35', '35', 308, 0, 0),
(374, 'veg', 'MISSI ROTI', '30', '30', 295, 0, 0),
(375, 'veg', 'MISSI ROTI BUUTER', '35', '35', 296, 0, 0),
(376, 'veg', 'MIX VEGETABLE PARATHA', '100', '100', 784, 0, 0),
(377, 'veg', 'PARATHA', '40', '40', 313, 0, 0),
(378, 'veg', 'PARATHA BUTTER', '45', '45', 314, 0, 0),
(379, 'veg', 'PESHAWARI KULCHA BUTTER', '105', '105', 310, 0, 0),
(380, 'veg', 'PUDINA KA KULCHA', '30', '30', 305, 0, 0),
(381, 'veg', 'PUDINA KA KULCHA BUTTER', '35', '35', 306, 0, 0),
(382, 'veg', 'ROTI KI TOKRI (BREAD BASKET)', '170', '170', 321, 0, 0),
(383, 'veg', 'BUTTER ROTI', '25', '25', 294, 0, 0),
(384, 'veg', 'CHEESE NAAN', '100', '100', 318, 0, 0),
(385, 'veg', 'CHI STUFF PARATHA', '120', '120', 744, 0, 0),
(386, 'veg', 'GOBI PARATHA', '80', '80', 783, 0, 0),
(387, 'veg', 'HARI MIRCH KI ROTI WITH EXTRA CHEES', '55', '55', 1007, 0, 0),
(388, 'veg', 'LASUNI NAAN', '80', '80', 317, 0, 0),
(389, 'veg', 'METHI BUTTER PARATHA', '45', '45', 741, 0, 0),
(390, 'veg', 'NAAN', '30', '30', 315, 0, 0),
(391, 'veg', 'NAAN BUTTER', '35', '35', 316, 0, 0),
(392, 'veg', 'PANEER PARATHA', '80', '80', 785, 0, 0),
(393, 'veg', 'PESHAWARI KULCHA', '60', '60', 309, 0, 0),
(394, 'veg', 'SPROUT SALAD', '100', '100', 1008, 0, 0),
(395, 'veg', 'TANDOORI ROTI', '20', '20', 293, 0, 0),
(396, 'veg', 'BOTTLED WATER 2LTR', '30', '30', 503, 0, 0),
(397, 'veg', 'CHICKEN GHEE ROST', '280', '280', 527, 0, 0),
(398, 'veg', 'MURGH AFGHANI TIKKA', '280', '280', 1099, 0, 0),
(399, 'veg', 'TANDOORI VEG HYEDRABADI BIRYANI', '200', '200', 1031, 0, 0),
(400, 'veg', 'AERATED DRINKS 2LTR', '120', '120', 520, 0, 0),
(401, 'veg', 'AERATED DRINKS 750ML', '60', '60', 510, 0, 0),
(402, 'veg', 'AFGANI KABAB 1PC', '50', '50', 1020, 0, 0),
(403, 'veg', 'AFGANI PANEER', '175', '175', 1103, 0, 0),
(404, 'veg', 'ALOO BRINGAL MASALA', '175', '175', 867, 0, 0),
(405, 'veg', 'ALOO CHAT', '100', '100', 714, 0, 0),
(406, 'veg', 'ALOO GOBI', '175', '175', 646, 0, 0),
(407, 'veg', 'ALOO MUTTER', '180', '180', 478, 0, 0),
(408, 'veg', 'ALOO MUTTER PANEER', '200', '200', 1014, 0, 0),
(409, 'veg', 'ALOO PALAK', '180', '180', 912, 0, 0),
(410, 'veg', 'ALU KA PARATHA', '80', '80', 416, 0, 0),
(411, 'veg', 'AMRITSARI TIKKI', '200', '200', 859, 0, 0),
(412, 'veg', 'APPLE', '100', '100', 798, 0, 0),
(413, 'veg', 'APPLE AND PAPAYA CHAT', '120', '120', 715, 0, 0),
(414, 'veg', 'APPLE DRINK', '70', '70', 843, 0, 0),
(415, 'veg', 'APPLE MILK SHAKE', '100', '100', 752, 0, 0),
(416, 'veg', 'BABY CORN CHILLY', '160', '160', 474, 0, 0),
(417, 'veg', 'BABY CORN IN BARBEQUE SAUCE', '180', '180', 1123, 0, 0),
(418, 'veg', 'BABY CORN IN GREEN SAUCE', '160', '160', 1096, 0, 0),
(419, 'veg', 'BABY CORN IN OYESTER SAUCE', '160', '160', 635, 0, 0),
(420, 'veg', 'BABY CORN MASALA', '170', '170', 577, 0, 0),
(421, 'veg', 'BABY CORN SCHEZWAN', '180', '180', 1041, 0, 0),
(422, 'veg', 'BABYCORN AMRITHSARI', '170', '170', 466, 0, 0),
(423, 'veg', 'BABYCORN MANCHURI', '160', '160', 519, 0, 0),
(424, 'veg', 'BASA FISH BUTTER GARLIC', '350', '350', 797, 0, 0),
(425, 'veg', 'BASA FISH CURRY', '400', '400', 470, 0, 0),
(426, 'veg', 'BASA FISH TIKKA', '350', '350', 745, 0, 0),
(427, 'veg', 'BASMATI CHAWAL', '90', '90', 323, 0, 0),
(428, 'veg', 'BASMATI CHAWAL HALF', '50', '50', 438, 0, 0),
(429, 'veg', 'BHATURA', '50', '50', 748, 0, 0),
(430, 'veg', 'BHENDI FRY', '120', '120', 755, 0, 0),
(431, 'veg', 'BHUTTE ANGARI SALAD', '70', '70', 718, 0, 0),
(432, 'veg', 'BLACK SNAPPER', '1200', '1200', 820, 0, 0),
(433, 'veg', 'BLUE CURACAO SODA', '80', '80', 453, 0, 0),
(434, 'veg', 'BLUE CURACAO WATER', '70', '70', 653, 0, 0),
(435, 'veg', 'BOILED CHICKEN', '160', '160', 765, 0, 0),
(436, 'veg', 'BOILED EGG', '40', '40', 408, 0, 0),
(437, 'veg', 'BOILED VEG', '130', '130', 686, 0, 0),
(438, 'veg', 'BOTLED SODA 750ML', '30', '30', 562, 0, 0),
(439, 'veg', 'BOTTLED APPLE DRINKS', '20', '20', 844, 0, 0),
(440, 'veg', 'BOTTLED WATER', '30', '30', 1130, 0, 0),
(441, 'veg', 'BRINGAL MASALA', '180', '180', 890, 0, 0),
(442, 'veg', 'BURNT GARLIC FRIED RICE (V)', '160', '160', 1036, 0, 0),
(443, 'veg', 'BUTTER', '30', '30', 558, 0, 0),
(444, 'veg', 'BUTTER CHICKEN FULL', '520', '520', 567, 0, 0),
(445, 'veg', 'BUTTER GARLIC NAAN', '100', '100', 364, 0, 0),
(446, 'veg', 'BUTTER GARLIC PRAWNS', '350', '350', 660, 0, 0),
(447, 'veg', 'BUTTER GARLIC ROTI', '55', '55', 1052, 0, 0),
(448, 'veg', 'BUTTER MILK  HALF', '80', '80', 1018, 0, 0),
(449, 'veg', 'BUTTER MILK PLAIN', '100', '100', 688, 0, 0),
(450, 'veg', 'BUTTER ROTI', '25', '25', 979, 0, 0),
(451, 'veg', 'CAPSICUM MASALA', '150', '150', 874, 0, 0),
(452, 'veg', 'CASHEWNUT MASALA', '220', '220', 472, 0, 0),
(453, 'veg', 'CHANA CHAT MASALA', '120', '120', 965, 0, 0),
(454, 'veg', 'CHAT SALAD', '40', '40', 1077, 0, 0),
(455, 'veg', 'CHEES BUTTER NAAN', '50', '50', 603, 0, 0),
(456, 'veg', 'CHEES CUBES', '50', '50', 611, 0, 0),
(457, 'veg', 'CHEES PEAS MASALA', '210', '210', 1082, 0, 0),
(458, 'veg', 'CHEESE GARLIC NAAN', '110', '110', 434, 0, 0),
(459, 'veg', 'CHEESE KURKURE SPCL', '220', '220', 1066, 0, 0),
(460, 'veg', 'CHEESE PARATHA', '80', '80', 958, 0, 0),
(461, 'veg', 'CHEESE PEANUT KURKURE', '170', '170', 383, 0, 0),
(462, 'veg', 'CHEESE STUFFING POTATO', '180', '180', 1057, 0, 0),
(463, 'veg', 'CHEF SPCL CHUM CHUM', '120', '120', 733, 0, 0),
(464, 'veg', 'CHEF SPCL VEG', '200', '200', 524, 0, 0),
(465, 'veg', 'CHEF SPECIAL', '500', '500', 754, 0, 0),
(466, 'veg', 'CHEFS SPECIAL', '350', '350', 625, 0, 0),
(467, 'veg', 'CHI BIRYANI BONE LESS', '220', '220', 605, 0, 0),
(468, 'veg', 'CHI BIRYANI TANDOORI', '240', '240', 598, 0, 0),
(469, 'veg', 'CHI HYRDRBADI', '220', '220', 793, 0, 0),
(470, 'veg', 'CHI KHEEMA PARATHA', '130', '130', 987, 0, 0),
(471, 'veg', 'CHI LASUNI TIKKA', '285', '285', 826, 0, 0),
(472, 'veg', 'CHI MUGHLAI DUM BIRYANI', '240', '240', 791, 0, 0),
(473, 'veg', 'CHI PESHAWARI TIKKA', '280', '280', 596, 0, 0),
(474, 'veg', 'CHIC CHETTINAD', '250', '250', 1038, 0, 0),
(475, 'veg', 'CHIC CHINESE PLATTER', '470', '470', 982, 0, 0),
(476, 'veg', 'CHIC OYE SHAWA SPCL TIKKA', '400', '400', 983, 0, 0),
(477, 'veg', 'CHICKEN AMERICAN CHOUPSEY', '200', '200', 396, 0, 0),
(478, 'veg', 'CHICKEN BANJARA KABAB', '265', '265', 880, 0, 0),
(479, 'veg', 'CHICKEN BIRYANI 1KG', '750', '750', 914, 0, 0),
(480, 'veg', 'CHICKEN CHINA TOWN', '240', '240', 1048, 0, 0),
(481, 'veg', 'CHICKEN CRISPY', '160', '160', 376, 0, 0),
(482, 'veg', 'CHICKEN FRANKIE', '180', '180', 1073, 0, 0),
(483, 'veg', 'CHICKEN FRIED KABAB', '160', '160', 770, 0, 0),
(484, 'veg', 'CHICKEN FRIED RICE', '160', '160', 381, 0, 0),
(485, 'veg', 'CHICKEN FRIED RICE WITH GRAVY', '210', '210', 931, 0, 0),
(486, 'veg', 'CHICKEN HAKKA NOODLES', '170', '170', 386, 0, 0),
(487, 'veg', 'CHICKEN IN BARBQUE SAUCE', '220', '220', 975, 0, 0),
(488, 'veg', 'CHICKEN IN HOISIN SAUCE', '160', '160', 375, 0, 0),
(489, 'veg', 'CHICKEN IN HOISIN SAUCE', '180', '180', 495, 0, 0),
(490, 'veg', 'CHICKEN KAFRIAL', '310', '310', 963, 0, 0),
(491, 'veg', 'CHICKEN KOLAPURI', '215', '215', 441, 0, 0),
(492, 'veg', 'CHICKEN KOLAPURI BL', '235', '235', 638, 0, 0),
(493, 'veg', 'CHICKEN KOLAPURI FULL', '485', '485', 1005, 0, 0),
(494, 'veg', 'CHICKEN KOLAPURI FULL (BL)', '515', '515', 957, 0, 0),
(495, 'veg', 'CHICKEN LOLYPOP', '200', '200', 537, 0, 0),
(496, 'veg', 'CHICKEN LOLYPOP 1PC', '40', '40', 1022, 0, 0),
(497, 'veg', 'CHICKEN LOLYPOP GHEE ROST', '320', '320', 946, 0, 0),
(498, 'veg', 'CHICKEN LOLYPOP HALF', '100', '100', 802, 0, 0),
(499, 'veg', 'CHICKEN MALAI KABAB', '265', '265', 545, 0, 0),
(500, 'veg', 'CHICKEN MALAI TIKKA', '275', '275', 395, 0, 0),
(501, 'veg', 'CHICKEN MANCHURI WITH GRAVY', '230', '230', 415, 0, 0),
(502, 'veg', 'CHICKEN MANCHURIAN', '180', '180', 440, 0, 0),
(503, 'veg', 'CHICKEN RARA', '230', '230', 1070, 0, 0),
(504, 'veg', 'CHICKEN RESHMI KABAB', '275', '275', 450, 0, 0),
(505, 'veg', 'CHICKEN SILVER PAPER', '280', '280', 540, 0, 0),
(506, 'veg', 'CHICKEN SLICED IN SOYA SAUCE', '180', '180', 391, 0, 0),
(507, 'veg', 'CHICKEN SWEET IN SOUR', '170', '170', 589, 0, 0),
(508, 'veg', 'CHICKEN TIKKA MASALA', '275', '275', 407, 0, 0),
(509, 'veg', 'CHICKEN TIRANGA MASALA', '300', '300', 921, 0, 0),
(510, 'veg', 'CHICKEN TIRANGA TIKKA', '280', '280', 920, 0, 0),
(511, 'veg', 'CHICKEN VINGS', '320', '320', 962, 0, 0),
(512, 'veg', 'CHICKEN WINGS', '270', '270', 750, 0, 0),
(513, 'veg', 'CHILLY CHICKEN', '190', '190', 378, 0, 0),
(514, 'veg', 'CHILLY CHICKEN WITH GRAVY', '220', '220', 1035, 0, 0),
(515, 'veg', 'CHILLY FRY', '40', '40', 557, 0, 0),
(516, 'veg', 'CHINISE SAUCE', '60', '60', 1091, 0, 0),
(517, 'veg', 'CHOCO TROPI', '100', '100', 943, 0, 0),
(518, 'veg', 'CHOICE OF STUFFED, KULCHA,NAAN,PARATHA', '70', '70', 806, 0, 0),
(519, 'veg', 'CHOLE', '125', '125', 747, 0, 0),
(520, 'veg', 'CHOLE BHATURA', '175', '175', 723, 0, 0),
(521, 'veg', 'CHOPS', '500', '500', 659, 0, 0),
(522, 'veg', 'CHOWMIN NOODLES (NV)', '160', '160', 594, 0, 0),
(523, 'veg', 'CHOWMIN NOODLES (V)', '140', '140', 593, 0, 0),
(524, 'veg', 'COFFE', '10', '10', 907, 0, 0),
(525, 'veg', 'CORN PULAO', '160', '160', 664, 0, 0),
(526, 'veg', 'CORN TEMPOR SPCL', '250', '250', 994, 0, 0),
(527, 'veg', 'COTTAGE CHEES WITH GREEN SAUCE', '170', '170', 1009, 0, 0),
(528, 'veg', 'CRAB', '400', '400', 787, 0, 0),
(529, 'veg', 'CRAB SUKKHA MASALA', '200', '200', 610, 0, 0),
(530, 'veg', 'CREAM OF ENGLISH VEG', '100', '100', 1120, 0, 0),
(531, 'veg', 'CREAM OF PALAK', '90', '90', 768, 0, 0),
(532, 'veg', 'CREAM OF VEG SOUP', '90', '90', 530, 0, 0),
(533, 'veg', 'CRISPY ASSORTED VEG', '0', '0', 483, 0, 0),
(534, 'veg', 'CRISPY CHICKEN', '180', '180', 1118, 0, 0),
(535, 'veg', 'CRISPY CORN & PEPPER DRY', '160', '160', 535, 0, 0),
(536, 'veg', 'CRISPY FRIED CHLLY', '160', '160', 853, 0, 0),
(537, 'veg', 'CRISPY FRIED THAI BABY CORN', '180', '180', 552, 0, 0),
(538, 'veg', 'CUPSICUM MASALA', '150', '150', 873, 0, 0),
(539, 'veg', 'CURD RICE', '100', '100', 325, 0, 0),
(540, 'veg', 'CURD RICE WITH TADKA', '120', '120', 827, 0, 0),
(541, 'veg', 'D', '0', '0', 1259, 0, 0),
(542, 'veg', 'DAHI KI TIKKI 1PS', '75', '75', 621, 0, 0),
(543, 'veg', 'DAHI KI TIKKI 2PS', '140', '140', 639, 0, 0),
(544, 'veg', 'DAL GHOST KHICHADI', '320', '320', 927, 0, 0),
(545, 'veg', 'DAL GOSH CHICKEN', '170', '170', 778, 0, 0),
(546, 'veg', 'DAL GOSH MUTTON', '250', '250', 505, 0, 0),
(547, 'veg', 'DAL GOST MUTTON FULL', '350', '350', 988, 0, 0),
(548, 'veg', 'DAL KHICHADI', '140', '140', 328, 0, 0),
(549, 'veg', 'DAL KOLAPURI', '140', '140', 427, 0, 0),
(550, 'veg', 'DAL MAKHANI', '0', '0', 485, 0, 0),
(551, 'veg', 'DAL METHI', '150', '150', 916, 0, 0),
(552, 'veg', 'DAL PUNJABI', '150', '150', 724, 0, 0),
(553, 'veg', 'DAL TADKA WITH GHEE', '150', '150', 986, 0, 0),
(554, 'veg', 'DRAGON ROLL WITH CHEES CHICKEN', '220', '220', 829, 0, 0),
(555, 'veg', 'DRUMS OF HAVEN', '350', '350', 526, 0, 0),
(556, 'veg', 'DRY FRUITS', '75', '75', 1086, 0, 0),
(557, 'veg', 'DUDH FENI', '80', '80', 1258, 0, 0),
(558, 'veg', 'DUDHI FENI', '80', '80', 1260, 0, 0),
(559, 'veg', 'DUDHI HALWA', '80', '80', 1261, 0, 0),
(560, 'veg', 'EGG 65', '160', '160', 1085, 0, 0),
(561, 'veg', 'EGG BHURJI', '80', '80', 399, 0, 0),
(562, 'veg', 'EGG BIRYANI', '180', '180', 370, 0, 0),
(563, 'veg', 'EGG BURJI', '80', '80', 429, 0, 0),
(564, 'veg', 'EGG BURNT GARLIC FRIED RICE', '180', '180', 1037, 0, 0),
(565, 'veg', 'EGG CHILLY', '180', '180', 398, 0, 0),
(566, 'veg', 'EGG CURRY', '160', '160', 531, 0, 0),
(567, 'veg', 'EGG HAKKA NOODLES', '150', '150', 439, 0, 0),
(568, 'veg', 'EGG HALF FRY', '50', '50', 420, 0, 0),
(569, 'veg', 'EGG HONG KONG', '140', '140', 578, 0, 0),
(570, 'veg', 'EGG HONG KONG NOODLES', '150', '150', 762, 0, 0),
(571, 'veg', 'EGG HYDERABADI BIRYANI', '180', '180', 587, 0, 0),
(572, 'veg', 'EGG HYDRABADI', '160', '160', 418, 0, 0),
(573, 'veg', 'EGG IN GREEN SAUCE', '140', '140', 549, 0, 0),
(574, 'veg', 'EGG KAFRAIL', '200', '200', 993, 0, 0),
(575, 'veg', 'EGG KOLAPURI', '190', '190', 517, 0, 0),
(576, 'veg', 'EGG LEMON GARLIC CHILLY NOODLES', '160', '160', 952, 0, 0),
(577, 'veg', 'EGG MANCHURI', '160', '160', 459, 0, 0),
(578, 'veg', 'EGG MASALA EXTRA  EGGS', '200', '200', 1090, 0, 0),
(579, 'veg', 'EGG PAKODA', '180', '180', 871, 0, 0),
(580, 'veg', 'EGG SCHEZWAN FRIED RICE', '160', '160', 397, 0, 0),
(581, 'veg', 'EGG SCHEZWAN NOODLES', '150', '150', 413, 0, 0),
(582, 'veg', 'EGG SHANGHAI FRIED RICE', '160', '160', 1016, 0, 0),
(583, 'veg', 'EGG SUKKHA MASALA', '140', '140', 652, 0, 0),
(584, 'veg', 'EGG TANDOORI BIRYANI', '180', '180', 837, 0, 0),
(585, 'veg', 'EGG TANDOORI BIRYANI', '180', '180', 902, 0, 0),
(586, 'veg', 'ENGLISH MANCHURI', '180', '180', 1098, 0, 0),
(587, 'veg', 'ENGLISH VEG CHILLY', '220', '220', 1108, 0, 0),
(588, 'veg', 'FINGER FISH', '300', '300', 443, 0, 0),
(589, 'veg', 'FINGER FISH WITH SAUCE', '350', '350', 677, 0, 0),
(590, 'veg', 'FISH BHOLA TANDOORI', '900', '900', 546, 0, 0),
(591, 'veg', 'FISH BIRYANI', '400', '400', 832, 0, 0),
(592, 'veg', 'FISH CHILLY', '350', '350', 544, 0, 0),
(593, 'veg', 'FISH CURRY', '350', '350', 1034, 0, 0),
(594, 'veg', 'FISH CURRY MANGLORE STYLE', '300', '300', 506, 0, 0),
(595, 'veg', 'FISH IN PEANUT BUTTER SAUCE', '350', '350', 812, 0, 0),
(596, 'veg', 'FISH IN REACHEDO SAUCE', '300', '300', 591, 0, 0),
(597, 'veg', 'FISH MALAI TIKKA', '350', '350', 442, 0, 0),
(598, 'veg', 'FISH RAVA FRY', '300', '300', 473, 0, 0),
(599, 'veg', 'FISH TAWA FRY', '200', '200', 796, 0, 0),
(600, 'veg', 'FISH THAI CURRY', '400', '400', 454, 0, 0),
(601, 'veg', 'FONZO', '20', '20', 1074, 0, 0),
(602, 'veg', 'FRENCH FRIES', '120', '120', 369, 0, 0),
(603, 'veg', 'FRENCH FRIES WITH CHEESE', '150', '150', 918, 0, 0),
(604, 'veg', 'FRIED ICE CREAM', '150', '150', 410, 0, 0),
(605, 'veg', 'FRUIT CUSTARD', '80', '80', 732, 0, 0),
(606, 'veg', 'FRUIT SALAD', '80', '80', 731, 0, 0),
(607, 'veg', 'FRY NOODLES', '20', '20', 565, 0, 0),
(608, 'veg', 'GAJAR HALWAA', '80', '80', 387, 0, 0),
(609, 'veg', 'GAJAR KA HALWAA WITH I/C', '100', '100', 761, 0, 0),
(610, 'veg', 'GARLIC FRY', '100', '100', 566, 0, 0),
(611, 'veg', 'GARLIC NAAN', '80', '80', 414, 0, 0),
(612, 'veg', 'GARLIC SAUCE', '30', '30', 631, 0, 0),
(613, 'veg', 'GHEE', '20', '20', 581, 0, 0),
(614, 'veg', 'GHEE DOLAR JILEBI', '80', '80', 1257, 0, 0),
(615, 'veg', 'GHEE RICE', '130', '130', 327, 0, 0),
(616, 'veg', 'GOBI IN GREEN SAUCE', '150', '150', 1095, 0, 0),
(617, 'veg', 'GOBI MANCHURI', '150', '150', 465, 0, 0),
(618, 'veg', 'GOBI MOTER', '175', '175', 1047, 0, 0),
(619, 'veg', 'GOBI TANDOORI', '165', '165', 522, 0, 0),
(620, 'veg', 'GOBI TIKKA', '160', '160', 608, 0, 0),
(621, 'veg', 'GOLDEN FRIED BABY CORN', '160', '160', 627, 0, 0),
(622, 'veg', 'GOLDEN PRAWNS FRY', '350', '350', 628, 0, 0),
(623, 'veg', 'GREEN CHETNI IN TANDOORI SALAD', '60', '60', 929, 0, 0),
(624, 'veg', 'GREEN CHILLY FRY', '60', '60', 467, 0, 0),
(625, 'veg', 'GREEN LIME MOJITO SODA', '80', '80', 554, 0, 0),
(626, 'veg', 'GREEN LIME MOJITO WATER', '70', '70', 447, 0, 0),
(627, 'veg', 'GREEN LIME MOJITO WITH JEERA SODA', '100', '100', 576, 0, 0),
(628, 'veg', 'GREEN LIME SODA', '150', '150', 458, 0, 0),
(629, 'veg', 'GREEN PEAS MASALA', '165', '165', 872, 0, 0),
(630, 'veg', 'GREEN PEAS MASALA WITH MUSHROOM', '200', '200', 939, 0, 0),
(631, 'veg', 'GREEN PEAS MASALA WITH VEGETABLE', '180', '180', 662, 0, 0),
(632, 'veg', 'GULAB JAMUN', '80', '80', 743, 0, 0),
(633, 'veg', 'GULAB JAMUN SINGLE PC', '30', '30', 834, 0, 0),
(634, 'veg', 'GULAB JAMUN WITH ICE CREAM', '70', '70', 729, 0, 0),
(635, 'veg', 'HARA MUTTON CHOPS 1PIECE', '100', '100', 561, 0, 0),
(636, 'veg', 'HARI MAKAI KHAS WITH MUSHROOM', '200', '200', 938, 0, 0),
(637, 'veg', 'HARI MAKAI KHAS WITH PANEER', '200', '200', 1030, 0, 0),
(638, 'veg', 'HONG KONG CHICKEN WITH GRAVY', '200', '200', 560, 0, 0),
(639, 'veg', 'HONG KONG CHICKEN WITH SAUCE', '200', '200', 964, 0, 0),
(640, 'veg', 'HUNAN CHILLY FRIED RICE (V)', '150', '150', 953, 0, 0),
(641, 'veg', 'HUNAN CHILLY NOODLES (V)', '150', '150', 803, 0, 0),
(642, 'veg', 'HUNAN CHILLY NOODLES(NV)', '170', '170', 759, 0, 0),
(643, 'veg', 'HUNAN CRISPY', '250', '250', 906, 0, 0),
(644, 'veg', 'HUNAN PANEER', '175', '175', 804, 0, 0),
(645, 'veg', 'HUNAN PRAWNS', '300', '300', 622, 0, 0),
(646, 'veg', 'HUNAN VEG', '160', '160', 970, 0, 0),
(647, 'veg', 'JAI THAI SPECIAL NOODLES (NV)', '160', '160', 666, 0, 0),
(648, 'veg', 'JAI THAI SPECIAL NOODLES (V)', '140', '140', 665, 0, 0),
(649, 'veg', 'JAYPURI BHENDI', '180', '180', 858, 0, 0),
(650, 'veg', 'JAYPURI BHENDI SPCL', '210', '210', 1028, 0, 0),
(651, 'veg', 'JEERA ALOO', '120', '120', 568, 0, 0),
(652, 'veg', 'JEERA CHAWAL', '110', '110', 324, 0, 0),
(653, 'veg', 'JEERA CHAWAL HALF', '60', '60', 654, 0, 0),
(654, 'veg', 'JEERA PULAO', '110', '110', 726, 0, 0),
(655, 'veg', 'JEERA SODA', '20', '20', 776, 0, 0),
(656, 'veg', 'JUICE 1LTR', '150', '150', 886, 0, 0),
(657, 'veg', 'KAAJU KORMA', '230', '230', 942, 0, 0),
(658, 'veg', 'KAAJU MAKHANI', '230', '230', 950, 0, 0),
(659, 'veg', 'KADAI PANEER', '180', '180', 521, 0, 0),
(660, 'veg', 'KADHI', '135', '135', 940, 0, 0),
(661, 'veg', 'KADI PAKODA', '180', '180', 1062, 0, 0),
(662, 'veg', 'KAJJU KOLAPURI', '225', '225', 790, 0, 0),
(663, 'veg', 'KAJJU KOLAPURI FULL', '450', '450', 1054, 0, 0),
(664, 'veg', 'KAJJU MASALA', '220', '220', 380, 0, 0),
(665, 'veg', 'KALEJA GHEE ROST', '320', '320', 936, 0, 0),
(666, 'veg', 'KALMI KABAB', '200', '200', 681, 0, 0),
(667, 'veg', 'KALMI KABAB (1 PS)', '150', '150', 900, 0, 0),
(668, 'veg', 'KASHMIRI PULAO', '190', '190', 322, 0, 0),
(669, 'veg', 'KERALA PARATHA', '35', '35', 990, 0, 0),
(670, 'veg', 'KESARI PULAO', '180', '180', 725, 0, 0),
(671, 'veg', 'KHEER', '20', '20', 1058, 0, 0),
(672, 'veg', 'KHUSHKA RICE', '150', '150', 417, 0, 0),
(673, 'veg', 'KING FISH MASALA FRY', '550', '550', 1026, 0, 0),
(674, 'veg', 'KING FISH RAVA FRY', '200', '200', 513, 0, 0),
(675, 'veg', 'KING FISH SUKKHA', '300', '300', 599, 0, 0),
(676, 'veg', 'KOTHMIRI SHEEKH', '0', '0', 488, 0, 0),
(677, 'veg', 'LAGAAN KI SABZI (FULL)', '330', '330', 1068, 0, 0),
(678, 'veg', 'LASKA SOUP SEA', '130', '130', 810, 0, 0),
(679, 'veg', 'LEADY FISH', '500', '500', 1114, 0, 0),
(680, 'veg', 'LEMON RICE', '160', '160', 1011, 0, 0),
(681, 'veg', 'LIVER GHEE ROAST', '320', '320', 932, 0, 0),
(682, 'veg', 'LOD OF THE RING', '160', '160', 640, 0, 0),
(683, 'veg', 'MACRONI SALAD', '100', '100', 717, 0, 0),
(684, 'veg', 'MAHARAJA PRAWNS', '500', '500', 457, 0, 0),
(685, 'veg', 'MALAI KOFTA', '190', '190', 944, 0, 0),
(686, 'veg', 'MALAI POMPLET', '700', '700', 534, 0, 0),
(687, 'veg', 'MASALA PAPAD', '0', '0', 492, 0, 0),
(688, 'veg', 'MASALA PEANUT', '46', '46', 481, 0, 0),
(689, 'veg', 'MASALA ROTI', '60', '60', 1079, 0, 0),
(690, 'veg', 'MASHROOM IN HOI SIN SAUCE', '160', '160', 449, 0, 0),
(691, 'veg', 'MATKA KULFI', '80', '80', 734, 0, 0),
(692, 'veg', 'MAWA CAKE', '60', '60', 1081, 0, 0),
(693, 'veg', 'MAXICAN FRIED RICE (VEG)', '190', '190', 1126, 0, 0),
(694, 'veg', 'METHI MATOR MALAI', '225', '225', 894, 0, 0),
(695, 'veg', 'METHI PARATHA', '80', '80', 637, 0, 0),
(696, 'veg', 'MEYANO SAUCE', '30', '30', 684, 0, 0),
(697, 'veg', 'MILK', '20', '20', 1059, 0, 0),
(698, 'veg', 'MINT LIME SODA', '80', '80', 541, 0, 0),
(699, 'veg', 'MINUTE MAID JUICE', '40', '40', 1075, 0, 0),
(700, 'veg', 'MIX FRUITS', '1500', '1500', 1053, 0, 0),
(701, 'veg', 'MIX MANCHURIAN', '180', '180', 1019, 0, 0),
(702, 'veg', 'MIX NOODLES (NV)', '200', '200', 1039, 0, 0),
(703, 'veg', 'MIX VEG', '180', '180', 896, 0, 0),
(704, 'veg', 'MIX VEG PAKODA', '160', '160', 1027, 0, 0),
(705, 'veg', 'MONEY PLANT', '500', '500', 1080, 0, 0),
(706, 'veg', 'MOONG DAL KA HALWA', '80', '80', 882, 0, 0),
(707, 'veg', 'MURG LUCKNOWI', '275', '275', 377, 0, 0),
(708, 'veg', 'MURG MUSSLAM SPCL FULL', '1000', '1000', 992, 0, 0),
(709, 'veg', 'MURG SUKKHA MANGLORE STYLE', '240', '240', 501, 0, 0),
(710, 'veg', 'MURGH AFGHANI KABAB', '300', '300', 1065, 0, 0),
(711, 'veg', 'MURGH BHUNA MASALA FULL', '485', '485', 1049, 0, 0),
(712, 'veg', 'MURGH BHUNA MASALA HALF', '240', '240', 1071, 0, 0),
(713, 'veg', 'MURGH DHANIYA ADRAKI BL', '235', '235', 1012, 0, 0),
(714, 'veg', 'MURGH DHANIYA ADRAKI FULL', '430', '430', 1021, 0, 0),
(715, 'veg', 'MURGH HANDI (FULL)', '350', '350', 969, 0, 0),
(716, 'veg', 'MURGH HANDI BL', '235', '235', 607, 0, 0),
(717, 'veg', 'MURGH HANDI FULL', '430', '430', 553, 0, 0),
(718, 'veg', 'MURGH HANDI FULL BL', '450', '450', 995, 0, 0),
(719, 'veg', 'MURGH HAYDRABADI', '230', '230', 933, 0, 0),
(720, 'veg', 'MURGH HOT GARLIC', '180', '180', 780, 0, 0),
(721, 'veg', 'MURGH HYDERABADI BIRYANI TANDOORI', '240', '240', 670, 0, 0),
(722, 'veg', 'MURGH KHURCHAN (BL)', '265', '265', 868, 0, 0),
(723, 'veg', 'MURGH KHURCHAN (BL)', '265', '265', 498, 0, 0),
(724, 'veg', 'MURGH KHURCHAN FULL', '450', '450', 1113, 0, 0),
(725, 'veg', 'MURGH KI KACHI DUM BIRYANI (BL)', '220', '220', 937, 0, 0),
(726, 'veg', 'MURGH LABABDAR (FULL)', '480', '480', 977, 0, 0),
(727, 'veg', 'MURGH LABABDAR BL', '235', '235', 613, 0, 0),
(728, 'veg', 'MURGH LABABDAR SPCL', '350', '350', 1060, 0, 0),
(729, 'veg', 'MURGH LASOONI', '265', '265', 1088, 0, 0),
(730, 'veg', 'MURGH LOLYPOP', '220', '220', 1029, 0, 0),
(731, 'veg', 'MURGH MADAMI KABAB', '290', '290', 904, 0, 0),
(732, 'veg', 'MURGH MAKHANI', '0', '0', 497, 0, 0),
(733, 'veg', 'MURGH MAKHANI (BL)', '255', '255', 887, 0, 0),
(734, 'veg', 'MURGH MAKHANI FULL', '485', '485', 948, 0, 0),
(735, 'veg', 'MURGH MAKHANI WITH VEGETABLE', '255', '255', 1101, 0, 0),
(736, 'veg', 'MURGH MASALA', '485', '485', 1064, 0, 0),
(737, 'veg', 'MURGH MUGHLAI BL', '245', '245', 1013, 0, 0),
(738, 'veg', 'MURGH MUGHLAI FULL', '450', '450', 1076, 0, 0),
(739, 'veg', 'MURGH MUSSALAM FULL', '500', '500', 885, 0, 0),
(740, 'veg', 'MURGH MUSSALAM FULL (BL)', '515', '515', 855, 0, 0),
(741, 'veg', 'MURGH MUSSALAM HALF (BL)', '315', '315', 856, 0, 0),
(742, 'veg', 'MURGH PAHADI KABAB', '275', '275', 949, 0, 0),
(743, 'veg', 'MURGH PAN TIKKA', '250', '250', 861, 0, 0),
(744, 'veg', 'MURGH PAN TIKKA', '280', '280', 862, 0, 0),
(745, 'veg', 'MURGH PATIYALA (FULL)', '485', '485', 978, 0, 0),
(746, 'veg', 'MURGH PUDINA TIKKA', '290', '290', 926, 0, 0),
(747, 'veg', 'MURGH PYAAZ KA SALAN (BL)', '255', '255', 869, 0, 0),
(748, 'veg', 'MURGH RARA (FULL)', '485', '485', 1102, 0, 0),
(749, 'veg', 'MURGH RICHADO', '280', '280', 592, 0, 0),
(750, 'veg', 'MURGH ROSALI KABAB', '280', '280', 860, 0, 0),
(751, 'veg', 'MURGH ROSALI KABAB', '350', '350', 857, 0, 0),
(752, 'veg', 'MURGH SHEEK KABAB', '265', '265', 338, 0, 0),
(753, 'veg', 'MURGH SHORBA', '110', '110', 968, 0, 0),
(754, 'veg', 'MURGH SOJA SHAHI KABAB 1 PS', '90', '90', 573, 0, 0),
(755, 'veg', 'MURGH TIKKA MASALA (FULL)', '420', '420', 1104, 0, 0),
(756, 'veg', 'MUSHROOM BLACK BEAN SAUCE', '160', '160', 409, 0, 0),
(757, 'veg', 'MUSHROOM CHILLY', '170', '170', 618, 0, 0),
(758, 'veg', 'MUSHROOM FRIED RICE', '160', '160', 655, 0, 0),
(759, 'veg', 'MUSHROOM FRIED RICE', '140', '140', 575, 0, 0),
(760, 'veg', 'MUSHROOM GHEE ROAST', '250', '250', 1015, 0, 0),
(761, 'veg', 'MUSHROOM HARIYALI TIKKA', '180', '180', 606, 0, 0),
(762, 'veg', 'MUSHROOM HUNAN', '165', '165', 580, 0, 0),
(763, 'veg', 'MUSHROOM HYDERABADI', '180', '180', 1121, 0, 0),
(764, 'veg', 'MUSHROOM IN BARBEQUE SAUCE', '180', '180', 1122, 0, 0),
(765, 'veg', 'MUSHROOM IN OYESTER SAUCE', '170', '170', 572, 0, 0),
(766, 'veg', 'MUSHROOM KAAJU MASALA', '225', '225', 945, 0, 0),
(767, 'veg', 'MUSHROOM KOLAPURI', '180', '180', 602, 0, 0),
(768, 'veg', 'MUSHROOM LABABDAR', '175', '175', 1106, 0, 0),
(769, 'veg', 'MUSHROOM MALAI TIKKA WITH CHEESE', '250', '250', 807, 0, 0),
(770, 'veg', 'MUSHROOM MANCHURI', '160', '160', 678, 0, 0),
(771, 'veg', 'MUSHROOM SOYA GARLIC SAUCE', '170', '170', 368, 0, 0),
(772, 'veg', 'MUSHROOM SUKKHA MANGLORE STYLE', '210', '210', 502, 0, 0),
(773, 'veg', 'MUSHROOM TANDOORI TIKKA', '180', '180', 446, 0, 0),
(774, 'veg', 'MUTTER PANEER', '180', '180', 437, 0, 0),
(775, 'veg', 'MUTTOM GHEE ROST (FULL)', '720', '720', 1119, 0, 0),
(776, 'veg', 'MUTTON BHUNA GOST FULL', '700', '700', 893, 0, 0),
(777, 'veg', 'MUTTON CHATPATA', '320', '320', 374, 0, 0),
(778, 'veg', 'MUTTON CHILLY', '280', '280', 1109, 0, 0),
(779, 'veg', 'MUTTON DHOOANDAR BOTI', '335', '335', 669, 0, 0),
(780, 'veg', 'MUTTON DO PYAAZA', '300', '300', 954, 0, 0),
(781, 'veg', 'MUTTON HANDI', '330', '330', 634, 0, 0),
(782, 'veg', 'MUTTON HANDI FULL', '550', '550', 1042, 0, 0),
(783, 'veg', 'MUTTON HYEDRABADI', '320', '320', 514, 0, 0),
(784, 'veg', 'MUTTON IN OYESTER SAUCE', '290', '290', 641, 0, 0),
(785, 'veg', 'MUTTON IN PEANUT BUTTER SAUCE', '240', '240', 604, 0, 0),
(786, 'veg', 'MUTTON IN RICHADO SAUCE', '360', '360', 595, 0, 0),
(787, 'veg', 'MUTTON KADAI', '315', '315', 583, 0, 0),
(788, 'veg', 'MUTTON KAFRAIN', '360', '360', 913, 0, 0),
(789, 'veg', 'MUTTON KHAFIYA', '310', '310', 663, 0, 0),
(790, 'veg', 'MUTTON KHEEMA MASALA FULL', '500', '500', 1107, 0, 0),
(791, 'veg', 'MUTTON KOLAPURI FULL', '650', '650', 961, 0, 0),
(792, 'veg', 'MUTTON LASOONI KADAI', '360', '360', 1087, 0, 0),
(793, 'veg', 'MUTTON MAKHANI', '300', '300', 674, 0, 0),
(794, 'veg', 'MUTTON MANGLORE STYLE', '320', '320', 475, 0, 0),
(795, 'veg', 'MUTTON MASALA', '335', '335', 597, 0, 0),
(796, 'veg', 'MUTTON MUSSALLAM HALF', '400', '400', 777, 0, 0),
(797, 'veg', 'MUTTON PATIYALA', '485', '485', 971, 0, 0),
(798, 'veg', 'MUTTON RARA', '350', '350', 1072, 0, 0),
(799, 'veg', 'MUTTON ROGAN JOSH (FULL)', '600', '600', 1105, 0, 0),
(800, 'veg', 'MUTTON ROTI WITH BOTI', '350', '350', 1136, 0, 0),
(801, 'veg', 'MUTTON ROTI WITH BOTI', '350', '350', 1135, 0, 0),
(802, 'veg', 'MUTTON SHEEK KABAB', '330', '330', 500, 0, 0),
(803, 'veg', 'NAAN KASHMIRI', '100', '100', 382, 0, 0),
(804, 'veg', 'NAVARATHANA KURMA', '180', '180', 722, 0, 0),
(805, 'veg', 'NAZI KOREAN NOOLES WITH FISH', '200', '200', 424, 0, 0),
(806, 'veg', 'NON VEG THALI', '160', '160', 548, 0, 0),
(807, 'veg', 'NON VEG TIFFIN', '170', '170', 636, 0, 0),
(808, 'veg', 'OMLET', '80', '80', 428, 0, 0),
(809, 'veg', 'OMLET HALF FRY', '80', '80', 959, 0, 0),
(810, 'veg', 'ONE TON CHICKEN', '170', '170', 539, 0, 0),
(811, 'veg', 'ONION CHILLY FRIED RICE', '150', '150', 643, 0, 0),
(812, 'veg', 'ONION FRY', '25', '25', 579, 0, 0),
(813, 'veg', 'ONION PAKODA', '130', '130', 774, 0, 0),
(814, 'veg', 'ONION PARATHA', '70', '70', 808, 0, 0),
(815, 'veg', 'OYE SHAWA  SPL MOCKTAIL', '100', '100', 460, 0, 0),
(816, 'veg', 'OYE SHAWA KHAS-E-DAWAT (NV) SPCL', '850', '850', 493, 0, 0),
(817, 'veg', 'OYE SHAWA KHAS-E-DAWAT (V)', '0', '0', 496, 0, 0),
(818, 'veg', 'OYE SHAWA SOUP SEA', '110', '110', 811, 0, 0),
(819, 'veg', 'OYE SHAWA SPCL DRINK', '150', '150', 840, 0, 0),
(820, 'veg', 'PALAK MAKAI SHORBA (V)', '110', '110', 966, 0, 0),
(821, 'veg', 'PALAK MALAI SHORBA (NV)', '120', '120', 967, 0, 0),
(822, 'veg', 'PALAK PANEER', '180', '180', 461, 0, 0),
(823, 'veg', 'PALAK RICE', '160', '160', 529, 0, 0),
(824, 'veg', 'PANEER  KOLAPURI', '180', '180', 836, 0, 0),
(825, 'veg', 'PANEER BADAM KA SALAN', '180', '180', 719, 0, 0),
(826, 'veg', 'PANEER BHURJI', '225', '225', 889, 0, 0),
(827, 'veg', 'PANEER BIRYANI', '180', '180', 1040, 0, 0),
(828, 'veg', 'PANEER BUTTER GARLIC', '180', '180', 935, 0, 0),
(829, 'veg', 'PANEER BUTTER MASALA', '200', '200', 390, 0, 0),
(830, 'veg', 'PANEER CHILLY', '180', '180', 403, 0, 0),
(831, 'veg', 'PANEER FRIED RICE (NV)', '170', '170', 668, 0, 0),
(832, 'veg', 'PANEER FRIED RICE (V)', '150', '150', 667, 0, 0),
(833, 'veg', 'PANEER GARLIC GRAVY', '220', '220', 799, 0, 0),
(834, 'veg', 'PANEER IN HOISIN SAUCE', '180', '180', 430, 0, 0),
(835, 'veg', 'PANEER IN PEANUT BUTTER SAUCE', '170', '170', 419, 0, 0),
(836, 'veg', 'PANEER IN PEANUT BUTTER SAUCE', '0', '0', 484, 0, 0),
(837, 'veg', 'PANEER KAAJU MASALA', '220', '220', 538, 0, 0),
(838, 'veg', 'PANEER KAJJU MASALA', '225', '225', 875, 0, 0),
(839, 'veg', 'PANEER MAKHANI', '180', '180', 455, 0, 0),
(840, 'veg', 'PANEER MALAI KOFTA', '190', '190', 898, 0, 0),
(841, 'veg', 'PANEER MALAI TIKKA', '190', '190', 491, 0, 0),
(842, 'veg', 'PANEER MALAI TIKKA', '180', '180', 371, 0, 0),
(843, 'veg', 'PANEER MANCHURIAN', '180', '180', 476, 0, 0),
(844, 'veg', 'PANEER MANCHURIAN WITH GRAVY', '150', '150', 685, 0, 0),
(845, 'veg', 'PANEER METHI MASALA', '175', '175', 1050, 0, 0),
(846, 'veg', 'PANEER METHI MASALA', '50', '50', 1051, 0, 0),
(847, 'veg', 'PANEER MUSHROOM BABY CORN CHILLY', '190', '190', 1094, 0, 0),
(848, 'veg', 'PANEER NOODLES (NV)', '180', '180', 1083, 0, 0),
(849, 'veg', 'PANEER SCHEZWAN FRIED RICE', '180', '180', 1017, 0, 0),
(850, 'veg', 'PANEER STUFF PARATHA', '90', '90', 915, 0, 0),
(851, 'veg', 'PANEER TIKKA LABABDAR FULL', '350', '350', 1055, 0, 0),
(852, 'veg', 'PANEER TIKKA LABABDAR SPCL', '250', '250', 1061, 0, 0),
(853, 'veg', 'PANEER TIKKA LAL BAHADUR', '0', '0', 489, 0, 0),
(854, 'veg', 'PANEER TIKKA LAL BAHADUR', '0', '0', 980, 0, 0),
(855, 'veg', 'PAPAD CHURI', '0', '0', 480, 0, 0),
(856, 'veg', 'PAPAD CHURI', '70', '70', 367, 0, 0),
(857, 'veg', 'PAPAD PARATHA', '80', '80', 1243, 0, 0),
(858, 'veg', 'PARCEL CHARGE', '10', '10', 422, 0, 0),
(859, 'veg', 'PARCEL CHARGE', '20', '20', 401, 0, 0),
(860, 'veg', 'PARCEL CHARGER', '20', '20', 400, 0, 0),
(861, 'veg', 'PEANUT SAUCE', '50', '50', 876, 0, 0),
(862, 'veg', 'PEPSI 250ML', '20', '20', 870, 0, 0);
INSERT INTO `item` (`slno`, `item_cat`, `itmnam`, `prc`, `prc2`, `item_code`, `status`, `pid`) VALUES
(863, 'veg', 'PESHAWARI MUSHROOM', '180', '180', 616, 0, 0),
(864, 'veg', 'PESHAWARI PARATHA', '80', '80', 612, 0, 0),
(865, 'veg', 'PINEAPPLE JUICE', '50', '50', 676, 0, 0),
(866, 'veg', 'PLAIN CHEESE', '30', '30', 555, 0, 0),
(867, 'veg', 'PLAIN CURD', '30', '30', 373, 0, 0),
(868, 'veg', 'PLAIN PALAK', '140', '140', 789, 0, 0),
(869, 'veg', 'PLAIN PEANUT', '30', '30', 384, 0, 0),
(870, 'veg', 'PLATE', '400', '400', 1128, 0, 0),
(871, 'veg', 'POMEGRANATE (ANAR)  JUICE', '80', '80', 919, 0, 0),
(872, 'veg', 'POMFRET', '500', '500', 490, 0, 0),
(873, 'veg', 'POMPLET SUKKHA MASALA', '500', '500', 617, 0, 0),
(874, 'veg', 'POMPLET TAWA FRY 1PIECE', '200', '200', 431, 0, 0),
(875, 'veg', 'PRAWNS CHILLY', '350', '350', 542, 0, 0),
(876, 'veg', 'PRAWNS CURRY', '450', '450', 525, 0, 0),
(877, 'veg', 'PRAWNS DUM BIRYANI TANDOORI', '310', '310', 753, 0, 0),
(878, 'veg', 'PRAWNS FRIED RICE', '250', '250', 821, 0, 0),
(879, 'veg', 'PRAWNS GHEE ROST', '400', '400', 515, 0, 0),
(880, 'veg', 'PRAWNS HAKKA NOODLES', '220', '220', 973, 0, 0),
(881, 'veg', 'PRAWNS HOI SIN SAUCE', '350', '350', 571, 0, 0),
(882, 'veg', 'PRAWNS IN OYESTER SAUCE', '350', '350', 463, 0, 0),
(883, 'veg', 'PRAWNS KADAI', '400', '400', 878, 0, 0),
(884, 'veg', 'PRAWNS MAHARAJA', '800', '800', 462, 0, 0),
(885, 'veg', 'PRAWNS MANCHURIAN', '350', '350', 764, 0, 0),
(886, 'veg', 'PRAWNS MASALA', '350', '350', 412, 0, 0),
(887, 'veg', 'PRAWNS MASALA FRY', '350', '350', 411, 0, 0),
(888, 'veg', 'PRAWNS NOODLES', '250', '250', 909, 0, 0),
(889, 'veg', 'PRAWNS NOODLES', '190', '190', 746, 0, 0),
(890, 'veg', 'PRAWNS RAVA FRY', '350', '350', 471, 0, 0),
(891, 'veg', 'PRAWNS SCHEZWAN NOODLES', '250', '250', 1110, 0, 0),
(892, 'veg', 'PRAWNS STEW FRIED RICE', '400', '400', 1116, 0, 0),
(893, 'veg', 'PRAWNS SUKKHA MASALA', '350', '350', 775, 0, 0),
(894, 'veg', 'PRAWNS TIKKA', '300', '300', 392, 0, 0),
(895, 'veg', 'PREDATOR ENERGY DRINKS', '70', '70', 848, 0, 0),
(896, 'veg', 'PUNJABI BIRYANI (TANDOOR)', '180', '180', 991, 0, 0),
(897, 'veg', 'RABADI WITH KULFI', '150', '150', 730, 0, 0),
(898, 'veg', 'RASGULLA', '80', '80', 1111, 0, 0),
(899, 'veg', 'RAWAS', '500', '500', 955, 0, 0),
(900, 'veg', 'RED BULL DRINKS', '120', '120', 406, 0, 0),
(901, 'veg', 'ROGAN JOSH GRAVY', '60', '60', 590, 0, 0),
(902, 'veg', 'ROOH AFZA', '70', '70', 504, 0, 0),
(903, 'veg', 'RUSSIAN SALAD', '100', '100', 716, 0, 0),
(904, 'veg', 'SAAG GOSHT (FULL)', '700', '700', 1089, 0, 0),
(905, 'veg', 'SABZI HYEDRABADI', '180', '180', 585, 0, 0),
(906, 'veg', 'SABZI MILONI (FULL)', '330', '330', 1069, 0, 0),
(907, 'veg', 'SARSO KA SAAG WITH CHICKEN', '300', '300', 402, 0, 0),
(908, 'veg', 'SARSO KA SAAG WITH CHICKEN GOSH', '250', '250', 507, 0, 0),
(909, 'veg', 'SARSO KA SAAG WITH MUTTON GOSH', '300', '300', 508, 0, 0),
(910, 'veg', 'SARSO KA SAAG WITH PANEER', '180', '180', 1006, 0, 0),
(911, 'veg', 'SCHEZWAN CHICKEN', '180', '180', 626, 0, 0),
(912, 'veg', 'SCHEZWAN NOODLES (NV)', '160', '160', 569, 0, 0),
(913, 'veg', 'SCHEZWAN NOODLES (V)', '140', '140', 570, 0, 0),
(914, 'veg', 'SCHEZWAN SAUCE', '30', '30', 379, 0, 0),
(915, 'veg', 'SCHEZWAN SAUCE', '30', '30', 404, 0, 0),
(916, 'veg', 'SESMI FRENCH FRIESES', '160', '160', 632, 0, 0),
(917, 'veg', 'SEV KI TIKKI 2PCS', '80', '80', 661, 0, 0),
(918, 'veg', 'SHAAN E ALOO (NV)', '350', '350', 482, 0, 0),
(919, 'veg', 'SHAAN E ALOO WITH CHEES', '180', '180', 1097, 0, 0),
(920, 'veg', 'SHAAN E ALOO WITH CHEESE 1PC', '100', '100', 1129, 0, 0),
(921, 'veg', 'SHAHI CAPSICUM N/V', '350', '350', 1025, 0, 0),
(922, 'veg', 'SHAHI GAJAR', '200', '200', 883, 0, 0),
(923, 'veg', 'SHAHI TUKDA', '120', '120', 736, 0, 0),
(924, 'veg', 'SHANGHAI CHICKEN', '175', '175', 469, 0, 0),
(925, 'veg', 'SHANGHAI MUSHROOM', '160', '160', 620, 0, 0),
(926, 'veg', 'SHANGHAI PANEER', '180', '180', 518, 0, 0),
(927, 'veg', 'SHEVAYYA', '50', '50', 1056, 0, 0),
(928, 'veg', 'SHOLA KA MURG', '0', '0', 494, 0, 0),
(929, 'veg', 'SHOLAY KABAB', '0', '0', 499, 0, 0),
(930, 'veg', 'SILVER FISH', '1500', '1500', 1117, 0, 0),
(931, 'veg', 'SIMPLEY', '400', '400', 1115, 0, 0),
(932, 'veg', 'SINGAPORE NOODLES [V]', '0', '0', 647, 0, 0),
(933, 'veg', 'SINGAPURI NOODLES (V)', '150', '150', 728, 0, 0),
(934, 'veg', 'SLICED CHICKEN IN BARBICUE SAUCE', '220', '220', 972, 0, 0),
(935, 'veg', 'SLICED KING FISH  2PIECE', '450', '450', 831, 0, 0),
(936, 'veg', 'SLICED KING FISH CURRY', '400', '400', 749, 0, 0),
(937, 'veg', 'SLICED MUTTON IN BLACK BEAN SAUCE', '190', '190', 423, 0, 0),
(938, 'veg', 'SLICED MUTTON IN HOI SIN SAUCE', '190', '190', 425, 0, 0),
(939, 'veg', 'SLICED PINEAPPLE', '100', '100', 989, 0, 0),
(940, 'veg', 'SPCL COFFEE', '10', '10', 892, 0, 0),
(941, 'veg', 'SPCL DISH', '310', '310', 444, 0, 0),
(942, 'veg', 'SPCL TANGRI PATIYALA', '550', '550', 928, 0, 0),
(943, 'veg', 'SPCL TEA', '10', '10', 891, 0, 0),
(944, 'veg', 'SPECIAL NON VEG THALI', '180', '180', 1361, 0, 0),
(945, 'veg', 'SPECIAL VEG THALI', '150', '150', 614, 0, 0),
(946, 'veg', 'SPINACH CREEKLING VEG', '160', '160', 536, 0, 0),
(947, 'veg', 'STIRRED FRIED VEG WITH GRAVY', '220', '220', 763, 0, 0),
(948, 'veg', 'STUFF CAPSICUM', '180', '180', 849, 0, 0),
(949, 'veg', 'STUFFED CAPSICUM (V)', '160', '160', 1032, 0, 0),
(950, 'veg', 'SUBZI MILONI', '0', '0', 486, 0, 0),
(951, 'veg', 'SUBZI TAWA PULAO', '0', '0', 487, 0, 0),
(952, 'veg', 'SUBZI TAWA PULAO', '160', '160', 326, 0, 0),
(953, 'veg', 'SURMAI', '500', '500', 516, 0, 0),
(954, 'veg', 'SURMAI SUKKHA MASALA', '350', '350', 657, 0, 0),
(955, 'veg', 'SURMAI TAWA FRY', '350', '350', 601, 0, 0),
(956, 'veg', 'TANDOORI ALOO', '120', '120', 960, 0, 0),
(957, 'veg', 'TANDOORI BABY CORN', '165', '165', 947, 0, 0),
(958, 'veg', 'TANDOORI CHICKEN HALF', '240', '240', 393, 0, 0),
(959, 'veg', 'TANDOORI KING FISH', '900', '900', 584, 0, 0),
(960, 'veg', 'TANDOORI KOKOPARA', '500', '500', 543, 0, 0),
(961, 'veg', 'TANDOORI MUTTON BIRYANI', '260', '260', 600, 0, 0),
(962, 'veg', 'TANDOORI MUTTON HYDRABADI BIRYANI', '280', '280', 1045, 0, 0),
(963, 'veg', 'TANDOORI POMPLET', '500', '500', 372, 0, 0),
(964, 'veg', 'TANDOORI POMPLET 1PIECE', '350', '350', 512, 0, 0),
(965, 'veg', 'TANDOORI PRAWNS', '380', '380', 426, 0, 0),
(966, 'veg', 'TANDOORI SALAD', '30', '30', 464, 0, 0),
(967, 'veg', 'TANDOORI TUDA FISH', '500', '500', 772, 0, 0),
(968, 'veg', 'TANDOORI VEG BIRYANI', '180', '180', 682, 0, 0),
(969, 'veg', 'TANDOORI VEG DUM BIRYANI', '180', '180', 656, 0, 0),
(970, 'veg', 'TANDORI CHAT', '250', '250', 1023, 0, 0),
(971, 'veg', 'TANGRI KABAB 1PS', '150', '150', 1092, 0, 0),
(972, 'veg', 'TAWA MUTTON DRY FRY (BL)', '330', '330', 901, 0, 0),
(973, 'veg', 'TAWA PARATHA', '40', '40', 1146, 0, 0),
(974, 'veg', 'THEPLA', '15', '15', 941, 0, 0),
(975, 'veg', 'TOFFEE PUDDING', '70', '70', 830, 0, 0),
(976, 'veg', 'TOMATO SALAD', '70', '70', 528, 0, 0),
(977, 'veg', 'TRIPPALE SCHEZWAN FRIED RICE (NV)', '180', '180', 828, 0, 0),
(978, 'veg', 'TRIPPALE SCHEZWAN FRIED RICE (V)', '160', '160', 727, 0, 0),
(979, 'veg', 'TUFANI KABAB', '300', '300', 1084, 0, 0),
(980, 'veg', 'VANILLA I/C', '30', '30', 760, 0, 0),
(981, 'veg', 'VEG BHUNA', '160', '160', 721, 0, 0),
(982, 'veg', 'VEG BIRYANI 1KG', '500', '500', 838, 0, 0),
(983, 'veg', 'VEG CHILLY', '160', '160', 564, 0, 0),
(984, 'veg', 'VEG COMBO', '250', '250', 624, 0, 0),
(985, 'veg', 'VEG EXOTICS', '230', '230', 839, 0, 0),
(986, 'veg', 'VEG GOLDEN COIN', '160', '160', 623, 0, 0),
(987, 'veg', 'VEG GRAVY', '60', '60', 448, 0, 0),
(988, 'veg', 'VEG HAKKA NOODLES', '140', '140', 451, 0, 0),
(989, 'veg', 'VEG HANDI', '180', '180', 895, 0, 0),
(990, 'veg', 'VEG HANDI FULL', '340', '340', 1043, 0, 0),
(991, 'veg', 'VEG HYDERABADI', '180', '180', 452, 0, 0),
(992, 'veg', 'VEG HYDERABADI BIRYANI', '180', '180', 433, 0, 0),
(993, 'veg', 'VEG JAIPURI', '180', '180', 910, 0, 0),
(994, 'veg', 'VEG JALFRAIZE', '180', '180', 934, 0, 0),
(995, 'veg', 'VEG JAYPURI', '170', '170', 421, 0, 0),
(996, 'veg', 'VEG KADAI', '165', '165', 436, 0, 0),
(997, 'veg', 'VEG KOFTA', '160', '160', 865, 0, 0),
(998, 'veg', 'VEG KOLAPURI', '160', '160', 477, 0, 0),
(999, 'veg', 'VEG LASOONI', '215', '215', 1044, 0, 0),
(1000, 'veg', 'VEG LOLYPOP', '140', '140', 713, 0, 0),
(1001, 'veg', 'VEG MAKHANWALA', '165', '165', 445, 0, 0),
(1002, 'veg', 'VEG MANCHURIAN WITH GRAVY', '180', '180', 908, 0, 0),
(1003, 'veg', 'VEG MANCHURIAN WITH SAUCE', '190', '190', 851, 0, 0),
(1004, 'veg', 'VEG PULAO', '160', '160', 574, 0, 0),
(1005, 'veg', 'VEG SCHEZWAN NOOLES', '140', '140', 435, 0, 0),
(1006, 'veg', 'VEG SPRING ROLL', '140', '140', 633, 0, 0),
(1007, 'veg', 'VEG STUFF KULCHA', '100', '100', 582, 0, 0),
(1008, 'veg', 'VEG SULTANA', '180', '180', 720, 0, 0),
(1009, 'veg', 'VEG TANDOORI PUNJABI BIRYANI', '180', '180', 847, 0, 0),
(1010, 'veg', 'VEG TAWA BIRYANI', '180', '180', 385, 0, 0),
(1011, 'veg', 'VEG THALI', '130', '130', 1131, 0, 0),
(1012, 'veg', 'VEG TIFFIN', '150', '150', 864, 0, 0),
(1013, 'veg', 'VEG TIFIN', '110', '110', 547, 0, 0),
(1014, 'veg', 'VEG TIRANGA', '200', '200', 922, 0, 0),
(1015, 'veg', 'VEG ULALA', '200', '200', 1145, 0, 0),
(1016, 'veg', 'WATER MELON JUICE', '100', '100', 675, 0, 0),
(1017, 'veg', 'WHITE PUMPKIN HALWA', '80', '80', 735, 0, 0),
(1018, 'veg', 'WINGS HANDI', '250', '250', 985, 0, 0),
(1019, 'veg', 'XS ENERGY DRINKS', '110', '110', 1132, 0, 0),
(1020, 'veg', 'COTTAGE CHEESE LAZZIZ', '180', '180', 706, 0, 0),
(1021, 'veg', 'DUM ALOO PUNJABI', '160', '160', 707, 0, 0),
(1022, 'veg', 'EGG PULAO', '160', '160', 334, 0, 0),
(1023, 'veg', 'MURGH HYDERABADI BIRYANI', '210', '210', 330, 0, 0),
(1024, 'veg', 'MURGH KI KACHI DUM BIRYANI', '200', '200', 329, 0, 0),
(1025, 'veg', 'MURGH PULAO', '180', '180', 335, 0, 0),
(1026, 'veg', 'MUSHROOM DILRUBA', '180', '180', 710, 0, 0),
(1027, 'veg', 'MUTTON DUM BIRYANI', '240', '240', 331, 0, 0),
(1028, 'veg', 'MUTTON HYDERABADI BIRYANI', '260', '260', 332, 0, 0),
(1029, 'veg', 'MUTTON PULAO', '210', '210', 336, 0, 0),
(1030, 'veg', 'NARGIS KOFTA', '180', '180', 708, 0, 0),
(1031, 'veg', 'PRAWNS DUM BIRYANI', '280', '280', 333, 0, 0),
(1032, 'veg', 'VEG HAYDRABADI', '150', '150', 712, 0, 0),
(1033, 'veg', 'VEG TAWA PUNJABI STYLE', '160', '160', 711, 0, 0),
(1034, 'veg', 'VEG UJALA', '150', '150', 709, 0, 0),
(1035, 'veg', '', '0', '0', 1238, 0, 0),
(1036, 'veg', 'AFGANI KEBAB', '0', '0', 1204, 0, 0),
(1037, 'veg', 'AFGANI TIKKA MASALA', '320', '320', 1294, 0, 0),
(1038, 'veg', 'AFGHANI KABAB', '300', '300', 1206, 0, 0),
(1039, 'veg', 'ALO FRUIT JUICE', '40', '40', 1179, 0, 0),
(1040, 'veg', 'ALOO CHEESE PARATHA', '110', '110', 1379, 0, 0),
(1041, 'veg', 'ALU CHEESE PARATHA', '120', '120', 1347, 0, 0),
(1042, 'veg', 'AMRITSARI PARATHA', '130', '130', 1251, 0, 0),
(1043, 'veg', 'AMRITSARI PARATHA MUTTON', '180', '180', 1273, 0, 0),
(1044, 'veg', 'BABY CORN KOLHAPURI', '180', '180', 1299, 0, 0),
(1045, 'veg', 'BESAN KE GATTE', '180', '180', 1194, 0, 0),
(1046, 'veg', 'BHINDI  AMCHOOR', '160', '160', 1197, 0, 0),
(1047, 'veg', 'BHINDI AMCHUR', '160', '160', 1307, 0, 0),
(1048, 'veg', 'BOILED EGG', '25', '25', 1212, 0, 0),
(1049, 'veg', 'BOILED EGG SINGLE', '20', '20', 1298, 0, 0),
(1050, 'veg', 'BONOFFEE PIE TAB', '75', '75', 1340, 0, 0),
(1051, 'veg', 'BURNT GARLIC NOODLES(V)', '160', '160', 1353, 0, 0),
(1052, 'veg', 'BUTTER GARLIC CORN SUSHI', '390', '390', 1368, 0, 0),
(1053, 'veg', 'CAIIFORNIA TEMPURA SUSHI', '420', '420', 1371, 0, 0),
(1054, 'veg', 'CARAMEL PUDING', '60', '60', 1272, 0, 0),
(1055, 'veg', 'CHEESE  PANEER PARATHA', '120', '120', 1271, 0, 0),
(1056, 'veg', 'CHEESE KULCHA', '50', '50', 1388, 0, 0),
(1057, 'veg', 'CHEESE OMLET', '120', '120', 1382, 0, 0),
(1058, 'veg', 'CHEFF SPCL WAZWAN KULFI', '500', '500', 1324, 0, 0),
(1059, 'veg', 'CHI PAHADI PARATHA', '130', '130', 1249, 0, 0),
(1060, 'veg', 'CHICKEN KULFI', '400', '400', 1329, 0, 0),
(1061, 'veg', 'CHICKEN MINI PLATTER', '400', '400', 1346, 0, 0),
(1062, 'veg', 'CHICKEN TERIYAKI SUSHI', '420', '420', 1372, 0, 0),
(1063, 'veg', 'CHILLY GARLIC ROTI (BUTTER)', '60', '60', 1287, 0, 0),
(1064, 'veg', 'CHOCOLATE ICE CREAM', '75', '75', 1338, 0, 0),
(1065, 'veg', 'CHOCOLATE MOOSE', '100', '100', 1363, 0, 0),
(1066, 'veg', 'CHOP MASALA', '45', '45', 1200, 0, 0),
(1067, 'veg', 'CORAINDER RICE CHICKEN', '300', '300', 1288, 0, 0),
(1068, 'veg', 'CORN PALAK', '160', '160', 1380, 0, 0),
(1069, 'veg', 'CORN PARATHA', '80', '80', 1242, 0, 0),
(1070, 'veg', 'CORN PEPER DRY', '180', '180', 1180, 0, 0),
(1071, 'veg', 'CRAB SUSHI', '450', '450', 1374, 0, 0),
(1072, 'veg', 'CREAM OF ALMOND WITH CHICKEN', '130', '130', 1220, 0, 0),
(1073, 'veg', 'CRISPY FRIED BABYCORN 1PC', '30', '30', 1344, 0, 0),
(1074, 'veg', 'DAHI BHALLA', '100', '100', 1264, 0, 0),
(1075, 'veg', 'DAHI BHALLA (1PS)', '50', '50', 1265, 0, 0),
(1076, 'veg', 'DAL GHOSH', '500', '500', 1290, 0, 0),
(1077, 'veg', 'DAL GHOSHT', '280', '280', 1203, 0, 0),
(1078, 'veg', 'DAL KOLAPURI WITH TADKA', '160', '160', 1354, 0, 0),
(1079, 'veg', 'DAL MAKHANI HALF', '120', '120', 1227, 0, 0),
(1080, 'veg', 'DAL PARATHA', '100', '100', 1247, 0, 0),
(1081, 'veg', 'DAL PUNJABI WITH TADKA', '170', '170', 1376, 0, 0),
(1082, 'veg', 'DUM ALOO KASHMIRI', '170', '170', 1308, 0, 0),
(1083, 'veg', 'EGG BURJI WITH CHEESE', '100', '100', 1187, 0, 0),
(1084, 'veg', 'EGG COMBINATION RICE', '180', '180', 1283, 0, 0),
(1085, 'veg', 'EGG HALF FRY WITH CHEESE', '70', '70', 1186, 0, 0),
(1086, 'veg', 'EGG IN OYESTER SAUCE', '160', '160', 1328, 0, 0),
(1087, 'veg', 'EGG KOLAPURI FULL', '350', '350', 1286, 0, 0),
(1088, 'veg', 'EGG MASALA (FULL)', '320', '320', 1274, 0, 0),
(1089, 'veg', 'EGG MUSULLAM', '290', '290', 1232, 0, 0),
(1090, 'veg', 'EGG PARATHA', '100', '100', 1248, 0, 0),
(1091, 'veg', 'EGG RARA', '180', '180', 1381, 0, 0),
(1092, 'veg', 'EGG SCHEZWAN DRY', '140', '140', 1235, 0, 0),
(1093, 'veg', 'EGG SCHEZWAN FRIED RICE EXTRA EGG', '180', '180', 1356, 0, 0),
(1094, 'veg', 'EGG STEW RICE', '160', '160', 1360, 0, 0),
(1095, 'veg', 'EGG TRIPLE SCHEZWAN FRIED RICE', '170', '170', 1188, 0, 0),
(1096, 'veg', 'FINGER FISH 1PS', '50', '50', 1185, 0, 0),
(1097, 'veg', 'FISH PARATHA', '150', '150', 1254, 0, 0),
(1098, 'veg', 'FISH PLATTER', '1000', '1000', 1213, 0, 0),
(1099, 'veg', 'GARLIC KULCHA', '50', '50', 1277, 0, 0),
(1100, 'veg', 'GARLIC PARATHA', '90', '90', 1245, 0, 0),
(1101, 'veg', 'GARLIC ROTI', '30', '30', 1217, 0, 0),
(1102, 'veg', 'GHEE OMLET', '100', '100', 1176, 0, 0),
(1103, 'veg', 'GHEE RICE', '250', '250', 1292, 0, 0),
(1104, 'veg', 'GHEE RICE', '260', '260', 1291, 0, 0),
(1105, 'veg', 'GREEN PEAS PARATHA', '80', '80', 1240, 0, 0),
(1106, 'veg', 'GULAB AMUN WITH FERNY', '50', '50', 1225, 0, 0),
(1107, 'veg', 'GULAB JAMUN WITH FERNY', '50', '50', 1226, 0, 0),
(1108, 'veg', 'GULMOHAR SEEKH KABAB VEG', '240', '240', 1313, 0, 0),
(1109, 'veg', 'GUSHTABA', '330', '330', 1317, 0, 0),
(1110, 'veg', 'HONEY', '20', '20', 1177, 0, 0),
(1111, 'veg', 'HONG KONG GRAVY', '180', '180', 1201, 0, 0),
(1112, 'veg', 'JILEBI RABADI', '80', '80', 1263, 0, 0),
(1113, 'veg', 'JIMMY DRINK', '110', '110', 1335, 0, 0),
(1114, 'veg', 'KADAI MURGH (FULL)', '430', '430', 1266, 0, 0),
(1115, 'veg', 'KAJU MASALA (FULL)', '450', '450', 1377, 0, 0),
(1116, 'veg', 'KASHMIRI BIRYANI', '270', '270', 1320, 0, 0),
(1117, 'veg', 'KASHMIRI DHAKAI PARATHA', '100', '100', 1311, 0, 0),
(1118, 'veg', 'KASHMIRI PARATHA', '80', '80', 1244, 0, 0),
(1119, 'veg', 'KASHMIRI PARATHA', '100', '100', 1312, 0, 0),
(1120, 'veg', 'KASHMIRI PLATER', '600', '600', 1325, 0, 0),
(1121, 'veg', 'KASHMIRI SAAG', '170', '170', 1310, 0, 0),
(1122, 'veg', 'KASHMIRI SEEKH  KABAB (NV)', '240', '240', 1314, 0, 0),
(1123, 'veg', 'KOKAM', '50', '50', 1134, 0, 0),
(1124, 'veg', 'KOKAM FOR STAFF', '15', '15', 1144, 0, 0),
(1125, 'veg', 'KOKAM STAFF', '15', '15', 1334, 0, 0),
(1126, 'veg', 'KULFI MALAI SHEEK', '200', '200', 1326, 0, 0),
(1127, 'veg', 'LEMOM SODA', '25', '25', 1295, 0, 0),
(1128, 'veg', 'LEMON JUICE', '20', '20', 1230, 0, 0),
(1129, 'veg', 'LOBSTER SUSHI', '450', '450', 1375, 0, 0),
(1130, 'veg', 'MALPUA', '80', '80', 1262, 0, 0),
(1131, 'veg', 'MANCHURIAN RICE (NV)', '180', '180', 1383, 0, 0),
(1132, 'veg', 'MANCHURIAN RICE (NV)', '180', '180', 1342, 0, 0),
(1133, 'veg', 'MANCHURIAN RICE (V)', '160', '160', 1343, 0, 0),
(1134, 'veg', 'MANGO JUICE', '50', '50', 1333, 0, 0),
(1135, 'veg', 'MASALA PAPAD BUTTER', '60', '60', 1341, 0, 0),
(1136, 'veg', 'MASALA PEANUT', '46', '46', 1181, 0, 0),
(1137, 'veg', 'MATSCHGAND', '300', '300', 1318, 0, 0),
(1138, 'veg', 'METHI PARATHA', '80', '80', 1241, 0, 0),
(1139, 'veg', 'MINI VEG PLATTER', '300', '300', 1348, 0, 0),
(1140, 'veg', 'MIX MANCHURI (V)', '180', '180', 1210, 0, 0),
(1141, 'veg', 'MIX NON VEG PLATTER', '900', '900', 1357, 0, 0),
(1142, 'veg', 'MIX VEG 65', '225', '225', 1224, 0, 0),
(1143, 'veg', 'MOGHLAI PARATHA', '130', '130', 1250, 0, 0),
(1144, 'veg', 'MONSTER', '140', '140', 1199, 0, 0),
(1145, 'veg', 'MTN.KHEEMA PARATHA', '150', '150', 1253, 0, 0),
(1146, 'veg', 'MTN.PAHADI PARATHA', '150', '150', 1252, 0, 0),
(1147, 'veg', 'MULI PARATHA', '80', '80', 1237, 0, 0),
(1148, 'veg', 'MURGH ANDRA STYLE', '250', '250', 1178, 0, 0),
(1149, 'veg', 'MURGH CURRY', '215', '215', 1331, 0, 0),
(1150, 'veg', 'MURGH CURRY (FULL)', '430', '430', 1332, 0, 0),
(1151, 'veg', 'MURGH HYDRABADI (FULL)', '450', '450', 1211, 0, 0),
(1152, 'veg', 'MURGH KALI MIRI', '350', '350', 1165, 0, 0),
(1153, 'veg', 'MURGH KORMA (FULL)', '480', '480', 1278, 0, 0),
(1154, 'veg', 'MURGH NAINITAL KOFTA (FULL)', '430', '430', 1358, 0, 0),
(1155, 'veg', 'MURGH NANITAL KOFTA (FULL)', '430', '430', 1366, 0, 0),
(1156, 'veg', 'MURGH NIZAMI KEBAB', '350', '350', 1233, 0, 0),
(1157, 'veg', 'MURGH PAHADI (FULL)', '570', '570', 1279, 0, 0),
(1158, 'veg', 'MURGH PAHADI MASALA', '285', '285', 1202, 0, 0),
(1159, 'veg', 'MURGH PAHADI MASALA (FULL)', '550', '550', 1284, 0, 0),
(1160, 'veg', 'MURGH PYAAZ KA SALAN (FULL)', '470', '470', 1147, 0, 0),
(1161, 'veg', 'MURGH SAAG WALA (FULL)', '480', '480', 1300, 0, 0),
(1162, 'veg', 'MURGH SOLANKI', '350', '350', 1216, 0, 0),
(1163, 'veg', 'MURGH STARTER CHEFS  SPECIAL', '350', '350', 1182, 0, 0),
(1164, 'veg', 'MURGH TAWA MASALA', '235', '235', 1183, 0, 0),
(1165, 'veg', 'MURGH VALENTINE SPECIAL', '320', '320', 1192, 0, 0),
(1166, 'veg', 'MUSHROOM GARLIC SUSHI', '390', '390', 1369, 0, 0),
(1167, 'veg', 'MUSHROOM IN GREEEN SAUCE', '160', '160', 1269, 0, 0),
(1168, 'veg', 'MUSHROOM IN GREEN SAUCE', '160', '160', 1270, 0, 0),
(1169, 'veg', 'MUSHROOM KADAI', '175', '175', 1275, 0, 0),
(1170, 'veg', 'MUTTER MASALA', '160', '160', 1359, 0, 0),
(1171, 'veg', 'MUTTON GRILLED KHEEMA', '350', '350', 1196, 0, 0),
(1172, 'veg', 'MUTTON IN GREEN SAUCE', '280', '280', 1219, 0, 0),
(1173, 'veg', 'MUTTON KHEEMA BIRYANI', '450', '450', 1319, 0, 0),
(1174, 'veg', 'MUTTON KHEEMA MASALA(FULL)', '660', '660', 1327, 0, 0),
(1175, 'veg', 'MUTTON KULFI GASTABA', '500', '500', 1323, 0, 0),
(1176, 'veg', 'MUTTON MANCHURI', '280', '280', 1321, 0, 0),
(1177, 'veg', 'MUTTON MASALA (FULL)', '670', '670', 1336, 0, 0),
(1178, 'veg', 'MUTTON PAHADI LASUNI', '350', '350', 1215, 0, 0),
(1179, 'veg', 'MUTTON RAAN', '2500', '2500', 1280, 0, 0),
(1180, 'veg', 'NADROO SEEKH KABAB (NV)', '320', '320', 1315, 0, 0),
(1181, 'veg', 'NIMBOOSE', '30', '30', 1337, 0, 0),
(1182, 'veg', 'NON VEG MOMOS', '210', '210', 1350, 0, 0),
(1183, 'veg', 'ONION PARATHA', '90', '90', 1246, 0, 0),
(1184, 'veg', 'ONION SALAD', '30', '30', 1175, 0, 0),
(1185, 'veg', 'OSHAWA YAKHNI', '340', '340', 1316, 0, 0),
(1186, 'veg', 'PANEER CHAMAN', '220', '220', 1309, 0, 0),
(1187, 'veg', 'PANEER CHAMAN (NV)', '360', '360', 1365, 0, 0),
(1188, 'veg', 'PANEER CHEESE PARATHA', '100', '100', 1367, 0, 0),
(1189, 'veg', 'PANEER CHEFF SPCL', '320', '320', 1345, 0, 0),
(1190, 'veg', 'PANEER CHILLY WITH GRAVY', '200', '200', 1387, 0, 0),
(1191, 'veg', 'PANEER IN SOYA GARLIC SAUCE', '180', '180', 1209, 0, 0),
(1192, 'veg', 'PANEER KALI MIRI', '220', '220', 1162, 0, 0),
(1193, 'veg', 'PANEER KASHMIRI TIKKA', '200', '200', 1306, 0, 0),
(1194, 'veg', 'PANEER METHI CHAMAN (FULL)', '350', '350', 1352, 0, 0),
(1195, 'veg', 'PANEER PAKODA', '180', '180', 1218, 0, 0),
(1196, 'veg', 'PANEER PUDINA TIKKA', '200', '200', 1214, 0, 0),
(1197, 'veg', 'PANEER SCHEZWAN FRIED RICE', '170', '170', 1207, 0, 0),
(1198, 'veg', 'PANEER SCHEZWAN FRIED RICE', '170', '170', 1339, 0, 0),
(1199, 'veg', 'PANEER SHANGHAI NOODLES', '180', '180', 1296, 0, 0),
(1200, 'veg', 'PANEER SUSHI', '390', '390', 1370, 0, 0),
(1201, 'veg', 'PANEER TIKKA FRANKIE', '160', '160', 1174, 0, 0),
(1202, 'veg', 'PANEER TIKKA LALBAHDUR WITH CHEECE', '200', '200', 1362, 0, 0),
(1203, 'veg', 'PANEER TIKKA ROLL', '175', '175', 1138, 0, 0),
(1204, 'veg', 'PAX', '100', '100', 1228, 0, 0),
(1205, 'veg', 'PHIRNI', '50', '50', 1276, 0, 0),
(1206, 'veg', 'PHIRNI RABDI', '50', '50', 1221, 0, 0),
(1207, 'veg', 'PHULKA', '25', '25', 1297, 0, 0),
(1208, 'veg', 'PRAWNS PARATHA', '150', '150', 1255, 0, 0),
(1209, 'veg', 'PRAWNS TEMPURA SUSHI', '450', '450', 1373, 0, 0),
(1210, 'veg', 'QWAHA KASHMIRI TEA', '50', '50', 1305, 0, 0),
(1211, 'veg', 'RAAN MUTTON', '3500', '3500', 1281, 0, 0),
(1212, 'veg', 'RABADI', '60', '60', 1256, 0, 0),
(1213, 'veg', 'RABADI WITH GULB JAMUN', '80', '80', 1302, 0, 0),
(1214, 'veg', 'RAJMA MASALA', '180', '180', 1195, 0, 0),
(1215, 'veg', 'RARA CHICKEN FULL', '450', '450', 1293, 0, 0),
(1216, 'veg', 'RASMALAI', '60', '60', 1301, 0, 0),
(1217, 'veg', 'ROSE RABDI', '40', '40', 1222, 0, 0),
(1218, 'veg', 'RUMALI ROTI', '50', '50', 1285, 0, 0),
(1219, 'veg', 'SHAHI PANEER', '200', '200', 1268, 0, 0),
(1220, 'veg', 'SHAN E ALU WITH KHEEMA', '220', '220', 1384, 0, 0),
(1221, 'veg', 'SHANGHAI PANEER', '160', '160', 1205, 0, 0),
(1222, 'veg', 'SINGAPORE FRIED RICE VEG', '150', '150', 1208, 0, 0),
(1223, 'veg', 'SMASH POTATO', '60', '60', 1236, 0, 0),
(1224, 'veg', 'SPIDER CREAPER', '200', '200', 1189, 0, 0),
(1225, 'veg', 'SPRITE 600ML', '50', '50', 1173, 0, 0),
(1226, 'veg', 'STING', '30', '30', 1229, 0, 0),
(1227, 'veg', 'SWEET N SOUR VEG', '200', '200', 1198, 0, 0),
(1228, 'veg', 'TANDOORI CHICKEN FULL', '450', '450', 348, 0, 0),
(1229, 'veg', 'TANGDI KEBAB FULL LEG', '180', '180', 1378, 0, 0),
(1230, 'veg', 'THAI BARBEQUE CHICKEN', '350', '350', 1193, 0, 0),
(1231, 'veg', 'TIGER DRINKS', '120', '120', 1231, 0, 0),
(1232, 'veg', 'TRIPPLE SCHEZWAN NOODLES (V)', '160', '160', 1351, 0, 0),
(1233, 'veg', 'VEG BALL MANCHURIAN WITH GRAVY', '200', '200', 1223, 0, 0),
(1234, 'veg', 'VEG CHEESE PARATHA', '110', '110', 1267, 0, 0),
(1235, 'veg', 'VEG COMBINATION FRIED RICE', '180', '180', 1355, 0, 0),
(1236, 'veg', 'VEG FRIED RICE', '150', '150', 351, 0, 0),
(1237, 'veg', 'VEG GOLCONDA', '200', '200', 1190, 0, 0),
(1238, 'veg', 'VEG GOLKUNDA', '180', '180', 1184, 0, 0),
(1239, 'veg', 'VEG HAKKA NOODLES (HALF)', '100', '100', 1322, 0, 0),
(1240, 'veg', 'VEG METHI MASALA FULL', '300', '300', 1289, 0, 0),
(1241, 'veg', 'VEG MOMOS', '160', '160', 1349, 0, 0),
(1242, 'veg', 'VEG PARATHA', '80', '80', 1239, 0, 0),
(1243, 'veg', 'VEG SCHEZWAN DRY', '160', '160', 1364, 0, 0),
(1244, 'veg', 'VEG SEEKH KEBAB', '200', '200', 1282, 0, 0),
(1245, 'veg', 'VEG VALENTINE SPECIAL', '200', '200', 1191, 0, 0),
(1246, 'veg', 'VEG VOLCANISE', '250', '250', 1234, 0, 0),
(1247, 'veg', 'VEGETABLE PARATHA WITH CHEESE', '120', '120', 1386, 0, 0),
(1248, 'veg', 'WATER HALF LTR', '10', '10', 1330, 0, 0),
(1249, 'veg', 'WAZWAN THALI (NV)', '450', '450', 1303, 0, 0),
(1250, 'veg', 'WAZWAN THALI (V)', '350', '350', 1304, 0, 0),
(1251, 'veg', 'WINGS 1 PIESE', '45', '45', 1385, 0, 0),
(1252, 'veg', 'MURGH TIKKA ROLL', '140', '140', 1137, 0, 0),
(1253, 'veg', 'APPLE BOTTEL JUICE', '50', '50', 1172, 0, 0),
(1254, 'veg', 'BAG', '5', '5', 1154, 0, 0),
(1255, 'veg', 'BIRYANI', '3500', '3500', 1142, 0, 0),
(1256, 'veg', 'BOILED VEG WITH BUTTER GARLIC SAUCE', '160', '160', 1168, 0, 0),
(1257, 'veg', 'BRUNT GARLIC FRIED RICE (NV)', '180', '180', 1151, 0, 0),
(1258, 'veg', 'BUTTER GARLIC ROTI', '35', '35', 1160, 0, 0),
(1259, 'veg', 'BUTTER GARLIC VEGETABLE', '160', '160', 1155, 0, 0),
(1260, 'veg', 'CORIANDER RICE (NV)', '180', '180', 1158, 0, 0),
(1261, 'veg', 'CORIANDER RICE (V)', '170', '170', 1157, 0, 0),
(1262, 'veg', 'CRABS BIRYANI', '350', '350', 1149, 0, 0),
(1263, 'veg', 'EGG THALI', '150', '150', 1159, 0, 0),
(1264, 'veg', 'FISH TIKKA', '450', '450', 1166, 0, 0),
(1265, 'veg', 'FRUITS', '1020', '1020', 1141, 0, 0),
(1266, 'veg', 'ICE CREAM', '430', '430', 1143, 0, 0),
(1267, 'veg', 'IRANI KABAB ONE PIECE', '60', '60', 1169, 0, 0),
(1268, 'veg', 'IRANI KEBAB', '420', '420', 1167, 0, 0),
(1269, 'veg', 'KHAJUR', '1000', '1000', 1140, 0, 0),
(1270, 'veg', 'KING FISH TAWA FRY', '250', '250', 389, 0, 0),
(1271, 'veg', 'MURG AFGHANI TIKKA', '50', '50', 1170, 0, 0),
(1272, 'veg', 'MURGH KALI MIRI PINEAPPLE', '350', '350', 1164, 0, 0),
(1273, 'veg', 'MUSHROOM HANDI', '175', '175', 1156, 0, 0),
(1274, 'veg', 'MUTTON KHEEMA BALL', '350', '350', 1153, 0, 0),
(1275, 'veg', 'MUTTON RARA (FULL)', '700', '700', 1163, 0, 0),
(1276, 'veg', 'PANEER PEPPER PINE APPLE', '200', '200', 1161, 0, 0),
(1277, 'veg', 'PANEER ROTI WITH BOTI', '300', '300', 1139, 0, 0),
(1278, 'veg', 'SCHEZWAN FRIED RICE (NV) EXTRA EGG', '200', '200', 1171, 0, 0),
(1279, 'veg', 'SURMAI  BIRYANI', '500', '500', 1148, 0, 0),
(1280, 'veg', 'TANDOORI CHICKEN WITH SCEZWAN SAUCE', '600', '600', 1150, 0, 0),
(1281, 'veg', 'TAWA SABZI KI BAHAR (FULL)', '370', '370', 1152, 0, 0),
(1282, 'Veg', 'SLICE 250', '30', '30', 10, 0, 220),
(1283, 'Veg', 'PEPSI 300ML', '30', '30', 1389, 0, 221),
(1284, 'Veg', '7 UP 300ML', '30', '30', 1390, 0, 222),
(1285, 'Veg', 'SLICE 250ML', '30', '30', 1391, 0, 223),
(1286, 'Veg', 'MIRINDA 300ML', '30', '30', 1392, 0, 224),
(1287, 'Veg', 'DEW 300ML', '30', '30', 1393, 0, 225),
(1288, 'Veg', 'COKE 200ML', '30', '30', 1394, 0, 226),
(1289, 'Veg', 'COKE 300ML', '30', '30', 1395, 0, 227),
(1290, 'Veg', 'THUMPS UP 200ML', '30', '30', 1395, 0, 228),
(1291, 'Veg', 'THUMPS UP 300ML', '30', '30', 1396, 0, 229),
(1292, 'Veg', 'SPRITE 200ML', '30', '30', 1397, 0, 230),
(1293, 'Veg', 'SPRITE 300ML', '30', '30', 1398, 0, 231),
(1294, 'Veg', 'FANTA 300ML', '30', '30', 1399, 0, 232),
(1295, 'Veg', 'FANTA 200ML', '30', '30', 1400, 0, 233),
(1296, 'Veg', 'MAAZA 250ML', '30', '30', 1401, 0, 234),
(1297, 'Veg', 'LIMCA 200ML', '30', '30', 1402, 0, 235);

-- --------------------------------------------------------

--
-- Table structure for table `kot_cancel`
--

CREATE TABLE `kot_cancel` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `itmno` varchar(10) NOT NULL,
  `itmnam` varchar(200) NOT NULL,
  `prc` double NOT NULL,
  `qty` double NOT NULL,
  `tot` double NOT NULL,
  `tabno` varchar(30) NOT NULL,
  `kot_num` int(10) NOT NULL,
  `captain` varchar(50) NOT NULL,
  `cap_code` int(10) NOT NULL,
  `kot_time` varchar(50) NOT NULL,
  `cancel_time` varchar(50) NOT NULL,
  `reson` varchar(250) NOT NULL,
  `cashid` int(10) NOT NULL,
  `type` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
-- Table structure for table `log_info`
--

CREATE TABLE `log_info` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `logintime` datetime NOT NULL,
  `logouttime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_info`
--

INSERT INTO `log_info` (`id`, `userid`, `logintime`, `logouttime`) VALUES
(1, 6, '2024-01-05 12:56:43', '0000-00-00 00:00:00'),
(2, 6, '2024-01-05 15:08:00', '0000-00-00 00:00:00'),
(3, 6, '2024-01-05 16:20:10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `parcelmaterial`
--

CREATE TABLE `parcelmaterial` (
  `id` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `stock` double NOT NULL,
  `date` date NOT NULL,
  `issued` double NOT NULL,
  `stockreturn` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Ajino Moto', 'Chinese Sausage', 'KG', 'KG', 0, 0),
(2, 'Ajvain', 'Masala', 'KG', 'KG', 0, 0),
(3, 'American Corn', 'Dairy', 'KG', 'KG', 0, 0),
(4, 'Milk Powder', 'Dairy', 'Packet', 'Packet', 0, 0),
(5, 'Amul Fresh cream', 'Dairy', 'Litre', 'Litre', 0, 0),
(6, 'Atta', 'Grocery', 'KG', 'KG', 0, 0),
(7, 'Baby corn ', 'Chinese', 'Tin', 'Tin', 0, 0),
(8, 'Badam', 'Dryfruit', 'KG', 'KG', 0, 0),
(9, 'Badishop', 'Masala', 'KG', 'KG', 0, 0),
(10, 'Bamboshoot', 'Chinese', 'Tin', 'Tin', 0, 0),
(11, 'Basa Fish', 'Meat & Sea Food ', 'KG', 'KG', 0, 0),
(12, 'Besan', 'Grocery', 'KG', 'KG', 0, 0),
(13, 'Big Salt', 'Masala', 'KG', 'KG', 0, 0),
(14, 'Black Dal', 'Grocery', 'KG', 'KG', 0, 0),
(15, 'Black paper corn', 'Masala', 'KG', 'KG', 0, 0),
(16, 'Black paper Powder', 'Masala', 'Packet', 'Packet', 0, 0),
(17, 'Black salt', 'Masala', 'Packet', 'Packet', 0, 0),
(18, 'Blue Curaco', 'Pantry', 'Bottle', 'Bottle', 12, 0),
(19, 'Bread', 'Dairy', 'Packet', 'Packet', 0, 0),
(20, 'Broiler', 'Meat & Sea Food', 'KG', 'KG', 0, 0),
(21, 'Butter', 'Dairy', 'KG', 'KG', 0, 0),
(22, 'Cashew 1/2', 'Dryfruit', 'KG', 'KG', 0, 0),
(23, 'Cashew Kani', 'Dryfruit', 'KG', 'KG', 0, 0),
(24, 'Chana Masala', 'Masala', 'Packet', 'Packet', 5, 0),
(25, 'Chanaa dal', 'Grocery', 'KG', 'KG', 0, 0),
(26, 'Charcole', 'Fuel', 'KG', 'KG', 0, 0),
(27, 'Chat masala', 'Masala', 'Packet', 'Packet', 5, 0),
(28, 'Amul Cheese', 'Dairy', 'KG', 'KG', 0, 0),
(29, 'Cherry', 'Dryfruit', 'KG', 'KG', 0, 0),
(30, 'Chilli Powder', 'Masala', 'Packet', 'Packet', 0, 0),
(31, 'Cleanwrap', 'Packing Material', 'Packet', 'Packet', 0, 0),
(32, 'Coconut Milk', 'Dairy', 'Tin', 'Tin', 12, 0),
(33, 'Coconut Oil', 'Dairy', 'Litre', 'Litre', 0, 0),
(34, 'Coconut Powder', 'Masala', 'Packet', 'Packet', 0, 0),
(35, 'Corn Flakes', 'Dairy', 'Packet', 'Packet', 18, 0),
(36, 'Corn Flour', 'Masala', 'KG', 'KG', 12, 0),
(37, 'Curd', 'Dairy', 'Litre', 'Litre', 0, 0),
(38, 'Cylender', 'Fuel', 'Tin', 'Tin', 0, 0),
(39, 'Dalchini', 'Masala', 'KG', 'KG', 0, 0),
(40, 'Dhaniya', 'Masala', 'KG', 'KG', 0, 0),
(41, 'Dhaniya Powder', 'Masala', 'Packet', 'Packet', 5, 0),
(42, 'Lobe ', 'Grocery', 'KG', 'KG', 0, 0),
(43, 'Dry Grapes', 'Dryfruit', 'KG', 'KG', 0, 0),
(44, 'Duster', 'Cleaning Product', 'KG', 'KG', 0, 0),
(45, 'Eadible Soda', 'Grocery', 'KG', 'KG', 0, 0),
(46, 'Eggs', 'Dairy', 'Piece', 'Piece', 0, 0),
(47, 'Finger chips', 'Dairy', 'Packet', 'Packet', 0, 0),
(48, 'Fish fingers ', 'Meat & Sea Food ', 'Packet', 'Packet', 0, 0),
(49, 'Fruit Cocktail', 'Dryfruit', 'Tin', 'Tin', 0, 0),
(50, 'Garam masala', 'Masala', 'Packet', 'Packet', 5, 0),
(51, 'Ghee', 'Dairy', 'KG', 'KG', 0, 0),
(52, 'Green Chilli Sauce', 'Chinese Sausage', 'Bottle', 'Bottle', 12, 0),
(53, 'Greenlam Mojito', 'Pantry', 'Bottle', 'Bottle', 12, 0),
(54, 'Green peace', 'Dairy', 'Packet', 'Packet', 0, 0),
(55, 'Gulab Jamun Powder', 'Grocery', 'Packet', 'Packet', 0, 0),
(56, 'Harbura', 'Grocery', 'KG', 'KG', 0, 0),
(57, 'Green Cardimum', 'Masala', 'KG', 'KG', 0, 0),
(58, 'Honey', 'Syrup', 'Bottle', 'Bottle', 0, 0),
(59, 'Indian Tandoor', 'Chicken', 'KG', 'KG', 0, 0),
(60, 'Javitri', 'Masala', 'KG', 'KG', 0, 0),
(61, 'Jeera', 'Masala', 'KG', 'KG', 0, 0),
(62, 'Jeera powder', 'Masala', 'Packet', 'Packet', 5, 0),
(63, 'Kabuli Chana', 'Grocery', 'KG', 'KG', 0, 0),
(64, 'Kali Ilaichi', 'Masala', 'KG', 'KG', 0, 0),
(65, 'Kalonji', 'Masala', 'KG', 'KG', 0, 0),
(66, 'Kesari Powder', 'Masala', 'Packet', 'Packet', 0, 0),
(67, 'Kewda Water', 'Liquids', 'Bottle', 'Bottle', 18, 0),
(68, 'King Fish', 'Meat & Sea Food ', 'KG', 'KG', 0, 0),
(69, 'Kitchen king', 'Masala', 'Packet', 'Packet', 5, 0),
(70, 'Lavang', 'Masala', 'KG', 'KG', 0, 0),
(71, 'Leg', 'Chicken', 'KG', 'KG', 0, 0),
(72, 'lemon', 'Vegitables', 'Piece', 'Piece', 0, 0),
(73, 'Magaj', 'Dryfruit', 'KG', 'KG', 0, 0),
(74, 'Maida', 'Grocery', 'KG', 'KG', 0, 0),
(75, 'Masoor Dala', 'Grocery', 'KG', 'KG', 0, 0),
(76, 'Meat Masala', 'Masala', 'Packet', 'Packet', 5, 0),
(77, 'Moong Dal', 'Grocery', 'KG', 'KG', 0, 0),
(78, 'Mustard Powder', 'Masala', 'Tin', 'Tin', 0, 0),
(79, 'Noodles ', 'Chinese', 'Packet', 'Packet', 0, 0),
(80, 'Oil', 'Grocery', 'Litre', 'Litre', 5, 0),
(81, 'Oyester SOS', 'Chinese Sausage', 'Bottle', 'Bottle', 0, 0),
(82, 'Paneer', 'Dairy', 'KG', 'KG', 0, 0),
(83, 'Papad', 'Pantry', 'Packet', 'Packet', 0, 0),
(84, 'Pavbhaji masala', 'Masala', 'Packet', 'Packet', 5, 0),
(85, 'Peanut', 'Grocery', 'KG', 'KG', 0, 0),
(86, 'Phutani', 'Grocery', 'KG', 'KG', 0, 0),
(87, 'Pickle', 'Grocery', 'KG', 'KG', 0, 0),
(88, 'Piri piri Sprinkler', 'Masala', 'Packet', 'Packet', 0, 0),
(89, 'Pohe', 'Grocery', 'KG', 'KG', 0, 0),
(90, 'Prawns', 'Meat & Sea Food ', 'KG', 'KG', 0, 0),
(91, 'Rai', 'Masala', 'KG', 'KG', 0, 0),
(92, 'Rajma ', 'Grocery', 'KG', 'KG', 0, 0),
(93, 'Rawa', 'Grocery', 'KG', 'KG', 0, 0),
(94, 'Red Cabbage', 'english Vegitable', 'KG', 'KG', 0, 0),
(95, 'Rose Water', 'Liquids', 'Bottle', 'Bottle', 18, 0),
(96, 'Salt', 'Masala', 'KG', 'KG', 0, 0),
(97, 'Shev', 'Grocery', 'KG', 'KG', 0, 0),
(98, 'Soya Sauce', 'Chinese', 'Bottle', 'Bottle', 12, 0),
(99, 'Staff Rice ()', 'Grocery', 'KG', 'KG', 0, 0),
(100, 'Starful', 'Masala', 'KG', 'KG', 0, 0),
(101, 'Sugar', 'Grocery', 'KG', 'KG', 0, 0),
(102, 'Sweet corn ', 'Chinese', 'Tin', 'Tin', 12, 0),
(103, 'Tandoori chicken', 'Meat & Sea Food', 'KG', 'KG', 0, 0),
(104, 'Tea powder', 'Grocery', 'KG', 'KG', 0, 0),
(105, 'Tej Patta', 'Masala', 'KG', 'KG', 0, 0),
(106, 'Tomato Sauce', 'Liquids', 'Bottle', 'Bottle', 0, 0),
(107, 'Tomato Ketchup', 'Chinese', 'Pouch', 'Pouch', 12, 0),
(108, 'Tomato Puree', 'Liquids', 'Tin', 'Tin', 12, 0),
(109, 'Toor daal', 'Grocery', 'KG', 'KG', 0, 0),
(110, 'Tooty Fruity', 'Dairy', 'KG', 'KG', 12, 0),
(111, 'Vinegar', 'Liquids', 'Bottle', 'Bottle', 18, 0),
(112, 'Gotur Chilli', 'Masala', 'KG', 'KG', 0, 0),
(113, 'Green Muttar', 'Grocery', 'KG', 'KG', 0, 0),
(114, 'Green Color', 'Colors', 'Tin', 'Tin', 0, 0),
(115, 'Head Cap', 'Cleaning Product', 'Packet', 'Packet', 0, 0),
(116, 'Ice Cube', 'Drinks', 'KG', 'KG', 0, 0),
(117, 'Kesar Syrup', 'Liquids', 'Bottle', 'Bottle', 0, 0),
(118, 'Kashmiri Chilli', 'Masala', 'KG', 'KG', 0, 0),
(119, 'Khawa', 'Dairy', 'KG', 'KG', 0, 0),
(120, 'Kasturi Methi', 'Masala', 'Packet', 'Packet', 0, 0),
(121, 'Methi Seed', 'Masala', 'KG', 'KG', 0, 0),
(122, 'Makai Atta', 'Grocery', 'KG', 'KG', 0, 0),
(123, 'Musturd Oil', 'Grocery', 'Bottle', 'Bottle', 0, 0),
(124, 'Mutton ', 'Meat & Sea Food ', 'KG', 'KG', 0, 0),
(125, 'Milk', 'Dairy', 'Litre', 'Litre', 0, 0),
(126, 'Musline cloth', 'Tandoor', 'Meter', 'Meter', 0, 0),
(127, 'Mushroom', 'Dairy', 'Packet', 'Packet', 0, 0),
(128, 'Mionise Sause', 'Chinese Sausage', 'Bottle', 'Bottle', 0, 0),
(129, 'Mouth Fresh', 'Grocery', 'Packet', 'Packet', 0, 0),
(130, 'Moong ', 'Grocery', 'KG', 'KG', 0, 0),
(131, 'Masoor', 'Grocery', 'KG', 'KG', 0, 0),
(132, 'Nutmug', 'Grocery', 'KG', 'KG', 0, 0),
(133, 'Parcel Bag 13/16', 'Packing Material', 'KG', 'KG', 0, 0),
(134, 'Parcel Bag 16/20', 'Packing Material', 'KG', 'KG', 0, 0),
(135, 'Popy Seeds', 'Masala', 'KG', 'KG', 0, 0),
(136, 'Pompret', 'Meat & Sea Food ', 'KG', 'KG', 0, 0),
(137, 'Plastic container', 'Packing Material', 'Packet', 'Packet', 0, 0),
(138, 'Square Container ', 'Packing Material', 'Packet', 'Packet', 0, 0),
(139, 'Pineapple  Slice', 'Dryfruit', 'Tin', 'Tin', 5, 0),
(140, 'Paper Bag', 'Packing Material', 'KG', 'KG', 0, 0),
(141, 'Pav', 'Dairy', 'Piece', 'Piece', 0, 0),
(142, 'Red Color', 'colors', 'Tin', 'Tin', 0, 0),
(143, 'Red Chilli Sauce', 'Chinese Sausage', 'Bottle', 'Bottle', 12, 0),
(144, 'Salad Oil', 'Oils', 'Bottle', 'Bottle', 0, 0),
(145, 'Sarson Ka Saag', 'indian ', 'Tin', 'Tin', 12, 0),
(146, 'Silver Pauch 6*8', 'Packing Material', 'Packet', 'Packet', 0, 0),
(147, 'Silver Foil', 'Packing Material', 'Box', 'Box', 0, 0),
(148, 'Straw', 'Drinks', 'Packet', 'Packet', 0, 0),
(149, 'Table Rice (The Chief)', 'Grocery', 'KG', 'KG', 0, 0),
(150, 'Tandoori Indian', 'Meat & Sea Food', 'KG', 'KG', 0, 0),
(151, 'Turmuric Powder', 'Masala', 'KG', 'KG', 0, 0),
(152, 'Tooty Pick', 'Mislaneous', 'Box', 'Box', 0, 0),
(153, 'White sesmi Seeds', 'Masala', 'KG', 'KG', 0, 0),
(154, 'White Papper Powder', 'Chinese', 'Packet', 'Packet', 0, 0),
(155, 'Wings', 'Meat & Sea Food', 'KG', 'KG', 0, 0),
(156, 'Yellow Chilli ', 'Masala', 'KG', 'KG', 0, 0),
(157, 'Yellow Color', 'Colors', 'Tin', 'Tin', 0, 0),
(158, 'Beetroot', 'Vegitables', 'KG', 'KG', 0, 0),
(159, 'Beans', 'Vegitables', 'KG', 'KG', 0, 0),
(160, 'Cabbage', 'Vegitables', 'KG', 'KG', 0, 0),
(161, 'Capcicum', 'Vegitables', 'KG', 'KG', 0, 0),
(162, 'Carret', 'Vegitables', 'KG', 'KG', 0, 0),
(163, 'Cauli Flower', 'Vegitables', 'Piece', 'Piece', 0, 0),
(164, 'Coriander Leaves', 'Vegitables', 'Piece', 'Piece', 0, 0),
(165, 'onion', 'Vegitables', 'KG', 'KG', 0, 0),
(166, 'Cucumber', 'Vegitables', 'KG', 'KG', 0, 0),
(167, 'Curry Leaves', 'Vegitables', 'Piece', 'Piece', 0, 0),
(168, 'Ginger ', 'Vegitables', 'KG', 'KG', 0, 0),
(169, 'Green Chilli', 'Vegitables', 'KG', 'KG', 0, 0),
(170, 'Lemon', 'Vegitables', 'Piece', 'Piece', 0, 0),
(171, 'Methi', 'Vegitables', 'Piece', 'Piece', 0, 0),
(172, 'Mint', 'Vegitables', 'Piece', 'Piece', 0, 0),
(173, 'Potato', 'Vegitables', 'KG', 'KG', 0, 0),
(174, 'Spanish Palak', 'Vegitables', 'Piece', 'Piece', 0, 0),
(175, 'Sping Onion', 'Vegitables', 'Piece', 'Piece', 0, 0),
(176, 'Tomato Tables', 'Vegitables', 'KG', 'KG', 0, 0),
(177, 'Pilled Garlic', 'Vegitables', 'KG', 'KG', 0, 0),
(178, 'Lemon Grass', 'Vegitables', 'KG', 'KG', 0, 0),
(179, 'Sallary Leaves', 'Vegitables', 'Piece', 'Piece', 0, 0),
(180, 'Red Cabbage', 'Vegitables', 'KG', 'KG', 0, 0),
(181, 'Brokli', 'Vegitables', 'KG', 'KG', 0, 0),
(182, 'Yellow Zuccani', 'Vegitables', 'KG', 'KG', 0, 0),
(183, 'Green Zuccani', 'Vegitables', 'KG', 'KG', 0, 0),
(184, 'Yellow Capsicum', 'Vegitables', 'KG', 'KG', 0, 0),
(185, 'Red Capsicum', 'Vegitables', 'KG', 'KG', 0, 0),
(186, 'Baby Corn (Fresh)', 'Vegitables', 'Packet', 'Packet', 0, 0),
(187, 'Brush', 'House Keeping', 'Piece', 'Piece', 0, 0),
(188, 'Garbage Bag', 'House Keeping', 'Packet', 'Packet', 0, 0),
(189, 'Ditergent Powder', 'House Keeping', 'KG', 'KG', 0, 0),
(190, 'Ditergent Saop', 'House Keeping', 'Piece', 'Piece', 0, 0),
(191, 'hand Wash', 'House Keeping', 'Litre', 'Litre', 0, 0),
(192, 'Mop', 'House Keeping', 'Piece', 'Piece', 0, 0),
(193, 'Napkin Paper', 'House Keeping', 'Piece', 'Piece', 0, 0),
(194, 'Phynoyl', 'House Keeping', 'Litre', 'Litre', 0, 0),
(195, 'Pitambari', 'House Keeping', 'Packet', 'Packet', 0, 0),
(196, 'Plastic Whool', 'House Keeping', 'Packet', 'Packet', 0, 0),
(197, 'Room freshner', 'House Keeping', 'Bottle', 'Bottle', 0, 0),
(198, 'Soap oil', 'House Keeping', 'Litre', 'Litre', 0, 0),
(199, 'Spunj', 'House Keeping', 'Piece', 'Piece', 0, 0),
(200, 'Scotch Brite', 'House Keeping', 'Piece', 'Piece', 0, 0),
(201, 'Kadi Zadu', 'House Keeping', 'Piece', 'Piece', 0, 0),
(202, 'Muscito Coil', 'House Keeping', 'Piece', 'Piece', 0, 0),
(203, 'Steel Wool', 'House Keeping', 'Piece', 'Piece', 0, 0),
(204, 'Toilet Roll', 'House Keeping', 'Piece', 'Piece', 0, 0),
(205, 'wiper', 'House Keeping', 'Piece', 'Piece', 0, 0),
(206, 'zadu', 'House Keeping', 'Piece', 'Piece', 0, 0),
(207, 'Dettol Soap ', 'House Keeping', 'Piece', 'Piece', 0, 0),
(208, 'Paste Control Medicene', 'House Keeping', 'Bottle', 'Bottle', 0, 0),
(209, 'Folding bag 3kg', 'Percel Material', 'KG', 'KG', 0, 0),
(210, 'Poly Bag', 'Percel Material', 'Packet', 'Packet', 0, 0),
(211, 'Pen ', 'Stationary', 'Box', 'Box', 0, 0),
(212, 'Marker', 'Stationary', 'Box', 'Box', 0, 0),
(213, 'Carbon ', 'Stationary', 'Box', 'Box', 0, 0),
(214, 'Stappler Pin', 'Stationary', 'Box', 'Box', 0, 0),
(215, 'Kot Book', 'Stationary', 'Piece', 'Piece', 0, 0),
(216, 'TD Brush', 'House Keeping', 'Piece', 'Piece', 0, 0),
(217, 'Yellow Thai Curry Paste', 'Tandoor', 'Tin', 'Tin', 0, 0),
(218, 'Fuel(Tin) ', 'Fuel', 'Tin', 'Tin', 5, 0),
(219, '', 'pepsi', '', '', 0, 0),
(220, 'SLICE 250', 'Flavours', 'Bottle', 'Bottle', 12, 0),
(221, 'PEPSI 300ML', 'Flavours', 'Bottle', 'Bottle', 28, 12),
(222, '7 UP 300ML', 'Flavours', 'Bottle', 'Bottle', 28, 12),
(223, 'SLICE 250ML', 'Flavours', 'Bottle', 'Bottle', 12, 0),
(224, 'MIRINDA 300ML', 'Flavours', 'Bottle', 'Bottle', 28, 12),
(225, 'DEW 300ML', 'Flavours', 'Bottle', 'Bottle', 28, 12),
(226, 'COKE 200ML', 'Flavours', 'Bottle', 'Bottle', 0, 0),
(227, 'COKE 300ML', 'Flavours', 'Bottle', 'Bottle', 0, 0),
(228, 'THUMPS UP 200ML', 'Flavours', 'Bottle', 'Bottle', 0, 0),
(229, 'THUMPS UP 300ML', 'Flavours', 'Bottle', 'Bottle', 0, 0),
(230, 'SPRITE 200ML', 'Flavours', 'Bottle', 'Bottle', 0, 0),
(231, 'SPRITE 300ML', 'Flavours', 'Bottle', 'Bottle', 0, 0),
(232, 'FANTA 300ML', 'Flavours', 'Bottle', 'Bottle', 0, 0),
(233, 'FANTA 200ML', 'Flavours', 'Bottle', 'Bottle', 0, 0),
(234, 'MAAZA 250ML', 'Flavours', 'Bottle', 'Bottle', 0, 0),
(235, 'LIMCA 200ML', 'Flavours', 'Bottle', 'Bottle', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_data`
--

CREATE TABLE `purchase_data` (
  `id` int(10) NOT NULL,
  `vendor` varchar(200) NOT NULL,
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
  `exp` varchar(10) NOT NULL,
  `date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `qty`, `venid`, `price`, `total`, `bamt`, `tax`, `disc`, `cess`, `perCaseQty`, `pid`, `exp`, `date`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, '03-01-2024', '03-01-2024'),
(2, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, '04-01-2024', '04-01-2024'),
(3, 2, 0, 0, 0, 0, 0, 0, 0, 1, 3, '05-01-2024', '05-01-2024'),
(4, 4, 0, 0, 0, 0, 0, 0, 0, 1, 4, '06-01-2024', '06-01-2024'),
(5, 10, 0, 0, 0, 0, 0, 0, 0, 1, 5, '07-01-2024', '07-01-2024'),
(6, 12, 0, 0, 0, 0, 0, 0, 0, 1, 6, '08-01-2024', '08-01-2024'),
(7, 40, 0, 0, 0, 0, 0, 0, 0, 1, 7, '09-01-2024', '09-01-2024'),
(8, 2.6, 0, 0, 0, 0, 0, 0, 0, 1, 8, '10-01-2024', '10-01-2024'),
(9, 0.45, 0, 0, 0, 0, 0, 0, 0, 1, 9, '11-01-2024', '11-01-2024'),
(10, 0, 0, 0, 0, 0, 0, 0, 0, 1, 10, '12-01-2024', '12-01-2024'),
(11, 2, 0, 0, 0, 0, 0, 0, 0, 1, 11, '13-01-2024', '13-01-2024'),
(12, 1.25, 0, 0, 0, 0, 0, 0, 0, 1, 12, '14-01-2024', '14-01-2024'),
(13, 0, 0, 0, 0, 0, 0, 0, 0, 1, 13, '15-01-2024', '15-01-2024'),
(14, 1, 0, 0, 0, 0, 0, 0, 0, 1, 14, '16-01-2024', '16-01-2024'),
(15, 0.6, 0, 0, 0, 0, 0, 0, 0, 1, 15, '17-01-2024', '17-01-2024'),
(16, 1, 0, 0, 0, 0, 0, 0, 0, 1, 16, '18-01-2024', '18-01-2024'),
(17, 2, 0, 0, 0, 0, 0, 0, 0, 1, 17, '19-01-2024', '19-01-2024'),
(18, 8, 0, 0, 0, 0, 0, 0, 0, 1, 18, '20-01-2024', '20-01-2024'),
(19, 3, 0, 0, 0, 0, 0, 0, 0, 1, 19, '21-01-2024', '21-01-2024'),
(20, 0, 0, 0, 0, 0, 0, 0, 0, 1, 20, '22-01-2024', '22-01-2024'),
(21, 9, 0, 0, 0, 0, 0, 0, 0, 1, 21, '23-01-2024', '23-01-2024'),
(22, 21, 0, 0, 0, 0, 0, 0, 0, 1, 22, '24-01-2024', '24-01-2024'),
(23, 19, 0, 0, 0, 0, 0, 0, 0, 1, 23, '25-01-2024', '25-01-2024'),
(24, 2, 0, 0, 0, 0, 0, 0, 0, 1, 24, '26-01-2024', '26-01-2024'),
(25, 0.16, 0, 0, 0, 0, 0, 0, 0, 1, 25, '27-01-2024', '27-01-2024'),
(26, 110, 0, 0, 0, 0, 0, 0, 0, 1, 26, '28-01-2024', '28-01-2024'),
(27, 0, 0, 0, 0, 0, 0, 0, 0, 1, 27, '29-01-2024', '29-01-2024'),
(28, 6, 0, 0, 0, 0, 0, 0, 0, 1, 28, '30-01-2024', '30-01-2024'),
(29, 0, 0, 0, 0, 0, 0, 0, 0, 1, 29, '31-01-2024', '31-01-2024'),
(30, 0, 0, 0, 0, 0, 0, 0, 0, 1, 30, '01-02-2024', '01-02-2024'),
(31, 3, 0, 0, 0, 0, 0, 0, 0, 1, 31, '02-02-2024', '02-02-2024'),
(32, 7, 0, 0, 0, 0, 0, 0, 0, 1, 32, '03-02-2024', '03-02-2024'),
(33, 2, 0, 0, 0, 0, 0, 0, 0, 1, 33, '04-02-2024', '04-02-2024'),
(34, 1, 0, 0, 0, 0, 0, 0, 0, 1, 34, '05-02-2024', '05-02-2024'),
(35, 4, 0, 0, 0, 0, 0, 0, 0, 1, 35, '06-02-2024', '06-02-2024'),
(36, 30, 0, 0, 0, 0, 0, 0, 0, 1, 36, '07-02-2024', '07-02-2024'),
(37, 0, 0, 0, 0, 0, 0, 0, 0, 1, 37, '08-02-2024', '08-02-2024'),
(38, 0, 0, 0, 0, 0, 0, 0, 0, 1, 38, '09-02-2024', '09-02-2024'),
(39, 0.6, 0, 0, 0, 0, 0, 0, 0, 1, 39, '10-02-2024', '10-02-2024'),
(40, 1, 0, 0, 0, 0, 0, 0, 0, 1, 40, '11-02-2024', '11-02-2024'),
(41, 2, 0, 0, 0, 0, 0, 0, 0, 1, 41, '12-02-2024', '12-02-2024'),
(42, 1.5, 0, 0, 0, 0, 0, 0, 0, 1, 42, '13-02-2024', '13-02-2024'),
(43, 1.5, 0, 0, 0, 0, 0, 0, 0, 1, 43, '14-02-2024', '14-02-2024'),
(44, 1, 0, 0, 0, 0, 0, 0, 0, 1, 44, '15-02-2024', '15-02-2024'),
(45, 0, 0, 0, 0, 0, 0, 0, 0, 1, 45, '16-02-2024', '16-02-2024'),
(46, 120, 0, 0, 0, 0, 0, 0, 0, 1, 46, '17-02-2024', '17-02-2024'),
(47, 2, 0, 0, 0, 0, 0, 0, 0, 1, 47, '18-02-2024', '18-02-2024'),
(48, 4, 0, 0, 0, 0, 0, 0, 0, 1, 48, '19-02-2024', '19-02-2024'),
(49, 5, 0, 0, 0, 0, 0, 0, 0, 1, 49, '20-02-2024', '20-02-2024'),
(50, 0, 0, 0, 0, 0, 0, 0, 0, 1, 50, '21-02-2024', '21-02-2024'),
(51, 1.5, 0, 0, 0, 0, 0, 0, 0, 1, 51, '22-02-2024', '22-02-2024'),
(52, 0, 0, 0, 0, 0, 0, 0, 0, 1, 52, '23-02-2024', '23-02-2024'),
(53, 11, 0, 0, 0, 0, 0, 0, 0, 1, 53, '24-02-2024', '24-02-2024'),
(54, 5, 0, 0, 0, 0, 0, 0, 0, 1, 54, '25-02-2024', '25-02-2024'),
(55, 0, 0, 0, 0, 0, 0, 0, 0, 1, 55, '26-02-2024', '26-02-2024'),
(56, 1, 0, 0, 0, 0, 0, 0, 0, 1, 56, '27-02-2024', '27-02-2024'),
(57, 0, 0, 0, 0, 0, 0, 0, 0, 1, 57, '28-02-2024', '28-02-2024'),
(58, 1, 0, 0, 0, 0, 0, 0, 0, 1, 58, '29-02-2024', '29-02-2024'),
(59, 0, 0, 0, 0, 0, 0, 0, 0, 1, 59, '01-03-2024', '01-03-2024'),
(60, 0, 0, 0, 0, 0, 0, 0, 0, 1, 60, '02-03-2024', '02-03-2024'),
(61, 0.5, 0, 0, 0, 0, 0, 0, 0, 1, 61, '03-03-2024', '03-03-2024'),
(62, 4, 0, 0, 0, 0, 0, 0, 0, 1, 62, '04-03-2024', '04-03-2024'),
(63, 0, 0, 0, 0, 0, 0, 0, 0, 1, 63, '05-03-2024', '05-03-2024'),
(64, 0.6, 0, 0, 0, 0, 0, 0, 0, 1, 64, '06-03-2024', '06-03-2024'),
(65, 0.8, 0, 0, 0, 0, 0, 0, 0, 1, 65, '07-03-2024', '07-03-2024'),
(66, 1, 0, 0, 0, 0, 0, 0, 0, 1, 66, '08-03-2024', '08-03-2024'),
(67, 4, 0, 0, 0, 0, 0, 0, 0, 1, 67, '09-03-2024', '09-03-2024'),
(68, 1, 0, 0, 0, 0, 0, 0, 0, 1, 68, '10-03-2024', '10-03-2024'),
(69, 2, 0, 0, 0, 0, 0, 0, 0, 1, 69, '11-03-2024', '11-03-2024'),
(70, 0.5, 0, 0, 0, 0, 0, 0, 0, 1, 70, '12-03-2024', '12-03-2024'),
(71, 0, 0, 0, 0, 0, 0, 0, 0, 1, 71, '13-03-2024', '13-03-2024'),
(72, 130, 0, 0, 0, 0, 0, 0, 0, 1, 72, '14-03-2024', '14-03-2024'),
(73, 0, 0, 0, 0, 0, 0, 0, 0, 1, 73, '15-03-2024', '15-03-2024'),
(74, 8, 0, 0, 0, 0, 0, 0, 0, 1, 74, '16-03-2024', '16-03-2024'),
(75, 0, 0, 0, 0, 0, 0, 0, 0, 1, 75, '17-03-2024', '17-03-2024'),
(76, 0, 0, 0, 0, 0, 0, 0, 0, 1, 76, '18-03-2024', '18-03-2024'),
(77, 0, 0, 0, 0, 0, 0, 0, 0, 1, 77, '19-03-2024', '19-03-2024'),
(78, 3, 0, 0, 0, 0, 0, 0, 0, 1, 78, '20-03-2024', '20-03-2024'),
(79, 9, 0, 0, 0, 0, 0, 0, 0, 1, 79, '21-03-2024', '21-03-2024'),
(80, 70, 0, 0, 0, 0, 0, 0, 0, 1, 80, '22-03-2024', '22-03-2024'),
(81, 5, 0, 0, 0, 0, 0, 0, 0, 1, 81, '23-03-2024', '23-03-2024'),
(82, 1, 0, 0, 0, 0, 0, 0, 0, 1, 82, '24-03-2024', '24-03-2024'),
(83, 24, 0, 0, 0, 0, 0, 0, 0, 1, 83, '25-03-2024', '25-03-2024'),
(84, 2, 0, 0, 0, 0, 0, 0, 0, 1, 84, '26-03-2024', '26-03-2024'),
(85, 0, 0, 0, 0, 0, 0, 0, 0, 1, 85, '27-03-2024', '27-03-2024'),
(86, 0.45, 0, 0, 0, 0, 0, 0, 0, 1, 86, '28-03-2024', '28-03-2024'),
(87, 0, 0, 0, 0, 0, 0, 0, 0, 1, 87, '29-03-2024', '29-03-2024'),
(88, 3, 0, 0, 0, 0, 0, 0, 0, 1, 88, '30-03-2024', '30-03-2024'),
(89, 9, 0, 0, 0, 0, 0, 0, 0, 1, 89, '31-03-2024', '31-03-2024'),
(90, 1, 0, 0, 0, 0, 0, 0, 0, 1, 90, '01-04-2024', '01-04-2024'),
(91, 1.45, 0, 0, 0, 0, 0, 0, 0, 1, 91, '02-04-2024', '02-04-2024'),
(92, 0.3, 0, 0, 0, 0, 0, 0, 0, 1, 92, '03-04-2024', '03-04-2024'),
(93, 1, 0, 0, 0, 0, 0, 0, 0, 1, 93, '04-04-2024', '04-04-2024'),
(94, 1.5, 0, 0, 0, 0, 0, 0, 0, 1, 94, '05-04-2024', '05-04-2024'),
(95, 4, 0, 0, 0, 0, 0, 0, 0, 1, 95, '06-04-2024', '06-04-2024'),
(96, 13, 0, 0, 0, 0, 0, 0, 0, 1, 96, '07-04-2024', '07-04-2024'),
(97, 5, 0, 0, 0, 0, 0, 0, 0, 1, 97, '08-04-2024', '08-04-2024'),
(98, 15, 0, 0, 0, 0, 0, 0, 0, 1, 98, '09-04-2024', '09-04-2024'),
(99, 0, 0, 0, 0, 0, 0, 0, 0, 1, 99, '10-04-2024', '10-04-2024'),
(100, 0.4, 0, 0, 0, 0, 0, 0, 0, 1, 100, '11-04-2024', '11-04-2024'),
(101, 44.5, 0, 0, 0, 0, 0, 0, 0, 1, 101, '12-04-2024', '12-04-2024'),
(102, 2, 0, 0, 0, 0, 0, 0, 0, 1, 102, '13-04-2024', '13-04-2024'),
(103, 0, 0, 0, 0, 0, 0, 0, 0, 1, 103, '14-04-2024', '14-04-2024'),
(104, 3, 0, 0, 0, 0, 0, 0, 0, 1, 104, '15-04-2024', '15-04-2024'),
(105, 0.25, 0, 0, 0, 0, 0, 0, 0, 1, 105, '16-04-2024', '16-04-2024'),
(106, 1, 0, 0, 0, 0, 0, 0, 0, 1, 106, '17-04-2024', '17-04-2024'),
(107, 0, 0, 0, 0, 0, 0, 0, 0, 1, 107, '18-04-2024', '18-04-2024'),
(108, 3, 0, 0, 0, 0, 0, 0, 0, 1, 108, '19-04-2024', '19-04-2024'),
(109, 0, 0, 0, 0, 0, 0, 0, 0, 1, 109, '20-04-2024', '20-04-2024'),
(110, 3, 0, 0, 0, 0, 0, 0, 0, 1, 110, '21-04-2024', '21-04-2024'),
(111, 4, 0, 0, 0, 0, 0, 0, 0, 1, 111, '22-04-2024', '22-04-2024'),
(112, 1.5, 0, 0, 0, 0, 0, 0, 0, 1, 112, '23-04-2024', '23-04-2024'),
(113, 3, 0, 0, 0, 0, 0, 0, 0, 1, 113, '24-04-2024', '24-04-2024'),
(114, 1, 0, 0, 0, 0, 0, 0, 0, 1, 114, '25-04-2024', '25-04-2024'),
(115, 7, 0, 0, 0, 0, 0, 0, 0, 1, 115, '26-04-2024', '26-04-2024'),
(116, 0, 0, 0, 0, 0, 0, 0, 0, 1, 116, '27-04-2024', '27-04-2024'),
(117, 0, 0, 0, 0, 0, 0, 0, 0, 1, 117, '28-04-2024', '28-04-2024'),
(118, 0, 0, 0, 0, 0, 0, 0, 0, 1, 118, '29-04-2024', '29-04-2024'),
(119, 0, 0, 0, 0, 0, 0, 0, 0, 1, 119, '30-04-2024', '30-04-2024'),
(120, 0, 0, 0, 0, 0, 0, 0, 0, 1, 120, '01-05-2024', '01-05-2024'),
(121, 0, 0, 0, 0, 0, 0, 0, 0, 1, 121, '02-05-2024', '02-05-2024'),
(122, 0, 0, 0, 0, 0, 0, 0, 0, 1, 122, '03-05-2024', '03-05-2024'),
(123, 0, 0, 0, 0, 0, 0, 0, 0, 1, 123, '04-05-2024', '04-05-2024'),
(124, 3, 0, 0, 0, 0, 0, 0, 0, 1, 124, '05-05-2024', '05-05-2024'),
(125, 0, 0, 0, 0, 0, 0, 0, 0, 1, 125, '06-05-2024', '06-05-2024'),
(126, 0, 0, 0, 0, 0, 0, 0, 0, 1, 126, '07-05-2024', '07-05-2024'),
(127, 5, 0, 0, 0, 0, 0, 0, 0, 1, 127, '08-05-2024', '08-05-2024'),
(128, 0, 0, 0, 0, 0, 0, 0, 0, 1, 128, '09-05-2024', '09-05-2024'),
(129, 8, 0, 0, 0, 0, 0, 0, 0, 1, 129, '10-05-2024', '10-05-2024'),
(130, 0.5, 0, 0, 0, 0, 0, 0, 0, 1, 130, '11-05-2024', '11-05-2024'),
(131, 0, 0, 0, 0, 0, 0, 0, 0, 1, 131, '12-05-2024', '12-05-2024'),
(132, 0, 0, 0, 0, 0, 0, 0, 0, 1, 132, '13-05-2024', '13-05-2024'),
(133, 3, 0, 0, 0, 0, 0, 0, 0, 1, 133, '14-05-2024', '14-05-2024'),
(134, 3, 0, 0, 0, 0, 0, 0, 0, 1, 134, '15-05-2024', '15-05-2024'),
(135, 0, 0, 0, 0, 0, 0, 0, 0, 1, 135, '16-05-2024', '16-05-2024'),
(136, 0, 0, 0, 0, 0, 0, 0, 0, 1, 136, '17-05-2024', '17-05-2024'),
(137, 10, 0, 0, 0, 0, 0, 0, 0, 1, 137, '18-05-2024', '18-05-2024'),
(138, 9, 0, 0, 0, 0, 0, 0, 0, 1, 138, '19-05-2024', '19-05-2024'),
(139, 5, 0, 0, 0, 0, 0, 0, 0, 1, 139, '20-05-2024', '20-05-2024'),
(140, 2, 0, 0, 0, 0, 0, 0, 0, 1, 140, '21-05-2024', '21-05-2024'),
(141, 0, 0, 0, 0, 0, 0, 0, 0, 1, 141, '22-05-2024', '22-05-2024'),
(142, 3, 0, 0, 0, 0, 0, 0, 0, 1, 142, '23-05-2024', '23-05-2024'),
(143, 0, 0, 0, 0, 0, 0, 0, 0, 1, 143, '24-05-2024', '24-05-2024'),
(144, 0, 0, 0, 0, 0, 0, 0, 0, 1, 144, '25-05-2024', '25-05-2024'),
(145, 6, 0, 0, 0, 0, 0, 0, 0, 1, 145, '26-05-2024', '26-05-2024'),
(146, 7, 0, 0, 0, 0, 0, 0, 0, 1, 146, '27-05-2024', '27-05-2024'),
(147, 5, 0, 0, 0, 0, 0, 0, 0, 1, 147, '28-05-2024', '28-05-2024'),
(148, 20, 0, 0, 0, 0, 0, 0, 0, 1, 148, '29-05-2024', '29-05-2024'),
(149, 18, 0, 0, 0, 0, 0, 0, 0, 1, 149, '30-05-2024', '30-05-2024'),
(150, 0, 0, 0, 0, 0, 0, 0, 0, 1, 150, '31-05-2024', '31-05-2024'),
(151, 0, 0, 0, 0, 0, 0, 0, 0, 1, 151, '01-06-2024', '01-06-2024'),
(152, 6, 0, 0, 0, 0, 0, 0, 0, 1, 152, '02-06-2024', '02-06-2024'),
(153, 0, 0, 0, 0, 0, 0, 0, 0, 1, 153, '03-06-2024', '03-06-2024'),
(154, 1, 0, 0, 0, 0, 0, 0, 0, 1, 154, '04-06-2024', '04-06-2024'),
(155, 0, 0, 0, 0, 0, 0, 0, 0, 1, 155, '05-06-2024', '05-06-2024'),
(156, 1, 0, 0, 0, 0, 0, 0, 0, 1, 156, '06-06-2024', '06-06-2024'),
(157, 6, 0, 0, 0, 0, 0, 0, 0, 1, 157, '07-06-2024', '07-06-2024'),
(158, 0, 0, 0, 0, 0, 0, 0, 0, 1, 158, '08-06-2024', '08-06-2024'),
(159, 0, 0, 0, 0, 0, 0, 0, 0, 1, 159, '09-06-2024', '09-06-2024'),
(160, 0, 0, 0, 0, 0, 0, 0, 0, 1, 160, '10-06-2024', '10-06-2024'),
(161, 0, 0, 0, 0, 0, 0, 0, 0, 1, 161, '11-06-2024', '11-06-2024'),
(162, 0, 0, 0, 0, 0, 0, 0, 0, 1, 162, '12-06-2024', '12-06-2024'),
(163, 0, 0, 0, 0, 0, 0, 0, 0, 1, 163, '13-06-2024', '13-06-2024'),
(164, 0, 0, 0, 0, 0, 0, 0, 0, 1, 164, '14-06-2024', '14-06-2024'),
(165, 250, 0, 0, 0, 0, 0, 0, 0, 1, 165, '15-06-2024', '15-06-2024'),
(166, 0, 0, 0, 0, 0, 0, 0, 0, 1, 166, '16-06-2024', '16-06-2024'),
(167, 0, 0, 0, 0, 0, 0, 0, 0, 1, 167, '17-06-2024', '17-06-2024'),
(168, 0, 0, 0, 0, 0, 0, 0, 0, 1, 168, '18-06-2024', '18-06-2024'),
(169, 0, 0, 0, 0, 0, 0, 0, 0, 1, 169, '19-06-2024', '19-06-2024'),
(170, 0, 0, 0, 0, 0, 0, 0, 0, 1, 170, '20-06-2024', '20-06-2024'),
(171, 0, 0, 0, 0, 0, 0, 0, 0, 1, 171, '21-06-2024', '21-06-2024'),
(172, 0, 0, 0, 0, 0, 0, 0, 0, 1, 172, '22-06-2024', '22-06-2024'),
(173, 0, 0, 0, 0, 0, 0, 0, 0, 1, 173, '23-06-2024', '23-06-2024'),
(174, 0, 0, 0, 0, 0, 0, 0, 0, 1, 174, '24-06-2024', '24-06-2024'),
(175, 0, 0, 0, 0, 0, 0, 0, 0, 1, 175, '25-06-2024', '25-06-2024'),
(176, 0, 0, 0, 0, 0, 0, 0, 0, 1, 176, '26-06-2024', '26-06-2024'),
(177, 0, 0, 0, 0, 0, 0, 0, 0, 1, 177, '27-06-2024', '27-06-2024'),
(178, 0, 0, 0, 0, 0, 0, 0, 0, 1, 178, '28-06-2024', '28-06-2024'),
(179, 0, 0, 0, 0, 0, 0, 0, 0, 1, 179, '29-06-2024', '29-06-2024'),
(180, 0, 0, 0, 0, 0, 0, 0, 0, 1, 180, '30-06-2024', '30-06-2024'),
(181, 0, 0, 0, 0, 0, 0, 0, 0, 1, 181, '01-07-2024', '01-07-2024'),
(182, 0, 0, 0, 0, 0, 0, 0, 0, 1, 182, '02-07-2024', '02-07-2024'),
(183, 0, 0, 0, 0, 0, 0, 0, 0, 1, 183, '03-07-2024', '03-07-2024'),
(184, 0, 0, 0, 0, 0, 0, 0, 0, 1, 184, '04-07-2024', '04-07-2024'),
(185, 0, 0, 0, 0, 0, 0, 0, 0, 1, 185, '05-07-2024', '05-07-2024'),
(186, 0, 0, 0, 0, 0, 0, 0, 0, 1, 186, '06-07-2024', '06-07-2024'),
(187, 1, 0, 0, 0, 0, 0, 0, 0, 1, 187, '07-07-2024', '07-07-2024'),
(188, 22, 0, 0, 0, 0, 0, 0, 0, 1, 188, '08-07-2024', '08-07-2024'),
(189, 3, 0, 0, 0, 0, 0, 0, 0, 1, 189, '09-07-2024', '09-07-2024'),
(190, 5, 0, 0, 0, 0, 0, 0, 0, 1, 190, '10-07-2024', '10-07-2024'),
(191, 5, 0, 0, 0, 0, 0, 0, 0, 1, 191, '11-07-2024', '11-07-2024'),
(192, 0, 0, 0, 0, 0, 0, 0, 0, 1, 192, '12-07-2024', '12-07-2024'),
(193, 240, 0, 0, 0, 0, 0, 0, 0, 1, 193, '13-07-2024', '13-07-2024'),
(194, 5, 0, 0, 0, 0, 0, 0, 0, 1, 194, '14-07-2024', '14-07-2024'),
(195, 18, 0, 0, 0, 0, 0, 0, 0, 1, 195, '15-07-2024', '15-07-2024'),
(196, 2, 0, 0, 0, 0, 0, 0, 0, 1, 196, '16-07-2024', '16-07-2024'),
(197, 1, 0, 0, 0, 0, 0, 0, 0, 1, 197, '17-07-2024', '17-07-2024'),
(198, 25, 0, 0, 0, 0, 0, 0, 0, 1, 198, '18-07-2024', '18-07-2024'),
(199, 0, 0, 0, 0, 0, 0, 0, 0, 1, 199, '19-07-2024', '19-07-2024'),
(200, 2, 0, 0, 0, 0, 0, 0, 0, 1, 200, '20-07-2024', '20-07-2024'),
(201, 0, 0, 0, 0, 0, 0, 0, 0, 1, 201, '21-07-2024', '21-07-2024'),
(202, 4, 0, 0, 0, 0, 0, 0, 0, 1, 202, '22-07-2024', '22-07-2024'),
(203, 36, 0, 0, 0, 0, 0, 0, 0, 1, 203, '23-07-2024', '23-07-2024'),
(204, 8, 0, 0, 0, 0, 0, 0, 0, 1, 204, '24-07-2024', '24-07-2024'),
(205, 1, 0, 0, 0, 0, 0, 0, 0, 1, 205, '25-07-2024', '25-07-2024'),
(206, 2, 0, 0, 0, 0, 0, 0, 0, 1, 206, '26-07-2024', '26-07-2024'),
(207, 4, 0, 0, 0, 0, 0, 0, 0, 1, 207, '27-07-2024', '27-07-2024'),
(208, 1, 0, 0, 0, 0, 0, 0, 0, 1, 208, '28-07-2024', '28-07-2024'),
(209, 4, 0, 0, 0, 0, 0, 0, 0, 1, 209, '29-07-2024', '29-07-2024'),
(210, 4, 0, 0, 0, 0, 0, 0, 0, 1, 210, '30-07-2024', '30-07-2024'),
(211, 2, 0, 0, 0, 0, 0, 0, 0, 1, 211, '31-07-2024', '31-07-2024'),
(212, 2, 0, 0, 0, 0, 0, 0, 0, 1, 212, '01-08-2024', '01-08-2024'),
(213, 1, 0, 0, 0, 0, 0, 0, 0, 1, 213, '02-08-2024', '02-08-2024'),
(214, 1, 0, 0, 0, 0, 0, 0, 0, 1, 214, '03-08-2024', '03-08-2024'),
(215, 40, 0, 0, 0, 0, 0, 0, 0, 1, 215, '04-08-2024', '04-08-2024'),
(216, 1, 0, 0, 0, 0, 0, 0, 0, 1, 216, '05-08-2024', '05-08-2024'),
(217, 0, 0, 0, 0, 0, 0, 0, 0, 1, 217, '06-08-2024', '06-08-2024'),
(218, 1, 0, 0, 0, 0, 0, 0, 0, 1, 218, '07-08-2024', '07-08-2024'),
(219, 30, 1, 3000, 94494.75, 90000, 4499.75, 5, 0, 1, 80, '2024-03-04', '2024-01-04'),
(220, 30, 2, 60, 1790, 1800, 0, 10, 0, 1, 37, '2024-03-04', '2024-01-04');

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
(1, 220, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(2, 221, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(3, 222, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(4, 223, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(5, 224, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(6, 225, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(7, 226, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(8, 227, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(9, 228, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(10, 229, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(11, 230, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(12, 231, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(13, 232, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(14, 233, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(15, 234, 0, 0, 0, 0, 0, 1, '2024-01-04', ''),
(16, 235, 0, 0, 0, 0, 0, 1, '2024-01-04', '');

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
  `status` varchar(20) NOT NULL,
  `type` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabledata`
--

INSERT INTO `tabledata` (`slno`, `date`, `itmno`, `itmnam`, `prc`, `qty`, `tot`, `tabno`, `billno`, `time`, `kot_num`, `status`, `type`) VALUES
(1, '2024-01-05', 102, 'LASSI (SWEET/SALT)', 120, 1, 120, 't-7', 1, '02:09 PM', 0, '', 0),
(2, '2024-01-05', 107, 'BOTTLED WATER', 23.8, 1, 23.8, 'T-6', 3, '02:16 PM', 0, '', 0),
(3, '2024-01-05', 393, 'TANDOORI CHICKEN HALF', 240, 1, 240, 'T-6', 3, '02:16 PM', 0, '', 0),
(4, '2024-01-05', 399, 'EGG BHURJI', 80, 1, 80, 'T-6', 3, '02:16 PM', 0, '', 0),
(5, '2024-01-05', 105, 'FRESH LIME SODA', 60, 2, 120, 'T-10', 2, '02:13 PM', 0, '', 0),
(6, '2024-01-05', 107, 'BOTTLED WATER', 23.8, 2, 47.6, 'T-10', 2, '02:13 PM', 0, '', 0),
(7, '2024-01-05', 132, 'CRIPSY ASSORTED VEGETABLES', 160, 1, 160, 'T-10', 2, '02:13 PM', 0, '', 0),
(8, '2024-01-05', 194, 'PANEER TIKKA LAL BAHADUR', 175, 1, 175, 'T-10', 2, '02:13 PM', 0, '', 0),
(9, '2024-01-05', 257, 'PANEER TIKKA LABABDAR', 175, 1, 175, 'T-10', 2, '02:13 PM', 0, '', 0),
(10, '2024-01-05', 293, 'TANDOORI ROTI', 20, 6, 120, 'T-10', 2, '02:13 PM', 0, '', 0),
(11, '2024-01-05', 351, 'VEG FRIED RICE', 150, 1, 150, 'T-10', 2, '02:13 PM', 0, '', 0),
(12, '2024-01-05', 102, 'LASSI (SWEET/SALT)', 120, 1, 120, 'T-3', 4, '02:28 PM', 0, '', 0),
(13, '2024-01-05', 107, 'BOTTLED WATER', 23.8, 1, 23.8, 'T-3', 4, '02:27 PM', 0, '', 0),
(14, '2024-01-05', 194, 'PANEER TIKKA LAL BAHADUR', 175, 1, 175, 'T-3', 4, '02:27 PM', 0, '', 0),
(15, '2024-01-05', 329, 'MURGH KI KACHI DUM BIRYANI', 200, 1, 200, 'T-3', 4, '02:28 PM', 0, '', 0),
(16, '2024-01-05', 422, 'PARCEL CHARGE', 10, 2, 20, 'T-3', 4, '02:28 PM', 0, '', 0),
(17, '2024-01-05', 537, 'CHICKEN LOLYPOP', 200, 1, 200, 'T-3', 4, '02:28 PM', 0, '', 0),
(18, '2024-01-05', 984, 'MURGH IRANI KABAB', 350, 3, 1050, 'T-3', 4, '02:28 PM', 0, '', 0),
(19, '2024-01-05', 1393, 'DEW 300ML', 30, 2, 60, 'T-3', 4, '02:28 PM', 0, '', 0),
(27, '2024-01-05', 107, 'BOTTLED WATER', 23.8, 1, 23.8, 'T-4', 5, '02:34 PM', 0, '', 0),
(28, '2024-01-05', 116, 'HOT N SOUR SOUP(V)', 90, 1, 90, 'T-4', 5, '02:34 PM', 0, '', 0),
(29, '2024-01-05', 194, 'PANEER TIKKA LAL BAHADUR', 175, 1, 175, 'T-4', 5, '02:34 PM', 0, '', 0),
(30, '2024-01-05', 293, 'TANDOORI ROTI', 20, 1, 20, 'T-4', 5, '02:34 PM', 0, '', 0),
(31, '2024-01-05', 364, 'BUTTER GARLIC NAAN', 100, 1, 100, 'T-4', 5, '02:34 PM', 0, '', 0),
(32, '2024-01-05', 369, 'FRENCH FRIES', 120, 1, 120, 'T-4', 5, '02:34 PM', 0, '', 0),
(33, '2024-01-05', 721, 'VEG BHUNA', 160, 1, 160, 'T-4', 5, '02:38 PM', 0, '', 0),
(34, '2024-01-05', 103, 'CHAAS (BUTTER MILK)', 120, 2, 240, 'T-9', 6, '02:49 PM', 0, '', 0),
(35, '2024-01-05', 107, 'BOTTLED WATER', 23.8, 1, 23.8, 'T-9', 6, '02:48 PM', 0, '', 0),
(36, '2024-01-05', 114, 'MANCHOW SOUP (V)', 90, 2, 180, 'T-9', 6, '02:48 PM', 0, '', 0),
(37, '2024-01-05', 132, 'CRIPSY ASSORTED VEGETABLES', 160, 1, 160, 'T-9', 6, '02:48 PM', 0, '', 0),
(38, '2024-01-05', 243, 'DAL DOUBLE TADKA', 135, 1, 135, 'T-9', 6, '02:48 PM', 0, '', 0),
(39, '2024-01-05', 257, 'PANEER TIKKA LABABDAR', 175, 1, 175, 'T-9', 6, '02:48 PM', 0, '', 0),
(40, '2024-01-05', 293, 'TANDOORI ROTI', 20, 6, 120, 'T-9', 6, '02:48 PM', 0, '', 0),
(41, '2024-01-05', 324, 'JEERA CHAWAL', 110, 1, 110, 'T-9', 6, '02:48 PM', 0, '', 0),
(49, '2024-01-05', 107, 'BOTTLED WATER', 23.8, 1, 23.8, 'T-1', 7, '03:09 PM', 0, '', 0),
(50, '2024-01-05', 105, 'FRESH LIME SODA', 60, 1, 60, 'T-5', 8, '03:23 PM', 0, '', 0),
(51, '2024-01-05', 107, 'BOTTLED WATER', 23.8, 1, 23.8, 'T-5', 8, '03:23 PM', 0, '', 0),
(52, '2024-01-05', 216, 'TAWA MUTTON DRY FRY', 310, 1, 310, 'T-5', 8, '03:23 PM', 0, '', 0),
(53, '2024-01-05', 332, 'MUTTON HYDERABADI BIRYANI', 260, 1, 260, 'T-5', 8, '03:23 PM', 0, '', 0),
(54, '2024-01-05', 841, 'LASSI (SWEET/SALT) HALF', 80, 1, 80, 'T-5', 8, '03:23 PM', 0, '', 0),
(57, '2024-01-05', 107, 'BOTTLED WATER', 23.8, 2, 47.6, 'T-1', 9, '03:24 PM', 0, '', 0),
(58, '2024-01-05', 145, 'HONG KONG CHICKEN', 175, 1, 175, 'T-1', 9, '03:24 PM', 0, '', 0),
(59, '2024-01-05', 194, 'PANEER TIKKA LAL BAHADUR', 175, 1, 175, 'T-1', 9, '03:24 PM', 0, '', 0),
(60, '2024-01-05', 329, 'MURGH KI KACHI DUM BIRYANI', 200, 1, 200, 'T-1', 9, '03:38 PM', 0, '', 0),
(61, '2024-01-05', 393, 'TANDOORI CHICKEN HALF', 240, 1, 240, 'T-1', 9, '03:24 PM', 0, '', 0),
(62, '2024-01-05', 535, 'CRISPY CORN & PEPPER DRY', 160, 1, 160, 'T-1', 9, '03:24 PM', 0, '', 0),
(64, '2024-01-05', 107, 'BOTTLED WATER', 23.8, 1, 23.8, 'T-10', 10, '03:45 PM', 0, '', 0),
(65, '2024-01-05', 211, 'TANGRI MUMTAJ', 300, 1, 300, 'T-10', 10, '03:45 PM', 0, '', 0),
(66, '2024-01-05', 264, 'MURGH LABABDAR', 225, 1, 225, 'T-10', 10, '03:45 PM', 0, '', 0),
(67, '2024-01-05', 293, 'TANDOORI ROTI', 20, 2, 40, 'T-10', 10, '03:45 PM', 0, '', 0),
(68, '2024-01-05', 329, 'MURGH KI KACHI DUM BIRYANI', 200, 1, 200, 'T-10', 10, '03:45 PM', 0, '', 0),
(69, '2024-01-05', 535, 'CRISPY CORN & PEPPER DRY', 160, 1, 160, 'T-10', 10, '03:45 PM', 0, '', 0),
(71, '2024-01-05', 183, 'SCHEZWAN FRIED RICE(NV)', 170, 1, 170, 'T-6', 11, '04:22 PM', 0, '', 0),
(72, '2024-01-05', 292, 'MASALA PAPAD', 50, 1, 50, 'T-6', 11, '03:56 PM', 0, '', 0),
(73, '2024-01-05', 645, 'HONG KONG STYLE', 160, 1, 160, 'T-6', 11, '03:55 PM', 0, '', 0),
(74, '2024-01-05', 841, 'LASSI (SWEET/SALT) HALF', 80, 1, 80, 'T-6', 11, '03:56 PM', 0, '', 0),
(78, '2024-01-05', 107, 'BOTTLED WATER', 23.8, 6, 142.8, 'G-1', 12, '03:56 PM', 0, '', 0),
(79, '2024-01-05', 290, 'ROASTED PAPAD', 20, 4, 80, 'G-1', 12, '03:56 PM', 0, '', 0),
(80, '2024-01-05', 344, 'PEANUT MASALA', 50, 4, 200, 'G-1', 12, '03:57 PM', 0, '', 0),
(81, '2024-01-05', 482, 'SHAAN E ALOO (NV)', 350, 2, 700, 'G-1', 12, '03:57 PM', 0, '', 0),
(82, '2024-01-05', 554, 'GREEN LIME MOJITO SODA', 80, 1, 80, 'G-1', 12, '03:57 PM', 0, '', 0),
(83, '2024-01-05', 562, 'BOTLED SODA 750ML', 30, 2, 60, 'G-1', 12, '03:56 PM', 0, '', 0),
(84, '2024-01-05', 699, 'KHUMB KHAZANA', 250, 1, 250, 'G-1', 12, '03:56 PM', 0, '', 0),
(85, '2024-01-05', 1206, 'AFGHANI KABAB', 300, 3, 900, 'G-1', 12, '03:57 PM', 0, '', 0);

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
  `time` varchar(50) NOT NULL,
  `type` double NOT NULL,
  `pid` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '2024-01-05', 'CHI BIRYANI TANDOORI', 598, 240, 1, 240, 'T-1', 'Naheed', 0, 3, '03:24 PM', 0),
(2, '2024-01-05', 'SCHEZWAN FRIED RICE(V)', 182, 150, 1, 150, 'T-6', 'Naheed', 0, 3, '03:55 PM', 0),
(3, '2024-01-05', 'BOTTLED WATER', 107, 23.8, 1, 23.8, 'T-6', 'Naheed', 0, 3, '03:56 PM', 0);

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
  `uid` int(10) NOT NULL,
  `qtycheck` varchar(50) NOT NULL
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
  `settle` int(10) NOT NULL,
  `billno` double NOT NULL,
  `venId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `dayshedule`
--
ALTER TABLE `dayshedule`
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
-- Indexes for table `kot_cancel`
--
ALTER TABLE `kot_cancel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `log_info`
--
ALTER TABLE `log_info`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assetspurchase`
--
ALTER TABLE `assetspurchase`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assetspurchasedata`
--
ALTER TABLE `assetspurchasedata`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assetsstock`
--
ALTER TABLE `assetsstock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beverages`
--
ALTER TABLE `beverages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categoroy`
--
ALTER TABLE `categoroy`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `dayshedule`
--
ALTER TABLE `dayshedule`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `empreg`
--
ALTER TABLE `empreg`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `slno` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1298;

--
-- AUTO_INCREMENT for table `kot_cancel`
--
ALTER TABLE `kot_cancel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `logid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `log_info`
--
ALTER TABLE `log_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parcelmaterial`
--
ALTER TABLE `parcelmaterial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `purchase_data`
--
ALTER TABLE `purchase_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `store_kitchen`
--
ALTER TABLE `store_kitchen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_stock`
--
ALTER TABLE `store_stock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tabledata`
--
ALTER TABLE `tabledata`
  MODIFY `slno` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `temtable`
--
ALTER TABLE `temtable`
  MODIFY `slno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `trash`
--
ALTER TABLE `trash`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trash_bill`
--
ALTER TABLE `trash_bill`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

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

--
-- AUTO_INCREMENT for table `wastage`
--
ALTER TABLE `wastage`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
