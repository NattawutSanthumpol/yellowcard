-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2022 at 08:57 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yellowcard`
--

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `lvl_id` int(1) NOT NULL COMMENT 'รหัสระดับสิทธิ์',
  `lvl_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ระดับสิทธิ์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`lvl_id`, `lvl_name`) VALUES
(1, 'Administrator'),
(2, 'Manager'),
(3, 'Teacher'),
(4, 'Guest');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `mem_id` int(7) NOT NULL COMMENT 'รหัสสมาชิก',
  `mem_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อสมาชิก',
  `mem_user` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Username',
  `mem_pass` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Password',
  `lvl_id` int(9) NOT NULL COMMENT '  รหัสระดับสิทธิ์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`mem_id`, `mem_name`, `mem_user`, `mem_pass`, `lvl_id`) VALUES
(0, 'Admin', 'admin', 'YWRtaW4=', 1),
(1, 'Guest', 'user', 'dXNlcg==', 4),
(2, 'test1', 'test1', 'dGVzdDE=', 2),
(3, 'test2', 'test2', 'dGVzdDI=', 3),
(4, 'test3', 'test3', 'dGVzdDM=', 4),
(5911013, 'ณัฐวุฒิ แสนทำพล', '5911013', 'NTkxMTAxMw==', 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_offense`
--

CREATE TABLE `std_offense` (
  `std_off_id` int(11) NOT NULL COMMENT 'รหัสกระทำผิด',
  `std_id` int(9) NOT NULL COMMENT ' รหัสนักศึกษา',
  `wr_id` int(3) NOT NULL COMMENT 'รหัสความผิด',
  `mem_id` int(7) NOT NULL COMMENT 'รหัสสมาชิก',
  `std_off_date` datetime NOT NULL COMMENT 'วันที่',
  `std_off_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `std_id` int(9) NOT NULL COMMENT 'รหัสนักศึกษา',
  `std_tname` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'คำนำหน้าชื่อ',
  `std_fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อนักศึกษา',
  `std_lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'นามสกุลนักศึกษา',
  `std_class` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ระดับชั้น',
  `std_depart` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'แผนก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`std_id`, `std_tname`, `std_fname`, `std_lname`, `std_class`, `std_depart`) VALUES
(611120019, 'นางสาว', 'ณัฐนันท์', 'น่วมทนงค์', 'ปวส.2/1', 'การบัญชี'),
(611120028, 'นางสาว', 'ฐิติกา', 'ทองดี', 'ปวส.2/1', 'การบัญชี'),
(611120069, 'นางสาว', 'ชนิดา', 'นิ่มวุฒิกาญจน์', 'ปวส.2/1', 'การบัญชี'),
(611120079, 'นาย', 'ณัฐชนน', 'เขาแก้ว', 'ปวส.2/1', 'การบัญชี'),
(611120080, 'นาย', 'ณัฐนัย', 'เจ็กตระกูล', 'ปวส.2/1', 'การบัญชี'),
(611120242, 'นางสาว', 'ณัฐศิมา', 'เพ็ชรอยู่', 'ปวส.2/1', 'การบัญชี'),
(611120314, 'นาย', 'เกียรติศักดิ์', 'พร้อมจิตร', 'ปวส.2/5', 'คอมพิวเตอร์ธุรกิจ'),
(621110042, 'นาย', 'กรกวิน', 'สุกัณฑ์', 'ปวช.1/9', 'เทคโนโลยีสารสนเทศ'),
(621110048, 'นางสาว', 'กุลสตรี', 'รูปสม', 'ปวช.1/1', 'พณิชยการ'),
(621110049, 'นาย', 'ณาธร', 'แย้มพยุง', 'ปวช.1/13', 'คอมพิวเตอร์กราฟิก'),
(621110094, 'นาย', 'จิระวัฒน์', 'ดุลรัมย์', 'ปวช.1/1', 'พณิชยการ'),
(621110125, 'นาย', 'ธนรัชต์', 'คุณมี', 'ปวช.1/13', 'คอมพิวเตอร์กราฟิก'),
(621110138, 'นาย', 'ปภาวิชญ์', 'อนันต์รัตนสกุล', 'ปวช.1/11', 'การท่องเที่ยว'),
(621110169, 'นาย', 'ณัฐวุฒิ', 'เเซ่คู', 'ปวช.1/13', 'คอมพิวเตอร์กราฟิก'),
(621110225, 'นาย', 'กิติศักดิ์', 'แก่นสวาท', 'ปวช.1/1', 'พณิชยการ'),
(621110308, 'นางสาว', 'กนกพลอย', 'พำนัก', 'ปวช.1/1', 'พณิชยการ'),
(621110330, 'นางสาว', 'จันทร์เพ็ญ', 'กล่อมกระโทก', 'ปวช.1/1', 'พณิชยการ'),
(621110337, 'นางสาว', 'ปรางค์ทอง', 'แก้วดอน', 'ปวช.1/11', 'การท่องเที่ยว'),
(621110359, 'นาย', 'ทักษ์ดนัย', 'จบไตรเภท', 'ปวช.1/13', 'คอมพิวเตอร์กราฟิก'),
(621110395, 'นาย', 'ก้องภพ', 'ศรีทอง', 'ปวช.1/9', 'เทคโนโลยีสารสนเทศ'),
(621110403, 'นางสาว', 'ชาลิสา', 'บรรดิษเสน', 'ปวช.1/13', 'คอมพิวเตอร์กราฟิก'),
(621110409, 'นาย', 'ณัฐกานต์', 'โพธิ์จำเริญ', 'ปวช.1/13', 'คอมพิวเตอร์กราฟิก'),
(621110412, 'นาย', 'ดนุพล', 'เรืองอัมพร', 'ปวช.1/9', 'เทคโนโลยีสารสนเทศ'),
(621110413, 'นาย', 'ดนุเดช', 'เรืองอัมพร', 'ปวช.1/9', 'เทคโนโลยีสารสนเทศ'),
(621110427, 'นาย', 'คณิศร', 'สมศรีอักษรแสง', 'ปวช.1/9', 'เทคโนโลยีสารสนเทศ'),
(621110432, 'นางสาว', 'กันตยา', 'หยิบจันทร์', 'ปวช.1/1', 'พณิชยการ'),
(621110494, 'นางสาว', 'กนกกาญจน์', 'ปานโต', 'ปวช.1/1', 'พณิชยการ'),
(621110514, 'นาย', 'ชิณวัตร', 'ภูชัยเจริญกุล', 'ปวช.1/13', 'คอมพิวเตอร์กราฟิก'),
(621110530, 'นางสาว', 'ปศิญา', 'เหล่างาม', 'ปวช.1/11', 'การท่องเที่ยว'),
(621110531, 'นางสาว', 'ปิยะนารถ', 'ทองผา', 'ปวช.1/11', 'การท่องเที่ยว'),
(621110537, 'นางสาว', 'กุลยา', 'เกิดฤทธิ์', 'ปวช.1/1', 'พณิชยการ'),
(621110544, 'นางสาว', 'ภัทรวดี', 'มณีจำรัส', 'ปวช.1/11', 'การท่องเที่ยว'),
(621110552, 'นาย', 'ทิพย์พเนตร', 'สมมน', 'ปวช.1/13', 'คอมพิวเตอร์กราฟิก'),
(621110568, 'นาย', 'ก้าวหน้า', 'ไชคำดี', 'ปวช.1/1', 'พณิชยการ'),
(621110579, 'นางสาว', 'กริณา', 'วิไลนุช', 'ปวช.1/1', 'พณิชยการ'),
(621110606, 'นาย', 'จักรพงษ์', 'ไชยรักษ์', 'ปวช.1/9', 'เทคโนโลยีสารสนเทศ'),
(621110613, 'นางสาว', 'ชลธิชา', 'บัวคง', 'ปวช.1/9', 'เทคโนโลยีสารสนเทศ'),
(621110615, 'นาย', 'เจษฎากร', 'ซื่อตรงใจ', 'ปวช.1/9', 'เทคโนโลยีสารสนเทศ'),
(621110619, 'นางสาว', 'พัชรนันท์', 'คะเนย์', 'ปวช.1/11', 'การท่องเที่ยว'),
(621110681, 'นางสาว', 'ภครวรรณ', 'ลงลา', 'ปวช.1/11', 'การท่องเที่ยว'),
(621110759, 'นาย', 'ณัฐพล', 'คุณธานี', 'ปวช.1/13', 'คอมพิวเตอร์กราฟิก'),
(621110842, 'นางสาว', 'ป้อม', '-', 'ปวช.1/11', 'การท่องเที่ยว'),
(621130005, 'นาย', 'ธนกร', 'สุบินตา', 'ปวส.1/16', 'เทคโนโลยีสารสนเทศ'),
(621130007, 'นาย', 'ทัตเทพ', 'ปรีชม', 'ปวส.1/16', 'เทคโนโลยีสารสนเทศ'),
(621130016, 'นาย', 'นัฏฐวุฒิ', 'สุนิน', 'ปวส.1/16', 'เทคโนโลยีสารสนเทศ'),
(621130017, 'นาย', 'นัฐวุฒิ', 'ไฝ่เพชรดี', 'ปวส.1/16', 'เทคโนโลยีสารสนเทศ'),
(621130020, 'นาย', 'พัชรพล', 'เอี่ยมเจริญ', 'ปวส.1/16', 'เทคโนโลยีสารสนเทศ'),
(621130023, 'นาย', 'นนทวัฒน์', 'แซ่โกว', 'ปวส.1/16', 'เทคโนโลยีสารสนเทศ'),
(621130158, 'นาย', 'นพรัตน์', 'พานาดา', 'ปวส.1/16', 'เทคโนโลยีสารสนเทศ');

-- --------------------------------------------------------

--
-- Table structure for table `wrong`
--

CREATE TABLE `wrong` (
  `wr_id` int(3) NOT NULL COMMENT 'รหัสความผิด',
  `wr_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อความผิด',
  `wr_score` int(2) NOT NULL COMMENT 'คะแนนความผิด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wrong`
--

INSERT INTO `wrong` (`wr_id`, `wr_name`, `wr_score`) VALUES
(1, 'ไม่คล้องบัตร', 5),
(2, 'ไม่สวมถุงเท้า', 5),
(3, 'นำอาหารไปกินบนอาคาร', 5),
(4, 'ความผิด 1', 15),
(5, 'ความผิด 2', 30),
(6, 'ความผิด 3', 14),
(7, 'ความผิด 4 ', 15),
(8, 'ความผิด 5', 20),
(9, 'ความผิด 6', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`lvl_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `std_offense`
--
ALTER TABLE `std_offense`
  ADD PRIMARY KEY (`std_off_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `wrong`
--
ALTER TABLE `wrong`
  ADD PRIMARY KEY (`wr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `lvl_id` int(1) NOT NULL AUTO_INCREMENT COMMENT 'รหัสระดับสิทธิ์', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `std_offense`
--
ALTER TABLE `std_offense`
  MODIFY `std_off_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกระทำผิด';

--
-- AUTO_INCREMENT for table `wrong`
--
ALTER TABLE `wrong`
  MODIFY `wr_id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'รหัสความผิด', AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
