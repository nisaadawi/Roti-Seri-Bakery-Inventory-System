-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 11:02 AM
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
(25, 52, 17, 'Batu Caves', 27, '2023-05-13 16:09:22');

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
(1, 'aboutus', 'About Us', '<div style=\"text-align: start;\"><font color=\"#7b8898\"><span style=\"font-size: 15px; background-color: rgb(255, 255, 255);\">Welcome to our survey management system! We are a team of experienced software developers who have created a platform designed to simplify the process of conducting and analyzing surveys.\n\nOur goal is to provide a user-friendly interface that makes it easy for organizations of all sizes to gather valuable insights from their customers, employees, or any other target audience. Our system allows you to design custom surveys, distribute them via various channels, and collect responses in real-time.\n\nOur team is dedicated to ensuring that our platform meets the highest standards of security and data privacy. We take the protection of your data seriously and have implemented robust measures to ensure that your information is always safe.\n\nWhether you\'re conducting market research, customer satisfaction surveys, or employee engagement surveys, our platform has the tools you need to get the job done. We are committed to providing exceptional customer service and support to ensure that your survey experience is as smooth and hassle-free as possible.\n\nThank you for choosing our survey management system. We look forward to helping you achieve your survey goals!</span></font></div>', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `frm_option` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `order_by` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `question`, `frm_option`, `type`, `order_by`, `survey_id`, `date_created`) VALUES
(1, 0, 'Sample Survey Question using Radio Button', '{\"cKWLY\":\"Option 1\",\"esNuP\":\"Option 2\",\"dAWTD\":\"Option 3\",\"eZCpf\":\"Option 4\"}', 'radio_opt', 3, 1, '2020-11-10 12:04:46'),
(2, 0, 'Question for Checkboxes', '{\"qCMGO\":\"Checkbox label 1\",\"JNmhW\":\"Checkbox label 2\",\"zZpTE\":\"Checkbox label 3\",\"dOeJi\":\"Checkbox label 4\"}', 'check_opt', 2, 1, '2020-11-10 12:25:13'),
(4, 0, 'Sample question for the text field', '', 'textfield_s', 1, 1, '2020-11-10 13:34:21'),
(5, 0, 'What is Your Name', '', 'textfield_s', 0, 3, '2023-01-08 13:46:10'),
(6, 0, 'Whats My name', '{\"rAiwW\":\"Nishalini\",\"UzLcW\":\"Sarvess\",\"ehyTa\":\"Gopal\",\"OqMGP\":\"Sitha\"}', 'radio_opt', 0, 6, '2023-02-20 21:58:03'),
(7, 0, 'When is New Year', '{\"fMLzB\":\"31 December 2022\",\"cOSEU\":\"30 December 2022\",\"ocZtA\":\"29 December 2022\"}', 'radio_opt', 0, 7, '2023-02-21 00:24:03'),
(8, 0, 'Which Day New Year will be', '{\"xrBJw\":\"Saturday\",\"dviTM\":\"Sunday\",\"PEtDL\":\"Monday\"}', 'radio_opt', 0, 7, '2023-02-21 00:25:06'),
(9, 0, 'My Age', '{\"tOqIg\":\"23\",\"AngZt\":\"24\",\"WdKyV\":\"25\"}', 'radio_opt', 0, 8, '2023-02-23 18:43:36'),
(11, 0, 'Where I lived?', '{\"NjEGP\":\"Penang\",\"BYuOP\":\"Pahang\",\"siWht\":\"KL\"}', 'radio_opt', 0, 8, '2023-02-23 18:45:21'),
(13, 0, 'What is your name', '{\"aKRGW\":\"No Name\",\"xiJVI\":\"Hello\"}', 'radio_opt', 0, 15, '2023-04-23 21:18:57'),
(14, 0, 'What is your age ?', '', 'textfield_s', 0, 15, '2023-04-23 21:19:17'),
(15, 0, 'Hai', '{\"akxVj\":\"Anweer\",\"qsxbD\":\"Answer\"}', 'check_opt', 0, 16, '2023-04-23 22:12:24'),
(16, 0, 'What is Your Name ?', '', 'textfield_s', 0, 19, '2023-05-01 22:02:09'),
(17, 0, 'How Old Are You?', '', 'textfield_s', 0, 19, '2023-05-01 22:02:26'),
(18, 0, 'What is your gender ?', '{\"hQxbA\":\"Male\",\"uYciC\":\"Female\"}', 'radio_opt', 0, 19, '2023-05-01 22:03:23'),
(19, 0, 'What is my name?', '', 'textfield_s', 0, 21, '2023-05-01 22:23:57'),
(20, 0, 'When is Labour Day', '{\"MWCAH\":\"1 May\",\"kDtSW\":\"2 May\"}', 'check_opt', 0, 22, '2023-05-01 22:27:15'),
(21, 0, 'What is Your NAme', '', 'textfield_s', 0, 23, '2023-05-01 22:53:30'),
(22, 0, 'How old are you', '', 'textfield_s', 0, 24, '2023-05-01 23:20:00'),
(23, 0, 'How old are you', '', 'textfield_s', 0, 35, '2023-05-02 02:06:12'),
(24, 0, 'How are you', '{\"SqhNv\":\"Im Fine\",\"lpjxy\":\"Not fine\"}', 'radio_opt', 0, 50, '2023-05-02 03:44:31'),
(25, 0, 'What is your name', '', 'textfield_s', 0, 52, '2023-05-13 16:07:59'),
(26, 0, 'How old are you?', '{\"bThdQ\":\"21\",\"lBrKo\":\"23\"}', 'check_opt', 0, 52, '2023-05-13 16:08:25'),
(27, 0, 'Where do you live?', '', 'textfield_s', 0, 52, '2023-05-13 16:08:40'),
(28, 0, 'What is your naame', '{\"lQZNt\":\"\",\"olFib\":\"\"}', 'check_opt', 0, 53, '2023-05-13 16:26:30');

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
(50, 'dddd', 'ddd', 'User Testing Templates  ', 16, '12,17', '2023-05-02', '2023-05-18', '2023-05-02 03:32:03'),
(51, 'Hello', 'helo2', 'Assessment-Quizzes  ', 10, '12,17', '2023-05-03', '2023-05-06', '2023-05-03 00:36:15'),
(52, 'Latest', 'Latest', 'Education Templates  ', 16, '17', '2023-05-12', '2023-05-20', '2023-05-13 16:07:38'),
(53, 'Report Errors', 'sdsfsds', 'Education Templates  ', 16, '12,17', '2023-05-13', '2023-05-20', '2023-05-13 16:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2 = Researcher, 3= Respondent',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `contact`, `address`, `email`, `password`, `type`, `date_created`) VALUES
(1, 'Administrator', '+123456789', 'Sample address', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1, '2020-11-10 08:43:06'),
(10, 'SARVESS', '0143057131', 'II-19-E, Greenlane Park Condominium, Solok Tembaga', 'sarvess.jr@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, '2023-02-21 16:26:14'),
(12, 'SARVESS', '0143057131', 'II-19-E, Greenlane Park Condominium, Solok Tembaga', 'sarvessveeri2312@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 3, '2023-02-23 18:35:49'),
(16, 'Sarvess', '+60143057131', 'II-19-E, Solok Tembaga', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, '2023-04-22 15:31:44'),
(17, 'Nishalini', '', '', 'nishalini1506@gmail.com', '1fbfc2633b512f3dbdb7dcde101cff21', 3, '2023-05-01 22:34:58'),
(19, 'Sarvess Veeriyah', '+60143057131', 'II-19-E, Solok Tembaga\r\nIsland Park', 'admin@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 3, '2023-05-15 16:52:56'),
(20, 'Sarvess Veeriyah', '+60143057131', 'II-19-E, Solok Tembaga\r\nIsland Park', 'admin@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 2, '2023-05-15 16:57:53');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `survey_set`
--
ALTER TABLE `survey_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
