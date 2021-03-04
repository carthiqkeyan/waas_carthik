-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 04:56 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waas_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `customer_contactID` varchar(25) NOT NULL,
  `Membership` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `lastlogin` varchar(15) NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `customer_contactID`, `Membership`, `status`, `lastlogin`, `is_active`) VALUES
(1, 'ABC Incorporate', 'abcincdubai@gmail.com', 'MEM001', 'Active', '2 hrs ago', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(12) NOT NULL,
  `package_month` varchar(255) NOT NULL,
  `package_year` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `customers` int(12) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1-Active,0-Inactive	'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `package_month`, `package_year`, `start_date`, `end_date`, `description`, `customers`, `status`) VALUES
(28, '3 Month', '', '0000-00-00', '0000-00-00', 'ddf', 1, 1),
(29, '3 Month', '', '2020-12-03', '2021-03-02', 'ddf', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_modules`
--

CREATE TABLE `system_modules` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `description` varchar(100) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_modules`
--

INSERT INTO `system_modules` (`id`, `name`, `description`, `status`, `is_active`) VALUES
(1, 'Account Management', 'Account Management', 1, 1),
(2, 'Special Requests', 'Special Requests', 1, 1),
(3, 'User Management', 'User Management', 1, 1),
(4, 'Authorization ', 'Authorization/Privilege', 1, 1),
(5, 'Campaign Management', 'Campaign Management', 1, 1),
(6, 'Reports', 'Reports', 1, 1),
(7, 'License Management', 'License Management', 1, 1),
(8, 'Subscription Management', 'Subscription Management', 1, 1),
(9, 'Role Management', 'Role Management', 1, 1),
(10, 'Splash Screen Management', 'Splash Screen Management', 1, 1),
(11, 'Advertisement Management', 'Advertisement Management', 1, 1),
(12, 'Audience Management', 'Audience Management', 1, 1),
(13, 'Dashboard Management', 'Dashboard Management', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_module_access`
--

CREATE TABLE `system_module_access` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_module_access`
--

INSERT INTO `system_module_access` (`id`, `module_id`, `name`, `description`, `status`, `is_active`) VALUES
(1, 1, 'Create Customer Account', '', 1, 1),
(2, 1, 'Edit Customer Account', '', 1, 1),
(3, 1, 'View All Accounts', '', 1, 1),
(4, 1, 'Enable Account', '', 1, 1),
(5, 1, 'Suspend Account', '', 1, 1),
(6, 1, 'Delete Customer Account', '', 1, 1),
(7, 1, 'Enable Campaign Capabilities (SMS, Email, WaaS Captive Portal)', '', 1, 1),
(8, 1, 'Disable Campaign Capabilities', '', 1, 1),
(9, 1, 'Export Accounts in excel', '', 1, 1),
(10, 1, 'Commence & Expiry Date', '', 1, 1),
(11, 7, 'Add License for a Customer Account', '', 1, 1),
(12, 7, 'Edit License for a customer Account', '', 1, 1),
(13, 7, 'View Customer Licenses', '', 1, 1),
(14, 7, 'Delete License for a Customer Account', '', 1, 1),
(15, 8, 'View all Subscription plans', '', 1, 1),
(16, 8, 'Add Subscription Plan', '', 1, 1),
(17, 8, 'Edit Subscription Plan', '', 1, 1),
(18, 8, 'Delete Subscription Plan', '', 1, 1),
(19, 9, 'View User Roles', '', 1, 1),
(20, 9, 'Add User Role', '', 1, 1),
(21, 9, 'Edit User Role', '', 1, 1),
(22, 9, 'Delete User Role', '', 1, 1),
(23, 3, 'View Business Users', '', 1, 1),
(24, 3, 'Add Business User ', '', 1, 1),
(25, 3, 'Edit Business User', '', 1, 1),
(26, 3, 'Delete Business User', '', 1, 1),
(27, 3, 'Change own password', '', 1, 1),
(28, 4, 'View Authorization/Priviledges list', '', 1, 1),
(29, 4, 'Authorize User Priviledges', '', 1, 1),
(30, 5, 'Create Campaign', '', 1, 1),
(31, 5, 'Edit Campaign', '', 1, 1),
(32, 5, 'Approve Campaign', '', 1, 1),
(33, 5, 'Re- Activate Campaign', '', 1, 1),
(34, 5, 'Deactivate Campaign', '', 1, 1),
(35, 5, 'Delete Campaign', '', 1, 1),
(36, 5, 'Publish Campaign', '', 1, 1),
(37, 10, 'Create Splash Page', '', 1, 1),
(38, 10, 'Approve Splash Page', '', 1, 1),
(39, 10, 'Edit Splash Page', '', 1, 1),
(40, 10, 'Re- Activate Splash Page', '', 1, 1),
(41, 10, 'Deactivate Splash Page', '', 1, 1),
(42, 10, 'Publish Splash Page', '', 1, 1),
(43, 10, 'Delete Splash Page', '', 1, 1),
(44, 11, 'Create Advertisement', '', 1, 1),
(45, 11, 'Approve Advertisement', '', 1, 1),
(46, 11, 'Edit Advertisement', '', 1, 1),
(47, 11, 'Publish Advertisement', '', 1, 1),
(48, 11, 'Re- Activate Advertisement', '', 1, 1),
(49, 11, 'Deactivate Advertisement', '', 1, 1),
(50, 11, 'Delete Advertisement', '', 1, 1),
(51, 5, 'View Campaign', '', 1, 1),
(52, 10, 'View Splash Page', '', 1, 1),
(53, 11, 'View Advertisement', '', 1, 1),
(54, 5, 'Schedule Campaign', '', 1, 1),
(55, 12, 'Create Audience List', '', 1, 1),
(56, 12, 'Edit Audience List', '', 1, 1),
(57, 12, 'View Audience List', '', 1, 1),
(58, 12, 'Delete Audience List', '', 1, 1),
(59, 6, 'Visitors/Customer Reports', '', 1, 1),
(60, 6, 'Campaign Report', '', 1, 1),
(61, 6, 'Accounts Report', '', 1, 1),
(62, 6, 'All Account Reports', '', 1, 1),
(63, 6, 'View Reports', '', 1, 1),
(64, 6, 'Download Reports', '', 1, 1),
(65, 13, 'Create Dashboard', '', 1, 1),
(66, 13, 'Edit Dashboard', '', 1, 1),
(67, 13, 'Delete Dashboard', '', 1, 1),
(68, 13, 'View Dashboard', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_roles`
--

CREATE TABLE `system_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `is_customer_role` tinyint(4) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_roles`
--

INSERT INTO `system_roles` (`id`, `name`, `description`, `is_customer_role`, `customer_id`, `status`, `is_active`) VALUES
(1, 'dddnddvvvvvvvvvv', 'werwtegdgdrtyfthftyftyftyfgyhdftgdfg', 0, NULL, 1, NULL),
(2, 'abcccc', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbb', 0, NULL, 1, NULL),
(3, 'ddddd', 'werwtttttttttttttttttttttttttttttttttttttttttt', 0, NULL, 2, NULL),
(4, 'ddddddddddddddddd', 'werwtegdgdrtyfthftyftyftyfgyhdftgdfg', 0, NULL, 1, NULL),
(8, 'ddddddddddddddddd', 'werwtegdgdrtyfthftyftyftyfgyhdftgdfg', 0, NULL, 1, NULL),
(9, 'ddddddddddddddddd', 'werwtegdgdrtyfthftyftyftyfgyhdftgdfg', 0, NULL, 1, NULL),
(10, 'ddddddddddddddddd', 'werwtegdgdrtyfthftyftyftyfgyhdftgdfg', 0, NULL, 1, NULL),
(11, 'sss', 'sssvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', 0, NULL, 1, NULL),
(12, 'xxxxx', 'vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', 0, NULL, 1, NULL),
(13, 'ssffffffffff', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 0, NULL, 1, NULL),
(14, 'sshhhhhhhhhhhhhhhhhhhhh', 'nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', 0, NULL, 1, NULL),
(15, 'dfdf', 'ddddddddddddddddddddddddddddddddddddd', 0, NULL, 1, NULL),
(16, 'sdsafasdfdasd', 'sasdasuuuuuuuuuuuuuuuuuuuuuuuuuuu', 0, NULL, 1, NULL),
(17, 'ddd', 'xgsdfgsdfgsdfgsdfgsegsdfasdf', 0, NULL, 1, NULL),
(18, 'zcxzxcz', 'ddddddddddddddddddddddddddddddddddddddd', 0, NULL, 1, NULL),
(19, 'xxxxxxxxxxxxxxx', 'aaaaaaaaaaaaaa', 0, NULL, 1, NULL),
(20, 'nnn', 'nnnlllllllllllllllll', 0, NULL, 1, NULL),
(21, 'adasdsasadasdasdasd', 'dsadasdasdsasdasdasdsadsdasdasdadssad', 0, NULL, 1, NULL),
(22, 'xSXXX', 'jshahkjjklkjlkjlkjlkjlkjlkljlkj', 0, NULL, 1, NULL),
(23, 'dddddddddddddddddddddd', 'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 0, NULL, 1, NULL),
(24, 'bnnnnnnnnnnnnn', 'hgjhjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjhhhhhhhhhhhhhhhhhh', 0, NULL, 1, NULL),
(25, 'faf', 'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 0, NULL, 1, NULL),
(26, 'kkkkkkkkkkkkkkkkkkkk', 'hjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjhjjhhhhhhhhhhjhhjj', 0, NULL, 1, NULL),
(27, 'afsdef', 'hjjhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 0, NULL, 1, NULL),
(28, 'hhhhhhhhhhhhhhhhhhhhhhh', 'hgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggghhjh', 0, NULL, 1, NULL),
(29, 'afsdef', ' njhjbbbbbbbbbbbbbbbbbbbbbbbbbbhggggggggggggggbvv', 0, NULL, 1, NULL),
(30, 'ssssccccc', 'sssscccccccccccccccccccccccccccccccccccccccccc', 0, NULL, 1, NULL),
(31, 'zccdfdf', 'fddddddddddddddddddddddddd', 0, NULL, 1, NULL),
(32, 'dhhhhhh', 'ldjalsjdladljasldalsdjlajsdlajlfjaldjal', 0, NULL, 1, NULL),
(33, 'Aasdasd', 'sdadasdASDASDASD', 0, NULL, 1, NULL),
(34, 'ccccccccccccccccc', 'ggggggggggggggggggggggggggggggggg', 0, NULL, 1, NULL),
(35, 'fsdf', 'sfsdfsdfsdfsdggsgsgsgfsgsdfgsdfsg', 0, NULL, 1, NULL),
(36, 'sdsfsf', 'kjdAKfjkafjkdhfkhwdkfhskjdfhk', 0, NULL, 1, NULL),
(37, 'dhkjshdfkjashdfk', 'uryiuryiueyeiurytiuryt', 0, NULL, 1, NULL),
(38, 'sczdf', 'dfhskdhfkhdfkkdhjkhfkj', 0, NULL, 1, NULL),
(39, 'dasd', 'zxxczxczczxcx', 0, NULL, 1, NULL),
(40, 'cvxcvxcv', 'csdgsdfgdfdgdgxdhxhghfg', 0, NULL, 1, NULL),
(41, 'cvxcvxcv', 'csdgsdfgdfdgdgxdhxhghfg', 0, NULL, 1, NULL),
(42, 'dfsd', 'dfgfdgsdfgdfgdfgfdg', 0, NULL, 1, NULL),
(43, 'dsdadfsssdgdfgdfgdg', 'adsasdsdasdssdsfsdfsdgsdgdsg', 0, NULL, 1, NULL),
(44, 'vzcvc', 'ewfjaljs;fas;dk;alkd;laksd;kas;ldka;', 0, NULL, 1, NULL),
(45, 'ccdasd', 'sddddddddddddddddsssssssdddddd', 0, NULL, 1, NULL),
(46, 'Sdad', 'xasmx.smszkdlszkdlsklkszdlklsdkflsd;lfk', 0, NULL, 1, NULL),
(47, 'asdasd', 'dlkfwfsdjfsd;fk;sdkfldkfl;kdxlfkd', 0, NULL, 1, NULL),
(48, 'vvvvvvvvv', 'sdjsjdkkadsasjdasdsjadieiieieieiii', 0, NULL, 1, NULL),
(49, 'AaaaAa', 'DSDHSDJHDDJH', 0, NULL, 1, NULL),
(50, 'afsdef', 'dsjkflsdkjfljhdskfhaskdlhfjadshkjshdf', 0, NULL, 1, NULL),
(51, 'sdfsdff', 'sdfsdfsfsdgsfdgsdfgdfgdfgdsfgef', 0, NULL, 1, NULL),
(52, 'sddsf', 'fuwoeuorieutierutierittr', 0, NULL, 1, NULL),
(53, 'afsdef', 'dfjksdfjldjfdslfjldfjdjfsdjjdkfjsdjfksdjfkjsldjljdljsdjsdksdj', 0, NULL, 1, NULL),
(54, 'afsdef', 'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 0, NULL, 1, NULL),
(55, 'afsdef', 'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 0, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_role_access`
--

CREATE TABLE `system_role_access` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `module_id` int(11) NOT NULL DEFAULT '0',
  `access_id` int(11) NOT NULL DEFAULT '0',
  `access_right` tinyint(4) NOT NULL DEFAULT '1',
  `cby` int(11) NOT NULL,
  `cdate` datetime NOT NULL,
  `mby` int(11) NOT NULL,
  `mdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_role_access`
--

INSERT INTO `system_role_access` (`id`, `role_id`, `module_id`, `access_id`, `access_right`, `cby`, `cdate`, `mby`, `mdate`) VALUES
(1, 44, 1, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 44, 1, 3, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 45, 1, 1, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 45, 1, 2, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 45, 0, 2, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 45, 1, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_modules`
--
ALTER TABLE `system_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_module_access`
--
ALTER TABLE `system_module_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_roles`
--
ALTER TABLE `system_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_role_access`
--
ALTER TABLE `system_role_access`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `system_modules`
--
ALTER TABLE `system_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `system_module_access`
--
ALTER TABLE `system_module_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `system_roles`
--
ALTER TABLE `system_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `system_role_access`
--
ALTER TABLE `system_role_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
