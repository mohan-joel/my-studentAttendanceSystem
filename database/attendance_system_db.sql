-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2023 at 06:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_class_teacher`
--

CREATE TABLE `assign_class_teacher` (
  `id` int(11) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_class_teacher`
--

INSERT INTO `assign_class_teacher` (`id`, `teacher_name`, `class`, `section`, `subject`, `status`) VALUES
(1, 'Saman Raj Baidhya', '1', 'A', 'English', 1),
(2, 'Sarita Dhital', '1', 'B', 'Nepali', 1),
(3, 'Samarpan  Panthi', '2', 'A', 'Math', 1),
(4, 'Santima Shakya', '2', 'B', 'Science', 1),
(5, 'Satisma Pandey', '3', 'A', 'Social', 1),
(6, 'Swatika Khadka', '3', 'A', 'Grammer', 1),
(7, 'Bikash Thadrai', '4', 'A', 'Health', 1),
(8, 'Abhisek Tuladhar', '4', 'B', 'Moral Science', 1),
(9, 'Antima Pandey', '5', 'A', 'OBTE', 1),
(10, 'Swastima Khadka', '5', 'B', 'Science', 1);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `section_name`) VALUES
(1, '1', 'A'),
(2, '1', 'B'),
(3, '2', 'A'),
(4, '2', 'B'),
(5, '3', 'A'),
(6, '3', 'B'),
(7, '4', 'A'),
(8, '4', 'B'),
(9, '5', 'A'),
(10, '5', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `father_contact` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `mother_contact` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `gender`, `class`, `section`, `address`, `contact`, `father_name`, `father_contact`, `mother_name`, `mother_contact`, `photo`) VALUES
(1, 'Sajin Chhetri', 'male', '5', 'A', 'tinkune', '9807587023', 'Sajan raj Chhettri', '9804423689', 'Sajina Chhettri', '9805569863', 'sajin.jpeg'),
(3, 'Ashim Pandey', 'boy', '1', 'A', 'golpark', '9804526985', 'Ashish Pandey', '9804526985', 'Neelam Pandey', '9804526985', 'boy.jpeg'),
(4, 'Akriti Pandey', 'girl', '1', 'A', 'Golpark', '9804526985', 'Ashish Pandey', '9804526985', 'Neelam Pandy', '9804526985', 'girls.jpeg'),
(5, 'Nishchit Shrestha', 'boy', '1', 'A', 'kalikanagar', '9804526985', 'Nitish Shrestha', '9804526985', 'Nilima Shrestha', '9804526985', 'boy.jpeg'),
(6, 'Nigam Sheikh', 'boy', '1', 'A', 'Naramput', '9804526985', 'Nimesh Sheikh', '9804526985', 'Nintina Shiekh', '9804526985', 'boy.jpeg'),
(7, 'Bikram Paudel', 'boy', '1', 'A', 'narganagar', '9804526985', 'Bibesh Paudel', '9804526985', 'Binita Paudel', '9804526985', 'boy.jpeg'),
(8, 'Santosh Ale', 'boy', '1', 'A', 'Chaparhatti', '9804526985', 'Santaram Ale', '9804526985', 'Santini Ale', '9804526985', 'boy.jpeg'),
(9, 'Rashmi B K', 'girl', '1', 'A', 'Simanagar', '9804526985', 'Raman B K', '9804526985', 'Ronisha B K', '9804526985', 'girls.jpeg'),
(10, 'Raunak Baidya', 'boy', '1', 'A', 'Nalampur', '9804526985', 'Ramesh Baidya', '9804526985', 'Rauninayan Baidya', '9804526985', 'boy.jpeg'),
(11, 'Bibek Sinjali', 'boy', '1', 'A', 'Pragatinagar', '9804526985', 'Bhim Sinjali', '9804526985', 'Bimala Sinjali', '9804526985', 'boy.jpeg'),
(12, 'Khem Bahadur Sinjali', 'boy', '1', 'A', 'Paminagar', '9804526985', 'Keshav Bahadur Sinjali', '9804526985', 'Kanti Sinjali', '9804526985', 'boy.jpeg'),
(13, 'Harichanda Barai', 'boy', '1', 'B', 'kalikanagar', '9804423693', 'Harilal Barai', '9804423693', 'HarmanPreet Barai', '9804423693', 'boy.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `class` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `class_teacher` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`id`, `dates`, `class`, `section`, `class_teacher`, `student_name`, `status`) VALUES
(1, '2023-11-04', '1', 'A', 'Saman Raj Baidhya', 'Ashim Pandey', 'Present'),
(2, '2023-11-04', '1', 'A', 'Saman Raj Baidhya', 'Akriti Pandey', 'Absent'),
(3, '2023-11-04', '1', 'A', 'Saman Raj Baidhya', 'Nishchit Shrestha', 'Present'),
(4, '2023-11-04', '1', 'A', 'Saman Raj Baidhya', 'Nigam Sheikh', 'Present'),
(5, '2023-11-04', '1', 'A', 'Saman Raj Baidhya', 'Bikram Paudel', 'Present'),
(6, '2023-11-04', '1', 'A', 'Saman Raj Baidhya', 'Santosh Ale', 'Present'),
(7, '2023-11-04', '1', 'A', 'Saman Raj Baidhya', 'Rashmi B K', 'Present'),
(8, '2023-11-04', '1', 'A', 'Saman Raj Baidhya', 'Raunak Baidya', 'Present'),
(9, '2023-11-04', '1', 'A', 'Saman Raj Baidhya', 'Bibek Sinjali', 'Present'),
(10, '2023-11-04', '1', 'A', 'Saman Raj Baidhya', 'Khem Bahadur Sinjali', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `email`, `address`, `contact`, `school`, `password`, `role`, `photo`) VALUES
(1, 'Mohan Bashyal', 'male', 'mohanbashyal37@gmail.com', 'kalikanagar', '9807587026', 'Tribhuwan United Academy', '56128f9ac96f6e9df190b0ae05d33150', 'Admin', 'me.jpg'),
(2, 'mohan bashyal', 'male', 'bashyalmohan77@gmail.com', 'kalikachowk', '9807569872', 'Tribhuwan United Academy', '12541254', 'Admin', 'boy.jpeg'),
(3, 'Saman Raj Baidhya', 'male', 'saman@gmail.com', 'kalinchowk', '9804426398', 'Tribhuwan United Academy', '12541254', 'Teacher', 'boy.jpeg'),
(4, 'Sarita Dhital', 'female', 'sarita@gmail.com', 'devinagar', '9804526985', 'Tribhuwan United Academy', '12541254', 'Teacher', 'girls.jpeg'),
(5, 'Samarpan  Panthi', 'male', 'samarpan@gmail.com', 'sukhanagar', '9804526985', 'Tribhuwan United Academy', '12541254', 'Teacher', 'boy.jpeg'),
(6, 'Santima Shakya', 'female', 'santima@gmail.com', 'golpark', '9804526985', 'Tribhuwan United Academy', '56128f9ac96f6e9df190b0ae05d33150', 'Teacher', 'girls.jpeg'),
(7, 'Satisma Pandey', 'female', 'satisma@gmail.com', 'drivertole', '9804526985', 'Tribhuwan United Academy', '56128f9ac96f6e9df190b0ae05d33150', 'Teacher', 'girls.jpeg'),
(8, 'Swatika Khadka', 'female', 'swastika@gmail.com', 'drivertole', '9804526985', 'Tribhuwan United Academy', '56128f9ac96f6e9df190b0ae05d33150', 'Teacher', 'girls.jpeg'),
(9, 'Saroj Timilsina', 'male', 'saroj@gmail.com', 'simanagar', '9804526985', 'Tribhuwan United Academy', '56128f9ac96f6e9df190b0ae05d33150', 'Teacher', 'boy.jpeg'),
(10, 'Aman Ghimire', 'male', 'aman@gmail.com', 'golpark', '9804526985', 'Tribhuwan United Academy', '56128f9ac96f6e9df190b0ae05d33150', 'Teacher', 'boy.jpeg'),
(11, 'Sujal Ghimire', 'male', 'sujal@gmail.com', 'golpark', '9804526985', 'Tribhuwan United Academy', '56128f9ac96f6e9df190b0ae05d33150', 'Teacher', 'boy.jpeg'),
(12, 'Swastima Khadka', 'female', 'swastima@gmail.com', 'pragatinagar', '9804526985', 'Tribhuwan United Academy', '56128f9ac96f6e9df190b0ae05d33150', 'Teacher', 'girls.jpeg'),
(13, 'Antima Pandey', 'female', 'antima@gmail.com', 'pulchowk', '9804526985', 'Tribhuwan United Academy', '56128f9ac96f6e9df190b0ae05d33150', 'Teacher', 'girls.jpeg'),
(14, 'Abhisek Tuladhar', 'male', 'abhisek@gmail.com', 'talodevinagar', '9804526985', 'Tribhuwan United Academy', '56128f9ac96f6e9df190b0ae05d33150', 'Teacher', 'boy.jpeg'),
(15, 'Bikash Thadrai', 'male', 'bikash@gmail.com', 'shankarnagar', '9804526985', 'Tribhuwan United Academy', '56128f9ac96f6e9df190b0ae05d33150', 'Teacher', 'boy.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_class_teacher`
--
ALTER TABLE `assign_class_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
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
-- AUTO_INCREMENT for table `assign_class_teacher`
--
ALTER TABLE `assign_class_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
