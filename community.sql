-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2020 at 03:58 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `community`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_token`
--

CREATE TABLE `access_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `TOKEN` varchar(255) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_token`
--

INSERT INTO `access_token` (`id`, `user_id`, `admin_id`, `TOKEN`, `date_time`) VALUES
(1, 1, NULL, 'bd8759e702252ad5d213df7c48a6178c', '2020-04-25 05:38:51'),
(2, 1, NULL, 'b8869b930370bccbf2140115e70b985c', '2020-04-25 06:25:16'),
(3, 1, NULL, '656479ddf2ad40e25f84cf6262eec5f1', '2020-04-25 06:25:19'),
(4, 1, NULL, '6320c981518b4f4944adbd724d80750a', '2020-04-25 06:25:29'),
(5, 1, NULL, '9def1ee45b49fbc0e144bda354a032f9', '2020-04-25 06:25:45'),
(6, 1, NULL, '5d4bf337a50957239e980cada3ece0e1', '2020-04-25 06:26:38'),
(7, 1, NULL, 'c50f0f66e84a5327d0d7bc2f39270d08', '2020-04-25 06:28:14'),
(8, 1, NULL, '1603e72de2a53fd3e369420189621662', '2020-04-25 06:37:41'),
(9, 1, NULL, 'c88dc313304a898819ff794586431495', '2020-04-25 06:40:30'),
(10, 1, NULL, '22243af0cd9c9c87421ce9e7c350153e', '2020-04-25 06:42:33'),
(11, 1, NULL, '6c8d97dc4cb259834cb88d50c24e6894', '2020-04-25 06:54:04'),
(12, 1, NULL, '84831aa96db4c671c6cca5622470b89c', '2020-04-25 06:54:44'),
(13, 1, NULL, 'cc4d6a082bc4e96a694e1691a1e426e7', '2020-04-25 06:56:23'),
(14, 1, NULL, '8c2d329bc5484ccb75113983016e356b', '2020-04-25 07:43:58'),
(15, 1, NULL, 'd2d1338b435d31deb748c621cb741f20', '2020-04-25 07:45:12'),
(16, 1, NULL, '3bbde590f9bd197dd67a30c20b5042ca', '2020-04-25 07:45:51'),
(17, 1, NULL, 'c8589d1303ab1543885ea3dd93c800c7', '2020-04-25 07:53:56'),
(18, 1, NULL, 'e9b9ef1f098302bd18316c2503d59d7c', '2020-04-25 07:56:18'),
(19, 1, NULL, '07a87b70cb059dc6ecc983262b23c44e', '2020-04-25 08:20:20'),
(20, 1, NULL, '736a8d7097510eeefb08f6a2291b8851', '2020-04-25 08:20:32'),
(21, 3, NULL, 'b54eb7fe74bd6fc73f078151091be3bd', '2020-04-25 10:21:50'),
(22, 14, NULL, 'af6b67d8f885e558d3f2bb1d7cc4a85b', '2020-04-26 10:26:59'),
(23, 12, NULL, '4c58dbf43e9abddf70f1ca7c77c5a77e', '2020-04-27 04:15:14'),
(24, 12, NULL, '5ab72974faf5cc6e75600f196e42852f', '2020-04-27 04:15:37'),
(25, 3, NULL, '4bcdfb68862a1d805fb8408b7b4cb9b1', '2020-04-27 04:58:21'),
(26, 8, NULL, '37ac4931c34f8e9a718ba786340a1ef5', '2020-04-27 06:53:46'),
(27, 8, NULL, '8dcafdd800f2922864bf340c1f7769b4', '2020-04-27 06:56:09'),
(28, 8, NULL, '9c8129ed93f09d50a3782180dedae2ae', '2020-04-27 07:52:13'),
(29, 8, NULL, 'ec169c92c90c7dd6dd57a16322372752', '2020-04-27 09:29:20'),
(30, 8, NULL, '067e4dda492f530bdc30c4c367fbfe0c', '2020-04-28 02:34:13'),
(31, 8, NULL, 'e1c2948d5396b45106d5efd05589d41d', '2020-04-28 09:21:29'),
(32, 11, NULL, '335ee0c2a682520fe8a264efc1111c32', '2020-05-01 04:49:42'),
(33, 8, NULL, '0add016d5f397ba980f9f98f117339ee', '2020-05-01 04:59:01'),
(34, 10, NULL, '947ff15eb75baeaa6a931e9f6145b696', '2020-05-01 05:07:36'),
(35, 8, NULL, 'ccfaa711263a5ac9e0738eea5622db4b', '2020-05-01 09:00:32'),
(36, 8, NULL, '5736d36cb534638e00f35e9df53f2726', '2020-05-02 03:02:22'),
(37, 8, NULL, '64c788864e38567e6a9f035b3e6e24dc', '2020-05-02 07:13:11'),
(38, 12, NULL, '491deda8335ce8ff397ac738f555b670', '2020-05-02 07:15:25'),
(39, 8, NULL, 'e29570bbf3a40135dd3cd059bbf48082', '2020-05-02 14:07:15'),
(40, 8, NULL, '69ec575619cd9f97413741f4de9685b3', '2020-05-03 02:56:10'),
(41, 10, NULL, '353ff340d88d571e76b755564e08c46a', '2020-05-03 07:44:04'),
(42, 8, NULL, '0688b431f36a494819afc62444ae5220', '2020-05-03 07:47:48'),
(43, 8, NULL, '672255fe989935667261c6440ffb0e3f', '2020-05-04 02:42:11'),
(44, 8, NULL, '036cd7af36e8c22113c5ca3c3bcdc016', '2020-05-04 03:43:49'),
(45, 8, NULL, '665ad5db5143afd5d8c46996a8784a4a', '2020-05-04 04:56:44'),
(46, 8, NULL, '44a64971da864aeb5ae2e06d2f9b6846', '2020-05-04 05:13:00'),
(47, 8, NULL, '103c54b00e040e4c9662313ed0a3a1e8', '2020-05-04 06:56:03'),
(48, 8, NULL, '45d9793762afb52a30595c72660194ac', '2020-05-04 10:25:13'),
(49, 8, NULL, '6c2b4fd84aba19cee2fa6b6f533cd7c1', '2020-05-04 10:32:54'),
(50, 8, NULL, 'f371c1a9b017f6bc0920b6a19c32bcab', '2020-05-04 11:24:15'),
(51, NULL, 1, 'beceb47684d1402f8419c4ff4c940d07', '2020-05-05 05:00:36'),
(52, NULL, 1, '46fcae05b681491ffeee163d7682fa05', '2020-05-05 05:03:23'),
(53, NULL, 1, '3ee9ecca358efd91e09659a8f6e7a639', '2020-05-05 06:53:09'),
(54, NULL, 1, '1a8bda6a45a7a0888c8be1d76f73fe66', '2020-05-05 07:00:40'),
(55, NULL, 1, '941ec3076520eb9fbb25bd5604376a62', '2020-05-05 07:13:39'),
(56, NULL, 1, '26926452b3103626bd753394309be099', '2020-05-05 07:14:13'),
(57, NULL, 1, '2d67ca6b6ce04c027dfe571cc6a5392f', '2020-05-06 02:50:28'),
(58, NULL, 1, 'a5e9a21ccc1a1427659366f0d5ccc295', '2020-05-06 04:08:18'),
(59, NULL, 1, '640d862de9b0608a3d01027ee2a6173e', '2020-05-06 09:14:08'),
(60, NULL, 1, '3ba18808bf72b155053384cc754c1a58', '2020-05-06 09:25:01'),
(61, 8, NULL, '5a75cd6325ffb70c5034efb37ae06de5', '2020-05-07 02:52:34'),
(62, 8, NULL, 'e1fda19fcdb8070f2826e681118032f6', '2020-05-08 03:47:15'),
(63, 8, NULL, '8b6a73fd1b4fcf38a61fbc08f98b5d62', '2020-05-09 02:42:22'),
(64, 8, NULL, '1ba92d72c267b990c5c6b095e2d7666b', '2020-05-09 08:06:46'),
(65, 8, NULL, '74f071a6bdca7f88a5f785a28ae7ee45', '2020-05-09 09:43:27'),
(66, 8, NULL, 'ec354f87937190bad727bb53f1f7da6d', '2020-05-09 09:49:02'),
(67, 8, NULL, 'a6c3e13d1ec17c399ecfebff13558f23', '2020-05-10 02:32:06'),
(68, 8, NULL, '844a19c57929a3cf39a5948f93b49912', '2020-05-10 03:06:37'),
(69, 8, NULL, 'f2f807f8d39acc9ef1cd7d3efa17a605', '2020-05-10 09:09:13'),
(70, 8, NULL, 'c63820f1c3993bf864f8240c04078509', '2020-05-10 09:18:01'),
(71, NULL, 1, '34da9d1324d436ca2ef2b228047a3b0e', '2020-05-11 02:48:35'),
(72, NULL, 1, '648272eec29ec53dfe2368286699ef59', '2020-05-11 04:59:53'),
(73, NULL, 1, '4d1f80ec47b6ab724d74d5f3226abf22', '2020-05-11 07:29:08'),
(74, NULL, 1, 'ab003aba58aef0310431661579c77c80', '2020-05-12 02:54:33'),
(75, NULL, 1, '304f1ee81d7c50b73e243e5f064653eb', '2020-06-11 13:31:54'),
(76, 8, NULL, 'ad98ed055131e9aa5d83890b4707df9d', '2020-06-11 13:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_user` varchar(255) DEFAULT NULL,
  `admin_pass` varchar(255) DEFAULT NULL,
  `admin_status` int(11) NOT NULL DEFAULT 1,
  `creat_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_user`, `admin_pass`, `admin_status`, `creat_date`) VALUES
(1, 'admin', '25d55ad283aa400af464c76d713c07ad', 1, '2020-05-05 08:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `asq_questions`
--

CREATE TABLE `asq_questions` (
  `asq_id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `sub_cat_id` int(11) DEFAULT NULL,
  `asq_title` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `votes` int(11) NOT NULL DEFAULT 0,
  `answers` int(11) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `asq_status` int(11) NOT NULL DEFAULT 1,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asq_questions`
--

INSERT INTO `asq_questions` (`asq_id`, `users_id`, `cat_id`, `sub_cat_id`, `asq_title`, `description`, `votes`, `answers`, `views`, `asq_status`, `date_time`) VALUES
(1, 12, 1, 5, 'My First Question', 'sdf dfs fghfg fsdf', 0, 0, 0, 1, '2020-05-02 15:26:08'),
(2, 12, 3, 8, 'My First Question', 'sdfs gfgd nfg gds gfg', 0, 0, 0, 1, '2020-05-02 15:39:07'),
(3, 12, 1, 6, 'My First Question Two', 'dfd fdsfds fdsfs fsdf', 0, 0, 0, 1, '2020-05-02 15:55:12'),
(4, 8, 1, 6, 'This is cadmus title check here', '&lt;p&gt;This is md imran hosen . work university of dhaka as web developer&amp;nbsp;&lt;/p&gt;', 0, 0, 0, 1, '2020-05-09 15:47:20'),
(5, 8, 3, 8, 'This is My First title here Question', '&lt;p&gt;&lt;br /&gt;&lt;/p&gt;', 0, 0, 0, 1, '2020-05-10 08:36:24'),
(6, 8, 1, 6, 'This is My First title here Question two', '&lt;p&gt;&lt;br /&gt;&lt;/p&gt;', 0, 0, 0, 1, '2020-05-10 08:41:33'),
(7, 8, 3, 8, 'This is My First title here Question twoh', '&lt;p&gt;&lt;br /&gt;&lt;/p&gt;', 0, 0, 0, 1, '2020-05-10 08:49:56'),
(8, 8, 1, 6, 'gsfdg dfsfg fd fgssfdg', '&lt;p&gt;&lt;br /&gt;&lt;/p&gt;', 0, 0, 0, 1, '2020-05-10 15:10:04'),
(9, 8, 1, 5, 'This is f t', '&lt;p&gt;&lt;br /&gt;&lt;/p&gt;', 0, 0, 0, 1, '2020-05-10 15:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `sub_id` int(11) NOT NULL DEFAULT 0,
  `cat_status` int(11) NOT NULL DEFAULT 1,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `sub_id`, `cat_status`, `create_date`) VALUES
(1, 'Category One', 0, 1, '2020-05-01 12:41:01'),
(2, 'Category Hosen', 0, 1, '2020-05-01 12:41:01'),
(3, 'Category Khan', 0, 1, '2020-05-01 12:41:38'),
(5, 'Sub Category One', 1, 1, '2020-05-01 12:45:07'),
(6, 'Sub Category Two', 1, 1, '2020-05-01 12:45:07'),
(15, 'sub category one', 2, 1, '2020-05-11 14:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` bigint(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `user_password` varchar(245) DEFAULT NULL,
  `otp` varchar(45) DEFAULT NULL,
  `users_mobile` varchar(245) DEFAULT NULL,
  `users_email` varchar(245) DEFAULT NULL,
  `users_fullname` varchar(245) DEFAULT NULL,
  `users_type` int(1) DEFAULT 1,
  `users_institute` varchar(245) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `user_fb` varchar(255) DEFAULT NULL,
  `user_ing` varchar(255) DEFAULT NULL,
  `user_wp` varchar(255) DEFAULT NULL,
  `user_tw` varchar(255) DEFAULT NULL,
  `users_create_at` datetime DEFAULT NULL,
  `users_is_premium` int(1) DEFAULT 0,
  `users_credit` int(11) DEFAULT 0,
  `users_renew_date` datetime DEFAULT NULL,
  `users_expaired_date` datetime DEFAULT NULL,
  `users_status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `username`, `user_password`, `otp`, `users_mobile`, `users_email`, `users_fullname`, `users_type`, `users_institute`, `profile_image`, `user_fb`, `user_ing`, `user_wp`, `user_tw`, `users_create_at`, `users_is_premium`, `users_credit`, `users_renew_date`, `users_expaired_date`, `users_status`) VALUES
(8, 'imranhosen', '25d55ad283aa400af464c76d713c07ad', '2045', '01409575149', 'imran@coder.com', 'Md Imran Hosen', 1, 'Awebfox IT Solution', 'imran.jpg', 'www.fb.com/Md.ImranHosen.up', '#', '#', '#', '2020-04-27 12:53:25', 0, 0, NULL, '2020-06-27 12:53:25', 2),
(9, 'imranhosen.me', '25d55ad283aa400af464c76d713c07ad', '1646', '01409575149', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2020-04-29 01:52:30', 0, 0, NULL, '2020-05-29 01:52:30', 1),
(10, 'imranhosen.up', '25d55ad283aa400af464c76d713c07ad', '3838', '01409575149', 'imran@pro.com', 'Md Imran Hosen', 1, '', 'imran.jpg', NULL, NULL, NULL, NULL, '2020-05-01 10:37:33', 0, 0, NULL, '2020-06-01 10:37:33', 2),
(11, 'imranhosen.pro', '25d55ad283aa400af464c76d713c07ad', '5844', '01965837190', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-01 10:48:56', 0, 0, NULL, '2020-06-01 10:48:56', 2),
(12, 'imran', '1cb122d5788671940079d44d3d747a0a', '5984', '01365837190', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-02 01:14:23', 0, 0, NULL, '2020-06-02 01:14:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL,
  `video_title` text DEFAULT NULL,
  `video_name` varchar(255) DEFAULT NULL,
  `video_status` int(11) NOT NULL DEFAULT 1,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`video_id`, `video_title`, `video_name`, `video_status`, `create_date`) VALUES
(1, 'What is a Dumy Lipsum Video title One here ?', 'video_name_one.mp4', 1, '2020-05-03 09:32:53'),
(2, 'What is a Dumy Lipsum Video title Two here ?', 'video_name_two.mp4', 1, '2020-05-03 09:32:53'),
(3, 'First video add title here.', 'video_name_one.mp4', 1, '2020-05-06 14:22:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_token`
--
ALTER TABLE `access_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `asq_questions`
--
ALTER TABLE `asq_questions`
  ADD PRIMARY KEY (`asq_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_token`
--
ALTER TABLE `access_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asq_questions`
--
ALTER TABLE `asq_questions`
  MODIFY `asq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
