-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2022 at 03:22 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doccure`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patientID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `createdAt` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patientID`, `doctorID`, `date`, `time`, `status`, `createdAt`) VALUES
(1, 1, 3, '2022-10-09', '06:20', 'Pending', '2022-09-27'),
(2, 1, 1, '2022-09-17', '03:20', 'Cancelled', '2022-09-27'),
(3, 1, 8, '2022-10-06', '06:17', 'Cancelled', '2022-09-27'),
(4, 1, 11, '2022-09-14', '12:00', 'Cancelled', '2022-09-27'),
(5, 1, 5, '2022-09-16', '03:20', 'Confirm', '2022-09-27'),
(6, 1, 9, '2022-10-19', '18:08', 'Confirm', '2022-09-27'),
(7, 1, 2, '2022-10-29', '14:00', 'Pending', '2022-09-27'),
(8, 1, 10, '2022-11-19', '12:00', 'Confirm', '2022-09-27'),
(9, 1, 7, '2022-12-16', '02:25', 'Cancelled', '2022-09-27'),
(10, 2, 2, '2022-11-15', '11:30', 'Pending', '2022-09-27'),
(11, 2, 9, '2022-09-16', '18:30', 'Cancelled', '2022-09-27'),
(12, 2, 3, '2022-10-07', '06:00', 'Cancelled', '2022-09-27'),
(13, 2, 1, '2022-09-17', '03:20', 'Confirm', '2022-09-27'),
(14, 2, 8, '2022-10-06', '06:17', 'Cancelled', '2022-09-27'),
(15, 2, 11, '2022-09-14', '12:00', 'Confirm', '2022-09-27'),
(16, 2, 5, '2022-09-16', '03:20', 'Confirm', '2022-09-27'),
(17, 1, 10, '2022-10-19', '16:00', 'Confirm', '2022-09-27'),
(18, 4, 2, '2022-10-29', '14:00', 'Pending', '2022-09-27'),
(19, 3, 2, '2022-11-19', '12:00', 'Pending', '2022-09-27'),
(20, 3, 3, '2022-12-16', '02:25', 'Cancelled', '2022-09-27'),
(21, 1, 12, '2022-10-19', '11:30', 'Cancelled', '2022-09-27'),
(22, 5, 8, '2022-10-14', '18:30', 'Pending', '2022-09-27'),
(23, 6, 10, '2022-10-13', '14:00', 'Confirm', '2022-09-27'),
(24, 7, 5, '2022-10-12', '17:00', 'Confirm', '2022-09-27'),
(25, 8, 8, '2022-09-30', '18:00', 'Cancelled', '2022-09-27'),
(26, 7, 4, '2022-09-29', '21:20', 'Confirm', '2022-09-27'),
(27, 5, 12, '2022-09-28', '22:30', 'Pending', '2022-09-27'),
(28, 8, 12, '2022-11-28', '22:00', 'Pending', '2022-09-27'),
(29, 2, 4, '2022-09-28', '18:30', 'Confirm', '2022-09-27'),
(30, 3, 1, '2022-09-17', '03:20', 'Confirm', '2022-09-27'),
(31, 8, 1, '2022-09-17', '03:20', 'Confirm', '2022-09-27'),
(32, 4, 3, '2022-10-09', '15:55', 'Pending', '2022-09-27'),
(33, 2, 1, '2022-12-25', '03:00', 'Pending', '2022-09-27'),
(34, 3, 1, '2022-12-25', '13:59', 'Pending', '2022-09-30'),
(35, 3, 1, '2022-12-25', '13:59', 'Pending', '2022-11-11'),
(36, 5, 1, '2022-11-25', '13:59', 'Pending', '2022-11-11'),
(37, 8, 1, '2023-11-25', '13:59', 'Confirm', '2022-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fName` varchar(50) DEFAULT NULL,
  `lName` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `image` varchar(300) DEFAULT 'imgs/doctor.jpg',
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `email`, `password`, `fName`, `lName`, `phone`, `image`, `country`, `state`, `biography`, `specialization`, `price`) VALUES
(1, 'yahya@email.com', 'fd9a51aac524e49a4701aec05efc24b77eefde88', 'Yahya', '', '0100000001', 'imgs/6513844801664236414foto-sushi-6anudmpILw4-unsplash.jpg', 'Egypt', 'Cairo', 'Whatever you do, do with determination. You have one life to live; do your work with passion and give your best. Whether you want to be a chef, doctor, actor, or a mother, be passionate to get the best result.', 'Ear, nose and throat (ENT)', '250'),
(2, 'salah@email.com', 'b0cb27789417899a4b3678da8e92d427c8c77e0d', 'Salah', 'Zanon', '0100000002', 'imgs/5018880421664236561doctor-02.jpg', 'Egypt', 'Giza', 'Whatever you do, do with determination. You have one life to live; do your work with passion and give your best. Whether you want to be a chef, doctor, actor, or a mother, be passionate to get the best result.', 'Dentistry', '150'),
(3, 'momen@email.com', '6c0067b87c15cd0756e5f0ec0589f89de5ec26d9', 'Momen', 'Khaled', '0100000003', 'imgs/2702131801664237237doctor-05.jpg', 'Egypt', 'Ashmoun', 'Whatever you do, do with determination. You have one life to live; do your work with passion and give your best. Whether you want to be a chef, doctor, actor, or a mother, be passionate to get the best result.\r\n\r\n', 'Physical therapist', '200'),
(4, 'shukri@email.com', 'f9cdb22d63c87db3cf63d46258d479b1f7a3b31c', 'Shukri', 'Salama', '0100000004', 'imgs/18572087721664237272doctor-08.jpg', 'Canada', 'Ottawa', 'Whatever you do, do with determination. You have one life to live; do your work with passion and give your best. Whether you want to be a chef, doctor, actor, or a mother, be passionate to get the best result.', 'Physical therapist', '110'),
(5, 'adel@email.com', '47000d841e0bf5c528435fc36806ad95cdb5d82b', 'Adel', 'Shakal', '0100000005', 'imgs/14983107911664237302doctor-09.jpg', 'Egypt', 'Menouf', 'Whatever you do, do with determination. You have one life to live; do your work with passion and give your best. Whether you want to be a chef, doctor, actor, or a mother, be passionate to get the best result.', 'Dermatology', '400'),
(6, 'roshdy@email.com', '77f1a517dbcf527bd71e076cef1778335092f0f5', 'Roshdy', 'Elsayed', '0100000006', 'imgs/8079519451664237362doctor-12.jpg', 'Egypt', '', 'Whatever you do, do with determination. You have one life to live; do your work with passion and give your best. Whether you want to be a chef, doctor, actor, or a mother, be passionate to get the best result.', 'Hematology', '50'),
(7, 'rania@email.com', '45ed0b8fe002ba551d00ac5b0ec2db3ce96dc251', 'Rania', 'Raghib', '0100000007', 'imgs/6713548051664237413doctor-01.jpg', 'Egypt', 'Cairo', 'Whatever you do, do with determination. You have one life to live; do your work with passion and give your best. Whether you want to be a chef, doctor, actor, or a mother, be passionate to get the best result.', 'General surgery', '300'),
(8, 'erica@email.com', 'b34dcff65a61fa6f44bf3335bcddbdc3b76b7e78', 'Erica', 'Jonas', '0100000008', 'imgs/11432836091664237502doctor-03.jpg', 'Canada', 'Ottawa', 'Whatever you do, do with determination. You have one life to live; do your work with passion and give your best. Whether you want to be a chef, doctor, actor, or a mother, be passionate to get the best result.', 'Family medicine', '500'),
(9, 'sara@email.com', 'dea04453c249149b5fc772d9528fe61afaf7441c', 'Sara', 'Tawfik', '0100000009', 'imgs/2738387731664237529doctor-06.jpg', 'Turkey', 'Ankara ', 'Whatever you do, do with determination. You have one life to live; do your work with passion and give your best. Whether you want to be a chef, doctor, actor, or a mother, be passionate to get the best result.', 'General surgery', '550'),
(10, 'shimaa@email.com', '397b8d36e2bdb85716b56437cda18d18b3a699a4', 'Shimaa', 'Khalel', '0100000010', 'imgs/613729331664237554doctor-10.jpg', 'Germony', 'Berline', 'Whatever you do, do with determination. You have one life to live; do your work with passion and give your best. Whether you want to be a chef, doctor, actor, or a mother, be passionate to get the best result.', 'Plastic surgery', '350'),
(11, 'nesma@email.com', '659bf48847b116c13db6bafdbc437bc02c2dc316', 'Nesma', 'Badr', '0100000011', 'imgs/960515881664237752doctor-07.jpg', 'Egypt', 'Cairo', 'Whatever you do, do with determination. You have one life to live; do your work with passion and give your best. Whether you want to be a chef, doctor, actor, or a mother, be passionate to get the best result.', 'Plastic surgery', '350'),
(12, 'gehad@email.com', '0a5cfe46eb46ce4439efc3fcff1a770eb84363cf', 'Gehad', 'Nasr', '0100000012', 'imgs/2199322371664237619doctor-11.jpg', 'Tokyo', 'Edo', 'Whatever you do, do with determination. You have one life to live; do your work with passion and give your best. Whether you want to be a chef, doctor, actor, or a mother, be passionate to get the best result.', 'Family medicine', '210');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fName` varchar(50) DEFAULT NULL,
  `lName` varchar(50) DEFAULT NULL,
  `image` varchar(300) DEFAULT 'imgs/user.jpg',
  `dateOfBirth` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `bloodGroup` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `zipCode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `email`, `password`, `fName`, `lName`, `image`, `dateOfBirth`, `phone`, `bloodGroup`, `address`, `city`, `state`, `country`, `zipCode`) VALUES
(1, 'yahya@email.com', 'fd9a51aac524e49a4701aec05efc24b77eefde88', 'Yahya', 'Saad', 'imgs/2248213991664233544yahya.jpg', '24/09/2002', '01200000001', 'AB-', 'Alglaaa St.', 'Ashmoun', 'El Monofia', 'Egypt', '32811'),
(2, 'youssef@email.com', '929ca6093a5ff966b1712a0f9ab0a5f3e92718ad', 'Youssef', 'Saad', 'imgs/649707161664238335youssef.jpg', '27/09/2005', '01234567801', 'B-', 'Down Town', 'Cairo', 'Cairo', 'Egypt', '32111'),
(3, 'mahmoud_mostafa@email.com', '42f1c6a8b4b7edc3dc0b2517f798bae0e044b713', 'Mahmoud', 'Mostafa', 'imgs/4082004551664238829mahmoud.jpg', '22/01/2005', '01234567802', 'B+', 'Random', '', 'Alsharqia', 'Egypt', '32811'),
(4, 'mahmoud_khaled@email.com', '42f1c6a8b4b7edc3dc0b2517f798bae0e044b713', 'Mahmoud', 'Khaled', 'imgs/12374615391664238850mahmoud.jpg', '27/07/2004', '01234567803', 'A+', 'Random', 'Tala', 'El Monofia', 'Egypt', '34490'),
(5, 'yassmine@email.com', '652fceb15b2a63bf47d6324cb4a5e40d8d1141b5', 'Yassmine', 'Radi', 'imgs/3069160491664238874yassmine.jpg', '27/09/2003', '01234567841', 'A-', 'Random', 'Darawa', 'El Monofia', 'Egypt', '34491'),
(6, 'shrouq@email.com', '98d46658f54af49c44fcba9d4546326d1b2d3c7c', 'Shrouq', 'Mahmoud', 'imgs/15641116261664238898shrouq.jpg', '02/09/2005', '01236567801', 'A+', '13 Ahmed Orabi st', 'El-zamalek', 'Cairo', 'Egypt', '5811'),
(7, 'ahmed@email.com', '1698c2bea6c8000723d5bb70363a8352d846917e', 'Ahmed', 'Abusrea', 'imgs/8895448631664238919ahmed.jpg', '24/09/2001', '01234562101', 'O-', 'Random', 'El-mohandsen', 'Giza', 'Egypt', '1234'),
(8, 'omar@email.com', '4a6db2314c199446c0e2d3e48e30295622c96639', 'Omar', 'Younes', 'imgs/12404791211664238945omar.jpg', '27/09/2012', '01234567821', 'AB+', 'Random', 'Random', 'Banha', 'Egypt', '5678'),
(9, 'mariem@email.com', 'fc80b28da3be21462ff9e1cef083fbd810c88a2c', 'Mariem', 'Abdelfatah', 'imgs/19330790381664238965mariem.jpg', '21/12/2007', '01234567844', 'O+', 'Random', 'Random', 'Tanta', 'Egypt', '78921');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient` (`patientID`),
  ADD KEY `doctor` (`doctorID`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `doctor` FOREIGN KEY (`doctorID`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `patient` FOREIGN KEY (`patientID`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
