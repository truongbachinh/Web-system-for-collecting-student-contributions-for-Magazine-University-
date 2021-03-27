-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2021 at 01:15 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contribution_appication`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `admin_id`) VALUES
('admin', 'admin', 1),
('admin', 'admin', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`f_id`, `f_name`, `f_description`, `f_manager`, `faculty_id`) VALUES
(22, 'Faculty 1', 'oke', 'ad 1', 'GCH17527'),
(23, 'Faculty 2', 'ad', 'ad2', 'GCH17528'),
(24, 'Faculty 3', 'ad', 'ad 3', 'GCH17529'),
(25, 'Faculty 4', 'oke', 'ad 4', 'GCH17530'),
(26, 'Faculty 5', 'ad', 'ad 5', 'GCH17531'),
(27, 'Faculty 6', 'ad', 'ad 6', 'GCH17532');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file_comment`
--

INSERT INTO `file_comment` (`file_comment_id`, `file_comment_content`, `file_comment_time`, `file_comment_user`, `file_submited_id`) VALUES
(11, 'Oke chính', 1616582489, 50, 50),
(12, 'ad', 1616582586, 50, 50),
(13, 'Oke rồi', 1616582797, 50, 51);

-- --------------------------------------------------------

--
-- Table structure for table `file_content`
--

CREATE TABLE `file_content` (
  `file_content_id` int(20) NOT NULL,
  `file_content_name` varchar(3000) NOT NULL,
  `file_content_update_name` int(11) NOT NULL,
  `file_submit_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file_content`
--

INSERT INTO `file_content` (`file_content_id`, `file_content_name`, `file_content_update_name`, `file_submit_id`) VALUES
(15, '107ed0167a9a2938451c00d0453c517797485493_2490671654577425_8179314827781472256_n.png', 1616579689, 50),
(16, '107ed0167a9a2938451c00d0453c517745C64A49-E3CC-4FE8-8DAA-93ED181C53C1.jpg', 1616579689, 50),
(17, '1273533eb4e696773834f64098867195144531148_200303688502170_6189451453374423095_n.png', 1616579718, 51),
(18, '1273533eb4e696773834f64098867195158384890_147610643901366_5275522211667288605_n.png', 1616579718, 51);

-- --------------------------------------------------------

--
-- Table structure for table `file_submit_to_topic`
--

CREATE TABLE `file_submit_to_topic` (
  `id` int(20) NOT NULL,
  `file_name` varchar(55) NOT NULL,
  `file_authod` varchar(55) NOT NULL,
  `file_status` int(20) NOT NULL,
  `file_date_uploaded` datetime NOT NULL,
  `file_date_edited` datetime NOT NULL,
  `file_topic_uploaded` int(11) NOT NULL,
  `file_userId_uploaded` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file_submit_to_topic`
--

INSERT INTO `file_submit_to_topic` (`id`, `file_name`, `file_authod`, `file_status`, `file_date_uploaded`, `file_date_edited`, `file_topic_uploaded`, `file_userId_uploaded`) VALUES
(50, 'Môn 1', 'Chinh', 2, '2021-03-24 16:54:49', '0000-00-00 00:00:00', 24, 44),
(51, 'môn 2', 'Chinh ', 3, '2021-03-24 16:55:18', '0000-00-00 00:00:00', 25, 44);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(20) NOT NULL,
  `news_content_short` varchar(255) NOT NULL,
  `news_content` text NOT NULL,
  `news_image` varchar(255) NOT NULL,
  `news_date_create_time` datetime NOT NULL,
  `news_title` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(20) NOT NULL,
  `role_name` varchar(15) NOT NULL,
  `role_full_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_full_name`) VALUES
(1, 'admin', 'admin permissio'),
(2, 'user', 'user permission');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(20) NOT NULL,
  `semester` varchar(125) NOT NULL,
  `schoolyear` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `topic_id` varchar(20) NOT NULL,
  `topic_name` varchar(255) NOT NULL,
  `topic_description` varchar(255) NOT NULL,
  `topic_deadline` datetime NOT NULL,
  `faculty_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `topic_id`, `topic_name`, `topic_description`, `topic_deadline`, `faculty_id`) VALUES
(24, 'GCH1', 'Topic môn 1', 'Topic oke', '2021-03-21 16:07:00', 22),
(25, 'GCH2', 'Topic môn 2', 'Topic oke', '2021-03-24 16:07:00', 22),
(26, 'GCH3', 'Topic môn 3', 'Nộp bài môn 3', '2021-03-24 16:11:00', 23),
(27, 'GCH4', 'Topic môn 4', 'Nộp bài môn 4', '2021-03-23 16:12:00', 24);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `username`, `password`, `email`, `status`, `u_create_time`, `u_update_time`, `fullname`, `role`, `faculty_id`) VALUES
(44, 'student1', '123456', 'truongbachinh1998@gmail.com', 1, 1616576159, 0, 'student 1 ', 'student', 22),
(45, 'student2', '123456', 'truongbachinh1998@gmail.com', 1, 1616576183, 0, 'student 2', 'student', 22),
(46, 'student3', '123456', 'truongbachinh1998@gmail.com', 1, 1616576204, 0, 'student 3', 'student', 23),
(47, 'student4', '123456', 'truongbachinh1998@gmail.com', 1, 1616576221, 0, 'student 4', 'student', 23),
(48, 'student5', '123456', 'truongbachinh1998@gmail.com', 1, 1616576240, 0, 'student 5', 'student', 24),
(49, 'student6', '123456', 'truongbachinh1998@gmail.com', 1, 1616576259, 0, 'student 6', 'student', 24),
(50, 'faculty1', '123456', 'truongbachinh1998@gmail.com', 1, 1616577179, 0, 'faculty 1', 'manager-coordinator', 22),
(51, 'faculty2', '123456', 'truongbachinh1998@gmail.com', 1, 1616577201, 0, 'chinh truong', 'manager-coordinator', 23),
(52, 'faculty3', '123456', 'truongbachinh1998@gmail.com', 1, 1616577216, 0, 'chinh truong', 'manager-coordinator', 24);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_Id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `role_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `file_submit_to_topic`
--
ALTER TABLE `file_submit_to_topic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fogeign_key_file_topic` (`file_topic_uploaded`),
  ADD KEY `fogeign_key_file_user` (`file_userId_uploaded`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`,`role_name`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fogeign_key_topic_faculty` (`faculty_id`);

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
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_Id`),
  ADD KEY `fogeign_key_userRole_role` (`role_id`),
  ADD KEY `fogeign_key_userRole_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `f_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `file_comment`
--
ALTER TABLE `file_comment`
  MODIFY `file_comment_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `file_content`
--
ALTER TABLE `file_content`
  MODIFY `file_content_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `file_submit_to_topic`
--
ALTER TABLE `file_submit_to_topic`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user_infor`
--
ALTER TABLE `user_infor`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file_comment`
--
ALTER TABLE `file_comment`
  ADD CONSTRAINT `fogeign_key_coment_user` FOREIGN KEY (`file_comment_user`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fogeign_key_comment_file` FOREIGN KEY (`file_submited_id`) REFERENCES `file_submit_to_topic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `file_content`
--
ALTER TABLE `file_content`
  ADD CONSTRAINT `fogeign_key_file_file_submit` FOREIGN KEY (`file_submit_id`) REFERENCES `file_submit_to_topic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `file_submit_to_topic`
--
ALTER TABLE `file_submit_to_topic`
  ADD CONSTRAINT `fogeign_key_file_topic` FOREIGN KEY (`file_topic_uploaded`) REFERENCES `topic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fogeign_key_file_user` FOREIGN KEY (`file_userId_uploaded`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `fogeign_key_topic_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`f_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `fogeign_key_userRole_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fogeign_key_userRole_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
