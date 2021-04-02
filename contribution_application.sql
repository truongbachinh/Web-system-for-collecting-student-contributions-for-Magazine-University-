-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2021 at 12:17 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `contribution_application`
--
-- --------------------------------------------------------
--
-- Table structure for table `admin`
--
CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `admin`
--
INSERT INTO `admin` (`id`, `username`, `password`, `role`)
VALUES (1, 'admin', 'admin', 'admin');
-- --------------------------------------------------------
--
-- Table structure for table `faculty`
--
CREATE TABLE `faculty` (
  `f_id` int(20) NOT NULL,
  `f_name` varchar(125) NOT NULL,
  `f_description` text NOT NULL,
  `f_manager` varchar(255) NOT NULL,
  `faculty_id` varchar(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `faculty`
--
INSERT INTO `faculty` (
    `f_id`,
    `f_name`,
    `f_description`,
    `f_manager`,
    `faculty_id`
  )
VALUES (22, 'Faculty 1', 'oke', 'ad 1', 'GCH17527'),
  (23, 'Faculty 2', 'ad', 'ad2', 'GCH17528'),
  (24, 'Faculty 3', 'ad', 'ad 3', 'GCH17529'),
  (25, 'Faculty 4', 'oke', 'ad 4', 'GCH17530'),
  (26, 'Faculty 5', 'ad', 'ad 5', 'GCH17531'),
  (27, 'Faculty 6', 'ad', 'ad 6', 'GCH17532'),
  (28, 'Faculty 7', 'oke', 'Chính', 'GCH17533');
-- --------------------------------------------------------
--
-- Table structure for table `file_comment`
--
CREATE TABLE `file_comment` (
  `file_comment_id` int(20) NOT NULL,
  `file_comment_content` text NOT NULL,
  `file_comment_time` int(11) NOT NULL,
  `file_comment_user` int(20) NOT NULL,
  `file_submited_id` int(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `file_comment`
--
INSERT INTO `file_comment` (
    `file_comment_id`,
    `file_comment_content`,
    `file_comment_time`,
    `file_comment_user`,
    `file_submited_id`
  )
VALUES (24, 'Pass', 1617286612, 50, 64),
  (25, 'Fail', 1617287756, 50, 67);
-- --------------------------------------------------------
--
-- Table structure for table `file_content`
--
CREATE TABLE `file_content` (
  `file_content_id` int(20) NOT NULL,
  `file_content_name` varchar(3000) NOT NULL,
  `file_content_update_name` int(11) NOT NULL,
  `file_submit_id` int(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `file_content`
--
INSERT INTO `file_content` (
    `file_content_id`,
    `file_content_name`,
    `file_content_update_name`,
    `file_submit_id`
  )
VALUES (
    45,
    'd94ae0d6ce48f3c4691a583d30f50dfa4A76F959-31D9-4C49-BADD-BDF58593C379.jpg',
    1617286474,
    64
  ),
  (
    46,
    'd94ae0d6ce48f3c4691a583d30f50dfa45C64A49-E3CC-4FE8-8DAA-93ED181C53C1.jpg',
    1617286474,
    64
  ),
  (
    50,
    '87f6f06a7ee7dd77d33ecb00b75bd7c6158384890_147610643901366_5275522211667288605_n.png',
    1617286554,
    66
  ),
  (
    51,
    'df327123eb351a5261a5380aa86604bc45C64A49-E3CC-4FE8-8DAA-93ED181C53C1.jpg',
    1617287563,
    67
  ),
  (
    52,
    'f396cefb21ebcbd5484cba83c37a0edf45C64A49-E3CC-4FE8-8DAA-93ED181C53C1.jpg',
    1617287728,
    68
  ),
  (
    94,
    '95d9fee8b48b979994249256ecd052593 loại người dùng.docx',
    1617330189,
    114
  );
-- --------------------------------------------------------
--
-- Table structure for table `file_submit_to_submission`
--
CREATE TABLE `file_submit_to_submission` (
  `id` int(20) NOT NULL,
  `file_name` varchar(55) NOT NULL,
  `file_authod` varchar(55) NOT NULL,
  `file_status` int(20) NOT NULL,
  `file_date_uploaded` datetime NOT NULL,
  `file_submission_uploaded` int(11) NOT NULL,
  `file_userId_uploaded` int(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `file_submit_to_submission`
--
INSERT INTO `file_submit_to_submission` (
    `id`,
    `file_name`,
    `file_authod`,
    `file_status`,
    `file_date_uploaded`,
    `file_submission_uploaded`,
    `file_userId_uploaded`
  )
VALUES (
    64,
    'Chinh',
    'student 1 ',
    2,
    '2021-04-01 21:14:34',
    25,
    44
  ),
  (
    66,
    'Môn 1',
    'student 2',
    1,
    '2021-04-01 21:15:54',
    25,
    45
  ),
  (
    67,
    'a',
    'student 1 ',
    3,
    '2021-04-01 21:32:43',
    26,
    44
  ),
  (
    68,
    'Chinh',
    'student 1 ',
    1,
    '2021-04-01 21:35:28',
    27,
    44
  ),
  (
    114,
    'a123',
    'student 1 ',
    1,
    '2021-04-02 09:23:09',
    28,
    44
  );
-- --------------------------------------------------------
--
-- Table structure for table `submission`
--
CREATE TABLE `submission` (
  `id` int(11) NOT NULL,
  `submission_name` varchar(20) NOT NULL,
  `submission_description` varchar(255) NOT NULL,
  `submission_deadline` datetime NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `submission`
--
INSERT INTO `submission` (
    `id`,
    `submission_name`,
    `submission_description`,
    `submission_deadline`
  )
VALUES (
    25,
    'Submission môn 2',
    'Submission oke',
    '2021-03-24 16:07:00'
  ),
  (
    26,
    'Submission môn 3',
    'Nộp bài môn 3',
    '2021-03-24 16:11:00'
  ),
  (
    27,
    'Submission môn 4',
    'Nộp bài môn 4',
    '2021-03-23 16:12:00'
  ),
  (
    28,
    'Submission môn 12',
    'Submission oke',
    '2021-03-20 19:35:00'
  ),
  (29, 'adadad', 'ad', '2021-03-24 10:15:00'),
  (
    30,
    '235235',
    '235235235235',
    '2021-04-01 20:09:00'
  ),
  (
    34,
    'ad1234124',
    'ad123124',
    '2021-04-02 16:25:00'
  ),
  (35, 'ad123', 'ad1234', '2021-04-02 17:13:00'),
  (
    36,
    'ad123456',
    'ad123456',
    '2021-04-02 17:13:00'
  );
-- --------------------------------------------------------
--
-- Table structure for table `user`
--
CREATE TABLE `user` (
  `u_id` int(20) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(125) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(10) NOT NULL,
  `u_create_time` int(11) NOT NULL,
  `u_update_time` int(11) NOT NULL,
  `fullname` varchar(125) NOT NULL,
  `role` varchar(31) NOT NULL,
  `faculty_id` int(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `user`
--
INSERT INTO `user` (
    `u_id`,
    `username`,
    `password`,
    `email`,
    `status`,
    `u_create_time`,
    `u_update_time`,
    `fullname`,
    `role`,
    `faculty_id`
  )
VALUES (
    44,
    'student1',
    '123456',
    'truongbachinh1998@gmail.com',
    1,
    1616576159,
    0,
    'student 1 ',
    'student',
    22
  ),
  (
    45,
    'student2',
    '123456',
    'truongbachinh1998@gmail.com',
    1,
    1616576183,
    0,
    'student 2',
    'student',
    22
  ),
  (
    46,
    'student3',
    '123456',
    'truongbachinh1998@gmail.com',
    1,
    1616576204,
    0,
    'student 3',
    'student',
    23
  ),
  (
    47,
    'student4',
    '123456',
    'truongbachinh1998@gmail.com',
    1,
    1616576221,
    0,
    'student 4',
    'student',
    23
  ),
  (
    48,
    'student5',
    '123456',
    'truongbachinh1998@gmail.com',
    1,
    1616576240,
    0,
    'student 5',
    'student',
    24
  ),
  (
    49,
    'student6',
    '123456',
    'truongbachinh1998@gmail.com',
    1,
    1616576259,
    0,
    'student 6',
    'student',
    24
  ),
  (
    50,
    'faculty1',
    '123456',
    'truongbachinh1998@gmail.com',
    1,
    1616577179,
    0,
    'faculty 1',
    'manager-coordinator',
    22
  ),
  (
    51,
    'faculty2',
    '123456',
    'truongbachinh1998@gmail.com',
    1,
    1616577201,
    0,
    'chinh truong',
    'manager-coordinator',
    23
  ),
  (
    52,
    'faculty3',
    '123456',
    'truongbachinh1998@gmail.com',
    1,
    1616577216,
    0,
    'chinh truong',
    'manager-coordinator',
    24
  ),
  (
    53,
    'student7',
    '123456',
    'truongbachinh1998@gmail.com',
    1,
    1616589316,
    0,
    'student 7',
    'student',
    28
  );
-- --------------------------------------------------------
--
-- Table structure for table `user_infor`
--
CREATE TABLE `user_infor` (
  `id` int(20) NOT NULL,
  `id_card` varchar(20) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` varchar(125) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `major` varchar(128) NOT NULL,
  `user_id` int(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Indexes for dumped tables
--
--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
ADD PRIMARY KEY (`f_id`);
--
-- Indexes for table `file_comment`
--
ALTER TABLE `file_comment`
ADD PRIMARY KEY (`file_comment_id`),
  ADD KEY `fogeign_key_comment_file` (`file_submited_id`),
  ADD KEY `fogeign_key_coment_user` (`file_comment_user`);
--
-- Indexes for table `file_content`
--
ALTER TABLE `file_content`
ADD PRIMARY KEY (`file_content_id`),
  ADD KEY `fogeign_key_file_file_submit` (`file_submit_id`);
--
-- Indexes for table `file_submit_to_submission`
--
ALTER TABLE `file_submit_to_submission`
ADD PRIMARY KEY (`id`),
  ADD KEY `fogeign_key_file_submission` (`file_submission_uploaded`),
  ADD KEY `fogeign_key_file_user` (`file_userId_uploaded`);
--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `user`
--
ALTER TABLE `user`
ADD PRIMARY KEY (`u_id`),
  ADD KEY `fogeign_key_user_faculty` (`faculty_id`);
--
-- Indexes for table `user_infor`
--
ALTER TABLE `user_infor`
ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_card` (`id_card`),
  ADD KEY `fogeign_key_user_user_infor` (`user_id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;
--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
MODIFY `f_id` int(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 32;
--
-- AUTO_INCREMENT for table `file_comment`
--
ALTER TABLE `file_comment`
MODIFY `file_comment_id` int(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 26;
--
-- AUTO_INCREMENT for table `file_content`
--
ALTER TABLE `file_content`
MODIFY `file_content_id` int(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 95;
--
-- AUTO_INCREMENT for table `file_submit_to_submission`
--
ALTER TABLE `file_submit_to_submission`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 115;
--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 37;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `u_id` int(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 56;
--
-- AUTO_INCREMENT for table `user_infor`
--
ALTER TABLE `user_infor`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 19;
--
-- Constraints for dumped tables
--
--
-- Constraints for table `file_comment`
--
ALTER TABLE `file_comment`
ADD CONSTRAINT `fogeign_key_coment_user` FOREIGN KEY (`file_comment_user`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fogeign_key_comment_file` FOREIGN KEY (`file_submited_id`) REFERENCES `file_submit_to_submission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Constraints for table `file_content`
--
ALTER TABLE `file_content`
ADD CONSTRAINT `fogeign_key_file_file_submit` FOREIGN KEY (`file_submit_id`) REFERENCES `file_submit_to_submission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Constraints for table `file_submit_to_submission`
--
ALTER TABLE `file_submit_to_submission`
ADD CONSTRAINT `fogeign_key_file_submission` FOREIGN KEY (`file_submission_uploaded`) REFERENCES `submission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fogeign_key_file_user` FOREIGN KEY (`file_userId_uploaded`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `fogeign_key_user_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`f_id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Constraints for table `user_infor`
--
ALTER TABLE `user_infor`
ADD CONSTRAINT `fogeign_key_user_user_infor` FOREIGN KEY (`user_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;