-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2025 at 02:39 PM
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
-- Database: `survey_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `question_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `survey_id`, `user_id`, `answer`, `question_id`, `date_created`) VALUES
(1, 1, 2, 'Sample Only', 4, '2020-11-10 14:46:07'),
(2, 1, 2, '[JNmhW],[zZpTE]', 2, '2020-11-10 14:46:07'),
(3, 1, 2, 'dAWTD', 1, '2020-11-10 14:46:07'),
(4, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in tempus turpis, sed fermentum risus. Praesent vitae velit rutrum, dictum massa nec, pharetra felis. Phasellus enim augue, laoreet in accumsan dictum, mollis nec lectus. Aliquam id viverra nisl. Proin quis posuere nulla. Nullam suscipit eget leo ut suscipit.', 4, '2020-11-10 15:59:43'),
(5, 1, 3, '[qCMGO],[JNmhW]', 2, '2020-11-10 15:59:43'),
(6, 1, 3, 'esNuP', 1, '2020-11-10 15:59:43'),
(7, 6, 4, 'UzLcW', 6, '2023-02-20 21:59:57'),
(8, 7, 4, 'fMLzB', 7, '2023-02-21 00:30:48'),
(9, 7, 4, 'xrBJw', 8, '2023-02-21 00:30:48'),
(10, 8, 13, 'LfmKN', 9, '2023-02-23 18:45:57'),
(11, 8, 13, '24', 10, '2023-02-23 18:45:57'),
(12, 8, 13, 'NjEGP', 11, '2023-02-23 18:45:57'),
(13, 15, 16, 'xiJVI', 13, '2023-04-23 21:32:31'),
(14, 15, 16, 'j', 14, '2023-04-23 21:32:32'),
(15, 16, 1, '[akxVj]', 15, '2023-04-23 22:12:43'),
(16, 15, 1, 'xiJVI', 13, '2023-04-23 22:12:58'),
(17, 15, 1, '', 14, '2023-04-23 22:12:58'),
(18, 23, 12, 'Sarvess', 21, '2023-05-01 22:53:52'),
(19, 24, 12, '24', 22, '2023-05-01 23:20:17'),
(20, 35, 12, '24', 23, '2023-05-02 02:10:09'),
(21, 50, 12, 'SqhNv', 24, '2023-05-02 03:44:47'),
(22, 50, 17, 'lpjxy', 24, '2023-05-02 03:45:11'),
(23, 52, 17, 'nishalini', 25, '2023-05-13 16:09:22'),
(24, 52, 17, '[lBrKo]', 26, '2023-05-13 16:09:22'),
(25, 52, 17, 'Batu Caves', 27, '2023-05-13 16:09:22'),
(31, 56, 19, 'ZVOCp', 33, '2023-05-22 00:22:06'),
(32, 56, 19, '[hYoVq]', 34, '2023-05-22 00:22:06'),
(33, 56, 17, 'ZVOCp', 33, '2023-05-22 00:28:11'),
(34, 56, 17, '[hYoVq]', 34, '2023-05-22 00:28:11'),
(35, 58, 17, 'sas', 35, '2023-05-22 00:29:58'),
(36, 58, 17, 'sadas', 36, '2023-05-22 00:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `description`, `created_at`) VALUES
(5, 'Assessment-Quizzes ', 'Assessment-Quizzes ', '2023-02-23 14:56:26'),
(6, 'Education Templates ', 'Templates for Education', '2023-02-23 14:56:52'),
(7, 'Technology Usability Templates', 'Templates for Technology', '2023-02-23 14:57:19'),
(8, 'User Testing Templates ', 'Templates for User Testing', '2023-02-23 14:58:02'),
(9, 'Healthcare Templates', 'Templates for Healtcare', '2023-02-23 14:58:29'),
(10, 'Business Templates', 'Templates for Business', '2023-02-23 14:58:52'),
(11, 'Marketing Templates', 'Templates for Marketing', '2023-02-23 14:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Message` varchar(2555) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ID`, `Name`, `Email`, `Message`, `created_at`) VALUES
(8, 'Thilo', 'thiloshinii99@gmail.com', 'Test2', '2023-02-23 10:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `ingredient_code` varchar(10) NOT NULL,
  `ingredient_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `current_quantity` int(11) NOT NULL,
  `measurement` varchar(50) NOT NULL,
  `supplier_detail` varchar(300) NOT NULL,
  `date_in` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `ingredient_code`, `ingredient_name`, `category`, `current_quantity`, `measurement`, `supplier_detail`, `date_in`, `expiration_date`) VALUES
(1, 'TEP001', 'TEPUNG', 'Dry Ingredient', 400, 'KG', 'TEPUNG BINTANG SDN BHD', '2025-01-06', '2026-01-06'),
(2, 'TEP001', 'TEPUNG', 'Dry Ingredient', 50, 'KG', 'TEPUNG BINTANG SDN BHD', '2025-01-06', '2025-02-06'),
(3, 'KOKO001', 'SERBUK KOKO', 'Dry Ingredient', 40, 'KG', 'KOKO MU SDN BHD', '2025-01-06', '2025-03-06'),
(4, 'KEJU001', 'KEJU', 'Dairy Product', 900, 'BLOCK', 'KEJU KHAS SDN BHD', '2025-01-06', '2025-05-06'),
(5, 'KEJU001', 'KEJU', 'Dairy Product', 200, 'BLOCK', 'KEJU KHAS SDN BHD', '2024-11-06', '2025-01-01'),
(6, 'KEJU001', 'KEJU', 'Dairy Product', 50, 'BLOCK', 'KEJU BINTANG SDN BHD', '2024-12-31', '2025-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `in_out_tracking`
--

CREATE TABLE `in_out_tracking` (
  `out_id` int(11) NOT NULL,
  `track_status` varchar(10) NOT NULL,
  `ingredient_code` varchar(10) NOT NULL,
  `ingredient_name` varchar(200) NOT NULL,
  `supplier_detail` varchar(300) DEFAULT NULL,
  `quantity_in` int(11) DEFAULT NULL,
  `date_in` date DEFAULT NULL,
  `quantity_out` int(11) DEFAULT NULL,
  `date_out` date DEFAULT NULL,
  `description` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `in_out_tracking`
--

INSERT INTO `in_out_tracking` (`out_id`, `track_status`, `ingredient_code`, `ingredient_name`, `supplier_detail`, `quantity_in`, `date_in`, `quantity_out`, `date_out`, `description`) VALUES
(1, 'OUT', 'TEP001', 'TEPUNG', 'TEPUNG BINTANG SDN BHD', NULL, NULL, 100, '2025-01-06', 'OUT FOR ROTI STRAWBERRY'),
(2, 'OUT', 'KOKO001', 'SERBUK KOKO', 'KOKO MU SDN BHD', NULL, NULL, 250, '2025-01-06', 'OUT FOR CHEESECAKE'),
(4, 'OUT', 'TEP001', 'TEPUNG', 'TEPUNG BINTANG SDN BHD', NULL, NULL, 150, '2025-01-06', 'Ingredient used immediately.');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `ID` int(11) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(20) DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'About Us', 'Welcome to Roti Sri Bakery, where passion for baking meets the joy of sharing delicious moments with you. Established with a commitment to delivering fresh, high-quality baked goods, we take pride in crafting every loaf, pastry, and dessert with care, love, and attention to detail.\r\n\r\nAt Roti Sri Bakery, we believe that every bite tells a story. Using only the finest ingredients, our team of skilled bakers works tirelessly to create a wide variety of baked goods, from traditional favorites to modern innovations. Whether you’re looking for soft, fluffy bread, decadent cakes, or savory treats, our bakery offers something for every taste and occasion.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `frm_option` text NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `order_by` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `question`, `frm_option`, `instruction`, `type`, `order_by`, `survey_id`, `date_created`) VALUES
(1, 0, 'Sample Survey Question using Radio Button', '{\"cKWLY\":\"Option 1\",\"esNuP\":\"Option 2\",\"dAWTD\":\"Option 3\",\"eZCpf\":\"Option 4\"}', '', 'radio_opt', 3, 1, '2020-11-10 12:04:46'),
(2, 0, 'Question for Checkboxes', '{\"qCMGO\":\"Checkbox label 1\",\"JNmhW\":\"Checkbox label 2\",\"zZpTE\":\"Checkbox label 3\",\"dOeJi\":\"Checkbox label 4\"}', '', 'check_opt', 2, 1, '2020-11-10 12:25:13'),
(4, 0, 'Sample question for the text field', '', '', 'textfield_s', 1, 1, '2020-11-10 13:34:21'),
(5, 0, 'What is Your Name', '', '', 'textfield_s', 0, 3, '2023-01-08 13:46:10'),
(6, 0, 'Whats My name', '{\"rAiwW\":\"Nishalini\",\"UzLcW\":\"Sarvess\",\"ehyTa\":\"Gopal\",\"OqMGP\":\"Sitha\"}', '', 'radio_opt', 0, 6, '2023-02-20 21:58:03'),
(7, 0, 'When is New Year', '{\"fMLzB\":\"31 December 2022\",\"cOSEU\":\"30 December 2022\",\"ocZtA\":\"29 December 2022\"}', '', 'radio_opt', 0, 7, '2023-02-21 00:24:03'),
(8, 0, 'Which Day New Year will be', '{\"xrBJw\":\"Saturday\",\"dviTM\":\"Sunday\",\"PEtDL\":\"Monday\"}', '', 'radio_opt', 0, 7, '2023-02-21 00:25:06'),
(9, 0, 'My Age', '{\"tOqIg\":\"23\",\"AngZt\":\"24\",\"WdKyV\":\"25\"}', '', 'radio_opt', 0, 8, '2023-02-23 18:43:36'),
(11, 0, 'Where I lived?', '{\"NjEGP\":\"Penang\",\"BYuOP\":\"Pahang\",\"siWht\":\"KL\"}', '', 'radio_opt', 0, 8, '2023-02-23 18:45:21'),
(13, 0, 'What is your name', '{\"aKRGW\":\"No Name\",\"xiJVI\":\"Hello\"}', '', 'radio_opt', 0, 15, '2023-04-23 21:18:57'),
(14, 0, 'What is your age ?', '', '', 'textfield_s', 0, 15, '2023-04-23 21:19:17'),
(15, 0, 'Hai', '{\"akxVj\":\"Anweer\",\"qsxbD\":\"Answer\"}', '', 'check_opt', 0, 16, '2023-04-23 22:12:24'),
(16, 0, 'What is Your Name ?', '', '', 'textfield_s', 0, 19, '2023-05-01 22:02:09'),
(17, 0, 'How Old Are You?', '', '', 'textfield_s', 0, 19, '2023-05-01 22:02:26'),
(18, 0, 'What is your gender ?', '{\"hQxbA\":\"Male\",\"uYciC\":\"Female\"}', '', 'radio_opt', 0, 19, '2023-05-01 22:03:23'),
(19, 0, 'What is my name?', '', '', 'textfield_s', 0, 21, '2023-05-01 22:23:57'),
(20, 0, 'When is Labour Day', '{\"MWCAH\":\"1 May\",\"kDtSW\":\"2 May\"}', '', 'check_opt', 0, 22, '2023-05-01 22:27:15'),
(21, 0, 'What is Your NAme', '', '', 'textfield_s', 0, 23, '2023-05-01 22:53:30'),
(22, 0, 'How old are you', '', '', 'textfield_s', 0, 24, '2023-05-01 23:20:00'),
(23, 0, 'How old are you', '', '', 'textfield_s', 0, 35, '2023-05-02 02:06:12'),
(24, 0, 'How are you', '{\"QkBGX\":\"Im Fine\",\"nPlXL\":\"Not fine\"}', 'instruc', 'radio_opt', 0, 50, '2023-05-02 03:44:31'),
(25, 0, 'Question 1: What is your name ?', '', 'Please Fill in the blanks.', 'textfield_s', 0, 52, '2023-05-13 16:07:59'),
(26, 0, 'How old are you?', '{\"bThdQ\":\"21\",\"lBrKo\":\"23\"}', '', 'check_opt', 0, 52, '2023-05-13 16:08:25'),
(27, 0, 'Where do you live?', '', '', 'textfield_s', 0, 52, '2023-05-13 16:08:40'),
(28, 0, 'What is your naame', '{\"lQZNt\":\"\",\"olFib\":\"\"}', '', 'check_opt', 0, 53, '2023-05-13 16:26:30'),
(29, 0, 'dsfsfd', '{\"cfCGq\":\"\",\"QfvqD\":\"\"}', '', 'check_opt', 0, 50, '2023-05-21 23:33:19'),
(30, 0, 'Helllo', '{\"OUqsw\":\"Agree\",\"YqcEe\":\"Disagree\"}', 'Fill In the balnks', 'check_opt', 0, 52, '2023-05-21 23:53:22'),
(31, 0, 'Are you male or female ?', '{\"qNHmZ\":\"Male\",\"AwQhL\":\"Femlae\",\"AMeTN\":\"Both\"}', 'Select your option', 'radio_opt', 0, 52, '2023-05-21 23:58:27'),
(32, 0, 'Section 1', '{\"TJkts\":\"Male\",\"UvAol\":\"Femaal\"}', 'Please choose your correct answer?', 'check_opt', 0, 52, '2023-05-22 00:01:18'),
(33, 0, 'What is SEP?', '{\"YvlAR\":\"Software Engineering Practice\",\"ZVOCp\":\"SEP\"}', 'Section 1: Please choose the correct answer?', 'radio_opt', 0, 56, '2023-05-22 00:07:37'),
(34, 0, 'SEP', '{\"hYoVq\":\"\",\"Glpfr\":\"\"}', '', 'check_opt', 0, 56, '2023-05-22 00:08:03'),
(35, 0, 'Whats your name', '', '', 'textfield_s', 0, 58, '2023-05-22 00:29:11'),
(36, 0, 'sdsd', '', '', 'textfield_s', 0, 58, '2023-05-22 00:29:30');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `product_code` varchar(100) NOT NULL,
  `product_name` varchar(120) NOT NULL,
  `year` year(4) NOT NULL,
  `month` varchar(120) NOT NULL,
  `sales` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`product_code`, `product_name`, `year`, `month`, `sales`) VALUES
('B001', 'Roti Coklat', '2024', 'November', 201.9),
('B002', 'Roti Pisang', '2024', 'November', 245),
('B003', 'Roti Krim', '2024', 'November', 180),
('B004', 'Sourdough', '2024', 'November', 265),
('C001', 'Chocolate Cake', '2024', 'November', 295.9),
('C002', 'Cheese Cake', '2024', 'November', 312.9),
('C003', 'Chocolate Moist Cake', '2025', 'January', 295),
('P001', 'Pain Au Chocolate', '2025', 'January', 227.95);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `num` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `supplier_ingredient` varchar(100) NOT NULL,
  `current_price` decimal(10,2) NOT NULL,
  `measurement` varchar(50) DEFAULT NULL,
  `supplier_performance` enum('1','2','3') NOT NULL COMMENT '1: Bad, 2: Good, 3: Excellent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`num`, `code`, `supplier_name`, `contact_number`, `supplier_ingredient`, `current_price`, `measurement`, `supplier_performance`) VALUES
(1, 'SUPTEP001', 'TEPUNG BINTANG SDN BHD', '051234889', 'TEPUNG', 4.50, 'KG', '2'),
(2, 'SUPTEP002', 'TEPUNG KITA SDN BHD', '045666788', 'TEPUNG', 4.20, 'KG', '3'),
(3, 'SUPKEJ001', 'KEJU BINTANG SDN BHD', '098765422', 'KEJU', 10.50, 'BLOCK', '2'),
(4, 'SUPKEJ002', 'KEJU KHAS SDN BHD', '05678900', 'KEJU', 9.90, 'BLOCK', '2'),
(5, 'SUPKOKO001', 'KOKO MU SDN BHD', '05666778', 'SERBUK KOKO', 16.00, 'KG', '1');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_orders`
--

CREATE TABLE `supplier_orders` (
  `num` int(11) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `status` enum('delivered','ongoing') NOT NULL,
  `order_date` date NOT NULL,
  `delivered_date` date DEFAULT NULL,
  `supplier_code` varchar(50) DEFAULT NULL,
  `supplier_name` varchar(100) DEFAULT NULL,
  `ingredient` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_orders`
--

INSERT INTO `supplier_orders` (`num`, `order_id`, `status`, `order_date`, `delivered_date`, `supplier_code`, `supplier_name`, `ingredient`, `price`, `quantity`) VALUES
(1, 'ORD001', 'delivered', '2024-12-01', '2024-12-31', NULL, NULL, NULL, NULL, NULL),
(2, 'ORD002', 'ongoing', '2024-12-15', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'ORD003', 'delivered', '2024-12-10', '2024-12-15', NULL, NULL, NULL, NULL, NULL),
(4, 'ORD004', 'ongoing', '2025-01-01', NULL, 'SUP004', 'Supplier D', 'Flour', 50.00, 100),
(5, 'ORD005', 'delivered', '2025-01-02', '2025-01-03', 'SUP005', 'Supplier E', 'Sugar', 40.00, 50),
(6, 'ORD006', 'ongoing', '2025-01-03', NULL, 'SUP006', 'Supplier F', 'Butter', 70.00, 30),
(7, 'ORD007', 'delivered', '2025-01-04', '2025-01-06', 'SUP007', 'Supplier G', 'Milk', 30.00, 20),
(8, 'ORD008', 'delivered', '2025-01-05', '2025-01-06', 'SUP008', 'Supplier H', 'Eggs', 20.00, 60);

-- --------------------------------------------------------

--
-- Table structure for table `survey_set`
--

CREATE TABLE `survey_set` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `respondent` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_set`
--

INSERT INTO `survey_set` (`id`, `title`, `description`, `category`, `user_id`, `respondent`, `start_date`, `end_date`, `date_created`) VALUES
(50, 'dddd', 'ddd', 'User Testing Templates  ', 16, '12 ,17 ,19 ', '2023-05-02', '2023-05-18', '2023-05-02 03:32:03'),
(51, 'Hello', 'helo2', 'Assessment-Quizzes  ', 10, '12,17', '2023-05-03', '2023-05-06', '2023-05-03 00:36:15'),
(52, 'Latest', 'Latest', 'Education Templates  ', 16, '12,17,19 ', '2023-05-12', '2023-05-20', '2023-05-13 16:07:38'),
(53, 'Report Errors', 'sdsfsds', 'Education Templates  ', 16, '12,17', '2023-05-13', '2023-05-20', '2023-05-13 16:26:01'),
(56, 'Quiz 1', 'SEP Quiz', 'Education Templates  ', 16, '17,19, 20', '2023-05-21', '2023-05-27', '2023-05-22 00:06:41'),
(57, 'Wake up', 'asssdsd', 'Education Templates  ', 16, '17 ,19 ', '2023-05-22', '2023-05-25', '2023-05-22 00:24:10'),
(58, 'DODO', 'dodo', 'Assessment-Quizzes  ', 16, '12,17,19', '2023-05-22', '2023-05-26', '2023-05-22 00:27:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2 = Inventory Supervisor, 3= Clerk',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `otp` varchar(6) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `contact`, `email`, `password`, `type`, `date_created`, `otp`, `is_verified`) VALUES
(1, 'Administrator', '+123456789', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1, '2020-11-10 08:43:06', NULL, 0),
(10, 'SARVESS', '0143057131', 'sarvess.jr@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, '2023-02-21 16:26:14', NULL, 0),
(12, 'SARVESS', '0143057131', 'sarvessveeri2312@gmail.com', '', 3, '2023-02-23 18:35:49', NULL, 0),
(16, 'Sarvess', '+60143057131', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, '2023-04-22 15:31:44', NULL, 0),
(17, 'Nishalini', '', 'nishalini1506@gmail.com', '1fbfc2633b512f3dbdb7dcde101cff21', 3, '2023-05-01 22:34:58', NULL, 0),
(19, 'Sarvess Veeriyah', '+60143057131', 'admin@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 3, '2023-05-15 16:52:56', NULL, 0),
(84, 'nurinjati', '0194091159', 'nurinwhalecome@gmail.com', '85773ef940338eabe57cff362e251036', 2, '2025-01-05 00:14:45', '890140', 1),
(87, 'jati', '0123456789', 'wintermeloninkyoto@gmail.com', '85773ef940338eabe57cff362e251036', 3, '2025-01-05 16:09:36', '578053', 1),
(88, 'mizan', '0102342324', 'mizann1912@gmail.com', '9070531bb00437411452d6ee8b6cb06b', 2, '2025-01-05 21:10:39', '172863', 1),
(91, 'nisaa', '01126727297', 'wereen0909@gmail.com', '3f305b7626d13e9ca315323f2ad704ba', 2, '2025-01-06 20:25:55', '720098', 1),
(92, 'nisaw', '011267627297', 'khairun0960@gmail.com', '3f305b7626d13e9ca315323f2ad704ba', 3, '2025-01-06 21:26:39', '773740', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_out_tracking`
--
ALTER TABLE `in_out_tracking`
  ADD PRIMARY KEY (`out_id`),
  ADD KEY `fk_cquantity` (`ingredient_code`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`product_code`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`num`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `supplier_orders`
--
ALTER TABLE `supplier_orders`
  ADD PRIMARY KEY (`num`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `survey_set`
--
ALTER TABLE `survey_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `in_out_tracking`
--
ALTER TABLE `in_out_tracking`
  MODIFY `out_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier_orders`
--
ALTER TABLE `supplier_orders`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `survey_set`
--
ALTER TABLE `survey_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
