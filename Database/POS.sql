-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 14, 2018 at 03:30 PM
-- Server version: 5.5.41-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_ksi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `name`, `image_name`) VALUES
(1, 'admin', '1234', 'Admin POS', 'image-none.png');

-- --------------------------------------------------------

--
-- Table structure for table `advt`
--

CREATE TABLE `advt` (
  `advt_id` int(11) NOT NULL,
  `customer_id_pri` int(11) NOT NULL,
  `advt_type` tinyint(4) DEFAULT NULL,
  `advt_header` varchar(255) DEFAULT NULL,
  `advt_message` text,
  `advt_status` tinyint(4) DEFAULT NULL,
  `date_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `apsth_pos_system`
--

CREATE TABLE `apsth_pos_system` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apsth_pos_system`
--

INSERT INTO `apsth_pos_system` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('14faf320d0cbfb9a7478856eb26ea1cbe2c15b65', '::1', 1520247933, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303234373933333b73686f705f69645f7072697c733a313a2231223b7061636b6167655f69647c733a313a2231223b757365725f69647c733a313a2231223b726f6c655f69647c733a313a2232223b726567656e65726174655f6c6f67696e7c693a3132333037313b),
('1be8962916689da464cb7d3aa5d99a7aceb578d5', '::1', 1520250576, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303235303537353b73686f705f69645f7072697c733a313a2231223b7061636b6167655f69647c733a313a2231223b757365725f69647c733a313a2231223b726f6c655f69647c733a313a2232223b726567656e65726174655f6c6f67696e7c693a3134343534393b),
('38156f4dcad10499893c33938a6eec6bb7084bbb', '::1', 1520250619, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303235303631393b61646d696e5f69647c733a313a2231223b726567656e65726174655f6c6f67696e7c693a3332333938333b),
('39cca5480768aacca198f1b243cc7c0c746e5808', '::1', 1520252506, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303235323439393b61646d696e5f69647c733a313a2231223b726567656e65726174655f6c6f67696e7c693a3733313234363b),
('3dc4ecd4f143a03f50aab1e46ac9acf0ae9b1c07', '::1', 1520250181, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303235303138313b61646d696e5f69647c733a313a2231223b726567656e65726174655f6c6f67696e7c693a3332333938333b),
('3fb04518f763c08a165fdfbd13e3560a46484c26', '::1', 1520253518, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303235333531383b61646d696e5f69647c733a313a2231223b726567656e65726174655f6c6f67696e7c693a3733313234363b),
('4686f594d7eaf8ee7f8c01b72fc0f3546e2a4434', '::1', 1520248272, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303234383233363b61646d696e5f69647c733a313a2231223b726567656e65726174655f6c6f67696e7c693a3332303035363b),
('5b0596744263d91aa1f3b895d7f8400b3183c8be', '::1', 1520249321, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303234393332313b61646d696e5f69647c733a313a2231223b726567656e65726174655f6c6f67696e7c693a3332333938333b),
('72995f30be4123fa5999fe4cca5919ce2d41fd93', '::1', 1520249915, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303234393930393b73686f705f69645f7072697c733a313a2231223b7061636b6167655f69647c733a313a2231223b757365725f69647c733a313a2231223b726f6c655f69647c733a313a2233223b726567656e65726174655f6c6f67696e7c693a3534333133333b),
('78ec3d553b33d30f5f37fd5dde7f9c2092d20427', '::1', 1520249418, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303234393430373b73686f705f69645f7072697c733a313a2231223b7061636b6167655f69647c733a313a2231223b757365725f69647c733a313a2231223b726f6c655f69647c733a313a2232223b726567656e65726174655f6c6f67696e7c693a3134313333363b),
('85420c536073e0248c795625ecb4a6a9c4d0328b', '::1', 1520248991, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303234383938313b61646d696e5f69647c733a313a2231223b726567656e65726174655f6c6f67696e7c693a3332333938333b),
('c7833420d7bc6dfccc42f9f948eed6439b4b99f6', '::1', 1520247558, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303234373535383b73686f705f69645f7072697c733a313a2231223b7061636b6167655f69647c733a313a2231223b757365725f69647c733a313a2231223b726f6c655f69647c733a313a2232223b726567656e65726174655f6c6f67696e7c693a3132333037313b),
('db36032318b04464b12e306d15e5e12d405cf06e', '::1', 1520247517, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303234373235373b73686f705f69645f7072697c733a313a2231223b7061636b6167655f69647c733a313a2231223b757365725f69647c733a313a2231223b726f6c655f69647c733a313a2232223b726567656e65726174655f6c6f67696e7c693a3132333037313b),
('ed9248c527d1e6fd286f1021467df2f618a70336', '::1', 1520251164, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303235313136343b),
('f2edb3787d90bb6b67b2be09de81eaa3e8958d22', '::1', 1520250250, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532303235303234313b73686f705f69645f7072697c733a313a2231223b7061636b6167655f69647c733a313a2231223b757365725f69647c733a313a2231223b726f6c655f69647c733a313a2232223b726567656e65726174655f6c6f67696e7c693a3134343534393b);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL COMMENT 'บัญชีธนาคารที่ใช้ โอนเงิน',
  `bank_number` varchar(100) DEFAULT NULL COMMENT 'เลขที่บัญชี',
  `bank_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อธนาคาร',
  `bank_fullname` varchar(255) DEFAULT NULL COMMENT 'ชื่อเต็ม เจ้าของธนาคาร',
  `bank_money` decimal(20,2) DEFAULT '0.00' COMMENT 'จำนวนเงินในบัญชี',
  `type_bank_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'ประเภทธนาคาร ค่าเริ่มต้น(ลบไม่ได้) , ลบได้',
  `shop_id_pri` int(11) NOT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_number`, `bank_name`, `bank_fullname`, `bank_money`, `type_bank_id`, `shop_id_pri`, `date_modify`) VALUES
(1, '', 'เงินสด', '', '0.00', 1, 1, '2018-03-04 17:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id_pri` int(11) NOT NULL,
  `customer_id` varchar(45) DEFAULT NULL COMMENT 'รหัสตั้งเอง',
  `user_id` int(11) NOT NULL COMMENT 'คนที่สร้างลูกค้า',
  `customer_group_id` int(11) NOT NULL COMMENT 'กลุ่มลูกค้า',
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL COMMENT 'ชื่อเต็ม',
  `email` varchar(100) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL COMMENT 'เบอร์โทร',
  `facebook` varchar(100) DEFAULT NULL COMMENT 'ติดต่อ facebook',
  `line` varchar(100) DEFAULT NULL COMMENT 'ติดต่อ Line',
  `instagram` varchar(100) DEFAULT NULL COMMENT 'ติดต่อ instagram',
  `address` varchar(1000) DEFAULT NULL COMMENT 'ที่อยู่ลูกค้า',
  `district` varchar(45) DEFAULT NULL,
  `amphoe` varchar(45) DEFAULT NULL,
  `province` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'สถานะ',
  `tax_id` varchar(15) DEFAULT NULL COMMENT 'เลขที่ผู้เสียภาษี',
  `tax_shop` varchar(500) DEFAULT NULL COMMENT 'ชื่อร้าน/บริษัท ที่เสียภาษี',
  `tax_shop_sub` varchar(500) DEFAULT NULL COMMENT 'ชื่อสาขา',
  `tax_address` varchar(1000) DEFAULT NULL COMMENT 'ที่อยู่ร้านที่เสียภาษี',
  `image_id` bigint(20) NOT NULL DEFAULT '1',
  `style` varchar(45) DEFAULT 'blue',
  `role_id` tinyint(4) NOT NULL COMMENT 'สิทธิ์การใช้งานระบบ',
  `date_create` date DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `customer_group_id` int(11) NOT NULL,
  `customer_group_name` varchar(100) DEFAULT NULL COMMENT 'ชื่อกลุ่มลูกค้า',
  `customer_group_save` varchar(45) DEFAULT NULL COMMENT 'ส่วนลด',
  `type_save_id` tinyint(4) DEFAULT NULL COMMENT 'ประเภทส่วนลด % , บาท',
  `shop_id_pri` int(11) NOT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL COMMENT 'ค่าใช้จ่ายอื่นๆที่ไม่เกี่ยวกับใบสั่งซื้อ',
  `shop_id_pri` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL COMMENT 'บัญชีที่ใช้',
  `expense_name` varchar(500) DEFAULT NULL COMMENT 'ชื่อรายการ',
  `expense_detail` varchar(1000) DEFAULT NULL COMMENT 'รายละเอียดรายการ',
  `expense_money` decimal(8,2) DEFAULT NULL,
  `expense_date_pay` date DEFAULT NULL COMMENT 'วันที่ชำระ',
  `expense_refer` varchar(45) DEFAULT NULL COMMENT 'เลขที่อ้างอิง',
  `expense_image` varchar(500) DEFAULT NULL COMMENT 'แนบไฟล์รูป (ถ้ามี)',
  `expense_shop` varchar(1000) DEFAULT NULL COMMENT 'ชื้อร้านที่จ่าย',
  `expense_shop_address` varchar(1000) DEFAULT NULL COMMENT 'ที่อยู่ร้านที่จ่าย',
  `expense_shop_email` varchar(1000) DEFAULT NULL COMMENT 'อีเมล์ร้านที่จ่าย',
  `expense_shop_tel` varchar(20) DEFAULT NULL COMMENT 'เบอร์โทรร้านที่จ่าย',
  `status_expense_id` tinyint(4) NOT NULL COMMENT 'สถานะรายการที่จ่าย',
  `date_modify` varchar(45) DEFAULT NULL COMMENT 'วันที่อัพเดทล่าสุด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `files_id` int(11) NOT NULL,
  `services_master_id_pri` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `files_name` varchar(45) DEFAULT NULL,
  `files_create` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group_menu`
--

CREATE TABLE `group_menu` (
  `group_menu_id` tinyint(4) NOT NULL,
  `group_menu_name` varchar(255) DEFAULT NULL,
  `group_menu_icon` varchar(45) DEFAULT NULL,
  `group_menu_public` tinyint(4) DEFAULT NULL,
  `group_menu_sort` tinyint(4) DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_menu`
--

INSERT INTO `group_menu` (`group_menu_id`, `group_menu_name`, `group_menu_icon`, `group_menu_public`, `group_menu_sort`, `date_modify`) VALUES
(2, 'สาขา/ตัวแทน/ลูกค้า', 'fa fa-users', 1, 6, '2017-09-04 13:52:35'),
(4, 'ตั้งค่า', 'fa fa-cog', 1, 10, '2017-07-31 21:05:58'),
(6, 'คลังสินค้า', 'mdi mdi-treasure-chest', 1, 4, '2017-08-01 22:33:22'),
(7, 'การซื้อ/คู่ค้า', 'mdi mdi-cart-plus', 1, 3, '2017-08-30 15:56:16'),
(8, 'การขาย', 'fa fa-clipboard', 1, 1, '2017-08-30 15:56:11'),
(9, 'บัญชี', 'mdi mdi-cash-multiple', 1, 7, '2017-08-22 16:44:03'),
(10, 'รายงาน', 'mdi mdi-file', 1, 8, '2017-08-01 18:10:12'),
(11, 'ประวัติการใช้งาน', 'fa fa-clipboard', 1, 9, '2018-03-02 08:40:45'),
(12, 'การจัดส่ง', 'fa fa-truck', 1, 2, '2017-08-30 16:05:11'),
(14, 'บริการหลังการขาย', 'fa fa-wrench', 1, 5, '2018-02-09 00:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `head_sms`
--

CREATE TABLE `head_sms` (
  `head_sms_id` int(11) NOT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `head_sms_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` bigint(20) NOT NULL,
  `image_name` varchar(500) DEFAULT NULL COMMENT 'ลิ้งค์รูป',
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `image_name`, `date_modify`) VALUES
(1, 'avatar-none.png', '2017-08-01 23:33:53'),
(2, 'image-none.png', '2017-08-01 23:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `income_bank`
--

CREATE TABLE `income_bank` (
  `income_bank_id` int(11) NOT NULL,
  `income_bank_name` varchar(45) DEFAULT NULL,
  `income_bank_branch` varchar(45) DEFAULT NULL,
  `income_bank_account_name` varchar(45) DEFAULT NULL,
  `income_bank_accoun_number` varchar(45) DEFAULT NULL,
  `income_bank_active` tinyint(3) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inform_payment`
--

CREATE TABLE `inform_payment` (
  `inform_payment_id` bigint(20) NOT NULL COMMENT 'หลักฐานการโอนเงิน',
  `bank_id` int(11) NOT NULL COMMENT 'ธนาคารที่โอน',
  `date_pay` date DEFAULT NULL COMMENT 'วันที่ชำระ',
  `time_pay` varchar(10) DEFAULT NULL COMMENT 'เวลาที่ชำระ รูปแบบ 23:30',
  `money` decimal(10,2) DEFAULT NULL COMMENT 'จำนวนเงินที่โอน',
  `invoice` varchar(45) DEFAULT NULL COMMENT 'เลขใบสั่งซื้อหรือใบแจ้งหนี้',
  `image_id` bigint(20) NOT NULL DEFAULT '2',
  `customer_id` varchar(45) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `customer_name` varchar(45) DEFAULT NULL COMMENT 'ชื่อลูกค้า',
  `customer_email` varchar(45) DEFAULT NULL COMMENT 'อีเมล์ลูกค้า',
  `customer_tel` varchar(45) DEFAULT NULL COMMENT 'เบอร์โทรลูกค้า',
  `status_inform_id` tinyint(4) NOT NULL,
  `shop_id_pri` int(11) NOT NULL COMMENT 'ร้านที่ได้รับแจ้งโอน',
  `user_id` int(11) DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login_check`
--

CREATE TABLE `login_check` (
  `login_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `regenerate_login` varchar(255) DEFAULT NULL,
  `login_last_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_check`
--

INSERT INTO `login_check` (`login_id`, `user_id`, `ip_address`, `regenerate_login`, `login_last_time`) VALUES
(1, 1, '::1', '144549', '2018-03-05 18:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `login_check_admin`
--

CREATE TABLE `login_check_admin` (
  `login_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `regenerate_login` varchar(255) DEFAULT NULL,
  `login_last_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_check_admin`
--

INSERT INTO `login_check_admin` (`login_id`, `admin_id`, `ip_address`, `regenerate_login`, `login_last_time`) VALUES
(1, 1, '::1', '731246', '2018-03-05 19:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `login_check_customer`
--

CREATE TABLE `login_check_customer` (
  `login_id` int(11) NOT NULL,
  `customer_id_pri` int(11) NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `regenerate_login` varchar(255) DEFAULT NULL,
  `login_last_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_bank`
--

CREATE TABLE `log_bank` (
  `log_id` bigint(20) NOT NULL COMMENT 'ประวัติการเงิน',
  `action_text` varchar(500) DEFAULT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_creditsms`
--

CREATE TABLE `log_creditsms` (
  `log_id` int(11) NOT NULL,
  `action_text` varchar(500) DEFAULT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_expense`
--

CREATE TABLE `log_expense` (
  `log_id` bigint(20) NOT NULL COMMENT 'ประวัติการเงิน',
  `action_text` varchar(500) DEFAULT NULL,
  `expense_id` int(11) NOT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_package`
--

CREATE TABLE `log_package` (
  `log_id` int(11) NOT NULL,
  `action_text` varchar(500) DEFAULT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_receipt`
--

CREATE TABLE `log_receipt` (
  `log_id` bigint(20) NOT NULL COMMENT 'ใชเก็บการกระทำเกี่ยวกับใบเสร็จ',
  `action_text` varchar(500) DEFAULT NULL,
  `receipt_master_id_pri` bigint(20) NOT NULL COMMENT 'อ้างอิงใบเสร็จ',
  `shop_id_pri` int(11) NOT NULL,
  `date_modify` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_sendemail`
--

CREATE TABLE `log_sendemail` (
  `log_id` int(11) NOT NULL,
  `action_text` text,
  `user_id` int(11) DEFAULT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_sendreceipt`
--

CREATE TABLE `log_sendreceipt` (
  `log_id` int(11) NOT NULL,
  `action_text` varchar(500) DEFAULT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_sendsms`
--

CREATE TABLE `log_sendsms` (
  `log_id` int(11) NOT NULL,
  `action_text` varchar(500) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_services`
--

CREATE TABLE `log_services` (
  `log_id` int(11) NOT NULL,
  `action_text` varchar(500) DEFAULT NULL,
  `services_master_id_pri` bigint(20) NOT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_transportexport`
--

CREATE TABLE `log_transportexport` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_user_login`
--

CREATE TABLE `log_user_login` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `log_text` varchar(45) DEFAULT NULL,
  `log_ip_address` varchar(45) DEFAULT NULL,
  `log_browser` varchar(255) DEFAULT NULL,
  `log_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `map_menu_package`
--

CREATE TABLE `map_menu_package` (
  `map_menu_package_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `menu_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `map_menu_role`
--

CREATE TABLE `map_menu_role` (
  `map_menu_role_id` int(11) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `menu_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `map_menu_role`
--

INSERT INTO `map_menu_role` (`map_menu_role_id`, `role_id`, `menu_id`) VALUES
(9, 1, 8),
(10, 1, 9),
(11, 1, 10),
(12, 1, 11),
(13, 1, 12),
(15, 1, 13),
(16, 1, 14),
(17, 1, 15),
(18, 1, 16),
(19, 1, 17),
(22, 1, 20),
(26, 3, 10),
(27, 3, 13),
(28, 3, 14),
(29, 1, 24),
(30, 1, 25),
(33, 1, 28),
(36, 1, 31),
(37, 1, 22),
(38, 1, 23),
(39, 1, 33),
(41, 1, 4),
(42, 1, 34),
(43, 1, 35),
(44, 1, 36),
(45, 1, 37),
(46, 1, 38),
(47, 1, 39),
(48, 5, 6),
(49, 5, 7),
(50, 5, 4),
(51, 5, 38),
(52, 5, 37),
(53, 5, 36),
(54, 5, 31),
(55, 5, 14),
(56, 5, 13),
(57, 5, 10),
(59, 1, 47),
(60, 1, 41),
(61, 1, 44),
(62, 1, 45),
(63, 1, 46),
(65, 1, 48),
(69, 3, 3),
(70, 3, 6),
(71, 3, 7),
(72, 3, 4),
(73, 3, 24),
(74, 3, 25),
(75, 3, 28),
(76, 3, 47),
(77, 3, 31),
(78, 3, 9),
(80, 3, 18),
(81, 3, 8),
(83, 3, 15),
(84, 3, 20),
(86, 3, 41),
(87, 3, 48),
(88, 3, 11),
(89, 3, 22),
(90, 3, 23),
(91, 3, 12),
(92, 3, 34),
(93, 3, 35),
(94, 3, 36),
(95, 3, 37),
(96, 3, 38),
(97, 3, 39),
(98, 3, 44),
(99, 3, 45),
(100, 3, 46),
(101, 3, 33),
(102, 3, 52),
(104, 1, 3),
(105, 1, 6),
(106, 1, 7),
(107, 1, 53),
(108, 1, 54),
(109, 1, 55),
(110, 1, 56),
(112, 1, 57),
(126, 1, 58),
(130, 3, 59),
(132, 8, 60),
(133, 1, 61),
(135, 8, 62),
(136, 8, 69),
(137, 1, 70),
(139, 3, 54),
(140, 3, 55),
(141, 3, 56),
(142, 3, 57),
(143, 1, 73),
(146, 1, 74),
(147, 1, 75),
(150, 1, 76),
(153, 3, 78),
(155, 3, 74),
(157, 2, 3),
(158, 2, 6),
(159, 2, 7),
(160, 2, 4),
(161, 2, 24),
(162, 2, 25),
(163, 2, 28),
(164, 2, 47),
(165, 2, 13),
(166, 2, 14),
(167, 2, 31),
(168, 2, 9),
(169, 2, 16),
(170, 2, 17),
(171, 2, 53),
(172, 2, 61),
(173, 2, 70),
(174, 2, 8),
(175, 2, 15),
(176, 2, 20),
(177, 2, 41),
(178, 2, 48),
(179, 2, 11),
(180, 2, 22),
(181, 2, 23),
(182, 2, 12),
(183, 2, 54),
(184, 2, 55),
(185, 2, 56),
(186, 2, 57),
(187, 2, 58),
(188, 2, 74),
(189, 2, 75),
(191, 2, 34),
(192, 2, 35),
(193, 2, 36),
(194, 2, 37),
(195, 2, 38),
(196, 2, 39),
(197, 2, 73),
(198, 2, 44),
(199, 2, 45),
(200, 2, 46),
(201, 4, 33),
(202, 4, 6),
(203, 4, 7),
(204, 4, 4),
(205, 4, 24),
(206, 4, 25),
(207, 4, 28),
(208, 4, 47),
(209, 4, 10),
(210, 4, 13),
(211, 4, 14),
(212, 4, 31),
(213, 4, 9),
(214, 4, 52),
(216, 4, 18),
(217, 4, 59),
(218, 4, 8),
(219, 4, 15),
(220, 4, 20),
(221, 4, 41),
(222, 4, 48),
(223, 4, 11),
(224, 4, 22),
(225, 4, 23),
(226, 4, 12),
(227, 4, 54),
(228, 4, 55),
(229, 4, 56),
(230, 4, 57),
(231, 4, 71),
(232, 4, 74),
(233, 4, 78),
(234, 4, 34),
(235, 4, 35),
(236, 4, 36),
(237, 4, 37),
(238, 4, 38),
(239, 4, 39),
(240, 4, 73),
(241, 4, 44),
(242, 4, 45),
(243, 4, 46),
(244, 5, 8),
(245, 5, 15),
(246, 5, 20),
(247, 5, 41),
(248, 5, 48),
(249, 5, 12),
(250, 5, 54),
(251, 5, 55),
(252, 5, 56),
(254, 6, 4),
(255, 6, 10),
(256, 6, 13),
(257, 6, 14),
(258, 6, 31),
(259, 6, 57),
(260, 6, 56),
(261, 6, 9),
(262, 6, 16),
(263, 6, 17),
(264, 6, 70),
(265, 6, 53),
(266, 6, 61),
(267, 6, 58),
(268, 6, 75),
(269, 6, 74),
(270, 6, 76),
(271, 6, 44),
(272, 6, 45),
(273, 6, 46),
(274, 6, 39),
(275, 6, 73),
(276, 5, 53),
(277, 5, 61),
(278, 5, 75),
(279, 5, 73),
(280, 7, 4),
(281, 7, 11),
(282, 7, 22),
(283, 7, 23),
(284, 7, 12),
(285, 7, 54),
(286, 7, 55),
(287, 7, 56),
(289, 7, 74),
(290, 7, 75),
(291, 7, 34),
(292, 7, 35),
(293, 7, 36),
(294, 7, 53),
(295, 7, 61),
(296, 7, 20),
(297, 7, 41),
(298, 7, 48),
(299, 7, 73),
(300, 9, 6),
(301, 9, 7),
(302, 9, 4),
(303, 9, 10),
(304, 9, 13),
(305, 9, 14),
(306, 9, 31),
(307, 9, 53),
(308, 9, 61),
(310, 9, 8),
(311, 9, 15),
(312, 9, 20),
(313, 9, 41),
(314, 9, 48),
(315, 9, 12),
(316, 9, 54),
(317, 9, 55),
(318, 9, 56),
(319, 9, 75),
(320, 9, 36),
(321, 9, 37),
(322, 9, 38),
(323, 9, 73),
(324, 12, 6),
(325, 12, 7),
(326, 12, 4),
(327, 12, 10),
(328, 12, 13),
(329, 12, 14),
(330, 12, 31),
(331, 12, 8),
(332, 12, 15),
(333, 12, 20),
(334, 12, 41),
(335, 12, 48),
(336, 12, 12),
(337, 12, 54),
(338, 12, 55),
(339, 12, 56),
(341, 12, 36),
(342, 12, 37),
(343, 12, 38),
(344, 12, 39),
(345, 3, 73),
(346, 10, 4),
(347, 10, 10),
(348, 10, 13),
(349, 10, 14),
(350, 10, 31),
(351, 10, 9),
(354, 10, 53),
(355, 3, 53),
(356, 3, 61),
(357, 3, 75),
(358, 3, 76),
(359, 10, 61),
(360, 10, 52),
(361, 10, 18),
(362, 10, 59),
(363, 10, 57),
(365, 10, 71),
(366, 10, 74),
(367, 10, 75),
(368, 10, 78),
(369, 10, 76),
(370, 10, 39),
(371, 10, 73),
(372, 10, 44),
(373, 10, 45),
(374, 10, 46),
(375, 13, 4),
(376, 13, 10),
(377, 13, 13),
(378, 13, 14),
(379, 13, 31),
(381, 13, 9),
(383, 13, 52),
(384, 13, 18),
(385, 13, 59),
(386, 13, 56),
(387, 13, 57),
(388, 13, 71),
(389, 13, 74),
(390, 13, 78),
(391, 13, 39),
(392, 13, 73),
(393, 13, 44),
(394, 13, 45),
(395, 13, 46),
(396, 11, 4),
(397, 11, 53),
(398, 11, 61),
(399, 11, 20),
(400, 11, 41),
(401, 11, 48),
(402, 11, 11),
(403, 11, 22),
(404, 11, 23),
(405, 11, 12),
(406, 11, 54),
(407, 11, 55),
(408, 11, 56),
(409, 11, 34),
(410, 11, 35),
(411, 11, 36),
(412, 11, 73),
(413, 14, 4),
(414, 14, 20),
(415, 14, 41),
(416, 14, 48),
(417, 14, 11),
(418, 14, 22),
(419, 14, 23),
(420, 14, 74),
(422, 14, 12),
(423, 14, 54),
(424, 14, 55),
(425, 14, 56),
(426, 14, 34),
(427, 14, 35),
(428, 14, 36),
(429, 14, 10),
(430, 7, 10),
(431, 11, 10),
(432, 1, 79),
(434, 1, 80),
(436, 3, 79),
(437, 3, 80),
(438, 4, 79),
(439, 4, 80),
(440, 6, 79),
(441, 6, 80),
(442, 13, 79),
(443, 13, 80),
(444, 1, 81),
(445, 2, 81),
(446, 3, 81),
(447, 6, 81),
(448, 10, 81),
(449, 13, 81),
(450, 2, 10),
(451, 1, 82),
(452, 1, 83),
(453, 2, 82),
(454, 2, 83),
(455, 3, 82),
(456, 3, 83),
(457, 4, 82),
(458, 4, 83),
(459, 5, 82),
(460, 5, 83),
(461, 6, 82),
(462, 6, 83),
(463, 7, 82),
(464, 7, 83),
(465, 9, 83),
(466, 9, 82),
(467, 10, 82),
(468, 10, 83),
(469, 11, 82),
(470, 11, 83),
(471, 12, 82),
(472, 12, 83),
(473, 13, 82),
(474, 13, 83),
(475, 14, 83),
(476, 14, 82),
(477, 1, 84),
(478, 2, 84),
(479, 3, 84),
(480, 5, 84),
(481, 12, 84),
(482, 9, 84),
(483, 1, 85),
(484, 2, 85),
(485, 3, 85),
(486, 4, 85),
(487, 7, 85),
(488, 11, 85),
(489, 14, 85),
(490, 2, 78),
(497, 2, 33),
(500, 1, 60),
(501, 1, 62),
(502, 1, 78),
(504, 1, 69),
(505, 1, 59),
(506, 1, 52),
(507, 1, 18),
(508, 2, 86),
(509, 2, 88),
(510, 1, 71),
(512, 2, 79),
(514, 2, 89),
(515, 1, 89),
(516, 2, 80),
(517, 3, 89),
(518, 4, 89),
(519, 3, 71),
(520, 3, 88),
(521, 4, 88),
(526, 3, 86),
(527, 3, 87),
(528, 4, 87),
(529, 4, 86),
(530, 2, 90),
(531, 2, 91),
(532, 2, 92),
(533, 3, 92),
(534, 3, 91),
(535, 3, 90),
(536, 4, 92),
(537, 4, 90),
(538, 4, 91),
(542, 1, 93),
(543, 2, 93),
(544, 2, 95),
(545, 2, 94),
(546, 1, 95),
(547, 1, 94),
(548, 1, 96),
(549, 2, 96),
(551, 1, 88),
(552, 1, 90),
(553, 1, 91),
(554, 1, 92),
(555, 2, 87),
(556, 1, 87),
(557, 1, 86),
(558, 3, 96),
(559, 3, 95),
(560, 3, 94),
(561, 4, 94),
(562, 4, 95),
(563, 4, 96),
(564, 4, 93),
(565, 4, 81),
(566, 15, 92),
(567, 15, 91),
(568, 15, 90),
(569, 15, 88),
(571, 15, 93),
(573, 15, 95),
(574, 15, 94),
(575, 15, 4),
(576, 15, 25),
(577, 5, 89),
(578, 9, 89),
(579, 12, 89);

-- --------------------------------------------------------

--
-- Table structure for table `map_product_stock`
--

CREATE TABLE `map_product_stock` (
  `map_product_stock_id` bigint(20) NOT NULL,
  `stock_id_pri` bigint(20) NOT NULL,
  `product_id_pri` bigint(20) NOT NULL,
  `map_product_amount` int(11) DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` tinyint(4) NOT NULL,
  `group_menu_id` tinyint(4) NOT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `menu_status_id` tinyint(4) DEFAULT NULL COMMENT '1=เปิด   2=ปิด  3=แสดงไม่ให้คลิก',
  `menu_link` varchar(255) DEFAULT NULL,
  `menu_sort` int(11) DEFAULT NULL,
  `menu_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `group_menu_id`, `menu_name`, `menu_status_id`, `menu_link`, `menu_sort`, `menu_modify`) VALUES
(3, 2, 'สาขา/ตัวแทนจำหน่าย', 1, 'shop', 1, '2017-08-01 17:51:50'),
(4, 4, 'ข้อมูลส่วนตัว', 3, 'profile', 1, '2018-02-08 23:43:13'),
(6, 2, 'ลูกค้า', 1, 'customer', 2, '2017-08-01 17:51:38'),
(7, 2, 'กลุ่มลูกค้า', 1, 'groupcustomer', 3, '2017-08-01 17:55:57'),
(8, 8, 'ขายหน้าร้านแบบรายการ', 1, 'sell', 2, '2018-02-14 09:29:18'),
(9, 7, 'ใบสั่งซื้อ', 1, 'order', 1, '2017-08-03 23:55:10'),
(10, 6, 'สินค้า', 1, 'product', 1, '2017-08-01 18:06:29'),
(11, 9, 'กระเป๋าเงิน', 1, 'wallet', 1, '2017-08-01 18:07:39'),
(12, 10, 'สรุปยอดขาย', 1, 'reportsummary', 1, '2017-09-14 19:03:37'),
(13, 6, 'หมวดหมู่สินค้า', 1, 'category', 2, '2017-08-03 21:00:18'),
(14, 6, 'คลังสินค้า', 1, 'stock', 3, '2017-08-03 22:27:35'),
(15, 8, 'เปิด Order', 1, 'quotation', 4, '2017-08-30 16:03:23'),
(16, 7, 'คู่ค้า', 1, 'partners', 7, '2017-08-03 22:50:18'),
(17, 7, 'กลุ่มคู่ค้า', 1, 'grouppartners', 9, '2017-08-03 22:55:39'),
(18, 7, 'รายการสั่งซื้อ (ประจำสาขา/ตัวแทน)', 1, 'purchase', 3, '2017-09-15 09:07:08'),
(20, 8, 'รายการ Order', 1, 'receipt', 5, '2017-09-13 21:04:42'),
(22, 9, 'ค่าใช้จ่าย', 1, 'expense', 4, '2017-08-23 14:09:26'),
(23, 9, 'รายการโอนเงิน', 1, 'alienate', 2, '2017-08-04 00:13:21'),
(24, 4, 'บริษัท/ร้านค้า', 1, 'shopsetting', 5, '2017-08-05 23:11:48'),
(25, 4, 'เอกสาร', 1, 'documentsetting', 7, '2017-08-06 15:27:16'),
(28, 4, 'Send SMS', 1, 'smss', 8, '2017-11-11 23:21:22'),
(31, 6, 'สติ๊กเกอร์สินค้า', 1, 'sticker', 4, '2017-08-20 22:44:25'),
(33, 4, 'จัดการผู้ใช้ระบบ', 1, 'user', 4, '2017-08-23 16:08:35'),
(34, 11, 'บัญชี', 1, 'logbank', 1, '2017-08-24 11:53:39'),
(35, 11, 'ค่าใช้จ่าย', 1, 'logexpense', 2, '2017-08-24 11:54:32'),
(36, 11, 'ใบเสร็จรับเงิน', 1, 'logreceipt3', 5, '2017-08-24 11:55:50'),
(37, 11, 'ขายหน้าร้าน', 1, 'logreceipt1', 3, '2017-08-24 11:56:08'),
(38, 11, 'ใบเสนอราคา', 1, 'logreceipt2', 4, '2017-08-24 11:56:30'),
(39, 11, 'ใบสั่งซื้อ', 1, 'logreceipt4', 6, '2017-08-24 11:57:04'),
(41, 8, 'ใบเสร็จรับเงิน', 1, 'bill', 6, '2017-08-18 18:55:47'),
(44, 12, 'สติ๊กเกอร์สินค้า', 1, 'stickertransport', 1, '2017-08-30 21:59:33'),
(45, 12, 'บรรจุสินค้า', 1, 'pack', 2, '2017-08-30 15:58:45'),
(46, 12, 'จัดส่งสินค้า', 1, 'transport', 3, '2017-08-30 15:59:16'),
(47, 4, 'ผู้ส่งสินค้า', 1, 'settingtransport', 6, '2017-08-30 16:07:00'),
(48, 8, 'รายการขายหน้าร้าน', 1, 'selllist', 3, '2017-08-30 16:10:46'),
(52, 7, 'คู่ค้า (ประจำสาขา/ตัวแทน)', 1, 'partnerssub', 8, '2017-09-15 09:05:50'),
(53, 7, 'รายการสั่งซื้อ (สาขา/ตัวแทน สั่ง)', 1, 'ordersub', 4, '2017-09-15 09:13:01'),
(54, 10, 'จัดอันดับยอดซื้อลูกค้า', 1, 'reportcustomerbuy', 8, '2017-09-14 19:04:02'),
(55, 10, 'จัดอันดับยอดขาย', 1, 'reportusersell', 9, '2017-09-14 19:04:10'),
(56, 10, 'จัดอันดับสินค้าขายดี', 1, 'reportproductbuy', 12, '2017-09-14 19:04:19'),
(57, 10, 'สินค้าคงคลัง', 1, 'reportwarehouse', 13, '2017-09-14 19:04:27'),
(58, 10, 'ความเคลื่อนไหวสินค้า', 1, 'reportproductmovement', 14, '2017-09-14 19:07:28'),
(59, 7, 'ใบแจ้งหนี้ (รับเข้าสินค้า)', 1, 'invoicelist', 5, '2017-09-13 21:47:03'),
(60, 4, 'ข้อมูลส่วนตัว (ลูกค้า)', 1, 'profilecustomer', 9, '2017-09-10 18:24:30'),
(61, 7, 'ใบแจ้งหนี้ (ส่งสินค้าออก)', 1, 'invoicesub', 6, '2017-09-15 09:12:20'),
(62, 12, 'จัดส่งสินค้า (ลูกค้า)', 1, 'transportcustomer', 4, '2017-09-10 22:03:49'),
(69, 9, 'รายการโอนเงิน (ลูกค้า)', 1, 'alienatecustomer', 5, '2017-09-10 22:57:09'),
(70, 7, 'รายการสั่งซื้อ', 1, 'ordermain', 2, '2017-09-12 15:34:49'),
(71, 10, 'ความเคลื่อนไหวสินค้า (สาขา/ตัวแทน)', 1, 'reportproductmovementsub', 15, '2017-09-27 15:38:46'),
(73, 11, 'ใบแจ้งหนี้', 1, 'logreceipt5', 7, '2017-09-14 10:56:31'),
(74, 10, 'สรุปใบสั่งซื้อ', 1, 'reportbuy', 5, '2017-09-14 22:29:33'),
(75, 10, 'สรุปใบแจ้งหนี้ (ส่งออกสินค้า)', 1, 'reportinvoice', 6, '2017-09-27 15:38:35'),
(76, 10, 'สินค้าส่งออก (สาขา/ตัวแทน)', 1, 'reporttransport', 16, '2017-09-27 15:39:01'),
(78, 10, 'สรุปใบแจ้งหนี้ (รับเข้าสินค้า)', 1, 'reportinvoicesub', 7, '2017-09-27 15:38:39'),
(79, 12, 'ตรวจสอบการจัดส่ง', 1, 'checktransport', 5, '2017-09-22 13:26:19'),
(80, 10, 'บริการส่งสินค้า', 1, 'reporttransportorder', 17, '2017-09-25 19:03:48'),
(81, 11, 'รายงานการส่งสินค้า', 1, 'logtransportexport', 9, '2017-09-26 17:18:15'),
(82, 10, 'สรุปยอดขาย (สินค้าส่งออกแล้ว) ', 1, 'reportsummarytransport', 3, '2017-10-14 21:02:58'),
(83, 10, 'ยอดขายพนักงาน (กลุ่มสินค้า) ', 1, 'reportsummarygroup', 4, '2017-10-14 21:03:13'),
(84, 4, 'หัวข้อ SMS', 1, 'headsms', 10, '2017-10-15 10:38:36'),
(85, 10, 'สรุปยอดขาย (รายการสินค้า)', 1, 'reportsummaryproduct', 2, '2017-10-16 21:38:58'),
(86, 4, 'แพ็กเกจ', 3, 'package', 2, '2018-02-08 23:42:30'),
(87, 4, 'แจ้งชำระเงิน', 3, 'payment', 3, '2018-02-08 23:47:04'),
(88, 14, 'เปิดใบบริการ', 1, 'services', 1, '2018-02-28 23:15:59'),
(89, 8, 'ขายหน้าร้านแบบรูปภาพ', 1, 'selleasy', 1, '2018-02-14 09:31:54'),
(90, 14, 'รายการบริการ', 1, 'serviceslist', 2, '2018-02-28 23:16:05'),
(91, 14, 'ตรวจสอบบริการ', 1, 'servicescheck', 3, '2018-02-20 21:24:48'),
(92, 14, 'เพิ่มการบริการ', 1, 'servicesadd', 4, '2018-02-20 21:24:54'),
(93, 11, 'ใบบริการ', 1, 'logservices', 8, '2018-02-28 11:25:10'),
(94, 10, 'สรุปบริการ', 1, 'reportsummaryservices', 10, '2018-03-01 08:28:13'),
(95, 10, 'สรุปรายการบริการ', 1, 'reportservices', 11, '2018-03-02 23:31:48'),
(96, 10, 'บริการส่งสินค้า (จัดส่งเอง)', 1, 'reporttransportdelivery', 18, '2018-03-02 08:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(255) DEFAULT NULL,
  `package_cost` varchar(45) DEFAULT NULL,
  `package_useuser` int(11) DEFAULT NULL,
  `package_useshop` int(11) DEFAULT NULL,
  `package_useagent` int(11) DEFAULT NULL,
  `package_usedate` int(11) DEFAULT NULL,
  `package_sms` int(11) DEFAULT NULL,
  `package_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 ปกติ 2 ระงับ',
  `package_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `package_name`, `package_cost`, `package_useuser`, `package_useshop`, `package_useagent`, `package_usedate`, `package_sms`, `package_status`, `package_modify`) VALUES
(1, 'แพ็กเกจ Free', 'ฟรี', 2, 1, 1, 10, 10, 1, '2018-02-28 20:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `partners_id_pri` int(11) NOT NULL COMMENT 'คู่ค้า',
  `partners_id` varchar(45) DEFAULT NULL COMMENT 'รหัสตั้งเอง',
  `partners_group_id` int(11) NOT NULL COMMENT 'กลุ่มคู่ค้า',
  `fullname` varchar(255) DEFAULT NULL COMMENT 'ชื่อเต็ม',
  `email` varchar(100) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL COMMENT 'เบอร์โทร',
  `facebook` varchar(100) DEFAULT NULL COMMENT 'ติดต่อ facebook',
  `line` varchar(100) DEFAULT NULL COMMENT 'ติดต่อ Line',
  `instagram` varchar(100) DEFAULT NULL COMMENT 'ติดต่อ instagram',
  `address` varchar(1000) DEFAULT NULL COMMENT 'ที่อยู่ลูกค้า',
  `status_id` int(11) NOT NULL COMMENT 'สถานะ',
  `tax_id` varchar(15) DEFAULT NULL COMMENT 'เลขที่ผู้เสียภาษี',
  `tax_shop` varchar(100) DEFAULT NULL COMMENT 'ชื่อร้าน/บริษัท ที่เสียภาษี',
  `tax_shop_sub` varchar(500) DEFAULT NULL COMMENT 'ชื่อสาขา',
  `tax_address` varchar(45) DEFAULT NULL COMMENT 'ที่อยู่ร้านที่เสียภาษี',
  `date_create` date DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `partners_group`
--

CREATE TABLE `partners_group` (
  `partners_group_id` int(11) NOT NULL COMMENT 'กลุ่มคู่ค้า',
  `shop_id_pri` int(11) NOT NULL,
  `partners_group_name` varchar(100) DEFAULT NULL COMMENT 'ชื่อกลุ่มคู่ค้า',
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `process_transport`
--

CREATE TABLE `process_transport` (
  `process_transport_id` int(11) NOT NULL COMMENT 'เก็บการประมวดผลการขนส่งจาก api ของแต่ละครั้ง',
  `shop_id_pri` int(11) NOT NULL COMMENT 'อ้างถึงร้าน',
  `user_id` int(11) NOT NULL COMMENT 'คนที่กดประมวลผลล่าสุด',
  `date_modify` datetime DEFAULT NULL COMMENT 'วันอัพเดทล่าสุด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id_pri` bigint(20) NOT NULL,
  `product_id` varchar(45) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `product_category_id` int(11) NOT NULL COMMENT 'หมวดหมู่',
  `product_name` varchar(100) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `product_brand` varchar(45) DEFAULT NULL COMMENT 'ยี้ห้อ',
  `product_gen` varchar(45) DEFAULT NULL COMMENT 'รุ่น',
  `product_buy_price` decimal(20,2) DEFAULT NULL COMMENT 'ราคาซื้อ',
  `product_sale_price` decimal(20,2) DEFAULT NULL COMMENT 'ราคาขาย',
  `product_weight` decimal(20,2) DEFAULT NULL COMMENT 'น้ำหนัก (กรัม)',
  `product_unit` varchar(20) DEFAULT NULL COMMENT 'หน่วยสินค้า ชิ้น , ตัว , ขวด',
  `product_barcode` varchar(45) DEFAULT NULL COMMENT 'บาร์โค้ด',
  `product_amount` varchar(45) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `image_id` bigint(20) NOT NULL COMMENT 'รูปสินค้า',
  `status_product_id` tinyint(4) NOT NULL COMMENT 'สถานะ แสดง ไม่แสดง ในหน้าขาย',
  `transfer_id` bigint(20) DEFAULT NULL COMMENT 'เก็บ product_id_pri ของแม่ไว้เพื่อเช็คเวลาดึงรายการ',
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` int(11) NOT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `product_category_name` varchar(100) DEFAULT NULL COMMENT 'ชื่อหมวดหมู่',
  `transfer_id` int(11) DEFAULT NULL COMMENT 'เก็บ category_id ของแม่ไว้เพื่อเช็คเวลาดึงรายการ',
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_properties`
--

CREATE TABLE `product_properties` (
  `product_properties_id` bigint(20) NOT NULL COMMENT 'คุณสมบัติสินค้า เช่น สี:เขียว ยาว:15cm',
  `product_id_pri` bigint(20) NOT NULL,
  `product_properties_name` varchar(100) DEFAULT NULL COMMENT 'ชื่อหมวดหมู่',
  `product_properties_value` varchar(100) DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(11) NOT NULL,
  `income_bank_id` int(11) NOT NULL,
  `receipt_number` varchar(45) DEFAULT NULL,
  `receipt_by` text,
  `receipt_cost` decimal(10,0) DEFAULT NULL,
  `receipt_datepay` date DEFAULT NULL,
  `receipt_timepay` time DEFAULT NULL,
  `receipt_evidence` text,
  `receipt_check` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `sms_id` int(11) DEFAULT NULL,
  `receipt_create` datetime DEFAULT NULL,
  `receipt_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `receipt_detail`
--

CREATE TABLE `receipt_detail` (
  `receipt_detail_id` bigint(20) NOT NULL COMMENT 'รายละเอียดบิล',
  `receipt_master_id_pri` bigint(20) NOT NULL COMMENT 'อ้างถึงใบเสร็จ',
  `product_id` varchar(45) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `product_name` varchar(500) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `product_amount` int(11) DEFAULT NULL COMMENT 'จำนวนสินค้า',
  `product_unit` varchar(45) DEFAULT NULL COMMENT 'หน่วยสินค้า',
  `product_price` decimal(20,2) DEFAULT NULL COMMENT 'ราคาสินค้าต่อหน่วย',
  `product_save` decimal(20,2) DEFAULT NULL COMMENT 'ส่วนลดต่อหน่วย',
  `product_price_sum` decimal(20,2) DEFAULT NULL COMMENT 'ราคารวม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `receipt_master`
--

CREATE TABLE `receipt_master` (
  `receipt_master_id_pri` bigint(20) NOT NULL,
  `receipt_master_id` varchar(45) DEFAULT NULL COMMENT 'รหัสรายการ',
  `shop_id_pri` int(11) NOT NULL COMMENT 'อ้างว่าใบเสร็จเป็นของร้านไหน',
  `user_id` int(11) NOT NULL COMMENT 'พนักงานออกใบเสร็จ',
  `type_receipt_id` tinyint(4) NOT NULL COMMENT 'ประเภท\nขายออก\nนำเข้า',
  `refer` varchar(45) DEFAULT NULL COMMENT 'อ้างอิงจากใบเสร็จอื่น หยอด receipt_master_id ของใบอื่น',
  `sale_from_id` tinyint(4) NOT NULL COMMENT 'ช่องทางขาย',
  `type_tax_id` tinyint(4) NOT NULL COMMENT 'ประเภทภาษี',
  `customer_id` varchar(45) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `customer_name` varchar(100) DEFAULT NULL COMMENT 'ชื่อลูกค้า',
  `customer_tel` varchar(20) DEFAULT NULL COMMENT 'เบอร์โทร',
  `customer_email` varchar(100) DEFAULT NULL COMMENT 'อีเมล์ ลูกค้า',
  `customer_address` varchar(500) DEFAULT NULL COMMENT 'ที่อยู่ลูกค้า',
  `customer_district` varchar(45) DEFAULT NULL,
  `customer_amphoe` varchar(45) DEFAULT NULL,
  `customer_province` varchar(45) DEFAULT NULL,
  `customer_zipcode` varchar(45) DEFAULT NULL,
  `customer_tax_id` varchar(45) DEFAULT NULL COMMENT 'ออกใบกำกับภาษี',
  `customer_tax_shop` varchar(100) DEFAULT NULL COMMENT 'ชื่อร้าน/บริษัท ออกใบกำกับภาษี',
  `customer_tax_shop_sub` varchar(45) DEFAULT NULL COMMENT 'ชื่อสาขา',
  `customer_tax_address` varchar(500) DEFAULT NULL COMMENT 'ที่อยู่ออกใบกำกับภาษี',
  `price_product_sum` decimal(20,2) DEFAULT NULL COMMENT 'รวมราคาสินค้า',
  `save` varchar(145) DEFAULT NULL COMMENT 'ส่วนลด (ดึงจากกลุ่มลูกค้าได้)',
  `price_befor_tax` decimal(20,2) DEFAULT NULL COMMENT 'ราคารวมก่อน + ภาษี 7%',
  `price_tax` decimal(20,2) DEFAULT NULL COMMENT 'ภาษี 7% ที่คำนวณแล้ว',
  `price` decimal(20,2) DEFAULT NULL COMMENT 'ราคาสินค้ารวมภาษี',
  `withholding_tax` varchar(10) DEFAULT NULL COMMENT 'หักภาษี ณ ที่จ่าย',
  `price_sum_pay` varchar(45) DEFAULT NULL COMMENT 'ยอดที่ต้องชำระรวมทั้งหมด',
  `transport_service_id` tinyint(4) NOT NULL DEFAULT '99',
  `transport_date` datetime DEFAULT NULL COMMENT 'วันที่ส่งสินค้า',
  `transport_service_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อบริการขนส่ง',
  `transport_send_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อผุู่ส่ง',
  `transport_send_tel` varchar(45) DEFAULT NULL COMMENT 'เบอร์โทรผู้ส่ง',
  `transport_send_address` varchar(1000) DEFAULT NULL COMMENT 'ที่อยู่ผู้ส่ง',
  `transport_price` decimal(20,2) DEFAULT NULL COMMENT 'ราคาจัดส่ง',
  `transport_tracking_id` varchar(100) DEFAULT NULL COMMENT 'รหัสติดตามจัดส่ง',
  `transport_customer` varchar(255) DEFAULT NULL COMMENT 'ชื่อผู้รับ',
  `transport_customer_tel` varchar(45) DEFAULT NULL COMMENT 'เบอร์โทรผู้รับสินค้า',
  `transport_customer_address` varchar(1000) DEFAULT NULL COMMENT 'ที่อยู่ผู้รับ + เบอร์ติดต่อ',
  `transport_customer_district` varchar(45) DEFAULT NULL,
  `transport_customer_amphoe` varchar(45) DEFAULT NULL,
  `transport_customer_province` varchar(45) DEFAULT NULL,
  `transport_customer_zipcode` varchar(45) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL COMMENT 'หมายเหตุ',
  `bank_id` int(11) DEFAULT NULL COMMENT 'คลังเงินที่จะเข้า หรือ ออก',
  `status_receipt_id` tinyint(4) NOT NULL COMMENT 'สถานะใบเสร็จ',
  `status_pay_id` tinyint(4) DEFAULT NULL COMMENT 'สถานะชำระ ชำระแล้ว , ยังไม่ได้ชไระ , ชำระบางส่วน',
  `status_transfer_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'สถานะการส่งสินค้า',
  `date_transfer` date DEFAULT NULL COMMENT 'วันที่ทำรายการ status_transfer_id',
  `status_receipt_order_id` tinyint(4) NOT NULL COMMENT 'สถานะสำหรับใบเปิด order',
  `status_receipt_print_id` tinyint(4) NOT NULL COMMENT 'สถานะการปริ้นใบเสร็จ',
  `date_receipt_print` date DEFAULT NULL COMMENT 'วันที่ปริ้นใบเสร็จ',
  `status_sticker_transport_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'สถานะปริ้น สติ๊กเกอร์',
  `date_sticker` date DEFAULT NULL COMMENT 'วันที่ปริ้น สติ๊กเกอร์',
  `status_pack_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'สถานะการแพ็คของ',
  `confirm_order_id` tinyint(4) DEFAULT '1',
  `status_get_product_id` tinyint(4) DEFAULT '1' COMMENT 'สถานะยืนยันได้รับของ',
  `credit` int(11) DEFAULT NULL COMMENT 'ใช้สำหรับให้เคดิตใบสั่งซื้อว่าจะให้เวลาชำระเงินกี่วัน 15 30 60',
  `date_pack` date DEFAULT NULL COMMENT 'วันที่แพ็กของ',
  `date_receipt` date DEFAULT NULL COMMENT 'วันที่ออกใบเสร็จ',
  `date_pay` date DEFAULT NULL COMMENT 'วันที่ชำระเงิน',
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `receipt_temp`
--

CREATE TABLE `receipt_temp` (
  `receipt_temp_id` int(11) NOT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` varchar(45) DEFAULT NULL,
  `product_name` varchar(45) DEFAULT NULL,
  `product_amount` int(11) DEFAULT NULL,
  `product_unit` varchar(45) DEFAULT NULL,
  `product_price` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ref_confirm_order`
--

CREATE TABLE `ref_confirm_order` (
  `confirm_order_id` tinyint(4) NOT NULL COMMENT 'สถานะการยืนยันใบสั่งซื้อ',
  `confirm_order_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='สถานะการยืนยันใบสั่งซื้อ';

--
-- Dumping data for table `ref_confirm_order`
--

INSERT INTO `ref_confirm_order` (`confirm_order_id`, `confirm_order_name`) VALUES
(1, 'รอออกใบแจ้งหนี้'),
(2, 'ออกใบแจ้งหนี้แล้ว'),
(3, 'ไม่มีสินค้ารอส่ง');

-- --------------------------------------------------------

--
-- Table structure for table `ref_receipt_print`
--

CREATE TABLE `ref_receipt_print` (
  `receipt_print_id` tinyint(4) NOT NULL COMMENT 'ขนาดใบเสร็จที่ปริ้น',
  `receipt_print_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_receipt_print`
--

INSERT INTO `ref_receipt_print` (`receipt_print_id`, `receipt_print_name`) VALUES
(1, 'A4'),
(2, 'B5');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status`
--

CREATE TABLE `ref_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_status`
--

INSERT INTO `ref_status` (`status_id`, `status_name`) VALUES
(1, 'ปกติ'),
(2, 'ถูกระงับ');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status_expense`
--

CREATE TABLE `ref_status_expense` (
  `status_expense_id` tinyint(4) NOT NULL COMMENT 'สถานะรายการที่จ่าย',
  `status_expense_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_status_expense`
--

INSERT INTO `ref_status_expense` (`status_expense_id`, `status_expense_name`) VALUES
(1, 'รอจ่าย'),
(2, 'จ่ายแล้ว'),
(3, 'ยกเลิก');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status_get_product`
--

CREATE TABLE `ref_status_get_product` (
  `status_get_product_id` tinyint(4) NOT NULL COMMENT 'สถานะยืนยันได้รับของ',
  `status_get_product_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='สถานะการยืนยันใบสั่งซื้อ';

--
-- Dumping data for table `ref_status_get_product`
--

INSERT INTO `ref_status_get_product` (`status_get_product_id`, `status_get_product_name`) VALUES
(1, 'ยังไม่ได้รับของ'),
(2, 'ได้รับของแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status_inform`
--

CREATE TABLE `ref_status_inform` (
  `status_inform_id` tinyint(4) NOT NULL COMMENT 'สถานะการตรวจสอบรายการโอน',
  `status_inform_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_status_inform`
--

INSERT INTO `ref_status_inform` (`status_inform_id`, `status_inform_name`) VALUES
(1, 'รอการตรวจสอบ'),
(2, 'ตรวจสอบแล้ว'),
(3, 'ข้อมูลไม่ถูกต้อง');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status_pack`
--

CREATE TABLE `ref_status_pack` (
  `status_pack_id` tinyint(4) NOT NULL COMMENT 'สถานะการแพ็คของ',
  `status_pack_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_status_pack`
--

INSERT INTO `ref_status_pack` (`status_pack_id`, `status_pack_name`) VALUES
(1, 'รอบรรจุ'),
(2, 'เสร็จสิ้น');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status_pay`
--

CREATE TABLE `ref_status_pay` (
  `status_pay_id` tinyint(4) NOT NULL COMMENT 'สถานะชำระ ชำระแล้ว , ยังไม่ได้ชไระ , ชำระบางส่วน',
  `status_pay_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_status_pay`
--

INSERT INTO `ref_status_pay` (`status_pay_id`, `status_pay_name`) VALUES
(1, 'ชำระเงินแล้ว'),
(2, 'รอการชำระเงิน'),
(3, 'ชำระเงินบางส่วน'),
(4, 'แจ้งโอนแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status_product`
--

CREATE TABLE `ref_status_product` (
  `status_product_id` tinyint(4) NOT NULL COMMENT 'สถานะ แสดง ไม่แสดง ในหน้าขาย',
  `status_product_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_status_product`
--

INSERT INTO `ref_status_product` (`status_product_id`, `status_product_name`) VALUES
(1, 'เปิดใช้งานปกติ'),
(2, 'ปิดการใช้งาน');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status_receipt`
--

CREATE TABLE `ref_status_receipt` (
  `status_receipt_id` tinyint(4) NOT NULL COMMENT 'สถานะใบเสร็จ\nบันทึก\nยกเลิก',
  `status_receipt_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_status_receipt`
--

INSERT INTO `ref_status_receipt` (`status_receipt_id`, `status_receipt_name`) VALUES
(1, 'บันทึก'),
(2, 'ยกเลิก');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status_receipt_order`
--

CREATE TABLE `ref_status_receipt_order` (
  `status_receipt_order_id` tinyint(4) NOT NULL COMMENT 'สถานะสำหรับใบเปิด order',
  `status_receipt_order_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_status_receipt_order`
--

INSERT INTO `ref_status_receipt_order` (`status_receipt_order_id`, `status_receipt_order_name`) VALUES
(1, 'ยังไม่ได้ออกใบเสร็จ'),
(2, 'ออกใบเสร็จแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status_receipt_print`
--

CREATE TABLE `ref_status_receipt_print` (
  `status_receipt_print_id` tinyint(4) NOT NULL COMMENT 'สถานะการปริ้นใบเสร็จ',
  `status_receipt_print_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_status_receipt_print`
--

INSERT INTO `ref_status_receipt_print` (`status_receipt_print_id`, `status_receipt_print_name`) VALUES
(1, 'ยังไม่ได้ปริ้นใบเสร็จ'),
(2, 'ปริ้นใบเสร็จแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status_shop`
--

CREATE TABLE `ref_status_shop` (
  `status_shop_id` tinyint(4) NOT NULL COMMENT 'สถานะร้าน ปกติ , ถูกระงับ\n',
  `status_shop_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_status_shop`
--

INSERT INTO `ref_status_shop` (`status_shop_id`, `status_shop_name`) VALUES
(1, 'เปิดใช้งานปกติ'),
(2, 'ระงับการใช้งาน');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status_sticker_transport`
--

CREATE TABLE `ref_status_sticker_transport` (
  `status_sticker_transport_id` tinyint(4) NOT NULL COMMENT 'สถานะปริ้น สติ๊กเกอร์',
  `status_sticker_transport_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_status_sticker_transport`
--

INSERT INTO `ref_status_sticker_transport` (`status_sticker_transport_id`, `status_sticker_transport_name`) VALUES
(1, 'รอปริ้น'),
(2, 'ปริ้นแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status_transfer`
--

CREATE TABLE `ref_status_transfer` (
  `status_transfer_id` tinyint(4) NOT NULL COMMENT 'สถานะการส่งสินค้า ยังไม่ได้ส่ง ,กำลังส่ง, ได้รับสินค้าแล้ว',
  `status_transfer_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_status_transfer`
--

INSERT INTO `ref_status_transfer` (`status_transfer_id`, `status_transfer_name`) VALUES
(1, 'รอจัดส่ง'),
(2, 'จัดส่งแล้ว'),
(3, 'รับของแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `ref_transport_service`
--

CREATE TABLE `ref_transport_service` (
  `transport_service_id` tinyint(4) NOT NULL COMMENT 'บริการขนส่ง',
  `transport_service_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อบริการขนส่ง',
  `transport_service_type` tinyint(4) DEFAULT NULL COMMENT '1 บริการขนส่งที่มีในระบบ\n2 บริการขนส่งอื่นๆ (กรอกชื่อเพิ่มเอง)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_transport_service`
--

INSERT INTO `ref_transport_service` (`transport_service_id`, `transport_service_name`, `transport_service_type`) VALUES
(1, 'Dropoff EMS', 1),
(2, 'Kerry Express', 1),
(3, 'จัดส่งเอง', 2),
(99, 'ไม่ระบุ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ref_transport_status`
--

CREATE TABLE `ref_transport_status` (
  `transport_status_id` tinyint(4) NOT NULL COMMENT 'สถานะการจัดส่งจาก api',
  `transport_status_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_transport_status`
--

INSERT INTO `ref_transport_status` (`transport_status_id`, `transport_status_name`) VALUES
(1, 'กำลังส่งสินค้า'),
(2, 'ถึงแล้วรอรับสินค้า'),
(3, 'รายการส่งกลับ'),
(4, 'รับสินค้าแล้ว'),
(5, 'เกิดข้อผิดพลาด');

-- --------------------------------------------------------

--
-- Table structure for table `ref_transport_type_pay`
--

CREATE TABLE `ref_transport_type_pay` (
  `transport_type_pay_id` tinyint(4) NOT NULL COMMENT 'ประเภทการจ่ายเงิน',
  `transport_type_pay_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_transport_type_pay`
--

INSERT INTO `ref_transport_type_pay` (`transport_type_pay_id`, `transport_type_pay_name`) VALUES
(1, 'ชำระเงินแล้ว'),
(2, 'เก็บเงินปลายทาง');

-- --------------------------------------------------------

--
-- Table structure for table `ref_type_bank`
--

CREATE TABLE `ref_type_bank` (
  `type_bank_id` tinyint(4) NOT NULL COMMENT 'ประเภท bank ลบได้ (ลบไม่ได้)',
  `type_bank_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_type_bank`
--

INSERT INTO `ref_type_bank` (`type_bank_id`, `type_bank_name`) VALUES
(1, 'ค่าเริ่มต้น (ลบไม่ได้)'),
(2, 'ลบได้');

-- --------------------------------------------------------

--
-- Table structure for table `ref_type_payment`
--

CREATE TABLE `ref_type_payment` (
  `type_payment_id` tinyint(4) NOT NULL COMMENT 'ประเภทการชำระ\nเงินสด\nบัตรเคดิต\nโอนธนาคาร',
  `type_payment_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_type_payment`
--

INSERT INTO `ref_type_payment` (`type_payment_id`, `type_payment_name`) VALUES
(1, 'เงินสด'),
(2, 'บัตรเครดิต'),
(3, 'โอนธนาคาร');

-- --------------------------------------------------------

--
-- Table structure for table `ref_type_receipt`
--

CREATE TABLE `ref_type_receipt` (
  `type_receipt_id` tinyint(4) NOT NULL COMMENT 'ประเภท\nขายสินค้าออก\nนำสินค้าเข้า',
  `type_receipt_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_type_receipt`
--

INSERT INTO `ref_type_receipt` (`type_receipt_id`, `type_receipt_name`) VALUES
(1, 'ขายหน้าร้าน'),
(2, 'ใบเปิด Order'),
(3, 'ใบเสร็จรับเงิน'),
(4, 'ใบสั่งซื้อ'),
(5, 'ใบแจ้งหนี้');

-- --------------------------------------------------------

--
-- Table structure for table `ref_type_save`
--

CREATE TABLE `ref_type_save` (
  `type_save_id` tinyint(4) NOT NULL COMMENT 'ประเภทส่วนลด % , บาท',
  `type_save_name` varchar(45) DEFAULT NULL COMMENT 'ประเภทส่วนลด % , บาท'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_type_save`
--

INSERT INTO `ref_type_save` (`type_save_id`, `type_save_name`) VALUES
(1, '%'),
(2, 'บาท');

-- --------------------------------------------------------

--
-- Table structure for table `ref_type_shop`
--

CREATE TABLE `ref_type_shop` (
  `type_shop_id` tinyint(4) NOT NULL COMMENT 'ประเภทร้าน ร้านหลักระบบ(เจ้าของแบร์น) ,ร้านหลัก(ตัวแทน) ,ร้านสาขาย่อย\n',
  `type_shop_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_type_shop`
--

INSERT INTO `ref_type_shop` (`type_shop_id`, `type_shop_name`) VALUES
(1, 'ร้านหลักระบบ(เจ้าของแบร์น)'),
(2, 'สาขาย่อย'),
(3, 'ตัวแทนจำหน่าย');

-- --------------------------------------------------------

--
-- Table structure for table `ref_type_tax`
--

CREATE TABLE `ref_type_tax` (
  `type_tax_id` tinyint(4) NOT NULL COMMENT 'ประเภทภาษี\nไม่มีภาษี\nแยกภาษีมูลค่าเพิ่ม 7%\nรวมภาษีมูลค่าเพิ่ม 7%',
  `type_tax_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_type_tax`
--

INSERT INTO `ref_type_tax` (`type_tax_id`, `type_tax_name`) VALUES
(1, 'ไม่มีภาษี'),
(2, '\nแยกภาษีมูลค่าเพิ่ม 7%'),
(3, '\nรวมภาษีมูลค่าเพิ่ม 7%');

-- --------------------------------------------------------

--
-- Table structure for table `ref_type_user`
--

CREATE TABLE `ref_type_user` (
  `type_user_id` tinyint(4) NOT NULL COMMENT 'ประเภท user เช่น ผู้ขายหลัก , ตัวแทนจำหน่าย',
  `type_user_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_type_user`
--

INSERT INTO `ref_type_user` (`type_user_id`, `type_user_name`) VALUES
(1, 'ผู้ใช้หลัก'),
(2, 'ผูใช้ย่อย');

-- --------------------------------------------------------

--
-- Table structure for table `ref_withholding_tax`
--

CREATE TABLE `ref_withholding_tax` (
  `withholding_tax_id` tinyint(4) NOT NULL COMMENT 'ประเภทภาษีหัก ณ ที่จ่าย',
  `withholding_tax` int(11) DEFAULT NULL COMMENT '1% 2% 3% 5% 10% 15%',
  `withholding_tax_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_withholding_tax`
--

INSERT INTO `ref_withholding_tax` (`withholding_tax_id`, `withholding_tax`, `withholding_tax_name`) VALUES
(1, 1, '1%'),
(2, 2, '2%'),
(3, 3, '3%'),
(4, 5, '5%'),
(5, 10, '10%'),
(6, 15, '15%');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` tinyint(4) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `date_modify`) VALUES
(1, 'ผู้ดูแลระบบ', '2017-07-30 19:26:53'),
(2, 'ผู้จัดการ', '2017-07-30 22:25:00'),
(3, 'ผู้จัดการสาขา', '2017-07-30 22:23:52'),
(4, 'ตัวแทนจำหน่าย', '2017-07-30 21:12:10'),
(5, 'ฝ่ายขาย', '2017-07-30 22:25:24'),
(6, 'ฝ่ายคลังสินค้า', '2017-07-30 22:30:42'),
(7, 'ฝ่ายการเงิน', '2017-07-30 22:31:04'),
(8, 'ลูกค้า', '2017-08-02 23:02:58'),
(9, 'ฝ่ายขายสาขา', '2017-07-30 22:25:24'),
(10, 'ฝ่ายคลังสินค้าสาขา', '2017-07-30 22:30:42'),
(11, 'ฝ่ายการเงินสาขา', '2017-07-30 22:31:04'),
(12, 'ฝ่ายขายตัวแทน', '2017-07-30 22:25:24'),
(13, 'ฝ่ายคลังสินค้าตัวแทน', '2017-07-30 22:30:42'),
(14, 'ฝ่ายการเงินตัวแทน', '2017-07-30 22:31:04'),
(15, 'ฝ่ายบริการหลังการขาย', '2018-03-05 18:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `sale_from`
--

CREATE TABLE `sale_from` (
  `sale_from_id` tinyint(4) NOT NULL COMMENT 'ช่องทางขาย หน้าร้าน (ค่าตั้งต้น) Facebook , Instagram',
  `sale_from_name` varchar(45) DEFAULT NULL,
  `shop_id_pri` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_from`
--

INSERT INTO `sale_from` (`sale_from_id`, `sale_from_name`, `shop_id_pri`) VALUES
(1, 'ไม่ระบุ', NULL),
(2, 'Facebook', 1),
(3, 'Instagram', 1),
(4, 'Line', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `services_id` int(11) NOT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `services_name` varchar(225) DEFAULT NULL,
  `services_cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `services_detail`
--

CREATE TABLE `services_detail` (
  `services_detail_id` bigint(20) NOT NULL,
  `services_master_id_pri` bigint(20) NOT NULL,
  `services_id` varchar(45) DEFAULT NULL,
  `services_name` varchar(500) DEFAULT NULL,
  `services_detail_number` varchar(45) DEFAULT NULL,
  `services_amount` int(11) DEFAULT NULL,
  `services_price` decimal(20,2) DEFAULT NULL,
  `services_save` decimal(20,2) DEFAULT NULL,
  `services_price_sum` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `services_master`
--

CREATE TABLE `services_master` (
  `services_master_id_pri` bigint(20) NOT NULL,
  `services_master_id` varchar(45) DEFAULT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_tax_id` tinyint(4) NOT NULL,
  `customer_id` varchar(45) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_tel` varchar(20) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_address` varchar(500) DEFAULT NULL,
  `customer_district` varchar(45) DEFAULT NULL,
  `customer_amphoe` varchar(45) DEFAULT NULL,
  `customer_province` varchar(45) DEFAULT NULL,
  `customer_zipcode` varchar(45) DEFAULT NULL,
  `customer_tax_id` varchar(45) DEFAULT NULL,
  `customer_tax_shop` varchar(100) DEFAULT NULL,
  `customer_tax_shop_sub` varchar(45) DEFAULT NULL,
  `customer_tax_address` varchar(500) DEFAULT NULL,
  `price_services_sum` decimal(20,2) DEFAULT NULL,
  `save` varchar(145) DEFAULT NULL,
  `price_befor_tax` decimal(20,2) DEFAULT NULL,
  `price_tax` decimal(20,2) DEFAULT NULL,
  `price` decimal(20,2) DEFAULT NULL,
  `withholding_tax` varchar(10) DEFAULT NULL,
  `price_sum_pay` varchar(45) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `services_start` date DEFAULT NULL COMMENT 'เริ่มประกัน',
  `services_end` date DEFAULT NULL COMMENT 'สิ้นสุดประกัน',
  `services_day_num` int(11) DEFAULT NULL COMMENT 'จำนวนวันบริการหลังการทำรายการ',
  `services_day` date DEFAULT NULL COMMENT 'วันที่ต้องไปบริการ',
  `services_alertday_num` int(11) DEFAULT NULL COMMENT 'จำนวนวันแจ้งเตือนก่อนถึงวันบริการ',
  `services_alertday` date DEFAULT NULL COMMENT 'เริ่มแจ้งเตือนวันที่',
  `services_status` tinyint(4) DEFAULT NULL COMMENT 'สถานะบริการ 1 รอดำเนินการ, 2 ดำเนินการแล้ว, 3 ยกเลิก',
  `services_pay` tinyint(4) DEFAULT NULL COMMENT 'สถานะชำระ 1 ชำระเงินแล้ว , 2 รอชำระเงินแล้ว',
  `date_services` datetime DEFAULT NULL COMMENT 'วันที่บริการ',
  `date_pay` datetime DEFAULT NULL COMMENT 'วันที่ชำระเงิน',
  `date_create` datetime DEFAULT NULL COMMENT 'วันที่ออกใบ',
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `setting_email`
--

CREATE TABLE `setting_email` (
  `fromaddress` varchar(255) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(45) DEFAULT NULL,
  `smtp_port` int(11) DEFAULT NULL,
  `smtp_secure` varchar(45) DEFAULT NULL,
  `smtp_status` int(11) DEFAULT NULL,
  `sms_tel` varchar(45) DEFAULT NULL,
  `sms_username` varchar(45) DEFAULT NULL,
  `sms_password` varchar(45) DEFAULT NULL,
  `sms_credit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting_email`
--

INSERT INTO `setting_email` (`fromaddress`, `from`, `smtp_host`, `smtp_user`, `smtp_password`, `smtp_port`, `smtp_secure`, `smtp_status`, `sms_tel`, `sms_username`, `sms_password`, `sms_credit`) VALUES
('pos@apsth.com', 'POS | Order | Stock Manager', 'mail.apsth.com', 'pos@apsth.com', 'apsTH@1990', 587, 'tls', 1, '0000', 'apsth2', '3da03a', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting_sms`
--

CREATE TABLE `setting_sms` (
  `setting_sms_id` bigint(20) NOT NULL COMMENT 'ตั้งค่า SMS',
  `setting_sms_number` varchar(45) DEFAULT NULL COMMENT 'เบอร์โทรผู้ส่ง',
  `setting_sms_username` varchar(45) DEFAULT NULL,
  `setting_sms_password` varchar(45) DEFAULT NULL,
  `credit_sum` int(11) DEFAULT '0' COMMENT 'จำนวน credit sms ที่ส่งไป',
  `credit_balance` int(11) DEFAULT '0' COMMENT 'จำนวน credit sms คงเหลือ',
  `credit_all` int(11) DEFAULT '0' COMMENT 'ตรวจสอบจำนวน credit ที่เหลือจาก API',
  `shop_id_pri` int(11) NOT NULL COMMENT 'ร้าน',
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting_sms`
--

INSERT INTO `setting_sms` (`setting_sms_id`, `setting_sms_number`, `setting_sms_username`, `setting_sms_password`, `credit_sum`, `credit_balance`, `credit_all`, `shop_id_pri`, `date_modify`) VALUES
(1, '0000', 'apsth2', '3da03a', 0, 0, 0, 1, '2018-03-04 17:16:46');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id_pri` int(11) NOT NULL,
  `shop_id` varchar(45) DEFAULT NULL COMMENT 'ธุรกิจร้าน',
  `shop_name` varchar(255) DEFAULT NULL COMMENT 'บริษัท/ร้านค้า',
  `tax_id` varchar(15) DEFAULT NULL COMMENT 'เลขผู้เสียภาษี',
  `tel_shop` varchar(20) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `fax_shop` varchar(20) DEFAULT NULL COMMENT 'โทรสาร (Fax)',
  `website_shop` varchar(100) DEFAULT NULL COMMENT 'Website',
  `email_shop` varchar(100) DEFAULT NULL COMMENT 'อีเมล',
  `address_shop` varchar(100) DEFAULT NULL COMMENT 'ที่อยู่',
  `image_id` bigint(20) DEFAULT NULL COMMENT 'logo',
  `type_shop_id` tinyint(4) NOT NULL,
  `status_shop_id` tinyint(4) NOT NULL COMMENT 'สถานะร้าน',
  `shop_business` varchar(255) DEFAULT NULL,
  `shop_create_id_pri` varchar(45) DEFAULT NULL,
  `shop_create_id` int(11) DEFAULT NULL COMMENT 'คนที่สร้างร้านหรือตัวแทนจำหน่ายนี้',
  `shop_promptpay_id` varchar(45) DEFAULT NULL,
  `shop_promptpay_name` varchar(255) DEFAULT NULL,
  `token` varchar(500) DEFAULT NULL,
  `token_status` tinyint(4) DEFAULT '1',
  `date_create` date DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id_pri`, `shop_id`, `shop_name`, `tax_id`, `tel_shop`, `fax_shop`, `website_shop`, `email_shop`, `address_shop`, `image_id`, `type_shop_id`, `status_shop_id`, `shop_business`, `shop_create_id_pri`, `shop_create_id`, `shop_promptpay_id`, `shop_promptpay_name`, `token`, `token_status`, `date_create`, `date_modify`) VALUES
(1, 'S1', 'บริษัท เจ้าของระบบ จำกัด', '0505557001854', '043-999999', '098-1816769', 'www.gm-thai.com', 'admin@testpos.com', 'ตำบลในเมือง อำเภอเมืองขอนแก่น ขอนแก่น 40000', 2, 1, 1, 'กระเป๋า/สัมภาระ', '1', NULL, '0981816769', 'ประสาน ศรีโสภา', NULL, 1, '2017-07-30', '2018-02-16 23:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `shop_setting_document`
--

CREATE TABLE `shop_setting_document` (
  `shop_setting_document_id` int(11) NOT NULL COMMENT 'บัญชีธนาคารที่ใช้ โอนเงิน',
  `shop_id_pri` int(11) NOT NULL,
  `transport_price` decimal(8,2) DEFAULT '0.00' COMMENT 'ค่าขนส่ง',
  `image_id` bigint(20) DEFAULT NULL COMMENT 'ตราประทับ มีหรือไม่มีก็ได้',
  `type_tax_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'ประเภทภาษี',
  `sell_id_default` varchar(45) DEFAULT 'PO' COMMENT 'คำนำหน้ารายการขายหน้าร้าน',
  `sell_number_default` varchar(45) DEFAULT '000001',
  `buy_id_default` varchar(45) DEFAULT 'QU' COMMENT 'คำนำหน้ารายการใบเสนอราคา',
  `buy_number_default` varchar(6) DEFAULT '000001' COMMENT 'รันใบเสร็จ ต้อง 6 ตัวเท่านั้น',
  `sale_id_default` varchar(45) DEFAULT 'RE' COMMENT 'คำนำหน้ารายการขาย (ค่าเริ่มต้น)',
  `sale_number_default` varchar(6) DEFAULT '000001',
  `order_id_default` varchar(45) DEFAULT 'OR' COMMENT 'คำนำหน้ารายการสั่งซื้อ',
  `order_number_default` varchar(6) DEFAULT '000001',
  `invoice_id_default` varchar(45) DEFAULT 'IV' COMMENT 'ใบแจ้งหนี้',
  `invoice_number_default` varchar(45) DEFAULT '000001',
  `tranfer_id_default` varchar(45) DEFAULT 'TF' COMMENT 'คำนำหน้ารายการโอน',
  `tranfer_number_default` varchar(6) DEFAULT '000001',
  `get_return_id_default` varchar(45) DEFAULT 'CN' COMMENT 'คำนำหน้ารายการรับคืน',
  `return_id_default` varchar(45) DEFAULT 'DN' COMMENT 'คำนำหน้ารายการคืน',
  `get_return_number_default` varchar(6) DEFAULT '000001',
  `services_id_default` varchar(45) DEFAULT 'SV' COMMENT 'คำนำหน้า บริการ',
  `services_number_default` varchar(6) DEFAULT '000001',
  `product_id_default` varchar(45) DEFAULT 'P' COMMENT 'คำนำหน้าสินค้า',
  `product_number_default` int(11) DEFAULT '1',
  `stock_id_default` varchar(45) DEFAULT 'W' COMMENT 'คำนำหน้าคลังสินค้า',
  `stock_number_default` int(11) DEFAULT '1',
  `customer_id_default` varchar(45) DEFAULT 'C' COMMENT 'คำนำหน้า ลูกค้า',
  `customer_number_default` int(11) DEFAULT '1',
  `partners_id_default` varchar(45) DEFAULT 'PC' COMMENT 'คำนำหน้า คู่ค้า',
  `partners_number_default` int(11) DEFAULT '1',
  `receipt_print_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'ขนาดใบเสร็จที่ปริ้น',
  `receipt_print_small` int(11) DEFAULT '80',
  `date_modify` datetime DEFAULT NULL,
  `data_tranfer` int(11) DEFAULT '1' COMMENT 'กำหนดความล่าช้าการส่งสินค้า หน่วยเป็น วัน',
  `date_pack` int(11) DEFAULT '1' COMMENT 'กำหนดความล่าช้าของการแพก หน่วยเป็น วัน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_setting_document`
--

INSERT INTO `shop_setting_document` (`shop_setting_document_id`, `shop_id_pri`, `transport_price`, `image_id`, `type_tax_id`, `sell_id_default`, `sell_number_default`, `buy_id_default`, `buy_number_default`, `sale_id_default`, `sale_number_default`, `order_id_default`, `order_number_default`, `invoice_id_default`, `invoice_number_default`, `tranfer_id_default`, `tranfer_number_default`, `get_return_id_default`, `return_id_default`, `get_return_number_default`, `services_id_default`, `services_number_default`, `product_id_default`, `product_number_default`, `stock_id_default`, `stock_number_default`, `customer_id_default`, `customer_number_default`, `partners_id_default`, `partners_number_default`, `receipt_print_id`, `receipt_print_small`, `date_modify`, `data_tranfer`, `date_pack`) VALUES
(1, 1, '0.00', NULL, 1, 'PO', '000001', 'QU', '000001', 'RE', '000001', 'OR', '000001', 'IV', '000001', 'TF', '000001', 'CN', 'DN', '000001', 'SV', '000001', 'S1P', 1, 'S1W', 2, 'S1C', 1, 'S1PC', 1, 1, 80, '2018-03-02 23:09:52', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `sms_id` int(11) NOT NULL,
  `sms_name` varchar(45) DEFAULT NULL,
  `sms_cost` int(11) DEFAULT NULL,
  `sms_amount` int(11) DEFAULT NULL,
  `sms_status` tinyint(4) NOT NULL DEFAULT '1',
  `sms_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`sms_id`, `sms_name`, `sms_cost`, `sms_amount`, `sms_status`, `sms_modify`) VALUES
(1, 'SMS-500', 500, 500, 1, '2018-02-10 15:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id_pri` bigint(20) NOT NULL,
  `stock_id` varchar(45) DEFAULT NULL,
  `stock_name` varchar(500) DEFAULT NULL COMMENT 'ลิ้งค์รูป',
  `shop_id_pri` int(11) NOT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id_pri`, `stock_id`, `stock_name`, `shop_id_pri`, `date_modify`) VALUES
(1, 'S1W1', 'คลังสินค้าหลัก', 1, '2018-02-06 16:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `transport_api`
--

CREATE TABLE `transport_api` (
  `transport_api_id` bigint(20) NOT NULL,
  `receipt_master_id_pri` bigint(20) NOT NULL COMMENT 'อ้างถึงใบเสร็จ',
  `transport_status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'สถานะการจัดส่งจาก api',
  `date_to` date DEFAULT NULL COMMENT 'วันที่จัดส่ง',
  `date_success` date DEFAULT NULL COMMENT 'วันที่เสร็จสิ้น',
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transport_api_setting`
--

CREATE TABLE `transport_api_setting` (
  `transport_api_setting_id` int(11) NOT NULL COMMENT 'สร้าง user api',
  `transport_setting_id` int(11) NOT NULL COMMENT 'ผูกกับการตั้งค่าขนส่ง',
  `transport_service_id` tinyint(4) NOT NULL COMMENT 'อ้างถึงบริการ เช่น kerry',
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transport_api_setting`
--

INSERT INTO `transport_api_setting` (`transport_api_setting_id`, `transport_setting_id`, `transport_service_id`, `username`, `password`) VALUES
(1, 1, 1, 'apsth2', '1234'),
(2, 1, 2, 'apsth1', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `transport_setting`
--

CREATE TABLE `transport_setting` (
  `transport_setting_id` int(11) NOT NULL COMMENT 'ตั้งค่าบริการขนส่งจัดส่ง เพื่อง่ายต่อการออกใบเสร็จ',
  `send_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อผู้ส่ง',
  `send_address` varchar(500) DEFAULT NULL COMMENT 'ที่อยู่ผู้ส่ง',
  `transport_service_id` tinyint(4) NOT NULL COMMENT 'บริการขนส่ง',
  `transport_price` decimal(8,2) DEFAULT NULL COMMENT 'ราคาค่าขนส่ง',
  `transport_tel` varchar(15) DEFAULT NULL,
  `date_deley` int(11) DEFAULT NULL,
  `show_product` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = ไม่โชว ,1 = โชว์',
  `show_price` tinyint(4) NOT NULL DEFAULT '0',
  `shop_id_pri` int(11) NOT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transport_setting`
--

INSERT INTO `transport_setting` (`transport_setting_id`, `send_name`, `send_address`, `transport_service_id`, `transport_price`, `transport_tel`, `date_deley`, `show_product`, `show_price`, `shop_id_pri`, `date_modify`) VALUES
(1, 'APSTH ', 'ตำบลในเมือง อำเภอเมืองขอนแก่น ขอนแก่น 40000', 1, '0.00', '0981816769', 3, 0, 0, 1, '2017-08-30 15:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `shop_id_pri` int(11) NOT NULL,
  `image_id` bigint(20) DEFAULT NULL COMMENT 'รูป Profile ถ้าไม่มีให้ผูกที่ ID 1',
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `role_id` tinyint(4) NOT NULL,
  `status_id` int(11) NOT NULL,
  `type_user_id` tinyint(4) NOT NULL COMMENT 'ประเภทผู้ขาย',
  `comment` varchar(500) DEFAULT NULL,
  `style` varchar(45) DEFAULT 'blue' COMMENT 'ใช้สำหรับเก็บชื่อไฟล์ CSS สำหรับสีทีม',
  `date_create` date DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `shop_id_pri`, `image_id`, `username`, `password`, `email`, `address`, `fullname`, `tel`, `role_id`, `status_id`, `type_user_id`, `comment`, `style`, `date_create`, `date_modify`) VALUES
(1, 1, 1, 'demo', '6e9bece1914809fb8493146417e722f6', 'admin@info.com', '', 'Admin', '0981816766', 2, 1, 1, '', 'purple', '2017-08-23', '2018-03-04 19:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_package`
--

CREATE TABLE `user_package` (
  `user_package_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_shop_id_pri` int(11) DEFAULT NULL,
  `user_package_modify` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_package`
--

INSERT INTO `user_package` (`user_package_id`, `user_id`, `package_id`, `package_shop_id_pri`, `user_package_modify`) VALUES
(1, 1, 1, 1, '2020-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `zipcode`
--

CREATE TABLE `zipcode` (
  `zipcode_id` int(11) NOT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `province` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zipcode`
--

INSERT INTO `zipcode` (`zipcode_id`, `zipcode`, `province`) VALUES
(1, '10100', 'กรุงเทพมหานคร   '),
(2, '10110', 'กรุงเทพมหานคร   '),
(3, '10120', 'กรุงเทพมหานคร   '),
(4, '10130', 'สมุทรปราการ   '),
(5, '10140', 'กรุงเทพมหานคร   '),
(6, '10150', 'กรุงเทพมหานคร   '),
(7, '10160', 'กรุงเทพมหานคร   '),
(8, '10170', 'กรุงเทพมหานคร   '),
(9, '10200', 'กรุงเทพมหานคร   '),
(10, '10210', 'กรุงเทพมหานคร   '),
(11, '10220', 'กรุงเทพมหานคร   '),
(12, '10230', 'กรุงเทพมหานคร   '),
(13, '10240', 'กรุงเทพมหานคร   '),
(14, '10250', 'กรุงเทพมหานคร   '),
(15, '10260', 'กรุงเทพมหานคร   '),
(16, '10270', 'สมุทรปราการ   '),
(17, '10280', 'สมุทรปราการ   '),
(18, '10290', 'สมุทรปราการ   '),
(19, '10300', 'กรุงเทพมหานคร   '),
(20, '10310', 'กรุงเทพมหานคร   '),
(21, '10330', 'กรุงเทพมหานคร   '),
(22, '10400', 'กรุงเทพมหานคร   '),
(23, '10500', 'กรุงเทพมหานคร   '),
(24, '10510', 'กรุงเทพมหานคร   '),
(25, '10520', 'กรุงเทพมหานคร   '),
(26, '10530', 'กรุงเทพมหานคร   '),
(27, '10540', 'สมุทรปราการ   '),
(28, '10550', 'สมุทรปราการ   '),
(29, '10560', 'สมุทรปราการ   '),
(30, '10600', 'กรุงเทพมหานคร   '),
(31, '10700', 'กรุงเทพมหานคร   '),
(32, '10800', 'กรุงเทพมหานคร   '),
(33, '10900', 'กรุงเทพมหานคร   '),
(34, '11000', 'นนทบุรี   '),
(35, '11110', 'นนทบุรี   '),
(36, '11120', 'นนทบุรี   '),
(37, '11130', 'นนทบุรี   '),
(38, '11140', 'นนทบุรี   '),
(39, '11150', 'นนทบุรี   '),
(40, '12000', 'ปทุมธานี   '),
(41, '12110', 'ปทุมธานี   '),
(42, '12120', 'ปทุมธานี   '),
(43, '12130', 'ปทุมธานี   '),
(44, '12140', 'ปทุมธานี   '),
(45, '12150', 'ปทุมธานี   '),
(46, '12160', 'ปทุมธานี   '),
(47, '12170', 'ปทุมธานี   '),
(48, '13000', 'พระนครศรีอยุธยา   '),
(49, '13110', 'พระนครศรีอยุธยา   '),
(50, '13120', 'พระนครศรีอยุธยา   '),
(51, '13130', 'พระนครศรีอยุธยา   '),
(52, '13140', 'พระนครศรีอยุธยา   '),
(53, '13150', 'พระนครศรีอยุธยา   '),
(54, '13160', 'พระนครศรีอยุธยา   '),
(55, '13170', 'พระนครศรีอยุธยา   '),
(56, '13180', 'พระนครศรีอยุธยา   '),
(57, '13190', 'พระนครศรีอยุธยา   '),
(58, '13210', 'พระนครศรีอยุธยา   '),
(59, '13220', 'พระนครศรีอยุธยา   '),
(60, '13230', 'พระนครศรีอยุธยา   '),
(61, '13240', 'พระนครศรีอยุธยา   '),
(62, '13240', 'ลพบุรี   '),
(63, '13250', 'พระนครศรีอยุธยา   '),
(64, '13260', 'พระนครศรีอยุธยา   '),
(65, '13270', 'พระนครศรีอยุธยา   '),
(66, '13280', 'พระนครศรีอยุธยา   '),
(67, '13290', 'พระนครศรีอยุธยา   '),
(68, '14000', 'อ่างทอง   '),
(69, '14110', 'อ่างทอง   '),
(70, '14120', 'อ่างทอง   '),
(71, '14130', 'อ่างทอง   '),
(72, '14140', 'อ่างทอง   '),
(73, '14150', 'อ่างทอง   '),
(74, '14160', 'อ่างทอง   '),
(75, '15000', 'ลพบุรี   '),
(76, '15110', 'ลพบุรี   '),
(77, '15120', 'ลพบุรี   '),
(78, '15130', 'ลพบุรี   '),
(79, '15140', 'ลพบุรี   '),
(80, '15150', 'ลพบุรี   '),
(81, '15170', 'ลพบุรี   '),
(82, '15180', 'ลพบุรี   '),
(83, '15190', 'ลพบุรี   '),
(84, '15210', 'ลพบุรี   '),
(85, '15220', 'ลพบุรี   '),
(86, '15230', 'ลพบุรี   '),
(87, '15240', 'ลพบุรี   '),
(88, '15250', 'ลพบุรี   '),
(89, '16000', 'สิงห์บุรี   '),
(90, '16110', 'สิงห์บุรี   '),
(91, '16120', 'สิงห์บุรี   '),
(92, '16130', 'สิงห์บุรี   '),
(93, '16140', 'สิงห์บุรี   '),
(94, '16150', 'สิงห์บุรี   '),
(95, '16160', 'สิงห์บุรี   '),
(96, '17000', 'ชัยนาท   '),
(97, '17110', 'ชัยนาท   '),
(98, '17120', 'ชัยนาท   '),
(99, '17130', 'ชัยนาท   '),
(100, '17140', 'ชัยนาท   '),
(101, '17150', 'ชัยนาท   '),
(102, '17160', 'ชัยนาท   '),
(103, '17170', 'ชัยนาท   '),
(104, '18000', 'สระบุรี'),
(105, '18110', 'สระบุรี'),
(106, '18120', 'สระบุรี'),
(107, '18130', 'สระบุรี'),
(108, '18140', 'สระบุรี'),
(109, '18150', 'สระบุรี'),
(110, '18160', 'สระบุรี'),
(111, '18170', 'สระบุรี'),
(112, '18180', 'สระบุรี'),
(113, '18190', 'สระบุรี'),
(114, '18210', 'สระบุรี'),
(115, '18220', 'ลพบุรี   '),
(116, '18220', 'สระบุรี'),
(117, '18230', 'สระบุรี'),
(118, '18240', 'สระบุรี'),
(119, '18250', 'สระบุรี'),
(120, '18260', 'สระบุรี'),
(121, '18270', 'สระบุรี'),
(122, '20000', 'ชลบุรี   '),
(123, '20110', 'ชลบุรี   '),
(124, '20120', 'ชลบุรี   '),
(125, '20130', 'ชลบุรี   '),
(126, '20140', 'ชลบุรี   '),
(127, '20150', 'ชลบุรี   '),
(128, '20160', 'ชลบุรี   '),
(129, '20170', 'ชลบุรี   '),
(130, '20180', 'ชลบุรี   '),
(131, '20190', 'ชลบุรี   '),
(132, '20220', 'ชลบุรี   '),
(133, '20230', 'ชลบุรี   '),
(134, '20240', 'ชลบุรี   '),
(135, '20250', 'ชลบุรี   '),
(136, '20270', 'ชลบุรี   '),
(137, '21000', 'ระยอง   '),
(138, '21100', 'ระยอง   '),
(139, '21110', 'ระยอง   '),
(140, '21120', 'ระยอง   '),
(141, '21130', 'ระยอง   '),
(142, '21140', 'ระยอง   '),
(143, '21150', 'ระยอง   '),
(144, '21160', 'ระยอง   '),
(145, '21170', 'ระยอง   '),
(146, '21180', 'ระยอง   '),
(147, '21190', 'ระยอง   '),
(148, '21210', 'ระยอง   '),
(149, '22000', 'จันทบุรี   '),
(150, '22110', 'จันทบุรี   '),
(151, '22120', 'จันทบุรี   '),
(152, '22130', 'จันทบุรี   '),
(153, '22140', 'จันทบุรี   '),
(154, '22150', 'จันทบุรี   '),
(155, '22160', 'ระยอง   '),
(156, '22160', 'จันทบุรี   '),
(157, '22170', 'จันทบุรี   '),
(158, '22180', 'จันทบุรี   '),
(159, '22190', 'จันทบุรี   '),
(160, '22210', 'จันทบุรี   '),
(161, '23000', 'ตราด   '),
(162, '23110', 'ตราด   '),
(163, '23120', 'ตราด   '),
(164, '23130', 'ตราด   '),
(165, '23140', 'ตราด   '),
(166, '23150', 'ตราด   '),
(167, '23170', 'ตราด   '),
(168, '24000', 'ฉะเชิงเทรา   '),
(169, '24110', 'ฉะเชิงเทรา   '),
(170, '24120', 'ฉะเชิงเทรา   '),
(171, '24130', 'ฉะเชิงเทรา   '),
(172, '24140', 'ฉะเชิงเทรา   '),
(173, '24150', 'ฉะเชิงเทรา   '),
(174, '24160', 'ฉะเชิงเทรา   '),
(175, '24170', 'ฉะเชิงเทรา   '),
(176, '24180', 'ฉะเชิงเทรา   '),
(177, '24190', 'ฉะเชิงเทรา   '),
(178, '25000', 'ปราจีนบุรี   '),
(179, '25110', 'ปราจีนบุรี   '),
(180, '25130', 'ปราจีนบุรี   '),
(181, '25140', 'ปราจีนบุรี   '),
(182, '25150', 'ปราจีนบุรี   '),
(183, '25190', 'ปราจีนบุรี   '),
(184, '25220', 'ปราจีนบุรี   '),
(185, '25230', 'ปราจีนบุรี   '),
(186, '25240', 'ปราจีนบุรี   '),
(187, '26000', 'นครนายก   '),
(188, '26110', 'นครนายก   '),
(189, '26120', 'นครนายก   '),
(190, '26130', 'นครนายก   '),
(191, '27000', 'สระแก้ว   '),
(192, '27120', 'สระแก้ว   '),
(193, '27160', 'สระแก้ว   '),
(194, '27180', 'สระแก้ว   '),
(195, '27210', 'สระแก้ว   '),
(196, '27250', 'สระแก้ว   '),
(197, '27260', 'สระแก้ว   '),
(198, '30000', 'นครราชสีมา   '),
(199, '30110', 'นครราชสีมา   '),
(200, '30120', 'นครราชสีมา   '),
(201, '30130', 'นครราชสีมา   '),
(202, '30140', 'นครราชสีมา   '),
(203, '30150', 'นครราชสีมา   '),
(204, '30160', 'นครราชสีมา   '),
(205, '30170', 'นครราชสีมา   '),
(206, '30180', 'นครราชสีมา   '),
(207, '30190', 'นครราชสีมา   '),
(208, '30210', 'นครราชสีมา   '),
(209, '30220', 'นครราชสีมา   '),
(210, '30230', 'นครราชสีมา   '),
(211, '30240', 'นครราชสีมา   '),
(212, '30250', 'นครราชสีมา   '),
(213, '30260', 'นครราชสีมา   '),
(214, '30270', 'นครราชสีมา   '),
(215, '30280', 'นครราชสีมา   '),
(216, '30290', 'นครราชสีมา   '),
(217, '30310', 'นครราชสีมา   '),
(218, '30320', 'นครราชสีมา   '),
(219, '30330', 'นครราชสีมา   '),
(220, '30340', 'นครราชสีมา   '),
(221, '30350', 'นครราชสีมา   '),
(222, '30360', 'นครราชสีมา   '),
(223, '30370', 'นครราชสีมา   '),
(224, '30380', 'นครราชสีมา   '),
(225, '30410', 'นครราชสีมา   '),
(226, '30430', 'นครราชสีมา   '),
(227, '30440', 'นครราชสีมา   '),
(228, '31000', 'บุรีรัมย์   '),
(229, '31110', 'บุรีรัมย์   '),
(230, '31120', 'บุรีรัมย์   '),
(231, '31130', 'บุรีรัมย์   '),
(232, '31140', 'บุรีรัมย์   '),
(233, '31150', 'บุรีรัมย์   '),
(234, '31160', 'บุรีรัมย์   '),
(235, '31170', 'บุรีรัมย์   '),
(236, '31180', 'บุรีรัมย์   '),
(237, '31190', 'บุรีรัมย์   '),
(238, '31210', 'บุรีรัมย์   '),
(239, '31220', 'บุรีรัมย์   '),
(240, '31230', 'บุรีรัมย์   '),
(241, '31240', 'บุรีรัมย์   '),
(242, '31250', 'บุรีรัมย์   '),
(243, '31260', 'บุรีรัมย์   '),
(244, '32000', 'สุรินทร์   '),
(245, '32110', 'สุรินทร์   '),
(246, '32120', 'สุรินทร์   '),
(247, '32130', 'สุรินทร์   '),
(248, '32140', 'สุรินทร์   '),
(249, '32150', 'สุรินทร์   '),
(250, '32160', 'สุรินทร์   '),
(251, '32170', 'สุรินทร์   '),
(252, '32180', 'สุรินทร์   '),
(253, '32190', 'สุรินทร์   '),
(254, '32210', 'สุรินทร์   '),
(255, '32220', 'สุรินทร์   '),
(256, '32230', 'สุรินทร์   '),
(257, '33000', 'ศรีสะเกษ   '),
(258, '33110', 'ศรีสะเกษ   '),
(259, '33120', 'ศรีสะเกษ   '),
(260, '33130', 'ศรีสะเกษ   '),
(261, '33140', 'ศรีสะเกษ   '),
(262, '33150', 'ศรีสะเกษ   '),
(263, '33160', 'ศรีสะเกษ   '),
(264, '33170', 'ศรีสะเกษ   '),
(265, '33180', 'ศรีสะเกษ   '),
(266, '33190', 'ศรีสะเกษ   '),
(267, '33210', 'ศรีสะเกษ   '),
(268, '33220', 'ศรีสะเกษ   '),
(269, '33230', 'ศรีสะเกษ   '),
(270, '33240', 'ศรีสะเกษ   '),
(271, '33250', 'ศรีสะเกษ   '),
(272, '33270', 'ศรีสะเกษ   '),
(273, '34000', 'อุบลราชธานี   '),
(274, '34110', 'อุบลราชธานี   '),
(275, '34130', 'อุบลราชธานี   '),
(276, '34140', 'อุบลราชธานี   '),
(277, '34150', 'อุบลราชธานี   '),
(278, '34160', 'อุบลราชธานี   '),
(279, '34170', 'อุบลราชธานี   '),
(280, '34190', 'อุบลราชธานี   '),
(281, '34220', 'อุบลราชธานี   '),
(282, '34230', 'อุบลราชธานี   '),
(283, '34250', 'อุบลราชธานี   '),
(284, '34260', 'อุบลราชธานี   '),
(285, '34270', 'อุบลราชธานี   '),
(286, '34280', 'อุบลราชธานี   '),
(287, '34310', 'อุบลราชธานี   '),
(288, '34320', 'อุบลราชธานี   '),
(289, '34330', 'อุบลราชธานี   '),
(290, '34340', 'อุบลราชธานี   '),
(291, '34350', 'อุบลราชธานี   '),
(292, '34360', 'อุบลราชธานี   '),
(293, '35000', 'ยโสธร   '),
(294, '35110', 'ยโสธร   '),
(295, '35120', 'ยโสธร   '),
(296, '35130', 'ยโสธร   '),
(297, '35140', 'ยโสธร   '),
(298, '35150', 'ยโสธร   '),
(299, '35160', 'ยโสธร   '),
(300, '35170', 'ยโสธร   '),
(301, '35180', 'ยโสธร   '),
(302, '36000', 'ชัยภูมิ   '),
(303, '36110', 'ชัยภูมิ   '),
(304, '36120', 'ชัยภูมิ   '),
(305, '36130', 'ชัยภูมิ   '),
(306, '36140', 'ชัยภูมิ   '),
(307, '36150', 'ชัยภูมิ   '),
(308, '36160', 'ชัยภูมิ   '),
(309, '36170', 'ชัยภูมิ   '),
(310, '36180', 'ชัยภูมิ   '),
(311, '36190', 'ชัยภูมิ   '),
(312, '36210', 'ชัยภูมิ   '),
(313, '36220', 'นครราชสีมา   '),
(314, '36220', 'ชัยภูมิ   '),
(315, '36230', 'ชัยภูมิ   '),
(316, '36240', 'ชัยภูมิ   '),
(317, '36250', 'ชัยภูมิ   '),
(318, '36260', 'ชัยภูมิ   '),
(319, '37000', 'อำนาจเจริญ   '),
(320, '37110', 'อำนาจเจริญ   '),
(321, '37180', 'อำนาจเจริญ   '),
(322, '37210', 'อำนาจเจริญ   '),
(323, '37240', 'อำนาจเจริญ   '),
(324, '37290', 'อำนาจเจริญ   '),
(325, '38000', 'บึงกาฬ'),
(326, '38150', 'บึงกาฬ'),
(327, '38170', 'บึงกาฬ'),
(328, '38180', 'บึงกาฬ'),
(329, '38190', 'บึงกาฬ'),
(330, '38210', 'บึงกาฬ'),
(331, '38220', 'บึงกาฬ'),
(332, '39000', 'หนองบัวลำภู   '),
(333, '39140', 'หนองบัวลำภู   '),
(334, '39170', 'หนองบัวลำภู   '),
(335, '39180', 'หนองบัวลำภู   '),
(336, '39270', 'หนองบัวลำภู   '),
(337, '39350', 'หนองบัวลำภู   '),
(338, '40000', 'ขอนแก่น   '),
(339, '40110', 'ขอนแก่น   '),
(340, '40120', 'ขอนแก่น   '),
(341, '40130', 'ขอนแก่น   '),
(342, '40140', 'ขอนแก่น   '),
(343, '40150', 'ขอนแก่น   '),
(344, '40160', 'ขอนแก่น   '),
(345, '40170', 'ขอนแก่น   '),
(346, '40180', 'ขอนแก่น   '),
(347, '40190', 'ขอนแก่น   '),
(348, '40210', 'ขอนแก่น   '),
(349, '40220', 'ขอนแก่น   '),
(350, '40230', 'ขอนแก่น   '),
(351, '40240', 'ขอนแก่น   '),
(352, '40250', 'ขอนแก่น   '),
(353, '40260', 'ขอนแก่น   '),
(354, '40270', 'ขอนแก่น   '),
(355, '40280', 'ขอนแก่น   '),
(356, '40290', 'ขอนแก่น   '),
(357, '40310', 'ขอนแก่น   '),
(358, '40320', 'ขอนแก่น   '),
(359, '40330', 'ขอนแก่น   '),
(360, '40340', 'ขอนแก่น   '),
(361, '40350', 'ขอนแก่น   '),
(362, '41000', 'อุดรธานี   '),
(363, '41110', 'อุดรธานี   '),
(364, '41130', 'อุดรธานี   '),
(365, '41150', 'อุดรธานี   '),
(366, '41160', 'อุดรธานี   '),
(367, '41190', 'อุดรธานี   '),
(368, '41210', 'อุดรธานี   '),
(369, '41220', 'อุดรธานี   '),
(370, '41230', 'อุดรธานี   '),
(371, '41240', 'อุดรธานี   '),
(372, '41250', 'อุดรธานี   '),
(373, '41260', 'อุดรธานี   '),
(374, '41280', 'อุดรธานี   '),
(375, '41290', 'อุดรธานี   '),
(376, '41310', 'อุดรธานี   '),
(377, '41320', 'อุดรธานี   '),
(378, '41330', 'อุดรธานี   '),
(379, '41340', 'อุดรธานี   '),
(380, '41360', 'อุดรธานี   '),
(381, '41370', 'อุดรธานี   '),
(382, '41380', 'อุดรธานี   '),
(383, '42000', 'เลย   '),
(384, '42100', 'เลย   '),
(385, '42110', 'เลย   '),
(386, '42120', 'เลย   '),
(387, '42130', 'เลย   '),
(388, '42140', 'เลย   '),
(389, '42150', 'เลย   '),
(390, '42160', 'เลย   '),
(391, '42170', 'เลย   '),
(392, '42180', 'เลย   '),
(393, '42190', 'เลย   '),
(394, '42210', 'เลย   '),
(395, '42220', 'เลย   '),
(396, '42230', 'เลย   '),
(397, '42240', 'เลย   '),
(398, '43000', 'หนองคาย   '),
(399, '43100', 'หนองคาย   '),
(400, '43110', 'หนองคาย   '),
(401, '43120', 'หนองคาย   '),
(402, '43130', 'หนองคาย   '),
(403, '43140', 'บึงกาฬ'),
(404, '43150', 'บึงกาฬ'),
(405, '43160', 'หนองคาย   '),
(406, '43170', 'บึงกาฬ'),
(407, '43180', 'บึงกาฬ'),
(408, '43190', 'บึงกาฬ'),
(409, '43210', 'บึงกาฬ'),
(410, '43220', 'บึงกาฬ'),
(411, '44000', 'มหาสารคาม   '),
(412, '44110', 'มหาสารคาม   '),
(413, '44120', 'มหาสารคาม   '),
(414, '44130', 'มหาสารคาม   '),
(415, '44140', 'มหาสารคาม   '),
(416, '44150', 'มหาสารคาม   '),
(417, '44160', 'มหาสารคาม   '),
(418, '44170', 'มหาสารคาม   '),
(419, '44180', 'มหาสารคาม   '),
(420, '44190', 'มหาสารคาม   '),
(421, '44210', 'มหาสารคาม   '),
(422, '45000', 'ร้อยเอ็ด   '),
(423, '45110', 'ร้อยเอ็ด   '),
(424, '45120', 'ร้อยเอ็ด   '),
(425, '45130', 'ร้อยเอ็ด   '),
(426, '45140', 'ร้อยเอ็ด   '),
(427, '45150', 'ร้อยเอ็ด   '),
(428, '45160', 'ร้อยเอ็ด   '),
(429, '45170', 'ร้อยเอ็ด   '),
(430, '45180', 'ร้อยเอ็ด   '),
(431, '45190', 'ร้อยเอ็ด   '),
(432, '45210', 'ร้อยเอ็ด   '),
(433, '45220', 'ร้อยเอ็ด   '),
(434, '45230', 'ร้อยเอ็ด   '),
(435, '45240', 'ร้อยเอ็ด   '),
(436, '45250', 'ร้อยเอ็ด   '),
(437, '45280', 'ร้อยเอ็ด   '),
(438, '46000', 'กาฬสินธุ์   '),
(439, '46110', 'กาฬสินธุ์   '),
(440, '46120', 'กาฬสินธุ์   '),
(441, '46130', 'กาฬสินธุ์   '),
(442, '46140', 'กาฬสินธุ์   '),
(443, '46150', 'กาฬสินธุ์   '),
(444, '46160', 'กาฬสินธุ์   '),
(445, '46170', 'กาฬสินธุ์   '),
(446, '46180', 'กาฬสินธุ์   '),
(447, '46190', 'กาฬสินธุ์   '),
(448, '46210', 'กาฬสินธุ์   '),
(449, '46220', 'กาฬสินธุ์   '),
(450, '46230', 'กาฬสินธุ์   '),
(451, '46240', 'กาฬสินธุ์   '),
(452, '47000', 'สกลนคร   '),
(453, '47110', 'สกลนคร   '),
(454, '47120', 'สกลนคร   '),
(455, '47130', 'สกลนคร   '),
(456, '47140', 'สกลนคร   '),
(457, '47150', 'สกลนคร   '),
(458, '47160', 'สกลนคร   '),
(459, '47170', 'สกลนคร   '),
(460, '47180', 'สกลนคร   '),
(461, '47190', 'สกลนคร   '),
(462, '47210', 'สกลนคร   '),
(463, '47220', 'สกลนคร   '),
(464, '47230', 'สกลนคร   '),
(465, '47240', 'สกลนคร   '),
(466, '47250', 'สกลนคร   '),
(467, '47260', 'สกลนคร   '),
(468, '47270', 'สกลนคร   '),
(469, '47280', 'สกลนคร   '),
(470, '47290', 'สกลนคร   '),
(471, '48000', 'นครพนม   '),
(472, '48110', 'นครพนม   '),
(473, '48120', 'นครพนม   '),
(474, '48130', 'นครพนม   '),
(475, '48140', 'นครพนม   '),
(476, '48150', 'นครพนม   '),
(477, '48160', 'นครพนม   '),
(478, '48170', 'นครพนม   '),
(479, '48180', 'นครพนม   '),
(480, '48190', 'นครพนม   '),
(481, '49000', 'มุกดาหาร   '),
(482, '49110', 'มุกดาหาร   '),
(483, '49120', 'มุกดาหาร   '),
(484, '49130', 'มุกดาหาร   '),
(485, '49140', 'มุกดาหาร   '),
(486, '49150', 'มุกดาหาร   '),
(487, '49160', 'มุกดาหาร   '),
(488, '50000', 'เชียงใหม่   '),
(489, '50100', 'เชียงใหม่   '),
(490, '50110', 'เชียงใหม่   '),
(491, '50120', 'เชียงใหม่   '),
(492, '50130', 'เชียงใหม่   '),
(493, '50140', 'เชียงใหม่   '),
(494, '50150', 'เชียงใหม่   '),
(495, '50160', 'เชียงใหม่   '),
(496, '50170', 'เชียงใหม่   '),
(497, '50180', 'เชียงใหม่   '),
(498, '50190', 'เชียงใหม่   '),
(499, '50200', 'เชียงใหม่   '),
(500, '50210', 'เชียงใหม่   '),
(501, '50220', 'เชียงใหม่   '),
(502, '50230', 'เชียงใหม่   '),
(503, '50240', 'เชียงใหม่   '),
(504, '50250', 'เชียงใหม่   '),
(505, '50260', 'เชียงใหม่   '),
(506, '50270', 'เชียงใหม่   '),
(507, '50280', 'เชียงใหม่   '),
(508, '50290', 'เชียงใหม่   '),
(509, '50300', 'เชียงใหม่   '),
(510, '50310', 'เชียงใหม่   '),
(511, '50320', 'เชียงใหม่   '),
(512, '50330', 'เชียงใหม่   '),
(513, '50340', 'เชียงใหม่   '),
(514, '50350', 'เชียงใหม่   '),
(515, '50360', 'เชียงใหม่   '),
(516, '51000', 'ลำพูน   '),
(517, '51110', 'ลำพูน   '),
(518, '51120', 'ลำพูน   '),
(519, '51130', 'ลำพูน   '),
(520, '51140', 'ลำพูน   '),
(521, '51150', 'ลำพูน   '),
(522, '51160', 'ลำพูน   '),
(523, '51170', 'ลำพูน   '),
(524, '51180', 'ลำพูน   '),
(525, '52000', 'ลำปาง   '),
(526, '52100', 'ลำปาง   '),
(527, '52110', 'ลำปาง   '),
(528, '52120', 'ลำปาง   '),
(529, '52130', 'ลำปาง   '),
(530, '52140', 'ลำปาง   '),
(531, '52150', 'ลำปาง   '),
(532, '52160', 'ลำปาง   '),
(533, '52170', 'ลำปาง   '),
(534, '52180', 'ลำปาง   '),
(535, '52190', 'ลำปาง   '),
(536, '52210', 'ลำปาง   '),
(537, '52220', 'ลำปาง   '),
(538, '52230', 'ลำปาง   '),
(539, '52240', 'ลำปาง   '),
(540, '53000', 'อุตรดิตถ์   '),
(541, '53110', 'อุตรดิตถ์   '),
(542, '53120', 'อุตรดิตถ์   '),
(543, '53130', 'อุตรดิตถ์   '),
(544, '53140', 'อุตรดิตถ์   '),
(545, '53150', 'อุตรดิตถ์   '),
(546, '53160', 'อุตรดิตถ์   '),
(547, '53170', 'อุตรดิตถ์   '),
(548, '53180', 'อุตรดิตถ์   '),
(549, '53190', 'อุตรดิตถ์   '),
(550, '53210', 'อุตรดิตถ์   '),
(551, '53220', 'อุตรดิตถ์   '),
(552, '53230', 'อุตรดิตถ์   '),
(553, '54000', 'แพร่   '),
(554, '54110', 'แพร่   '),
(555, '54120', 'แพร่   '),
(556, '54130', 'แพร่   '),
(557, '54140', 'แพร่   '),
(558, '54150', 'แพร่   '),
(559, '54160', 'แพร่   '),
(560, '54170', 'แพร่   '),
(561, '55000', 'น่าน   '),
(562, '55110', 'น่าน   '),
(563, '55120', 'น่าน   '),
(564, '55130', 'น่าน   '),
(565, '55140', 'น่าน   '),
(566, '55150', 'น่าน   '),
(567, '55160', 'น่าน   '),
(568, '55170', 'น่าน   '),
(569, '55180', 'น่าน   '),
(570, '55190', 'น่าน   '),
(571, '55210', 'น่าน   '),
(572, '55220', 'น่าน   '),
(573, '56000', 'พะเยา   '),
(574, '56110', 'พะเยา   '),
(575, '56120', 'พะเยา   '),
(576, '56130', 'พะเยา   '),
(577, '56140', 'พะเยา   '),
(578, '56150', 'พะเยา   '),
(579, '56160', 'พะเยา   '),
(580, '57000', 'เชียงราย   '),
(581, '57100', 'เชียงราย   '),
(582, '57110', 'เชียงราย   '),
(583, '57120', 'เชียงราย   '),
(584, '57130', 'เชียงราย   '),
(585, '57140', 'เชียงราย   '),
(586, '57150', 'เชียงราย   '),
(587, '57160', 'เชียงราย   '),
(588, '57170', 'เชียงราย   '),
(589, '57180', 'เชียงราย   '),
(590, '57190', 'เชียงราย   '),
(591, '57210', 'เชียงราย   '),
(592, '57220', 'เชียงราย   '),
(593, '57230', 'เชียงราย   '),
(594, '57240', 'เชียงราย   '),
(595, '57250', 'เชียงราย   '),
(596, '57260', 'เชียงราย   '),
(597, '57270', 'เชียงราย   '),
(598, '57280', 'เชียงราย   '),
(599, '57290', 'เชียงราย   '),
(600, '57310', 'เชียงราย   '),
(601, '57340', 'เชียงราย   '),
(602, '58000', 'แม่ฮ่องสอน   '),
(603, '58110', 'แม่ฮ่องสอน   '),
(604, '58120', 'แม่ฮ่องสอน   '),
(605, '58130', 'เชียงใหม่   '),
(606, '58130', 'แม่ฮ่องสอน   '),
(607, '58140', 'แม่ฮ่องสอน   '),
(608, '58150', 'แม่ฮ่องสอน   '),
(609, '60000', 'นครสวรรค์   '),
(610, '60110', 'นครสวรรค์   '),
(611, '60120', 'นครสวรรค์   '),
(612, '60130', 'นครสวรรค์   '),
(613, '60140', 'นครสวรรค์   '),
(614, '60150', 'นครสวรรค์   '),
(615, '60160', 'นครสวรรค์   '),
(616, '60170', 'นครสวรรค์   '),
(617, '60180', 'นครสวรรค์   '),
(618, '60190', 'นครสวรรค์   '),
(619, '60210', 'นครสวรรค์   '),
(620, '60220', 'นครสวรรค์   '),
(621, '60230', 'นครสวรรค์   '),
(622, '60240', 'นครสวรรค์   '),
(623, '60250', 'นครสวรรค์   '),
(624, '60260', 'นครสวรรค์   '),
(625, '61000', 'อุทัยธานี   '),
(626, '61110', 'อุทัยธานี   '),
(627, '61120', 'อุทัยธานี   '),
(628, '61130', 'อุทัยธานี   '),
(629, '61140', 'อุทัยธานี   '),
(630, '61150', 'อุทัยธานี   '),
(631, '61160', 'อุทัยธานี   '),
(632, '61170', 'อุทัยธานี   '),
(633, '61180', 'อุทัยธานี   '),
(634, '62000', 'กำแพงเพชร   '),
(635, '62110', 'กำแพงเพชร   '),
(636, '62120', 'กำแพงเพชร   '),
(637, '62130', 'กำแพงเพชร   '),
(638, '62140', 'กำแพงเพชร   '),
(639, '62150', 'กำแพงเพชร   '),
(640, '62160', 'กำแพงเพชร   '),
(641, '62170', 'กำแพงเพชร   '),
(642, '62180', 'กำแพงเพชร   '),
(643, '62190', 'กำแพงเพชร   '),
(644, '62210', 'กำแพงเพชร   '),
(645, '63000', 'ตาก   '),
(646, '63110', 'ตาก   '),
(647, '63120', 'ตาก   '),
(648, '63130', 'ตาก   '),
(649, '63140', 'ตาก   '),
(650, '63150', 'ตาก   '),
(651, '63160', 'ตาก   '),
(652, '63170', 'ตาก   '),
(653, '64000', 'สุโขทัย   '),
(654, '64110', 'สุโขทัย   '),
(655, '64120', 'สุโขทัย   '),
(656, '64130', 'สุโขทัย   '),
(657, '64140', 'สุโขทัย   '),
(658, '64150', 'สุโขทัย   '),
(659, '64160', 'สุโขทัย   '),
(660, '64170', 'สุโขทัย   '),
(661, '64180', 'สุโขทัย   '),
(662, '64190', 'สุโขทัย   '),
(663, '64210', 'สุโขทัย   '),
(664, '64220', 'สุโขทัย   '),
(665, '64230', 'สุโขทัย   '),
(666, '65000', 'พิษณุโลก   '),
(667, '65110', 'พิษณุโลก   '),
(668, '65120', 'พิษณุโลก   '),
(669, '65130', 'พิษณุโลก   '),
(670, '65140', 'พิษณุโลก   '),
(671, '65150', 'พิษณุโลก   '),
(672, '65160', 'พิษณุโลก   '),
(673, '65170', 'พิษณุโลก   '),
(674, '65180', 'พิษณุโลก   '),
(675, '65190', 'พิษณุโลก   '),
(676, '65210', 'พิษณุโลก   '),
(677, '65220', 'พิษณุโลก   '),
(678, '65230', 'พิษณุโลก   '),
(679, '65240', 'พิษณุโลก   '),
(680, '66000', 'พิจิตร   '),
(681, '66110', 'พิจิตร   '),
(682, '66120', 'พิจิตร   '),
(683, '66130', 'พิจิตร   '),
(684, '66140', 'พิจิตร   '),
(685, '66150', 'พิจิตร   '),
(686, '66160', 'พิจิตร   '),
(687, '66170', 'พิจิตร   '),
(688, '66180', 'พิจิตร   '),
(689, '66190', 'พิจิตร   '),
(690, '66210', 'พิจิตร   '),
(691, '66220', 'พิจิตร   '),
(692, '66230', 'พิจิตร   '),
(693, '67000', 'เพชรบูรณ์   '),
(694, '67110', 'เพชรบูรณ์   '),
(695, '67120', 'เพชรบูรณ์   '),
(696, '67130', 'เพชรบูรณ์   '),
(697, '67140', 'เพชรบูรณ์   '),
(698, '67150', 'เพชรบูรณ์   '),
(699, '67160', 'เพชรบูรณ์   '),
(700, '67170', 'เพชรบูรณ์   '),
(701, '67180', 'เพชรบูรณ์   '),
(702, '67190', 'เพชรบูรณ์   '),
(703, '67210', 'เพชรบูรณ์   '),
(704, '67220', 'เพชรบูรณ์   '),
(705, '67230', 'เพชรบูรณ์   '),
(706, '67240', 'เพชรบูรณ์   '),
(707, '67250', 'เพชรบูรณ์   '),
(708, '67260', 'เพชรบูรณ์   '),
(709, '67270', 'เพชรบูรณ์   '),
(710, '67280', 'เพชรบูรณ์   '),
(711, '70000', 'ราชบุรี   '),
(712, '70110', 'ราชบุรี   '),
(713, '70120', 'ราชบุรี   '),
(714, '70130', 'ราชบุรี   '),
(715, '70140', 'ราชบุรี   '),
(716, '70150', 'ราชบุรี   '),
(717, '70160', 'ราชบุรี   '),
(718, '70170', 'ราชบุรี   '),
(719, '70180', 'ราชบุรี   '),
(720, '70190', 'ราชบุรี   '),
(721, '70190', 'กาญจนบุรี   '),
(722, '70210', 'ราชบุรี   '),
(723, '71000', 'กาญจนบุรี   '),
(724, '71110', 'กาญจนบุรี   '),
(725, '71120', 'กาญจนบุรี   '),
(726, '71130', 'กาญจนบุรี   '),
(727, '71140', 'กาญจนบุรี   '),
(728, '71150', 'กาญจนบุรี   '),
(729, '71160', 'กาญจนบุรี   '),
(730, '71170', 'กาญจนบุรี   '),
(731, '71180', 'กาญจนบุรี   '),
(732, '71190', 'กาญจนบุรี   '),
(733, '71210', 'กาญจนบุรี   '),
(734, '71220', 'กาญจนบุรี   '),
(735, '71240', 'กาญจนบุรี   '),
(736, '71250', 'กาญจนบุรี   '),
(737, '71260', 'กาญจนบุรี   '),
(738, '72000', 'สุพรรณบุรี   '),
(739, '72110', 'สุพรรณบุรี   '),
(740, '72120', 'สุพรรณบุรี   '),
(741, '72130', 'สุพรรณบุรี   '),
(742, '72140', 'สุพรรณบุรี   '),
(743, '72150', 'สุพรรณบุรี   '),
(744, '72160', 'สุพรรณบุรี   '),
(745, '72170', 'สุพรรณบุรี   '),
(746, '72180', 'สุพรรณบุรี   '),
(747, '72190', 'สุพรรณบุรี   '),
(748, '72210', 'สุพรรณบุรี   '),
(749, '72220', 'สุพรรณบุรี   '),
(750, '72230', 'สุพรรณบุรี   '),
(751, '72240', 'สุพรรณบุรี   '),
(752, '72250', 'สุพรรณบุรี   '),
(753, '73000', 'นครปฐม   '),
(754, '73110', 'นครปฐม   '),
(755, '73120', 'นครปฐม   '),
(756, '73130', 'นครปฐม   '),
(757, '73140', 'นครปฐม   '),
(758, '73150', 'นครปฐม   '),
(759, '73160', 'นครปฐม   '),
(760, '73170', 'นครปฐม   '),
(761, '73180', 'นครปฐม   '),
(762, '73190', 'นครปฐม   '),
(763, '73210', 'นครปฐม   '),
(764, '73220', 'นครปฐม   '),
(765, '74000', 'สมุทรสาคร   '),
(766, '74110', 'สมุทรสาคร   '),
(767, '74120', 'สมุทรสาคร   '),
(768, '74130', 'สมุทรสาคร   '),
(769, '75000', 'สมุทรสงคราม   '),
(770, '75110', 'สมุทรสงคราม   '),
(771, '75120', 'สมุทรสงคราม   '),
(772, '76000', 'เพชรบุรี   '),
(773, '76100', 'เพชรบุรี   '),
(774, '76110', 'เพชรบุรี   '),
(775, '76120', 'เพชรบุรี   '),
(776, '76130', 'เพชรบุรี   '),
(777, '76140', 'เพชรบุรี   '),
(778, '76150', 'เพชรบุรี   '),
(779, '76160', 'เพชรบุรี   '),
(780, '76170', 'เพชรบุรี   '),
(781, '77000', 'ประจวบคีรีขันธ์   '),
(782, '77110', 'ประจวบคีรีขันธ์   '),
(783, '77120', 'ประจวบคีรีขันธ์   '),
(784, '77130', 'ประจวบคีรีขันธ์   '),
(785, '77140', 'ประจวบคีรีขันธ์   '),
(786, '77150', 'ประจวบคีรีขันธ์   '),
(787, '77170', 'ประจวบคีรีขันธ์   '),
(788, '77180', 'ประจวบคีรีขันธ์   '),
(789, '77190', 'ประจวบคีรีขันธ์   '),
(790, '77210', 'ประจวบคีรีขันธ์   '),
(791, '77220', 'ประจวบคีรีขันธ์   '),
(792, '77230', 'ประจวบคีรีขันธ์   '),
(793, '80000', 'นครศรีธรรมราช   '),
(794, '80110', 'นครศรีธรรมราช   '),
(795, '80120', 'นครศรีธรรมราช   '),
(796, '80130', 'นครศรีธรรมราช   '),
(797, '80140', 'นครศรีธรรมราช   '),
(798, '80150', 'นครศรีธรรมราช   '),
(799, '80160', 'นครศรีธรรมราช   '),
(800, '80170', 'นครศรีธรรมราช   '),
(801, '80180', 'นครศรีธรรมราช   '),
(802, '80190', 'นครศรีธรรมราช   '),
(803, '80210', 'นครศรีธรรมราช   '),
(804, '80220', 'นครศรีธรรมราช   '),
(805, '80230', 'นครศรีธรรมราช   '),
(806, '80240', 'นครศรีธรรมราช   '),
(807, '80240', 'กระบี่   '),
(808, '80250', 'นครศรีธรรมราช   '),
(809, '80260', 'นครศรีธรรมราช   '),
(810, '80270', 'นครศรีธรรมราช   '),
(811, '80280', 'นครศรีธรรมราช   '),
(812, '80290', 'นครศรีธรรมราช   '),
(813, '80310', 'นครศรีธรรมราช   '),
(814, '80320', 'นครศรีธรรมราช   '),
(815, '80330', 'นครศรีธรรมราช   '),
(816, '80340', 'นครศรีธรรมราช   '),
(817, '80350', 'นครศรีธรรมราช   '),
(818, '80360', 'นครศรีธรรมราช   '),
(819, '81000', 'กระบี่   '),
(820, '81110', 'กระบี่   '),
(821, '81120', 'กระบี่   '),
(822, '81130', 'กระบี่   '),
(823, '81140', 'กระบี่   '),
(824, '81150', 'กระบี่   '),
(825, '81160', 'กระบี่   '),
(826, '81170', 'กระบี่   '),
(827, '82000', 'พังงา   '),
(828, '82110', 'พังงา   '),
(829, '82120', 'พังงา   '),
(830, '82130', 'พังงา   '),
(831, '82140', 'พังงา   '),
(832, '82150', 'พังงา   '),
(833, '82160', 'พังงา   '),
(834, '82170', 'พังงา   '),
(835, '82180', 'พังงา   '),
(836, '82190', 'พังงา   '),
(837, '83000', 'พังงา   '),
(838, '83000', 'ภูเก็ต   '),
(839, '83100', 'ภูเก็ต   '),
(840, '83110', 'ภูเก็ต   '),
(841, '83120', 'ภูเก็ต   '),
(842, '83130', 'ภูเก็ต   '),
(843, '83150', 'ภูเก็ต   '),
(844, '84000', 'สุราษฎร์ธานี   '),
(845, '84100', 'สุราษฎร์ธานี   '),
(846, '84110', 'สุราษฎร์ธานี   '),
(847, '84120', 'สุราษฎร์ธานี   '),
(848, '84130', 'สุราษฎร์ธานี   '),
(849, '84140', 'สุราษฎร์ธานี   '),
(850, '84150', 'สุราษฎร์ธานี   '),
(851, '84160', 'สุราษฎร์ธานี   '),
(852, '84170', 'สุราษฎร์ธานี   '),
(853, '84180', 'สุราษฎร์ธานี   '),
(854, '84190', 'สุราษฎร์ธานี   '),
(855, '84210', 'สุราษฎร์ธานี   '),
(856, '84220', 'สุราษฎร์ธานี   '),
(857, '84230', 'สุราษฎร์ธานี   '),
(858, '84240', 'สุราษฎร์ธานี   '),
(859, '84250', 'สุราษฎร์ธานี   '),
(860, '84260', 'สุราษฎร์ธานี   '),
(861, '84270', 'สุราษฎร์ธานี   '),
(862, '84280', 'สุราษฎร์ธานี   '),
(863, '84290', 'สุราษฎร์ธานี   '),
(864, '84310', 'สุราษฎร์ธานี   '),
(865, '84320', 'สุราษฎร์ธานี   '),
(866, '84330', 'สุราษฎร์ธานี   '),
(867, '84340', 'สุราษฎร์ธานี   '),
(868, '84350', 'สุราษฎร์ธานี   '),
(869, '85000', 'ระนอง   '),
(870, '85110', 'ระนอง   '),
(871, '85120', 'ระนอง   '),
(872, '85130', 'ระนอง   '),
(873, '86000', 'ชุมพร   '),
(874, '86100', 'ชุมพร   '),
(875, '86110', 'ชุมพร   '),
(876, '86120', 'ชุมพร   '),
(877, '86130', 'ชุมพร   '),
(878, '86140', 'ชุมพร   '),
(879, '86150', 'ชุมพร   '),
(880, '86160', 'ชุมพร   '),
(881, '86170', 'ชุมพร   '),
(882, '86180', 'ชุมพร   '),
(883, '86190', 'ชุมพร   '),
(884, '86210', 'ชุมพร   '),
(885, '86220', 'ชุมพร   '),
(886, '86230', 'ชุมพร   '),
(887, '90000', 'สงขลา   '),
(888, '90100', 'สงขลา   '),
(889, '90110', 'สงขลา   '),
(890, '90115', 'สงขลา   '),
(891, '90120', 'สงขลา   '),
(892, '90130', 'สงขลา   '),
(893, '90140', 'สงขลา   '),
(894, '90150', 'สงขลา   '),
(895, '90160', 'สงขลา   '),
(896, '90170', 'สงขลา   '),
(897, '90180', 'สงขลา   '),
(898, '90190', 'สงขลา   '),
(899, '90210', 'สงขลา   '),
(900, '90220', 'สงขลา   '),
(901, '90230', 'สงขลา   '),
(902, '90240', 'สงขลา   '),
(903, '90250', 'สงขลา   '),
(904, '90260', 'สงขลา   '),
(905, '90270', 'สงขลา   '),
(906, '90280', 'สงขลา   '),
(907, '90310', 'สงขลา   '),
(908, '90320', 'สงขลา   '),
(909, '90330', 'สงขลา   '),
(910, '91000', 'สตูล   '),
(911, '91110', 'สตูล   '),
(912, '91120', 'สตูล   '),
(913, '91130', 'สตูล   '),
(914, '91140', 'สตูล   '),
(915, '91150', 'สตูล   '),
(916, '91160', 'สตูล   '),
(917, '92000', 'ตรัง   '),
(918, '92110', 'ตรัง   '),
(919, '92120', 'ตรัง   '),
(920, '92130', 'ตรัง   '),
(921, '92140', 'ตรัง   '),
(922, '92150', 'ตรัง   '),
(923, '92160', 'ตรัง   '),
(924, '92170', 'ตรัง   '),
(925, '92180', 'ตรัง   '),
(926, '92190', 'ตรัง   '),
(927, '92210', 'ตรัง   '),
(928, '92220', 'ตรัง   '),
(929, '93000', 'พัทลุง   '),
(930, '93110', 'พัทลุง   '),
(931, '93120', 'พัทลุง   '),
(932, '93130', 'พัทลุง   '),
(933, '93140', 'พัทลุง   '),
(934, '93150', 'พัทลุง   '),
(935, '93160', 'พัทลุง   '),
(936, '93170', 'พัทลุง   '),
(937, '93180', 'พัทลุง   '),
(938, '93190', 'พัทลุง   '),
(939, '94000', 'ปัตตานี   '),
(940, '94110', 'ปัตตานี   '),
(941, '94120', 'ปัตตานี   '),
(942, '94130', 'ปัตตานี   '),
(943, '94140', 'ปัตตานี   '),
(944, '94150', 'ปัตตานี   '),
(945, '94160', 'ปัตตานี   '),
(946, '94170', 'ปัตตานี   '),
(947, '94180', 'ปัตตานี   '),
(948, '94190', 'ปัตตานี   '),
(949, '94220', 'ปัตตานี   '),
(950, '94230', 'ปัตตานี   '),
(951, '95000', 'ยะลา   '),
(952, '95110', 'ยะลา   '),
(953, '95120', 'ยะลา   '),
(954, '95130', 'ยะลา   '),
(955, '95140', 'ยะลา   '),
(956, '95150', 'ยะลา   '),
(957, '95160', 'ยะลา   '),
(958, '95170', 'ยะลา   '),
(959, '96000', 'นราธิวาส   '),
(960, '96110', 'นราธิวาส   '),
(961, '96120', 'นราธิวาส   '),
(962, '96130', 'นราธิวาส   '),
(963, '96140', 'นราธิวาส   '),
(964, '96150', 'นราธิวาส   '),
(965, '96160', 'นราธิวาส   '),
(966, '96170', 'นราธิวาส   '),
(967, '96180', 'นราธิวาส   '),
(968, '96190', 'นราธิวาส   '),
(969, '96210', 'นราธิวาส   '),
(970, '96220', 'นราธิวาส   ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `advt`
--
ALTER TABLE `advt`
  ADD PRIMARY KEY (`advt_id`),
  ADD KEY `fk_advt_customer1_idx` (`customer_id_pri`);

--
-- Indexes for table `apsth_pos_system`
--
ALTER TABLE `apsth_pos_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`),
  ADD KEY `fk_bank_shop1_idx` (`shop_id_pri`),
  ADD KEY `fk_bank_ref_type_tax_copy11_idx` (`type_bank_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id_pri`),
  ADD KEY `fk_admin_ref_status1_idx` (`status_id`),
  ADD KEY `fk_customer_user1_idx` (`user_id`),
  ADD KEY `fk_customer_customer_group1_idx` (`customer_group_id`),
  ADD KEY `fk_customer_role1_idx` (`role_id`),
  ADD KEY `fk_customer_image1_idx` (`image_id`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`customer_group_id`),
  ADD KEY `fk_customer_group_ref_type_save1_idx` (`type_save_id`),
  ADD KEY `fk_customer_group_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `fk_expense_ref_status_expense1_idx` (`status_expense_id`),
  ADD KEY `fk_expense_shop1_idx` (`shop_id_pri`),
  ADD KEY `fk_expense_bank1_idx` (`bank_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`files_id`),
  ADD KEY `fk_files_services_master1_idx` (`services_master_id_pri`),
  ADD KEY `fk_files_user1_idx` (`user_id`);

--
-- Indexes for table `group_menu`
--
ALTER TABLE `group_menu`
  ADD PRIMARY KEY (`group_menu_id`);

--
-- Indexes for table `head_sms`
--
ALTER TABLE `head_sms`
  ADD PRIMARY KEY (`head_sms_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `income_bank`
--
ALTER TABLE `income_bank`
  ADD PRIMARY KEY (`income_bank_id`);

--
-- Indexes for table `inform_payment`
--
ALTER TABLE `inform_payment`
  ADD PRIMARY KEY (`inform_payment_id`),
  ADD KEY `fk_inform_payment_bank1_idx` (`bank_id`),
  ADD KEY `fk_inform_payment_ref_status_inform1_idx` (`status_inform_id`),
  ADD KEY `fk_inform_payment_image1_idx` (`image_id`),
  ADD KEY `fk_inform_payment_shop1_idx` (`shop_id_pri`),
  ADD KEY `fk_inform_payment_user1_idx` (`user_id`);

--
-- Indexes for table `login_check`
--
ALTER TABLE `login_check`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `fk_login_check_user1_idx` (`user_id`);

--
-- Indexes for table `login_check_admin`
--
ALTER TABLE `login_check_admin`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `fk_login_check_admin_admin1_idx` (`admin_id`);

--
-- Indexes for table `login_check_customer`
--
ALTER TABLE `login_check_customer`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `fk_login_check_customer_customer1_idx` (`customer_id_pri`);

--
-- Indexes for table `log_bank`
--
ALTER TABLE `log_bank`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_bank_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `log_creditsms`
--
ALTER TABLE `log_creditsms`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_creditsms_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `log_expense`
--
ALTER TABLE `log_expense`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_bank_shop1_idx` (`shop_id_pri`),
  ADD KEY `fk_log_expense_expense1_idx` (`expense_id`);

--
-- Indexes for table `log_package`
--
ALTER TABLE `log_package`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_package_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `log_receipt`
--
ALTER TABLE `log_receipt`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_receipt_receipt_master1_idx` (`receipt_master_id_pri`),
  ADD KEY `fk_log_receipt_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `log_sendemail`
--
ALTER TABLE `log_sendemail`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_sendemail_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `log_sendreceipt`
--
ALTER TABLE `log_sendreceipt`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_sendreceipt_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `log_sendsms`
--
ALTER TABLE `log_sendsms`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_sendsms_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `log_services`
--
ALTER TABLE `log_services`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_services_services_master1_idx` (`services_master_id_pri`),
  ADD KEY `fk_log_services_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `log_transportexport`
--
ALTER TABLE `log_transportexport`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_transportexport_user1_idx` (`user_id`),
  ADD KEY `fk_log_transportexport_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `log_user_login`
--
ALTER TABLE `log_user_login`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `map_menu_package`
--
ALTER TABLE `map_menu_package`
  ADD PRIMARY KEY (`map_menu_package_id`),
  ADD KEY `fk_map_menu_package_package1_idx` (`package_id`),
  ADD KEY `fk_map_menu_package_menu1_idx` (`menu_id`);

--
-- Indexes for table `map_menu_role`
--
ALTER TABLE `map_menu_role`
  ADD PRIMARY KEY (`map_menu_role_id`),
  ADD KEY `fk_role_has_group_menu_role1_idx` (`role_id`),
  ADD KEY `fk_map_group_menu_role_menu1_idx` (`menu_id`);

--
-- Indexes for table `map_product_stock`
--
ALTER TABLE `map_product_stock`
  ADD PRIMARY KEY (`map_product_stock_id`),
  ADD KEY `fk_map_product_stock_stock1_idx` (`stock_id_pri`),
  ADD KEY `fk_map_product_stock_product1_idx` (`product_id_pri`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `fk_menu_group_menu1_idx` (`group_menu_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`partners_id_pri`),
  ADD KEY `fk_admin_ref_status1_idx` (`status_id`),
  ADD KEY `fk_partners_partners_group1_idx` (`partners_group_id`);

--
-- Indexes for table `partners_group`
--
ALTER TABLE `partners_group`
  ADD PRIMARY KEY (`partners_group_id`),
  ADD KEY `fk_partners_group_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `process_transport`
--
ALTER TABLE `process_transport`
  ADD PRIMARY KEY (`process_transport_id`),
  ADD KEY `fk_process_transport_shop1_idx` (`shop_id_pri`),
  ADD KEY `fk_process_transport_user1_idx` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id_pri`),
  ADD KEY `fk_product_product_category1_idx` (`product_category_id`),
  ADD KEY `fk_product_image1_idx` (`image_id`),
  ADD KEY `fk_product_ref_status_product1_idx` (`status_product_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`),
  ADD KEY `fk_product_category_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `product_properties`
--
ALTER TABLE `product_properties`
  ADD PRIMARY KEY (`product_properties_id`),
  ADD KEY `fk_product_properties_product1_idx` (`product_id_pri`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receipt_id`),
  ADD KEY `fk_receipt_user1_idx` (`user_id`),
  ADD KEY `fk_receipt_income_bank1_idx` (`income_bank_id`),
  ADD KEY `fk_receipt_package1_idx` (`package_id`),
  ADD KEY `fk_receipt_sms1_idx` (`sms_id`);

--
-- Indexes for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  ADD PRIMARY KEY (`receipt_detail_id`),
  ADD KEY `fk_receipt_detail_receipt_master1_idx` (`receipt_master_id_pri`);

--
-- Indexes for table `receipt_master`
--
ALTER TABLE `receipt_master`
  ADD PRIMARY KEY (`receipt_master_id_pri`),
  ADD KEY `fk_receipt_master_ref_type_receipt1_idx` (`type_receipt_id`),
  ADD KEY `fk_receipt_master_ref_type_tax1_idx` (`type_tax_id`),
  ADD KEY `fk_receipt_master_sale_from1_idx` (`sale_from_id`),
  ADD KEY `fk_receipt_master_ref_status_receipt2_idx` (`status_receipt_id`),
  ADD KEY `fk_receipt_master_ref_status_transfer1_idx` (`status_transfer_id`),
  ADD KEY `fk_receipt_master_shop1_idx` (`shop_id_pri`),
  ADD KEY `fk_receipt_master_ref_status_pay1_idx` (`status_pay_id`),
  ADD KEY `fk_receipt_master_bank1_idx` (`bank_id`),
  ADD KEY `fk_receipt_master_ref_status_receipt_order1_idx` (`status_receipt_order_id`),
  ADD KEY `fk_receipt_master_user1_idx` (`user_id`),
  ADD KEY `fk_receipt_master_ref_status_receipt_print1_idx` (`status_receipt_print_id`),
  ADD KEY `fk_receipt_master_ref_status_sticker_transport1_idx` (`status_sticker_transport_id`),
  ADD KEY `fk_receipt_master_ref_status_pack1_idx` (`status_pack_id`),
  ADD KEY `fk_receipt_master_ref_confirm_order1_idx` (`confirm_order_id`),
  ADD KEY `fk_receipt_master_ref_status_get_product1_idx` (`status_get_product_id`),
  ADD KEY `fk_receipt_master_ref_transport_service1_idx` (`transport_service_id`);

--
-- Indexes for table `receipt_temp`
--
ALTER TABLE `receipt_temp`
  ADD PRIMARY KEY (`receipt_temp_id`),
  ADD KEY `fk_receipt_temp_shop1_idx` (`shop_id_pri`),
  ADD KEY `fk_receipt_temp_user1_idx` (`user_id`);

--
-- Indexes for table `ref_confirm_order`
--
ALTER TABLE `ref_confirm_order`
  ADD PRIMARY KEY (`confirm_order_id`);

--
-- Indexes for table `ref_receipt_print`
--
ALTER TABLE `ref_receipt_print`
  ADD PRIMARY KEY (`receipt_print_id`);

--
-- Indexes for table `ref_status`
--
ALTER TABLE `ref_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `ref_status_expense`
--
ALTER TABLE `ref_status_expense`
  ADD PRIMARY KEY (`status_expense_id`);

--
-- Indexes for table `ref_status_get_product`
--
ALTER TABLE `ref_status_get_product`
  ADD PRIMARY KEY (`status_get_product_id`);

--
-- Indexes for table `ref_status_inform`
--
ALTER TABLE `ref_status_inform`
  ADD PRIMARY KEY (`status_inform_id`);

--
-- Indexes for table `ref_status_pack`
--
ALTER TABLE `ref_status_pack`
  ADD PRIMARY KEY (`status_pack_id`);

--
-- Indexes for table `ref_status_pay`
--
ALTER TABLE `ref_status_pay`
  ADD PRIMARY KEY (`status_pay_id`);

--
-- Indexes for table `ref_status_product`
--
ALTER TABLE `ref_status_product`
  ADD PRIMARY KEY (`status_product_id`);

--
-- Indexes for table `ref_status_receipt`
--
ALTER TABLE `ref_status_receipt`
  ADD PRIMARY KEY (`status_receipt_id`);

--
-- Indexes for table `ref_status_receipt_order`
--
ALTER TABLE `ref_status_receipt_order`
  ADD PRIMARY KEY (`status_receipt_order_id`);

--
-- Indexes for table `ref_status_receipt_print`
--
ALTER TABLE `ref_status_receipt_print`
  ADD PRIMARY KEY (`status_receipt_print_id`);

--
-- Indexes for table `ref_status_shop`
--
ALTER TABLE `ref_status_shop`
  ADD PRIMARY KEY (`status_shop_id`);

--
-- Indexes for table `ref_status_sticker_transport`
--
ALTER TABLE `ref_status_sticker_transport`
  ADD PRIMARY KEY (`status_sticker_transport_id`);

--
-- Indexes for table `ref_status_transfer`
--
ALTER TABLE `ref_status_transfer`
  ADD PRIMARY KEY (`status_transfer_id`);

--
-- Indexes for table `ref_transport_service`
--
ALTER TABLE `ref_transport_service`
  ADD PRIMARY KEY (`transport_service_id`);

--
-- Indexes for table `ref_transport_status`
--
ALTER TABLE `ref_transport_status`
  ADD PRIMARY KEY (`transport_status_id`);

--
-- Indexes for table `ref_transport_type_pay`
--
ALTER TABLE `ref_transport_type_pay`
  ADD PRIMARY KEY (`transport_type_pay_id`);

--
-- Indexes for table `ref_type_bank`
--
ALTER TABLE `ref_type_bank`
  ADD PRIMARY KEY (`type_bank_id`);

--
-- Indexes for table `ref_type_payment`
--
ALTER TABLE `ref_type_payment`
  ADD PRIMARY KEY (`type_payment_id`);

--
-- Indexes for table `ref_type_receipt`
--
ALTER TABLE `ref_type_receipt`
  ADD PRIMARY KEY (`type_receipt_id`);

--
-- Indexes for table `ref_type_save`
--
ALTER TABLE `ref_type_save`
  ADD PRIMARY KEY (`type_save_id`);

--
-- Indexes for table `ref_type_shop`
--
ALTER TABLE `ref_type_shop`
  ADD PRIMARY KEY (`type_shop_id`);

--
-- Indexes for table `ref_type_tax`
--
ALTER TABLE `ref_type_tax`
  ADD PRIMARY KEY (`type_tax_id`);

--
-- Indexes for table `ref_type_user`
--
ALTER TABLE `ref_type_user`
  ADD PRIMARY KEY (`type_user_id`);

--
-- Indexes for table `ref_withholding_tax`
--
ALTER TABLE `ref_withholding_tax`
  ADD PRIMARY KEY (`withholding_tax_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sale_from`
--
ALTER TABLE `sale_from`
  ADD PRIMARY KEY (`sale_from_id`),
  ADD KEY `fk_sale_from_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`services_id`),
  ADD KEY `fk_services_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `services_detail`
--
ALTER TABLE `services_detail`
  ADD PRIMARY KEY (`services_detail_id`),
  ADD KEY `fk_services_detail_services_master1_idx` (`services_master_id_pri`);

--
-- Indexes for table `services_master`
--
ALTER TABLE `services_master`
  ADD PRIMARY KEY (`services_master_id_pri`),
  ADD KEY `fk_services_master_shop1_idx` (`shop_id_pri`),
  ADD KEY `fk_services_master_user1_idx` (`user_id`),
  ADD KEY `fk_services_master_ref_type_tax1_idx` (`type_tax_id`),
  ADD KEY `fk_services_master_bank1_idx` (`bank_id`);

--
-- Indexes for table `setting_sms`
--
ALTER TABLE `setting_sms`
  ADD PRIMARY KEY (`setting_sms_id`),
  ADD KEY `fk_setting_sms_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id_pri`),
  ADD KEY `fk_shop_ref_type_shop1_idx` (`type_shop_id`),
  ADD KEY `fk_shop_ref_status_shop1_idx` (`status_shop_id`),
  ADD KEY `fk_shop_image1_idx` (`image_id`);

--
-- Indexes for table `shop_setting_document`
--
ALTER TABLE `shop_setting_document`
  ADD PRIMARY KEY (`shop_setting_document_id`),
  ADD KEY `fk_bank_shop1_idx` (`shop_id_pri`),
  ADD KEY `fk_shop_setting_document_image1_idx` (`image_id`),
  ADD KEY `fk_shop_setting_document_ref_type_tax1_idx` (`type_tax_id`),
  ADD KEY `fk_shop_setting_document_ref_paper_print1_idx` (`receipt_print_id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`sms_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id_pri`),
  ADD KEY `fk_stock_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `transport_api`
--
ALTER TABLE `transport_api`
  ADD PRIMARY KEY (`transport_api_id`),
  ADD KEY `fk_transport_api_receipt_master1_idx` (`receipt_master_id_pri`),
  ADD KEY `fk_transport_api_ref_transport_status1_idx` (`transport_status_id`);

--
-- Indexes for table `transport_api_setting`
--
ALTER TABLE `transport_api_setting`
  ADD PRIMARY KEY (`transport_api_setting_id`),
  ADD KEY `fk_transport_api_setting_transport_setting1_idx` (`transport_setting_id`),
  ADD KEY `fk_transport_api_setting_ref_transport_service1_idx` (`transport_service_id`);

--
-- Indexes for table `transport_setting`
--
ALTER TABLE `transport_setting`
  ADD PRIMARY KEY (`transport_setting_id`),
  ADD KEY `fk_transport_ref_transport_service1_idx` (`transport_service_id`),
  ADD KEY `fk_transport_shop1_idx` (`shop_id_pri`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_admin_ref_status1_idx` (`status_id`),
  ADD KEY `fk_admin_role1_idx` (`role_id`),
  ADD KEY `fk_admin_shop1_idx` (`shop_id_pri`),
  ADD KEY `fk_user_ref_type_user1_idx` (`type_user_id`),
  ADD KEY `fk_user_image1_idx` (`image_id`);

--
-- Indexes for table `user_package`
--
ALTER TABLE `user_package`
  ADD PRIMARY KEY (`user_package_id`),
  ADD KEY `fk_user_package_user1_idx` (`user_id`),
  ADD KEY `fk_user_package_package1_idx` (`package_id`);

--
-- Indexes for table `zipcode`
--
ALTER TABLE `zipcode`
  ADD PRIMARY KEY (`zipcode_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advt`
--
ALTER TABLE `advt`
  MODIFY `advt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'บัญชีธนาคารที่ใช้ โอนเงิน', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id_pri` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `customer_group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ค่าใช้จ่ายอื่นๆที่ไม่เกี่ยวกับใบสั่งซื้อ';

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `files_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_menu`
--
ALTER TABLE `group_menu`
  MODIFY `group_menu_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `head_sms`
--
ALTER TABLE `head_sms`
  MODIFY `head_sms_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `income_bank`
--
ALTER TABLE `income_bank`
  MODIFY `income_bank_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inform_payment`
--
ALTER TABLE `inform_payment`
  MODIFY `inform_payment_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'หลักฐานการโอนเงิน';

--
-- AUTO_INCREMENT for table `login_check`
--
ALTER TABLE `login_check`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_check_admin`
--
ALTER TABLE `login_check_admin`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_check_customer`
--
ALTER TABLE `login_check_customer`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_bank`
--
ALTER TABLE `log_bank`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ประวัติการเงิน';

--
-- AUTO_INCREMENT for table `log_creditsms`
--
ALTER TABLE `log_creditsms`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_expense`
--
ALTER TABLE `log_expense`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ประวัติการเงิน';

--
-- AUTO_INCREMENT for table `log_package`
--
ALTER TABLE `log_package`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_receipt`
--
ALTER TABLE `log_receipt`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ใชเก็บการกระทำเกี่ยวกับใบเสร็จ';

--
-- AUTO_INCREMENT for table `log_sendemail`
--
ALTER TABLE `log_sendemail`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_sendreceipt`
--
ALTER TABLE `log_sendreceipt`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_sendsms`
--
ALTER TABLE `log_sendsms`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_services`
--
ALTER TABLE `log_services`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_transportexport`
--
ALTER TABLE `log_transportexport`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_user_login`
--
ALTER TABLE `log_user_login`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `map_menu_package`
--
ALTER TABLE `map_menu_package`
  MODIFY `map_menu_package_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `map_menu_role`
--
ALTER TABLE `map_menu_role`
  MODIFY `map_menu_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=580;

--
-- AUTO_INCREMENT for table `map_product_stock`
--
ALTER TABLE `map_product_stock`
  MODIFY `map_product_stock_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `partners_id_pri` int(11) NOT NULL AUTO_INCREMENT COMMENT 'คู่ค้า';

--
-- AUTO_INCREMENT for table `partners_group`
--
ALTER TABLE `partners_group`
  MODIFY `partners_group_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'กลุ่มคู่ค้า';

--
-- AUTO_INCREMENT for table `process_transport`
--
ALTER TABLE `process_transport`
  MODIFY `process_transport_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'เก็บการประมวดผลการขนส่งจาก api ของแต่ละครั้ง';

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id_pri` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_properties`
--
ALTER TABLE `product_properties`
  MODIFY `product_properties_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'คุณสมบัติสินค้า เช่น สี:เขียว ยาว:15cm';

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  MODIFY `receipt_detail_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'รายละเอียดบิล';

--
-- AUTO_INCREMENT for table `receipt_master`
--
ALTER TABLE `receipt_master`
  MODIFY `receipt_master_id_pri` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt_temp`
--
ALTER TABLE `receipt_temp`
  MODIFY `receipt_temp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_confirm_order`
--
ALTER TABLE `ref_confirm_order`
  MODIFY `confirm_order_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะการยืนยันใบสั่งซื้อ', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ref_receipt_print`
--
ALTER TABLE `ref_receipt_print`
  MODIFY `receipt_print_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ขนาดใบเสร็จที่ปริ้น', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_status`
--
ALTER TABLE `ref_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_status_expense`
--
ALTER TABLE `ref_status_expense`
  MODIFY `status_expense_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะรายการที่จ่าย', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ref_status_get_product`
--
ALTER TABLE `ref_status_get_product`
  MODIFY `status_get_product_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะยืนยันได้รับของ', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_status_inform`
--
ALTER TABLE `ref_status_inform`
  MODIFY `status_inform_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะการตรวจสอบรายการโอน', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ref_status_pack`
--
ALTER TABLE `ref_status_pack`
  MODIFY `status_pack_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะการแพ็คของ', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_status_pay`
--
ALTER TABLE `ref_status_pay`
  MODIFY `status_pay_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะชำระ ชำระแล้ว , ยังไม่ได้ชไระ , ชำระบางส่วน', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ref_status_product`
--
ALTER TABLE `ref_status_product`
  MODIFY `status_product_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะ แสดง ไม่แสดง ในหน้าขาย', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_status_receipt`
--
ALTER TABLE `ref_status_receipt`
  MODIFY `status_receipt_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะใบเสร็จ\nบันทึก\nยกเลิก', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_status_receipt_order`
--
ALTER TABLE `ref_status_receipt_order`
  MODIFY `status_receipt_order_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะสำหรับใบเปิด order', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_status_receipt_print`
--
ALTER TABLE `ref_status_receipt_print`
  MODIFY `status_receipt_print_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะการปริ้นใบเสร็จ', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_status_shop`
--
ALTER TABLE `ref_status_shop`
  MODIFY `status_shop_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะร้าน ปกติ , ถูกระงับ\n', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_status_sticker_transport`
--
ALTER TABLE `ref_status_sticker_transport`
  MODIFY `status_sticker_transport_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะปริ้น สติ๊กเกอร์', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_status_transfer`
--
ALTER TABLE `ref_status_transfer`
  MODIFY `status_transfer_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะการส่งสินค้า ยังไม่ได้ส่ง ,กำลังส่ง, ได้รับสินค้าแล้ว', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ref_transport_service`
--
ALTER TABLE `ref_transport_service`
  MODIFY `transport_service_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'บริการขนส่ง', AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `ref_transport_status`
--
ALTER TABLE `ref_transport_status`
  MODIFY `transport_status_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'สถานะการจัดส่งจาก api', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ref_transport_type_pay`
--
ALTER TABLE `ref_transport_type_pay`
  MODIFY `transport_type_pay_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ประเภทการจ่ายเงิน', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_type_bank`
--
ALTER TABLE `ref_type_bank`
  MODIFY `type_bank_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ประเภท bank ลบได้ (ลบไม่ได้)', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_type_payment`
--
ALTER TABLE `ref_type_payment`
  MODIFY `type_payment_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ประเภทการชำระ\nเงินสด\nบัตรเคดิต\nโอนธนาคาร', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ref_type_receipt`
--
ALTER TABLE `ref_type_receipt`
  MODIFY `type_receipt_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ประเภท\nขายสินค้าออก\nนำสินค้าเข้า', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ref_type_save`
--
ALTER TABLE `ref_type_save`
  MODIFY `type_save_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ประเภทส่วนลด % , บาท', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_type_shop`
--
ALTER TABLE `ref_type_shop`
  MODIFY `type_shop_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ประเภทร้าน ร้านหลักระบบ(เจ้าของแบร์น) ,ร้านหลัก(ตัวแทน) ,ร้านสาขาย่อย\n', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ref_type_tax`
--
ALTER TABLE `ref_type_tax`
  MODIFY `type_tax_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ประเภทภาษี\nไม่มีภาษี\nแยกภาษีมูลค่าเพิ่ม 7%\nรวมภาษีมูลค่าเพิ่ม 7%', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ref_type_user`
--
ALTER TABLE `ref_type_user`
  MODIFY `type_user_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ประเภท user เช่น ผู้ขายหลัก , ตัวแทนจำหน่าย', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ref_withholding_tax`
--
ALTER TABLE `ref_withholding_tax`
  MODIFY `withholding_tax_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ประเภทภาษีหัก ณ ที่จ่าย', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sale_from`
--
ALTER TABLE `sale_from`
  MODIFY `sale_from_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ช่องทางขาย หน้าร้าน (ค่าตั้งต้น) Facebook , Instagram', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services_detail`
--
ALTER TABLE `services_detail`
  MODIFY `services_detail_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services_master`
--
ALTER TABLE `services_master`
  MODIFY `services_master_id_pri` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting_sms`
--
ALTER TABLE `setting_sms`
  MODIFY `setting_sms_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ตั้งค่า SMS', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id_pri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop_setting_document`
--
ALTER TABLE `shop_setting_document`
  MODIFY `shop_setting_document_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'บัญชีธนาคารที่ใช้ โอนเงิน', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `sms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id_pri` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transport_api`
--
ALTER TABLE `transport_api`
  MODIFY `transport_api_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transport_api_setting`
--
ALTER TABLE `transport_api_setting`
  MODIFY `transport_api_setting_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'สร้าง user api', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transport_setting`
--
ALTER TABLE `transport_setting`
  MODIFY `transport_setting_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ตั้งค่าบริการขนส่งจัดส่ง เพื่อง่ายต่อการออกใบเสร็จ', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_package`
--
ALTER TABLE `user_package`
  MODIFY `user_package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zipcode`
--
ALTER TABLE `zipcode`
  MODIFY `zipcode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=971;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advt`
--
ALTER TABLE `advt`
  ADD CONSTRAINT `fk_advt_customer1` FOREIGN KEY (`customer_id_pri`) REFERENCES `customer` (`customer_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bank`
--
ALTER TABLE `bank`
  ADD CONSTRAINT `fk_bank_ref_type_tax_copy11` FOREIGN KEY (`type_bank_id`) REFERENCES `ref_type_bank` (`type_bank_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bank_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_admin_ref_status10` FOREIGN KEY (`status_id`) REFERENCES `ref_status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_customer_group1` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_group` (`customer_group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD CONSTRAINT `fk_customer_group_ref_type_save1` FOREIGN KEY (`type_save_id`) REFERENCES `ref_type_save` (`type_save_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_group_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `fk_expense_bank1` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`bank_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_expense_ref_status_expense1` FOREIGN KEY (`status_expense_id`) REFERENCES `ref_status_expense` (`status_expense_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_expense_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `fk_files_services_master1` FOREIGN KEY (`services_master_id_pri`) REFERENCES `services_master` (`services_master_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_files_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inform_payment`
--
ALTER TABLE `inform_payment`
  ADD CONSTRAINT `fk_inform_payment_bank1` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`bank_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inform_payment_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inform_payment_ref_status_inform1` FOREIGN KEY (`status_inform_id`) REFERENCES `ref_status_inform` (`status_inform_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inform_payment_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inform_payment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `login_check`
--
ALTER TABLE `login_check`
  ADD CONSTRAINT `fk_login_check_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `login_check_admin`
--
ALTER TABLE `login_check_admin`
  ADD CONSTRAINT `fk_login_check_admin_admin1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `login_check_customer`
--
ALTER TABLE `login_check_customer`
  ADD CONSTRAINT `fk_login_check_customer_customer1` FOREIGN KEY (`customer_id_pri`) REFERENCES `customer` (`customer_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log_bank`
--
ALTER TABLE `log_bank`
  ADD CONSTRAINT `fk_log_bank_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log_creditsms`
--
ALTER TABLE `log_creditsms`
  ADD CONSTRAINT `fk_log_creditsms_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log_expense`
--
ALTER TABLE `log_expense`
  ADD CONSTRAINT `fk_log_bank_shop10` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_log_expense_expense1` FOREIGN KEY (`expense_id`) REFERENCES `expense` (`expense_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log_package`
--
ALTER TABLE `log_package`
  ADD CONSTRAINT `fk_log_package_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log_receipt`
--
ALTER TABLE `log_receipt`
  ADD CONSTRAINT `fk_log_receipt_receipt_master1` FOREIGN KEY (`receipt_master_id_pri`) REFERENCES `receipt_master` (`receipt_master_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_log_receipt_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log_sendemail`
--
ALTER TABLE `log_sendemail`
  ADD CONSTRAINT `fk_log_sendemail_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log_sendreceipt`
--
ALTER TABLE `log_sendreceipt`
  ADD CONSTRAINT `fk_log_sendreceipt_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log_sendsms`
--
ALTER TABLE `log_sendsms`
  ADD CONSTRAINT `fk_log_sendsms_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log_services`
--
ALTER TABLE `log_services`
  ADD CONSTRAINT `fk_log_services_services_master1` FOREIGN KEY (`services_master_id_pri`) REFERENCES `services_master` (`services_master_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_log_services_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log_transportexport`
--
ALTER TABLE `log_transportexport`
  ADD CONSTRAINT `fk_log_transportexport_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_log_transportexport_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `map_menu_package`
--
ALTER TABLE `map_menu_package`
  ADD CONSTRAINT `fk_map_menu_package_menu1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_map_menu_package_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `map_menu_role`
--
ALTER TABLE `map_menu_role`
  ADD CONSTRAINT `fk_map_group_menu_role_menu1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_role_has_group_menu_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `map_product_stock`
--
ALTER TABLE `map_product_stock`
  ADD CONSTRAINT `fk_map_product_stock_product1` FOREIGN KEY (`product_id_pri`) REFERENCES `product` (`product_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_map_product_stock_stock1` FOREIGN KEY (`stock_id_pri`) REFERENCES `stock` (`stock_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_group_menu1` FOREIGN KEY (`group_menu_id`) REFERENCES `group_menu` (`group_menu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `partners`
--
ALTER TABLE `partners`
  ADD CONSTRAINT `fk_admin_ref_status100` FOREIGN KEY (`status_id`) REFERENCES `ref_status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_partners_partners_group1` FOREIGN KEY (`partners_group_id`) REFERENCES `partners_group` (`partners_group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `partners_group`
--
ALTER TABLE `partners_group`
  ADD CONSTRAINT `fk_partners_group_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `process_transport`
--
ALTER TABLE `process_transport`
  ADD CONSTRAINT `fk_process_transport_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_process_transport_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_product_category1` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`product_category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_ref_status_product1` FOREIGN KEY (`status_product_id`) REFERENCES `ref_status_product` (`status_product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `fk_product_category_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_properties`
--
ALTER TABLE `product_properties`
  ADD CONSTRAINT `fk_product_properties_product1` FOREIGN KEY (`product_id_pri`) REFERENCES `product` (`product_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `fk_receipt_income_bank1` FOREIGN KEY (`income_bank_id`) REFERENCES `income_bank` (`income_bank_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_sms1` FOREIGN KEY (`sms_id`) REFERENCES `sms` (`sms_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  ADD CONSTRAINT `fk_receipt_detail_receipt_master1` FOREIGN KEY (`receipt_master_id_pri`) REFERENCES `receipt_master` (`receipt_master_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `receipt_master`
--
ALTER TABLE `receipt_master`
  ADD CONSTRAINT `fk_receipt_master_bank1` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`bank_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_ref_confirm_order1` FOREIGN KEY (`confirm_order_id`) REFERENCES `ref_confirm_order` (`confirm_order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_ref_status_get_product1` FOREIGN KEY (`status_get_product_id`) REFERENCES `ref_status_get_product` (`status_get_product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_ref_status_pack1` FOREIGN KEY (`status_pack_id`) REFERENCES `ref_status_pack` (`status_pack_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_ref_status_pay1` FOREIGN KEY (`status_pay_id`) REFERENCES `ref_status_pay` (`status_pay_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_ref_status_receipt2` FOREIGN KEY (`status_receipt_id`) REFERENCES `ref_status_receipt` (`status_receipt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_ref_status_receipt_order1` FOREIGN KEY (`status_receipt_order_id`) REFERENCES `ref_status_receipt_order` (`status_receipt_order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_ref_status_receipt_print1` FOREIGN KEY (`status_receipt_print_id`) REFERENCES `ref_status_receipt_print` (`status_receipt_print_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_ref_status_sticker_transport1` FOREIGN KEY (`status_sticker_transport_id`) REFERENCES `ref_status_sticker_transport` (`status_sticker_transport_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_ref_status_transfer1` FOREIGN KEY (`status_transfer_id`) REFERENCES `ref_status_transfer` (`status_transfer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_ref_transport_service1` FOREIGN KEY (`transport_service_id`) REFERENCES `ref_transport_service` (`transport_service_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_ref_type_receipt1` FOREIGN KEY (`type_receipt_id`) REFERENCES `ref_type_receipt` (`type_receipt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_ref_type_tax1` FOREIGN KEY (`type_tax_id`) REFERENCES `ref_type_tax` (`type_tax_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_sale_from1` FOREIGN KEY (`sale_from_id`) REFERENCES `sale_from` (`sale_from_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_master_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `receipt_temp`
--
ALTER TABLE `receipt_temp`
  ADD CONSTRAINT `fk_receipt_temp_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receipt_temp_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sale_from`
--
ALTER TABLE `sale_from`
  ADD CONSTRAINT `fk_sale_from_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk_services_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `services_detail`
--
ALTER TABLE `services_detail`
  ADD CONSTRAINT `fk_services_detail_services_master1` FOREIGN KEY (`services_master_id_pri`) REFERENCES `services_master` (`services_master_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `services_master`
--
ALTER TABLE `services_master`
  ADD CONSTRAINT `fk_services_master_bank1` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`bank_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_services_master_ref_type_tax1` FOREIGN KEY (`type_tax_id`) REFERENCES `ref_type_tax` (`type_tax_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_services_master_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_services_master_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `setting_sms`
--
ALTER TABLE `setting_sms`
  ADD CONSTRAINT `fk_setting_sms_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `fk_shop_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shop_ref_status_shop1` FOREIGN KEY (`status_shop_id`) REFERENCES `ref_status_shop` (`status_shop_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shop_ref_type_shop1` FOREIGN KEY (`type_shop_id`) REFERENCES `ref_type_shop` (`type_shop_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop_setting_document`
--
ALTER TABLE `shop_setting_document`
  ADD CONSTRAINT `fk_bank_shop10` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shop_setting_document_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shop_setting_document_ref_paper_print1` FOREIGN KEY (`receipt_print_id`) REFERENCES `ref_receipt_print` (`receipt_print_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shop_setting_document_ref_type_tax1` FOREIGN KEY (`type_tax_id`) REFERENCES `ref_type_tax` (`type_tax_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_stock_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transport_api`
--
ALTER TABLE `transport_api`
  ADD CONSTRAINT `fk_transport_api_receipt_master1` FOREIGN KEY (`receipt_master_id_pri`) REFERENCES `receipt_master` (`receipt_master_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transport_api_ref_transport_status1` FOREIGN KEY (`transport_status_id`) REFERENCES `ref_transport_status` (`transport_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transport_api_setting`
--
ALTER TABLE `transport_api_setting`
  ADD CONSTRAINT `fk_transport_api_setting_ref_transport_service1` FOREIGN KEY (`transport_service_id`) REFERENCES `ref_transport_service` (`transport_service_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transport_api_setting_transport_setting1` FOREIGN KEY (`transport_setting_id`) REFERENCES `transport_setting` (`transport_setting_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transport_setting`
--
ALTER TABLE `transport_setting`
  ADD CONSTRAINT `fk_transport_ref_transport_service1` FOREIGN KEY (`transport_service_id`) REFERENCES `ref_transport_service` (`transport_service_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transport_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_admin_ref_status1` FOREIGN KEY (`status_id`) REFERENCES `ref_status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_admin_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_admin_shop1` FOREIGN KEY (`shop_id_pri`) REFERENCES `shop` (`shop_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_ref_type_user1` FOREIGN KEY (`type_user_id`) REFERENCES `ref_type_user` (`type_user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_package`
--
ALTER TABLE `user_package`
  ADD CONSTRAINT `fk_user_package_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_package_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
